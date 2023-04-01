<?php

namespace EmporiumData\Provider;

use EmporiumData\Loader;
use pocketmine\player\Player;
use pocketmine\utils\Config;

class JsonProvider implements ProviderInterface
{
    public static string $SERVER_FOLDER;
    public static string $PLAYER_FOLDER;

    public function __construct(Loader $loader)
    {
        self::$PLAYER_FOLDER = $loader->getDataFolder() . Loader::PLAYER_FOLDER;
        self::$SERVER_FOLDER = $loader->getDataFolder() . Loader::SERVER_FOLDER;

        if (!is_dir(self::$SERVER_FOLDER)) mkdir(self::$SERVER_FOLDER);
        if (!is_dir(self::$PLAYER_FOLDER)) mkdir(self::$PLAYER_FOLDER);
    }

    public function getPlayerDataAll (string $xuid): array
    {
        return (new Config(self::$PLAYER_FOLDER . $xuid . ".json", Config::JSON))->getAll();
    }

    public function savePlayerDataAll(string $xuid, array $data): void
    {
        $config = new Config(self::$PLAYER_FOLDER . $xuid . ".json", Config::JSON);

        $config->setAll($data);
        $config->save();
    }

    public function getServerDataAll(string $filename): array
    {
        return (new Config(self::$SERVER_FOLDER . $filename . ".json", Config::JSON))->getAll();
    }

    public function saveServerDataAll (string $filename, array $data): void
    {
        $config = new Config(self::$SERVER_FOLDER . $filename . ".json", Config::JSON);

        $config->setAll($data);
        $config->save();
    }
}