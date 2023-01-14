<?php

namespace Emporium\Prison\commands;

use Emporium\Prison\forms\Mines;
use Emporium\Prison\Loader;
use Emporium\Prison\Managers\DataManager;
use Emporium\Prison\Variables;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\player\Player;

use pocketmine\utils\TextFormat;
use pocketmine\utils\TextFormat as TF;
use pocketmine\world\Position;
use pocketmine\world\sound\EndermanTeleportSound;

class MinesCommand extends Command {

    public function __construct() {
        parent::__construct("mines", "Opens the Mine Menu", "/mines", ["mm", "mine"]);
        $this->setPermission("emporiumprison.command.mines");
        $this->setPermissionMessage(Variables::ERROR_PREFIX . TextFormat::RED . "No permission!");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {

        #$permission = DataManager::getOfflinePlayerData($sender, "permissions", "emporiumprison.command.mines");
        $playerLevel = DataManager::getOfflinePlayerData($sender, "Players", "level");

        if(!$sender instanceof Player) {
            return false;
        }

        /*
        if(!$permission) {
            return false;
        }*/

        if(isset($args[0])) {
            switch($args[0]) {
                case "info":
                    $form = new Mines();
                    $form->MinesInfoForm($sender);
                    break;

                case "coal":
                    if($playerLevel >= 5)
                    $sender->teleport(new Position(18.5, 111, -12.5, Loader::getInstance()->getServer()->getWorldManager()->getWorldByName("IronMine")));
                    $sender->broadcastSound(new EndermanTeleportSound(), [$sender]);
                    $sender->sendTitle(TF::BOLD . TF::GREEN . "MINE");
                    $sender->sendSubTitle(TF::GRAY . "Coal");
                    break;

                case "iron":
                    if($playerLevel >= 10) {
                        $sender->teleport(new Position(18.5, 111, -12.5, Loader::getInstance()->getServer()->getWorldManager()->getWorldByName("IronMine")));
                        $sender->broadcastSound(new EndermanTeleportSound(), [$sender]);
                        $sender->sendTitle(TF::BOLD . TF::GREEN . "MINE");
                        $sender->sendSubTitle(TF::WHITE . "Iron");
                    } else {
                        $sender->sendMessage(Variables::ERROR_PREFIX . "You need to be level 5 to access that mine!");
                    }
                    break;

                case "redstone":
                    if($playerLevel >= 15) {
                        $sender->teleport(new Position(18.5, 111, -12.5, Loader::getInstance()->getServer()->getWorldManager()->getWorldByName("RedstoneMine")));
                        $sender->broadcastSound(new EndermanTeleportSound(), [$sender]);
                        $sender->sendTitle(TF::BOLD . TF::GREEN . "MINE");
                        $sender->sendSubTitle(TF::RED . "Redstone");
                    } else {
                        $sender->sendMessage(Variables::ERROR_PREFIX . "You need to be level 10 to access that mine!");
                    }
                    break;

                case "lapis":
                    if($playerLevel >= 20) {
                        $sender->teleport(new Position(18.5, 111, -12.5, Loader::getInstance()->getServer()->getWorldManager()->getWorldByName("LapisMine")));
                        $sender->broadcastSound(new EndermanTeleportSound(), [$sender]);
                        $sender->sendTitle(TF::BOLD . TF::GREEN . "MINE");
                        $sender->sendSubTitle(TF::BLUE . "Lapis");
                    } else {
                        $sender->sendMessage(Variables::ERROR_PREFIX . "You need to be level 15 to access that mine!");
                    }
                    break;

                case "gold":
                    if($playerLevel >= 25) {
                        $sender->teleport(new Position(18.5, 111, -12.5, Loader::getInstance()->getServer()->getWorldManager()->getWorldByName("GoldMine")));
                        $sender->broadcastSound(new EndermanTeleportSound(), [$sender]);
                        $sender->sendTitle(TF::BOLD . TF::GREEN . "MINE");
                        $sender->sendSubTitle(TF::GOLD . "Gold");
                    } else {
                        $sender->sendMessage(Variables::ERROR_PREFIX . "You need to be level 20 to access that mine!");
                    }
                    break;

                case "diamond":
                    if($playerLevel >= 30) {
                        $sender->teleport(new Position(18.5, 111, -12.5, Loader::getInstance()->getServer()->getWorldManager()->getWorldByName("DiamondMine")));
                        $sender->broadcastSound(new EndermanTeleportSound(), [$sender]);
                        $sender->sendTitle(TF::BOLD . TF::GREEN . "MINE");
                        $sender->sendSubTitle(TF::AQUA . "Diamond");
                    } else {
                        $sender->sendMessage(Variables::ERROR_PREFIX . "You need to be level 25 to access that mine!");
                    }
                    break;

                case "emerald":
                    if($playerLevel >= 35) {
                        $sender->teleport(new Position(18.5, 111, -12.5, Loader::getInstance()->getServer()->getWorldManager()->getWorldByName("EmeraldMine")));
                        $sender->broadcastSound(new EndermanTeleportSound(), [$sender]);
                        $sender->sendTitle(TF::BOLD . TF::GREEN . "MINE");
                        $sender->sendSubTitle(TF::GREEN . "Emerald");
                    } else {
                        $sender->sendMessage(Variables::ERROR_PREFIX . "You need to be level 30 to access that mine!");
                    }
                    break;
            }
        }
        /* i need to make tutorial world first
        if($playerLevel >= 5) {
            $form = new Mines();
            $form->MinesForm($sender);
            return true;
        } else {
            $form = new Mines();
            $form->TutorialMineForm($sender);
            return true;
        } */

        $form = new Mines();
        $form->MinesForm($sender);
        return true;
    }
}