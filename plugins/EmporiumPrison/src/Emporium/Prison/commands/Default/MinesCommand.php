<?php

namespace Emporium\Prison\commands\Default;

use Emporium\Prison\Menus\Mines;

use Emporium\Prison\Variables;

use EmporiumCore\managers\data\DataManager;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\network\mcpe\protocol\types\DeviceOS;
use pocketmine\player\Player;

use pocketmine\utils\TextFormat as TF;
use pocketmine\world\sound\BarrelOpenSound;
use pocketmine\world\sound\ChestOpenSound;
use pocketmine\world\sound\PopSound;

class MinesCommand extends Command {

    public function __construct() {
        parent::__construct("mines", "Opens the Mine Menu", "/mines", ["mm", "mine"]);
        $this->setPermission("emporiumprison.command.mines");
        $this->setPermissionMessage(Variables::ERROR_PREFIX . TF::RED . "No permission.");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {

        if(!$sender instanceof Player) {
            return false;
        }

        $tutorialComplete = \Emporium\Prison\Managers\DataManager::getData($sender, "Players", "tutorial-complete");
        $permission = DataManager::getData($sender, "Permissions", "emporiumprison.command.mines");
        if(!$permission) {
            return false;
        }

        if(isset($args[0])) {
            $parameter = strtolower($args[0]);
            if($parameter === "info") {

                if(isset($args[1])) {
                    $mine = strtolower($args[1]);

                    switch($mine) {
                        case "coal":
                            $form = new Mines();
                            $form->coalMineInfo($sender);
                            break;

                        case "iron":
                            $form = new Mines();
                            $form->ironMineInfo($sender);
                            break;

                        case "redstone":
                            $form = new Mines();
                            $form->redstoneMineInfo($sender);
                            break;

                        case "lapis":
                            $form = new Mines();
                            $form->lapisMineInfo($sender);
                            break;

                        case "gold":
                            $form = new Mines();
                            $form->goldMineInfo($sender);
                            break;

                        case "diamond":
                            $form = new Mines();
                            $form->diamondMineInfo($sender);
                            break;

                        case "emerald":
                            $form = new Mines();
                            $form->emeraldMineInfo($sender);
                            break;

                        default:
                            $sender->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "That mine does not exist");
                            $sender->sendMessage("§r");
                            $sender->sendMessage(" Here are a list of available Mines:\n - Coal\n - Iron\n - Lapis\n - Redstone\n - Gold\n - Diamond\n - Emerald");
                            break;
                    }
                } else {
                    $form = new Mines();
                    $form->MinesInfoForm($sender);
                }
            }

        } elseif($tutorialComplete === false) {
            $sender->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You need to complete the tutorial to use that");
            $sender->broadcastSound(new PopSound(1), [$sender]);
            return true;
        } else {
            $extraData = $sender->getPlayerInfo()->getExtraData();
            switch($extraData["DeviceOS"]) {

                case DeviceOS::IOS:
                case DeviceOS::ANDROID:
                case DeviceOS::PLAYSTATION:
                case DeviceOS::XBOX:
                case DeviceOS::NINTENDO:
                    $sender->broadcastSound(new BarrelOpenSound(), [$sender]);
                    $form = new Mines();
                    $form->Form($sender);
                    break;

                case DeviceOS::WINDOWS_10:
                case DeviceOS::OSX:
                    $sender->broadcastSound(new ChestOpenSound(), [$sender]);
                    $menu = new Mines();
                    $menu->Inventory($sender);
                    break;
            }
        }
        return true;
    }
}