<?php

namespace Tetro\EmporiumEnchants\Listeners;

use BlockHorizons\Fireworks\item\Fireworks;

use Emporium\Prison\EmporiumPrison;
use Emporium\Prison\Managers\misc\Translator;

use Emporium\Prison\Variables;
use pocketmine\block\BlockTypeIds;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\VanillaItems;
use pocketmine\world\sound\ClickSound;
use pocketmine\world\sound\DoorBumpSound;
use pocketmine\world\sound\DoorCrashSound;
use pocketmine\world\sound\TotemUseSound;
use Tetro\EmporiumWormhole\Utils\FireworksParticle;

use Exception;
use pocketmine\event\inventory\InventoryTransactionEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerItemUseEvent;
use pocketmine\inventory\transaction\action\SlotChangeAction;
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

        if($hand->getNamedTag()->getTag("LockedCustomEnchantBook") === null) return;

        # Elite Book
        if ($hand->getNamedTag()->getString("LockedCustomEnchantBook") === "elite") {

            # create book
            $enchants = $utils->getEnchantNotPickaxe(CustomEnchant::RARITY_ELITE);
            $enchant = $enchants[array_rand($enchants)];
            $id = $enchant->getTypeId();
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
        if ($hand->getNamedTag()->getString("LockedCustomEnchantBook") == "ultimate") {

            # create book
            $enchants = $utils->getEnchantNotPickaxe(CustomEnchant::RARITY_ULTIMATE);
            $enchant = $enchants[array_rand($enchants)];
            $id = $enchant->getTypeId();
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
        if ($hand->getNamedTag()->getString("LockedCustomEnchantBook") == "legendary") {

            # create book
            $enchants = $utils->getEnchantNotPickaxe(CustomEnchant::RARITY_LEGENDARY);
            $enchant = $enchants[array_rand($enchants)];
            $id = $enchant->getTypeId();
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
        if ($hand->getNamedTag()->getString("LockedCustomEnchantBook") == "godly") {

            # create book
            $enchants = $utils->getEnchantNotPickaxe(CustomEnchant::RARITY_GODLY);
            $enchant = $enchants[array_rand($enchants)];
            $id = $enchant->getTypeId();
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
        if ($hand->getNamedTag()->getString("LockedCustomEnchantBook") == "heroic") {

            # create book
            $enchants = $utils->getEnchantNotPickaxe(CustomEnchant::RARITY_HEROIC);
            $enchant = $enchants[array_rand($enchants)];
            $id = $enchant->getTypeId();
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
        if ($hand->getNamedTag()->getString("LockedCustomEnchantBook") == "executive") {

            # create book
            $enchants = $utils->getEnchantNotPickaxe(CustomEnchant::RARITY_EXECUTIVE);
            $enchant = $enchants[array_rand($enchants)];
            $id = $enchant->getTypeId();
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

        if (count($actions) === 2) {
            foreach ($actions as $i => $action) {

                $itemClickedWith = $action->getTargetItem();
                $itemClicked = $action->getSourceItem();

                if($action instanceof SlotChangeAction && ($otherAction = $actions[($i + 1) % 2]) instanceof SlotChangeAction && $itemClickedWith->getNamedTag()->getTag("EnergyOrb") && $itemClicked->getNamedTag()->getTag("OpenedCustomEnchantBook")) {

                    # cancel event
                    $event->cancel();

                    $energyOrb = $itemClickedWith;
                    $book = $itemClicked;

                    $applyBookEnergySuccessful = false;
                    $allEnergyUsed = false;
                    $newOrbValue = 0;
                    $energyToAdd = 0;

                    # get energy data
                    $bookEnergy = $book->getNamedTag()->getInt("Energy");
                    $bookEnergyNeeded = $book->getNamedTag()->getInt("EnergyNeeded");
                    $energyOrbEnergy = $energyOrb->getNamedTag()->getInt("Energy");

                    if($bookEnergy == $bookEnergyNeeded) {
                        $player->broadcastSound(new ClickSound(30), [$player]);
                        return;
                    }

                    # energy calculation
                    $newData = $bookEnergy + $energyOrbEnergy;

                    # check if user is adding more energy than needed
                    if($newData > $bookEnergyNeeded) {
                        $energyToAdd = $bookEnergyNeeded - $bookEnergy;
                        $newOrbValue = $energyOrbEnergy - $energyToAdd;
                    }

                    if($newOrbValue > 0) {

                        # add the energy
                        $book->getNamedTag()->setInt("Energy", $bookEnergy + $energyToAdd);

                        # create new energy orb
                        $newEnergyOrb = EmporiumPrison::getInstance()->getOrbs()->EnergyOrb($newOrbValue);

                        # update items
                        $updatedBook = EmporiumEnchants::getInstance()->getBookManager()->updateBook($book);

                        # give player new items
                        $action->getInventory()->setItem($action->getSlot(), $updatedBook);
                        $player->getCursorInventory()->removeItem($energyOrb);
                        $player->getCursorInventory()->addItem($newEnergyOrb);
                        $player->broadcastSound(new XpCollectSound(), [$player]);

                        $applyBookEnergySuccessful = true;
                    }

                    if($newOrbValue == 0) {
                        $book->getNamedTag()->setInt("Energy", $newData);
                        $applyBookEnergySuccessful = true;
                        $allEnergyUsed = true;
                    }

                    if($allEnergyUsed) {
                        # remove energy orb
                        $otherAction->getInventory()->setItem($otherAction->getSlot(), BlockTypeIds::AIR);
                    }

                    # update book if successful
                    if ($applyBookEnergySuccessful) {
                        # update book information
                        $updatedBook = EmporiumEnchants::getInstance()->getBookManager()->updateBook($book);

                        # give player new book
                        $action->getInventory()->setItem($action->getSlot(), $updatedBook);

                        $player->broadcastSound(new XpCollectSound(), [$player]);
                    }
                }
            }
        }
    }

    /**
     * @priority HIGHEST
     */
    public function onApplyBookEnchant(InventoryTransactionEvent $event): void
    {
        $player = $event->getTransaction()->getSource();
        $transaction = $event->getTransaction();
        $actions = array_values($transaction->getActions());

        if (count($actions) != 2) {
            return;
        }

        foreach ($actions as $i => $action) {

            $itemClickedWith = $action->getTargetItem();
            $itemClicked = $action->getSourceItem();

            if ($action instanceof SlotChangeAction and ($otherAction = $actions[($i + 1) % 2]) instanceof SlotChangeAction
                and $itemClicked->getNamedTag()->getTag("OpenedCustomEnchantBook")
                    and $itemClicked->getTypeId() !== BlockTypeIds::AIR and $itemClickedWith->getEnchantments() > 0) {

                $willChange = false;

                # book data
                if ($itemClickedWith->getNamedTag()->getTag("Energy") === null) return;
                if ($itemClickedWith->getNamedTag()->getTag("EnergyNeeded") === null) return;
                if ($itemClickedWith->getNamedTag()->getTag("Success") === null) return;

                $bookEnergy = $itemClickedWith->getNamedTag()->getInt("Energy");
                $bookEnergyNeeded = $itemClickedWith->getNamedTag()->getInt("EnergyNeeded");
                $bookChance = $itemClickedWith->getNamedTag()->getInt("Success");

                # generate random number
                $randomNumber = mt_rand(1, 100);

                if ($bookEnergy < $bookEnergyNeeded) {
                    $event->cancel();
                    $player->sendMessage(TF::RED . "You need to fill the Book's Energy to do that");
                    $player->broadcastSound(new DoorBumpSound(), [$player]);
                    return;
                }


                foreach ($itemClickedWith->getEnchantments() as $enchantment) {
                    $enchantmentType = $enchantment->getType();
                    $newLevel = $enchantment->getLevel();
                    $existingEnchant = $itemClicked->getEnchantment($enchantmentType);
                }

                if (!isset($enchantmentType)) return;

                if (!$enchantmentType instanceof CustomEnchant) return;

                if ($enchantmentType->getItemType() === CustomEnchant::ITEM_TYPE_TOOLS) {

                    if (!Utils::itemMatchesItemType($itemClicked, $enchantmentType->getItemType()) || !Utils::checkEnchantIncompatibilities($itemClicked, $enchantmentType)) {
                        $player->sendMessage(TF::RED . "You can not apply this enchant to that item");
                        return;
                    }


                    # pickaxe data
                    if (!$itemClicked->getNamedTag()->getTag("Energy")) return;

                    $pickaxeEnergy = $itemClicked->getNamedTag()->getInt("Energy");
                    $pickaxeEnergyNeeded = EmporiumPrison::getInstance()->getPickaxeManager()->getEnergyNeeded($itemClicked);

                    if ($pickaxeEnergy < $pickaxeEnergyNeeded) {
                        $player->sendMessage("You need to fill the Pickaxe Energy to do that");
                        return;
                    }


                    // Upgrade CE Level
                    if ($existingEnchant !== null) {

                        if ($existingEnchant->getLevel() <= $newLevel) {

                            /*
                             * enchant already has that level
                             */
                            if ($existingEnchant->getLevel() === $newLevel) {
                                $player->sendMessage(Variables::PREFIX . "Item already has that enchant with the same level");
                                return;
                            }

                            // New Level
                            if ($existingEnchant->getLevel() < $newLevel) $willChange = true;
                        }

                    } else $willChange = true;


                    if (((!Utils::itemMatchesItemType($itemClicked, $enchantmentType->getItemType()) || !Utils::checkEnchantIncompatibilities($itemClicked, $enchantmentType))) ||
                        $itemClicked->getCount() < 1 ||
                        $newLevel > $enchantmentType->getMaxLevel()) {
                        continue;
                    }

                    if ($randomNumber <= $bookChance) {
                        $player->sendMessage(TF::GREEN . "Enchant Success");
                        $itemClicked->addEnchantment(new EnchantmentInstance($enchantmentType, $newLevel));
                    } else {
                        $player->sendMessage(TF::RED . "Enchant failed");
                    }

                    return;

                } else {


                    if (!Utils::itemMatchesItemType($itemClicked, $enchantmentType->getItemType()) || !Utils::checkEnchantIncompatibilities($itemClicked, $enchantmentType)) {
                        $player->sendMessage(TF::RED . "You can not apply this enchant to that item");
                        return;
                    }
                    /*
                     * not trying to enchant pickaxe
                     * only book needs full energy to enchant
                     */

                    # upgrade CE level
                    if (!is_null($existingEnchant)) {
                        if ($existingEnchant->getLevel() <= $newLevel) {
                            // already has enchant with same level
                            if ($existingEnchant->getLevel() === $newLevel) {
                                $player->sendMessage(Variables::PREFIX . "Item already has that enchant with the same level");
                                return;
                            }
                            // New Level
                            if ($existingEnchant->getLevel() < $newLevel) $willChange = true;
                        }
                    } else {
                        $willChange = true;
                    }


                    if ($itemClicked->getCount() !== 1 || $newLevel > $enchantmentType->getMaxLevel() ||
                        ($itemClicked->getTypeId() == VanillaItems::ENCHANTED_BOOK()->getTypeId() && count($itemClicked->getEnchantments()) === 0) ||
                        $itemClicked->getTypeId() == VanillaItems::BOOK()->getTypeId()) {
                        continue;
                    }


                    if ($randomNumber > $bookChance) {
                        $event->cancel();
                        $player->sendTitle(TF::RED . "Enchant failed", "", 5, 40, 5);
                        $player->broadcastSound(new DoorCrashSound(), [$player]);
                        $otherAction->getInventory()->setItem($otherAction->getSlot(), BlockTypeIds::AIR);
                        return;
                    }

                    $player->sendTitle(TF::GREEN . "Enchant Success", "", 5, 40, 5);
                    $itemClicked->addEnchantment(new EnchantmentInstance($enchantmentType, $newLevel));
                    $player->broadcastSound(new TotemUseSound(), [$player]);

                }

                if ($willChange) {
                    $event->cancel();
                    $action->getInventory()->setItem($action->getSlot(), $itemClicked);
                    $otherAction->getInventory()->setItem($otherAction->getSlot(), BlockTypeIds::AIR);
                }
            }
        }
    }
}