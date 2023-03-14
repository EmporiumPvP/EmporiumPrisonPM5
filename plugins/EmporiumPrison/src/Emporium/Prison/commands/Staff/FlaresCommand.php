<?php

namespace Emporium\Prison\commands\Staff;

use Emporium\Prison\items\Flares;

use Emporium\Prison\EmporiumPrison;
use Emporium\Prison\Variables;

use EmporiumCore\managers\data\DataManager;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\player\Player;

use pocketmine\utils\TextFormat as TF;

class FlaresCommand extends Command {

    public function __construct() {
        parent::__construct("flare", "Main flare Command", "/flare give <player> <type> <rarity>");
        $this->setPermission("emporiumprison.command.flare");
        $this->setPermissionMessage(Variables::ERROR_PREFIX . TF::RED . "No permission!");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {

        if(!$sender instanceof Player) {
            return;
        }

        $permission = DataManager::getData($sender, "Permissions", "emporiumprison.command.flare");
        if(!$permission) {
            $sender->sendMessage($this->getPermissionMessage());
        }

        $usage = $this->getUsage();
        # give
        if(isset($args[0])) {
            $parmeter = $args[0];

            # player
            if(isset($args[1])) {
                $target = EmporiumPrison::getInstance()->getServer()->getPlayerExact($args[1]);

                # flare type
                if(isset($args[2])) {
                    $type = $args[2];

                    # type rarity
                    if(isset($args[3])) {
                        $rarity = $args[3];
                        # check if player is online
                        if($target instanceof Player) {
                            if($parmeter === "give") {
                                if($type === "meteor") {
                                    switch($rarity) {

                                        case "elite":
                                            $target->getInventory()->addItem((new Flares())->EliteMeteor());
                                            $target->sendMessage(Variables::SERVER_PREFIX . "You have received an " . TF::BLUE . "Elite Meteor Flare");
                                            break;

                                        case "ultimate":
                                            $target->getInventory()->addItem((new Flares())->UltimateMeteor());
                                            $target->sendMessage(Variables::SERVER_PREFIX . "You have received an " . TF::YELLOW . "Ultimate Meteor Flare");
                                            break;

                                        case "legendary":
                                            $target->getInventory()->addItem((new Flares())->LegendaryMeteor());
                                            $target->sendMessage(Variables::SERVER_PREFIX . "You have received a " . TF::GOLD . "Legendary Meteor Flare");
                                            break;

                                        case "godly":
                                            $target->getInventory()->addItem((new Flares())->GodlyMeteor());
                                            $target->sendMessage(Variables::SERVER_PREFIX . "You have received a " . TF::LIGHT_PURPLE . "Godly Meteor Flare");
                                            break;

                                        case "heroic":
                                            $target->getInventory()->addItem((new Flares())->HeroicMeteor());
                                            $target->sendMessage(Variables::SERVER_PREFIX . "You have received a " . TF::RED . "Heroic Meteor Flare");
                                            break;

                                        case "vulkarion":
                                            $target->getInventory()->addItem((new Flares())->heroicVulkarion());
                                            $target->sendMessage(Variables::SERVER_PREFIX . "You have received a " . TF::DARK_RED . "Heroic Vulkarion G-Kit Flare");
                                            break;

                                        case "zenith":
                                            $target->getInventory()->addItem((new Flares())->heroicZenith());
                                            $target->sendMessage(Variables::SERVER_PREFIX . "You have received a " . TF::GOLD . "Heroic Zenith G-Kit Flare");
                                            break;

                                        case "colossus":
                                            $target->getInventory()->addItem((new Flares())->heroicColossus());
                                            $target->sendMessage(Variables::SERVER_PREFIX . "You have received a " . TF::WHITE . "Heroic Colossus G-Kit Flare");
                                            break;

                                        case "warlock":
                                            $target->getInventory()->addItem((new Flares())->heroicWarlock());
                                            $target->sendMessage(Variables::SERVER_PREFIX . "You have received a " . TF::DARK_PURPLE . "Heroic Warlock G-Kit Flare");
                                            break;

                                        case "slaughter":
                                            $target->getInventory()->addItem((new Flares())->heroicSlaughter());
                                            $target->sendMessage(Variables::SERVER_PREFIX . "You have received a " . TF::RED . "Heroic Slaughter G-Kit Flare");
                                            break;

                                        case "enchanter":
                                            $target->getInventory()->addItem((new Flares())->heroicEnchanter());
                                            $target->sendMessage(Variables::SERVER_PREFIX . "You have received a " . TF::AQUA . "Heroic Enchanter G-Kit Flare");
                                            break;

                                        case "atheos":
                                            $target->getInventory()->addItem((new Flares())->heroicAtheos());
                                            $target->sendMessage(Variables::SERVER_PREFIX . "You have received a " . TF::GRAY . "Heroic Atheos G-Kit Flare");
                                            break;

                                        case "iapetus":
                                            $target->getInventory()->addItem((new Flares())->heroicIapetus());
                                            $target->sendMessage(Variables::SERVER_PREFIX . "You have received a " . TF::BLUE . "Heroic Iapetus G-Kit Flare");
                                            break;

                                        case "broteas":
                                            $target->getInventory()->addItem((new Flares())->heroicBroteas());
                                            $target->sendMessage(Variables::SERVER_PREFIX . "You have received a " . TF::GREEN . "Heroic Broteas G-Kit Flare");
                                            break;

                                        case "ares":
                                            $target->getInventory()->addItem((new Flares())->heroicAres());
                                            $target->sendMessage(Variables::SERVER_PREFIX . "You have received a " . TF::GOLD . "Heroic Ares G-Kit Flare");
                                            break;

                                        case "grimreaper":
                                            $target->getInventory()->addItem((new Flares())->heroicGrimReaper());
                                            $target->sendMessage(Variables::SERVER_PREFIX . "You have received a " . TF::RED . "Heroic Grim Reaper G-Kit Flare");
                                            break;

                                        case "executioner":
                                            $target->getInventory()->addItem((new Flares())->heroicExecutioner());
                                            $target->sendMessage(Variables::SERVER_PREFIX . "You have received a " . TF::DARK_RED . "Heroic Executioner G-Kit Flare");
                                            break;

                                        case "blacksmith":
                                            $target->getInventory()->addItem((new Flares())->blacksmith());
                                            $target->sendMessage(Variables::SERVER_PREFIX . "You have received a " . TF::DARK_GRAY . "Blacksmith G-Kit Flare");
                                            break;

                                        case "hero":
                                            $target->getInventory()->addItem((new Flares())->blacksmith());
                                            $target->sendMessage(Variables::SERVER_PREFIX . "You have received a " . TF::WHITE . "Hero G-Kit Flare");
                                            break;

                                        case "cyborg":
                                            $target->getInventory()->addItem((new Flares())->cyborg());
                                            $target->sendMessage(Variables::SERVER_PREFIX . "You have received a " . TF::DARK_AQUA . "Cyborg G-Kit Flare");
                                            break;

                                        case "crucible":
                                            $target->getInventory()->addItem((new Flares())->crucible());
                                            $target->sendMessage(Variables::SERVER_PREFIX . "You have received a " . TF::YELLOW . "Crucible G-Kit Flare");
                                            break;

                                        case "hunter":
                                            $target->getInventory()->addItem((new Flares())->hunter());
                                            $target->sendMessage(Variables::SERVER_PREFIX . "You have received a " . TF::AQUA . "Hunter G-Kit Flare");
                                            break;

                                        default:
                                            $sender->sendMessage(Variables::ERROR_PREFIX . "Usage:");
                                            $sender->sendMessage($usage);
                                            break;
                                    }
                                }
                            } else {
                                $sender->sendMessage(Variables::ERROR_PREFIX . "Usage:");
                                $sender->sendMessage($usage);
                            }
                        } else {
                            $sender->sendMessage(Variables::ERROR_PREFIX . "That player does not exist.");
                        }

                    } else {
                        $sender->sendMessage(Variables::ERROR_PREFIX . "Usage:");
                        $sender->sendMessage($usage);
                    }
                } else {
                    $sender->sendMessage(Variables::ERROR_PREFIX . "Please specify a type.");
                }
            } else {
                $sender->sendMessage(Variables::ERROR_PREFIX . "Please specify a player.");
            }
        } else {
            $sender->sendMessage(Variables::ERROR_PREFIX . "Usage:");
            $sender->sendMessage($usage);
        }
    }

}