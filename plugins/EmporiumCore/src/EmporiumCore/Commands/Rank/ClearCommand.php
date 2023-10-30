<?php

namespace EmporiumCore\Commands\Rank;

use EmporiumCore\Variables;
use EmporiumData\DataManager;
use EmporiumData\PermissionsManager;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;

class ClearCommand extends Command {

    private array $subcommands = ["hand", "inv"];

    public function __construct() {
        parent::__construct("clear", "Clear a players inventory.", "/clear [hand/inv]", ["c"]);
        $this->setPermission("emporiumcore.command.clear");
    }

    # Command Code
    public function execute(CommandSender $sender, string $commandLabel, array $args): void {

        if(!$sender instanceof Player) {
            return;
        }

        # check command cooldown
        $cooldown = DataManager::getInstance()->getPlayerData($sender->getXuid(), $this->getPermissions()[0]);
        if($cooldown > 0) {
            $sender->sendMessage(\Emporium\Prison\Variables::PREFIX . "You can use this again in $cooldown seconds");
            return;
        }

        # set command cooldown (10 seconds)
        DataManager::getInstance()->setPlayerData($sender->getXuid(), "cooldown.command.clear", 60);

        $permission = PermissionsManager::getInstance()->checkPermission($sender->getXuid(), $this->getPermissions());
        if (!$permission) {
            $sender->sendMessage(\Emporium\Prison\Variables::NO_PERMISSION_MESSAGE);
            return;
        }

        if(!isset($args[0])) {
            $sender->sendMessage(\Emporium\Prison\Variables::PREFIX . "Usage: " . $this->getUsage());
            return;
        }
        $subcommand = strtolower($args[0]);

        if(!in_array($subcommand, $this->subcommands)) {
            $sender->sendMessage(\Emporium\Prison\Variables::PREFIX . "Usage: /clear <hand/inv>");
            return;
        }

        if (strtolower($args[0]) === "hand") {
            $hand = $sender->getInventory()->getItemInHand();
            $sender->getInventory()->remove($hand);
            $sender->sendMessage(TF::BOLD . TF::GREEN . "(!) " . TF::RESET . TF::GREEN . "Successfully cleared your hand.");
            return;
        }
        if (strtolower($args[0]) === "inv") {
            $sender->getOffHandInventory()->clearAll();
            $sender->getArmorInventory()->clearAll();
            $sender->getInventory()->clearAll();
            $sender->sendMessage(TF::BOLD . TF::GREEN . "(!) " . TF::RESET . TF::GREEN . "Successfully cleared your inventory.");
        }
    }

}