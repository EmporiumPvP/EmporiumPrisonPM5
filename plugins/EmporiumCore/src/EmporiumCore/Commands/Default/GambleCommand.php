<?php

namespace EmporiumCore\Commands\Default;

use EmporiumCore\Variables;
use JsonException;
use pocketmine\player\Player;
use pocketmine\command\{Command, CommandSender};

use EmporiumCore\Managers\Data\DataManager;
use pocketmine\utils\TextFormat;

class GambleCommand extends Command {

    public function __construct() {
        parent::__construct("gamble", "Gamble your money.", "/gamble");
        $this->setPermission("emporiumcore.command.gamble");
    }

    # Command Code

    /**
     * @throws JsonException
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {

        if (!$sender instanceof Player) {
            $sender->sendMessage("§cYou may only run this command in-game!");
            return false;
        }

        $permission = DataManager::getData($sender, "Permissions", "emporiumcore.command.gamble");
        if ($permission === false) {
            $sender->sendMessage(TextFormat::RED . "No permission");
            return false;
        }

        if (isset($args[0])) {
            $balance = DataManager::getData($sender, "Players", "Money");
            if (is_numeric($args[0])) {
                if ($args[0] <= 500000000) {
                    if ($args[0] > 0) {
                        if ($balance >= $args[0]) {
                            $chance = mt_rand(1, 5);
                            if ($chance === 1) {
                                $sender->sendMessage(Variables::SERVER_PREFIX . "§r§a+" . $args[0]);
                                DataManager::addData($sender, "Players", "Money", $args[0]);
                                return true;
                            }
                            $sender->sendMessage(Variables::SERVER_PREFIX . "§r§c-" . $args[0]);
                            DataManager::takeData($sender, "Players", "Money", $args[0]);
                            return true;
                        }
                        $sender->sendMessage(Variables::SERVER_PREFIX . "§r§7You do not have enough money to gamble $" . $args[0] . ".");
                        return false;
                    }
                    $sender->sendMessage(Variables::SERVER_PREFIX . "§r§7Please provide a valid amount to pay.");
                    return false;
                }
                $sender->sendMessage(Variables::SERVER_PREFIX . "§r§7The max amount of money you can gamble is $500,000,000.");
                return false;
            }
            $sender->sendMessage(Variables::SERVER_PREFIX . "§r§7Please enter only numbers for the amount you're gambling.");
            return false;
        }
        $sender->sendMessage(Variables::SERVER_PREFIX . "§r§7Command Usage: /gamble <amount>");
        return false;
    }
}