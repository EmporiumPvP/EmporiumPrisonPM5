<?php

namespace Items\GKitsItems;

use Emporium\Prison\items\Orbs;
use Emporium\Prison\items\Scrolls;
use pocketmine\item\Item;
use Tetro\EmporiumEnchants\Items\Books;

class HeroicEnchanter {

    public function energy(): Item {
        $amount = mt_rand(1000000, 2000000);
        $energy = new Orbs();
        return $energy->EnergyOrb($amount);
    }

    public function whiteScroll(): Item {
        return (new Scrolls())->whitescroll();
    }

    public function mysteryEliteEnchants(): Item {
        return (new Books())->Elite(5);
    }

    public function mysteryUltimateEnchants(): Item {
        return (new Books())->Ultimate(4);
    }

    public function mysteryLegendaryEnchants(): Item {
        return (new Books())->Legendary(3);
    }

    public function mysteryGodlyEnchants(): Item {
        return (new Books())->Godly(2);
    }

    public function mysteryHeroicEnchants(): Item {
        return (new Books())->Heroic(1);
    }

    public function mysteryExecutiveEnchants(): Item {
        return (new Books())->Executive(1);
    }
}