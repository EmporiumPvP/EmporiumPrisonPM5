<?php

namespace EmporiumCore\Commands\Staff;

use EmporiumCore\EmporiumCore;
use EmporiumCore\Variables;
use EmporiumData\PermissionsManager;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;
use pocketmine\world\Position;

class TeleportCommand extends Command {

    public function __construct() {
        parent::__construct("teleport", "Teleport a player to you or teleport to a player.", "/teleport <option> <player>", ["tp"]);
        $this->setPermission("emporiumcore.command.teleport");
    }

    # Command Code
    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {

        if(!$sender instanceof Player) {
            return false;
        }

        $permission = PermissionsManager::getInstance()->checkPermission($sender->getXuid(),  ["emporiumcore.command.teleport"]);
        if (!$permission) {
            $sender->sendMessage(\Emporium\Prison\Variables::NO_PERMISSION_MESSAGE);
            return false;
        }

        if (isset($args[0])) {
            $option = strtolower($args[0]);
            if ($option === "to" || $option === "here" || $option === "coordinates" || $option === "coords") {
                if (isset($args[1])) {
                    if ($option === "to" || $option === "here") {
                        $player = EmporiumCore::getInstance()->getServer()->getPlayerExact($args[1]);
                        if ($player instanceof Player) {
                            switch($option) {
                                case "to":
                                    $sender->teleport($player->getLocation());
                                    $sender->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "have teleported to {$player->getName()}.");
                                    break;

                                case "here":
                                    $player->teleport($sender->getLocation());
                                    $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have teleported to {$sender->getName()}.");
                                    $sender->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have teleported {$player->getName()} to you.");
                                    break;
                            }
                        } else {
                            $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "That player cannot be found.");
                            return false;
                        }
                    } elseif ($option === "coordinates" || $option === "coords") {
                        if (isset($args[1])) {
                            if (!is_numeric($args[1])) {
                                $args[1] = 0;
                            }
                            if (isset($args[2])) {
                                if (!is_numeric($args[2])) {
                                    $args[2] = 0;
                                }
                                if (isset($args[3])) {
                                    if (!is_numeric($args[3])) {
                                        $args[3] = 0;
                                    }
                                    $x = $args[1] + 0;
                                    $y = $args[2] + 0;
                                    $z = $args[3] + 0;
                                    $world = $sender->getWorld();
                                    $sender->teleport(new Position($x, $y, $z, $world));
                                    $sender->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have teleported to $x, $y, $z.");
                                    return true;
                                } else {
                                    $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "Usage: /teleport coordinates <x> <y> <z>");
                                    return false;
                                }
                            } else {
                                $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "Usage: /teleport coordinates <x> <y> <z>");
                                return false;
                            }
                        } else {
                            $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "Usage: /teleport coordinates <x> <y> <z>");
                            return false;
                        }
                    }
                } else {
                    $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "Usage: /teleport <option> <player>");
                    return false;
                }
            } else {
                $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "That is an invalid option.");
                $sender->sendMessage(TF::GRAY . "Please use one of the following options:");
                $sender->sendMessage(TF::GRAY . "- /teleport to <player>");
                $sender->sendMessage(TF::GRAY . "- /teleport here <player>");
                $sender->sendMessage(TF::GRAY . "- /teleport coordinates <coordinates>");
                return false;
            }
        }
        $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "Usage: /teleport <option> <player>");
        return false;
    }

}