<?php

namespace EmporiumCore\Commands\Staff;

use EmporiumCore\EmporiumCore;
use EmporiumCore\Managers\Data\DataManager;

use EmporiumCore\Variables;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;

class WarnCommand extends Command {

    public function __construct() {
        parent::__construct("warn", "Warn a player.", "/warn [player]");
        $this->setPermission("emporiumcore.command.warn");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {

        if(!$sender instanceof Player) {
            return false;
        }

        $permission = DataManager::getData($sender, "Permissions", "emporiumcore.command.warn");
        if ($permission === false) {
            $sender->sendMessage(TF::RED . "No permission");
            return false;
        }

        if (isset($args[0])) {
            $player = EmporiumCore::getPluginInstance()->getServer()->getPlayerExact($args[0]);
            if ($player instanceof Player) {
                $sender->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have warned {$player->getName()}.");
                $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have been warned by staff.");
                return true;
            }
            $sender->sendMessage(Variables::ERROR_PREFIX . TF::GRAY . "That player cannot be found.");
            return false;
        }
        $sender->sendMessage(Variables::ERROR_PREFIX . TF::GRAY . "Usage: /warn <player>");
        return false;
    }

}