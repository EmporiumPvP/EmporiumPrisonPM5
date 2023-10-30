<?php

namespace EmporiumCore\Commands\Staff;

use EmporiumCore\Variables;
use EmporiumData\PermissionsManager;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;
use pocketmine\utils\TextFormat as TF;

class BroadcastCommand extends Command {

    public function __construct() {
        parent::__construct("broadcast", "Broadcast a message.", "/broadcast <message>", ["say"]);
        $this->setPermission("emporiumcore.command.broadcast");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {

        if(!$sender instanceof Player) {
            return false;
        }

        $permission = PermissionsManager::getInstance()->checkPermission($sender->getXuid(), ["emporiumcore.command.broadcast"]);
        if (!$permission) {
            $sender->sendMessage(TextFormat::RED . "No permission");
            return false;
        }

        if (isset($args)) {
            $message = implode(" ", $args);
            $sender->getServer()->broadcastMessage(TF::BOLD . TF::GOLD . "(!) Announcement");
            $sender->getServer()->broadcastMessage($message);
            return true;
        }
        $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "Usage: /broadcast <message>");
        return false;
    }
}