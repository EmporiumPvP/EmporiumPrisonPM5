<?php

namespace Inventories;

use Items\Boosters;
use Items\Lootboxes;
use Items\Crystals;
use Items\Gems;
use Items\GKits;
use Items\MenuItems;
use Items\Nodes;
use Items\Pouches;
# LIBRARY
use Items\RankKits;
use Items\Relics;

# POCKETMINE
use muqsit\invmenu\InvMenu;
use muqsit\invmenu\transaction\DeterministicInvMenuTransaction;
use muqsit\invmenu\type\InvMenuTypeIds;
use pocketmine\world\sound\EnderChestOpenSound;
use pocketmine\world\sound\PopSound;

class ItemsMenu {

    public function Lootboxes($sender): void {

        $menu = InvMenu::create(InvMenuTypeIds::TYPE_DOUBLE_CHEST);
        $menu->setName("Item Menu - Lootboxes");
        $menu->setListener(InvMenu::readonly(function(DeterministicInvMenuTransaction $transaction) : void {
            $player = $transaction->getPlayer();
            $itemClicked = $transaction->getItemClicked();

            if($itemClicked->getNamedTag()->getTag("GKitLootbox")) {
                $player->getInventory()->addItem((new Lootboxes)->GKit(1));
                $player->broadcastSound(new PopSound());
            }
            if($itemClicked->getNamedTag()->getTag("RankKitLootbox")) {
                $player->getInventory()->addItem((new Lootboxes)->RankKit(1));
                $player->broadcastSound(new PopSound());
            }
            if($itemClicked->getNamedTag()->getTag("PrestigeKitLootbox")) {
                $player->getInventory()->addItem((new Lootboxes)->PrestigeKit(1));
                $player->broadcastSound(new PopSound());
            }
        }));
        $inventory = $menu->getInventory();

        $inventory->setItem(0, (new MenuItems)->Filler());
        $inventory->setItem(1, (new MenuItems)->Filler());
        $inventory->setItem(2, (new MenuItems)->Filler());
        $inventory->setItem(3, (new MenuItems)->Filler());
        $inventory->setItem(4, (new MenuItems)->Filler());
        $inventory->setItem(5, (new MenuItems)->Filler());
        $inventory->setItem(6, (new MenuItems)->Filler());
        $inventory->setItem(7, (new MenuItems)->Filler());
        $inventory->setItem(8, (new MenuItems)->Filler());
        $inventory->setItem(9, (new MenuItems)->Filler());
        $inventory->setItem(17, (new MenuItems)->Filler());
        $inventory->setItem(18, (new MenuItems)->Filler());
        $inventory->setItem(26, (new MenuItems)->Filler());
        $inventory->setItem(27, (new MenuItems)->Filler());
        $inventory->setItem(35, (new MenuItems)->Filler());
        $inventory->setItem(36, (new MenuItems)->Filler());
        $inventory->setItem(44, (new MenuItems)->Filler());
        $inventory->setItem(45, (new MenuItems)->Filler());
        $inventory->setItem(46, (new MenuItems)->Filler());
        $inventory->setItem(47, (new MenuItems)->Filler());
        $inventory->setItem(48, (new MenuItems)->Filler());
        #$inventory->setItem(49, (new MenuItems)->NextPage());
        $inventory->setItem(50, (new MenuItems)->Filler());
        $inventory->setItem(51, (new MenuItems)->Filler());
        $inventory->setItem(52, (new MenuItems)->Filler());
        $inventory->setItem(53, (new MenuItems)->Filler());
        # lootboxes
        $inventory->addItem((new Lootboxes)->GKit(1));
        $inventory->addItem((new Lootboxes)->RankKit(1));
        $inventory->addItem((new Lootboxes)->PrestigeKit(1));

        $menu->send($sender);
    }

