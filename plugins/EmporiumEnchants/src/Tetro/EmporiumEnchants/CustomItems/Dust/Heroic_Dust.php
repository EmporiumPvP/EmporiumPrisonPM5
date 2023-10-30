<?php

namespace Tetro\EmporiumEnchants\CustomItems\Dust;

use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;

use pocketmine\item\Item;
use pocketmine\item\ItemIdentifier;

class Heroic_Dust extends Item implements ItemComponents {

    use ItemComponentsTrait;

    public function __construct(ItemIdentifier $identifier, string $name = "Unknown") {
        parent::__construct($identifier, $name);
        $this->initComponent("heroic_dust");
    }
}