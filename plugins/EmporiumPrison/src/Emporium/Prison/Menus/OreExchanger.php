<?php

namespace Emporium\Prison\Menus;

use Emporium\Prison\Managers\misc\Translator;
use EmporiumData\DataManager;

use muqsit\invmenu\InvMenu;
use muqsit\invmenu\transaction\InvMenuTransaction;
use muqsit\invmenu\transaction\InvMenuTransactionResult;
use muqsit\invmenu\type\InvMenuTypeIds;

use pocketmine\block\VanillaBlocks;
use pocketmine\item\Item;
use pocketmine\item\ItemIds;
use pocketmine\item\VanillaItems;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;
use pocketmine\world\sound\ItemFrameAddItemSound;
use pocketmine\world\sound\XpCollectSound;

use Tetro\EmporiumTutorial\EmporiumTutorial;

class OreExchanger {

    public function Inventory(Player $player): void {

        $menu = InvMenu::create(InvMenuTypeIds::TYPE_CHEST);
        $menu->setName("Ore Exchanger");
        $menu->setListener(function (InvMenuTransaction $transaction) use ($player): InvMenuTransactionResult {
            $out = $transaction->getOut();

            # coal ore
            if($out->getId() == ItemIds::COAL_ORE) {
                $sellPrice = 0;
                # get all in inventory
                # check if player has that block
                if($player->getInventory()->contains(VanillaBlocks::COAL_ORE()->asItem())) {
                    # calculate sell price
                    foreach ($player->getInventory()->getContents() as $item) {
                        if($item->getId() == ItemIds::COAL_ORE) {
                            $count = $item->getCount();
                            $sellPrice = 0.06 * $count;
                            $player->getInventory()->remove($item);
                        }
                    }
                    # give player money
                    DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.money") + $sellPrice);
                    # send confirmation message
                    $player->sendMessage(TF::GREEN . "+$" . Translator::shortNumber($sellPrice));
                    # play sound
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                } else {
                    $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You do not have any Coal Ores in your inventory.");
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                }
                $this->checkTutorialProgress($player);
                return $transaction->discard();
            }
            # coal
            if($out->getId() == ItemIds::COAL) {
                $sellPrice = 0;
                # get all in inventory
                # check if player has that block
                if($player->getInventory()->contains(VanillaItems::COAL())) {
                    # calculate sell price
                    foreach ($player->getInventory()->getContents() as $item) {
                        if($item->getId() == ItemIds::COAL) {
                            $count = $item->getCount();
                            $sellPrice = 0.32 * $count;
                            $player->getInventory()->remove($item);
                        }
                    }
                    # give player money
                    DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.money") + $sellPrice);
                    # send confirmation message
                    $player->sendMessage(TF::GREEN . "+$" . Translator::shortNumber($sellPrice));
                    # play sound
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                } else {
                    $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You do not have any Coal in your inventory.");
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                }
                $this->checkTutorialProgress($player);
                return $transaction->discard();
            }
            # coal block
            if($out->getId() == ItemIds::COAL_BLOCK) {
                $sellPrice = 0;
                # get all in inventory
                # check if player has that block
                if($player->getInventory()->contains(VanillaBlocks::COAL()->asItem())) {
                    # calculate sell price
                    foreach ($player->getInventory()->getContents() as $item) {
                        if($item->getId() == ItemIds::COAL_BLOCK) {
                            $count = $item->getCount();
                            $sellPrice = 1.21 * $count;
                            $player->getInventory()->remove($item);
                        }
                    }
                    # give player money
                    DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.money") + $sellPrice);
                    # send confirmation message
                    $player->sendMessage(TF::GREEN . "+$" . Translator::shortNumber($sellPrice));
                    # play sound
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                } else {
                    $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You do not have any Coal Blocks in your inventory.");
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                }
                $this->checkTutorialProgress($player);
                return $transaction->discard();
            }

            # iron ore
            if($out->getId() == ItemIds::IRON_ORE) {
                $sellPrice = 0;
                # get all in inventory
                # check if player has that block
                if($player->getInventory()->contains(VanillaBlocks::IRON_ORE()->asItem())) {
                    # calculate sell price
                    foreach ($player->getInventory()->getContents() as $item) {
                        if($item->getId() == ItemIds::IRON_ORE) {
                            $count = $item->getCount();
                            $sellPrice = 0.20 * $count;
                            $player->getInventory()->remove($item);
                        }
                    }
                    # give player money
                    DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.money") + $sellPrice);
                    # send confirmation message
                    $player->sendMessage(TF::GREEN . "+$" . Translator::shortNumber($sellPrice));
                    # play sound
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                } else {
                    $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You do not have any Iron Ores in your inventory.");
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                }
                $this->checkTutorialProgress($player);
                return $transaction->discard();
            }
            # iron
            if($out->getId() == ItemIds::IRON_INGOT) {
                $sellPrice = 0;
                # get all in inventory
                # check if player has that block
                if($player->getInventory()->contains(VanillaItems::IRON_INGOT())) {
                    # calculate sell price
                    foreach ($player->getInventory()->getContents() as $item) {
                        if($item->getId() == ItemIds::IRON_INGOT) {
                            $count = $item->getCount();
                            $sellPrice = 1.02 * $count;
                            $player->getInventory()->remove($item);
                        }
                    }
                    # give player money
                    DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.money") + $sellPrice);
                    # send confirmation message
                    $player->sendMessage(TF::GREEN . "+$" . Translator::shortNumber($sellPrice));
                    # play sound
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                } else {
                    $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You do not have any Iron Ingot in your inventory.");
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                }
                $this->checkTutorialProgress($player);
                return $transaction->discard();
            }
            # iron block
            if($out->getId() == ItemIds::IRON_BLOCK) {
                $sellPrice = 0;
                # get all in inventory
                # check if player has that block
                if($player->getInventory()->contains(VanillaBlocks::IRON()->asItem())) {
                    # calculate sell price
                    foreach ($player->getInventory()->getContents() as $item) {
                        if($item->getId() == ItemIds::IRON_BLOCK) {
                            $count = $item->getCount();
                            $sellPrice = 4.08 * $count;
                            $player->getInventory()->remove($item);
                        }
                    }
                    # give player money
                    DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.money") + $sellPrice);
                    # send confirmation message
                    $player->sendMessage(TF::GREEN . "+$" . Translator::shortNumber($sellPrice));
                    # play sound
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                } else {
                    $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You do not have any Iron Blocks in your inventory.");
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                }
                $this->checkTutorialProgress($player);
                return $transaction->discard();
            }

            # lapis ore
            if($out->getId() == ItemIds::LAPIS_ORE) {
                $sellPrice = 0;
                # get all in inventory
                # check if player has that block
                if($player->getInventory()->contains(VanillaBlocks::LAPIS_LAZULI_ORE()->asItem())) {
                    # calculate sell price
                    foreach ($player->getInventory()->getContents() as $item) {
                        if($item->getId() == ItemIds::LAPIS_ORE) {
                            $count = $item->getCount();
                            $sellPrice = 0.52 * $count;
                            $player->getInventory()->remove($item);
                        }
                    }
                    # give player money
                    DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.money") + $sellPrice);
                    # send confirmation message
                    $player->sendMessage(TF::GREEN . "+$" . Translator::shortNumber($sellPrice));
                    # play sound
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                } else {
                    $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You do not have any Lapis Ores in your inventory.");
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                }
                $this->checkTutorialProgress($player);
                return $transaction->discard();
            }
            # lapis
            if($out->getId() == ItemIds::DYE) {
                if($out->getMeta() == 4) {
                    $sellPrice = 0;
                    # get all in inventory
                    # check if player has that block
                    if($player->getInventory()->contains(VanillaItems::LAPIS_LAZULI())) {
                        # calculate sell price
                        foreach ($player->getInventory()->getContents() as $item) {
                            if($item->getId() == ItemIds::DYE) {
                                if($out->getMeta() == 4) {
                                    $count = $item->getCount();
                                    $sellPrice = 2.70 * $count;
                                    $player->getInventory()->remove($item);
                                }
                            }
                        }
                        # give player money
                        DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.money") + $sellPrice);
                        # send confirmation message
                        $player->sendMessage(TF::GREEN . "+$" . Translator::shortNumber($sellPrice));
                        # play sound
                        $player->broadcastSound(new XpCollectSound(), [$player]);
                    } else {
                        $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You do not have any Lapis in your inventory.");
                        $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    }
                }
                return $transaction->discard();
            }
            # lapis block
            if($out->getId() == ItemIds::LAPIS_BLOCK) {
                $sellPrice = 0;
                # get all in inventory
                # check if player has that block
                if($player->getInventory()->contains(VanillaBlocks::LAPIS_LAZULI()->asItem())) {
                    # calculate sell price
                    foreach ($player->getInventory()->getContents() as $item) {
                        if($item->getId() == ItemIds::LAPIS_BLOCK) {
                            $count = $item->getCount();
                            $sellPrice = 10.80 * $count;
                            $player->getInventory()->remove($item);
                        }
                    }
                    # give player money
                    DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.money") + $sellPrice);
                    # send confirmation message
                    $player->sendMessage(TF::GREEN . "+$" . Translator::shortNumber($sellPrice));
                    # play sound
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                } else {
                    $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You do not have any Lapis Blocks in your inventory.");
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                }
                $this->checkTutorialProgress($player);
                return $transaction->discard();
            }

            # redstone ore
            if($out->getId() == ItemIds::REDSTONE_ORE) {
                $sellPrice = 0;
                # get all in inventory
                # check if player has that block
                if($player->getInventory()->contains(VanillaBlocks::REDSTONE_ORE()->asItem())) {
                    # calculate sell price
                    foreach ($player->getInventory()->getContents() as $item) {
                        if($item->getId() == ItemIds::REDSTONE_ORE) {
                            $count = $item->getCount();
                            $sellPrice = 1.57 * $count;
                            $player->getInventory()->remove($item);
                        }
                    }
                    # give player money
                    DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.money") + $sellPrice);
                    # send confirmation message
                    $player->sendMessage(TF::GREEN . "+$" . Translator::shortNumber($sellPrice));
                    # play sound
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                } else {
                    $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You do not have any Redstone Ores in your inventory.");
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                }
                $this->checkTutorialProgress($player);
                return $transaction->discard();
            }
            # redstone
            if($out->getId() == ItemIds::REDSTONE) {
                $sellPrice = 0;
                # get all in inventory
                # check if player has that block
                if($player->getInventory()->contains(VanillaItems::REDSTONE_DUST())) {
                    # calculate sell price
                    foreach ($player->getInventory()->getContents() as $item) {
                        if($item->getId() == ItemIds::REDSTONE) {
                            $count = $item->getCount();
                            $sellPrice = 8.29 * $count;
                            $player->getInventory()->remove($item);
                        }
                    }
                    # give player money
                    DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.money") + $sellPrice);
                    # send confirmation message
                    $player->sendMessage(TF::GREEN . "+$" . Translator::shortNumber($sellPrice));
                    # play sound
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                } else {
                    $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You do not have any Redstone in your inventory.");
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                }
                $this->checkTutorialProgress($player);
                return $transaction->discard();
            }
            # redstone block
            if($out->getId() == ItemIds::REDSTONE_BLOCK) {
                $sellPrice = 0;
                # get all in inventory
                # check if player has that block
                if($player->getInventory()->contains(VanillaBlocks::REDSTONE()->asItem())) {
                    # calculate sell price
                    foreach ($player->getInventory()->getContents() as $item) {
                        if($item->getId() == ItemIds::REDSTONE_BLOCK) {
                            $count = $item->getCount();
                            $sellPrice = 33.16 * $count;
                            $player->getInventory()->remove($item);
                        }
                    }
                    # give player money
                    DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.money") + $sellPrice);
                    # send confirmation message
                    $player->sendMessage(TF::GREEN . "+$" . Translator::shortNumber($sellPrice));
                    # play sound
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                } else {
                    $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You do not have any Redstone Blocks in your inventory.");
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                }
                $this->checkTutorialProgress($player);
                return $transaction->discard();
            }

            # gold ore
            if($out->getId() == ItemIds::GOLD_ORE) {
                $sellPrice = 0;
                # get all in inventory
                # check if player has that block
                if($player->getInventory()->contains(VanillaBlocks::GOLD_ORE()->asItem())) {
                    # calculate sell price
                    foreach ($player->getInventory()->getContents() as $item) {
                        if($item->getId() == ItemIds::GOLD_ORE) {
                            $count = $item->getCount();
                            $sellPrice = 4.86 * $count;
                            $player->getInventory()->remove($item);
                        }
                    }
                    # give player money
                    DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.money") + $sellPrice);
                    # send confirmation message
                    $player->sendMessage(TF::GREEN . "+$" . Translator::shortNumber($sellPrice));
                    # play sound
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                } else {
                    $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You do not have any Gold Ores in your inventory.");
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                }
                $this->checkTutorialProgress($player);
                return $transaction->discard();
            }
            # gold
            if($out->getId() == ItemIds::GOLD_INGOT) {
                $sellPrice = 0;
                # get all in inventory
                # check if player has that block
                if($player->getInventory()->contains(VanillaItems::GOLD_INGOT())) {
                    # calculate sell price
                    foreach ($player->getInventory()->getContents() as $item) {
                        if($item->getId() == ItemIds::GOLD_INGOT) {
                            $count = $item->getCount();
                            $sellPrice = 25.76 * $count;
                            $player->getInventory()->remove($item);
                        }
                    }
                    # give player money
                    DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.money") + $sellPrice);
                    # send confirmation message
                    $player->sendMessage(TF::GREEN . "+$" . Translator::shortNumber($sellPrice));
                    # play sound
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                } else {
                    $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You do not have any Gold Ingots in your inventory.");
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                }
                $this->checkTutorialProgress($player);
                return $transaction->discard();
            }
            # gold block
            if($out->getId() == ItemIds::GOLD_BLOCK) {
                $sellPrice = 0;
                # get all in inventory
                # check if player has that block
                if($player->getInventory()->contains(VanillaBlocks::GOLD()->asItem())) {
                    # calculate sell price
                    foreach ($player->getInventory()->getContents() as $item) {
                        if($item->getId() == ItemIds::GOLD_BLOCK) {
                            $count = $item->getCount();
                            $sellPrice = 103.04 * $count;
                            $player->getInventory()->remove($item);
                        }
                    }
                    # give player money
                    DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.money") + $sellPrice);
                    # send confirmation message
                    $player->sendMessage(TF::GREEN . "+$" . Translator::shortNumber($sellPrice));
                    # play sound
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                } else {
                    $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You do not have any Gold Blocks in your inventory.");
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                }
                $this->checkTutorialProgress($player);
                return $transaction->discard();
            }

            # diamond ore
            if($out->getId() == ItemIds::DIAMOND_ORE) {
                $sellPrice = 0;
                # get all in inventory
                # check if player has that block
                if($player->getInventory()->contains(VanillaBlocks::DIAMOND_ORE()->asItem())) {
                    # calculate sell price
                    foreach ($player->getInventory()->getContents() as $item) {
                        if($item->getId() == ItemIds::DIAMOND_ORE) {
                            $count = $item->getCount();
                            $sellPrice = 7.34 * $count;
                            $player->getInventory()->remove($item);
                        }
                    }
                    # give player money
                    DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.money") + $sellPrice);
                    # send confirmation message
                    $player->sendMessage(TF::GREEN . "+$" . Translator::shortNumber($sellPrice));
                    # play sound
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                } else {
                    $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You do not have any Diamond Ores in your inventory.");
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                }
                $this->checkTutorialProgress($player);
                return $transaction->discard();
            }
            # diamond
            if($out->getId() == ItemIds::DIAMOND) {
                $sellPrice = 0;
                # get all in inventory
                # check if player has that block
                if($player->getInventory()->contains(VanillaItems::DIAMOND())) {
                    # calculate sell price
                    foreach ($player->getInventory()->getContents() as $item) {
                        if($item->getId() == ItemIds::DIAMOND) {
                            $count = $item->getCount();
                            $sellPrice = 38.85 * $count;
                            $player->getInventory()->remove($item);
                        }
                    }
                    # give player money
                    DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.money") + $sellPrice);
                    # send confirmation message
                    $player->sendMessage(TF::GREEN . "+$" . Translator::shortNumber($sellPrice));
                    # play sound
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                } else {
                    $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You do not have any Diamonds in your inventory.");
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                }
                $this->checkTutorialProgress($player);
                return $transaction->discard();
            }
            # diamond block
            if($out->getId() == ItemIds::DIAMOND_BLOCK) {
                $sellPrice = 0;
                # get all in inventory
                # check if player has that block
                if($player->getInventory()->contains(VanillaBlocks::DIAMOND()->asItem())) {
                    # calculate sell price
                    foreach ($player->getInventory()->getContents() as $item) {
                        if($item->getId() == ItemIds::DIAMOND_BLOCK) {
                            $count = $item->getCount();
                            $sellPrice = 155.40 * $count;
                            $player->getInventory()->remove($item);
                        }
                    }
                    # give player money
                    DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.money") + $sellPrice);
                    # send confirmation message
                    $player->sendMessage(TF::GREEN . "+$" . Translator::shortNumber($sellPrice));
                    # play sound
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                } else {
                    $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You do not have any Diamond Blocks in your inventory.");
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                }
                $this->checkTutorialProgress($player);
                return $transaction->discard();
            }

            # emerald ore
            if($out->getId() == ItemIds::EMERALD_ORE) {
                $sellPrice = 0;
                # get all in inventory
                # check if player has that block
                if($player->getInventory()->contains(VanillaBlocks::EMERALD_ORE()->asItem())) {
                    # calculate sell price
                    foreach ($player->getInventory()->getContents() as $item) {
                        if($item->getId() == ItemIds::EMERALD_ORE) {
                            $count = $item->getCount();
                            $sellPrice = 27.35 * $count;
                            $player->getInventory()->remove($item);
                        }
                    }
                    # give player money
                    DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.money") + $sellPrice);
                    # send confirmation message
                    $player->sendMessage(TF::GREEN . "+$" . Translator::shortNumber($sellPrice));
                    # play sound
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                } else {
                    $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You do not have any Emerald Ores in your inventory.");
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                }
                $this->checkTutorialProgress($player);
                return $transaction->discard();
            }
            # emerald
            if($out->getId() == ItemIds::EMERALD) {
                $sellPrice = 0;
                # get all in inventory
                # check if player has that block
                if($player->getInventory()->contains(VanillaItems::EMERALD())) {
                    # calculate sell price
                    foreach ($player->getInventory()->getContents() as $item) {
                        if($item->getId() == ItemIds::EMERALD) {
                            $count = $item->getCount();
                            $sellPrice = 144.92 * $count;
                            $player->getInventory()->remove($item);
                        }
                    }
                    # give player money
                    DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.money") + $sellPrice);
                    # send confirmation message
                    $player->sendMessage(TF::GREEN . "+$" . Translator::shortNumber($sellPrice));
                    # play sound
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                } else {
                    $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You do not have any Emeralds in your inventory.");
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                }
                $this->checkTutorialProgress($player);
                return $transaction->discard();
            }
            # emerald block
            if($out->getId() == ItemIds::EMERALD_BLOCK) {
                $sellPrice = 0;
                # get all in inventory
                # check if player has that block
                if($player->getInventory()->contains(VanillaBlocks::EMERALD()->asItem())) {
                    # calculate sell price
                    foreach ($player->getInventory()->getContents() as $item) {
                        if($item->getId() == ItemIds::EMERALD_BLOCK) {
                            $count = $item->getCount();
                            $sellPrice = 579.68 * $count;
                            $player->getInventory()->remove($item);
                        }
                    }
                    # give player money
                    DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.money") + $sellPrice);
                    # send confirmation message
                    $player->sendMessage(TF::GREEN . "+$" . Translator::shortNumber($sellPrice));
                    # play sound
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                } else {
                    $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You do not have any Emeralds Blocks in your inventory.");
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                }
                $this->checkTutorialProgress($player);
                return $transaction->discard();
            }

            return $transaction->discard();
        });
        $inventory = $menu->getInventory();
        $inventory->setItem(1, $this->coalOre());
        $inventory->setItem(2, $this->ironOre());
        $inventory->setItem(3, $this->lapisOre());
        $inventory->setItem(4, $this->redstoneOre());
        $inventory->setItem(5, $this->goldOre());
        $inventory->setItem(6, $this->diamondOre());
        $inventory->setItem(7, $this->emeraldOre());
        $inventory->setItem(10, $this->coal());
        $inventory->setItem(11, $this->iron());
        $inventory->setItem(12, $this->lapis());
        $inventory->setItem(13, $this->redstone());
        $inventory->setItem(14, $this->gold());
        $inventory->setItem(15, $this->diamond());
        $inventory->setItem(16, $this->emerald());
        $inventory->setItem(19, $this->coalBlock());
        $inventory->setItem(20, $this->ironBlock());
        $inventory->setItem(21, $this->lapisBlock());
        $inventory->setItem(22, $this->redstoneBlock());
        $inventory->setItem(23, $this->goldBlock());
        $inventory->setItem(24, $this->diamondBlock());
        $inventory->setItem(25, $this->emeraldBlock());

        $menu->send($player);
    }

