<?php

namespace Tetro\EmporiumEnchants\Items;

use customiesdevs\customies\item\CustomiesItemFactory;

use pocketmine\item\Item;
use pocketmine\utils\TextFormat as TF;

class Books {

    public function Elite($amount): Item {
        $item = CustomiesItemFactory::getInstance()->get("emporiumenchants:elite_book");
        $item->setCustomName(TF::BOLD .  TF::BLUE . "Elite " . TF::WHITE . "Book");
        $item->setCount($amount);
        $item->getNamedTag()->setString("LockedCustomEnchantBook", "elite");
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
        $item = CustomiesItemFactory::getInstance()->get("emporiumenchants:ultimate_book");
        $item->setCustomName(TF::BOLD .  TF::YELLOW . "Ultimate " . TF::WHITE . "Book");
        $item->setCount($amount);
        $item->getNamedTag()->setString("LockedCustomEnchantBook", "ultimate");
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
        $item = CustomiesItemFactory::getInstance()->get("emporiumenchants:legendary_book");
        $item->setCustomName(TF::BOLD .  TF::GOLD . "Legendary " . TF::WHITE . "Book");
        $item->setCount($amount);
        $item->getNamedTag()->setString("LockedCustomEnchantBook", "legendary");
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
        $item = CustomiesItemFactory::getInstance()->get("emporiumenchants:godly_book");
        $item->setCustomName(TF::BOLD .  TF::LIGHT_PURPLE . "Godly " . TF::WHITE . "Book");
        $item->setCount($amount);
        $item->getNamedTag()->setString("LockedCustomEnchantBook", "godly");
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
        $item = CustomiesItemFactory::getInstance()->get("emporiumenchants:heroic_book");
        $item->setCustomName(TF::BOLD .  TF::RED . "Heroic " . TF::WHITE . "Book");
        $item->setCount($amount);
        $item->getNamedTag()->setString("LockedCustomEnchantBook", "heroic");
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
        $item = CustomiesItemFactory::getInstance()->get("emporiumenchants:executive_book");
        $item->setCustomName(TF::BOLD .  TF::BLACK . "Executive " . TF::WHITE . "Book");
        $item->setCount($amount);
        $item->getNamedTag()->setString("LockedCustomEnchantBook", "executive");
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