<?php

namespace EmporiumCore\Commands\Default;

use EmporiumCore\EmporiumCore;
use EmporiumData\PermissionsManager;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;

# POCKETMINE

class KitsCommand extends Command {

    public function __construct() {
        parent::__construct("kits", "Opens the Kits Menu", "/kits", ["kit"]);
        $this->setPermission("emporiumcore.command.kits");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {

        if(!$sender instanceof Player) {
            return false;
        }

        $permission = PermissionsManager::getInstance()->checkPermission($sender->getXuid(), "emporiumcore.command.kits");
        if (!$permission) {
            $sender->sendMessage(TextFormat::RED . "No permission");
            return false;
        }

        $menu = EmporiumCore::getInstance()->getKitsMenu();
        $extraData = $sender->getPlayerInfo()->getExtraData();
        if($extraData)
        $menu->open($sender);
        return true;
    }
}