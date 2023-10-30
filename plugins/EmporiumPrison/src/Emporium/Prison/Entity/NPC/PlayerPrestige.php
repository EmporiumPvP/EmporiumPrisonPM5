<?php

namespace Emporium\Prison\Entity\NPC;

use Emporium\Prison\EmporiumPrison;
use pocketmine\entity\Location;
use pocketmine\entity\Skin;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\utils\TextFormat as TF;

class PlayerPrestige extends NPC
{

    public function __construct(Location $location, Skin $skin, ?CompoundTag $nbt = null)
    {
        parent::__construct($location, $skin, $nbt);

        $this->setNameTag(TF::BOLD . TF::RED . "Player Prestige" . TF::GRAY . "\n(Click Me)");
        $this->setNameTagAlwaysVisible();
        $this->setHasGravity(false);
        $this->getInventory()->setItemInHand(EmporiumPrison::getInstance()->getPickaxes()->Trainee());
    }

}