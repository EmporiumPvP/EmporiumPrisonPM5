<?php

namespace EmporiumCore\Commands\Staff;

use EmporiumCore\EmporiumCore;
use EmporiumCore\Listeners\WebhookEvent;
use EmporiumCore\Variables;
use JsonException;

use pocketmine\player\Player;
use pocketmine\command\{Command, CommandSender};

use EmporiumCore\Managers\Data\DataManager;
use pocketmine\utils\TextFormat as TF;

class UnfreezeCommand extends Command {

    public function __construct() {
        parent::__construct("unfreeze", "Unfreeze a player.", "/unfreeze <player>");
        $this->setPermission("emporiumcore.command.unfreeze");
    }

    /**
     * @throws JsonException
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {

        if(!$sender instanceof Player) {
            return false;
        }

        $permission = DataManager::getData($sender, "Permissions", "emporiumcore.command.unfreeze");
        if ($permission === false) {
            $sender->sendMessage(TF::RED . "No permission");
            return false;
        }

        if (isset($args[0])) {
            $player = EmporiumCore::getInstance()->getServer()->getPlayerExact($args[0]);
            if ($player instanceof Player) {
                DataManager::setData($player, "Players", "Frozen", false);
                $sender->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have unfrozen {$player->getName()}.");
                $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have been unfrozen and can now move.");
                // Send Logs
                WebhookEvent::staffWebhook($sender, $player->getName(), "Unfreeze");
                return true;
            }
            if (file_exists(EmporiumCore::getInstance()->getDataFolder() . "Players/$args[0].yml")) {
                DataManager::setOfflinePlayerData($args[0], "Players", "Frozen", false);
                $sender->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have unfrozen $args[0].");
                // Send Logs
                WebhookEvent::staffWebhook($sender, $args[0], "Unfreeze");
                return true;
            } else {
                $sender->sendMessage(Variables::ERROR_PREFIX . TF::GRAY . "That player cannot be found.");
                return false;
            }
        } else {
            $sender->sendMessage(Variables::ERROR_PREFIX . TF::GRAY . "Usage: /unfreeze <player>");
            return false;
        }
    }
}