    public function coalOre(): Item {
        $item = VanillaBlocks::COAL_ORE()->asItem();
        $item->setCustomName(TF::AQUA . "Coal Ore");
        $lore = [
            TF::EOL,
            TF::GREEN . "$" . TF::WHITE . "0.06"
        ];
        $item->setLore($lore);

        return $item;
    }
    public function coal(): Item {
        $item = VanillaItems::COAL();
        $item->setCustomName(TF::AQUA . "Coal");
        $lore = [
            TF::EOL,
            TF::GREEN . "$" . TF::WHITE . "0.32"
        ];
        $item->setLore($lore);

        return $item;
    }
    public function coalBlock(): Item {
        $item = VanillaBlocks::COAL()->asItem();
        $item->setCustomName(TF::AQUA . "Coal Block");
        $lore = [
            TF::EOL,
            TF::GREEN . "$" . TF::WHITE . "1.21"
        ];
        $item->setLore($lore);

        return $item;
    }

    public function ironOre(): Item {
        $item = VanillaBlocks::IRON_ORE()->asItem();
        $item->setCustomName(TF::AQUA . "Iron Ore");
        $lore = [
            TF::EOL,
            TF::GREEN . "$" . TF::WHITE . "0.20"
        ];
        $item->setLore($lore);

        return $item;
    }
    public function iron(): Item {
        $item = VanillaItems::IRON_INGOT();
        $item->setCustomName(TF::AQUA . "Iron Ingot");
        $lore = [
            TF::EOL,
            TF::GREEN . "$" . TF::WHITE . "1.02"
        ];
        $item->setLore($lore);

        return $item;
    }
    public function ironBlock(): Item {
        $item = VanillaBlocks::IRON()->asItem();
        $item->setCustomName(TF::AQUA . "Iron Block");
        $lore = [
            TF::EOL,
            TF::GREEN . "$" . TF::WHITE . "4.08"
        ];
        $item->setLore($lore);

        return $item;
    }

