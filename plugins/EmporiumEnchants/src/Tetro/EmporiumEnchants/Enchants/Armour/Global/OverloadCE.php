<?php

# Namespaces
namespace Tetro\EmporiumEnchants\Enchants\Armour\Global;

# Pocketmine API
use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\player\Player;
use Tetro\EmporiumEnchants\Core\CustomEnchant;
use Tetro\EmporiumEnchants\Core\Types\ToggleableEnchantment;

# Used Files

# Enchantment Class
class OverloadCE extends ToggleableEnchantment
{

    # Register Enchantment
    public string $name = "Overload";
    public string $description = "Grants you with extra health.";
    public int $rarity = CustomEnchant::RARITY_LEGENDARY;
    public int $cooldownDuration = 0;
    public int $maxLevel = 3;
    public int $chance = 1;

    # Compatibility
    public int $usageType = CustomEnchant::TYPE_ARMOR_INVENTORY;
    public int $itemType = CustomEnchant::ITEM_TYPE_ARMOR;

    # Enchantment
    public function toggle(Player $player, Item $item, Inventory $inventory, int $slot, int $level, bool $toggle): void
    {
        // Enchantment Code
        # Variables
        $vanity = $player->getMaxHealth();
        $add = 2 * $level * ($toggle ? 1 : -1);
        # Check for Invalid Health
        if ($vanity <= 0) {
            $player->setMaxHealth(20);
            $player->setHealth($player->getMaxHealth());
            return;
        }
        # Set Health
        $player->setMaxHealth($vanity + $add);
        $player->setHealth($player->getHealth() * ($vanity / ($vanity - $add)));
    }
}