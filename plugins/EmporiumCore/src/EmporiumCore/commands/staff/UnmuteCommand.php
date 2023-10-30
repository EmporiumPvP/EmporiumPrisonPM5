<?php

namespace EmporiumCore\Commands\Staff;

use EmporiumCore\EmporiumCore;
use EmporiumCore\Listeners\WebhookEvent;
use EmporiumCore\Variables;
use EmporiumData\DataManager;
use EmporiumData\Loader;
use EmporiumData\PermissionsManager;
use pocketmine\command\{Command, CommandSender};
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;

class UnmuteCommand extends Command {

    public function __construct() {
        parent::__construct("unmute", "Unmute a player.", "/unmute <player>");
        $this->setPermission("emporiumcore.command.unmute");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {

        if(!$sender instanceof Player) {
            return false;
        }

        $permission = PermissionsManager::getInstance()->checkPermission($sender->getXuid(), ["emporiumcore.command.unmute"]);
        if (!$permission) {
            $sender->sendMessage(\Emporium\Prison\Variables::NO_PERMISSION_MESSAGE);
            return false;
        }

        if (isset($args[0])) {
            $player = EmporiumCore::getInstance()->getServer()->getPlayerExact($args[0]);
            if ($player instanceof Player) {
                DataManager::getInstance()->setPlayerData($player->getXuid(), "mute-timer", 0);
                $sender->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have unmuted {$player->getName()}.");
                $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have been unmuted.");
                // Send Logs
                WebhookEvent::staffWebhook($sender, $player->getName(), "Unmute");
                return true;
            }
            if (file_exists(Loader::PLAYER_FOLDER . $player->getXuid() . ".json")) {
                DataManager::getInstance()->setPlayerData($player->getXuid(), "mute-timer", 0);
                $sender->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have unmuted $player.");
                // Send Logs
                WebhookEvent::staffWebhook($sender, $args[0], "Unmute");
                return true;
            } else {
                $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "That player cannot be found.");
                return false;
            }
        } else {
            $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "Usage: /unfreeze <player>");
            return false;
        }
    }
}