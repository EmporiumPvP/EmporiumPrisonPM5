<?php

namespace EmporiumCore\Commands\Staff;

use EmporiumCore\EmporiumCore;
use EmporiumCore\Listeners\WebhookEvent;
use EmporiumCore\Variables;

use JsonException;

use pocketmine\command\{Command, CommandSender};

use EmporiumCore\Managers\Data\DataManager;

use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;

class UnbanCommand extends Command {

    public function __construct() {
        parent::__construct("unban", "Unban a player from the server.", "/unban <player>");
        $this->setPermission("emporiumcore.command.unban");
    }

    /**
     * @throws JsonException
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {

        if(!$sender instanceof Player) {
            return false;
        }

        $permission = DataManager::getData($sender, "Permissions", "emporiumcore.command.unban");
        if ($permission === false) {
            $sender->sendMessage(TF::RED . "No permission");
            return false;
        }

        if (isset($args[0])) {
            if (file_exists(EmporiumCore::getInstance()->getDataFolder() . "Players/$args[0].yml")) {
                DataManager::setOfflinePlayerData($args[0], "Players", "Banned", false);
                DataManager::setOfflinePlayerData($args[0], "Cooldowns", "Ban", 0);
                $sender->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have unbanned " . TF::YELLOW . "$args[0].");
                // Send Logs
                WebhookEvent::staffWebhook($sender, $args[0], "Unban");
                return true;
            } else {
                $sender->sendMessage(Variables::ERROR_PREFIX . TF::GRAY . "That player cannot be found.");
                return false;
            }
        } else {
            $sender->sendMessage(Variables::ERROR_PREFIX . TF::GRAY . "Usage: /unban <player>");
            return false;
        }
    }
}