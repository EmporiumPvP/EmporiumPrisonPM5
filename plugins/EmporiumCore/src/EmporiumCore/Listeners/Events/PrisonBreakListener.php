<?php

namespace EmporiumCore\Listeners\Events;

use EmporiumData\ServerManager;
use pocketmine\block\BlockTypeIds;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\Listener;

class PrisonBreakListener implements Listener {

    public array $ores = [
        BlockTypeIds::COAL_ORE,
        BlockTypeIds::COAL_ORE, BlockTypeIds::COAL,
        BlockTypeIds::IRON_ORE, BlockTypeIds::IRON,
        BlockTypeIds::LAPIS_LAZULI_ORE, BlockTypeIds::LAPIS_LAZULI,
        BlockTypeIds::REDSTONE_ORE, BlockTypeIds::REDSTONE,
        BlockTypeIds::GOLD_ORE, BlockTypeIds::GOLD,
        BlockTypeIds::DIAMOND_ORE, BlockTypeIds::DIAMOND_ORE,
        BlockTypeIds::EMERALD_ORE, BlockTypeIds::EMERALD
    ];

    public function onBlockBreak(BlockBreakEvent $event): void {

        $prisonBreak = ServerManager::getInstance()->getData("events.prisonbreak");
        $player = $event->getPlayer();
        $blockId = $event->getBlock()->getTypeId();

        if($prisonBreak === true) {
            if(in_array($blockId, $this->ores)) {
                ServerManager::getInstance()->setData("events.prisonBreak." . $player->getXuid(), ServerManager::getInstance()->getData("events.prisonBreak." . $player->getXuid()) + 1);
            }
        }
    }

}