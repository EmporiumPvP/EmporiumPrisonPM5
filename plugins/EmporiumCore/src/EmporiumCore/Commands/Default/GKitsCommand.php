<?php

namespace EmporiumCore\Commands\Default;

use EmporiumCore\Managers\Data\DataManager;

use Menus\GKitsMenu;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\event\server\DataPacketReceiveEvent;
use pocketmine\network\mcpe\JwtUtils;
use pocketmine\network\mcpe\protocol\LoginPacket;
use pocketmine\network\mcpe\protocol\types\DeviceOS;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;
use pocketmine\world\sound\EnderChestOpenSound;

class GKitsCommand extends Command implements Listener {

    private $deviceOS;

    public function __construct() {
        parent::__construct("gkits", "Opens the GKitsForms menu", "/gkits", ["gkit"]);
        $this->setPermission("emporiumcore.command.gkits");
    }

    public function onPacketReceive(DataPacketReceiveEvent $event) {

        $pk = $event->getPacket();
        if($pk instanceof LoginPacket) {
            $data = JwtUtils::parse($pk->clientDataJwt)[1]["ThirdPartyName"];
            $this->deviceOS[$data] = JwtUtils::parse($pk->clientDataJwt)[1]["DeviceOS"];
        }
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {

        if(!$sender instanceof Player) {
            return false;
        }

        $permission = DataManager::getData($sender, "Permissions", "emporiumcore.command.gkits");
        if ($permission === false) {
            $sender->sendMessage(TextFormat::RED . "No permission");
            return false;
        }

        # SEND FORM TO CORRECT OS
        $menu = new GKitsMenu();
        $extraData = $sender->getPlayerInfo()->getExtraData();
        switch($extraData["DeviceOS"]) {
            # SEND FORM
            case DeviceOS::IOS:
            case DeviceOS::ANDROID:
            case DeviceOS::PLAYSTATION:
            case DeviceOS::XBOX:
            case DeviceOS::NINTENDO:
                $menu->Form($sender);
                break;
            # SEND MENU
            case DeviceOS::WINDOWS_10:
            case DeviceOS::OSX:
                $menu->Inventory($sender);
                $sender->broadcastSound(new EnderChestOpenSound());
                return true;
        }

        return true;
    }

} # END OF CLASS