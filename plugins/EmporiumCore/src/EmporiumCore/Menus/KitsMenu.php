<?php

namespace EmporiumCore\Menus;

use Emporium\Prison\library\formapi\SimpleForm;
use Emporium\Prison\Managers\misc\Translator;
use EmporiumCore\EmporiumCore;
use EmporiumData\DataManager;
use EmporiumData\PermissionsManager;
use muqsit\invmenu\InvMenu;
use muqsit\invmenu\transaction\DeterministicInvMenuTransaction;
use muqsit\invmenu\type\InvMenuTypeIds;
use pocketmine\block\VanillaBlocks;
use pocketmine\item\Item;
use pocketmine\item\ItemIds;
use pocketmine\item\VanillaItems;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;
use pocketmine\world\sound\DoorCrashSound;
use pocketmine\world\sound\EnderChestCloseSound;
use pocketmine\world\sound\EnderChestOpenSound;

class KitsMenu extends Menu {

    public function Form($player): void {

        $form = new SimpleForm(function (Player $player, $data) {
            $result = $data;
            if($result === null) {
                $player->broadcastSound(new EnderChestCloseSound());
                return true;
            }
            switch($result) {
                case 0: # rank kits
                    $this->rankKitsForm($player);
                    break;
                case 1: # god kits
                    $gkits = EmporiumCore::getInstance()->getGkitsMenu();
                    $gkits->Form($player);
                    break;
                case 2: # quest kits
                    #$this->questKitsForm($player);
                    $player->sendMessage(TF::BOLD . "Quest kits are coming soon...");
                    break;
                case 3: # prestige kits
                    $this->prestigeKitsForm($player);
                    break;
                case 4:
                    $player->broadcastSound(new EnderChestCloseSound());
                    break;
            }
            return true;
        });
        $form->setTitle("RankKits");
        $form->setContent("§7Select a category");
        $form->addButton(TF::BOLD . "Rank Kits");
        $form->addButton(TF::BOLD . "God Kits");
        $form->addButton(TF::BOLD . "Quest Kits\n(Coming soon)");
        $form->addButton(TF::BOLD . "Prestige Kits");
        $form->addButton(TF::BOLD . TF::RED . "Exit");
        $player->sendForm($form);
    }

