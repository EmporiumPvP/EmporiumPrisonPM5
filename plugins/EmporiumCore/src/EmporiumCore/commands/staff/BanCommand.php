<?php

namespace EmporiumCore\Commands\Staff;

use Emporium\Prison\Managers\misc\Translator;
use EmporiumCore\EmporiumCore;
use EmporiumCore\Listeners\WebhookEvent;
use EmporiumCore\Variables;
use EmporiumData\DataManager;
use EmporiumData\PermissionsManager;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;

class BanCommand extends Command {

    public function __construct() {
        parent::__construct("ban", "Ban a player from the server.", "/ban <player> <seconds> <reason>");
        $this->setPermission("emporiumcore.command.ban");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {

        if(!$sender instanceof Player) {
            return false;
        }

        $permission = PermissionsManager::getInstance()->checkPermission($sender->getXuid(), "emporiumcore.command.ban");
        if (!$permission) {
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
                                DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.anned", true);
                                DataManager::getInstance()->setPlayerData($player->getXuid(), "ban-timer", (int) $args[1]);
                                $player->kick(Variables::BAN_HEADER . TF::AQUA . "\n§bDuration: " . TF::WHITE . "$time\n" . TF::AQUA . "Reason: " . TF::WHITE . "$reason");
                                $sender->sendMessage(TF::GRAY . "You have banned " . TF::YELLOW . "{$player->getName()}.");
                                $sender->sendMessage(TF::GRAY . "Ban Duration: " . TF::YELLOW . "$time.");
                                $sender->sendMessage(TF::GRAY . "Ban Reason: " . TF::YELLOW . "$reason.");
                                // Send Logs
                                WebhookEvent::staffWebhook($sender, $player, "Ban");
                                return true;
                            } else {
                                $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RED . "Command Usage: /ban <player> <time> <reason>");
                                return false;
                            }
                        } else {
                            $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RED . "Please enter a valid duration.");
                            return false;
                        }
                    } else {
                        $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RED . "Please enter the duration in seconds.");
                        return false;
                    }
                } else {
                    $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RED . "Command Usage: /ban <player> <time> <reason>");
                    return false;
                }
            } else {
                $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RED . "That player cannot be found.");
                return false;
            }
        } else {
            $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RED . "Command Usage: /ban <player> <time> <reason>");
            return false;
        }
    }

}