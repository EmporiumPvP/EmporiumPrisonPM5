<?php

namespace EmporiumCore\Listeners\Player;

use EmporiumData\DataManager;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\utils\TextFormat as TF;


class MoveEvent implements Listener {

    # Movement Listener
    public function onMove(PlayerMoveEvent $event) {
        $player = $event->getPlayer();
        if (DataManager::getInstance()->getPlayerXuid($player->getName()) == "00") return;
        $isFrozen = DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.frozen");

        // Frozen
        # Freeze Check
        if ($isFrozen) {
            $event->cancel();
            $player->sendTip(TF::BOLD . TF::DARK_GRAY . "(" . TF::RED . "!" . TF::DARK_GRAY . ")" . TF::RESET . TF::RED . "You are frozen and cannot move!");
        }

    }

}