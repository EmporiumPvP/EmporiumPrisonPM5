<?php

namespace EmporiumCore\Commands\Default;

use EmporiumCore\Managers\Data\DataManager;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;

class DiscordCommand extends Command {

    public function __construct() {
        parent::__construct("discord", "Sends player the Emporium Network Discord Server", "/discord");
        $this->setPermission("emporiumcore.command.discord");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {

        if(!$sender instanceof Player) {
            return false;
        }

        $permission = DataManager::getData($sender, "Permissions", "emporiumcore.command.discord");
        if ($permission === false) {
            $sender->sendMessage(TextFormat::RED . "No permission");
            return false;
        }

        $sender->sendMessage('§a§l==============================');
        $sender->sendMessage('');
        $sender->sendMessage('         Join our discord server!');
        $sender->sendMessage('      §ehttps://discord.emporiumpvp.com');
        $sender->sendMessage('');
        $sender->sendMessage('§a§l==============================');
        return true;

    } # END OF EXECUTE

} # END OF CLASS