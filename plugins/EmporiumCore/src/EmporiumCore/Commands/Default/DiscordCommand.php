<?php

namespace EmporiumCore\Commands\Default;

use Emporium\Prison\Variables;
use EmporiumData\PermissionsManager;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;

class DiscordCommand extends Command {

    public function __construct() {
        parent::__construct("discord", "Sends player the Emporium Network Discord Server", "/discord");
        $this->setPermission("emporiumcore.command.discord");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {

        if(!$sender instanceof Player) return false;

        $permission = PermissionsManager::getInstance()->checkPermission($sender->getXuid(), $this->getPermissions());
        if (!$permission) {
            $sender->sendMessage(Variables::NO_PERMISSION_MESSAGE);
            return false;
        }

        $sender->sendMessage(TF::BOLD . TF::GOLD . "(!)" . TF::RESET . TF::GOLD . " Join our discord server!");
        $sender->sendMessage(TF::GOLD . "https://discord.gg/7TbbGK7pg4");
        return true;

    }

}