<?php

namespace Items\RankKitItems;

use Emporium\Prison\EmporiumPrison;
use Emporium\Prison\items\Orbs;
use Emporium\Prison\items\Scrolls;
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

    public function booster(): Item {

        $randomBooster = mt_rand(1, 10);
        $item = EmporiumPrison::getInstance()->getBoosters();
        if($randomBooster == 1) {
            return $item->EnergyBooster(2);
        }
        if($randomBooster == 2) {
            return $item->EnergyBooster(2.5);
        }
        if($randomBooster == 3) {
            return $item->EnergyBooster(3);
        }
        if($randomBooster == 4) {
            return $item->EnergyBooster(3.5);
        }
        if($randomBooster == 5) {
            return $item->MiningXpBooster(2);
        }
        if($randomBooster == 6) {
            return $item->MiningXpBooster(2.5);
        }
        if($randomBooster == 7) {
            return $item->MiningXpBooster(3);
        }
        if($randomBooster == 8) {
            return $item->MiningXpBooster(3.5);
        }
        if($randomBooster == 9) {
            return $item->MysteryEnergyBooster();
        }
        if($randomBooster == 10) {
            return $item->MysteryMiningXpBooster();
        }
        return $item->EnergyBooster(2);
    }

    public function contraband1(): Item {

        $randomContraband = mt_rand(1, 5);
        $item = EmporiumPrison::getInstance()->getContraband();
        if($randomContraband == 1) {
            return $item->Elite(1);
        }
        if($randomContraband == 2) {
            return $item->Ultimate(1);
        }
        if($randomContraband == 3) {
            return $item->Legendary(1);
        }
        if($randomContraband == 4) {
            return $item->Godly(1);
        }
        if($randomContraband == 5) {
            return $item->Heroic(1);
        }
        return $item->Elite(1);
    }

    public function contraband2(): Item {

        $randomContraband = mt_rand(1, 5);
        $item = EmporiumPrison::getInstance()->getContraband();
        if($randomContraband == 1) {
            return $item->Elite(1);
        }
        if($randomContraband == 2) {
            return $item->Ultimate(1);
        }
        if($randomContraband == 3) {
            return $item->Legendary(1);
        }
        if($randomContraband == 4) {
            return $item->Godly(1);
        }
        if($randomContraband == 5) {
            return $item->Heroic(1);
        }
        return $item->Elite(1);
    }

    public function contraband3(): Item
    {

        $randomContraband = mt_rand(1, 5);
        $item = EmporiumPrison::getInstance()->getContraband();
        if($randomContraband == 1) {
            return $item->Elite(1);
        }
        if($randomContraband == 2) {
            return $item->Ultimate(1);
        }
        if($randomContraband == 3) {
            return $item->Legendary(1);
        }
        if($randomContraband == 4) {
            return $item->Godly(1);
        }
        if($randomContraband == 5) {
            return $item->Heroic(1);
        }
        return $item->Elite(1);
    }
    /*
    public function mysteryEnergy(): Item {

    }*/

    public function randomCrystal(): Item {

        $item = new Crystals();
        $reward = mt_rand(1, 12);

        if($reward == 1) {
            return $item->noble();
        }
        if($reward == 2) {
            return $item->nobleSuperior();
        }
        if($reward == 3) {
            return $item->imperial();
        }
        if($reward == 4) {
            return $item->imperialSuperior();
        }
        if($reward == 5) {
            return $item->supreme();
        }
        if($reward == 6) {
            return $item->supremeSuperior();
        }
        if($reward == 7) {
            return $item->majesty();
        }
        if($reward == 8) {
            return $item->majestySuperior();
        }
        if($reward == 9) {
            return $item->emperor();
        }
        if($reward == 10) {
            return $item->emperorSuperior();
        }
        if($reward == 11) {
            return $item->president();
        }
        if($reward == 12) {
            return $item->presidentSuperior();
        }
        return $item->noble();
    }
}