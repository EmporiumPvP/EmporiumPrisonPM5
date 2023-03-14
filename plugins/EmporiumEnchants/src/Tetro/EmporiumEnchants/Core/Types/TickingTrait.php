<?php

namespace Tetro\EmporiumEnchants\Core\Types;

use pocketmine\inventory\Inventory;
use pocketmine\player\Player;
use pocketmine\item\Item;

use Tetro\EmporiumEnchants\Loader;

trait TickingTrait {
    
    protected Loader $plugin;

    public function canTick(): bool
    {
        return true;
    }

    public function getTickingInterval(): int
    {
        return 1;
    }

    public function onTick(Player $player, Item $item, Inventory $inventory, int $slot, int $level): void
    {
        if ($this->getCooldown($player) > 0) return;
        $this->tick($player, $item, $inventory, $slot, $level);
    }


    public function tick(Player $player, Item $item, Inventory $inventory, int $slot, int $level): void
    {

    }

    public function supportsMultipleItems(): bool
    {
        return false;
    }
}