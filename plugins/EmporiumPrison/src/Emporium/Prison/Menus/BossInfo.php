<?php

namespace Emporium\Prison\Menus;

use BlockHorizons\InvSee\libs\muqsit\invmenu\type\InvMenuTypeIds;

use customiesdevs\customies\item\CustomiesItemFactory;
use Emporium\Prison\Managers\misc\Utils;
use muqsit\invmenu\InvMenu;
use muqsit\invmenu\transaction\DeterministicInvMenuTransaction;

use pocketmine\block\Block;
use pocketmine\block\BlockTypeIds;
use pocketmine\block\utils\MobHeadType;
use pocketmine\block\VanillaBlocks;
use pocketmine\item\Item;
use pocketmine\item\VanillaItems;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;

class BossInfo
{
    public function Menu(Player $player): void {
        $menu = InvMenu::create(InvMenuTypeIds::TYPE_CHEST);
        $menu->setName("Boss Info");
        $menu->setListener(InvMenu::readonly(function(DeterministicInvMenuTransaction $transaction) {

        }));
        $inventory = $menu->getInventory();

        $inventory->setItem(Utils::getNextCenteredSlot($inventory), $this->kingSlimeItem());
        $inventory->setItem(Utils::getNextCenteredSlot($inventory), $this->golemItem());
        $inventory->setItem(Utils::getNextCenteredSlot($inventory), $this->verdaiItem());
        $inventory->setItem(Utils::getNextCenteredSlot($inventory), $this->blazeItem());

        for($i = 0; $i <= 26; $i++) {
            if($inventory->isSlotEmpty($i)) {
                $inventory->setItem($i, $this->filler());
            }
        }
        $menu->send($player);
    }

    private function filler(): Item
    {
        $item = CustomiesItemFactory::getInstance()->get("2dglasspanes:pane_lightgrey");
        $item->setCustomName("§r");
        return $item;
    }

    private function golemItem(): Item {

        $item = VanillaBlocks::IRON()->asItem();
        $item->setCustomName(TF::BOLD . TF::RED . "Guardian Golem");
        $lore = [
            "",
            TF::GRAY . "The first prototype guard made",
            TF::GRAY . "by the Cosmonauts to automate",
            TF::GRAY . "prisons. Reports say this",
            TF::GRAY . "machine died centuries ago yet",
            TF::GRAY . "the rumors are growing with",
            TF::GRAY . "every passing day. It cant be",
            TF::GRAY . "ignored anymore..."
        ];
        $item->setLore($lore);

        return $item;
    }

    private function verdaiItem(): Item {

        $item = VanillaBlocks::MOB_HEAD()->setMobHeadType(MobHeadType::PLAYER())->asItem();
        $item->setCustomName(TF::BOLD . TF::GOLD . "Verdai, The Dark Architect");
        $lore = [
            "",
            TF::GRAY . "Forced to construct the prison",
            TF::GRAY . "from the planet itself, Verdai's",
            TF::GRAY . "mind ruptured under the strain.",
            TF::GRAY . "Once the creator of order.",
            TF::GRAY . "Now the harbinger of chaos."
        ];
        $item->setLore($lore);

        return $item;
    }

    private function kingSlimeItem(): Item {

        $item = VanillaBlocks::SLIME()->asItem();
        $item->setCustomName(TF::BOLD . TF::GREEN . "King Slime");
        $lore = [
            "",
            TF::GRAY . "An abandoned experiment that",
            TF::GRAY . "still haunts the Prison Guards",
            TF::GRAY . "to this day... the King Slime",
            TF::GRAY . "is not a challenge to be taken",
            TF::GRAY . "by inexperienced prisoners!"
        ];
        $item->setLore($lore);

        return $item;
    }

    private function blazeItem(): Item {

        $item = VanillaItems::BLAZE_POWDER();
        $item->setCustomName(TF::BOLD . TF::RED . "Prince Blaze");
        $lore = [
            "",
            TF::GRAY . "Master of fire, commander of",
            TF::GRAY . "demons; The prince Blazes name",
            TF::GRAY . "sends fear into the hearts of",
            TF::GRAY . "even the most veteran Prisoners!"
        ];
        $item->setLore($lore);

        return $item;
    }
}