<?php

namespace Emporium\Prison\Entity\NPC;

use pocketmine\block\VanillaBlocks;
use pocketmine\entity\Location;
use pocketmine\entity\Skin;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\utils\TextFormat as TF;

class Blacksmith extends NPC
{

    public function __construct(Location $location, Skin $skin, ?CompoundTag $nbt = null)
    {
        parent::__construct($location, $skin, $nbt);

        $this->setNameTag(TF::BOLD . TF::GOLD . "Blacksmith" . TF::GRAY . "\n(Click Me)");

        $this->setHasGravity(false);
        $this->getInventory()->setItemInHand(VanillaBlocks::ANVIL()->asItem());
        $this->setNameTagAlwaysVisible();
    }
}