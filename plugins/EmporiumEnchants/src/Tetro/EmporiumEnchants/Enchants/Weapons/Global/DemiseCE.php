<?php

# Namespaces
namespace Tetro\EmporiumEnchants\Enchants\Weapons\Global;

# Pocketmine API
use pocketmine\event\Event;
use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;
use Tetro\EmporiumEnchants\Core\{CustomEnchant};
use Tetro\EmporiumEnchants\Core\Types\ReactiveEnchantment;

# Used Files

# Enchantment Class
class DemiseCE extends ReactiveEnchantment
{

    # Register Enchantment
    public string $name = "Demise";
    public string $description = "Has a chance to ignore your opponents armor and deal extra damage.";
    public int $rarity = CustomEnchant::RARITY_ULTIMATE;
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
        $victim = $event->getEntity();
        $damage = $event->getBaseDamage();
        $health = $victim->getHealth();
        $enemy = $event->getEntity();
        $damager = $event->getDamager();
        if ((!$enemy instanceof Player) or (!$damager instanceof Player)) {
            return;
        }
        # Calculate
        if ($health - ($damage * ($level * 3)) <= 0) {
            $player->sendMessage("§l§6** Demise **");
            $this->setCooldown($player, 30);
            return;
        }
        $this->setCooldown($player, 30);
        // Deal Damage
        $enemy->setHealth($enemy->getHealth() - ($level * 3));
    }
}