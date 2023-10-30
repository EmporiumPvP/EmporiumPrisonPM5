<?php

declare(strict_types=1);

namespace Emporium\Prison\area;

use diamondgold\MiniBosses\Boss;
use Emporium\Prison\EmporiumPrison;
use pocketmine\block\BlockTypeIds;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityTeleportEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;

class AreaListener implements Listener
{

    /** @var array */
    public array $safezone = [];

    /** @var array */
    public array $wilderness = [];

    /** @var array */
    private array $mineableBlocks = [
        BlockTypeIds::COAL_ORE,
        BlockTypeIds::COAL,
        BlockTypeIds::IRON_ORE,
        BlockTypeIds::IRON,
        BlockTypeIds::LAPIS_LAZULI_ORE,
        BlockTypeIds::LAPIS_LAZULI,
        BlockTypeIds::REDSTONE_ORE,
        BlockTypeIds::REDSTONE,
        BlockTypeIds::GOLD_ORE,
        BlockTypeIds::GOLD,
        BlockTypeIds::DIAMOND_ORE,
        BlockTypeIds::DIAMOND,
        BlockTypeIds::EMERALD_ORE,
        BlockTypeIds::EMERALD,
        BlockTypeIds::NETHER_QUARTZ_ORE
    ];

    /** @var EmporiumPrison */
    private EmporiumPrison $emporiumPrison;

    /**
     * @param EmporiumPrison $emporiumPrison
     */
    public function __construct(EmporiumPrison $emporiumPrison)
    {
        $this->emporiumPrison = $emporiumPrison;
    }

    /**
     * * @priority HIGHEST
     * @param EntityDamageEvent $event
     * @return void
     */
    public function onEntityDamage(EntityDamageEvent $event): void
    {

        $entity = $event->getEntity();
        $cause = $entity->getLastDamageCause();
        $areaManager = $this->emporiumPrison->getAreaManager();
        $areas = $areaManager->getAreasInPosition($entity->getPosition()->asPosition());

        # player attacking boss
        if ($entity instanceof Player and $cause instanceof Boss) return;
        # boss attacking player
        if ($entity instanceof Boss and $cause instanceof Player) return;

        # in area
        if ($areas !== null) {
            foreach ($areas as $area) {

                if ($area->getPvpFlag() === false) {
                    $event->cancel();
                    return;
                }
            }
        }
    }

    /**
     * @priority HIGHEST
     * @param BlockPlaceEvent $event
     * @return void
     */
    public function onBlockPlace(BlockPlaceEvent $event): void
    {

        $player = $event->getPlayer();
        $areaManager = $this->emporiumPrison->getAreaManager();
        $areas = $areaManager->getAreasInPosition($player->getPosition()->asPosition());

        # in wild
        if ($areas === null) {
            return;
        }

        # in an area
        foreach ($areas as $area) {
            if ($area->getEditFlag() === false) {
                $event->cancel();
                return;
            }
        }
    }

    /**
     * @priority HIGHEST
     * @param BlockBreakEvent $event
     * @return void
     */
    public function onBlockBreak(BlockBreakEvent $event): void
    {

        $block = $event->getBlock();
        $player = $event->getPlayer();
        $areaManager = $this->emporiumPrison->getAreaManager();
        $areas = $areaManager->getAreasInPosition($player->getPosition()->asPosition());

        # in wilderness
        if ($areas === null) {
            if (!in_array($block->getTypeId(), $this->mineableBlocks)) {
                #$event->cancel();
                return;
            }
        }

        # in an area
        if ($areas !== null) {
            foreach ($areas as $area) {
                if ($area->getEditFlag() === false) {
                    if (!in_array($block->getTypeId(), $this->mineableBlocks)) {
                        $event->cancel();
                        return;
                    }
                }
            }
        }

    }

