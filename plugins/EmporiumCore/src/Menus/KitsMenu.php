<?php

namespace Menus;

use Emporium\Prison\library\formapi\SimpleForm;
use Emporium\Prison\Managers\misc\Translator;
use EmporiumCore\Managers\Data\DataManager;
use Items\RankKits;
use muqsit\invmenu\InvMenu;
use muqsit\invmenu\transaction\DeterministicInvMenuTransaction;
use muqsit\invmenu\type\InvMenuTypeIds;
use pocketmine\item\Item;
use pocketmine\item\ItemFactory;
use pocketmine\item\ItemIds;
use pocketmine\item\VanillaItems;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;
use pocketmine\world\sound\DoorCrashSound;
use pocketmine\world\sound\EnderChestCloseSound;
use pocketmine\world\sound\EnderChestOpenSound;

class KitsMenu {

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
                    $gkits = new GKitsMenu();
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

    public function rankKitsForm($player): void {
        $form = new SimpleForm(function(Player $player, $data) {
            if($data === null) {
                return;
            }
            switch($data) {

                case 0:
                    $cooldown = DataManager::getData($player, "Cooldowns", "RankKitNoble");
                    $permission = DataManager::getData($player, "Permissions", "emporiumcore.rankkit.noble");
                    if($permission) {
                        if(DataManager::getData($player, "Cooldowns", "RankKitNoble") > 0) {
                            $player->sendMessage(TF::RED . "That GKit is on Cooldown, Time remaining: " . Translator::timeConvert($cooldown));
                            $player->broadcastSound(new DoorCrashSound());
                        } else {
                            if($player->getInventory()->canAddItem((new RankKits())->noble(1))) {
                                $player->getInventory()->addItem((new RankKits())->noble(1));
                                DataManager::setData($player, "Cooldowns", "RankKitNoble", 259200); # 3 day cooldown
                            } else {
                                $player->getWorld()->dropItem($player->getPosition(), (new RankKits())->noble(1));
                            }
                            $player->sendMessage(TF::GREEN . "You claimed Noble Rank Kit");
                        }
                    } else {
                        $player->sendMessage(TF::RED . "That Rank Kit is Locked");
                    }
                    break;

                case 1:
                    $cooldown = DataManager::getData($player, "Cooldowns", "RankKitImperial");
                    $permission = DataManager::getData($player, "Permissions", "emporiumcore.rankkit.imperial");
                    if($permission) {
                        if(DataManager::getData($player, "Cooldowns", "RankKitImperial") > 0) {
                            $player->sendMessage(TF::RED . "That GKit is on Cooldown, Time remaining: " . Translator::timeConvert($cooldown));
                            $player->broadcastSound(new DoorCrashSound());
                        } else {
                            if($player->getInventory()->canAddItem((new RankKits())->imperial(1))) {
                                $player->getInventory()->addItem((new RankKits())->imperial(1));
                                DataManager::setData($player, "Cooldowns", "RankKitImperial", 259200); # 3 day cooldown
                            } else {
                                $player->getWorld()->dropItem($player->getPosition(), (new RankKits())->imperial(1));
                            }
                            $player->sendMessage(TF::GREEN . "You claimed Imperial Rank Kit");
                        }
                    } else {
                        $player->sendMessage(TF::RED . "That Rank Kit is Locked");
                    }
                    break;

                case 2:
                    $cooldown = DataManager::getData($player, "Cooldowns", "RankKitSupreme");
                    $permission = DataManager::getData($player, "Permissions", "emporiumcore.rankkit.supreme");
                    if($permission) {
                        if(DataManager::getData($player, "Cooldowns", "RankKitSupreme") > 0) {
                            $player->sendMessage(TF::RED . "That GKit is on Cooldown, Time remaining: " . Translator::timeConvert($cooldown));
                            $player->broadcastSound(new DoorCrashSound());
                        } else {
                            if($player->getInventory()->canAddItem((new RankKits())->supreme(1))) {
                                $player->getInventory()->addItem((new RankKits())->supreme(1));
                                DataManager::setData($player, "Cooldowns", "RankKitSupreme", 259200); # 3 day cooldown
                            } else {
                                $player->getWorld()->dropItem($player->getPosition(), (new RankKits())->supreme(1));
                            }
                            $player->sendMessage(TF::GREEN . "You claimed Supreme Rank Kit");
                        }
                    } else {
                        $player->sendMessage(TF::RED . "That Rank Kit is Locked");
                    }
                    break;

                case 3:
                    $cooldown = DataManager::getData($player, "Cooldowns", "RankKitMajesty");
                    $permission = DataManager::getData($player, "Permissions", "emporiumcore.rankkit.majesty");
                    if($permission) {
                        if(DataManager::getData($player, "Cooldowns", "RankKitMajesty") > 0) {
                            $player->sendMessage(TF::RED . "That GKit is on Cooldown, Time remaining: " . Translator::timeConvert($cooldown));
                            $player->broadcastSound(new DoorCrashSound());
                        } else {
                            if($player->getInventory()->canAddItem((new RankKits())->majesty(1))) {
                                $player->getInventory()->addItem((new RankKits())->majesty(1));
                                DataManager::setData($player, "Cooldowns", "RankKitNoble", 259200); # 3 day cooldown
                            } else {
                                $player->getWorld()->dropItem($player->getPosition(), (new RankKits())->majesty(1));
                            }
                            $player->sendMessage(TF::GREEN . "You claimed Majesty Rank Kit");
                        }
                    } else {
                        $player->sendMessage(TF::RED . "That Rank Kit is Locked");
                    }
                    break;

                case 4:
                    $cooldown = DataManager::getData($player, "Cooldowns", "RankKitEmperor");
                    $permission = DataManager::getData($player, "Permissions", "emporiumcore.rankkit.emperor");
                    if($permission) {
                        if(DataManager::getData($player, "Cooldowns", "RankKitEmperor") > 0) {
                            $player->sendMessage(TF::RED . "That GKit is on Cooldown, Time remaining: " . Translator::timeConvert($cooldown));
                            $player->broadcastSound(new DoorCrashSound());
                        } else {
                            if($player->getInventory()->canAddItem((new RankKits())->emperor(1))) {
                                $player->getInventory()->addItem((new RankKits())->emperor(1));
                                DataManager::setData($player, "Cooldowns", "RankKitEmperor", 259200); # 3 day cooldown
                            } else {
                                $player->getWorld()->dropItem($player->getPosition(), (new RankKits())->emperor(1));
                            }
                            $player->sendMessage(TF::GREEN . "You claimed Emperor Rank Kit");
                        }
                    } else {
                        $player->sendMessage(TF::RED . "That Rank Kit is Locked");
                    }
                    break;

                case 5:
                    $cooldown = DataManager::getData($player, "Cooldowns", "RankKitPresident");
                    $permission = DataManager::getData($player, "Permissions", "emporiumcore.rankkit.president");
                    if($permission) {
                        if(DataManager::getData($player, "Cooldowns", "RankKitPresident") > 0) {
                            $player->sendMessage(TF::RED . "That GKit is on Cooldown, Time remaining: " . Translator::timeConvert($cooldown));
                            $player->broadcastSound(new DoorCrashSound());
                        } else {
                            if($player->getInventory()->canAddItem((new RankKits())->noble(1))) {
                                $player->getInventory()->addItem((new RankKits())->noble(1));
                                DataManager::setData($player, "Cooldowns", "RankKitPresident", 259200); # 3 day cooldown
                            } else {
                                $player->getWorld()->dropItem($player->getPosition(), (new RankKits())->president(1));
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
        if(DataManager::getData($player, "Permissions", "emporiumcore.rankkit.noble")) {
            if(DataManager::getData($player, "Cooldowns", "RankKitNoble") > 0) {
                $form->addButton(TF::BOLD . "Noble\n" . TF::RED . "On Cooldown");
            } else {
                $form->addButton(TF::BOLD . "Noble\n" . TF::GREEN . "Available");
            }
        } else {
            $form->addButton(TF::BOLD . "Noble\n" . TF::RED . "Locked");
        }
        if(DataManager::getData($player, "Permissions", "emporiumcore.rankkit.imperial")) {
            if(DataManager::getData($player, "Cooldowns", "RankKitImperial") > 0) {
                $form->addButton(TF::BOLD . "Imperial\n" . TF::RED . "On Cooldown");
            } else {
                $form->addButton(TF::BOLD . "Imperial\n" . TF::GREEN . "Available");
            }
        } else {
            $form->addButton(TF::BOLD . "Imperial\n" . TF::RED . "Locked");
        }
        if(DataManager::getData($player, "Permissions", "emporiumcore.rankkit.supreme")) {
            if(DataManager::getData($player, "Cooldowns", "RankKitSupreme") > 0) {
                $form->addButton(TF::BOLD . "Supreme\n" . TF::RED . "On Cooldown");
            } else {
                $form->addButton(TF::BOLD . "Supreme\n" . TF::GREEN . "Available");
            }
        } else {
            $form->addButton(TF::BOLD . "Supreme\n" . TF::RED . "Locked");
        }
        if(DataManager::getData($player, "Permissions", "emporiumcore.rankkit.majesty")) {
            if(DataManager::getData($player, "Cooldowns", "RankKitMajesty") > 0) {
                $form->addButton(TF::BOLD . "Majesty\n" . TF::RED . "On Cooldown");
            } else {
                $form->addButton(TF::BOLD . "Majesty\n" . TF::GREEN . "Available");
            }
        } else {
            $form->addButton(TF::BOLD . "Majesty\n" . TF::RED . "Locked");
        }
        if(DataManager::getData($player, "Permissions", "emporiumcore.rankkit.emperor")) {
            if(DataManager::getData($player, "Cooldowns", "RankKitEmperor") > 0) {
                $form->addButton(TF::BOLD . "Emperor\n" . TF::RED . "On Cooldown");
            } else {
                $form->addButton(TF::BOLD . "Emperor\n" . TF::GREEN . "Available");
            }
        } else {
            $form->addButton(TF::BOLD . "Emperor\n" . TF::RED . "Locked");
        }
        if(DataManager::getData($player, "Permissions", "emporiumcore.rankkit.president")) {
            if(DataManager::getData($player, "Cooldowns", "RankKitPresident") > 0) {
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
                    $cooldown = DataManager::getData($player, "Cooldowns", "PrestigeKit1");
                    $permission = DataManager::getData($player, "Permissions", "emporiumcore.prestigekit.prestige1");
                    if($permission) {
                        if(DataManager::getData($player, "Cooldowns", "PrestigeKit1") > 0) {
                            $player->sendMessage(TF::RED . "That Prestige Kit is on Cooldown, Time remaining: " . Translator::timeConvert($cooldown));
                            $player->broadcastSound(new DoorCrashSound());
                        } else {
                            if($player->getInventory()->canAddItem((new RankKits())->noble(1))) {
                                $player->getInventory()->addItem((new RankKits())->noble(1));
                                DataManager::setData($player, "Cooldowns", "PrestigeKit1", 259200); # 3 day cooldown
                            } else {
                                $player->getWorld()->dropItem($player->getPosition(), (new RankKits())->noble(1));
                            }
                            $player->sendMessage(TF::GREEN . "You claimed Prestige Kit 1");
                        }
                    } else {
                        $player->sendMessage(TF::RED . "That Prestige Kit is Locked");
                    }
                    break;

                case 1:
                    $cooldown = DataManager::getData($player, "Cooldowns", "PrestigeKit2");
                    $permission = DataManager::getData($player, "Permissions", "emporiumcore.prestigekit.prestige2");
                    if($permission) {
                        if(DataManager::getData($player, "Cooldowns", "PrestigeKit2") > 0) {
                            $player->sendMessage(TF::RED . "That Prestige Kit is on Cooldown, Time remaining: " . Translator::timeConvert($cooldown));
                            $player->broadcastSound(new DoorCrashSound());
                        } else {
                            if($player->getInventory()->canAddItem((new RankKits())->noble(1))) {
                                $player->getInventory()->addItem((new RankKits())->noble(1));
                                DataManager::setData($player, "Cooldowns", "PrestigeKit2", 259200); # 3 day cooldown
                            } else {
                                $player->getWorld()->dropItem($player->getPosition(), (new RankKits())->noble(1));
                            }
                            $player->sendMessage(TF::GREEN . "You claimed Prestige Kit 2");
                        }
                    } else {
                        $player->sendMessage(TF::RED . "That Prestige Kit is Locked");
                    }
                    break;

                case 2:
                    $cooldown = DataManager::getData($player, "Cooldowns", "PrestigeKit3");
                    $permission = DataManager::getData($player, "Permissions", "emporiumcore.prestigekit.prestige3");
                    if($permission) {
                        if(DataManager::getData($player, "Cooldowns", "PrestigeKit3") > 0) {
                            $player->sendMessage(TF::RED . "That Prestige Kit is on Cooldown, Time remaining: " . Translator::timeConvert($cooldown));
                            $player->broadcastSound(new DoorCrashSound());
                        } else {
                            if($player->getInventory()->canAddItem((new RankKits())->noble(1))) {
                                $player->getInventory()->addItem((new RankKits())->noble(1));
                                DataManager::setData($player, "Cooldowns", "PrestigeKit3", 259200); # 3 day cooldown
                            } else {
                                $player->getWorld()->dropItem($player->getPosition(), (new RankKits())->noble(1));
                            }
                            $player->sendMessage(TF::GREEN . "You claimed Prestige Kit 3");
                        }
                    } else {
                        $player->sendMessage(TF::RED . "That Prestige Kit is Locked");
                    }
                    break;

                case 3:
                    $cooldown = DataManager::getData($player, "Cooldowns", "PrestigeKit4");
                    $permission = DataManager::getData($player, "Permissions", "emporiumcore.prestigekit.prestige4");
                    if($permission) {
                        if(DataManager::getData($player, "Cooldowns", "PrestigeKit4") > 0) {
                            $player->sendMessage(TF::RED . "That Prestige Kit is on Cooldown, Time remaining: " . Translator::timeConvert($cooldown));
                            $player->broadcastSound(new DoorCrashSound());
                        } else {
                            if($player->getInventory()->canAddItem((new RankKits())->noble(1))) {
                                $player->getInventory()->addItem((new RankKits())->noble(1));
                                DataManager::setData($player, "Cooldowns", "PrestigeKit4", 259200); # 3 day cooldown
                            } else {
                                $player->getWorld()->dropItem($player->getPosition(), (new RankKits())->noble(1));
                            }
                            $player->sendMessage(TF::GREEN . "You claimed Prestige Kit 4");
                        }
                    } else {
                        $player->sendMessage(TF::RED . "That Prestige Kit is Locked");
                    }
                    break;

                case 4:
                    $cooldown = DataManager::getData($player, "Cooldowns", "PrestigeKit5");
                    $permission = DataManager::getData($player, "Permissions", "emporiumcore.prestigekit.prestige5");
                    if($permission) {
                        if(DataManager::getData($player, "Cooldowns", "PrestigeKit5") > 0) {
                            $player->sendMessage(TF::RED . "That Prestige Kit is on Cooldown, Time remaining: " . Translator::timeConvert($cooldown));
                            $player->broadcastSound(new DoorCrashSound());
                        } else {
                            if($player->getInventory()->canAddItem((new RankKits())->noble(1))) {
                                $player->getInventory()->addItem((new RankKits())->noble(1));
                                DataManager::setData($player, "Cooldowns", "PrestigeKit5", 259200); # 3 day cooldown
                            } else {
                                $player->getWorld()->dropItem($player->getPosition(), (new RankKits())->noble(1));
                            }
                            $player->sendMessage(TF::GREEN . "You claimed Prestige Kit 5");
                        }
                    } else {
                        $player->sendMessage(TF::RED . "That Prestige Kit is Locked");
                    }
                    break;

                case 5:
                    $cooldown = DataManager::getData($player, "Cooldowns", "PrestigeKit6");
                    $permission = DataManager::getData($player, "Permissions", "emporiumcore.prestigekit.prestige6");
                    if($permission) {
                        if(DataManager::getData($player, "Cooldowns", "PrestigeKit6") > 0) {
                            $player->sendMessage(TF::RED . "That Prestige Kit is on Cooldown, Time remaining: " . Translator::timeConvert($cooldown));
                            $player->broadcastSound(new DoorCrashSound());
                        } else {
                            if($player->getInventory()->canAddItem((new RankKits())->noble(1))) {
                                $player->getInventory()->addItem((new RankKits())->noble(1));
                                DataManager::setData($player, "Cooldowns", "PrestigeKit6", 259200); # 3 day cooldown
                            } else {
                                $player->getWorld()->dropItem($player->getPosition(), (new RankKits())->noble(1));
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
        if(DataManager::getData($player, "Permissions", "emporiumcore.prestigekit.prestige1")) {
            if(DataManager::getData($player, "Cooldowns", "Prestige1Kit") > 0) {
                $form->addButton(TF::BOLD . "Prestige 1\n" . TF::RED . "On Cooldown");
            } else {
                $form->addButton(TF::BOLD . "Prestige 1\n" . TF::GREEN . "Available");
            }
        } else {
            $form->addButton(TF::BOLD . "Prestige 1\n" . TF::RED . "Locked");
        }
        if(DataManager::getData($player, "Permissions", "emporiumcore.prestigekit.prestige2")) {
            if(DataManager::getData($player, "Cooldowns", "Prestige2Kit") > 0) {
                $form->addButton(TF::BOLD . "Prestige 2\n" . TF::RED . "On Cooldown");
            } else {
                $form->addButton(TF::BOLD . "Prestige 2\n" . TF::GREEN . "Available");
            }
        } else {
            $form->addButton(TF::BOLD . "Prestige 2\n" . TF::RED . "Locked");
        }
        if(DataManager::getData($player, "Permissions", "emporiumcore.prestigekit.prestige3")) {
            if(DataManager::getData($player, "Cooldowns", "Prestige3Kit") > 0) {
                $form->addButton(TF::BOLD . "Prestige 3\n" . TF::RED . "On Cooldown");
            } else {
                $form->addButton(TF::BOLD . "Prestige 3\n" . TF::GREEN . "Available");
            }
        } else {
            $form->addButton(TF::BOLD . "Prestige 3\n" . TF::RED . "Locked");
        }
        if(DataManager::getData($player, "Permissions", "emporiumcore.prestigekit.prestige4")) {
            if(DataManager::getData($player, "Cooldowns", "Prestige4Kit") > 0) {
                $form->addButton(TF::BOLD . "Prestige 4\n" . TF::RED . "On Cooldown");
            } else {
                $form->addButton(TF::BOLD . "Prestige 4\n" . TF::GREEN . "Available");
            }
        } else {
            $form->addButton(TF::BOLD . "Prestige 4\n" . TF::RED . "Locked");
        }
        if(DataManager::getData($player, "Permissions", "emporiumcore.prestigekit.prestige5")) {
            if(DataManager::getData($player, "Cooldowns", "Prestige5Kit") > 0) {
                $form->addButton(TF::BOLD . "Prestige 5\n" . TF::RED . "On Cooldown");
            } else {
                $form->addButton(TF::BOLD . "Prestige 5\n" . TF::GREEN . "Available");
            }
        } else {
            $form->addButton(TF::BOLD . "Prestige 5\n" . TF::RED . "Locked");
        }
        if(DataManager::getData($player, "Permissions", "emporiumcore.prestigekit.prestige6")) {
            if(DataManager::getData($player, "Cooldowns", "Prestige6Kit") > 0) {
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
                    $menu = new RankKitsMenu();
                    $menu->Inventory($player);
                    break;
                    # god kits
                case ItemIds::ENDER_CHEST:
                    $player->broadcastSound(new EnderChestOpenSound(), [$player]);
                    $menu = new GKitsMenu();
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
        $item = ItemFactory::getInstance()->get(ItemIds::ENDER_CHEST);
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