    public function rankKitsForm(Player $player): void {
        $form = new SimpleForm(function(Player $player, $data) {
            if($data === null) {
                return;
            }
            switch($data) {

                case 0:
                    $cooldown = DataManager::getInstance()->getPlayerData($player->getXuid(), "cooldown.rank_kit_noble");
                    $permission = PermissionsManager::getInstance()->checkPermission($player->getXuid(), "emporiumcore.rank_kit.noble");
                    if($permission) {
                        if($cooldown > 0) {
                            $player->sendMessage(TF::RED . "That GKit is on Cooldown, Time remaining: " . Translator::timeConvert($cooldown));
                            $player->broadcastSound(new DoorCrashSound());
                        } else {
                            if($player->getInventory()->canAddItem((EmporiumCore::getInstance()->getRankKits())->noble(1))) {
                                $player->getInventory()->addItem((EmporiumCore::getInstance()->getRankKits())->noble(1));
                                DataManager::getInstance()->setPlayerData($player->getXuid(), "cooldown.rank_kit_noble", 259200); # 3 day cooldown
                            } else {
                                $player->getWorld()->dropItem($player->getPosition(), (EmporiumCore::getInstance()->getRankKits())->noble(1));
                            }
                            $player->sendMessage(TF::GREEN . "You claimed Noble Rank Kit");
                        }
                    } else {
                        $player->sendMessage(TF::RED . "That Rank Kit is Locked");
                    }
                    break;

                case 1:
                    $cooldown = DataManager::getInstance()->getPlayerData($player->getXuid(), "cooldown.rank_kit_imperial");
                    $permission = PermissionsManager::getInstance()->checkPermission($player->getXuid(), "emporiumcore.rank_kit.imperial");
                    if($permission) {
                        if($cooldown > 0) {
                            $player->sendMessage(TF::RED . "That GKit is on Cooldown, Time remaining: " . Translator::timeConvert($cooldown));
                            $player->broadcastSound(new DoorCrashSound());
                        } else {
                            if($player->getInventory()->canAddItem((EmporiumCore::getInstance()->getRankKits())->imperial(1))) {
                                $player->getInventory()->addItem((EmporiumCore::getInstance()->getRankKits())->imperial(1));
                                DataManager::getInstance()->setPlayerData($player->getXuid(), "cooldown.rank_kit_imperial", 259200); # 3 day cooldown
                            } else {
                                $player->getWorld()->dropItem($player->getPosition(), (EmporiumCore::getInstance()->getRankKits())->imperial(1));
                            }
                            $player->sendMessage(TF::GREEN . "You claimed Imperial Rank Kit");
                        }
                    } else {
                        $player->sendMessage(TF::RED . "That Rank Kit is Locked");
                    }
                    break;

                case 2:
                    $cooldown = DataManager::getInstance()->getPlayerData($player->getXuid(), "cooldown.rank_kit_supreme");
                    $permission = PermissionsManager::getInstance()->checkPermission($player->getXuid(), "emporiumcore.rank_kit.supreme");
                    if($permission) {
                        if($cooldown > 0) {
                            $player->sendMessage(TF::RED . "That GKit is on Cooldown, Time remaining: " . Translator::timeConvert($cooldown));
                            $player->broadcastSound(new DoorCrashSound());
                        } else {
                            if($player->getInventory()->canAddItem((EmporiumCore::getInstance()->getRankKits())->supreme(1))) {
                                $player->getInventory()->addItem((EmporiumCore::getInstance()->getRankKits())->supreme(1));
                                DataManager::getInstance()->setPlayerData($player->getXuid(), "cooldown.rank_kit_supreme", 259200); # 3 day cooldown
                            } else {
                                $player->getWorld()->dropItem($player->getPosition(), (EmporiumCore::getInstance()->getRankKits())->supreme(1));
                            }
                            $player->sendMessage(TF::GREEN . "You claimed Supreme Rank Kit");
                        }
                    } else {
                        $player->sendMessage(TF::RED . "That Rank Kit is Locked");
                    }
                    break;

                case 3:
                    $cooldown = DataManager::getInstance()->getPlayerData($player->getXuid(), "cooldown.rank_kit_majesty");
                    $permission = PermissionsManager::getInstance()->checkPermission($player->getXuid(), "emporiumcore.rank_kit.majesty");
                    if($permission) {
                        if($cooldown > 0) {
                            $player->sendMessage(TF::RED . "That GKit is on Cooldown, Time remaining: " . Translator::timeConvert($cooldown));
                            $player->broadcastSound(new DoorCrashSound());
                        } else {
                            if($player->getInventory()->canAddItem((EmporiumCore::getInstance()->getRankKits())->majesty(1))) {
                                $player->getInventory()->addItem((EmporiumCore::getInstance()->getRankKits())->majesty(1));
                                DataManager::getInstance()->setPlayerData($player->getXuid(), "cooldown.rank_kit_majesty", 259200); # 3 day cooldown
                            } else {
                                $player->getWorld()->dropItem($player->getPosition(), (EmporiumCore::getInstance()->getRankKits())->majesty(1));
                            }
                            $player->sendMessage(TF::GREEN . "You claimed Majesty Rank Kit");
                        }
                    } else {
                        $player->sendMessage(TF::RED . "That Rank Kit is Locked");
                    }
                    break;

                case 4:
                    $cooldown = DataManager::getInstance()->getPlayerData($player->getXuid(), "cooldown.rank_kit_emperor");
                    $permission = PermissionsManager::getInstance()->checkPermission($player->getXuid(), "emporiumcore.rank_kit.emperor");
                    if($permission) {
                        if($cooldown > 0) {
                            $player->sendMessage(TF::RED . "That GKit is on Cooldown, Time remaining: " . Translator::timeConvert($cooldown));
                            $player->broadcastSound(new DoorCrashSound());
                        } else {
                            if($player->getInventory()->canAddItem((EmporiumCore::getInstance()->getRankKits())->emperor(1))) {
                                $player->getInventory()->addItem((EmporiumCore::getInstance()->getRankKits())->emperor(1));
                                DataManager::getInstance()->setPlayerData($player->getXuid(), "cooldown.rank_kit_emperor", 259200); # 3 day cooldown
                            } else {
                                $player->getWorld()->dropItem($player->getPosition(), (EmporiumCore::getInstance()->getRankKits())->emperor(1));
                            }
                            $player->sendMessage(TF::GREEN . "You claimed Emperor Rank Kit");
                        }
                    } else {
                        $player->sendMessage(TF::RED . "That Rank Kit is Locked");
                    }
                    break;

                case 5:
                    $cooldown = DataManager::getInstance()->getPlayerData($player->getXuid(), "cooldown.rank_kit_president");
                    $permission = PermissionsManager::getInstance()->checkPermission($player->getXuid(), "emporiumcore.rank_kit.president");
                    if($permission) {
                        if($cooldown > 0) {
                            $player->sendMessage(TF::RED . "That GKit is on Cooldown, Time remaining: " . Translator::timeConvert($cooldown));
                            $player->broadcastSound(new DoorCrashSound());
                        } else {
                            if($player->getInventory()->canAddItem((EmporiumCore::getInstance()->getRankKits())->noble(1))) {
                                $player->getInventory()->addItem((EmporiumCore::getInstance()->getRankKits())->noble(1));
                                DataManager::getInstance()->setPlayerData($player->getXuid(), "cooldown.rank_kit_president", 259200); # 3 day cooldown
                            } else {
                                $player->getWorld()->dropItem($player->getPosition(), (EmporiumCore::getInstance()->getRankKits())->president(1));
                            }
                            $player->sendMessage(TF::GREEN . "You claimed President Rank Kit");
                        }
                    } else {
                        $player->sendMessage(TF::RED . "That Rank Kit is Locked");
                    }
                    break;

                case 6:
                    $this->Form($player);
                    break;

            }
        });
        $form->setTitle(TF::BOLD . "Rank Kits");
        $form->setContent("Click a kit to claim it");
        if(PermissionsManager::getInstance()->checkPermission($player->getXuid(), "emporiumcore.rank_kit.noble")) {
            if(DataManager::getInstance()->getPlayerData($player->getXuid(), "cooldown.rank_kit_noble") > 0) {
                $form->addButton(TF::BOLD . "Noble\n" . TF::RED . "On Cooldown");
            } else {
                $form->addButton(TF::BOLD . "Noble\n" . TF::GREEN . "Available");
            }
        } else {
            $form->addButton(TF::BOLD . "Noble\n" . TF::RED . "Locked");
        }
        if(PermissionsManager::getInstance()->checkPermission($player->getXuid(), "emporiumcore.rank_kit.imperial")) {
            if(DataManager::getInstance()->getPlayerData($player->getXuid(), "cooldown.rank_kit_imperial") > 0) {
                $form->addButton(TF::BOLD . "Imperial\n" . TF::RED . "On Cooldown");
            } else {
                $form->addButton(TF::BOLD . "Imperial\n" . TF::GREEN . "Available");
            }
        } else {
            $form->addButton(TF::BOLD . "Imperial\n" . TF::RED . "Locked");
        }
        if(PermissionsManager::getInstance()->checkPermission($player->getXuid(), "emporiumcore.rank_kit.supreme")) {
            if(DataManager::getInstance()->getPlayerData($player->getXuid(), "cooldown.rank_kit_supreme") > 0) {
                $form->addButton(TF::BOLD . "Supreme\n" . TF::RED . "On Cooldown");
            } else {
                $form->addButton(TF::BOLD . "Supreme\n" . TF::GREEN . "Available");
            }
        } else {
            $form->addButton(TF::BOLD . "Supreme\n" . TF::RED . "Locked");
        }
        if(PermissionsManager::getInstance()->checkPermission($player->getXuid(), "emporiumcore.rank_kit.majesty")) {
            if(DataManager::getInstance()->getPlayerData($player->getXuid(), "cooldown.rank_kit_majesty") > 0) {
                $form->addButton(TF::BOLD . "Majesty\n" . TF::RED . "On Cooldown");
            } else {
                $form->addButton(TF::BOLD . "Majesty\n" . TF::GREEN . "Available");
            }
        } else {
            $form->addButton(TF::BOLD . "Majesty\n" . TF::RED . "Locked");
        }
        if(PermissionsManager::getInstance()->checkPermission($player->getXuid(), "emporiumcore.rank_kit.emperor")) {
            if(DataManager::getInstance()->getPlayerData($player->getXuid(), "cooldown.rank_kit_emperor") > 0) {
                $form->addButton(TF::BOLD . "Emperor\n" . TF::RED . "On Cooldown");
            } else {
                $form->addButton(TF::BOLD . "Emperor\n" . TF::GREEN . "Available");
            }
        } else {
            $form->addButton(TF::BOLD . "Emperor\n" . TF::RED . "Locked");
        }
        if(PermissionsManager::getInstance()->checkPermission($player->getXuid(), "emporiumcore.rank_kit.president")) {
            if(DataManager::getInstance()->getPlayerData($player->getXuid(), "cooldown.rank_kit_president") > 0) {
                $form->addButton(TF::BOLD . "President\n" . TF::RED . "On Cooldown");
            } else {
                $form->addButton(TF::BOLD . "President\n" . TF::GREEN . "Available");
            }
        } else {
            $form->addButton(TF::BOLD . "President\n" . TF::RED . "Locked");
        }
        $form->addButton(TF::BOLD . TF::RED . "Back");
        $player->sendForm($form);
    }

