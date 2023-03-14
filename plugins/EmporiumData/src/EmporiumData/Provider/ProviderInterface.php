<?php

namespace EmporiumData\Provider;

use pocketmine\player\Player;

interface ProviderInterface
{

    public function getPlayerDataAll (string $xuid) : array;

    public function savePlayerDataAll (string $xuid, array $data) : void;

    public function saveServerData (string $filename, string $key, mixed $data) : void;
    public function getServerData (string $filename, string $key) : mixed;
}