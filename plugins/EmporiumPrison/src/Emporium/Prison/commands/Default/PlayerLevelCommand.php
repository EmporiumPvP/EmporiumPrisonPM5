<?php

namespace Emporium\Prison\commands\Default;

use Emporium\Prison\EmporiumPrison;

use EmporiumData\PermissionsManager;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;

class PlayerLevelCommand extends Command {

    public function __construct() {
        parent::__construct("level", "Opens Player Level Form", "/level", ["level", "pl"]);
        $this->setPermission("emporiumprison.command.playerlevel");
        $this->setPermissionMessage(TF::BOLD . TF::RED . "(!) " . TF::RED . "No permission");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {

        if(!$sender instanceof Player) {
            return;
        }

        $permission = PermissionsManager::getInstance()->checkPermission($sender->getXuid(), "emporiumprison.command.playerlevel");
        if(!$permission) {
            return;
        }

        $playerLevel = EmporiumPrison::getInstance()->getPlayerLevelMenu();
        $playerLevel->open($sender);
    }
}