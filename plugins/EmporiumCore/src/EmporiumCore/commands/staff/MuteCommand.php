<?php

namespace EmporiumCore\Commands\Staff;

use Emporium\Prison\Managers\misc\Translator;
use EmporiumCore\EmporiumCore;
use EmporiumCore\Listeners\WebhookEvent;
use EmporiumCore\Variables;
use EmporiumData\DataManager;
use EmporiumData\PermissionsManager;
use pocketmine\command\{Command, CommandSender};
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;

class MuteCommand extends Command {

    public function __construct() {
        parent::__construct("mute", "Mute a player.", "/mute <player> <time>");
        $this->setPermission("emporiumcore.command.mute");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {

        if(!$sender instanceof Player) {
            return false;
        }

        $permission = PermissionsManager::getInstance()->checkPermission($sender->getXuid(), ["emporiumcore.command.mute"]);
        if (!$permission) {
            $sender->sendMessage(\Emporium\Prison\Variables::NO_PERMISSION_MESSAGE);
            return false;
        }

        if (isset($args[0])) {
            $player = EmporiumCore::getInstance()->getServer()->getPlayerExact($args[0]);
            if ($player instanceof Player) {
                if (isset($args[1])) {
                    if (is_numeric($args[1])) {
                        $time = $args[1];
                        if ($time > 0) {
                            DataManager::getInstance()->setPlayerData($player->getXuid(), "mute-timer", $time);
                            $time = Translator::timeConvert($args[1]);
                            $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You have been muted for $time.");
                            $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You have muted {$player->getName()}.");
                            $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "Mute Duration: $time.");

                            # create reason message
                            $reason = $args;
                            $sortedReason = str_replace([$player, $time], ["", ""], $reason);
                            if ($sortedReason === "" || $sortedReason === " ") {
                                $sortedReason = "No reason was specified.";
                            }

                            # Send webhook
                            WebhookEvent::staffWebhook($sender, $player, "Mute", $sortedReason);

                            return true;
                        } else {
                            $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "Please enter a valid duration.");
                            return false;
                        }
                    } else {
                        $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "Please enter the duration in seconds.");
                        return false;
                    }
                } else {
                    $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "Usage: /mute <player> <time>");
                    return false;
                }
            } else {
                $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "That player cannot be found.");
                return false;
            }
        } else {
            $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "Usage: /mute <player> <time>");
            return false;
        }
    }
}