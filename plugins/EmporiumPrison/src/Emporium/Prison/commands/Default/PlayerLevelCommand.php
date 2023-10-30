<?php

namespace Emporium\Prison\commands\Default;

use Emporium\Prison\EmporiumPrison;

use Emporium\Prison\Variables;
use EmporiumData\PermissionsManager;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;

class PlayerLevelCommand extends Command {

    public function __construct() {
        parent::__construct("level", "Opens Player Level Form", "/level", ["level", "pl"]);
        $this->setPermission("emporiumprison.command.playerlevel");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {

        if(!$sender instanceof Player) {
            return;
        }

        $permission = PermissionsManager::getInstance()->checkPermission($sender->getXuid(), $this->getPermissions());
        if(!$permission) {
            $sender->sendMessage(Variables::NO_PERMISSION_MESSAGE);
            return;
        }

        $playerLevel = EmporiumPrison::getInstance()->getPlayerLevelMenu();
        $playerLevel->open($sender);
    }
}