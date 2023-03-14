<?php

namespace Emporium\Prison\tasks\Ores;

use pocketmine\block\Block;
use pocketmine\block\VanillaBlocks;
use pocketmine\scheduler\Task;
use pocketmine\world\Position;

class EmeraldBlockSpawnTask extends Task {

    private Block $block;
    private Position $blockPosition;

    public function __construct(Block $block, Position $blockPosition) {
        $this->block = $block;
        $this->blockPosition = $blockPosition;
    }

    public function onRun(): void {
        $this->block->getPosition()->getWorld()->setBlock($this->blockPosition, VanillaBlocks::EMERALD());
    }
}