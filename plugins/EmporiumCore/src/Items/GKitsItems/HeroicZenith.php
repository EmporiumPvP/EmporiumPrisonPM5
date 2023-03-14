<?php

namespace Items\GKitsItems;

use Emporium\Prison\items\Pickaxes;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\Item;
use pocketmine\item\VanillaItems;
use pocketmine\utils\TextFormat as TF;
use Tetro\EmporiumEnchants\Utils\Utils;

class HeroicZenith {

    public function leggings(): Item {
        $item = VanillaItems::GOLDEN_LEGGINGS();
        $item->setCustomName(TF::BOLD . TF::GOLD . "Zenith Leggings");
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
    public function pickaxe($player): Item {
        $pickaxe = new Pickaxes($player);
        $item = $pickaxe->Gold();
        $item->setCustomName(TF::BOLD . TF::GOLD . "Zenith Pickaxe");
        return $item;
    }

}