<?php

namespace Emporium\Prison\commands\Default;

use Emporium\Prison\Variables;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;

class PlayerPrestigeCommand extends Command {

    public function __construct() {
        parent::__construct("prestige", "Main command to prestige", "/prestige");
        $this->setPermission("emporiumprison.command.prestige");
        $this->setPermissionMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "No permission");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {

        if(!$sender instanceof Player) {
            return;
        }

        /*
        $permission = DataManager::getData($sender, "Permissions", "emporiumprison.command.prestige");
        if ($permission === false) {
            $sender->sendMessage(TextFormat::RED . "No permission");
            return false;
        }
        */

        /*
         * TODO
         *
         * Check if player is level 100
         * if true
         * player attribute selection
         * reset stats
         *
         */
        $sender->sendMessage(TF::RED . "This feature is still under development, please visit the NPC at /spawn");
    }
}