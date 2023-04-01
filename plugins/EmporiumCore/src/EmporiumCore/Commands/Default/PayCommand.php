<?php

namespace EmporiumCore\Commands\Default;

use Emporium\Prison\Managers\misc\Translator;
use EmporiumCore\EmporiumCore;
use EmporiumCore\Variables;
use EmporiumData\DataManager;
use EmporiumData\PermissionsManager;
use pocketmine\command\{Command, CommandSender};
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;

# Used Files

class PayCommand extends Command
{


    public function __construct() {
        parent::__construct("pay", "Send a player money");
        $this->setPermission("emporiumcore.command.pay");
        $this->setUsage("/pay <amount> <player>");
    }

    # Command Code
    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {

        // Check Player
        if (!$sender instanceof Player) {
            $sender->sendMessage(TF::RED . "You may only run this command in-game!");
            return false;
        }

        // Check for Permissions
        $permission = PermissionsManager::getInstance()->checkPermission($sender->getXuid(), "emporiumcore.command.pay");
        if (!$permission) {
            $sender->sendMessage(TF::RED . "You do not have permission to use this command.");
            return false;
        }

        $balance = DataManager::getInstance()->getPlayerData($sender->getXuid(), "profile.money");

        // Execute Command
        if (isset($args[0])) {
            if (is_numeric($args[0])) {
                $amount = $args[0];
                if ($amount > 0) {
                    if ($balance >= $amount) {
                        if (isset($args[1])) {
                            $player = EmporiumCore::getInstance()->getServer()->getPlayerExact($args[1]);
                            if($player === $sender) {
                                $sender->sendMessage(TF::RED . "You can not pay yourself");
                            } else {
                                if ($player instanceof Player) {
                                    DataManager::getInstance()->setPlayerData($sender->getXuid(), "profile.money", DataManager::getInstance()->getPlayerData($sender->getXuid(), "profile.money") + $amount);
                                    DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.money") + $amount);
                                    $sender->sendMessage(Variables::SERVER_PREFIX . "You have successfully paid $" . Translator::shortNumber($amount) . " to " . $player->getName() . ".");
                                    $player->sendMessage(Variables::SERVER_PREFIX . "You have been paid $" . Translator::shortNumber($amount) . " by " . $sender->getName() . ".");
                                    return true;
                                } else {
                                    $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "That player cannot be found.");
                                    return false;
                                }
                            }
                        }
                    } else {
                        $sender->sendMessage(TF::RED . "Insufficient funds");
                        return false;
                    }
                }
            } else {
                $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "Command Usage: /pay <amount> <player>");
                return false;
            }
        } else {
            $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "Please provide a valid amount to pay.");
            return false;
        }
        return false;
    }

}