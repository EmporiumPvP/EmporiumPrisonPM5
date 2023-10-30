<?php

namespace Tetro\EmporiumEnchants\Items;

use Emporium\Prison\Managers\misc\GlowManager;

use pocketmine\item\Item;
use pocketmine\item\VanillaItems;
use pocketmine\utils\TextFormat as TF;

class Scrolls
{

    # black scrolls
    public function blackScrollHundred(): Item {
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
        $item->getNamedTag()->setString("Scroll", "black");
        $item->getNamedTag()->setInt("chance", 100);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    public function blackScrollRandomChance(): Item {
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
        $item->getNamedTag()->setString("Scroll", "black");
        $item->getNamedTag()->setInt("chance", $chance);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    public function blackScrollSetChance(int $chance): Item {
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
        $item->getNamedTag()->setString("Scroll", "black");
        $item->getNamedTag()->setInt("chance", $chance);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    # randomisation scrolls
    public function eliteRandomisationScroll(): Item {
        $item = VanillaItems::PAPER();
        $item->setCustomName(TF::BOLD . TF::BLUE . "Elite Randomisation Scroll");
        $lore = [
            TF::EOL,
            TF::GOLD . "When placed on a pickaxe enchant",
            TF::GOLD . "it will completely randomize",
            TF::GOLD . "the success and failure rates",
            TF::GOLD . "of that enchant.",
            TF::EOL,
            TF::GREEN . "Only works on " . TF::BOLD . TF::BLUE . "Elite " . TF::RESET . TF::GREEN . "Enchants",
            TF::EOL,
            TF::GRAY . "(Drag-n-drop on Enchant)"
        ];
        $item->setLore($lore);
        $item->getNamedTag()->setString("RandomisationScroll", "elite");
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    public function ultimateRandomisationScroll(): Item {
        $item = VanillaItems::PAPER();
        $item->setCustomName(TF::BOLD . TF::YELLOW . "Ultimate Randomisation Scroll");
        $lore = [
            TF::EOL,
            TF::GOLD . "When placed on a pickaxe enchant",
            TF::GOLD . "it will completely randomize",
            TF::GOLD . "the success and failure rates",
            TF::GOLD . "of that enchant.",
            TF::EOL,
            TF::GREEN . "Only works on " . TF::BOLD . TF::YELLOW . "Ultimate " . TF::RESET . TF::GREEN . "Enchants",
            TF::EOL,
            TF::GRAY . "(Drag-n-drop on Enchant)"
        ];
        $item->setLore($lore);
        $item->getNamedTag()->setString("RandomisationScroll", "ultimate");
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    public function legendaryRandomisationScroll(): Item {
        $item = VanillaItems::PAPER();
        $item->setCustomName(TF::BOLD . TF::GOLD . "Legendary Randomisation Scroll");
        $lore = [
            TF::EOL,
            TF::GOLD . "When placed on a pickaxe enchant",
            TF::GOLD . "it will completely randomize",
            TF::GOLD . "the success and failure rates",
            TF::GOLD . "of that enchant.",
            TF::EOL,
            TF::GREEN . "Only works on " . TF::BOLD . TF::GOLD . "Legendary " . TF::RESET . TF::GREEN . "Enchants",
            TF::EOL,
            TF::GRAY . "(Drag-n-drop on Enchant)"
        ];
        $item->setLore($lore);
        $item->getNamedTag()->setString("RandomisationScroll", "legendary");
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    public function godlyRandomisationScroll(): Item {
        $item = VanillaItems::PAPER();
        $item->setCustomName(TF::BOLD . TF::LIGHT_PURPLE . "Godly Randomisation Scroll");
        $lore = [
            TF::EOL,
            TF::GOLD . "When placed on a pickaxe enchant",
            TF::GOLD . "it will completely randomize",
            TF::GOLD . "the success and failure rates",
            TF::GOLD . "of that enchant.",
            TF::EOL,
                TF::GREEN . "Only works on " . TF::BOLD . TF::LIGHT_PURPLE . "Godly " . TF::RESET . TF::GREEN . "Enchants",
            TF::EOL,
            TF::GRAY . "(Drag-n-drop on Enchant)"
        ];
        $item->setLore($lore);
        $item->getNamedTag()->setString("RandomisationScroll", "godly");
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    public function heroicRandomisationScroll(): Item {
        $item = VanillaItems::PAPER();
        $item->setCustomName(TF::BOLD . TF::RED . "Heroic Randomisation Scroll");
        $lore = [
            TF::EOL,
            TF::GOLD . "When placed on a pickaxe enchant",
            TF::GOLD . "it will completely randomize",
            TF::GOLD . "the success and failure rates",
            TF::GOLD . "of that enchant.",
            TF::EOL,
            TF::GREEN . "Only works on " . TF::BOLD . TF::RED . "Heroic " . TF::RESET . TF::GREEN . "Enchants",
            TF::EOL,
            TF::GRAY . "(Drag-n-drop on Enchant)"
        ];
        $item->setLore($lore);
        $item->getNamedTag()->setString("RandomisationScroll", "heroic");
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }
}