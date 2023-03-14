<?php

namespace Emporium\Prison\tasks\Events;

use Emporium\Prison\library\bossbar\BossBarAPI;
use Emporium\Prison\EmporiumPrison;
use EmporiumCore\Managers\Data\ServerManager;
use pocketmine\scheduler\Task;

class PrisonBreakBar extends Task{

    public function onRun(): void {

        $prisonBreak = ServerManager::getData("Events", "PrisonBreak");
        if($prisonBreak) {
            $title = "";
            $percent = "";
            $colour = BossBarAPI::COLOR_YELLOW;
            foreach (EmporiumPrison::getInstance()->getServer()->getOnlinePlayers() as $player) {
                BossBarAPI::getInstance()->sendBossBar($player, $title, 1, $percent, $colour);
            }
        } else {
            $this->getHandler()->cancel();
        }
    }
}