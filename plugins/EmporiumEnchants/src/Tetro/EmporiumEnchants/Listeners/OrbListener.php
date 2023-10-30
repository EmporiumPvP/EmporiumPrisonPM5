<?php

namespace Tetro\EmporiumEnchants\Listeners;

use BlockHorizons\Fireworks\item\Fireworks;

use Emporium\Prison\EmporiumPrison;
use Emporium\Prison\Managers\misc\Translator;
use Emporium\Prison\Variables;

use Exception;

use pocketmine\block\BlockTypeIds;
use pocketmine\event\inventory\InventoryTransactionEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerItemUseEvent;
use pocketmine\inventory\transaction\action\SlotChangeAction;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\utils\TextFormat as TF;
use pocketmine\world\sound\ClickSound;
use pocketmine\world\sound\DoorBumpSound;
use pocketmine\world\sound\TotemUseSound;
use pocketmine\world\sound\XpCollectSound;

use Tetro\EmporiumEnchants\Core\CustomEnchant;
use Tetro\EmporiumEnchants\Core\OrbManager;
use Tetro\EmporiumEnchants\EmporiumEnchants;
use Tetro\EmporiumEnchants\Utils\Utils;
use Tetro\EmporiumWormhole\Utils\FireworksParticle;

class OrbListener implements Listener
{

    private orbManager $orbManager;

    public function __construct()
    {
        $this->orbManager = EmporiumEnchants::getInstance()->getOrbManager();
    }

