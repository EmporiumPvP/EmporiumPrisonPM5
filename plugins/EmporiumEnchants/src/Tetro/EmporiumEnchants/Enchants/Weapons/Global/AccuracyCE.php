<?php

# Namespaces
namespace Tetro\EmporiumEnchants\Enchants\Weapons\Global;

# Pocketmine API
use pocketmine\event\Event;
use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\player\Player;
use Tetro\EmporiumEnchants\Core\{CustomEnchant};
use Tetro\EmporiumEnchants\Core\Types\ReactiveEnchantment;

# Used Files

# Enchantment Class
class AccuracyCE extends ReactiveEnchantment
{

    # Register Enchantment
    public string $name = "Accuracy";
    public string $description = "Does more dmg when aiming at the head.";
    public int $rarity = CustomEnchant::RARITY_HEROIC;
    public int $cooldownDuration = 40;
    public int $maxLevel = 5;
    public int $chance = 300;

    # Compatibility
    public int $usageType = CustomEnchant::TYPE_HAND;
    public int $itemType = CustomEnchant::ITEM_TYPE_WEAPON;

    # Enchantment
    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void
    {
        // Variables
        $enemy = $event->getEntity();
        $damager = $event->getDamager();
        if ((!$enemy instanceof Player) or (!$damager instanceof Player)) {
            return;
        }
        $damage = $event->getBaseDamage();
        $health = $enemy->getHealth();
        # Calculate
        if ($health - ($damage * ($level * 2)) <= 0) {
            $player->sendMessage("§l§d** Accuracy **");
            $this->setCooldown($player, 30);
            return;
        }
        $this->setCooldown($player, 30);
        // Deal Damage
        $enemy->setHealth($enemy->getHealth() - ($level * 2));
    }
}