    public function Kits($sender): void {

        $menu = InvMenu::create(InvMenuTypeIds::TYPE_DOUBLE_CHEST);
        $menu->setName("Item Menu - Kits");
        $menu->setListener(InvMenu::readonly(function(DeterministicInvMenuTransaction $transaction) : void {
            $player = $transaction->getPlayer();
            $itemClicked = $transaction->getItemClicked();

            /*
                # ui buttons
                case "§l§7Back":
                    $this->Gems($player);
                    $player->broadcastSound(new EnderChestOpenSound());
                    break;
                case "§l§7Next page":
                    $this->Nodes($player);
                    $player->broadcastSound(new EnderChestOpenSound());
                    break;
            */
            # rank kits
            if($itemClicked->getNamedTag()->getTag("RankKitNoble")) {
                $player->getInventory()->addItem((new RankKits)->noble(1));
                $player->broadcastSound(new PopSound());
            }
            if($itemClicked->getNamedTag()->getTag("RankKitImperial")) {
                $player->getInventory()->addItem((new RankKits)->imperial(1));
                $player->broadcastSound(new PopSound());
            }
            if($itemClicked->getNamedTag()->getTag("RankKitSupreme")) {
                $player->getInventory()->addItem((new RankKits)->supreme(1));
                $player->broadcastSound(new PopSound());
            }
            if($itemClicked->getNamedTag()->getTag("RankKitMajesty")) {
                $player->getInventory()->addItem((new RankKits)->majesty(1));
                $player->broadcastSound(new PopSound());
            }
            if($itemClicked->getNamedTag()->getTag("RankKitEmperor")) {
                $player->getInventory()->addItem((new RankKits)->emperor(1));
                $player->broadcastSound(new PopSound());
            }
            if($itemClicked->getNamedTag()->getTag("RankKitPresident")) {
                $player->getInventory()->addItem((new RankKits)->president(1));
                $player->broadcastSound(new PopSound());
            }
            # gkits
            if($itemClicked->getNamedTag()->getTag("GKitHeroicVulkarion")) {
                $player->getInventory()->addItem((new GKits)->heroicVulkarion(1));
                $player->broadcastSound(new PopSound());
            }
            if($itemClicked->getNamedTag()->getTag("GKitHeroicZenith")) {
                $player->getInventory()->addItem((new GKits)->heroicZenith(1));
                $player->broadcastSound(new PopSound());
            }
            if($itemClicked->getNamedTag()->getTag("GKitHeroicColossus")) {
                $player->getInventory()->addItem((new GKits)->heroicColossus(1));
                $player->broadcastSound(new PopSound());
            }
            if($itemClicked->getNamedTag()->getTag("GKitHeroicWarlock")) {
                $player->getInventory()->addItem((new GKits)->heroicWarlock(1));
                $player->broadcastSound(new PopSound());
            }
            if($itemClicked->getNamedTag()->getTag("GKitHeroicSlaughter")) {
                $player->getInventory()->addItem((new GKits)->heroicSlaughter(1));
                $player->broadcastSound(new PopSound());
            }
            if($itemClicked->getNamedTag()->getTag("GKitHeroicEnchanter")) {
                $player->getInventory()->addItem((new GKits)->heroicEnchanter(1));
                $player->broadcastSound(new PopSound());
            }
            if($itemClicked->getNamedTag()->getTag("GKitHeroicAtheos")) {
                $player->getInventory()->addItem((new GKits)->heroicAtheos(1));
                $player->broadcastSound(new PopSound());
            }
            if($itemClicked->getNamedTag()->getTag("GKitHeroicIapetus")) {
                $player->getInventory()->addItem((new GKits)->heroicIapetus(1));
                $player->broadcastSound(new PopSound());
            }
            if($itemClicked->getNamedTag()->getTag("GKitHeroicBroteas")) {
                $player->getInventory()->addItem((new GKits)->heroicBroteas(1));
                $player->broadcastSound(new PopSound());
            }
            if($itemClicked->getNamedTag()->getTag("GKitHeroicAres")) {
                $player->getInventory()->addItem((new GKits)->heroicAres(1));
                $player->broadcastSound(new PopSound());
            }
            if($itemClicked->getNamedTag()->getTag("GKitHeroicGrimReaper")) {
                $player->getInventory()->addItem((new GKits)->heroicGrimReaper(1));
                $player->broadcastSound(new PopSound());
            }
            if($itemClicked->getNamedTag()->getTag("GKitHeroicExecutioner")) {
                $player->getInventory()->addItem((new GKits)->heroicExecutioner(1));
                $player->broadcastSound(new PopSound());
            }
            if($itemClicked->getNamedTag()->getTag("GKitBlacksmith")) {
                $player->getInventory()->addItem((new GKits)->blacksmith(1));
                $player->broadcastSound(new PopSound());
            }
            if($itemClicked->getNamedTag()->getTag("GKitBlacksmith")) {
                $player->getInventory()->addItem((new GKits)->blacksmith(1));
                $player->broadcastSound(new PopSound());
            }
            if($itemClicked->getNamedTag()->getTag("GKitHero")) {
                $player->getInventory()->addItem((new GKits)->hero(1));
                $player->broadcastSound(new PopSound());
            }
            if($itemClicked->getNamedTag()->getTag("GKitCyborg")) {
                $player->getInventory()->addItem((new GKits)->cyborg(1));
                $player->broadcastSound(new PopSound());
            }
            if($itemClicked->getNamedTag()->getTag("GKitCrucible")) {
                $player->getInventory()->addItem((new GKits)->crucible(1));
                $player->broadcastSound(new PopSound());
            }
            if($itemClicked->getNamedTag()->getTag("GKitHunter")) {
                $player->getInventory()->addItem((new GKits)->hunter(1));
                $player->broadcastSound(new PopSound());
            }
        }));

        $inventory = $menu->getInventory();

        $inventory->setItem(0, (new MenuItems)->Filler());
        $inventory->setItem(1, (new MenuItems)->Filler());
        $inventory->setItem(2, (new MenuItems)->Filler());
        $inventory->setItem(3, (new MenuItems)->Filler());
        $inventory->setItem(4, (new MenuItems)->Filler());
        $inventory->setItem(5, (new MenuItems)->Filler());
        $inventory->setItem(6, (new MenuItems)->Filler());
        $inventory->setItem(7, (new MenuItems)->Filler());
        $inventory->setItem(8, (new MenuItems)->Filler());
        $inventory->setItem(9, (new MenuItems)->Filler());
        $inventory->setItem(17, (new MenuItems)->Filler());
        $inventory->setItem(18, (new MenuItems)->Filler());
        $inventory->setItem(26, (new MenuItems)->Filler());
        $inventory->setItem(27, (new MenuItems)->Filler());
        $inventory->setItem(35, (new MenuItems)->Filler());
        $inventory->setItem(36, (new MenuItems)->Filler());
        $inventory->setItem(44, (new MenuItems)->Filler());
        $inventory->setItem(45, (new MenuItems)->Filler());
        $inventory->setItem(46, (new MenuItems)->Filler());
        $inventory->setItem(47, (new MenuItems)->Filler());
        $inventory->setItem(48, (new MenuItems)->Back());
        $inventory->setItem(49, (new MenuItems)->Filler());
        $inventory->setItem(50, (new MenuItems)->NextPage());
        $inventory->setItem(51, (new MenuItems)->Filler());
        $inventory->setItem(52, (new MenuItems)->Filler());
        $inventory->setItem(53, (new MenuItems)->Filler());
        # rank kits
        $inventory->addItem((new RankKits)->noble(1));
        $inventory->addItem((new RankKits)->imperial(1));
        $inventory->addItem((new RankKits)->supreme(1));
        $inventory->addItem((new RankKits)->majesty(1));
        $inventory->addItem((new RankKits)->emperor(1));
        $inventory->addItem((new RankKits)->president(1));
        # gkits
        $inventory->addItem((new GKits)->heroicVulkarion(1));
        $inventory->addItem((new GKits)->heroicZenith(1));
        $inventory->addItem((new GKits)->heroicColossus(1));
        $inventory->addItem((new GKits)->heroicZenith(1));
        $inventory->addItem((new GKits)->heroicWarlock(1));
        $inventory->addItem((new GKits)->heroicSlaughter(1));
        $inventory->addItem((new GKits)->heroicZenith(1));
        $inventory->addItem((new GKits)->heroicEnchanter(1));
        $inventory->addItem((new GKits)->heroicAtheos(1));
        $inventory->addItem((new GKits)->heroicIapetus(1));
        $inventory->addItem((new GKits)->heroicBroteas(1));
        $inventory->addItem((new GKits)->heroicAres(1));
        $inventory->addItem((new GKits)->heroicGrimReaper(1));
        $inventory->addItem((new GKits)->heroicExecutioner(1));
        $inventory->addItem((new GKits)->blacksmith(1));
        $inventory->addItem((new GKits)->hero(1));
        $inventory->addItem((new GKits)->cyborg(1));
        $inventory->addItem((new GKits)->crucible(1));
        $inventory->addItem((new GKits)->hunter(1));

        $menu->send($sender);
    }

