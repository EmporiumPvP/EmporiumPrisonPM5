<?php

namespace Menus;

use Emporium\Prison\library\formapi\SimpleForm;
use Emporium\Prison\Variables;
use EmporiumCore\Managers\Data\DataManager;
use pocketmine\utils\TextFormat as TF;

class Tags {

    public function Form($player): void {
        $form = new SimpleForm(function($player, $data) {
            if ($data === null) {
                return;
            }
            switch($data) {
                case 0:
                    if (DataManager::getData($player, "Tags", "vampire") === true) {
                        DataManager::setData($player, "Players", "Tag", "§4Vampire");
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have equipped the Vampire tag.");
                        return;
                    }
                    $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You do not have permission to equip this tag!");
                    break;
                case 1:
                    if (DataManager::getData($player, "Tags", "noob") === true) {
                        DataManager::setData($player, "Players", "Tag", "§2Noob");
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have equipped the Noob tag.");
                        return;
                    }
                    $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You do not have permission to equip this tag!");
                    break;
                case 2:
                    if (DataManager::getData($player, "Tags", "weeb") === true) {
                        DataManager::setData($player, "Players", "Tag", "§dWeeb");
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have equipped the Weeb tag.");
                        return;
                    }
                    $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You do not have permission to equip this tag!");
                    break;
                case 3:
                    if (DataManager::getData($player, "Tags", "dodo") === true) {
                        DataManager::setData($player, "Players", "Tag", "§5Dodo");
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have equipped the Dodo tag.");
                        return;
                    }
                    $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You do not have permission to equip this tag!");
                    break;
                case 4:
                    if (DataManager::getData($player, "Tags", "2ez") === true) {
                        DataManager::setData($player, "Players", "Tag", "§c2EZ");
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have equipped the 2EZ tag.");
                        return;
                    }
                    $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You do not have permission to equip this tag!");
                    break;
                case 5:
                    if (DataManager::getData($player, "Tags", "pvpgod") === true) {
                        DataManager::setData($player, "Players", "Tag", "§4PvP§6God");
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have equipped the PvPGod tag.");
                        return;
                    }
                    $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You do not have permission to equip this tag!");
                    break;
                case 6:
                    if (DataManager::getData($player, "Tags", "otaku") === true) {
                        DataManager::setData($player, "Players", "Tag", "§dO§5t§da§5k§du");
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have equipped the Otaku tag.");
                        return;
                    }
                    $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You do not have permission to equip this tag!");
                    break;
                case 7:
                    if (DataManager::getData($player, "Tags", "emporium") === true) {
                        DataManager::setData($player, "Players", "Tag", "§bEmporium");
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have equipped the Emporium tag.");
                        return;
                    }
                    $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You do not have permission to equip this tag!");
                    break;
                case 8:
                    if (DataManager::getData($player, "Tags", "daddy") === true) {
                        DataManager::setData($player, "Players", "Tag", "§3Daddy");
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have equipped the Daddy tag.");
                        return;
                    }
                    $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You do not have permission to equip this tag!");
                    break;
                case 9:
                    if (DataManager::getData($player, "Tags", "tryhard") === true) {
                        DataManager::setData($player, "Players", "Tag", "§6Try§ehard");
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have equipped the Tryhard tag.");
                        return;
                    }
                    $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You do not have permission to equip this tag!");
                    break;

                case 10:
                    if (DataManager::getData($player, "Tags", "alpha") === true) {
                        DataManager::setData($player, "Players", "Tag", "§cAlpha");
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have equipped the Alpha tag.");
                        return;
                    }
                    $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You do not have permission to equip this tag!");
                    break;
            }
        });
        $form->setTitle("§l§9Tags Menu");
        $form->setContent("§7Select the tag that you would like to equip.");
        // Vampire Tag
        if (DataManager::getData($player, "Tags", "vampire") === true) {
            $form->addButton("§9Vampire\n§aUnlocked");
        } else {
            $form->addButton("§9Vampire\n§cLocked");
        }
        // Noob Tag
        if (DataManager::getData($player, "Tags", "noob") === true) {
            $form->addButton("§9Noob\n§aUnlocked");
        } else {
            $form->addButton("§9Noob\n§cLocked");
        }
        // Weeb Tag
        if (DataManager::getData($player, "Tags", "weeb") === true) {
            $form->addButton("§9Weeb\n§aUnlocked");
        } else {
            $form->addButton("§9Weeb\n§cLocked");
        }
        // Dodo Tag
        if (DataManager::getData($player, "Tags", "dodo") === true) {
            $form->addButton("§9Dodo\n§aUnlocked");
        } else {
            $form->addButton("§9Dodo\n§cLocked");
        }
        // 2EZ Tag
        if (DataManager::getData($player, "Tags", "2ez") === true) {
            $form->addButton("§92EZ\n§aUnlocked");
        } else {
            $form->addButton("§92EZ\n§cLocked");
        }
        // PvPGod Tag
        if (DataManager::getData($player, "Tags", "pvpgod") === true) {
            $form->addButton("§9PvPGod\n§aUnlocked");
        } else {
            $form->addButton("§9PvPGod\n§cLocked");
        }
        // Otaku Tag
        if (DataManager::getData($player, "Tags", "otaku") === true) {
            $form->addButton("§9Otaku\n§aUnlocked");
        } else {
            $form->addButton("§9Otaku\n§cLocked");
        }
        // Sera Tag
        if (DataManager::getData($player, "Tags", "emporium") === true) {
            $form->addButton("§9Sera\n§aUnlocked");
        } else {
            $form->addButton("§9Sera\n§cLocked");
        }
        // Daddy Tag
        if (DataManager::getData($player, "Tags", "daddy") === true) {
            $form->addButton("§9Daddy\n§aUnlocked");
        } else {
            $form->addButton("§9Daddy\n§cLocked");
        }
        // Tryhard Tag
        if (DataManager::getData($player, "Tags", "tryhard") === true) {
            $form->addButton("§9Tryhard\n§aUnlocked");
        } else {
            $form->addButton("§9Tryhard\n§cLocked");
        }
        // alpha Tag
        if (DataManager::getData($player, "Tags", "alpha") === true) {
            $form->addButton("§cAlpha\n§aUnlocked");
        } else {
            $form->addButton("§cAlpha\n§cLocked");
        }
        // Close Button
        $form->addButton("§4Close");
        $player->sendForm($form);
    }

}