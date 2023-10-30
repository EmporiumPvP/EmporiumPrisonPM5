<?php

namespace Items;

use pocketmine\block\VanillaBlocks;
use pocketmine\item\Item;
use pocketmine\item\StringToItemParser;
use pocketmine\utils\TextFormat as TF;

class RankKits {

    public function noble(int $amount): Item {
        $item = VanillaBlocks::ENDER_CHEST()->asItem();
        $item->setCustomName(TF::BOLD . TF::DARK_GRAY . "Noble " . TF::RESET . TF::DARK_GRAY . "Rank Kit");
        $item->getNamedTag()->setByte("RankKitNoble", 1);
        $item->setCount($amount);

        $lore = [
            "",
            TF::RED . "This GKit Contains:",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::DARK_GRAY . "Noble " . TF::RESET . TF::DARK_GRAY . "Helmet",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::DARK_GRAY . "Noble " . TF::RESET . TF::DARK_GRAY . "Chestplate",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::DARK_GRAY . "Noble " . TF::RESET . TF::DARK_GRAY . "Leggings",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::DARK_GRAY . "Noble " . TF::RESET . TF::DARK_GRAY . "Boots",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::DARK_GRAY . "Noble " . TF::RESET . TF::DARK_GRAY . "Sword",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::WHITE . "1,000,000 " . TF::AQUA . "Energy",
            "",
            TF::GRAY . "(Right-click to Claim)"
        ];
        $item->setLore($lore);

        return $item;
    }

    public function imperial(int $amount): Item {
        $item = VanillaBlocks::ENDER_CHEST()->asItem();
        $item->setCustomName(TF::BOLD . TF::LIGHT_PURPLE . "Imperial " . TF::RESET . TF::LIGHT_PURPLE . "Rank Kit");
        $item->getNamedTag()->setByte("RankKitImperial", 1);
        $item->setCount($amount);

        $lore = [
            "",
            TF::RED . "This GKit Contains:",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::LIGHT_PURPLE . "Noble " . TF::RESET . TF::LIGHT_PURPLE . "Helmet",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::LIGHT_PURPLE . "Noble " . TF::RESET . TF::LIGHT_PURPLE . "Chestplate",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::LIGHT_PURPLE . "Noble " . TF::RESET . TF::LIGHT_PURPLE . "Leggings",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::LIGHT_PURPLE . "Noble " . TF::RESET . TF::LIGHT_PURPLE . "Boots",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::LIGHT_PURPLE . "Noble " . TF::RESET . TF::LIGHT_PURPLE . "Sword",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::AQUA . "Elite Dust",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::WHITE . "1,250,000 " . TF::AQUA . "Energy",
            "",
            TF::GRAY . "(Right-click to Claim)"
        ];
        $item->setLore($lore);

        return $item;
    }

    public function supreme(int $amount): Item {
        $item = VanillaBlocks::ENDER_CHEST()->asItem();
        $item->setCustomName(TF::BOLD . TF::DARK_AQUA . "Supreme " . TF::RESET . TF::DARK_AQUA . "Rank Kit");
        $item->getNamedTag()->setByte("RankKitSupreme", 1);
        $item->setCount($amount);

        $lore = [
            "",
            TF::RED . "This GKit Contains:",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::DARK_AQUA . "Supreme " . TF::RESET . TF::DARK_AQUA . "Helmet",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::DARK_AQUA . "Supreme " . TF::RESET . TF::DARK_AQUA . "Chestplate",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::DARK_AQUA . "Supreme " . TF::RESET . TF::DARK_AQUA . "Leggings",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::DARK_AQUA . "Supreme " . TF::RESET . TF::DARK_AQUA . "Boots",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::DARK_AQUA . "Supreme " . TF::RESET . TF::DARK_AQUA . "Sword",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::YELLOW . "Ultimate Dust",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::WHITE . "1,750,000 " . TF::AQUA . "Energy",
            "",
            TF::GRAY . "(Right-click to Claim)"
        ];
        $item->setLore($lore);

        return $item;
    }

