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

class UnfreezeCommand extends Command {

    public function __construct() {
        parent::__construct("unfreeze", "Unfreeze a player.", "/unfreeze <player>");
        $this->setPermission("emporiumcore.command.unfreeze");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {

        if(!$sender instanceof Player) {
            return false;
        }

        $permission = PermissionsManager::getInstance()->checkPermission($sender->getXuid(),  ["emporiumcore.command.unfreeze"]);
        if (!$permission) {
            $sender->sendMessage(\Emporium\Prison\Variables::NO_PERMISSION_MESSAGE);
            return false;
        }

        if (isset($args[0])) {
            $player = EmporiumCore::getInstance()->getServer()->getPlayerExact($args[0]);
            if ($player instanceof Player) {
                DataManager::getInstance()->setPlayerData($sender->getXuid(), "profile.frozen", false);
                $sender->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have unfrozen {$player->getName()}.");
                $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have been unfrozen and can now move.");
                // Send Logs
                WebhookEvent::staffWebhook($sender, $player->getName(), "Unfreeze");
                return true;
            }
            if (file_exists(Loader::PLAYER_FOLDER . $player->getXuid() . ".json")) {
                DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.frozen", false);
                $sender->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have unfrozen $player.");
                // Send Logs
                WebhookEvent::staffWebhook($sender, $player, "Unfreeze");
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