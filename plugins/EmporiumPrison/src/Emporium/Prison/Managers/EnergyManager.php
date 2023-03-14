<?php

namespace Emporium\Prison\Managers;

use EmporiumData\DataManager;
use JsonException;
use pocketmine\player\Player;

class EnergyManager {

    /**
     * @throws JsonException
     */
    public function start(Player $player, float $multiplier): void {
        $this->setMultiplier($player, $multiplier);
        $this->addTime($player);
    }

    public function stop(Player $player): void {
        DataManager::getInstance()->setPlayerData($player->getXuid(), "booster.energy-booster-timer", 0);
        DataManager::getInstance()->setPlayerData($player->getXuid(), "booster.energy-booster-multiplier", 1.0);
    }

    public function addTime(Player $player): void {
        DataManager::getInstance()->setPlayerData($player->getXuid(), "booster.energy-booster-timer", DataManager::getInstance()->getPlayerData($player->getXuid(), "energy-booster-timer") + 3600);
    }

    public function getTime(Player $player): int {
        return DataManager::getInstance()->getPlayerData($player->getXuid(), "booster.energy-booster-timer");
    }

    public function setMultiplier(Player $player, float $multiplier): void {
        DataManager::getInstance()->setPlayerData($player->getXuid(), "booster.energy-booster-multiplier", $multiplier);

    }

    public function getMultiplier(Player $player): float {
        return DataManager::getInstance()->getPlayerData($player->getXuid(), "booster.energy-booster-multiplier");
    }

}