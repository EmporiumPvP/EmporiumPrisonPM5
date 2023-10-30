<?php

namespace Emporium\Prison\listeners\Items;

use Emporium\Prison\EmporiumPrison;

use pocketmine\event\inventory\InventoryTransactionEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\inventory\transaction\action\SlotChangeAction;
use pocketmine\item\VanillaItems;
use pocketmine\utils\TextFormat as TF;
use pocketmine\world\sound\ItemFrameAddItemSound;
use pocketmine\world\sound\XpCollectSound;

class WhiteScrollListener implements Listener {

    /**
     * @priority HIGHEST
     */
    public function onApplyWhiteScroll(InventoryTransactionEvent $event): void {

        $player = $event->getTransaction()->getSource();
        $transaction = $event->getTransaction();
        $actions = array_values($transaction->getActions());
        $applySuccessful = false;

        if (count($actions) === 2) {
            foreach ($actions as $i => $action) {
                if ($action instanceof SlotChangeAction && ($otherAction = $actions[($i + 1) % 2]) instanceof SlotChangeAction && ($itemClickedWith = $action->getTargetItem())->getTypeId() == VanillaItems::PAPER()->getTypeId() && ($itemClicked = $action->getSourceItem())->getTypeId() !== VanillaItems::AIR()->getTypeId()) {

                    # item checks
                    if ($itemClickedWith->getNamedTag()->getTag("Scroll") === null) return;
                    if ($itemClicked->getNamedTag()->getTag("PickaxeType") === null) return;
                    if ($itemClicked->getNamedTag()->getTag("Energy") === null) return;
                    if ($itemClicked->getNamedTag()->getTag("whitescrolled") === null) return;

                    # cancel event
                    $event->cancel();

                    # get item data
                    $scrollType = $itemClickedWith->getNamedTag()->getString("Scroll");
                    $isWhiteScrolled = $itemClicked->getNamedTag()->getString("whitescrolled");

                    # compatability checks
                    if($scrollType == "WhiteScroll" && $isWhiteScrolled == "white") {
                        $player->sendMessage(TF::RED . "That item already has a White Scroll applied");
                        $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                        return;
                    }

                    if($scrollType == "WhiteScroll" && $isWhiteScrolled == "holy") {
                        $player->sendMessage(TF::RED . "That item already has a Holy White Scroll applied");
                        $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                        return;
                    }

                    if($scrollType == "HolyWhiteScroll" && $isWhiteScrolled == "holy") {
                        $player->sendMessage(TF::RED . "That item already has a Holy White Scroll applied");
                        $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                        return;
                    }

                    if($scrollType == "HolyWhiteScroll" && $isWhiteScrolled != "white") {
                        $player->sendMessage(TF::RED . "You need to apply a white scroll first");
                        $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                        return;
                    }



                    # apply white scroll
                    if($scrollType === "WhiteScroll") {

                        # set new pickaxe data
                        $itemClicked->getNamedTag()->setString("whitescrolled", "white");

                        # send confirmation
                        $player->sendMessage(TF::BOLD . TF::WHITE . "You have applied a White Scroll");
                        $player->broadcastSound(new XpCollectSound(), [$player]);

                        # set apply successful
                        $applySuccessful = true;
                    }



                    # applying holy white scroll
                    if($scrollType === "HolyWhiteScroll") {

                        # set new pickaxe data
                        $itemClicked->getNamedTag()->setString("whitescrolled", "holy");

                        # send confirmation
                        $player->sendMessage(TF::BOLD . TF::GOLD . "You have applied a Holy White Scroll");
                        $player->broadcastSound(new XpCollectSound(), [$player]);

                        # set apply successful
                        $applySuccessful = true;
                    }


                    if ($applySuccessful) {
                        # update pickaxe information
                        $updatedPickaxe = EmporiumPrison::getInstance()->getPickaxeManager()->updatePickaxe($itemClicked);

                        # send new pickaxe
                        $action->getInventory()->setItem($action->getSlot(), $updatedPickaxe);

                        # remove white scroll
                        $otherAction->getInventory()->setItem($otherAction->getSlot(), VanillaItems::AIR());
                        $player->broadcastSound(new XpCollectSound(), [$player]);
                    }
                }
            }
        }
    }

    public function onDeathWithWhiteScroll(PlayerDeathEvent $event) {

        $player = $event->getPlayer();
        $inventory = $player->getInventory();

        $drops = $event->getDrops();
        $event->setDrops([]);
        $inventory->clearAll();
        $player->getArmorInventory()->clearAll();

        $event->setKeepInventory(true);

        foreach ($drops as $index => $drop) {

            # no white scroll
            if (!$drop->getNamedTag()->getTag("whitescrolled") || $drop->getNamedTag()->getString("whitescrolled") == "false") {
                $player->getWorld()->dropItem($player->getLocation(), $drop);
                continue;
            }

            /*
             * normal white scroll
             * item loses energy
             * if it has energy
             */
            if($drop->getNamedTag()->getString("whitescrolled") == "white") {
                $player->sendMessage(TF::BOLD . TF::WHITE . "White Scroll Activated");
                $drop->getNamedTag()->setString("whitescrolled", "false");

                # has energy
                if ($drop->getNamedTag()->getTag("Energy")) {
                    $drop->getNamedTag()->setInt("Energy", 0);
                }

                # is a pickaxe
                if($drop->getNamedTag()->getTag("PickaxeType")) {
                    $drop = EmporiumPrison::getInstance()->getPickaxeManager()->updatePickaxe($drop);
                }

                $player->getInventory()->addItem($drop);
            }

            /*
             * holy white scroll
             * no energy is lost
             */
            if($drop->getNamedTag()->getString("whitescrolled") == "holy") {
                $player->sendMessage(TF::BOLD . TF::GOLD . "Holy White Scroll Activated");
                $drop->getNamedTag()->setString("whitescrolled", "false");

                # is a pickaxe
                if($drop->getNamedTag()->getTag("PickaxeType")) {
                    $drop = EmporiumPrison::getInstance()->getPickaxeManager()->updatePickaxe($drop);
                }

                $player->getInventory()->addItem($drop);
            }
        }
    }

}