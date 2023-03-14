<?php

namespace Emporium\Prison\listeners\Items;

use Emporium\Prison\EmporiumPrison;
use Emporium\Prison\Managers\PickaxeManager;

use muqsit\playervaults\PlayerVaults;
use muqsit\playervaults\vault\Vault;
use muqsit\playervaults\vault\VaultAccess;

use pocketmine\event\inventory\InventoryTransactionEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\inventory\transaction\action\SlotChangeAction;
use pocketmine\item\ItemIds;
use pocketmine\item\VanillaItems;
use pocketmine\Server;
use pocketmine\utils\TextFormat as TF;
use pocketmine\world\sound\ItemFrameAddItemSound;
use pocketmine\world\sound\XpCollectSound;

class WhiteScrollListener implements Listener {

    private PickaxeManager $pickaxeManager;

    public function __construct() {
        # managers
        $this->pickaxeManager = EmporiumPrison::getPickaxeManager();
    }

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
                if ($action instanceof SlotChangeAction && ($otherAction = $actions[($i + 1) % 2]) instanceof SlotChangeAction && ($itemClickedWith = $action->getTargetItem())->getId() === ItemIds::PAPER && ($itemClicked = $action->getSourceItem())->getId() !== ItemIds::AIR) {
                    if ($itemClickedWith->getNamedTag()->getTag("Scroll") === null) {
                        $player->sendMessage("1");
                        return;
                    }
                    if ($itemClicked->getNamedTag()->getTag("PickaxeType") === null) {
                        $player->sendMessage("2");
                        return;
                    }
                    if ($itemClicked->getNamedTag()->getTag("Energy") === null) {
                        $player->sendMessage("3");
                        return;
                    }
                    if ($itemClicked->getNamedTag()->getTag("whitescrolled") === null) {
                        $player->sendMessage("4");
                        return;
                    }
                    # cancel event
                    $event->cancel();
                    # get item data
                    $scrollType = $itemClickedWith->getNamedTag()->getString("Scroll");
                    $isWhiteScrolled = $itemClicked->getNamedTag()->getString("whitescrolled");

                    if($isWhiteScrolled === "white" ||
                        $isWhiteScrolled === "holy") {
                        # pickaxe is already white scrolled
                        $player->sendMessage(TF::RED . "This item is already white scrolled");
                        $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                        $applySuccessful = false;
                    } else {
                        # item isn't white scrolled

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

                        # apply holy white scroll
                        if($scrollType === "HolyWhiteScroll") {
                            # set new pickaxe data
                            $itemClicked->getNamedTag()->setString("whitescrolled", "holy");
                            # send confirmation
                            $player->sendMessage(TF::BOLD . TF::GOLD . "You have applied a Holy White Scroll");
                            $player->broadcastSound(new XpCollectSound(), [$player]);
                            # set apply successful
                            $applySuccessful = true;
                        }
                    }
                    if ($applySuccessful) {
                        $event->cancel();
                        # update pickaxe information
                        $updatedPickaxe = $this->pickaxeManager->updatePickaxe($itemClicked);
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
        # managers

        $event->setDrops([]);
        foreach ($inventory->getContents() as $item) {
            /** @var PlayerVaults $vaults */
            $vaults = Server::getInstance()->getPluginManager()->getPlugin("PlayerVaults");
            if($item->getNamedTag()->getTag("whitescrolled") === null) {
                $player->getWorld()->dropItem($player->getLocation(), $item);
                return;
            } else {
                if($item->getNamedTag()->getString("whitescrolled") === "false") {
                    return;
                }
                if($item->getNamedTag()->getString("whitescrolled") === "white") {
                    $player->sendMessage(TF::BOLD . TF::WHITE . "White Scroll Activated");
                    $item->getNamedTag()->setString("whitescrolled", "false");
                    $updatedItem = $this->pickaxeManager->updatePickaxe($item);
                    # save item in collection chest
                    $vaults->loadVault($player->getName(), 10, function(Vault $vault, VaultAccess $access) use ($updatedItem): void {
                        $inventory = $vault->getInventory();
                        $inventory->addItem($updatedItem);
                        $access->release(); // unloads vault and if necessary, saves vault
                    });
                }
                if($item->getNamedTag()->getString("whitescrolled") === "holy") {
                    $player->sendMessage(TF::BOLD . TF::GOLD . "Holy White Scroll Activated");
                    $item->getNamedTag()->setString("whitescrolled", "false");
                    $updatedItem = $this->pickaxeManager->updatePickaxe($item);
                    # save item in collection chest
                    $vaults->loadVault($player->getName(), 10, function(Vault $vault, VaultAccess $access) use ($updatedItem): void {
                        $inventory = $vault->getInventory();
                        $inventory->addItem($updatedItem);
                        $access->release(); // unloads vault and if necessary, saves vault
                    });
                }
            }
        }
    }

}