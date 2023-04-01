<?php

namespace Emporium\Prison\listeners\worlds;

use diamondgold\MiniBosses\Boss;

use pocketmine\block\BlockLegacyIds;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\Listener;
use pocketmine\player\Player;

class WorldListener implements Listener {

    private array $ores = [
        BlockLegacyIds::COAL_ORE,
        BlockLegacyIds::COAL_BLOCK,
        BlockLegacyIds::IRON_ORE,
        BlockLegacyIds::IRON_BLOCK,
        BlockLegacyIds::LAPIS_ORE,
        BlockLegacyIds::LAPIS_BLOCK,
        BlockLegacyIds::REDSTONE_ORE,
        BlockLegacyIds::LIT_REDSTONE_ORE,
        BlockLegacyIds::REDSTONE_BLOCK,
        BlockLegacyIds::GOLD_ORE,
        BlockLegacyIds::GOLD_BLOCK,
        BlockLegacyIds::DIAMOND_ORE,
        BlockLegacyIds::DIAMOND_BLOCK,
        BlockLegacyIds::EMERALD_ORE,
        BlockLegacyIds::EMERALD_BLOCK,
        BlockLegacyIds::QUARTZ_ORE
    ];

    private array $buildProtectedWorlds = [
        "world",
        "TutorialMine",
        "ChainBadlands",
        "IronBadlands",
        "GoldBadlands",
        "DiamondBadlands"
    ];

    private array $pvpProtectedWorlds = [
        "world",
        "TutorialMine",
        "ChainBadlands",
        "IronBadlands",
        "GoldBadlands",
        "DiamondBadlands"
    ];

    private  array $fallDamageProtectedWorlds = [
        "world",
        "TutorialMine",
        "ChainBadlands",
        "IronBadlands",
        "GoldBadlands",
        "DiamondBadlands"
    ];

    /**
     * @priority HIGHEST
     */
    public function onBreak(BlockBreakEvent $event) {

        $player = $event->getPlayer();
        $world = $player->getWorld()->getFolderName();
        $blockId = $event->getBlock()->getIdInfo()->getBlockId();


        if(in_array($world, $this->buildProtectedWorlds)) {
            if(!in_array($blockId, $this->ores)) {
                $event->cancel();
            }
        }
    }

    public function onPlace(BlockPlaceEvent $event) {

        $world = $event->getPlayer()->getWorld()->getFolderName();

        if(in_array($world, $this->buildProtectedWorlds)) {
            $event->cancel();
        }
    }

    public function onAttack(EntityDamageByEntityEvent $event) {

        $world = $event->getDamager()->getWorld()->getFolderName();
        $damager = $event->getDamager();
        $entity = $event->getEntity();

        if(in_array($world, $this->pvpProtectedWorlds)) {

            if($damager instanceof Boss && $entity instanceof Player) return;
            if($damager instanceof Player && $entity instanceof Boss) return;

            if($damager instanceof Player && $entity instanceof Player) {
                $event->cancel();
            }
        }
    }

    public function onNaturalDamage(EntityDamageEvent $event) {

        $entity = $event->getEntity();
        $world = $entity->getWorld()->getFolderName();
        $cause = $event->getCause();

        if($entity instanceof Player) {
            if($cause === EntityDamageEvent::CAUSE_FALL) {
                if(in_array($world, $this->fallDamageProtectedWorlds)) {
                    $event->cancel();
                }
            }
            if($cause === EntityDamageEvent::CAUSE_FIRE ||
                $cause === EntityDamageEvent::CAUSE_FIRE_TICK ||
                $cause === EntityDamageEvent::CAUSE_DROWNING) {
                if(in_array($world, $this->fallDamageProtectedWorlds)) {
                    $event->cancel();
                }
            }
        }
    }

}