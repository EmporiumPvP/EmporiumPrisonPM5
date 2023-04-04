<?php

# Namespace
namespace Tetro\EmporiumEnchants\Core;

use Emporium\Prison\EmporiumPrison;
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
use pocketmine\network\mcpe\protocol\{InventoryContentPacket,
    InventorySlotPacket,
    InventoryTransactionPacket,
    MobEquipmentPacket,
    PlayerActionPacket,
    PlayerAuthInputPacket,
    types\PlayerAction,
    types\PlayerBlockActionWithBlockInfo};
use pocketmine\network\mcpe\protocol\types\inventory\ItemStackWrapper;
use pocketmine\player\Player;

use pocketmine\utils\TextFormat as TF;
use pocketmine\world\sound\AnvilBreakSound;
use pocketmine\world\sound\DoorBumpSound;
use pocketmine\world\sound\DoorCrashSound;
use pocketmine\world\sound\TotemUseSound;
use Tetro\EmporiumEnchants\Core\Types\{ReactiveEnchantment, ToggleableEnchantment};
use Tetro\EmporiumEnchants\Enchants\Tools\ShatterCE;
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
        if ($packet instanceof PlayerActionPacket) {
            if ($packet->action === PlayerAction::START_BREAK || $packet->action === PlayerAction::CREATIVE_PLAYER_DESTROY_BLOCK) {
                ShatterCE::$lastBreakFace[$event->getOrigin()->getPlayer()->getName()] = $packet->face;
            }
        }
        if ($packet instanceof PlayerAuthInputPacket) {
            $blockActions = $packet->getBlockActions();
            if ($blockActions !== null) {
                foreach ($blockActions as $blockAction) {
                    if ($blockAction instanceof PlayerBlockActionWithBlockInfo) {
                        ShatterCE::$lastBreakFace[$event->getOrigin()->getPlayer()->getName()] = $blockAction->getFace();
                    }
                }
            }
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

                if (!$holder instanceof Player) return;

                if (!$oldItem->equals(($newItem = $inventory->getItem($slot)), !$inventory instanceof ArmorInventory)) {
                    if ($newItem->getId() === ItemIds::AIR || $inventory instanceof ArmorInventory) foreach ($oldItem->getEnchantments() as $oldEnchantment) ToggleableEnchantment::attemptToggle($holder, $oldItem, $oldEnchantment, $inventory, $slot, false);
                    if ($oldItem->getId() === ItemIds::AIR || $inventory instanceof ArmorInventory) foreach ($newItem->getEnchantments() as $newEnchantment) ToggleableEnchantment::attemptToggle($holder, $newItem, $newEnchantment, $inventory, $slot);
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
        if (!$player->isClosed()) return;

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
    public function onTransaction(InventoryTransactionEvent $event): void
    {
        $transaction = $event->getTransaction();
        $actions = array_values($transaction->getActions());
        $player = $event->getTransaction()->getSource();

        if (count($actions) != 2) return;

        foreach ($actions as $i => $action) {

            if ($action instanceof SlotChangeAction &&
                ($otherAction = $actions[($i + 1) % 2]) instanceof SlotChangeAction ) {
                $itemClicked = $action->getSourceItem();
                $itemClickedWith = $action->getTargetItem();

                if ($itemClickedWith->getId() === ItemIds::ENCHANTED_BOOK &&
                    $itemClicked->getId() !== ItemIds::AIR ||
                    count($itemClicked->getEnchantments()) >= count($itemClickedWith->getEnchantments())) {


                    if (count($itemClickedWith->getEnchantments()) < 1) return;
                    $willChange = false;

                    if($itemClicked->getId() === ItemIds::ENCHANTED_BOOK || $itemClicked->getId() === ItemIds::BOOK) return;

                    # book data
                    if($itemClickedWith->getNamedTag()->getTag("Energy") === null) return;
                    if($itemClickedWith->getNamedTag()->getTag("EnergyNeeded") === null) return;
                    if($itemClickedWith->getNamedTag()->getTag("success") === null) return;

                    $bookEnergy = $itemClickedWith->getNamedTag()->getInt("Energy");
                    $bookEnergyNeeded = $itemClickedWith->getNamedTag()->getInt("EnergyNeeded");
                    $bookChance = $itemClickedWith->getNamedTag()->getInt("success");

                    # generate random number
                    $randomNumber = mt_rand(1, 100);

                    if($bookEnergy < $bookEnergyNeeded) {
                        $event->cancel();
                        $player->sendMessage(TF::RED . "You need to fill the Book Energy to do that");
                        $player->broadcastSound(new DoorBumpSound(), [$player]);
                        return;
                    }


                    foreach ($itemClickedWith->getEnchantments() as $enchantment) {
                        $enchantmentType = $enchantment->getType();
                        $newLevel = $enchantment->getLevel();
                        $existingEnchant = $itemClicked->getEnchantment($enchantmentType);
                    }

                    if(!isset($enchantmentType)) {
                        return;
                    }

                    if(!$enchantmentType instanceof CustomEnchant) return;

                    if($enchantmentType->getItemType() === CustomEnchant::ITEM_TYPE_TOOLS) {

                        if(!Utils::itemMatchesItemType($itemClicked, $enchantmentType->getItemType()) || !Utils::checkEnchantIncompatibilities($itemClicked, $enchantmentType)) {
                            $player->sendMessage(TF::RED . "You can not apply this enchant to that item");
                            return;
                        }


                        # pickaxe data
                        if($itemClicked->getNamedTag()->getTag("Energy")) return;
                        $pickaxeEnergy = $itemClicked->getNamedTag()->getInt("Energy");
                        $pickaxeEnergyNeeded = EmporiumPrison::getInstance()->getPickaxeManager()->getEnergyNeeded($itemClicked);

                        if($pickaxeEnergy < $pickaxeEnergyNeeded) {
                            $player->sendMessage("You need to fill the Pickaxe Energy to do that");
                            return;
                        }


                        // Upgrade CE Level
                        if ($existingEnchant !== null) {

                            if ($existingEnchant->getLevel() <= $newLevel) {
                                // Upgrade Level
                                if ($existingEnchant->getLevel() === $newLevel) return;

                                // New Level
                                if ($existingEnchant->getLevel() < $newLevel) $willChange = true;

                            }

                        } else $willChange = true;


                        if (((!Utils::itemMatchesItemType($itemClicked, $enchantmentType->getItemType()) || !Utils::checkEnchantIncompatibilities($itemClicked, $enchantmentType))) ||
                            $itemClicked->getCount() !== 1 ||
                            $newLevel > $enchantmentType->getMaxLevel() ||
                            ($itemClicked->getId() === ItemIds::ENCHANTED_BOOK && count($itemClicked->getEnchantments()) === 0) ||
                            $itemClicked->getId() === ItemIds::BOOK
                        ) continue;
                        if($randomNumber <= $bookChance) {
                            $player->sendMessage(TF::GREEN . "Enchant Success");
                            $itemClicked->addEnchantment(new EnchantmentInstance($enchantmentType, $newLevel));
                        } else {
                            $player->sendMessage(TF::RED . "Enchant failed");
                        }

                        return;

                    } else {


                        if(!Utils::itemMatchesItemType($itemClicked, $enchantmentType->getItemType()) || !Utils::checkEnchantIncompatibilities($itemClicked, $enchantmentType)) {
                            $player->sendMessage(TF::RED . "You can not apply this enchant to that item"); return;
                        }
                        /*
                         * not trying to enchant pickaxe
                         *
                         * only book needs full energy to enchant
                         */

                        // Upgrade CE Level

                        if (!is_null($existingEnchant)) {
                            if ($existingEnchant->getLevel() <= $newLevel) {
                                // already has enchant with same level
                                if ($existingEnchant->getLevel() === $newLevel) return;
                                // New Level
                                if ($existingEnchant->getLevel() < $newLevel) $willChange = true;
                            }
                        } else $willChange = true;



                        if ($itemClicked->getCount() !== 1 || $newLevel > $enchantmentType->getMaxLevel() ||
                            ($itemClicked->getId() === ItemIds::ENCHANTED_BOOK && count($itemClicked->getEnchantments()) === 0) ||
                            $itemClicked->getId() === ItemIds::BOOK) continue;


                        if ($randomNumber > $bookChance) {
                            $event->cancel();
                            $player->sendTitle(TF::RED . "Enchant failed", "", 5, 40, 5);
                            $player->broadcastSound(new DoorCrashSound(), [$player]);
                            $otherAction->getInventory()->setItem($otherAction->getSlot(), VanillaItems::AIR());
                            return;
                        }

                        $player->sendTitle(TF::GREEN . "Enchant Success", "", 5, 40, 5);
                        $itemClicked->addEnchantment(new EnchantmentInstance($enchantmentType, $newLevel));
                        $player->broadcastSound(new TotemUseSound(), [$player]);

                    }

                    if ($willChange) {
                        $event->cancel();
                        $action->getInventory()->setItem($action->getSlot(), $itemClicked);
                        $otherAction->getInventory()->setItem($otherAction->getSlot(), VanillaItems::AIR());
                    }
                }
            }
        }
    }
}
