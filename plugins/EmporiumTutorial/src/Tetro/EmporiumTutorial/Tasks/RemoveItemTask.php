<?php

namespace Tetro\EmporiumTutorial\Tasks;

use pocketmine\item\Item;
use pocketmine\player\Player;
use pocketmine\scheduler\Task;

class RemoveItemTask extends Task {

    private Item $item;
    private Player $player;

    public function __construct(Player $player, Item $item) {
        $this->player = $player;
        $this->item = $item;
    }

    public function onRun(): void {
        $this->player->getInventory()->removeItem($this->item);

        # remove pickaxe from cursor
        $this->player->getCursorInventory()->removeItem($this->item);
    }
}