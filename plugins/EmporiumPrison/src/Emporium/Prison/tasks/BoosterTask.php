<?php

namespace Emporium\Prison\tasks;

use Emporium\Prison\EmporiumPrison;
use EmporiumData\DataManager;
use Emporium\Prison\Variables;

use JsonException;

use pocketmine\scheduler\Task;
use pocketmine\utils\TextFormat as TF;

class BoosterTask extends Task {

    private EmporiumPrison $plugin;

    public function __construct(EmporiumPrison $plugin) {
        $this->plugin = $plugin;
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

    # Task Execution

    /**
     * @throws JsonException
     */
    public function onRun(): void {

        // For all Files
        foreach ($this->getPlayers() as $player) {
            $xuid = DataManager::getInstance()->getPlayerXuid($player);

            $energyBooster = DataManager::getInstance()->getPlayerData($xuid, "booster.energy-booster-timer");
            if ($energyBooster > 0) DataManager::getInstance()->setPlayerData($xuid, "booster.energy-booster-timer", $energyBooster - 1);

            if($energyBooster === 0) {
                DataManager::getInstance()->setPlayerData($xuid, "booster.energy-booster-timer", 0);
                DataManager::getInstance()->setPlayerData($xuid, "booster.energy-booster-multiplier", 1);
            }

            $miningBooster = DataManager::getInstance()->getPlayerData($xuid, "booster.mining-booster-timer");

            if ($miningBooster > 0) DataManager::getInstance()->setPlayerData($xuid, "booster.mining-booster-timer", $miningBooster - 1);

            if($miningBooster === 0) {
                DataManager::getInstance()->setPlayerData($xuid, "booster.mining-booster-timer", 0);
                DataManager::getInstance()->setPlayerData($xuid, "booster.mining-booster-multiplier", 1);
            }
        }

        // For all Online Players
        foreach ($this->plugin->getServer()->getOnlinePlayers() as $player) {

            $energyBoosterTime = EmporiumPrison::getMiningManager()->getTime($player);

            # Send Alerts
            if ($energyBoosterTime === 1) {
                $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "Your Energy Booster has worn off.");
            }

            $miningBoosterTime = EmporiumPrison::getMiningManager()->getTime($player);

            if ($miningBoosterTime === 1) {
                $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "Your Mining XP Booster has worn off.");
            }
        }
    }
}