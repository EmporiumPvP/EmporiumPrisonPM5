<?php

namespace Emporium\Prison\commands\Default;

use Emporium\Prison\Menus\Help;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\network\mcpe\protocol\types\DeviceOS;
use pocketmine\player\Player;
use pocketmine\world\sound\BarrelOpenSound;
use pocketmine\world\sound\ChestOpenSound;

class HelpCommand extends Command
{
    public function __construct()
    {
        parent::__construct("help");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {

        if(!$sender instanceof Player) {
            return false;
        }

        $helpMenu = new Help();
        $extraData = $sender->getPlayerInfo()->getExtraData();
        switch($extraData["DeviceOS"]) {

            case DeviceOS::IOS:
            case DeviceOS::ANDROID:
            case DeviceOS::PLAYSTATION:
            case DeviceOS::XBOX:
            case DeviceOS::NINTENDO:
                $sender->broadcastSound(new BarrelOpenSound(), [$sender]);
                $helpMenu->Form($sender);
                break;

            case DeviceOS::WINDOWS_10:
            case DeviceOS::OSX:
                $sender->broadcastSound(new ChestOpenSound(), [$sender]);
                $helpMenu->Inventory($sender);
                break;
        }
        return true;
    }
}