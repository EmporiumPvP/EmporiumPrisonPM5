<?php

namespace EmporiumCore\Tasks;


use EmporiumCore\EmporiumCore;

use EmporiumData\DataManager;

use pocketmine\scheduler\Task;

class TimerTask extends Task
{

    private EmporiumCore $plugin;


    public function __construct(EmporiumCore $plugin)
    {
        $this->plugin = $plugin;
    }

    public function onRun(): void
    {

        /*
         * player online time
         */
        foreach ($this->plugin->getServer()->getOnlinePlayers() as $players) {
            if (DataManager::getInstance()->getPlayerXuid($players->getName()) == "00") return;
            DataManager::getInstance()->setPlayerData($players->getXuid(), "profile.online_time", (int)DataManager::getInstance()->getPlayerData($players->getXuid(), "profile.online_time") + 1);
        }

    }

}