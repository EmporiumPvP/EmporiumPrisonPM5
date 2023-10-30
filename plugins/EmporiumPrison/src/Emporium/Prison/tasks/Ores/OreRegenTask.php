<?php

namespace Emporium\Prison\tasks\Ores;

use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockIdentifier;
use pocketmine\block\BlockTypeIds;
use pocketmine\block\BlockToolType;
use pocketmine\block\BlockTypeInfo;
use pocketmine\block\VanillaBlocks;
use pocketmine\scheduler\Task;
use pocketmine\world\Position;
use pocketmine\world\sound\BlockPlaceSound;

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
            case BlockTypeIds::IRON_ORE:
            case BlockTypeIds::LAPIS_LAZULI_ORE:
            case BlockTypeIds::REDSTONE_ORE:
            case BlockTypeIds::GOLD_ORE:
            case BlockTypeIds::DIAMOND_ORE:
            case BlockTypeIds::EMERALD_ORE:
            case BlockTypeIds::COAL_ORE:
                $this->block->getPosition()->getWorld()->setBlock($this->blockPosition, $this->block);
                break;

            case BlockTypeIds::COAL:
                $this->block->getPosition()->getWorld()->setBlock($this->blockPosition, VanillaBlocks::COAL_ORE());
                break;

            case BlockTypeIds::IRON:
                $this->block->getPosition()->getWorld()->setBlock($this->blockPosition, VanillaBlocks::IRON_ORE());
                break;

            case BlockTypeIds::REDSTONE:
                $this->block->getPosition()->getWorld()->setBlock($this->blockPosition, VanillaBlocks::REDSTONE_ORE());
                break;

            case BlockTypeIds::LAPIS_LAZULI:
                $this->block->getPosition()->getWorld()->setBlock($this->blockPosition, VanillaBlocks::LAPIS_LAZULI_ORE());
                break;

            case BlockTypeIds::GOLD:
                $this->block->getPosition()->getWorld()->setBlock($this->blockPosition, VanillaBlocks::GOLD_ORE());
                break;

            case BlockTypeIds::DIAMOND:
                $this->block->getPosition()->getWorld()->setBlock($this->blockPosition, VanillaBlocks::DIAMOND_ORE());
                break;

            case BlockTypeIds::EMERALD:
                $this->block->getPosition()->getWorld()->setBlock($this->blockPosition, VanillaBlocks::EMERALD_ORE());
                break;
        }

        $this->block->getPosition()->getWorld()->addSound($this->blockPosition->asVector3() , new BlockPlaceSound(new Block(new BlockIdentifier(BlockTypeIds::COAL_ORE), "coal_ore", new BlockTypeInfo(new BlockBreakInfo(10.0, BlockToolType::PICKAXE, 1)))));
    }
}