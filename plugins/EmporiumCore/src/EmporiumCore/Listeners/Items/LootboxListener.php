<?php

namespace EmporiumCore\Listeners\Items;

use EmporiumCore\Listeners\WebhookEvent;
use EmporiumData\DataManager;
use Items\GKits;
use Items\RankKits;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerItemUseEvent;
use pocketmine\utils\TextFormat as TF;

class LootboxListener implements Listener {

    public function onClaimLootbox(PlayerItemUseEvent $event) {

        $player = $event->getPlayer();
        if (DataManager::getInstance()->getPlayerXuid($player->getName()) == "00") return;
        $item = $event->getItem();
        $count = $item->getCount();

        if($item->getNamedTag()->getTag("GKitLootbox") !== null) {

            WebhookEvent::itemWebhook($player, "GKitLootbox");

            # remove item
            $item->setCount($count - 1);
            $player->getInventory()->setItemInHand($item);
            # give reward
            $reward = mt_rand(1, 16);
            switch($reward) {

                case 1: # heroic vulkarion
                    $player->sendMessage(TF::GREEN . "You got God Kit " . TF::DARK_RED . "Heroic Vulkarion");
                    $player->getInventory()->addItem((new GKits())->heroicVulkarion(1));
                    break;

                case 2: # heroic zenith
                    $player->sendMessage(TF::GREEN . "You got God Kit " . TF::GOLD . "Heroic Zenith");
                    $player->getInventory()->addItem((new GKits())->heroicZenith(1));
                    break;

                case 3: # heroic colossus
                    $player->sendMessage(TF::GREEN . "You got God Kit " . TF::WHITE . "Heroic Colossus");
                    $player->getInventory()->addItem((new GKits())->heroicColossus(1));
                    break;

                case 4: # heroic warlock
                    $player->sendMessage(TF::GREEN . "You got God Kit " . TF::DARK_PURPLE . "Heroic Warlock");
                    $player->getInventory()->addItem((new GKits())->heroicWarlock(1));
                    break;

                case 5: # heroic slaughter
                    $player->sendMessage(TF::GREEN . "You got God Kit " . TF::RED . "Heroic Slaughter");
                    $player->getInventory()->addItem((new GKits())->heroicSlaughter(1));
                    break;

                case 6: # heroic enchanter
                    $player->sendMessage(TF::GREEN . "You got God Kit " . TF::AQUA . "Heroic Enchanter");
                    $player->getInventory()->addItem((new GKits())->heroicEnchanter(1));
                    break;

                case 7: # heroic atheos
                    $player->sendMessage(TF::GREEN . "You got God Kit " . TF::GRAY . "Heroic Atheos");
                    $player->getInventory()->addItem((new GKits())->heroicAtheos(1));
                    break;

                case 8: # heroic Iapetus
                    $player->sendMessage(TF::GREEN . "You got God Kit " . TF::BLUE . "Heroic Iapetus");
                    $player->getInventory()->addItem((new GKits())->heroicIapetus(1));
                    break;

                case 9: # heroic broteas
                    $player->sendMessage(TF::GREEN . "You got God Kit " . TF::GREEN . "Heroic Broteas");
                    $player->getInventory()->addItem((new GKits())->heroicBroteas(1));
                    break;

                case 10: # heroic ares
                    $player->sendMessage(TF::GREEN . "You got God Kit " . TF::GOLD . "Heroic Ares");
                    $player->getInventory()->addItem((new GKits())->heroicAres(1));
                    break;

                case 11: # heroic grim reaper
                    $player->sendMessage(TF::GREEN . "You got God Kit " . TF::RED . "Heroic Grim Reaper");
                    $player->getInventory()->addItem((new GKits())->heroicGrimReaper(1));
                    break;

                case 12: # heroic executioner
                    $player->sendMessage(TF::GREEN . "You got God Kit " . TF::DARK_RED . "Heroic Executioner");
                    $player->getInventory()->addItem((new GKits())->heroicExecutioner(1));
                    break;

                case 13: # hero
                    $player->sendMessage(TF::GREEN . "You got God Kit " . TF::WHITE . "Hero");
                    $player->getInventory()->addItem((new GKits())->Hero(1));
                    break;

                case 14: # cyborg
                    $player->sendMessage(TF::GREEN . "You got God Kit " . TF::DARK_AQUA . "Cyborg");
                    $player->getInventory()->addItem((new GKits())->Cyborg(1));
                    break;

                case 15: # crucible
                    $player->sendMessage(TF::GREEN . "You got God Kit " . TF::YELLOW . "Crucible");
                    $player->getInventory()->addItem((new GKits())->Crucible(1));
                    break;

                case 16: # hunter
                    $player->sendMessage(TF::GREEN . "You got God Kit " . TF::RED . "Hunter");
                    $player->getInventory()->addItem((new GKits())->Hunter(1));
                    break;
            }
        }
        if($item->getNamedTag()->getTag("RankKitLootbox") !== null) {

            WebhookEvent::itemWebhook($player, "RankKitLootbox");

            # remove item
            $item->setCount($count - 1);
            $player->getInventory()->setItemInHand($item);
            # give reward
            $reward = mt_rand(1, 6);
            switch($reward) {

                case 1: # noble
                    $player->sendMessage(TF::GREEN . "You got Rank Kit " . TF::DARK_GRAY . "Noble");
                    $player->getInventory()->addItem((new RankKits())->noble(1));
                    break;

                case 2: # imperial
                    $player->sendMessage(TF::GREEN . "You got Rank Kit " . TF::LIGHT_PURPLE . "Imperial");
                    $player->getInventory()->addItem((new RankKits())->imperial(1));
                    break;

                case 3: # supreme
                    $player->sendMessage(TF::GREEN . "You got Rank Kit " . TF::DARK_AQUA . "Supreme");
                    $player->getInventory()->addItem((new RankKits())->supreme(1));
                    break;

                case 4: # majesty
                    $player->sendMessage(TF::GREEN . "You got Rank Kit " . TF::DARK_PURPLE . "Majesty");
                    $player->getInventory()->addItem((new RankKits())->majesty(1));
                    break;

                case 5: # emperor
                    $player->sendMessage(TF::GREEN . "You got Rank Kit " . TF::AQUA . "Emperor");
                    $player->getInventory()->addItem((new RankKits())->emperor(1));
                    break;

                case 6: # president
                    $player->sendMessage(TF::GREEN . "You got Rank Kit " . TF::RED . "President");
                    $player->getInventory()->addItem((new RankKits())->president(1));
                    break;
            }
        }
        if($item->getNamedTag()->getTag("PrestigeKitLootbox") !== null) {

            WebhookEvent::itemWebhook($player, "PrestigeKitLootbox");

            # remove item
            $item->setCount($count - 1);
            $player->getInventory()->setItemInHand($item);
            # give reward
            $reward = mt_rand(1, 6);
            switch($reward) {

                case 1: # prestige 1
                    break;

                case 2: # prestige 2
                    break;

                case 3: # prestige 3
                    break;

                case 4: # prestige 4
                    break;

                case 5: # prestige 5
                    break;

                case 6: # prestige 6
                    break;
            }
        }
    }

}