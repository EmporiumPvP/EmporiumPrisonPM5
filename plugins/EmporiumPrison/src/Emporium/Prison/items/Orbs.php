<?php

namespace Emporium\Prison\items;

use customiesdevs\customies\item\CustomiesItemFactory;
use Emporium\Prison\Managers\misc\GlowManager;
use Emporium\Prison\Managers\misc\Translator;

use pocketmine\item\Item;

use pocketmine\item\VanillaItems;
use pocketmine\utils\TextFormat as TF;

class Orbs {

    public function PickaxeLevelUpToken(): Item {

        $item = VanillaItems::PAPER();
        $item->setCustomName("Pickaxe Level Orb");
        $item->getNamedTag()->setByte("PickaxeLevelUpToken", 1);
        $lore = [
            "",
            TF::WHITE . "Grants " . TF::UNDERLINE . "ONE" . TF::RESET . TF::WHITE . "free Level for",
            TF::WHITE . "any pickaxe, without the requirements!",
            "",
            TF::GRAY . "Hint: Drop onto a pickaxe to use"
        ];
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    public function PickaxePrestigeToken(): Item {

        $item = VanillaItems::PAPER();
        $item->setCustomName(TF::BOLD . TF::YELLOW . "Pickaxe Prestige Token " . TF::WHITE . "I" . TF::RESET);
        $item->getNamedTag()->setByte("PickaxePrestigeToken", 1);
        $lore = [
            TF::WHITE . "Grants " . TF::UNDERLINE . "ONE" . TF::RESET . TF::WHITE . "free Prestige for",
            TF::WHITE . "any pickaxe, without the requirements!",
            "",
            TF::RED . "This item can prestige your pickaxe up to a maximum prestige of: 1",
            "",
            TF::GRAY . "Hint: Drop onto a pickaxe to use"
        ];
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    public function EnergyOrb(int $amount): Item {

        $stringAmount = strval($amount);
        $translatedAmount = Translator::numberFormat($amount);
        $item = CustomiesItemFactory::getInstance()->get("emporiumprison:energy");
        #$item = BlockTypeIds::LIGHT_BLUE_DYE();
        $item->setCustomName(TF::BOLD . TF::WHITE . $translatedAmount . TF::AQUA . " Energy " . TF::RESET);
        $lore = [
            TF::GOLD . "Contains " . TF::BOLD . TF::WHITE . $translatedAmount . TF::AQUA . " Energy" . TF::RESET,
            TF::GOLD . "that is used for Enchanting",
            "",
            TF::GRAY . "Hint: Drop onto a pickaxe to add",
            TF::GRAY . "its energy!",
        ];
        $item->setLore($lore);
        $item->getNamedTag()->setString("EnergyOrb", "EnergyOrb");
        $item->getNamedTag()->setInt("Energy", $stringAmount);
        $item->addEnchantment(GlowManager::$enchInst);
        return $item;
    }

}