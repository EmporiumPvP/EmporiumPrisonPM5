<?php

namespace Emporium\Prison\tasks\Events;

use Emporium\Prison\library\bossbar\BossBarAPI;
use Emporium\Prison\EmporiumPrison;

use EmporiumData\DataManager;
use EmporiumData\ServerManager;

use pocketmine\scheduler\CancelTaskException;
use pocketmine\scheduler\Task;
use pocketmine\utils\TextFormat as TF;

class PrisonBreakBar extends Task {

    private int $timer;

    public function __construct()
    {
        $this->timer = 0;
    }

    public function onRun(): void {

        $prisonBreak = ServerManager::getInstance()->getData("events.prison_break-enabled");

        if(!$prisonBreak) if(!$this->getHandler()->isCancelled()) $this->getHandler()->cancel();

        if($prisonBreak) {

            # increment timer
            $this->timer++;

            # create boss bar
            $progress = round(($this->timer / 900) * 100, +1);
            $title = TF::BOLD . TF::RED . "Prison Break";
            $percent = ($progress / 100);
            $colour = BossBarAPI::COLOR_RED;

            foreach (EmporiumPrison::getInstance()->getServer()->getOnlinePlayers() as $player) {
                if (DataManager::getInstance()->getPlayerXuid($player->getName()) == "00") return;

                # send boss bar
                if($this->timer < 900) {
                    BossBarAPI::getInstance()->sendBossBar($player, $title, 1, $percent, $colour);
                }

                # remove boss bar
                if($this->timer >= 900) {
                    BossBarAPI::getInstance()->hideBossBar($player, 1);
                    throw new CancelTaskException();
                }
            }

        }
    }
}