<?php

namespace EmporiumCore\managers\player;

use EmporiumCore\managers\data\DataManager;
use EmporiumCore\Variables;

class PlayerManager implements Listener {

    public function onLogin(PlayerPreLoginEvent $event) {

        $player = $event->getPlayerInfo();
        $playerName = $player->getUsername();
        # create player file
        @mkdir(EmporiumCore::getInstance()->getDataFolder() . "PlayerData/Players/");
        if(!file_exists(EmporiumCore::getInstance()->getDataFolder() . "PlayerData/Players/" . $playerName . ".yml")) {
            new Config(EmporiumCore::getInstance()->getDataFolder() . "PlayerData/Players/" . $playerName . ".yml", Config::YAML, $this->defaultPlayerData);
        }
        # create player tags file
        @mkdir(EmporiumCore::getInstance()->getDataFolder() . "PlayerData/Tags/");
        if(!file_exists(EmporiumCore::getInstance()->getDataFolder() . "PlayerData/Tags/" . $playerName . ".yml")) {
            new Config(EmporiumCore::getInstance()->getDataFolder() . "PlayerData/Tags/" . $playerName . ".yml", Config::YAML, $this->defaultTagsData);
        }
        # create player permissions file
        @mkdir(EmporiumCore::getInstance()->getDataFolder() . "PlayerData/Permissions/");
        if(!file_exists(EmporiumCore::getInstance()->getDataFolder() . "PlayerData/Permissions/" . $playerName . ".yml")) {
            new Config(EmporiumCore::getInstance()->getDataFolder() . "PlayerData/Permissions/" . $playerName . ".yml", Config::YAML, $this->defaultPermissionsData);
        }
        # create player cooldowns file
        @mkdir(EmporiumCore::getInstance()->getDataFolder() . "PlayerData/Cooldowns/");
        if(!file_exists(EmporiumCore::getInstance()->getDataFolder() . "PlayerData/Cooldowns/" . $playerName . ".yml")) {
            new Config(EmporiumCore::getInstance()->getDataFolder() . "PlayerData/Cooldowns/" . $playerName . ".yml", Config::YAML);
        }

        if(file_exists(EmporiumCore::getInstance()->getDataFolder() . "PlayerData/Players/" . $playerName . ".yml")) {
            $isBanned = DataManager::getOfflinePlayerData($playerName, "Players", "Banned");
            if($isBanned) {
                $event->setKickReason(PlayerPreLoginEvent::KICK_REASON_BANNED, Variables::BAN_HEADER);
            }
        }
    }
}