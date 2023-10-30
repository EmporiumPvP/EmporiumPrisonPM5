<?php

namespace Tetro\EmporiumEnchants\Listeners;

use Emporium\Prison\Variables;

use Exception;

use pocketmine\block\BlockTypeIds;
use pocketmine\event\inventory\InventoryTransactionEvent;
use pocketmine\event\Listener;
use pocketmine\inventory\transaction\action\SlotChangeAction;
use pocketmine\utils\TextFormat as TF;
use pocketmine\world\sound\DoorBumpSound;
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
        $applySuccessful = false;

        if (count($actions) === 2) {
            foreach ($actions as $i => $action) {
                $itemClickedWith = $action->getTargetItem();
                $itemClicked = $action->getSourceItem();

                if ($action instanceof SlotChangeAction and
                    ($otherAction = $actions[($i + 1) % 2]) instanceof SlotChangeAction and
                    $itemClicked->getTypeId() !== BlockTypeIds::AIR) {


                    # not a scroll
                    if($itemClickedWith->getNamedTag()->getTag("Scroll") === null) return;

                    # not a black scroll
                    if($itemClickedWith->getNamedTag()->getString("Scroll") !== "black") return;

                    $event->cancel();

                    # using on a pickaxe
                    if($itemClicked->getNamedTag()->getTag("PickaxeType")) {
                        $player->sendMessage(Variables::PREFIX . "You cannot extract Pickaxe Enchants");
                        $player->broadcastSound(new DoorBumpSound(), [$player]);
                        return;
                    }

                    $totalCustomEnchants = 0;
                    $totalVanillaEnchants = 0;
                    $count = 0;
                    $enchantNames = [];
                    $enchantLevels = [];
                    $enchantRarities = [];

                    # get item enchants
                    if(count($itemClicked->getEnchantments()) > 0) {

                        $count = count($itemClicked->getEnchantments());

                        # get random enchant from item
                        foreach ($itemClicked->getEnchantments() as $enchant) {

                            $enchantLevels[] = $enchant->getLevel();

                            # custom enchant
                            if (!$enchant->getType() instanceof CustomEnchant)  {
                                $totalVanillaEnchants++;
                                continue;
                            }
                            if($enchant->getType()->getRarity() == CustomEnchant::RARITY_EXECUTIVE) continue;

                            $enchantNames[] = $enchant->getType()->getName();
                            $enchantRarities[] = $enchant->getType()->getRarity();
                            $totalCustomEnchants++;
                        }

                        # only has vanilla enchants
                        if($totalCustomEnchants == 0 && $totalVanillaEnchants > 0) {
                            $player->sendMessage(Variables::PREFIX . "You can only extract Custom Enchants");
                            return;
                        }

                        # has no enchants
                        if($totalCustomEnchants == 0) {
                            $player->sendMessage(Variables::PREFIX . "That item doesn't have any enchants");
                            return;
                        }

                        # remove random enchant
                        $randomEnchant = mt_rand(0, $count - 1);
                        $itemClicked->removeEnchantment(CustomEnchantManager::getEnchantmentByName($enchantNames[$randomEnchant]));

                        # enchant info
                        $name = $enchantNames[$randomEnchant];
                        $enchant = CustomEnchantManager::getEnchantmentByName($name);
                        $level = $enchantLevels[$randomEnchant];
                        $rarity = $enchantRarities[$randomEnchant];
                        $id = CustomEnchantManager::getEnchantmentByName($name)->getTypeId();

                        # blackscroll chance
                        $chance = $itemClickedWith->getNamedTag()->getInt("chance");

                        # send confirmation
                        $player->sendMessage(TF::GRAY . "You have extracted " . TF::LIGHT_PURPLE . $name . " " . $level . TF::GRAY . " with a " . TF::WHITE . $chance . "%" . TF::GRAY . " chance");

                        # set apply successful
                        $applySuccessful = true;
                    }
                }

                if ($applySuccessful) {

                    # remove old item
                    $action->getInventory()->removeItem($itemClicked);

                    # give player new item
                    $action->getInventory()->setItem($action->getSlot(), $itemClicked);

                    # create enchant book
                    $book = $this->bookManager->EnchantedBook($enchant, $level, $rarity, $id, $chance);
                    $player->getInventory()->addItem($book);

                    # give player enchant book
                    $otherAction->getInventory()->setItem($otherAction->getSlot(), BlockTypeIds::AIR);
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                }
            }
        }
    }

}