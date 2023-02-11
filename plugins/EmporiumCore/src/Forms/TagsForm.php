<?php

namespace Forms;

use Emporium\Prison\library\formapi\SimpleForm;
use EmporiumCore\Managers\Data\DataManager;
use EmporiumCore\Variables;

class TagsForm {

    public function Form($player): SimpleForm {
        $form = new SimpleForm(function($player, $data) {
            if ($data === null) {
                return;
            }
            switch($data) {
                case 0:
                    if (DataManager::getData($player, "Permissions", "TagVampire") === true) {
                        DataManager::setData($player, "Players", "Tag", "§4Vampire");
                        $player->sendMessage(Variables::SERVER_PREFIX . "§r§7You have equipped the Vampire tag.");
                        return;
                    }
                    $player->sendMessage(Variables::ERROR_PREFIX . "§r§7You do not have permission to equip this tag!");
                    break;
                case 1:
                    if (DataManager::getData($player, "Permissions", "TagNoob") === true) {
                        DataManager::setData($player, "Players", "Tag", "§2Noob");
                        $player->sendMessage(Variables::SERVER_PREFIX . "§r§7You have equipped the Noob tag.");
                        return;
                    }
                    $player->sendMessage(Variables::ERROR_PREFIX . "§r§7You do not have permission to equip this tag!");
                    break;
                case 2:
                    if (DataManager::getData($player, "Permissions", "TagWeeb") === true) {
                        DataManager::setData($player, "Players", "Tag", "§dWeeb");
                        $player->sendMessage(Variables::SERVER_PREFIX . "§r§7You have equipped the Weeb tag.");
                        return;
                    }
                    $player->sendMessage(Variables::ERROR_PREFIX . "§r§7You do not have permission to equip this tag!");
                    break;
                case 3:
                    if (DataManager::getData($player, "Permissions", "TagDodo") === true) {
                        DataManager::setData($player, "Players", "Tag", "§5Dodo");
                        $player->sendMessage(Variables::SERVER_PREFIX . "§r§7You have equipped the Dodo tag.");
                        return;
                    }
                    $player->sendMessage(Variables::ERROR_PREFIX . "§r§7You do not have permission to equip this tag!");
                    break;
                case 4:
                    if (DataManager::getData($player, "Permissions", "Tag2EZ") === true) {
                        DataManager::setData($player, "Players", "Tag", "§c2EZ");
                        $player->sendMessage(Variables::SERVER_PREFIX . "§r§7You have equipped the 2EZ tag.");
                        return;
                    }
                    $player->sendMessage(Variables::ERROR_PREFIX . "§r§7You do not have permission to equip this tag!");
                    break;
                case 5:
                    if (DataManager::getData($player, "Permissions", "TagPvPGod") === true) {
                        DataManager::setData($player, "Players", "Tag", "§4PvP§6God");
                        $player->sendMessage(Variables::SERVER_PREFIX . "§r§7You have equipped the PvPGod tag.");
                        return;
                    }
                    $player->sendMessage(Variables::ERROR_PREFIX . "§r§7You do not have permission to equip this tag!");
                    break;
                case 6:
                    if (DataManager::getData($player, "Permissions", "TagOtaku") === true) {
                        DataManager::setData($player, "Players", "Tag", "§dO§5t§da§5k§du");
                        $player->sendMessage(Variables::SERVER_PREFIX . "§r§7You have equipped the Otaku tag.");
                        return;
                    }
                    $player->sendMessage(Variables::ERROR_PREFIX . "§r§7You do not have permission to equip this tag!");
                    break;
                case 7:
                    if (DataManager::getData($player, "Permissions", "TagEmporium") === true) {
                        DataManager::setData($player, "Players", "Tag", "§bS§3e§br§3a");
                        $player->sendMessage(Variables::SERVER_PREFIX . "§r§7You have equipped the Sera tag.");
                        return;
                    }
                    $player->sendMessage(Variables::ERROR_PREFIX . "§r§7You do not have permission to equip this tag!");
                    break;
                case 8:
                    if (DataManager::getData($player, "Permissions", "TagDaddy") === true) {
                        DataManager::setData($player, "Players", "Tag", "§3Daddy");
                        $player->sendMessage(Variables::SERVER_PREFIX . "§r§7You have equipped the Daddy tag.");
                        return;
                    }
                    $player->sendMessage(Variables::ERROR_PREFIX . "§r§7You do not have permission to equip this tag!");
                    break;
                case 9:
                    if (DataManager::getData($player, "Permissions", "TagTryhard") === true) {
                        DataManager::setData($player, "Players", "Tag", "§6Try§ehard");
                        $player->sendMessage(Variables::SERVER_PREFIX . "§r§7You have equipped the Tryhard tag.");
                        return;
                    }
                    $player->sendMessage(Variables::ERROR_PREFIX . "§r§7You do not have permission to equip this tag!");
                    break;
                case 10:
                    break;
            }
        });
        $form->setTitle("§l§9Tag Menu");
        $form->setContent("§7Select the tag that you would like to equipped.");
        // Vampire Tag
        if (DataManager::getData($player, "Permissions", "TagVampire") === true) {
            $form->addButton("§9Vampire\n§aUnlocked");
        } else {
            $form->addButton("§9Vampire\n§cLocked");
        }
        // Noob Tag
        if (DataManager::getData($player, "Permissions", "TagNoob") === true) {
            $form->addButton("§9Noob\n§aUnlocked");
        } else {
            $form->addButton("§9Noob\n§cLocked");
        }
        // Weeb Tag
        if (DataManager::getData($player, "Permissions", "TagWeeb") === true) {
            $form->addButton("§9Weeb\n§aUnlocked");
        } else {
            $form->addButton("§9Weeb\n§cLocked");
        }
        // Dodo Tag
        if (DataManager::getData($player, "Permissions", "TagDodo") === true) {
            $form->addButton("§9Dodo\n§aUnlocked");
        } else {
            $form->addButton("§9Dodo\n§cLocked");
        }
        // 2EZ Tag
        if (DataManager::getData($player, "Permissions", "Tag2EZ") === true) {
            $form->addButton("§92EZ\n§aUnlocked");
        } else {
            $form->addButton("§92EZ\n§cLocked");
        }
        // PvPGod Tag
        if (DataManager::getData($player, "Permissions", "TagPvPGod") === true) {
            $form->addButton("§9PvPGod\n§aUnlocked");
        } else {
            $form->addButton("§9PvPGod\n§cLocked");
        }
        // Otaku Tag
        if (DataManager::getData($player, "Permissions", "TagOtaku") === true) {
            $form->addButton("§9Otaku\n§aUnlocked");
        } else {
            $form->addButton("§9Otaku\n§cLocked");
        }
        // Sera Tag
        if (DataManager::getData($player, "Permissions", "TagSera") === true) {
            $form->addButton("§9Emporium\n§aUnlocked");
        } else {
            $form->addButton("§9Emporium\n§cLocked");
        }
        // Daddy Tag
        if (DataManager::getData($player, "Permissions", "TagDaddy") === true) {
            $form->addButton("§9Daddy\n§aUnlocked");
        } else {
            $form->addButton("§9Daddy\n§cLocked");
        }
        // Tryhard Tag
        if (DataManager::getData($player, "Permissions", "TagTryhard") === true) {
            $form->addButton("§9Tryhard\n§aUnlocked");
        } else {
            $form->addButton("§9Tryhard\n§cLocked");
        }
        // Close Button
        $form->addButton("§4Close");
        $player->sendForm($form);

        return $form;
    }

}