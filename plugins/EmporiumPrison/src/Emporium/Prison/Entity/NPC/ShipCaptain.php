<?php

namespace Emporium\Prison\Entity\NPC;

use pocketmine\entity\Location;
use pocketmine\entity\Skin;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\utils\TextFormat as TF;

class ShipCaptain extends NPC
{

    public function __construct(Location $location, Skin $skin, ?CompoundTag $nbt = null)
    {
        parent::__construct($location, $skin, $nbt);

        $this->setNameTag(TF::BOLD . TF::LIGHT_PURPLE . "Ship Captain" . TF::GRAY . "\n(Click Me)");
        $this->setNameTagAlwaysVisible();
        $this->setHasGravity(false);
    }

}