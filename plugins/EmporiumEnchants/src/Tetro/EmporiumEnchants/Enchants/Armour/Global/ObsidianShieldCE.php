<?php

# Namespaces
namespace Tetro\EmporiumEnchants\Enchants\Armour\Global;

# Pocketmine API
use pocketmine\entity\effect\{EffectInstance, VanillaEffects};
use pocketmine\event\Event;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\player\Player;
use Tetro\EmporiumEnchants\Core\CustomEnchant;
use Tetro\EmporiumEnchants\Core\Types\ReactiveEnchantment;

# Used Files

# Enchantment Class
class ObsidianShieldCE extends ReactiveEnchantment
{

    # Register Enchantment
    public string $name = "Obsidian Shield";
    public string $description = "Grants you with permanent immunity to fire.";
    public int $rarity = CustomEnchant::RARITY_ELITE;
    public int $cooldownDuration = 0;
    public int $maxLevel = 1;
    public int $chance = 1;

    # Compatibility
    public int $usageType = CustomEnchant::TYPE_ARMOR_INVENTORY;
    public int $itemType = CustomEnchant::ITEM_TYPE_ARMOR;

    # Reagents
    public function getReagent(): array
    {
        return [PlayerMoveEvent::class];
    }

    # Enchantment
    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void
    {
        // Enchantment Code
        if ($event instanceof PlayerMoveEvent) {
            $player->getEffects()->add(new EffectInstance(VanillaEffects::FIRE_RESISTANCE(), 200, $level - 1, false));
        }
    }
}