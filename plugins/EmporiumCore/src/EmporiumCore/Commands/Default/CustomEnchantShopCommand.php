<?php

namespace EmporiumCore\Commands\Default;

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

        // Check Player
        if (!$sender instanceof Player) {
            $sender->sendMessage("§cYou may only run this command in-game!");
            return false;
        }

        $permission = PermissionsManager::getInstance()->checkPermission($sender->getXuid(), "emporiumcore.command.ceshop");
        // Check for Permissions
        if (!$permission) {
            $sender->sendMessage("§cYou do not have permission to use this command.");
            return false;
        }

        // Execute Command
        $menu = EmporiumCore::getInstance()->getCustomEnchantMenu();
        $menu->open($sender);
        return true;
    }
}