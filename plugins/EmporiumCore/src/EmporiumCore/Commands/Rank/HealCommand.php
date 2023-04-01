<?php

namespace EmporiumCore\Commands\Rank;

use EmporiumCore\Variables;
use EmporiumData\PermissionsManager;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;

class HealCommand extends Command {

    public function __construct() {
        parent::__construct("heal", "sets players health to full", "/heal");
        $this->setPermission("emporiumcore.command.heal");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {

        if(!$sender instanceof Player) {
            return false;
        }

        $permission = PermissionsManager::getInstance()->checkPermission($sender->getXuid(),  "emporiumcore.command.heal");
        if (!$permission) {
            $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RED . "No permission");
            return false;
        }

        $maxHealth = $sender->getMaxHealth();
        if($sender->getHealth() === $maxHealth) {
            $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You are full HP!");
            return false;
        } else {
            $sender->setHealth($sender->getMaxHealth());
            $sender->sendMessage(Variables::SERVER_PREFIX . TF::GREEN . "Healed!");
            return true;
        }

    }

}