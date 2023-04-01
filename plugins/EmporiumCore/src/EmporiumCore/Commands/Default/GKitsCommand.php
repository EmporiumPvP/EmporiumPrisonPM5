<?php

namespace EmporiumCore\Commands\Default;

use EmporiumCore\EmporiumCore;
use EmporiumData\PermissionsManager;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;

class GKitsCommand extends Command implements Listener {

    public function __construct() {
        parent::__construct("gkits", "Opens the GKitsForms menu", "/gkits", ["gkit"]);
        $this->setPermission("emporiumcore.command.gkits");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {

        if(!$sender instanceof Player) {
            return false;
        }

        $permission = PermissionsManager::getInstance()->checkPermission($sender->getXuid(), "emporiumcore.command.gkits");
        if (!$permission) {
            $sender->sendMessage(TextFormat::RED . "No permission");
            return false;
        }

        # send form
        $menu = EmporiumCore::getInstance()->getGkitsMenu();
        $menu->open($sender);
        return true;
    }

} # END OF CLASS