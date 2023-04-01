<?php

namespace Tetro\EmporiumEnchants\Listeners;

use pocketmine\event\inventory\InventoryTransactionEvent;
use pocketmine\event\Listener;
use pocketmine\inventory\transaction\action\SlotChangeAction;
use pocketmine\item\ItemIds;
use pocketmine\item\VanillaItems;
use pocketmine\world\sound\XpCollectSound;

use Tetro\EmporiumEnchants\EmporiumEnchants;

class PageListener implements Listener
{

    /**
     * @priority HIGHEST
     */
    public function onApplyEnergyOrbToBook(InventoryTransactionEvent $event): void {

        $player = $event->getTransaction()->getSource();
        $transaction = $event->getTransaction();
        $actions = array_values($transaction->getActions());

        if (count($actions) === 2) {
            foreach ($actions as $i => $action) {
                if ($action instanceof SlotChangeAction && ($otherAction = $actions[($i + 1) % 2]) instanceof SlotChangeAction && ($itemClickedWith = $action->getTargetItem())->getId() === ItemIds::PAPER && ($itemClicked = $action->getSourceItem())->getId() !== ItemIds::AIR) {
                    # verify page
                    if($itemClickedWith->getNamedTag()->getTag("Page") === null) return;
                    if($itemClickedWith->getNamedTag()->getTag("Boost") === null) return;

                    # cancel event
                    $event->cancel();

                    # verify custom enchant book
                    if($itemClicked->getNamedTag()->getTag("CustomEnchantBook") === null) return;
                    if($itemClicked->getNamedTag()->getTag("RarityName") === null) return;

                    # page data
                    $pageRarity = $itemClickedWith->getNamedTag()->getInt("Page");
                    $pageBoost = $itemClickedWith->getNamedTag()->getInt("Boost");

                    # book data
                    $bookRarity = $itemClicked->getNamedTag()->getInt("Rarity");
                    $bookSuccess = $itemClicked->getNamedTag()->getInt("Success");

                    # check compatability
                    if(!$pageRarity === $bookRarity) return;
                    # check book success
                    if($bookSuccess === 100) return;



                    # apply page to book
                    if($bookSuccess + $pageBoost > 100) {
                        # add new data
                        $itemClicked->getNamedTag()->setInt("Success", 100);
                        # update book
                        $updatedBook = EmporiumEnchants::getInstance()->getBookManager()->updateBook($itemClicked);
                        # remove old book & give new book
                        $action->getInventory()->setItem($action->getSlot(), $updatedBook);
                        # remove page
                        $otherAction->getInventory()->setItem($otherAction->getSlot(), VanillaItems::AIR());
                        # play sound
                        $player->broadcastSound(new XpCollectSound(), [$player]);
                        return;
                    }



                    # calculate new data
                    $newData = $bookSuccess + $pageBoost;
                    # set new data
                    $itemClicked->getNamedTag()->setInt("Success", $newData);
                    # update book
                    $updatedBook = EmporiumEnchants::getInstance()->getBookManager()->updateBook($itemClicked);
                    # remove old book & give new book
                    $action->getInventory()->setItem($action->getSlot(), $updatedBook);
                    # remove page
                    $otherAction->getInventory()->setItem($otherAction->getSlot(), VanillaItems::AIR());
                    # play sound
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                    return;
                }
            }
        }
    }

}