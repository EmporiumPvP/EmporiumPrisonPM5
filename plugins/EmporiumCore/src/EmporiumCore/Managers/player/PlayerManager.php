<?php

namespace EmporiumCore\managers\player;

use EmporiumCore\Variables;
use EmporiumData\DataManager;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\utils\TextFormat as TF;

class PlayerManager implements Listener {

    public function onLogin(PlayerJoinEvent $event) {

        $player = $event->getPlayer();

        $isBanned = DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.banned");
        $banTimeRemaining = (int) DataManager::getInstance()->getPlayerData($player->getXuid(), "cooldowns.ban");
        if(!$isBanned) return;

        $player->kick(Variables::BAN_HEADER . TF::EOL . TF::RED . "Time remaining: " . TF::GRAY . $banTimeRemaining);
    }
}