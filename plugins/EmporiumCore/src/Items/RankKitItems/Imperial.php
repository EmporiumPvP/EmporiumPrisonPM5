<?php

namespace Items\RankKitItems;

use Emporium\Prison\items\Orbs;
use pocketmine\item\Item;
use pocketmine\item\VanillaItems;
use pocketmine\utils\TextFormat as TF;

class Imperial {

    public function sword(): Item {
        $item = VanillaItems::GOLDEN_SWORD();
        $item->setCustomName(TF::BOLD . TF::LIGHT_PURPLE . "Imperial " . TF::WHITE . "Sword");
        $lore = [
            "",
            TF::YELLOW . "Required Level " . TF::WHITE . "30"
        ];
        $item->setLore($lore);
        return $item;
    }

    public function energy(): Item {
        $energy = new Orbs();
        return $energy->EnergyOrb(1250000);
    }

    public function helmet(): Item {
        $item = VanillaItems::GOLDEN_HELMET();
        $item->setCustomName(TF::BOLD . TF::LIGHT_PURPLE . "Imperial Helmet");
        $lore = [
            "",
            TF::YELLOW . "Required Level " . TF::WHITE . "30"
        ];
        $item->setLore($lore);
        return $item;
    }
    public function chestplate(): Item {
        $item = VanillaItems::GOLDEN_CHESTPLATE();
        $item->setCustomName(TF::BOLD . TF::LIGHT_PURPLE . "Imperial Chestplate");
        $lore = [
            "",
            TF::YELLOW . "Required Level " . TF::WHITE . "30"
        ];
        $item->setLore($lore);
        return $item;
    }
    public function leggings(): Item {
        $item = VanillaItems::GOLDEN_LEGGINGS();
        $item->setCustomName(TF::BOLD . TF::LIGHT_PURPLE . "Imperial Leggings");
        $lore = [
            "",
            TF::YELLOW . "Required Level " . TF::WHITE . "30"
        ];
        $item->setLore($lore);
        return $item;
    }
    public function boots(): Item {
        $item = VanillaItems::GOLDEN_BOOTS();
        $item->setCustomName(TF::BOLD . TF::LIGHT_PURPLE . "Imperial Boots");
        $lore = [
            "",
            TF::YELLOW . "Required Level " . TF::WHITE . "30"
        ];
        $item->setLore($lore);
        return $item;
    }

}