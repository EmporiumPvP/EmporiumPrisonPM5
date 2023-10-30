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

class UnbanCommand extends Command {

    public function __construct() {
        parent::__construct("unban", "Unban a player from the server.", "/unban <player>");
        $this->setPermission("emporiumcore.command.unban");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {

        if(!$sender instanceof Player) {
            return false;
        }

        $permission = PermissionsManager::getInstance()->checkPermission($sender->getXuid(), ["emporiumcore.command.unban"]);
        if (!$permission) {
            $sender->sendMessage(\Emporium\Prison\Variables::NO_PERMISSION_MESSAGE);
            return false;
        }

        if(!isset($args[0])) {
            $sender->sendMessage("Please specify a player");
            return false;
        }

        $player = EmporiumCore::getInstance()->getServer()->getPlayerExact($args[0]);

        if(!file_exists(Loader::PLAYER_FOLDER . $player->getXuid() . ".json")) {
            $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "(" . TF::RED . "!" . TF::DARK_GRAY . ") " . TF::RESET . TF::RED . "That player cannot be found.");
            return false;
        }

        DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.banned", false);
        DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.ban", 0);
        $sender->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have unbanned " . TF::YELLOW . "$args[0].");

        // Send Logs
        WebhookEvent::staffWebhook($sender, $args[0], "Unban");
        return true;
    }
}