<?php

namespace Emporium\Prison\Entity\NPC;

use pocketmine\entity\Location;
use pocketmine\entity\Skin;
use pocketmine\item\VanillaItems;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\utils\TextFormat as TF;

class Banker extends NPC
{

    public function __construct(Location $location, Skin $skin, ?CompoundTag $nbt = null)
    {
        parent::__construct($location, $skin, $nbt);

        $this->setNameTag(TF::BOLD . TF::AQUA . "Banker" . TF::GRAY . "\n(Click Me)");
        $this->setNameTagAlwaysVisible();
        $this->setHasGravity(false);
        $this->getInventory()->setItemInHand(VanillaItems::PAPER());
    }

}