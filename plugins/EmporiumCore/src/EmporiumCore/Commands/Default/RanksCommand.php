<?php

namespace EmporiumCore\Commands\Default;

use EmporiumCore\EmporiumCore;

use EmporiumData\DataManager;
use EmporiumData\PermissionsManager;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;

class RanksCommand extends Command {

    public array $ranks = [
        "player",
        "noble",
        "imperial",
        "supreme",
        "majesty",
        "emperor",
        "president",
        "trial",
        "builder",
        "helper",
        "mod",
        "admin",
        "developer",
        "manager",
        "owner",
        "founder"
        ];

    public function __construct() {
        parent::__construct("ranks", "Main ranks command", "/ranks | set [player] [rank]");
        $this->setPermission("emporiumcore.command.ranks");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {

        if(!$sender instanceof Player) {
            $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "Only use this in game");
            return;
        }

        $permission = PermissionsManager::getInstance()->checkPermission($sender->getXuid(), "emporiumcore.command.ranks");
        if(!$permission) {
            $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "No permission");
            return;
        }

        # parameter
        # send ranks list
        if(!isset($args[0])) {
            $sender->sendMessage(TF::BOLD . TF::GOLD . "<" . TF::RESET . TF::DARK_GRAY . "----- " . TF::BOLD . TF::YELLOW . "Ranks " . TF::RESET . TF::DARK_GRAY . "-----" . TF::BOLD . TF::GOLD . ">");
            $sender->sendMessage(TF::YELLOW . "Below is the list of Player Ranks.");
            $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "* " . TF::RESET . TF::GRAY . "Noble");
            $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "* " . TF::RESET . TF::GRAY . "Imperial");
            $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "* " . TF::RESET . TF::GRAY . "Supreme");
            $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "* ". TF::RESET . TF::GRAY . "Majesty");
            $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "* ". TF::RESET . TF::GRAY . "Emperor");
            $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "* ". TF::RESET . TF::GRAY . "President");
            $sender->sendMessage(TF::YELLOW . "Below is the list of staff Ranks.");
            $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "* ". TF::RESET . TF::GRAY . "Trial");
            $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "* ". TF::RESET . TF::GRAY . "Builder");
            $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "* ". TF::RESET . TF::GRAY . "Helper");
            $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "* ". TF::RESET . TF::GRAY . "Mod");
            $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "* ". TF::RESET . TF::GRAY . "Admin");
            $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "* ". TF::RESET . TF::GRAY . "Developer");
            $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "* ". TF::RESET . TF::GRAY . "Manager");
            $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "* ". TF::RESET . TF::GRAY . "Owner");
            $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "* ". TF::RESET . TF::GRAY . "Founder");
            $sender->sendMessage(TF::BOLD . TF::GOLD . "<" . TF::RESET . TF::DARK_GRAY . "§r§8-----------------" . TF::BOLD . TF::GOLD . ">");
            return;
        }
        $parameter = strtolower($args[0]);

        if(!$parameter == "set") {
            $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "Invalid usage");
            $sender->sendMessage($this->getUsage());
            return;
        }

        # player
        if(!isset($args[1])) {
            $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "Invalid usage");
            $sender->sendMessage($this->getUsage());
            return;
        }
        $target = EmporiumCore::getInstance()->getServer()->getPlayerExact($args[1]);

        if(!$target instanceof Player) {
            $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "That player is not online");
            return;
        }

        # rank to set
        if(!isset($args[2])) {
            $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "Invalid usage");
            $sender->sendMessage($this->getUsage());
            return;
        }
        $rank = strtolower($args[2]);

        if(!in_array($rank, $this->ranks)) {
            $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "That rank does not exist!");
            $sender->sendMessage("Here is a list of ranks on the server");
            $sender->sendMessage("§r ");
            $sender->sendMessage(TF::BOLD . TF::GOLD . "<" . TF::RESET . TF::DARK_GRAY . "----- " . TF::BOLD . TF::YELLOW . "Ranks " . TF::RESET . TF::DARK_GRAY . "-----" . TF::BOLD . TF::GOLD . ">");
            $sender->sendMessage(TF::YELLOW . "Below is the list of Player Ranks.");
            $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "* " . TF::RESET . TF::GRAY . "Noble");
            $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "* " . TF::RESET . TF::GRAY . "Imperial");
            $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "* " . TF::RESET . TF::GRAY . "Supreme");
            $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "* ". TF::RESET . TF::GRAY . "Majesty");
            $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "* ". TF::RESET . TF::GRAY . "Emperor");
            $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "* ". TF::RESET . TF::GRAY . "President");
            $sender->sendMessage(TF::YELLOW . "Below is the list of staff Ranks.");
            $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "* ". TF::RESET . TF::GRAY . "Trial");
            $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "* ". TF::RESET . TF::GRAY . "Builder");
            $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "* ". TF::RESET . TF::GRAY . "Helper");
            $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "* ". TF::RESET . TF::GRAY . "Mod");
            $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "* ". TF::RESET . TF::GRAY . "Admin");
            $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "* ". TF::RESET . TF::GRAY . "Developer");
            $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "* ". TF::RESET . TF::GRAY . "Manager");
            $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "* ". TF::RESET . TF::GRAY . "Owner");
            $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "* ". TF::RESET . TF::GRAY . "Founder");
            $sender->sendMessage(TF::BOLD . TF::GOLD . "<" . TF::RESET . TF::DARK_GRAY . "§r§8-----------------" . TF::BOLD . TF::GOLD . ">");
        }

        # set players rank
        if($parameter == "set") {
            DataManager::getInstance()->setPlayerData($target->getXuid(), "profile.rank", $rank);
            switch($rank) {
                case "player":
                    DataManager::getInstance()->setPlayerData($target->getXuid(), "profile.rank_format", TF::BOLD . TF::DARK_GRAY . "<" . TF::RESET . TF::GRAY . "Player" . TF::BOLD . TF::DARK_GRAY . ">" . TF::RESET);
                    break;
                case "noble":
                    DataManager::getInstance()->setPlayerData($target->getXuid(), "profile.rank_format", TF::BOLD . TF::GRAY . "<" . TF::RESET . TF::DARK_GRAY . "Noble" . TF::BOLD . TF::GRAY . ">" . TF::RESET);
                    break;
                case "imperial":
                    DataManager::getInstance()->setPlayerData($target->getXuid(), "profile.rank_format", TF::BOLD . TF::DARK_PURPLE . "<" . TF::RESET . TF::LIGHT_PURPLE . "Imperial" . TF::BOLD . TF::DARK_PURPLE . ">" . TF::RESET);
                    break;
                case "supreme":
                    DataManager::getInstance()->setPlayerData($target->getXuid(), "profile.rank_format", TF::BOLD . TF::AQUA . "<" . TF::RESET . TF::DARK_AQUA . "Supreme" . TF::BOLD . TF::AQUA . ">" . TF::RESET);
                    break;
                case "majesty":
                    DataManager::getInstance()->setPlayerData($target->getXuid(), "profile.rank_format", TF::BOLD . TF::LIGHT_PURPLE . "<" . TF::RESET . TF::DARK_PURPLE . "Majesty" . TF::BOLD . TF::LIGHT_PURPLE . ">" . TF::RESET);
                    break;
                case "emperor":
                    DataManager::getInstance()->setPlayerData($target->getXuid(), "profile.rank_format", TF::BOLD . TF::YELLOW . "<" . TF::RESET . TF::AQUA . "Emperor" . TF::BOLD . TF::YELLOW . ">" . TF::RESET);
                    break;
                case "president":
                    DataManager::getInstance()->setPlayerData($target->getXuid(), "profile.rank_format", TF::BOLD . TF::DARK_RED . "<" . TF::RESET . TF::RED . "President" . TF::BOLD . TF::DARK_RED . ">" . TF::RESET);
                    break;
                case "trial":
                    DataManager::getInstance()->setPlayerData($target->getXuid(), "profile.rank_format", TF::BOLD . TF::DARK_GRAY . "[" . TF::RESET . TF::GRAY . "Trial-Mod" . TF::BOLD . TF::DARK_GRAY . "]" . TF::RESET);
                    break;
                case "builder":
                    DataManager::getInstance()->setPlayerData($target->getXuid(), "profile.rank_format", TF::BOLD . TF::DARK_BLUE . "[" . TF::RESET . TF::BLUE . "Builder" . TF::BOLD . TF::DARK_BLUE . "]" . TF::RESET);
                    break;
                case "helper":
                    DataManager::getInstance()->setPlayerData($target->getXuid(), "profile.rank_format", TF::BOLD . TF::GOLD . "[" . TF::RESET . TF::YELLOW . "Helper" . TF::BOLD . TF::GOLD . "]" . TF::RESET);
                    break;
                case "mod":
                    DataManager::getInstance()->setPlayerData($target->getXuid(), "profile.rank_format", TF::BOLD . TF::DARK_GREEN . "[" . TF::RESET . TF::GREEN . "Mod" . TF::BOLD . TF::DARK_GREEN . "]" . TF::RESET);
                    break;
                case "admin":
                    DataManager::getInstance()->setPlayerData($target->getXuid(), "profile.rank_format", TF::BOLD . TF::RED . "[" . TF::RESET . TF::DARK_RED . "Admin" . TF::BOLD . TF::RED . "]" . TF::RESET);
                    break;
                case "developer":
                    DataManager::getInstance()->setPlayerData($target->getXuid(), "profile.rank_format", TF::BOLD . TF::AQUA . "[" . TF::RESET . TF::DARK_AQUA . "Developer" . TF::BOLD . TF::AQUA . "]" . TF::RESET);
                    break;
                case "manager":
                    DataManager::getInstance()->setPlayerData($target->getXuid(), "profile.rank_format", TF::BOLD . TF::BLUE . "[" . TF::RESET . TF::DARK_BLUE . "Manager" . TF::BOLD . TF::BLUE . "]" . TF::RESET);
                    break;
                case "owner":
                    DataManager::getInstance()->setPlayerData($target->getXuid(), "profile.rank_format", TF::BOLD . TF::DARK_RED . "[" . TF::RESET . TF::RED . "OWNER" . TF::BOLD . TF::DARK_RED . "]" . TF::RESET);
                    break;
                case "founder":
                    DataManager::getInstance()->setPlayerData($target->getXuid(), "profile.rank_format", TF::BOLD . TF::DARK_GRAY . "[" . TF::RESET . TF::BLACK . "Founder" . TF::BOLD . TF::DARK_GRAY . "]" . TF::RESET);
                    break;
            }
            $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::GRAY . "You have set " . TF::AQUA . "$args[1]'s " . TF::GRAY . "rank to " . TF::AQUA . "$rank");
        }
    }
}