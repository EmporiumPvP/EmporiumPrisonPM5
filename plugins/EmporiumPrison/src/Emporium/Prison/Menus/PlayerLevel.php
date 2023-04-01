<?php

namespace Emporium\Prison\Menus;

use customiesdevs\customies\item\CustomiesItemFactory;

use Emporium\Prison\EmporiumPrison;
use EmporiumData\DataManager;

use Emporium\Prison\library\formapi\SimpleForm;
use Emporium\Prison\Managers\misc\GlowManager;
use Emporium\Prison\Managers\misc\Translator;

use muqsit\invmenu\InvMenu;
use muqsit\invmenu\transaction\DeterministicInvMenuTransaction;
use muqsit\invmenu\type\InvMenuTypeIds;

use pocketmine\item\Item;
use pocketmine\item\VanillaItems;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;

class PlayerLevel extends Menu {

    public function Form(Player $player): void {

        $form = new SimpleForm(function($player) {
            $menu = EmporiumPrison::getInstance()->getHelpMenu();
            $menu->open($player);
        });
        $form->setTitle("Player Levels");
        $form->setContent(TF::BOLD . TF::GREEN . "Level " . TF::RESET . TF::WHITE . "1:" . TF::EOL . TF::WHITE . "0" . TF::GRAY . " XP" . TF::EOL . "Unlocks:" . TF::EOL . TF::EOL . TF::GOLD . "Wooden Sword\nWooden Axe\nWooden Pickaxe" . TF::EOL . TF::EOL .
            TF::BOLD . TF::GREEN . "Level " . TF::RESET . TF::WHITE . "10:" . TF::EOL . TF::WHITE . "1,220" . TF::GRAY . " XP" . TF::EOL . "Unlocks:" . TF::EOL . TF::EOL . TF::GOLD . "Chain Armour\nStone Sword\nStone Axe" . TF::EOL . TF::EOL .
            TF::BOLD . TF::GREEN . "Level " . TF::RESET . TF::WHITE . "15:" . TF::EOL . TF::WHITE . "3,212" . TF::GRAY . " XP" . TF::EOL . TF::EOL .
            TF::BOLD . TF::GREEN . "Level " . TF::RESET . TF::WHITE . "20:" . TF::EOL . TF::WHITE . "8,989" . TF::GRAY . " XP" . TF::EOL . TF::EOL .
            TF::BOLD . TF::GREEN . "Level " . TF::RESET . TF::WHITE . "25:" . TF::EOL . TF::WHITE . "22,371" . TF::GRAY . " XP" . TF::EOL . TF::EOL .
            TF::BOLD . TF::GREEN . "Level " . TF::RESET . TF::WHITE . "30:" . TF::EOL . TF::WHITE . "52,849" . TF::GRAY . " XP" . TF::EOL . "Unlocks:" . TF::EOL . TF::EOL . TF::GOLD . "Gold Armour\nGold Sword\nGold Axe" . TF::EOL . TF::EOL .
            TF::BOLD . TF::GREEN . "Level " . TF::RESET . TF::WHITE . "35:" . TF::EOL . TF::WHITE . "112,490" . TF::GRAY . " XP" . TF::EOL . TF::EOL .
            TF::BOLD . TF::GREEN . "Level " . TF::RESET . TF::WHITE . "40:" . TF::EOL . TF::WHITE . "221,961" . TF::GRAY . " XP" . TF::EOL . TF::EOL .
            TF::BOLD . TF::GREEN . "Level " . TF::RESET . TF::WHITE . "45:" . TF::EOL . TF::WHITE . "415,826" . TF::GRAY . " XP" . TF::EOL . TF::EOL .
            TF::BOLD . TF::GREEN . "Level " . TF::RESET . TF::WHITE . "50:" . TF::EOL . TF::WHITE . "743,138" . TF::GRAY . " XP" . TF::EOL . "Unlocks:" . TF::EOL . TF::EOL . TF::GOLD . "Gold Pickaxe" . TF::EOL . TF::EOL .
            TF::BOLD . TF::GREEN . "Level " . TF::RESET . TF::WHITE . "55:" . TF::EOL . TF::WHITE . "1,400,756" . TF::GRAY . " XP" . TF::EOL . TF::EOL .
            TF::BOLD . TF::GREEN . "Level " . TF::RESET . TF::WHITE . "60:" . TF::EOL . TF::WHITE . "2,376,187" . TF::GRAY . " XP" . TF::EOL . "Unlocks:" . TF::EOL . TF::EOL . TF::GOLD . "Iron Armour\nIron Sword\nIron Axe" . TF::EOL . TF::EOL .
            TF::BOLD . TF::GREEN . "Level " . TF::RESET . TF::WHITE . "65:" . TF::EOL . TF::WHITE . "3,948,878" . TF::GRAY . " XP" . TF::EOL . TF::EOL .
            TF::BOLD . TF::GREEN . "Level " . TF::RESET . TF::WHITE . "70:" . TF::EOL . TF::WHITE . "6,161,893" . TF::GRAY . " XP" . TF::EOL . "Unlocks:" . TF::EOL . TF::EOL . TF::GOLD . "Iron Pickaxe" . TF::EOL . TF::EOL .
            TF::BOLD . TF::GREEN . "Level " . TF::RESET . TF::WHITE . "75:" . TF::EOL . TF::WHITE . "9,466,940" . TF::GRAY . " XP" . TF::EOL . TF::EOL .
            TF::BOLD . TF::GREEN . "Level " . TF::RESET . TF::WHITE . "80:" . TF::EOL . TF::WHITE . "14,370,029" . TF::GRAY . " XP" . TF::EOL . TF::EOL .
            TF::BOLD . TF::GREEN . "Level " . TF::RESET . TF::WHITE . "85:" . TF::EOL . TF::WHITE . "20,519,704" . TF::GRAY . " XP" . TF::EOL . TF::EOL .
            TF::BOLD . TF::GREEN . "Level " . TF::RESET . TF::WHITE . "90:" . TF::EOL . TF::WHITE . "28,286,166" . TF::GRAY . " XP" . TF::EOL . "Unlocks:" . TF::EOL . TF::EOL . TF::GOLD . "Diamond Pickaxe" . TF::EOL . TF::EOL .
            TF::BOLD . TF::GREEN . "Level " . TF::RESET . TF::WHITE . "95:" . TF::EOL . TF::WHITE . "54,186,166" . TF::GRAY . " XP" . TF::EOL . TF::EOL .
            TF::BOLD . TF::GREEN . "Level " . TF::RESET . TF::WHITE . "100:" . TF::EOL . TF::WHITE . "118,686,166" . TF::GRAY . " XP" . TF::EOL . "Unlocks:" . TF::EOL . TF::EOL . TF::GOLD . "Diamond Armour\nDiamond Sword\nDiamond Axe" . TF::EOL . TF::EOL .
            TF::BOLD . TF::GREEN . "Level " . TF::RESET . TF::WHITE . "101:" . TF::EOL . TF::WHITE . "368,686,166" . TF::GRAY . " XP" . TF::EOL . TF::EOL .
            TF::BOLD . TF::GREEN . "Level " . TF::RESET . TF::WHITE . "102:" . TF::EOL . TF::WHITE . "2,368,686,166" . TF::GRAY . " XP" . TF::EOL . TF::EOL .
            TF::BOLD . TF::GREEN . "Level " . TF::RESET . TF::WHITE . "103:" . TF::EOL . TF::WHITE . "9,868,686,166" . TF::GRAY . " XP" . TF::EOL . TF::EOL .
            TF::BOLD . TF::GREEN . "Level " . TF::RESET . TF::WHITE . "104:" . TF::EOL . TF::WHITE . "24,933,628,891" . TF::GRAY . " XP" . TF::EOL . TF::EOL .
            TF::BOLD . TF::GREEN . "Level " . TF::RESET . TF::WHITE . "105:" . TF::EOL . TF::WHITE . "72,933,628,891" . TF::GRAY . " XP" . TF::EOL . TF::EOL .
            TF::BOLD . TF::GREEN . "Level " . TF::RESET . TF::WHITE . "106:" . TF::EOL . TF::WHITE . "172,933,628,891" . TF::GRAY . " XP" . TF::EOL . TF::EOL);
        $form->addButton("Back");
        $player->sendForm($form);
    }

