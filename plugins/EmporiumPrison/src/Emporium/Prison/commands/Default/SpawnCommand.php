<?php

namespace Emporium\Prison\commands\Default;

use Emporium\Prison\EmporiumPrison;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\player\Player;

use pocketmine\world\Position;

use pocketmine\world\sound\EndermanTeleportSound;
use Tetro\EPTutorial\Managers\TutorialManager;

class SpawnCommand extends Command {

    public function __construct() {
        parent::__construct("spawn", "Teleport to spawn", "/spawn");
        $this->setPermission("emporiumprison.command.spawn");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {

        $tutorialManager = new TutorialManager();

        if(!$sender instanceof Player) {
            return;
        }

        if($tutorialManager->tutorialComplete($sender) === false) {
            $sender->broadcastSound(new EndermanTeleportSound(), [$sender]);
            $sender->teleport(new Position(-29.5, 154, -2.5, EmporiumPrison::getInstance()->getServer()->getWorldManager()->getWorldByName("TutorialMine")));
        } else {
            $sender->broadcastSound(new EndermanTeleportSound(), [$sender]);
            $sender->teleport(new Position(-1525.5, 169, -316.5, EmporiumPrison::getInstance()->getServer()->getWorldManager()->getWorldByName("world")));
        }
    }
}