<?php

namespace Emporium\Prison\commands\Staff;

use Emporium\Prison\items\Orbs;

use Emporium\Prison\EmporiumPrison;

use Emporium\Prison\Managers\misc\Translator;

use Emporium\Prison\Variables;

use EmporiumCore\managers\data\DataManager;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\player\Player;

use pocketmine\utils\TextFormat as TF;

class EnergyCommand extends Command {

    public function __construct() {
        parent::__construct("energy", "Main energy Command", "/energy give <amount> <player>");
        $this->setPermission("emporiumprison.command.energy");
        $this->setPermissionMessage(Variables::ERROR_PREFIX . TF::RED . "No permission.");
    }

    /**
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args) {

        if(!$sender instanceof Player) {
            return;
        }

        $permission = DataManager::getData($sender, "Permissions", "emporiumprison.command.energy");
        if(!$permission) {
            $sender->sendMessage($this->getPermissionMessage());
            return;
        }

        $usage = $this->getUsage();
        
        if(isset($args[0])) {
            $parmeter = $args[0];
            if(isset($args[1])) {
                $amount = $args[1];
                if($amount <= 2000000000) {
                    if(isset($args[2])) {
                        $target = EmporiumPrison::getInstance()->getServer()->getPlayerExact($args[2]);
                        if($target instanceof Player) {
                            if($parmeter === "give") {
                                $target->getInventory()->addItem((new Orbs())->EnergyOrb($amount));
                            } else {
                                $sender->sendMessage(Variables::ERROR_PREFIX . TF::GRAY . $this->getUsage());
                            }
                        } else {
                            $sender->sendMessage(Variables::ERROR_PREFIX . "That player does not exist.");
                        }
                    } else {
                        $sender->sendMessage(Variables::ERROR_PREFIX . "Please specify a player.");
                    }
                } else {
                    $sender->sendMessage(Variables::ERROR_PREFIX . "You can not give more than " . Translator::shortNumber(2000000000) . " energy.");
                }
            } else {
                $sender->sendMessage(Variables::ERROR_PREFIX . "Please specify an amount.");
            }
        } else {
            $sender->sendMessage(Variables::ERROR_PREFIX . "Usage:");
            $sender->sendMessage($usage);
        }
    }
}