    public function Shards($sender): void {

        $menu = InvMenu::create(InvMenuTypeIds::TYPE_DOUBLE_CHEST);
        $menu->setName("Item Menu - Shards");
        $menu->setListener(InvMenu::readonly(function(DeterministicInvMenuTransaction $transaction) : void {
            $player = $transaction->getPlayer();
            $itemClicked = $transaction->getItemClicked()->getCustomName();

            switch($itemClicked) {

                case "§l§7Back":
                    $this->Kits($player);
                    $player->broadcastSound(new EnderChestOpenSound());
                    break;

                case "§l§7Next page":
                    $this->Relics($player);
                    $player->broadcastSound(new EnderChestOpenSound());
                    break;

                case "§eFeed Permissions":
                    $player->getInventory()->addItem((new Nodes)->Feed());
                    $player->broadcastSound(new PopSound());
                    break;

                case "§eHeal Permissions":
                    $player->getInventory()->addItem((new Nodes)->Heal());
                    $player->broadcastSound(new PopSound());
                    break;

                case "§eFly Permissions":
                    $player->getInventory()->addItem((new Nodes)->Fly());
                    $player->broadcastSound(new PopSound());
                    break;

                case "§eHermes Kit Permissions":
                    $player->getInventory()->addItem((new Nodes)->Hermes());
                    $player->broadcastSound(new PopSound());
                    break;

                case "§eAthena Kit Permissions":
                    $player->getInventory()->addItem((new Nodes)->Athena());
                    $player->broadcastSound(new PopSound());
                    break;

                case "§eZeus Kit Permissions":
                    $player->getInventory()->addItem((new Nodes)->Zeus());
                    $player->broadcastSound(new PopSound());
                    break;
            }

        }));

        $inventory = $menu->getInventory();

        $inventory->setItem(0, (new MenuItems)->Filler());
        $inventory->setItem(1, (new MenuItems)->Filler());
        $inventory->setItem(2, (new MenuItems)->Filler());
        $inventory->setItem(3, (new MenuItems)->Filler());
        $inventory->setItem(4, (new MenuItems)->Filler());
        $inventory->setItem(5, (new MenuItems)->Filler());
        $inventory->setItem(6, (new MenuItems)->Filler());
        $inventory->setItem(7, (new MenuItems)->Filler());
        $inventory->setItem(8, (new MenuItems)->Filler());
        $inventory->setItem(9, (new MenuItems)->Filler());
        $inventory->setItem(17, (new MenuItems)->Filler());
        $inventory->setItem(18, (new MenuItems)->Filler());
        $inventory->setItem(26, (new MenuItems)->Filler());
        $inventory->setItem(27, (new MenuItems)->Filler());
        $inventory->setItem(35, (new MenuItems)->Filler());
        $inventory->setItem(36, (new MenuItems)->Filler());
        $inventory->setItem(44, (new MenuItems)->Filler());
        $inventory->setItem(45, (new MenuItems)->Filler());
        $inventory->setItem(46, (new MenuItems)->Filler());
        $inventory->setItem(47, (new MenuItems)->Filler());
        $inventory->setItem(48, (new MenuItems)->Back());
        $inventory->setItem(49, (new MenuItems)->Filler());
        $inventory->setItem(50, (new MenuItems)->NextPage());
        $inventory->setItem(51, (new MenuItems)->Filler());
        $inventory->setItem(52, (new MenuItems)->Filler());
        $inventory->setItem(53, (new MenuItems)->Filler());

        $inventory->addItem((new Nodes)->Feed());
        $inventory->addItem((new Nodes)->Fly());
        $inventory->addItem((new Nodes)->Heal());
        $inventory->addItem((new Nodes)->Hermes());
        $inventory->addItem((new Nodes)->Athena());
        $inventory->addItem((new Nodes)->Zeus());

        $menu->send($sender);
    }

