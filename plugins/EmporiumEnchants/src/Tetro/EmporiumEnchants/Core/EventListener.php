<?php

# Namespace
namespace Tetro\EmporiumEnchants\Core;


use pocketmine\block\BlockLegacyIds;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\entity\{EntityDamageByEntityEvent, EntityDamageEvent, EntityEffectAddEvent, ProjectileHitBlockEvent};
use pocketmine\event\inventory\InventoryTransactionEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\{PlayerDeathEvent, PlayerInteractEvent, PlayerItemHeldEvent, PlayerJoinEvent, PlayerMoveEvent, PlayerQuitEvent, PlayerToggleSneakEvent};
use pocketmine\event\server\{DataPacketSendEvent, DataPacketReceiveEvent};
use pocketmine\inventory\{ArmorInventory, CallbackInventoryListener, Inventory, PlayerInventory};
use pocketmine\inventory\transaction\action\SlotChangeAction;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\{Item, ItemIds, VanillaItems};
use pocketmine\network\mcpe\protocol\{InventoryContentPacket, InventorySlotPacket, InventoryTransactionPacket, MobEquipmentPacket, PlayerAuthInputPacket};
use pocketmine\network\mcpe\protocol\types\inventory\ItemStackWrapper;
use pocketmine\player\Player;

use pocketmine\utils\TextFormat;
use Tetro\EmporiumEnchants\Core\Types\{ReactiveEnchantment, ToggleableEnchantment};
use Tetro\EmporiumEnchants\Utils\Utils;

class EventListener implements Listener {

    public function onBreak(BlockBreakEvent $event): void {
        $player = $event->getPlayer();
        ReactiveEnchantment::attemptReaction($player, $event);
    }

    public function onDataPacketReceive(DataPacketReceiveEvent $event): void
    {
        $packet = $event->getPacket();
        if ($packet instanceof InventoryTransactionPacket) {
            $transaction = $packet->trData;
            foreach ($transaction->getActions() as $action) {
                $action->oldItem = new ItemStackWrapper($action->oldItem->getStackId(), Utils::filterDisplayedEnchants($action->oldItem->getItemStack()));
                $action->newItem = new ItemStackWrapper($action->newItem->getStackId(), Utils::filterDisplayedEnchants($action->newItem->getItemStack()));
            }
        }
        if ($packet instanceof PlayerAuthInputPacket) {
            $blockActions = $packet->getBlockActions();
        }
        if ($packet instanceof MobEquipmentPacket) Utils::filterDisplayedEnchants($packet->item->getItemStack());
    }

    public function onDataPacketSend(DataPacketSendEvent $event): void
    {
        $packets = $event->getPackets();
        foreach ($packets as $packet) {
            if ($packet instanceof InventorySlotPacket) {
                $packet->item = new ItemStackWrapper($packet->item->getStackId(), Utils::displayEnchants($packet->item->getItemStack()));
            }
            if ($packet instanceof InventoryContentPacket) {
                foreach ($packet->items as $i => $item) {
                    $packet->items[$i] = new ItemStackWrapper($item->getStackId(), Utils::displayEnchants($item->getItemStack()));
                }
            }
        }
    }

    /**
     * @priority HIGHEST
     */
    public function onDamage(EntityDamageEvent $event): void
    {
        $entity = $event->getEntity();
        if ($entity instanceof Player) {
            if ($event->getCause() === EntityDamageEvent::CAUSE_FALL && !Utils::shouldTakeFallDamage($entity)) {
                if ($entity->getArmorInventory()->getBoots()->getEnchantment(CustomEnchantManager::getEnchantment(CustomEnchantIds::SPRINGS)) === null) Utils::setShouldTakeFallDamage($entity, true);
                $event->cancel();
                return;
            }
            ReactiveEnchantment::attemptReaction($entity, $event);
        }
        if ($event instanceof EntityDamageByEntityEvent) {
            $attacker = $event->getDamager();
            if ($attacker instanceof Player) ReactiveEnchantment::attemptReaction($attacker, $event);
        }
    }

    /**
     * @priority HIGHEST
     */
    public function onEffectAdd(EntityEffectAddEvent $event): void
    {
        $entity = $event->getEntity();
        if ($entity instanceof Player) ReactiveEnchantment::attemptReaction($entity, $event);
    }

    public function onDeath(PlayerDeathEvent $event): void
    {
        ReactiveEnchantment::attemptReaction($event->getPlayer(), $event);
    }

    /**
     * @priority HIGHEST
     */
    public function onInteract(PlayerInteractEvent $event): void
    {
        ReactiveEnchantment::attemptReaction($event->getPlayer(), $event);
    }

