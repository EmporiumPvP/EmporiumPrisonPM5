<?php

namespace EmporiumData\Rank;

use pocketmine\utils\TextFormat;

class Rank
{
    private string $name;
    private string $format;
    private string $inheritance;
    private array $permissions;


    public function __construct(string $rank, string $format, string $inheritance, array $permissions)
    {
        $this->name = $rank;
        $this->format = TextFormat::colorize($format);
        $this->inheritance = $inheritance;
        $this->permissions = $permissions;
    }

    /**
     * @return string
     */
    public function getFormat(): string
    {
        return $this->format;
    }

    /**
     * @return string
     */
    public function getInheritance(): string
    {
        return $this->inheritance;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getPermissions(): array
    {
        return $this->permissions;
    }


}