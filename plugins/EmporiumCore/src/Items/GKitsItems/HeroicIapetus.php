<?php

namespace Items\GKitsItems;

use Emporium\Prison\items\Orbs;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\Item;
use pocketmine\item\VanillaItems;
use pocketmine\utils\TextFormat as TF;
use Tetro\EmporiumEnchants\Utils\Utils;

class HeroicIapetus {

    public function axe(): Item {
        $item = VanillaItems::GOLDEN_AXE();
        $item->setCustomName(TF::BOLD . TF::GRAY . "Iapetus Axe");
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

    public function energy(): Item {

        $amount = mt_rand(1000000, 3000000);
        $energy = new Orbs();
        return $energy->EnergyOrb($amount);
    }

}