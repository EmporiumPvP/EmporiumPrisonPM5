<?php

namespace EmporiumCore\Menus;

use Emporium\Prison\EmporiumPrison;
use Emporium\Prison\library\formapi\SimpleForm;

use EmporiumData\DataManager;

use muqsit\invmenu\InvMenu;
use muqsit\invmenu\transaction\DeterministicInvMenuTransaction;
use muqsit\invmenu\type\InvMenuTypeIds;

use pocketmine\item\Item;
use pocketmine\item\ItemIds;
use pocketmine\item\VanillaItems;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;
use pocketmine\world\sound\ItemFrameAddItemSound;
use pocketmine\world\sound\XpCollectSound;

class Blacksmith extends Menu {

    public function Form(Player $player): void {
        $form = new SimpleForm(function(Player $player, $data) {
            if($data === null) {
                return;
            } else {
                $playerMoney = DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.money");
                switch($data) {
                    # bow
                    case 0:
                        if($playerMoney >= 5000) {
                            if($player->getInventory()->canAddItem(VanillaItems::BOW())) {
                                $player->sendMessage(TF::RED . "- $5,000");
                                $player->getInventory()->addItem(VanillaItems::BOW());
                                $player->broadcastSound(new XpCollectSound(), [$player]);
                                DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 5000);
                            } else {
                                $player->sendMessage(TF::RED . "Your inventory is full");
                            }
                        } else {
                            $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                            $player->sendMessage(TF::RED . "Insufficient funds");
                        }
                        break;
                    # arrow
                    case 1:
                        if($playerMoney >= 100) {
                            if($player->getInventory()->canAddItem(VanillaItems::ARROW())) {
                                $player->sendMessage(TF::RED . "- $100");
                                $player->getInventory()->addItem(VanillaItems::ARROW());
                                $player->broadcastSound(new XpCollectSound(), [$player]);
                                DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 100);
                            } else {
                                $player->sendMessage(TF::RED . "Your inventory is full");
                            }
                        } else {
                            $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                            $player->sendMessage(TF::RED . "Insufficient funds");
                        }
                        break;
                    # wooden pickaxe
                    case 2:
                        if($playerMoney >= 20) {
                            if($player->getInventory()->canAddItem((EmporiumPrison::getInstance()->getPickaxes())->Trainee())) {
                                $player->sendMessage(TF::RED . "- $20");
                                $player->getInventory()->addItem((EmporiumPrison::getInstance()->getPickaxes())->Trainee());
                                $player->broadcastSound(new XpCollectSound(), [$player]);
                                DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 20);
                            } else {
                                $player->sendMessage(TF::RED . "Your inventory is full");
                            }
                        } else {
                            $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                            $player->sendMessage(TF::RED . "Insufficient funds");
                        }
                        break;
                    # wooden sword
                    case 3:
                        if($playerMoney >= 100) {
                            if($player->getInventory()->canAddItem(VanillaItems::WOODEN_SWORD())) {
                                $player->sendMessage(TF::RED . "- $100");
                                $player->getInventory()->addItem(VanillaItems::WOODEN_SWORD());
                                $player->broadcastSound(new XpCollectSound(), [$player]);
                                DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 100);
                            } else {
                                $player->sendMessage(TF::RED . "Your inventory is full");
                            }
                        } else {
                            $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                            $player->sendMessage(TF::RED . "Insufficient funds");
                        }
                        break;
                    # wooden axe
                    case 4:
                        if($playerMoney >= 100) {
                            if($player->getInventory()->canAddItem(VanillaItems::WOODEN_AXE())) {
                                $player->sendMessage(TF::RED . "- $100");
                                $player->getInventory()->addItem(VanillaItems::WOODEN_AXE());
                                $player->broadcastSound(new XpCollectSound(), [$player]);
                                DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 100);
                            } else {
                                $player->sendMessage(TF::RED . "Your inventory is full");
                            }
                        } else {
                            $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                            $player->sendMessage(TF::RED . "Insufficient funds");
                        }
                        break;

