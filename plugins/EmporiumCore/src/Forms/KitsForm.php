<?php

namespace Forms;

use Emporium\Prison\library\formapi\SimpleForm;

use pocketmine\player\Player;
use pocketmine\world\sound\EnderChestCloseSound;

class KitsForm {

    public function Form($sender): SimpleForm {

        $form = new SimpleForm(function (Player $sender, $data) {
            $result = $data;
            if($result === null) {
                $sender->broadcastSound(new EnderChestCloseSound());
                return true;
            }
            switch($result) {
                case 0: # ADVENTURER

                    break;
                case 1: # KNIGHT

                    break;
                case 2: # WARRIOR

                    break;
                case 3: # WARLORD

                    break;
                case 4: # OVERLORD

                    break;
                case 5: # TWILIGHT

                    break;
                case 6: # NIGHTMARE

                    break;
                case 7: # ETERNAL

                    break;
                case 8: # SERAPH

                    break;
                case 9:
                    $sender->broadcastSound(new EnderChestCloseSound());
                    break;
            }
            return true;
        });
        $form->setTitle("RankKits");
        $form->setContent("§7Select a kit to use it.");

        $form->addButton("Adventurer\n§7(Click To Claim)");
        $form->addButton("Knight\n§7(Click To Claim)");
        $form->addButton("Warrior\n§7(Click To Claim)");
        $form->addButton("Warlord\n§7(Click To Claim)");
        $form->addButton("Overlord\n§7(Click To Claim)");
        $form->addButton("Twilight\n§7(Click To Claim)");
        $form->addButton("Nightmare\n§7(Click To Claim)");
        $form->addButton("Eternal\n§7(Click To Claim)");
        $form->addButton("Seraph\n§7(Click To Claim)");
        $form->addButton("§cExit");
        $sender->sendForm($form);
        return $form;

    }

}