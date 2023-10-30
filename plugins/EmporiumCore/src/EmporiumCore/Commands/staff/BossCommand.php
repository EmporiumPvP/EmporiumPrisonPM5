<?php

namespace EmporiumCore\Commands\Staff;

use diamondgold\MiniBosses\Main;
use Emporium\Prison\EmporiumPrison;
use Emporium\Prison\tasks\TeleportTask;
use Emporium\Prison\Variables;
use EmporiumCore\Listeners\WebhookEvent;
use EmporiumData\PermissionsManager;
use EmporiumData\Provider\JsonProvider;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;
use pocketmine\world\Position;

class BossCommand extends Command
{

    private array $bosses = [
        "coal_bandit", "apollo", "poseidon", "zeus", "hades"
    ];

    public function __construct()
    {
        parent::__construct("boss", "main boss command", "/boss [info/spawn] [boss]");
        $this->setPermission("emporiumcore.command.boss");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {

        if (!$sender instanceof Player) {
            return;
        }

        if(!isset($args[0])) {
            $position = new Position(65, 126, 26, EmporiumPrison::getInstance()->getServer()->getWorldManager()->getWorldByName("BossArena"));
            EmporiumPrison::getInstance()->getScheduler()->scheduleRepeatingTask(new TeleportTask($sender, $position, 10), 20);
            return;
        }
        $parameter = strtolower($args[0]);

        if(!isset($args[1])) {
            $sender->sendMessage($this->getUsage());
        }

        switch($parameter) {

            case "info":
                EmporiumPrison::getInstance()->getBossInfo()->Menu($sender);
                break;

            case "spawn":
                $permission = PermissionsManager::getInstance()->checkPermission($sender->getXuid(), ["emporiumcore.command.spawnboss"]);
                if (!$permission) {
                    $sender->sendMessage(Variables::NO_PERMISSION_MESSAGE);
                    return;
                }

                if(!isset($args[1])) {
                    $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "Please specify a boss to spawn");
                    return;
                }
                $boss = strtolower($args[1]);

                if (!in_array($boss, $this->bosses)) {
                    $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "That boss does not exist");
                    return;
                }

                $data = file_get_contents(JsonProvider::$SERVER_FOLDER . "boss/drops_" . str_replace(" ", "-", strtolower($boss)) . ".txt");
                $items = explode(" ", $data);

                Main::getInstance()->spawnBoss($boss, ["drops" => array_rand($items)]);
                EmporiumPrison::getInstance()->getServer()->broadcastMessage(TF::BOLD . TF::DARK_GRAY . "(" . TF::RED . "!" . TF::DARK_GRAY . ") " . TF::RESET . TF::GRAY . "The " . TF::RED . ucfirst($boss) . TF::GRAY . " Boss has spawned, join " . TF::GREEN . "/boss" . TF::GRAY . " to kill him for rewards");

                # send webhook
                WebhookEvent::EventsWebhook("Boss", $boss);
                break;
        }
    }

}