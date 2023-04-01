<?php

namespace Items;

use Emporium\Prison\Managers\misc\GlowManager;
use pocketmine\item\Item;
use pocketmine\item\StringToItemParser;
use pocketmine\utils\TextFormat as TF;

class Lootboxes {

    public function MysteryGKit(int $amount): Item {

        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::LIGHT_PURPLE . "Mystery GKit" . TF::WHITE . " Lootbox");
        $item->getNamedTag()->setByte("GKitLootbox", 1);
        $item->setCount($amount);
        $lore = [
            "",
            TF::BOLD . TF::WHITE . "Random Loot (" . TF::RESET . TF::GRAY . "3 Blackscroll" . TF::BOLD . TF::WHITE . ")",
            " * 1x Heroic Vulkarion",
            " * 1x Heroic Zenith",
            " * 1x Heroic Colossus",
            " * 1x Heroic Warlock",
            " * 1x Heroic Slaughter",
            " * 1x Heroic Enchanter",
            " * 1x Heroic Atheos",
            " * 1x Heroic Apetus",
            " * 1x Heroic Broteas",
            " * 1x Heroic Ares",
            " * 1x Heroic Grim Reaper",
            " * 1x Heroic Executioner",
            " * 1x Hero",
            " * 1x Cyborg",
            " * 1x Crucible",
            " * 1x Hunter",
        ];
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);
        return $item;
    }

    public function LegendaryMysteryGKit(int $amount): Item {

        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::LIGHT_PURPLE . "Legendary Mystery GKit" . TF::WHITE . " Lootbox");
        $item->getNamedTag()->setByte("LegendaryGKitLootbox", 1);
        $item->setCount($amount);
        $lore = [
            "",
            TF::BOLD . TF::WHITE . "Random Loot (" . TF::RESET . TF::GRAY . "3 Blackscroll" . TF::BOLD . TF::WHITE . ")",
            " * 1x Heroic Vulkarion",
            " * 1x Heroic Zenith",
            " * 1x Heroic Colossus",
            " * 1x Heroic Warlock",
            " * 1x Heroic Slaughter",
            " * 1x Heroic Enchanter",
            " * 1x Heroic Atheos",
            " * 1x Heroic Apetus",
            " * 1x Heroic Broteas",
            " * 1x Heroic Ares",
            " * 1x Heroic Grim Reaper",
            " * 1x Heroic Executioner",
            " * 1x Hero",
            " * 1x Cyborg",
            " * 1x Crucible",
            " * 1x Hunter",
        ];
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);
        return $item;
    }

    public function MysteryRankKit(int $amount): Item {

        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::LIGHT_PURPLE . "MysteryRank Kit" . TF::WHITE . " Lootbox");
        $item->getNamedTag()->setByte("MysteryRankKitLootbox", 1);
        $item->setCount($amount);
        $lore = [
            "",
            TF::BOLD . TF::WHITE . "Random Loot (" . TF::RESET . TF::GRAY . "1 Item" . TF::BOLD . TF::WHITE . ")",
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

    public function PrestigeKit(int $amount): Item {

        $item = StringToItemParser::getInstance()->parse("ender_chest");
        $item->setCustomName(TF::LIGHT_PURPLE . "Prestige Kit" . TF::WHITE . " Lootbox");
        $item->getNamedTag()->setByte("PrestigeKitLootbox", 1);
        $item->setCount($amount);
        $lore = [
            "",
            TF::BOLD . TF::WHITE . "Random Loot (" . TF::RESET . TF::GRAY . "1 Item" . TF::BOLD . TF::WHITE . ")",
            " * 1x Prestige 1",
            " * 1x Prestige 2",
            " * 1x Prestige 3",
            " * 1x Prestige 4",
            " * 1x Prestige 5",
            " * 1x Prestige 6"
        ];
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);
        return $item;
    }
}