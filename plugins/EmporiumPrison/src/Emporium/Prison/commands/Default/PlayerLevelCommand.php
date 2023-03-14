<?php

namespace Emporium\Prison\commands\Default;


use Emporium\Prison\Menus\PlayerLevel;
use Emporium\Prison\Variables;

use EmporiumCore\managers\data\DataManager;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\network\mcpe\protocol\types\DeviceOS;

use pocketmine\player\Player;

use pocketmine\utils\TextFormat;
use pocketmine\world\sound\BarrelOpenSound;
use pocketmine\world\sound\ChestOpenSound;

class PlayerLevelCommand extends Command {

    public function __construct() {
        parent::__construct("level", "Opens Player Level Form", "/level", ["level", "pl"]);
        $this->setPermission("emporiumprison.command.playerlevel");
        $this->setPermissionMessage(Variables::ERROR_PREFIX . TextFormat::RED . "No permission!");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {

        if(!$sender instanceof Player) {
            return;
        }

        $permission = DataManager::getData($sender, "Permissions", "emporiumprison.command.playerlevel");
        if(!$permission) {
            return;
        }

        $playerLevel = new PlayerLevel();
        $extraData = $sender->getPlayerInfo()->getExtraData();
        switch($extraData["DeviceOS"]) {

            case DeviceOS::IOS:
            case DeviceOS::ANDROID:
            case DeviceOS::PLAYSTATION:
            case DeviceOS::XBOX:
            case DeviceOS::NINTENDO:
                $sender->broadcastSound(new BarrelOpenSound(), [$sender]);
                $playerLevel->Form($sender);
                break;

            case DeviceOS::WINDOWS_10:
            case DeviceOS::OSX:
                $sender->broadcastSound(new ChestOpenSound(), [$sender]);
                $playerLevel->Inventory($sender);
                break;
        }
    }
}