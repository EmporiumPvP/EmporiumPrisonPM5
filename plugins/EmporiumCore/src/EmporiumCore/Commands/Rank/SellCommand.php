<?php

namespace EmporiumCore\Commands\Rank;

use Emporium\Prison\Managers\misc\Translator;
use EmporiumCore\Managers\Data\DataManager;
use EmporiumCore\Variables;

use JsonException;
use pocketmine\item\ItemIds;
use pocketmine\player\Player;

use pocketmine\command\{Command, CommandSender};

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

    /**
     * @throws JsonException
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {

        if (!$sender instanceof Player) {
            $sender->sendMessage("§cYou may only run this command in-game!");
            return false;
        }

        $permission = DataManager::getData($sender, "Permissions", "emporiumcore.command.sell");
        if (!$permission) {
            $sender->sendMessage("§cYou do not have permission to use this command.");
            return false;
        }

        if (isset($args[0])) {
            if (strtolower($args[0]) === "hand") {
                $item = $sender->getInventory()->getItemInHand();
                $count = $item->getCount();
                $sellprice = 0;
                # coal ore
                if ($item->getId() === ItemIds::COAL_ORE) {
                    $count = $item->getCount();
                    $sellprice = $sellprice + (0.06 * $count);
                    $sender->getInventory()->remove($item);
                }
                # coal block
                if ($item->getId() === ItemIds::COAL) {
                    $count = $item->getCount();
                    $sellprice = $sellprice + (0.32 * $count);
                    $sender->getInventory()->remove($item);
                }
                # coal
                if ($item->getId() === ItemIds::COAL_BLOCK) {
                    $count = $item->getCount();
                    $sellprice = $sellprice + (1.21 * $count);
                    $sender->getInventory()->remove($item);
                }

                # iron ore
                if ($item->getId() === ItemIds::IRON_ORE) {
                    $count = $item->getCount();
                    $sellprice = $sellprice + (0.20 * $count);
                    $sender->getInventory()->remove($item);
                }
                # iron ingot
                if ($item->getId() === ItemIds::IRON_INGOT) {
                    $count = $item->getCount();
                    $sellprice = $sellprice + (1.02 * $count);
                    $sender->getInventory()->remove($item);
                }
                # iron block
                if ($item->getId() === ItemIds::IRON_BLOCK) {
                    $count = $item->getCount();
                    $sellprice = $sellprice + (4.08 * $count);
                    $sender->getInventory()->remove($item);
                }

                # lapis ore
                if ($item->getId() === ItemIds::LAPIS_ORE) {
                    $count = $item->getCount();
                    $sellprice = $sellprice + (0.52 * $count);
                    $sender->getInventory()->remove($item);
                }
                # lapis
                if ($item->getId() === ItemIds::DYE && $item->getMeta() === 4) {
                    $count = $item->getCount();
                    $sellprice = $sellprice + (2.70 * $count);
                    $sender->getInventory()->remove($item);
                }
                # lapis block
                if ($item->getId() === ItemIds::LAPIS_BLOCK) {
                    $count = $item->getCount();
                    $sellprice = $sellprice + (10.80 * $count);
                    $sender->getInventory()->remove($item);
                }

                # redstone ore
                if ($item->getId() === ItemIds::REDSTONE_ORE) {
                    $count = $item->getCount();
                    $sellprice = $sellprice + (1.57 * $count);
                    $sender->getInventory()->remove($item);
                }
                # redstone
                if ($item->getId() === ItemIds::REDSTONE) {
                    $count = $item->getCount();
                    $sellprice = $sellprice + (8.29 * $count);
                    $sender->getInventory()->remove($item);
                }
                # redstone block
                if ($item->getId() === ItemIds::REDSTONE_BLOCK) {
                    $count = $item->getCount();
                    $sellprice = $sellprice + (33.16 * $count);
                    $sender->getInventory()->remove($item);
                }

                # gold ore
                if ($item->getId() === ItemIds::GOLD_ORE) {
                    $count = $item->getCount();
                    $sellprice = $sellprice + (4.86 * $count);
                    $sender->getInventory()->remove($item);
                }
                # gold ingot
                if ($item->getId() === ItemIds::GOLD_INGOT) {
                    $count = $item->getCount();
                    $sellprice = $sellprice + (25.76 * $count);
                }
                # gold block
                if ($item->getId() === ItemIds::GOLD_BLOCK) {
                    $count = $item->getCount();
                    $sellprice = $sellprice + (103.04 * $count);
                    $sender->getInventory()->remove($item);
                }

                # diamond ore
                if ($item->getId() === ItemIds::DIAMOND_ORE) {
                    $count = $item->getCount();
                    $sellprice = $sellprice + (7.34 * $count);
                    $sender->getInventory()->remove($item);
                }
                # diamond
                if ($item->getId() === ItemIds::DIAMOND) {
                    $count = $item->getCount();
                    $sellprice = $sellprice + (38.85 * $count);
                    $sender->getInventory()->remove($item);
                }
                # diamond block
                if ($item->getId() === ItemIds::DIAMOND_BLOCK) {
                    $count = $item->getCount();
                    $sellprice = $sellprice + (155.40 * $count);
                    $sender->getInventory()->remove($item);
                }

                # emerald ore
                if ($item->getId() === ItemIds::EMERALD_ORE) {
                    $count = $item->getCount();
                    $sellprice = $sellprice + (27.35 * $count);
                    $sender->getInventory()->remove($item);
                }
                # emerald
                if ($item->getId() === ItemIds::EMERALD) {
                    $count = $item->getCount();
                    $sellprice = $sellprice + (144.92 * $count);
                    $sender->getInventory()->remove($item);
                }
                # emerald block
                if ($item->getId() === ItemIds::EMERALD_BLOCK) {
                    $count = $item->getCount();
                    $sellprice = $sellprice + (579.68 * $count);
                    $sender->getInventory()->remove($item);
                }
                // Nothing Sold
                if ($sellprice === 0) {
                    $sender->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You cannot sell that item.");
                    return false;
                } else {
                    $sender->getInventory()->remove($item);
                    DataManager::addData($sender, "Players", "Money", $sellprice);
                    $sender->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have sold " . TF::WHITE . $count . "x " . TF::AQUA . $item->getName() . " for " . TF::GREEN . "$" . TF::WHITE . Translator::shortNumber($sellprice) . ".");
                    return true;
                }
            }
            if (strtolower($args[0]) === "inv") {
                $inventory = $sender->getInventory()->getContents();
                $sellprice = 0;
                foreach ($inventory as $item) {
                    if(in_array($item->getId(), $this->sellables)) {
                        # coal ore
                        if ($item->getId() === ItemIds::COAL_ORE) {
                            $count = $item->getCount();
                            $sellprice = $sellprice + (0.06 * $count);
                            $sender->getInventory()->remove($item);
                        }
                        # coal block
                        if ($item->getId() === ItemIds::COAL) {
                            $count = $item->getCount();
                            $sellprice = $sellprice + (0.32 * $count);
                            $sender->getInventory()->remove($item);
                        }
                        # coal
                        if ($item->getId() === ItemIds::COAL_BLOCK) {
                            $count = $item->getCount();
                            $sellprice = $sellprice + (1.21 * $count);
                            $sender->getInventory()->remove($item);
                        }

                        # iron ore
                        if ($item->getId() === ItemIds::IRON_ORE) {
                            $count = $item->getCount();
                            $sellprice = $sellprice + (0.20 * $count);
                            $sender->getInventory()->remove($item);
                        }
                        # iron ingot
                        if ($item->getId() === ItemIds::IRON_INGOT) {
                            $count = $item->getCount();
                            $sellprice = $sellprice + (1.02 * $count);
                            $sender->getInventory()->remove($item);
                        }
                        # iron block
                        if ($item->getId() === ItemIds::IRON_BLOCK) {
                            $count = $item->getCount();
                            $sellprice = $sellprice + (4.08 * $count);
                            $sender->getInventory()->remove($item);
                        }

                        # lapis ore
                        if ($item->getId() === ItemIds::LAPIS_ORE) {
                            $count = $item->getCount();
                            $sellprice = $sellprice + (0.52 * $count);
                            $sender->getInventory()->remove($item);
                        }
                        # lapis
                        if ($item->getId() === ItemIds::DYE && $item->getMeta() === 4) {
                            $count = $item->getCount();
                            $sellprice = $sellprice + (2.70 * $count);
                            $sender->getInventory()->remove($item);
                        }
                        # lapis block
                        if ($item->getId() === ItemIds::LAPIS_BLOCK) {
                            $count = $item->getCount();
                            $sellprice = $sellprice + (10.80 * $count);
                            $sender->getInventory()->remove($item);
                        }

                        # redstone ore
                        if ($item->getId() === ItemIds::REDSTONE_ORE) {
                            $count = $item->getCount();
                            $sellprice = $sellprice + (1.57 * $count);
                            $sender->getInventory()->remove($item);
                        }
                        # redstone
                        if ($item->getId() === ItemIds::REDSTONE) {
                            $count = $item->getCount();
                            $sellprice = $sellprice + (8.29 * $count);
                            $sender->getInventory()->remove($item);
                        }
                        # redstone block
                        if ($item->getId() === ItemIds::REDSTONE_BLOCK) {
                            $count = $item->getCount();
                            $sellprice = $sellprice + (33.16 * $count);
                            $sender->getInventory()->remove($item);
                        }

                        # gold ore
                        if ($item->getId() === ItemIds::GOLD_ORE) {
                            $count = $item->getCount();
                            $sellprice = $sellprice + (4.86 * $count);
                            $sender->getInventory()->remove($item);
                        }
                        # gold ingot
                        if ($item->getId() === ItemIds::GOLD_INGOT) {
                            $count = $item->getCount();
                            $sellprice = $sellprice + (25.76 * $count);
                        }
                        # gold block
                        if ($item->getId() === ItemIds::GOLD_BLOCK) {
                            $count = $item->getCount();
                            $sellprice = $sellprice + (103.04 * $count);
                            $sender->getInventory()->remove($item);
                        }

                        # diamond ore
                        if ($item->getId() === ItemIds::DIAMOND_ORE) {
                            $count = $item->getCount();
                            $sellprice = $sellprice + (7.34 * $count);
                            $sender->getInventory()->remove($item);
                        }
                        # diamond
                        if ($item->getId() === ItemIds::DIAMOND) {
                            $count = $item->getCount();
                            $sellprice = $sellprice + (38.85 * $count);
                            $sender->getInventory()->remove($item);
                        }
                        # diamond block
                        if ($item->getId() === ItemIds::DIAMOND_BLOCK) {
                            $count = $item->getCount();
                            $sellprice = $sellprice + (155.40 * $count);
                            $sender->getInventory()->remove($item);
                        }

                        # emerald ore
                        if ($item->getId() === ItemIds::EMERALD_ORE) {
                            $count = $item->getCount();
                            $sellprice = $sellprice + (27.35 * $count);
                            $sender->getInventory()->remove($item);
                        }
                        # emerald
                        if ($item->getId() === ItemIds::EMERALD) {
                            $count = $item->getCount();
                            $sellprice = $sellprice + (144.92 * $count);
                            $sender->getInventory()->remove($item);
                        }
                        # emerald block
                        if ($item->getId() === ItemIds::EMERALD_BLOCK) {
                            $count = $item->getCount();
                            $sellprice = $sellprice + (579.68 * $count);
                            $sender->getInventory()->remove($item);
                        }
                    }
                }
                // Nothing Sold
                if ($sellprice === 0) {
                    $sender->sendMessage(Variables::ERROR_PREFIX . TF::GRAY . "You do not have any sellable items in your inventory.");
                    return false;
                } else {
                    DataManager::addData($sender, "Players", "Money", $sellprice);
                    $sender->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have sold your inventory for $" . $sellprice . ".");
                    return true;
                }
            } else {
                $sender->sendMessage(Variables::ERROR_PREFIX . TF::GRAY . "Usage: /sell <hand/inv>");
                return false;
            }
        } else {
            $sender->sendMessage(Variables::ERROR_PREFIX . TF::GRAY . "Usage: /sell <hand/inv>");
            return false;
        }
    }
}