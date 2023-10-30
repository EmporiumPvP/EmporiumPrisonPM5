<?php

namespace EmporiumCore\Commands\Staff;


use EmporiumCore\EmporiumCore;
use EmporiumCore\Listeners\WebhookEvent;
use EmporiumCore\Variables;
use EmporiumData\DataManager;
use EmporiumData\PermissionsManager;
use pocketmine\command\{Command, CommandSender};
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;

class FreezeCommand extends Command {

    public function __construct() {
        parent::__construct("freeze", "Freeze a player.", "/freeze <player>");
        $this->setPermission("emporiumcore.command.freeze");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {

        if(!$sender instanceof Player) {
            return false;
        }

        $permission = PermissionsManager::getInstance()->checkPermission($sender->getXuid(),  "emporiumcore.command.freeze");
        if (!$permission) {
            $sender->sendMessage(\Emporium\Prison\Variables::NO_PERMISSION_MESSAGE);
            return false;
        }

        if (isset($args[0])) {
            $player = EmporiumCore::getInstance()->getServer()->getPlayerExact($args[0]);
            if ($player instanceof Player) {
                DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.frozen", true);
                $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You have frozen " . TF::YELLOW . "{$player->getName()}.");
                $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You are now frozen and cannot move.");
                // Send Logs
                WebhookEvent::staffWebhook($sender, $player, "Freeze");
                return true;
            } else {
                $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "That player cannot be found.");
                return false;
            }
        } else {
            $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "Usage: /freeze <player>");
            return false;
        }
    }
}