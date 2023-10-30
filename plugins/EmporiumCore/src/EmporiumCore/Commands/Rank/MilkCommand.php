<?php

namespace EmporiumCore\Commands\Rank;

use Emporium\Prison\Variables;
use EmporiumData\DataManager;
use EmporiumData\PermissionsManager;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;
use pocketmine\world\sound\PotionFinishBrewingSound;

class MilkCommand extends Command {

    public function __construct() {
        parent::__construct("milk", "Removes effects from player.", "/milk");
        $this->setPermission("emporiumcore.command.milk");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): void {

        if(!$sender instanceof Player) return;

        $permission = PermissionsManager::getInstance()->checkPermission($sender->getXuid(), $this->getPermissions());
        if (!$permission) {
            $sender->sendMessage(Variables::NO_PERMISSION_MESSAGE);
            return;
        }

        # check command cooldown
        $cooldown = DataManager::getInstance()->getPlayerData($sender->getXuid(), "cooldown.command.milk");
        if($cooldown > 0) {
            $sender->sendMessage(Variables::PREFIX . "You can use this again in $cooldown seconds");
            return;
        }

        # set command cooldown (60 seconds)
        DataManager::getInstance()->setPlayerData($sender->getXuid(), "cooldown.command.milk", 60);

        $sender->getEffects()->clear();
        $sender->broadcastSound(new PotionFinishBrewingSound());

    } # END OF EXECUTE

} # END OF CLASS