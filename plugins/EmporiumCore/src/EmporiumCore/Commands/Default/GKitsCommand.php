<?php

namespace EmporiumCore\Commands\Default;

use Emporium\Prison\Variables;
use EmporiumCore\EmporiumCore;
use EmporiumData\PermissionsManager;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\player\Player;

class GKitsCommand extends Command implements Listener {

    public function __construct() {
        parent::__construct("gkits", "Opens the GKitsForms menu", "/gkits", ["gkit"]);
        $this->setPermission("emporiumcore.command.gkits");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {

        if(!$sender instanceof Player) {
            return false;
        }

        $permission = PermissionsManager::getInstance()->checkPermission($sender->getXuid(), $this->getPermissions());
        if (!$permission) {
            $sender->sendMessage(Variables::NO_PERMISSION_MESSAGE);
            return false;
        }

        # send form
        $menu = EmporiumCore::getInstance()->getGkitsMenu();
        $menu->open($sender);
        return true;
    }

} # END OF CLASS