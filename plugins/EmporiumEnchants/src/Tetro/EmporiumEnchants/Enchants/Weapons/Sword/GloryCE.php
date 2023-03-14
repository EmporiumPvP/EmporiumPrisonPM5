<?php

# Namespaces
namespace Tetro\EmporiumEnchants\Enchants\Weapons\Sword;

# Pocketmine API
use pocketmine\item\Item;
use pocketmine\event\Event;
use pocketmine\player\Player;
use pocketmine\inventory\Inventory;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\world\particle\EnchantmentTableParticle;

# Used Files
use Tetro\EmporiumEnchants\Core\CustomEnchant;
use Tetro\EmporiumEnchants\Core\Types\ReactiveEnchantment;

# Enchantment Class
class GloryCE extends ReactiveEnchantment {

    # Register Enchantment
    public string $name = "Glory";
    public string $description = "Show custom particle damage on the enemy.";
    public int $rarity = CustomEnchant::RARITY_HEROIC;
    public int $cooldownDuration = 0;
    public int $maxLevel = 10;
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
        // Chance
        $random = mt_rand(1, 1000);
        $chance = $level * 100;
        if ($chance <= $random) {
			return;
        }
        // Enchantment Code
        $enemy = $event->getEntity();
        $player->getWorld()->addParticle($enemy->getPosition()->add(0.5, 0.5, 0.5), new EnchantmentTableParticle());
    }
}