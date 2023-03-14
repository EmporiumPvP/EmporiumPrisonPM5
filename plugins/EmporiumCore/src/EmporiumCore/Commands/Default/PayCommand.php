<?php

namespace EmporiumCore\Commands\Default;

use Emporium\Prison\Managers\misc\Translator;
use EmporiumCore\Variables;

use JsonException;
use pocketmine\player\Player;
use pocketmine\command\{Command, CommandSender};

# Used Files
use EmporiumCore\EmporiumCore;
use EmporiumCore\Managers\Data\DataManager;
use pocketmine\utils\TextFormat as TF;

class PayCommand extends Command
{


    public function __construct() {
        parent::__construct("pay", "Send a player money");
        $this->setPermission("emporiumcore.command.pay");
        $this->setUsage("/pay <amount> <player>");
    }

    /**
     * @throws JsonException
     */
    # Command Code
    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {
        // Check for Permissions
        if (!$this->testPermissionSilent($sender)) {
            $sender->sendMessage(TF::RED . "You do not have permission to use this command.");
            return false;
        }
        // Check Player
        if (!$sender instanceof Player) {
            $sender->sendMessage(TF::RED . "You may only run this command in-game!");
            return false;
        }
        $balance = DataManager::getData($sender, "Players", "Money");

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
                                    DataManager::takeData($sender, "Players", "Money", $amount);
                                    DataManager::addData($player, "Players", "Money", $amount);
                                    $sender->sendMessage(Variables::SERVER_PREFIX . "You have successfully paid $" . Translator::shortNumber($amount) . " to " . $player->getName() . ".");
                                    $player->sendMessage(Variables::SERVER_PREFIX . "You have been paid $" . Translator::shortNumber($amount) . " by " . $sender->getName() . ".");
                                    return true;
                                } else {
                                    $sender->sendMessage(Variables::ERROR_PREFIX . "That player cannot be found.");
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
                $sender->sendMessage(Variables::ERROR_PREFIX . "Command Usage: /pay <amount> <player>");
                return false;
            }
        } else {
            $sender->sendMessage(Variables::ERROR_PREFIX . "Please provide a valid amount to pay.");
            return false;
        }
        return false;
    }

}