    # help inventory sub menus
    public function Inventory(Player $player): void {

        $playerLevel = DataManager::getInstance()->getPlayerData($player->getXuid(),  "profile.level");
        $menu = InvMenu::create(InvMenuTypeIds::TYPE_DOUBLE_CHEST);
        $menu->setListener(InvMenu::readonly(function(DeterministicInvMenuTransaction $transaction) {}));
        $inventory = $menu->getInventory();

        $inventory->setItem(0, $this->level1($player));
        $inventory->setItem(1, $this->level10($player));
        $inventory->setItem(2, $this->level15($player));
        $inventory->setItem(3, $this->level20($player));
        $inventory->setItem(4, $this->level25($player));
        $inventory->setItem(5, $this->level30($player));
        $inventory->setItem(6, $this->level35($player));
        $inventory->setItem(7, $this->level40($player));
        $inventory->setItem(8, $this->level45($player));
        if($playerLevel >= 1) {
            $inventory->setItem(9, $this->unlocked());
        } else {
            $inventory->setItem(9, $this->locked());
        }
        if($playerLevel >= 10) {
            $inventory->setItem(10, $this->unlocked());
        } else {
            $inventory->setItem(10, $this->locked());
        }
        if($playerLevel >= 15) {
            $inventory->setItem(11, $this->unlocked());
        } else {
            $inventory->setItem(11, $this->locked());
        }
        if($playerLevel >= 20) {
            $inventory->setItem(12, $this->unlocked());
        } else {
            $inventory->setItem(12, $this->locked());
        }
        if($playerLevel >= 25) {
            $inventory->setItem(13, $this->unlocked());
        } else {
            $inventory->setItem(13, $this->locked());
        }
        if($playerLevel >= 30) {
            $inventory->setItem(14, $this->unlocked());
        } else {
            $inventory->setItem(14, $this->locked());
        }
        if($playerLevel >= 35) {
            $inventory->setItem(15, $this->unlocked());
        } else {
            $inventory->setItem(15, $this->locked());
        }
        if($playerLevel >= 40) {
            $inventory->setItem(16, $this->unlocked());
        } else {
            $inventory->setItem(16, $this->locked());
        }
        if($playerLevel >= 45) {
            $inventory->setItem(17, $this->unlocked());
        } else {
            $inventory->setItem(17, $this->locked());
        }
        $inventory->setItem(18, $this->level50($player));
        $inventory->setItem(19, $this->level55($player));
        $inventory->setItem(20, $this->level60($player));
        $inventory->setItem(21, $this->level65($player));
        $inventory->setItem(22, $this->level70($player));
        $inventory->setItem(23, $this->level75($player));
        $inventory->setItem(24, $this->level80($player));
        $inventory->setItem(25, $this->level85($player));
        $inventory->setItem(26, $this->level90($player));
        if($playerLevel >= 50) {
            $inventory->setItem(27, $this->unlocked());
        } else {
            $inventory->setItem(27, $this->locked());
        }
        if($playerLevel >= 55) {
            $inventory->setItem(28, $this->unlocked());
        } else {
            $inventory->setItem(28, $this->locked());
        }
        if($playerLevel >= 60) {
            $inventory->setItem(29, $this->unlocked());
        } else {
            $inventory->setItem(29, $this->locked());
        }
        if($playerLevel >= 65) {
            $inventory->setItem(30, $this->unlocked());
        } else {
            $inventory->setItem(30, $this->locked());
        }
        if($playerLevel >= 70) {
            $inventory->setItem(31, $this->unlocked());
        } else {
            $inventory->setItem(31, $this->locked());
        }
        if($playerLevel >= 75) {
            $inventory->setItem(32, $this->unlocked());
        } else {
            $inventory->setItem(32, $this->locked());
        }
        if($playerLevel >= 80) {
            $inventory->setItem(33, $this->unlocked());
        } else {
            $inventory->setItem(33, $this->locked());
        }
        if($playerLevel >= 85) {
            $inventory->setItem(34, $this->unlocked());
        } else {
            $inventory->setItem(34, $this->locked());
        }
        if($playerLevel >= 90) {
            $inventory->setItem(35, $this->unlocked());
        } else {
            $inventory->setItem(35, $this->locked());
        }
        $inventory->setItem(36, $this->level95($player));
        $inventory->setItem(37, $this->level100($player));
        $inventory->setItem(38, $this->level101($player));
        $inventory->setItem(39, $this->level102($player));
        $inventory->setItem(40, $this->level103($player));
        $inventory->setItem(41, $this->level104($player));
        $inventory->setItem(42, $this->level105($player));
        $inventory->setItem(43, $this->level106($player));
        if($playerLevel >= 95) {
            $inventory->setItem(45, $this->unlocked());
        } else {
            $inventory->setItem(45, $this->locked());
        }
        if($playerLevel >= 100) {
            $inventory->setItem(46, $this->unlocked());
        } else {
            $inventory->setItem(46, $this->locked());
        }
        if($playerLevel >= 101) {
            $inventory->setItem(47, $this->unlocked());
        } else {
            $inventory->setItem(47, $this->locked());
        }
        if($playerLevel >= 102) {
            $inventory->setItem(48, $this->unlocked());
        } else {
            $inventory->setItem(48, $this->locked());
        }
        if($playerLevel >= 103) {
            $inventory->setItem(49, $this->unlocked());
        } else {
            $inventory->setItem(49, $this->locked());
        }
        if($playerLevel >= 104) {
            $inventory->setItem(50, $this->unlocked());
        } else {
            $inventory->setItem(50, $this->locked());
        }
        if($playerLevel >= 105) {
            $inventory->setItem(51, $this->unlocked());
        } else {
            $inventory->setItem(51, $this->locked());
        }
        if($playerLevel >= 106) {
            $inventory->setItem(52, $this->unlocked());
        } else {
            $inventory->setItem(52, $this->locked());
        }

        $menu->send($player);
    }

