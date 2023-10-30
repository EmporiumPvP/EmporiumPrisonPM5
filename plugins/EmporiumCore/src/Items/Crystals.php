<?php

namespace Items;

use pocketmine\item\Item;
use pocketmine\item\StringToItemParser;
use pocketmine\item\VanillaItems;
use pocketmine\utils\TextFormat as TF;

class Crystals {

    public function noble(): Item {
        $item = VanillaItems::NETHER_STAR();
        $item->setCustomName(TF::DARK_GRAY . "Noble Rank" . TF::LIGHT_PURPLE . " Crystal");
        $item->getNamedTag()->setByte("NobleCrystal", 1);

        $lore = [
            "",
            TF::GRAY . "Has a chance to give you " . TF::DARK_GRAY . "Noble Rank",
            "",
            TF::GRAY . "(Right-click to Use)"
        ];
        $item->setLore($lore);
        return $item;
    }

    public function nobleSuperior(): Item {
        $item = StringToItemParser::getInstance()->parse("nether_star");
        $item->setCustomName(TF::DARK_GRAY . "Noble Rank" . TF::YELLOW . " Superior Crystal");
        $item->getNamedTag()->setByte("NobleSuperiorCrystal", 1);

        $lore = [
            "",
            TF::GRAY . "Ranks you up to " . TF::DARK_GRAY . "Noble Rank",
            "",
            TF::GRAY . "(Right-click to Use)"
        ];
        $item->setLore($lore);
        return $item;
    }

    public function imperial(): Item {
        $item = StringToItemParser::getInstance()->parse("nether_star");
        $item->setCustomName(TF::LIGHT_PURPLE . "Imperial Rank" . TF::LIGHT_PURPLE . " Crystal");
        $item->getNamedTag()->setByte("ImperialCrystal", 1);

        $lore = [
            "",
            TF::GRAY . "Has a chance to give you " . TF::DARK_GRAY . "Noble Rank",
            "",
            TF::GRAY . "(Right-click to Use)"
        ];
        $item->setLore($lore);
        return $item;
    }

    public function imperialSuperior(): Item {
        $item = StringToItemParser::getInstance()->parse("nether_star");
        $item->setCustomName(TF::LIGHT_PURPLE . "Noble Rank" . TF::YELLOW . " Superior Crystal");
        $item->getNamedTag()->setByte("ImperialSuperiorCrystal", 1);

        $lore = [
            "",
            TF::GRAY . "Ranks you up to " . TF::LIGHT_PURPLE . "Imperial Rank",
            "",
            TF::GRAY . "(Right-click to Use)"
        ];
        $item->setLore($lore);
        return $item;
    }

    public function supreme(): Item {
        $item = StringToItemParser::getInstance()->parse("nether_star");
        $item->setCustomName(TF::DARK_AQUA . "Supreme Rank" . TF::LIGHT_PURPLE . " Crystal");
        $item->getNamedTag()->setByte("SupremeCrystal", 1);

        $lore = [
            "",
            TF::GRAY . "Has a chance to give you " . TF::DARK_AQUA . "Supreme Rank",
            "",
            TF::GRAY . "(Right-click to Use)"
        ];
        $item->setLore($lore);
        return $item;
    }

    public function supremeSuperior(): Item {
        $item = StringToItemParser::getInstance()->parse("nether_star");
        $item->setCustomName(TF::DARK_AQUA . "Supreme Rank" . TF::YELLOW . " Superior Crystal");
        $item->getNamedTag()->setByte("SupremeSuperiorCrystal", 1);

        $lore = [
            "",
            TF::GRAY . "Ranks you up to " . TF::BLUE . "Supreme Rank",
            "",
            TF::GRAY . "(Right-click to Use)"
        ];
        $item->setLore($lore);
        return $item;
    }

    public function majesty(): Item {
        $item = StringToItemParser::getInstance()->parse("nether_star");
        $item->setCustomName(TF::BLUE . "Majesty Rank" . TF::LIGHT_PURPLE . " Crystal");
        $item->getNamedTag()->setByte("MajestyCrystal", 1);

        $lore = [
            "",
            TF::GRAY . "Has a chance to give you " . TF::BLUE . "Majesty Rank",
            "",
            TF::GRAY . "(Right-click to Use)"
        ];
        $item->setLore($lore);
        return $item;
    }

    public function majestySuperior(): Item {
        $item = StringToItemParser::getInstance()->parse("nether_star");
        $item->setCustomName(TF::BLUE . "Majesty Rank" . TF::YELLOW . " Superior Crystal");
        $item->getNamedTag()->setByte("MajestySuperiorCrystal", 1);

        $lore = [
            "",
            TF::GRAY . "Ranks you up to " . TF::BLUE . "Majesty Rank",
            "",
            TF::GRAY . "(Right-click to Use)"
        ];
        $item->setLore($lore);
        return $item;
    }

    public function emperor(): Item {
        $item = StringToItemParser::getInstance()->parse("nether_star");
        $item->setCustomName(TF::AQUA . "Emperor Rank" . TF::LIGHT_PURPLE . " Crystal");
        $item->getNamedTag()->setByte("EmperorCrystal", 1);

        $lore = [
            "",
            TF::GRAY . "Has a chance to give you " . TF::AQUA . "Emperor Rank",
            "",
            TF::GRAY . "(Right-click to Use)"
        ];
        $item->setLore($lore);
        return $item;
    }

    public function emperorSuperior(): Item {
        $item = StringToItemParser::getInstance()->parse("nether_star");
        $item->setCustomName(TF::AQUA . "Emperor Rank" . TF::YELLOW . " Superior Crystal");
        $item->getNamedTag()->setByte("EmperorSuperiorCrystal", 1);

        $lore = [
            "",
            TF::GRAY . "Ranks you up to " . TF::AQUA . "Emperor Rank",
            "",
            TF::GRAY . "(Right-click to Use)"
        ];
        $item->setLore($lore);
        return $item;
    }

    public function president(): Item {
        $item = StringToItemParser::getInstance()->parse("nether_star");
        $item->setCustomName(TF::RED . "President Rank" . TF::LIGHT_PURPLE . " Crystal");
        $item->getNamedTag()->setByte("PresidentCrystal", 1);

        $lore = [
            "",
            TF::GRAY . "Has a chance to give you " . TF::RED . "President Rank",
            "",
            TF::GRAY . "(Right-click to Use)"
        ];
        $item->setLore($lore);
        return $item;
    }

    public function presidentSuperior(): Item {
        $item = StringToItemParser::getInstance()->parse("nether_star");
        $item->setCustomName(TF::RED . "President Rank" . TF::YELLOW . " Superior Crystal");
        $item->getNamedTag()->setByte("PresidentSuperiorCrystal", 1);

        $lore = [
            "",
            TF::GRAY . "Ranks you up to " . TF::RED . "President Rank",
            "",
            TF::GRAY . "(Right-click to Use)"
        ];
        $item->setLore($lore);
        return $item;
    }

}