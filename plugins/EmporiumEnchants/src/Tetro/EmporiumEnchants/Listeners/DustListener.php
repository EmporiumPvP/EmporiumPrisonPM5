<?php

namespace Tetro\EmporiumEnchants\Listeners;

use pocketmine\event\inventory\InventoryTransactionEvent;
use pocketmine\event\Listener;
use pocketmine\inventory\transaction\action\SlotChangeAction;
use pocketmine\item\ItemIds;
use pocketmine\item\VanillaItems;
use pocketmine\world\sound\XpCollectSound;

use Tetro\EmporiumEnchants\Core\OrbManager;
use Tetro\EmporiumEnchants\EmporiumEnchants;

class DustListener implements Listener {

    private OrbManager $orbManager;

    public function __construct()
    {
        $this->orbManager = EmporiumEnchants::getInstance()->getOrbManager();
    }

    /**
     * @priority HIGHEST
     */
    public function onApplyDustToPickaxeEnchant(InventoryTransactionEvent $event): void {

        $player = $event->getTransaction()->getSource();
        $transaction = $event->getTransaction();
        $actions = array_values($transaction->getActions());

        if (count($actions) === 2) {
            foreach ($actions as $i => $action) {
                if ($action instanceof SlotChangeAction && ($otherAction = $actions[($i + 1) % 2]) instanceof SlotChangeAction && ($itemClickedWith = $action->getTargetItem())->getId() === ItemIds::GLOWSTONE_DUST && ($itemClicked = $action->getSourceItem())->getId() !== ItemIds::AIR) {
                    # verify dust
                    if($itemClickedWith->getNamedTag()->getTag("EnchantDust") === null) return;
                    if($itemClickedWith->getNamedTag()->getTag("Rarity") === null) return;
                    if($itemClickedWith->getNamedTag()->getTag("Boost") === null) return;

                    # cancel event
                    $event->cancel();

                    # verify pickaxe enchant orb
                    if($itemClicked->getNamedTag()->getTag("CustomEnchantOrb") === null) return;
                    if($itemClicked->getNamedTag()->getTag("Rarity") === null) return;
                    if($itemClicked->getNamedTag()->getTag("Success") === null) return;

                    # get dust data
                    $dustRarity = $itemClickedWith->getNamedTag()->getInt("Rarity");
                    $dustBoost = $itemClickedWith->getNamedTag()->getInt("Boost");

                    # get pickaxe enchant orb data
                    $pickaxeOrbRarity = $itemClicked->getNamedTag()->getInt("Rarity");
                    $pickaxeOrbSuccess = $itemClicked->getNamedTag()->getInt("Success");

                    # check compatability
                    if(!$dustRarity === $pickaxeOrbRarity) return;

                    # check orb success
                    if($pickaxeOrbSuccess === 100) return;



                    # apply dust to orb
                    if($pickaxeOrbSuccess + $dustBoost > 100) {
                        # add new data
                        $itemClicked->getNamedTag()->setInt("Success", 100);
                        # update orb
                        $updatedOrb = $this->orbManager->updateOrb($itemClicked);
                        # remove old orb & give new orb
                        $action->getInventory()->setItem($action->getSlot(), $updatedOrb);
                        # remove dust
                        $otherAction->getInventory()->setItem($otherAction->getSlot(), VanillaItems::AIR());
                        # play sound
                        $player->broadcastSound(new XpCollectSound(), [$player]);
                        return;
                    }



                    # calculate new data
                    $newData = $dustBoost + $pickaxeOrbSuccess;
                    # set new data
                    $itemClicked->getNamedTag()->setInt("Success", $newData);
                    # update orb
                    $updatedOrb = EmporiumEnchants::getInstance()->getOrbManager()->updateOrb($itemClicked);
                    # remove old orb & give new orb
                    $action->getInventory()->setItem($action->getSlot(), $updatedOrb);
                    # remove dust
                    $otherAction->getInventory()->setItem($otherAction->getSlot(), VanillaItems::AIR());
                    # play sound
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                }
            }
        }
    }
}