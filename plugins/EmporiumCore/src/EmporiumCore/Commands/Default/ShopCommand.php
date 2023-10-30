<?php

namespace EmporiumCore\Commands\Default;

use Emporium\Prison\EmporiumPrison;
use Emporium\Prison\Variables;
use EmporiumData\DataManager;
use EmporiumData\PermissionsManager;
use pocketmine\command\{Command, CommandSender};
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;
use pocketmine\world\Position;

class ShopCommand extends Command {

    public function __construct() {
        parent::__construct("shop", "Travel to the Shop", "/shop", ["market", "store"]);
        $this->setPermission("emporiumcore.command.shop");
    }

    # Command Code
    public function execute(CommandSender $sender, string $commandLabel, array $args): void {

        if(!$sender instanceof Player) {
            return;
        }

        $permission = PermissionsManager::getInstance()->checkPermission($sender->getXuid(), $this->getPermissions());
        if (!$permission) {
            $sender->sendMessage(Variables::NO_PERMISSION_MESSAGE);
            return;
        }

        $cooldown = DataManager::getInstance()->getPlayerData($sender->getXuid(), "cooldown.command.shop");
        if($cooldown > 0) {
            $sender->sendMessage(Variables::PREFIX . "You can use this in $cooldown seconds");
            return;
        }

        $tutorialComplete = DataManager::getInstance()->getPlayerData($sender->getXuid(), "profile.tutorial-complete");
        if($tutorialComplete) {
            $sender->teleport(new Position(-1585.5, 170, -317.5, EmporiumPrison::getInstance()->getServer()->getWorldManager()->getWorldByName("world")));
            return;
        }

        $sender->sendMessage(Variables::PREFIX . "You need to complete the tutorial to use that");
    }

}