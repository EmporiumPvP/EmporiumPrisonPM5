<?php

declare(strict_types = 1);

namespace Emporium\Prison\area;

use Emporium\Prison\EmporiumPrison;
use pocketmine\world\Position;

class AreaManager {

    /** @var EmporiumPrison */
    private EmporiumPrison $emporiumPrison;

    /** @var Area[] */
    private array $areas = [];

    /**
     * AreaManager constructor.
     *
     * @param EmporiumPrison $emporiumPrison
     *
     * @throws AreaException
     */
    public function __construct(EmporiumPrison $emporiumPrison) {
        $this->emporiumPrison = $emporiumPrison;
        $emporiumPrison->getServer()->getPluginManager()->registerEvents(new AreaListener($emporiumPrison), $emporiumPrison);
        $this->init();
    }

    /**
     * @throws AreaException
     */
    public function init(): void {
        # spawn
        $this->addArea(new Area("Spawn",
            new Position(-1663, 0, -417, $this->emporiumPrison->getServer()->getWorldManager()->getWorldByName("world")),
            new Position(-1409, 255, -189, $this->emporiumPrison->getServer()->getWorldManager()->getWorldByName("world")), false, false));

        # tutorial mine
        $this->addArea(new Area("TutorialMine",
            new Position(72, 0, 138, $this->emporiumPrison->getServer()->getWorldManager()->getWorldByName("TutorialMine")),
            new Position(-437, 255, -190, $this->emporiumPrison->getServer()->getWorldManager()->getWorldByName("TutorialMine")), false, false));

        # zones
        $this->addArea(new Area("ChainZone",
            new Position(-1792, 0, -511, $this->emporiumPrison->getServer()->getWorldManager()->getWorldByName("world")),
            new Position(-963, 255, 510, $this->emporiumPrison->getServer()->getWorldManager()->getWorldByName("world")), true, false));
        $this->addArea(new Area("GoldZone",
            new Position(-960, 0, -511, $this->emporiumPrison->getServer()->getWorldManager()->getWorldByName("world")),
            new Position(-390, 255, 510, $this->emporiumPrison->getServer()->getWorldManager()->getWorldByName("world")), true, false));
        $this->addArea(new Area("IronZone",
            new Position(-386, 0, -511, $this->emporiumPrison->getServer()->getWorldManager()->getWorldByName("world")),
            new Position(253, 255, 510, $this->emporiumPrison->getServer()->getWorldManager()->getWorldByName("world")), true, false));
        $this->addArea(new Area("DiamondZone",
            new Position(256, 0, -511, $this->emporiumPrison->getServer()->getWorldManager()->getWorldByName("world")),
            new Position(1790, 255, 510, $this->emporiumPrison->getServer()->getWorldManager()->getWorldByName("world")), true, false));

        /*
        # mines
        $this->addArea(new Area("CoalMine",
            new Position(-1303, 0, -174, $this->emporiumPrison->getServer()->getWorldManager()->getWorldByName("world")),
            new Position(-1604, 255, 126, $this->emporiumPrison->getServer()->getWorldManager()->getWorldByName("world")), false, false));
        $this->addArea(new Area("IronMine",
            new Position(-1035, 0, 389, $this->emporiumPrison->getServer()->getWorldManager()->getWorldByName("world")),
            new Position(-1285, 255, 88, $this->emporiumPrison->getServer()->getWorldManager()->getWorldByName("world")), false, false));
        $this->addArea(new Area("LapisMine",
            new Position(-500, 0, -352, $this->emporiumPrison->getServer()->getWorldManager()->getWorldByName("world")),
            new Position(-937, 255, 46, $this->emporiumPrison->getServer()->getWorldManager()->getWorldByName("world")), false, false));
        $this->addArea(new Area("RedstoneMine",
            new Position(-608, 0, -509, $this->emporiumPrison->getServer()->getWorldManager()->getWorldByName("world")),
            new Position(-190, 255, 5, $this->emporiumPrison->getServer()->getWorldManager()->getWorldByName("world")), false, false));
        $this->addArea(new Area("GoldMine",
            new Position(214, 0, 106, $this->emporiumPrison->getServer()->getWorldManager()->getWorldByName("world")),
            new Position(-233, 255, -348, $this->emporiumPrison->getServer()->getWorldManager()->getWorldByName("world")), false, false));
        $this->addArea(new Area("DiamondMine",
            new Position(159, 0, 425, $this->emporiumPrison->getServer()->getWorldManager()->getWorldByName("world")),
            new Position(545, 255, 52, $this->emporiumPrison->getServer()->getWorldManager()->getWorldByName("world")), false, false));
        $this->addArea(new Area("EmeraldMine",
            new Position(1418, 0, -323, $this->emporiumPrison->getServer()->getWorldManager()->getWorldByName("world")),
            new Position(1063, 255, 32, $this->emporiumPrison->getServer()->getWorldManager()->getWorldByName("world")), false, false));
         *
         * mine areas dont work when they are inside an area (eg: coal & iron are inside chain area)
         */

        /*
         * TODO
         *
         * Badlands
         * Events (koth, boss arena etc)
         */
    }

    /**
     * @param Area $area
     */
    public function addArea(Area $area): void {
        $this->areas[] = $area;
    }

    /**
     * @param Position $position
     *
     * @return Area[]|null
     */
    public function getAreasInPosition(Position $position): ?array {
        $areas = $this->getAreas();
        $areasInPosition = [];
        foreach($areas as $area) {
            if($area->isPositionInside($position) === true) {
                $areasInPosition[] = $area;
            }
        }
        if(empty($areasInPosition)) {
            return null;
        }
        return $areasInPosition;
    }

    /**
     * @return Area[]
     */
    public function getAreas(): array {
        return $this->areas;
    }
}