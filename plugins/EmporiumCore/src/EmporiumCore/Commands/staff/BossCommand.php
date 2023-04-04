<?php

namespace EmporiumCore\Commands\Staff;

use diamondgold\MiniBosses\Main;

use Emporium\Prison\EmporiumPrison;
use EmporiumData\PermissionsManager;

use EmporiumData\Provider\JsonProvider;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\data\bedrock\LegacyItemIdToStringIdMap;
use pocketmine\item\Item;
use pocketmine\item\VanillaItems;
use pocketmine\nbt\LittleEndianNbtSerializer;
use pocketmine\nbt\TreeRoot;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;

class BossCommand extends Command {

    # need to make these -> "iron_bandit", "lapis_bandit", "redstone_bandit", "gold_bandit", "diamond_bandit", "emerald_bandit", "elite_bandit",

    private array $bosses = [
        "coal_bandit", "apollo", "poseidon", "zeus", "hades"
    ];

    public function __construct() {
        parent::__construct("boss", "main boss command", "/boss");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {

        if(!$sender instanceof Player) {
            return;
        }

        $permission = PermissionsManager::getInstance()->checkPermission($sender->getXuid(), "emporiumcore.command.boss");
        if(!$permission) {
            $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "No permission");
            return;
        }

        /*
         * TODO
         *
         * create menu which shows all bosses and when they will next spawn (none admin command)
         *
         * add args to spawn specific boss
         * add args to remove boss
         *
         */

        if(!isset($args[0])) {
            $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "Please specify a boss to spawn");
            return;
        }
        $boss = strtolower($args[0]);

        if(!in_array($boss, $this->bosses)) {
            $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "That boss does not exist");
            return;
        }

        $data = file_get_contents(JsonProvider::$SERVER_FOLDER . "boss/drops_" . str_replace(" ", "-", strtolower($boss)) . ".txt");

        Main::getInstance()->spawnBoss($boss, ["drops" => explode(" ", ($items = explode(" ", $data))[mt_rand(0, count($items) - 1)])]);
        EmporiumPrison::getInstance()->getServer()->broadcastMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "The " . TF::LIGHT_PURPLE . ucfirst($boss) . TF::RED . " Boss has spawned, join /boss to kill him for rewards");
    }
}