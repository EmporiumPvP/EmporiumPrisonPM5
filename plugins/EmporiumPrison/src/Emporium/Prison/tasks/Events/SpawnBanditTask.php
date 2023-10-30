<?php

namespace Emporium\Prison\tasks\Events;

use diamondgold\MiniBosses\Main;

use EmporiumCore\EmporiumCore;
use EmporiumCore\Listeners\WebhookEvent;

use EmporiumData\Provider\JsonProvider;
use EmporiumData\ServerManager;

use pocketmine\scheduler\Task;
use pocketmine\utils\TextFormat as TF;

class SpawnBanditTask extends Task
{

    /**
     * @var array|string[]
     */
    private array $bandits;

    public function __construct()
    {
        $this->bandits = ["elite_bandit_chain", "elite_bandit_gold", "elite_bandit_iron", "elite_bandit_diamond"];
    }

    public function onRun(): void
    {
        # increment timer
        ServerManager::getInstance()->setData("events.bandit_spawn", ServerManager::getInstance()->getData("events.bandit_spawn") + 1);

        $seconds = ServerManager::getInstance()->getData("events.bandit_spawn");
        $minute = $seconds / 60;

        # has been 30 minutes
        if($minute >= 60) {
            # choose random bandit
            $bandit = $this->bandits[mt_rand(0, count($this->bandits) - 1)];

            # generate spawn location
            $position = $this->generateLocation($bandit);
            $x = $position["x"];
            $y = $position["y"];
            $z = $position["z"];
            $location = $x . "x " . $y . "y " . $z . "z ";

            # set drops
            $data = file_get_contents(JsonProvider::$SERVER_FOLDER . "boss/drops_" . str_replace(" ", "-", strtolower($bandit)) . ".txt");
            $items = explode(" ", $data);

            # set overrides
            $opts = [
                "x" => $x,
                "y" => $y,
                "z" => $z,
                "drops" => array_rand($items),
                "respawnTime" => -1, # never respawn
                "despawnTime" => (20 * 60) * 30 # 30 minutes
            ];

            # spawn boss
            Main::getInstance()->spawnBoss($bandit, $opts);

            # broadcast message
            $message = TF::BOLD . TF::GRAY . "An " . TF::RED . substr(ucwords(str_replace("_", " ", $bandit)), 0, 12) . TF::GRAY . " has been spotted near " . TF::GREEN . $location;
            EmporiumCore::getInstance()->getServer()->broadcastMessage($message);

            # send webhook
            WebhookEvent::EventsWebhook("Bandit", ucwords(str_replace("_", " ", $bandit)));

            # reset timer
            ServerManager::getInstance()->setData("events.bandit_spawn", 0);
        }


    }

    public function generateLocation(string $bandit): array
    {

        switch ($bandit) {

            # bandits
            # can spawn chain zone
            case "elite_bandit_chain":
                $x = mt_rand(-1792, -963);
                $z = mt_rand(-511, 511);
                $y = EmporiumCore::getInstance()->getServer()->getWorldManager()->getWorldByName("world")->getHighestBlockAt($x, $z) + 1;
                $position = [
                    "x" => $x,
                    "y" => $y,
                    "z" => $z
                ];
                break;

            # can spawn gold zone
            case "elite_bandit_gold":
                $x = mt_rand(-960, -390);
                $z = mt_rand(-511, 511);
                $y = EmporiumCore::getInstance()->getServer()->getWorldManager()->getWorldByName("world")->getHighestBlockAt($x, $z) + 1;
                $position = [
                    "x" => $x,
                    "y" => $y,
                    "z" => $z
                ];
                break;

            # can spawn iron zone
            case "elite_bandit_iron":
                $x = mt_rand(-386, 253);
                $z = mt_rand(-511, 511);
                $y = EmporiumCore::getInstance()->getServer()->getWorldManager()->getWorldByName("world")->getHighestBlockAt($x, $z) + 1;
                $position = [
                    "x" => $x,
                    "y" => $y,
                    "z" => $z
                ];
                break;

            # can spawn diamond zone
            case "elite_bandit_diamond":
                $x = mt_rand(256, 1790);
                $z = mt_rand(-511, 511);
                $y = EmporiumCore::getInstance()->getServer()->getWorldManager()->getWorldByName("world")->getHighestBlockAt($x, $z) + 1;
                $position = [
                    "x" => $x,
                    "y" => $y,
                    "z" => $z
                ];
                break;

            default:
                $position = [
                    "x" => 0,
                    "y" => 0,
                    "z" => 0
                ];
                break;
        }

        return $position;
    }
}