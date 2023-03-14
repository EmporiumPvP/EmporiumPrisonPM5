<?php

# Namespaces
namespace Tetro\EmporiumEnchants\Enchants\Armour\Chestplate;

# Pocketmine API
use pocketmine\event\Event;
use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\player\Player;
use Tetro\EmporiumEnchants\Core\CustomEnchant;
use Tetro\EmporiumEnchants\Core\Types\ReactiveEnchantment;

# Used Files

# Enchantment Class
class BandAidCE extends ReactiveEnchantment
{

    # Register Enchantment
    public string $name = "Band-Aid";
    public string $description = "Grants you with immunity to Bleeding.";
    public int $rarity = CustomEnchant::RARITY_EXECUTIVE;
    public int $cooldownDuration = 0;
    public int $maxLevel = 1;
    public int $chance = 1;

    # Compatibility
    public int $usageType = CustomEnchant::TYPE_CHESTPLATE;
    public int $itemType = CustomEnchant::ITEM_TYPE_CHESTPLATE;

    # Enchantment
    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void
    {
    }
}