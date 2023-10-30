<?php

namespace Tetro\EmporiumEnchants\Listeners;

use pocketmine\block\BlockTypeIds;
use pocketmine\event\inventory\InventoryTransactionEvent;
use pocketmine\event\Listener;
use pocketmine\inventory\transaction\action\SlotChangeAction;
use pocketmine\world\sound\XpCollectSound;

use Tetro\EmporiumEnchants\EmporiumEnchants;

class PageListener implements Listener
{

    /**
     * @priority HIGHEST
     */
    public function onApplyPageToBook(InventoryTransactionEvent $event): void {

        $player = $event->getTransaction()->getSource();
        $transaction = $event->getTransaction();
        $actions = array_values($transaction->getActions());

        if (count($actions) === 2) {
            foreach ($actions as $i => $action) {

                $itemClickedWith = $action->getTargetItem();
                $itemClicked = $action->getSourceItem();

                if ($action instanceof SlotChangeAction && ($otherAction = $actions[($i + 1) % 2]) instanceof SlotChangeAction && $itemClickedWith->getNamedTag()->getTag("Page") && $itemClicked->getNamedTag()->getTag("OpenedCustomEnchantBook")) {

                    $page = $itemClickedWith;
                    $book = $itemClicked;

                    # cancel event
                    $event->cancel();

                    # page data
                    $pageRarity = $page->getNamedTag()->getInt("Page");
                    $pageBoost = $page->getNamedTag()->getInt("Boost");

                    # book data
                    $bookRarity = $book->getNamedTag()->getInt("Rarity");
                    $bookSuccess = $book->getNamedTag()->getInt("Success");

                    # check compatability
                    if(!$pageRarity === $bookRarity) return;

                    # check book success
                    if($bookSuccess === 100) return;



                    # apply page to book
                    if($bookSuccess + $pageBoost > 100) {

                        # add new data
                        $book->getNamedTag()->setInt("Success", 100);

                        # update book
                        $updatedBook = EmporiumEnchants::getInstance()->getBookManager()->updateBook($book);

                        # remove old book & give new book
                        $action->getInventory()->setItem($action->getSlot(), $updatedBook);

                        # remove page
                        $otherAction->getInventory()->setItem($otherAction->getSlot(), BlockTypeIds::AIR);

                        # play sound
                        $player->broadcastSound(new XpCollectSound(), [$player]);

                        return;
                    }


                    # set new data
                    $book->getNamedTag()->setInt("Success", $bookSuccess + $pageBoost);

                    # update book
                    $updatedBook = EmporiumEnchants::getInstance()->getBookManager()->updateBook($book);

                    # remove old book & give new book
                    $action->getInventory()->setItem($action->getSlot(), $updatedBook);

                    # remove page
                    $otherAction->getInventory()->setItem($otherAction->getSlot(), BlockTypeIds::AIR);

                    # play sound
                    $player->broadcastSound(new XpCollectSound(), [$player]);

                }
            }
        }
    }

}