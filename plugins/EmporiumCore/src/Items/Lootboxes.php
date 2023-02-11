<?php

namespace Items;

use Emporium\Prison\Managers\misc\GlowManager;

use pocketmine\item\Item;
use pocketmine\item\StringToItemParser;

use pocketmine\utils\TextFormat as TF;

class Lootboxes {

    public static function GKit(int $amount): Item {

        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::LIGHT_PURPLE . "GKit" . TF::WHITE . " Lootbox");
        $item->getNamedTag()->setByte("GKitLootbox", 1);
        $item->setCount($amount);
        $lore = [
            "",
            TF::BOLD . TF::WHITE . "Random Loot (" . TF::RESET . TF::GRAY . "3 Items" . TF::BOLD . TF::WHITE . ")",
            " * 1x Heroic Vulkarion",
            " * 1x Heroic Zenith",
            " * 1x Heroic Colossus",
            " * 1x Heroic Warlock",
            " * 1x Heroic Slaughter",
            " * 1x Heroic Atheos",
            " * 1x Heroic Apetus",
            " * 1x Heroic Broteas",
            " * 1x Heroic Ares",
            " * 1x Heroic Grim Reaper",
            " * 1x Heroic Executioner",
            " * 1x Blacksmith",
            " * 1x Hero",
            " * 1x Cyborg",
            " * 1x Crucible",
            " * 1x Hunter",
        ];
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);
        return $item;
    }

    public static function RankKit(int $amount): Item {

        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::LIGHT_PURPLE . "Rank Kit" . TF::WHITE . " Lootbox");
        $item->getNamedTag()->setByte("RankKitLootbox", 1);
        $item->setCount($amount);
        $lore = [
            "",
            TF::BOLD . TF::WHITE . "Random Loot (" . TF::RESET . TF::GRAY . "3 Items" . TF::BOLD . TF::WHITE . ")",
            " * 1x Noble Kit",
            " * 1x Imperial Kit",
            " * 1x Supreme Kit",
            " * 1x Majesty Kit",
            " * 1x Emperor Kit",
            " * 1x President Kit",
        ];
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);
        return $item;
    }

    public static function PrestigeKit(int $amount): Item {

        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::LIGHT_PURPLE . "Prestige Kit" . TF::WHITE . " Lootbox");
        $item->getNamedTag()->setByte("PrestigeKitLootbox", 1);
        $item->setCount($amount);
        $lore = [
            "",
            TF::BOLD . TF::WHITE . "Random Loot (" . TF::RESET . TF::GRAY . "3 Items" . TF::BOLD . TF::WHITE . ")",
            " * 1x Prestige 1",
            " * 1x Prestige 2",
            " * 1x Prestige 3",
            " * 1x Prestige 4",
            " * 1x Prestige 5"
        ];
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);
        return $item;
    }
}