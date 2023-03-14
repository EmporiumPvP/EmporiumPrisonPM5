<?php

namespace EmporiumCore\Commands\Staff;

use Emporium\Prison\Managers\misc\Translator;

use EmporiumCore\EmporiumCore;
use EmporiumCore\Listeners\WebhookEvent;
use EmporiumCore\Variables;

use JsonException;

use pocketmine\player\Player;
use pocketmine\command\{Command, CommandSender};

use EmporiumCore\Managers\Data\DataManager;
use pocketmine\utils\TextFormat as TF;

class MuteCommand extends Command {

    public function __construct() {
        parent::__construct("mute", "Mute a player.", "/mute <time> <player>");
        $this->setPermission("emporiumcore.command.mute");
    }

    # Command Code
    /**
     * @throws JsonException
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {

        if(!$sender instanceof Player) {
            return false;
        }

        $permission = DataManager::getData($sender, "Permissions", "emporiumcore.command.mute");
        if ($permission === false) {
            $sender->sendMessage(TF::RED . "No permission");
            return false;
        }

        if (isset($args[0])) {
            $player = EmporiumCore::getInstance()->getServer()->getPlayerExact($args[0]);
            if ($player instanceof Player) {
                if (isset($args[1])) {
                    if (is_numeric($args[1])) {
                        if ($args[1] > 0) {
                            $time = Translator::timeConvert($args[1]);
                            DataManager::setData($player, "Cooldowns", "Mute", $args[1]);
                            $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have been muted for $time.");
                            $sender->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have muted {$player->getName()}.");
                            $sender->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "Mute Duration: $time.");
                            // Send Logs
                            WebhookEvent::staffWebhook($sender, $player, "Mute");
                            return true;
                        } else {
                            $sender->sendMessage(Variables::ERROR_PREFIX . TF::GRAY . "Please enter a valid duration.");
                            return false;
                        }
                    } else {
                        $sender->sendMessage(Variables::ERROR_PREFIX . TF::GRAY . "Please enter the duration in seconds.");
                        return false;
                    }
                } else {
                    $sender->sendMessage(Variables::ERROR_PREFIX . TF::GRAY . "Usage: /mute <player> <time>");
                    return false;
                }
            } else {
                $sender->sendMessage(Variables::ERROR_PREFIX . TF::GRAY . "That player cannot be found.");
                return false;
            }
        } else {
            $sender->sendMessage(Variables::ERROR_PREFIX . TF::GRAY . "Usage: /mute <player> <time>");
            return false;
        }
    }
}