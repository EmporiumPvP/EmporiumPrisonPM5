<?php

namespace Emporium\Prison\Entity\NPC;

use pocketmine\entity\Location;
use pocketmine\entity\Skin;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\utils\TextFormat as TF;
use Tetro\EmporiumEnchants\EmporiumEnchants;

class Enchanter extends NPC
{

    public function __construct(Location $location, Skin $skin, ?CompoundTag $nbt = null)
    {
        parent::__construct($location, $skin, $nbt);

        $this->setNameTag(TF::BOLD . TF::DARK_PURPLE . "Enchanter" . TF::GRAY . "\n(Click Me)");
        $this->setNameTagAlwaysVisible();
        $this->setHasGravity(false);
        $this->getInventory()->setItemInHand(EmporiumEnchants::getInstance()->getBooks()->Elite(1));
    }
}