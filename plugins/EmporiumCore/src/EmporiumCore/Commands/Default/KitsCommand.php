<?php

namespace EmporiumCore\Commands\Default;

use EmporiumCore\Managers\Data\DataManager;

use Menus\KitsMenu;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\network\mcpe\protocol\types\DeviceOS;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;
use pocketmine\world\sound\EnderChestOpenSound;

# POCKETMINE

class KitsCommand extends Command {

    public function __construct() {
        parent::__construct("kits", "Opens the RankKits Menu", "/kits", ["kit"]);
        $this->setPermission("emporiumcore.command.kits");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {

        if(!$sender instanceof Player) {
            return false;
        }

        $permission = DataManager::getData($sender, "Permissions", "emporiumcore.command.kits");
        if ($permission === false) {
            $sender->sendMessage(TextFormat::RED . "No permission");
            return false;
        }

        $extraData = $sender->getPlayerInfo()->getExtraData();
        switch($extraData["DeviceOS"]) {

            case DeviceOS::IOS:
            case DeviceOS::ANDROID:
            case DeviceOS::PLAYSTATION:
            case DeviceOS::XBOX:
            case DeviceOS::NINTENDO:
                $form = new KitsMenu();
                $form->Form($sender);
                $sender->broadcastSound(new EnderChestOpenSound());
                break;

            case DeviceOS::WINDOWS_10:
            case DeviceOS::OSX:
                $menu = new KitsMenu();
                $menu->Inventory($sender);
                $sender->broadcastSound(new EnderChestOpenSound());
                break;
        }
        return true;
    }
}