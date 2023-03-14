<?php

namespace Emporium\Prison\tasks\Ores;

use pocketmine\block\Block;
use pocketmine\block\BlockLegacyIds;
use pocketmine\block\VanillaBlocks;
use pocketmine\scheduler\Task;
use pocketmine\world\Position;

class OreRegenTask extends Task {

    private Block $block;
    private Position $blockPosition;
    private int $blockId;

    public function __construct(Block $block, Position $blockPosition, int $blockId) {
        $this->block = $block;
        $this->blockId = $blockId;
        $this->blockPosition = $blockPosition;
    }

    public function onRun(): void {
            switch($this->blockId) {
                case BlockLegacyIds::IRON_ORE:
                case BlockLegacyIds::LAPIS_ORE:
                case BlockLegacyIds::REDSTONE_ORE:
                case BlockLegacyIds::GOLD_ORE:
                case BlockLegacyIds::DIAMOND_ORE:
                case BlockLegacyIds::EMERALD_ORE:
                case BlockLegacyIds::COAL_ORE:
                    $this->block->getPosition()->getWorld()->setBlock($this->blockPosition, $this->block);
                    break;

                case BlockLegacyIds::COAL_BLOCK:
                    $this->block->getPosition()->getWorld()->setBlock($this->blockPosition, VanillaBlocks::COAL_ORE());
                    break;

                case BlockLegacyIds::IRON_BLOCK:
                    $this->block->getPosition()->getWorld()->setBlock($this->blockPosition, VanillaBlocks::IRON_ORE());
                    break;

                case BlockLegacyIds::REDSTONE_BLOCK:
                    $this->block->getPosition()->getWorld()->setBlock($this->blockPosition, VanillaBlocks::REDSTONE_ORE());
                    break;

                case BlockLegacyIds::LAPIS_BLOCK:
                    $this->block->getPosition()->getWorld()->setBlock($this->blockPosition, VanillaBlocks::LAPIS_LAZULI_ORE());
                    break;

                case BlockLegacyIds::GOLD_BLOCK:
                    $this->block->getPosition()->getWorld()->setBlock($this->blockPosition, VanillaBlocks::GOLD_ORE());
                    break;

                case BlockLegacyIds::DIAMOND_BLOCK:
                    $this->block->getPosition()->getWorld()->setBlock($this->blockPosition, VanillaBlocks::DIAMOND_ORE());
                    break;

                case BlockLegacyIds::EMERALD_BLOCK:
                    $this->block->getPosition()->getWorld()->setBlock($this->blockPosition, VanillaBlocks::EMERALD_ORE());
                    break;
            }
    }
}