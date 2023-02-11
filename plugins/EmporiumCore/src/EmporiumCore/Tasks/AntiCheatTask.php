<?php

namespace EmporiumCore\Tasks;

use EmporiumCore\Variables;

use JsonException;

use pocketmine\scheduler\Task;

use EmporiumCore\EmporiumCore;

use EmporiumCore\Managers\Misc\Webhooks;
use EmporiumCore\Managers\Data\DataManager;

use pocketmine\utils\TextFormat as TF;

class AntiCheatTask extends Task {

    private EmporiumCore $plugin;

    public function __construct(EmporiumCore $plugin) {
        $this->plugin = $plugin;
	}

    /**
     * @throws JsonException
     */
    public function onRun(): void {
        
        // For Online Players
        foreach($this->plugin->getServer()->getOnlinePlayers() as $player) {

            // Variables
            $auto = DataManager::getData($player, "Players", "AntiAuto");
            $nuke = DataManager::getData($player, "Players", "AntiNuke");
            $wAuto = DataManager::getData($player, "Players", "AutoWarn");
            $wNuke = DataManager::getData($player, "Players", "NukeWarn");

            // Anti-Auto
            if ($wAuto === 3) {
                DataManager::setData($player, "Players", "AntiAuto", 0);
                DataManager::setData($player, "Players", "AutoWarn", 0);
                DataManager::setData($player, "Cooldowns", "Ban", 86400);
                DataManager::setData($player, "Players", "Banned", true);
                $player->kick("§cYou have been banned from Emporium.\n§bDuration: §f24 Hours\n§bReason: §fIgnoring CPS warnings");
            }
            if ($auto > 25) {
                DataManager::addData($player, "Players", "AutoWarn", 1);
                $player->sendMessage(Variables::WARDEN_PREFIX . TF::GRAY . "Please keep your CPS below 20.");
                // Create Webhook
                $message = "**" . $player->getName() . "** has **25+** CPS.";
                $webhook = "https://discord.com/api/webhooks/1023797835247910994/I9NqP41dBvS3ZySY9yNRQMr3UEvhZAvsLBjDIYFn6qYTF3SGYpkaMa23TUuoNaYBYbhD";
                $curlopts = [
	    	        "content" => $message,
                    "username" => "EmporiumPvP | WardenAC"
                ];
                // Send Webhook
                $this->plugin->getServer()->getAsyncPool()->submitTask(new Webhooks($player->getName(), $webhook, serialize($curlopts)));
            }

            // Anti-Nuke
            if ($wNuke === 2) {
                DataManager::setData($player, "Players", "AntiNuke", 0);
                DataManager::setData($player, "Players", "NukeWarn", 0);
                DataManager::setData($player, "Cooldowns", "Ban", 86400);
                DataManager::setData($player, "Players", "Banned", true);
                $player->kick("§cYou have been banned from Emporium.\n§bDuration: §f24 Hours\n§bReason: §fYou have been flagged for nuking");
            }
            if ($nuke > 40) {
                DataManager::addData($player, "Players", "NukeWarn", 1);
                $player->sendMessage(Variables::WARDEN_PREFIX . TF::GRAY . "You have been flagged for nuking. Please mine slower or disable your hacks.");
                // Create Webhook
                $message = "**" . $player->getName() . "** has been flagged for **Nuking**.";
                $webhook = "https://discord.com/api/webhooks/1023797835247910994/I9NqP41dBvS3ZySY9yNRQMr3UEvhZAvsLBjDIYFn6qYTF3SGYpkaMa23TUuoNaYBYbhD";
                $curlopts = [
	    	        "content" => $message,
                    "username" => "Emporium | WardenAC"
                ];
                // Send Webhook
                $this->plugin->getServer()->getAsyncPool()->submitTask(new Webhooks($player->getName(), $webhook, serialize($curlopts)));
            }
            DataManager::setData($player, "Players", "AntiNuke", 0);
        }
    }
}