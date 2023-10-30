<?php

namespace Emporium\Prison\commands\Default;

use Emporium\Prison\EmporiumPrison;
use Emporium\Prison\Variables;

use EmporiumData\PermissionsManager;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;
use pocketmine\world\sound\PopSound;

use Tetro\EmporiumTutorial\EmporiumTutorial;

class MinesCommand extends Command {

    private array $mines = [
        "coal",
        "iron",
        "lapis",
        "redstone",
        "gold",
        "diamond",
        "emerald"
    ];

    public function __construct() {
        parent::__construct("mines", "Opens the Mine Menu", "/mines", ["mm", "mine"]);
        $this->setPermission("emporiumprison.command.mines");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): void {

        if(!$sender instanceof Player) return;

        # permission check
        if(!PermissionsManager::getInstance()->checkPermission($sender->getXuid(), $this->getPermissions())) {
            $sender->sendMessage(Variables::NO_PERMISSION_MESSAGE);
            return;
        }

        $menu = EmporiumPrison::getInstance()->getMines();

        # tutorial progress
        if (EmporiumTutorial::getInstance()->getTutorialManager()->checkPlayerTutorialComplete($sender) === false) {
            $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You need to complete the tutorial to use that");
            $sender->broadcastSound(new PopSound(1), [$sender]);
            return;
        }

        # open mines menu
        if (empty($args)) {
            $menu->open($sender);
            return;
        }

        # parameter check
        $parameter = strtolower($args[0]);

        if(!$parameter == "info") {
            $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "(" . TF::RED . "!" . TF::DARK_GRAY . ") " . TF::RESET . TF::RED . "invalid usage");
            $sender->sendMessage(TF::GRAY . "/mines | info [mine]");
            return;
        }

        # mine check
        if(!isset($args[1])) {
            $menu->MinesInfoForm($sender);
            return;
        }
        $mine = strtolower($args[1]);

        if(!in_array($mine, $this->mines)) {
            $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "(" . TF::RED . "!" . TF::DARK_GRAY . ") " . TF::RESET . TF::RED . "that mine does not exist");
            $sender->sendMessage(TF::GRAY . "Available mines:");
            $sender->sendMessage(TF::GRAY . "Coal");
            $sender->sendMessage(TF::GRAY . "Iron");
            $sender->sendMessage(TF::GRAY . "Lapis");
            $sender->sendMessage(TF::GRAY . "Redstone");
            $sender->sendMessage(TF::GRAY . "Gold");
            $sender->sendMessage(TF::GRAY . "Diamond");
            $sender->sendMessage(TF::GRAY . "Emerald");
            return;
        }

        switch($mine) {
            case "coal":
                $menu->coalMineInfo($sender);
                break;

            case "iron":
                $menu->ironMineInfo($sender);
                break;

            case "redstone":
                $menu->redstoneMineInfo($sender);
                break;

            case "lapis":
                $menu->lapisMineInfo($sender);
                break;

            case "gold":
                $menu->goldMineInfo($sender);
                break;

            case "diamond":
                $menu->diamondMineInfo($sender);
                break;

            case "emerald":
                $menu->emeraldMineInfo($sender);
                break;

            default:
                $sender->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "That mine does not exist" . TF::EOL . TF::EOL . "Here are a list of available Mines:\n - Coal\n - Iron\n - Lapis\n - Redstone\n - Gold\n - Diamond\n - Emerald");
                break;
        }
    }
}