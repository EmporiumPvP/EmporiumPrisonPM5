<?php

namespace Emporium\Prison\commands\Staff;

use Emporium\Prison\EmporiumPrison;
use Emporium\Prison\tasks\NPCUpdateTask;
use Emporium\Prison\Variables;

use EmporiumData\PermissionsManager;

use JonyGamesYT9\EntityAPI\entity\EntityFactory;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;

class NPCCommand extends Command {

    private array $parameters =[
        "update",
        "spawn",
        "delete"
    ];

    private array $npcs = [
        "tourguide",
        "oreexchanger",
        "blacksmith",
        "tinkerer",
        "enchanter",
        "playerprestige",
        "pickaxeprestige",
        "chef",
        "auctioneer",
        "captain",
        "banker"
    ];

    public function __construct() {
        parent::__construct("npc", "Main NPC Command", TF::GRAY . "/npc [update] | [spawn/delete] [entity]");
        $this->setPermission("emporiumprison.command.npc");
        $this->setPermissionMessage(TF::BOLD . TF::RED . "(!) " . TF::RED . "No permission");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {

        if(!$sender instanceof Player) {
            return;
        }

        $permission = PermissionsManager::getInstance()->checkPermission($sender->getXuid(), "emporiumprison.command.npc");
        if(!$permission) {
            $sender->sendMessage($this->getPermissionMessage());
        }

        if(!isset($args[0])) {
            $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "invalid usage");
            $sender->sendMessage($this->getUsage());
            return;
        }

        $parameter = strtolower($args[0]);

        if(!in_array($parameter, $this->parameters)) {
            $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "invalid usage");
            $sender->sendMessage($this->getUsage());
            return;
        }

        if($parameter === "update") {
            EmporiumPrison::getInstance()->getScheduler()->scheduleTask(new NPCUpdateTask());
            $sender->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "All entities have been updated!");
            return;
        }

        if(!isset($args[1])) {
            $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "please specify an NPC");
            return;
        }
        $npc = strtolower($args[1]);

        if(!in_array($npc, $this->npcs)) {
            $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "invalid NPC");
            return;
        }

        if($parameter === "spawn") {
            switch($npc) {

                case "tourguide":
                    EntityFactory::getInstance()->create($sender->getLocation(), $sender->getSkin() , "tourguide", 1);
                    $sender->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have spawned " . TF::YELLOW . "Tour Guide");
                    break;

                case "oreexchanger":
                    EntityFactory::getInstance()->create($sender->getLocation(), $sender->getSkin(), "oreexchanger", 1);
                    $sender->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have spawned " . TF::AQUA . "Ore Exchanger");
                    break;

                case "blacksmith":
                    EntityFactory::getInstance()->create($sender->getLocation(), $sender->getSkin(), "blacksmith", 1);
                    $sender->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have spawned " . TF::DARK_GRAY . "Blacksmith");
                    break;

                case "tinkerer":
                    EntityFactory::getInstance()->create($sender->getLocation(), $sender->getSkin(), "tinkerer", 1);
                    $sender->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have spawned " . TF::DARK_AQUA . "EmporiumTinker");
                    break;

                case "enchanter":
                    EntityFactory::getInstance()->create($sender->getLocation(), $sender->getSkin(), "enchanter", 1);
                    $sender->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have spawned " . TF::DARK_PURPLE . "Enchanter");
                    break;

                case "playerprestige":
                    EntityFactory::getInstance()->create($sender->getLocation(), $sender->getSkin(), "player_prestige", 1);
                    $sender->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have spawned " . TF::RED . "Player Prestige");
                    break;

                case "pickaxeprestige":
                    EntityFactory::getInstance()->create($sender->getLocation(), $sender->getSkin(), "pickaxe_prestige", 1);
                    $sender->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have spawned " . TF::AQUA . "Pickaxe Prestige");
                    break;

                case "chef":
                    EntityFactory::getInstance()->create($sender->getLocation(), $sender->getSkin(), "chef", 1);
                    $sender->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have spawned " . TF::GOLD . "Chef");
                    break;

                case "auctioneer":
                    EntityFactory::getInstance()->create($sender->getLocation(), $sender->getSkin(),"auctioneer", 1);
                    $sender->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have spawned " . TF::GREEN . "Auctioneer");
                    break;

                case "captain":
                    EntityFactory::getInstance()->create($sender->getLocation(), $sender->getSkin(),"captain", 1);
                    $sender->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have spawned " . TF::LIGHT_PURPLE . "Ship Captain");
                    break;

                case "banker":
                    EntityFactory::getInstance()->create($sender->getLocation(), $sender->getSkin(),"banker", 1);
                    $sender->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have spawned " . TF::AQUA . "Banker");
                    break;
            }
        }

        if($parameter === "delete") {
            switch($npc) {

                case "tourguide":
                    EntityFactory::getInstance()->eliminate("tourguide", $sender->getPosition()->getWorld());
                    break;

                case "tutorialoreexchanger":
                    EntityFactory::getInstance()->eliminate("tutorialoreexchanger", $sender->getPosition()->getWorld());
                    break;

                case "tutorialforger":
                    EntityFactory::getInstance()->eliminate("tutorialblacksmith", $sender->getPosition()->getWorld());
                    break;

                case "oreexchanger":
                    EntityFactory::getInstance()->eliminate("oreexchanger", $sender->getPosition()->getWorld());
                    break;

                case "forger":
                    EntityFactory::getInstance()->eliminate("forger", $sender->getPosition()->getWorld());
                    break;

                case "blacksmith":
                    EntityFactory::getInstance()->eliminate("blacksmith", $sender->getPosition()->getWorld());
                    break;

                case "chef":
                    EntityFactory::getInstance()->eliminate("chef", $sender->getPosition()->getWorld());
                    break;

                case "auctioneer":
                    EntityFactory::getInstance()->eliminate("auctioneer", $sender->getPosition()->getWorld());
                    break;

                case "blackmarket":
                    EntityFactory::getInstance()->eliminate("blackmarket", $sender->getPosition()->getWorld());
                    break;

                case "captain":
                    EntityFactory::getInstance()->eliminate("captain", $sender->getPosition()->getWorld());
                    break;

                case "banker":
                    EntityFactory::getInstance()->eliminate("banker", $sender->getPosition()->getWorld());
                    break;
            }
        }
    }
}