    public function prestigeKitsForm($player): void {
        $form = new SimpleForm(function(Player $player, $data) {
            if($data === null) {
                return;
            }
            switch($data) {

                case 0:
                    $cooldown = DataManager::getInstance()->getPlayerData($player->getXuid(), "prestige_kit1");
                    $permission = PermissionsManager::getInstance()->checkPermission($player->getXuid(), "emporiumcore_prestigekit_prestige1");
                    if($permission) {
                        if($cooldown > 0) {
                            $player->sendMessage(TF::RED . "That Prestige Kit is on Cooldown, Time remaining: " . Translator::timeConvert($cooldown));
                            $player->broadcastSound(new DoorCrashSound());
                        } else {
                            if($player->getInventory()->canAddItem((EmporiumCore::getInstance()->getRankKits())->noble(1))) {
                                $player->getInventory()->addItem((EmporiumCore::getInstance()->getRankKits())->noble(1));
                                DataManager::getInstance()->setPlayerData($player, "prestige_kit1", 259200); # 3 day cooldown
                            } else {
                                $player->getWorld()->dropItem($player->getPosition(), (EmporiumCore::getInstance()->getRankKits())->noble(1));
                            }
                            $player->sendMessage(TF::GREEN . "You claimed Prestige Kit 1");
                        }
                    } else {
                        $player->sendMessage(TF::RED . "That Prestige Kit is Locked");
                    }
                    break;

                case 1:
                    $cooldown = DataManager::getInstance()->getPlayerData($player->getXuid(), "prestige_kit2");
                    $permission = PermissionsManager::getInstance()->checkPermission($player->getXuid(), "emporiumcore_prestigekit_prestige2");
                    if($permission) {
                        if($cooldown > 0) {
                            $player->sendMessage(TF::RED . "That Prestige Kit is on Cooldown, Time remaining: " . Translator::timeConvert($cooldown));
                            $player->broadcastSound(new DoorCrashSound());
                        } else {
                            if($player->getInventory()->canAddItem((EmporiumCore::getInstance()->getRankKits())->noble(1))) {
                                $player->getInventory()->addItem((EmporiumCore::getInstance()->getRankKits())->noble(1));
                                DataManager::getInstance()->setPlayerData($player, "prestige_kit2", 259200); # 3 day cooldown
                            } else {
                                $player->getWorld()->dropItem($player->getPosition(), (EmporiumCore::getInstance()->getRankKits())->noble(1));
                            }
                            $player->sendMessage(TF::GREEN . "You claimed Prestige Kit 2");
                        }
                    } else {
                        $player->sendMessage(TF::RED . "That Prestige Kit is Locked");
                    }
                    break;

                case 2:
                    $cooldown = DataManager::getInstance()->getPlayerData($player->getXuid(), "prestige_kit3");
                    $permission = PermissionsManager::getInstance()->checkPermission($player->getXuid(), "emporiumcore_prestigekit_prestige3");
                    if($permission) {
                        if($cooldown > 0) {
                            $player->sendMessage(TF::RED . "That Prestige Kit is on Cooldown, Time remaining: " . Translator::timeConvert($cooldown));
                            $player->broadcastSound(new DoorCrashSound());
                        } else {
                            if($player->getInventory()->canAddItem((EmporiumCore::getInstance()->getRankKits())->noble(1))) {
                                $player->getInventory()->addItem((EmporiumCore::getInstance()->getRankKits())->noble(1));
                                DataManager::getInstance()->setPlayerData($player, "prestige_kit3", 259200); # 3 day cooldown
                            } else {
                                $player->getWorld()->dropItem($player->getPosition(), (EmporiumCore::getInstance()->getRankKits())->noble(1));
                            }
                            $player->sendMessage(TF::GREEN . "You claimed Prestige Kit 3");
                        }
                    } else {
                        $player->sendMessage(TF::RED . "That Prestige Kit is Locked");
                    }
                    break;

                case 3:
                    $cooldown = DataManager::getInstance()->getPlayerData($player->getXuid(), "PrestigeKit4");
                    $permission = PermissionsManager::getInstance()->checkPermission($player->getXuid(), "emporiumcore_prestigekit_prestige4");
                    if($permission) {
                        if(DataManager::getInstance()->getPlayerData($player->getXuid(), "PrestigeKit4") > 0) {
                            $player->sendMessage(TF::RED . "That Prestige Kit is on Cooldown, Time remaining: " . Translator::timeConvert($cooldown));
                            $player->broadcastSound(new DoorCrashSound());
                        } else {
                            if($player->getInventory()->canAddItem((EmporiumCore::getInstance()->getRankKits())->noble(1))) {
                                $player->getInventory()->addItem((EmporiumCore::getInstance()->getRankKits())->noble(1));
                                DataManager::getInstance()->setPlayerData($player, "prestige_kit4", 259200); # 3 day cooldown
                            } else {
                                $player->getWorld()->dropItem($player->getPosition(), (EmporiumCore::getInstance()->getRankKits())->noble(1));
                            }
                            $player->sendMessage(TF::GREEN . "You claimed Prestige Kit 4");
                        }
                    } else {
                        $player->sendMessage(TF::RED . "That Prestige Kit is Locked");
                    }
                    break;

                case 4:
                    $cooldown = DataManager::getInstance()->getPlayerData($player->getXuid(), "prestige_kit5");
                    $permission = PermissionsManager::getInstance()->checkPermission($player->getXuid(), "emporiumcore_prestigekit_prestige5");
                    if($permission) {
                        if($cooldown > 0) {
                            $player->sendMessage(TF::RED . "That Prestige Kit is on Cooldown, Time remaining: " . Translator::timeConvert($cooldown));
                            $player->broadcastSound(new DoorCrashSound());
                        } else {
                            if($player->getInventory()->canAddItem((EmporiumCore::getInstance()->getRankKits())->noble(1))) {
                                $player->getInventory()->addItem((EmporiumCore::getInstance()->getRankKits())->noble(1));
                                DataManager::getInstance()->setPlayerData($player, "prestige_kit5", 259200); # 3 day cooldown
                            } else {
                                $player->getWorld()->dropItem($player->getPosition(), (EmporiumCore::getInstance()->getRankKits())->noble(1));
                            }
                            $player->sendMessage(TF::GREEN . "You claimed Prestige Kit 5");
                        }
                    } else {
                        $player->sendMessage(TF::RED . "That Prestige Kit is Locked");
                    }
                    break;

                case 5:
                    $cooldown = DataManager::getInstance()->getPlayerData($player->getXuid(), "prestige_kit6");
                    $permission = PermissionsManager::getInstance()->checkPermission($player->getXuid(), "emporiumcore_prestigekit_prestige6");
                    if($permission) {
                        if($cooldown > 0) {
                            $player->sendMessage(TF::RED . "That Prestige Kit is on Cooldown, Time remaining: " . Translator::timeConvert($cooldown));
                            $player->broadcastSound(new DoorCrashSound());
                        } else {
                            if($player->getInventory()->canAddItem((EmporiumCore::getInstance()->getRankKits())->noble(1))) {
                                $player->getInventory()->addItem((EmporiumCore::getInstance()->getRankKits())->noble(1));
                                DataManager::getInstance()->setPlayerData($player, "prestige_kit6", 259200); # 3 day cooldown
                            } else {
                                $player->getWorld()->dropItem($player->getPosition(), (EmporiumCore::getInstance()->getRankKits())->noble(1));
                            }
                            $player->sendMessage(TF::GREEN . "You claimed Prestige Kit 6");
                        }
                    } else {
                        $player->sendMessage(TF::RED . "That Prestige Kit is Locked");
                    }
                    break;

                case 6:
                    $this->Form($player);
                    break;

            }
        });
        $form->setTitle(TF::BOLD . "Prestige Kits");
        $form->setContent("Click a kit to claim it");
        if(PermissionsManager::getInstance()->checkPermission($player->getXuid(), "emporiumcore_prestigekit_prestige1")) {
            if(DataManager::getInstance()->getPlayerData($player->getXuid(), "prestige_kit1") > 0) {
                $form->addButton(TF::BOLD . "Prestige 1\n" . TF::RED . "On Cooldown");
            } else {
                $form->addButton(TF::BOLD . "Prestige 1\n" . TF::GREEN . "Available");
            }
        } else {
            $form->addButton(TF::BOLD . "Prestige 1\n" . TF::RED . "Locked");
        }
        if(PermissionsManager::getInstance()->checkPermission($player->getXuid(), "emporiumcore_prestigekit_prestige2")) {
            if(DataManager::getInstance()->getPlayerData($player->getXuid(), "prestige_kit2") > 0) {
                $form->addButton(TF::BOLD . "Prestige 2\n" . TF::RED . "On Cooldown");
            } else {
                $form->addButton(TF::BOLD . "Prestige 2\n" . TF::GREEN . "Available");
            }
        } else {
            $form->addButton(TF::BOLD . "Prestige 2\n" . TF::RED . "Locked");
        }
        if(PermissionsManager::getInstance()->checkPermission($player->getXuid(), "emporiumcore_prestigekit_prestige3")) {
            if(DataManager::getInstance()->getPlayerData($player->getXuid(), "prestige_kit3") > 0) {
                $form->addButton(TF::BOLD . "Prestige 3\n" . TF::RED . "On Cooldown");
            } else {
                $form->addButton(TF::BOLD . "Prestige 3\n" . TF::GREEN . "Available");
            }
        } else {
            $form->addButton(TF::BOLD . "Prestige 3\n" . TF::RED . "Locked");
        }
        if(PermissionsManager::getInstance()->checkPermission($player->getXuid(), "emporiumcore_prestigekit_prestige4")) {
            if(DataManager::getInstance()->getPlayerData($player->getXuid(), "prestige_kit4") > 0) {
                $form->addButton(TF::BOLD . "Prestige 4\n" . TF::RED . "On Cooldown");
            } else {
                $form->addButton(TF::BOLD . "Prestige 4\n" . TF::GREEN . "Available");
            }
        } else {
            $form->addButton(TF::BOLD . "Prestige 4\n" . TF::RED . "Locked");
        }
        if(PermissionsManager::getInstance()->checkPermission($player->getXuid(), "emporiumcore_prestigekit_prestige5")) {
            if(DataManager::getInstance()->getPlayerData($player->getXuid(), "prestige_kit5") > 0) {
                $form->addButton(TF::BOLD . "Prestige 5\n" . TF::RED . "On Cooldown");
            } else {
                $form->addButton(TF::BOLD . "Prestige 5\n" . TF::GREEN . "Available");
            }
        } else {
            $form->addButton(TF::BOLD . "Prestige 5\n" . TF::RED . "Locked");
        }
        if(PermissionsManager::getInstance()->checkPermission($player->getXuid(), "emporiumcore_prestigekit_prestige6")) {
            if(DataManager::getInstance()->getPlayerData($player->getXuid(), "prestige_kit6") > 0) {
                $form->addButton(TF::BOLD . "Prestige 6\n" . TF::RED . "On Cooldown");
            } else {
                $form->addButton(TF::BOLD . "Prestige 6\n" . TF::GREEN . "Available");
            }
        } else {
            $form->addButton(TF::BOLD . "Prestige 6\n" . TF::RED . "Locked");
        }
        $form->addButton(TF::BOLD . TF::RED . "Back");
        $player->sendForm($form);
    }

