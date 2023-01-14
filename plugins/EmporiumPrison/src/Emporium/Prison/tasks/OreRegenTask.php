<?php

namespace Emporium\Prison\tasks;

use pocketmine\block\Block;
use pocketmine\scheduler\Task;
use pocketmine\world\Position;

class OreRegenTask extends Task {

    private Block $block;
    private Position $blockPosition;

    public function __construct(Block $block, Position $blockPosition) {
        $this->block = $block;
        $this->blockPosition = $blockPosition;
    }

    public function onRun(): void {
        $this->block->getPosition()->getWorld()->setBlock($this->blockPosition, $this->block);
    }
}