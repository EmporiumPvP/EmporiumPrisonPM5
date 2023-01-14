<?php

namespace Emporium\Prison\forms;

use Emporium\Prison\library\formapi\SimpleForm;
use Emporium\Prison\Loader;
use Emporium\Prison\Managers\DataManager;
use Emporium\Prison\Variables;

use pocketmine\player\Player;

use pocketmine\utils\TextFormat as TF;

use pocketmine\world\Position;
use pocketmine\world\sound\EndermanTeleportSound;

class Mines {

    public function MinesForm(Player $player): SimpleForm {

        $form = new SimpleForm(function($player, $data) {

            $playerLevel = DataManager::getOfflinePlayerData($player, "Players", "level");

            if($data === null) {
                return;
            }
            switch($data) {

                case 0: # coal mine
                    $player->teleport(new Position(18.5, 111, -12.5, Loader::getInstance()->getServer()->getWorldManager()->getWorldByName("IronMine")));
                    $player->broadcastSound(new EndermanTeleportSound(), [$player]);
                    $player->sendTitle(TF::BOLD . TF::GREEN . "MINE");
                    $player->sendSubTitle(TF::GRAY . "Coal");
                    break;

                case 1: # iron mine (level 5 required)
                    if($playerLevel <= 5) {
                        $player->teleport(new Position(18.5, 111, -12.5, Loader::getInstance()->getServer()->getWorldManager()->getWorldByName("IronMine")));
                        $player->broadcastSound(new EndermanTeleportSound(), [$player]);
                        $player->sendTitle(TF::BOLD . TF::GREEN . "MINE");
                        $player->sendSubTitle(TF::WHITE . "Iron");
                    } else {
                        $player->sendMessage(Variables::ERROR_PREFIX . "You need to be level 5 to access that mine!");
                    }
                    break;

                case 2: # redstone mine (level 10 required)
                    if($playerLevel <= 10) {
                        $player->teleport(new Position(18.5, 111, -12.5, Loader::getInstance()->getServer()->getWorldManager()->getWorldByName("RedstoneMine")));
                        $player->broadcastSound(new EndermanTeleportSound(), [$player]);
                        $player->sendTitle(TF::BOLD . TF::GREEN . "MINE");
                        $player->sendSubTitle(TF::RED . "Redstone");
                    } else {
                        $player->sendMessage(Variables::ERROR_PREFIX . "You need to be level 10 to access that mine!");
                    }
                    break;

                case 3: # lapis mine (level 15 required)
                    if($playerLevel <= 15) {
                        $player->teleport(new Position(18.5, 111, -12.5, Loader::getInstance()->getServer()->getWorldManager()->getWorldByName("LapisMine")));
                        $player->broadcastSound(new EndermanTeleportSound(), [$player]);
                        $player->sendTitle(TF::BOLD . TF::GREEN . "MINE");
                        $player->sendSubTitle(TF::BLUE . "Lapis");
                    } else {
                        $player->sendMessage(Variables::ERROR_PREFIX . "You need to be level 15 to access that mine!");
                    }
                    break;

                case 4: # gold mine (level 20 required)
                    if($playerLevel <= 20) {
                        $player->teleport(new Position(18.5, 111, -12.5, Loader::getInstance()->getServer()->getWorldManager()->getWorldByName("GoldMine")));
                        $player->broadcastSound(new EndermanTeleportSound(), [$player]);
                        $player->sendTitle(TF::BOLD . TF::GREEN . "MINE");
                        $player->sendSubTitle(TF::GOLD . "Gold");
                    } else {
                        $player->sendMessage(Variables::ERROR_PREFIX . "You need to be level 20 to access that mine!");
                    }
                    break;

                case 5: # diamond mine (level 25 required)
                    if($playerLevel <= 25) {
                        $player->teleport(new Position(18.5, 111, -12.5, Loader::getInstance()->getServer()->getWorldManager()->getWorldByName("DiamondMine")));
                        $player->broadcastSound(new EndermanTeleportSound(), [$player]);
                        $player->sendTitle(TF::BOLD . TF::GREEN . "MINE");
                        $player->sendSubTitle(TF::AQUA . "Diamond");
                    } else {
                        $player->sendMessage(Variables::ERROR_PREFIX . "You need to be level 25 to access that mine!");
                    }
                    break;

                case 6: # emerald mine (level 30 required)
                    if($playerLevel <= 30) {
                        $player->teleport(new Position(18.5, 111, -12.5, Loader::getInstance()->getServer()->getWorldManager()->getWorldByName("EmeraldMine")));
                        $player->broadcastSound(new EndermanTeleportSound(), [$player]);
                        $player->sendTitle(TF::BOLD . TF::GREEN . "MINE");
                        $player->sendSubTitle(TF::GREEN . "Emerald");
                    } else {
                        $player->sendMessage(Variables::ERROR_PREFIX . "You need to be level 30 to access that mine!");
                    }
                    break;

                case 7: # exit
                    break;
            }
        });
        # add locked mines button
        $form->setTitle(TF::DARK_AQUA);
        $form->setContent(TF::GRAY . "Select a mine to teleport to it");
        $form->addButton(TF::BLACK . "Coal Mine\n" . TF::DARK_GRAY . "(Click Me)");
        $form->addButton(TF::WHITE . "Iron Mine\n" . TF::DARK_GRAY . "(Click Me)");
        $form->addButton(TF::RED . "Redstone Mine\n" . TF::DARK_GRAY . "(Click Me)");
        $form->addButton(TF::BLUE . "Lapis Mine\n" . TF::DARK_GRAY . "(Click Me)");
        $form->addButton(TF::GOLD . "Gold Mine\n" . TF::DARK_GRAY . "(Click Me)");
        $form->addButton(TF::AQUA . "Diamond Mine\n" . TF::DARK_GRAY . "(Click Me)");
        $form->addButton(TF::GREEN . "Emerald Mine\n" . TF::DARK_GRAY . "(Click Me)");
        $form->addButton(TF::DARK_RED . "Exit");

        $form->sendToPlayer($player);
        return $form;
    }

    public function TutorialMineForm(Player $player): SimpleForm {

        $form = new SimpleForm(function($player, $data) {

            if($data === null) {
                return;
            }
            switch($data) {

                case 0: # tutorial mine
                    $player->teleport(new Position(18.5, 111, -12.5, Loader::getInstance()->getServer()->getWorldManager()->getWorldByName("TutorialMine")));
                    $player->broadcastSound(new EndermanTeleportSound(), [$player]);
                    $player->sendTitle(TF::BOLD . TF::GREEN . "MINE");
                    $player->sendSubTitle(TF::GOLD . "Tutorial");
                    break;

                case 1: # exit
                    break;
            }
        });
        $form->setTitle(TF::DARK_AQUA);
        $form->setContent(TF::GRAY . "Teleport to the Tutorial Mine");
        $form->addButton(TF::GOLD . "Tutorial Mine\n" . TF::DARK_GRAY . "(Click Me)");
        $form->addButton(TF::DARK_RED . "Exit");

        $form->sendToPlayer($player);
        return $form;
    }

    public function MinesInfoForm(Player $player): SimpleForm {

        $form = new SimpleForm(function($player, $data) {
            if($data === null) {
                return;
            }
            switch($data) {
                case 0:
                    break;
            }
        });
        $form->setTitle("Mines - Info");
        $form->setContent("Input mines info here.");
        $form->addButton(TF::DARK_RED . "Exit");
        $form->sendToPlayer($player);
        return $form;
    }

}