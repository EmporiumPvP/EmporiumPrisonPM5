<?php

namespace Emporium\Prison\Menus;


use Emporium\Prison\library\formapi\SimpleForm;

use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;

class Bank extends Menu {

    public function open (Player $player) : void
    {
        $this->Form($player);
    }

    public function Form(Player $player): void {

        $form = new SimpleForm(function ($player, $data) {
            if($data === null) {
                return;
            }

            switch($data) {

                case 0:
                    # account
                    break;

                case 1:
                    # deposit
                    break;

                case 2:
                    # withdraw
                    break;
            }
        });
        $form->setTitle(TF::BOLD . "Bank");
        $form->setContent("Welcome to the Emporium Bank! Here you can manage your Investments\n\n\n\n\n");
        $form->addButton(TF::BOLD . "Account");
        $form->addButton(TF::BOLD . "Deposit");
        $form->addButton(TF::BOLD . "Withdraw");
        $player->sendForm($form);
    }



}