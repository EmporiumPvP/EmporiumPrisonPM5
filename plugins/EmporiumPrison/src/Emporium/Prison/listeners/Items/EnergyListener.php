<?php

namespace Emporium\Prison\listeners\Items;

use Emporium\Prison\EmporiumPrison;
use Emporium\Prison\items\Boosters;
use Emporium\Prison\items\Orbs;
use Emporium\Prison\Managers\EnergyManager;
use Emporium\Prison\Managers\PickaxeManager;
use Emporium\Prison\Variables;

use JsonException;

use pocketmine\event\inventory\InventoryTransactionEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerItemUseEvent;

use pocketmine\inventory\transaction\action\SlotChangeAction;
use pocketmine\item\ItemIds;
use pocketmine\item\VanillaItems;
use pocketmine\utils\TextFormat as TF;

use pocketmine\world\sound\BlazeShootSound;
use pocketmine\world\sound\XpCollectSound;
use pocketmine\world\sound\XpLevelUpSound;
use Tetro\EmporiumEnchants\Core\BookManager;
use Tetro\EmporiumEnchants\Loader;

class EnergyListener implements Listener {

    private EnergyManager $energyManager;
    private PickaxeManager $pickaxeManager;
    private BookManager $bookManager;
    private Boosters $boosters;
    private Orbs $orbs;

