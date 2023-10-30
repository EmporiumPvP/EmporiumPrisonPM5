<?php

namespace EmporiumCore\Commands\Default;

use Emporium\Prison\Variables;
use EmporiumData\DataManager;
use EmporiumData\PermissionsManager;

use pocketmine\command\{Command, CommandSender};
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;

class GambleCommand extends Command {

    public function __construct() {
        parent::__construct("gamble", "Gamble your money.", "/gamble [amount]");
        $this->setPermission("emporiumcore.command.gamble");
    }

    # Command Code

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool
    {

        if (!$sender instanceof Player) return false;

        $permission = PermissionsManager::getInstance()->checkPermission($sender->getXuid(), $this->getPermissions());
        if (!$permission) {
            $sender->sendMessage(Variables::NO_PERMISSION_MESSAGE);
            return false;
        }

        if (!isset($args[0])) {
            $sender->sendMessage(Variables::PREFIX . $this->getUsage());
            return false;
        }
        $amount = $args[0];
        $balance = DataManager::getInstance()->getPlayerData($sender->getXuid(), "profile.money");

        if (!is_numeric($amount)) {
            $sender->sendMessage(Variables::PREFIX . "Please enter only numbers for the amount you're gambling");
            return false;
        }

        if ($amount > 500000000) {
            $sender->sendMessage(Variables::PREFIX . "The max amount of money you can gamble is $500,000,000");
            return false;
        }

        if ($amount < 1) {
            $sender->sendMessage(Variables::PREFIX . "Please provide a valid amount to pay");
            return false;
        }

        if ($balance < $amount) {
            $sender->sendMessage(Variables::PREFIX . "You do not have enough money to gamble $$amount");
            return false;
        }

        $chance = mt_rand(1, 5);

        if ($chance === 1) {
            $sender->sendMessage(Variables::PREFIX . "+" . $args[0]);
        } else {
            $sender->sendMessage(Variables::PREFIX . "-" . $amount);
        }
        DataManager::getInstance()->setPlayerData($sender->getXuid(), "profile.money", DataManager::getInstance()->getPlayerData($sender->getXuid(), "profile.money") + $amount);
        return true;
    }
}