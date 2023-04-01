<?php

namespace Emporium\Prison\Managers;

use JsonException;
use pocketmine\player\Player;

use EmporiumData\DataManager;

class MiningManager {

    /**
     * @throws JsonException
     */
    public function start(Player $player, float $multiplier): void {
        $this->setMultiplier($player, $multiplier);
        $this->addTime($player);
    }

    public function stop(Player $player): void {
        DataManager::getInstance()->setPlayerData($player->getXuid(),  "boosters.mining-booster-timer", 0);
        DataManager::getInstance()->setPlayerData($player->getXuid(),  "boosters.mining-booster-multiplier", 1.0);
    }

    public function addTime(Player $player): void {
        DataManager::getInstance()->setPlayerData($player->getXuid(),  "boosters.mining-booster-timer", ((int) DataManager::getInstance()->getPlayerData($player->getXuid(), "mining-booster-timer")) + 3600);
    }

    public function getTime(Player $player): int {
        return DataManager::getInstance()->getPlayerData($player->getXuid(),  "boosters.mining-booster-timer");
    }

    public function setMultiplier(Player $player, float $multiplier): void {
        DataManager::getInstance()->setPlayerData($player->getXuid(),  "boosters.mining-booster-multiplier", $multiplier);

    }

    public function getMultiplier(Player $player): float {
        return DataManager::getInstance()->getPlayerData($player->getXuid(),  "boosters.mining-booster-multiplier");
    }

}