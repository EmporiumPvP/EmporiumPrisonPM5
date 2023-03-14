<?php

namespace Emporium\Prison\tasks\Meteors;

use Emporium\Prison\EmporiumPrison;

use pocketmine\block\VanillaBlocks;

use pocketmine\scheduler\Task;

class MeteorTask extends Task {

    private int $x;
    private int $y;
    private int $z;

    public function __construct(int $x, int $y, int $z) {
        $this->x = $x;
        $this->y = $y;
        $this->z = $z;
    }

    public function onRun(): void {

        # spawn block
        EmporiumPrison::getInstance()->getServer()->getWorldManager()->getWorldByName("world")->setBlockAt($this->x, $this->y, $this->z, VanillaBlocks::NETHER_QUARTZ_ORE());
    }

}