<?php

namespace Emporium\Prison\listeners\Items;

use Emporium\Prison\EmporiumPrison;
use Emporium\Prison\items\Boosters;
use Emporium\Prison\Managers\MiningManager;
use Emporium\Prison\Variables;

use JsonException;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerItemUseEvent;
use pocketmine\utils\TextFormat as TF;
use pocketmine\world\sound\BlazeShootSound;

class BoosterListener implements Listener {


    private MiningManager $miningManager;
    private Boosters $boosters;

    public function __construct() {
        $this->miningManager = EmporiumPrison::getMiningManager();
        $this->boosters = EmporiumPrison::getBoosters();
    }

    /**
     * @throws JsonException
     */
    public function BoosterUseAir(PlayerItemUseEvent $event) {

        $player = $event->getPlayer();
        $hand = $player->getInventory()->getItemInHand();
        $count = $hand->getCount();

        if ($hand->getNamedTag()->getTag("MysteryMiningXpBooster")) {
            $booster = $hand->getNamedTag()->getInt("MysteryMiningXpBooster");
            switch($booster) {

                case 2:
                    if($player->getInventory()->canAddItem($this->boosters->MiningXpBooster(1.25))) {
                        # give player item
                        $player->getInventory()->addItem($this->boosters->MiningXpBooster(1.25));
                        # send confirmation
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have received a " . TF::WHITE . "1.25x " . TF::GREEN . "Mining XP Booster.");
                        # remove item from stack
                        $hand->setCount($count - 1);
                        $player->getInventory()->setItemInHand($hand);
                        # send sound
                        $player->broadcastSound(new BlazeShootSound(), [$player]);
                    } else {
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::RED . "Your inventory is full.");
                    }
                    break;

                case 3:
                    if($player->getInventory()->canAddItem($this->boosters->MiningXpBooster(1.5))) {
                        # give player item
                        $player->getInventory()->addItem($this->boosters->MiningXpBooster(1.5));
                        # send confirmation
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have received a " . TF::WHITE . "1.5x " . TF::GREEN . "Mining XP Booster.");
                        # remove item from stack
                        $hand->setCount($count - 1);
                        $player->getInventory()->setItemInHand($hand);
                        # send sound
                        $player->broadcastSound(new BlazeShootSound(), [$player]);
                    } else {
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::RED . "Your inventory is full.");
                    }
                    break;

                case 4:
                    if($player->getInventory()->canAddItem($this->boosters->MiningXpBooster(1.75))) {
                        # give player item
                        $player->getInventory()->addItem($this->boosters->MiningXpBooster(1.75));
                        # send confirmation
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have received a " . TF::WHITE . "1.75x " . TF::GREEN . "Mining XP Booster.");
                        # remove item from stack
                        $hand->setCount($count - 1);
                        $player->getInventory()->setItemInHand($hand);
                        # send sound
                        $player->broadcastSound(new BlazeShootSound(), [$player]);
                    } else {
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::RED . "Your inventory is full.");
                    }
                    break;

