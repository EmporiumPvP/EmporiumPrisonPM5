<?php

namespace Tetro\EmporiumEnchants\Items;

use customiesdevs\customies\item\CustomiesItemFactory;
use Emporium\Prison\Managers\misc\GlowManager;
use pocketmine\item\Item;
use pocketmine\utils\TextFormat as TF;
use Tetro\EmporiumEnchants\Core\CustomEnchant;

class Pages {

    public function elitePage(int $boost): Item { # boost max = 15
        $rarity = CustomEnchant::RARITY_ELITE;
        $item = CustomiesItemFactory::getInstance()->get("emporiumenchants:elite_page");
        $item->setCustomName(TF::BOLD . TF::BLUE . "Elite Page " . TF::RESET . TF::GRAY . "(" . TF::GREEN . $boost . "%" . TF::GRAY . ")");
        $item->getNamedTag()->setInt("EnchantPage", $rarity);
        $item->getNamedTag()->setInt("Boost", $boost);
        $lore = [
            TF::EOL,
            TF::BOLD . TF::GREEN . "+$boost% " . TF::RESET . TF::GREEN . "Success rate",
            TF::BOLD . TF::RED . "-$boost% " . TF::RESET . TF::RED . "Fail rate",
            TF::EOL,
            TF::GRAY . "Hint: Drag-n-drop onto",
            TF::GRAY . "Enchantment books!"
        ];
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    public function ultimatePage(int $boost): Item { # boost max = 15
        $rarity = CustomEnchant::RARITY_ULTIMATE;
        $item = CustomiesItemFactory::getInstance()->get("emporiumenchants:ultimate_page");
        $item->setCustomName(TF::BOLD . TF::YELLOW . "Ultimate Page " . TF::RESET . TF::GRAY . "(" . TF::GREEN . $boost . "%" . TF::GRAY . ")");
        $item->getNamedTag()->setInt("EnchantPage", $rarity);
        $item->getNamedTag()->setInt("Boost", $boost);
        $lore = [
            TF::EOL,
            TF::BOLD . TF::GREEN . "+$boost% " . TF::RESET . TF::GREEN . "Success rate",
            TF::BOLD . TF::RED . "-$boost% " . TF::RESET . TF::RED . "Fail rate",
            TF::EOL,
            TF::GRAY . "Hint: Drag-n-drop onto",
            TF::GRAY . "Enchantment books!"
        ];
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    public function legendaryPage(int $boost): Item { # boost max = 15
        $rarity = CustomEnchant::RARITY_LEGENDARY;
        $item = CustomiesItemFactory::getInstance()->get("emporiumenchants:legendary_page");
        $item->setCustomName(TF::BOLD . TF::GOLD . "Legendary Page " . TF::RESET . TF::GRAY . "(" . TF::GREEN . $boost . "%" . TF::GRAY . ")");
        $item->getNamedTag()->setInt("EnchantPage", $rarity);
        $item->getNamedTag()->setInt("Boost", $boost);
        $lore = [
            TF::EOL,
            TF::BOLD . TF::GREEN . "+$boost% " . TF::RESET . TF::GREEN . "Success rate",
            TF::BOLD . TF::RED . "-$boost% " . TF::RESET . TF::RED . "Fail rate",
            TF::EOL,
            TF::GRAY . "Hint: Drag-n-drop onto",
            TF::GRAY . "Enchantment books!"
        ];
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    public function godlyPage(int $boost): Item { # boost max = 15
        $rarity = CustomEnchant::RARITY_GODLY;
        $item = CustomiesItemFactory::getInstance()->get("emporiumenchants:godly_page");
        $item->setCustomName(TF::BOLD . TF::LIGHT_PURPLE . "Godly Page " . TF::RESET . TF::GRAY . "(" . TF::GREEN . $boost . "%" . TF::GRAY . ")");
        $item->getNamedTag()->setInt("EnchantPage", $rarity);
        $item->getNamedTag()->setInt("Boost", $boost);
        $lore = [
            TF::EOL,
            TF::BOLD . TF::GREEN . "+$boost% " . TF::RESET . TF::GREEN . "Success rate",
            TF::BOLD . TF::RED . "-$boost% " . TF::RESET . TF::RED . "Fail rate",
            TF::EOL,
            TF::GRAY . "Hint: Drag-n-drop onto",
            TF::GRAY . "Enchantment books!"
        ];
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    public function heroicPage(int $boost): Item { # boost max = 15
        $rarity = CustomEnchant::RARITY_HEROIC;
        $item = CustomiesItemFactory::getInstance()->get("emporiumenchants:heroic_page");
        $item->setCustomName(TF::BOLD . TF::RED . "Heroic Page " . TF::RESET . TF::GRAY . "(" . TF::GREEN . $boost . "%" . TF::GRAY . ")");
        $item->getNamedTag()->setInt("EnchantPage", $rarity);
        $item->getNamedTag()->setInt("Boost", $boost);
        $lore = [
            TF::EOL,
            TF::BOLD . TF::GREEN . "+$boost% " . TF::RESET . TF::GREEN . "Success rate",
            TF::BOLD . TF::RED . "-$boost% " . TF::RESET . TF::RED . "Fail rate",
            TF::EOL,
            TF::GRAY . "Hint: Drag-n-drop onto",
            TF::GRAY . "Enchantment books!"
        ];
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    public function executivePage(int $boost): Item { # boost max = 15
        $rarity = CustomEnchant::RARITY_EXECUTIVE;
        $item = CustomiesItemFactory::getInstance()->get("emporiumenchants:executive_page");
        $item->setCustomName(TF::BOLD . TF::BLACK . "Executive Page " . TF::RESET . TF::GRAY . "(" . TF::GREEN . $boost . "%" . TF::GRAY . ")");
        $item->getNamedTag()->setInt("EnchantPage", $rarity);
        $item->getNamedTag()->setInt("Boost", $boost);
        $lore = [
            TF::EOL,
            TF::BOLD . TF::GREEN . "+$boost% " . TF::RESET . TF::GREEN . "Success rate",
            TF::BOLD . TF::RED . "-$boost% " . TF::RESET . TF::RED . "Fail rate",
            TF::EOL,
            TF::GRAY . "Hint: Drag-n-drop onto",
            TF::GRAY . "Enchantment books!"
        ];
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }
}