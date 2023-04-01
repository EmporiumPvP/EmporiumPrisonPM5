<?php

namespace Emporium\Prison\tasks\Events;

use Emporium\Prison\library\bossbar\BossBarAPI;
use Emporium\Prison\EmporiumPrison;

use EmporiumData\DataManager;
use EmporiumData\ServerManager;

use pocketmine\scheduler\Task;

class PrisonBreakBar extends Task{

    public function onRun(): void {

        $prisonBreak = ServerManager::getInstance()->getData("events.prison_break");
        if($prisonBreak) {
            $title = "Prison Break Event";
            $percent = 0;
            $colour = BossBarAPI::COLOR_YELLOW;
            foreach (EmporiumPrison::getInstance()->getServer()->getOnlinePlayers() as $player) {
                if (DataManager::getInstance()->getPlayerXuid($player->getName()) == "00") return;
                BossBarAPI::getInstance()->sendBossBar($player, $title, 1, $percent, $colour);
            }
        } else {
            $this->getHandler()->cancel();
        }
    }
}