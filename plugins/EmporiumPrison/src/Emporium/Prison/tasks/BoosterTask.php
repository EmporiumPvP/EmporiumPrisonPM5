<?php

namespace Emporium\Prison\tasks;

use Emporium\Prison\EmporiumPrison;
use Emporium\Prison\Managers\DataManager;
use Emporium\Prison\Managers\EnergyManager;
use Emporium\Prison\Managers\MiningManager;
use Emporium\Prison\Variables;

use JsonException;

use pocketmine\scheduler\Task;
use pocketmine\utils\TextFormat as TF;

class BoosterTask extends Task {

    private EmporiumPrison $plugin;
    private EnergyManager $energyManager;
    private MiningManager $miningManager;

    public function __construct(EmporiumPrison $plugin) {
        $this->plugin = $plugin;
        $this->energyManager = EmporiumPrison::getEnergyManager();
        $this->miningManager = EmporiumPrison::getMiningManager();
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

            $energyBooster = DataManager::getOfflinePlayerData($player, "Boosters", "energy-booster-timer");
            if ($energyBooster > 0) {
                DataManager::takeOfflinePlayerData($player, "Boosters", "energy-booster-timer", 1);
            }
            if($energyBooster === 0) {
                DataManager::setOfflinePlayerData($player, "Boosters", "energy-booster-timer", 0);
                DataManager::setOfflinePlayerData($player, "Boosters", "energy-booster-multiplier", 1);
            }

            $miningBooster = DataManager::getOfflinePlayerData($player, "Boosters", "mining-booster-timer");
            if ($miningBooster > 0) {
                DataManager::takeOfflinePlayerData($player, "Boosters", "mining-booster-timer", 1);
            }
            if($miningBooster === 0) {
                DataManager::setOfflinePlayerData($player, "Boosters", "mining-booster-timer", 0);
                DataManager::setOfflinePlayerData($player, "Boosters", "mining-booster-multiplier", 1);
            }
        }

        // For all Online Players
        foreach ($this->plugin->getServer()->getOnlinePlayers() as $player) {

            $energyBoosterTime = $this->energyManager->getTime($player);

            # Send Alerts
            if ($energyBoosterTime === 1) {
                $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "Your Energy Booster has worn off.");
            }

            $miningBoosterTime = $this->miningManager->getTime($player);

            if ($miningBoosterTime === 1) {
                $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "Your Mining XP Booster has worn off.");
            }
        }
    }
}