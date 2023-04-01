<?php

namespace Emporium\Prison\Menus;

use Emporium\Prison\EmporiumPrison;
use Emporium\Prison\library\formapi\SimpleForm;

use EmporiumData\DataManager;

use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;

use Tetro\EmporiumTutorial\EmporiumTutorial;

class TourGuide extends Menu {

    public function open(Player $player): void
    {
        $this->MainForm($player);
    }

    public function MainForm(Player $player): void {
        $form = new SimpleForm(function($player, $data) {

            $tutorialManager = EmporiumTutorial::getInstance()->getTutorialManager();
            if($data === null) {
                return;
            }

            # give starter pickaxe
            if ($data == 0) {
                # check if tutorial active
                $tutorialProgress = $tutorialManager->getPlayerTutorialProgress($player);
                if($tutorialProgress == 0) {
                    # update tutorial progression
                    DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.tutorial-progress", DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.tutorial-progress") + 1);
                    # start next tutorial stage
                    $tutorialManager->startTutorial($player);
                }
                # give starter pickaxe
                $player->getInventory()->addItem(EmporiumPrison::getInstance()->getPickaxes()->Trainee());
            }
        });
        $form->setTitle("Tour Guide");
        $form->setContent(
            TF::GRAY . "Hello! My name is Eric, and i am your Tour Guide!\n\nWelcome to " . TF::AQUA . "Emporium" . TF::DARK_AQUA . "Prison" . TF::GRAY . ", this server is Packed with loads of features so you will always have something to do, whether that's grinding in the mines, or hunting down Loot in one of the Adventures!\n\nTo get started you will need to claim your pickaxe and head down to the mines, if you ever get stuck just type " . TF::YELLOW . "/help " . TF::GRAY . "Good luck and have fun!");
        $form->addButton("Claim Your Pickaxe");
        $player->sendForm($form);
    }

}