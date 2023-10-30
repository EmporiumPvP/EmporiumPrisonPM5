<?php

namespace EmporiumCore\Commands\Staff;

use Emporium\Prison\EmporiumPrison;
use EmporiumCore\EmporiumCore;
use EmporiumData\PermissionsManager;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;
use pocketmine\utils\TextFormat as TF;

class ContrabandCommand extends Command {

    public function __construct() {
        parent::__construct("contraband", "Main contraband command");
        $this->setUsage("/contraband [rarity] | [player]");
        $this->setPermission("emporiumcore.command.contraband");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {

        if(!$sender instanceof Player) {
            return;
        }

        $permission = PermissionsManager::getInstance()->checkPermission($sender->getXuid(), ["emporiumcore.command.contraband"]);
        if(!$permission) {
            $sender->sendMessage(TextFormat::RED . "No permission");
            return;
        }

        if(isset($args[0])) {
            $rarity = $args[0];
            if(isset($args[1])) {
                $target = EmporiumCore::getInstance()->getServer()->getPlayerExact($args[1]);
                if($target instanceof Player) {
                    switch($rarity) {

                        case "elite":
                            $target->getInventory()->addItem(EmporiumPrison::getInstance()->getContraband()->Elite(1));
                            break;

                        case "ultimate":
                            $target->getInventory()->addItem(EmporiumPrison::getInstance()->getContraband()->Ultimate(1));
                            break;

                        case "legendary":
                            $target->getInventory()->addItem(EmporiumPrison::getInstance()->getContraband()->Legendary(1));
                            break;

                        case "godly":
                            $target->getInventory()->addItem(EmporiumPrison::getInstance()->getContraband()->Godly(1));
                            break;

                        case "heroic":
                            $target->getInventory()->addItem(EmporiumPrison::getInstance()->getContraband()->Heroic(1));
                            break;
                    }
                } else {
                    $sender->sendMessage(TF::BOLD . "That player is not online");
                }
            } else {
                switch($rarity) {

                    case "elite":
                        $sender->getInventory()->addItem(EmporiumPrison::getInstance()->getContraband()->Elite(1));
                        break;

                    case "ultimate":
                        $sender->getInventory()->addItem(EmporiumPrison::getInstance()->getContraband()->Ultimate(1));
                        break;

                    case "legendary":
                        $sender->getInventory()->addItem(EmporiumPrison::getInstance()->getContraband()->Legendary(1));
                        break;

                    case "Godly":
                        $sender->getInventory()->addItem(EmporiumPrison::getInstance()->getContraband()->Godly(1));
                        break;

                    case "heroic":
                        $sender->getInventory()->addItem(EmporiumPrison::getInstance()->getContraband()->Heroic(1));
                        break;
                }
            }
        } else {
            $sender->sendMessage($this->getUsage());
        }
    }
}