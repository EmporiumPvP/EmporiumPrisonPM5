<?php

namespace EmporiumCore\Menus;

use Emporium\Prison\library\formapi\SimpleForm;
use Emporium\Prison\Variables;
use EmporiumData\DataManager;
use pocketmine\utils\TextFormat as TF;

class Tags {

    public function Form($player): void {
        $form = new SimpleForm(function($player, $data) {
            if ($data === null) {
                return;
            }
            switch($data) {
                case 0:

                    if (DataManager::getInstance()->getPlayerData($player->getXuid(), "tags.vampire") === true) {
                        DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.tag", "§4Vampire");
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have equipped the Vampire tag.");
                        return;
                    }
                    $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You do not have permission to equip this tag!");
                    break;
                case 1:
                    if (DataManager::getInstance()->getPlayerData($player->getXuid(), "tags.noob") === true) {
                        DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.tag", "§2Noob");
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have equipped the Noob tag.");
                        return;
                    }
                    $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You do not have permission to equip this tag!");
                    break;
                case 2:
                    if (DataManager::getInstance()->getPlayerData($player->getXuid(), "tags.weeb") === true) {
                        DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.tag", "§dWeeb");
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have equipped the Weeb tag.");
                        return;
                    }
                    $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You do not have permission to equip this tag!");
                    break;
                case 3:
                    if (DataManager::getInstance()->getPlayerData($player->getXuid(), "tags.dodo") === true) {
                        DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.tag", "§5Dodo");
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have equipped the Dodo tag.");
                        return;
                    }
                    $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You do not have permission to equip this tag!");
                    break;
                case 4:
                    if (DataManager::getInstance()->getPlayerData($player->getXuid(), "tags.2ez") === true) {
                        DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.tag", "§c2EZ");
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have equipped the 2EZ tag.");
                        return;
                    }
                    $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You do not have permission to equip this tag!");
                    break;
                case 5:
                    if (DataManager::getInstance()->getPlayerData($player->getXuid(), "tags.pvpgod") === true) {
                        DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.tag", "§4PvP§6God");
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have equipped the PvPGod tag.");
                        return;
                    }
                    $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You do not have permission to equip this tag!");
                    break;
                case 6:
                    if (DataManager::getInstance()->getPlayerData($player->getXuid(), "tags.otaku") === true) {
                        DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.tag", "§dO§5t§da§5k§du");
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have equipped the Otaku tag.");
                        return;
                    }
                    $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You do not have permission to equip this tag!");
                    break;
                case 7:
                    if (DataManager::getInstance()->getPlayerData($player->getXuid(), "tags.emporium") === true) {
                        DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.tag", "§bEmporium");
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have equipped the Emporium tag.");
                        return;
                    }
                    $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You do not have permission to equip this tag!");
                    break;
                case 8:
                    if (DataManager::getInstance()->getPlayerData($player->getXuid(), "tags.daddy") === true) {
                        DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.tag", "§3Daddy");
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have equipped the Daddy tag.");
                        return;
                    }
                    $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You do not have permission to equip this tag!");
                    break;
                case 9:
                    if (DataManager::getInstance()->getPlayerData($player->getXuid(), "tags.tryhard") === true) {
                        DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.tag", "§6Try§ehard");
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have equipped the Tryhard tag.");
                        return;
                    }
                    $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You do not have permission to equip this tag!");
                    break;

                case 10:
                    if (DataManager::getInstance()->getPlayerData($player->getXuid(), "tags.alpha") === true) {
                        DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.tag", "§cAlpha");
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have equipped the Alpha tag.");
                        return;
                    }
                    $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You do not have permission to equip this tag!");
                    break;
            }
        });
        $form->setTitle("§l§9Tags Menu");
        $form->setContent("§7Select the tag that you would like to equip.");
        // Vampire Tag
        if (DataManager::getInstance()->getPlayerData($player->getXuid(), "tags.vampire") === true) {
            $form->addButton("§9Vampire\n§aUnlocked");
        } else {
            $form->addButton("§9Vampire\n§cLocked");
        }
        // Noob Tag
        if (DataManager::getInstance()->getPlayerData($player->getXuid(), "tags.noob") === true) {
            $form->addButton("§9Noob\n§aUnlocked");
        } else {
            $form->addButton("§9Noob\n§cLocked");
        }
        // Weeb Tag
        if (DataManager::getInstance()->getPlayerData($player->getXuid(), "tags.weeb") === true) {
            $form->addButton("§9Weeb\n§aUnlocked");
        } else {
            $form->addButton("§9Weeb\n§cLocked");
        }
        // Dodo Tag
        if (DataManager::getInstance()->getPlayerData($player->getXuid(), "tags.dodo") === true) {
            $form->addButton("§9Dodo\n§aUnlocked");
        } else {
            $form->addButton("§9Dodo\n§cLocked");
        }
        // 2EZ Tag
        if (DataManager::getInstance()->getPlayerData($player->getXuid(), "tags.2ez") === true) {
            $form->addButton("§92EZ\n§aUnlocked");
        } else {
            $form->addButton("§92EZ\n§cLocked");
        }
        // PvPGod Tag
        if (DataManager::getInstance()->getPlayerData($player->getXuid(), "tags.pvpgod") === true) {
            $form->addButton("§9PvPGod\n§aUnlocked");
        } else {
            $form->addButton("§9PvPGod\n§cLocked");
        }
        // Otaku Tag
        if (DataManager::getInstance()->getPlayerData($player->getXuid(), "tags.otaku") === true) {
            $form->addButton("§9Otaku\n§aUnlocked");
        } else {
            $form->addButton("§9Otaku\n§cLocked");
        }
        // Sera Tag
        if (DataManager::getInstance()->getPlayerData($player->getXuid(), "tags.emporium") === true) {
            $form->addButton("§9Emporium\n§aUnlocked");
        } else {
            $form->addButton("§9Emporium\n§cLocked");
        }
        // Daddy Tag
        if (DataManager::getInstance()->getPlayerData($player->getXuid(), "tags.daddy") === true) {
            $form->addButton("§9Daddy\n§aUnlocked");
        } else {
            $form->addButton("§9Daddy\n§cLocked");
        }
        // Tryhard Tag
        if (DataManager::getInstance()->getPlayerData($player->getXuid(), "tags.tryhard") === true) {
            $form->addButton("§9Tryhard\n§aUnlocked");
        } else {
            $form->addButton("§9Tryhard\n§cLocked");
        }
        // alpha Tag
        if (DataManager::getInstance()->getPlayerData($player->getXuid(), "tags.alpha") === true) {
            $form->addButton("§cAlpha\n§aUnlocked");
        } else {
            $form->addButton("§cAlpha\n§cLocked");
        }
        // Close Button
        $form->addButton("§4Close");
        $player->sendForm($form);
    }

}