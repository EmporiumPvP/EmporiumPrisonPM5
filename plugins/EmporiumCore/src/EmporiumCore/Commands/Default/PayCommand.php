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

class PayCommand extends Command
{


    public function __construct() {
        parent::__construct("pay", "Send a player money", "/pay [player] [amount]");
        $this->setPermission("emporiumcore.command.pay");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {

        if (!$sender instanceof Player) {
            $sender->sendMessage(TF::RED . "You may only run this command in-game!");
            return false;
        }

        // Check for Permissions
        $permission = PermissionsManager::getInstance()->checkPermission($sender->getXuid(), $this->getPermissions());
        if (!$permission) {
            $sender->sendMessage(\Emporium\Prison\Variables::NO_PERMISSION_MESSAGE);
            return false;
        }

        $balance = DataManager::getInstance()->getPlayerData($sender->getXuid(), "profile.money");

        if(!isset($args[0])) {
            return false;
        }
        $player = EmporiumCore::getInstance()->getServer()->getPlayerExact($args[0]);

        if(!$player instanceof Player) {
            $sender->sendMessage(\Emporium\Prison\Variables::PREFIX . "That player cannot be found");
            return false;
        }

        if(!isset($args[1])) {
            $sender->sendMessage(\Emporium\Prison\Variables::PREFIX . "Please provide a valid amount to pay");
            return false;
        }
        $amount = $args[1];

        if(!is_numeric($amount)) {
            $sender->sendMessage(\Emporium\Prison\Variables::PREFIX . "Command Usage: /pay [player] [amount]");
            return false;
        }

        if(!$amount > 0) {
            $sender->sendMessage(\Emporium\Prison\Variables::PREFIX . "Amount needs to be more than 0");
            return false;
        }

        if($balance < $amount) {
            $sender->sendMessage(\Emporium\Prison\Variables::PREFIX . "Insufficient funds");
            return false;
        }

        DataManager::getInstance()->setPlayerData($sender->getXuid(), "profile.money", DataManager::getInstance()->getPlayerData($sender->getXuid(), "profile.money") + $amount);
        DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.money") + $amount);
        $sender->sendMessage(Variables::SERVER_PREFIX . "You have successfully paid $" . Translator::shortNumber($amount) . " to " . $player->getName());
        $player->sendMessage(Variables::SERVER_PREFIX . "You have been paid $" . Translator::shortNumber($amount) . " by " . $sender->getName());
        return true;
    }

}