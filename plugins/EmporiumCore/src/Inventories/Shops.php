<?php

namespace Inventories;

use Emporium\Prison\items\Pickaxes;


use EmporiumCore\managers\data\DataManager;
use muqsit\invmenu\InvMenu;
use muqsit\invmenu\transaction\DeterministicInvMenuTransaction;
use muqsit\invmenu\type\InvMenuTypeIds;

use pocketmine\item\VanillaItems;

use pocketmine\utils\TextFormat;

use pocketmine\world\sound\ItemFrameAddItemSound;
use pocketmine\world\sound\XpCollectSound;

class Shops {

    public function Blacksmith($sender): void {

        $menu = InvMenu::create(InvMenuTypeIds::TYPE_DOUBLE_CHEST);
        $menu->setName(TextFormat::BOLD . "Blacksmith");
        $money = DataManager::getData($sender, "Players", "Money");
        $menu->setListener(InvMenu::readonly(function(DeterministicInvMenuTransaction $transaction) use ($money): void {
            $player = $transaction->getPlayer();
            $itemClicked = $transaction->getItemClicked();
            # bow
            if($itemClicked->getId() === 261) {
                if($money >= 5000) {
                    DataManager::takeData($player, "Players", "Money", 5000);
                    $player->getInventory()->addItem(VanillaItems::BOW());
                    $player->broadcastSound(new XpCollectSound());
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound());
                }
            }
            # arrow
            if($itemClicked->getId() === 262) {
                if($money >= 100) {
                    DataManager::takeData($player, "Players", "Money", 100);
                    $player->getInventory()->addItem(VanillaItems::ARROW());
                    $player->broadcastSound(new XpCollectSound());
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound());
                }
            }
            # trainee pickaxe
            if($itemClicked->getId() === 270) {
                if($money >= 20) {
                    DataManager::takeData($player, "Players", "Money", 20);
                    $player->getInventory()->addItem((new Pickaxes($player))->Trainee());
                    $player->broadcastSound(new XpCollectSound());
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound());
                }
            }
            # wooden sword
            if($itemClicked->getId() === 268) {
                if($money >= 100) {
                    DataManager::takeData($player, "Players", "Money", 100);
                    $player->getInventory()->addItem(VanillaItems::WOODEN_SWORD());
                    $player->broadcastSound(new XpCollectSound());
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound());
                }
            }
            # wooden axe
            if($itemClicked->getId() === 271) {
                if($money >= 100) {
                    DataManager::takeData($player, "Players", "Money", 100);
                    $player->getInventory()->addItem(VanillaItems::WOODEN_AXE());
                    $player->broadcastSound(new XpCollectSound());
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound());
                }
            }


            # chain helmet
            if($itemClicked->getId() === 302) {
                if($money >= 100) {
                    DataManager::takeData($player, "Players", "Money", 100);
                    $player->getInventory()->addItem(VanillaItems::CHAINMAIL_HELMET());
                    $player->broadcastSound(new XpCollectSound());
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound());
                }
            }
            # chain chestplate
            if($itemClicked->getId() === 303) {
                if($money >= 100) {
                    DataManager::takeData($player, "Players", "Money", 100);
                    $player->getInventory()->addItem(VanillaItems::CHAINMAIL_CHESTPLATE());
                    $player->broadcastSound(new XpCollectSound());
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound());
                }
            }
            # chain leggings
            if($itemClicked->getId() === 304) {
                if($money >= 100) {
                    DataManager::takeData($player, "Players", "Money", 100);
                    $player->getInventory()->addItem(VanillaItems::CHAINMAIL_LEGGINGS());
                    $player->broadcastSound(new XpCollectSound());
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound());
                }
            }
            # chain boots
            if($itemClicked->getId() === 305) {
                if($money >= 100) {
                    DataManager::takeData($player, "Players", "Money", 100);
                    $player->getInventory()->addItem(VanillaItems::CHAINMAIL_BOOTS());
                    $player->broadcastSound(new XpCollectSound());
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound());
                }
            }
            # stone pickaxe
            if($itemClicked->getId() === 274) {
                if($money >= 200) {
                    DataManager::takeData($player, "Players", "Money", 200);
                    $player->getInventory()->addItem((new Pickaxes($player))->Stone());
                    $player->broadcastSound(new XpCollectSound());
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound());
                }
            }
            # stone sword
            if($itemClicked->getId() === 272) {
                if($money >= 500) {
                    DataManager::takeData($player, "Players", "Money", 500);
                    $player->getInventory()->addItem(VanillaItems::STONE_SWORD());
                    $player->broadcastSound(new XpCollectSound());
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound());
                }
            }
            # stone axe
            if($itemClicked->getId() === 275) {
                if($money >= 500) {
                    DataManager::takeData($player, "Players", "Money", 500);
                    $player->getInventory()->addItem(VanillaItems::STONE_AXE());
                    $player->broadcastSound(new XpCollectSound());
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound());
                }
            }


            # golden helmet
            if($itemClicked->getId() === 314) {
                if($money >= 1000) {
                    DataManager::takeData($player, "Players", "Money", 1000);
                    $player->getInventory()->addItem(VanillaItems::GOLDEN_HELMET());
                    $player->broadcastSound(new XpCollectSound());
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound());
                }
            }
            # golden chestplate
            if($itemClicked->getId() === 315) {
                if($money >= 1000) {
                    DataManager::takeData($player, "Players", "Money", 1000);
                    $player->getInventory()->addItem(VanillaItems::GOLDEN_CHESTPLATE());
                    $player->broadcastSound(new XpCollectSound());
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound());
                }
            }
            # golden leggings
            if($itemClicked->getId() === 316) {
                if($money >= 1000) {
                    DataManager::takeData($player, "Players", "Money", 1000);
                    $player->getInventory()->addItem(VanillaItems::GOLDEN_LEGGINGS());
                    $player->broadcastSound(new XpCollectSound());
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound());
                }
            }
            # golden boots
            if($itemClicked->getId() === 317) {
                if($money >= 1000) {
                    DataManager::takeData($player, "Players", "Money", 1000);
                    $player->getInventory()->addItem(VanillaItems::GOLDEN_BOOTS());
                    $player->broadcastSound(new XpCollectSound());
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound());
                }
            }
            # golden pickaxe
            if($itemClicked->getId() === 285) {
                if($money >= 2000) {
                    DataManager::takeData($player, "Players", "Money", 2000);
                    $player->getInventory()->addItem((new Pickaxes($player))->Gold());
                    $player->broadcastSound(new XpCollectSound());
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound());
                }
            }
            # golden sword
            if($itemClicked->getId() === 283) {
                if($money >= 2000) {
                    DataManager::takeData($player, "Players", "Money", 2000);
                    $player->getInventory()->addItem(VanillaItems::GOLDEN_SWORD());
                    $player->broadcastSound(new XpCollectSound());
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound());
                }
            }
            # golden axe
            if($itemClicked->getId() === 286) {
                if($money >= 2000) {
                    DataManager::takeData($player, "Players", "Money", 2000);
                    $player->getInventory()->addItem(VanillaItems::GOLDEN_AXE());
                    $player->broadcastSound(new XpCollectSound());
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound());
                }
            }


            # iron helmet
            if($itemClicked->getId() === 306) {
                if($money >= 100000) {
                    DataManager::takeData($player, "Players", "Money", 100000);
                    $player->getInventory()->addItem(VanillaItems::IRON_HELMET());
                    $player->broadcastSound(new XpCollectSound());
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound());
                }
            }
            # iron chestplate
            if($itemClicked->getId() === 307) {
                if($money >= 100000) {
                    DataManager::takeData($player, "Players", "Money", 100000);
                    $player->getInventory()->addItem(VanillaItems::IRON_CHESTPLATE());
                    $player->broadcastSound(new XpCollectSound());
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound());
                }
            }
            # iron leggings
            if($itemClicked->getId() === 308) {
                if($money >= 100000) {
                    DataManager::takeData($player, "Players", "Money", 100000);
                    $player->getInventory()->addItem(VanillaItems::IRON_LEGGINGS());
                    $player->broadcastSound(new XpCollectSound());
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound());
                }
            }
            # iron boots
            if($itemClicked->getId() === 309) {
                if($money >= 100000) {
                    DataManager::takeData($player, "Players", "Money", 100000);
                    $player->getInventory()->addItem(VanillaItems::IRON_BOOTS());
                    $player->broadcastSound(new XpCollectSound());
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound());
                }
            }
            # iron pickaxe
            if($itemClicked->getId() === 257) {
                if($money >= 200000) {
                    DataManager::takeData($player, "Players", "Money", 200000);
                    $player->getInventory()->addItem((new Pickaxes($player))->Iron());
                    $player->broadcastSound(new XpCollectSound());
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound());
                }
            }
            # iron sword
            if($itemClicked->getId() === 267) {
                if($money >= 200000) {
                    DataManager::takeData($player, "Players", "Money", 200000);
                    $player->getInventory()->addItem(VanillaItems::IRON_SWORD());
                    $player->broadcastSound(new XpCollectSound());
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound());
                }
            }
            # iron axe
            if($itemClicked->getId() === 258) {
                if($money >= 200000) {
                    DataManager::takeData($player, "Players", "Money", 200000);
                    $player->getInventory()->addItem(VanillaItems::IRON_AXE());
                    $player->broadcastSound(new XpCollectSound());
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound());
                }
            }


            # diamond helmet
            if($itemClicked->getId() === 310) {
                if($money >= 1000000) {
                    DataManager::takeData($player, "Players", "Money", 1000000);
                    $player->getInventory()->addItem(VanillaItems::DIAMOND_HELMET());
                    $player->broadcastSound(new XpCollectSound());
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound());
                }
            }
            # diamond chestplate
            if($itemClicked->getId() === 311) {
                if($money >= 1000000) {
                    DataManager::takeData($player, "Players", "Money", 1000000);
                    $player->getInventory()->addItem(VanillaItems::DIAMOND_CHESTPLATE());
                    $player->broadcastSound(new XpCollectSound());
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound());
                }
            }
            # diamond leggings
            if($itemClicked->getId() === 312) {
                if($money >= 1000000) {
                    DataManager::takeData($player, "Players", "Money", 1000000);
                    $player->getInventory()->addItem(VanillaItems::DIAMOND_LEGGINGS());
                    $player->broadcastSound(new XpCollectSound());
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound());
                }
            }
            # diamond boots
            if($itemClicked->getId() === 313) {
                if($money >= 1000000) {
                    DataManager::takeData($player, "Players", "Money", 1000000);
                    $player->getInventory()->addItem(VanillaItems::DIAMOND_BOOTS());
                    $player->broadcastSound(new XpCollectSound());
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound());
                }
            }
            # diamond pickaxe
            if($itemClicked->getId() === 278) {
                if($money >= 2000000) {
                    DataManager::takeData($player, "Players", "Money", 2000000);
                    $player->getInventory()->addItem((new Pickaxes($player))->Diamond());
                    $player->broadcastSound(new XpCollectSound());
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound());
                }
            }
            # diamond sword
            if($itemClicked->getId() === 276) {
                if($money >= 2000000) {
                    DataManager::takeData($player, "Players", "Money", 2000000);
                    $player->getInventory()->addItem(VanillaItems::DIAMOND_SWORD());
                    $player->broadcastSound(new XpCollectSound());
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound());
                }
            }
            # diamond axe
            if($itemClicked->getId() === 279) {
                if($money >= 2000000) {
                    DataManager::takeData($player, "Players", "Money", 2000000);
                    $player->getInventory()->addItem(VanillaItems::DIAMOND_AXE());
                    $player->broadcastSound(new XpCollectSound());
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound());
                }
            }
        }));
        $inventory = $menu->getInventory();
        # starter tier
        $inventory->setItem(1, VanillaItems::BOW()); # $5000
        $inventory->setItem(2, VanillaItems::ARROW()); # $100
        $inventory->setItem(5, (new Pickaxes($sender))->Trainee()); # $20
        $inventory->setItem(6, VanillaItems::WOODEN_SWORD()); # $100
        $inventory->setItem(7, VanillaItems::WOODEN_AXE()); # $100
        # chain tier
        $inventory->setItem(10, VanillaItems::CHAINMAIL_HELMET()); # $100
        $inventory->setItem(11, VanillaItems::CHAINMAIL_CHESTPLATE()); # $100
        $inventory->setItem(12, VanillaItems::CHAINMAIL_LEGGINGS()); # $100
        $inventory->setItem(13, VanillaItems::CHAINMAIL_BOOTS()); # $100
        $inventory->setItem(14, (new Pickaxes($sender))->Stone()); # $200
        $inventory->setItem(15, VanillaItems::STONE_SWORD()); # $500
        $inventory->setItem(16, VanillaItems::STONE_AXE()); # $500
        # gold tier
        $inventory->setItem(19, VanillaItems::GOLDEN_HELMET()); # $1000
        $inventory->setItem(20, VanillaItems::GOLDEN_CHESTPLATE()); # $1000
        $inventory->setItem(21, VanillaItems::GOLDEN_LEGGINGS()); # $1000
        $inventory->setItem(22, VanillaItems::GOLDEN_BOOTS()); # $1000
        $inventory->setItem(23, (new Pickaxes($sender))->Gold()); # $2000
        $inventory->setItem(24, VanillaItems::GOLDEN_SWORD()); # $2000
        $inventory->setItem(25, VanillaItems::GOLDEN_AXE()); # $2000
        # iron tier
        $inventory->setItem(28, VanillaItems::IRON_HELMET()); # $100000
        $inventory->setItem(29, VanillaItems::IRON_CHESTPLATE()); # $100000
        $inventory->setItem(30, VanillaItems::IRON_LEGGINGS()); # $100000
        $inventory->setItem(31, VanillaItems::IRON_BOOTS()); # $100000
        $inventory->setItem(32, (new Pickaxes($sender))->Iron()); # $200000
        $inventory->setItem(33, VanillaItems::IRON_SWORD()); # $200000
        $inventory->setItem(34, VanillaItems::IRON_AXE()); # $200000
        # diamond tier
        $inventory->setItem(37, VanillaItems::DIAMOND_HELMET()); # $1000000
        $inventory->setItem(38, VanillaItems::DIAMOND_CHESTPLATE()); # $1000000
        $inventory->setItem(39, VanillaItems::DIAMOND_LEGGINGS()); # $1000000
        $inventory->setItem(40, VanillaItems::DIAMOND_BOOTS()); # $1000000
        $inventory->setItem(41, (new Pickaxes($sender))->Diamond()); # $2000000
        $inventory->setItem(42, VanillaItems::DIAMOND_SWORD()); # $2000000
        $inventory->setItem(43, VanillaItems::DIAMOND_AXE()); # $2000000

        $menu->send($sender);
    }

}