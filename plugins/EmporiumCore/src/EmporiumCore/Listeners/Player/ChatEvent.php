<?php

namespace EmporiumCore\Listeners\Player;

use Emporium\Prison\Managers\misc\Translator;
use Emporium\Prison\Managers\PrisonManager;
use EmporiumCore\managers\data\DataManager;
use EmporiumCore\Variables;
use pocketmine\entity\Entity;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\player\PlayerLoginEvent;
use pocketmine\utils\TextFormat as TF;

class ChatEvent implements Listener {

    public function onLogin(PlayerLoginEvent $event) {

    }

    public function onChat(PlayerChatEvent $event) {

        $player = $event->getPlayer();
        $playerName = $player->getName();
        $message = $event->getMessage();
        $playerLevel = PrisonManager::getData("Players", $playerName, "level");
        $playerRank = DataManager::getData($player, "Players", "Rank");
        $playerRankFormat = DataManager::getData($player, "Players", "RankFormat");
        $playerPrestige = DataManager::getData($player, "Players", "Prestige");
        $muted = DataManager::getData($player, "Cooldowns", "Muted");
        $antispam = DataManager::getData($player, "Cooldowns", "Antispam");

        # player prestige format
        if($playerPrestige === 0) {
            $prestigeFormat = null;
        } elseif($playerPrestige > 0) {
            switch ($playerPrestige) {
                case 1:
                    $prestigeFormat = TF::BOLD . TF::LIGHT_PURPLE . "<" . TF::AQUA . "I" . TF::LIGHT_PURPLE . "> " . TF::RESET;
                    break;

                case 2:
                    $prestigeFormat = TF::BOLD . TF::LIGHT_PURPLE . "<" . TF::AQUA . "II" . TF::LIGHT_PURPLE . "> " . TF::RESET;
                    break;

                case 3:
                    $prestigeFormat = TF::BOLD . TF::LIGHT_PURPLE . "<" . TF::AQUA . "III" . TF::LIGHT_PURPLE . "> " . TF::RESET;
                    break;

                case 4:
                    $prestigeFormat = TF::BOLD . TF::LIGHT_PURPLE . "<" . TF::AQUA . "IV" . TF::LIGHT_PURPLE . "> " . TF::RESET;
                    break;

                case 5:
                    $prestigeFormat = TF::BOLD . TF::LIGHT_PURPLE . "<" . TF::AQUA . "V" . TF::LIGHT_PURPLE . "> " . TF::RESET;
                    break;

                case 6:
                    $prestigeFormat = TF::BOLD . TF::LIGHT_PURPLE . "<" . TF::AQUA . "VI" . TF::LIGHT_PURPLE . "> " . TF::RESET;
                    break;
            }
        }

        if($muted > 0) {
            $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You are currently muted. Time remaining: " . TF::AQUA . Translator::timeConvert($muted));
            return;
        }
        /*
        if($antispam > 0) {
            $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "Slow down, dont spam");
            return;
        }*/

        #DataManager::addData($player, "Cooldowns", "Antispam", 1);

        $playerTag = DataManager::getData($player, "Players", "Tag");
        if($playerTag != null) {
            $playerTagFormat = TF::WHITE . "[" . $playerTag . TF::WHITE . "]";
        } else {
            $playerTagFormat = null;
        }
        # player level format
        $playerLevelFormat = TF::GRAY . "[" . TF::WHITE . $playerLevel . TF::GRAY . "] " . TF::RESET;

        # set player chat format
        $event->setFormat($prestigeFormat . TF::RESET . $playerLevelFormat . TF::RESET . $playerRankFormat . TF::RESET . " " . $playerTagFormat . TF::RESET . $playerName . TF::RESET . ": " . TF::GRAY . $message);
    }
}