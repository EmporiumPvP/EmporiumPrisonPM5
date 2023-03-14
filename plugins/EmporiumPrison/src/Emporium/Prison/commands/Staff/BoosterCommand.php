<?php

namespace Emporium\Prison\commands\Staff;

use Emporium\Prison\items\Boosters;
use Emporium\Prison\EmporiumPrison;
use Emporium\Prison\Managers\EnergyManager;
use Emporium\Prison\Managers\MiningManager;
use Emporium\Prison\Variables;

use EmporiumCore\EmporiumCore;
use EmporiumCore\managers\data\DataManager;
use JsonException;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;

use pocketmine\utils\TextFormat as TF;

class BoosterCommand extends Command {

    private Boosters $boosters;

    public function __construct() {
        parent::__construct("booster", "Main boosters command", "/booster <stop> <type> | <give> <type> <player> <multiplier>");
        $this->setPermission("emporiumprison.command.booster");
        $this->setPermissionMessage(Variables::ERROR_PREFIX . TF::RED . "No permission!");
        $this->boosters = EmporiumPrison::getBoosters();
    }

    /**
     * @throws JsonException
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args) {

        if(!$sender instanceof Player) {
            return;
        }


        $permission = DataManager::getData($sender, "Permissions", "emporiumprison.command.booster");
        if(!$permission) {
            $sender->sendMessage($this->getPermissionMessage());
        }

        if(isset($args[0])) {
            $parameter = $args[0];
            if($parameter === "give") {
                if(isset($args[1])) {
                    $type = $args[1];
                    if(isset($args[2])) {
                        $target = EmporiumCore::getInstance()->getServer()->getPlayerExact($args[2]);
                        if($target instanceof Player) {
                            switch($type) {

                                case "mysteryenergy": # /booster give mysteryenergy <player>
                                    if($target->getInventory()->canAddItem($this->boosters->MysteryEnergyBooster())) {
                                        $target->getInventory()->addItem($this->boosters->MysteryEnergyBooster());
                                        $target->sendMessage(Variables::SERVER_PREFIX . TF::GREEN . "You have received a ". TF::AQUA . "Mystery Energy Booster" . TF::GREEN . "!");
                                        $sender->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You gave $target a ". TF::AQUA . "Mystery Energy Booster" . TF::GREEN . "!");
                                    } else {
                                        $sender->sendMessage(TF::RED ."Players inventory is full");
                                    }
                                    break;

                                case "mysterymining": # /booster give mysterymining <player>
                                    if($target->getInventory()->canAddItem($this->boosters->MysteryMiningXpBooster())) {
                                        $target->getInventory()->addItem($this->boosters->MysteryMiningXpBooster());
                                        $target->sendMessage(Variables::SERVER_PREFIX . TF::GREEN . "You have received a ". TF::AQUA . "Mystery Mining Booster" . TF::GREEN . "!");
                                        $sender->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You gave $target a ". TF::AQUA . "Mystery Mining Booster" . TF::GREEN . "!");
                                    } else {
                                        $sender->sendMessage(TF::RED ."Players inventory is full");
                                    }
                                    break;

                                case "energy":
                                    if(isset($args[3])) {
                                        $multiplier = $args[3];
                                        switch($multiplier) {
                                            case 1.25:
                                                $target->getInventory()->addItem((new Boosters())->EnergyBooster($multiplier));
                                                $target->sendMessage(Variables::SERVER_PREFIX . TF::GREEN . "You have received a " . TF::WHITE . "1.25x " . TF::AQUA . "Energy Booster" . TF::GREEN . "!");
                                                break;

                                            case 1.5:
                                                $target->getInventory()->addItem((new Boosters())->EnergyBooster($multiplier));
                                                $target->sendMessage(Variables::SERVER_PREFIX . TF::GREEN . "You have received a " . TF::WHITE . "1.5x " . TF::AQUA . "Energy Booster" . TF::GREEN . "!");
                                                break;

                                            case 1.75:
                                                $target->getInventory()->addItem((new Boosters())->EnergyBooster($multiplier));
                                                $target->sendMessage(Variables::SERVER_PREFIX . TF::GREEN . "You have received a " . TF::WHITE . "1.75x " . TF::AQUA . "Energy Booster" . TF::GREEN . "!");
                                                break;

                                            case 2.0:
                                                $target->getInventory()->addItem((new Boosters())->EnergyBooster($multiplier));
                                                $target->sendMessage(Variables::SERVER_PREFIX . TF::GREEN . "You have received a " . TF::WHITE . "2x " . TF::AQUA . "Energy Booster" . TF::GREEN . "!");
                                                break;

                                            case 2.25:
                                                $target->getInventory()->addItem((new Boosters())->EnergyBooster($multiplier));
                                                $target->sendMessage(Variables::SERVER_PREFIX . TF::GREEN . "You have received a " . TF::WHITE . "2.25x " . TF::AQUA . "Energy Booster" . TF::GREEN . "!");
                                                break;

                                            case 2.5:
                                                $target->getInventory()->addItem((new Boosters())->EnergyBooster($multiplier));
                                                $target->sendMessage(Variables::SERVER_PREFIX . TF::GREEN . "You have received a " . TF::WHITE . "2.5x " . TF::AQUA . "Energy Booster" . TF::GREEN . "!");
                                                break;

                                            case 2.75:
                                                $target->getInventory()->addItem((new Boosters())->EnergyBooster($multiplier));
                                                $target->sendMessage(Variables::SERVER_PREFIX . TF::GREEN . "You have received a " . TF::WHITE . "2.75x " . TF::AQUA . "Energy Booster" . TF::GREEN . "!");
                                                break;

                                            case 3.0:
                                                $target->getInventory()->addItem((new Boosters())->EnergyBooster($multiplier));
                                                $target->sendMessage(Variables::SERVER_PREFIX . TF::GREEN . "You have received a " . TF::WHITE . "3x " . TF::AQUA . "Energy Booster" . TF::GREEN . "!");
                                                break;

                                            case 3.25:
                                                $target->getInventory()->addItem((new Boosters())->EnergyBooster($multiplier));
                                                $target->sendMessage(Variables::SERVER_PREFIX . TF::GREEN . "You have received a " . TF::WHITE . "3.25x " . TF::AQUA . "Energy Booster" . TF::GREEN . "!");
                                                break;

                                            case 3.5:
                                                $target->getInventory()->addItem((new Boosters())->EnergyBooster($multiplier));
                                                $target->sendMessage(Variables::SERVER_PREFIX . TF::GREEN . "You have received a " . TF::WHITE . "3.5x " . TF::AQUA . "Energy Booster" . TF::GREEN . "!");
                                                break;
                                        }
                                    } else {
                                        $sender->sendMessage(Variables::ERROR_PREFIX . "Please specify a multiplier!");
                                    }

                                    break;

                                case "mining":
                                    if(isset($args[3])) {
                                        $multiplier = $args[3];
                                        switch($multiplier) {
                                            case 1.25:
                                                $target->getInventory()->addItem((new Boosters())->MiningXpBooster($multiplier));
                                                $target->sendMessage(Variables::SERVER_PREFIX . TF::GREEN . "You have received a " . TF::WHITE . "1.25x " . TF::AQUA . "Mining Booster" . TF::GREEN . "!");
                                                break;

                                            case 1.5:
                                                $target->getInventory()->addItem((new Boosters())->MiningXpBooster($multiplier));
                                                $target->sendMessage(Variables::SERVER_PREFIX . TF::GREEN . "You have received a " . TF::WHITE . "1.5x " . TF::AQUA . "Mining Booster" . TF::GREEN . "!");
                                                break;

                                            case 1.75:
                                                $target->getInventory()->addItem((new Boosters())->MiningXpBooster($multiplier));
                                                $target->sendMessage(Variables::SERVER_PREFIX . TF::GREEN . "You have received a " . TF::WHITE . "1.75x " . TF::AQUA . "Mining Booster" . TF::GREEN . "!");
                                                break;

                                            case 2.0:
                                                $target->getInventory()->addItem((new Boosters())->MiningXpBooster($multiplier));
                                                $target->sendMessage(Variables::SERVER_PREFIX . TF::GREEN . "You have received a " . TF::WHITE . "2x " . TF::AQUA . "Mining Booster" . TF::GREEN . "!");
                                                break;

                                            case 2.25:
                                                $target->getInventory()->addItem((new Boosters())->MiningXpBooster($multiplier));
                                                $target->sendMessage(Variables::SERVER_PREFIX . TF::GREEN . "You have received a " . TF::WHITE . "2.25x " . TF::AQUA . "Mining Booster" . TF::GREEN . "!");
                                                break;

                                            case 2.5:
                                                $target->getInventory()->addItem((new Boosters())->MiningXpBooster($multiplier));
                                                $target->sendMessage(Variables::SERVER_PREFIX . TF::GREEN . "You have received a " . TF::WHITE . "2.5x " . TF::AQUA . "Mining Booster" . TF::GREEN . "!");
                                                break;

                                            case 2.75:
                                                $target->getInventory()->addItem((new Boosters())->MiningXpBooster($multiplier));
                                                $target->sendMessage(Variables::SERVER_PREFIX . TF::GREEN . "You have received a " . TF::WHITE . "2.75x " . TF::AQUA . "Mining Booster" . TF::GREEN . "!");
                                                break;

                                            case 3.0:
                                                $target->getInventory()->addItem((new Boosters())->MiningXpBooster($multiplier));
                                                $target->sendMessage(Variables::SERVER_PREFIX . TF::GREEN . "You have received a " . TF::WHITE . "3x " . TF::AQUA . "Mining Booster" . TF::GREEN . "!");
                                                break;

                                            case 3.25:
                                                $target->getInventory()->addItem((new Boosters())->MiningXpBooster($multiplier));
                                                $target->sendMessage(Variables::SERVER_PREFIX . TF::GREEN . "You have received a " . TF::WHITE . "3.25x " . TF::AQUA . "Mining Booster" . TF::GREEN . "!");
                                                break;

                                            case 3.5:
                                                $target->getInventory()->addItem((new Boosters())->MiningXpBooster($multiplier));
                                                $target->sendMessage(Variables::SERVER_PREFIX . TF::GREEN . "You have received a " . TF::WHITE . "3.5x " . TF::AQUA . "Mining Booster" . TF::GREEN . "!");
                                                break;
                                        }
                                    } else {
                                        $sender->sendMessage(Variables::ERROR_PREFIX . "Please specify a multiplier!");
                                    }

                                    break;

                                default:
                                    $sender->sendMessage(Variables::ERROR_PREFIX . "Unknown type!");
                                    $sender->sendMessage("");
                                    $sender->sendMessage(TF::GRAY . "Available:");
                                    $sender->sendMessage(TF::GRAY . " - mysteryenergy");
                                    $sender->sendMessage(TF::GRAY . " - energy");
                                    $sender->sendMessage(TF::GRAY . " - mysterymining");
                                    $sender->sendMessage(TF::GRAY . " - mining");
                                    break;
                            }
                        } else {
                            $sender->sendMessage(TF::RED . "That player is not online");
                        }
                    } else {
                        $sender->sendMessage(TF::RED . "Please specify a player");
                    }
                } else {
                    $sender->sendMessage(TF::RED . "Please specify a type!");
                }
            } elseif($parameter === "stop") {
                if(isset($args[1])) {
                    $type = $args[1];
                    switch($type) {

                        case "mining":
                            if(isset($args[2])) {
                                $target = EmporiumPrison::getInstance()->getServer()->getPlayerExact($args[2]);
                                if($target instanceof Player) {
                                    $miningManager = new MiningManager($target);
                                    $miningManager->stop();
                                }
                            }
                            break;

                        case "energy":
                            if(isset($args[2])) {
                                $target = EmporiumPrison::getInstance()->getServer()->getPlayerExact($args[2]);
                                if($target instanceof Player) {
                                    $energyManager = new EnergyManager($target);
                                    $energyManager->stop();
                                }
                            }
                            break;
                    }
                } else {
                    $sender->sendMessage(TF::RED . "Please select a Booster");
                }
            } else {
                $sender->sendMessage(Variables::ERROR_PREFIX . TF::RED . "Usage: " . TF::GRAY . "/booster <give> <type> <player> <multiplier>");
            }

        } else {
            $sender->sendMessage(Variables::ERROR_PREFIX . TF::RED . "Usage: " . TF::GRAY . "/booster <give> <type> <player> <multiplier>");
        }
    }
}