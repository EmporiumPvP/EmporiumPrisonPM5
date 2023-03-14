<?php

namespace Emporium\Prison\Menus;

use Emporium\Prison\library\formapi\SimpleForm;

use Emporium\Prison\Managers\DataManager;
use Emporium\Prison\Managers\misc\Translator;

use EmporiumCore\Variables;

use muqsit\invmenu\InvMenu;
use muqsit\invmenu\transaction\DeterministicInvMenuTransaction;
use muqsit\invmenu\type\InvMenuTypeIds;

use pocketmine\item\Item;
use pocketmine\item\ItemIds;
use pocketmine\item\StringToItemParser;

use pocketmine\player\Player;

use pocketmine\utils\TextFormat as TF;

use pocketmine\world\sound\ItemFrameAddItemSound;
use pocketmine\world\sound\XpCollectSound;

use Tetro\EPTutorial\Managers\TutorialManager;

class OreExchanger {

    private array $sellables = [
        16, 173, 263, # coal
        15, 42, 265, # iron
        21, 22, 351, # lapis
        73, 152, 331, # redstone
        14, 41, 266, # gold
        56, 57, 264, # diamond
        129, 133, 388 # emerald
    ];

    public function Form($player): void {

        $form = new SimpleForm(function($player, $data) {
            if($data === null) {
                return;
            }
            $tutorialManager = new TutorialManager();
            $sellprice = 0;
            switch($data) {

                case 0: # sell ores
                    break;

                case 1: # exit
                    break;
            }
        });
        $form->setTitle(TF::BOLD . "Ore Exchanger");
        $form->addButton(TF::BOLD . "Sell Ores");
        $form->addButton(TF::BOLD . "Exit");

        $player->sendForm($form);
    }

