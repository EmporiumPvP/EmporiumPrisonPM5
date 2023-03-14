<?php

namespace Emporium\Prison\tasks\Leaderboards;

use Emporium\Prison\EmporiumPrison;
use EmporiumCore\EmporiumCore;
use EmporiumCore\Managers\Data\DataManager;

use pocketmine\scheduler\Task;

class TopMoney extends Task {

    /**
     */
    public function onRun(): void {

        $top10Data = array();

        # delete old file
        if(file_exists(EmporiumCore::getInstance()->getDataFolder() . "Server/TopMoneyLeaderboardData.yml")) {
            unlink(EmporiumCore::getInstance()->getDataFolder() . "Server/TopMoneyLeaderboardData.yml");
        }

        $moneys = [];
        $place = 0;
        # get all player money data
        foreach($this->getPlayers() as $players) {
            $balance = DataManager::getOfflinePlayerData($players, "Players", "Money");
            if (is_numeric($balance)) {
                $moneys[$players] = $balance;
            }
        }
        // Sort + Get
        rsort($moneys);

        for ($i = 0; $i < 11; $i++) {
            $top10Data[] = $moneys;
        }

    }

    # Get all Players
    function getPlayers(): array {
        $files = scandir(EmporiumPrison::getInstance()->getDataFolder() . "Boosters");
        $players = [];
        foreach($files as $file) {
            if (in_array($file, ["..", "."])) continue;
            if (str_contains(".tmp", $file)) continue;
            $players[] = str_replace(".yml", "", $file);
        }
        return $players;
    }

}