                case 5:
                    if($player->getInventory()->canAddItem($this->boosters->MiningXpBooster(2.0))) {
                        # give player item
                        $player->getInventory()->addItem($this->boosters->MiningXpBooster(2.0));
                        # send confirmation
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have received a " . TF::WHITE . "2x " . TF::GREEN . "Mining XP Booster.");
                        # remove item from stack
                        $hand->setCount($count - 1);
                        $player->getInventory()->setItemInHand($hand);
                        # send sound
                        $player->broadcastSound(new BlazeShootSound(), [$player]);
                    } else {
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::RED . "Your inventory is full.");
                    }
                    break;

                case 6:
                    if($player->getInventory()->canAddItem($this->boosters->MiningXpBooster(2.25))) {
                        # give player item
                        $player->getInventory()->addItem($this->boosters->MiningXpBooster(2.25));
                        # send confirmation
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have received a " . TF::WHITE . "2.25x " . TF::GREEN . "Mining XP Booster.");
                        # remove item from stack
                        $hand->setCount($count - 1);
                        $player->getInventory()->setItemInHand($hand);
                        # send sound
                        $player->broadcastSound(new BlazeShootSound(), [$player]);
                    } else {
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::RED . "Your inventory is full.");
                    }
                    break;

                case 7:
                    if($player->getInventory()->canAddItem($this->boosters->MiningXpBooster(2.5))) {
                        # give player item
                        $player->getInventory()->addItem($this->boosters->MiningXpBooster(2.5));
                        # send confirmation
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have received a " . TF::WHITE . "2.5x " . TF::GREEN . "Mining XP Booster.");
                        # remove item from stack
                        $hand->setCount($count - 1);
                        $player->getInventory()->setItemInHand($hand);
                        # send sound
                        $player->broadcastSound(new BlazeShootSound(), [$player]);
                    } else {
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::RED . "Your inventory is full.");
                    }
                    break;

                case 8:
                    if($player->getInventory()->canAddItem($this->boosters->MiningXpBooster(2.75))) {
                        # give player item
                        $player->getInventory()->addItem($this->boosters->MiningXpBooster(2.75));
                        # send confirmation
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have received a " . TF::WHITE . "2.75x " . TF::GREEN . "Mining XP Booster.");
                        # remove item from stack
                        $hand->setCount($count - 1);
                        $player->getInventory()->setItemInHand($hand);
                        # send sound
                        $player->broadcastSound(new BlazeShootSound(), [$player]);
                    } else {
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::RED . "Your inventory is full.");
                    }
                    break;

                case 9:
                    if($player->getInventory()->canAddItem($this->boosters->MiningXpBooster(3.0))) {
                        # give player item
                        $player->getInventory()->addItem($this->boosters->MiningXpBooster(3.0));
                        # send confirmation
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have received a " . TF::WHITE . "3x " . TF::GREEN . "Mining XP Booster.");
                        # remove item from stack
                        $hand->setCount($count - 1);
                        $player->getInventory()->setItemInHand($hand);
                        # send sound
                        $player->broadcastSound(new BlazeShootSound(), [$player]);
                    } else {
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::RED . "Your inventory is full.");
                    }
                    break;

                case 10:
                    if($player->getInventory()->canAddItem($this->boosters->MiningXpBooster(3.25))) {
                        # give player item
                        $player->getInventory()->addItem($this->boosters->MiningXpBooster(3.25));
                        # send confirmation
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have received a " . TF::WHITE . "3.25x " . TF::GREEN . "Mining XP Booster.");
                        # remove item from stack
                        $hand->setCount($count - 1);
                        $player->getInventory()->setItemInHand($hand);
                        # send sound
                        $player->broadcastSound(new BlazeShootSound(), [$player]);
                    } else {
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::RED . "Your inventory is full.");
                    }
                    break;

                case 11:
                    if($player->getInventory()->canAddItem($this->boosters->MiningXpBooster(3.5))) {
                        # give player item
                        $player->getInventory()->addItem($this->boosters->MiningXpBooster(3.5));
                        # send confirmation
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have received a " . TF::WHITE . "3.5x " . TF::GREEN . "Mining XP Booster.");
                        # remove item from stack
                        $hand->setCount($count - 1);
                        $player->getInventory()->setItemInHand($hand);
                        # send sound
                        $player->broadcastSound(new BlazeShootSound(), [$player]);
                    } else {
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::RED . "Your inventory is full.");
                    }
                    break;
            }
        }

        if($hand->getNamedTag()->getTag("MiningXpBooster")) {
            $multiplier = $hand->getNamedTag()->getFloat("MiningXpBooster");
            $activeMultiplier = $this->miningManager->getMultiplier($player);

            if($activeMultiplier > 1) {
                if($multiplier !== $activeMultiplier) {
                    $player->sendMessage(Variables::SERVER_PREFIX . "You already have an active Mining XP Booster.");
                } else {
                    $player->broadcastSound(new BlazeShootSound(), [$player]);
                    $hand->setCount($count - 1);
                    $player->getInventory()->setItemInHand($hand);
                    $this->miningManager->addTime($player);
                }
            } else {
                switch($multiplier) {

                    case 1.25:
                    case 1.5:
                    case 1.75:
                    case 2.0:
                    case 2.25:
                    case 2.5:
                    case 2.75:
                    case 3.0:
                    case 3.25:
                    case 3.5:
                        $hand->setCount($count - 1);
                        $player->getInventory()->setItemInHand($hand);

                        $player->broadcastSound(new BlazeShootSound(), [$player]);

                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have applied a " . TF::WHITE . $multiplier . "x" . TF::AQUA . " Mining XP Booster");
                        $this->miningManager->start($player, $multiplier);
                        break;

                }
            }
        }
    }

    /**
     * @throws JsonException
     */
    public function BoosterUseBlock(PlayerInteractEvent $event) {

        $player = $event->getPlayer();
        $hand = $player->getInventory()->getItemInHand();
        $count = $hand->getCount();

        if ($hand->getNamedTag()->getTag("MysteryMiningXpBooster")) {
            $booster = $hand->getNamedTag()->getInt("MysteryMiningXpBooster");
            switch($booster) {

                case 2:
                    if($player->getInventory()->canAddItem($this->boosters->MiningXpBooster(1.25))) {
                        # give player item
                        $player->getInventory()->addItem($this->boosters->MiningXpBooster(1.25));
                        # send confirmation
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have received a " . TF::WHITE . "1.25x " . TF::GREEN . "Mining XP Booster.");
                        # remove item from stack
                        $hand->setCount($count - 1);
                        $player->getInventory()->setItemInHand($hand);
                        # send sound
                        $player->broadcastSound(new BlazeShootSound(), [$player]);
                    } else {
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::RED . "Your inventory is full.");
                    }
                    break;

                case 3:
                    if($player->getInventory()->canAddItem($this->boosters->MiningXpBooster(1.5))) {
                        # give player item
                        $player->getInventory()->addItem($this->boosters->MiningXpBooster(1.5));
                        # send confirmation
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have received a " . TF::WHITE . "1.5x " . TF::GREEN . "Mining XP Booster.");
                        # remove item from stack
                        $hand->setCount($count - 1);
                        $player->getInventory()->setItemInHand($hand);
                        # send sound
                        $player->broadcastSound(new BlazeShootSound(), [$player]);
                    } else {
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::RED . "Your inventory is full.");
                    }
                    break;

                case 4:
                    if($player->getInventory()->canAddItem($this->boosters->MiningXpBooster(1.75))) {
                        # give player item
                        $player->getInventory()->addItem($this->boosters->MiningXpBooster(1.75));
                        # send confirmation
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have received a " . TF::WHITE . "1.75x " . TF::GREEN . "Mining XP Booster.");
                        # remove item from stack
                        $hand->setCount($count - 1);
                        $player->getInventory()->setItemInHand($hand);
                        # send sound
                        $player->broadcastSound(new BlazeShootSound(), [$player]);
                    } else {
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::RED . "Your inventory is full.");
                    }
                    break;

                case 5:
                    if($player->getInventory()->canAddItem($this->boosters->MiningXpBooster(2.0))) {
                        # give player item
                        $player->getInventory()->addItem($this->boosters->MiningXpBooster(2.0));
                        # send confirmation
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have received a " . TF::WHITE . "2x " . TF::GREEN . "Mining XP Booster.");
                        # remove item from stack
                        $hand->setCount($count - 1);
                        $player->getInventory()->setItemInHand($hand);
                        # send sound
                        $player->broadcastSound(new BlazeShootSound(), [$player]);
                    } else {
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::RED . "Your inventory is full.");
                    }
                    break;

                case 6:
                    if($player->getInventory()->canAddItem($this->boosters->MiningXpBooster(2.25))) {
                        # give player item
                        $player->getInventory()->addItem($this->boosters->MiningXpBooster(2.25));
                        # send confirmation
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have received a " . TF::WHITE . "2.25x " . TF::GREEN . "Mining XP Booster.");
                        # remove item from stack
                        $hand->setCount($count - 1);
                        $player->getInventory()->setItemInHand($hand);
                        # send sound
                        $player->broadcastSound(new BlazeShootSound(), [$player]);
                    } else {
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::RED . "Your inventory is full.");
                    }
                    break;

                case 7:
                    if($player->getInventory()->canAddItem($this->boosters->MiningXpBooster(2.5))) {
                        # give player item
                        $player->getInventory()->addItem($this->boosters->MiningXpBooster(2.5));
                        # send confirmation
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have received a " . TF::WHITE . "2.5x " . TF::GREEN . "Mining XP Booster.");
                        # remove item from stack
                        $hand->setCount($count - 1);
                        $player->getInventory()->setItemInHand($hand);
                        # send sound
                        $player->broadcastSound(new BlazeShootSound(), [$player]);
                    } else {
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::RED . "Your inventory is full.");
                    }
                    break;

                case 8:
                    if($player->getInventory()->canAddItem($this->boosters->MiningXpBooster(2.75))) {
                        # give player item
                        $player->getInventory()->addItem($this->boosters->MiningXpBooster(2.75));
                        # send confirmation
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have received a " . TF::WHITE . "2.75x " . TF::GREEN . "Mining XP Booster.");
                        # remove item from stack
                        $hand->setCount($count - 1);
                        $player->getInventory()->setItemInHand($hand);
                        # send sound
                        $player->broadcastSound(new BlazeShootSound(), [$player]);
                    } else {
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::RED . "Your inventory is full.");
                    }
                    break;

                case 9:
                    if($player->getInventory()->canAddItem($this->boosters->MiningXpBooster(3.0))) {
                        # give player item
                        $player->getInventory()->addItem($this->boosters->MiningXpBooster(3.0));
                        # send confirmation
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have received a " . TF::WHITE . "3x " . TF::GREEN . "Mining XP Booster.");
                        # remove item from stack
                        $hand->setCount($count - 1);
                        $player->getInventory()->setItemInHand($hand);
                        # send sound
                        $player->broadcastSound(new BlazeShootSound(), [$player]);
                    } else {
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::RED . "Your inventory is full.");
                    }
                    break;

                case 10:
                    if($player->getInventory()->canAddItem($this->boosters->MiningXpBooster(3.25))) {
                        # give player item
                        $player->getInventory()->addItem($this->boosters->MiningXpBooster(3.25));
                        # send confirmation
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have received a " . TF::WHITE . "3.25x " . TF::GREEN . "Mining XP Booster.");
                        # remove item from stack
                        $hand->setCount($count - 1);
                        $player->getInventory()->setItemInHand($hand);
                        # send sound
                        $player->broadcastSound(new BlazeShootSound(), [$player]);
                    } else {
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::RED . "Your inventory is full.");
                    }
                    break;

                case 11:
                    if($player->getInventory()->canAddItem($this->boosters->MiningXpBooster(3.5))) {
                        # give player item
                        $player->getInventory()->addItem($this->boosters->MiningXpBooster(3.5));
                        # send confirmation
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have received a " . TF::WHITE . "3.5x " . TF::GREEN . "Mining XP Booster.");
                        # remove item from stack
                        $hand->setCount($count - 1);
                        $player->getInventory()->setItemInHand($hand);
                        # send sound
                        $player->broadcastSound(new BlazeShootSound(), [$player]);
                    } else {
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::RED . "Your inventory is full.");
                    }
                    break;
            }
        }

        if($hand->getNamedTag()->getTag("MiningXpBooster")) {
            $multiplier = $hand->getNamedTag()->getFloat("MiningXpBooster");
            $activeMultiplier = $this->miningManager->getMultiplier($player);

            if($activeMultiplier > 1) {
                if($multiplier !== $activeMultiplier) {
                    $player->sendMessage(Variables::SERVER_PREFIX . "You already have an active Mining XP Booster.");
                } else {
                    $player->broadcastSound(new BlazeShootSound(), [$player]);
                    $hand->setCount($count - 1);
                    $player->getInventory()->setItemInHand($hand);
                    $this->miningManager->addTime($player);
                }
            } else {
                switch($multiplier) {

                    case 1.25:
                    case 1.5:
                    case 1.75:
                    case 2.0:
                    case 2.25:
                    case 2.5:
                    case 2.75:
                    case 3.0:
                    case 3.25:
                    case 3.5:
                        $hand->setCount($count - 1);
                        $player->getInventory()->setItemInHand($hand);

                        $player->broadcastSound(new BlazeShootSound(), [$player]);

                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have applied a " . TF::WHITE . $multiplier . "x" . TF::AQUA . " Mining XP Booster");
                        $this->miningManager->start($player, $multiplier);
                        break;

                }
            }
        }
    }
}