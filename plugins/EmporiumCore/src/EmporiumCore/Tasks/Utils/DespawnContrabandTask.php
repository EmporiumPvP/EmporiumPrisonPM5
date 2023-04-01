<?php

namespace EmporiumCore\Tasks\Utils;

use pocketmine\block\VanillaBlocks;
use pocketmine\scheduler\Task;
use pocketmine\world\World;

class DespawnContrabandTask extends Task {

    private World $world;
    private int $x;
    private int $y;
    private int $z;

    public function __construct(World $world, int $x, int $y, int $z) {
        $this->world = $world;
        $this->x = $x;
        $this->y = $y;
        $this->z = $z;
    }

    public function onRun(): void
    {
        if(!$this->world->getBlockAt($this->x, $this->y + 2, $this->z) == VanillaBlocks::ENDER_CHEST()) return;
        $this->world->setBlockAt($this->x, $this->y + 2, $this->z, VanillaBlocks::AIR());
    }
}