    public function unlocked(): Item {
        $item = CustomiesItemFactory::getInstance()->get("customies:unlocked");
        $item->setCustomName("§aUnlocked");
        $item->setLore(["§r"]);
        $item->addEnchantment(GlowManager::$enchInst);
            return $item;
    }

    public function locked(): Item {
        $item = CustomiesItemFactory::getInstance()->get("customies:locked");
        $item->setCustomName("§cLocked");
        $item->setLore(["§r"]);
        $item->addEnchantment(GlowManager::$enchInst);
        return $item;
    }

    public function level1($player): Item {

        $playerLevel = DataManager::getInstance()->getPlayerData($player->getXuid(),  "profile.level");
        $item = VanillaItems::WOODEN_SWORD();
        $item->addEnchantment(GlowManager::$enchInst);

        if($playerLevel >= 1) {
            $status = TF::BOLD . TF::GREEN . "UNLOCKED";
        } else {
            $status = TF::BOLD . TF::RED . "LOCKED";
        }
        $item->setCustomName(TF::BOLD . TF::GREEN . "Level " . TF::WHITE . "1");
        $lore = [
            TF::GRAY . "(" . TF::WHITE . "0" . TF::GRAY . " XP)",
            "",
            "$status",
            "",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::GOLD . "Wooden Sword",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::GOLD . "Wooden Axe",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::GOLD . "Wooden Pickaxe",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::DARK_GRAY . "Coming soon...",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::DARK_GRAY . "Coming soon...",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::DARK_GRAY . "Coming soon...",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::DARK_GRAY . "Coming soon...",
            "",
            "$status - Kept with Prestige " . TF::BOLD . TF::LIGHT_PURPLE . "<" . TF::AQUA . "I" . TF::LIGHT_PURPLE . ">:",
            "",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::DARK_GRAY . "Coal mine warp"
        ];
        $item->setLore($lore);

        return $item;
    }

    public function level10($player): Item {

        $playerLevel = DataManager::getInstance()->getPlayerData($player->getXuid(),  "profile.level");
        $item = VanillaItems::CHAINMAIL_CHESTPLATE();
        $item->addEnchantment(GlowManager::$enchInst);

        if($playerLevel >= 10) {
            $status = TF::BOLD . TF::GREEN . "UNLOCKED";
        } else {
            $status = TF::BOLD . TF::RED . "LOCKED";
        }
        $item->setCustomName(TF::BOLD . TF::GREEN . "Level " . TF::WHITE . "10");
        $lore = [
            TF::GRAY . "(" . TF::WHITE . Translator::shortNumber(1220) . TF::GRAY . " XP)",
            "",
            "$status",
            "",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::GOLD . "Chain armour",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::GOLD . "Stone Axe",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::GOLD . "Stone Sword",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::AQUA . "+1 Quest" . TF::GRAY . "Coming soon",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::DARK_GRAY . "Coming soon...",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::DARK_GRAY . "Coming soon...",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::DARK_GRAY . "Coming soon...",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::DARK_GRAY . "Coming soon...",
            "",
            "$status - Kept with Prestige " . TF::BOLD . TF::LIGHT_PURPLE . "<" . TF::AQUA . "I" . TF::LIGHT_PURPLE . ">:",
            "",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::DARK_GRAY . "Iron mine warp"
        ];
        $item->setLore($lore);

        return $item;
    }

    public function level15($player): Item {

        $playerLevel = DataManager::getInstance()->getPlayerData($player->getXuid(),  "profile.level");
        $item = VanillaItems::PRISMARINE_SHARD();
        $item->addEnchantment(GlowManager::$enchInst);

        if($playerLevel >= 15) {
            $status = TF::BOLD . TF::GREEN . "UNLOCKED";
        } else {
            $status = TF::BOLD . TF::RED . "LOCKED";
        }
        $item->setCustomName(TF::BOLD . TF::GREEN . "Level " . TF::WHITE . "15");
        $lore = [
            TF::GRAY . "(" . TF::WHITE . Translator::shortNumber(3212) . TF::GRAY . " XP)",
            "",
            "$status",
            "",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::GREEN . "+4-8 Uncommon Shards " . TF::GRAY . "(One time reward)",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::GREEN . "Uncommon Contraband " . TF::GRAY . "(One time reward)",
        ];
        $item->setLore($lore);

        return $item;
    }

