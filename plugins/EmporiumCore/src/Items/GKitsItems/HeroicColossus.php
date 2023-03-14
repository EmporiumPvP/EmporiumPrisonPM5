<?php

namespace Items\GKitsItems;

use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\Item;
use pocketmine\item\VanillaItems;
use pocketmine\utils\TextFormat as TF;
use Tetro\EmporiumEnchants\Utils\Utils;

class HeroicColossus {

    public function boots(): Item {
        $item = VanillaItems::GOLDEN_BOOTS();
        $item->setCustomName(TF::BOLD . TF::WHITE . "Colossus Boots");
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
        $enchant5Level = mt_rand(1, $enchant4->getMaxLevel());
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
        $item->setCustomName(TF::BOLD . TF::WHITE . "Colossus Sword");
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

}