<?php

namespace EmporiumData\Rank;

use EmporiumData\Provider\JsonProvider;
use pocketmine\utils\Config;

class RankManager
{
    /** @var array<string, Rank> */
    private array $ranks = [];

    public static self $instance;

    public function __construct()
    {
        self::$instance = $this;
        $this->loadRanks();
    }

    private function loadRanks () : void
    {
        $file = new Config(JsonProvider::$SERVER_FOLDER . "ranks.yml", Config::YAML);

        foreach ($file->getAll() as $rank => $data) $this->ranks[$rank] = new Rank($rank, $data["format"] ?? "", $data["inheritance"] ?? "", $data["permissions"] ?? []);
    }

    public function getRank (string $name) : Rank
    {
        return $this->ranks[$name];
    }

    /**
     * @return array<string, Rank>
     */
    public function getRanks(): array
    {
        return $this->ranks;
    }

    /**
     * @return RankManager
     */
    public static function getInstance(): RankManager
    {
        return self::$instance;
    }
}