<?php

namespace Emporium\Prison\tasks\Ores;

use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockIdentifier;
use pocketmine\block\BlockToolType;
use pocketmine\block\BlockTypeInfo;
use pocketmine\block\VanillaBlocks;
use pocketmine\block\BlockTypeIds;
use pocketmine\scheduler\Task;
use pocketmine\world\Position;
use pocketmine\world\sound\BlockPlaceSound;

class EmeraldBlockSpawnTask extends Task {

    private Block $block;
    private Position $blockPosition;

    public function __construct(Block $block, Position $blockPosition) {
        $this->block = $block;
        $this->blockPosition = $blockPosition;
    }

    public function onRun(): void {
        $this->block->getPosition()->getWorld()->setBlock($this->blockPosition, VanillaBlocks::EMERALD());
        $this->block->getPosition()->getWorld()->addSound($this->blockPosition->asVector3() , new BlockPlaceSound(new Block(new BlockIdentifier(BlockTypeIds::EMERALD), "emerald_block", new BlockTypeInfo(new BlockBreakInfo(10.0, BlockToolType::PICKAXE, 1)))));
    }
}