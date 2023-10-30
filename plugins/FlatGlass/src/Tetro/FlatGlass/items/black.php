<?php

namespace Tetro\FlatGlass\items;

use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;

use pocketmine\item\Item;
use pocketmine\item\ItemIdentifier;

class black extends Item implements ItemComponents
{
    use ItemComponentsTrait;

    public function __construct(ItemIdentifier $identifier, string $name = "Unknown")
    {
        parent::__construct($identifier, $name);
        $this->initComponent("pane_black");
        $this->setupRenderOffsets(32, 32, true);
    }
}