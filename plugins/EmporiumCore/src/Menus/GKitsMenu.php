<?php

namespace Menus;

use Emporium\Prison\library\formapi\SimpleForm;
use Emporium\Prison\Managers\misc\GlowManager;
use Emporium\Prison\Managers\misc\Translator;
use EmporiumCore\Managers\Data\DataManager;
use Items\GKits;
use muqsit\invmenu\InvMenu;
use muqsit\invmenu\transaction\DeterministicInvMenuTransaction;
use muqsit\invmenu\type\InvMenuTypeIds;
use pocketmine\item\Item;
use pocketmine\item\StringToItemParser;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;
use pocketmine\world\sound\DoorCrashSound;
use pocketmine\world\sound\EnderChestCloseSound;
use pocketmine\world\sound\ItemFrameAddItemSound;


class GKitsMenu {

    public function Form($sender): void {

        $form = new SimpleForm(function (Player $sender, $data) {
            $result = $data;
            if($result === null) {
                $sender->broadcastSound(new EnderChestCloseSound());
                return true;
            }
            switch($result) {

                case 0:
                    $cooldown = \Emporium\Prison\Managers\DataManager::getData($sender, "Cooldowns", "GKitHeroicVulkarion");
                    $permission = DataManager::getData($sender, "Permissions", "emporiumcore.gkit.heroicvulkarion");
                    if($permission) {
                        if(DataManager::getData($sender, "Cooldowns", "GKitHeroicVulkarion") > 0) {
                            $sender->sendMessage(TF::RED . "That GKit is on Cooldown, Time remaining: " . Translator::timeConvert($cooldown));
                            $sender->broadcastSound(new DoorCrashSound());
                        } else {
                            if($sender->getInventory()->canAddItem((new GKits())->heroicVulkarion(1))) {
                                $sender->getInventory()->addItem((new GKits())->heroicVulkarion(1));
                                DataManager::setData($sender, "Cooldowns", "GKitHeroicVulkarion", 259200); # 3 day cooldown
                            } else {
                                $sender->getWorld()->dropItem($sender->getPosition(), (new GKits())->heroicVulkarion(1));
                            }
                            $sender->sendMessage(TF::GREEN . "You claimed Heroic Vulkarion GKit");
                        }
                    } else {
                        $sender->sendMessage(TF::RED . "That GKit is Locked");
                    }
                    break;

                case 1:
                    $cooldown = DataManager::getData($sender, "Cooldowns", "GKitHeroicZenith");
                    $permission = DataManager::getData($sender, "Permissions", "emporiumcore.gkit.heroiczenith");
                    if($permission) {
                        if(DataManager::getData($sender, "Cooldowns", "GKitHeroicZenith") > 0) {
                            $sender->sendMessage(TF::RED . "That GKit is on Cooldown, Time remaining: " . Translator::timeConvert($cooldown));
                            $sender->broadcastSound(new DoorCrashSound());
                        } else {
                            if($sender->getInventory()->canAddItem((new GKits())->heroicZenith(1))) {
                                $sender->getInventory()->addItem((new GKits())->heroicZenith(1));
                            } else {
                                $sender->getWorld()->dropItem($sender->getPosition(), (new GKits())->heroicZenith(1));
                            }
                            DataManager::setData($sender, "Cooldowns", "GKitHeroicZenith", 259200); # 3 day cooldown
                            $sender->sendMessage(TF::GREEN . "You claimed Heroic Zenith GKit");
                        }
                    } else {
                        $sender->sendMessage(TF::RED . "That GKit is Locked");
                    }
                    break;

                case 2:
                    $cooldown = DataManager::getData($sender, "Cooldowns", "GKitHeroicColossus");
                    $permission = DataManager::getData($sender, "Permissions", "emporiumcore.gkit.heroiccolossus");
                    if($permission) {
                        if(DataManager::getData($sender, "Cooldowns", "GKitHeroicColossus") > 0) {
                            $sender->sendMessage(TF::RED . "That GKit is on Cooldown, Time remaining: " . Translator::timeConvert($cooldown));
                            $sender->broadcastSound(new DoorCrashSound());
                        } else {
                            if($sender->getInventory()->canAddItem((new GKits())->heroicColossus(1))) {
                                $sender->getInventory()->addItem((new GKits())->heroicColossus(1));
                            } else {
                                $sender->getWorld()->dropItem($sender->getPosition(), (new GKits())->heroicColossus(1));
                            }
                            DataManager::setData($sender, "Cooldowns", "GKitHeroicColossus", 259200); # 3 day cooldown
                            $sender->sendMessage(TF::GREEN . "You claimed Heroic Zenith GKit");
                        }
                    } else {
                        $sender->sendMessage(TF::RED . "That GKit is Locked");
                    }
                    break;

                case 3:
                    $cooldown = DataManager::getData($sender, "Cooldowns", "GKitHeroicWarlock");
                    $permission = DataManager::getData($sender, "Permissions", "emporiumcore.gkit.heroicwarlock");
                    if($permission) {
                        if(DataManager::getData($sender, "Cooldowns", "GKitHeroicWarlock") > 0) {
                            $sender->sendMessage(TF::RED . "That GKit is on Cooldown, Time remaining: " . Translator::timeConvert($cooldown));
                            $sender->broadcastSound(new DoorCrashSound());
                        } else {
                            if($sender->getInventory()->canAddItem((new GKits())->heroicWarlock(1))) {
                                $sender->getInventory()->addItem((new GKits())->heroicWarlock(1));
                            } else {
                                $sender->getWorld()->dropItem($sender->getPosition(), (new GKits())->heroicWarlock(1));
                            }
                            DataManager::setData($sender, "Cooldowns", "GKitHeroicWarlock", 259200); # 3 day cooldown
                            $sender->sendMessage(TF::GREEN . "You claimed Heroic Warlock GKit");
                        }
                    } else {
                        $sender->sendMessage(TF::RED . "That GKit is Locked");
                    }
                    break;

                case 4:
                    $cooldown = DataManager::getData($sender, "Cooldowns", "GKitHeroicSlaughter");
                    $permission = DataManager::getData($sender, "Permissions", "emporiumcore.gkit.heroicslaughter");
                    if($permission) {
                        if(DataManager::getData($sender, "Cooldowns", "GKitHeroicSlaughter") > 0) {
                            $sender->sendMessage(TF::RED . "That GKit is on Cooldown, Time remaining: " . Translator::timeConvert($cooldown));
                            $sender->broadcastSound(new DoorCrashSound());
                        } else {
                            if($sender->getInventory()->canAddItem((new GKits())->heroicSlaughter(1))) {
                                $sender->getInventory()->addItem((new GKits())->heroicSlaughter(1));
                            } else {
                                $sender->getWorld()->dropItem($sender->getPosition(), (new GKits())->heroicSlaughter(1));
                            }
                            DataManager::setData($sender, "Cooldowns", "GKitHeroicSlaughter", 259200); # 3 day cooldown
                            $sender->sendMessage(TF::GREEN . "You claimed Heroic Slaughter GKit");
                        }
                    } else {
                        $sender->sendMessage(TF::RED . "That GKit is Locked");
                    }
                    break;

                case 5:
                    $cooldown = DataManager::getData($sender, "Cooldowns", "GKitHeroicEnchanter");
                    $permission = DataManager::getData($sender, "Permissions", "emporiumcore.gkit.heroicenchanter");
                    if($permission) {
                        if(DataManager::getData($sender, "Cooldowns", "GKitHeroicEnchanter") > 0) {
                            $sender->sendMessage(TF::RED . "That GKit is on Cooldown, Time remaining: " . Translator::timeConvert($cooldown));
                            $sender->broadcastSound(new DoorCrashSound());
                        } else {
                            if($sender->getInventory()->canAddItem((new GKits())->heroicEnchanter(1))) {
                                $sender->getInventory()->addItem((new GKits())->heroicEnchanter(1));
                            } else {
                                $sender->getWorld()->dropItem($sender->getPosition(), (new GKits())->heroicEnchanter(1));
                            }
                            DataManager::setData($sender, "Cooldowns", "GKitHeroicEnchanter", 259200); # 3 day cooldown
                            $sender->sendMessage(TF::GREEN . "You claimed Heroic Enchanter GKit");
                        }
                    } else {
                        $sender->sendMessage(TF::RED . "That GKit is Locked");
                    }
                    break;

                case 6:
                    $cooldown = DataManager::getData($sender, "Cooldowns", "GKitHeroicAtheos");
                    $permission = DataManager::getData($sender, "Permissions", "emporiumcore.gkit.heroicatheos");
                    if($permission) {
                        if(DataManager::getData($sender, "Cooldowns", "GKitHeroicAtheos") > 0) {
                            $sender->sendMessage(TF::RED . "That GKit is on Cooldown, Time remaining: " . Translator::timeConvert($cooldown));
                            $sender->broadcastSound(new DoorCrashSound());
                        } else {
                            if($sender->getInventory()->canAddItem((new GKits())->heroicAtheos(1))) {
                                $sender->getInventory()->addItem((new GKits())->heroicAtheos(1));
                            } else {
                                $sender->getWorld()->dropItem($sender->getPosition(), (new GKits())->heroicAtheos(1));
                            }
                            DataManager::setData($sender, "Cooldowns", "GKitHeroicAtheos", 259200); # 3 day cooldown
                            $sender->sendMessage(TF::GREEN . "You claimed Heroic Atheos GKit");
                        }
                    } else {
                        $sender->sendMessage(TF::RED . "That GKit is Locked");
                    }
                    break;

                case 7:
                    $cooldown = DataManager::getData($sender, "Cooldowns", "GKitHeroicIapetus");
                    $permission = DataManager::getData($sender, "Permissions", "emporiumcore.gkit.heroiciapetus");
                    if($permission) {
                        if(DataManager::getData($sender, "Cooldowns", "GKitHeroicIapetus") > 0) {
                            $sender->sendMessage(TF::RED . "That GKit is on Cooldown, Time remaining: " . Translator::timeConvert($cooldown));
                            $sender->broadcastSound(new DoorCrashSound());
                        } else {
                            if($sender->getInventory()->canAddItem((new GKits())->heroicIapetus(1))) {
                                $sender->getInventory()->addItem((new GKits())->heroicIapetus(1));
                            } else {
                                $sender->getWorld()->dropItem($sender->getPosition(), (new GKits())->heroicIapetus(1));
                            }
                            DataManager::setData($sender, "Cooldowns", "GKitHeroicIapetus", 259200); # 3 day cooldown
                            $sender->sendMessage(TF::GREEN . "You claimed Heroic Iapetus GKit");
                        }
                    } else {
                        $sender->sendMessage(TF::RED . "That GKit is Locked");
                    }
                    break;

                case 8:
                    $cooldown = DataManager::getData($sender, "Cooldowns", "GKitHeroicBroteas");
                    $permission = DataManager::getData($sender, "Permissions", "emporiumcore.gkit.heroicbroteas");
                    if($permission) {
                        if(DataManager::getData($sender, "Cooldowns", "GKitHeroicWBroteas") > 0) {
                            $sender->sendMessage(TF::RED . "That GKit is on Cooldown, Time remaining: " . Translator::timeConvert($cooldown));
                            $sender->broadcastSound(new DoorCrashSound());
                        } else {
                            if($sender->getInventory()->canAddItem((new GKits())->heroicBroteas(1))) {
                                $sender->getInventory()->addItem((new GKits())->heroicBroteas(1));
                                DataManager::setData($sender, "Cooldowns", "GKitHeroicBroteas", 259200); # 3 day cooldown
                            } else {
                                $sender->getWorld()->dropItem($sender->getPosition(), (new GKits())->heroicBroteas(1));
                            }
                            DataManager::setData($sender, "Cooldowns", "GKitHeroicBroteas", 259200); # 3 day cooldown
                            $sender->sendMessage(TF::GREEN . "You claimed Heroic Broteas GKit");
                        }
                    } else {
                        $sender->sendMessage(TF::RED . "That GKit is Locked");
                    }
                    break;

                case 9:
                    $cooldown = DataManager::getData($sender, "Cooldowns", "GKitHeroicAres");
                    $permission = DataManager::getData($sender, "Permissions", "emporiumcore.gkit.heroicares");
                    if($permission) {
                        if(DataManager::getData($sender, "Cooldowns", "GKitHeroicAres") > 0) {
                            $sender->sendMessage(TF::RED . "That GKit is on Cooldown, Time remaining: " . Translator::timeConvert($cooldown));
                            $sender->broadcastSound(new DoorCrashSound());
                        } else {
                            if($sender->getInventory()->canAddItem((new GKits())->heroicAres(1))) {
                                $sender->getInventory()->addItem((new GKits())->heroicAres(1));
                            } else {
                                $sender->getWorld()->dropItem($sender->getPosition(), (new GKits())->heroicAres(1));
                            }
                            DataManager::setData($sender, "Cooldowns", "GKitHeroicAres", 259200); # 3 day cooldown
                            $sender->sendMessage(TF::GREEN . "You claimed Heroic Ares GKit");
                        }
                    } else {
                        $sender->sendMessage(TF::RED . "That GKit is Locked");
                    }
                    break;

                case 10:
                    $cooldown = DataManager::getData($sender, "Cooldowns", "GKitHeroicGrimReaper");
                    $permission = DataManager::getData($sender, "Permissions", "emporiumcore.gkit.heroicgrimreaper");
                    if($permission) {
                        if(DataManager::getData($sender, "Cooldowns", "GKitHeroicGrimReaper") > 0) {
                            $sender->sendMessage(TF::RED . "That GKit is on Cooldown, Time remaining: " . Translator::timeConvert($cooldown));
                            $sender->broadcastSound(new DoorCrashSound());
                        } else {
                            if($sender->getInventory()->canAddItem((new GKits())->heroicGrimReaper(1))) {
                                $sender->getInventory()->addItem((new GKits())->heroicGrimReaper(1));
                            } else {
                                $sender->getWorld()->dropItem($sender->getPosition(), (new GKits())->heroicGrimReaper(1));
                            }
                            DataManager::setData($sender, "Cooldowns", "GKitHeroicGrimReaper", 259200); # 3 day cooldown
                            $sender->sendMessage(TF::GREEN . "You claimed Heroic Grim Reaper GKit");
                        }
                    } else {
                        $sender->sendMessage(TF::RED . "That GKit is Locked");
                    }
                    break;

                case 11:
                    $cooldown = DataManager::getData($sender, "Cooldowns", "GKitHeroicExecutioner");
                    $permission = DataManager::getData($sender, "Permissions", "emporiumcore.gkit.heroicexecutioner");
                    if($permission) {
                        if(DataManager::getData($sender, "Cooldowns", "GKitHeroicExecutioner") > 0) {
                            $sender->sendMessage(TF::RED . "That GKit is on Cooldown, Time remaining: " . Translator::timeConvert($cooldown));
                            $sender->broadcastSound(new DoorCrashSound());
                        } else {
                            if($sender->getInventory()->canAddItem((new GKits())->heroicExecutioner(1))) {
                                $sender->getInventory()->addItem((new GKits())->heroicExecutioner(1));
                            } else {
                                $sender->getWorld()->dropItem($sender->getPosition(), (new GKits())->heroicExecutioner(1));
                            }
                            DataManager::setData($sender, "Cooldowns", "GKitHeroicExecutioner", 259200); # 3 day cooldown
                            $sender->sendMessage(TF::GREEN . "You claimed Heroic Executioner GKit");
                        }
                    } else {
                        $sender->sendMessage(TF::RED . "That GKit is Locked");
                    }
                    break;

                case 12:
                    $cooldown = DataManager::getData($sender, "Cooldowns", "GKitBlacksmith");
                    $permission = DataManager::getData($sender, "Permissions", "emporiumcore.gkit.blacksmith");
                    if($permission) {
                        if(DataManager::getData($sender, "Cooldowns", "GKitBlacksmith") > 0) {
                            $sender->sendMessage(TF::RED . "That GKit is on Cooldown, Time remaining: " . Translator::timeConvert($cooldown));
                            $sender->broadcastSound(new DoorCrashSound());
                        } else {
                            if($sender->getInventory()->canAddItem((new GKits())->Blacksmith(1))) {
                                $sender->getInventory()->addItem((new GKits())->Blacksmith(1));
                            } else {
                                $sender->getWorld()->dropItem($sender->getPosition(), (new GKits())->Blacksmith(1));
                            }
                            DataManager::setData($sender, "Cooldowns", "GKitBlacksmith", 259200); # 3 day cooldown
                            $sender->sendMessage(TF::GREEN . "You claimed Blacksmith GKit");
                        }
                    } else {
                        $sender->sendMessage(TF::RED . "That GKit is Locked");
                    }
                    break;

                case 13:
                    $cooldown = DataManager::getData($sender, "Cooldowns", "GKitHero");
                    $permission = DataManager::getData($sender, "Permissions", "emporiumcore.gkit.hero");
                    if($permission) {
                        if(DataManager::getData($sender, "Cooldowns", "GKitHero") > 0) {
                            $sender->sendMessage(TF::RED . "That GKit is on Cooldown, Time remaining: " . Translator::timeConvert($cooldown));
                            $sender->broadcastSound(new DoorCrashSound());
                        } else {
                            if($sender->getInventory()->canAddItem((new GKits())->Hero(1))) {
                                $sender->getInventory()->addItem((new GKits())->Hero(1));
                            } else {
                                $sender->getWorld()->dropItem($sender->getPosition(), (new GKits())->Hero(1));
                            }
                            DataManager::setData($sender, "Cooldowns", "GKitHero", 259200); # 3 day cooldown
                            $sender->sendMessage(TF::GREEN . "You claimed Hero GKit");
                        }
                    } else {
                        $sender->sendMessage(TF::RED . "That GKit is Locked");
                    }
                    break;

                case 14:
                    $cooldown = DataManager::getData($sender, "Cooldowns", "GKitCyborg");
                    $permission = DataManager::getData($sender, "Permissions", "emporiumcore.gkit.cyborg");
                    if($permission) {
                        if(DataManager::getData($sender, "Cooldowns", "GKitCyborg") > 0) {
                            $sender->sendMessage(TF::RED . "That GKit is on Cooldown, Time remaining: " . Translator::timeConvert($cooldown));
                            $sender->broadcastSound(new DoorCrashSound());
                        } else {
                            if($sender->getInventory()->canAddItem((new GKits())->Cyborg(1))) {
                                $sender->getInventory()->addItem((new GKits())->Cyborg(1));
                            } else {
                                $sender->getWorld()->dropItem($sender->getPosition(), (new GKits())->Cyborg(1));
                            }
                            DataManager::setData($sender, "Cooldowns", "GKitCyborg", 259200); # 3 day cooldown
                            $sender->sendMessage(TF::GREEN . "You claimed Cyborg GKit");
                        }
                    } else {
                        $sender->sendMessage(TF::RED . "That GKit is Locked");
                    }
                    break;

                case 15:
                    $cooldown = DataManager::getData($sender, "Cooldowns", "GKitCrucible");
                    $permission = DataManager::getData($sender, "Permissions", "emporiumcore.gkit.crucible");
                    if($permission) {
                        if(DataManager::getData($sender, "Cooldowns", "GKitCrucible") > 0) {
                            $sender->sendMessage(TF::RED . "That GKit is on Cooldown, Time remaining: " . Translator::timeConvert($cooldown));
                            $sender->broadcastSound(new DoorCrashSound());
                        } else {
                            if($sender->getInventory()->canAddItem((new GKits())->Crucible(1))) {
                                $sender->getInventory()->addItem((new GKits())->Crucible(1));
                            } else {
                                $sender->getWorld()->dropItem($sender->getPosition(), (new GKits())->Crucible(1));
                            }
                            DataManager::setData($sender, "Cooldowns", "GKitCrucible", 259200); # 3 day cooldown
                            $sender->sendMessage(TF::GREEN . "You claimed Crucible GKit");
                        }
                    } else {
                        $sender->sendMessage(TF::RED . "That GKit is Locked");
                    }
                    break;

                case 16:
                    $cooldown = DataManager::getData($sender, "Cooldowns", "GKitHunter");
                    $permission = DataManager::getData($sender, "Permissions", "emporiumcore.gkit.hunter");
                    if($permission) {
                        if(DataManager::getData($sender, "Cooldowns", "GKitHunter") > 0) {
                            $sender->sendMessage(TF::RED . "That GKit is on Cooldown, Time remaining: " . Translator::timeConvert($cooldown));
                            $sender->broadcastSound(new DoorCrashSound());
                        } else {
                            if($sender->getInventory()->canAddItem((new GKits())->Hunter(1))) {
                                $sender->getInventory()->addItem((new GKits())->Hunter(1));
                            } else {
                                $sender->getWorld()->dropItem($sender->getPosition(), (new GKits())->Hunter(1));
                            }
                            DataManager::setData($sender, "Cooldowns", "GKitHunter", 259200); # 3 day cooldown
                            $sender->sendMessage(TF::GREEN . "You claimed Hunter GKit");
                        }
                    } else {
                        $sender->sendMessage(TF::RED . "That GKit is Locked");
                    }
                    break;
            }
            return true;
        });
        $form->setTitle("GKits");
        $form->setContent("§7Select a kit to use it.");
        if(DataManager::getData($sender, "Permissions", "emporiumcore.gkit.heroicvulkarion")) {
            if(DataManager::getData($sender, "Cooldowns", "GKitHeroicVulkarion") > 0) {
                $form->addButton(TF::BOLD . "Heroic Vulkarion\n" . TF::RED . "On Cooldown");
            } else {
                $form->addButton(TF::BOLD . "Heroic Vulkarion\n" . TF::GREEN . "Available");
            }
        } else {
            $form->addButton(TF::BOLD . "Heroic Vulkarion\n" . TF::RED . "Locked");
        }
        if(DataManager::getData($sender, "Permissions", "emporiumcore.gkit.heroiczenith")) {
            if(DataManager::getData($sender, "Cooldowns", "GKitHeroicZenith") > 0) {
                $form->addButton(TF::BOLD . "Heroic Zenith\n" . TF::RED . "On Cooldown");
            } else {
                $form->addButton(TF::BOLD . "Heroic Zenith\n" . TF::GREEN . "Available");
            }
        } else {
            $form->addButton(TF::BOLD . "Heroic Zenith\n" . TF::RED . "Locked");
        }
        if(DataManager::getData($sender, "Permissions", "emporiumcore.gkit.heroiccolossus")) {
            if(DataManager::getData($sender, "Cooldowns", "GKitHeroicColossus") > 0) {
                $form->addButton(TF::BOLD . "Heroic Colossus\n" . TF::RED . "On Cooldown");
            } else {
                $form->addButton(TF::BOLD . "Heroic Colossus\n" . TF::GREEN . "Available");
            }
        } else {
            $form->addButton(TF::BOLD . "Heroic Colossus\n" . TF::RED . "Locked");
        }
        if(DataManager::getData($sender, "Permissions", "emporiumcore.gkit.heroicwarlock")) {
            if(DataManager::getData($sender, "Cooldowns", "GKitHeroicWarlock") > 0) {
                $form->addButton(TF::BOLD . "Heroic Warlock\n" . TF::RED . "On Cooldown");
            } else {
                $form->addButton(TF::BOLD . "Heroic Warlock\n" . TF::GREEN . "Available");
            }
        } else {
            $form->addButton(TF::BOLD . "Heroic Warlock\n" . TF::RED . "Locked");
        }
        if(DataManager::getData($sender, "Permissions", "emporiumcore.gkit.heroicslaughter")) {
            if(DataManager::getData($sender, "Cooldowns", "GKitHeroicSlaughter") > 0) {
                $form->addButton(TF::BOLD . "Heroic Slaughter\n" . TF::RED . "On Cooldown");
            } else {
                $form->addButton(TF::BOLD . "Heroic Slaughter\n" . TF::GREEN . "Available");
            }
        } else {
            $form->addButton(TF::BOLD . "Heroic Slaughter\n" . TF::RED . "Locked");
        }
        if(DataManager::getData($sender, "Permissions", "emporiumcore.gkit.heroicenchanter")) {
            if(DataManager::getData($sender, "Cooldowns", "GKitHeroicEnchanter") > 0) {
                $form->addButton(TF::BOLD . "Heroic Enchanter\n" . TF::RED . "On Cooldown");
            } else {
                $form->addButton(TF::BOLD . "Heroic Enchanter\n" . TF::GREEN . "Available");
            }
        } else {
            $form->addButton(TF::BOLD . "Heroic Enchanter\n" . TF::RED . "Locked");
        }
        if(DataManager::getData($sender, "Permissions", "emporiumcore.gkit.heroicatheos")) {
            if(DataManager::getData($sender, "Cooldowns", "GKitHeroicAtheos") > 0) {
                $form->addButton(TF::BOLD . "Heroic Atheos\n" . TF::RED . "On Cooldown");
            } else {
                $form->addButton(TF::BOLD . "Heroic Atheos\n" . TF::GREEN . "Available");
            }
        } else {
            $form->addButton(TF::BOLD . "Heroic Atheos\n" . TF::RED . "Locked");
        }
        if(DataManager::getData($sender, "Permissions", "emporiumcore.gkit.heroiciapetus")) {
            if(DataManager::getData($sender, "Cooldowns", "GKitHeroicIapetus") > 0) {
                $form->addButton(TF::BOLD . "Heroic Iapetus\n" . TF::RED . "On Cooldown");
            } else {
                $form->addButton(TF::BOLD . "Heroic Iapetus\n" . TF::GREEN . "Available");
            }
        } else {
            $form->addButton(TF::BOLD . "Heroic Iapetus\n" . TF::RED . "Locked");
        }
        if(DataManager::getData($sender, "Permissions", "emporiumcore.gkit.heroicbroteas")) {
            if(DataManager::getData($sender, "Cooldowns", "GKitHeroicBroteas") > 0) {
                $form->addButton(TF::BOLD . "Heroic Broteas\n" . TF::RED . "On Cooldown");
            } else {
                $form->addButton(TF::BOLD . "Heroic Broteas\n" . TF::GREEN . "Available");
            }
        } else {
            $form->addButton(TF::BOLD . "Heroic Broteas\n" . TF::RED . "Locked");
        }
        if(DataManager::getData($sender, "Permissions", "emporiumcore.gkit.heroicares")) {
            if(DataManager::getData($sender, "Cooldowns", "GKitHeroicAres") > 0) {
                $form->addButton(TF::BOLD . "Heroic Ares\n" . TF::RED . "On Cooldown");
            } else {
                $form->addButton(TF::BOLD . "Heroic Ares\n" . TF::GREEN . "Available");
            }
        } else {
            $form->addButton(TF::BOLD . "Heroic Ares\n" . TF::RED . "Locked");
        }
        if(DataManager::getData($sender, "Permissions", "emporiumcore.gkit.heroicgrimreaper")) {
            if(DataManager::getData($sender, "Cooldowns", "GKitHeroicGrimReaper") > 0) {
                $form->addButton(TF::BOLD . "Heroic Grim Reaper\n" . TF::RED . "On Cooldown");
            } else {
                $form->addButton(TF::BOLD . "Heroic Grim Reaper\n" . TF::GREEN . "Available");
            }
        } else {
            $form->addButton(TF::BOLD . "Heroic Grim Reaper\n" . TF::RED . "Locked");
        }
        if(DataManager::getData($sender, "Permissions", "emporiumcore.gkit.heroicexecutioner")) {
            if(DataManager::getData($sender, "Cooldowns", "GKitHeroicExecutioner") > 0) {
                $form->addButton(TF::BOLD . "Heroic Executioner\n" . TF::RED . "On Cooldown");
            } else {
                $form->addButton(TF::BOLD . "Heroic Executioner\n" . TF::GREEN . "Available");
            }
        } else {
            $form->addButton(TF::BOLD . "Heroic Executioner\n" . TF::RED . "Locked");
        }
        if(DataManager::getData($sender, "Permissions", "emporiumcore.gkit.hero")) {
            if(DataManager::getData($sender, "Cooldowns", "GKitHero") > 0) {
                $form->addButton(TF::BOLD . "Hero\n" . TF::RED . "On Cooldown");
            } else {
                $form->addButton(TF::BOLD . "Hero\n" . TF::GREEN . "Available");
            }
        } else {
            $form->addButton(TF::BOLD . "Hero\n" . TF::RED . "Locked");
        }
        if(DataManager::getData($sender, "Permissions", "emporiumcore.gkit.cyborg")) {
            if(DataManager::getData($sender, "Cooldowns", "GKitCyborg") > 0) {
                $form->addButton(TF::BOLD . "Cyborg\n" . TF::RED . "On Cooldown");
            } else {
                $form->addButton(TF::BOLD . "Cyborg\n" . TF::GREEN . "Available");
            }
        } else {
            $form->addButton(TF::BOLD . "Cyborg\n" . TF::RED . "Locked");
        }
        if(DataManager::getData($sender, "Permissions", "emporiumcore.gkit.crucible")) {
            if(DataManager::getData($sender, "Cooldowns", "GKitCrucible") > 0) {
                $form->addButton(TF::BOLD . "Crucible\n" . TF::RED . "On Cooldown");
            } else {
                $form->addButton(TF::BOLD . "Crucible\n" . TF::GREEN . "Available");
            }
        } else {
            $form->addButton(TF::BOLD . "Crucible\n" . TF::RED . "Locked");
        }
        if(DataManager::getData($sender, "Permissions", "emporiumcore.gkit.hunter")) {
            if(DataManager::getData($sender, "Cooldowns", "GKitHunter") > 0) {
                $form->addButton(TF::BOLD . "Hunter\n" . TF::RED . "On Cooldown");
            } else {
                $form->addButton(TF::BOLD . "Hunter\n" . TF::GREEN . "Available");
            }
        } else {
            $form->addButton(TF::BOLD . "Hunter\n" . TF::RED . "Locked");
        }
        $form->addButton("§cEXIT");
        $sender->sendForm($form);
    }