    public function Relics($sender): void {

        $menu = InvMenu::create(InvMenuTypeIds::TYPE_DOUBLE_CHEST);
        $menu->setName("Item Menu - Relics");
        $menu->setListener(InvMenu::readonly(function(DeterministicInvMenuTransaction $transaction) : void {
            $player = $transaction->getPlayer();
            $itemClicked = $transaction->getItemClicked()->getCustomName();

            switch($itemClicked) {

                case "§l§7Back":
                    $this->Nodes($player);
                    $player->broadcastSound(new EnderChestOpenSound());
                    break;

                case "§l§7Next page":
                    $this->Pouches($player);
                    $player->broadcastSound(new EnderChestOpenSound());
                    break;

                case "§8[§7*§8] §l§bCommon Relic §r§8[§7*§8]":
                    $player->getInventory()->addItem((new Relics)->Common());
                    $player->broadcastSound(new PopSound());
                    break;

                case "§8[§7*§8] §l§eUncommon Relic §r§8[§7*§8]":
                    $player->getInventory()->addItem((new Relics)->Uncommon());
                    $player->broadcastSound(new PopSound());
                    break;

                case "§8[§7*§8] §l§6Rare Relic §r§8[§7*§8]":
                    $player->getInventory()->addItem((new Relics)->Rare());
                    $player->broadcastSound(new PopSound());
                    break;

                case "§8[§7*§8] §l§cMythical Relic §r§8[§7*§8]":
                    $player->getInventory()->addItem((new Relics)->Mythical());
                    $player->broadcastSound(new PopSound());
                    break;

                case "§8[§7*§8] §l§4Immortal Relic §r§8[§7*§8]":
                    $player->getInventory()->addItem((new Relics)->Immortal());
                    $player->broadcastSound(new PopSound());
                    break;
            }

        }));

        $inventory = $menu->getInventory();

        $inventory->setItem(0, (new MenuItems)->Filler());
        $inventory->setItem(1, (new MenuItems)->Filler());
        $inventory->setItem(2, (new MenuItems)->Filler());
        $inventory->setItem(3, (new MenuItems)->Filler());
        $inventory->setItem(4, (new MenuItems)->Filler());
        $inventory->setItem(5, (new MenuItems)->Filler());
        $inventory->setItem(6, (new MenuItems)->Filler());
        $inventory->setItem(7, (new MenuItems)->Filler());
        $inventory->setItem(8, (new MenuItems)->Filler());
        $inventory->setItem(9, (new MenuItems)->Filler());
        $inventory->setItem(17, (new MenuItems)->Filler());
        $inventory->setItem(18, (new MenuItems)->Filler());
        $inventory->setItem(26, (new MenuItems)->Filler());
        $inventory->setItem(27, (new MenuItems)->Filler());
        $inventory->setItem(35, (new MenuItems)->Filler());
        $inventory->setItem(36, (new MenuItems)->Filler());
        $inventory->setItem(44, (new MenuItems)->Filler());
        $inventory->setItem(45, (new MenuItems)->Filler());
        $inventory->setItem(46, (new MenuItems)->Filler());
        $inventory->setItem(47, (new MenuItems)->Filler());
        $inventory->setItem(48, (new MenuItems)->Back());
        $inventory->setItem(49, (new MenuItems)->Filler());
        $inventory->setItem(50, (new MenuItems)->NextPage());
        $inventory->setItem(51, (new MenuItems)->Filler());
        $inventory->setItem(52, (new MenuItems)->Filler());
        $inventory->setItem(53, (new MenuItems)->Filler());

        $inventory->addItem((new Relics)->Common());
        $inventory->addItem((new Relics)->Uncommon());
        $inventory->addItem((new Relics)->Rare());
        $inventory->addItem((new Relics)->Mythical());
        $inventory->addItem((new Relics)->Immortal());

        $menu->send($sender);
    }

