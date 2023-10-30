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

        $permission = PermissionsManager::getInstance()->checkPermission($sender->getXuid(), ["emporiumcore.command.ban"]);
        if (!$permission) {
            $sender->sendMessage(\Emporium\Prison\Variables::NO_PERMISSION_MESSAGE);
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

                                # create reason message
                                $reason = $args;
                                $sortedReason = str_replace([$player, $time], ["", ""], $reason);
                                if ($sortedReason === "" || $sortedReason === " ") {
                                    $sortedReason = "No reason was specified.";
                                }

                                # Send webhook
                                WebhookEvent::staffWebhook($sender, $player, "Ban", $sortedReason);

                                # set data
                                DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.banned", true);
                                # DataManager::getInstance()->setPlayerData($player->getXuid(), "cooldown.ban", (int) $args[1]); need to add to cooldown files

                                $player->kick(Variables::BAN_HEADER . TF::AQUA . "\n§bDuration: " . TF::WHITE . "$time\n" . TF::AQUA . "Reason: " . TF::WHITE . "$reason");

                                $sender->sendMessage(TF::GRAY . "You have banned " . TF::YELLOW . "{$player->getName()}.");
                                $sender->sendMessage(TF::GRAY . "Ban Duration: " . TF::YELLOW . "$time.");
                                $sender->sendMessage(TF::GRAY . "Ban Reason: " . TF::YELLOW . "$reason.");
                                return true;
                            } else {
                                $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "(" . TF::RED . "!" . TF::DARK_GRAY . ") " . TF::RESET . TF::RED . "Command Usage: /ban <player> <time> <reason>");
                                return false;
                            }
                        } else {
                            $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "(" . TF::RED . "!" . TF::DARK_GRAY . ") " . TF::RESET . TF::RED . "Please enter a valid duration.");
                            return false;
                        }
                    } else {
                        $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "(" . TF::RED . "!" . TF::DARK_GRAY . ") " . TF::RESET . TF::RED . "Please enter the duration in seconds.");
                        return false;
                    }
                } else {
                    $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "(" . TF::RED . "!" . TF::DARK_GRAY . ") " . TF::RESET . TF::RED . "Command Usage: /ban <player> <time> <reason>");
                    return false;
                }
            } else {
                $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "(" . TF::RED . "!" . TF::DARK_GRAY . ") " . TF::RESET . TF::RED . "That player cannot be found.");
                return false;
            }
        } else {
            $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "(" . TF::RED . "!" . TF::DARK_GRAY . ") " . TF::RESET . TF::RED . "Command Usage: /ban <player> <time> <reason>");
            return false;
        }
    }

}