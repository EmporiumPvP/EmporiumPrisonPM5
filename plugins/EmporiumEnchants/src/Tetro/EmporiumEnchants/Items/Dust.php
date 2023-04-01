<?php

namespace Tetro\EmporiumEnchants\Items;

use Emporium\Prison\Managers\misc\GlowManager;
use pocketmine\item\Item;
use pocketmine\item\VanillaItems;
use pocketmine\utils\TextFormat as TF;
use Tetro\EmporiumEnchants\Core\CustomEnchant;

class Dust {

    public function eliteDust(int $boost): Item {
        $item = VanillaItems::GLOWSTONE_DUST();
        $item->setCustomName(TF::BOLD . TF::BLUE . "Elite Dust " . TF::RESET . TF::GRAY . "(" . TF::GREEN . $boost . "%" . TF::GRAY . ")");
        $rarity = CustomEnchant::RARITY_ELITE;
        $item->getNamedTag()->setInt("EnchantDust", $rarity);
        $item->getNamedTag()->setInt("Rarity", $rarity);
        $item->getNamedTag()->setInt("Boost", $boost);
        $lore = [
            TF::EOL,
            TF::BOLD . TF::GREEN . "+$boost%" . TF::RESET . TF::LIGHT_PURPLE . "boost to Pickaxe Enchant Orbs,",
            TF::LIGHT_PURPLE . "and the Wormhole",
            TF::BOLD . TF::GRAY . "(ADDITIVE)",
            TF::EOL,
            TF::GRAY . "Pickaxe Enchant Orbs: Drag-n-drop",
            TF::GRAY . "Wormhole:: Drop into portal"
        ];
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    public function ultimateDust(int $boost): Item {
        $item = VanillaItems::GLOWSTONE_DUST();
        $item->setCustomName(TF::BOLD . TF::YELLOW . "Ultimate Dust " . TF::RESET . TF::GRAY . "(" . TF::GREEN . $boost . "%" . TF::GRAY . ")");
        $rarity = CustomEnchant::RARITY_ULTIMATE;
        $item->getNamedTag()->setInt("EnchantDust", $rarity);
        $item->getNamedTag()->setInt("Rarity", $rarity);
        $item->getNamedTag()->setInt("Boost", $boost);
        $lore = [
            TF::EOL,
            TF::BOLD . TF::GREEN . "+$boost%" . TF::RESET . TF::LIGHT_PURPLE . "boost to Pickaxe Enchant Orbs,",
            TF::LIGHT_PURPLE . "and the Wormhole",
            TF::BOLD . TF::GRAY . "(ADDITIVE)",
            TF::EOL,
            TF::GRAY . "Pickaxe Enchant Orbs: Drag-n-drop",
            TF::GRAY . "Wormhole: Drop into portal"
        ];
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    public function legendaryDust(int $boost): Item {
        $item = VanillaItems::GLOWSTONE_DUST();
        $item->setCustomName(TF::BOLD . TF::GOLD . "Legendary Dust " . TF::RESET . TF::GRAY . "(" . TF::GREEN . $boost . "%" . TF::GRAY . ")");
        $rarity = CustomEnchant::RARITY_LEGENDARY;
        $item->getNamedTag()->setInt("EnchantDust", $rarity);
        $item->getNamedTag()->setInt("Rarity", $rarity);
        $item->getNamedTag()->setInt("Boost", $boost);
        $lore = [
            TF::EOL,
            TF::BOLD . TF::GREEN . "+$boost%" . TF::RESET . TF::LIGHT_PURPLE . "boost to Pickaxe Enchant Orbs,",
            TF::LIGHT_PURPLE . "and the Wormhole",
            TF::BOLD . TF::GRAY . "(ADDITIVE)",
            TF::EOL,
            TF::GRAY . "Pickaxe Enchant Orbs: Drag-n-drop",
            TF::GRAY . "Wormhole: Drop into portal"
        ];
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    public function godlyDust(int $boost): Item {
        $item = VanillaItems::GLOWSTONE_DUST();
        $item->setCustomName(TF::BOLD . TF::LIGHT_PURPLE . "Godly Dust " . TF::RESET . TF::GRAY . "(" . TF::GREEN . $boost . "%" . TF::GRAY . ")");
        $rarity = CustomEnchant::RARITY_GODLY;
        $item->getNamedTag()->setInt("EnchantDust", $rarity);
        $item->getNamedTag()->setInt("Rarity", $rarity);
        $item->getNamedTag()->setInt("Boost", $boost);
        $lore = [
            TF::EOL,
            TF::BOLD . TF::GREEN . "+$boost%" . TF::RESET . TF::LIGHT_PURPLE . "boost to Pickaxe Enchant Orbs,",
            TF::LIGHT_PURPLE . "and the Wormhole",
            TF::BOLD . TF::GRAY . "(ADDITIVE)",
            TF::EOL,
            TF::GRAY . "Pickaxe Enchant Orbs: Drag-n-drop",
            TF::GRAY . "Wormhole: Drop into portal"
        ];
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    public function heroicDust(int $boost): Item {
        $item = VanillaItems::GLOWSTONE_DUST();
        $item->setCustomName(TF::BOLD . TF::RED . "Heroic Dust " . TF::RESET . TF::GRAY . "(" . TF::GREEN . $boost . "%" . TF::GRAY . ")");
        $rarity = CustomEnchant::RARITY_HEROIC;
        $item->getNamedTag()->setInt("EnchantDust", $rarity);
        $item->getNamedTag()->setInt("Rarity", $rarity);
        $item->getNamedTag()->setInt("Boost", $boost);
        $lore = [
            TF::EOL,
            TF::BOLD . TF::GREEN . "+$boost%" . TF::RESET . TF::LIGHT_PURPLE . "boost to Pickaxe Enchant Orbs,",
            TF::LIGHT_PURPLE . "and the Wormhole",
            TF::BOLD . TF::GRAY . "(ADDITIVE)",
            TF::EOL,
            TF::GRAY . "Pickaxe Enchant Orbs: Drag-n-drop",
            TF::GRAY . "Wormhole: Drop into portal"
        ];
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }
}