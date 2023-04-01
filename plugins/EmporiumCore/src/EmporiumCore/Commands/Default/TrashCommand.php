<?php

namespace EmporiumCore\Commands\Default;

use EmporiumData\PermissionsManager;
use muqsit\invmenu\InvMenu;
use muqsit\invmenu\type\InvMenuTypeIds;
use pocketmine\command\{Command, CommandSender};
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;

class TrashCommand extends Command {

    public function __construct() {
        parent::__construct("trash", "Throw away unwanted items.", "/trash", ["dispose"]);
        $this->setPermission("emporiumcore.command.trash");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {

        if(!$sender instanceof Player) {
            return false;
        }

        $permission = PermissionsManager::getInstance()->checkPermission($sender->getXuid(), "emporiumcore.command.trash");
        if (!$permission) {
            $sender->sendMessage(TextFormat::RED . "No permission");
            return false;
        }

        $menu = InvMenu::create(InvMenuTypeIds::TYPE_DOUBLE_CHEST);
        $menu->setName("§l§9Trash");
        $menu->send($sender);
        return true;
    }
}