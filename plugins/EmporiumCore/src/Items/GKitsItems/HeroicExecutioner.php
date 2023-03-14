<?php

namespace Items\GKitsItems;

use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\Item;
use pocketmine\item\VanillaItems;
use pocketmine\utils\TextFormat as TF;
use Tetro\EmporiumEnchants\Utils\Utils;

class HeroicExecutioner {

    public function helmet(): Item {
        $item = VanillaItems::GOLDEN_HELMET();
        $item->setCustomName(TF::BOLD . TF::DARK_RED . "Executioner's Hood");
        # get enchants
        $enchant1 = Utils::getRandomArmourEnchant();
        $enchant1Level = mt_rand(1, $enchant1->getMaxLevel());
        $enchant2 = Utils::getRandomArmourEnchant();
        $enchant2Level = mt_rand(1, $enchant2->getMaxLevel());
        $enchant3 = Utils::getRandomArmourEnchant();
        $enchant3Level = mt_rand(1, $enchant3->getMaxLevel());
        # add enchants
        $item->addEnchantment(new EnchantmentInstance($enchant1, $enchant1Level));
        $item->addEnchantment(new EnchantmentInstance($enchant2, $enchant2Level));
        $item->addEnchantment(new EnchantmentInstance($enchant3, $enchant3Level));
        return $item;
    }
    public function chestplate(): Item {
        $item = VanillaItems::GOLDEN_CHESTPLATE();
        $item->setCustomName(TF::BOLD . TF::DARK_RED . "Executioner's Robe");
        # get enchants
        $enchant1 = Utils::getRandomArmourEnchant();
        $enchant1Level = mt_rand(1, $enchant1->getMaxLevel());
        $enchant2 = Utils::getRandomArmourEnchant();
        $enchant2Level = mt_rand(1, $enchant2->getMaxLevel());
        $enchant3 = Utils::getRandomArmourEnchant();
        $enchant3Level = mt_rand(1, $enchant3->getMaxLevel());
        # add enchants
        $item->addEnchantment(new EnchantmentInstance($enchant1, $enchant1Level));
        $item->addEnchantment(new EnchantmentInstance($enchant2, $enchant2Level));
        $item->addEnchantment(new EnchantmentInstance($enchant3, $enchant3Level));
        return $item;
    }
    public function leggings(): Item {
        $item = VanillaItems::GOLDEN_LEGGINGS();
        $item->setCustomName(TF::BOLD . TF::DARK_RED . "Executioner's Greaves");
        # get enchants
        $enchant1 = Utils::getRandomArmourEnchant();
        $enchant1Level = mt_rand(1, $enchant1->getMaxLevel());
        $enchant2 = Utils::getRandomArmourEnchant();
        $enchant2Level = mt_rand(1, $enchant2->getMaxLevel());
        $enchant3 = Utils::getRandomArmourEnchant();
        $enchant3Level = mt_rand(1, $enchant3->getMaxLevel());
        # add enchants
        $item->addEnchantment(new EnchantmentInstance($enchant1, $enchant1Level));
        $item->addEnchantment(new EnchantmentInstance($enchant2, $enchant2Level));
        $item->addEnchantment(new EnchantmentInstance($enchant3, $enchant3Level));
        return $item;
    }
    public function boots(): Item {
        $item = VanillaItems::GOLDEN_BOOTS();
        $item->setCustomName(TF::BOLD . TF::DARK_RED . "Executioner's Sabatons");
        # get enchants
        $enchant1 = Utils::getRandomArmourEnchant();
        $enchant1Level = mt_rand(1, $enchant1->getMaxLevel());
        $enchant2 = Utils::getRandomArmourEnchant();
        $enchant2Level = mt_rand(1, $enchant2->getMaxLevel());
        $enchant3 = Utils::getRandomArmourEnchant();
        $enchant3Level = mt_rand(1, $enchant3->getMaxLevel());
        # add enchants
        $item->addEnchantment(new EnchantmentInstance($enchant1, $enchant1Level));
        $item->addEnchantment(new EnchantmentInstance($enchant2, $enchant2Level));
        $item->addEnchantment(new EnchantmentInstance($enchant3, $enchant3Level));
        return $item;
    }
    public function axe(): Item {
        $item = VanillaItems::GOLDEN_AXE();
        $item->setCustomName(TF::BOLD . TF::DARK_RED . "Executioner's Axe");
        # get enchants
        $enchant1 = Utils::getRandomWeaponEnchant();
        $enchant1Level = mt_rand(1, $enchant1->getMaxLevel());
        $enchant2 = Utils::getRandomWeaponEnchant();
        $enchant2Level = mt_rand(1, $enchant2->getMaxLevel());
        $enchant3 = Utils::getRandomWeaponEnchant();
        $enchant3Level = mt_rand(1, $enchant3->getMaxLevel());
        # add enchants
        $item->addEnchantment(new EnchantmentInstance($enchant1, $enchant1Level));
        $item->addEnchantment(new EnchantmentInstance($enchant2, $enchant2Level));
        $item->addEnchantment(new EnchantmentInstance($enchant3, $enchant3Level));
        return $item;
    }

}