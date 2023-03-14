<?php

# Namespace
namespace Tetro\EmporiumEnchants\Core\Types;

# Pocketmine Packages
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\inventory\Inventory;
use pocketmine\player\Player;
use pocketmine\event\Event;
use pocketmine\item\Item;

# Used Files
use Tetro\EmporiumEnchants\Core\Types\ReactiveEnchantment;
use Tetro\EmporiumEnchants\Core\CustomEnchant;
use Tetro\EmporiumEnchants\Utils\Utils;

# Reactive Trait
trait ReactiveTrait {

    # Check Can React
    public function canReact(): bool {
        return true;
    }

    # Get Reagent
    public function getReagent(): array {
        return [EntityDamageByEntityEvent::class];
    }

    # Execute Reaction
    public function onReaction(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void {
        if ($this->getCooldown($player) > 0) return;
        if ($event instanceof EntityDamageByEntityEvent) {
            if ($event->getEntity() === $player && $event->getDamager() !== $player && $this->shouldReactToDamage()) return;
            if ($event->getEntity() !== $player && $this->shouldReactToDamaged()) return;
        }
        if (mt_rand(0, 1) <= $this->getChance($level)) {
            $this->react($player, $item, $inventory, $slot, $event, $level, $stack);
        }
    }

    # React
    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void {
    }

    # Get Chance
    public function getChance(int $level): float {
        return $this->chance * $level;
    }

    # Get Cooldown Duration
    public function getCooldownDuration(): int {
        return $this->cooldownDuration;
    }

    # Should React to Damage
    public function shouldReactToDamage(): bool {
        return $this->getItemType() === CustomEnchant::ITEM_TYPE_WEAPON || $this->getItemType() === CustomEnchant::ITEM_TYPE_SWORD || $this->getItemType() === CustomEnchant::ITEM_TYPE_AXE || $this->getItemType() === CustomEnchant::ITEM_TYPE_SCYTHE;
    }

    # Should React to Damaged
    public function shouldReactToDamaged(): bool {
        return $this->getUsageType() === CustomEnchant::TYPE_ARMOR_INVENTORY || $this->getUsageType() === CustomEnchant::TYPE_BOOTS || $this->getUsageType() === CustomEnchant::TYPE_LEGGINGS || $this->getUsageType() === CustomEnchant::TYPE_CHESTPLATE || $this->getUsageType() === CustomEnchant::TYPE_HELMET;
    }

    # Attempt Reaction
    public static function attemptReaction(Player $player, Event $event): void {
        if ($player->getInventory() === null) return;
        $enchantmentStacks = [];
        foreach ($player->getInventory()->getContents() as $slot => $content) {
            foreach (Utils::sortEnchantmentsByPriority($content->getEnchantments()) as $enchantmentInstance) {
                /** @var ReactiveEnchantment $enchantment */
                $enchantment = $enchantmentInstance->getType();
                if ($enchantment instanceof CustomEnchant && $enchantment->canReact()) {
                    if ($enchantment->getUsageType() === CustomEnchant::TYPE_INVENTORY || $enchantment->getUsageType() === CustomEnchant::TYPE_ANY_INVENTORY || ($enchantment->getUsageType() === CustomEnchant::TYPE_HAND && $player->getInventory()->getHeldItemIndex() === $slot)) {
                        foreach ($enchantment->getReagent() as $reagent) {
                            if ($event instanceof $reagent) {
                                $enchantmentStacks[$enchantment->getId()] = ($enchantmentStacks[$enchantment->getId()] ?? 0) + $enchantmentInstance->getLevel();
                                $enchantment->onReaction($player, $content, $player->getInventory(), $slot, $event, $enchantmentInstance->getLevel(), $enchantmentStacks[$enchantment->getId()]);
                            }
                        }
                    }
                }
            }
        }
        foreach ($player->getArmorInventory()->getContents() as $slot => $content) {
            foreach (Utils::sortEnchantmentsByPriority($content->getEnchantments()) as $enchantmentInstance) {
                /** @var ReactiveEnchantment $enchantment */
                $enchantment = $enchantmentInstance->getType();
                if ($enchantment instanceof CustomEnchant && $enchantment->canReact()) {
                    if ((
                        $enchantment->getUsageType() === CustomEnchant::TYPE_ANY_INVENTORY ||
                        $enchantment->getUsageType() === CustomEnchant::TYPE_ARMOR_INVENTORY ||
                        $enchantment->getUsageType() === CustomEnchant::TYPE_HELMET && Utils::isHelmet($content) ||
                        $enchantment->getUsageType() === CustomEnchant::TYPE_CHESTPLATE && Utils::isChestplate($content) ||
                        $enchantment->getUsageType() === CustomEnchant::TYPE_LEGGINGS && Utils::isLeggings($content) ||
                        $enchantment->getUsageType() === CustomEnchant::TYPE_BOOTS && Utils::isBoots($content)
                    )) {
                        foreach ($enchantment->getReagent() as $reagent) {
                            if ($event instanceof $reagent) {
                                $enchantmentStacks[$enchantment->getId()] = ($enchantmentStacks[$enchantment->getId()] ?? 0) + $enchantmentInstance->getLevel();
                                $enchantment->onReaction($player, $content, $player->getArmorInventory(), $slot, $event, $enchantmentInstance->getLevel(), $enchantmentStacks[$enchantment->getId()]);
                            }
                        }
                    }
                }
            }
        }
    }
}