    /**
     * @priority HIGHEST
     */
    public function onItemHold(PlayerItemHeldEvent $event): void
    {
        $player = $event->getPlayer();
        $inventory = $player->getInventory();
        $oldItem = $inventory->getItemInHand();
        $newItem = $event->getItem();
        foreach ($oldItem->getEnchantments() as $enchantmentInstance) ToggleableEnchantment::attemptToggle($player, $oldItem, $enchantmentInstance, $inventory, $inventory->getHeldItemIndex(), false);
        foreach ($newItem->getEnchantments() as $enchantmentInstance) ToggleableEnchantment::attemptToggle($player, $newItem, $enchantmentInstance, $inventory, $inventory->getHeldItemIndex());
    }

    public function onJoin(PlayerJoinEvent $event): void
    {
        $player = $event->getPlayer();
        foreach ($player->getInventory()->getContents() as $slot => $content) {
            foreach ($content->getEnchantments() as $enchantmentInstance) {
                ToggleableEnchantment::attemptToggle($player, $content, $enchantmentInstance, $player->getInventory(), $slot);
            }
        }
        foreach ($player->getArmorInventory()->getContents() as $slot => $content) {
            foreach ($content->getEnchantments() as $enchantmentInstance) {
                ToggleableEnchantment::attemptToggle($player, $content, $enchantmentInstance, $player->getArmorInventory(), $slot);
            }
        }

        $onSlot = function (Inventory $inventory, int $slot, Item $oldItem): void {
            if ($inventory instanceof PlayerInventory || $inventory instanceof ArmorInventory) {
                $holder = $inventory->getHolder();
                if ($holder instanceof Player) {
                    if (!$oldItem->equals(($newItem = $inventory->getItem($slot)), !$inventory instanceof ArmorInventory)) {
                        if ($newItem->getId() === ItemIds::AIR || $inventory instanceof ArmorInventory) foreach ($oldItem->getEnchantments() as $oldEnchantment) ToggleableEnchantment::attemptToggle($holder, $oldItem, $oldEnchantment, $inventory, $slot, false);
                        if ($oldItem->getId() === ItemIds::AIR || $inventory instanceof ArmorInventory) foreach ($newItem->getEnchantments() as $newEnchantment) ToggleableEnchantment::attemptToggle($holder, $newItem, $newEnchantment, $inventory, $slot);
                    }
                }
            }
        };
        /**
         * @param Item[] $oldContents
         */
        $onContent = function (Inventory $inventory, array $oldContents) use ($onSlot): void {
            foreach ($oldContents as $slot => $oldItem) {
                if (!($oldItem ?? VanillaItems::AIR())->equals($inventory->getItem($slot), !$inventory instanceof ArmorInventory)) {
                    $onSlot($inventory, $slot, $oldItem);
                }
            }
        };
        $player->getInventory()->getListeners()->add(new CallbackInventoryListener($onSlot, $onContent));
        $player->getArmorInventory()->getListeners()->add(new CallbackInventoryListener($onSlot, $onContent));
    }

    /**
     * @priority HIGHEST
     */
    public function onMove(PlayerMoveEvent $event): void
    {
        $player = $event->getPlayer();
        if (!Utils::shouldTakeFallDamage($player)) {
            if ($player->getWorld()->getBlock($player->getPosition()->floor()->subtract(0, 1, 0))->getId() !== BlockLegacyIds::AIR && Utils::getNoFallDamageDuration($player) <= 0) {
                Utils::setShouldTakeFallDamage($player, true);
            } else {
                Utils::increaseNoFallDamageDuration($player);
            }
        }
        if ($event->getFrom()->floor()->equals($event->getTo()->floor())) return;
        ReactiveEnchantment::attemptReaction($player, $event);
    }

    /**
     * @priority MONITOR
     */
    public function onQuit(PlayerQuitEvent $event): void
    {
        $player = $event->getPlayer();
        if (!$player->isClosed()) {
            foreach ($player->getInventory()->getContents() as $slot => $content) {
                foreach ($content->getEnchantments() as $enchantmentInstance) {
                    ToggleableEnchantment::attemptToggle($player, $content, $enchantmentInstance, $player->getInventory(), $slot, false);
                }
            }
            foreach ($player->getArmorInventory()->getContents() as $slot => $content) {
                foreach ($content->getEnchantments() as $enchantmentInstance) {
                    ToggleableEnchantment::attemptToggle($player, $content, $enchantmentInstance, $player->getArmorInventory(), $slot, false);
                }
            }
        }
    }

