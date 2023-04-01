<?php

namespace Emporium\Prison\items;

use Emporium\Prison\Managers\misc\GlowManager;
use pocketmine\item\Item;
use pocketmine\item\StringToItemParser;
use pocketmine\utils\TextFormat as TF;

class Contraband {

    public function Elite(int $amount): Item {
        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCount($amount);
        $item->setCustomName(TF::BOLD . TF::BLUE . "Elite Contraband");
        $lore = [
            "",
            TF::GRAY . "A stash of mystery contraband",
            TF::GRAY . "smuggled in by Prisoners!",
            "",
            TF::BOLD . TF::GRAY . "Contains " . TF::UNDERLINE . TF::BLUE . "3 Elite Rarity " . TF::RESET . TF::GRAY . "items...",
            TF::BOLD . TF::GOLD . "* " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::WHITE . "250,000 " . TF::AQUA . "Energy",
            TF::BOLD . TF::GOLD . "* " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::WHITE . "100,000 " . TF::AQUA . "Energy",
            TF::BOLD . TF::GOLD . "* " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::WHITE . "50,000 " . TF::AQUA . "Energy",
            TF::BOLD . TF::GOLD . "* " . TF::RESET . TF::GRAY . "2x " . TF::BOLD . TF::GOLD . "Mystery Elite Enchant",
            TF::BOLD . TF::GOLD . "* " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::WHITE . "Rank: " . TF::WHITE . "<" . TF::LIGHT_PURPLE . "Imperial" . TF::WHITE . ">",
            TF::BOLD . TF::GOLD . "* " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::WHITE . "Rank Kit: " . TF::WHITE . "<" . TF::LIGHT_PURPLE . "Imperial" . TF::WHITE . ">",
            TF::BOLD . TF::GOLD . "* " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::GOLD . "Mystery Elite GKit",
            TF::BOLD . TF::GOLD . "* " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . "$250,000 - $500,000",
            "",
            TF::GRAY . "Right-click to open"

        ];
        $item->setLore($lore);
        $item->getNamedTag()->setByte("EliteContraband", 1);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    public function Ultimate(int $amount): Item {
        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCount($amount);
        $item->setCustomName(TF::BOLD . TF::YELLOW . "Ultimate Contraband");
        $lore = [
            "",
            TF::GRAY . "A stash of mystery contraband",
            TF::GRAY . "smuggled in by Prisoners!",
            "",
            TF::GRAY . "Contains " . TF::UNDERLINE . TF::YELLOW . "3 Ultimate Rarity " . TF::RESET . TF::GRAY . "items...",
            TF::BOLD . TF::GOLD . "* " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::WHITE . "750,000 " . TF::AQUA . "Energy",
            TF::BOLD . TF::GOLD . "* " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::WHITE . "500,000 " . TF::AQUA . "Energy",
            TF::BOLD . TF::GOLD . "* " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::WHITE . "250,000 " . TF::AQUA . "Energy",
            TF::BOLD . TF::GOLD . "* " . TF::RESET . TF::GRAY . "2x " . TF::BOLD . TF::GOLD . "Mystery Ultimate Enchant",
            TF::BOLD . TF::GOLD . "* " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::WHITE . "Rank: " . TF::WHITE . "<" . TF::GREEN . "Supreme" . TF::WHITE . ">",
            TF::BOLD . TF::GOLD . "* " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::WHITE . "Rank Kit: " . TF::WHITE . "<" . TF::GREEN . "Supreme" . TF::WHITE . ">",
            TF::BOLD . TF::GOLD . "* " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::GOLD . "Mystery Ultimate GKit",
            TF::BOLD . TF::GOLD . "* " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . "$500,000 - $1,000,000",
            "",
            TF::GRAY . "Right-click to open"
        ];
        $item->setLore($lore);
        $item->getNamedTag()->setByte("UltimateContraband", 1);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    public function Legendary(int $amount): Item {
        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCount($amount);
        $item->setCustomName(TF::BOLD . TF::GOLD . "Legendary Contraband");
        $lore = [
            "",
            TF::GRAY . "A stash of mystery contraband",
            TF::GRAY . "smuggled in by Prisoners!",
            "",
            TF::GRAY . "Contains " . TF::UNDERLINE . TF::GOLD . "3 Legendary Rarity " . TF::RESET . TF::GRAY . "items...",
            TF::BOLD . TF::GOLD . "* " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::WHITE . "1,250,000 " . TF::AQUA . "Energy",
            TF::BOLD . TF::GOLD . "* " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::WHITE . "1,000,000 " . TF::AQUA . "Energy",
            TF::BOLD . TF::GOLD . "* " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::WHITE . "750,000 " . TF::AQUA . "Energy",
            TF::BOLD . TF::GOLD . "* " . TF::RESET . TF::GRAY . "2x " . TF::BOLD . TF::GOLD . "Mystery Legendary Enchant",
            TF::BOLD . TF::GOLD . "* " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::WHITE . "Rank: " . TF::WHITE . "<" . TF::BLUE . "Majesty" . TF::WHITE . ">",
            TF::BOLD . TF::GOLD . "* " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::WHITE . "Rank Kit: " . TF::WHITE . "<" . TF::BLUE . "Majesty" . TF::WHITE . ">",
            TF::BOLD . TF::GOLD . "* " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::GOLD . "Mystery Legendary GKit",
            TF::BOLD . TF::GOLD . "* " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . "$1,000,000 - $2,000,000",
            "",
            TF::GRAY . "Right-click to open"
        ];
        $item->setLore($lore);
        $item->getNamedTag()->setByte("LegendaryContraband", 1);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    public function Godly(int $amount): Item {
        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCount($amount);
        $item->setCustomName(TF::BOLD . TF::LIGHT_PURPLE . "Godly Contraband");
        $lore = [
            "",
            TF::GRAY . "A stash of mystery contraband",
            TF::GRAY . "smuggled in by Prisoners!",
            "",
            TF::GRAY . "Contains " . TF::UNDERLINE . TF::RED . "3 Heroic Rarity " . TF::RESET . TF::GRAY . "items...",
            TF::BOLD . TF::GOLD . "* " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::WHITE . "1,750,000 " . TF::AQUA . "Energy",
            TF::BOLD . TF::GOLD . "* " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::WHITE . "1,500,000 " . TF::AQUA . "Energy",
            TF::BOLD . TF::GOLD . "* " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::WHITE . "1,250,000 " . TF::AQUA . "Energy",
            TF::BOLD . TF::GOLD . "* " . TF::RESET . TF::GRAY . "2x " . TF::BOLD . TF::GOLD . "Mystery Godly Enchant",
            TF::BOLD . TF::GOLD . "* " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::WHITE . "Rank: " . TF::WHITE . "<" . TF::AQUA . "Emperor" . TF::WHITE . ">",
            TF::BOLD . TF::GOLD . "* " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::WHITE . "Rank Kit: " . TF::WHITE . "<" . TF::AQUA . "Emperor" . TF::WHITE . ">",
            TF::BOLD . TF::GOLD . "* " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::GOLD . "Mystery Godly GKit",
            TF::BOLD . TF::GOLD . "* " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . "$2,000,000 - $4,000,000",
            "",
            TF::GRAY . "Right-click to open"
        ];
        $item->setLore($lore);
        $item->getNamedTag()->setByte("GodlyContraband", 1);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    public function Heroic(int $amount): Item {
        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCount($amount);
        $item->setCustomName(TF::BOLD . TF::RED . "Heroic Contraband");
        $lore = [
            "",
            TF::GRAY . "A stash of mystery contraband",
            TF::GRAY . "smuggled in by Prisoners!",
            "",
            TF::GRAY . "Contains " . TF::UNDERLINE . TF::LIGHT_PURPLE . "3 Godly Rarity " . TF::RESET . TF::GRAY . "items...",
            TF::BOLD . TF::GOLD . "* " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::WHITE . "2,250,000 " . TF::AQUA . "Energy",
            TF::BOLD . TF::GOLD . "* " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::WHITE . "2,000,000 " . TF::AQUA . "Energy",
            TF::BOLD . TF::GOLD . "* " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::WHITE . "1,750,000 " . TF::AQUA . "Energy",
            TF::BOLD . TF::GOLD . "* " . TF::RESET . TF::GRAY . "2x " . TF::BOLD . TF::GOLD . "Mystery Heroic Enchant",
            TF::BOLD . TF::GOLD . "* " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::WHITE . "Rank: " . TF::WHITE . "<" . TF::RED . "President" . TF::WHITE . ">",
            TF::BOLD . TF::GOLD . "* " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::WHITE . "Rank Kit: " . TF::WHITE . "<" . TF::RED . "President" . TF::WHITE . ">",
            TF::BOLD . TF::GOLD . "* " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::GOLD . "Mystery Rank Kit",
            TF::BOLD . TF::GOLD . "* " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . "$4,000,000 - $6,000,000",
            "",
            TF::GRAY . "Right-click to open"
        ];
        $item->setLore($lore);
        $item->getNamedTag()->setByte("HeroicContraband", 1);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

}