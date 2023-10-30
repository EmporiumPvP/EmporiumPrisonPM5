<?php

namespace Emporium\Prison\tasks\Events;

use diamondgold\MiniBosses\Main;

use Emporium\Prison\Variables;
use EmporiumCore\EmporiumCore;
use EmporiumCore\Listeners\WebhookEvent;

use EmporiumData\Provider\JsonProvider;

use EmporiumData\ServerManager;
use pocketmine\scheduler\Task;
use pocketmine\utils\TextFormat as TF;

class SpawnBossTask extends Task
{

    /**
     * @var array|string[]
     */
    private array $bosses;

    public function __construct()
    {
        /*
         * TODO:
         * , "zeus", "poseidon", "apollo"
         */
        $this->bosses = ["hades"];
    }

    public function onRun(): void
    {
        # increment timer
        ServerManager::getInstance()->setData("events.boss_spawn", ServerManager::getInstance()->getData("events.boss_spawn") + 1);

        $seconds = ServerManager::getInstance()->getData("events.boss_spawn");
        $minute = $seconds / 60;

        # has been 6 hours
        if($minute >= 360) {
            # choose random boss
            $boss = $this->bosses[mt_rand(0, count($this->bosses) - 1)];

            # set drops
            $data = file_get_contents(JsonProvider::$SERVER_FOLDER . "boss/drops_" . str_replace(" ", "-", strtolower($boss)) . ".txt");
            $items = explode(" ", $data);

            # set overrides
            $opts = [
                "x" => Variables::BOSS_SPAWN_LOCATION["x"],
                "y" => Variables::BOSS_SPAWN_LOCATION["y"],
                "z" => Variables::BOSS_SPAWN_LOCATION["z"],
                "drops" => array_rand($items),
                "respawnTime" => -1, # never respawn
                "despawnTime" => (20 * 60) * (60 * 5) # 5 hours
            ];

            # spawn boss
            Main::getInstance()->spawnBoss($boss, $opts);

            # broadcast message
            $message = TF::BOLD . TF::YELLOW . "(!) " . TF::RED . TF::UNDERLINE . (str_replace("_", " ", $boss)) . TF::YELLOW . " HAS SPAWNED - FIGHT!" . TF::EOL . TF::RESET . TF::GRAY . "PvP is disabled and keep inventory is enabled";
            EmporiumCore::getInstance()->getServer()->broadcastMessage($message);

            # send webhook
            WebhookEvent::EventsWebhook("Boss", ucwords(str_replace("_", " ", $boss)));

            # reset timer
            ServerManager::getInstance()->setData("events.boss_spawn", 0);
        }
    }
}