    public function Pouches($sender): void {

        $menu = InvMenu::create(InvMenuTypeIds::TYPE_DOUBLE_CHEST);
        $menu->setName("Item Menu - Pouches");
        $menu->setListener(InvMenu::readonly(function(DeterministicInvMenuTransaction $transaction): void {

            $player = $transaction->getPlayer();
            $itemClicked = $transaction->getItemClicked()->getCustomName();

            switch($itemClicked) {

                case "§l§7Back":
                    $this->Relics($player);
                    $player->broadcastSound(new EnderChestOpenSound());
                    break;

                case "§l§7Next page":
                    $this->Books($player);
                    $player->broadcastSound(new EnderChestOpenSound());
                    break;

                case "§8[§7*§8] §l§3Money Pouch §8[§7*§8]":
                    $player->getInventory()->addItem((new Pouches)->Money());
                    $player->broadcastSound(new PopSound());
                    break;
            }
        }));

        $inventory = $menu->getInventory();

        $inventory->setItem(0, (new MenuItems)->Filler());
        $inventory->setItem(1, (new MenuItems)->Filler());
        $inventory->setItem(2, (new MenuItems)->Filler());
        $inventory->setItem(3, (new MenuItems)->Filler());
        $inventory->setItem(4, (new MenuItems)->Filler());
        $inventory->setItem(5, (new MenuItems)->Filler());
        $inventory->setItem(6, (new MenuItems)->Filler());
        $inventory->setItem(7, (new MenuItems)->Filler());
        $inventory->setItem(8, (new MenuItems)->Filler());
        $inventory->setItem(9, (new MenuItems)->Filler());
        $inventory->setItem(17, (new MenuItems)->Filler());
        $inventory->setItem(18, (new MenuItems)->Filler());
        $inventory->setItem(26, (new MenuItems)->Filler());
        $inventory->setItem(27, (new MenuItems)->Filler());
        $inventory->setItem(35, (new MenuItems)->Filler());
        $inventory->setItem(36, (new MenuItems)->Filler());
        $inventory->setItem(44, (new MenuItems)->Filler());
        $inventory->setItem(45, (new MenuItems)->Filler());
        $inventory->setItem(46, (new MenuItems)->Filler());
        $inventory->setItem(47, (new MenuItems)->Filler());
        $inventory->setItem(48, (new MenuItems)->Back());
        $inventory->setItem(49, (new MenuItems)->Filler());
        $inventory->setItem(50, (new MenuItems)->NextPage());
        $inventory->setItem(51, (new MenuItems)->Filler());
        $inventory->setItem(52, (new MenuItems)->Filler());
        $inventory->setItem(53, (new MenuItems)->Filler());

        # POUCHES
        $inventory->addItem((new Pouches)->Money());

        $menu->send($sender);
    }

