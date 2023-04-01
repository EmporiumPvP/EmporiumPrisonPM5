<?php

namespace Tetro\EmporiumEnchants\Listeners;

use BlockHorizons\Fireworks\item\Fireworks;

use Emporium\Prison\EmporiumPrison;
use Emporium\Prison\Managers\misc\Translator;

use Tetro\EmporiumWormhole\Utils\FireworksParticle;

use Exception;
use pocketmine\event\inventory\InventoryTransactionEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerItemUseEvent;
use pocketmine\inventory\transaction\action\SlotChangeAction;
use pocketmine\item\ItemIds;
use pocketmine\item\VanillaItems;
use pocketmine\utils\TextFormat as TF;
use pocketmine\world\sound\XpCollectSound;

use Tetro\EmporiumEnchants\Core\BookManager;
use Tetro\EmporiumEnchants\Core\CustomEnchant;
use Tetro\EmporiumEnchants\EmporiumEnchants;
use Tetro\EmporiumEnchants\Utils\Utils;

class BookListener implements Listener {

    private BookManager $bookManager;

    public function __construct() {
        $this->bookManager = EmporiumEnchants::getInstance()->getBookManager();
    }

    /**
     * @throws Exception
     */
    public function onRevealBook(PlayerItemUseEvent $event) {

        $player = $event->getPlayer();
        $hand = $player->getInventory()->getItemInHand();
        $count = $hand->getCount();

        $utils = new Utils();

        # Elite Book
        if ($hand->getNamedTag()->getTag("EliteCustomEnchantBook")) {
            # create book
            $enchants = $utils->getEnchantNotPickaxe(CustomEnchant::RARITY_ELITE);
            $enchant = $enchants[array_rand($enchants)];
            $id = $enchant->getId();
            $level = mt_rand(1, $enchant->getMaxLevel());
            $rarity = CustomEnchant::RARITY_ELITE;
            $name = $enchant->getName();
            $success = mt_rand(1, 100);
            # check if player inventory full
            if($player->getInventory()->canAddItem($this->bookManager->EnchantedBook($enchant, $level,  $rarity, $id, $success))) {
                # remove Item
                $hand->setCount($count - 1);
                $player->getInventory()->setItemInHand($hand);
                # give item
                $player->getInventory()->addItem($this->bookManager->EnchantedBook($enchant, $level,  $rarity, $id, $success));
                # send particles
                FireworksParticle::instantFirework($player, Fireworks::COLOR_BLUE);
                $player->sendMessage(TF::BOLD . TF::GRAY . "(!) " . TF::RESET . TF::GRAY . "You received: " . TF::BLUE . $name . " " . TF::AQUA . Translator::romanNumber($level) . TF::GRAY . " (" . TF::WHITE . $success . "%" . TF::GRAY . ")");
            } else {
                $player->sendMessage(TF::RED. "Your inventory is full");
            }
        }

        # Ultimate Book
        if ($hand->getNamedTag()->getTag("UltimateCustomEnchantBook")) {
            # create book
            $enchants = $utils->getEnchantNotPickaxe(CustomEnchant::RARITY_ULTIMATE);
            $enchant = $enchants[array_rand($enchants)];
            $id = $enchant->getId();
            $level = mt_rand(1, $enchant->getMaxLevel());
            $rarity = CustomEnchant::RARITY_ULTIMATE;
            $name = $enchant->getName();
            $success = mt_rand(1, 100);
            # check if player inventory full
            if($player->getInventory()->canAddItem($this->bookManager->EnchantedBook($enchant, $level,  $rarity, $id, $success))) {
                # remove Item
                $hand->setCount($count - 1);
                $player->getInventory()->setItemInHand($hand);
                # give item
                $player->getInventory()->addItem($this->bookManager->EnchantedBook($enchant, $level,  $rarity, $id, $success));
                # send particles
                FireworksParticle::instantFirework($player, Fireworks::COLOR_YELLOW);
                $player->sendMessage(TF::BOLD . TF::GRAY . "(!) " . TF::RESET . TF::GRAY . "You received: " . TF::YELLOW . $name . " " . TF::AQUA . Translator::romanNumber($level) . TF::GRAY . " (" . TF::WHITE . $success . "%" . TF::GRAY . ")");
            } else {
                $player->sendMessage(TF::RED. "Your inventory is full");
            }
        }

        # Legendary Book
        if ($hand->getNamedTag()->getTag("LegendaryCustomEnchantBook")) {
            # create book
            $enchants = $utils->getEnchantNotPickaxe(CustomEnchant::RARITY_LEGENDARY);
            $enchant = $enchants[array_rand($enchants)];
            $id = $enchant->getId();
            $level = mt_rand(1, $enchant->getMaxLevel());
            $rarity = CustomEnchant::RARITY_LEGENDARY;
            $name = $enchant->getName();
            $success = mt_rand(1, 100);
            # check if player inventory full
            if($player->getInventory()->canAddItem($this->bookManager->EnchantedBook($enchant, $level,  $rarity, $id, $success))) {
                # remove Item
                $hand->setCount($count - 1);
                $player->getInventory()->setItemInHand($hand);
                # give item
                $player->getInventory()->addItem($this->bookManager->EnchantedBook($enchant, $level,  $rarity, $id, $success));
                # send particles
                FireworksParticle::instantFirework($player, Fireworks::COLOR_GOLD);
                $player->sendMessage(TF::BOLD . TF::GRAY . "(!) " . TF::RESET . TF::GRAY . "You received: " . TF::GOLD . $name . " " . TF::AQUA . Translator::romanNumber($level) . TF::GRAY . " (" . TF::WHITE . $success . "%" . TF::GRAY . ")");
            } else {
                $player->sendMessage(TF::RED. "Your inventory is full");
            }
        }

        # Godly Book
        if ($hand->getNamedTag()->getTag("GodlyCustomEnchantBook")) {
            # create book
            $enchants = $utils->getEnchantNotPickaxe(CustomEnchant::RARITY_GODLY);
            $enchant = $enchants[array_rand($enchants)];
            $id = $enchant->getId();
            $level = mt_rand(1, $enchant->getMaxLevel());
            $rarity = CustomEnchant::RARITY_GODLY;
            $name = $enchant->getName();
            $success = mt_rand(1, 100);
            # check if player inventory full
            if($player->getInventory()->canAddItem($this->bookManager->EnchantedBook($enchant, $level,  $rarity, $id, $success))) {
                # remove Item
                $hand->setCount($count - 1);
                $player->getInventory()->setItemInHand($hand);
                # give item
                $player->getInventory()->addItem($this->bookManager->EnchantedBook($enchant, $level,  $rarity, $id, $success));
                # send particles
                FireworksParticle::instantFirework($player, Fireworks::COLOR_PINK);
                $player->sendMessage(TF::BOLD . TF::GRAY . "(!) " . TF::RESET . TF::GRAY . "You received: " . TF::LIGHT_PURPLE . $name . " " . TF::AQUA . Translator::romanNumber($level) . TF::GRAY . " (" . TF::WHITE . $success . "%" . TF::GRAY . ")");
            } else {
                $player->sendMessage(TF::RED. "Your inventory is full");
            }
        }

        # Heroic Book
        if ($hand->getNamedTag()->getTag("HeroicCustomEnchantBook")) {
            # create book
            $enchants = $utils->getEnchantNotPickaxe(CustomEnchant::RARITY_HEROIC);
            $enchant = $enchants[array_rand($enchants)];
            $id = $enchant->getId();
            $level = mt_rand(1, $enchant->getMaxLevel());
            $rarity = CustomEnchant::RARITY_HEROIC;
            $name = $enchant->getName();
            $success = mt_rand(1, 100);
            # check if player inventory full
            if($player->getInventory()->canAddItem($this->bookManager->EnchantedBook($enchant, $level,  $rarity, $id, $success))) {
                # remove Item
                $hand->setCount($count - 1);
                $player->getInventory()->setItemInHand($hand);
                # give item
                $player->getInventory()->addItem(($this->bookManager->EnchantedBook($enchant, $level,  $rarity, $id, $success)));
                # send particles
                FireworksParticle::instantFirework($player, Fireworks::COLOR_RED);
                $player->sendMessage(TF::BOLD . TF::GRAY . "(!) " . TF::RESET . TF::GRAY . "You received: " . TF::RED . $name . " " . TF::AQUA . Translator::romanNumber($level) . TF::GRAY . " (" . TF::WHITE . $success . "%" . TF::GRAY . ")");
            } else {
                $player->sendMessage(TF::RED. "Your inventory is full");
            }
        }

        # Executive Book
        if ($hand->getNamedTag()->getTag("ExecutiveCustomEnchantBook")) {
            # create book
            $enchants = $utils->getEnchantNotPickaxe(CustomEnchant::RARITY_EXECUTIVE);
            $enchant = $enchants[array_rand($enchants)];
            $id = $enchant->getId();
            $level = mt_rand(1, $enchant->getMaxLevel());
            $rarity = CustomEnchant::RARITY_EXECUTIVE;
            $name = $enchant->getName();
            $success = mt_rand(1, 100);
            # check if player inventory full
            if($player->getInventory()->canAddItem($this->bookManager->EnchantedBook($enchant, $level,  $rarity, $id, $success))) {
                # remove Item
                $hand->setCount($count - 1);
                $player->getInventory()->setItemInHand($hand);
                # give item
                $player->getInventory()->addItem($this->bookManager->EnchantedBook($enchant, $level,  $rarity, $id, $success));
                # send particles
                FireworksParticle::instantFirework($player, Fireworks::COLOR_BLACK);
                $player->sendMessage(TF::BOLD . TF::GRAY . "(!) " . TF::RESET . TF::GRAY . "You received: " . TF::BLACK . $name . " " . TF::AQUA . Translator::romanNumber($level) . TF::GRAY . " (" . TF::WHITE . $success . "%" . TF::GRAY . ")");
            } else {
                $player->sendMessage(TF::RED. "Your inventory is full");
            }
        }

    }

