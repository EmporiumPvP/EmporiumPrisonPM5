<?php

namespace EmporiumCore\Tasks;

use EmporiumCore\EmporiumCore;
use EmporiumCore\Managers\Misc\Webhooks;
use EmporiumCore\Variables;
use EmporiumData\DataManager;
use pocketmine\scheduler\Task;
use pocketmine\utils\TextFormat as TF;

class AntiCheatTask extends Task {

    private EmporiumCore $plugin;

    public function __construct(EmporiumCore $plugin) {
        $this->plugin = $plugin;
	}

    public function onRun(): void {
        
        // For Online Players
        foreach($this->plugin->getServer()->getOnlinePlayers() as $player) {
            if (DataManager::getInstance()->getPlayerXuid($player->getName()) == "00") return;

            // Variables
            $auto = (int) DataManager::getInstance()->getPlayerData($player->getXuid(), "anticheat.anti_auto");
            $nuke = (int) DataManager::getInstance()->getPlayerData($player->getXuid(), "anticheat.anti_nuke");
            $warnAuto = (int) DataManager::getInstance()->getPlayerData($player->getXuid(), "auto_warn");
            $warnNuke = (int) DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.nuke_warn");

            // Anti-Auto
            if ($warnAuto === 10) {
                DataManager::getInstance()->setPlayerData($player->getXuid(), "anticheat.anti_auto", 0);
                DataManager::getInstance()->setPlayerData($player->getXuid(), "auto_warn", 0);
                DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.ban", 86400);
                DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.banned", true);
                $player->kick("§cYou have been banned from Emporium.\n§bDuration: §f24 Hours\n§bReason: §fIgnoring CPS warnings");
            }
            if ($auto > 25) {
                DataManager::getInstance()->setPlayerData($player->getXuid(), "auto_warn", 1);
                $player->sendMessage(Variables::WARDEN_PREFIX . TF::GRAY . "Please keep your CPS below 20.");
                // Create Webhook
                $message = "**" . $player->getName() . "** has **25+** CPS.";
                $webhook = "https://discord.com/api/webhooks/1073240681985880114/IH8qqjVhtUf-snbdC0oHA36F_9rcLFee5TdIwnPgNyZwz9P-c-SPyl5qeExZhUAv7InL";
                $curlopts = [
	    	        "content" => $message,
                    "username" => "EmporiumPvP | WardenAC"
                ];
                // Send Webhook
                $this->plugin->getServer()->getAsyncPool()->submitTask(new Webhooks($player->getName(), $webhook, serialize($curlopts)));
            }

            // Anti-Nuke
            if ($warnNuke === 10) {
                DataManager::getInstance()->setPlayerData($player->getXuid(), "anticheat.anti_nuke", 0);
                DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.nuke_warn", 0);
                DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.ban", 86400);
                DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.banned", true);
                $player->kick("§cYou have been banned from Emporium.\n§bDuration: §f24 Hours\n§bReason: §fYou have been flagged for nuking");
            }
            if ($nuke > 40) {
                DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.nuke_warn", 1);
                $player->sendMessage(Variables::WARDEN_PREFIX . TF::GRAY . "You have been flagged for nuking. Please mine slower or disable your hacks.");
                // Create Webhook
                $message = "**" . $player->getName() . "** has been flagged for **Nuking**.";
                $webhook = "https://discord.com/api/webhooks/1073240681985880114/IH8qqjVhtUf-snbdC0oHA36F_9rcLFee5TdIwnPgNyZwz9P-c-SPyl5qeExZhUAv7InL";
                $curlopts = [
	    	        "content" => $message,
                    "username" => "Emporium | WardenAC"
                ];
                // Send Webhook
                $this->plugin->getServer()->getAsyncPool()->submitTask(new Webhooks($player->getName(), $webhook, serialize($curlopts)));
            }
            DataManager::getInstance()->setPlayerData($player->getXuid(), "anticheat.anti_nuke", 0);
        }
    }
}