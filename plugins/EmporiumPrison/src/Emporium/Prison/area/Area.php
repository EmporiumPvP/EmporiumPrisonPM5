<?php

declare(strict_types = 1);

namespace Emporium\Prison\area;

use pocketmine\world\Position;
use pocketmine\world\World;

class Area {

    /** @var string */
    private string $name;

    /** @var Position */
    private Position $firstPosition;

    /** @var Position */
    private Position $secondPosition;

    /** @var World|null */
    private ?World $world;

    /**
     * Area constructor.
     *
     * @param string $name
     * @param Position $firstPosition
     * @param Position $secondPosition
     *
     * @throws AreaException
     */
    public function __construct(string $name, Position $firstPosition, Position $secondPosition) {
        $this->firstPosition = $firstPosition;
        $this->secondPosition = $secondPosition;
        $this->name = $name;
        $this->world = $firstPosition->getWorld()->getDisplayName() === $secondPosition->getWorld()->getDisplayName() ? $firstPosition->getWorld() : null;
        if($this->world === null) {
            throw new AreaException("Area \"$name\"'s first position's world does not equal the second position's world.");
        }
    }

    /**
     * @param Position $position
     *
     * @return bool
     */
    public function isPositionInside(Position $position): bool {
        $world = $position->getWorld();
        $firstPosition = $this->firstPosition;
        $secondPosition = $this->secondPosition;
        $minX = min($firstPosition->getX(), $secondPosition->getX());
        $maxX = max($firstPosition->getX(), $secondPosition->getX());
        $minY = min($firstPosition->getY(), $secondPosition->getY());
        $maxY = max($firstPosition->getY(), $secondPosition->getY());
        $minZ = min($firstPosition->getZ(), $secondPosition->getZ());
        $maxZ = max($firstPosition->getZ(), $secondPosition->getZ());
        return $minX <= $position->getX() and $maxX >= $position->getX() and $minY <= $position->getY() and
            $maxY >= $position->getY() and $minZ <= $position->getZ() and $maxZ >= $position->getZ() and
            $this->world->getDisplayName() === $world->getDisplayName();
    }

    /**
     * @return Position
     */
    public function getFirstPosition(): Position {
        return $this->firstPosition;
    }

    /**
     * @return Position
     */
    public function getSecondPosition(): Position {
        return $this->secondPosition;
    }

    /**
     * @return World
     */
    public function getWorld(): World {
        return $this->world;
    }

    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }
}