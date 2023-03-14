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

    public function getServerData(string $filename, string $key): mixed
    {
        return (new Config(self::$SERVER_FOLDER . $filename . ".json", Config::JSON))->getNested($key);
    }

    public function saveServerData(string $filename, string $key, mixed $data): void
    {
        $config = new Config(self::$SERVER_FOLDER . $filename . ".json", Config::JSON);

        $config->setNested($key, $data);
        $config->save();
    }
}