    /**
     * @throws Exception
     */
    public function onRevealOrb(PlayerItemUseEvent $event)
    {

        $player = $event->getPlayer();
        $hand = $player->getInventory()->getItemInHand();
        $count = $hand->getCount();

        $utils = new Utils();

        # not a pickaxe enchant orb
        if (!$hand->getNamedTag()->getTag("LockedPickaxeEnchantOrb")) return;

        # Elite Orb
        if ($hand->getNamedTag()->getString("LockedPickaxeEnchantOrb") == "elite") {

            # create orb
            $enchants = $utils->getPickaxeEnchant(CustomEnchant::RARITY_ELITE);
            $enchant = $enchants[array_rand($enchants)];
            $id = $enchant->getTypeId();
            $level = mt_rand(1, $enchant->getMaxLevel());
            $rarity = CustomEnchant::RARITY_ELITE;
            $name = $enchant->getName();
            $success = mt_rand(1, 100);

            # check if player inventory full
            if ($player->getInventory()->canAddItem($this->orbManager->EnchantedOrb($enchant, $level, $rarity, $id, $success))) {

                # remove Item
                $hand->setCount($count - 1);
                $player->getInventory()->setItemInHand($hand);

                # give item
                $player->getInventory()->addItem($this->orbManager->EnchantedOrb($enchant, $level, $rarity, $id, $success));

                # send particles
                FireworksParticle::instantFirework($player, Fireworks::COLOR_BLUE);
                $player->sendMessage(TF::BOLD . TF::GRAY . "(!) " . TF::RESET . TF::GRAY . "You received: " . TF::BLUE . $name . " " . TF::AQUA . Translator::romanNumber($level) . TF::GRAY . " (" . TF::WHITE . $success . "%" . TF::GRAY . ")");
            } else {
                $player->sendMessage(TF::RED . "Your inventory is full");
            }
        }

        # Ultimate Orb
        if ($hand->getNamedTag()->getString("LockedPickaxeEnchantOrb") == "ultimate") {

            # create orb
            $enchants = $utils->getPickaxeEnchant(CustomEnchant::RARITY_ULTIMATE);
            $enchant = $enchants[array_rand($enchants)];
            $id = $enchant->getTypeId();
            $level = mt_rand(1, $enchant->getMaxLevel());
            $rarity = CustomEnchant::RARITY_ULTIMATE;
            $name = $enchant->getName();
            $success = mt_rand(1, 100);

            # check if player inventory full
            if ($player->getInventory()->canAddItem($this->orbManager->EnchantedOrb($enchant, $level, $rarity, $id, $success))) {

                # remove Item
                $hand->setCount($count - 1);
                $player->getInventory()->setItemInHand($hand);

                # give item
                $player->getInventory()->addItem($this->orbManager->EnchantedOrb($enchant, $level, $rarity, $id, $success));

                # send particles
                FireworksParticle::instantFirework($player, Fireworks::COLOR_YELLOW);
                $player->sendMessage(TF::BOLD . TF::GRAY . "(!) " . TF::RESET . TF::GRAY . "You received: " . TF::YELLOW . $name . " " . TF::AQUA . Translator::romanNumber($level) . TF::GRAY . " (" . TF::WHITE . $success . "%" . TF::GRAY . ")");
            } else {
                $player->sendMessage(TF::RED . "Your inventory is full");
            }
        }

        # Legendary Orb
        if ($hand->getNamedTag()->getString("LockedPickaxeEnchantOrb") == "legendary") {

            # create orb
            $enchants = $utils->getPickaxeEnchant(CustomEnchant::RARITY_LEGENDARY);
            $enchant = $enchants[array_rand($enchants)];
            $id = $enchant->getTypeId();
            $level = mt_rand(1, $enchant->getMaxLevel());
            $rarity = CustomEnchant::RARITY_LEGENDARY;
            $name = $enchant->getName();
            $success = mt_rand(1, 100);

            # check if player inventory full
            if ($player->getInventory()->canAddItem($this->orbManager->EnchantedOrb($enchant, $level, $rarity, $id, $success))) {

                # remove Item
                $hand->setCount($count - 1);
                $player->getInventory()->setItemInHand($hand);

                # give item
                $player->getInventory()->addItem($this->orbManager->EnchantedOrb($enchant, $level, $rarity, $id, $success));

                # send particles
                FireworksParticle::instantFirework($player, Fireworks::COLOR_GOLD);
                $player->sendMessage(TF::BOLD . TF::GRAY . "(!) " . TF::RESET . TF::GRAY . "You received: " . TF::GOLD . $name . " " . TF::AQUA . Translator::romanNumber($level) . TF::GRAY . " (" . TF::WHITE . $success . "%" . TF::GRAY . ")");
            } else {
                $player->sendMessage(TF::RED . "Your inventory is full");
            }
        }

        # Godly Orb
        if ($hand->getNamedTag()->getString("LockedPickaxeEnchantOrb") == "godly") {

            # create orb
            $enchants = $utils->getPickaxeEnchant(CustomEnchant::RARITY_GODLY);
            $enchant = $enchants[array_rand($enchants)];
            $id = $enchant->getTypeId();
            $level = mt_rand(1, $enchant->getMaxLevel());
            $rarity = CustomEnchant::RARITY_GODLY;
            $name = $enchant->getName();
            $success = mt_rand(1, 100);

            # check if player inventory full
            if ($player->getInventory()->canAddItem($this->orbManager->EnchantedOrb($enchant, $level, $rarity, $id, $success))) {

                # remove Item
                $hand->setCount($count - 1);
                $player->getInventory()->setItemInHand($hand);

                # give item
                $player->getInventory()->addItem($this->orbManager->EnchantedOrb($enchant, $level, $rarity, $id, $success));

                # send particles
                FireworksParticle::instantFirework($player, Fireworks::COLOR_PINK);
                $player->sendMessage(TF::BOLD . TF::GRAY . "(!) " . TF::RESET . TF::GRAY . "You received: " . TF::LIGHT_PURPLE . $name . " " . TF::AQUA . Translator::romanNumber($level) . TF::GRAY . " (" . TF::WHITE . $success . "%" . TF::GRAY . ")");
            } else {
                $player->sendMessage(TF::RED . "Your inventory is full");
            }
        }

        # Heroic Orb
        if ($hand->getNamedTag()->getString("LockedPickaxeEnchantOrb") == "heroic") {

            # create orb
            $enchants = $utils->getPickaxeEnchant(CustomEnchant::RARITY_HEROIC);
            $enchant = $enchants[array_rand($enchants)];
            $id = $enchant->getTypeId();
            $level = mt_rand(1, $enchant->getMaxLevel());
            $rarity = CustomEnchant::RARITY_HEROIC;
            $name = $enchant->getName();
            $success = mt_rand(1, 100);

            # check if player inventory full
            if ($player->getInventory()->canAddItem($this->orbManager->EnchantedOrb($enchant, $level, $rarity, $id, $success))) {

                # remove Item
                $hand->setCount($count - 1);
                $player->getInventory()->setItemInHand($hand);

                # give item
                $player->getInventory()->addItem(($this->orbManager->EnchantedOrb($enchant, $level, $rarity, $id, $success)));

                # send particles
                FireworksParticle::instantFirework($player, Fireworks::COLOR_RED);
                $player->sendMessage(TF::BOLD . TF::GRAY . "(!) " . TF::RESET . TF::GRAY . "You received: " . TF::RED . $name . " " . TF::AQUA . Translator::romanNumber($level) . TF::GRAY . " (" . TF::WHITE . $success . "%" . TF::GRAY . ")");
            } else {
                $player->sendMessage(TF::RED . "Your inventory is full");
            }
        }
    }

