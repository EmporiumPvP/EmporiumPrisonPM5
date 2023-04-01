<?php

namespace Emporium\Prison\listeners\Items;

use Emporium\Prison\EmporiumPrison;
use Emporium\Prison\Variables;

use JsonException;

use pocketmine\event\inventory\InventoryTransactionEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerItemUseEvent;
use pocketmine\inventory\transaction\action\SlotChangeAction;
use pocketmine\item\ItemIds;
use pocketmine\item\VanillaItems;
use pocketmine\utils\TextFormat as TF;
use pocketmine\world\sound\BlazeShootSound;
use pocketmine\world\sound\XpCollectSound;
use pocketmine\world\sound\XpLevelUpSound;

class EnergyListener implements Listener {

    /**
     * @throws JsonException
     */
    public function onInteractAir(PlayerItemUseEvent $event) {
        $player = $event->getPlayer();
        $hand = $player->getInventory()->getItemInHand();
        $count = $hand->getCount();

        if ($hand->getNamedTag()->getTag("MysteryEnergyBooster")) {
            $booster = $hand->getNamedTag()->getInt("MysteryEnergyBooster");
            switch ($booster) {

                case 2:
                    if($player->getInventory()->canAddItem(EmporiumPrison::getInstance()->getBoosters()->EnergyBooster(1.25))) {
                        # give player item
                        $player->getInventory()->addItem((EmporiumPrison::getInstance()->getBoosters()->EnergyBooster(1.25)));
                        # send confirmation
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have received a " . TF::WHITE . "1.25x " . TF::GREEN . "Energy Booster.");
                        # remove 1 from stack
                        $hand->setCount($count - 1);
                        $player->getInventory()->setItemInHand($hand);
                        # play sound
                        $player->broadcastSound(new BlazeShootSound(), [$player]);
                    } else {
                        $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RED . "Your inventory is full.");
                    }
                    break;

                case 3:
                    if($player->getInventory()->canAddItem(EmporiumPrison::getInstance()->getBoosters()->EnergyBooster(1.5))) {
                        # give player item
                        $player->getInventory()->addItem((EmporiumPrison::getInstance()->getBoosters()->EnergyBooster(1.5)));
                        # send confirmation
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have received a " . TF::WHITE . "1.5x " . TF::GREEN . "Energy Booster.");
                        # remove 1 from stack
                        $hand->setCount($count - 1);
                        $player->getInventory()->setItemInHand($hand);
                        # play sound
                        $player->broadcastSound(new BlazeShootSound(), [$player]);
                    } else {
                        $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RED . "Your inventory is full.");
                    }
                    break;

                case 4:
                    if($player->getInventory()->canAddItem(EmporiumPrison::getInstance()->getBoosters()->EnergyBooster(1.75))) {
                        # give player item
                        $player->getInventory()->addItem((EmporiumPrison::getInstance()->getBoosters()->EnergyBooster(1.75)));
                        # send confirmation
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have received a " . TF::WHITE . "1.75x " . TF::GREEN . "Energy Booster.");
                        # remove 1 from stack
                        $hand->setCount($count - 1);
                        $player->getInventory()->setItemInHand($hand);
                        # play sound
                        $player->broadcastSound(new BlazeShootSound(), [$player]);
                    } else {
                        $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RED . "Your inventory is full.");
                    }
                    break;

