<?php

namespace EmporiumCore\Commands\Staff;

use EmporiumCore\EmporiumCore;
use EmporiumCore\Managers\Data\DataManager;

use EmporiumCore\Variables;
use pocketmine\player\Player;
use pocketmine\command\{Command, CommandSender};

use EmporiumCore\Listeners\Players\WebhookEvent;

use pocketmine\utils\TextFormat as TF;

class KillCommand extends Command {

    public function __construct() {
        parent::__construct("kill", "Kill a player.", "/kill <player>");
        $this->setPermission("emporiumcore.command.kill");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {

        if(!$sender instanceof Player) {
            return false;
        }

        $permission = DataManager::getData($sender, "Permissions", "emporiumcore.command.kill");
        if ($permission === false) {
            $sender->sendMessage(TF::RED . "No permission");
            return false;
        }

        if (isset($args[0])) {
            $player = EmporiumCore::getPluginInstance()->getServer()->getPlayerExact($args[0]);
            if ($player instanceof Player) {
                $player->kill();
                $sender->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have killed " . TF::YELLOW . "{$player->getName()}.");
                // Send Logs
                WebhookEvent::staffWebhook($sender, $player, "Kill");
                return true;
            }
            $sender->sendMessage(Variables::ERROR_PREFIX . TF::GRAY . "That player cannot be found.");
            return false;
        }
        $sender->sendMessage(Variables::ERROR_PREFIX . TF::GRAY . "Command Usage: /kill <player>");
        return false;
    }
}