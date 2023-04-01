<?php

namespace Items;

use pocketmine\item\Item;
use pocketmine\item\StringToItemParser;
use pocketmine\utils\TextFormat as TF;

class GKits {

    public function heroicVulkarion(int $amount): Item {
        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::BOLD . TF::DARK_RED . "Heroic Vulkarion " . TF::RESET . TF::DARK_RED . "GKit");
        $item->getNamedTag()->setByte("HeroicVulkarionGKit", 1);
        $item->setCount($amount);

        $lore = [
            "",
            TF::RED . "This GKit Contains:",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::DARK_RED . "Heroic Vulkarion " . TF::RESET . TF::DARK_RED . "Helmet",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::DARK_RED . "Heroic Vulkarion " . TF::RESET . TF::DARK_RED . "Chestplate",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::DARK_RED . "Heroic Vulkarion " . TF::RESET . TF::DARK_RED . "Leggings",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::DARK_RED . "Heroic Vulkarion " . TF::RESET . TF::DARK_RED . "Boots",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::DARK_RED . "Heroic Vulkarion " . TF::RESET . TF::DARK_RED . "Sword",
            "",
            TF::GRAY . "(Right-click to Claim)"
        ];
        $item->setLore($lore);

        return $item;
    }

    public function heroicZenith(int $amount): Item {
        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::BOLD . TF::GOLD . "Heroic Zenith " . TF::RESET . TF::GOLD . "GKit");
        $item->getNamedTag()->setByte("HeroicZenithGKit", 1);
        $item->setCount($amount);

        $lore = [
            "",
            TF::RED . "This GKit Contains:",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::GOLD . "Heroic Zenith " . TF::RESET . TF::GOLD . "Leggings",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::GOLD . "Heroic Zenith " . TF::RESET . TF::GOLD . "Pickaxe",
            "",
            TF::GRAY . "(Right-click to Claim)"
        ];
        $item->setLore($lore);

        return $item;
    }

    public function heroicColossus(int $amount): Item {
        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::BOLD . TF::WHITE . "Heroic Colossus " . TF::RESET . TF::WHITE . "GKit");
        $item->getNamedTag()->setByte("HeroicColossusGKit", 1);
        $item->setCount($amount);

        $lore = [
            "",
            TF::RED . "This GKit Contains:",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::WHITE . "Heroic Colossus " . TF::RESET . TF::WHITE . "Boots",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::WHITE . "Heroic Colossus " . TF::RESET . TF::WHITE . "Sword",
            "",
            TF::GRAY . "(Right-click to Claim)"
        ];
        $item->setLore($lore);

        return $item;
    }

    public function heroicWarlock(int $amount): Item {
        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::BOLD . TF::DARK_PURPLE . "Heroic Warlock " . TF::RESET . TF::DARK_PURPLE . "GKit");
        $item->getNamedTag()->setByte("HeroicWarlockGKit", 1);
        $item->setCount($amount);

        $lore = [
            "",
            TF::RED . "This GKit Contains:",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::BLUE . "Elite Enchantment ",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::YELLOW . "Ultimate Enchantment ",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::GOLD . "Legendary Enchantment ",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::LIGHT_PURPLE . "Godly Enchantment ",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::RED . "Heroic Enchantment ",
            TF::BOLD . TF::GRAY . " * " . TF::BOLD . TF::WHITE . "1,000,000 - 4,000,000" . TF::AQUA . " Energy",
            "",
            TF::GRAY . "(Right-click to Claim)"
        ];
        $item->setLore($lore);

        return $item;
    }

    public function heroicSlaughter(int $amount): Item {
        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::BOLD . TF::RED . "Heroic Slaughter " . TF::RESET . TF::DARK_PURPLE . "GKit");
        $item->getNamedTag()->setByte("HeroicSlaughterGKit", 1);
        $item->setCount($amount);

        $lore = [
            "",
            TF::RED . "This GKit Contains:",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::RED . "Heroic Slaughter " . TF::RESET . TF::RED . "Chestplate",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::RED . "Heroic Slaughter " . TF::RESET . TF::RED . "Axe",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::RED . "Heroic Slaughter " . TF::RESET . TF::RED . "Slaughter Lootbag",
            "",
            TF::GRAY . "(Right-click to Claim)"
        ];
        $item->setLore($lore);

        return $item;
    }

    public function heroicEnchanter(int $amount): Item {
        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::BOLD . TF::AQUA . "Heroic Enchanter " . TF::RESET . TF::DARK_PURPLE . "GKit");
        $item->getNamedTag()->setByte("HeroicEnchanterGKit", 1);
        $item->setCount($amount);

        $lore = [
            "",
            TF::RED . "This GKit Contains:",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::BLUE . "Elite Enchantment ",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::BLUE . "Elite Dust ",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::YELLOW . "Ultimate Enchantment ",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::YELLOW . "Ultimate Dust ",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::GOLD . "Legendary Enchantment ",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::GOLD . "Legendary Dust ",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::LIGHT_PURPLE . "Godly Enchantment ",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::LIGHT_PURPLE . "Godly Dust ",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::RED . "Heroic Enchantment ",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::RED . "Heroic Dust ",
            TF::BOLD . TF::GRAY . " * " . TF::BOLD . TF::WHITE . "1,000,000 - 4,000,000" . TF::AQUA . " Energy",
            TF::BOLD . TF::GRAY . " * " . TF::BOLD . TF::WHITE . "White Scroll ",
            "",
            TF::GRAY . "(Right-click to Claim)"
        ];
        $item->setLore($lore);

        return $item;
    }

    public function heroicAtheos(int $amount): Item {
        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::BOLD . TF::GRAY . "Heroic Atheos " . TF::RESET . TF::DARK_PURPLE . "GKit");
        $item->getNamedTag()->setByte("HeroicAtheosGKit", 1);
        $item->setCount($amount);

        $lore = [
            "",
            TF::RED . "This GKit Contains:",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::GRAY . "Heroic Atheos " . TF::RESET . TF::GRAY . "Helmet",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::GRAY . "Heroic Atheos " . TF::RESET . TF::GRAY . "Sword",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::GRAY . "Emporium Tokens ",
            "",
            TF::GRAY . "(Right-click to Claim)"
        ];
        $item->setLore($lore);

        return $item;
    }

    public function heroicIapetus(int $amount): Item {
        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::BOLD . TF::BLUE . "Heroic Iapetus " . TF::RESET . TF::DARK_PURPLE . "GKit");
        $item->getNamedTag()->setByte("HeroicIapetusGKit", 1);
        $item->setCount($amount);

        $lore = [
            "",
            TF::RED . "This GKit Contains:",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::BLUE . "Heroic Iapetus " . TF::RESET . TF::BLUE . "Axe",
            TF::BOLD . TF::GRAY . " * " . TF::BOLD . TF::WHITE . "1,000,000 - 4,000,000" . TF::AQUA . " Energy",
            TF::BOLD . TF::GRAY . " * " . TF::BOLD . TF::WHITE . "White Scroll ",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "2x " . TF::BOLD . TF::BLUE . "Elite Dust ",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "2x " . TF::BOLD . TF::YELLOW . "Ultimate Dust ",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "2x " . TF::BOLD . TF::GOLD . "Legendary Dust ",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "2x " . TF::BOLD . TF::LIGHT_PURPLE . "Godly Dust ",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "2x " . TF::BOLD . TF::RED . "Heroic Dust ",
            "",
            TF::GRAY . "(Right-click to Claim)"
        ];
        $item->setLore($lore);

        return $item;
    }

    public function heroicBroteas(int $amount): Item {
        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::BOLD . TF::GREEN . "Heroic Broteas " . TF::RESET . TF::DARK_PURPLE . "GKit");
        $item->getNamedTag()->setByte("HeroicBroteasGKit", 1);
        $item->setCount($amount);

        $lore = [
            "",
            TF::RED . "This GKit Contains:",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::GREEN . "Heroic Broteas " . TF::RESET . TF::GREEN . "Axe",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::GREEN . "Heroic Broteas " . TF::RESET . TF::GREEN . "Pickaxe",
            TF::BOLD . TF::GRAY . " * " . TF::BOLD . TF::WHITE . "1,000,000 - 4,000,000" . TF::AQUA . " Energy",
            "",
            TF::GRAY . "(Right-click to Claim)"
        ];
        $item->setLore($lore);

        return $item;
    }

    public function heroicAres(int $amount): Item {
        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::BOLD . TF::GOLD . "Heroic Ares " . TF::RESET . TF::GOLD . "GKit");
        $item->getNamedTag()->setByte("HeroicAresGKit", 1);
        $item->setCount($amount);

        $lore = [
            "",
            TF::RED . "This GKit Contains:",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::GOLD . "Heroic Ares " . TF::RESET . TF::GOLD . "Helmet",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::GOLD . "Heroic Ares " . TF::RESET . TF::GOLD . "Chestplate",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::GOLD . "Heroic Ares " . TF::RESET . TF::GOLD . "Leggings",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::GOLD . "Heroic Ares " . TF::RESET . TF::GOLD . "Boots",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::GOLD . "Heroic Ares " . TF::RESET . TF::GOLD . "Sword",
            "",
            TF::GRAY . "(Right-click to Claim)"
        ];
        $item->setLore($lore);

        return $item;
    }

    public function heroicGrimReaper(int $amount): Item {
        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::BOLD . TF::RED . "Heroic Grim Reaper " . TF::RESET . TF::GOLD . "GKit");
        $item->getNamedTag()->setByte("HeroicGrimReaperGKit", 1);
        $item->setCount($amount);

        $lore = [
            "",
            TF::RED . "This GKit Contains:",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::RED . "Heroic Grim Reaper " . TF::RESET . TF::RED . "Helmet",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::RED . "Heroic Grim Reaper " . TF::RESET . TF::RED . "Chestplate",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::RED . "Heroic Grim Reaper " . TF::RESET . TF::RED . "Leggings",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::RED . "Heroic Grim Reaper " . TF::RESET . TF::RED . "Boots",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::RED . "Heroic Grim Reaper " . TF::RESET . TF::RED . "Sword",
            "",
            TF::GRAY . "(Right-click to Claim)"
        ];
        $item->setLore($lore);

        return $item;
    }

    public function heroicExecutioner(int $amount): Item {
        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::BOLD . TF::DARK_RED . "Heroic Executioner " . TF::RESET . TF::GOLD . "GKit");
        $item->getNamedTag()->setByte("HeroicExecutionerGKit", 1);
        $item->setCount($amount);

        $lore = [
            "",
            TF::RED . "This GKit Contains:",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::DARK_RED . "Heroic Executioner " . TF::RESET . TF::DARK_RED . "Helmet",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::DARK_RED . "Heroic Executioner " . TF::RESET . TF::DARK_RED . "Chestplate",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::DARK_RED . "Heroic Executioner " . TF::RESET . TF::DARK_RED . "Leggings",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::DARK_RED . "Heroic Executioner " . TF::RESET . TF::DARK_RED . "Boots",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::DARK_RED . "Heroic Executioner " . TF::RESET . TF::DARK_RED . "Sword",
            "",
            TF::GRAY . "(Right-click to Claim)"
        ];
        $item->setLore($lore);

        return $item;
    }

    public function Blacksmith(int $amount): Item {
        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::BOLD . TF::DARK_GRAY . "Blacksmith " . TF::RESET . TF::DARK_GRAY . "GKit");
        $item->getNamedTag()->setByte("BlacksmithGKit", 1);
        $item->setCount($amount);

        $lore = [
            "",
            TF::RED . "This GKit Contains:",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "2x " . TF::BOLD . TF::BLUE . "Elite Enchantment ",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "2x " . TF::BOLD . TF::YELLOW . "Ultimate Enchantment ",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "2x " . TF::BOLD . TF::GOLD . "Legendary Enchantment ",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "2x " . TF::BOLD . TF::LIGHT_PURPLE . "Godly Enchantment ",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "2x " . TF::BOLD . TF::RED . "Heroic Enchantment ",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "2x " . TF::BOLD . TF::BLUE . "Elite Enchantment Dust",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "2x " . TF::BOLD . TF::YELLOW . "Ultimate Enchantment Dust",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "2x " . TF::BOLD . TF::GOLD . "Legendary Enchantment Dust",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "2x " . TF::BOLD . TF::LIGHT_PURPLE . "Godly Enchantment Dust",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "2x " . TF::BOLD . TF::RED . "Heroic Enchantment Dust",
            TF::BOLD . TF::GRAY . " * " . TF::BOLD . TF::WHITE . "1,000,000 - 4,000,000" . TF::AQUA . " Energy",
            TF::BOLD . TF::GRAY . " * " . TF::BOLD . TF::WHITE . "White Scroll ",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::DARK_GRAY . "Blacksmith " . TF::RESET . TF::DARK_GRAY . "Boots",
            "",
            TF::GRAY . "(Right-click to Claim)"
        ];
        $item->setLore($lore);

        return $item;
    }

    public function Hero(int $amount): Item {
        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::BOLD . TF::WHITE . "Hero " . TF::RESET . TF::WHITE . "GKit");
        $item->getNamedTag()->setByte("HeroGKit", 1);
        $item->setCount($amount);

        $lore = [
            "",
            TF::RED . "This GKit Contains:",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::WHITE . "Hero " . TF::RESET . TF::WHITE . "Helmet",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::WHITE . "Hero " . TF::RESET . TF::WHITE . "Chestplate",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::WHITE . "Hero " . TF::RESET . TF::WHITE . "Leggings",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::WHITE . "Hero " . TF::RESET . TF::WHITE . "Boots",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::WHITE . "Hero " . TF::RESET . TF::WHITE . "Sword",
            "",
            TF::GRAY . "(Right-click to Claim)"
        ];
        $item->setLore($lore);

        return $item;
    }

    public function Cyborg(int $amount): Item {
        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::BOLD . TF::DARK_AQUA . "Cyborg " . TF::RESET . TF::DARK_AQUA . "GKit");
        $item->getNamedTag()->setByte("CyborgGKit", 1);
        $item->setCount($amount);

        $lore = [
            "",
            TF::RED . "This GKit Contains:",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::DARK_AQUA . "Cybernetic " . TF::RESET . TF::DARK_AQUA . "Helmet",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::DARK_AQUA . "Cybernetic " . TF::RESET . TF::DARK_AQUA . "Chestplate",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::DARK_AQUA . "Cybernetic " . TF::RESET . TF::DARK_AQUA . "Leggings",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::DARK_AQUA . "Cybernetic " . TF::RESET . TF::DARK_AQUA . "Boots",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::DARK_AQUA . "Cybernetic " . TF::RESET . TF::DARK_AQUA . "Sword",
            "",
            TF::GRAY . "(Right-click to Claim)"
        ];
        $item->setLore($lore);

        return $item;
    }

    public function Crucible(int $amount): Item {
        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::BOLD . TF::YELLOW . "Crucible " . TF::RESET . TF::YELLOW . "GKit");
        $item->getNamedTag()->setByte("CyborgGKit", 1);
        $item->setCount($amount);

        $lore = [
            "",
            TF::RED . "This GKit Contains:",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::YELLOW . "Crucible " . TF::RESET . TF::YELLOW . "Chestplate",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::YELLOW . "Crucible " . TF::RESET . TF::YELLOW . "Leggings",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::YELLOW . "Crucible " . TF::RESET . TF::YELLOW . "Pickaxe",
            TF::BOLD . TF::GRAY . " * " . TF::BOLD . TF::WHITE . "500,000 - 2,000,000" . TF::AQUA . " Energy",
            "",
            TF::GRAY . "(Right-click to Claim)"
        ];
        $item->setLore($lore);

        return $item;
    }

    public function Hunter(int $amount): Item {
        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::BOLD . TF::AQUA . "Hunter " . TF::RESET . TF::AQUA . "GKit");
        $item->getNamedTag()->setByte("HunterGKit", 1);
        $item->setCount($amount);

        $lore = [
            "",
            TF::RED . "This GKit Contains:",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::AQUA . "Hunter " . TF::RESET . TF::AQUA . "Helmet",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::AQUA . "Hunter " . TF::RESET . TF::AQUA . "Chestplate",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::AQUA . "Hunter " . TF::RESET . TF::AQUA . "Leggings",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::AQUA . "Hunter " . TF::RESET . TF::AQUA . "Boots",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::AQUA . "Hunter " . TF::RESET . TF::AQUA . "Sword",
            "",
            TF::GRAY . "(Right-click to Claim)"
        ];
        $item->setLore($lore);

        return $item;
    }

}