    public function lapisOre(): Item {
        $item = VanillaBlocks::LAPIS_LAZULI_ORE()->asItem();
        $item->setCustomName(TF::AQUA . "Lapis Ore");
        $lore = [
            TF::EOL,
            TF::GREEN . "$" . TF::WHITE . "0.52"
        ];
        $item->setLore($lore);

        return $item;
    }
    public function lapis(): Item {
        $item = VanillaItems::LAPIS_LAZULI();
        $item->setCustomName(TF::AQUA . "Lapis Ingot");
        $lore = [
            TF::EOL,
            TF::GREEN . "$" . TF::WHITE . "2.70"
        ];
        $item->setLore($lore);

        return $item;
    }
    public function lapisBlock(): Item {
        $item = VanillaBlocks::LAPIS_LAZULI()->asItem();
        $item->setCustomName(TF::AQUA . "Lapis Block");
        $lore = [
            TF::EOL,
            TF::GREEN . "$" . TF::WHITE . "10.80"
        ];
        $item->setLore($lore);

        return $item;
    }

    public function redstoneOre(): Item {
        $item = VanillaBlocks::REDSTONE_ORE()->asItem();
        $item->setCustomName(TF::AQUA . "Redstone Ore");
        $lore = [
            TF::EOL,
            TF::GREEN . "$" . TF::WHITE . "1.57"
        ];
        $item->setLore($lore);

        return $item;
    }
    public function redstone(): Item {
        $item = VanillaItems::REDSTONE_DUST();
        $item->setCustomName(TF::AQUA . "Redstone");
        $lore = [
            TF::EOL,
            TF::GREEN . "$" . TF::WHITE . "8.29"
        ];
        $item->setLore($lore);

        return $item;
    }
    public function redstoneBlock(): Item {
        $item = VanillaBlocks::REDSTONE()->asItem();
        $item->setCustomName(TF::AQUA . "Redstone Block");
        $lore = [
            TF::EOL,
            TF::GREEN . "$" . TF::WHITE . "33.16"
        ];
        $item->setLore($lore);

        return $item;
    }

