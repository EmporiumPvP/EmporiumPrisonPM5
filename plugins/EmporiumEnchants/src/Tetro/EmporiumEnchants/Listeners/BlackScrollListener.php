<?php

namespace Tetro\EmporiumEnchants\Listeners;

use Emporium\Prison\EmporiumPrison;

use Exception;

use pocketmine\event\inventory\InventoryTransactionEvent;
use pocketmine\event\Listener;
use pocketmine\inventory\transaction\action\SlotChangeAction;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\ItemIds;
use pocketmine\item\VanillaItems;
use pocketmine\utils\TextFormat as TF;
use pocketmine\world\sound\XpCollectSound;

use Tetro\EmporiumEnchants\Core\BookManager;
use Tetro\EmporiumEnchants\Core\CustomEnchant;
use Tetro\EmporiumEnchants\Core\CustomEnchantManager;
use Tetro\EmporiumEnchants\EmporiumEnchants;

class BlackScrollListener implements Listener
{
    private BookManager $bookManager;

    public function __construct() {
        # managers
        $this->bookManager = EmporiumEnchants::getInstance()->getBookManager();
    }

    /**
     * @throws Exception
     */
    public function onUseBlackScroll(InventoryTransactionEvent $event): void
    {
        $player = $event->getTransaction()->getSource();
        $transaction = $event->getTransaction();
        $actions = array_values($transaction->getActions());

        if (count($actions) === 2) {
            foreach ($actions as $i => $action) {
                if ($action instanceof SlotChangeAction && ($otherAction = $actions[($i + 1) % 2]) instanceof SlotChangeAction && ($itemClickedWith = $action->getTargetItem())->getId() === ItemIds::DYE && ($itemClicked = $action->getSourceItem())->getId() !== ItemIds::AIR) {
                    if($itemClickedWith->getNamedTag()->getTag("Blackscroll") === null) return;
                    if ($itemClickedWith->getNamedTag()->getTag("chance") === null) return;
                    if ($itemClicked->getNamedTag()->getTag("Energy") === null) return;

                    # cancel event
                    $event->cancel();
                    # get item enchants
                    if(count($itemClicked->getEnchantments()) > 0) {
                        $count = count($itemClicked->getEnchantments());
                        # get random enchant from item
                        foreach ($itemClicked->getEnchantments() as $enchant) {
                            $enchantLevels[] = $enchant->getLevel();
                            if($enchant instanceof CustomEnchant) {
                                $enchantNames[] = $enchant->getName();
                                $enchantRarities[] = $enchant->getRarity();
                            }
                            if($enchant instanceof Enchantment) {
                                break;
                            }
                        }
                        # remove random enchant
                        $randomEnchant = mt_rand(0, $count - 1);
                        $itemClicked->removeEnchantment(CustomEnchantManager::getEnchantmentByName($enchantNames[$randomEnchant]));
                        # enchant info
                        $name = $enchantNames[$randomEnchant];
                        $enchant = CustomEnchantManager::getEnchantmentByName($name);
                        $level = $enchantLevels[$randomEnchant];
                        $rarity = $enchantRarities[$randomEnchant];
                        $id = CustomEnchantManager::getEnchantmentByName($name)->getId();
                        # blackscroll info
                        $chance = $itemClickedWith->getNamedTag()->getInt("chance");
                        # send confirmation
                        $player->sendMessage(TF::GRAY . "You have extracted " . TF::LIGHT_PURPLE . $name . " " . $level . TF::GRAY . " with a " . TF::WHITE . $chance . "%" . TF::GRAY . " chance");
                        # set apply successful
                        $applySuccessful = true;
                    } else {
                        $player->sendMessage("That item doesn't have any enchants that can be extracted");
                        return;
                    }


                    if ($applySuccessful) {
                        # update pickaxe information
                        $updatedPickaxe = EmporiumPrison::getInstance()->getPickaxeManager()->updatePickaxe($itemClicked);
                        # give player new pickaxe
                        $action->getInventory()->setItem($action->getSlot(), $updatedPickaxe);
                        # create enchant book
                        $book = $this->bookManager->EnchantedBook($enchant, $level, $rarity, $id, $chance);
                        $player->getInventory()->addItem($book);
                        # give player enchant book
                        $otherAction->getInventory()->setItem($otherAction->getSlot(), VanillaItems::AIR());
                        $player->broadcastSound(new XpCollectSound(), [$player]);
                    }
                }
            }
        }
    }

}