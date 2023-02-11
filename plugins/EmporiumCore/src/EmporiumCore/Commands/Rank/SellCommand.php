<?php

namespace EmporiumCore\Commands\Rank;

use Emporium\Prison\Managers\misc\Translator;
use EmporiumCore\managers\data\DataManager;
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
                // Gold Ore
                if ($item->getId() === 14) {
                    $count = $item->getCount();
                    $sellprice = $sellprice + (20 * $count);
                }
                // Iron Ore
                if ($item->getId() === 15) {
                    $count = $item->getCount();
                    $sellprice = $sellprice + (10 * $count);
                }
                // Coal Ore
                if ($item->getId() === 16) {
                    $count = $item->getCount();
                    $sellprice = $sellprice + (10 * $count);
                }
                // Lapis Ore
                if ($item->getId() === 21) {
                    $count = $item->getCount();
                    $sellprice = $sellprice + (10 * $count);
                }
                // Lapis Block
                if ($item->getId() === 22) {
                    $count = $item->getCount();
                    $sellprice = $sellprice + (90 * $count);
                }
                // Gold Block
                if ($item->getId() === 41) {
                    $count = $item->getCount();
                    $sellprice = $sellprice + (180 * $count);
                }
                // Iron Block
                if ($item->getId() === 42) {
                    $count = $item->getCount();
                    $sellprice = $sellprice + (90 * $count);
                }
                // Diamond Ore
                if ($item->getId() === 56) {
                    $count = $item->getCount();
                    $sellprice = $sellprice + (30 * $count);
                }
                // Diamond Block
                if ($item->getId() === 57) {
                    $count = $item->getCount();
                    $sellprice = $sellprice + (270 * $count);
                }
                // Redstone Ore
                if ($item->getId() === 73) {
                    $count = $item->getCount();
                    $sellprice = $sellprice + (10 * $count);
                }
                // Emerald Ore
                if ($item->getId() === 129) {
                    $count = $item->getCount();
                    $sellprice = $sellprice + (50 * $count);
                }
                // Emerald Block
                if ($item->getId() === 133) {
                    $count = $item->getCount();
                    $sellprice = $sellprice + (450 * $count);
                }
                // Redstone Block
                if ($item->getId() === 152) {
                    $count = $item->getCount();
                    $sellprice = $sellprice + (10 * $count);
                }
                // Coal Block
                if ($item->getId() === 173) {
                    $count = $item->getCount();
                    $sellprice = $sellprice + (90 * $count);
                }
                // Red Sandstone
                if ($item->getId() === 179) {
                    $count = $item->getCount();
                    $sellprice = $sellprice + (30 * $count);
                }
                // Coal
                if ($item->getId() === 263) {
                    $count = $item->getCount();
                    $sellprice = $sellprice + (10 * $count);
                }
                // Diamond
                if ($item->getId() === 264) {
                    $count = $item->getCount();
                    $sellprice = $sellprice + (30 * $count);
                }
                // Iron Ingot
                if ($item->getId() === 265) {
                    $count = $item->getCount();
                    $sellprice = $sellprice + (10 * $count);
                }
                // Gold Ingot
                if ($item->getId() === 266) {
                    $count = $item->getCount();
                    $sellprice = $sellprice + (20 * $count);
                }
                // Redstone
                if ($item->getId() === 331) {
                    $count = $item->getCount();
                    $sellprice = $sellprice + (10 * $count);
                }
                // Dye / Lapis
                if ($item->getId() === 351) {
                    $count = $item->getCount();
                    $sellprice = $sellprice + (10 * $count);
                }
                // Emerald
                if ($item->getId() === 388) {
                    $count = $item->getCount();
                    $sellprice = $sellprice + (50 * $count);
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
                        }
                        # coal block
                        if ($item->getId() === ItemIds::COAL_BLOCK) {
                            $count = $item->getCount();
                            $sellprice = $sellprice + (0.32 * $count);
                        }
                        # coal
                        if ($item->getId() === ItemIds::COAL) {
                            $count = $item->getCount();
                            $sellprice = $sellprice + (1.21 * $count);
                        }

                        # iron ore
                        if ($item->getId() === ItemIds::IRON_ORE) {
                            $count = $item->getCount();
                            $sellprice = $sellprice + (0.20 * $count);
                        }
                        # iron ingot
                        if ($item->getId() === ItemIds::IRON_INGOT) {
                            $count = $item->getCount();
                            $sellprice = $sellprice + (1.02 * $count);
                        }
                        # iron block
                        if ($item->getId() === ItemIds::IRON_BLOCK) {
                            $count = $item->getCount();
                            $sellprice = $sellprice + (4.08 * $count);
                        }

                        # lapis ore
                        if ($item->getId() === ItemIds::LAPIS_ORE) {
                            $count = $item->getCount();
                            $sellprice = $sellprice + (0.52 * $count);
                        }
                        # lapis
                        if ($item->getId() === ItemIds::DYE) {
                            $count = $item->getCount();
                            $sellprice = $sellprice + (2.70 * $count);
                        }
                        # lapis block
                        if ($item->getId() === ItemIds::LAPIS_BLOCK) {
                            $count = $item->getCount();
                            $sellprice = $sellprice + (10.80 * $count);
                        }

                        # redstone ore
                        if ($item->getId() === ItemIds::REDSTONE_ORE) {
                            $count = $item->getCount();
                            $sellprice = $sellprice + (1.57 * $count);
                        }
                        # redstone
                        if ($item->getId() === ItemIds::REDSTONE) {
                            $count = $item->getCount();
                            $sellprice = $sellprice + (8.29 * $count);
                        }
                        # redstone block
                        if ($item->getId() === ItemIds::REDSTONE_BLOCK) {
                            $count = $item->getCount();
                            $sellprice = $sellprice + (33.16 * $count);
                        }

                        # gold ore
                        if ($item->getId() === ItemIds::GOLD_ORE) {
                            $count = $item->getCount();
                            $sellprice = $sellprice + (4.86 * $count);
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
                        }

                        # diamond ore
                        if ($item->getId() === ItemIds::DIAMOND_ORE) {
                            $count = $item->getCount();
                            $sellprice = $sellprice + (7.34 * $count);
                        }
                        # diamond
                        if ($item->getId() === ItemIds::DIAMOND) {
                            $count = $item->getCount();
                            $sellprice = $sellprice + (38.85 * $count);
                        }
                        # diamond block
                        if ($item->getId() === ItemIds::DIAMOND_BLOCK) {
                            $count = $item->getCount();
                            $sellprice = $sellprice + (155.40 * $count);
                        }

                        # emerald ore
                        if ($item->getId() === ItemIds::EMERALD_ORE) {
                            $count = $item->getCount();
                            $sellprice = $sellprice + (27.35 * $count);
                        }
                        # emerald
                        if ($item->getId() === ItemIds::EMERALD) {
                            $count = $item->getCount();
                            $sellprice = $sellprice + (144.92 * $count);
                        }
                        # emerald block
                        if ($item->getId() === ItemIds::EMERALD_BLOCK) {
                            $count = $item->getCount();
                            $sellprice = $sellprice + (579.68 * $count);
                        }
                        $sender->getInventory()->remove($item);
                    }
                }
                // Nothing Sold
                if ($sellprice === 0) {
                    $sender->sendMessage(Variables::ERROR_PREFIX . TF::GRAY . "You do not have any sellable items in your inventory.");
                    return false;
                }
                DataManager::addData($sender, "Players", "Money", $sellprice);
                $sender->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have sold your inventory for $" . $sellprice . ".");
                return true;
            }
            $sender->sendMessage(Variables::ERROR_PREFIX . TF::GRAY . "Usage: /sell <hand/inv>");
            return false;
        }
        $sender->sendMessage(Variables::ERROR_PREFIX . TF::GRAY . "Usage: /sell <hand/inv>");
        return false;
    }
}