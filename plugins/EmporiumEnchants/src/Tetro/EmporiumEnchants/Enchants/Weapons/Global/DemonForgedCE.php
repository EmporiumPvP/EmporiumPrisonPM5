<?php

# Namespaces
namespace Tetro\EmporiumEnchants\Enchants\Weapons\Global;

# Pocketmine API
use pocketmine\event\Event;
use pocketmine\inventory\Inventory;
use pocketmine\item\{Armor, Item};
use pocketmine\player\Player;
use Tetro\EmporiumEnchants\Core\{CustomEnchant};
use Tetro\EmporiumEnchants\Core\Types\ReactiveEnchantment;

# Used Files

# Enchantment Class
class DemonForgedCE extends ReactiveEnchantment
{

    # Register Enchantment
    public string $name = "Demonforged";
    public string $description = "Has a chance to deal extra damage to your opponents armor durability";
    public int $rarity = CustomEnchant::RARITY_LEGENDARY;
    public int $cooldownDuration = 30;
    public int $maxLevel = 5;
    public int $chance = 500;

    # Compatibility
    public int $usageType = CustomEnchant::TYPE_HAND;
    public int $itemType = CustomEnchant::ITEM_TYPE_WEAPON;

    # Enchantment
    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void
    {
        $enemy = $event->getEntity();
        $damager = $event->getDamager();
        if ((!$enemy instanceof Player) or (!$damager instanceof Player)) {
            return;
        }
        $enemy = $event->getEntity();
        foreach ($enemy->getArmorInventory()->getContents() as $slot => $armour) {
            if ($armour instanceof Armor) {
                $value = 1 * $level;
                $armour->applyDamage($value);
                $enemy->getArmorInventory()->setItem($slot, $armour);
            }
        }
    }
}