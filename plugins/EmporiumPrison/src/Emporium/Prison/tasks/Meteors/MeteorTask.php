<?php

namespace Emporium\Prison\tasks\Meteors;

use pocketmine\block\VanillaBlocks;
use pocketmine\scheduler\Task;
use pocketmine\world\World;

class MeteorTask extends Task {

    private int $x;
    private int $y;
    private int $z;
    private World $world;

    public function __construct(World $world, int $x, int $y, int $z) {
        $this->world = $world;
        $this->x = $x;
        $this->y = $y;
        $this->z = $z;
    }

    public function onRun(): void {

        # spawn block
        $this->world->setBlockAt($this->x, $this->y + 1, $this->z, VanillaBlocks::NETHER_QUARTZ_ORE());
    }

}