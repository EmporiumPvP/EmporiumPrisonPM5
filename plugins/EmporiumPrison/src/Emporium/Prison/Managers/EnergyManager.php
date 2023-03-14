<?php

namespace Emporium\Prison\Managers;

use JsonException;
use pocketmine\player\Player;

class EnergyManager {

    /**
     * @throws JsonException
     */
    public function start(Player $player, float $multiplier): void {
        $this->addTime($player);
        $this->setMultiplier($player, $multiplier);
    }

    /**
     * @throws JsonException
     */
    public function stop(Player $player): void {
        DataManager::setData($player, "Boosters", "energy-booster-timer", 0);
        DataManager::setData($player, "Boosters", "energy-booster-multiplier", 1.0);
    }

    public function getTime(Player $player): int {
        return DataManager::getData($player, "Boosters", "energy-booster-timer");
    }

    /**
     * @throws JsonException
     */
    public function addTime(Player $player): void {
        DataManager::addData($player, "Boosters", "energy-booster-timer", 3600);
    }

    public function getMultiplier(Player $player): float {
        return DataManager::getData($player, "Boosters", "energy-booster-multiplier");
    }

    /**
     * @throws JsonException
     */
    public function setMultiplier(Player $player, float $multiplier): void {
        DataManager::setData($player, "Boosters", "energy-booster-multiplier", $multiplier);
    }

}