    /**
     * @priority HIGHEST
     * @param PlayerMoveEvent $event
     * @return void
     */
    public function onPlayerMove(PlayerMoveEvent $event): void
    {

        $player = $event->getPlayer();
        $to = $event->getTo();
        $from = $event->getFrom();

        # anti void
        if ($to->getY() < 0) {
            if ($to->getWorld()->getFolderName() === $this->emporiumPrison->getServer()->getWorldManager()->getDefaultWorld()->getFolderName()) {
                $player->teleport($to->getWorld()->getSpawnLocation());
                return;
            }
        }

        $areaManager = $this->emporiumPrison->getAreaManager();
        $areas = $areaManager->getAreasInPosition($player->getPosition()->asPosition());

        # wilderness
        if ($areas === null) {
            if (!isset($this->wilderness[$player->getName()])) {
                $this->wilderness[$player->getName()] = $player;
                $player->sendTitle(TF::BOLD . TF::DARK_GREEN . "Wilderness", TF::RED . "PVP Enabled");
            }
            if (isset($this->safezone[$player->getName()])) {
                unset($this->safezone[$player->getName()]);
            }
        }

        if ($areas !== null) {

            foreach ($areas as $area) {

                # safe zones
                if ($area->getName() === "Spawn" && $area->isPositionInside($to) !== $area->isPositionInside($from)) {
                    $player->sendTitle(TF::BOLD . TF::GREEN . "Spawn" . TF::RESET, TF::GRAY . "You have entered a safe area.");
                }
                if ($area->getName() === "TutorialMine" && $area->isPositionInside($to) !== $area->isPositionInside($from)) {
                    $player->sendTitle(TF::BOLD . TF::GREEN . "Tutorial" . TF::RESET, TF::GRAY . "You have entered a safe area.");
                }

                # armour zones
                if ($area->getName() === "ChainZone" && $area->isPositionInside($to) !== $area->isPositionInside($from)) {
                    $player->sendTitle(" ", "(!) You entered the Chain Zone", 5, 20, 5);
                }
                if ($area->getName() === "GoldZone" && $area->isPositionInside($to) !== $area->isPositionInside($from)) {
                    $player->sendTitle(" ", "(!) You entered the Gold Zone", 5, 20, 5);
                }
                if ($area->getName() === "IronZone" && $area->isPositionInside($to) !== $area->isPositionInside($from)) {
                    $player->sendTitle("", "(!) You entered the Iron Zone", 5, 20, 5);
                }
                if ($area->getName() === "DiamondZone" && $area->isPositionInside($to) !== $area->isPositionInside($from)) {
                    $player->sendTitle("", "(!) You entered the Diamond Zone", 5, 20, 5);
                }

                # mines
                if ($area->getName() === "IronMine" && $area->isPositionInside($to) !== $area->isPositionInside($from)) {
                    $player->sendTitle(TF::BOLD . TF::GRAY . "Iron Mine", TF::GREEN . "PVP is disabled");
                }
                if ($area->getName() === "LapisMine" && $area->isPositionInside($to) !== $area->isPositionInside($from)) {
                    $player->sendTitle(TF::BOLD . TF::BLUE . "Lapis Mine", TF::GREEN . "PVP is disabled");
                }
                if ($area->getName() === "RedstoneMine" && $area->isPositionInside($to) !== $area->isPositionInside($from)) {
                    $player->sendTitle(TF::BOLD . TF::DARK_RED . "Redstone Mine", TF::GREEN . "PVP is disabled");
                }
                if ($area->getName() === "GoldMine" && $area->isPositionInside($to) !== $area->isPositionInside($from)) {
                    $player->sendTitle(TF::BOLD . TF::YELLOW . "Gold Mine", TF::GREEN . "PVP is disabled");
                }
                if ($area->getName() === "DiamondMine" && $area->isPositionInside($to) !== $area->isPositionInside($from)) {
                    $player->sendTitle(TF::BOLD . TF::AQUA . "Diamond Mine", TF::GREEN . "PVP is disabled");
                }
                if ($area->getName() === "EmeraldMine" && $area->isPositionInside($to) !== $area->isPositionInside($from)) {
                    $player->sendTitle(TF::BOLD . TF::GREEN . "Emerald Mine", TF::GREEN . "PVP is disabled");
                }

            }
        }
    }

