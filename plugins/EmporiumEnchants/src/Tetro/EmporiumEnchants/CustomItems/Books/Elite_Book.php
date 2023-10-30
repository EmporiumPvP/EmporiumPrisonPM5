<?php

namespace Tetro\EmporiumEnchants\CustomItems\Books;

use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;

use pocketmine\item\Item;
use pocketmine\item\ItemIdentifier;

class Elite_Book extends Item implements ItemComponents
{

    use ItemComponentsTrait;

    public function __construct(ItemIdentifier $identifier, string $name = "Unknown")
    {
        parent::__construct($identifier, $name);
        $this->initComponent("elite_book");
    }
}
