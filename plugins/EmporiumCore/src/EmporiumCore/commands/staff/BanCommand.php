<?php

namespace EmporiumCore\Commands\Staff;

use Emporium\Prison\Managers\misc\Translator;
use EmporiumCore\EmporiumCore;
use EmporiumCore\Listeners\WebhookEvent;
use EmporiumCore\Variables;
use JsonException;


use EmporiumCore\Managers\Data\DataManager;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;

class BanCommand extends Command {

    public function __construct() {
        parent::__construct("ban", "Ban a player from the server.", "/ban <player> <seconds> <reason>");
        $this->setPermission("emporiumcore.command.ban");
    }

    /**
     * @throws JsonException
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {

        if(!$sender instanceof Player) {
            return false;
        }

        $permission = DataManager::getData($sender, "Permissions", "emporiumcore.command.ban");
        if ($permission === false) {
            $sender->sendMessage("§cYou do not have permission to use this command.");
            return false;
        }

        if (isset($args[0])) {
            $player = EmporiumCore::getInstance()->getServer()->getPlayerExact($args[0]);
            if ($player instanceof Player) {
                if (isset($args[1])) {
                    if (is_numeric($args[1])) {
                        if ($args[1] > 0) {
                            if (isset($args[2])) {
                                $time = Translator::timeConvert($args[1]);
                                $reason = $args[2];
                                if ($reason === "" || $reason === " ") {
                                    $reason = "No reason was specified.";
                                }
                                DataManager::setData($player, "Players", "Banned", true);
                                DataManager::setData($player, "Cooldowns", "Ban", $args[1]);
                                $player->kick(Variables::BAN_HEADER . TF::AQUA . "\n§bDuration: " . TF::WHITE . "$time\n" . TF::AQUA . "Reason: " . TF::WHITE . "$reason");
                                $sender->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have banned " . TF::YELLOW . "{$player->getName()}.");
                                $sender->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "Ban Duration: " . TF::YELLOW . "$time.");
                                $sender->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "Ban Reason: " . TF::YELLOW . "$reason.");
                                // Send Logs
                                WebhookEvent::staffWebhook($sender, $player, "Ban");
                                return true;
                            } else {
                                $sender->sendMessage(Variables::ERROR_PREFIX . TF::GRAY . "Command Usage: /ban <player> <time> <reason>");
                                return false;
                            }
                        } else {
                            $sender->sendMessage(Variables::ERROR_PREFIX . TF::GRAY . "Please enter a valid duration.");
                            return false;
                        }
                    } else {
                        $sender->sendMessage(Variables::ERROR_PREFIX . TF::GRAY . "Please enter the duration in seconds.");
                        return false;
                    }
                } else {
                    $sender->sendMessage(Variables::ERROR_PREFIX . TF::GRAY . "Command Usage: /ban <player> <time> <reason>");
                    return false;
                }
            } else {
                $sender->sendMessage(Variables::ERROR_PREFIX . TF::GRAY . "That player cannot be found.");
                return false;
            }
        } else {
            $sender->sendMessage(Variables::ERROR_PREFIX . TF::GRAY . "Command Usage: /ban <player> <time> <reason>");
            return false;
        }
    }

}