    public function Menu(Player $player): void {
        $tutorialManager = new TutorialManager();

        $menu = InvMenu::create(InvMenuTypeIds::TYPE_CHEST);
        $menu->setName(TF::BOLD . "Ore Exchanger");
        $menu->setListener(InvMenu::readonly(function(DeterministicInvMenuTransaction $transaction) use ($tutorialManager): void {

            $player = $transaction->getPlayer();
            $itemClicked = $transaction->getItemClicked();
            $sellprice = 0;

            $inventory = $player->getInventory()->getContents();
            foreach ($inventory as $item) {
                if(in_array($item->getId(), $this->sellables)) {
                    switch($itemClicked->getId()) {

                        case ItemIds::COAL_ORE:
                            $count = $item->getCount();
                            $sellprice = $sellprice + (0.06 * $count);
                            break;
                        case ItemIds::COAL:
                            $count = $item->getCount();
                            $sellprice = $sellprice + (0.32 * $count);
                            break;
                        case ItemIds::COAL_BLOCK:
                            $count = $item->getCount();
                            $sellprice = $sellprice + (1.21 * $count);
                            break;

                        case ItemIds::IRON_ORE:
                            $count = $item->getCount();
                            $sellprice = $sellprice + (0.20 * $count);
                            break;
                        case ItemIds::IRON_INGOT:
                            $count = $item->getCount();
                            $sellprice = $sellprice + (1.02 * $count);
                            break;
                        case ItemIds::IRON_BLOCK:
                            $count = $item->getCount();
                            $sellprice = $sellprice + (4.08 * $count);
                            break;

                        case ItemIds::LAPIS_ORE:
                            $count = $item->getCount();
                            $sellprice = $sellprice + (0.52 * $count);
                            break;
                        case ItemIds::DYE:
                            $count = $item->getCount();
                            $sellprice = $sellprice + (2.70 * $count);
                            break;
                        case ItemIds::LAPIS_BLOCK:
                            $count = $item->getCount();
                            $sellprice = $sellprice + (10.80 * $count);
                            break;

                        case ItemIds::REDSTONE_ORE:
                            $count = $item->getCount();
                            $sellprice = $sellprice + (1.57 * $count);
                            break;
                        case ItemIds::REDSTONE_DUST:
                            $count = $item->getCount();
                            $sellprice = $sellprice + (8.29 * $count);
                            break;
                        case ItemIds::REDSTONE_BLOCK:
                            $count = $item->getCount();
                            $sellprice = $sellprice + (33.16 * $count);
                            break;

                        case ItemIds::GOLD_ORE:
                            $count = $item->getCount();
                            $sellprice = $sellprice + (4.86 * $count);
                            break;
                        case ItemIds::GOLD_INGOT:
                            $count = $item->getCount();
                            $sellprice = $sellprice + (25.76 * $count);
                            break;
                        case ItemIds::GOLD_BLOCK:
                            $count = $item->getCount();
                            $sellprice = $sellprice + (103.04 * $count);
                            break;

                        case ItemIds::DIAMOND_ORE:
                            $count = $item->getCount();
                            $sellprice = $sellprice + (7.34 * $count);
                            break;
                        case ItemIds::DIAMOND:
                            $count = $item->getCount();
                            $sellprice = $sellprice + (38.85 * $count);
                            break;
                        case ItemIds::DIAMOND_BLOCK:
                            $count = $item->getCount();
                            $sellprice = $sellprice + (155.40 * $count);
                            break;

                        case ItemIds::EMERALD_ORE:
                            $count = $item->getCount();
                            $sellprice = $sellprice + (27.35 * $count);
                            break;
                        case ItemIds::EMERALD:
                            $count = $item->getCount();
                            $sellprice = $sellprice + (144.92 * $count);
                            break;
                        case ItemIds::EMERALD_BLOCK:
                            $count = $item->getCount();
                            $sellprice = $sellprice + (579.68 * $count);
                            break;
                    }
                    $player->getInventory()->remove($item);
                }
            }

            # sell messages
            if ($sellprice === 0) {
                $player->sendMessage(TF::BOLD . TF::YELLOW . "Ore Exchanger" . TF::RESET . TF::GRAY . "You do not have any sellable items in your inventory.");
                $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
            } else {
                \EmporiumCore\managers\data\DataManager::addData($player, "Players", "Money", $sellprice);
                $player->sendMessage(TF::BOLD . TF::YELLOW . "Ore Exchanger" . TF::RESET . TF::GRAY . "You have sold your inventory for " . TF::GREEN . "$" . TF::WHITE . Translator::shortNumber($sellprice));
                $player->broadcastSound(new XpCollectSound(), [$player]);
            }
            # check tutorial stage
            $tutorialProgress = $tutorialManager->getPlayerTutorialProgress($player);
            if($tutorialProgress == 2) {
                # update player tutorial progression
                DataManager::addData($player, "Players", "tutorial-progress", 1);
                # start next tutorial stage
                $tutorialManager->startTutorial($player);
            }

        }));
        $inventory = $menu->getInventory();
        # coal
        $inventory->setItem(1, self::coalOre());
        $inventory->setItem(10, self::coal());
        $inventory->setItem(19, self::coalBlock());
        # iron
        $inventory->setItem(2, self::ironOre());
        $inventory->setItem(11, self::iron());
        $inventory->setItem(20, self::ironBlock());
        # lapis
        $inventory->setItem(3, self::lapisOre());
        $inventory->setItem(12, self::lapis());
        $inventory->setItem(21, self::lapisBlock());
        # redstone
        $inventory->setItem(4, self::redstoneOre());
        $inventory->setItem(13, self::redstone());
        $inventory->setItem(22, self::redstoneBlock());
        # gold
        $inventory->setItem(5, self::goldOre());
        $inventory->setItem(14, self::gold());
        $inventory->setItem(23, self::goldBlock());
        # diamond
        $inventory->setItem(6, self::diamondOre());
        $inventory->setItem(15, self::diamond());
        $inventory->setItem(24, self::diamondBlock());
        # emerald
        $inventory->setItem(7, self::emeraldOre());
        $inventory->setItem(16, self::emerald());
        $inventory->setItem(25, self::emeraldBlock());

        $menu->send($player);
    }

