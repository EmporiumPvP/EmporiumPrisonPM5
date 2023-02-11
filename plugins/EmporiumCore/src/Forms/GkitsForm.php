<?php

namespace Forms;

use Emporium\Prison\library\formapi\SimpleForm;

use Inventories\GKitsMenu;

use Items\GKits;

use pocketmine\player\Player;
use pocketmine\world\sound\EnderChestCloseSound;
use pocketmine\world\sound\ExplodeSound;

class GkitsForm {

    public function Form($sender): SimpleForm {

        $form = new SimpleForm(function (Player $sender, $data) {
            $result = $data;
            if($result === null) {
                $sender->broadcastSound(new EnderChestCloseSound());
                return true;
            }
            $prefix = "§l§3SERVER §8>> ";
            switch($result) {

                case 0: # CHAMPION GKIT
                    # SEND PLAYER KIT PREVIEW IF NO PERMS
                    if(!$sender->hasPermission("emporiumcore.gkit.champion")) {
                        $form = new GKitsMenu();
                        $form->ChampionPreview($sender);
                    } else {
                        # CHECK IF PLAYERS INV IS FULL
                        if(!$sender->getInventory()->canAddItem((new GKits)->ChampionScroll())) {
                            $sender->sendMessage($prefix . " §7Your inventory is full.");
                            break;
                        }
                        $sender->getInventory()->addItem((new GKits)->ChampionScroll());
                        $sender->broadcastSound(new ExplodeSound());
                        $sender->sendMessage($prefix . "§7You successfully claimed §aChampion §7GKit.");
                        break;
                    }
                    break;
                case 1: # LEGEND GKIT
                    # SEND PLAYER KIT PREVIEW IF NO PERMS
                    if(!$sender->hasPermission("emporiumcore.gkit.legend")) {
                        $form = new GKitsMenu();
                        $form->LegendPreview($sender);
                    } else {
                        # CHECK IF PLAYERS INV IS FULL
                        if(!$sender->getInventory()->canAddItem((new GKits)->LegendScroll())) {
                            $sender->sendMessage($prefix . " §7Your inventory is full.");
                            break;
                        }
                        $sender->getInventory()->addItem((new GKits)->LegendScroll());
                        $sender->broadcastSound(new ExplodeSound());
                        $sender->sendMessage($prefix . "§7You successfully claimed §6Legend §7GKit.");
                        break;
                    }
                    break;
                CASE 2: # OVERLORD GKIT
                    # SEND PLAYER KIT PREVIEW IF NO PERMS
                    if(!$sender->hasPermission("emporiumcore.gkit.overlord")) {
                        $form = new GKitsMenu();
                        $form->OverlordPreview($sender);
                    } else {
                        # CHECK IF PLAYERS INV IS FULL
                        if(!$sender->getInventory()->canAddItem((new Gkits)->OverlordScroll())) {
                            $sender->sendMessage($prefix . " §7Your inventory is full.");
                            break;
                        }
                        # SEND PLAYER GKIT
                        $sender->getInventory()->addItem((new GKits)->OverlordScroll());
                        $sender->broadcastSound(new ExplodeSound());
                        $sender->sendMessage($prefix . "§7You successfully claimed §cOverlord §7GKit.");
                        break;
                    }
                    break;
                case 3: # MYTH GKIT
                    # SEND PLAYER KIT PREVIEW IF NO PERMS
                    if(!$sender->hasPermission("emporiumcore.gkit.myth")) {
                        $form = new GKitsMenu();
                        $form->MythPreview($sender);
                    } else {
                        # CHECK IF PLAYERS INV IS FULL
                        if(!$sender->getInventory()->canAddItem((new GKits)->MythScroll())) {
                            $sender->sendMessage($prefix . " §7Your inventory is full.");
                            break;
                        }
                        $sender->getInventory()->addItem((new GKits)->MythScroll());
                        $sender->broadcastSound(new ExplodeSound());
                        $sender->sendMessage($prefix . "§7You successfully claimed §3Myth §7GKit.");
                        break;
                    }
                    break;
                case 4: # IMMORTAL GKIT
                    # SEND PLAYER KIT PREVIEW IF NO PERMS
                    if(!$sender->hasPermission("emporiumcore.gkit.immortal")) {
                        $form = new GKitsMenu();
                        $form->ImmortalPreview($sender);
                        # SEND PREVIEW KIT INV
                    } else {
                        # CHECK IF PLAYERS INV IS FULL
                        if(!$sender->getInventory()->canAddItem((new GKits)->ImmortalScroll())) {
                            $sender->sendMessage($prefix . " §7Your inventory is full.");
                            break;
                        }
                        $sender->getInventory()->addItem((new GKits)->ImmortalScroll());
                        $sender->broadcastSound(new ExplodeSound());
                        $sender->sendMessage($prefix . "§7You successfully claimed §dImmortal §7GKit.");
                        break;
                    }
                    break;
                case 5: # EXIT
                    $sender->broadcastSound(new EnderChestCloseSound());
                    break;
            }
            return true;
        });
        $form->setTitle("GKits");
        $form->setContent("§7Select a kit to use it.");
        $form->addButton("§aChampion");
        $form->addButton("§6Legend");
        $form->addButton("§cOverlord");
        $form->addButton("§bMyth");
        $form->addButton("§dImmortal");
        $form->addButton("§cEXIT");
        $sender->sendForm($sender);
        return $form;

    }

}