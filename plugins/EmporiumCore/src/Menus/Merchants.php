<?php

namespace Menus;

use Emporium\Prison\items\Pickaxes;
use Emporium\Prison\library\formapi\SimpleForm;
use EmporiumCore\Managers\Data\DataManager;
use muqsit\invmenu\InvMenu;
use muqsit\invmenu\transaction\DeterministicInvMenuTransaction;
use muqsit\invmenu\type\InvMenuTypeIds;
use pocketmine\item\Item;
use pocketmine\item\ItemIds;
use pocketmine\item\StringToItemParser;
use pocketmine\item\VanillaItems;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;
use pocketmine\world\sound\ItemFrameAddItemSound;
use pocketmine\world\sound\XpCollectSound;

class Merchants {

    public function BlacksmithForm(Player $player): void {
        $form = new SimpleForm(function(Player $player, $data) {
            if($data === null) {
                return;
            } else {
                $playerMoney = DataManager::getData($player, "Players", "Money");
                switch($data) {
                    # bow
                    case 0:
                        if($playerMoney >= 5000) {
                            if($player->getInventory()->canAddItem(VanillaItems::BOW())) {
                                $player->sendMessage(TF::RED . "- $5,000");
                                $player->getInventory()->addItem(VanillaItems::BOW());
                                $player->broadcastSound(new XpCollectSound(), [$player]);
                                DataManager::takeData($player, "Players", "Money", 5000);
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
                                DataManager::takeData($player, "Players", "Money", 100);
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
                            if($player->getInventory()->canAddItem((new Pickaxes($player))->Trainee())) {
                                $player->sendMessage(TF::RED . "- $20");
                                $player->getInventory()->addItem((new Pickaxes($player))->Trainee());
                                $player->broadcastSound(new XpCollectSound(), [$player]);
                                DataManager::takeData($player, "Players", "Money", 20);
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
                                DataManager::takeData($player, "Players", "Money", 100);
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
                                DataManager::takeData($player, "Players", "Money", 100);
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
                                DataManager::takeData($player, "Players", "Money", 100);
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
                                DataManager::takeData($player, "Players", "Money", 100);
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
                                DataManager::takeData($player, "Players", "Money", 100);
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
                                DataManager::takeData($player, "Players", "Money", 100);
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
                            if($player->getInventory()->canAddItem((new Pickaxes($player))->Stone())) {
                                $player->sendMessage(TF::RED . "- $200");
                                $player->getInventory()->addItem((new Pickaxes($player))->Stone());
                                $player->broadcastSound(new XpCollectSound(), [$player]);
                                DataManager::takeData($player, "Players", "Money", 200);
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
                                DataManager::takeData($player, "Players", "Money", 500);
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
                                DataManager::takeData($player, "Players", "Money", 500);
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
                                DataManager::takeData($player, "Players", "Money", 1000);
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
                                DataManager::takeData($player, "Players", "Money", 1000);
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
                                DataManager::takeData($player, "Players", "Money", 1000);
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
                                DataManager::takeData($player, "Players", "Money", 1000);
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
                            if($player->getInventory()->canAddItem((new Pickaxes($player))->Gold())) {
                                $player->sendMessage(TF::RED . "- $2,000");
                                $player->getInventory()->addItem((new Pickaxes($player))->Gold());
                                $player->broadcastSound(new XpCollectSound(), [$player]);
                                DataManager::takeData($player, "Players", "Money", 2000);
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
                                DataManager::takeData($player, "Players", "Money", 2000);
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
                                DataManager::takeData($player, "Players", "Money", 2000);
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
                                DataManager::takeData($player, "Players", "Money", 100000);
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
                                DataManager::takeData($player, "Players", "Money", 100000);
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
                                DataManager::takeData($player, "Players", "Money", 100000);
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
                                DataManager::takeData($player, "Players", "Money", 100000);
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
                            if($player->getInventory()->canAddItem((new Pickaxes($player))->Iron())) {
                                $player->sendMessage(TF::RED . "- $200,000");
                                $player->getInventory()->addItem((new Pickaxes($player))->Iron());
                                $player->broadcastSound(new XpCollectSound(), [$player]);
                                DataManager::takeData($player, "Players", "Money", 200000);
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
                                DataManager::takeData($player, "Players", "Money", 200000);
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
                                DataManager::takeData($player, "Players", "Money", 200000);
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
                                DataManager::takeData($player, "Players", "Money", 1000000);
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
                                DataManager::takeData($player, "Players", "Money", 1000000);
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
                                DataManager::takeData($player, "Players", "Money", 1000000);
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
                                DataManager::takeData($player, "Players", "Money", 1000000);
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
                            if($player->getInventory()->canAddItem((new Pickaxes($player))->Diamond())) {
                                $player->sendMessage(TF::RED . "- $2,000,000");
                                $player->getInventory()->addItem((new Pickaxes($player))->Diamond());
                                $player->broadcastSound(new XpCollectSound(), [$player]);
                                DataManager::takeData($player, "Players", "Money", 2000000);
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
                                DataManager::takeData($player, "Players", "Money", 2000000);
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
                                DataManager::takeData($player, "Players", "Money", 2000000);
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
    public function BlacksmithInventory($sender): void {

        $menu = InvMenu::create(InvMenuTypeIds::TYPE_DOUBLE_CHEST);
        $menu->setName(TF::BOLD . "Blacksmith");
        $money = DataManager::getData($sender, "Players", "Money");
        $menu->setListener(InvMenu::readonly(function(DeterministicInvMenuTransaction $transaction) use ($money): void {
            $player = $transaction->getPlayer();
            $itemClicked = $transaction->getItemClicked();
            # bow
            if($itemClicked->getId() === ItemIds::BOW) {
                if($money >= 5000) {
                    DataManager::takeData($player, "Players", "Money", 5000);
                    $player->getInventory()->addItem(VanillaItems::BOW());
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                    $player->sendMessage(TF::RED . "- $5,000");
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Insufficient funds");
                }
            }
            # arrow
            if($itemClicked->getId() === ItemIds::ARROW) {
                if($money >= 100) {
                    DataManager::takeData($player, "Players", "Money", 100);
                    $player->getInventory()->addItem(VanillaItems::ARROW());
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                    $player->sendMessage(TF::RED . "- $100");
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Insufficient funds");
                }
            }
            # trainee pickaxe
            if($itemClicked->getId() === ItemIds::WOODEN_PICKAXE) {
                if($money >= 20) {
                    DataManager::takeData($player, "Players", "Money", 20);
                    $player->getInventory()->addItem((new Pickaxes($player))->Trainee());
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                    $player->sendMessage(TF::RED . "- $20");
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Insufficient funds");
                }
            }
            # wooden sword
            if($itemClicked->getId() === ItemIds::WOODEN_SWORD) {
                if($money >= 100) {
                    DataManager::takeData($player, "Players", "Money", 100);
                    $player->getInventory()->addItem(VanillaItems::WOODEN_SWORD());
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                    $player->sendMessage(TF::RED . "- $100");
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Insufficient funds");
                }
            }
            # wooden axe
            if($itemClicked->getId() === ItemIds::WOODEN_AXE) {
                if($money >= 100) {
                    DataManager::takeData($player, "Players", "Money", 100);
                    $player->getInventory()->addItem(VanillaItems::WOODEN_AXE());
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                    $player->sendMessage(TF::RED . "- $100");
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Insufficient funds");
                }
            }


            # chain helmet
            if($itemClicked->getId() === ItemIds::CHAINMAIL_HELMET) {
                if($money >= 100) {
                    DataManager::takeData($player, "Players", "Money", 100);
                    $player->getInventory()->addItem(VanillaItems::CHAINMAIL_HELMET());
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                    $player->sendMessage(TF::RED . "- $100");
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Insufficient funds");
                }
            }
            # chain chestplate
            if($itemClicked->getId() === ItemIds::CHAINMAIL_CHESTPLATE) {
                if($money >= 100) {
                    DataManager::takeData($player, "Players", "Money", 100);
                    $player->getInventory()->addItem(VanillaItems::CHAINMAIL_CHESTPLATE());
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                    $player->sendMessage(TF::RED . "- $100");
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Insufficient funds");
                }
            }
            # chain leggings
            if($itemClicked->getId() === ItemIds::CHAIN_LEGGINGS) {
                if($money >= 100) {
                    DataManager::takeData($player, "Players", "Money", 100);
                    $player->getInventory()->addItem(VanillaItems::CHAINMAIL_LEGGINGS());
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                    $player->sendMessage(TF::RED . "- $100");
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Insufficient funds");
                }
            }
            # chain boots
            if($itemClicked->getId() === ItemIds::CHAIN_BOOTS) {
                if($money >= 100) {
                    DataManager::takeData($player, "Players", "Money", 100);
                    $player->getInventory()->addItem(VanillaItems::CHAINMAIL_BOOTS());
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                    $player->sendMessage(TF::RED . "- $100");
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Insufficient funds");
                }
            }
            # stone pickaxe
            if($itemClicked->getId() === ItemIds::STONE_PICKAXE) {
                if($money >= 200) {
                    DataManager::takeData($player, "Players", "Money", 200);
                    $player->getInventory()->addItem((new Pickaxes($player))->Stone());
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                    $player->sendMessage(TF::RED . "- $200");
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Insufficient funds");
                }
            }
            # stone sword
            if($itemClicked->getId() === ItemIds::STONE_SWORD) {
                if($money >= 500) {
                    DataManager::takeData($player, "Players", "Money", 500);
                    $player->getInventory()->addItem(VanillaItems::STONE_SWORD());
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                    $player->sendMessage(TF::RED . "- $500");
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Insufficient funds");
                }
            }
            # stone axe
            if($itemClicked->getId() === ItemIds::STONE_AXE) {
                if($money >= 500) {
                    DataManager::takeData($player, "Players", "Money", 500);
                    $player->getInventory()->addItem(VanillaItems::STONE_AXE());
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                    $player->sendMessage(TF::RED . "- $500");
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Insufficient funds");
                }
            }


            # golden helmet
            if($itemClicked->getId() === ItemIds::GOLDEN_HELMET) {
                if($money >= 1000) {
                    DataManager::takeData($player, "Players", "Money", 1000);
                    $player->getInventory()->addItem(VanillaItems::GOLDEN_HELMET());
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                    $player->sendMessage(TF::RED . "- $1,000");
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Insufficient funds");
                }
            }
            # golden chestplate
            if($itemClicked->getId() === ItemIds::GOLDEN_CHESTPLATE) {
                if($money >= 1000) {
                    DataManager::takeData($player, "Players", "Money", 1000);
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                    $player->sendMessage(TF::RED . "- $1,000");
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Insufficient funds");
                }
            }
            # golden leggings
            if($itemClicked->getId() === ItemIds::GOLDEN_LEGGINGS) {
                if($money >= 1000) {
                    DataManager::takeData($player, "Players", "Money", 1000);
                    $player->getInventory()->addItem(VanillaItems::GOLDEN_LEGGINGS());
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                    $player->sendMessage(TF::RED . "- $1,000");
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Insufficient funds");
                }
            }
            # golden boots
            if($itemClicked->getId() === ItemIds::GOLDEN_BOOTS) {
                if($money >= 1000) {
                    DataManager::takeData($player, "Players", "Money", 1000);
                    $player->getInventory()->addItem(VanillaItems::GOLDEN_BOOTS());
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                    $player->sendMessage(TF::RED . "- $1,000");
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Insufficient funds");
                }
            }
            # golden pickaxe
            if($itemClicked->getId() === ItemIds::GOLDEN_PICKAXE) {
                if($money >= 2000) {
                    DataManager::takeData($player, "Players", "Money", 2000);
                    $player->getInventory()->addItem((new Pickaxes($player))->Gold());
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                    $player->sendMessage(TF::RED . "- $2,000");
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Insufficient funds");
                }
            }
            # golden sword
            if($itemClicked->getId() === ItemIds::GOLDEN_SWORD) {
                if($money >= 2000) {
                    DataManager::takeData($player, "Players", "Money", 2000);
                    $player->getInventory()->addItem(VanillaItems::GOLDEN_SWORD());
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                    $player->sendMessage(TF::RED . "- $2,000");
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Insufficient funds");
                }
            }
            # golden axe
            if($itemClicked->getId() === ItemIds::GOLDEN_AXE) {
                if($money >= 2000) {
                    DataManager::takeData($player, "Players", "Money", 2000);
                    $player->getInventory()->addItem(VanillaItems::GOLDEN_AXE());
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                    $player->sendMessage(TF::RED . "- $2,000");
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Insufficient funds");
                }
            }


            # iron helmet
            if($itemClicked->getId() === ItemIds::IRON_HELMET) {
                if($money >= 100000) {
                    DataManager::takeData($player, "Players", "Money", 100000);
                    $player->getInventory()->addItem(VanillaItems::IRON_HELMET());
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                    $player->sendMessage(TF::RED . "- $100,000");
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Insufficient funds");
                }
            }
            # iron chestplate
            if($itemClicked->getId() === ItemIds::IRON_CHESTPLATE) {
                if($money >= 100000) {
                    DataManager::takeData($player, "Players", "Money", 100000);
                    $player->getInventory()->addItem(VanillaItems::IRON_CHESTPLATE());
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                    $player->sendMessage(TF::RED . "- $100,000");
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Insufficient funds");
                }
            }
            # iron leggings
            if($itemClicked->getId() === ItemIds::IRON_LEGGINGS) {
                if($money >= 100000) {
                    DataManager::takeData($player, "Players", "Money", 100000);
                    $player->getInventory()->addItem(VanillaItems::IRON_LEGGINGS());
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                    $player->sendMessage(TF::RED . "- $100,000");
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Insufficient funds");
                }
            }
            # iron boots
            if($itemClicked->getId() === ItemIds::IRON_BOOTS) {
                if($money >= 100000) {
                    DataManager::takeData($player, "Players", "Money", 100000);
                    $player->getInventory()->addItem(VanillaItems::IRON_BOOTS());
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                    $player->sendMessage(TF::RED . "- $100,000");
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Insufficient funds");
                }
            }
            # iron pickaxe
            if($itemClicked->getId() === ItemIds::IRON_PICKAXE) {
                if($money >= 200000) {
                    DataManager::takeData($player, "Players", "Money", 200000);
                    $player->getInventory()->addItem((new Pickaxes($player))->Iron());
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                    $player->sendMessage(TF::RED . "- $200,000");
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Insufficient funds");
                }
            }
            # iron sword
            if($itemClicked->getId() === ItemIds::IRON_SWORD) {
                if($money >= 200000) {
                    DataManager::takeData($player, "Players", "Money", 200000);
                    $player->getInventory()->addItem(VanillaItems::IRON_SWORD());
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                    $player->sendMessage(TF::RED . "- $200,000");
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Insufficient funds");
                }
            }
            # iron axe
            if($itemClicked->getId() === ItemIds::IRON_AXE) {
                if($money >= 200000) {
                    DataManager::takeData($player, "Players", "Money", 200000);
                    $player->getInventory()->addItem(VanillaItems::IRON_AXE());
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                    $player->sendMessage(TF::RED . "- $200,000");
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Insufficient funds");
                }
            }


            # diamond helmet
            if($itemClicked->getId() === ItemIds::DIAMOND_HELMET) {
                if($money >= 1000000) {
                    DataManager::takeData($player, "Players", "Money", 1000000);
                    $player->getInventory()->addItem(VanillaItems::DIAMOND_HELMET());
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                    $player->sendMessage(TF::RED . "- $1,000,000");
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Insufficient funds");
                }
            }
            # diamond chestplate
            if($itemClicked->getId() === ItemIds::DIAMOND_CHESTPLATE) {
                if($money >= 1000000) {
                    DataManager::takeData($player, "Players", "Money", 1000000);
                    $player->getInventory()->addItem(VanillaItems::DIAMOND_CHESTPLATE());
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                    $player->sendMessage(TF::RED . "- $1,000,000");
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Insufficient funds");
                }
            }
            # diamond leggings
            if($itemClicked->getId() === ItemIds::DIAMOND_LEGGINGS) {
                if($money >= 1000000) {
                    DataManager::takeData($player, "Players", "Money", 1000000);
                    $player->getInventory()->addItem(VanillaItems::DIAMOND_LEGGINGS());
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                    $player->sendMessage(TF::RED . "- $1,000,000");
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Insufficient funds");
                }
            }
            # diamond boots
            if($itemClicked->getId() === ItemIds::DIAMOND_BLOCK) {
                if($money >= 1000000) {
                    DataManager::takeData($player, "Players", "Money", 1000000);
                    $player->getInventory()->addItem(VanillaItems::DIAMOND_BOOTS());
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                    $player->sendMessage(TF::RED . "- $1,000,000");
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Insufficient funds");
                }
            }
            # diamond pickaxe
            if($itemClicked->getId() === ItemIds::DIAMOND_PICKAXE) {
                if($money >= 2000000) {
                    DataManager::takeData($player, "Players", "Money", 2000000);
                    $player->getInventory()->addItem((new Pickaxes($player))->Diamond());
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                    $player->sendMessage(TF::RED . "- $2,000,000");
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Insufficient funds");
                }
            }
            # diamond sword
            if($itemClicked->getId() === ItemIds::DIAMOND_SWORD) {
                if($money >= 2000000) {
                    DataManager::takeData($player, "Players", "Money", 2000000);
                    $player->getInventory()->addItem(VanillaItems::DIAMOND_SWORD());
                    $player->sendMessage(TF::RED . "- $2,000,000");
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    $player->sendMessage(TF::RED . "Insufficient funds");
                }
            }
            # diamond axe
            if($itemClicked->getId() === ItemIds::DIAMOND_AXE) {
                if($money >= 2000000) {
                    DataManager::takeData($player, "Players", "Money", 2000000);
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

        $menu->send($sender);
    }

    # blacksmith items
    # row 1
    public function bow(): Item {
        $item = StringToItemParser::getInstance()->parse("bow");
        $item->setLore([
            "§r",
            TF::GREEN . "$5,000",
            "§r",
            TF::GRAY . "Click to purchase 1"
        ]);

        return $item;
    }
    public function arrow(): Item {
        $item = StringToItemParser::getInstance()->parse("arrow");
        $item->setLore([
            "§r",
            TF::GREEN . "$100",
            "§r",
            TF::GRAY . "Click to purchase 1"
        ]);

        return $item;
    }
    public function wooden_pickaxe(): Item {
        $item = StringToItemParser::getInstance()->parse("wooden_pickaxe");
        $item->setLore([
            "§r",
            TF::GREEN . "$20",
            "§r",
            TF::GRAY . "Click to purchase 1"
        ]);

        return $item;
    }
    public function wooden_sword(): Item {
        $item = StringToItemParser::getInstance()->parse("wooden_sword");
        $item->setLore([
            "§r",
            TF::GREEN . "$100",
            "§r",
            TF::GRAY . "Click to purchase 1"
        ]);

        return $item;
    }
    public function wooden_axe(): Item {
        $item = StringToItemParser::getInstance()->parse("wooden_axe");
        $item->setLore([
            "§r",
            TF::GREEN . "$100",
            "§r",
            TF::GRAY . "Click to purchase 1"
        ]);

        return $item;
    }
    # row 2
    public function chain_helmet(): Item {
        $item = StringToItemParser::getInstance()->parse("chain_helmet");
        $item->setLore([
            "§r",
            TF::GREEN . "$100",
            "§r",
            TF::GRAY . "Click to purchase 1"
        ]);

        return $item;
    }
    public function chain_chestplate(): Item {
        $item = StringToItemParser::getInstance()->parse("chain_chestplate");
        $item->setLore([
            "§r",
            TF::GREEN . "$100",
            "§r",
            TF::GRAY . "Click to purchase 1"
        ]);

        return $item;
    }
    public function chain_leggings(): Item {
        $item = StringToItemParser::getInstance()->parse("chain_leggings");
        $item->setLore([
            "§r",
            TF::GREEN . "$100",
            "§r",
            TF::GRAY . "Click to purchase 1"
        ]);

        return $item;
    }
    public function chain_boots(): Item {
        $item = StringToItemParser::getInstance()->parse("chain_boots");
        $item->setLore([
            "§r",
            TF::GREEN . "$100",
            "§r",
            TF::GRAY . "Click to purchase 1"
        ]);

        return $item;
    }
    public function stone_pickaxe(): Item {
        $item = StringToItemParser::getInstance()->parse("stone_pickaxe");
        $item->setLore([
            "§r",
            TF::GREEN . "$200",
            "§r",
            TF::GRAY . "Click to purchase 1"
        ]);

        return $item;
    }
    public function stone_Sword(): Item {
        $item = StringToItemParser::getInstance()->parse("stone_sword");
        $item->setLore([
            "§r",
            TF::GREEN . "$500",
            "§r",
            TF::GRAY . "Click to purchase 1"
        ]);

        return $item;
    }
    public function stone_axe(): Item {
        $item = StringToItemParser::getInstance()->parse("stone_axe");
        $item->setLore([
            "§r",
            TF::GREEN . "$500",
            "§r",
            TF::GRAY . "Click to purchase 1"
        ]);

        return $item;
    }
    # row 3
    public function gold_helmet(): Item {
        $item = StringToItemParser::getInstance()->parse("golden_helmet");
        $item->setLore([
            "§r",
            TF::GREEN . "$1,000",
            "§r",
            TF::GRAY . "Click to purchase 1"
        ]);

        return $item;
    }
    public function gold_chestplate(): Item {
        $item = StringToItemParser::getInstance()->parse("golden_chestplate");
        $item->setLore([
            "§r",
            TF::GREEN . "$1,000",
            "§r",
            TF::GRAY . "Click to purchase 1"
        ]);

        return $item;
    }
    public function gold_leggings(): Item {
        $item = StringToItemParser::getInstance()->parse("golden_leggings");
        $item->setLore([
            "§r",
            TF::GREEN . "$1,000",
            "§r",
            TF::GRAY . "Click to purchase 1"
        ]);

        return $item;
    }
    public function gold_boots(): Item {
        $item = StringToItemParser::getInstance()->parse("golden_boots");
        $item->setLore([
            "§r",
            TF::GREEN . "$1,000",
            "§r",
            TF::GRAY . "Click to purchase 1"
        ]);

        return $item;
    }
    public function gold_pickaxe(): Item {
        $item = StringToItemParser::getInstance()->parse("golden_pickaxe");
        $item->setLore([
            "§r",
            TF::GREEN . "$2,000",
            "§r",
            TF::GRAY . "Click to purchase 1"
        ]);

        return $item;
    }
    public function gold_sword(): Item {
        $item = StringToItemParser::getInstance()->parse("golden_sword");
        $item->setLore([
            "§r",
            TF::GREEN . "$2,000",
            "§r",
            TF::GRAY . "Click to purchase 1"
        ]);

        return $item;
    }
    public function gold_axe(): Item {
        $item = StringToItemParser::getInstance()->parse("golden_axe");
        $item->setLore([
            "§r",
            TF::GREEN . "$2,000",
            "§r",
            TF::GRAY . "Click to purchase 1"
        ]);

        return $item;
    }
    # row 4
    public function iron_helmet(): Item {
        $item = StringToItemParser::getInstance()->parse("iron_helmet");
        $item->setLore([
            "§r",
            TF::GREEN . "$100,000",
            "§r",
            TF::GRAY . "Click to purchase 1"
        ]);

        return $item;
    }
    public function iron_chestplate(): Item {
        $item = StringToItemParser::getInstance()->parse("iron_chestplate");
        $item->setLore([
            "§r",
            TF::GREEN . "$100,000",
            "§r",
            TF::GRAY . "Click to purchase 1"
        ]);

        return $item;
    }
    public function iron_leggings(): Item {
        $item = StringToItemParser::getInstance()->parse("iron_leggings");
        $item->setLore([
            "§r",
            TF::GREEN . "$100,000",
            "§r",
            TF::GRAY . "Click to purchase 1"
        ]);

        return $item;
    }
    public function iron_boots(): Item {
        $item = StringToItemParser::getInstance()->parse("iron_boots");
        $item->setLore([
            "§r",
            TF::GREEN . "$100,000",
            "§r",
            TF::GRAY . "Click to purchase 1"
        ]);

        return $item;
    }
    public function iron_pickaxe(): Item {
        $item = StringToItemParser::getInstance()->parse("iron_pickaxe");
        $item->setLore([
            "§r",
            TF::GREEN . "$200,000",
            "§r",
            TF::GRAY . "Click to purchase 1"
        ]);

        return $item;
    }
    public function iron_sword(): Item {
        $item = StringToItemParser::getInstance()->parse("iron_sword");
        $item->setLore([
            "§r",
            TF::GREEN . "$200,000",
            "§r",
            TF::GRAY . "Click to purchase 1"
        ]);

        return $item;
    }
    public function iron_axe(): Item {
        $item = StringToItemParser::getInstance()->parse("iron_axe");
        $item->setLore([
            "§r",
            TF::GREEN . "$200,000",
            "§r",
            TF::GRAY . "Click to purchase 1"
        ]);

        return $item;
    }
    # row 5
    public function diamond_helmet(): Item {
        $item = StringToItemParser::getInstance()->parse("diamond_helmet");
        $item->setLore([
            "§r",
            TF::GREEN . "$1,000,000",
            "§r",
            TF::GRAY . "Click to purchase 1"
        ]);

        return $item;
    }
    public function diamond_chestplate(): Item {
        $item = StringToItemParser::getInstance()->parse("diamond_chestplate");
        $item->setLore([
            "§r",
            TF::GREEN . "$1,000,000",
            "§r",
            TF::GRAY . "Click to purchase 1"
        ]);

        return $item;
    }
    public function diamond_leggings(): Item {
        $item = StringToItemParser::getInstance()->parse("diamond_leggings");
        $item->setLore([
            "§r",
            TF::GREEN . "$1,000,000",
            "§r",
            TF::GRAY . "Click to purchase 1"
        ]);

        return $item;
    }
    public function diamond_boots(): Item {
        $item = StringToItemParser::getInstance()->parse("diamond_boots");
        $item->setLore([
            "§r",
            TF::GREEN . "$1,000,000",
            "§r",
            TF::GRAY . "Click to purchase 1"
        ]);

        return $item;
    }
    public function diamond_pickaxe(): Item {
        $item = StringToItemParser::getInstance()->parse("diamond_pickaxe");
        $item->setLore([
            "§r",
            TF::GREEN . "$2,000,000",
            "§r",
            TF::GRAY . "Click to purchase 1"
        ]);

        return $item;
    }
    public function diamond_sword(): Item {
        $item = StringToItemParser::getInstance()->parse("diamond_sword");
        $item->setLore([
            "§r",
            TF::GREEN . "$2,000,000",
            "§r",
            TF::GRAY . "Click to purchase 1"
        ]);

        return $item;
    }
    public function diamond_axe(): Item {
        $item = StringToItemParser::getInstance()->parse("diamond_axe");
        $item->setLore([
            "§r",
            TF::GREEN . "$2,000,000",
            "§r",
            TF::GRAY . "Click to purchase 1"
        ]);

        return $item;
    }

    # chef
    public function Chef($player): void {
        $menu = InvMenu::create(InvMenuTypeIds::TYPE_CHEST);
        $menu->setName(TF::BOLD . "Food");
        $menu->setListener(InvMenu::readonly(function (DeterministicInvMenuTransaction $transaction) {

            $player = $transaction->getPlayer();
            $itemClicked = $transaction->getItemClicked();
            $playerMoney = DataManager::getData($player, "Players", "Money");
            switch($itemClicked->getId()) {
                case ItemIds::COOKIE:
                    if($playerMoney >= 0.05) {
                        if($player->getInventory()->canAddItem(VanillaItems::COOKIE())) {
                            $player->getInventory()->addItem(VanillaItems::COOKIE());
                            $player->sendMessage(TF::RED . "- $0.05");
                            DataManager::takeData($player, "Players", "Money", 0.05);
                            $player->broadcastSound(new XpCollectSound(), [$player]);
                        } else {
                            $player->sendMessage(TF::RED . "Your inventory is full");
                            $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                        }
                    } else {
                        $player->sendMessage(TF::RED . "Insufficient funds");
                        $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    }
                    break;
                case ItemIds::APPLE:
                    if($playerMoney >= 0.25) {
                        if($player->getInventory()->canAddItem(VanillaItems::APPLE())) {
                            $player->getInventory()->addItem(VanillaItems::APPLE());
                            $player->sendMessage(TF::RED . "- $0.25");
                            DataManager::takeData($player, "Players", "Money", 0.25);
                            $player->broadcastSound(new XpCollectSound(), [$player]);
                        } else {
                            $player->sendMessage(TF::RED . "Your inventory is full");
                            $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                        }
                    } else {
                        $player->sendMessage(TF::RED . "Insufficient funds");
                        $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    }
                    break;
                case ItemIds::PUMPKIN_PIE:
                    if($playerMoney >= 1) {
                        if($player->getInventory()->canAddItem(VanillaItems::PUMPKIN_PIE())) {
                            $player->getInventory()->addItem(VanillaItems::PUMPKIN_PIE());
                            $player->sendMessage(TF::RED . "- $1");
                            DataManager::takeData($player, "Players", "Money", 1);
                            $player->broadcastSound(new XpCollectSound(), [$player]);
                        } else {
                            $player->sendMessage(TF::RED . "Your inventory is full");
                            $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                        }
                    } else {
                        $player->sendMessage(TF::RED . "Insufficient funds");
                        $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    }
                    break;
                case ItemIds::BREAD:
                    if($playerMoney >= 0.25) {
                        if($player->getInventory()->canAddItem(VanillaItems::BREAD())) {
                            $player->getInventory()->addItem(VanillaItems::BREAD());
                            $player->sendMessage(TF::RED . "- $2.50");
                            DataManager::takeData($player, "Players", "Money", 2.50);
                            $player->broadcastSound(new XpCollectSound(), [$player]);
                        } else {
                            $player->sendMessage(TF::RED . "Your inventory is full");
                            $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                        }
                    } else {
                        $player->sendMessage(TF::RED . "Insufficient funds");
                        $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    }
                    break;
                case ItemIds::COOKED_CHICKEN:
                    if($playerMoney >= 5) {
                        if($player->getInventory()->canAddItem(VanillaItems::COOKED_CHICKEN())) {
                            $player->getInventory()->addItem(VanillaItems::COOKED_CHICKEN());
                            $player->sendMessage(TF::RED . "- $5");
                            DataManager::takeData($player, "Players", "Money", 5);
                            $player->broadcastSound(new XpCollectSound(), [$player]);
                        } else {
                            $player->sendMessage(TF::RED . "Your inventory is full");
                            $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                        }
                    } else {
                        $player->sendMessage(TF::RED . "Insufficient funds");
                        $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    }
                    break;
                case ItemIds::STEAK:
                    if($playerMoney >= 10) {
                        if($player->getInventory()->canAddItem(VanillaItems::STEAK())) {
                            $player->getInventory()->addItem(VanillaItems::STEAK());
                            $player->sendMessage(TF::RED . "- $10");
                            DataManager::takeData($player, "Players", "Money", 10);
                            $player->broadcastSound(new XpCollectSound(), [$player]);
                        } else {
                            $player->sendMessage(TF::RED . "Your inventory is full");
                            $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                        }
                    } else {
                        $player->sendMessage(TF::RED . "Insufficient funds");
                        $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    }
                    break;
                case ItemIds::GOLDEN_CARROT:
                    if($playerMoney >= 25) {
                        if($player->getInventory()->canAddItem(VanillaItems::GOLDEN_CARROT())) {
                            $player->getInventory()->addItem(VanillaItems::GOLDEN_CARROT());
                            $player->sendMessage(TF::RED . "- $25");
                            DataManager::takeData($player, "Players", "Money", 25);
                            $player->broadcastSound(new XpCollectSound(), [$player]);
                        } else {
                            $player->sendMessage(TF::RED . "Your inventory is full");
                            $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                        }
                    } else {
                        $player->sendMessage(TF::RED . "Insufficient funds");
                        $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    }
                    break;
            }
        }));
        $inventory = $menu->getInventory();
        $inventory->setItem(10, $this->cookie());
        $inventory->setItem(11, $this->apple());
        $inventory->setItem(12, $this->pumpkinPie());
        $inventory->setItem(13, $this->bread());
        $inventory->setItem(14, $this->cookedChicken());
        $inventory->setItem(15, $this->steak());
        $inventory->setItem(16, $this->goldenCarrot());
        $menu->send($player);
    }
    # chef items
    public function cookie(): Item {
        $item = StringToItemParser::getInstance()->parse("cookie");
        $lore = [
            "§r",
            TF::GREEN . "$0.05",
            "",
            TF::GRAY . "Click to buy 1"
        ];
        $item->setLore($lore);

        return $item;
    }
    public function apple(): Item {
        $item = StringToItemParser::getInstance()->parse("apple");
        $lore = [
            "§r",
            TF::GREEN . "$0.25",
            "",
            TF::GRAY . "Click to buy 1"
        ];
        $item->setLore($lore);

        return $item;
    }
    public function pumpkinPie(): Item {
        $item = StringToItemParser::getInstance()->parse("pumpkin_pie");
        $lore = [
            "§r",
            TF::GREEN . "$1",
            "",
            TF::GRAY . "Click to buy 1"
        ];
        $item->setLore($lore);

        return $item;
    }
    public function bread(): Item {
        $item = StringToItemParser::getInstance()->parse("bread");
        $lore = [
            "§r",
            TF::GREEN . "$2.50",
            "",
            TF::GRAY . "Click to buy 1"
        ];
        $item->setLore($lore);

        return $item;
    }
    public function cookedChicken(): Item {
        $item = StringToItemParser::getInstance()->parse("cooked_chicken");
        $lore = [
            "§r",
            TF::GREEN . "$5",
            "",
            TF::GRAY . "Click to buy 1"
        ];
        $item->setLore($lore);

        return $item;
    }
    public function steak(): Item {
        $item = StringToItemParser::getInstance()->parse("cooked_beef");
        $lore = [
            "§r",
            TF::GREEN . "$10",
            "",
            TF::GRAY . "Click to buy 1"
        ];
        $item->setLore($lore);

        return $item;
    }
    public function goldenCarrot(): Item {
        $item = StringToItemParser::getInstance()->parse("golden_carrot");
        $lore = [
            "§r",
            TF::GREEN . "$25",
            "",
            TF::GRAY . "Click to buy 1"
        ];
        $item->setLore($lore);

        return $item;
    }
}