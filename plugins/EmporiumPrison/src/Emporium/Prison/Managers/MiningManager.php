<?php

namespace Emporium\Prison\Managers;

use JsonException;
use pocketmine\player\Player;

class MiningManager {

    /**
     * @throws JsonException
     */
    public function start(Player $player, float $multiplier): void {
        $this->setMultiplier($player, $multiplier);
        $this->addTime($player);
    }

    /**
     * @throws JsonException
     */
    public function stop(Player $player): void {
        DataManager::setData($player, "Boosters", "mining-booster-timer", 0);
        DataManager::setData($player, "Boosters", "mining-booster-multiplier", 1.0);
    }

    /**
     * @throws JsonException
     */
    public function addTime(Player $player): void {
        DataManager::addData($player, "Boosters", "mining-booster-timer", 3600);
    }

    public function getTime(Player $player): int {
        return DataManager::getData($player, "Boosters", "mining-booster-timer");
    }

    /**
     * @throws JsonException
     */
    public function setMultiplier(Player $player, float $multiplier): void {
        DataManager::setData($player, "Boosters", "mining-booster-multiplier", $multiplier);
    }

    public function getMultiplier(Player $player): float {
        return DataManager::getData($player, "Boosters", "mining-booster-multiplier");
    }

}