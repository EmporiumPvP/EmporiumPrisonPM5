<?php

namespace Emporium\Prison\commands\Staff;

use Emporium\Prison\EmporiumPrison;
use Emporium\Prison\Variables;

use EmporiumData\PermissionsManager;

use JsonException;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;

class BoosterCommand extends Command {

    private array $multipliers = [
        1.25, 1.5, 1.75,
        2.0, 2.25, 2.5, 2.75,
        3.0, 3.25, 3.5
    ];
    public function __construct() {
        parent::__construct("booster", "Main boosters command", TF::GRAY . "/booster <stop> | <give> <type> <player> <multiplier>");
        $this->setPermission("emporiumprison.command.booster");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {

        if(!$sender instanceof Player) {
            return;
        }

        # permission check
        $permission = PermissionsManager::getInstance()->checkPermission($sender->getXuid(), $this->getPermissions());
        if(!$permission) {
            $sender->sendMessage(Variables::NO_PERMISSION_MESSAGE);
        }

        # parameter
        if(!isset($args[0])) {
            $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "invalid usage");
            $sender->sendMessage($this->getUsage());
            return;
        }
        $parameter = strtolower($args[0]);

        # booster type
        if(!isset($args[1])) {
            $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "invalid usage");
            $sender->sendMessage(TF::RED . "Please specify a type!");
            return;
        }
        $type = strtolower($args[1]);

        # player to give booster
        if(!isset($args[2])) {
            $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "invalid usage");
            $sender->sendMessage(TF::RED . "Please specify a player");
            return;
        }

        $target = EmporiumPrison::getInstance()->getServer()->getPlayerExact($args[2]);
        if(!$target instanceof Player) {
            $sender->sendMessage(TF::RED . "That player is not online");
            return;
        }

        # parameter check
        if(!$parameter == "give" || !$parameter == "stop") {
            $sender->sendMessage("test");
            $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "invalid usage");
            $sender->sendMessage($this->getUsage());
            return;
        }

        # give player a booster
        if($parameter === "give") {
            switch($type) {

                case "mysteryenergy":
                    if($target->getInventory()->canAddItem(EmporiumPrison::getInstance()->getBoosters()->MysteryEnergyBooster())) {
                        $target->getInventory()->addItem(EmporiumPrison::getInstance()->getBoosters()->MysteryEnergyBooster());
                        $target->sendMessage(Variables::SERVER_PREFIX . TF::GREEN . "You have received a ". TF::AQUA . "Mystery Energy Booster" . TF::GREEN . "!");
                        $sender->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You gave " . $target->getName() . "  a ". TF::AQUA . "Mystery Energy Booster" . TF::GREEN . "!");
                    } else {
                        $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "Players inventory is full");
                    }
                    break;

                case "mysterymining":
                    if($target->getInventory()->canAddItem(EmporiumPrison::getInstance()->getBoosters()->MysteryMiningXpBooster())) {
                        $target->getInventory()->addItem(EmporiumPrison::getInstance()->getBoosters()->MysteryMiningXpBooster());
                        $target->sendMessage(Variables::SERVER_PREFIX . TF::GREEN . "You have received a ". TF::AQUA . "Mystery Mining Booster" . TF::GREEN . "!");
                        $sender->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You gave " . $target->getName() . " a ". TF::AQUA . "Mystery Mining Booster" . TF::GREEN . "!");
                    } else {
                        $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "Players inventory is full");
                    }
                    break;

                case "energy":
                    if(!isset($args[3])) {
                        $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "Please specify a multiplier!");
                        return;
                    }

                    if(!is_numeric($args[3])) {
                        $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "Multiplier needs to be numerical");
                        return;
                    }

                    if(!in_array($args[3], $this->multipliers)) {
                        $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "That is not a valid multiplier");
                        return;
                    }
                    $multiplier = floatval($args[3]);

                    if($target->getInventory()->canAddItem(EmporiumPrison::getInstance()->getBoosters()->EnergyBooster($multiplier))) {
                        $target->getInventory()->addItem(EmporiumPrison::getInstance()->getBoosters()->EnergyBooster($multiplier));
                    } else {
                        $target->getWorld()->dropItem($target->getPosition(), EmporiumPrison::getInstance()->getBoosters()->EnergyBooster($multiplier));
                    }
                    $target->sendMessage(Variables::SERVER_PREFIX . TF::GREEN . "You have received a " . TF::WHITE . $multiplier . "x " . TF::AQUA . "Energy Booster" . TF::GREEN . "!");
                    break;

                case "mining":
                    if(!isset($args[3])) {
                        $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "Please specify a multiplier!");
                        return;
                    }

                    if(!is_numeric($args[3])) {
                        $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "Multiplier needs to be numerical");
                        return;
                    }

                    if(!in_array($args[3], $this->multipliers)) {
                        $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "That is not a valid multiplier");
                        return;
                    }
                    $multiplier = floatval($args[3]);

                    if($target->getInventory()->canAddItem(EmporiumPrison::getInstance()->getBoosters()->MiningXpBooster($multiplier))) {
                        $target->getInventory()->addItem(EmporiumPrison::getInstance()->getBoosters()->MiningXpBooster($multiplier));
                    } else {
                        $target->getWorld()->dropItem($target->getPosition(), EmporiumPrison::getInstance()->getBoosters()->MiningXpBooster($multiplier));
                    }
                    $target->sendMessage(Variables::SERVER_PREFIX . TF::GREEN . "You have received a " . TF::WHITE . $multiplier . "x " . TF::AQUA . "Mining Booster" . TF::GREEN . "!");
                    break;

                default:
                    $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "Unknown type");
                    $sender->sendMessage("");
                    $sender->sendMessage(TF::GRAY . "Available:");
                    $sender->sendMessage(TF::GRAY . " - mysteryenergy");
                    $sender->sendMessage(TF::GRAY . " - energy");
                    $sender->sendMessage(TF::GRAY . " - mysterymining");
                    $sender->sendMessage(TF::GRAY . " - mining");
                    break;
            }
        }

        # stop players booster
        if($parameter === "stop") {
            switch($type) {

                case "mining":
                    $miningManager = EmporiumPrison::getInstance()->getMiningManager();$miningManager->stop($sender);
                    break;

                case "energy":
                    $energyManager = EmporiumPrison::getInstance()->getEnergyManager();
                    $energyManager->stop($sender);
                    break;

                default:
                    $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "Unknown type");
                    $sender->sendMessage("");
                    $sender->sendMessage(TF::GRAY . "Available:");
                    $sender->sendMessage(TF::GRAY . " - mining");
                    $sender->sendMessage(TF::GRAY . " - energy");
                    break;

            }
        }
    }
}