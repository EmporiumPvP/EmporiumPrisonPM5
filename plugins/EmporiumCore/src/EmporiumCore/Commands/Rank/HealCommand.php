<?php

namespace EmporiumCore\Commands\Rank;

use EmporiumCore\Variables;
use EmporiumData\DataManager;
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

    public function execute(CommandSender $sender, string $commandLabel, array $args): void {

        if(!$sender instanceof Player) return;

        $permission = PermissionsManager::getInstance()->checkPermission($sender->getXuid(),  $this->getPermissions());
        if (!$permission) {
            $sender->sendMessage(\Emporium\Prison\Variables::NO_PERMISSION_MESSAGE);
            return;
        }

        # check command cooldown
        $cooldown = DataManager::getInstance()->getPlayerData($sender->getXuid(), "cooldown.command.heal");
        if($cooldown > 0) {
            $sender->sendMessage(\Emporium\Prison\Variables::PREFIX . "You can use this again in $cooldown seconds");
            return;
        }

        # set command cooldown (10 seconds)
        DataManager::getInstance()->setPlayerData($sender->getXuid(), "cooldown.command.heal", 60);

        $maxHealth = $sender->getMaxHealth();
        if($sender->getHealth() === $maxHealth) {
            $sender->sendMessage(\Emporium\Prison\Variables::PREFIX . "You are full HP");
            return;
        }
        $sender->setMaxHealth($sender->getMaxHealth());
        $sender->sendMessage(Variables::SERVER_PREFIX . TF::GREEN . "Healed!");
    }

}