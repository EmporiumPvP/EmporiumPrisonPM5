<?php

namespace Tetro\EmporiumEnchants\Items;

use pocketmine\item\Item;
use pocketmine\item\VanillaItems;
use pocketmine\utils\TextFormat as TF;

class Books {

    public function Elite($amount): Item {
        $item = VanillaItems::BOOK();
        $item->setCustomName(TF::BOLD .  TF::BLUE . "Elite " . TF::WHITE . "Book");
        $item->setCount($amount);
        $item->getNamedTag()->setString("EliteCustomEnchantBook", "elite");
        $item->getNamedTag()->setString("Rarity", "elite");
        $lore = [
            TF::RESET . TF::GRAY . "Examine this book to receive a random",
            TF::RESET . TF::BLUE . "Elite " . TF::GRAY . "enchantment book.",
            TF::RESET . TF::DARK_GRAY . " * " . TF::GRAY . "Right-click to examine this book.",
            TF::RESET . TF::DARK_GRAY . " * " . TF::GRAY . "Tier: " . TF::GREEN . "I"
        ];
        $item->setLore($lore);
        return $item;
    }

    public function Ultimate($amount): Item {
        $item = VanillaItems::BOOK();
        $item->setCustomName(TF::BOLD .  TF::YELLOW . "Ultimate " . TF::WHITE . "Book");
        $item->setCount($amount);
        $item->getNamedTag()->setString("UltimateCustomEnchantBook", "ultimate");
        $item->getNamedTag()->setString("Rarity", "ultimate");
        $lore = [
            TF::RESET . TF::GRAY . "Examine this book to receive a random",
            TF::RESET . TF::YELLOW . "Ultimate " . TF::GRAY . "enchantment book.",
            TF::RESET . TF::DARK_GRAY . " * " . TF::GRAY . "Right-click to examine this book.",
            TF::RESET . TF::DARK_GRAY . " * " . TF::GRAY . "Tier: " . TF::GREEN . "II"
        ];
        $item->setLore($lore);
        return $item;
    }

    public function Legendary($amount): Item {
        $item = VanillaItems::BOOK();
        $item->setCustomName(TF::BOLD .  TF::GOLD . "Legendary " . TF::WHITE . "Book");
        $item->setCount($amount);
        $item->getNamedTag()->setString("LegendaryCustomEnchantBook", "legendary");
        $item->getNamedTag()->setString("Rarity", "legendary");
        $lore = [
            TF::RESET . TF::GRAY . "Examine this book to receive a random",
            TF::RESET . TF::GOLD . "Legendary " . TF::GRAY . "enchantment book.",
            TF::RESET . TF::DARK_GRAY . " * " . TF::GRAY . "Right-click to examine this book.",
            TF::RESET . TF::DARK_GRAY . " * " . TF::GRAY . "Tier: " . TF::GREEN . "III"
        ];
        $item->setLore($lore);
        return $item;
    }

    public function Godly($amount): Item {
        $item = VanillaItems::BOOK();
        $item->setCustomName(TF::BOLD .  TF::LIGHT_PURPLE . "Godly " . TF::WHITE . "Book");
        $item->setCount($amount);
        $item->getNamedTag()->setString("GodlyCustomEnchantBook", "godly");
        $item->getNamedTag()->setString("Rarity", "godly");
        $lore = [
            TF::RESET . TF::GRAY . "Examine this book to receive a random",
            TF::RESET . TF::LIGHT_PURPLE . "Godly " . TF::GRAY . "enchantment book.",
            TF::RESET . TF::DARK_GRAY . " * " . TF::GRAY . "Right-click to examine this book.",
            TF::RESET . TF::DARK_GRAY . " * " . TF::GRAY . "Tier: " . TF::GREEN . "IV"
        ];
        $item->setLore($lore);
        return $item;
    }

    public function Heroic($amount): Item {
        $item = VanillaItems::BOOK();
        $item->setCustomName(TF::BOLD .  TF::RED . "Heroic " . TF::WHITE . "Book");
        $item->setCount($amount);
        $item->getNamedTag()->setString("HeroicCustomEnchantBook", "heroic");
        $item->getNamedTag()->setString("Rarity", "heroic");
        $lore = [
            TF::RESET . TF::GRAY . "Examine this book to receive a random",
            TF::RESET . TF::RED . "Heroic " . TF::GRAY . "enchantment book.",
            TF::RESET . TF::DARK_GRAY . " * " . TF::GRAY . "Right-click to examine this book.",
            TF::RESET . TF::DARK_GRAY . " * " . TF::GRAY . "Tier: " . TF::GREEN . "V"
        ];
        $item->setLore($lore);
        return $item;
    }

    public function Executive($amount): Item {
        $item = VanillaItems::BOOK();
        $item->setCustomName(TF::BOLD .  TF::BLACK . "Executive " . TF::WHITE . "Book");
        $item->setCount($amount);
        $item->getNamedTag()->setString("ExecutiveCustomEnchantBook", "executive");
        $item->getNamedTag()->setString("Rarity", "executive");
        $lore = [
            TF::RESET . TF::GRAY . "Examine this book to receive a random",
            TF::RESET . TF::BLACK . "Executive " . TF::GRAY . "enchantment book.",
            TF::RESET . TF::DARK_GRAY . " * " . TF::GRAY . "Right-click to examine this book.",
            TF::RESET . TF::DARK_GRAY . " * " . TF::GRAY . "Tier: " . TF::GREEN . "VI"
        ];
        $item->setLore($lore);
        return $item;
    }
}