    public function level20($player): Item {

        $playerLevel = DataManager::getInstance()->getPlayerData($player->getXuid(),  "profile.level");
        $item = VanillaItems::WRITABLE_BOOK();
        $item->addEnchantment(GlowManager::$enchInst);

        if($playerLevel >= 20) {
            $status = TF::BOLD . TF::GREEN . "UNLOCKED";
        } else {
            $status = TF::BOLD . TF::RED . "LOCKED";
        }
        $item->setCustomName(TF::BOLD . TF::GREEN . "Level " . TF::WHITE . "20");
        $lore = [
            TF::GRAY . "(" . TF::WHITE . Translator::shortNumber(8989) . TF::GRAY . " XP)",
            "",
            "$status",
            "",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::GREEN . "+4-8 Uncommon Shards " . TF::GRAY . "(One time reward)",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::GREEN . "Uncommon Contraband " . TF::GRAY . "(One time reward)",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::GREEN . "Level 20 Enchantment bundle " . TF::GRAY . "(One time reward at Prestige 0)",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::DARK_GRAY . "Coming soon...",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::DARK_GRAY . "Coming soon..."
        ];
        $item->setLore($lore);

        return $item;
    }

    public function level25($player): Item {

        $playerLevel = DataManager::getInstance()->getPlayerData($player->getXuid(),  "profile.level");
        $item = VanillaItems::PRISMARINE_SHARD();
        $item->addEnchantment(GlowManager::$enchInst);

        if($playerLevel >= 25) {
            $status = TF::BOLD . TF::GREEN . "UNLOCKED";
        } else {
            $status = TF::BOLD . TF::RED . "LOCKED";
        }
        $item->setCustomName(TF::BOLD . TF::GREEN . "Level " . TF::WHITE . "25");
        $lore = [
            TF::GRAY . "(" . TF::WHITE . Translator::shortNumber(22371) . TF::GRAY . " XP)",
            "",
            "$status",
            "",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::GREEN . "+4-8 Uncommon Shards " . TF::GRAY . "(One time reward)",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::GREEN . "Uncommon Contraband " . TF::GRAY . "(One time reward)",
        ];
        $item->setLore($lore);

        return $item;
    }

    public function level30($player): Item {

        $playerLevel = DataManager::getInstance()->getPlayerData($player->getXuid(),  "profile.level");
        $item = VanillaItems::LAPIS_LAZULI();
        $item->addEnchantment(GlowManager::$enchInst);

        if($playerLevel >= 30) {
            $status = TF::BOLD . TF::GREEN . "UNLOCKED";
        } else {
            $status = TF::BOLD . TF::RED . "LOCKED";
        }
        $item->setCustomName(TF::BOLD . TF::GREEN . "Level " . TF::WHITE . "30");
        $lore = [
            TF::GRAY . "(" . TF::WHITE . Translator::shortNumber(52849) . TF::GRAY . " XP)",
            "",
            "$status",
            "",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::BLUE . "+16-32 Elite Shards " . TF::GRAY . "(One time reward)",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::BLUE . "Elite Contraband " . TF::GRAY . "(One time reward)",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::BLUE . "Lapis Ore ",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::GOLD . "Gold Armour ",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::GOLD . "Gold Axe ",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::GOLD . "Gold Sword ",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::DARK_GRAY . "Stone Pickaxe ",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::GREEN . "$65,000 Bank Investment Limit",
            "",
            "$status - Kept with Prestige " . TF::BOLD . TF::LIGHT_PURPLE . "<" . TF::AQUA . "I" . TF::LIGHT_PURPLE . ">:",
            "",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::DARK_GRAY . "Lapis mine warp"
        ];
        $item->setLore($lore);

        return $item;
    }

    public function level35($player): Item {

        $playerLevel = DataManager::getInstance()->getPlayerData($player->getXuid(),  "profile.level");
        $item = VanillaItems::PRISMARINE_SHARD();
        $item->addEnchantment(GlowManager::$enchInst);

        if($playerLevel >= 35) {
            $status = TF::BOLD . TF::GREEN . "UNLOCKED";
        } else {
            $status = TF::BOLD . TF::RED . "LOCKED";
        }
        $item->setCustomName(TF::BOLD . TF::GREEN . "Level " . TF::WHITE . "35");
        $lore = [
            TF::GRAY . "(" . TF::WHITE . Translator::shortNumber(112490) . TF::GRAY . " XP)",
            "",
            "$status",
            "",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::BLUE . "+16-32 Elite Shards " . TF::GRAY . "(One time reward)",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::BLUE . "Elite Contraband " . TF::GRAY . "(One time reward)",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::GREEN . "$140,000 Bank Investment Limit",
        ];
        $item->setLore($lore);

        return $item;
    }

    public function level40($player): Item {

        $playerLevel = DataManager::getInstance()->getPlayerData($player->getXuid(),  "profile.level");
        $item = VanillaItems::PAPER();
        $item->addEnchantment(GlowManager::$enchInst);

        if($playerLevel >= 40) {
            $status = TF::BOLD . TF::GREEN . "UNLOCKED";
        } else {
            $status = TF::BOLD . TF::RED . "LOCKED";
        }
        $item->setCustomName(TF::BOLD . TF::GREEN . "Level " . TF::WHITE . "40");
        $lore = [
            TF::GRAY . "(" . TF::WHITE . Translator::shortNumber(221961) . TF::GRAY . " XP)",
            "",
            "$status",
            "",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::BLUE . "+16-32 Elite Shards " . TF::GRAY . "(One time reward)",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::BLUE . "Elite Contraband " . TF::GRAY . "(One time reward)",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::BLUE . "Coming soon...",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::BLUE . "Coming soon.",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::GREEN . "$215,000 Bank Investment Limit",
        ];
        $item->setLore($lore);

        return $item;
    }

