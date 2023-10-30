<?php

namespace Emporium\Prison\tasks\Events;

use Emporium\Prison\EmporiumPrison;
use EmporiumCore\EmporiumCore;
use EmporiumCore\Listeners\WebhookEvent;

use EmporiumData\ServerManager;

use pocketmine\scheduler\Task;
use pocketmine\Server;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat as TF;

class PrisonBreakTask extends Task
{

    private Config $prisonBreakData;

    public function __construct()
    {
        $this->prisonBreakData = new Config(EmporiumCore::getInstance()->getDataFolder() . "events/PrisonBreak.yml");
    }

    public function onRun(): void
    {
        # increment timer
        ServerManager::getInstance()->setData("events.prison_break", ServerManager::getInstance()->getData("events.prison_break") + 1);

        $seconds = ServerManager::getInstance()->getData("events.prison_break");
        $minute = $seconds / 60;

        /*
         * start event
         * every 3 hours
         */
        if($minute == 60 * 3) {

            EmporiumPrison::getInstance()->getScheduler()->scheduleRepeatingTask(new PrisonBreakBar(), 20);
            # send messages
            $messages = [
                TF::BOLD . TF::GOLD . "(!) The " . TF::RED . "Prison break Event " . TF::GOLD . "has started!" . TF::EOL,
                TF::BOLD . TF::GOLD . "The event will finish in 15 minutes." . TF::EOL,
                TF::EOL,
                TF::BOLD . TF::RED . "Prison Break", TF::GREEN . "Mine in any Tier Mine to obtain Loot!" . TF::EOL
            ];
            $message = implode(" ", $messages);

            Server::getInstance()->broadcastMessage($message);

            # create event file
            ServerManager::getInstance()->setData("events.prison_break-enabled", true);
            new Config(EmporiumCore::getInstance()->getDataFolder() . "events\PrisonBreak.json", Config::YAML);

            # send webhook
            WebhookEvent::EventsWebhook("PrisonBreak");
        }

        /*
         * end event
         * 15 minutes later
         */
        if($minute == (60 * 3) + 15) {

            # end event
            ServerManager::getInstance()->setData("events.prison_break-enabled", false);

            # create results message
            $message = TF::BOLD . TF::GOLD . "(!) The " . TF::RED . "Prison break Event " . TF::GOLD . "has ended!" . TF::EOL;
            $message .= TF::BOLD . TF::DARK_AQUA . "The Top 5 Prisoners are:" . TF::EOL;

            $place = 1;

            $eventData = [];

            foreach ($this->prisonBreakData->getAll() as $playerData => $playerPoints) {
                $eventData[$playerData] = $playerPoints;
            }
            arsort($eventData);

            foreach ($eventData as $playerData => $playerPoints) {
                if ($place > 5) break;
                $message .= TF::BOLD . TF::DARK_AQUA . "$playerData: " . TF::GOLD . $playerPoints . " points" . TF::EOL;
                $place++;
            }

            # broadcast message
            EmporiumCore::getInstance()->getServer()->broadcastMessage($message);

            # delete events file
            unlink(EmporiumCore::getInstance()->getDataFolder() . "events/PrisonBreak.json");

            # reset timer
            ServerManager::getInstance()->setData("events.prison_break", 0);
        }
    }
}