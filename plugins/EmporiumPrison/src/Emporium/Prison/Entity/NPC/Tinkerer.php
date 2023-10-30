<?php

namespace Emporium\Prison\Entity\NPC;

use Emporium\Prison\EmporiumPrison;
use pocketmine\entity\Location;
use pocketmine\entity\Skin;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\utils\TextFormat as TF;

class Tinkerer extends NPC
{

    public function __construct(Location $location, Skin $skin, ?CompoundTag $nbt = null)
    {
        parent::__construct($location, $skin, $nbt);

        $this->setNameTag(TF::BOLD . TF::DARK_AQUA . "Tinker" . TF::GRAY . "\n(Click Me)");
        $this->setNameTagAlwaysVisible();
        $this->setHasGravity(false);
        $this->getInventory()->setItemInHand(EmporiumPrison::getInstance()->getOrbs()->EnergyOrb(10));
    }

}