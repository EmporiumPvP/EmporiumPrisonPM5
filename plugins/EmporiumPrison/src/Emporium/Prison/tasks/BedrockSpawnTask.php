<?php

namespace Emporium\Prison\tasks;

use pocketmine\block\Block;
use pocketmine\scheduler\Task;
use pocketmine\world\Position;

class BedrockSpawnTask extends Task {

    private Block $block;
    private Block $placeHolder;
    private Position $blockPosition;

    public function __construct(Block $block, Block $placeHolder, Position $blockPosition) {
        $this->block = $block;
        $this->placeHolder = $placeHolder;
        $this->blockPosition = $blockPosition;
    }

    public function onRun(): void {
        $this->block->getPosition()->getWorld()->setBlock($this->blockPosition, $this->placeHolder);
    }
}