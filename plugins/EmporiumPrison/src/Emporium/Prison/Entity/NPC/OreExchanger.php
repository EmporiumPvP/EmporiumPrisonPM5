<?php

namespace Emporium\Prison\Entity\NPC;

use pocketmine\block\VanillaBlocks;
use pocketmine\entity\Location;
use pocketmine\entity\Skin;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\utils\TextFormat as TF;

class OreExchanger extends NPC
{

    public function __construct(Location $location, Skin $skin, ?CompoundTag $nbt = null)
    {
        parent::__construct($location, $skin, $nbt);

        $this->setNameTag(TF::BOLD . TF::GOLD . "Ore Exchanger" . TF::GRAY . "\n(Click Me)");

        $this->setHasGravity(false);
        $this->getInventory()->setItemInHand(VanillaBlocks::COAL_ORE()->asItem());
        $this->setNameTagAlwaysVisible(true);
    }
}