    public function Inventory($player): void {
        $menu = InvMenu::create(InvMenuTypeIds::TYPE_CHEST);
        $menu->setName(TF::BOLD . "Kits Menu");
        $menu->setListener(InvMenu::readonly(function(DeterministicInvMenuTransaction $transaction) {

            $itemClicked = $transaction->getItemClicked();
            $player = $transaction->getPlayer();

            switch($itemClicked->getId()) {
                # rank kits
                case ItemIds::DIAMOND_SWORD:
                    $player->broadcastSound(new EnderChestOpenSound(), [$player]);
                    $menu = EmporiumCore::getInstance()->getRankKitsMenu();
                    $menu->Inventory($player);
                    break;
                    # god kits
                case ItemIds::ENDER_CHEST:
                    $player->broadcastSound(new EnderChestOpenSound(), [$player]);
                    $menu = EmporiumCore::getInstance()->getGkitsMenu();
                    $menu->Inventory($player);
                    break;
                    # quest kits
                case ItemIds::WRITABLE_BOOK:
                    $player->broadcastSound(new EnderChestOpenSound(), [$player]);
                    $player->sendMessage(TF::GRAY . "Coming soon");
                    break;
                    # prestige kits
                case ItemIds::ENDER_PEARL:
                    $player->broadcastSound(new EnderChestOpenSound(), [$player]);
                    break;
            }
        }));
        $inventory = $menu->getInventory();

        $inventory->setItem(10, $this->rankKitsItem());
        $inventory->setItem(12, $this->godKitsItem());
        $inventory->setItem(14, $this->questKitsItem());
        $inventory->setItem(16, $this->prestigeKitsItem());

        $menu->send($player);
    }


