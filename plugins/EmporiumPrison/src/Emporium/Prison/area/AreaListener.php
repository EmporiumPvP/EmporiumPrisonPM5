<?php

declare(strict_types = 1);

namespace Emporium\Prison\area;

use diamondgold\MiniBosses\Boss;
use Emporium\Prison\EmporiumPrison;

use pocketmine\block\BlockIdentifier;
use pocketmine\block\BlockLegacyIds;
use pocketmine\entity\Entity;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityTeleportEvent;
use pocketmine\event\entity\ProjectileLaunchEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;

class AreaListener implements Listener {

    /** @var EmporiumPrison */
    private EmporiumPrison $emporiumPrison;

    /** @var array */
    public array $safezone = [];

    /** @var array */
    public array $warzone = [];

     /** @var array */
    public array $wilderness = [];

    /**
     * AreaListener constructor.
     *
     * @param EmporiumPrison $emporiumPrison
     */
    public function __construct(EmporiumPrison $emporiumPrison)
    {
        $this->emporiumPrison = $emporiumPrison;
    }

    /**
     * @priority HIGH
     * @param PlayerMoveEvent $event
     */
    public function onPlayerMove(PlayerMoveEvent $event): void {
        $player = $event->getPlayer();
        $to = $event->getTo();
        $from = $event->getFrom();
        if($to->getY() < 0) {
            if($to->getWorld()->getFolderName() === $this->emporiumPrison->getServer()->getWorldManager()->getDefaultWorld()->getFolderName()) {
                $player->teleport($to->getWorld()->getSpawnLocation());
                return;
            }
        }
        
        $areaManager = $this->emporiumPrison->getAreaManager();
        $areas = $areaManager->getAreasInPosition($player->getPosition()->asPosition());
        if($areas !== null) {
            foreach($areas as $area) {
                if($area->getName() === "Spawn" && $area->isPositionInside($to) !== $area->isPositionInside($from)) {
                    $player->sendTitle(TF::BOLD . TF::GREEN . "Spawn" . TF::RESET, TF::GRAY . "You have entered a safe area.");
                }
                if($area->getName() === "TutorialMine" && $area->isPositionInside($to) !== $area->isPositionInside($from)) {
                    $player->sendTitle(TF::BOLD . TF::GREEN . "Tutorial Mine" . TF::RESET, TF::GRAY . "You have entered a safe area.");
                }
                if($area->getName() === "CoalMine" && $area->isPositionInside($to) !== $area->isPositionInside($from)) {
                    $player->sendTitle(TF::BOLD . TF::DARK_GRAY . "Coal Mine", "§7PVP is disabled");
                }
                if($area->getName() === "IronMine" && $area->isPositionInside($to) !== $area->isPositionInside($from)) {
                    $player->sendTitle(TF::BOLD . TF::GRAY . "Iron Mine", "§7PVP is disabled");
                }
                if($area->getName() === "LapisMine" && $area->isPositionInside($to) !== $area->isPositionInside($from)) {
                    $player->sendTitle(TF::BOLD . TF::BLUE . "Lapis Mine", "§7PVP is disabled");
                }
                if($area->getName() === "RedstoneMine" && $area->isPositionInside($to) !== $area->isPositionInside($from)) {
                    $player->sendTitle(TF::BOLD . TF::DARK_RED . "Redstone Mine", "§7PVP is disabled");
                }
                if($area->getName() === "GoldMine" && $area->isPositionInside($to) !== $area->isPositionInside($from)) {
                    $player->sendTitle(TF::BOLD . TF::YELLOW . "Gold Mine", "§7PVP is disabled");
                }
                if($area->getName() === "DiamondMine" && $area->isPositionInside($to) !== $area->isPositionInside($from)) {
                    $player->sendTitle(TF::BOLD . TF::AQUA . "Diamond Mine", "§7PVP is disabled");
                }
                if($area->getName() === "EmeraldMine" && $area->isPositionInside($to) !== $area->isPositionInside($from)) {
                    $player->sendTitle(TF::BOLD . TF::GREEN . "Emerald Mine", "§7PVP is disabled");
                }
            }
        }
        #if($areas !== null) {
        #    foreach($areas as $area) {
        #        if($area->getName() === "WarzoneArena") {
        #            return;
        #        }
        #        if(isset($this->warzone[$player->getName()]) && isset($this->safezone[$player->getName()])) {
        #            return;
        #        }
        #        if($area->getPvpFlag() === false && !isset($this->safezone[$player->getName()])) {
        #            if(isset($this->warzone[$player->getName()])) {
        #                unset($this->warzone[$player->getName()]);
        #            }
        #            $this->safezone[$player->getName()] = $player;
        #            $player->sendTitle("§l§aSAFEZONE§r", "§7You have entered a safe area.");
        #            return;
        #        } 
        #        if($area->getPvpFlag() === true && !isset($this->warzone[$player->getName()])) {
        #            if(isset($this->safezone[$player->getName()])) {
        #                unset($this->safezone[$player->getName()]);
        #            }
        #            $this->warzone[$player->getName()] = $player;
        #            $player->sendTitle("§l§4WARZONE§r", "§7You have entered a non-safe area.");
        #            return;
        #        }
        #    }
        #}
        if($areas === null) {
            if(!isset($this->wilderness[$player->getName()])) {
                $this->wilderness[$player->getName()] = $player;
                $player->sendTitle("§l§2WILDERNESS§r", "§7You have entered the wilderness.");
            }
            if(isset($this->safezone[$player->getName()])) {
                unset($this->safezone[$player->getName()]);
            }
        }
    }