    public function majesty(int $amount): Item {
        $item = VanillaBlocks::ENDER_CHEST()->asItem();
        $item->setCustomName(TF::BOLD . TF::BLUE . "Majesty " . TF::RESET . TF::BLUE . "Rank Kit");
        $item->getNamedTag()->setByte("RankKitMajesty", 1);
        $item->setCount($amount);

        $lore = [
            "",
            TF::RED . "This GKit Contains:",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::BLUE . "Noble " . TF::RESET . TF::BLUE . "Helmet",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::BLUE . "Noble " . TF::RESET . TF::BLUE . "Chestplate",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::BLUE . "Noble " . TF::RESET . TF::BLUE . "Leggings",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::BLUE . "Noble " . TF::RESET . TF::BLUE . "Boots",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::BLUE . "Noble " . TF::RESET . TF::BLUE . "Sword",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::GOLD . "Legendary Dust",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::WHITE . "2,000,000 " . TF::AQUA . "Energy",
            "",
            TF::GRAY . "(Right-click to Claim)"
        ];
        $item->setLore($lore);

        return $item;
    }

    public function emperor(int $amount): Item {
        $item = VanillaBlocks::ENDER_CHEST()->asItem();
        $item->setCustomName(TF::BOLD . TF::AQUA . "Emperor " . TF::RESET . TF::AQUA . "Rank Kit");
        $item->getNamedTag()->setByte("RankKitEmperor", 1);
        $item->setCount($amount);

        $lore = [
            "",
            TF::RED . "This GKit Contains:",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::AQUA . "Emperor " . TF::RESET . TF::AQUA . "Helmet",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::AQUA . "Emperor " . TF::RESET . TF::AQUA . "Chestplate",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::AQUA . "Emperor " . TF::RESET . TF::AQUA . "Leggings",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::AQUA . "Emperor " . TF::RESET . TF::AQUA . "Boots",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::AQUA . "Emperor " . TF::RESET . TF::AQUA . "Sword",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::GOLD . "Godly Dust",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::WHITE . "2,500,000 " . TF::AQUA . "Energy",
            "",
            TF::GRAY . "(Right-click to Claim)"
        ];
        $item->setLore($lore);

        return $item;
    }

    public function president(int $amount): Item {
        $item = VanillaBlocks::ENDER_CHEST()->asItem();
        $item->setCustomName(TF::BOLD . TF::RED . "President " . TF::RESET . TF::RED . "Rank Kit");
        $item->getNamedTag()->setByte("RankKitPresident", 1);
        $item->setCount($amount);

        $lore = [
            "",
            TF::RED . "This GKit Contains: " . TF::GRAY . "(" . TF::WHITE . "5 Random Items" . TF::GRAY . ")",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::RED . "President " . TF::RESET . TF::RED . "Helmet",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::RED . "President " . TF::RESET . TF::RED . "Chestplate",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::RED . "President " . TF::RESET . TF::RED . "Leggings",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::RED . "President " . TF::RESET . TF::RED . "Boots",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::RED . "President " . TF::RESET . TF::RED . "Sword",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::GOLD . "Godly Dust",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::AQUA . "Mystery Energy Orb",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::RED . "Mystery GKit Lootbox",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GREEN . "Mystery XP Booster",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::AQUA . "Mystery Energy Booster",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::LIGHT_PURPLE . "Mystery Meteor Flare",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::RED . "Heroic Meteor Flare",
            TF::BOLD . TF::GRAY . " * " . TF::BOLD . TF::WHITE . "White Scroll ",
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
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::BLUE . "Elite Contraband ",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::YELLOW . "Ultimate Contraband ",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::GOLD . "Legendary Contraband ",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::LIGHT_PURPLE . "Godly Contraband ",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::RED . "Heroic Contraband ",
            TF::BOLD . TF::GRAY . " * " . TF::RESET . TF::GRAY . "1x " . TF::BOLD . TF::RED . "Prestige Kit Lootbox ",
            "",
            TF::GRAY . "(Right-click to Claim)"
        ];
        $item->setLore($lore);

        return $item;
    }

}