    public function level45($player): Item {

        $playerLevel = DataManager::getInstance()->getPlayerData($player->getXuid(),  "profile.level");
        $item = VanillaItems::PRISMARINE_SHARD();
        $item->addEnchantment(GlowManager::$enchInst);

        if($playerLevel >= 45) {
            $status = TF::BOLD . TF::GREEN . "UNLOCKED";
        } else {
            $status = TF::BOLD . TF::RED . "LOCKED";
        }
        $item->setCustomName(TF::BOLD . TF::GREEN . "Level " . TF::WHITE . "45");
        $lore = [
            TF::GRAY . "(" . TF::WHITE . Translator::shortNumber(415826) . TF::GRAY . " XP)",
            "",
            "$status",
            "",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::BLUE . "+16-32 Elite Shards " . TF::GRAY . "(One time reward)",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::BLUE . "Elite Contraband " . TF::GRAY . "(One time reward)",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::GREEN . "$290,000 Bank Investment Limit",
        ];
        $item->setLore($lore);

        return $item;
    }

    public function level50($player): Item {

        $playerLevel = DataManager::getInstance()->getPlayerData($player->getXuid(),  "profile.level");
        $item = VanillaItems::REDSTONE_DUST();
        $item->addEnchantment(GlowManager::$enchInst);

        if($playerLevel >= 50) {
            $status = TF::BOLD . TF::GREEN . "UNLOCKED";
        } else {
            $status = TF::BOLD . TF::RED . "LOCKED";
        }
        $item->setCustomName(TF::BOLD . TF::GREEN . "Level " . TF::WHITE . "50");
        $lore = [
            TF::GRAY . "(" . TF::WHITE . Translator::shortNumber(743138) . TF::GRAY . " XP)",
            "",
            "$status",
            "",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::YELLOW . "+16-32 Ultimate Shards " . TF::GRAY . "(One time reward)",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::YELLOW . "Ultimate Contraband " . TF::GRAY . "(One time reward)",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::GOLD . "Golden Pickaxe",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::GREEN . "$450,000 Bank Investment Limit",
            "",
            "$status - Kept with Prestige " . TF::BOLD . TF::LIGHT_PURPLE . "<" . TF::AQUA . "I" . TF::LIGHT_PURPLE . ">:",
            "",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::DARK_RED . "Redstone mine warp"
        ];
        $item->setLore($lore);

        return $item;
    }

    public function level55($player): Item {

        $playerLevel = DataManager::getInstance()->getPlayerData($player->getXuid(),  "profile.level");
        $item = VanillaItems::GOLD_INGOT();
        $item->addEnchantment(GlowManager::$enchInst);

        if($playerLevel >= 55) {
            $status = TF::BOLD . TF::GREEN . "UNLOCKED";
        } else {
            $status = TF::BOLD . TF::RED . "LOCKED";
        }
        $item->setCustomName(TF::BOLD . TF::GREEN . "Level " . TF::WHITE . "55");
        $lore = [
            TF::GRAY . "(" . TF::WHITE . Translator::shortNumber(1400756) . TF::GRAY . " XP)",
            "",
            "$status",
            "",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::YELLOW . "+16-32 Ultimate Shards " . TF::GRAY . "(One time reward)",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::YELLOW . "Ultimate Contraband " . TF::GRAY . "(One time reward)",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::GREEN . "$950,000 Bank Investment Limit",
        ];
        $item->setLore($lore);

        return $item;
    }

    public function level60($player): Item {

        $playerLevel = DataManager::getInstance()->getPlayerData($player->getXuid(),  "profile.level");
        $item = VanillaItems::REDSTONE_DUST();
        $item->addEnchantment(GlowManager::$enchInst);

        if($playerLevel >= 60) {
            $status = TF::BOLD . TF::GREEN . "UNLOCKED";
        } else {
            $status = TF::BOLD . TF::RED . "LOCKED";
        }
        $item->setCustomName(TF::BOLD . TF::GREEN . "Level " . TF::WHITE . "60");
        $lore = [
            TF::GRAY . "(" . TF::WHITE . Translator::shortNumber(2376187) . TF::GRAY . " XP)",
            "",
            "$status",
            "",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::YELLOW . "+32-64 Ultimate Shards " . TF::GRAY . "(One time reward)",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::YELLOW . "Ultimate Contraband " . TF::GRAY . "(One time reward)",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::GREEN . "$1,450,000 Bank Investment Limit",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::GRAY . "Iron Armour",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::GRAY . "Iron Axe",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::GRAY . "Iron Sword",
        ];
        $item->setLore($lore);

        return $item;
    }

    public function level65($player): Item {

        $playerLevel = DataManager::getInstance()->getPlayerData($player->getXuid(),  "profile.level");
        $item = VanillaItems::GOLD_INGOT();
        $item->addEnchantment(GlowManager::$enchInst);

        if($playerLevel >= 65) {
            $status = TF::BOLD . TF::GREEN . "UNLOCKED";
        } else {
            $status = TF::BOLD . TF::RED . "LOCKED";
        }
        $item->setCustomName(TF::BOLD . TF::GREEN . "Level " . TF::WHITE . "65");
        $lore = [
            TF::GRAY . "(" . TF::WHITE . Translator::shortNumber(3948878) . TF::GRAY . " XP)",
            "",
            "$status",
            "",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::YELLOW . "+32-64 Ultimate Shards " . TF::GRAY . "(One time reward)",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::YELLOW . "Ultimate Contraband " . TF::GRAY . "(One time reward)",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::GREEN . "$1,950,000 Bank Investment Limit",
        ];
        $item->setLore($lore);

        return $item;
    }

