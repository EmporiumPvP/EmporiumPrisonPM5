<?php

namespace EmporiumCore\Listeners\Items;

use EmporiumCore\EmporiumCore;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerItemUseEvent;
use pocketmine\utils\TextFormat as TF;
use pocketmine\world\sound\BlazeShootSound;

class RankKitListener implements Listener {

    public function onClaimRankKit(PlayerItemUseEvent $event) {
        $player = $event->getPlayer();
        $item = $event->getItem();

        if($item->getNamedTag()->getTag("RankKitNoble")) {

            $kitItems = EmporiumCore::getInstance()->getNobleItems();
            $rankKitItems = [
                $kitItems->energy(),
                $kitItems->helmet(),
                $kitItems->chestplate(),
                $kitItems->leggings(),
                $kitItems->boots(),
                $kitItems->sword()
            ];

            foreach ($rankKitItems as $kitItem) {
                if($player->getInventory()->canAddItem($kitItem)) {
                    $player->getInventory()->addItem($kitItem);
                    continue;
                }
                $player->getWorld()->dropItem($player->getPosition(), $kitItem);
            }
            $player->getInventory()->setItemInHand($item->setCount($item->getCount() - 1));
            $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::DARK_GRAY . "Noble rank kit");
        }

        if($item->getNamedTag()->getTag("RankKitImperial")) {

            $kitItems = EmporiumCore::getInstance()->getImperialItems();
            $rankKitItems = [
                $kitItems->energy(),
                $kitItems->helmet(),
                $kitItems->chestplate(),
                $kitItems->leggings(),
                $kitItems->boots(),
                $kitItems->sword()
            ];

            foreach ($rankKitItems as $kitItem) {
                if($player->getInventory()->canAddItem($kitItem)) {
                    $player->getInventory()->addItem($kitItem);
                    continue;
                }
                $player->getWorld()->dropItem($player->getPosition(), $kitItem);
            }
            $player->getInventory()->setItemInHand($item->setCount($item->getCount() - 1));
            $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::LIGHT_PURPLE . "Imperial rank kit");
        }

        if($item->getNamedTag()->getTag("RankKitSupreme")) {

            $kitItems = EmporiumCore::getInstance()->getSupremeItems();
            $rankKitItems = [
                $kitItems->energy(),
                $kitItems->helmet(),
                $kitItems->chestplate(),
                $kitItems->leggings(),
                $kitItems->boots(),
                $kitItems->sword()
            ];

            foreach ($rankKitItems as $kitItem) {
                if($player->getInventory()->canAddItem($kitItem)) {
                    $player->getInventory()->addItem($kitItem);
                    continue;
                }
                $player->getWorld()->dropItem($player->getPosition(), $kitItem);
            }
            $player->getInventory()->setItemInHand($item->setCount($item->getCount() - 1));
            $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::DARK_AQUA . "Supreme rank kit");
        }

        if($item->getNamedTag()->getTag("RankKitMajesty")) {

            $kitItems = EmporiumCore::getInstance()->getMajestyItems();
            $rankKitItems = [
                $kitItems->energy(),
                $kitItems->helmet(),
                $kitItems->chestplate(),
                $kitItems->leggings(),
                $kitItems->boots(),
                $kitItems->sword()
            ];

            foreach ($rankKitItems as $kitItem) {
                if($player->getInventory()->canAddItem($kitItem)) {
                    $player->getInventory()->addItem($kitItem);
                    continue;
                }
                $player->getWorld()->dropItem($player->getPosition(), $kitItem);
            }
            $player->getInventory()->setItemInHand($item->setCount($item->getCount() - 1));
            $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::DARK_AQUA . "Majesty rank kit");
        }

        if($item->getNamedTag()->getTag("RankKitEmperor")) {

            $kitItems = EmporiumCore::getInstance()->getEmperorItems();

            $rankKitItems = [
                $kitItems->energy(),
                $kitItems->prestigeKit(),
                $kitItems->whiteScroll(),
                $kitItems->mysteryGKitLootbox(),
                $kitItems->booster(),
                $kitItems->holyWhiteScroll(),
                $kitItems->contraband1(),
                $kitItems->contraband2(),
                $kitItems->contraband3(),
                $kitItems->legendaryMysteryGKitLootbox()
            ];

            foreach ($rankKitItems as $kitItem) {
                if($player->getInventory()->canAddItem($kitItem)) {
                    $player->getInventory()->addItem($kitItem);
                    continue;
                }
                $player->getWorld()->dropItem($player->getPosition(), $kitItem);
            }
            $player->getInventory()->setItemInHand($item->setCount($item->getCount() - 1));
            $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::AQUA . "Emperor rank kit");
        }

        if($item->getNamedTag()->getTag("RankKitPresident")) {

            $kitItems = EmporiumCore::getInstance()->getPresidentItems();

            $rankKitItems = array(
                $kitItems->energy(),
                $kitItems->whiteScroll(),
                $kitItems->holyWhiteScroll(),
                $kitItems->booster(),
                $kitItems->contraband3(),
                $kitItems->contraband2(),
                $kitItems->contraband1(),
                $kitItems->randomCrystal()
            );

            foreach ($rankKitItems as $items) {
                if($player->getInventory()->canAddItem($items)) {
                    $player->getInventory()->addItem($items);
                    continue;
                }
                $player->getWorld()->dropItem($player->getPosition(), $items);
            }

            $player->sendMessage(TF::BOLD . TF::GRAY . "You claimed " . TF::RED . "President rank kit");
            $player->broadcastSound(new BlazeShootSound(), [$player]);
            $player->getInventory()->setItemInHand($item->setCount($item->getCount() - 1));
        }
    }
}