    public function goldOre(): Item {
        $item = VanillaBlocks::GOLD_ORE()->asItem();
        $item->setCustomName(TF::AQUA . "Gold Ore");
        $lore = [
            TF::EOL,
            TF::GREEN . "$" . TF::WHITE . "4.86"
        ];
        $item->setLore($lore);

        return $item;
    }
    public function gold(): Item {
        $item = VanillaItems::GOLD_INGOT();
        $item->setCustomName(TF::AQUA . "Gold Ingot");
        $lore = [
            TF::EOL,
            TF::GREEN . "$" . TF::WHITE . "25.76"
        ];
        $item->setLore($lore);

        return $item;
    }
    public function goldBlock(): Item {
        $item = VanillaBlocks::GOLD()->asItem();
        $item->setCustomName(TF::AQUA . "Gold Block");
        $lore = [
            TF::EOL,
            TF::GREEN . "$" . TF::WHITE . "103.04"
        ];
        $item->setLore($lore);

        return $item;
    }

    public function diamondOre(): Item {
        $item = VanillaBlocks::DIAMOND_ORE()->asItem();
        $item->setCustomName(TF::AQUA . "Diamond Ore");
        $lore = [
            TF::EOL,
            TF::GREEN . "$" . TF::WHITE . "7.34"
        ];
        $item->setLore($lore);

        return $item;
    }
    public function diamond(): Item {
        $item = VanillaItems::DIAMOND();
        $item->setCustomName(TF::AQUA . "Diamond");
        $lore = [
            TF::EOL,
            TF::GREEN . "$" . TF::WHITE . "38.85"
        ];
        $item->setLore($lore);

        return $item;
    }
    public function diamondBlock(): Item {
        $item = VanillaBlocks::DIAMOND()->asItem();
        $item->setCustomName(TF::AQUA . "Diamond Block");
        $lore = [
            TF::EOL,
            TF::GREEN . "$" . TF::WHITE . "155.40"
        ];
        $item->setLore($lore);

        return $item;
    }

