<?php

namespace EmporiumCore\Listeners\Player;

use EmporiumCore\Managers\Data\DataManager;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerMoveEvent;


class MoveEvent implements Listener {

    # Movement Listener
    public function onMove(PlayerMoveEvent $event) {
        $player = $event->getPlayer();
        $isFrozen = DataManager::getData($player, "Players", "Frozen");
        $placeholder = DataManager::getData($player, "Cooldowns", "AbilityPlaceholder");

        // Frozen
        # Freeze Check
        if ($isFrozen === true) {
            $event->cancel();
            $player->sendTip("§l§8(§4!§8) §r§cYou are frozen and cannot move!");
        }

        // Abilities
        # Placeholder Ability
        if ($placeholder > 0) {
            $event->cancel();
        }
    }

}