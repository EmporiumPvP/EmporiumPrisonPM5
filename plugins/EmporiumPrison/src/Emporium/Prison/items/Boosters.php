<?php

namespace Emporium\Prison\items;

use Emporium\Prison\Managers\misc\GlowManager;

use pocketmine\item\Item;

use pocketmine\item\VanillaItems;
use pocketmine\utils\TextFormat as TF;

class Boosters {

    public function MysteryEnergyBooster(): Item {

        $item = VanillaItems::MAGMA_CREAM();
        $item->getNamedTag()->setInt("MysteryEnergyBooster", mt_rand(1, 10));
        $item->setCustomName(TF::BOLD . TF::DARK_PURPLE . "Mystery" . TF::AQUA . " Energy Booster");
        $lore = [
            "",
            TF::UNDERLINE . TF::GRAY . "Right-Click " . TF::RESET . TF::GRAY . "to reveal a random",
            TF::GRAY . "Booster ranging from 1.25-3.5x",
            TF::GRAY . "for 60 Minutes!",
            "",
            TF::BOLD . TF::WHITE . "Random Loot (" . TF::RESET . TF::GRAY . "1 item" . TF::BOLD . TF::WHITE . ")",
            TF::BOLD . TF::WHITE . " * " . TF::RESET . TF::WHITE . "1x " . TF::BOLD . TF::GREEN . "Energy Booster"
        ];
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    public function EnergyBooster(float $multiplier): Item {

        $item = VanillaItems::MAGMA_CREAM();
        $item->getNamedTag()->setFloat("EnergyBooster", $multiplier);
        $item->setCustomName(TF::BOLD . TF::AQUA . "Energy Booster");
        $lore = [
            TF::GRAY . "Increase your Energy gain for a",
            TF::GRAY . "fixed amount of time",
            "",
            TF::BOLD . TF::AQUA . "MULTIPLIER",
            TF::RESET . TF::GRAY . $multiplier . "x",
            "",
            TF::BOLD . TF::AQUA . "DURATION",
            TF::RESET . TF::GRAY . "60 minutes",
            "",
            TF::RESET . TF::GRAY . "Hint: Right-click to apply"
        ];
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    public function MysteryMiningXpBooster(): Item {

        $item = VanillaItems::MAGMA_CREAM();
        $item->getNamedTag()->setInt("MysteryMiningXpBooster", mt_rand(2, 11));
        $item->setCustomName(TF::BOLD . TF::DARK_PURPLE . "Mystery" . TF::GREEN . " Mining XP Booster");
        $lore = [
            "",
            TF::UNDERLINE . TF::GRAY . "Right-Click " . TF::RESET . TF::GRAY . "to reveal a random",
            TF::GRAY . "Booster ranging from 1.25-3.5x",
            TF::GRAY . "for 60 Minutes!",
            "",
            TF::BOLD . TF::WHITE . "Random Loot (" . TF::RESET . TF::GRAY . "1 item" . TF::BOLD . TF::WHITE . ")",
            TF::BOLD . TF::WHITE . " * " . TF::RESET . TF::WHITE . "1x " . TF::BOLD . TF::GREEN . "Mining XP Booster"
        ];
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    public function MiningXpBooster(float $multiplier): Item {

        $item = VanillaItems::MAGMA_CREAM();
        $item->getNamedTag()->setFloat("MiningXpBooster", $multiplier);
        $item->setCustomName(TF::BOLD . TF::GREEN . "Mining XP Booster");
        $lore = [
            TF::GRAY . "Increase your Mining XP gain",
            TF::GRAY . "for a fixed amount of time",
            "",
            TF::BOLD . TF::GREEN . "MULTIPLIER",
            TF::RESET . TF::GRAY . $multiplier . "x",
            "",
            TF::BOLD . TF::GREEN . "DURATION",
            TF::RESET . TF::GRAY . "60 Minutes",
            "",
            TF::RESET . TF::GRAY . "Hint: Right-click to apply"
        ];
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

}