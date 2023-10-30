<?php

namespace EmporiumCore\Listeners\Player;

use Emporium\Prison\Managers\misc\Translator;

use EmporiumData\DataManager;
use EmporiumData\Rank\RankManager;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\player\chat\LegacyRawChatFormatter;
use pocketmine\utils\TextFormat as TF;

class ChatEvent implements Listener {

    public function onChat(PlayerChatEvent $event) {

        $player = $event->getPlayer();
        $message = $event->getMessage();

        # increment player anti-spam
        DataManager::getInstance()->setPlayerData($player->getXuid(), "cooldown.anti-spam", (int) DataManager::getInstance()->getPlayerData($player->getXuid(), "cooldown.anti-spam") + 1);

        # check anti spam
        $antiSpam = DataManager::getInstance()->getPlayerData($player->getXuid(), "cooldown.anti-spam");
        if($antiSpam >= 3) {
            $event->cancel();
            $player->sendMessage(TF::RED . "Please dont not spam chat! You can talk again in $antiSpam seconds");
        }

        # check muted
        $muted = (int) DataManager::getInstance()->getPlayerData($player->getXuid(), "mute-timer");
        if($muted > 0) {
            $event->cancel();
            $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You are currently muted. Time remaining: " . TF::AQUA . Translator::timeConvert($muted));
            return;
        }

        # player data
        $playerLevel = DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.level");
        $playerRankFormat = RankManager::getInstance()->getRank(DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.rank"));
        $playerPrestige = DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.prestige");

        # player prestige format
        $prestigeFormat = "";
        if($playerPrestige < 1) {
            $prestigeFormat = null;
        }
        if($playerPrestige >= 1) {
            $prestigeFormat = match ($playerPrestige) {
                1 => TF::BOLD . TF::LIGHT_PURPLE . "<" . TF::AQUA . "I" . TF::LIGHT_PURPLE . "> " . TF::RESET,
                2 => TF::BOLD . TF::LIGHT_PURPLE . "<" . TF::AQUA . "II" . TF::LIGHT_PURPLE . "> " . TF::RESET,
                3 => TF::BOLD . TF::LIGHT_PURPLE . "<" . TF::AQUA . "III" . TF::LIGHT_PURPLE . "> " . TF::RESET,
                4 => TF::BOLD . TF::LIGHT_PURPLE . "<" . TF::AQUA . "IV" . TF::LIGHT_PURPLE . "> " . TF::RESET,
                5 => TF::BOLD . TF::LIGHT_PURPLE . "<" . TF::AQUA . "V" . TF::LIGHT_PURPLE . "> " . TF::RESET,
                6 => TF::BOLD . TF::LIGHT_PURPLE . "<" . TF::AQUA . "VI" . TF::LIGHT_PURPLE . "> " . TF::RESET,
                default => null
            };
        }

        $playerTag = DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.tag");
        if($playerTag === "tag" || $playerTag === null || $playerTag === false) {
            $playerTagFormat = null;
        } else {
            $playerTagFormat = TF::WHITE . "[" . $playerTag . TF::WHITE . "]";
        }

        # player level format
        $playerLevelFormat = TF::GRAY . "[" . TF::WHITE . $playerLevel . TF::GRAY . "] " . TF::RESET;

        # set player chat format
        $event->setFormatter(new LegacyRawChatFormatter($prestigeFormat . TF::RESET . $playerLevelFormat . TF::RESET . TF::BOLD . $playerRankFormat->getFormat() . TF::RESET . " " . $playerTagFormat . TF::RESET . $player->getName() . TF::RESET . ": " . TF::GRAY . $message));
    }
}