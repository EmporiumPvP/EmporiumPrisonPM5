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
class BlessedCE extends ReactiveEnchantment
{

    # Register Enchantment
    public string $name = "Blessed";
    public string $description = "Has a chance to remove negative effects.";
    public int $rarity = CustomEnchant::RARITY_ULTIMATE;
    public int $cooldownDuration = 40;
    public int $maxLevel = 3;
    public int $chance = 300;

    # Compatibility
    public int $usageType = CustomEnchant::TYPE_HAND;
    public int $itemType = CustomEnchant::ITEM_TYPE_WEAPON;

    # Enchantment
    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void
    {
        foreach ($player->getEffects()->all() as $effect) {
            if ($effect->getType()->isBad()) {
                $player->getEffects()->remove($effect->getType());
                $player->sendMessage("§l§e** Blessed **");
            }
        }
    }
}