<?php

namespace Tetro\EmporiumTinker\commands;

use EmporiumData\PermissionsManager;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;

use Tetro\EmporiumTinker\Tinker;

class TinkerCommand extends Command {

    public function __construct() {
        parent::__construct("tinker", "Check a players balance.", "/EmporiumTinker");
        $this->setPermission("emporiumtinker.command.tinker");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {

        if (!$sender instanceof Player) {
            return;
        }

        $permission = PermissionsManager::getInstance()->checkPermission($sender->getXuid(), $this->getPermissions());
        if (!$permission) {
            $sender->sendMessage(TF::RED . "You need a higher rank to use that, please visit the EmporiumTinker at " . TF::AQUA . "/shop");
            return;
        }

        $menu = Tinker::getInstance()->getTinkerMenu();
        $menu->Menu($sender);
    }
}