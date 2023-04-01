<?php

namespace EmporiumCore\Commands\Staff;

use EmporiumData\PermissionsManager;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;

class BossCommand extends Command {

    public function __construct() {
        parent::__construct("boss", "main boss command", "/boss");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {

        if(!$sender instanceof Player) {
            return;
        }

        $permission = PermissionsManager::getInstance()->checkPermission($sender->getXuid(), "emporiumcore.command.boss");
        if(!$permission) {
            $sender->sendMessage(TextFormat::RED . "No permission");
            return;
        }

        /*
         * TODO
         *
         * create menu which shows all bosses and when they will next spawn
         *
         * add args to spawn specific boss
         * add args to remove boss
         * add args to disable boss
         *
         */
        #Main::getInstance()->spawnBoss("coal_bandit");
    }
}