<?php

namespace EmporiumCore\Commands\Staff;

use EmporiumCore\EmporiumCore;
use EmporiumCore\Variables;
use JsonException;

use pocketmine\player\Player;

use pocketmine\command\{Command, CommandSender};

use EmporiumCore\Managers\Data\DataManager;
use EmporiumCore\Listeners\Players\WebhookEvent;

use pocketmine\utils\TextFormat as TF;

class UnmuteCommand extends Command {

    public function __construct() {
        parent::__construct("unmute", "Unmute a player.", "/unmute <player>");
        $this->setPermission("emporiumcore.command.unmute");
    }

    /**
     * @throws JsonException
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {

        if(!$sender instanceof Player) {
            return false;
        }

        $permission = DataManager::getData($sender, "Permissions", "emporiumcore.command.unmute");
        if ($permission === false) {
            $sender->sendMessage(TF::RED . "No permission");
            return false;
        }

        if (isset($args[0])) {
            $player = EmporiumCore::getPluginInstance()->getServer()->getPlayerExact($args[0]);
            if ($player instanceof Player) {
                DataManager::setData($player, "Cooldowns", "Mute", 0);
                $sender->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have unmuted {$player->getName()}.");
                $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have been unmuted.");
                // Send Logs
                WebhookEvent::staffWebhook($sender, $player->getName(), "Unmute");
                return true;
            }
            if (file_exists(EmporiumCore::getPluginInstance()->getDataFolder() . "Players/{$args[0]}.yml")) {
                DataManager::setOfflinePlayerData($args[0], "Cooldowns", "Mute", 0);
                $sender->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have unmuted {$args[0]}.");
                // Send Logs
                WebhookEvent::staffWebhook($sender, $args[0], "Unmute");
                return true;
            }
            $sender->sendMessage(Variables::ERROR_PREFIX . TF::GRAY . "That player cannot be found.");
            return false;
        }
        $sender->sendMessage(Variables::ERROR_PREFIX . TF::GRAY . "Usage: /unfreeze <player>");
        return false;
    }
}