    # coal
    public function coalOre(): Item {

        $item = StringToItemParser::getInstance()->parse("coal_ore");
        $item->setCustomName(TF::BOLD . TF::AQUA . "Coal Ore");
        $lore = [
            "§r",
            TF::GREEN . "$0.06",
            "§r",
            TF::GRAY . "Click to sell ALL you have",
            TF::GRAY . "of this item to the Exchanger"
        ];
        $item->setLore($lore);

        return $item;
    }
    public function coal(): Item {

        $item = StringToItemParser::getInstance()->parse("coal");
        $item->setCustomName(TF::BOLD . TF::AQUA . "Coal");
        $lore = [
            "§r",
            TF::GREEN . "$0.32",
            "§r",
            TF::GRAY . "Click to sell ALL you have",
            TF::GRAY . "of this item to the Exchanger"
        ];
        $item->setLore($lore);

        return $item;
    }
    public function coalBlock(): Item {

        $item = StringToItemParser::getInstance()->parse("coal_block");
        $item->setCustomName(TF::BOLD . TF::AQUA . "Coal Block");
        $lore = [
            "§r",
            TF::GREEN . "$1.21",
            "§r",
            TF::GRAY . "Click to sell ALL you have",
            TF::GRAY . "of this item to the Exchanger"
        ];
        $item->setLore($lore);

        return $item;
    }
    # iron
    public function ironOre(): Item {

        $item = StringToItemParser::getInstance()->parse("iron_ore");
        $item->setCustomName(TF::BOLD . TF::AQUA . "Iron Ore");
        $lore = [
            "§r",
            TF::GREEN . "$0.20",
            "§r",
            TF::GRAY . "Click to sell ALL you have",
            TF::GRAY . "of this item to the Exchanger"
        ];
        $item->setLore($lore);

        return $item;
    }
    public function iron(): Item {

        $item = StringToItemParser::getInstance()->parse("iron_ingot");
        $item->setCustomName(TF::BOLD . TF::AQUA . "Iron");
        $lore = [
            "§r",
            TF::GREEN . "$1.02",
            "§r",
            TF::GRAY . "Click to sell ALL you have",
            TF::GRAY . "of this item to the Exchanger"
        ];
        $item->setLore($lore);

        return $item;
    }
    public function ironBlock(): Item {

        $item = StringToItemParser::getInstance()->parse("iron_block");
        $item->setCustomName(TF::BOLD . TF::AQUA . "Iron Block");
        $lore = [
            "§r",
            TF::GREEN . "$4.08",
            "§r",
            TF::GRAY . "Click to sell ALL you have",
            TF::GRAY . "of this item to the Exchanger"
        ];
        $item->setLore($lore);

        return $item;
    }
    # lapis
    public function lapisOre(): Item {

        $item = StringToItemParser::getInstance()->parse("lapis_ore");
        $item->setCustomName(TF::BOLD . TF::AQUA . "Lapis Ore");
        $lore = [
            "§r",
            TF::GREEN . "$0.52",
            "§r",
            TF::GRAY . "Click to sell ALL you have",
            TF::GRAY . "of this item to the Exchanger"
        ];
        $item->setLore($lore);

        return $item;
    }
    public function lapis(): Item {

        $item = StringToItemParser::getInstance()->parse("lapis_lazuli");
        $item->setCustomName(TF::BOLD . TF::AQUA . "Lapis");
        $lore = [
            "§r",
            TF::GREEN . "$2.70",
            "§r",
            TF::GRAY . "Click to sell ALL you have",
            TF::GRAY . "of this item to the Exchanger"
        ];
        $item->setLore($lore);

        return $item;
    }
    public function lapisBlock(): Item {

        $item = StringToItemParser::getInstance()->parse("lapis_block");
        $item->setCustomName(TF::BOLD . TF::AQUA . "Lapis Block");
        $lore = [
            "§r",
            TF::GREEN . "10.80",
            "§r",
            TF::GRAY . "Click to sell ALL you have",
            TF::GRAY . "of this item to the Exchanger"
        ];
        $item->setLore($lore);

        return $item;
    }
    # redstone
    public function redstoneOre(): Item {

        $item = StringToItemParser::getInstance()->parse("redstone_ore");
        $item->setCustomName(TF::BOLD . TF::AQUA . "Redstone Ore");
        $lore = [
            "§r",
            TF::GREEN . "$1.57",
            "§r",
            TF::GRAY . "Click to sell ALL you have",
            TF::GRAY . "of this item to the Exchanger"
        ];
        $item->setLore($lore);

        return $item;
    }
    public function redstone(): Item {

        $item = StringToItemParser::getInstance()->parse("redstone");
        $item->setCustomName(TF::BOLD . TF::AQUA . "Redstone");
        $lore = [
            "§r",
            TF::GREEN . "$8.29",
            "§r",
            TF::GRAY . "Click to sell ALL you have",
            TF::GRAY . "of this item to the Exchanger"
        ];
        $item->setLore($lore);

        return $item;
    }
    public function redstoneBlock(): Item {

        $item = StringToItemParser::getInstance()->parse("redstone_block");
        $item->setCustomName(TF::BOLD . TF::AQUA . "Redstone Block");
        $lore = [
            "§r",
            TF::GREEN . "33.16",
            "§r",
            TF::GRAY . "Click to sell ALL you have",
            TF::GRAY . "of this item to the Exchanger"
        ];
        $item->setLore($lore);

        return $item;
    }
    # gold
    public function goldOre(): Item {

        $item = StringToItemParser::getInstance()->parse("gold_ore");
        $item->setCustomName(TF::BOLD . TF::AQUA . "Gold Ore");
        $lore = [
            "§r",
            TF::GREEN . "$4.86",
            "§r",
            TF::GRAY . "Click to sell ALL you have",
            TF::GRAY . "of this item to the Exchanger"
        ];
        $item->setLore($lore);

        return $item;
    }
    public function gold(): Item {

        $item = StringToItemParser::getInstance()->parse("gold_ingot");
        $item->setCustomName(TF::BOLD . TF::AQUA . "Gold");
        $lore = [
            "§r",
            TF::GREEN . "25.76",
            "§r",
            TF::GRAY . "Click to sell ALL you have",
            TF::GRAY . "of this item to the Exchanger"
        ];
        $item->setLore($lore);

        return $item;
    }
    public function goldBlock(): Item {

        $item = StringToItemParser::getInstance()->parse("gold_block");
        $item->setCustomName(TF::BOLD . TF::AQUA . "Gold Block");
        $lore = [
            "§r",
            TF::GREEN . "103.04",
            "§r",
            TF::GRAY . "Click to sell ALL you have",
            TF::GRAY . "of this item to the Exchanger"
        ];
        $item->setLore($lore);

        return $item;
    }
    # diamond
    public function diamondOre(): Item {

        $item = StringToItemParser::getInstance()->parse("diamond_ore");
        $item->setCustomName(TF::BOLD . TF::AQUA . "Diamond Ore");
        $lore = [
            "§r",
            TF::GREEN . "$7.34",
            "§r",
            TF::GRAY . "Click to sell ALL you have",
            TF::GRAY . "of this item to the Exchanger"
        ];
        $item->setLore($lore);

        return $item;
    }
    public function diamond(): Item {

        $item = StringToItemParser::getInstance()->parse("diamond");
        $item->setCustomName(TF::BOLD . TF::AQUA . "Diamond");
        $lore = [
            "§r",
            TF::GREEN . "38.85",
            "§r",
            TF::GRAY . "Click to sell ALL you have",
            TF::GRAY . "of this item to the Exchanger"
        ];
        $item->setLore($lore);

        return $item;
    }
    public function diamondBlock(): Item {

        $item = StringToItemParser::getInstance()->parse("diamond_block");
        $item->setCustomName(TF::BOLD . TF::AQUA . "Diamond Block");
        $lore = [
            "§r",
            TF::GREEN . "155.40",
            "§r",
            TF::GRAY . "Click to sell ALL you have",
            TF::GRAY . "of this item to the Exchanger"
        ];
        $item->setLore($lore);

        return $item;
    }
    # emerald
    public function emeraldOre(): Item {

        $item = StringToItemParser::getInstance()->parse("emerald_ore");
        $item->setCustomName(TF::BOLD . TF::AQUA . "Emerald Ore");
        $lore = [
            "§r",
            TF::GREEN . "27.35",
            "§r",
            TF::GRAY . "Click to sell ALL you have",
            TF::GRAY . "of this item to the Exchanger"
        ];
        $item->setLore($lore);

        return $item;
    }
    public function emerald(): Item {

        $item = StringToItemParser::getInstance()->parse("emerald");
        $item->setCustomName(TF::BOLD . TF::AQUA . "Emerald");
        $lore = [
            "§r",
            TF::GREEN . "144.92",
            "§r",
            TF::GRAY . "Click to sell ALL you have",
            TF::GRAY . "of this item to the Exchanger"
        ];
        $item->setLore($lore);

        return $item;
    }
    public function emeraldBlock(): Item {

        $item = StringToItemParser::getInstance()->parse("emerald_block");
        $item->setCustomName(TF::BOLD . TF::AQUA . "Emerald Block");
        $lore = [
            "§r",
            TF::GREEN . "579.68",
            "§r",
            TF::GRAY . "Click to sell ALL you have",
            TF::GRAY . "of this item to the Exchanger"
        ];
        $item->setLore($lore);

        return $item;
    }
}