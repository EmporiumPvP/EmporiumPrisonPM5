<?php

namespace EmporiumCore\Commands\Rank;

use EmporiumCore\Variables;
use EmporiumData\DataManager;
use EmporiumData\PermissionsManager;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;
use pocketmine\world\sound\BurpSound;

class FeedCommand extends Command {

    public function __construct() {
        parent::__construct("feed", "Sets players hunger to full", "/feed");
        $this->setPermission("emporiumcore.command.feed");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): void {

        if(!$sender instanceof Player) {
            return;
        }

        # check command cooldown
        $cooldown = DataManager::getInstance()->getPlayerData($sender->getXuid(), "cooldown.command.feed");
        if($cooldown > 0) {
            $sender->sendMessage(\Emporium\Prison\Variables::PREFIX . "You can use this again in $cooldown seconds");
            return;
        }

        # set command cooldown (10 seconds)
        DataManager::getInstance()->setPlayerData($sender->getXuid(), "cooldown.command.feed", 60);

        $permission = PermissionsManager::getInstance()->checkPermission($sender->getXuid(),  $this->getPermissions());
        if (!$permission) {
            $sender->sendMessage(\Emporium\Prison\Variables::NO_PERMISSION_MESSAGE);
            return;
        }

        $hunger = $sender->getHungerManager()->getFood();
        if($hunger == 20) {
            $sender->sendMessage(\Emporium\Prison\Variables::PREFIX . "You are not hungry!");
            return;
        }
        $sender->getHungerManager()->setFood(20);
        $sender->getHungerManager()->setSaturation(20);
        $sender->broadcastSound(new BurpSound());
        $sender->sendMessage(Variables::SERVER_PREFIX . TF::GREEN . "Fed!");

    } # END OF EXECUTE

} # END OF CLASS