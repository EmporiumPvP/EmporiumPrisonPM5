<?php

namespace Emporium\Prison\commands\Default;

use Emporium\Prison\Variables;

use EmporiumCore\Managers\Data\DataManager;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;

class PickaxePrestigeCommand extends Command {

    public function __construct() {
        parent::__construct("pickaxeprestige", "Main command to prestige pickaxe", "/pickaxeprestige", ["pprestige", "pp"]);
        $this->setPermission("emporiumprison.command.pickaxeprestige");
        $this->setPermissionMessage(Variables::ERROR_PREFIX . TF::RED . "No permission.");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {

        if(!$sender instanceof Player) {
            return;
        }

        /*
        $permission = DataManager::getData($sender, "Permissions", "emporiumprison.command.pickaxeprestige");
        if ($permission === false) {
            $sender->sendMessage(TF::RED . "No permission");
            return false;
        }
        */

        /*
         * TODO
         *
         * Check if player pickaxe is level 100
         * if true
         * pickaxe attribute selection
         * reset stats
         * remove enchants
         *
         */
        $sender->sendMessage(TF::RED . "This feature is still under development");
    }
}