<?php

namespace EmporiumCore\Commands\Staff;

use EmporiumCore\EmporiumCore;
use EmporiumCore\Listeners\WebhookEvent;
use EmporiumCore\Variables;
use EmporiumData\PermissionsManager;
use pocketmine\command\{Command, CommandSender};
use pocketmine\player\Player;
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

        $permission = PermissionsManager::getInstance()->checkPermission($sender->getXuid(), "emporiumcore.command.kill");
        if (!$permission) {
            $sender->sendMessage(\Emporium\Prison\Variables::NO_PERMISSION_MESSAGE);
            return false;
        }

        if (isset($args[0])) {
            $player = EmporiumCore::getInstance()->getServer()->getPlayerExact($args[0]);
            if ($player instanceof Player) {
                $player->kill();
                $sender->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have killed " . TF::YELLOW . "{$player->getName()}.");
                // Send Logs
                WebhookEvent::staffWebhook($sender, $player, "Kill");
                return true;
            } else {
                $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "That player cannot be found.");
                return false;
            }
        } else {
            $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "Command Usage: /kill <player>");
            return false;
        }
    }
}