    /**
     * @priority HIGHEST
     */
    public function onApplyEnergyOrbToBook(InventoryTransactionEvent $event): void {

        $player = $event->getTransaction()->getSource();
        $transaction = $event->getTransaction();
        $actions = array_values($transaction->getActions());
        $applyBookEnergySuccessful = false;

        if (count($actions) === 2) {
            foreach ($actions as $i => $action) {
                if ($action instanceof SlotChangeAction && ($otherAction = $actions[($i + 1) % 2]) instanceof SlotChangeAction && ($itemClickedWith = $action->getTargetItem())->getId() === ItemIds::DYE && ($itemClicked = $action->getSourceItem())->getId() !== ItemIds::AIR) {
                    if ($itemClickedWith->getNamedTag()->getTag("EnergyOrb") === null) return;
                    if ($itemClickedWith->getNamedTag()->getTag("Energy") === null) return;

                    # is item an enchant book?
                    if ($itemClicked->getNamedTag()->getTag("CustomEnchantBook") === null) return;

                    # does item have energy?
                    if ($itemClicked->getNamedTag()->getTag("Energy") === null) return;

                    # cancel event
                    $event->cancel();

                    # get energy data
                    $bookEnergy = $itemClicked->getNamedTag()->getInt("Energy");
                    $energyOrbEnergy = $itemClickedWith->getNamedTag()->getInt("Energy");

                    # energy calculation
                    $newData = $bookEnergy + $energyOrbEnergy;



                    # add max amount of energy (if newData more than 2B)
                    if($newData > 2000000000) {
                        $maxApplicableEnergy = 2000000000 - $bookEnergy;
                        if($maxApplicableEnergy > 0) {
                            $energyToAdd = $maxApplicableEnergy + $bookEnergy;
                            # add the energy
                            $itemClicked->getNamedTag()->setInt("Energy", $energyToAdd);
                            # create new energy orb
                            $newOrbValue = $energyOrbEnergy - $maxApplicableEnergy;
                            $newEnergyOrb = EmporiumPrison::getInstance()->getOrbs()->EnergyOrb($newOrbValue);
                            # update items
                            $updatedBook = EmporiumEnchants::getInstance()->getBookManager()->updateBook($itemClicked);
                            $event->cancel();
                            # give player new items
                            $action->getInventory()->setItem($action->getSlot(), $updatedBook);
                            $otherAction->getInventory()->setItem($otherAction->getSlot(), $newEnergyOrb);
                            $player->broadcastSound(new XpCollectSound(), [$player]);
                            # set to false so energy orb doesnt get removed
                            $applyBookEnergySuccessful = false;
                        }
                    } else {
                        $itemClicked->getNamedTag()->setInt("Energy", $newData);
                        $applyBookEnergySuccessful = true;
                    }




                    # update book if successful
                    if ($applyBookEnergySuccessful) {
                        # update book information
                        $updatedBook = EmporiumEnchants::getInstance()->getBookManager()->updateBook($itemClicked);
                        # remove energy orb
                        $event->cancel();
                        # give player new pickaxe
                        $action->getInventory()->setItem($action->getSlot(), $updatedBook);
                        # remove energy orb
                        $otherAction->getInventory()->setItem($otherAction->getSlot(), VanillaItems::AIR());
                        $player->broadcastSound(new XpCollectSound(), [$player]);
                    }
                }
            }
        }
    }
}