    public function emeraldOre(): Item {
        $item = VanillaBlocks::EMERALD_ORE()->asItem();
        $item->setCustomName(TF::AQUA . "Emerald Ore");
        $lore = [
            TF::EOL,
            TF::GREEN . "$" . TF::WHITE . "27.35"
        ];
        $item->setLore($lore);

        return $item;
    }
    public function emerald(): Item {
        $item = VanillaItems::EMERALD();
        $item->setCustomName(TF::AQUA . "Emerald");
        $lore = [
            TF::EOL,
            TF::GREEN . "$" . TF::WHITE . "144.92"
        ];
        $item->setLore($lore);

        return $item;
    }
    public function emeraldBlock(): Item {
        $item = VanillaBlocks::EMERALD()->asItem();
        $item->setCustomName(TF::AQUA . "Emerald Block");
        $lore = [
            TF::EOL,
            TF::GREEN . "$" . TF::WHITE . "579.68"
        ];
        $item->setLore($lore);

        return $item;
    }

    private function checkTutorialProgress(Player $player): void {
        # check tutorial stage
        $tutorialProgress = EmporiumTutorial::getInstance()->getTutorialManager()->getPlayerTutorialProgress($player);
        if($tutorialProgress == 2) {
            # update player tutorial progression
            DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.tutorial-progress", (int) DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.tutorial-progress") + 1);
            # remove menu
            $player->removeCurrentWindow();
            # start next tutorial stage
            EmporiumTutorial::getInstance()->getTutorialManager()->startTutorial($player);
        }
    }
}