    /**
     * @priority HIGHEST
     */
    public function onSneak(PlayerToggleSneakEvent $event): void
    {
        ReactiveEnchantment::attemptReaction($event->getPlayer(), $event);
    }

    /**
     * @priority HIGHEST
     */
    public function onProjectileHitBlock(ProjectileHitBlockEvent $event): void
    {
        $shooter = $event->getEntity()->getOwningEntity();
        if ($shooter instanceof Player) ReactiveEnchantment::attemptReaction($shooter, $event);
    }

    /**
     * @priority HIGHEST
     */
    public function onTransaction(InventoryTransactionEvent $event): void {

        $player = $event->getTransaction()->getSource();

        $transaction = $event->getTransaction();
        $actions = array_values($transaction->getActions());
        if (count($actions) === 2) {
            foreach ($actions as $i => $action) {
                if ($action instanceof SlotChangeAction && ($otherAction = $actions[($i + 1) % 2]) instanceof SlotChangeAction && ($itemClickedWith = $action->getTargetItem())->getId() === ItemIds::ENCHANTED_BOOK && ($itemClicked = $action->getSourceItem())->getId() !== ItemIds::AIR) {

                    /* Slot item */
                    if($itemClicked->getId() === ItemIds::ENCHANTED_BOOK || $itemClicked->getNamedTag()->getTag("CustomEnchantBook")) return;
                    if($itemClicked->getNamedTag()->getTag("Energy") === null) return;

                    /* Item in mouse */
                    if($itemClickedWith->getNamedTag()->getTag("CustomEnchantBook") === null) return;

                    if (count($itemClickedWith->getEnchantments()) < 1) return;

                    $bookEnergy = $itemClickedWith->getNamedTag()->getInt("Energy");
                    $bookEnergyNeeded = $itemClickedWith->getNamedTag()->getInt("EnergyNeeded");

                    if($bookEnergy < $bookEnergyNeeded) {
                        $player->sendMessage("You need more energy to do this");
                        return;
                    }

                    $enchantChance = $itemClickedWith->getNamedTag()->getInt("success");
                    $randomNumber = mt_rand(1, 100);

                    foreach ($itemClickedWith->getEnchantments() as $enchantment) {
                        $enchantmentType = $enchantment->getType();
                        $enchantmentLevel = $enchantment->getLevel();
                    }

                    $player->sendMessage("Enchant Level: $enchantmentLevel");


                    if($itemClicked->getEnchantment($enchantmentType) !== null) {
                        # enchant exists
                        if($itemClicked->getEnchantment($enchantmentType)->getLevel() <= $enchantmentLevel) {
                            # enchant exists and is lower or equal level
                            $willChange = false;
                        } else {
                            # enchant exists but is lower than new level
                            if($randomNumber <= $enchantChance) {
                                $player->sendMessage(TextFormat::GREEN . "Enchant successful");
                                $willChange = true;
                            } else {
                                $player->sendMessage(TextFormat::RED . "Enchant failed");
                                $willChange = false;
                            }
                        }
                    } else {
                        # enchant doesnt exist
                        $newLevel = $enchantmentLevel;

                        var_dump($enchantmentType instanceof CustomEnchant);
                        var_dump(Utils::itemMatchesItemType($itemClicked, $enchantmentType->getItemType()));
                        var_dump(Utils::checkEnchantIncompatibilities($itemClicked, $enchantmentType));
                        var_dump($itemClicked->getCount() == 1);
                        var_dump($newLevel <= $enchantmentType->getMaxLevel());

                        # is enchant compatible?
                        if (
                            $enchantmentType instanceof CustomEnchant &&
                            Utils::itemMatchesItemType($itemClicked, $enchantmentType->getItemType()) &&
                            Utils::checkEnchantIncompatibilities($itemClicked, $enchantmentType) &&
                            $itemClicked->getCount() == 1 &&
                            $newLevel <= $enchantmentType->getMaxLevel())
                        {
                            if(($randomNumber <= $enchantChance) || true) {
                                $player->sendMessage("Enchant successful");
                                $willChange = true;
                            } else {
                                $player->sendMessage("Enchant failed");
                                return;
                            }
                        } else {
                            # enchant is not compatible
                            return;
                        }
                    }



                    if ($willChange) {

                        $event->cancel();
                        $itemClicked->addEnchantment(new EnchantmentInstance($enchantmentType, $enchantmentLevel));
                        $action->getInventory()->setItem($action->getSlot(), $itemClicked);
                        $otherAction->getInventory()->setItem($otherAction->getSlot(), VanillaItems::AIR());
                    }
                }
            }
        }
    }

}