    /**
     * @priority HIGHEST
     * @param EntityTeleportEvent $event
     * @return void
     */
    public function onTeleport(EntityTeleportEvent $event): void
    {

        $entity = $event->getEntity();

        $to = $event->getTo();
        $from = $event->getFrom();

        if (!$entity instanceof Player) return;

        $player = $entity;

        $areaManager = $this->emporiumPrison->getAreaManager();
        $areas = $areaManager->getAreasInPosition($to);

        if ($areas === null) {
            if (!isset($this->wilderness[$player->getName()])) {
                $this->wilderness[$player->getName()] = $player;
                $player->sendTitle(TF::BOLD . TF::DARK_GREEN . "WILDERNESS", TF::RED . "PVP Enabled");
            }
            if (isset($this->safezone[$player->getName()])) {
                unset($this->safezone[$player->getName()]);
            }
        }

        if ($areas !== null) {

            foreach ($areas as $area) {

                # safe zones
                if ($area->getName() === "Spawn" && $area->isPositionInside($to) !== $area->isPositionInside($from)) {
                    $player->sendTitle(TF::BOLD . TF::GREEN . "Spawn" . TF::RESET, TF::GRAY . "You have entered a safe area.");
                }
                if ($area->getName() === "TutorialMine" && $area->isPositionInside($to) !== $area->isPositionInside($from)) {
                    $player->sendTitle(TF::BOLD . TF::GREEN . "Tutorial" . TF::RESET, TF::GRAY . "You have entered a safe area.");
                }

                # armour zones
                if ($area->getName() === "ChainZone" && $area->isPositionInside($to) !== $area->isPositionInside($from)) {
                    $player->sendTitle(" ", "(!) You entered the Chain Zone", 5, 20, 5);
                }
                if ($area->getName() === "GoldZone" && $area->isPositionInside($to) !== $area->isPositionInside($from)) {
                    $player->sendTitle(" ", "(!) You entered the Gold Zone", 5, 20, 5);
                }
                if ($area->getName() === "IronZone" && $area->isPositionInside($to) !== $area->isPositionInside($from)) {
                    $player->sendTitle("", "(!) You entered the Iron Zone", 5, 20, 5);
                }
                if ($area->getName() === "DiamondZone" && $area->isPositionInside($to) !== $area->isPositionInside($from)) {
                    $player->sendTitle("", "(!) You entered the Diamond Zone", 5, 20, 5);
                }

                # mines
                if ($area->getName() === "IronMine" && $area->isPositionInside($to) !== $area->isPositionInside($from)) {
                    $player->sendTitle(TF::BOLD . TF::GRAY . "Iron Mine", TF::GREEN . "PVP is disabled");
                }
                if ($area->getName() === "LapisMine" && $area->isPositionInside($to) !== $area->isPositionInside($from)) {
                    $player->sendTitle(TF::BOLD . TF::BLUE . "Lapis Mine", TF::GREEN . "PVP is disabled");
                }
                if ($area->getName() === "RedstoneMine" && $area->isPositionInside($to) !== $area->isPositionInside($from)) {
                    $player->sendTitle(TF::BOLD . TF::DARK_RED . "Redstone Mine", TF::GREEN . "PVP is disabled");
                }
                if ($area->getName() === "GoldMine" && $area->isPositionInside($to) !== $area->isPositionInside($from)) {
                    $player->sendTitle(TF::BOLD . TF::YELLOW . "Gold Mine", TF::GREEN . "PVP is disabled");
                }
                if ($area->getName() === "DiamondMine" && $area->isPositionInside($to) !== $area->isPositionInside($from)) {
                    $player->sendTitle(TF::BOLD . TF::AQUA . "Diamond Mine", TF::GREEN . "PVP is disabled");
                }
                if ($area->getName() === "EmeraldMine" && $area->isPositionInside($to) !== $area->isPositionInside($from)) {
                    $player->sendTitle(TF::BOLD . TF::GREEN . "Emerald Mine", TF::GREEN . "PVP is disabled");
                }
            }
        }
    }

}