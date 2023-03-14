<?php

namespace Items\GKitsItems;

use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\Item;
use pocketmine\item\VanillaItems;
use pocketmine\utils\TextFormat as TF;
use Tetro\EmporiumEnchants\Utils\Utils;

class Hunter {

    public function helmet(): Item {
        $item = VanillaItems::GOLDEN_HELMET();
        $item->setCustomName(TF::BOLD . TF::AQUA . "Hunter Helmet");
        # get enchants
        $enchant1 = Utils::getRandomArmourEnchant();
        $enchant1Level = mt_rand(1, $enchant1->getMaxLevel());
        $enchant2 = Utils::getRandomArmourEnchant();
        $enchant2Level = mt_rand(1, $enchant2->getMaxLevel());
        $enchant3 = Utils::getRandomArmourEnchant();
        $enchant3Level = mt_rand(1, $enchant3->getMaxLevel());
        $enchant4 = Utils::getRandomArmourEnchant();
        $enchant4Level = mt_rand(1, $enchant4->getMaxLevel());
        $enchant5 = Utils::getRandomArmourEnchant();
        $enchant5Level = mt_rand(1, $enchant5->getMaxLevel());
        # add enchants
        $item->addEnchantment(new EnchantmentInstance($enchant1, $enchant1Level));
        $item->addEnchantment(new EnchantmentInstance($enchant2, $enchant2Level));
        $item->addEnchantment(new EnchantmentInstance($enchant3, $enchant3Level));
        $item->addEnchantment(new EnchantmentInstance($enchant4, $enchant4Level));
        $item->addEnchantment(new EnchantmentInstance($enchant5, $enchant5Level));
        return $item;
    }
    public function chestplate(): Item {
        $item = VanillaItems::GOLDEN_CHESTPLATE();
        $item->setCustomName(TF::BOLD . TF::AQUA . "Hunter Chestplate");
        # get enchants
        $enchant1 = Utils::getRandomArmourEnchant();
        $enchant1Level = mt_rand(1, $enchant1->getMaxLevel());
        $enchant2 = Utils::getRandomArmourEnchant();
        $enchant2Level = mt_rand(1, $enchant2->getMaxLevel());
        $enchant3 = Utils::getRandomArmourEnchant();
        $enchant3Level = mt_rand(1, $enchant3->getMaxLevel());
        $enchant4 = Utils::getRandomArmourEnchant();
        $enchant4Level = mt_rand(1, $enchant4->getMaxLevel());
        $enchant5 = Utils::getRandomArmourEnchant();
        $enchant5Level = mt_rand(1, $enchant5->getMaxLevel());
        # add enchants
        $item->addEnchantment(new EnchantmentInstance($enchant1, $enchant1Level));
        $item->addEnchantment(new EnchantmentInstance($enchant2, $enchant2Level));
        $item->addEnchantment(new EnchantmentInstance($enchant3, $enchant3Level));
        $item->addEnchantment(new EnchantmentInstance($enchant4, $enchant4Level));
        $item->addEnchantment(new EnchantmentInstance($enchant5, $enchant5Level));
        return $item;
    }
    public function leggings(): Item {
        $item = VanillaItems::GOLDEN_LEGGINGS();
        $item->setCustomName(TF::BOLD . TF::AQUA . "Hunter Leggings");
        # get enchants
        $enchant1 = Utils::getRandomArmourEnchant();
        $enchant1Level = mt_rand(1, $enchant1->getMaxLevel());
        $enchant2 = Utils::getRandomArmourEnchant();
        $enchant2Level = mt_rand(1, $enchant2->getMaxLevel());
        $enchant3 = Utils::getRandomArmourEnchant();
        $enchant3Level = mt_rand(1, $enchant3->getMaxLevel());
        $enchant4 = Utils::getRandomArmourEnchant();
        $enchant4Level = mt_rand(1, $enchant4->getMaxLevel());
        $enchant5 = Utils::getRandomArmourEnchant();
        $enchant5Level = mt_rand(1, $enchant5->getMaxLevel());
        # add enchants
        $item->addEnchantment(new EnchantmentInstance($enchant1, $enchant1Level));
        $item->addEnchantment(new EnchantmentInstance($enchant2, $enchant2Level));
        $item->addEnchantment(new EnchantmentInstance($enchant3, $enchant3Level));
        $item->addEnchantment(new EnchantmentInstance($enchant4, $enchant4Level));
        $item->addEnchantment(new EnchantmentInstance($enchant5, $enchant5Level));
        return $item;
    }
    public function boots(): Item {
        $item = VanillaItems::GOLDEN_BOOTS();
        $item->setCustomName(TF::BOLD . TF::AQUA . "Hunter Boots");
        # get enchants
        $enchant1 = Utils::getRandomArmourEnchant();
        $enchant1Level = mt_rand(1, $enchant1->getMaxLevel());
        $enchant2 = Utils::getRandomArmourEnchant();
        $enchant2Level = mt_rand(1, $enchant2->getMaxLevel());
        $enchant3 = Utils::getRandomArmourEnchant();
        $enchant3Level = mt_rand(1, $enchant3->getMaxLevel());
        $enchant4 = Utils::getRandomArmourEnchant();
        $enchant4Level = mt_rand(1, $enchant4->getMaxLevel());
        $enchant5 = Utils::getRandomArmourEnchant();
        $enchant5Level = mt_rand(1, $enchant5->getMaxLevel());
        # add enchants
        $item->addEnchantment(new EnchantmentInstance($enchant1, $enchant1Level));
        $item->addEnchantment(new EnchantmentInstance($enchant2, $enchant2Level));
        $item->addEnchantment(new EnchantmentInstance($enchant3, $enchant3Level));
        $item->addEnchantment(new EnchantmentInstance($enchant4, $enchant4Level));
        $item->addEnchantment(new EnchantmentInstance($enchant5, $enchant5Level));
        return $item;
    }
    public function sword(): Item {
        $item = VanillaItems::GOLDEN_SWORD();
        $item->setCustomName(TF::BOLD . TF::AQUA . "Hunter Sword");
        # get enchants
        $enchant1 = Utils::getRandomWeaponEnchant();
        $enchant1Level = mt_rand(1, $enchant1->getMaxLevel());
        $enchant2 = Utils::getRandomWeaponEnchant();
        $enchant2Level = mt_rand(1, $enchant2->getMaxLevel());
        $enchant3 = Utils::getRandomWeaponEnchant();
        $enchant3Level = mt_rand(1, $enchant3->getMaxLevel());
        $enchant4 = Utils::getRandomWeaponEnchant();
        $enchant4Level = mt_rand(1, $enchant4->getMaxLevel());
        $enchant5 = Utils::getRandomWeaponEnchant();
        $enchant5Level = mt_rand(1, $enchant5->getMaxLevel());
        # add enchants
        $item->addEnchantment(new EnchantmentInstance($enchant1, $enchant1Level));
        $item->addEnchantment(new EnchantmentInstance($enchant2, $enchant2Level));
        $item->addEnchantment(new EnchantmentInstance($enchant3, $enchant3Level));
        $item->addEnchantment(new EnchantmentInstance($enchant4, $enchant4Level));
        $item->addEnchantment(new EnchantmentInstance($enchant5, $enchant5Level));
        return $item;
    }

}