    public function rankKitsItem(): Item {
        $item = VanillaItems::DIAMOND_SWORD();
        $item->setCustomName(TF::BOLD . TF::AQUA . "Rank Kits");
        $lore = [
            "§r",
            TF::BOLD . TF::GRAY . "(Click)"
        ];
        $item->setLore($lore);

        return $item;
    }

    public function godKitsItem(): Item {
        $item = VanillaBlocks::ENDER_CHEST()->asItem();
        $item->setCustomName(TF::BOLD . TF::AQUA . "God Kits");
        $lore = [
            "§r",
            TF::BOLD . TF::GRAY . "(Click)"
        ];
        $item->setLore($lore);

        return $item;
    }

    public function questKitsItem(): Item {
        $item = VanillaItems::WRITABLE_BOOK();
        $item->setCustomName(TF::BOLD . TF::AQUA . "Quest Kits");
        $lore = [
            "§r",
            TF::BOLD . TF::GRAY . "(Click)"
        ];
        $item->setLore($lore);

        return $item;
    }

    public function prestigeKitsItem(): Item {
        $item = VanillaItems::ENDER_PEARL();
        $item->setCustomName(TF::BOLD . TF::AQUA . "Prestige Kits");
        $lore = [
            "§r",
            TF::BOLD . TF::GRAY . "(Click)"
        ];
        $item->setLore($lore);

        return $item;
    }
}