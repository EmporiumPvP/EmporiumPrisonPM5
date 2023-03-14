<?php

namespace Tetro\EmporiumEnchants\Listeners;

use Emporium\Prison\EmporiumPrison;
use Emporium\Prison\Managers\PickaxeManager;

use Exception;
use pocketmine\event\inventory\InventoryTransactionEvent;
use pocketmine\event\Listener;
use pocketmine\inventory\transaction\action\SlotChangeAction;
use pocketmine\item\ItemIds;
use pocketmine\item\VanillaItems;
use pocketmine\utils\TextFormat as TF;
use pocketmine\world\sound\XpCollectSound;

use Tetro\EmporiumEnchants\Core\BookManager;
use Tetro\EmporiumEnchants\Core\CustomEnchantManager;
use Tetro\EmporiumEnchants\Loader;

class BlackScrollListener implements Listener
{

    private PickaxeManager $pickaxeManager;
    private BookManager $bookManager;

    public function __construct() {
        # managers
        $this->pickaxeManager = EmporiumPrison::getPickaxeManager();
        $this->bookManager = Loader::getBookManager();
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
                    if($itemClickedWith->getMeta() !== 0) {
                        return;
                    }
                    if ($itemClickedWith->getNamedTag()->getTag("chance") === null) {
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
                        # remove random enchant
                        if(count($itemClicked->getEnchantments()) > 0) {
                            $count = count($itemClicked->getEnchantments());
                            foreach ($itemClicked->getEnchantments() as $enchants) {
                                $enchantNames[] = $enchants->getType()->getName();
                                $enchantLevels[] = $enchants->getLevel();
                                $enchantRarities[] = $enchants->getType()->getRarity();
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
                            # update pickaxe
                            $this->pickaxeManager->updatePickaxe($itemClicked);
                            # set apply successful
                            $applySuccessful = true;
                            # create enchant book
                            $item = $this->bookManager->EnchantedBook($enchant, $level, $rarity, $id, $chance);
                            $player->getInventory()->addItem($item);
                        } else {
                            # set apply unsuccessful
                            $applySuccessful = false;
                        }
                    }

                    if ($applySuccessful) {
                        # update pickaxe information
                        $updatedPickaxe = $this->pickaxeManager->updatePickaxe($itemClicked);
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

}