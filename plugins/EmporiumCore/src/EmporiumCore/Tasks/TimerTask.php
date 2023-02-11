<?php

namespace EmporiumCore\Tasks;

use EmporiumCore\Listeners\WebhookEvent;

use EmporiumCore\EmporiumCore;

use EmporiumCore\Managers\Data\DataManager;
use EmporiumCore\Managers\Data\ServerManager;

use JsonException;

use pocketmine\scheduler\Task;

use pocketmine\utils\Config;
use pocketmine\utils\TextFormat as TF;

class TimerTask extends Task {

    private EmporiumCore $plugin;
    private Config $prisonBreak;

    public function __construct(EmporiumCore $plugin) {
        $this->plugin = $plugin;
    }

    /**
     * @throws JsonException
     */
    public function onRun(): void {
        
        //////////////////////////////// PLAYER ONLINE TIME ////////////////////////////////
        foreach($this->plugin->getServer()->getOnlinePlayers() as $players) {
            DataManager::addData($players, "Players", "OnlineTime", 1);
        }

        # variables
        $timer = ServerManager::getData("Events", "EventsTimer");
        $minute = $timer / 60;

        //////////////////////////////// EVENT MESSAGES ////////////////////////////////
        switch($minute) {
            # prison break starting messages (EVERY 45 HOURS - 5)
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

            # prison break started messages (EVERY 45 HOURS)
            case 180:
            case 360:
            case 540:
            case 720:
            case 900:
            case 1080:
            case 1260:
                $this->plugin->getServer()->broadcastMessage(TF::BOLD . TF::GOLD . "(!) The " . TF::RED . "Prison break Event " . TF::GOLD . "has started!");
                $this->plugin->getServer()->broadcastMessage(TF::BOLD . TF::GOLD . "The event will finish in 15 minutes.");
                $this->plugin->getServer()->broadcastMessage("");
                $this->plugin->getServer()->broadcastTitle(TF::BOLD . TF::RED . "Prison Break", TF::GREEN . "Mine in any Tier Mine to obtain Loot!");
                ServerManager::setData("Events", "PrisonBreak", true);
                $this->prisonBreak = new Config(EmporiumCore::getPluginInstance()->getDataFolder() . "Server/PrisonBreak.yml", Config::YAML);
                $players = null;
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
                $this->plugin->getServer()->broadcastMessage(TF::BOLD . TF::GOLD . "(!) The " . TF::RED . "Prison break Event " . TF::GOLD . "has ended!");
                $this->plugin->getServer()->broadcastMessage(TF::BOLD . TF::DARK_AQUA . "The Top 5 Prisoners are:");
                $data = [];
                foreach ($this->prisonBreak->getAll() as $player => $points) {
                    $data[$player] = $points;
                }
                $place = 1;
                arsort($data);
                foreach($data as $player => $points) {
                    if($place > 5) break;
                    $this->plugin->getServer()->broadcastMessage(TF::BOLD . TF::DARK_AQUA . "$player: " . TF::GOLD . $points . " points");
                    $place++;
                }
                ServerManager::setData("Events", "PrisonBreak", false);
                unlink($this->plugin->getDataFolder() . "Server/PrisonBreak.yml");
                break;
        }

        # ADD EVENT TIME
        ServerManager::addData("Events", "EventsTimer", 1);
    }
}