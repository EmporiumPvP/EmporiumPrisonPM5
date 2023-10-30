<?php

namespace Emporium\Prison\commands\Staff;

use Emporium\Prison\EmporiumPrison;
use Emporium\Prison\Managers\misc\Translator;
use Emporium\Prison\Variables;

use EmporiumData\PermissionsManager;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\console\ConsoleCommandSender;
use pocketmine\player\Player;

use pocketmine\utils\TextFormat as TF;

class EnergyCommand extends Command {

    public function __construct() {
        parent::__construct("energy", "Main energy Command", "/energy give <amount> <player>");
        $this->setPermission("emporiumprison.command.energy");
    }

    /**
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args) {

        # bandit kill reward
        if($sender instanceof ConsoleCommandSender) {
            if(!isset($args[0])) return;
            $parmeter = strtolower($args[0]);

            if(!$parmeter == "give") return;

            if(!isset($args[1])) return;
            $banditRarity = strtolower($args[1]);

            if(!isset($args[2])) return;
            $target = EmporiumPrison::getInstance()->getServer()->getPlayerExact($args[2]);

            switch ($banditRarity) {
                case "CoalBandit":
                    $amount = mt_rand(5000, 10000);
                    $target->getInventory()->addItem(EmporiumPrison::getInstance()->getOrbs()->EnergyOrb($amount));
                    break;
                case "GoldBandit":
                    $amount = mt_rand(10000, 15000);
                    $target->getInventory()->addItem(EmporiumPrison::getInstance()->getOrbs()->EnergyOrb($amount));
                    break;
                case "IronBandit":
                    $amount = mt_rand(15000, 20000);
                    $target->getInventory()->addItem(EmporiumPrison::getInstance()->getOrbs()->EnergyOrb($amount));
                    break;
                case "DiamondBandit":
                    $amount = mt_rand(20000, 25000);
                    $target->getInventory()->addItem(EmporiumPrison::getInstance()->getOrbs()->EnergyOrb($amount));
                    break;
            }
            return;
        }

        if(!$sender instanceof Player) return;

        # check permission
        $permission = PermissionsManager::getInstance()->checkPermission($sender->getXuid(), $this->getPermissions());
        if(!$permission) {
            $sender->sendMessage(Variables::NO_PERMISSION_MESSAGE);
            return;
        }

        # parameter check
        if(!isset($args[0])) {
            $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "Usage:");
            $sender->sendMessage($this->getUsage());
            return;
        }
        $parmeter = strtolower($args[0]);

        if(!$parmeter == "give") {
            $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "invalid usage");
            $sender->sendMessage($this->getUsage());
            return;
        }

        # amount check
        if(!isset($args[1])) {
            $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "Please specify an amount.");
            return;
        }
        $amount = $args[1];

        if(!is_numeric($amount)) {
            $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "Amount needs to be numerical");
            return;
        }

        if($amount > 2000000000) {
            $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You can not give more than " . Translator::shortNumber(2000000000) . " energy.");
            return;
        }

        # target check
        if(!isset($args[2])) {
            return;
        }
        $target = EmporiumPrison::getInstance()->getServer()->getPlayerExact($args[2]);

        if(!$target instanceof Player) {
            $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "That player is not online");
            return;
        }

        # give the orb
        if($target->getInventory()->canAddItem(EmporiumPrison::getInstance()->getOrbs()->EnergyOrb($amount))) {
            $target->getInventory()->addItem((EmporiumPrison::getInstance()->getOrbs())->EnergyOrb($amount));
        } else {
            $target->getWorld()->dropItem($target->getPosition(), EmporiumPrison::getInstance()->getOrbs()->EnergyOrb($amount));
        }
        $target->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You received an Energy Orb");
    }
}