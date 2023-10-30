<?php

# Namespace
namespace Tetro\EmporiumEnchants\Core;

use Emporium\Prison\EmporiumPrison;
use pocketmine\block\BlockTypeIds;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\entity\{EntityDamageByEntityEvent,
    EntityDamageEvent,
    EntityEffectAddEvent,
    ProjectileHitBlockEvent
};
use pocketmine\event\Listener;
use pocketmine\event\player\{PlayerDeathEvent,
    PlayerInteractEvent,
    PlayerItemHeldEvent,
    PlayerJoinEvent,
    PlayerMoveEvent,
    PlayerQuitEvent,
    PlayerToggleSneakEvent
};
use pocketmine\event\server\{DataPacketReceiveEvent, DataPacketSendEvent};
use pocketmine\inventory\{ArmorInventory, CallbackInventoryListener, Inventory, PlayerInventory};
use pocketmine\item\{Item, VanillaItems};
use pocketmine\network\mcpe\protocol\{InventoryContentPacket,
    InventorySlotPacket,
    InventoryTransactionPacket,
    MobEquipmentPacket,
    PlayerActionPacket,
    PlayerAuthInputPacket,
    types\PlayerAction,
    types\PlayerBlockActionWithBlockInfo
};
use pocketmine\network\mcpe\protocol\types\inventory\ItemStackWrapper;
use pocketmine\player\Player;

use pocketmine\scheduler\ClosureTask;
use Tetro\EmporiumEnchants\Core\Types\{ReactiveEnchantment, ToggleableEnchantment};
use Tetro\EmporiumEnchants\EmporiumEnchants;
use Tetro\EmporiumEnchants\Enchants\Tools\ShatterCE;
use Tetro\EmporiumEnchants\Utils\Utils;

class EventListener implements Listener
{

    public function onBreak(BlockBreakEvent $event): void
    {
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
                    if ($newItem->getTypeId() == BlockTypeIds::AIR || $inventory instanceof ArmorInventory) foreach ($oldItem->getEnchantments() as $oldEnchantment) ToggleableEnchantment::attemptToggle($holder, $oldItem, $oldEnchantment, $inventory, $slot, false);
                    if ($oldItem->getTypeId() == BlockTypeIds::AIR || $inventory instanceof ArmorInventory) foreach ($newItem->getEnchantments() as $newEnchantment) ToggleableEnchantment::attemptToggle($holder, $newItem, $newEnchantment, $inventory, $slot);
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
            if ($player->getWorld()->getBlock($player->getPosition()->floor()->subtract(0, 1, 0))->getTypeId() !== BlockTypeIds::AIR && Utils::getNoFallDamageDuration($player) <= 0) {
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
}
