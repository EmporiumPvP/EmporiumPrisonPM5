<?php

namespace Emporium\Prison\listeners\Items;

use Emporium\Prison\Variables;

use EmporiumData\DataManager;

use pocketmine\event\inventory\InventoryTransactionEvent;
use pocketmine\event\Listener;
use pocketmine\inventory\transaction\action\SlotChangeAction;
use pocketmine\item\Armor;
use pocketmine\item\Item;
use pocketmine\item\VanillaItems;

class ArmourListener implements Listener {

    private const CHAIN_LEVEL = 10;
    private const GOLD_LEVEL = 30;
    private const IRON_LEVEL = 60;
    private const DIAMOND_LEVEL = 100;

    /*
    private array $helmetTypes = [
        VanillaItems::CHAINMAIL_HELMET() => self::CHAIN_LEVEL,
        VanillaItems::GOLDEN_HELMET() => self::GOLD_LEVEL,
        VanillaItems::IRON_HELMET() => self::IRON_LEVEL,
        VanillaItems::DIAMOND_HELMET() => self::DIAMOND_LEVEL
    ];

    private array $chestplateTypes = [VanillaItems::CHAINMAIL_CHESTPLATE => self::CHAIN_LEVEL, VanillaItems::GOLDEN_CHESTPLATE => self::GOLD_LEVEL, VanillaItems::IRON_CHESTPLATE => self::IRON_LEVEL, VanillaItems::DIAMOND_CHESTPLATE => self::DIAMOND_LEVEL];
    private array $leggingTypes = [VanillaItems::CHAINMAIL_LEGGINGS => self::CHAIN_LEVEL, VanillaItems::GOLDEN_LEGGINGS => self::GOLD_LEVEL, VanillaItems::IRON_LEGGINGS => self::IRON_LEVEL, VanillaItems::DIAMOND_LEGGINGS => self::DIAMOND_LEVEL];
    private array $bootTypes = [VanillaItems::CHAINMAIL_BOOTS => self::CHAIN_LEVEL, VanillaItems::GOLDEN_BOOTS => self::GOLD_LEVEL, VanillaItems::IRON_BOOTS => self::IRON_LEVEL, VanillaItems::DIAMOND_BOOTS => self::DIAMOND_LEVEL];


    public function onApplyArmour(InventoryTransactionEvent $event): void {

        $player = $event->getTransaction()->getSource();
        $transaction = $event->getTransaction();
        $armourInventory = $player->getArmorInventory();
        $actions = $transaction->getActions();

        foreach ($actions as $action) {
            $itemClickedWith = $action->getTargetItem();

            if(!in_array($itemClickedWith->getTypeId(), $this->helmetTypes)
                or !in_array($itemClickedWith->getTypeId(), $this->chestplateTypes)
                or !in_array($itemClickedWith->getTypeId(), $this->leggingTypes)
                or !in_array($itemClickedWith->getTypeId(), $this->bootTypes)) return;

            $helmet = $armourInventory->getHelmet();
            $chestplate = $armourInventory->getChestplate();
            $leggings = $armourInventory->getLeggings();
            $boots = $armourInventory->getBoots();

            $playerLevel = DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.level");

            # helmet check
            if(!is_null($helmet->getTypeId())) {
                if(in_array($helmet->getTypeId(), $this->helmetTypes)) {
                    $levelNeeded = array_search($helmet->getTypeId(), $this->helmetTypes);

                    if($playerLevel < $levelNeeded) {
                        $event->cancel();
                        $player->sendMessage(Variables::PREFIX . TF::RESET . TF::RED . "You need to be level " . $levelNeeded . " to wear that");
                    }
                }
            }

            # chestplate check
            if(!is_null($chestplate->getTypeId())) {
                if(in_array($chestplate->getTypeId(), $this->chestplateTypes)) {
                    $levelNeeded = array_search($helmet->getTypeId(), $this->chestplateTypes);

                    if($playerLevel < $levelNeeded) {
                        $event->cancel();
                        $player->sendMessage(Variables::PREFIX . TF::RESET . TF::RED . "You need to be level " . $levelNeeded . " to wear that");
                    }
                }
            }

            # leggings check
            if(!is_null($leggings->getTypeId())) {
                if(in_array($leggings->getTypeId(), $this->leggingTypes)) {
                    $levelNeeded = array_search($leggings->getTypeId(), $this->leggingTypes);

                    if($playerLevel < $levelNeeded) {
                        $event->cancel();
                        $player->sendMessage(Variables::PREFIX . TF::RESET . TF::RED . "You need to be level " . $levelNeeded . " to wear that");
                    }
                }
            }

            # boots check
            if(!is_null($boots->getTypeId())) {
                if(in_array($boots->getTypeId(), $this->bootTypes)) {
                    $levelNeeded = array_search($boots->getTypeId(), $this->bootTypes);

                    if($playerLevel < $levelNeeded) {
                        $event->cancel();
                        $player->sendMessage(Variables::PREFIX . TF::RESET . TF::RED . "You need to be level " . $levelNeeded . " to wear that");
                    }
                }
            }
        }
    } */
}