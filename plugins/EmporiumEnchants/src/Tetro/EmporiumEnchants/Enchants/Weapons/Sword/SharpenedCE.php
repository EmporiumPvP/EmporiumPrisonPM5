<?php

# Namespaces
namespace Tetro\EmporiumEnchants\Enchants\Weapons\Sword;

# Pocketmine API
use pocketmine\item\Item;
use pocketmine\event\Event;
use pocketmine\player\Player;
use pocketmine\inventory\Inventory;
use pocketmine\event\entity\EntityDamageByEntityEvent;

# Used Files
use Tetro\EmporiumEnchants\Core\Types\ReactiveEnchantment;
use Tetro\EmporiumEnchants\Core\{CustomEnchant, CustomEnchantIds};

# Enchantment Class
class SharpenedCE extends ReactiveEnchantment {

    # Register Enchantment
    public string $name = "Sharpened";
    public string $description = "Deal extra damage to the enemy.";
    public int $rarity = CustomEnchant::RARITY_GODLY;
    public int $cooldownDuration = 0;
    public int $maxLevel = 5;
    public int $chance = 1;

    # Compatibility
    public int $usageType = CustomEnchant::TYPE_HAND;
    public int $itemType = CustomEnchant::ITEM_TYPE_SWORD;

    # Reagents
    public function getReagent(): array {
        return [EntityDamageByEntityEvent::class];
    }
    
    # Enchantment
    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void {
        // Enchantment Code
        if ($event instanceof EntityDamageByEntityEvent) {
            $event->setModifier(2 + $level * 0.2, CustomEnchantIds::SHARPEN);
            
        }
    }
}