    public function level70($player): Item {

        $playerLevel = DataManager::getInstance()->getPlayerData($player->getXuid(),  "profile.level");
        $item = VanillaItems::ENDER_PEARL();
        $item->addEnchantment(GlowManager::$enchInst);

        if($playerLevel >= 70) {
            $status = TF::BOLD . TF::GREEN . "UNLOCKED";
        } else {
            $status = TF::BOLD . TF::RED . "LOCKED";
        }
        $item->setCustomName(TF::BOLD . TF::GREEN . "Level " . TF::WHITE . "70");
        $lore = [
            TF::GRAY . "(" . TF::WHITE . Translator::shortNumber(6161893) . TF::GRAY . " XP)",
            "",
            "$status",
            "",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::GOLD . "+32-64 Legendary Shards " . TF::GRAY . "(One time reward)",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::GOLD . "Legendary Contraband " . TF::GRAY . "(One time reward)",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::GREEN . "$2,700,000 Bank Investment Limit",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::DARK_GRAY . "Iron Pickaxe",
            "",
            "$status - Kept with Prestige " . TF::BOLD . TF::LIGHT_PURPLE . "<" . TF::AQUA . "I" . TF::LIGHT_PURPLE . ">:",
            "",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::GOLD . "Gold mine warp"
        ];
        $item->setLore($lore);

        return $item;
    }

    public function level75($player): Item {

        $playerLevel = DataManager::getInstance()->getPlayerData($player->getXuid(),  "profile.level");
        $item = VanillaItems::PRISMARINE_SHARD();
        $item->addEnchantment(GlowManager::$enchInst);

        if($playerLevel >= 75) {
            $status = TF::BOLD . TF::GREEN . "UNLOCKED";
        } else {
            $status = TF::BOLD . TF::RED . "LOCKED";
        }
        $item->setCustomName(TF::BOLD . TF::GREEN . "Level " . TF::WHITE . "75");
        $lore = [
            TF::GRAY . "(" . TF::WHITE . Translator::shortNumber(9466940) . TF::GRAY . " XP)",
            "",
            "$status",
            "",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::GOLD . "+32-64 Legendary Shards " . TF::GRAY . "(One time reward)",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::GOLD . "Legendary Contraband " . TF::GRAY . "(One time reward)",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::GREEN . "$2,700,000 Bank Investment Limit",
            "",
            "$status - Kept with Prestige " . TF::BOLD . TF::LIGHT_PURPLE . "<" . TF::AQUA . "I" . TF::LIGHT_PURPLE . ">:",
            "",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::GOLD . "Master Miners Shop"
        ];
        $item->setLore($lore);

        return $item;
    }

    public function level80($player): Item {

        $playerLevel = DataManager::getInstance()->getPlayerData($player->getXuid(),  "profile.level");
        $item = VanillaItems::GOLD_NUGGET();
        $item->addEnchantment(GlowManager::$enchInst);

        if($playerLevel >= 80) {
            $status = TF::BOLD . TF::GREEN . "UNLOCKED";
        } else {
            $status = TF::BOLD . TF::RED . "LOCKED";
        }
        $item->setCustomName(TF::BOLD . TF::GREEN . "Level " . TF::WHITE . "80");
        $lore = [
            TF::GRAY . "(" . TF::WHITE . Translator::shortNumber(14370029) . TF::GRAY . " XP)",
            "",
            "$status",
            "",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::GOLD . "+32-64 Legendary Shards " . TF::GRAY . "(One time reward)",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::GOLD . "Legendary Contraband " . TF::GRAY . "(One time reward)",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::GREEN . "$6,200,000 Bank Investment Limit",
            "",
            "$status - Kept with Prestige " . TF::BOLD . TF::LIGHT_PURPLE . "<" . TF::AQUA . "I" . TF::LIGHT_PURPLE . ">:",
            "",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::GOLD . "Master Miners Shop"
        ];
        $item->setLore($lore);

        return $item;
    }

    public function level85($player): Item {

        $playerLevel = DataManager::getInstance()->getPlayerData($player->getXuid(),  "profile.level");
        $item = VanillaItems::PRISMARINE_SHARD();
        $item->addEnchantment(GlowManager::$enchInst);

        if($playerLevel >= 85) {
            $status = TF::BOLD . TF::GREEN . "UNLOCKED";
        } else {
            $status = TF::BOLD . TF::RED . "LOCKED";
        }
        $item->setCustomName(TF::BOLD . TF::GREEN . "Level " . TF::WHITE . "85");
        $lore = [
            TF::GRAY . "(" . TF::WHITE . Translator::shortNumber(20519704) . TF::GRAY . " XP)",
            "",
            "$status",
            "",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::GOLD . "+32-64 Legendary Shards " . TF::GRAY . "(One time reward)",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::GOLD . "Legendary Contraband " . TF::GRAY . "(One time reward)",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::GREEN . "$7,950,000 Bank Investment Limit",
        ];
        $item->setLore($lore);

        return $item;
    }

    public function level90($player): Item {

        $playerLevel = DataManager::getInstance()->getPlayerData($player->getXuid(),  "profile.level");
        $item = VanillaItems::EXPERIENCE_BOTTLE();
        $item->addEnchantment(GlowManager::$enchInst);

        if($playerLevel >= 90) {
            $status = TF::BOLD . TF::GREEN . "UNLOCKED";
        } else {
            $status = TF::BOLD . TF::RED . "LOCKED";
        }
        $item->setCustomName(TF::BOLD . TF::GREEN . "Level " . TF::WHITE . "90");
        $lore = [
            TF::GRAY . "(" . TF::WHITE . Translator::shortNumber(28286166) . TF::GRAY . " XP)",
            "",
            "$status",
            "",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::RED . "+32-64 Godly Shards " . TF::GRAY . "(One time reward)",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::RED . "Godly Contraband " . TF::GRAY . "(One time reward)",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::GREEN . "$14,350,000 Bank Investment Limit",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::GOLD . "Legendary XP Bottles",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::AQUA . "Diamond Ore",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::AQUA . "Diamond Pickaxe",
            "",
            "$status - Kept with Prestige " . TF::BOLD . TF::LIGHT_PURPLE . "<" . TF::AQUA . "I" . TF::LIGHT_PURPLE . ">:",
            "",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::AQUA . "Diamond Mine Warp"
        ];
        $item->setLore($lore);

        return $item;
    }

