<?php

# Namespaces
namespace Tetro\EmporiumEnchants\Enchants\Weapons\Global;

# Pocketmine API
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\Event;
use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\player\Player;
use Tetro\EmporiumEnchants\Core\{CustomEnchant};
use Tetro\EmporiumEnchants\Core\Types\ReactiveEnchantment;

# Used Files

# Enchantment Class
class ChargeCE extends ReactiveEnchantment
{

    # Register Enchantment
    public string $name = "Charge";
    public string $description = "Increases your damage while sprinting.";
    public int $rarity = CustomEnchant::RARITY_ULTIMATE;
    public int $cooldownDuration = 0;
    public int $maxLevel = 5;
    public int $chance = 10000;

    # Compatibility
    public int $usageType = CustomEnchant::TYPE_HAND;
    public int $itemType = CustomEnchant::ITEM_TYPE_WEAPON;

    # Enchantment
    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void
    {
        if ($player->isSprinting()) {
            // Variables
            $enemy = $event->getEntity();
            $damager = $event->getDamager();
            if ((!$enemy instanceof Player) or (!$damager instanceof Player)) {
                return;
            }
            $enemy = $event->getEntity();
            $damage = $event->getBaseDamage();
            $health = $enemy->getHealth();
            # Calculate
            if ($health - ($damage + ($level * 0.5)) <= 0) {
                $enemy->attack(new EntityDamageEvent($enemy, EntityDamageEvent::CAUSE_SUICIDE, 1000));
                return;
            }
            // Deal Damage
            $event->setBaseDamage($event->getBaseDamage() + ($level * 0.5));
        }
    }
}