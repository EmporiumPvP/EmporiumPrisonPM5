<?php

namespace EmporiumCore\Commands\Default;

use EmporiumData\DataManager;
use EmporiumData\PermissionsManager;

use pocketmine\command\{Command, CommandSender};
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;

class GambleCommand extends Command {

    public function __construct() {
        parent::__construct("gamble", "Gamble your money.", "/gamble");
        $this->setPermission("emporiumcore.command.gamble");
    }

    # Command Code

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {

        if (!$sender instanceof Player) {
            $sender->sendMessage("§cYou may only run this command in-game!");
            return false;
        }

        $permission = PermissionsManager::getInstance()->checkPermission($sender->getXuid(), "emporiumcore.command.gamble");
        if ($permission === false) {
            $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "No permission");
            return false;
        }

        if (isset($args[0])) {
            $money = $args[0];
            $balance = DataManager::getInstance()->getPlayerData($sender->getXuid(), "profile.money");
            if (is_numeric($money)) {
                if ($money <= 500000000) {
                    if ($money > 0) {
                        if ($balance >= $money) {
                            $chance = mt_rand(1, 5);
                            if ($chance === 1) {
                                $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "§r§a+" . $args[0]);
                            } else {
                                $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "§r§c-" . $money);
                            }
                            DataManager::getInstance()->setPlayerData($sender->getXuid(), "profile.money", DataManager::getInstance()->getPlayerData($sender->getXuid(), "profile.money") + $money);
                            return true;
                        } else {
                            $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "§r§7You do not have enough money to gamble $" . $args[0] . ".");
                            return false;
                        }
                    } else {
                        $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "§r§7Please provide a valid amount to pay.");
                        return false;
                    }
                } else {
                    $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "§r§7The max amount of money you can gamble is $500,000,000.");
                    return false;
                }
            } else {
                $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "§r§7Please enter only numbers for the amount you're gambling.");
                return false;
            }
        } else {
            $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "§r§7Command Usage: /gamble <amount>");
            return false;
        }
    }
}