    public function level95($player): Item {

        $playerLevel = DataManager::getInstance()->getPlayerData($player->getXuid(),  "profile.level");
        $item = VanillaItems::DIAMOND();
        $item->addEnchantment(GlowManager::$enchInst);

        if($playerLevel >= 95) {
            $status = TF::BOLD . TF::GREEN . "UNLOCKED";
        } else {
            $status = TF::BOLD . TF::RED . "LOCKED";
        }
        $item->setCustomName(TF::BOLD . TF::GREEN . "Level " . TF::WHITE . "95");
        $lore = [
            TF::GRAY . "(" . TF::WHITE . Translator::shortNumber(54186166) . TF::GRAY . " XP)",
            "",
            "$status",
            "",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::RED . "+32-64 Godly Shards " . TF::GRAY . "(One time reward)",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::RED . "Godly Contraband " . TF::GRAY . "(One time reward)",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::GREEN . "$39,350,000 Bank Investment Limit",
        ];
        $item->setLore($lore);

        return $item;
    }

    public function level100($player): Item {

        $playerLevel = DataManager::getInstance()->getPlayerData($player->getXuid(),  "profile.level");
        $item = VanillaItems::PRISMARINE_CRYSTALS();
        $item->addEnchantment(GlowManager::$enchInst);

        if($playerLevel >= 100) {
            $status = TF::BOLD . TF::GREEN . "UNLOCKED";
        } else {
            $status = TF::BOLD . TF::RED . "LOCKED";
        }
        $item->setCustomName(TF::BOLD . TF::GREEN . "Level " . TF::WHITE . "100");
        $lore = [
            TF::GRAY . "(" . TF::WHITE . Translator::shortNumber(118686166) . TF::GRAY . " XP)",
            "",
            "$status",
            "",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::RED . "+32-64 Godly Shards " . TF::GRAY . "(One time reward)",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::RED . "Godly Contraband " . TF::GRAY . "(One time reward)",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::GREEN . "$159,350,000 Bank Investment Limit",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::GREEN . "No withdraw Tax from Bank",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::AQUA . "Diamond Armour",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::AQUA . "Diamond Sword",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::AQUA . "Diamond Axe",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::DARK_AQUA . "Prismarine Ore",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::GREEN . "Emerald Ore",
            "",
            "$status - Kept with Prestige " . TF::BOLD . TF::LIGHT_PURPLE . "<" . TF::AQUA . "I" . TF::LIGHT_PURPLE . ">:",
            "",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::GRAY . "Executive Mine Warp",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::GRAY . "Emerald Mine Warp"
        ];
        $item->setLore($lore);

        return $item;
    }

    public function level101($player): Item {

        $playerLevel = DataManager::getInstance()->getPlayerData($player->getXuid(),  "profile.level");
        $item = VanillaItems::DRAGON_HEAD();
        $item->addEnchantment(GlowManager::$enchInst);

        if($playerLevel >= 101) {
            $status = TF::BOLD . TF::GREEN . "UNLOCKED";
        } else {
            $status = TF::BOLD . TF::RED . "LOCKED";
        }
        $item->setCustomName(TF::BOLD . TF::GREEN . "Level " . TF::WHITE . "101" . TF::EOL . TF::RED . "Prestige " . TF::LIGHT_PURPLE . "<" . TF::AQUA . "I" . TF::LIGHT_PURPLE . ">");
        $lore = [
            TF::GRAY . "(" . TF::WHITE . Translator::shortNumber(368686166) . TF::GRAY . " XP)",
            "",
            "$status",
            "",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::RED . "+32-64 Godly Shards " . TF::GRAY . "(One time reward)",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::RED . "Godly Contraband " . TF::GRAY . "(One time reward)",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::GREEN . "$909,350,000 Bank Investment Limit",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::GREEN . "Lootbox: Prestige " . TF::BOLD . TF::LIGHT_PURPLE . "<" . TF::AQUA . "I" . TF::LIGHT_PURPLE . ">",
            "",
            "$status - Kept with Prestige " . TF::BOLD . TF::LIGHT_PURPLE . "<" . TF::AQUA . "I" . TF::LIGHT_PURPLE . ">:",
            "",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::GRAY . "+1 /pv",
        ];
        $item->setLore($lore);

        return $item;
    }

    public function level102($player): Item {

        $playerLevel = DataManager::getInstance()->getPlayerData($player->getXuid(),  "profile.level");
        $item = VanillaItems::DRAGON_HEAD();
        $item->addEnchantment(GlowManager::$enchInst);

        if($playerLevel >= 102) {
            $status = TF::BOLD . TF::GREEN . "UNLOCKED";
        } else {
            $status = TF::BOLD . TF::RED . "LOCKED";
        }
        $item->setCustomName(TF::BOLD . TF::GREEN . "Level " . TF::WHITE . "102" . TF::EOL . TF::RED . "Prestige " . TF::LIGHT_PURPLE . "<" . TF::AQUA . "II" . TF::LIGHT_PURPLE . ">");
        $lore = [
            TF::GRAY . "(" . TF::WHITE . Translator::shortNumber(2368686166) . TF::GRAY . " XP)",
            "",
            "$status",
            "",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::RED . "+32-64 Godly Shards " . TF::GRAY . "(One time reward)",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::RED . "Godly Contraband " . TF::GRAY . "(One time reward)",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::GREEN . "$2,409,350,000 Bank Investment Limit",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::GREEN . "Lootbox: Prestige " . TF::BOLD . TF::LIGHT_PURPLE . "<" . TF::AQUA . "II" . TF::LIGHT_PURPLE . ">",
            "",
            "$status - Kept with Prestige " . TF::BOLD . TF::LIGHT_PURPLE . "<" . TF::AQUA . "I" . TF::LIGHT_PURPLE . ">:",
            "",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::GRAY . "+1 /pv",
        ];
        $item->setLore($lore);

        return $item;
    }

