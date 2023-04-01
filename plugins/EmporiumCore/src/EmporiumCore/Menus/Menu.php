<?php

namespace EmporiumCore\Menus;

use pocketmine\network\mcpe\protocol\types\DeviceOS;
use pocketmine\player\Player;
use pocketmine\world\sound\BarrelOpenSound;
use pocketmine\world\sound\ChestOpenSound;

abstract class Menu
{
    public const PLATFORM_MOBILE = 0;
    public const PLATFORM_PC = 1;

    public function open (Player $player) : void
    {
        if ($this->checkPlatform($player) == self::PLATFORM_PC) {
            $player->broadcastSound(new ChestOpenSound(), [$player]);
            $this->Inventory($player);
            return;
        }

        $player->broadcastSound(new BarrelOpenSound(), [$player]);
        $this->Form($player);
    }

    public function checkPlatform (Player $player) : int
    {
        $extraData = $player->getPlayerInfo()->getExtraData();
        return match ($extraData["DeviceOS"]) {
            DeviceOS::WINDOWS_10, DeviceOS::OSX => self::PLATFORM_PC,
            default => self::PLATFORM_MOBILE,
        };
    }

    public function Inventory (Player $player) : void {}
    public function Form (Player $player) : void {}
}