<?php

namespace Tetro\EmporiumWormhole\Menus;

use customiesdevs\customies\item\CustomiesItemFactory;

use Emporium\Prison\EmporiumPrison;

use Tetro\EmporiumTutorial\EmporiumTutorial;

use Tetro\EmporiumWormhole\Core\Managers\RandomWormholeEnchant;
use Tetro\EmporiumWormhole\Utils\FireworksParticle;

use EmporiumData\DataManager;

use muqsit\invmenu\InvMenu;
use muqsit\invmenu\transaction\DeterministicInvMenuTransaction;
use muqsit\invmenu\type\InvMenuTypeIds;

use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\enchantment\VanillaEnchantments;
use pocketmine\item\Item;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;

use Tetro\EmporiumEnchants\Core\CustomEnchantIds;
use Tetro\EmporiumEnchants\Core\CustomEnchantManager;

class Menu {

    /**
     * @var true
     */
    private bool $levelUpSuccess = false;

    public function Inventory(Player $player, Item $item): void {

        # Managers
        $tutorialProgress = EmporiumTutorial::getInstance()->getTutorialManager()->getPlayerTutorialProgress($player);
        # enchants

        # enchant 1
        $enchant1Chance = mt_rand(1, 100);
        $enchant1 = RandomWormholeEnchant::enchantGenerator($item, $enchant1Chance);

        # enchant 2
        $enchant2Chance = mt_rand(1, 100);
        $enchant2 = RandomWormholeEnchant::enchantGenerator($item, $enchant2Chance);

        # enchant 3
        $enchant3Chance = mt_rand(1, 100);
        $enchant3 = RandomWormholeEnchant::enchantGenerator($item, $enchant3Chance);

        # enchant 4
        $enchant4Chance = mt_rand(1, 100);
        $enchant4 = RandomWormholeEnchant::enchantGenerator($item, $enchant4Chance);

        # enchant 5
        $enchant5Chance = mt_rand(1, 100);
        $enchant5 = RandomWormholeEnchant::enchantGenerator($item, $enchant5Chance);

        # random number
        $randomNumber = mt_rand(1, 100);

        $menu = InvMenu::create(InvMenuTypeIds::TYPE_CHEST);
        $pickaxeManager = EmporiumPrison::getInstance()->getPickaxeManager();
        $tutorialManager = EmporiumTutorial::getInstance()->getTutorialManager();
        $menu->setName(TF::BOLD . "Wormhole");
        $menu->setListener(InvMenu::readonly(function(DeterministicInvMenuTransaction $transaction) use ($pickaxeManager, $item, $enchant5, $enchant4, $enchant3, $enchant2, $enchant1, $randomNumber, $enchant5Chance, $enchant4Chance, $enchant3Chance, $enchant2Chance, $enchant1Chance, $tutorialManager, $tutorialProgress): void {
            $player = $transaction->getPlayer();
            $itemClicked = $transaction->getItemClicked();
            $level = 0;

            if($transaction->getItemClicked()->getNamedTag()->getTag("enchant") !== null) {
                $enchant = $transaction->getItemClicked()->getNamedTag()->getString("enchant");
                if($itemClicked->getNamedTag()->getInt("success") !== null) {
                    $chance = $itemClicked->getNamedTag()->getInt("success");
                } else {
                    $chance = 0;
                }
                if($itemClicked->getNamedTag()->getInt("nextlevel") !== null) {
                    if($itemClicked->getNamedTag()->getTag("isMax") !== null) {
                        $level = "Max Level";
                    } else {
                        $level = $itemClicked->getNamedTag()->getInt("nextlevel");
                    }
                }
                switch($enchant) {

                        # vanilla enchants
                        case "efficiency":
                            if(is_numeric($level)) {
                                if($randomNumber <= $chance) {
                                    $enchantName = str_replace("_", " ", $enchant);
                                    $player->sendMessage(TF::BOLD . TF::GREEN . "You got " . ucwords($enchantName));
                                    $item->addEnchantment(new EnchantmentInstance(VanillaEnchantments::EFFICIENCY(), $level));
                                    $pickaxeManager->addSuccessfulEnchant($player, $item);
                                    $this->levelUpSuccess = true;
                                } else {
                                    $player->sendMessage(TF::RED . "Enchant Failed!");
                                    $pickaxeManager->addFailedEnchant($player, $item);
                                    $this->levelUpSuccess = false;
                                }
                            } else {
                                $player->sendMessage("Enchant is Max");
                                $pickaxeManager->addSuccessfulEnchant($player, $item);
                                $this->levelUpSuccess = true;
                            }
                            break;
                        # custom enchants
                        case "alchemy":
                            if(is_numeric($level)) {
                                if($randomNumber <= $chance) {
                                    $enchantName = str_replace("_", " ", $enchant);
                                    $player->sendMessage(TF::BOLD . TF::GREEN . "You got " . ucwords($enchantName));
                                    $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantment(CustomEnchantIds::ALCHEMY), $level));
                                    $pickaxeManager->addSuccessfulEnchant($player, $item);
                                    $this->levelUpSuccess = true;
                                } else {
                                    $player->sendMessage(TF::RED . "Enchant Failed!");
                                    $pickaxeManager->addFailedEnchant($player, $item);
                                    $this->levelUpSuccess = false;
                                }
                            } else {
                                $player->sendMessage("Enchant is Max");
                                $pickaxeManager->addSuccessfulEnchant($player, $item);
                                $this->levelUpSuccess = true;
                            }
                            break;
                        case "energy_collector":
                            if(is_numeric($level)) {
                                if($randomNumber <= $chance) {
                                    $enchantName = str_replace("_", " ", $enchant);
                                    $player->sendMessage(TF::BOLD . TF::GREEN . "You got " . ucwords($enchantName));
                                    $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantment(CustomEnchantIds::ENERGY_COLLECTOR), $level));
                                    $pickaxeManager->addSuccessfulEnchant($player, $item);
                                    $this->levelUpSuccess = true;
                                } else {
                                    $player->sendMessage(TF::RED . "Enchant Failed!");
                                    $pickaxeManager->addFailedEnchant($player, $item);
                                    $this->levelUpSuccess = false;
                                }
                            } else {
                                $player->sendMessage("Enchant is Max");
                                $pickaxeManager->addSuccessfulEnchant($player, $item);
                                $this->levelUpSuccess = true;
                            }
                            break;
                        case "transfuse":
                            if(is_numeric($level)) {
                                if($randomNumber <= $chance) {
                                    $enchantName = str_replace("_", " ", $enchant);
                                    $player->sendMessage(TF::BOLD . TF::GREEN . "You got " . ucwords($enchantName));
                                    $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantment(CustomEnchantIds::TRANSFUSE), $level));
                                    $pickaxeManager->addSuccessfulEnchant($player, $item);
                                    $this->levelUpSuccess = true;
                                } else {
                                    $player->sendMessage(TF::RED . "Enchant Failed!");
                                    $pickaxeManager->addFailedEnchant($player, $item);
                                    $this->levelUpSuccess = false;
                                }
                            } else {
                                $player->sendMessage("Enchant is Max");
                                $pickaxeManager->addSuccessfulEnchant($player, $item);
                                $this->levelUpSuccess = true;
                            }
                            break;
                        case "ore_magnet":
                            if(is_numeric($level)) {
                                if($randomNumber <= $chance) {
                                    $enchantName = str_replace("_", " ", $enchant);
                                    $player->sendMessage(TF::BOLD . TF::GREEN . "You got " . ucwords($enchantName));
                                    $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantment(CustomEnchantIds::ORE_MAGNET), $level));
                                    $pickaxeManager->addSuccessfulEnchant($player, $item);
                                    $this->levelUpSuccess = true;
                                } else {
                                    $player->sendMessage(TF::RED . "Enchant Failed!");
                                    $pickaxeManager->addFailedEnchant($player, $item);
                                    $this->levelUpSuccess = false;
                                }
                            } else {
                                $player->sendMessage("Enchant is Max");
                                $pickaxeManager->addSuccessfulEnchant($player, $item);
                                $this->levelUpSuccess = true;
                            }
                            break;
                        case "shard_discoverer":
                            if(is_numeric($level)) {
                                if($randomNumber <= $chance) {
                                    $enchantName = str_replace("_", " ", $enchant);
                                    $player->sendMessage(TF::BOLD . TF::GREEN . "You got " . ucwords($enchantName));
                                    $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantment(CustomEnchantIds::SHARD_DISCOVERER), $level));
                                    $pickaxeManager->addSuccessfulEnchant($player, $item);
                                    $this->levelUpSuccess = true;
                                } else {
                                    $player->sendMessage(TF::RED . "Enchant Failed!");
                                    $pickaxeManager->addFailedEnchant($player, $item);
                                    $this->levelUpSuccess = false;
                                }
                            } else {
                                $player->sendMessage("Enchant is Max");
                                $pickaxeManager->addSuccessfulEnchant($player, $item);
                                $this->levelUpSuccess = true;
                            }
                            break;
                        case "super_breaker":
                            if(is_numeric($level)) {
                                if($randomNumber <= $chance) {
                                    $enchantName = str_replace("_", " ", $enchant);
                                    $player->sendMessage(TF::BOLD . TF::GREEN . "You got " . ucwords($enchantName));
                                    $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantment(CustomEnchantIds::SUPER_BREAKER), $level));
                                    $pickaxeManager->addSuccessfulEnchant($player, $item);
                                    $this->levelUpSuccess = true;
                                } else {
                                    $player->sendMessage(TF::RED . "Enchant Failed!");
                                    $pickaxeManager->addFailedEnchant($player, $item);
                                    $this->levelUpSuccess = false;
                                }
                            } else {
                                $player->sendMessage("Enchant is Max");
                                $pickaxeManager->addSuccessfulEnchant($player, $item);
                                $this->levelUpSuccess = true;
                            }
                            break;
                        case "miners_sight":
                            if(is_numeric($level)) {
                                if($randomNumber <= $chance) {
                                    $enchantName = str_replace("_", " ", $enchant);
                                    $player->sendMessage(TF::BOLD . TF::GREEN . "You got " . ucwords($enchantName));
                                    $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantment(CustomEnchantIds::MINERS_SIGHT), $level));
                                    $pickaxeManager->addSuccessfulEnchant($player, $item);
                                    $this->levelUpSuccess = true;
                                } else {
                                    $player->sendMessage(TF::RED . "Enchant Failed!");
                                    $pickaxeManager->addFailedEnchant($player, $item);
                                    $this->levelUpSuccess = false;
                                }
                            } else {
                                $player->sendMessage("Enchant is Max");
                                $pickaxeManager->addSuccessfulEnchant($player, $item);
                                $this->levelUpSuccess = true;
                            }
                            break;
                        case "jackpot":
                            if(is_numeric($level)) {
                                if($randomNumber <= $chance) {
                                    $enchantName = str_replace("_", " ", $enchant);
                                    $player->sendMessage(TF::BOLD . TF::GREEN . "You got " . ucwords($enchantName));
                                    $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantment(CustomEnchantIds::JACKPOT), $level));
                                    $pickaxeManager->addSuccessfulEnchant($player, $item);
                                    $this->levelUpSuccess = true;
                                } else {
                                    $player->sendMessage(TF::RED . "Enchant Failed!");
                                    $pickaxeManager->addFailedEnchant($player, $item);
                                    $this->levelUpSuccess = false;
                                }
                            } else {
                                $player->sendMessage("Enchant is Max");
                                $pickaxeManager->addSuccessfulEnchant($player, $item);
                                $this->levelUpSuccess = true;
                            }
                            break;
                        case "ore_surge":
                            if(is_numeric($level)) {
                                if($randomNumber <= $chance) {
                                    $enchantName = str_replace("_", " ", $enchant);
                                    $player->sendMessage(TF::BOLD . TF::GREEN . "You got " . ucwords($enchantName));
                                    $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantment(CustomEnchantIds::ORE_SURGE), $level));
                                    $pickaxeManager->addSuccessfulEnchant($player, $item);
                                    $this->levelUpSuccess = true;
                                } else {
                                    $player->sendMessage(TF::RED . "Enchant Failed!");
                                    $pickaxeManager->addFailedEnchant($player, $item);
                                    $this->levelUpSuccess = false;
                                }
                            } else {
                                $player->sendMessage("Enchant is Max");
                                $pickaxeManager->addSuccessfulEnchant($player, $item);
                                $this->levelUpSuccess = true;
                            }
                            break;
                        case "luck":
                            if(is_numeric($level)) {
                                if($randomNumber <= $chance) {
                                    $enchantName = str_replace("_", " ", $enchant);
                                    $player->sendMessage(TF::BOLD . TF::GREEN . "You got " . ucwords($enchantName));
                                    $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantment(CustomEnchantIds::LUCK), $level));
                                    $pickaxeManager->addSuccessfulEnchant($player, $item);
                                    $this->levelUpSuccess = true;
                                } else {
                                    $player->sendMessage(TF::RED . "Enchant Failed!");
                                    $pickaxeManager->addFailedEnchant($player, $item);
                                    $this->levelUpSuccess = false;
                                }
                            } else {
                                $player->sendMessage("Enchant is Max");
                                $pickaxeManager->addSuccessfulEnchant($player, $item);
                                $this->levelUpSuccess = true;
                            }
                            break;
                        case "meteor_hunter":
                            if(is_numeric($level)) {
                                if($randomNumber <= $chance) {
                                    $enchantName = str_replace("_", " ", $enchant);
                                    $player->sendMessage(TF::BOLD . TF::GREEN . "You got " . ucwords($enchantName));
                                    $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantment(CustomEnchantIds::METEOR_HUNTER), $level));
                                    $pickaxeManager->addSuccessfulEnchant($player, $item);
                                    $this->levelUpSuccess = true;
                                } else {
                                    $player->sendMessage(TF::RED . "Enchant Failed!");
                                    $pickaxeManager->addFailedEnchant($player, $item);
                                    $this->levelUpSuccess = false;
                                }
                            } else {
                                $player->sendMessage("Enchant is Max");
                                $pickaxeManager->addSuccessfulEnchant($player, $item);
                                $this->levelUpSuccess = true;
                            }
                            break;
                        case "meteor_summoner":
                            if(is_numeric($level)) {
                                if($randomNumber <= $chance) {
                                    $enchantName = str_replace("_", " ", $enchant);
                                    $player->sendMessage(TF::BOLD . TF::GREEN . "You got " . ucwords($enchantName));
                                    $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantment(CustomEnchantIds::METEOR_SUMMONER), $level));
                                    $pickaxeManager->addSuccessfulEnchant($player, $item);
                                    $this->levelUpSuccess = true;
                                } else {
                                    $player->sendMessage(TF::RED . "Enchant Failed!");
                                    $pickaxeManager->addFailedEnchant($player, $item);
                                    $this->levelUpSuccess = false;
                                }
                            } else {
                                $player->sendMessage("Enchant is Max");
                                $pickaxeManager->addSuccessfulEnchant($player, $item);
                                $this->levelUpSuccess = true;
                            }
                            break;
                        case "shatter":
                            if(is_numeric($level)) {
                                if($randomNumber <= $chance) {
                                    $enchantName = str_replace("_", " ", $enchant);
                                    $player->sendMessage(TF::BOLD . TF::GREEN . "You got " . ucwords($enchantName));
                                    $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantment(CustomEnchantIds::SHATTER), $level));
                                    $pickaxeManager->addSuccessfulEnchant($player, $item);
                                    $this->levelUpSuccess = true;
                                } else {
                                    $player->sendMessage(TF::RED . "Enchant Failed!");
                                    $pickaxeManager->addFailedEnchant($player, $item);
                                    $this->levelUpSuccess = false;
                                }
                            } else {
                                $player->sendMessage("Enchant is Max");
                                $pickaxeManager->addSuccessfulEnchant($player, $item);
                                $this->levelUpSuccess = true;
                            }
                            break;

                        default:
                            break;
                    }
                FireworksParticle::Fireworks3($player);
                $player->removeCurrentWindow();
                EmporiumPrison::getInstance()->getPickaxeManager()->levelUpAnimation($player);
                $player->getInventory()->remove($item);
                $updatedPickaxe = $pickaxeManager->levelUpPickaxe($item);
                $player->getInventory()->addItem($updatedPickaxe);
                $this->levelUpSuccess = true;
            }
            if($tutorialProgress === 4) {
                DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.tutorial-progress", DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.tutorial-progress") + 1);
                DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.tutorial-complete", true);
                $tutorialManager->startTutorial($player);
            }
        }));
        $menu->setInventoryCloseListener(function(Player $player) use ($pickaxeManager, $item): void {
            if(!$this->levelUpSuccess) {
                $player->sendMessage(TF::BOLD . TF::DARK_GRAY . "(" . TF::RED . "!" . TF::DARK_GRAY . ") " . TF::RESET . TF::RED . "You left the Wormhole and your pickaxe has been levelled up with a failed enchant");
                $pickaxeManager->addFailedEnchant($player, $item);
                $this->levelUpSuccess = false;
                $pickaxeManager->levelUpPickaxe($item);
                $player->getInventory()->addItem($item);
                $pickaxeManager->levelUpAnimation($player);
            }
        });
        # set items
        $inventory = $menu->getInventory();

        # pickaxe
        $inventory->setItem(4, $item);
        # enchant options
        $inventory->setItem(11, $enchant1);
        $inventory->setItem(12, $enchant2);
        $inventory->setItem(13, $enchant3);
        $inventory->setItem(14, $enchant4);
        $inventory->setItem(15, $enchant5);
        # filler
        for($i = 0; $i <= 26; $i++) {
            if($inventory->isSlotEmpty($i)) {
                $inventory->setItem($i, $this->filler());
            }
        }

        $menu->send($player);
    }

    public function filler(): Item {
        $item = CustomiesItemFactory::getInstance()->get("2dglasspanes:pane_lightgrey");
        $item->setCustomName("§r");
        return $item;
    }
}