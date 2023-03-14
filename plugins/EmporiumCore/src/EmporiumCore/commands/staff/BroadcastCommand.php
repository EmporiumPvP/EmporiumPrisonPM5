<?php

namespace EmporiumCore\Commands\Staff;

use EmporiumCore\Managers\Data\DataManager;
use EmporiumCore\Variables;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\player\Player;

use pocketmine\utils\TextFormat as TF;

class BroadcastCommand extends Command {

    public function __construct() {
        parent::__construct("broadcast", "Broadcast a message.", "/broadcast <message>", ["say"]);
        $this->setPermission("emporiumcore.command.broadcast");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {

        if($sender instanceof Player) {
            $permission = DataManager::getData($sender, "Permissions", "emporiumcore.command.broadcast");
            if ($permission === false) {
                $sender->sendMessage("§cYou do not have permission to use this command.");
                return false;
            }
        }

        if (isset($args[0])) {
            $message = implode(" ", $args[0]);
            $sender->getServer()->broadcastMessage(TF::BOLD . TF::GOLD . "(!) Announcement");
            $sender->getServer()->broadcastMessage($message);
            return true;
        }
        $sender->sendMessage(Variables::ERROR_PREFIX . TF::GRAY . "Usage: /broadcast <message>");
        return false;
    }
}