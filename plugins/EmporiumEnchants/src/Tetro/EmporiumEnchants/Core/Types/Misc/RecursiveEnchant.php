<?php

# Namespace
namespace Tetro\EmporiumEnchants\Core\Types\Misc;

# Pocketmine Packages
use pocketmine\event\Event;
use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\player\Player;

# Used Files
use Tetro\EmporiumEnchants\Core\Types\ReactiveEnchantment;

# Type Enchant
class RecursiveEnchant extends ReactiveEnchantment {
    
    # Array
    public static array $isUsing;

    # Execute Enchant
    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void {
        if (isset(self::$isUsing[$player->getName()])) return;
        self::$isUsing[$player->getName()] = true;
        $this->safeReact($player, $item, $inventory, $slot, $event, $level, $stack);
        unset(self::$isUsing[$player->getName()]);
    }

    # Safe Execution
    public function safeReact(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void {
    }
}