    public function level103($player): Item {

        $playerLevel = DataManager::getInstance()->getPlayerData($player->getXuid(),  "profile.level");
        $item = VanillaItems::DRAGON_HEAD();
        $item->addEnchantment(GlowManager::$enchInst);

        if($playerLevel >= 103) {
            $status = TF::BOLD . TF::GREEN . "UNLOCKED";
        } else {
            $status = TF::BOLD . TF::RED . "LOCKED";
        }
        $item->setCustomName(TF::BOLD . TF::GREEN . "Level " . TF::WHITE . "103" . TF::EOL . TF::RED . "Prestige " . TF::LIGHT_PURPLE . "<" . TF::AQUA . "III" . TF::LIGHT_PURPLE . ">");
        $lore = [
            TF::GRAY . "(" . TF::WHITE . Translator::shortNumber(9868686166) . TF::GRAY . " XP)",
            "",
            "$status",
            "",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::RED . "+32-64 Godly Shards " . TF::GRAY . "(One time reward)",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::RED . "Godly Contraband " . TF::GRAY . "(One time reward)",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::GREEN . "$2,409,350,000 Bank Investment Limit",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::GREEN . "Lootbox: Prestige " . TF::BOLD . TF::LIGHT_PURPLE . "<" . TF::AQUA . "III" . TF::LIGHT_PURPLE . ">",
            "",
            "$status - Kept with Prestige " . TF::BOLD . TF::LIGHT_PURPLE . "<" . TF::AQUA . "III" . TF::LIGHT_PURPLE . ">:",
            "",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::GRAY . "+1 /pv",
        ];
        $item->setLore($lore);

        return $item;
    }

    public function level104($player): Item {

        $playerLevel = DataManager::getInstance()->getPlayerData($player->getXuid(),  "profile.level");
        $item = VanillaItems::DRAGON_HEAD();
        $item->addEnchantment(GlowManager::$enchInst);

        if($playerLevel >= 104) {
            $status = TF::BOLD . TF::GREEN . "UNLOCKED";
        } else {
            $status = TF::BOLD . TF::RED . "LOCKED";
        }
        $item->setCustomName(TF::BOLD . TF::GREEN . "Level " . TF::WHITE . "104" . TF::EOL . TF::RED . "Prestige " . TF::LIGHT_PURPLE . "<" . TF::AQUA . "IV" . TF::LIGHT_PURPLE . ">");
        $lore = [
            TF::GRAY . "(" . TF::WHITE . Translator::shortNumber(24933628891) . TF::GRAY . " XP)",
            "",
            "$status",
            "",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::RED . "+32-64 Godly Shards " . TF::GRAY . "(One time reward)",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::RED . "Godly Contraband " . TF::GRAY . "(One time reward)",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::GREEN . "Lootbox: Prestige " . TF::BOLD . TF::LIGHT_PURPLE . "<" . TF::AQUA . "IV" . TF::LIGHT_PURPLE . ">",
            "",
            "$status - Kept with Prestige " . TF::BOLD . TF::LIGHT_PURPLE . "<" . TF::AQUA . "IV" . TF::LIGHT_PURPLE . ">:",
            "",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::GRAY . "+1 /pv",
        ];
        $item->setLore($lore);

        return $item;
    }

    public function level105($player): Item {

        $playerLevel = DataManager::getInstance()->getPlayerData($player->getXuid(),  "profile.level");
        $item = VanillaItems::DRAGON_HEAD();
        $item->addEnchantment(GlowManager::$enchInst);

        if($playerLevel >= 105) {
            $status = TF::BOLD . TF::GREEN . "UNLOCKED";
        } else {
            $status = TF::BOLD . TF::RED . "LOCKED";
        }
        $item->setCustomName(TF::BOLD . TF::GREEN . "Level " . TF::WHITE . "105" . TF::EOL . TF::RED . "Prestige " . TF::LIGHT_PURPLE . "<" . TF::AQUA . "V" . TF::LIGHT_PURPLE . ">");
        $lore = [
            TF::GRAY . "(" . TF::WHITE . Translator::shortNumber(72933628891) . TF::GRAY . " XP)",
            "",
            "$status",
            "",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::RED . "+32-64 Godly Shards " . TF::GRAY . "(One time reward)",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::RED . "Godly Contraband " . TF::GRAY . "(One time reward)",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::GREEN . "Lootbox: Prestige " . TF::BOLD . TF::LIGHT_PURPLE . "<" . TF::AQUA . "V" . TF::LIGHT_PURPLE . ">",
            "",
            "$status - Kept with Prestige " . TF::BOLD . TF::LIGHT_PURPLE . "<" . TF::AQUA . "V" . TF::LIGHT_PURPLE . ">:",
            "",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::GRAY . "+1 /pv",
        ];
        $item->setLore($lore);

        return $item;
    }

    public function level106($player): Item {

        $playerLevel = DataManager::getInstance()->getPlayerData($player->getXuid(),  "profile.level");
        $item = VanillaItems::DRAGON_HEAD();
        $item->addEnchantment(GlowManager::$enchInst);

        if($playerLevel >= 106) {
            $status = TF::BOLD . TF::GREEN . "UNLOCKED";
        } else {
            $status = TF::BOLD . TF::RED . "LOCKED";
        }
        $item->setCustomName(TF::BOLD . TF::GREEN . "Level " . TF::WHITE . "106" . TF::EOL . TF::RED . "Prestige " . TF::LIGHT_PURPLE . "<" . TF::AQUA . "VI" . TF::LIGHT_PURPLE . ">");
        $lore = [
            TF::GRAY . "(" . TF::WHITE . Translator::shortNumber(172933628891) . TF::GRAY . " XP)",
            "",
            "$status",
            "",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::RED . "+32-64 Godly Shards " . TF::GRAY . "(One time reward)",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::RED . "Godly Contraband " . TF::GRAY . "(One time reward)",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::GOLD . "Exotic XP Bottles",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::GREEN . "Lootbox: Prestige " . TF::BOLD . TF::LIGHT_PURPLE . "<" . TF::AQUA . "VI" . TF::LIGHT_PURPLE . ">",
            "",
            "$status - Kept with Prestige " . TF::BOLD . TF::LIGHT_PURPLE . "<" . TF::AQUA . "VI" . TF::LIGHT_PURPLE . ">:",
            "",
            TF::BOLD . TF::GREEN . " * " . TF::RESET . TF::GRAY . "+1 /pv",
        ];
        $item->setLore($lore);

        return $item;
    }

}