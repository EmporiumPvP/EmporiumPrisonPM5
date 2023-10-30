<?php

namespace Emporium\Prison\listeners\bosses;

use diamondgold\MiniBosses\Boss;

use EmporiumData\DataManager;

use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Listener;
use pocketmine\player\Player;

class BossListener implements Listener
{

    private array $bosses = ["hades", "apollo", "poseidon", "zeus"];


    public function onKillBoss(EntityDamageByEntityEvent $event) {

        $entity = $event->getEntity();
        $cause = $entity->getLastDamageCause();
        $entityName = $entity->getName();

        if(!$entity instanceof Boss) return;

        if(!in_array($entityName, $this->bosses)) return;

        var_dump($cause);

        if($cause instanceof Player) {
            $player = $cause;

            $player->sendMessage("You killed $entityName");
            DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.bosskills", DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.bosskills") + 1);
        }
    }
}