    public function Inventory($sender): void {

        # create inventory
        $menu = InvMenu::create(InvMenuTypeIds::TYPE_CHEST);
        $menu->setName("GKits");
        # menu listener
        $menu->setListener(InvMenu::readonly(function(DeterministicInvMenuTransaction $transaction) use ($sender): void {

            # inventory variables
            $player = $transaction->getPlayer();
            $itemClicked = $transaction->getItemClicked();

            # heroic vulkarion
            if($itemClicked->getNamedTag()->getTag("HeroicVulkarion")) {
                if($player->getInventory()->canAddItem((new GKits)->heroicVulkarion(1))) {
                    $player->getInventory()->addItem((new GKits)->heroicVulkarion(1));
                    DataManager::setData($player, "Cooldowns", "GKitHeroicVulkarion", 259200); # 3 day cooldown
                    $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::DARK_RED . "Vulkarion Gkit");
                    $player->removeCurrentWindow();
                    self::Inventory($player);
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Inventory Full");
                }
            } elseif($itemClicked->getNamedTag()->getTag("LockedHeroicVulkarion")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
            }
            # cooldown
            if($itemClicked->getNamedTag()->getTag("HeroicVulkarionCooldown")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                $player->sendMessage(TF::BOLD . TF::RED . "That Kit is on Cooldown");
            }

            # heroic zenith
            if($itemClicked->getNamedTag()->getTag("HeroicZenith")) {
                if($player->getInventory()->canAddItem((new GKits)->heroicZenith(1))) {
                    $player->getInventory()->addItem((new GKits)->heroicZenith(1));
                    DataManager::setData($player, "Cooldowns", "GKitHeroicZenith", 259200); # 3 day cooldown
                    $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::GOLD . "Zenith Gkit");
                    $player->removeCurrentWindow();
                    self::Inventory($player);
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Inventory Full");
                }
            } elseif($itemClicked->getNamedTag()->getTag("LockedHeroicZenith")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
            }
            # cooldown
            if($itemClicked->getNamedTag()->getTag("HeroicZenithCooldown")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                $player->sendMessage(TF::BOLD . TF::RED . "That Kit is on Cooldown");
            }

            # heroic colossus
            if($itemClicked->getNamedTag()->getTag("HeroicColossus")) {
                if($player->getInventory()->canAddItem((new GKits)->heroicColossus(1))) {
                    $player->getInventory()->addItem((new GKits)->heroicColossus(1));
                    DataManager::setData($player, "Cooldowns", "GKitHeroicColossus", 259200); # 3 day cooldown
                    $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::WHITE . "Colossus Gkit");
                    $player->removeCurrentWindow();
                    self::Inventory($player);
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Inventory Full");
                }
            } elseif($itemClicked->getNamedTag()->getTag("LockedHeroicColossus")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
            }
            # cooldown
            if($itemClicked->getNamedTag()->getTag("HeroicColossusCooldown")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                $player->sendMessage(TF::BOLD . TF::RED . "That Kit is on Cooldown");
            }

            # heroic warlock
            if($itemClicked->getNamedTag()->getTag("HeroicWarlock")) {
                if($player->getInventory()->canAddItem((new GKits)->heroicWarlock(1))) {
                    $player->getInventory()->addItem((new GKits)->heroicWarlock(1));
                    DataManager::setData($player, "Cooldowns", "GKitHeroicWarlock", 259200); # 3 day cooldown
                    $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::DARK_PURPLE . "Warlock Gkit");
                    $player->removeCurrentWindow();
                    self::Inventory($player);
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Inventory Full");
                }
            } elseif($itemClicked->getNamedTag()->getTag("LockedHeroicWarlock")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
            }
            # cooldown
            if($itemClicked->getNamedTag()->getTag("HeroicWarlockCooldown")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                $player->sendMessage(TF::BOLD . TF::RED . "That Kit is on Cooldown");
            }

