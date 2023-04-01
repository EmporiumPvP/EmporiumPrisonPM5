<?php

namespace EmporiumData\Provider;

use pocketmine\player\Player;

interface ProviderInterface
{

    public function getPlayerDataAll (string $xuid) : array;
    public function savePlayerDataAll (string $xuid, array $data) : void;

    public function getServerDataAll (string $filename) : array;
    public function saveServerDataAll (string $filename, array $data) : void;
}