    /**
     * @priority HIGHEST
     */
    public function onApplyEnergyOrbToPickaxeOrb(InventoryTransactionEvent $event): void
    {

        $player = $event->getTransaction()->getSource();
        $transaction = $event->getTransaction();
        $actions = array_values($transaction->getActions());

        if (count($actions) === 2) {
            foreach ($actions as $i => $action) {

                $itemClickedWith = $action->getTargetItem();
                $itemClicked = $action->getSourceItem();

                if ($action instanceof SlotChangeAction && ($otherAction = $actions[($i + 1) % 2]) instanceof SlotChangeAction && $itemClickedWith->getNamedTag()->getTag("EnergyOrb") && $itemClicked->getNamedTag()->getTag("OpenedPickaxeEnchantOrb")) {

                    $energyOrb = $itemClickedWith;
                    $pickaxeEnchantOrb = $itemClicked;

                    # cancel event
                    $event->cancel();

                    $applyOrbEnergySuccessful = false;
                    $allEnergyUsed = false;
                    $newOrbValue = 0;
                    $energyToAdd = 0;

                    # get energy data
                    $pickaxeOrbEnergy = $pickaxeEnchantOrb->getNamedTag()->getInt("Energy");
                    $pickaxeOrbEnergyNeeded = $pickaxeEnchantOrb->getNamedTag()->getInt("EnergyNeeded");
                    $energyOrbEnergy = $energyOrb->getNamedTag()->getInt("Energy");

                    if ($pickaxeOrbEnergy == $pickaxeOrbEnergyNeeded) {
                        $player->broadcastSound(new ClickSound(30), [$player]);
                        return;
                    }

                    # energy calculation
                    $newData = $pickaxeOrbEnergy + $energyOrbEnergy;

                    # check if user is adding more energy than needed
                    if ($newData > $pickaxeOrbEnergyNeeded) {
                        $energyToAdd = $pickaxeOrbEnergyNeeded - $pickaxeOrbEnergy;
                        $newOrbValue = $energyOrbEnergy - $energyToAdd;
                    }

                    if ($newOrbValue > 0) {

                        # add the energy
                        $pickaxeEnchantOrb->getNamedTag()->setInt("Energy", $pickaxeOrbEnergy + $energyToAdd);

                        # create new energy orb
                        $newEnergyOrb = EmporiumPrison::getInstance()->getOrbs()->EnergyOrb($newOrbValue);

                        # update items
                        $updatedOrb = EmporiumEnchants::getInstance()->getOrbManager()->updateOrb($pickaxeEnchantOrb);

                        # give player new items
                        $action->getInventory()->setItem($action->getSlot(), $updatedOrb);
                        $player->getCursorInventory()->removeItem($energyOrb);
                        $player->getCursorInventory()->addItem($newEnergyOrb);
                        $player->broadcastSound(new XpCollectSound(), [$player]);

                        $applyOrbEnergySuccessful = true;
                    }

                    if ($newOrbValue == 0) {
                        $pickaxeEnchantOrb->getNamedTag()->setInt("Energy", $newData);
                        $applyOrbEnergySuccessful = true;
                        $allEnergyUsed = true;
                    }

                    if ($allEnergyUsed) {
                        # remove energy orb
                        $otherAction->getInventory()->setItem($otherAction->getSlot(), BlockTypeIds::AIR);
                    }

                    # update orb if successful
                    if ($applyOrbEnergySuccessful) {
                        # update orb information
                        $updatedOrb = EmporiumEnchants::getInstance()->getOrbManager()->updateOrb($pickaxeEnchantOrb);

                        # give player new orb
                        $action->getInventory()->setItem($action->getSlot(), $updatedOrb);

                        $player->broadcastSound(new XpCollectSound(), [$player]);
                    }
                }
            }
        }
    }

