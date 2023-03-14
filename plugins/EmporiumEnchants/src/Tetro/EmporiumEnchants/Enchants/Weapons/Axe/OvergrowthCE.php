<?php

# Namespaces
namespace Tetro\EmporiumEnchants\Enchants\Weapons\Axe;

# Pocketmine API
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\Event;
use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\item\ItemFactory;
use pocketmine\player\Player;
use Tetro\EmporiumEnchants\Core\CustomEnchant;
use Tetro\EmporiumEnchants\Core\Types\ReactiveEnchantment;

# Used Files

# Enchantment Class
class OvergrowthCE extends ReactiveEnchantment
{

    # Register Enchantment
    public string $name = "Overgrowth";
    public string $description = "Increases the amount of crops droped when harvesting.";
    public int $rarity = CustomEnchant::RARITY_EXECUTIVE;
    public int $cooldownDuration = 0;
    public int $maxLevel = 10;
    public int $chance = 1;

    # Compatibility
    public int $usageType = CustomEnchant::TYPE_HAND;
    public int $itemType = CustomEnchant::ITEM_TYPE_AXE;

    # Reagents
    public function getReagent(): array
    {
        return [BlockBreakEvent::class];
    }

    # Enchantment
    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void
    {
        // Enchantment Code
        if ($event instanceof BlockBreakEvent) {
            // World Check
            $block = $event->getBlock()->getId();
            $world = $player->getWorld()->getFolderName();
            if ($world === "Lobby" || $world === "Warzone") {
                return;
            }
            // Not Wilderness
            if ($world !== "Wilderness") {
                // Public Mine
                if ($world === "PublicMine") {
                    if ($block !== 14) {
                        if ($block !== 16) {
                            return;
                        }
                    }
                }
                // Ranked Mine
                if ($world === "RankedMine") {
                    if ($block !== 57) {
                        if ($block !== 133) {
                            return;
                        }
                    }
                }
                // PvP Mine
                if ($world === "PvPMine") {
                    if ($block !== 153) {
                        if ($block !== 129) {
                            if ($block !== 56) {
                                if ($block !== 155) {
                        			return;
                                }
                            }
                        }
                    }
                }
                // Prestige Mine
                if ($world === "PrestigeMine") {
                    if ($block !== 224) {
                        return;
                    }
                }
            }
            if ($block === 338) {
                $random = mt_rand(1, 50);
                $chance = $level * 2;
                if ($chance >= $random) {
                    $amount = mt_rand(10 , 20);
                    $item = ItemFactory::getInstance()->get(338, 0, $amount);
                    foreach ($player->getInventory()->addItem($item) as $invfull) {
                        $player->getWorld()->dropItem($player->getPosition(), $invfull);
                    }
                    $player->sendTip("§r§aYou have be blessed with +" . $amount . "!");
                }
            }
            if ($block === 296) {
                $random = mt_rand(1, 50);
                $chance = $level * 2;
                if ($chance >= $random) {
                    $amount = mt_rand(10 , 20);
                    $item = ItemFactory::getInstance()->get(296, 4, $amount);
                    foreach ($player->getInventory()->addItem($item) as $invfull) {
                        $player->getWorld()->dropItem($player->getPosition(), $invfull);
                    }
                    $player->sendTip("§r§aYou have be blessed with +" . $amount . "!");
                }
            }
            if ($block === 457) {
                $random = mt_rand(1, 50);
                $chance = $level * 2;
                if ($chance >= $random) {
                    $amount = mt_rand(10 , 20);
                    $item = ItemFactory::getInstance()->get(457, 4, $amount);
                    foreach ($player->getInventory()->addItem($item) as $invfull) {
                        $player->getWorld()->dropItem($player->getPosition(), $invfull);
                    }
                    $player->sendTip("§r§aYou have be blessed with +" . $amount . "!");
                }
            }
            if ($block === 392) {
                $random = mt_rand(1, 50);
                $chance = $level * 2;
                if ($chance >= $random) {
                    $amount = mt_rand(10 , 20);
                    $item = ItemFactory::getInstance()->get(392, 4, $amount);
                    foreach ($player->getInventory()->addItem($item) as $invfull) {
                        $player->getWorld()->dropItem($player->getPosition(), $invfull);
                    }
                    $player->sendTip("§r§aYou have be blessed with +" . $amount . "!");
                }
            }
            if ($block === 391) {
                $random = mt_rand(1, 50);
                $chance = $level * 2;
                if ($chance >= $random) {
                    $amount = mt_rand(10 , 20);
                    $item = ItemFactory::getInstance()->get(391, 4, $amount);
                    foreach ($player->getInventory()->addItem($item) as $invfull) {
                        $player->getWorld()->dropItem($player->getPosition(), $invfull);
                    }
                    $player->sendTip("§r§aYou have be blessed with +" . $amount . "!");
                }
            }
            if ($block === 86) {
                $random = mt_rand(1, 50);
                $chance = $level * 2;
                if ($chance >= $random) {
                    $amount = mt_rand(10 , 20);
                    $item = ItemFactory::getInstance()->get(86, 4, $amount);
                    foreach ($player->getInventory()->addItem($item) as $invfull) {
                        $player->getWorld()->dropItem($player->getPosition(), $invfull);
                    }
                    $player->sendTip("§r§aYou have be blessed with +" . $amount . "!");
                }
            }
            if ($block === 103) {
                $random = mt_rand(1, 50);
                $chance = $level * 2;
                if ($chance >= $random) {
                    $amount = mt_rand(10 , 20);
                    $item = ItemFactory::getInstance()->get(103, 4, $amount);
                    foreach ($player->getInventory()->addItem($item) as $invfull) {
                        $player->getWorld()->dropItem($player->getPosition(), $invfull);
                    }
                    $player->sendTip("§r§aYou have be blessed with +" . $amount . "!");
                }
            }
            if ($block === 360) {
                $random = mt_rand(1, 50);
                $chance = $level * 2;
                if ($chance >= $random) {
                    $amount = mt_rand(10 , 20);
                    $item = ItemFactory::getInstance()->get(360, 4, $amount);
                    foreach ($player->getInventory()->addItem($item) as $invfull) {
                        $player->getWorld()->dropItem($player->getPosition(), $invfull);
                    }
                    $player->sendTip("§r§aYou have be blessed with +" . $amount . "!");
                }
            }
        }
    }

    # Priority
    public function getPriority(): int
    {
        return 2;
    }
}