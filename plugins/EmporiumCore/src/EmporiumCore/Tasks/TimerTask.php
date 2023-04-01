<?php

namespace EmporiumCore\Tasks;

use EmporiumCore\EmporiumCore;
use EmporiumCore\Listeners\WebhookEvent;
use EmporiumData\DataManager;
use EmporiumData\ServerManager;
use pocketmine\scheduler\Task;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat as TF;

class TimerTask extends Task {

    private EmporiumCore $plugin;

    public function __construct(EmporiumCore $plugin) {
        $this->plugin = $plugin;
    }

    public function onRun(): void {
        
        //////////////////////////////// PLAYER ONLINE TIME ////////////////////////////////
        foreach($this->plugin->getServer()->getOnlinePlayers() as $players) {
            if (DataManager::getInstance()->getPlayerXuid($players->getName()) == "00") return;
            DataManager::getInstance()->setPlayerData($players->getXuid(), "profile.online_time", (int)DataManager::getInstance()->getPlayerData($players->getXuid(), "profile.online_time") + 1);
        }

        # variables
        $timer = ServerManager::getInstance()->getData("events.events_timer");
        $minute = $timer / 60;

        //////////////////////////////// EVENT MESSAGES ////////////////////////////////
        switch($minute) {
            # prison break starting messages (EVERY 3 HOURS - 5 MINUTES)
            case 175:
            case 355:
            case 535:
            case 715:
            case 895:
            case 1075:
            case 1255:
                $this->plugin->getServer()->broadcastMessage(TF::BOLD . TF::GOLD . "(!) The " . TF::RED . "Prison break Event " . TF::GOLD . "Will start in 5 Minutes!");
                $this->plugin->getServer()->broadcastMessage(TF::BOLD . TF::GOLD . "More information about this event in " . TF::AQUA . "/help prisonbreak");
                break;

            # prison break started messages (EVERY 3 HOURS)
            case 180:
            case 360:
            case 540:
            case 720:
            case 900:
            case 1080:
            case 1260:
                # send messages
                $this->plugin->getServer()->broadcastMessage(TF::BOLD . TF::GOLD . "(!) The " . TF::RED . "Prison break Event " . TF::GOLD . "has started!");
                $this->plugin->getServer()->broadcastMessage(TF::BOLD . TF::GOLD . "The event will finish in 15 minutes.");
                $this->plugin->getServer()->broadcastMessage("");
                $this->plugin->getServer()->broadcastTitle(TF::BOLD . TF::RED . "Prison Break", TF::GREEN . "Mine in any Tier Mine to obtain Loot!");
                # create event file
                ServerManager::getInstance()->setData("events.prison_break", true);
                new Config(EmporiumCore::getInstance()->getDataFolder() . "events\PrisonBreak.json", Config::YAML);
                $players = null;
                # send webhook
                WebhookEvent::EventsWebhook($players, "PrisonBreak");
                break;

            # prison break ended messages
            case 195:
            case 375:
            case 555:
            case 735:
            case 915:
            case 1095:
            case 1275:
                $prisonBreak = New Config(EmporiumCore::getInstance()->getDataFolder() . "events/PrisonBreak.yml");
                # end event
                ServerManager::getInstance()->setData("events.prison_break", false);
                # create results message
                $message = TF::BOLD . TF::GOLD . "(!) The " . TF::RED . "Prison break Event " . TF::GOLD . "has ended!" . TF::EOL;
                $message .= TF::BOLD . TF::DARK_AQUA . "The Top 5 Prisoners are:" . TF::EOL;
                $place = 1;
                $eventData = [];
                foreach($prisonBreak->getAll() as $playerData => $playerPoints) {
                    $eventData[$playerData] = $playerPoints;
                }
                arsort($eventData);
                foreach($eventData as $playerData => $playerPoints) {
                    if($place > 5) break;
                    $message .= TF::BOLD . TF::DARK_AQUA . "$playerData: " . TF::GOLD . $playerPoints . " points" . TF::EOL;
                    $place++;
                }
                # broadcast message
                EmporiumCore::getInstance()->getServer()->broadcastMessage($message);
                # delete events file
                unlink($this->plugin->getDataFolder() . "events/PrisonBreak.yml");
                break;
        }

        # add event time
        ServerManager::getInstance()->setData("events.prison_break", (int)ServerManager::getInstance()->getData("events.prison_break") + 1);
    }
}