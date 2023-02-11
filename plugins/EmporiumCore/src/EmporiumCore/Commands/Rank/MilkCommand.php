<?php

namespace EmporiumCore\Commands\Rank;

use EmporiumCore\Managers\Data\DataManager;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\player\Player;

use pocketmine\world\sound\PotionFinishBrewingSound;

class MilkCommand extends Command {

    public function __construct() {
        parent::__construct("milk", "Removes effects from player.", "/milk");
        $this->setPermission("emporiumcore.command.milk");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {

        if(!$sender instanceof Player) {
            return false;
        }

        $permission = DataManager::getData($sender, "Permissions", "emporiumcore.command.milk");
        if ($permission === false) {
            $sender->sendMessage("§cYou do not have permission to use this command.");
            return false;
        }

        $sender->getEffects()->clear();
        $sender->broadcastSound(new PotionFinishBrewingSound());
        return true;

    } # END OF EXECUTE

} # END OF CLASS