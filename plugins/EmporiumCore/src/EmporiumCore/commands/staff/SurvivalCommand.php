<?php

namespace EmporiumCore\Commands\Staff;

use EmporiumCore\Managers\Data\DataManager;
use EmporiumCore\Variables;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\player\GameMode;
use pocketmine\player\Player;

use pocketmine\utils\TextFormat as TF;

class SurvivalCommand extends Command {

    public function __construct() {
        parent::__construct("survival", "Sets players gamemode to Survival", "/survival");
        $this->setPermission('emporiumcore.command.survival');
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {

        if(!$sender instanceof Player) {
            return false;
        }

        $permission = DataManager::getData($sender, "Permissions", "emporiumcore.command.survival");
        if ($permission === false) {
            $sender->sendMessage(TF::RED . "No permission");
            return false;
        }

        if($sender->getGamemode() === GameMode::SURVIVAL()) {
            $sender->sendMessage(Variables::ERROR_PREFIX . TF::GRAY . "You are already in Survival!");
            return false;
        } else {
            $sender->setGamemode(GameMode::SURVIVAL());
            $sender->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You are now in Survival!");
            return true;
        }

    }

}