    public function Boosters($sender): void {

        $menu = InvMenu::create(InvMenuTypeIds::TYPE_DOUBLE_CHEST);
        $menu->setName("Item Menu - Boosters");
        $menu->setListener(InvMenu::readonly(function(DeterministicInvMenuTransaction $transaction) : void {
            $player = $transaction->getPlayer();
            $itemClicked = $transaction->getItemClicked()->getCustomName();

            switch($itemClicked) {

                case "§l§7Back":
                    #$this->Books($player);
                    $player->broadcastSound(new EnderChestOpenSound());
                    break;

                case "§l§7Next page":
                    $this->Crystals($player);
                    $player->broadcastSound(new EnderChestOpenSound());
                    break;

                case "§l§cPersonal Relic Booster":
                    $player->getInventory()->addItem((new Boosters)->Relic());
                    $player->broadcastSound(new PopSound());
                    break;

                case "§l§cGlobal Relic Booster":
                    $player->getInventory()->addItem((new Boosters)->GlobalRelic());
                    $player->broadcastSound(new PopSound());
                    break;

                case "§l§dPersonal Key Booster":
                    $player->getInventory()->addItem((new Boosters)->Key());
                    $player->broadcastSound(new PopSound());
                    break;

                case "§l§dGlobal Key Booster":
                    $player->getInventory()->addItem((new Boosters)->GlobalKey());
                    $player->broadcastSound(new PopSound());
                    break;
            }

        }));

        $inventory = $menu->getInventory();

        $inventory->setItem(0, (new MenuItems)->Filler());
        $inventory->setItem(1, (new MenuItems)->Filler());
        $inventory->setItem(2, (new MenuItems)->Filler());
        $inventory->setItem(3, (new MenuItems)->Filler());
        $inventory->setItem(4, (new MenuItems)->Filler());
        $inventory->setItem(5, (new MenuItems)->Filler());
        $inventory->setItem(6, (new MenuItems)->Filler());
        $inventory->setItem(7, (new MenuItems)->Filler());
        $inventory->setItem(8, (new MenuItems)->Filler());
        $inventory->setItem(9, (new MenuItems)->Filler());
        $inventory->setItem(17, (new MenuItems)->Filler());
        $inventory->setItem(18, (new MenuItems)->Filler());
        $inventory->setItem(26, (new MenuItems)->Filler());
        $inventory->setItem(27, (new MenuItems)->Filler());
        $inventory->setItem(35, (new MenuItems)->Filler());
        $inventory->setItem(36, (new MenuItems)->Filler());
        $inventory->setItem(44, (new MenuItems)->Filler());
        $inventory->setItem(45, (new MenuItems)->Filler());
        $inventory->setItem(46, (new MenuItems)->Filler());
        $inventory->setItem(47, (new MenuItems)->Filler());
        $inventory->setItem(48, (new MenuItems)->Back());
        $inventory->setItem(49, (new MenuItems)->Filler());
        $inventory->setItem(50, (new MenuItems)->NextPage());
        $inventory->setItem(51, (new MenuItems)->Filler());
        $inventory->setItem(52, (new MenuItems)->Filler());
        $inventory->setItem(53, (new MenuItems)->Filler());

        $inventory->addItem((new Boosters)->Relic());
        $inventory->addItem((new Boosters)->GlobalRelic());
        $inventory->addItem((new Boosters)->Key());
        $inventory->addItem((new Boosters)->GlobalKey());

        $menu->send($sender);
    }

