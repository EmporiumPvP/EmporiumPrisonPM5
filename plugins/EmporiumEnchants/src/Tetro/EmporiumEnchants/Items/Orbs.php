<?php

namespace Tetro\EmporiumEnchants\Items;

use pocketmine\item\Item;
use pocketmine\item\VanillaItems;
use pocketmine\utils\TextFormat as TF;

class Orbs {

    public function Elite($amount): Item {
        $item = VanillaItems::BLUE_DYE();
        $item->setCustomName(TF::BOLD . TF::BLUE . "Elite " . TF::WHITE . "Orb");
        $item->setCount($amount);
        $item->getNamedTag()->setString("ElitePickaxeEnchantOrb", "elite");
        $item->getNamedTag()->setString("Rarity", "elite");
        $lore = [
            TF::RESET . TF::GRAY . "Examine this Orb to receive a random",
            TF::RESET . TF::BLUE . "Elite " . TF::GRAY . "enchantment orb.",
            TF::RESET . TF::DARK_GRAY . " * " . TF::GRAY . "Right-click to examine this orb.",
            TF::RESET . TF::DARK_GRAY . " * " . TF::GRAY . "Tier: " . TF::GREEN . "I"
        ];
        $item->setLore($lore);
        return $item;
    }

    public function Ultimate($amount): Item {
        $item = VanillaItems::YELLOW_DYE();
        $item->setCustomName(TF::BOLD . TF::YELLOW . "Ultimate " . TF::WHITE . "Orb");
        $item->setCount($amount);
        $item->getNamedTag()->setString("UltimatePickaxeEnchantOrb", "ultimate");
        $item->getNamedTag()->setString("Rarity", "ultimate");
        $lore = [
            TF::RESET . TF::GRAY . "Examine this Orb to receive a random",
            TF::RESET . TF::BLUE . "Elite " . TF::GRAY . "enchantment orb.",
            TF::RESET . TF::DARK_GRAY . " * " . TF::GRAY . "Right-click to examine this orb.",
            TF::RESET . TF::DARK_GRAY . " * " . TF::GRAY . "Tier: " . TF::GREEN . "II"
        ];
        $item->setLore($lore);
        return $item;
    }

    public function Legendary($amount): Item {
        $item = VanillaItems::ORANGE_DYE();
        $item->setCustomName(TF::BOLD . TF::GOLD . "Legendary " . TF::WHITE . "Orb");
        $item->setCount($amount);
        $item->getNamedTag()->setString("LegendaryPickaxeEnchantOrb", "legendary");
        $item->getNamedTag()->setString("Rarity", "legendary");
        $lore = [
            TF::RESET . TF::GRAY . "Examine this Orb to receive a random",
            TF::RESET . TF::BLUE . "Elite " . TF::GRAY . "enchantment orb.",
            TF::RESET . TF::DARK_GRAY . " * " . TF::GRAY . "Right-click to examine this orb.",
            TF::RESET . TF::DARK_GRAY . " * " . TF::GRAY . "Tier: " . TF::GREEN . "III"
        ];
        $item->setLore($lore);
        return $item;
    }

    public function Godly($amount): Item {
        $item = VanillaItems::PINK_DYE();
        $item->setCustomName(TF::BOLD . TF::LIGHT_PURPLE . "Godly " . TF::WHITE . "Orb");
        $item->setCount($amount);
        $item->getNamedTag()->setString("GodlyPickaxeEnchantOrb", "godly");
        $item->getNamedTag()->setString("Rarity", "godly");
        $lore = [
            TF::RESET . TF::GRAY . "Examine this Orb to receive a random",
            TF::RESET . TF::BLUE . "Elite " . TF::GRAY . "enchantment orb.",
            TF::RESET . TF::DARK_GRAY . " * " . TF::GRAY . "Right-click to examine this orb.",
            TF::RESET . TF::DARK_GRAY . " * " . TF::GRAY . "Tier: " . TF::GREEN . "IV"
        ];
        $item->setLore($lore);
        return $item;
    }

    public function Heroic($amount): Item {
        $item = VanillaItems::RED_DYE();
        $item->setCustomName(TF::BOLD . TF::RED . "Heroic " . TF::WHITE . "Orb");
        $item->setCount($amount);
        $item->getNamedTag()->setString("HeroicPickaxeEnchantOrb", "heroic");
        $item->getNamedTag()->setString("Rarity", "heroic");
        $lore = [
            TF::RESET . TF::GRAY . "Examine this Orb to receive a random",
            TF::RESET . TF::BLUE . "Elite " . TF::GRAY . "enchantment orb.",
            TF::RESET . TF::DARK_GRAY . " * " . TF::GRAY . "Right-click to examine this orb.",
            TF::RESET . TF::DARK_GRAY . " * " . TF::GRAY . "Tier: " . TF::GREEN . "V"
        ];
        $item->setLore($lore);
        return $item;
    }
}