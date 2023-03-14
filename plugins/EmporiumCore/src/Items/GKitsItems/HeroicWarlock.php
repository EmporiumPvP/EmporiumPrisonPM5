<?php

namespace Items\GKitsItems;

use Emporium\Prison\items\Orbs;
use pocketmine\item\Item;
use Tetro\EmporiumEnchants\Items\Books;

class HeroicWarlock {

    public function energy(): Item {
        $amount = mt_rand(1000000, 3000000);
        $energy = new Orbs();
        return $energy->EnergyOrb($amount);
    }

    public function mysteryEliteEnchants(): Item {
        return (new Books())->Elite(3);
    }

    public function mysteryUltimateEnchants(): Item {
        return (new Books())->Ultimate(3);
    }

    public function mysteryLegendaryEnchants(): Item {
        return (new Books())->Legendary(2);
    }

    public function mysteryGodlyEnchants(): Item {
        return (new Books())->Godly(2);
    }

    public function mysteryHeroicEnchants(): Item {
        return (new Books())->Heroic(1);
    }

}