                    # chain helmet
                    case 5:
                        if($playerMoney >= 100) {
                            if($player->getInventory()->canAddItem(VanillaItems::CHAINMAIL_HELMET())) {
                                $player->sendMessage(TF::RED . "- $100");
                                $player->getInventory()->addItem(VanillaItems::CHAINMAIL_HELMET());
                                $player->broadcastSound(new XpCollectSound(), [$player]);
                                DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 100);
                            } else {
                                $player->sendMessage(TF::RED . "Your inventory is full");
                            }
                        } else {
                            $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                            $player->sendMessage(TF::RED . "Insufficient funds");
                        }
                        break;
                    # chain chestplate
                    case 6:
                        if($playerMoney >= 100) {
                            if($player->getInventory()->canAddItem(VanillaItems::CHAINMAIL_CHESTPLATE())) {
                                $player->sendMessage(TF::RED . "- $100");
                                $player->getInventory()->addItem(VanillaItems::CHAINMAIL_CHESTPLATE());
                                $player->broadcastSound(new XpCollectSound(), [$player]);
                                DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 100);
                            } else {
                                $player->sendMessage(TF::RED . "Your inventory is full");
                            }
                        } else {
                            $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                            $player->sendMessage(TF::RED . "Insufficient funds");
                        }
                        break;
                    # chain leggings
                    case 7:
                        if($playerMoney >= 100) {
                            if($player->getInventory()->canAddItem(VanillaItems::CHAINMAIL_LEGGINGS())) {
                                $player->sendMessage(TF::RED . "- $100");
                                $player->getInventory()->addItem(VanillaItems::CHAINMAIL_LEGGINGS());
                                $player->broadcastSound(new XpCollectSound(), [$player]);
                                DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 100);
                            } else {
                                $player->sendMessage(TF::RED . "Your inventory is full");
                            }
                        } else {
                            $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                            $player->sendMessage(TF::RED . "Insufficient funds");
                        }
                        break;
                    # chain boots
                    case 8:
                        if($playerMoney >= 100) {
                            if($player->getInventory()->canAddItem(VanillaItems::CHAINMAIL_BOOTS())) {
                                $player->sendMessage(TF::RED . "- $100");
                                $player->getInventory()->addItem(VanillaItems::CHAINMAIL_BOOTS());
                                $player->broadcastSound(new XpCollectSound(), [$player]);
                                DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 100);
                            } else {
                                $player->sendMessage(TF::RED . "Your inventory is full");
                            }
                        } else {
                            $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                            $player->sendMessage(TF::RED . "Insufficient funds");
                        }
                        break;
                    # stone pickaxe
                    case 9:
                        if($playerMoney >= 200) {
                            if($player->getInventory()->canAddItem((EmporiumPrison::getInstance()->getPickaxes())->Stone())) {
                                $player->sendMessage(TF::RED . "- $200");
                                $player->getInventory()->addItem((EmporiumPrison::getInstance()->getPickaxes())->Stone());
                                $player->broadcastSound(new XpCollectSound(), [$player]);
                                DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 200);
                            } else {
                                $player->sendMessage(TF::RED . "Your inventory is full");
                            }
                        } else {
                            $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                            $player->sendMessage(TF::RED . "Insufficient funds");
                        }
                        break;
                    # stone sword
                    case 10:
                        if($playerMoney >= 500) {
                            if($player->getInventory()->canAddItem(VanillaItems::STONE_SWORD())) {
                                $player->sendMessage(TF::RED . "- $500");
                                $player->getInventory()->addItem(VanillaItems::STONE_SWORD());
                                $player->broadcastSound(new XpCollectSound(), [$player]);
                                DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 500);
                            } else {
                                $player->sendMessage(TF::RED . "Your inventory is full");
                            }
                        } else {
                            $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                            $player->sendMessage(TF::RED . "Insufficient funds");
                        }
                        break;
                    # stone axe
                    case 11:
                        if($playerMoney >= 500) {
                            if($player->getInventory()->canAddItem(VanillaItems::STONE_AXE())) {
                                $player->sendMessage(TF::RED . "- $500");
                                $player->getInventory()->addItem(VanillaItems::STONE_AXE());
                                $player->broadcastSound(new XpCollectSound(), [$player]);
                                DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 500);
                            } else {
                                $player->sendMessage(TF::RED . "Your inventory is full");
                            }
                        } else {
                            $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                            $player->sendMessage(TF::RED . "Insufficient funds");
                        }
                        break;

                    # gold helmet
                    case 12:
                        if($playerMoney >= 1000) {
                            if($player->getInventory()->canAddItem(VanillaItems::GOLDEN_HELMET())) {
                                $player->sendMessage(TF::RED . "- $1,000");
                                $player->getInventory()->addItem(VanillaItems::GOLDEN_HELMET());
                                $player->broadcastSound(new XpCollectSound(), [$player]);
                                DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 1000);
                            } else {
                                $player->sendMessage(TF::RED . "Your inventory is full");
                            }
                        } else {
                            $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                            $player->sendMessage(TF::RED . "Insufficient funds");
                        }
                        break;
                    # gold chestplate
                    case 13:
                        if($playerMoney >= 1000) {
                            if($player->getInventory()->canAddItem(VanillaItems::GOLDEN_CHESTPLATE())) {
                                $player->sendMessage(TF::RED . "- $1,000");
                                $player->getInventory()->addItem(VanillaItems::GOLDEN_CHESTPLATE());
                                $player->broadcastSound(new XpCollectSound(), [$player]);
                                DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 1000);
                            } else {
                                $player->sendMessage(TF::RED . "Your inventory is full");
                            }
                        } else {
                            $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                            $player->sendMessage(TF::RED . "Insufficient funds");
                        }
                        break;
                    # gold leggings
                    case 14:
                        if($playerMoney >= 100) {
                            if($player->getInventory()->canAddItem(VanillaItems::GOLDEN_LEGGINGS())) {
                                $player->sendMessage(TF::RED . "- $1,000");
                                $player->getInventory()->addItem(VanillaItems::GOLDEN_LEGGINGS());
                                $player->broadcastSound(new XpCollectSound(), [$player]);
                                DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 1000);
                            } else {
                                $player->sendMessage(TF::RED . "Your inventory is full");
                            }
                        } else {
                            $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                            $player->sendMessage(TF::RED . "Insufficient funds");
                        }
                        break;
                    # gold boots
                    case 15:
                        if($playerMoney >= 1000) {
                            if($player->getInventory()->canAddItem(VanillaItems::GOLDEN_BOOTS())) {
                                $player->sendMessage(TF::RED . "- $1,000");
                                $player->getInventory()->addItem(VanillaItems::GOLDEN_BOOTS());
                                $player->broadcastSound(new XpCollectSound(), [$player]);
                                DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 1000);
                            } else {
                                $player->sendMessage(TF::RED . "Your inventory is full");
                            }
                        } else {
                            $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                            $player->sendMessage(TF::RED . "Insufficient funds");
                        }
                        break;
                    # gold pickaxe
                    case 16:
                        if($playerMoney >= 2000) {
                            if($player->getInventory()->canAddItem((EmporiumPrison::getInstance()->getPickaxes())->Gold())) {
                                $player->sendMessage(TF::RED . "- $2,000");
                                $player->getInventory()->addItem((EmporiumPrison::getInstance()->getPickaxes())->Gold());
                                $player->broadcastSound(new XpCollectSound(), [$player]);
                                DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 2000);
                            } else {
                                $player->sendMessage(TF::RED . "Your inventory is full");
                            }
                        } else {
                            $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                            $player->sendMessage(TF::RED . "Insufficient funds");
                        }
                        break;
                    # gold sword
                    case 17:
                        if($playerMoney >= 2000) {
                            if($player->getInventory()->canAddItem(VanillaItems::GOLDEN_SWORD())) {
                                $player->sendMessage(TF::RED . "- $2,000");
                                $player->getInventory()->addItem(VanillaItems::STONE_SWORD());
                                $player->broadcastSound(new XpCollectSound(), [$player]);
                                DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 2000);
                            } else {
                                $player->sendMessage(TF::RED . "Your inventory is full");
                            }
                        } else {
                            $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                            $player->sendMessage(TF::RED . "Insufficient funds");
                        }
                        break;
                    # gold axe
                    case 18:
                        if($playerMoney >= 2000) {
                            if($player->getInventory()->canAddItem(VanillaItems::GOLDEN_AXE())) {
                                $player->sendMessage(TF::RED . "- $2,000");
                                $player->getInventory()->addItem(VanillaItems::GOLDEN_AXE());
                                $player->broadcastSound(new XpCollectSound(), [$player]);
                                DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 2000);
                            } else {
                                $player->sendMessage(TF::RED . "Your inventory is full");
                            }
                        } else {
                            $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                            $player->sendMessage(TF::RED . "Insufficient funds");
                        }
                        break;

                    # iron helmet
                    case 19:
                        if($playerMoney >= 100000) {
                            if($player->getInventory()->canAddItem(VanillaItems::IRON_HELMET())) {
                                $player->sendMessage(TF::RED . "- $100,000");
                                $player->getInventory()->addItem(VanillaItems::IRON_HELMET());
                                $player->broadcastSound(new XpCollectSound(), [$player]);
                                DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 100000);
                            } else {
                                $player->sendMessage(TF::RED . "Your inventory is full");
                            }
                        } else {
                            $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                            $player->sendMessage(TF::RED . "Insufficient funds");
                        }
                        break;
                    # iron chestplate
                    case 20:
                        if($playerMoney >= 100000) {
                            if($player->getInventory()->canAddItem(VanillaItems::IRON_CHESTPLATE())) {
                                $player->sendMessage(TF::RED . "- $100,000");
                                $player->getInventory()->addItem(VanillaItems::IRON_CHESTPLATE());
                                $player->broadcastSound(new XpCollectSound(), [$player]);
                                DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 100000);
                            } else {
                                $player->sendMessage(TF::RED . "Your inventory is full");
                            }
                        } else {
                            $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                            $player->sendMessage(TF::RED . "Insufficient funds");
                        }
                        break;
                    # iron leggings
                    case 21:
                        if($playerMoney >= 100000) {
                            if($player->getInventory()->canAddItem(VanillaItems::IRON_LEGGINGS())) {
                                $player->sendMessage(TF::RED . "- $100,000");
                                $player->getInventory()->addItem(VanillaItems::IRON_LEGGINGS());
                                $player->broadcastSound(new XpCollectSound(), [$player]);
                                DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 100000);
                            } else {
                                $player->sendMessage(TF::RED . "Your inventory is full");
                            }
                        } else {
                            $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                            $player->sendMessage(TF::RED . "Insufficient funds");
                        }
                        break;
                    # iron boots
                    case 22:
                        if($playerMoney >= 100000) {
                            if($player->getInventory()->canAddItem(VanillaItems::IRON_BOOTS())) {
                                $player->sendMessage(TF::RED . "- $100,000");
                                $player->getInventory()->addItem(VanillaItems::IRON_BOOTS());
                                $player->broadcastSound(new XpCollectSound(), [$player]);
                                DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 100000);
                            } else {
                                $player->sendMessage(TF::RED . "Your inventory is full");
                            }
                        } else {
                            $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                            $player->sendMessage(TF::RED . "Insufficient funds");
                        }
                        break;
                    # iron pickaxe
                    case 23:
                        if($playerMoney >= 200000) {
                            if($player->getInventory()->canAddItem((EmporiumPrison::getInstance()->getPickaxes())->Iron())) {
                                $player->sendMessage(TF::RED . "- $200,000");
                                $player->getInventory()->addItem((EmporiumPrison::getInstance()->getPickaxes())->Iron());
                                $player->broadcastSound(new XpCollectSound(), [$player]);
                                DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 200000);
                            } else {
                                $player->sendMessage(TF::RED . "Your inventory is full");
                            }
                        } else {
                            $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                            $player->sendMessage(TF::RED . "Insufficient funds");
                        }
                        break;
                    # iron sword
                    case 24:
                        if($playerMoney >= 200000) {
                            if($player->getInventory()->canAddItem(VanillaItems::IRON_SWORD())) {
                                $player->sendMessage(TF::RED . "- $200,000");
                                $player->getInventory()->addItem(VanillaItems::IRON_SWORD());
                                $player->broadcastSound(new XpCollectSound(), [$player]);
                                DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 200000);
                            } else {
                                $player->sendMessage(TF::RED . "Your inventory is full");
                            }
                        } else {
                            $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                            $player->sendMessage(TF::RED . "Insufficient funds");
                        }
                        break;
                    # iron axe
                    case 25:
                        if($playerMoney >= 200000) {
                            if($player->getInventory()->canAddItem(VanillaItems::IRON_AXE())) {
                                $player->sendMessage(TF::RED . "- $200,000");
                                $player->getInventory()->addItem(VanillaItems::IRON_AXE());
                                $player->broadcastSound(new XpCollectSound(), [$player]);
                                DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 200000);
                            } else {
                                $player->sendMessage(TF::RED . "Your inventory is full");
                            }
                        } else {
                            $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                            $player->sendMessage(TF::RED . "Insufficient funds");
                        }
                        break;

                    # diamond helmet
                    case 26:
                        if($playerMoney >= 1000000) {
                            if($player->getInventory()->canAddItem(VanillaItems::DIAMOND_HELMET())) {
                                $player->sendMessage(TF::RED . "- $1,000,000");
                                $player->getInventory()->addItem(VanillaItems::DIAMOND_HELMET());
                                $player->broadcastSound(new XpCollectSound(), [$player]);
                                DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 1000000);
                            } else {
                                $player->sendMessage(TF::RED . "Your inventory is full");
                            }
                        } else {
                            $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                            $player->sendMessage(TF::RED . "Insufficient funds");
                        }
                        break;
                    # diamond chestplate
                    case 27:
                        if($playerMoney >= 1000000) {
                            if($player->getInventory()->canAddItem(VanillaItems::DIAMOND_CHESTPLATE())) {
                                $player->sendMessage(TF::RED . "- $1,000,000");
                                $player->getInventory()->addItem(VanillaItems::DIAMOND_CHESTPLATE());
                                $player->broadcastSound(new XpCollectSound(), [$player]);
                                DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 1000000);
                            } else {
                                $player->sendMessage(TF::RED . "Your inventory is full");
                            }
                        } else {
                            $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                            $player->sendMessage(TF::RED . "Insufficient funds");
                        }
                        break;
                    # diamond leggings
                    case 28:
                        if($playerMoney >= 1000000) {
                            if($player->getInventory()->canAddItem(VanillaItems::DIAMOND_LEGGINGS())) {
                                $player->sendMessage(TF::RED . "- $1,000,000");
                                $player->getInventory()->addItem(VanillaItems::DIAMOND_LEGGINGS());
                                $player->broadcastSound(new XpCollectSound(), [$player]);
                                DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 1000000);
                            } else {
                                $player->sendMessage(TF::RED . "Your inventory is full");
                            }
                        } else {
                            $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                            $player->sendMessage(TF::RED . "Insufficient funds");
                        }
                        break;
                    # diamond boots
                    case 29:
                        if($playerMoney >= 1000000) {
                            if($player->getInventory()->canAddItem(VanillaItems::DIAMOND_BOOTS())) {
                                $player->sendMessage(TF::RED . "- $1,000,000");
                                $player->getInventory()->addItem(VanillaItems::DIAMOND_BOOTS());
                                $player->broadcastSound(new XpCollectSound(), [$player]);
                                DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 1000000);
                            } else {
                                $player->sendMessage(TF::RED . "Your inventory is full");
                            }
                        } else {
                            $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                            $player->sendMessage(TF::RED . "Insufficient funds");
                        }
                        break;
                    # diamond pickaxe
                    case 30:
                        if($playerMoney >= 2000000) {
                            if($player->getInventory()->canAddItem((EmporiumPrison::getInstance()->getPickaxes())->Diamond())) {
                                $player->sendMessage(TF::RED . "- $2,000,000");
                                $player->getInventory()->addItem((EmporiumPrison::getInstance()->getPickaxes())->Diamond());
                                $player->broadcastSound(new XpCollectSound(), [$player]);
                                DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 2000000);
                            } else {
                                $player->sendMessage(TF::RED . "Your inventory is full");
                            }
                        } else {
                            $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                            $player->sendMessage(TF::RED . "Insufficient funds");
                        }
                        break;
                    # diamond sword
                    case 31:
                        if($playerMoney >= 2000000) {
                            if($player->getInventory()->canAddItem(VanillaItems::DIAMOND_SWORD())) {
                                $player->sendMessage(TF::RED . "- $2,000,000");
                                $player->getInventory()->addItem(VanillaItems::DIAMOND_SWORD());
                                $player->broadcastSound(new XpCollectSound(), [$player]);
                                DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 2000000);
                            } else {
                                $player->sendMessage(TF::RED . "Your inventory is full");
                            }
                        } else {
                            $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                            $player->sendMessage(TF::RED . "Insufficient funds");
                        }
                        break;
                    # diamond axe
                    case 32:
                        if($playerMoney >= 2000000) {
                            if($player->getInventory()->canAddItem(VanillaItems::DIAMOND_AXE())) {
                                $player->sendMessage(TF::RED . "- $2,000,000");
                                $player->getInventory()->addItem(VanillaItems::DIAMOND_AXE());
                                $player->broadcastSound(new XpCollectSound(), [$player]);
                                DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 2000000);
                            } else {
                                $player->sendMessage(TF::RED . "Your inventory is full");
                            }
                        } else {
                            $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                            $player->sendMessage(TF::RED . "Insufficient funds");
                        }
                        break;
                }
            }
        });
        $form->setTitle(TF::BOLD . "Blacksmith");
        $form->addButton("Bow\n" . TF::GREEN . "$5,000");
        $form->addButton("Arrow\n" . TF::GREEN . "$100");
        $form->addButton("Wooden Pickaxe\n" . TF::GREEN . "$20");
        $form->addButton("Wooden Sword\n" . TF::GREEN . "$100");
        $form->addButton("Wooden Axe\n" . TF::GREEN . "$100");
        # chain
        $form->addButton("Chain Helmet\n" . TF::GREEN . "$100");
        $form->addButton("Chain Chestplate\n" . TF::GREEN . "$100");
        $form->addButton("Chain Leggings\n" . TF::GREEN . "$100");
        $form->addButton("Chain Boots\n" . TF::GREEN . "$100");
        $form->addButton("Stone Pickaxe\n" . TF::GREEN . "$200");
        $form->addButton("Stone Sword\n" . TF::GREEN . "$500");
        $form->addButton("Stone Axe\n" . TF::GREEN . "$500");
        # gold
        $form->addButton("Gold Helmet\n" . TF::GREEN . "$1,000");
        $form->addButton("Gold Chestplate\n" . TF::GREEN . "$1,000");
        $form->addButton("Gold Leggings\n" . TF::GREEN . "$1,000");
        $form->addButton("Gold Boots\n" . TF::GREEN . "$1,000");
        $form->addButton("Gold Pickaxe\n" . TF::GREEN . "$2,000");
        $form->addButton("Gold Sword\n" . TF::GREEN . "$2,000");
        $form->addButton("Gold Axe\n" . TF::GREEN . "$2,000");
        # iron
        $form->addButton("Iron Helmet\n" . TF::GREEN . "$100,000");
        $form->addButton("Iron Chestplate\n" . TF::GREEN . "$100,000");
        $form->addButton("Iron Leggings\n" . TF::GREEN . "$100,000");
        $form->addButton("Iron Boots\n" . TF::GREEN . "$100,000");
        $form->addButton("Iron Pickaxe\n" . TF::GREEN . "$200,000");
        $form->addButton("Iron Sword\n" . TF::GREEN . "$200,000");
        $form->addButton("Iron Axe\n" . TF::GREEN . "$200,000");
        # diamond
        $form->addButton("Diamond Helmet\n" . TF::GREEN . "$1,000,000");
        $form->addButton("Diamond Chestplate\n" . TF::GREEN . "$1,000,000");
        $form->addButton("Diamond Leggings\n" . TF::GREEN . "$1,000,000");
        $form->addButton("Diamond Boots\n" . TF::GREEN . "$1,000,000");
        $form->addButton("Diamond Pickaxe\n" . TF::GREEN . "$2,000,000");
        $form->addButton("Diamond Sword\n" . TF::GREEN . "$2,000,000");
        $form->addButton("Diamond Axe\n" . TF::GREEN . "$2,000,000");
        $player->sendForm($form);
    }
    # blacksmith
    public function Inventory($player): void {

        $menu = InvMenu::create(InvMenuTypeIds::TYPE_DOUBLE_CHEST);
        $menu->setName(TF::BOLD . "Blacksmith");
        $money = DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.money");
        $menu->setListener(InvMenu::readonly(function(DeterministicInvMenuTransaction $transaction) use ($money): void {
            $player = $transaction->getPlayer();
            $itemClicked = $transaction->getItemClicked();
            # bow
            if($itemClicked->getTypeId() == VanillaItems::BOW()) {
                if($money >= 5000) {
                    DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 5000);
                    $player->getInventory()->addItem(VanillaItems::BOW());
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                    $player->sendMessage(TF::RED . "- $5,000");
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Insufficient funds");
                }
            }
            # arrow
            if($itemClicked->getTypeId() == VanillaItems::ARROW()) {
                if($money >= 100) {
                    DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 100);
                    $player->getInventory()->addItem(VanillaItems::ARROW());
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                    $player->sendMessage(TF::RED . "- $100");
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Insufficient funds");
                }
            }
            # trainee pickaxe
            if($itemClicked->getTypeId() == VanillaItems::WOODEN_PICKAXE()) {
                if($money >= 20) {
                    DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 20);
                    $player->getInventory()->addItem((EmporiumPrison::getInstance()->getPickaxes())->Trainee());
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                    $player->sendMessage(TF::RED . "- $20");
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Insufficient funds");
                }
            }
            # wooden sword
            if($itemClicked->getTypeId() == VanillaItems::WOODEN_SWORD()) {
                if($money >= 100) {
                    DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 100);
                    $player->getInventory()->addItem(VanillaItems::WOODEN_SWORD());
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                    $player->sendMessage(TF::RED . "- $100");
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Insufficient funds");
                }
            }
            # wooden axe
            if($itemClicked->getTypeId() == VanillaItems::WOODEN_AXE()) {
                if($money >= 100) {
                    DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 100);
                    $player->getInventory()->addItem(VanillaItems::WOODEN_AXE());
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                    $player->sendMessage(TF::RED . "- $100");
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Insufficient funds");
                }
            }


            # chain helmet
            if($itemClicked->getTypeId() == VanillaItems::CHAINMAIL_HELMET()) {
                if($money >= 100) {
                    DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 100);
                    $player->getInventory()->addItem(VanillaItems::CHAINMAIL_HELMET());
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                    $player->sendMessage(TF::RED . "- $100");
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Insufficient funds");
                }
            }
            # chain chestplate
            if($itemClicked->getTypeId() == VanillaItems::CHAINMAIL_CHESTPLATE()) {
                if($money >= 100) {
                    DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 100);
                    $player->getInventory()->addItem(VanillaItems::CHAINMAIL_CHESTPLATE());
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                    $player->sendMessage(TF::RED . "- $100");
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Insufficient funds");
                }
            }
            # chain leggings
            if($itemClicked->getTypeId() == VanillaItems::CHAINMAIL_LEGGINGS()) {
                if($money >= 100) {
                    DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 100);
                    $player->getInventory()->addItem(VanillaItems::CHAINMAIL_LEGGINGS());
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                    $player->sendMessage(TF::RED . "- $100");
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Insufficient funds");
                }
            }
            # chain boots
            if($itemClicked->getTypeId() == VanillaItems::CHAINMAIL_BOOTS()) {
                if($money >= 100) {
                    DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 100);
                    $player->getInventory()->addItem(VanillaItems::CHAINMAIL_BOOTS());
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                    $player->sendMessage(TF::RED . "- $100");
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Insufficient funds");
                }
            }
            # stone pickaxe
            if($itemClicked->getTypeId() == VanillaItems::STONE_PICKAXE()) {
                if($money >= 200) {
                    DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 200);
                    $player->getInventory()->addItem((EmporiumPrison::getInstance()->getPickaxes())->Stone());
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                    $player->sendMessage(TF::RED . "- $200");
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Insufficient funds");
                }
            }
            # stone sword
            if($itemClicked->getTypeId() == VanillaItems::STONE_SWORD()) {
                if($money >= 500) {
                    DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 500);
                    $player->getInventory()->addItem(VanillaItems::STONE_SWORD());
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                    $player->sendMessage(TF::RED . "- $500");
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Insufficient funds");
                }
            }
            # stone axe
            if($itemClicked->getTypeId() == VanillaItems::STONE_AXE()) {
                if($money >= 500) {
                    DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 500);
                    $player->getInventory()->addItem(VanillaItems::STONE_AXE());
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                    $player->sendMessage(TF::RED . "- $500");
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Insufficient funds");
                }
            }


            # golden helmet
            if($itemClicked->getTypeId() == VanillaItems::GOLDEN_HELMET()) {
                if($money >= 1000) {
                    DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 1000);
                    $player->getInventory()->addItem(VanillaItems::GOLDEN_HELMET());
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                    $player->sendMessage(TF::RED . "- $1,000");
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Insufficient funds");
                }
            }
            # golden chestplate
            if($itemClicked->getTypeId() == VanillaItems::GOLDEN_CHESTPLATE()) {
                if($money >= 1000) {
                    DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 1000);
                    $player->getInventory()->addItem(VanillaItems::GOLDEN_CHESTPLATE());
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                    $player->sendMessage(TF::RED . "- $1,000");
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Insufficient funds");
                }
            }
            # golden leggings
            if($itemClicked->getTypeId() == VanillaItems::GOLDEN_LEGGINGS()) {
                if($money >= 1000) {
                    DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 1000);
                    $player->getInventory()->addItem(VanillaItems::GOLDEN_LEGGINGS());
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                    $player->sendMessage(TF::RED . "- $1,000");
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Insufficient funds");
                }
            }
            # golden boots
            if($itemClicked->getTypeId() == VanillaItems::GOLDEN_BOOTS()) {
                if($money >= 1000) {
                    DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 1000);
                    $player->getInventory()->addItem(VanillaItems::GOLDEN_BOOTS());
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                    $player->sendMessage(TF::RED . "- $1,000");
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Insufficient funds");
                }
            }
            # golden pickaxe
            if($itemClicked->getTypeId() == VanillaItems::GOLDEN_PICKAXE()) {
                if($money >= 2000) {
                    DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 2000);
                    $player->getInventory()->addItem((EmporiumPrison::getInstance()->getPickaxes())->Gold());
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                    $player->sendMessage(TF::RED . "- $2,000");
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Insufficient funds");
                }
            }
            # golden sword
            if($itemClicked->getTypeId() == VanillaItems::GOLDEN_SWORD()) {
                if($money >= 2000) {
                    DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 2000);
                    $player->getInventory()->addItem(VanillaItems::GOLDEN_SWORD());
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                    $player->sendMessage(TF::RED . "- $2,000");
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Insufficient funds");
                }
            }
            # golden axe
            if($itemClicked->getTypeId() == VanillaItems::GOLDEN_AXE()) {
                if($money >= 2000) {
                    DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 2000);
                    $player->getInventory()->addItem(VanillaItems::GOLDEN_AXE());
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                    $player->sendMessage(TF::RED . "- $2,000");
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Insufficient funds");
                }
            }


            # iron helmet
            if($itemClicked->getTypeId() == VanillaItems::IRON_HELMET()) {
                if($money >= 100000) {
                    DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 100000);
                    $player->getInventory()->addItem(VanillaItems::IRON_HELMET());
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                    $player->sendMessage(TF::RED . "- $100,000");
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Insufficient funds");
                }
            }
            # iron chestplate
            if($itemClicked->getTypeId() == VanillaItems::IRON_CHESTPLATE()) {
                if($money >= 100000) {
                    DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 100000);
                    $player->getInventory()->addItem(VanillaItems::IRON_CHESTPLATE());
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                    $player->sendMessage(TF::RED . "- $100,000");
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Insufficient funds");
                }
            }
            # iron leggings
            if($itemClicked->getTypeId() == VanillaItems::IRON_LEGGINGS()) {
                if($money >= 100000) {
                    DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 100000);
                    $player->getInventory()->addItem(VanillaItems::IRON_LEGGINGS());
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                    $player->sendMessage(TF::RED . "- $100,000");
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Insufficient funds");
                }
            }
            # iron boots
            if($itemClicked->getTypeId() == VanillaItems::IRON_BOOTS()) {
                if($money >= 100000) {
                    DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 100000);
                    $player->getInventory()->addItem(VanillaItems::IRON_BOOTS());
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                    $player->sendMessage(TF::RED . "- $100,000");
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Insufficient funds");
                }
            }
            # iron pickaxe
            if($itemClicked->getTypeId() == VanillaItems::IRON_PICKAXE()) {
                if($money >= 200000) {
                    DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 200000);
                    $player->getInventory()->addItem((EmporiumPrison::getInstance()->getPickaxes())->Iron());
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                    $player->sendMessage(TF::RED . "- $200,000");
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Insufficient funds");
                }
            }
            # iron sword
            if($itemClicked->getTypeId() == VanillaItems::IRON_SWORD()) {
                if($money >= 200000) {
                    DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 200000);
                    $player->getInventory()->addItem(VanillaItems::IRON_SWORD());
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                    $player->sendMessage(TF::RED . "- $200,000");
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Insufficient funds");
                }
            }
            # iron axe
            if($itemClicked->getTypeId() == VanillaItems::IRON_AXE()) {
                if($money >= 200000) {
                    DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 200000);
                    $player->getInventory()->addItem(VanillaItems::IRON_AXE());
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                    $player->sendMessage(TF::RED . "- $200,000");
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Insufficient funds");
                }
            }


            # diamond helmet
            if($itemClicked->getTypeId() == VanillaItems::DIAMOND_HELMET()) {
                if($money >= 1000000) {
                    DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 1000000);
                    $player->getInventory()->addItem(VanillaItems::DIAMOND_HELMET());
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                    $player->sendMessage(TF::RED . "- $1,000,000");
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Insufficient funds");
                }
            }
            # diamond chestplate
            if($itemClicked->getTypeId() == VanillaItems::DIAMOND_CHESTPLATE()) {
                if($money >= 1000000) {
                    DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 1000000);
                    $player->getInventory()->addItem(VanillaItems::DIAMOND_CHESTPLATE());
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                    $player->sendMessage(TF::RED . "- $1,000,000");
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Insufficient funds");
                }
            }
            # diamond leggings
            if($itemClicked->getTypeId() == VanillaItems::DIAMOND_LEGGINGS()) {
                if($money >= 1000000) {
                    DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 1000000);
                    $player->getInventory()->addItem(VanillaItems::DIAMOND_LEGGINGS());
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                    $player->sendMessage(TF::RED . "- $1,000,000");
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Insufficient funds");
                }
            }
            # diamond boots
            if($itemClicked->getTypeId() == VanillaItems::DIAMOND_BOOTS()) {
                if($money >= 1000000) {
                    DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 1000000);
                    $player->getInventory()->addItem(VanillaItems::DIAMOND_BOOTS());
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                    $player->sendMessage(TF::RED . "- $1,000,000");
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Insufficient funds");
                }
            }
            # diamond pickaxe
            if($itemClicked->getTypeId() == VanillaItems::DIAMOND_PICKAXE()) {
                if($money >= 2000000) {
                    DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 2000000);
                    $player->getInventory()->addItem((EmporiumPrison::getInstance()->getPickaxes())->Diamond());
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                    $player->sendMessage(TF::RED . "- $2,000,000");
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Insufficient funds");
                }
            }
            # diamond sword
            if($itemClicked->getTypeId() == VanillaItems::DIAMOND_SWORD()) {
                if($money >= 2000000) {
                    DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 2000000);
                    $player->getInventory()->addItem(VanillaItems::DIAMOND_SWORD());
                    $player->sendMessage(TF::RED . "- $2,000,000");
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Insufficient funds");
                }
            }
            # diamond axe
            if($itemClicked->getTypeId() == VanillaItems::DIAMOND_AXE()) {
                if($money >= 2000000) {
                    DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 2000000);
                    $player->getInventory()->addItem(VanillaItems::DIAMOND_AXE());
                    $player->sendMessage(TF::RED . "- $2,000,000");
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Insufficient funds");
                }
            }
        }));
        $inventory = $menu->getInventory();
        # starter tier`
        $inventory->setItem(1, $this->bow()); # $5000
        $inventory->setItem(2, $this->arrow()); # $100
        $inventory->setItem(5, $this->wooden_pickaxe()); # $20
        $inventory->setItem(6, $this->wooden_sword()); # $100
        $inventory->setItem(7, $this->wooden_axe()); # $100
        # chain tier
        $inventory->setItem(10, $this->chain_helmet()); # $100
        $inventory->setItem(11, $this->chain_chestplate()); # $100
        $inventory->setItem(12, $this->chain_leggings()); # $100
        $inventory->setItem(13, $this->chain_boots()); # $100
        $inventory->setItem(14, $this->stone_pickaxe()); # $200
        $inventory->setItem(15, $this->stone_Sword()); # $500
        $inventory->setItem(16, $this->stone_axe()); # $500
        # gold tier
        $inventory->setItem(19, $this->gold_helmet()); # $1000
        $inventory->setItem(20, $this->gold_chestplate()); # $1000
        $inventory->setItem(21, $this->gold_leggings()); # $1000
        $inventory->setItem(22, $this->gold_boots()); # $1000
        $inventory->setItem(23, $this->gold_pickaxe()); # $2000
        $inventory->setItem(24, $this->gold_sword()); # $2000
        $inventory->setItem(25, $this->gold_axe()); # $2000
        # iron tier
        $inventory->setItem(28, $this->iron_helmet()); # $100000
        $inventory->setItem(29, $this->iron_chestplate()); # $100000
        $inventory->setItem(30, $this->iron_leggings()); # $100000
        $inventory->setItem(31, $this->iron_boots()); # $100000
        $inventory->setItem(32, $this->iron_pickaxe()); # $200000
        $inventory->setItem(33, $this->iron_sword()); # $200000
        $inventory->setItem(34, $this->iron_axe()); # $200000
        # diamond tier
        $inventory->setItem(37, $this->diamond_helmet()); # $1000000
        $inventory->setItem(38, $this->diamond_chestplate()); # $1000000
        $inventory->setItem(39, $this->diamond_leggings()); # $1000000
        $inventory->setItem(40, $this->diamond_boots()); # $1000000
        $inventory->setItem(41, $this->diamond_pickaxe()); # $2000000
        $inventory->setItem(42, $this->diamond_sword()); # $2000000
        $inventory->setItem(43, $this->diamond_axe()); # $2000000

        $menu->send($player);
    }

    # blacksmith items
    # row 1
    public function bow(): Item {
        $item = VanillaItems::BOW();
        $item->setLore([
            TF::EOL,
            TF::GREEN . "$5,000",
            TF::EOL,
            TF::GRAY . "Click to purchase 1"
        ]);

        return $item;
    }
    public function arrow(): Item {
        $item = VanillaItems::ARROW();
        $item->setLore([
            TF::EOL,
            TF::GREEN . "$100",
            TF::EOL,
            TF::GRAY . "Click to purchase 1"
        ]);

        return $item;
    }
    public function wooden_pickaxe(): Item {
        $item = VanillaItems::WOODEN_PICKAXE();
        $item->setLore([
            TF::EOL,
            TF::GREEN . "$20",
            TF::EOL,
            TF::YELLOW . "Required Mining Level " . TF::BOLD . TF::WHITE . "1",
            TF::EOL,
            TF::GRAY . "Click to purchase 1"
        ]);

        return $item;
    }
    public function wooden_sword(): Item {
        $item = VanillaItems::WOODEN_SWORD();
        $item->setLore([
            TF::EOL,
            TF::GREEN . "$100",
            TF::EOL,
            TF::GRAY . "Click to purchase 1"
        ]);

        return $item;
    }
    public function wooden_axe(): Item {
        $item = VanillaItems::WOODEN_AXE();
        $item->setLore([
            TF::EOL,
            TF::GREEN . "$100",
            TF::EOL,
            TF::GRAY . "Click to purchase 1"
        ]);

        return $item;
    }
    # row 2
    public function chain_helmet(): Item {
        $item = VanillaItems::CHAINMAIL_HELMET();
        $item->setLore([
            TF::EOL,
            TF::GREEN . "$100",
            TF::EOL,
            TF::GRAY . "Click to purchase 1"
        ]);

        return $item;
    }
    public function chain_chestplate(): Item {
        $item = VanillaItems::CHAINMAIL_CHESTPLATE();
        $item->setLore([
            TF::EOL,
            TF::GREEN . "$100",
            TF::EOL,
            TF::GRAY . "Click to purchase 1"
        ]);

        return $item;
    }
    public function chain_leggings(): Item {
        $item = VanillaItems::CHAINMAIL_LEGGINGS();
        $item->setLore([
            TF::EOL,
            TF::GREEN . "$100",
            TF::EOL,
            TF::GRAY . "Click to purchase 1"
        ]);

        return $item;
    }
    public function chain_boots(): Item {
        $item = VanillaItems::CHAINMAIL_BOOTS();
        $item->setLore([
            TF::EOL,
            TF::GREEN . "$100",
            TF::EOL,
            TF::GRAY . "Click to purchase 1"
        ]);

        return $item;
    }
    public function stone_pickaxe(): Item {
        $item = VanillaItems::STONE_PICKAXE();
        $item->setLore([
            TF::EOL,
            TF::GREEN . "$200",
            TF::EOL,
            TF::YELLOW . "Required Mining Level " . TF::BOLD . TF::WHITE . "30",
            TF::EOL,
            TF::GRAY . "Click to purchase 1"
        ]);

        return $item;
    }
    public function stone_Sword(): Item {
        $item = VanillaItems::STONE_SWORD();
        $item->setLore([
            TF::EOL,
            TF::GREEN . "$500",
            TF::EOL,
            TF::GRAY . "Click to purchase 1"
        ]);

        return $item;
    }
    public function stone_axe(): Item {
        $item = VanillaItems::STONE_AXE();
        $item->setLore([
            TF::EOL,
            TF::GREEN . "$500",
            TF::EOL,
            TF::GRAY . "Click to purchase 1"
        ]);

        return $item;
    }
    # row 3
    public function gold_helmet(): Item {
        $item = VanillaItems::GOLDEN_HELMET();
        $item->setLore([
            TF::EOL,
            TF::GREEN . "$1,000",
            TF::EOL,
            TF::GRAY . "Click to purchase 1"
        ]);

        return $item;
    }
    public function gold_chestplate(): Item {
        $item = VanillaItems::GOLDEN_CHESTPLATE();
        $item->setLore([
            TF::EOL,
            TF::GREEN . "$1,000",
            TF::EOL,
            TF::GRAY . "Click to purchase 1"
        ]);

        return $item;
    }
    public function gold_leggings(): Item {
        $item = VanillaItems::GOLDEN_LEGGINGS();
        $item->setLore([
            TF::EOL,
            TF::GREEN . "$1,000",
            TF::EOL,
            TF::GRAY . "Click to purchase 1"
        ]);

        return $item;
    }
    public function gold_boots(): Item {
        $item = VanillaItems::GOLDEN_BOOTS();
        $item->setLore([
            TF::EOL,
            TF::GREEN . "$1,000",
            TF::EOL,
            TF::GRAY . "Click to purchase 1"
        ]);

        return $item;
    }
    public function gold_pickaxe(): Item {
        $item = VanillaItems::GOLDEN_PICKAXE();
        $item->setLore([
            TF::EOL,
            TF::GREEN . "$2,000",
            TF::EOL,
            TF::YELLOW . "Required Mining Level " . TF::BOLD . TF::WHITE . "50",
            TF::EOL,
            TF::GRAY . "Click to purchase 1"
        ]);

        return $item;
    }
    public function gold_sword(): Item {
        $item = VanillaItems::GOLDEN_SWORD();
        $item->setLore([
            TF::EOL,
            TF::GREEN . "$2,000",
            TF::EOL,
            TF::GRAY . "Click to purchase 1"
        ]);

        return $item;
    }
    public function gold_axe(): Item {
        $item = VanillaItems::GOLDEN_AXE();
        $item->setLore([
            TF::EOL,
            TF::GREEN . "$2,000",
            TF::EOL,
            TF::GRAY . "Click to purchase 1"
        ]);

        return $item;
    }
    # row 4
    public function iron_helmet(): Item {
        $item = VanillaItems::IRON_HELMET();
        $item->setLore([
            TF::EOL,
            TF::GREEN . "$100,000",
            TF::EOL,
            TF::GRAY . "Click to purchase 1"
        ]);

        return $item;
    }
    public function iron_chestplate(): Item {
        $item = VanillaItems::IRON_CHESTPLATE();
        $item->setLore([
            TF::EOL,
            TF::GREEN . "$100,000",
            TF::EOL,
            TF::GRAY . "Click to purchase 1"
        ]);

        return $item;
    }
    public function iron_leggings(): Item {
        $item = VanillaItems::IRON_LEGGINGS();
        $item->setLore([
            TF::EOL,
            TF::GREEN . "$100,000",
            TF::EOL,
            TF::GRAY . "Click to purchase 1"
        ]);

        return $item;
    }
    public function iron_boots(): Item {
        $item = VanillaItems::IRON_BOOTS();
        $item->setLore([
            TF::EOL,
            TF::GREEN . "$100,000",
            TF::EOL,
            TF::GRAY . "Click to purchase 1"
        ]);

        return $item;
    }
    public function iron_pickaxe(): Item {
        $item = VanillaItems::IRON_PICKAXE();
        $item->setLore([
            TF::EOL,
            TF::GREEN . "$200,000",
            TF::EOL,
            TF::YELLOW . "Required Mining Level " . TF::BOLD . TF::WHITE . "70",
            TF::EOL,
            TF::GRAY . "Click to purchase 1"
        ]);

        return $item;
    }
    public function iron_sword(): Item {
        $item = VanillaItems::IRON_SWORD();
        $item->setLore([
            TF::EOL,
            TF::GREEN . "$200,000",
            TF::EOL,
            TF::GRAY . "Click to purchase 1"
        ]);

        return $item;
    }
    public function iron_axe(): Item {
        $item = VanillaItems::IRON_AXE();
        $item->setLore([
            TF::EOL,
            TF::GREEN . "$200,000",
            TF::EOL,
            TF::GRAY . "Click to purchase 1"
        ]);

        return $item;
    }
    # row 5
    public function diamond_helmet(): Item {
        $item = VanillaItems::DIAMOND_HELMET();
        $item->setLore([
            TF::EOL,
            TF::GREEN . "$1,000,000",
            TF::EOL,
            TF::GRAY . "Click to purchase 1"
        ]);

        return $item;
    }
    public function diamond_chestplate(): Item {
        $item = VanillaItems::DIAMOND_CHESTPLATE();
        $item->setLore([
            TF::EOL,
            TF::GREEN . "$1,000,000",
            TF::EOL,
            TF::GRAY . "Click to purchase 1"
        ]);

        return $item;
    }
    public function diamond_leggings(): Item {
        $item = VanillaItems::DIAMOND_LEGGINGS();
        $item->setLore([
            TF::EOL,
            TF::GREEN . "$1,000,000",
            TF::EOL,
            TF::GRAY . "Click to purchase 1"
        ]);

        return $item;
    }
    public function diamond_boots(): Item {
        $item = VanillaItems::DIAMOND_BOOTS();
        $item->setLore([
            TF::EOL,
            TF::GREEN . "$1,000,000",
            TF::EOL,
            TF::GRAY . "Click to purchase 1"
        ]);

        return $item;
    }
    public function diamond_pickaxe(): Item {
        $item = VanillaItems::DIAMOND_PICKAXE();
        $item->setLore([
            TF::EOL,
            TF::GREEN . "$2,000,000",
            TF::EOL,
            TF::YELLOW . "Required Mining Level " . TF::BOLD . TF::WHITE . "90",
            TF::EOL,
            TF::GRAY . "Click to purchase 1"
        ]);

        return $item;
    }
    public function diamond_sword(): Item {
        $item = VanillaItems::DIAMOND_SWORD();
        $item->setLore([
            TF::EOL,
            TF::GREEN . "$2,000,000",
            TF::EOL,
            TF::GRAY . "Click to purchase 1"
        ]);

        return $item;
    }
    public function diamond_axe(): Item {
        $item = VanillaItems::DIAMOND_AXE();
        $item->setLore([
            TF::EOL,
            TF::GREEN . "$2,000,000",
            TF::EOL,
            TF::GRAY . "Click to purchase 1"
        ]);

        return $item;
    }

}