    public function __construct() {
        $this->energyManager = EmporiumPrison::getEnergyManager();
        $this->pickaxeManager = EmporiumPrison::getPickaxeManager();
        $this->bookManager = Loader::getBookManager();
        $this->boosters = EmporiumPrison::getBoosters();
        $this->orbs = EmporiumPrison::getOrbs();
    }

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
                    if($player->getInventory()->canAddItem($this->boosters->EnergyBooster(1.25))) {
                        # give player item
                        $player->getInventory()->addItem(($this->boosters->EnergyBooster(1.25)));
                        # send confirmation
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have received a " . TF::WHITE . "1.25x " . TF::GREEN . "Energy Booster.");
                        # remove 1 from stack
                        $hand->setCount($count - 1);
                        $player->getInventory()->setItemInHand($hand);
                        # play sound
                        $player->broadcastSound(new BlazeShootSound(), [$player]);
                    } else {
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::RED . "Your inventory is full.");
                    }
                    break;

                case 3:
                    if($player->getInventory()->canAddItem($this->boosters->EnergyBooster(1.5))) {
                        # give player item
                        $player->getInventory()->addItem(($this->boosters->EnergyBooster(1.5)));
                        # send confirmation
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have received a " . TF::WHITE . "1.5x " . TF::GREEN . "Energy Booster.");
                        # remove 1 from stack
                        $hand->setCount($count - 1);
                        $player->getInventory()->setItemInHand($hand);
                        # play sound
                        $player->broadcastSound(new BlazeShootSound(), [$player]);
                    } else {
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::RED . "Your inventory is full.");
                    }
                    break;

                case 4:
                    if($player->getInventory()->canAddItem($this->boosters->EnergyBooster(1.75))) {
                        # give player item
                        $player->getInventory()->addItem(($this->boosters->EnergyBooster(1.75)));
                        # send confirmation
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have received a " . TF::WHITE . "1.75x " . TF::GREEN . "Energy Booster.");
                        # remove 1 from stack
                        $hand->setCount($count - 1);
                        $player->getInventory()->setItemInHand($hand);
                        # play sound
                        $player->broadcastSound(new BlazeShootSound(), [$player]);
                    } else {
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::RED . "Your inventory is full.");
                    }
                    break;

                case 5:
                    if($player->getInventory()->canAddItem($this->boosters->EnergyBooster(2.0))) {
                        # give player item
                        $player->getInventory()->addItem(($this->boosters->EnergyBooster(2.0)));
                        # send confirmation
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have received a " . TF::WHITE . "2x " . TF::GREEN . "Energy Booster.");
                        # remove 1 from stack
                        $hand->setCount($count - 1);
                        $player->getInventory()->setItemInHand($hand);
                        # play sound
                        $player->broadcastSound(new BlazeShootSound(), [$player]);
                    } else {
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::RED . "Your inventory is full.");
                    }
                    break;

                case 6:
                    if($player->getInventory()->canAddItem($this->boosters->EnergyBooster(2.25))) {
                        # give player item
                        $player->getInventory()->addItem(($this->boosters->EnergyBooster(2.25)));
                        # send confirmation
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have received a " . TF::WHITE . "2.25x " . TF::GREEN . "Energy Booster.");
                        # remove 1 from stack
                        $hand->setCount($count - 1);
                        $player->getInventory()->setItemInHand($hand);
                        # play sound
                        $player->broadcastSound(new BlazeShootSound(), [$player]);
                    } else {
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::RED . "Your inventory is full.");
                    }
                    break;

                case 7:
                    if($player->getInventory()->canAddItem($this->boosters->EnergyBooster(2.5))) {
                        # give player item
                        $player->getInventory()->addItem(($this->boosters->EnergyBooster(2.5)));
                        # send confirmation
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have received a " . TF::WHITE . "2.5x " . TF::GREEN . "Energy Booster.");
                        # remove 1 from stack
                        $hand->setCount($count - 1);
                        $player->getInventory()->setItemInHand($hand);
                        # play sound
                        $player->broadcastSound(new BlazeShootSound(), [$player]);
                    } else {
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::RED . "Your inventory is full.");
                    }
                    break;

                case 8:
                    if($player->getInventory()->canAddItem($this->boosters->EnergyBooster(2.75))) {
                        # give player item
                        $player->getInventory()->addItem(($this->boosters->EnergyBooster(2.75)));
                        # send confirmation
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have received a " . TF::WHITE . "2.75x " . TF::GREEN . "Energy Booster.");
                        # remove 1 from stack
                        $hand->setCount($count - 1);
                        $player->getInventory()->setItemInHand($hand);
                        # play sound
                        $player->broadcastSound(new BlazeShootSound(), [$player]);
                    } else {
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::RED . "Your inventory is full.");
                    }
                    break;

                case 9:
                    if($player->getInventory()->canAddItem($this->boosters->EnergyBooster(3.0))) {
                        # give player item
                        $player->getInventory()->addItem(($this->boosters->EnergyBooster(3.0)));
                        # send confirmation
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have received a " . TF::WHITE . "3x " . TF::GREEN . "Energy Booster.");
                        # remove 1 from stack
                        $hand->setCount($count - 1);
                        $player->getInventory()->setItemInHand($hand);
                        # play sound
                        $player->broadcastSound(new BlazeShootSound(), [$player]);
                    } else {
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::RED . "Your inventory is full.");
                    }
                    break;

                case 10:
                    if($player->getInventory()->canAddItem($this->boosters->EnergyBooster(3.25))) {
                        # give player item
                        $player->getInventory()->addItem(($this->boosters->EnergyBooster(3.25)));
                        # send confirmation
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have received a " . TF::WHITE . "3.25x " . TF::GREEN . "Energy Booster.");
                        # remove 1 from stack
                        $hand->setCount($count - 1);
                        $player->getInventory()->setItemInHand($hand);
                        # play sound
                        $player->broadcastSound(new BlazeShootSound(), [$player]);
                    } else {
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::RED . "Your inventory is full.");
                    }
                    break;

                case 11:
                    if($player->getInventory()->canAddItem($this->boosters->EnergyBooster(3.5))) {
                        # give player item
                        $player->getInventory()->addItem(($this->boosters->EnergyBooster(3.5)));
                        # send confirmation
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have received a " . TF::WHITE . "3.5x " . TF::GREEN . "Energy Booster.");
                        # remove 1 from stack
                        $hand->setCount($count - 1);
                        $player->getInventory()->setItemInHand($hand);
                        # play sound
                        $player->broadcastSound(new BlazeShootSound(), [$player]);
                    } else {
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::RED . "Your inventory is full.");
                    }
                    break;
            }
        }

        if ($hand->getNamedTag()->getTag("EnergyBooster")) {
            $multiplier = $hand->getNamedTag()->getFloat("EnergyBooster");
            $activeMultiplier = $this->energyManager->getMultiplier($player);

            if ($activeMultiplier > 1) {
                if (!$multiplier == $activeMultiplier) {
                    $player->sendMessage(Variables::SERVER_PREFIX . "You already have an active Energy Booster.");
                } else {
                    $player->broadcastSound(new BlazeShootSound(), [$player]);
                    $hand->setCount($count - 1);
                    $player->getInventory()->setItemInHand($hand);
                    $this->energyManager->addTime($player);
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
                        $this->energyManager->start($player, $multiplier);
                        break;

                }
            }
        }
    }

    /**
     * @throws JsonException
     */
    public function onInteractBlock(PlayerInteractEvent $event) {
        $player = $event->getPlayer();
        $hand = $player->getInventory()->getItemInHand();
        $count = $hand->getCount();

        if ($hand->getNamedTag()->getTag("MysteryEnergyBooster")) {
            $booster = $hand->getNamedTag()->getInt("MysteryEnergyBooster");
            switch ($booster) {

                case 2:
                    if($player->getInventory()->canAddItem($this->boosters->EnergyBooster(1.25))) {
                        # give player item
                        $player->getInventory()->addItem(($this->boosters->EnergyBooster(1.25)));
                        # send confirmation
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have received a " . TF::WHITE . "1.25x " . TF::GREEN . "Energy Booster.");
                        # remove 1 from stack
                        $hand->setCount($count - 1);
                        $player->getInventory()->setItemInHand($hand);
                        # play sound
                        $player->broadcastSound(new BlazeShootSound(), [$player]);
                    } else {
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::RED . "Your inventory is full.");
                    }
                    break;

                case 3:
                    if($player->getInventory()->canAddItem($this->boosters->EnergyBooster(1.5))) {
                        # give player item
                        $player->getInventory()->addItem(($this->boosters->EnergyBooster(1.5)));
                        # send confirmation
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have received a " . TF::WHITE . "1.5x " . TF::GREEN . "Energy Booster.");
                        # remove 1 from stack
                        $hand->setCount($count - 1);
                        $player->getInventory()->setItemInHand($hand);
                        # play sound
                        $player->broadcastSound(new BlazeShootSound(), [$player]);
                    } else {
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::RED . "Your inventory is full.");
                    }
                    break;

                case 4:
                    if($player->getInventory()->canAddItem($this->boosters->EnergyBooster(1.75))) {
                        # give player item
                        $player->getInventory()->addItem(($this->boosters->EnergyBooster(1.75)));
                        # send confirmation
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have received a " . TF::WHITE . "1.75x " . TF::GREEN . "Energy Booster.");
                        # remove 1 from stack
                        $hand->setCount($count - 1);
                        $player->getInventory()->setItemInHand($hand);
                        # play sound
                        $player->broadcastSound(new BlazeShootSound(), [$player]);
                    } else {
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::RED . "Your inventory is full.");
                    }
                    break;

                case 5:
                    if($player->getInventory()->canAddItem($this->boosters->EnergyBooster(2.0))) {
                        # give player item
                        $player->getInventory()->addItem(($this->boosters->EnergyBooster(2.0)));
                        # send confirmation
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have received a " . TF::WHITE . "2x " . TF::GREEN . "Energy Booster.");
                        # remove 1 from stack
                        $hand->setCount($count - 1);
                        $player->getInventory()->setItemInHand($hand);
                        # play sound
                        $player->broadcastSound(new BlazeShootSound(), [$player]);
                    } else {
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::RED . "Your inventory is full.");
                    }
                    break;

                case 6:
                    if($player->getInventory()->canAddItem($this->boosters->EnergyBooster(2.25))) {
                        # give player item
                        $player->getInventory()->addItem(($this->boosters->EnergyBooster(2.25)));
                        # send confirmation
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have received a " . TF::WHITE . "2.25x " . TF::GREEN . "Energy Booster.");
                        # remove 1 from stack
                        $hand->setCount($count - 1);
                        $player->getInventory()->setItemInHand($hand);
                        # play sound
                        $player->broadcastSound(new BlazeShootSound(), [$player]);
                    } else {
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::RED . "Your inventory is full.");
                    }
                    break;

                case 7:
                    if($player->getInventory()->canAddItem($this->boosters->EnergyBooster(2.5))) {
                        # give player item
                        $player->getInventory()->addItem(($this->boosters->EnergyBooster(2.5)));
                        # send confirmation
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have received a " . TF::WHITE . "2.5x " . TF::GREEN . "Energy Booster.");
                        # remove 1 from stack
                        $hand->setCount($count - 1);
                        $player->getInventory()->setItemInHand($hand);
                        # play sound
                        $player->broadcastSound(new BlazeShootSound(), [$player]);
                    } else {
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::RED . "Your inventory is full.");
                    }
                    break;

                case 8:
                    if($player->getInventory()->canAddItem($this->boosters->EnergyBooster(2.75))) {
                        # give player item
                        $player->getInventory()->addItem(($this->boosters->EnergyBooster(2.75)));
                        # send confirmation
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have received a " . TF::WHITE . "2.75x " . TF::GREEN . "Energy Booster.");
                        # remove 1 from stack
                        $hand->setCount($count - 1);
                        $player->getInventory()->setItemInHand($hand);
                        # play sound
                        $player->broadcastSound(new BlazeShootSound(), [$player]);
                    } else {
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::RED . "Your inventory is full.");
                    }
                    break;

                case 9:
                    if($player->getInventory()->canAddItem($this->boosters->EnergyBooster(3.0))) {
                        # give player item
                        $player->getInventory()->addItem(($this->boosters->EnergyBooster(3.0)));
                        # send confirmation
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have received a " . TF::WHITE . "3x " . TF::GREEN . "Energy Booster.");
                        # remove 1 from stack
                        $hand->setCount($count - 1);
                        $player->getInventory()->setItemInHand($hand);
                        # play sound
                        $player->broadcastSound(new BlazeShootSound(), [$player]);
                    } else {
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::RED . "Your inventory is full.");
                    }
                    break;

                case 10:
                    if($player->getInventory()->canAddItem($this->boosters->EnergyBooster(3.25))) {
                        # give player item
                        $player->getInventory()->addItem(($this->boosters->EnergyBooster(3.25)));
                        # send confirmation
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have received a " . TF::WHITE . "3.25x " . TF::GREEN . "Energy Booster.");
                        # remove 1 from stack
                        $hand->setCount($count - 1);
                        $player->getInventory()->setItemInHand($hand);
                        # play sound
                        $player->broadcastSound(new BlazeShootSound(), [$player]);
                    } else {
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::RED . "Your inventory is full.");
                    }
                    break;

                case 11:
                    if($player->getInventory()->canAddItem($this->boosters->EnergyBooster(3.5))) {
                        # give player item
                        $player->getInventory()->addItem(($this->boosters->EnergyBooster(3.5)));
                        # send confirmation
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have received a " . TF::WHITE . "3.5x " . TF::GREEN . "Energy Booster.");
                        # remove 1 from stack
                        $hand->setCount($count - 1);
                        $player->getInventory()->setItemInHand($hand);
                        # play sound
                        $player->broadcastSound(new BlazeShootSound(), [$player]);
                    } else {
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::RED . "Your inventory is full.");
                    }
                    break;
            }
        }

        if ($hand->getNamedTag()->getTag("EnergyBooster")) {
            $multiplier = $hand->getNamedTag()->getFloat("EnergyBooster");
            $activeMultiplier = $this->energyManager->getMultiplier($player);

            if ($activeMultiplier > 1) {
                if (!$multiplier == $activeMultiplier) {
                    $player->sendMessage(Variables::SERVER_PREFIX . "You already have an active Energy Booster.");
                } else {
                    $player->broadcastSound(new BlazeShootSound(), [$player]);
                    $hand->setCount($count - 1);
                    $player->getInventory()->setItemInHand($hand);
                    $this->energyManager->addTime($player);
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
                        $this->energyManager->start($player, $multiplier);
                        break;

                }
            }
        }
    }

    /**
     * @priority HIGHEST
     */
    public function onApplyEnergyOrbToPickaxe(InventoryTransactionEvent $event): void {
        $player = $event->getTransaction()->getSource();
        $transaction = $event->getTransaction();
        $actions = array_values($transaction->getActions());
        $applyEnergySuccessful = false;

        if (count($actions) === 2) {
            foreach ($actions as $i => $action) {
                if ($action instanceof SlotChangeAction && ($otherAction = $actions[($i + 1) % 2]) instanceof SlotChangeAction && ($itemClickedWith = $action->getTargetItem())->getId() === ItemIds::DYE && ($itemClicked = $action->getSourceItem())->getId() !== ItemIds::AIR) {
                    if ($itemClickedWith->getNamedTag()->getString("EnergyOrb") === null) {
                        return;
                    }
                    if ($itemClickedWith->getNamedTag()->getTag("Energy") === null) {
                        return;
                    }
                    if ($itemClicked->getNamedTag()->getTag("PickaxeType") === null) {
                        return;
                    }
                    if ($itemClicked->getNamedTag()->getTag("Energy") === null) {
                        return;
                    } else {
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
                                $newEnergyOrb = $this->orbs->EnergyOrb($newOrbValue);
                                # update items
                                $updatedPickaxe = $this->pickaxeManager->updatePickaxe($itemClicked);
                                $event->cancel();
                                # give player new items
                                $action->getInventory()->setItem($action->getSlot(), $updatedPickaxe);
                                $otherAction->getInventory()->setItem($otherAction->getSlot(), $newEnergyOrb);
                                $player->broadcastSound(new XpCollectSound(), [$player]);
                                # set to false so energy orb doesnt get removed
                                $applyEnergySuccessful = false;
                            }
                        } else {
                            $itemClicked->getNamedTag()->setInt("Energy", $newData);
                            $applyEnergySuccessful = true;
                        }
                    }
                    if ($applyEnergySuccessful) {
                        # update pickaxe information
                        $updatedPickaxe = $this->pickaxeManager->updatePickaxe($itemClicked);
                        # remove energy orb
                        $event->cancel();
                        # give player new pickaxe
                        $action->getInventory()->setItem($action->getSlot(), $updatedPickaxe);
                        # remove energy orb
                        $otherAction->getInventory()->setItem($otherAction->getSlot(), VanillaItems::AIR());
                        $player->broadcastSound(new XpCollectSound(), [$player]);
                    }
                }
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
        $applyPickaxeEnergySuccessful = false;
        $applyBookEnergySuccessful = false;

        if (count($actions) === 2) {
            foreach ($actions as $i => $action) {
                if ($action instanceof SlotChangeAction && ($otherAction = $actions[($i + 1) % 2]) instanceof SlotChangeAction && ($itemClickedWith = $action->getTargetItem())->getId() === ItemIds::DYE && ($itemClicked = $action->getSourceItem())->getId() !== ItemIds::AIR) {
                    if($itemClickedWith->getMeta() !== 12) {
                        return;
                    }
                    if ($itemClickedWith->getNamedTag()->getString("EnergyOrb") === null) {
                        return;
                    }
                    if ($itemClickedWith->getNamedTag()->getTag("Energy") === null) {
                        return;
                    }
                    # is item pickaxe or enchant book?
                    if ($itemClicked->getNamedTag()->getTag("CustomEnchantBook") === null) {
                        return;
                    }
                    # does item have energy?
                    if ($itemClicked->getNamedTag()->getTag("Energy") === null) {
                        return;
                    } else {
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
                                $newEnergyOrb = $this->orbs->EnergyOrb($newOrbValue);
                                # update items
                                $updatedBook = $this->bookManager->updateBook($itemClicked);
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
                    }

                    # update book if successful
                    if ($applyBookEnergySuccessful) {
                        # update book information
                        $updatedBook = $this->bookManager->updateBook($itemClicked);
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