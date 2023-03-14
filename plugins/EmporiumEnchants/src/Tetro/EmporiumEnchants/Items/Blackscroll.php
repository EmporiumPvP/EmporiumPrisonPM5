<?php

namespace Tetro\EmporiumEnchants\Items;

use Emporium\Prison\Managers\misc\GlowManager;
use pocketmine\item\Item;
use pocketmine\item\VanillaItems;
use pocketmine\utils\TextFormat as TF;

class Blackscroll {

    public function oneHundredChance(): Item {
        $item = VanillaItems::INK_SAC();
        $item->setCustomName(TF::BOLD . TF::DARK_GRAY . "Black Scroll " . TF::RESET . TF::GRAY . "(" . TF::WHITE . "100" . TF::GRAY . "%)");
        $lore = [
            TF::EOL,
            TF::LIGHT_PURPLE . "Extracts an Enchant from a",
            TF::LIGHT_PURPLE . "pickaxe or a piece of gear.",
            TF::EOL,
            TF::GREEN . "✓ " . TF::BOLD . TF::YELLOW . "Elite           " . TF::RESET . TF::GREEN . "✓ " . TF::BOLD . TF::YELLOW . "Ultimate",
            TF::GREEN . "✓ " . TF::BOLD . TF::YELLOW . "Legendary   " . TF::RESET . TF::GREEN . "✓ " . TF::BOLD . TF::YELLOW . "Godly",
            TF::GREEN . "✓ " . TF::BOLD . TF::YELLOW . "Heroic        " . TF::RESET . TF::RED . "✗ " . TF::BOLD . TF::RED . "Executive",
            TF::RED . "✗ " . TF::BOLD . TF::RED . "Nuclear         ",
            TF::EOL,
            TF::BOLD . TF::GRAY . "HINT: " . TF::RESET . TF::GRAY . "Drag and drop onto a pickaxe",
            TF::GRAY . "or a piece of gear to randomly extract",
            TF::GRAY . "an enchantment!",
            TF::EOL,
            TF::BOLD . TF::RED . "WARNING: Irreversible action!"
        ];
        $item->setLore($lore);
        $item->getNamedTag()->setInt("chance", 100);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }
    public function randomChance(): Item {
        $chance = mt_rand(1, 100);
        $item = VanillaItems::INK_SAC();
        $item->setCustomName(TF::BOLD . TF::DARK_GRAY . "Black Scroll " . TF::RESET . TF::GRAY . "(" . TF::WHITE . $chance . TF::GRAY . "%)");
        $lore = [
            TF::EOL,
            TF::LIGHT_PURPLE . "Extracts an Enchant from a",
            TF::LIGHT_PURPLE . "pickaxe or a piece of gear.",
            TF::EOL,
            TF::GREEN . "✓ " . TF::BOLD . TF::YELLOW . "Elite           " . TF::RESET . TF::GREEN . "✓ " . TF::BOLD . TF::YELLOW . "Ultimate",
            TF::GREEN . "✓ " . TF::BOLD . TF::YELLOW . "Legendary   " . TF::RESET . TF::GREEN . "✓ " . TF::BOLD . TF::YELLOW . "Godly",
            TF::GREEN . "✓ " . TF::BOLD . TF::YELLOW . "Heroic        " . TF::RESET . TF::RED . "✗ " . TF::BOLD . TF::RED . "Executive",
            TF::RED . "✗ " . TF::BOLD . TF::RED . "Nuclear         ",
            TF::EOL,
            TF::BOLD . TF::GRAY . "HINT: " . TF::RESET . TF::GRAY . "Drag and drop onto a pickaxe",
            TF::GRAY . "or a piece of gear to randomly extract",
            TF::GRAY . "an enchantment!",
            TF::EOL,
            TF::BOLD . TF::RED . "WARNING: Irreversible action!"
        ];
        $item->setLore($lore);
        $item->getNamedTag()->setInt("chance", $chance);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    public function setChance(int $chance): Item {
        $item = VanillaItems::INK_SAC();
        $item->setCustomName(TF::BOLD . TF::DARK_GRAY . "Black Scroll " . TF::RESET . TF::GRAY . "(" . TF::WHITE . $chance . TF::GRAY . "%)");
        $lore = [
            TF::EOL,
            TF::LIGHT_PURPLE . "Extracts an Enchant from a",
            TF::LIGHT_PURPLE . "pickaxe or a piece of gear.",
            TF::EOL,
            TF::GREEN . "✓ " . TF::BOLD . TF::YELLOW . "Elite           " . TF::RESET . TF::GREEN . "✓ " . TF::BOLD . TF::YELLOW . "Ultimate",
            TF::GREEN . "✓ " . TF::BOLD . TF::YELLOW . "Legendary   " . TF::RESET . TF::GREEN . "✓ " . TF::BOLD . TF::YELLOW . "Godly",
            TF::GREEN . "✓ " . TF::BOLD . TF::YELLOW . "Heroic        " . TF::RESET . TF::RED . "✗ " . TF::BOLD . TF::RED . "Executive",
            TF::RED . "✗ " . TF::BOLD . TF::RED . "Nuclear         ",
            TF::EOL,
            TF::BOLD . TF::GRAY . "HINT: " . TF::RESET . TF::GRAY . "Drag and drop onto a pickaxe",
            TF::GRAY . "or a piece of gear to randomly extract",
            TF::GRAY . "an enchantment!",
            TF::EOL,
            TF::BOLD . TF::RED . "WARNING: Irreversible action!"
        ];
        $item->setLore($lore);
        $item->getNamedTag()->setInt("chance", $chance);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

}