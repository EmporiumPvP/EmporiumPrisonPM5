<?php

namespace Items;

use pocketmine\item\Item;
use pocketmine\item\ItemFactory;
use pocketmine\utils\TextFormat as TF;

class PlayerTags {

    public function vampire(): Item {
        $item = ItemFactory::getInstance()->get(421);
        $item->getNamedTag()->setString("Tag", "vampire");
        $item->setCustomName(TF::DARK_RED . "Vampire Tag");
        $lore = [
            "§r",
            TF::GRAY . "Right-click to claim"
        ];
        $item->setLore($lore);
        return $item;
    }

}