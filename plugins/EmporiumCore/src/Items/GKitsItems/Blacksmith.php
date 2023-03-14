<?php

namespace Items\GKitsItems;

use Emporium\Prison\items\Orbs;
use Emporium\Prison\items\Scrolls;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\Item;
use pocketmine\item\VanillaItems;
use pocketmine\utils\TextFormat as TF;
use Tetro\EmporiumEnchants\Items\Books;
use Tetro\EmporiumEnchants\Utils\Utils;

class Blacksmith {

    public function goldHelmet(): Item {
        $item = VanillaItems::GOLDEN_HELMET();
        $item->setCustomName(TF::BOLD . TF::DARK_GRAY . "Blacksmith's " . TF::RESET . TF::DARK_GRAY . "Gold Helmet");
        # get enchants
        $enchant1 = Utils::getRandomArmourEnchant();
        $enchant1Level = mt_rand(1, $enchant1->getMaxLevel());
        $enchant2 = Utils::getRandomArmourEnchant();
        $enchant2Level = mt_rand(1, $enchant2->getMaxLevel());
        # add enchants
        $item->addEnchantment(new EnchantmentInstance($enchant1, $enchant1Level));
        $item->addEnchantment(new EnchantmentInstance($enchant2, $enchant2Level));

        return $item;
    }
    public function energy(): Item {
        $amount = mt_rand(1000000, 4000000);
        $energy = new Orbs();
        return $energy->EnergyOrb($amount);
    }

    public function whiteScroll(): Item {
        return (new Scrolls())->whitescroll();
    }

    public function mysteryEliteEnchants(): Item {
        return (new Books())->Elite(2);
    }

    public function mysteryUltimateEnchants(): Item {
        return (new Books())->Ultimate(2);
    }

    public function mysteryLegendaryEnchants(): Item {
        return (new Books())->Legendary(2);
    }

    public function mysteryGodlyEnchants(): Item {
        return (new Books())->Godly(2);
    }

    public function mysteryHeroicEnchants(): Item {
        return (new Books())->Heroic(2);
    }

    public function mysteryExecutiveEnchants(): Item {
        return (new Books())->Executive(2);
    }

}