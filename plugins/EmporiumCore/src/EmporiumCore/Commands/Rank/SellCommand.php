<?php

namespace EmporiumCore\Commands\Rank;

use Emporium\Prison\Managers\misc\Translator;

use EmporiumCore\Variables;

use EmporiumData\DataManager;
use EmporiumData\PermissionsManager;

use pocketmine\command\{Command, CommandSender};

use pocketmine\block\Coal;
use pocketmine\block\CoalOre;
use pocketmine\block\IronOre;
use pocketmine\block\LapisOre;
use pocketmine\block\utils\DyeColor;
use pocketmine\block\VanillaBlocks;

use pocketmine\item\VanillaItems;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;

class SellCommand extends Command {

    private array $sellables = [
        16, 173, 263, # coal
        15, 42, 265, # iron
        21, 22, 351, # lapis
        73, 152, 331, # redstone
        14, 41, 266, # gold
        56, 57, 264, # diamond
        129, 133, 388 # emerald
    ];

    public function __construct() {
        parent::__construct("sell", "Sell your items.", "/sell <hand/inv>");
        $this->setPermission("emporiumcore.command.sell");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {

        if (!$sender instanceof Player) return false;

        $permission = PermissionsManager::getInstance()->checkPermission($sender->getXuid(), $this->getPermissions());
        if (!$permission) {
            $sender->sendMessage(\Emporium\Prison\Variables::NO_PERMISSION_MESSAGE);
            return false;
        }

        if(!isset($args[0])) {
            $sender->sendMessage(\Emporium\Prison\Variables::PREFIX . "Usage: " . $this->getUsage());
            return false;
        }

        if (strtolower($args[0]) === "hand") {
            $item = $sender->getInventory()->getItemInHand();
            $count = $item->getCount();
            $sellprice = 0;
            # coal ore
            if ($item instanceof CoalOre) {
                $count = $item->get;
                $sellprice = $sellprice + (0.06 * $count);
                $sender->getInventory()->remove($item);
            }
            # coal block
            if ($item instanceof Coal) {
                $count = $item->asItem()->getCount();
                $sellprice = $sellprice + (0.32 * $count);
                $sender->getInventory()->remove($item);
            }
            # coal
            if ($item instanceof \pocketmine\item\Coal) {
                $count = $item->getCount();
                $sellprice = $sellprice + (1.21 * $count);
                $sender->getInventory()->remove($item);
            }

            # iron ore
            if ($item instanceof IronOre) {
                $count = $item->asItem()->getCount();
                $sellprice = $sellprice + (0.20 * $count);
                $sender->getInventory()->remove($item);
            }
            # iron ingot
            if ($item->getTypeId() == VanillaItems::IRON_INGOT()->getTypeId()) {
                $count = $item->getCount();
                $sellprice = $sellprice + (1.02 * $count);
                $sender->getInventory()->remove($item);
            }
            # iron block
            if ($item === VanillaBlocks::IRON()) {
                $count = $item->getCount();
                $sellprice = $sellprice + (4.08 * $count);
                $sender->getInventory()->remove($item);
            }

            # lapis ore
            if ($item instanceof LapisOre) {
                $count = $item->asItem()->getCount();
                $sellprice = $sellprice + (0.52 * $count);
                $sender->getInventory()->remove($item);
            }
            # lapis
            if ($item === VanillaItems::DYE() && $item->getColor() === DyeColor::BLUE()) {
                $count = $item->getCount();
                $sellprice = $sellprice + (2.70 * $count);
                $sender->getInventory()->remove($item);
            }
            # lapis block
            if ($item === VanillaBlocks::LAPIS_LAZULI()) {
                $count = $item->getCount();
                $sellprice = $sellprice + (10.80 * $count);
                $sender->getInventory()->remove($item);
            }

            # redstone ore
            if ($item === VanillaBlocks::REDSTONE_ORE()) {
                $count = $item->getCount();
                $sellprice = $sellprice + (1.57 * $count);
                $sender->getInventory()->remove($item);
            }
            # redstone
            if ($item->getTypeId() === VanillaItems::REDSTONE_DUST()->getTypeId()) {
                $count = $item->getCount();
                $sellprice = $sellprice + (8.29 * $count);
                $sender->getInventory()->remove($item);
            }
            # redstone block
            if ($item->getTypeId() === VanillaBlocks::REDSTONE()->getTypeId()) {
                $count = $item->getCount();
                $sellprice = $sellprice + (33.16 * $count);
                $sender->getInventory()->remove($item);
            }

            # gold ore
            if ($item === VanillaBlocks::GOLD_ORE()) {
                $count = $item->getCount();
                $sellprice = $sellprice + (4.86 * $count);
                $sender->getInventory()->remove($item);
            }
            # gold ingot
            if ($item === VanillaItems::GOLD_INGOT()) {
                $count = $item->getCount();
                $sellprice = $sellprice + (25.76 * $count);
            }
            # gold block
            if ($item === VanillaBlocks::GOLD()) {
                $count = $item->getCount();
                $sellprice = $sellprice + (103.04 * $count);
                $sender->getInventory()->remove($item);
            }

            # diamond ore
            if ($item === VanillaBlocks::DIAMOND_ORE()) {
                $count = $item->getCount();
                $sellprice = $sellprice + (7.34 * $count);
                $sender->getInventory()->remove($item);
            }
            # diamond
            if ($item === VanillaItems::DIAMOND()) {
                $count = $item->getCount();
                $sellprice = $sellprice + (38.85 * $count);
                $sender->getInventory()->remove($item);
            }
            # diamond block
            if ($item === VanillaBlocks::DIAMOND()) {
                $count = $item->getCount();
                $sellprice = $sellprice + (155.40 * $count);
                $sender->getInventory()->remove($item);
            }

            # emerald ore
            if ($item === VanillaBlocks::EMERALD_ORE()) {
                $count = $item->getCount();
                $sellprice = $sellprice + (27.35 * $count);
                $sender->getInventory()->remove($item);
            }
            # emerald
            if ($item === VanillaItems::EMERALD()) {
                $count = $item->getCount();
                $sellprice = $sellprice + (144.92 * $count);
                $sender->getInventory()->remove($item);
            }
            # emerald block
            if ($item === VanillaBlocks::EMERALD()) {
                $count = $item->getCount();
                $sellprice = $sellprice + (579.68 * $count);
                $sender->getInventory()->remove($item);
            }
            // Nothing Sold
            if ($sellprice === 0) {
                $sender->sendMessage(\Emporium\Prison\Variables::PREFIX . "You cannot sell that item.");
                return false;
            }
            $sender->getInventory()->remove($item);
            DataManager::getInstance()->setPlayerData($sender->getXuid(), "profile.money", DataManager::getInstance()->getPlayerData($sender->getXuid(), "profile.money") + $sellprice);
            $sender->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have sold " . TF::WHITE . $count . "x " . TF::AQUA . $item->getName() . " for " . TF::GREEN . "$" . TF::WHITE . Translator::shortNumber($sellprice) . ".");
            return true;
        }

        if (strtolower($args[0]) === "inv") {
            $inventory = $sender->getInventory()->getContents();
            $sellprice = 0;
            foreach ($inventory as $item) {
                if(in_array($item->getTypeId(), $this->sellables)) {
                    # coal ore
                    if ($item === VanillaBlocks::COAL_ORE()) {
                        $count = $item->getCount();
                        $sellprice = $sellprice + (0.06 * $count);
                        $sender->getInventory()->remove($item);
                    }
                    # coal block
                    if ($item === VanillaBlocks::COAL()) {
                        $count = $item->getCount();
                        $sellprice = $sellprice + (0.32 * $count);
                        $sender->getInventory()->remove($item);
                    }
                    # coal
                    if ($item === VanillaItems::COAL()) {
                        $count = $item->getCount();
                        $sellprice = $sellprice + (1.21 * $count);
                        $sender->getInventory()->remove($item);
                    }

                    # iron ore
                    if ($item === VanillaBlocks::IRON_ORE()) {
                        $count = $item->getCount();
                        $sellprice = $sellprice + (0.20 * $count);
                        $sender->getInventory()->remove($item);
                    }
                    # iron ingot
                    if ($item === VanillaItems::IRON_INGOT()) {
                        $count = $item->getCount();
                        $sellprice = $sellprice + (1.02 * $count);
                        $sender->getInventory()->remove($item);
                    }
                    # iron block
                    if ($item === VanillaBlocks::IRON()) {
                        $count = $item->getCount();
                        $sellprice = $sellprice + (4.08 * $count);
                        $sender->getInventory()->remove($item);
                    }

                    # lapis ore
                    if ($item === VanillaBlocks::LAPIS_LAZULI_ORE()) {
                        $count = $item->getCount();
                        $sellprice = $sellprice + (0.52 * $count);
                        $sender->getInventory()->remove($item);
                    }
                    # lapis
                    if ($item === VanillaItems::LAPIS_LAZULI()) {
                        $count = $item->getCount();
                        $sellprice = $sellprice + (2.70 * $count);
                        $sender->getInventory()->remove($item);
                    }
                    # lapis block
                    if ($item == VanillaBlocks::LAPIS_LAZULI()) {
                        $count = $item->getCount();
                        $sellprice = $sellprice + (10.80 * $count);
                        $sender->getInventory()->remove($item);
                    }

                    # redstone ore
                    if ($item == VanillaBlocks::REDSTONE_ORE()) {
                        $count = $item->getCount();
                        $sellprice = $sellprice + (1.57 * $count);
                        $sender->getInventory()->remove($item);
                    }
                    # redstone
                    if ($item == VanillaItems::REDSTONE_DUST()) {
                        $count = $item->getCount();
                        $sellprice = $sellprice + (8.29 * $count);
                        $sender->getInventory()->remove($item);
                    }
                    # redstone block
                    if ($item === VanillaBlocks::REDSTONE()) {
                        $count = $item->getCount();
                        $sellprice = $sellprice + (33.16 * $count);
                        $sender->getInventory()->remove($item);
                    }

                    # gold ore
                    if ($item === VanillaBlocks::GOLD_ORE()) {
                        $count = $item->getCount();
                        $sellprice = $sellprice + (4.86 * $count);
                        $sender->getInventory()->remove($item);
                    }
                    # gold ingot
                    if ($item === VanillaItems::GOLD_INGOT()) {
                        $count = $item->getCount();
                        $sellprice = $sellprice + (25.76 * $count);
                    }
                    # gold block
                    if ($item === VanillaBlocks::GOLD()) {
                        $count = $item->getCount();
                        $sellprice = $sellprice + (103.04 * $count);
                        $sender->getInventory()->remove($item);
                    }

                    # diamond ore
                    if ($item === VanillaBlocks::DIAMOND_ORE()) {
                        $count = $item->getCount();
                        $sellprice = $sellprice + (7.34 * $count);
                        $sender->getInventory()->remove($item);
                    }
                    # diamond
                    if ($item === VanillaItems::DIAMOND()) {
                        $count = $item->getCount();
                        $sellprice = $sellprice + (38.85 * $count);
                        $sender->getInventory()->remove($item);
                    }
                    # diamond block
                    if ($item === VanillaBlocks::DIAMOND()) {
                        $count = $item->getCount();
                        $sellprice = $sellprice + (155.40 * $count);
                        $sender->getInventory()->remove($item);
                    }

                    # emerald ore
                    if ($item === VanillaBlocks::EMERALD_ORE()) {
                        $count = $item->getCount();
                        $sellprice = $sellprice + (27.35 * $count);
                        $sender->getInventory()->remove($item);
                    }
                    # emerald
                    if ($item === VanillaItems::EMERALD()) {
                        $count = $item->getCount();
                        $sellprice = $sellprice + (144.92 * $count);
                        $sender->getInventory()->remove($item);
                    }
                    # emerald block
                    if ($item === VanillaBlocks::EMERALD()) {
                        $count = $item->getCount();
                        $sellprice = $sellprice + (579.68 * $count);
                        $sender->getInventory()->remove($item);
                    }
                }
            }
            // Nothing Sold
            if ($sellprice === 0) {
                $sender->sendMessage(\Emporium\Prison\Variables::PREFIX . "You do not have any sellable items in your inventory.");
                return false;
            } else {
                DataManager::getInstance()->setPlayerData($sender->getXuid(), "profile.money", DataManager::getInstance()->getPlayerData($sender->getXuid(), "profile.money") + $sellprice);
                $sender->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have sold your inventory for $" . $sellprice . ".");
                return true;
            }
        }

        $sender->sendMessage(\Emporium\Prison\Variables::PREFIX . "Usage: " . $this->getUsage());
        return false;
    }
}