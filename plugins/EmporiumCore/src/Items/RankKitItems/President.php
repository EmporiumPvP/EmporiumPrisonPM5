<?php

namespace Items\RankKitItems;

use Emporium\Prison\items\Boosters;
use Emporium\Prison\items\Orbs;
use Emporium\Prison\items\Scrolls;
use Items\Contraband;
use Items\Crystals;
use pocketmine\item\Item;

class President {

    public function whiteScroll(): Item {
        $item = new Scrolls();
        return $item->whiteScroll();
    }

    public function holyWhiteScroll(): Item {
        $item = new Scrolls();
        return $item->holyWhiteScroll();
    }

    /*
    public function gkitItemGenerator(): Item {
        $gkitSelector = mt_rand(1, 17);
        switch($gkitSelector) {

        }
    }*/

    public function energy(): Item {
        $amount = mt_rand(3000000, 4000000);
        $energy = new Orbs();
        return $energy->EnergyOrb($amount);
    }

    public function booster(): Boosters {

        $randomBooster = mt_rand(1, 10);
        $item = new Boosters();
        switch($randomBooster) {

            case 1: # energy x2
                $item->EnergyBooster(2);
                break;

            case 2: # energy x2.5
                $item->EnergyBooster(2.5);
                break;

            case 3: # energy x3
                $item->EnergyBooster(3);
                break;

            case 4: # energy x3.5
                $item->EnergyBooster(3.5);
                break;

            case 5: # xp x2
                $item->MiningXpBooster(2);
                break;

            case 6: # xp x2.5
                $item->MiningXpBooster(2.5);
                break;

            case 7: # xp x3
                $item->MiningXpBooster(3);
                break;

            case 8: # xp x3.5
                $item->MiningXpBooster(3.5);
                break;

            case 9: # mystery energy
                $item->MysteryEnergyBooster();
                break;

            case 10: # mystery xp
                $item->MysteryMiningXpBooster();
                break;
        }
        return $item;
    }

    public function contraband1(): Contraband {

        $randomContraband = mt_rand(1, 5);
        $item = new Contraband();
        switch($randomContraband) {

            case 1: # elite
                $item->Elite(1);
                break;

            case 2: # ultimate
                $item->Elite(1);
                break;

            case 3: # legendary
                $item->Legendary(1);
                break;

            case 4: # godly
                $item->Godly(1);
                break;

            case 5: # heroic
                $item->Heroic(1);
                break;

        }
        return $item;
    }

    public function contraband2(): Contraband {

        $randomContraband = mt_rand(1, 5);
        $item = new Contraband();
        switch($randomContraband) {

            case 1: # elite
                $item->Elite(1);
                break;

            case 2: # ultimate
                $item->Elite(1);
                break;

            case 3: # legendary
                $item->Legendary(1);
                break;

            case 4: # godly
                $item->Godly(1);
                break;

            case 5: # heroic
                $item->Heroic(1);
                break;

        }
        return $item;
    }

    public function contraband3(): Contraband {

        $randomContraband = mt_rand(1, 5);
        $item = new Contraband();
        switch($randomContraband) {

            case 1: # elite
                $item->Elite(1);
                break;

            case 2: # ultimate
                $item->Elite(1);
                break;

            case 3: # legendary
                $item->Legendary(1);
                break;

            case 4: # godly
                $item->Godly(1);
                break;

            case 5: # heroic
                $item->Heroic(1);
                break;

        }
        return $item;
    }
    /*
    public function mysteryEnergy(): Item {

    }*/

    public function randomCrystal(): Crystals {

        $item = new Crystals();
        $reward = mt_rand(1, 12);

        switch($reward) {

            case 1: # noble
                $item->noble();
                break;

            case 2: # noble superior
                $item->nobleSuperior();
                break;

            case 3: # imperial
                $item->imperial();
                break;

            case 4: # imperial superior
                $item->imperialSuperior();
                break;

            case 5: # supreme
                $item->supreme();
                break;

            case 6: # supreme superior
                $item->supremeSuperior();
                break;

            case 7: # majesty
                $item->majesty();
                break;

            case 8: # majesty superior
                $item->majestySuperior();
                break;

            case 9: # emperor
                $item->emperor();
                break;

            case 10: # emperor superior
                $item->emperorSuperior();
                break;

            case 11: # president
                $item->president();
                break;

            case 12: # president superior
                $item->presidentSuperior();
                break;
        }
        return $item;
    }
}