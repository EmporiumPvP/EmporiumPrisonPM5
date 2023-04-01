<?php

namespace EmporiumCore\Commands\Rank;

use EmporiumCore\Variables;
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

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {

        if(!$sender instanceof Player) {
            return false;
        }

        $permission = PermissionsManager::getInstance()->checkPermission($sender->getXuid(),  "emporiumcore.command.feed");
        if (!$permission) {
            $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RED . "No permission.");
            return false;
        }

        $hunger = $sender->getHungerManager()->getFood();
        if($hunger == 20) {
            $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You are not hungry!");
            return false;
        } else {
            $sender->getHungerManager()->setFood(20);
            $sender->getHungerManager()->setSaturation(20);
            $sender->broadcastSound(new BurpSound());
            $sender->sendMessage(Variables::SERVER_PREFIX . TF::GREEN . "Fed!");
            return true;
        }

    } # END OF EXECUTE

} # END OF CLASS