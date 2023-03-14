<?php

namespace Items\GKitsItems;

use Emporium\Prison\items\Orbs;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\Item;
use pocketmine\item\VanillaItems;
use pocketmine\utils\TextFormat as TF;
use Tetro\EmporiumEnchants\Utils\Utils;

class HeroicBroteas {

    public function axe(): Item {
        $item = VanillaItems::GOLDEN_AXE();
        $item->setCustomName(TF::BOLD . TF::DARK_PURPLE . "Broteas Axe");
        # get enchants
        $enchant1 = Utils::getRandomWeaponEnchant();
        $enchant1Level = mt_rand(1, $enchant1->getMaxLevel());
        $enchant2 = Utils::getRandomWeaponEnchant();
        $enchant2Level = mt_rand(1, $enchant2->getMaxLevel());
        $enchant3 = Utils::getRandomWeaponEnchant();
        $enchant3Level = mt_rand(1, $enchant3->getMaxLevel());
        $enchant4 = Utils::getRandomWeaponEnchant();
        $enchant4Level = mt_rand(1, $enchant4->getMaxLevel());
        # add enchants
        $item->addEnchantment(new EnchantmentInstance($enchant1, $enchant1Level));
        $item->addEnchantment(new EnchantmentInstance($enchant2, $enchant2Level));
        $item->addEnchantment(new EnchantmentInstance($enchant3, $enchant3Level));
        $item->addEnchantment(new EnchantmentInstance($enchant4, $enchant4Level));
        return $item;
    }
    public function pickaxe(): Item {
        $item = VanillaItems::GOLDEN_PICKAXE();
        $item->setCustomName(TF::BOLD . TF::DARK_PURPLE . "Broteas Pickaxe");
        return $item;
    }
    public function energy(): Item {
        $amount = mt_rand(1000000, 4000000);
        $energy = new Orbs();
        return $energy->EnergyOrb($amount);
    }

}