    public function onTeleport(EntityTeleportEvent $event): void {

        $entity = $event->getEntity();

        $to = $event->getTo();
        $from = $event->getFrom();

        if(!$entity instanceof Player) return;

        $player = $entity;

        $areaManager = $this->emporiumPrison->getAreaManager();
        $areas = $areaManager->getAreasInPosition($to);
        if($areas !== null) {
            foreach($areas as $area) {
                if($area->getName() === "Spawn" && $area->isPositionInside($to) !== $area->isPositionInside($from)) {
                    $player->sendTitle(TF::BOLD . TF::GREEN . "Spawn" . TF::RESET, TF::GRAY . "You have entered a safe area.");
                }
                if($area->getName() === "TutorialMine" && $area->isPositionInside($to) !== $area->isPositionInside($from)) {
                    $player->sendTitle(TF::BOLD . TF::GREEN . "Tutorial Mine" . TF::RESET, TF::GRAY . "You have entered a safe area.");
                }
                if($area->getName() === "CoalMine" && $area->isPositionInside($to) !== $area->isPositionInside($from)) {
                    $player->sendTitle(TF::BOLD . TF::DARK_GRAY . "Coal Mine", "§7PVP is disabled");
                }
                if($area->getName() === "IronMine" && $area->isPositionInside($to) !== $area->isPositionInside($from)) {
                    $player->sendTitle(TF::BOLD . TF::GRAY . "Iron Mine", "§7PVP is disabled");
                }
                if($area->getName() === "LapisMine" && $area->isPositionInside($to) !== $area->isPositionInside($from)) {
                    $player->sendTitle(TF::BOLD . TF::BLUE . "Lapis Mine", "§7PVP is disabled");
                }
                if($area->getName() === "RedstoneMine" && $area->isPositionInside($to) !== $area->isPositionInside($from)) {
                    $player->sendTitle(TF::BOLD . TF::DARK_RED . "Redstone Mine", "§7PVP is disabled");
                }
                if($area->getName() === "GoldMine" && $area->isPositionInside($to) !== $area->isPositionInside($from)) {
                    $player->sendTitle(TF::BOLD . TF::YELLOW . "Gold Mine", "§7PVP is disabled");
                }
                if($area->getName() === "DiamondMine" && $area->isPositionInside($to) !== $area->isPositionInside($from)) {
                    $player->sendTitle(TF::BOLD . TF::AQUA . "Diamond Mine", "§7PVP is disabled");
                }
                if($area->getName() === "EmeraldMine" && $area->isPositionInside($to) !== $area->isPositionInside($from)) {
                    $player->sendTitle(TF::BOLD . TF::GREEN . "Emerald Mine", "§7PVP is disabled");
                }
            }
        }
    }

}