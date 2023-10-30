<?php

namespace Emporium\Prison\commands\Default;

use Emporium\Prison\EmporiumPrison;
use Emporium\Prison\tasks\TeleportTask;

use Emporium\Prison\Variables;
use EmporiumData\DataManager;

use EmporiumData\PermissionsManager;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;
use pocketmine\world\Position;
use pocketmine\world\sound\EndermanTeleportSound;

use Tetro\EmporiumTutorial\EmporiumTutorial;

class SpawnCommand extends Command {

    public function __construct() {
        parent::__construct("spawn", "Teleport to spawn", "/spawn");
        $this->setPermission("emporiumprison.command.spawn");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {

        $tutorialManager = EmporiumTutorial::getInstance()->getTutorialManager();

        if(!$sender instanceof Player) {
            return;
        }

        $permission = PermissionsManager::getInstance()->checkPermission($sender->getXuid(), $this->getPermissions());
        if(!$permission) {
            $sender->sendMessage(Variables::NO_PERMISSION_MESSAGE);
            return;
        }

        # check command cooldown
        $cooldown = DataManager::getInstance()->getPlayerData($sender->getXuid(), "cooldown.command.spawn");
        if($cooldown > 0) {
            $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "(" . TF::RED . "!" . TF::DARK_GRAY . ") " . TF::RESET . TF::RED . "You can use this again in $cooldown seconds");
            return;
        }

        # set command cooldown (10 seconds)
        DataManager::getInstance()->setPlayerData($sender->getXuid(), "cooldown.command.spawn", 10);

        if($tutorialManager->checkPlayerTutorialComplete($sender) === true) {
            $sender->broadcastSound(new EndermanTeleportSound(), [$sender]);
            $spawn = new Position(-1525.5, 169, -316.5, EmporiumPrison::getInstance()->getServer()->getWorldManager()->getWorldByName("world"));
            EmporiumPrison::getInstance()->getScheduler()->scheduleRepeatingTask(new TeleportTask($sender, $spawn, 10), 20);
            return;
        }
        $sender->broadcastSound(new EndermanTeleportSound(), [$sender]);
        $spawn = new Position(-29.5, 154, -2.5, EmporiumPrison::getInstance()->getServer()->getWorldManager()->getWorldByName("TutorialMine"));
        EmporiumPrison::getInstance()->getScheduler()->scheduleRepeatingTask(new TeleportTask($sender, $spawn, 10), 20);
    }
}