<?php

namespace Emporium\Prison\items;

use Emporium\Prison\Managers\misc\GlowManager;
use pocketmine\item\Item;
use pocketmine\item\VanillaItems;
use pocketmine\utils\TextFormat as TF;

class Scrolls {

    public function whiteScroll(): Item {

        $item = VanillaItems::PAPER();
        $item->setCustomName(TF::BOLD . TF::WHITE . "White Scroll");
        $item->getNamedTag()->setString("Scroll", "WhiteScroll");
        $lore = [
            "§r",
            TF::WHITE . "When applied to gear:",
            TF::GRAY . "You keep the item on death but lose",
            TF::GRAY . "the energy on it.",
            "§r",
            TF::BOLD . TF::GRAY . "Note: " . TF::RESET . TF::GRAY . "White Scroll will get removed",
            TF::GRAY . "upon activation",
            "§r",
            TF::GRAY . "Hint: drag-and-drop on in your inventory",
            TF::GRAY . "onto the item you wish to apply it to."
        ];
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);
        return $item;
    }

    public function holyWhiteScroll(): Item {

        $item = VanillaItems::PAPER();
        $item->setCustomName(TF::BOLD . TF::GOLD . "Holy White Scroll");
        $item->getNamedTag()->setString("Scroll", "HolyWhiteScroll");
        $lore = [
            "§r",
            TF::WHITE . "When applied to gear:",
            TF::GRAY . "You keep the item on death and keep",
            TF::GRAY . "the energy on it.",
            "§r",
            TF::BOLD . TF::GRAY . "Note: Holy White Scroll will get removed",
            TF::GRAY . "upon activation",
            "§r",
            TF::GRAY . "Hint: drag-and-drop on in your inventory",
            TF::GRAY . "onto the item you wish to apply it to."
        ];
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);
        return $item;
    }
}