<?php

namespace EmporiumCore\Commands\Default;

use Emporium\Prison\Variables;
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
        if ($sender instanceof Player) {
            $permission = PermissionsManager::getInstance()->checkPermission($sender->getXuid(), $this->getPermissions());
            if(!$permission) {
                $sender->sendMessage(Variables::NO_PERMISSION_MESSAGE);
                return;
            }
        }


        # parameter
        # send ranks list
        if(!isset($args[0])) {
            $this->sendRankList($sender);
            return;
        }
        $parameter = strtolower($args[0]);

        if(!$parameter == "set") {
            $sender->sendMessage(Variables::PREFIX . "Invalid usage");
            $sender->sendMessage($this->getUsage());
            return;
        }

        # player
        if(!isset($args[1])) {
            $sender->sendMessage(Variables::PREFIX . "Invalid usage");
            $sender->sendMessage($this->getUsage());
            return;
        }
        $target = EmporiumCore::getInstance()->getServer()->getPlayerExact($args[1]);

        if(!$target instanceof Player) {
            $sender->sendMessage(Variables::PREFIX . "That player is not online");
            return;
        }

        # rank to set
        if(!isset($args[2])) {
            $sender->sendMessage(Variables::PREFIX . "Invalid usage");
            $sender->sendMessage($this->getUsage());
            return;
        }
        $rank = strtolower($args[2]);

        if(!in_array($rank, $this->ranks)) {
            $sender->sendMessage(Variables::PREFIX . "That rank does not exist!");
            $this->sendRankList($sender);
        }

        # set players rank
        if($parameter == "set") {
            DataManager::getInstance()->setPlayerData($target->getXuid(), "profile.rank", $rank);
            $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::GRAY . "You have set " . TF::AQUA . "$args[1]'s " . TF::GRAY . "rank to " . TF::AQUA . "$rank");
        }
    }

    public function sendRankList (Player $to) : void
    {
        $to->sendMessage("Here is a list of ranks on the server");
        $to->sendMessage("§r ");
        $to->sendMessage(TF::BOLD . TF::GOLD . "<" . TF::RESET . TF::DARK_GRAY . "----- " . TF::BOLD . TF::YELLOW . "Ranks " . TF::RESET . TF::DARK_GRAY . "-----" . TF::BOLD . TF::GOLD . ">");
        $to->sendMessage(TF::YELLOW . "Below is the list of Player Ranks.");
        $to->sendMessage(TF::BOLD . TF::DARK_GRAY . "* " . TF::RESET . TF::GRAY . "Noble");
        $to->sendMessage(TF::BOLD . TF::DARK_GRAY . "* " . TF::RESET . TF::GRAY . "Imperial");
        $to->sendMessage(TF::BOLD . TF::DARK_GRAY . "* " . TF::RESET . TF::GRAY . "Supreme");
        $to->sendMessage(TF::BOLD . TF::DARK_GRAY . "* ". TF::RESET . TF::GRAY . "Majesty");
        $to->sendMessage(TF::BOLD . TF::DARK_GRAY . "* ". TF::RESET . TF::GRAY . "Emperor");
        $to->sendMessage(TF::BOLD . TF::DARK_GRAY . "* ". TF::RESET . TF::GRAY . "President");
        $to->sendMessage(TF::YELLOW . "Below is the list of staff Ranks.");
        $to->sendMessage(TF::BOLD . TF::DARK_GRAY . "* ". TF::RESET . TF::GRAY . "Trial");
        $to->sendMessage(TF::BOLD . TF::DARK_GRAY . "* ". TF::RESET . TF::GRAY . "Builder");
        $to->sendMessage(TF::BOLD . TF::DARK_GRAY . "* ". TF::RESET . TF::GRAY . "Helper");
        $to->sendMessage(TF::BOLD . TF::DARK_GRAY . "* ". TF::RESET . TF::GRAY . "Mod");
        $to->sendMessage(TF::BOLD . TF::DARK_GRAY . "* ". TF::RESET . TF::GRAY . "Admin");
        $to->sendMessage(TF::BOLD . TF::DARK_GRAY . "* ". TF::RESET . TF::GRAY . "Developer");
        $to->sendMessage(TF::BOLD . TF::DARK_GRAY . "* ". TF::RESET . TF::GRAY . "Manager");
        $to->sendMessage(TF::BOLD . TF::DARK_GRAY . "* ". TF::RESET . TF::GRAY . "Owner");
        $to->sendMessage(TF::BOLD . TF::DARK_GRAY . "* ". TF::RESET . TF::GRAY . "Founder");
        $to->sendMessage(TF::BOLD . TF::GOLD . "<" . TF::RESET . TF::DARK_GRAY . "§r§8-----------------" . TF::BOLD . TF::GOLD . ">");
    }
}