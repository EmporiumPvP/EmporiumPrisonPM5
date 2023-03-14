<?php

namespace EmporiumCore\Commands\Default;

use Emporium\Prison\EmporiumPrison;

use Emporium\Prison\Variables;
use pocketmine\player\Player;
use pocketmine\command\{Command, CommandSender};

use EmporiumCore\Managers\Data\DataManager;

use pocketmine\utils\TextFormat as TF;
use pocketmine\world\Position;

class ShopCommand extends Command {

    public function __construct() {
        parent::__construct("shop", "Travel to the Shop", "/shop", ["market", "store"]);
        $this->setPermission("emporiumcore.command.shop");
    }

    # Command Code
    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {

        if(!$sender instanceof Player) {
            return false;
        }

        $permission = DataManager::getData($sender, "Permissions", "emporiumcore.command.shop");
        if ($permission === false) {
            $sender->sendMessage(TF::RED . "No permission");
            return false;
        }

        $tutorialComplete = \Emporium\Prison\Managers\DataManager::getData($sender, "Players", "tutorial-complete");

        if($tutorialComplete) {
            $sender->teleport(new Position(-1585.5, 170, -317.5, EmporiumPrison::getInstance()->getServer()->getWorldManager()->getWorldByName("world")));
            return true;
        } else {
            $sender->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You need to complete the tutorial to use that");
            return false;
        }
    }

}