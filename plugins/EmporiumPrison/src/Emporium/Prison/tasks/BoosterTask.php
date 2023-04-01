<?php

namespace Emporium\Prison\tasks;

use Emporium\Prison\EmporiumPrison;
use Emporium\Prison\Variables;

use EmporiumData\DataManager;

use pocketmine\scheduler\Task;
use pocketmine\utils\TextFormat as TF;

class BoosterTask extends Task {

    private EmporiumPrison $plugin;

    public function __construct(EmporiumPrison $plugin) {
        $this->plugin = $plugin;
    }


    # Task Execution
    public function onRun(): void {

        // For all Files
        foreach (DataManager::getInstance()->getPlayerNames() as $player) {
            $xuid = $player;

            $energyBooster = DataManager::getInstance()->getPlayerData($xuid,  "boosters.energy-booster-timer");
            if ($energyBooster > 0) DataManager::getInstance()->setPlayerData($xuid,  "boosters.energy-booster-timer", $energyBooster - 1);

            if($energyBooster === 0) {
                DataManager::getInstance()->setPlayerData($xuid,  "boosters.energy-booster-timer", 0);
                DataManager::getInstance()->setPlayerData($xuid,  "boosters.energy-booster-multiplier", 1);
            }

            $miningBooster = DataManager::getInstance()->getPlayerData($xuid, "boosters.mining-booster-timer");

            if ($miningBooster > 0) DataManager::getInstance()->setPlayerData($xuid,  "boosters.mining-booster-timer", $miningBooster - 1);

            if($miningBooster === 0) {
                DataManager::getInstance()->setPlayerData($xuid,  "boosters.mining-booster-timer", 0);
                DataManager::getInstance()->setPlayerData($xuid,  "boosters.mining-booster-multiplier", 1);
            }
        }

        // For all Online Players
        foreach ($this->plugin->getServer()->getOnlinePlayers() as $player) {

            $energyBoosterTime = EmporiumPrison::getInstance()->getMiningManager()->getTime($player);

            # Send Alerts
            if ($energyBoosterTime === 1) {
                $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "Your Energy Booster has worn off.");
            }

            $miningBoosterTime = EmporiumPrison::getInstance()->getMiningManager()->getTime($player);

            if ($miningBoosterTime === 1) {
                $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "Your Mining XP Booster has worn off.");
            }
        }
    }
}