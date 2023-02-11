<?php

namespace EmporiumCore\Commands\Staff;

use EmporiumCore\Managers\Data\DataManager;

use EmporiumCore\Variables;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\player\GameMode;
use pocketmine\player\Player;

use pocketmine\utils\TextFormat as TF;

class CreativeCommand extends Command {

    public function __construct() {
        parent::__construct("creative", "Sets players gamemode to Creative", "/creative");
        $this->setPermission('emporiumcore.command.creative');
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {

        if(!$sender instanceof Player) {
            return false;
        }

        $permission = DataManager::getData($sender, "Permissions", "emporiumcore.command.creative");
        if ($permission === false) {
                $sender->sendMessage(TF::RED . "No permission.");
            return false;
        }

        if($sender->getGamemode() === GameMode::CREATIVE()) {
            $sender->sendMessage(Variables::ERROR_PREFIX . TF::RED . "You are already in creative!");
            return false;
        } else {
            $sender->setGamemode(GameMode::CREATIVE());
            $sender->sendMessage(Variables::SERVER_PREFIX . TF::GREEN . " are now in creative!");
            return true;
        }

    }

}