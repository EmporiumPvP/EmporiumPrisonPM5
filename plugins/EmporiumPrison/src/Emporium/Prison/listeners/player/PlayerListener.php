<?php

namespace Emporium\Prison\listeners\player;

use Emporium\Prison\EmporiumPrison;
use Emporium\Prison\tasks\NPCUpdateTask;

use Tetro\EmporiumTutorial\EmporiumTutorial;

use pocketmine\event\inventory\CraftItemEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\Listener;
use pocketmine\world\Position;

class PlayerListener implements Listener {

    public function onJoin(PlayerJoinEvent $event): void {

        $player = $event->getPlayer();

        $tutorialManager = EmporiumTutorial::getInstance()->getTutorialManager();

        # check if player is in tutorial
        $tutorialComplete = $tutorialManager->checkPlayerTutorialComplete($player);

        if(!$tutorialComplete) {
            $player->teleport(new Position(-29.5, 154, -2.5, EmporiumPrison::getInstance()->getServer()->getWorldManager()->getWorldByName("TutorialMine")));
            $tutorialManager->startTutorial($player);
        }

        # update NPC names
        EmporiumPrison::getInstance()->getScheduler()->scheduleTask(new NPCUpdateTask());
    }

    public function onCraft(CraftItemEvent $event) {
        $event->cancel();
    }

}