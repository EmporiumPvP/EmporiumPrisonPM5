<?php

namespace Tetro\EmporiumEnchants\Items;

use customiesdevs\customies\item\CustomiesItemFactory;

use pocketmine\item\Item;
use pocketmine\utils\TextFormat as TF;

class Orbs {

    public function Elite($amount): Item {
        $item = CustomiesItemFactory::getInstance()->get("emporiumenchants:elite_orb");
        $item->setCustomName(TF::BOLD . TF::BLUE . "Elite " . TF::WHITE . "Orb");
        $item->setCount($amount);
        $item->getNamedTag()->setString("LockedPickaxeEnchantOrb", "elite");
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
        $item = CustomiesItemFactory::getInstance()->get("emporiumenchants:ultimate_orb");
        $item->setCustomName(TF::BOLD . TF::YELLOW . "Ultimate " . TF::WHITE . "Orb");
        $item->setCount($amount);
        $item->getNamedTag()->setString("LockedPickaxeEnchantOrb", "ultimate");
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
        $item = CustomiesItemFactory::getInstance()->get("emporiumenchants:legendary_orb");
        $item->setCustomName(TF::BOLD . TF::GOLD . "Legendary " . TF::WHITE . "Orb");
        $item->setCount($amount);
        $item->getNamedTag()->setString("LockedPickaxeEnchantOrb", "legendary");
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
        $item = CustomiesItemFactory::getInstance()->get("emporiumenchants:godly_orb");
        $item->setCustomName(TF::BOLD . TF::LIGHT_PURPLE . "Godly " . TF::WHITE . "Orb");
        $item->setCount($amount);
        $item->getNamedTag()->setString("LockedPickaxeEnchantOrb", "godly");
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
        $item = CustomiesItemFactory::getInstance()->get("emporiumenchants:heroic_orb");
        $item->setCustomName(TF::BOLD . TF::RED . "Heroic " . TF::WHITE . "Orb");
        $item->setCount($amount);
        $item->getNamedTag()->setString("LockedPickaxeEnchantOrb", "heroic");
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