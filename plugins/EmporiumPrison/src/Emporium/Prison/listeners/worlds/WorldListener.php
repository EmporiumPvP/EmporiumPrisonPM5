<?php

namespace Emporium\Prison\listeners\worlds;

use pocketmine\block\Fire;
use pocketmine\event\block\BlockSpreadEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\Listener;
use pocketmine\player\Player;

class WorldListener implements Listener
{

    private array $fallDamageProtectedWorlds = [
        "world",
        "TutorialMine",
        "ChainBadlands",
        "IronBadlands",
        "GoldBadlands",
        "DiamondBadlands"
    ];

    private array $fireSpreadProtectedWorlds = [
        "world",
        "TutorialMine",
        "ChainBadlands",
        "IronBadlands",
        "GoldBadlands",
        "DiamondBadlands"
    ];

    public function onNaturalDamage(EntityDamageEvent $event)
    {

        $entity = $event->getEntity();
        $world = $entity->getWorld()->getFolderName();
        $cause = $event->getCause();

        if ($entity instanceof Player) {
            if ($cause === EntityDamageEvent::CAUSE_FALL) {
                if (in_array($world, $this->fallDamageProtectedWorlds)) {
                    $event->cancel();
                }
            }
            if ($cause === EntityDamageEvent::CAUSE_FIRE ||
                $cause === EntityDamageEvent::CAUSE_FIRE_TICK ||
                $cause === EntityDamageEvent::CAUSE_DROWNING) {
                if (in_array($world, $this->fallDamageProtectedWorlds)) {
                    $event->cancel();
                }
            }
        }
    }
}