    /**
     * @priority HIGHEST
     */
    public function onApplyOrbEnchant(InventoryTransactionEvent $event): void
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
                and $itemClickedWith->getNamedTag()->getTag("OpenedPickaxeEnchantOrb")
                and $itemClicked->getNamedTag()->getTag("PickaxeType")) {

                $pickaxeEnchantOrb = $itemClickedWith;
                $pickaxe = $itemClicked;

                $event->cancel();

                if (count($pickaxeEnchantOrb->getEnchantments()) < 1) return;

                $willChange = false;

                # orb data
                $orbEnergy = $pickaxeEnchantOrb->getNamedTag()->getInt("Energy");
                $orbEnergyNeeded = $pickaxeEnchantOrb->getNamedTag()->getInt("EnergyNeeded");
                $orbChance = $pickaxeEnchantOrb->getNamedTag()->getInt("Success");

                # generate random number
                $randomNumber = mt_rand(1, 100);

                if ($orbEnergy < $orbEnergyNeeded) {
                    $player->sendMessage(Variables::PREFIX . "You need to fill the Orb Energy to do that");
                    $player->broadcastSound(new DoorBumpSound(), [$player]);
                    return;
                }


                foreach ($pickaxeEnchantOrb->getEnchantments() as $enchantment) {
                    $enchantmentType = $enchantment->getType();
                    $newLevel = $enchantment->getLevel();
                    $existingEnchant = $pickaxe->getEnchantment($enchantmentType);
                }

                if (!isset($enchantmentType)) return;

                if (!$enchantmentType instanceof CustomEnchant) return;

                if ($enchantmentType->getItemType() === CustomEnchant::ITEM_TYPE_TOOLS) {
                    if (!Utils::itemMatchesItemType($pickaxe, $enchantmentType->getItemType()) || !Utils::checkEnchantIncompatibilities($pickaxe, $enchantmentType)) {
                        $player->sendMessage(Variables::PREFIX . "You can not apply this enchant to that item");
                        return;
                    }

                    $pickaxeEnergy = $pickaxe->getNamedTag()->getInt("Energy");
                    $pickaxeEnergyNeeded = EmporiumPrison::getInstance()->getPickaxeManager()->getEnergyNeeded($pickaxe);

                    if ($pickaxeEnergy < $pickaxeEnergyNeeded) {
                        $player->sendMessage(Variables::PREFIX . "You need to fill the Pickaxe Energy to do that");
                        return;
                    }


                    # does pickaxe have enchant already?
                    if ($existingEnchant !== null) {

                        if ($existingEnchant->getLevel() > $newLevel) {
                            $player->sendMessage(Variables::PREFIX . "Pickaxe already has this enchant with a higher level");
                            return;
                        }

                        if ($existingEnchant->getLevel() === $newLevel) {
                            $player->sendMessage(Variables::PREFIX . "Pickaxe already has this enchant with a equal level");
                            return;
                        }

                        # will get a new level
                        if ($existingEnchant->getLevel() < $newLevel) $willChange = true;

                    } else $willChange = true;


                    if (((!Utils::itemMatchesItemType($pickaxe, $enchantmentType->getItemType()) || !Utils::checkEnchantIncompatibilities($pickaxe, $enchantmentType))) ||
                        $pickaxe->getCount() !== 1 ||
                        $newLevel > $enchantmentType->getMaxLevel() ||
                        count($pickaxe->getEnchantments()) === 0) {
                        continue;
                    }
                    if ($randomNumber <= $orbChance) {
                        $player->sendMessage(TF::GREEN . "Enchant Success");
                        EmporiumPrison::getInstance()->getPickaxeManager()->addSuccessfulEnchant($player, $pickaxe);
                        $pickaxe->addEnchantment(new EnchantmentInstance($enchantmentType, $newLevel));
                    } else {
                        $player->sendMessage(TF::RED . "Enchant failed");
                        EmporiumPrison::getInstance()->getPickaxeManager()->addFailedEnchant($player, $pickaxe);
                    }
                    $player->broadcastSound(new TotemUseSound(), [$player]);
                }

                if ($willChange) {

                    # remove energy needed
                    EmporiumPrison::getInstance()->getPickaxeManager()->removeLevelUpEnergy($pickaxe);

                    # level up pickaxe
                    EmporiumPrison::getInstance()->getPickaxeManager()->levelUpPickaxe($pickaxe);
                    # sort enchantments (need to fix)
                    EmporiumPrison::getInstance()->getPickaxeManager()->sortEnchants($pickaxe);
                    # send level up animation
                    EmporiumPrison::getInstance()->getPickaxeManager()->levelUpAnimation($player);

                    # give player updated pickaxe
                    $action->getInventory()->setItem($action->getSlot(), $pickaxe);
                    $otherAction->getInventory()->setItem($otherAction->getSlot(), BlockTypeIds::AIR);
                }
            }
        }
    }
}