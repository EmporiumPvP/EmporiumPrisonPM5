<?php

# Namespaces
namespace Tetro\EmporiumEnchants\Enchants\Weapons\Sword;

# Pocketmine API
use pocketmine\item\Item;
use pocketmine\event\Event;
use pocketmine\player\Player;
use pocketmine\inventory\Inventory;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\entity\effect\{EffectInstance, VanillaEffects};

# Used Files
use Tetro\EmporiumEnchants\Core\CustomEnchant;
use Tetro\EmporiumEnchants\Core\Types\ReactiveEnchantment;

# Enchantment Class
class RageCE extends ReactiveEnchantment {

    # Register Enchantment
    public string $name = "Rage";
    public string $description = "Grants you with permanent strength.";
    public int $rarity = CustomEnchant::RARITY_ULTIMATE;
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
        $player->getEffects()->add(new EffectInstance(VanillaEffects::STRENGTH(), 200, $level - 1, false));
    }
}