    public function Crystals($sender): void {

        $menu = InvMenu::create(InvMenuTypeIds::TYPE_DOUBLE_CHEST);
        $menu->setName("Item Menu - Crystals");
        $menu->setListener(InvMenu::readonly(function(DeterministicInvMenuTransaction $transaction) : void {
            $player = $transaction->getPlayer();
            $itemClicked = $transaction->getItemClicked()->getCustomName();

            switch($itemClicked) {

                case "§l§7Back":
                    $this->Boosters($player);
                    $player->broadcastSound(new EnderChestOpenSound());
                    break;

                case "§2Knight Crystal":
                    $player->getInventory()->addItem((new Crystals)->noble());
                    $player->broadcastSound(new PopSound());
                    break;

                case "§2Knight Superior Crystal":
                    $player->getInventory()->addItem((new Crystals)->nobleSuperior());
                    $player->broadcastSound(new PopSound());
                    break;

                case "§eWarrior Crystal":
                    $player->getInventory()->addItem((new Crystals)->imperial());
                    $player->broadcastSound(new PopSound());
                    break;

                case "§eWarrior Superior Crystal":
                    $player->getInventory()->addItem((new Crystals)->imperialSuperior());
                    $player->broadcastSound(new PopSound());
                    break;

                case "§3Warlord Crystal":
                    $player->getInventory()->addItem((new Crystals)->supreme());
                    $player->broadcastSound(new PopSound());
                    break;

                case "§3Warlord Superior Crystal":
                    $player->getInventory()->addItem((new Crystals)->supremeSuperior());
                    $player->broadcastSound(new PopSound());
                    break;

                case "§4Overlord Crystal":
                    $player->getInventory()->addItem((new Crystals)->majesty());
                    $player->broadcastSound(new PopSound());
                    break;

                case "§4Overlord Superior Crystal":
                    $player->getInventory()->addItem((new Crystals)->majestySuperior());
                    $player->broadcastSound(new PopSound());
                    break;

                case "§dTwilight Crystal":
                    $player->getInventory()->addItem((new Crystals)->emperor());
                    $player->broadcastSound(new PopSound());
                    break;

                case "§dTwilight Superior Crystal":
                    $player->getInventory()->addItem((new Crystals)->emperorSuperior());
                    $player->broadcastSound(new PopSound());
                    break;

                case "§l§4N§ci§4g§ch§4t§cm§4a§cr§4e §r§4Crystal":
                    $player->getInventory()->addItem((new Crystals)->president());
                    $player->broadcastSound(new PopSound());
                    break;

                case "§4N§ci§4g§ch§4t§cm§4a§cr§4e §r§4Superior Crystal":
                    $player->getInventory()->addItem((new Crystals)->presidentSuperior());
                    $player->broadcastSound(new PopSound());
                    break;
            }

        }));

        $inventory = $menu->getInventory();

        $inventory->setItem(0, (new MenuItems)->Filler());
        $inventory->setItem(1, (new MenuItems)->Filler());
        $inventory->setItem(2, (new MenuItems)->Filler());
        $inventory->setItem(3, (new MenuItems)->Filler());
        $inventory->setItem(4, (new MenuItems)->Filler());
        $inventory->setItem(5, (new MenuItems)->Filler());
        $inventory->setItem(6, (new MenuItems)->Filler());
        $inventory->setItem(7, (new MenuItems)->Filler());
        $inventory->setItem(8, (new MenuItems)->Filler());
        $inventory->setItem(9, (new MenuItems)->Filler());
        $inventory->setItem(17, (new MenuItems)->Filler());
        $inventory->setItem(18, (new MenuItems)->Filler());
        $inventory->setItem(26, (new MenuItems)->Filler());
        $inventory->setItem(27, (new MenuItems)->Filler());
        $inventory->setItem(35, (new MenuItems)->Filler());
        $inventory->setItem(36, (new MenuItems)->Filler());
        $inventory->setItem(44, (new MenuItems)->Filler());
        $inventory->setItem(45, (new MenuItems)->Filler());
        $inventory->setItem(46, (new MenuItems)->Filler());
        $inventory->setItem(47, (new MenuItems)->Filler());
        $inventory->setItem(48, (new MenuItems)->Filler());
        $inventory->setItem(49, (new MenuItems)->Back());
        $inventory->setItem(50, (new MenuItems)->Filler());
        $inventory->setItem(51, (new MenuItems)->Filler());
        $inventory->setItem(52, (new MenuItems)->Filler());
        $inventory->setItem(53, (new MenuItems)->Filler());

        $inventory->addItem((new Crystals)->noble());
        $inventory->addItem((new Crystals)->nobleSuperior());
        $inventory->addItem((new Crystals)->imperial());
        $inventory->addItem((new Crystals)->imperialSuperior());
        $inventory->addItem((new Crystals)->supreme());
        $inventory->addItem((new Crystals)->supremeSuperior());
        $inventory->addItem((new Crystals)->majesty());
        $inventory->addItem((new Crystals)->majestySuperior());
        $inventory->addItem((new Crystals)->emperor());
        $inventory->addItem((new Crystals)->emperorSuperior());
        $inventory->addItem((new Crystals)->president());
        $inventory->addItem((new Crystals)->presidentSuperior());

        $menu->send($sender);
    }

}