                case 5:
                    if($player->getInventory()->canAddItem(EmporiumPrison::getInstance()->getBoosters()->EnergyBooster(2.0))) {
                        # give player item
                        $player->getInventory()->addItem((EmporiumPrison::getInstance()->getBoosters()->EnergyBooster(2.0)));
                        # send confirmation
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have received a " . TF::WHITE . "2x " . TF::GREEN . "Energy Booster.");
                        # remove 1 from stack
                        $hand->setCount($count - 1);
                        $player->getInventory()->setItemInHand($hand);
                        # play sound
                        $player->broadcastSound(new BlazeShootSound(), [$player]);
                    } else {
                        $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RED . "Your inventory is full.");
                    }
                    break;

                case 6:
                    if($player->getInventory()->canAddItem(EmporiumPrison::getInstance()->getBoosters()->EnergyBooster(2.25))) {
                        # give player item
                        $player->getInventory()->addItem((EmporiumPrison::getInstance()->getBoosters()->EnergyBooster(2.25)));
                        # send confirmation
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have received a " . TF::WHITE . "2.25x " . TF::GREEN . "Energy Booster.");
                        # remove 1 from stack
                        $hand->setCount($count - 1);
                        $player->getInventory()->setItemInHand($hand);
                        # play sound
                        $player->broadcastSound(new BlazeShootSound(), [$player]);
                    } else {
                        $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RED . "Your inventory is full.");
                    }
                    break;

                case 7:
                    if($player->getInventory()->canAddItem(EmporiumPrison::getInstance()->getBoosters()->EnergyBooster(2.5))) {
                        # give player item
                        $player->getInventory()->addItem((EmporiumPrison::getInstance()->getBoosters()->EnergyBooster(2.5)));
                        # send confirmation
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have received a " . TF::WHITE . "2.5x " . TF::GREEN . "Energy Booster.");
                        # remove 1 from stack
                        $hand->setCount($count - 1);
                        $player->getInventory()->setItemInHand($hand);
                        # play sound
                        $player->broadcastSound(new BlazeShootSound(), [$player]);
                    } else {
                        $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RED . "Your inventory is full.");
                    }
                    break;

                case 8:
                    if($player->getInventory()->canAddItem(EmporiumPrison::getInstance()->getBoosters()->EnergyBooster(2.75))) {
                        # give player item
                        $player->getInventory()->addItem((EmporiumPrison::getInstance()->getBoosters()->EnergyBooster(2.75)));
                        # send confirmation
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have received a " . TF::WHITE . "2.75x " . TF::GREEN . "Energy Booster.");
                        # remove 1 from stack
                        $hand->setCount($count - 1);
                        $player->getInventory()->setItemInHand($hand);
                        # play sound
                        $player->broadcastSound(new BlazeShootSound(), [$player]);
                    } else {
                        $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RED . "Your inventory is full.");
                    }
                    break;

                case 9:
                    if($player->getInventory()->canAddItem(EmporiumPrison::getInstance()->getBoosters()->EnergyBooster(3.0))) {
                        # give player item
                        $player->getInventory()->addItem((EmporiumPrison::getInstance()->getBoosters()->EnergyBooster(3.0)));
                        # send confirmation
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have received a " . TF::WHITE . "3x " . TF::GREEN . "Energy Booster.");
                        # remove 1 from stack
                        $hand->setCount($count - 1);
                        $player->getInventory()->setItemInHand($hand);
                        # play sound
                        $player->broadcastSound(new BlazeShootSound(), [$player]);
                    } else {
                        $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RED . "Your inventory is full.");
                    }
                    break;

                case 10:
                    if($player->getInventory()->canAddItem(EmporiumPrison::getInstance()->getBoosters()->EnergyBooster(3.25))) {
                        # give player item
                        $player->getInventory()->addItem((EmporiumPrison::getInstance()->getBoosters()->EnergyBooster(3.25)));
                        # send confirmation
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have received a " . TF::WHITE . "3.25x " . TF::GREEN . "Energy Booster.");
                        # remove 1 from stack
                        $hand->setCount($count - 1);
                        $player->getInventory()->setItemInHand($hand);
                        # play sound
                        $player->broadcastSound(new BlazeShootSound(), [$player]);
                    } else {
                        $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RED . "Your inventory is full.");
                    }
                    break;

                case 11:
                    if($player->getInventory()->canAddItem(EmporiumPrison::getInstance()->getBoosters()->EnergyBooster(3.5))) {
                        # give player item
                        $player->getInventory()->addItem((EmporiumPrison::getInstance()->getBoosters()->EnergyBooster(3.5)));
                        # send confirmation
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have received a " . TF::WHITE . "3.5x " . TF::GREEN . "Energy Booster.");
                        # remove 1 from stack
                        $hand->setCount($count - 1);
                        $player->getInventory()->setItemInHand($hand);
                        # play sound
                        $player->broadcastSound(new BlazeShootSound(), [$player]);
                    } else {
                        $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RED . "Your inventory is full.");
                    }
                    break;
            }
        }

        if ($hand->getNamedTag()->getTag("EnergyBooster")) {
            $multiplier = $hand->getNamedTag()->getFloat("EnergyBooster");
            $activeMultiplier = EmporiumPrison::getInstance()->getEnergyManager()->getMultiplier($player);

            if ($activeMultiplier > 1) {
                if (!$multiplier == $activeMultiplier) {
                    $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RED . "You already have an active Energy Booster.");
                } else {
                    $player->broadcastSound(new BlazeShootSound(), [$player]);
                    $hand->setCount($count - 1);
                    $player->getInventory()->setItemInHand($hand);
                    EmporiumPrison::getInstance()->getEnergyManager()->addTime($player);
                }
            } else {
                switch ($multiplier) {

                    case 1.5:
                    case 1.75:
                    case 2.0:
                    case 2.25:
                    case 2.5:
                    case 2.75:
                    case 3.0:
                    case 3.25:
                    case 3.5:
                    case 1.25:
                        $hand->setCount($count - 1);
                        $player->getInventory()->setItemInHand($hand);

                        $player->broadcastSound(new XpLevelUpSound(mt_rand(1, 10)), [$player]);

                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have applied a " . TF::WHITE . $multiplier . "x" . TF::AQUA . " Energy Booster");
                        EmporiumPrison::getInstance()->getEnergyManager()->start($player, $multiplier);
                        break;

                }
            }
        }
    }

    /**
     * @priority HIGHEST
     */
    public function applyEnergyToEnergyOrPickaxe(InventoryTransactionEvent $event): void {
        $player = $event->getTransaction()->getSource();
        $transaction = $event->getTransaction();
        $actions = array_values($transaction->getActions());

        if (count($actions) === 2) {
            foreach ($actions as $i => $action) {
                if ($action instanceof SlotChangeAction && ($otherAction = $actions[($i + 1) % 2]) instanceof SlotChangeAction && ($itemClickedWith = $action->getTargetItem())->getId() === ItemIds::DYE && ($itemClicked = $action->getSourceItem())->getId() !== ItemIds::AIR) {
                    # item clicked with has to be an energy orb
                    if ($itemClickedWith->getNamedTag()->getTag("EnergyOrb") === null) return;
                    # item clicked with has to have energy
                    if ($itemClickedWith->getNamedTag()->getTag("Energy") === null) return;
                    # cancel event
                    $event->cancel();
                    # item clicked has to be pickaxe or energy orb
                    if($itemClicked->getNamedTag()->getTag("EnergyOrb") !== null) {
                        # get energy data
                        $energyOrb1Energy = $itemClickedWith->getNamedTag()->getInt("Energy");
                        $energyOrb2Energy = $itemClicked->getNamedTag()->getInt("Energy");
                        $newEnergyData = $energyOrb1Energy + $energyOrb2Energy;
                        if($newEnergyData > 2000000000) {
                            $maxApplicableEnergy = 2000000000 - $energyOrb1Energy;
                            if($maxApplicableEnergy > 0) {
                                $energyToAdd = $maxApplicableEnergy + $energyOrb1Energy;
                                # add the energy
                                $itemClicked->getNamedTag()->setInt("Energy", $energyToAdd);
                                # create new energy orb
                                $newOrbValue = $energyOrb1Energy - $maxApplicableEnergy;
                                $newEnergyOrb = EmporiumPrison::getInstance()->getOrbs()->EnergyOrb($newOrbValue);
                                # update items
                                $updatedEnergyOrb = EmporiumPrison::getInstance()->getOrbs()->EnergyOrb($newOrbValue);
                                $event->cancel();
                                # give player new items
                                $action->getInventory()->setItem($action->getSlot(), $updatedEnergyOrb);
                                $otherAction->getInventory()->setItem($otherAction->getSlot(), $newEnergyOrb);
                                $player->broadcastSound(new XpCollectSound(), [$player]);
                                # set to false so energy orb doesnt get removed
                                return;
                            }
                        } else {
                            $newEnergyOrb = EmporiumPrison::getInstance()->getOrbs()->EnergyOrb($newEnergyData);
                            # remove energy orb
                            # give player new pickaxe
                            $action->getInventory()->setItem($action->getSlot(), $newEnergyOrb);
                            # remove energy orb
                            $otherAction->getInventory()->setItem($otherAction->getSlot(), VanillaItems::AIR());
                            $player->broadcastSound(new XpCollectSound(), [$player]);
                            return;
                        }
                    }

                    if($itemClicked->getNamedTag()->getTag("PickaxeType") !== null) {
                        # cancel event
                        $event->cancel();
                        # get energy data
                        $pickaxeEnergy = $itemClicked->getNamedTag()->getInt("Energy");
                        $energyOrb = $itemClickedWith->getNamedTag()->getInt("Energy");
                        # energy calculation
                        $newData = $pickaxeEnergy + $energyOrb;
                        # add max amount of energy (if newData more than 2B)
                        if($newData > 2000000000) {
                            $maxApplicableEnergy = 2000000000 - $pickaxeEnergy;
                            if($maxApplicableEnergy > 0) {
                                $energyToAdd = $maxApplicableEnergy + $pickaxeEnergy;
                                # add the energy
                                $itemClicked->getNamedTag()->setInt("Energy", $energyToAdd);
                                # create new energy orb
                                $newOrbValue = $energyOrb - $maxApplicableEnergy;
                                $newEnergyOrb = EmporiumPrison::getInstance()->getOrbs()->EnergyOrb($newOrbValue);
                                # update items
                                $updatedPickaxe = EmporiumPrison::getInstance()->getPickaxeManager()->updatePickaxe($itemClicked);
                                $event->cancel();
                                # give player new items
                                $action->getInventory()->setItem($action->getSlot(), $updatedPickaxe);
                                $otherAction->getInventory()->setItem($otherAction->getSlot(), $newEnergyOrb);
                                $player->broadcastSound(new XpCollectSound(), [$player]);
                                return;
                            }
                        } else {
                            # set new energy data
                            $itemClicked->getNamedTag()->setInt("Energy", $newData);
                            # update pickaxe information
                            $updatedPickaxe = EmporiumPrison::getInstance()->getPickaxeManager()->updatePickaxe($itemClicked);
                            # give player new pickaxe
                            $action->getInventory()->setItem($action->getSlot(), $updatedPickaxe);
                            # remove energy orb
                            $otherAction->getInventory()->setItem($otherAction->getSlot(), VanillaItems::AIR());
                            # play sound
                            $player->broadcastSound(new XpCollectSound(), [$player]);
                            return;
                        }
                    } else {
                        return;
                    }
                }
            }
        }
    }
}