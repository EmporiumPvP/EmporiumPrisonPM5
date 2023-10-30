<?php

namespace Tetro\EmporiumWormhole\Tasks;

use Emporium\Prison\EmporiumPrison;

use pocketmine\item\Item;
use pocketmine\player\Player;
use pocketmine\scheduler\Task;

use Tetro\EmporiumWormhole\Menus\Menu;

class OpenWormholeMenuTask extends Task
{

    private Player $player;
    private Item $item;

    public function __construct(Player $player, Item $item)
    {
        $this->player = $player;
        $this->item = $item;
    }


    public function onRun(): void
    {
        # remove energy from pickaxe
        EmporiumPrison::getInstance()->getPickaxeManager()->removeLevelUpEnergy($this->item);

        # send inventory
        $menu = new Menu();
        $menu->Inventory($this->player, $this->item);
    }
}