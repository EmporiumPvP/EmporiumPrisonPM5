<?php

namespace EmporiumCore\Listeners\Events;

use EmporiumCore\Managers\Data\ServerManager;

use JsonException;

use pocketmine\block\BlockLegacyIds;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\Listener;

class PrisonBreakListener implements Listener {

    public array $ores = [
        BlockLegacyIds::COAL_ORE, BlockLegacyIds::COAL_BLOCK,
        BlockLegacyIds::IRON_ORE, BlockLegacyIds::IRON_BLOCK,
        BlockLegacyIds::LAPIS_ORE, BlockLegacyIds::LAPIS_BLOCK,
        BlockLegacyIds::REDSTONE_ORE, BlockLegacyIds::REDSTONE_BLOCK,
        BlockLegacyIds::GOLD_ORE, BlockLegacyIds::GOLD_BLOCK,
        BlockLegacyIds::DIAMOND_ORE, BlockLegacyIds::DIAMOND_BLOCK,
        BlockLegacyIds::EMERALD_ORE, BlockLegacyIds::EMERALD_BLOCK
    ];

    /**
     * @throws JsonException
     */
    public function onBlockBreak(BlockBreakEvent $event): void {

        $prisonBreak = ServerManager::getData("Events", "PrisonBreak");
        $player = $event->getPlayer();
        $blockId = $event->getBlock()->getIdInfo()->getBlockId();

        if($prisonBreak === true) {
            if(in_array($blockId, $this->ores)) {
                ServerManager::addData("PrisonBreak", $player->getName(), 1);
            }
        }
    }

}