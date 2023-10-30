<?php

namespace EmporiumCore\Commands\Default;

use Emporium\Prison\Variables;
use EmporiumCore\EmporiumCore;
use EmporiumData\PermissionsManager;
use pocketmine\command\{Command, CommandSender};
use pocketmine\player\Player;

class CustomEnchantShopCommand extends Command {

    # Command Constructor
    public function __construct() {
        parent::__construct("ceshop", "Purchase custom enchants from the shop.", "/ceshop", ["cs"]);
        $this->setPermission("emporiumcore.command.ceshop");
    }

    # Command Code
    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {

        if (!$sender instanceof Player) return false;

        $permission = PermissionsManager::getInstance()->checkPermission($sender->getXuid(), $this->getPermissions());
        if (!$permission) {
            $sender->sendMessage(Variables::NO_PERMISSION_MESSAGE);
            return false;
        }

        // Execute Command
        $menu = EmporiumCore::getInstance()->getCustomEnchantMenu();
        $menu->open($sender);
        return true;
    }
}