            # heroic slaughter
            if($itemClicked->getNamedTag()->getTag("HeroicSlaughter")) {
                if($player->getInventory()->canAddItem((new GKits)->heroicSlaughter(1))) {
                    $player->getInventory()->addItem((new GKits)->heroicSlaughter(1));
                    DataManager::setData($player, "Cooldowns", "GKitHeroicSlaughter", 259200); # 3 day cooldown
                    $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::RED . "Slaughter Gkit");
                    $player->removeCurrentWindow();
                    self::Inventory($player);
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Inventory Full");
                }
            } elseif($itemClicked->getNamedTag()->getTag("LockedHeroicSlaughter")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
            }
            # cooldown
            if($itemClicked->getNamedTag()->getTag("HeroicSlaughterCooldown")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                $player->sendMessage(TF::BOLD . TF::RED . "That Kit is on Cooldown");
            }

            # heroic Enchanter
            if($itemClicked->getNamedTag()->getTag("HeroicEnchanter")) {
                if($player->getInventory()->canAddItem((new GKits)->heroicEnchanter(1))) {
                    $player->getInventory()->addItem((new GKits)->heroicEnchanter(1));
                    DataManager::setData($player, "Cooldowns", "GKitHeroicEnchanter", 259200); # 3 day cooldown
                    $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::AQUA . "Enchanter Gkit");
                    $player->removeCurrentWindow();
                    self::Inventory($player);
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Inventory Full");
                }
            } elseif($itemClicked->getNamedTag()->getTag("LockedHeroicEnchanter")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
            }
            # cooldown
            if($itemClicked->getNamedTag()->getTag("HeroicEnchanterCooldown")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                $player->sendMessage(TF::BOLD . TF::RED . "That Kit is on Cooldown");
            }

            # heroic atheos
            if($itemClicked->getNamedTag()->getTag("HeroicAtheos")) {
                if($player->getInventory()->canAddItem((new GKits)->heroicAtheos(1))) {
                    $player->getInventory()->addItem((new GKits)->heroicAtheos(1));
                    DataManager::setData($player, "Cooldowns", "GKitHeroicAtheos", 259200); # 3 day cooldown
                    $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::GRAY . "Atheos Gkit");
                    $player->removeCurrentWindow();
                    self::Inventory($player);
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Inventory Full");
                }
            } elseif($itemClicked->getNamedTag()->getTag("LockedHeroicAtheos")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
            }
            # cooldown
            if($itemClicked->getNamedTag()->getTag("HeroicAtheosCooldown")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                $player->sendMessage(TF::BOLD . TF::RED . "That Kit is on Cooldown");
            }

            # heroic iapetus
            if($itemClicked->getNamedTag()->getTag("HeroicIapetus")) {
                if($player->getInventory()->canAddItem((new GKits)->heroicIapetus(1))) {
                    $player->getInventory()->addItem((new GKits)->heroicIapetus(1));
                    DataManager::setData($player, "Cooldowns", "GKitHeroicIapetus", 259200); # 3 day cooldown
                    $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::BLUE . "Iapetus Gkit");
                    $player->removeCurrentWindow();
                    self::Inventory($player);
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Inventory Full");
                }
            } elseif($itemClicked->getNamedTag()->getTag("LockedHeroicIapetus")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
            }
            # cooldown
            if($itemClicked->getNamedTag()->getTag("HeroicIapetusCooldown")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                $player->sendMessage(TF::BOLD . TF::RED . "That Kit is on Cooldown");
            }

            # heroic broteas
            if($itemClicked->getNamedTag()->getTag("HeroicBroteas")) {
                if($player->getInventory()->canAddItem((new GKits)->heroicBroteas(1))) {
                    $player->getInventory()->addItem((new GKits)->heroicBroteas(1));
                    DataManager::setData($player, "Cooldowns", "GKitHeroicBroteas", 259200); # 3 day cooldown
                    $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::GREEN . "Broteas Gkit");
                    $player->removeCurrentWindow();
                    self::Inventory($player);
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Inventory Full");
                }
            } elseif($itemClicked->getNamedTag()->getTag("LockedHeroicBroteas")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
            }
            # cooldown
            if($itemClicked->getNamedTag()->getTag("HeroicBroteasCooldown")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                $player->sendMessage(TF::BOLD . TF::RED . "That Kit is on Cooldown");
            }

            # heroic ares
            if($itemClicked->getNamedTag()->getTag("HeroicAres")) {
                if($player->getInventory()->canAddItem((new GKits)->heroicAres(1))) {
                    $player->getInventory()->addItem((new GKits)->heroicAres(1));
                    DataManager::setData($player, "Cooldowns", "GKitHeroicAres", 259200); # 3 day cooldown
                    $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::GOLD . "Ares Gkit");
                    $player->removeCurrentWindow();
                    self::Inventory($player);
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Inventory Full");
                }
            } elseif($itemClicked->getNamedTag()->getTag("LockedHeroicAres")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
            }
            # cooldown
            if($itemClicked->getNamedTag()->getTag("HeroicAresCooldown")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                $player->sendMessage(TF::BOLD . TF::RED . "That Kit is on Cooldown");
            }

            # heroic grim reaper
            if($itemClicked->getNamedTag()->getTag("HeroicGrimReaper")) {
                if($player->getInventory()->canAddItem((new GKits)->heroicGrimReaper(1))) {
                    $player->getInventory()->addItem((new GKits)->heroicGrimReaper(1));
                    DataManager::setData($player, "Cooldowns", "GKitHeroicGrimReaper", 259200); # 3 day cooldown
                    $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::RED . "Grim Reaper Gkit");
                    $player->removeCurrentWindow();
                    self::Inventory($player);
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Inventory Full");
                }
            } elseif($itemClicked->getNamedTag()->getTag("LockedHeroicGrimReaper")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
            }
            # cooldown
            if($itemClicked->getNamedTag()->getTag("HeroicGrimReaperCooldown")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                $player->sendMessage(TF::BOLD . TF::RED . "That Kit is on Cooldown");
            }

            # heroic executioner
            if($itemClicked->getNamedTag()->getTag("HeroicExecutioner")) {
                if($player->getInventory()->canAddItem((new GKits)->heroicExecutioner(1))) {
                    $player->getInventory()->addItem((new GKits)->heroicExecutioner(1));
                    DataManager::setData($player, "Cooldowns", "GKitHeroicExecutioner", 259200); # 3 day cooldown
                    $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::DARK_RED . "Executioner Gkit");
                    $player->removeCurrentWindow();
                    self::Inventory($player);
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Inventory Full");
                }
            } elseif($itemClicked->getNamedTag()->getTag("LockedHeroicExecutioner")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
            }
            # cooldown
            if($itemClicked->getNamedTag()->getTag("HeroicExecutionerCooldown")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                $player->sendMessage(TF::BOLD . TF::RED . "That Kit is on Cooldown");
            }

            # blacksmith
            if($itemClicked->getNamedTag()->getTag("Blacksmith")) {
                if($player->getInventory()->canAddItem((new GKits)->Blacksmith(1))) {
                    $player->getInventory()->addItem((new GKits)->Blacksmith(1));
                    DataManager::setData($player, "Cooldowns", "GKitBlacksmith", 259200); # 3 day cooldown
                    $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::DARK_GRAY . "Blacksmith Gkit");
                    $player->removeCurrentWindow();
                    self::Inventory($player);
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Inventory Full");
                }
            } elseif($itemClicked->getNamedTag()->getTag("LockedBlacksmith")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
            }
            # cooldown
            if($itemClicked->getNamedTag()->getTag("BlacksmithCooldown")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                $player->sendMessage(TF::BOLD . TF::RED . "That Kit is on Cooldown");
            }

            # hero
            if($itemClicked->getNamedTag()->getTag("Hero")) {
                if($player->getInventory()->canAddItem((new GKits)->Hero(1))) {
                    $player->getInventory()->addItem((new GKits)->Hero(1));
                    DataManager::setData($player, "Cooldowns", "GKitHero", 259200); # 3 day cooldown
                    $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::WHITE . "Hero Gkit");
                    $player->removeCurrentWindow();
                    self::Inventory($player);
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Inventory Full");
                }
            } elseif($itemClicked->getNamedTag()->getTag("LockedHero")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
            }
            # cooldown
            if($itemClicked->getNamedTag()->getTag("HeroCooldown")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                $player->sendMessage(TF::BOLD . TF::RED . "That Kit is on Cooldown");
            }

            # cyborg
            if($itemClicked->getNamedTag()->getTag("Cyborg")) {
                if($player->getInventory()->canAddItem((new GKits)->Cyborg(1))) {
                    $player->getInventory()->addItem((new GKits)->Cyborg(1));
                    DataManager::setData($player, "Cooldowns", "GKitCyborg", 259200); # 3 day cooldown
                    $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::DARK_AQUA . "Cyborg Gkit");
                    $player->removeCurrentWindow();
                    self::Inventory($player);
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Inventory Full");
                }
            } elseif($itemClicked->getNamedTag()->getTag("LockedCyborg")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
            }
            # cooldown
            if($itemClicked->getNamedTag()->getTag("CyborgCooldown")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                $player->sendMessage(TF::BOLD . TF::RED . "That Kit is on Cooldown");
            }

            # crucible
            if($itemClicked->getNamedTag()->getTag("Crucible")) {
                if($player->getInventory()->canAddItem((new GKits)->Crucible(1))) {
                    $player->getInventory()->addItem((new GKits)->Crucible(1));
                    DataManager::setData($player, "Cooldowns", "GKitCrucible", 259200); # 3 day cooldown
                    $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::YELLOW . "Crucible Gkit");
                    $player->removeCurrentWindow();
                    self::Inventory($player);
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Inventory Full");
                }
            } elseif($itemClicked->getNamedTag()->getTag("LockedCrucible")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
            }
            # cooldown
            if($itemClicked->getNamedTag()->getTag("CrucibleCooldown")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                $player->sendMessage(TF::BOLD . TF::RED . "That Kit is on Cooldown");
            }

            # hunter
            if($itemClicked->getNamedTag()->getTag("Hunter")) {
                if($player->getInventory()->canAddItem((new GKits)->Hunter(1))) {
                    $player->getInventory()->addItem((new GKits)->Hunter(1));
                    DataManager::setData($player, "Cooldowns", "GKitHunter", 259200); # 3 day cooldown
                    $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::AQUA . "Hunter Gkit");
                    $player->removeCurrentWindow();
                    self::Inventory($player);
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Inventory Full");
                }
            } elseif($itemClicked->getNamedTag()->getTag("LockedHunter")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
            }
            # cooldown
            if($itemClicked->getNamedTag()->getTag("HunterCooldown")) {
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                $player->sendMessage(TF::BOLD . TF::RED . "That Kit is on Cooldown");
            }

        }));

        # inventory
        $inventory = $menu->getInventory();
        # add items
        $inventory->setItem(0, $this->heroicVulkarionItem($sender));
        $inventory->setItem(1, $this->heroicZenithItem($sender));
        $inventory->setItem(2, $this->heroicColossusItem($sender));
        $inventory->setItem(3, $this->heroicWarlockItem($sender));
        $inventory->setItem(4, $this->HeroicSlaughterItem($sender));
        $inventory->setItem(5, $this->heroicEnchanterItem($sender));
        $inventory->setItem(6, $this->heroicAtheosItem($sender));
        $inventory->setItem(7, $this->heroicIapetusItem($sender));
        $inventory->setItem(8, $this->heroicBroteasItem($sender));
        $inventory->setItem(9, $this->heroicAresItem($sender));
        $inventory->setItem(10, $this->heroicGrimReaperItem($sender));
        $inventory->setItem(11, $this->heroicExecutionerItem($sender));
        $inventory->setItem(12, $this->blacksmithItem($sender));
        $inventory->setItem(13, $this->heroItem($sender));
        $inventory->setItem(14, $this->CyborgItem($sender));
        $inventory->setItem(15, $this->crucibleItem($sender));
        $inventory->setItem(16, $this->hunterItem($sender));
        # send inventory
        $menu->send($sender);
    }

    # heroic vulkarion
    public function heroicVulkarionItem($sender): Item {

        $heroicVulkarionCooldown = DataManager::getData($sender, "Cooldowns", "GKitHeroicVulkarion");
        $permission = DataManager::getData($sender, "Permissions", "emporiumcore.gkit.heroicvulkarion");

        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::BOLD . TF::DARK_RED . "Heroic Vulkarion " . TF::RESET . TF::DARK_RED . "GKit");

        if($permission) {
            if($heroicVulkarionCooldown > 0) {
                # kit on cooldown
                $lore = [
                    "§r",
                    TF::BOLD . TF::RED . "ON COOLDOWN " . Translator::timeConvert($heroicVulkarionCooldown)
                ];
                $item->getNamedTag()->setString("HeroicVulkarionCooldown", 1);
            } else {
                # kit available
                $lore = [
                    "§r",
                    TF::BOLD . TF::GREEN . "AVAILABLE NOW " . TF::GRAY . "(Click)"
                ];
                $item->getNamedTag()->setString("HeroicVulkarion", 1);
            }
        } else {
            # kit locked
            $lore = [
                "§r",
                TF::BOLD . TF::RED . "LOCKED "
            ];
            $item->getNamedTag()->setString("LockedHeroicVulkarion", 1);
        }
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    # heroic zenith
    public function heroicZenithItem($sender): Item {

        $heroicZenithCooldown = DataManager::getData($sender, "Cooldowns", "GKitHeroicZenith");
        $permission = DataManager::getData($sender, "Permissions", "emporiumcore.gkit.heroiczenith");

        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::BOLD . TF::GOLD . "Heroic Zenith " . TF::RESET . TF::GOLD . "GKit");
        if($permission) {
            if($heroicZenithCooldown > 0) {
                # kit on cooldown
                $lore = [
                    "§r",
                    TF::BOLD . TF::RED . "ON COOLDOWN " . Translator::timeConvert($heroicZenithCooldown)
                ];
                $item->getNamedTag()->setString("HeroicZenithCooldown", 1);
            } else {
                # kit available
                $lore = [
                    "§r",
                    TF::BOLD . TF::GREEN . "AVAILABLE NOW " . TF::GRAY . "(Click)"
                ];
                $item->getNamedTag()->setString("HeroicZenith", 1);
            }
        } else {
            # kit locked
            $lore = [
                "§r",
                TF::BOLD . TF::RED . "LOCKED "
            ];
            $item->getNamedTag()->setString("LockedHeroicZenith", 1);
        }
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    # heroic colossus
    public function heroicColossusItem($sender): Item {

        $heroicColossusCooldown = DataManager::getData($sender, "Cooldowns", "GKitHeroicColossus");
        $permission = DataManager::getData($sender, "Permissions", "emporiumcore.gkit.heroiccolossus");

        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::BOLD . TF::WHITE . "Heroic Colossus " . TF::RESET . TF::WHITE . "GKit");

        if($permission) {
            if($heroicColossusCooldown > 0) {
                # kit on cooldown
                $lore = [
                    "§r",
                    TF::BOLD . TF::RED . "ON COOLDOWN " . Translator::timeConvert($heroicColossusCooldown)
                ];
                $item->getNamedTag()->setString("HeroicColossusCooldown", 1);
            } else {
                # kit available
                $lore = [
                    "§r",
                    TF::BOLD . TF::GREEN . "AVAILABLE NOW " . TF::GRAY . "(Click)"
                ];
                $item->getNamedTag()->setString("HeroicColossus", 1);
            }
        } else {
            # kit locked
            $lore = [
                "§r",
                TF::BOLD . TF::RED . "LOCKED "
            ];
            $item->getNamedTag()->setString("LockedHeroicColossus", 1);
        }
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    # heroic warlock
    public function heroicWarlockItem($sender): Item {

        $heroicWarlockCooldown = DataManager::getData($sender, "Cooldowns", "GKitHeroicWarlock");
        $permission = DataManager::getData($sender, "Permissions", "emporiumcore.gkit.heroicwarlock");

        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::BOLD . TF::DARK_PURPLE . "Heroic Warlock " . TF::RESET . TF::DARK_PURPLE . "GKit");
        if($permission) {
            if($heroicWarlockCooldown > 0) {
                # kit on cooldown
                $lore = [
                    "§r",
                    TF::BOLD . TF::RED . "ON COOLDOWN " . Translator::timeConvert($heroicWarlockCooldown)
                ];
                $item->getNamedTag()->setString("HeroicWarlockCooldown", 1);
            } else {
                # kit available
                $lore = [
                    "§r",
                    TF::BOLD . TF::GREEN . "AVAILABLE NOW " . TF::GRAY . "(Click)"
                ];
                $item->getNamedTag()->setString("HeroicWarlock", 1);
            }
        } else {
            # kit locked
            $lore = [
                "§r",
                TF::BOLD . TF::RED . "LOCKED "
            ];
            $item->getNamedTag()->setString("LockedHeroicWarlock", 1);
        }
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    # heroic slaughter
    public function heroicSlaughterItem($sender): Item {

        $heroicSlaughterCooldown = DataManager::getData($sender, "Cooldowns", "GKitHeroicSlaughter");
        $permission = DataManager::getData($sender, "Permissions", "emporiumcore.gkit.heroicslaughter");

        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::BOLD . TF::RED . "Heroic Slaughter " . TF::RESET . TF::RED . "GKit");

        if($permission) {
            if($heroicSlaughterCooldown > 0) {
                # kit on cooldown
                $lore = [
                    "§r",
                    TF::BOLD . TF::RED . "ON COOLDOWN " . Translator::timeConvert($heroicSlaughterCooldown)
                ];
                $item->getNamedTag()->setString("HeroicSlaughterCooldown", 1);
            } else {
                # kit available
                $lore = [
                    "§r",
                    TF::BOLD . TF::GREEN . "AVAILABLE NOW " . TF::GRAY . "(Click)"
                ];
                $item->getNamedTag()->setString("HeroicSlaughter", 1);
            }
        } else {
            # kit locked
            $lore = [
                "§r",
                TF::BOLD . TF::RED . "LOCKED "
            ];
            $item->getNamedTag()->setString("LockedHeroicSlaughter", 1);
        }
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    # heroic enchanter
    public function heroicEnchanterItem($sender): Item {

        $heroicEnchanterCooldown = DataManager::getData($sender, "Cooldowns", "GKitHeroicEnchanter");
        $permission = DataManager::getData($sender, "Permissions", "emporiumcore.gkit.heroicenchanter");

        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::BOLD . TF::AQUA . "Heroic Enchanter " . TF::RESET . TF::AQUA . "GKit");

        if($permission) {
            if($heroicEnchanterCooldown > 0) {
                # kit on cooldown
                $lore = [
                    "§r",
                    TF::BOLD . TF::RED . "ON COOLDOWN " . Translator::timeConvert($heroicEnchanterCooldown)
                ];
                $item->getNamedTag()->setString("HeroicEnchanterCooldown", 1);
            } else {
                # kit available
                $lore = [
                    "§r",
                    TF::BOLD . TF::GREEN . "AVAILABLE NOW " . TF::GRAY . "(Click)"
                ];
                $item->getNamedTag()->setString("HeroicEnchanter", 1);
            }
        } else {
            # kit locked
            $lore = [
                "§r",
                TF::BOLD . TF::RED . "LOCKED "
            ];
            $item->getNamedTag()->setString("LockedHeroicEnchanter", 1);
        }
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    # heroic atheos
    public function heroicAtheosItem($sender): Item {

        $heroicAtheosCooldown = DataManager::getData($sender, "Cooldowns", "GKitHeroicAtheos");
        $permission = DataManager::getData($sender, "Permissions", "emporiumcore.gkit.heroicatheos");

        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::BOLD . TF::GRAY . "Heroic Atheos " . TF::RESET . TF::GRAY . "GKit");

        if($permission) {
            if($heroicAtheosCooldown > 0) {
                # kit on cooldown
                $lore = [
                    "§r",
                    TF::BOLD . TF::RED . "ON COOLDOWN " . Translator::timeConvert($heroicAtheosCooldown)
                ];
                $item->getNamedTag()->setString("HeroicAtheosCooldown", 1);
            } else {
                # kit available
                $lore = [
                    "§r",
                    TF::BOLD . TF::GREEN . "AVAILABLE NOW " . TF::GRAY . "(Click)"
                ];
                $item->getNamedTag()->setString("HeroicAtheos", 1);
            }
        } else {
            # kit locked
            $lore = [
                "§r",
                TF::BOLD . TF::RED . "LOCKED "
            ];
            $item->getNamedTag()->setString("LockedHeroicAtheos", 1);
        }
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    # heroic iapetus
    public function heroicIapetusItem($sender): Item {

        $heroicIapetusCooldown = DataManager::getData($sender, "Cooldowns", "GKitHeroicIapetus");
        $permission = DataManager::getData($sender, "Permissions", "emporiumcore.gkit.heroiciapetus");

        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::BOLD . TF::BLUE . "Heroic Iapetus " . TF::RESET . TF::BLUE . "GKit");

        if($permission) {
            if($heroicIapetusCooldown > 0) {
                # kit on cooldown
                $lore = [
                    "§r",
                    TF::BOLD . TF::RED . "ON COOLDOWN " . Translator::timeConvert($heroicIapetusCooldown)
                ];
                $item->getNamedTag()->setString("HeroicIapetusCooldown", 1);
            } else {
                # kit available
                $lore = [
                    "§r",
                    TF::BOLD . TF::GREEN . "AVAILABLE NOW " . TF::GRAY . "(Click)"
                ];
                $item->getNamedTag()->setString("HeroicIapetus", 1);
            }
        } else {
            # kit locked
            $lore = [
                "§r",
                TF::BOLD . TF::RED . "LOCKED "
            ];
            $item->getNamedTag()->setString("LockedHeroicIapetus", 1);
        }
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    # heroic broteas
    public function heroicBroteasItem($sender): Item {

        $heroicBroteasCooldown = DataManager::getData($sender, "Cooldowns", "GKitHeroicBroteas");
        $permission = DataManager::getData($sender, "Permissions", "emporiumcore.gkit.heroicbroteas");

        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::BOLD . TF::GREEN . "Heroic Broteas " . TF::RESET . TF::GREEN . "GKit");

        if($permission) {
            if($heroicBroteasCooldown > 0) {
                # kit on cooldown
                $lore = [
                    "§r",
                    TF::BOLD . TF::RED . "ON COOLDOWN " . Translator::timeConvert($heroicBroteasCooldown)
                ];
                $item->getNamedTag()->setString("HeroicBroteasCooldown", 1);
            } else {
                # kit available
                $lore = [
                    "§r",
                    TF::BOLD . TF::GREEN . "AVAILABLE NOW " . TF::GRAY . "(Click)"
                ];
                $item->getNamedTag()->setString("HeroicBroteas", 1);
            }
        } else {
            # kit locked
            $lore = [
                "§r",
                TF::BOLD . TF::RED . "LOCKED "
            ];
            $item->getNamedTag()->setString("LockedHeroicBroteas", 1);
        }
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    # heroic ares
    public function heroicAresItem($sender): Item {

        $heroicAresCooldown = DataManager::getData($sender, "Cooldowns", "GKitHeroicAres");
        $permission = DataManager::getData($sender, "Permissions", "emporiumcore.gkit.heroicares");

        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::BOLD . TF::GOLD . "Heroic Ares " . TF::RESET . TF::GOLD . "GKit");

        if($permission) {
            if($heroicAresCooldown > 0) {
                # kit on cooldown
                $lore = [
                    "§r",
                    TF::BOLD . TF::RED . "ON COOLDOWN " . Translator::timeConvert($heroicAresCooldown)
                ];
                $item->getNamedTag()->setString("HeroicAresCooldown", 1);
            } else {
                # kit available
                $lore = [
                    "§r",
                    TF::BOLD . TF::GREEN . "AVAILABLE NOW " . TF::GRAY . "(Click)"
                ];
                $item->getNamedTag()->setString("HeroicAres", 1);
            }
        } else {
            # kit locked
            $lore = [
                "§r",
                TF::BOLD . TF::RED . "LOCKED "
            ];
            $item->getNamedTag()->setString("LockedHeroicAres", 1);
        }
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    # heroic grim reaper
    public function heroicGrimReaperItem($sender): Item {

        $heroicGrimReaperCooldown = DataManager::getData($sender, "Cooldowns", "GKitHeroicGrimReaper");
        $permission = DataManager::getData($sender, "Permissions", "emporiumcore.gkit.heroicgrimreaper");

        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::BOLD . TF::RED . "Heroic Grim Reaper " . TF::RESET . TF::RED . "GKit");

        if($permission) {
            if($heroicGrimReaperCooldown > 0) {
                # kit on cooldown
                $lore = [
                    "§r",
                    TF::BOLD . TF::RED . "ON COOLDOWN " . Translator::timeConvert($heroicGrimReaperCooldown)
                ];
                $item->getNamedTag()->setString("HeroicGrimReaperCooldown", 1);
            } else {
                # kit available
                $lore = [
                    "§r",
                    TF::BOLD . TF::GREEN . "AVAILABLE NOW " . TF::GRAY . "(Click)"
                ];
                $item->getNamedTag()->setString("HeroicGrimReaper", 1);
            }
        } else {
            # kit locked
            $lore = [
                "§r",
                TF::BOLD . TF::RED . "LOCKED "
            ];
            $item->getNamedTag()->setString("LockedHeroicGrimReaper", 1);
        }
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    # heroic executioner
    public function heroicExecutionerItem($sender): Item {

        $heroicExecutionerCooldown = DataManager::getData($sender, "Cooldowns", "GKitHeroicExecutioner");
        $permission = DataManager::getData($sender, "Permissions", "emporiumcore.gkit.heroicexecutioner");

        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::BOLD . TF::DARK_RED . "Heroic Executioner " . TF::RESET . TF::DARK_RED . "GKit");

        if($permission) {
            if($heroicExecutionerCooldown > 0) {
                # kit on cooldown
                $lore = [
                    "§r",
                    TF::BOLD . TF::RED . "ON COOLDOWN " . Translator::timeConvert($heroicExecutionerCooldown)
                ];
                $item->getNamedTag()->setString("HeroicExecutionerCooldown", 1);
            } else {
                # kit available
                $lore = [
                    "§r",
                    TF::BOLD . TF::GREEN . "AVAILABLE NOW " . TF::GRAY . "(Click)"
                ];
                $item->getNamedTag()->setString("HeroicExecutioner", 1);
            }
        } else {
            # kit locked
            $lore = [
                "§r",
                TF::BOLD . TF::RED . "LOCKED "
            ];
            $item->getNamedTag()->setString("LockedHeroicExecutioner", 1);
        }
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    # blacksmith
    public function blacksmithItem($sender): Item {

        $blacksmithCooldown = DataManager::getData($sender, "Cooldowns", "GKitBlacksmith");
        $permission = DataManager::getData($sender, "Permissions", "emporiumcore.gkit.blacksmith");

        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::BOLD . TF::DARK_GRAY . "Blacksmith " . TF::RESET . TF::DARK_GRAY . "GKit");

        if($permission) {
            if($blacksmithCooldown > 0) {
                # kit on cooldown
                $lore = [
                    "§r",
                    TF::BOLD . TF::RED . "ON COOLDOWN " . Translator::timeConvert($blacksmithCooldown)
                ];
                $item->getNamedTag()->setString("BlacksmithCooldown", 1);
            } else {
                # kit available
                $lore = [
                    "§r",
                    TF::BOLD . TF::GREEN . "AVAILABLE NOW " . TF::GRAY . "(Click)"
                ];
                $item->getNamedTag()->setString("Blacksmith", 1);
            }
        } else {
            # kit locked
            $lore = [
                "§r",
                TF::BOLD . TF::RED . "LOCKED "
            ];
            $item->getNamedTag()->setString("LockedBlacksmith", 1);
        }
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    # hero
    public function heroItem($sender): Item {

        $heroCooldown = DataManager::getData($sender, "Cooldowns", "GKitHero");
        $permission = DataManager::getData($sender, "Permissions", "emporiumcore.gkit.hero");

        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::BOLD . TF::WHITE . "Hero " . TF::RESET . TF::WHITE . "GKit");

        if($permission) {
            if($heroCooldown > 0) {
                # kit on cooldown
                $lore = [
                    "§r",
                    TF::BOLD . TF::RED . "ON COOLDOWN " . Translator::timeConvert($heroCooldown)
                ];
                $item->getNamedTag()->setString("HeroCooldown", 1);
            } else {
                # kit available
                $lore = [
                    "§r",
                    TF::BOLD . TF::GREEN . "AVAILABLE NOW " . TF::GRAY . "(Click)"
                ];
                $item->getNamedTag()->setString("Hero", 1);
            }
        } else {
            # kit locked
            $lore = [
                "§r",
                TF::BOLD . TF::RED . "LOCKED "
            ];
            $item->getNamedTag()->setString("LockedHero", 1);
        }
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    # cyborg
    public function cyborgItem($sender): Item {

        $cyborgCooldown = DataManager::getData($sender, "Cooldowns", "GKitCyborg");
        $permission = DataManager::getData($sender, "Permissions", "emporiumcore.gkit.hero");

        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::BOLD . TF::DARK_AQUA . "Cyborg " . TF::RESET . TF::DARK_AQUA . "GKit");

        if($permission) {
            if($cyborgCooldown > 0) {
                # kit on cooldown
                $lore = [
                    "§r",
                    TF::BOLD . TF::RED . "ON COOLDOWN " . Translator::timeConvert($cyborgCooldown)
                ];
                $item->getNamedTag()->setString("CyborgCooldown", 1);
            } else {
                # kit available
                $lore = [
                    "§r",
                    TF::BOLD . TF::GREEN . "AVAILABLE NOW " . TF::GRAY . "(Click)"
                ];
                $item->getNamedTag()->setString("Cyborg", 1);
            }
        } else {
            # kit locked
            $lore = [
                "§r",
                TF::BOLD . TF::RED . "LOCKED "
            ];
            $item->getNamedTag()->setString("LockedCyborg", 1);
        }
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    # crucible
    public function crucibleItem($sender): Item {

        $crucibleCooldown = DataManager::getData($sender, "Cooldowns", "GKitCrucible");
        $permission = DataManager::getData($sender, "Permissions", "emporiumcore.gkit.crucible");

        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::BOLD . TF::YELLOW . "Crucible " . TF::RESET . TF::YELLOW . "GKit");

        if($permission) {
            if($crucibleCooldown > 0) {
                # kit on cooldown
                $lore = [
                    "§r",
                    TF::BOLD . TF::RED . "ON COOLDOWN " . Translator::timeConvert($crucibleCooldown)
                ];
                $item->getNamedTag()->setString("CrucibleCooldown", 1);
            } else {
                # kit available
                $lore = [
                    "§r",
                    TF::BOLD . TF::GREEN . "AVAILABLE NOW " . TF::GRAY . "(Click)"
                ];
                $item->getNamedTag()->setString("Crucible", 1);
            }
        } else {
            # kit locked
            $lore = [
                "§r",
                TF::BOLD . TF::RED . "LOCKED "
            ];
            $item->getNamedTag()->setString("LockedCrucible", 1);
        }
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    # hunter
    public function hunterItem($sender): Item {

        $hunterCooldown = DataManager::getData($sender, "Cooldowns", "GKitHunter");
        $permission = DataManager::getData($sender, "Permissions", "emporiumcore.gkit.hunter");

        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::BOLD . TF::AQUA . "Hunter " . TF::RESET . TF::AQUA . "GKit");

        if($permission) {
            if($hunterCooldown > 0) {
                # kit on cooldown
                $lore = [
                    "§r",
                    TF::BOLD . TF::RED . "ON COOLDOWN " . Translator::timeConvert($hunterCooldown)
                ];
                $item->getNamedTag()->setString("HunterCooldown", 1);
            } else {
                # kit available
                $lore = [
                    "§r",
                    TF::BOLD . TF::GREEN . "AVAILABLE NOW " . TF::GRAY . "(Click)"
                ];
                $item->getNamedTag()->setString("Hunter", 1);
            }
        } else {
            # kit locked
            $lore = [
                "§r",
                TF::BOLD . TF::RED . "LOCKED "
            ];
            $item->getNamedTag()->setString("LockedHunter", 1);
        }
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }
}