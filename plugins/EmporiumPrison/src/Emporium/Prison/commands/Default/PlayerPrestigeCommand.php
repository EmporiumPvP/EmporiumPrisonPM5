<?php

namespace Emporium\Prison\commands\Default;

use Emporium\Prison\Variables;

use EmporiumData\PermissionsManager;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;

class PlayerPrestigeCommand extends Command {

    public function __construct() {
        parent::__construct("prestige", "Main command to prestige", "/prestige");
        $this->setPermission("emporiumprison.command.prestige");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): void {

        if(!$sender instanceof Player) {
            return;
        }


        $permission = PermissionsManager::getInstance()->checkPermission($sender->getXuid(), $this->getPermissions());
        if ($permission === false) {
            $sender->sendMessage(Variables::NO_PERMISSION_MESSAGE);
            return;
        }


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