<?php

namespace EmporiumCore\Commands\Staff;

use EmporiumCore\EmporiumCore;
use EmporiumCore\Listeners\WebhookEvent;
use EmporiumCore\Managers\Data\DataManager;
use EmporiumCore\Variables;

use pocketmine\player\Player;

use pocketmine\command\{Command, CommandSender};

use pocketmine\utils\TextFormat as TF;

class KickCommand extends Command {

    public function __construct() {
        parent::__construct("kick", "Kick a player from the server.", "/kick <player>");
        $this->setPermission("emporiumcore.command.kick");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {

        if(!$sender instanceof Player) {
            return false;
        }

        $permission = DataManager::getData($sender, "Permissions", "emporiumcore.command.kick");
        if ($permission === false) {
            $sender->sendMessage(TF::RED . "No permission");
            return false;
        }

        if (isset($args[0])) {
            $player = EmporiumCore::getInstance()->getServer()->getPlayerExact($args[0]);
            if ($player instanceof Player) {
                $player->kick("§cYou have been kicked from Emporium.");
                $sender->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have kicked {$player->getName()}.");
                // Send Logs
                WebhookEvent::staffWebhook($sender, $player, "Kick");
                return true;
            } else {
                $sender->sendMessage(Variables::ERROR_PREFIX . TF::GRAY . "That player cannot be found.");
                return false;
            }
        } else {
            $sender->sendMessage(Variables::ERROR_PREFIX . TF::GRAY . "Usage: /kick <player>");
            return false;
        }
    }
}