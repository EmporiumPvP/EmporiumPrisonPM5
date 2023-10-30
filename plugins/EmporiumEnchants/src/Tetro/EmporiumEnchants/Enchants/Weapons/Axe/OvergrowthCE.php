<?php

# Namespaces
namespace Tetro\EmporiumEnchants\Enchants\Weapons\Axe;

# Pocketmine API
use pocketmine\block\VanillaBlocks;

use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\Event;

use pocketmine\inventory\Inventory;

use pocketmine\item\Item;
use pocketmine\item\VanillaItems;

use pocketmine\player\Player;

use Tetro\EmporiumEnchants\Core\CustomEnchant;
use Tetro\EmporiumEnchants\Core\Types\ReactiveEnchantment;

# Used Files

# Enchantment Class
class OvergrowthCE extends ReactiveEnchantment
{

    # Register Enchantment
    public string $name = "Overgrowth";
    public string $description = "Increases the amount of crops dropped when harvesting.";
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
            $blockId = $event->getBlock()->getTypeId();
            $worldName = $player->getWorld()->getFolderName();
            if ($worldName === "Lobby" || $worldName === "Warzone") {
                return;
            }
            // Not Wilderness
            if ($worldName !== "Wilderness") {
                // Public Mine
                if ($worldName === "PublicMine") {
                    if ($blockId !== 14) {
                        if ($blockId !== 16) {
                            return;
                        }
                    }
                }
                // Ranked Mine
                if ($worldName === "RankedMine") {
                    if ($blockId !== 57) {
                        if ($blockId !== 133) {
                            return;
                        }
                    }
                }
                // PvP Mine
                if ($worldName === "PvPMine") {
                    if ($blockId !== 153) {
                        if ($blockId !== 129) {
                            if ($blockId !== 56) {
                                if ($blockId !== 155) {
                        			return;
                                }
                            }
                        }
                    }
                }
                // Prestige Mine
                if ($worldName === "PrestigeMine") {
                    if ($blockId !== 224) {
                        return;
                    }
                }
            }

            # sugar cane
            if ($blockId === VanillaBlocks::SUGARCANE()->getTypeId()) {

                $random = mt_rand(1, 50);
                $chance = $level * 2;

                if ($chance >= $random) {
                    $amount = mt_rand(10 , 20);
                    $item = VanillaBlocks::SUGARCANE()->asItem()->setCount($amount);
                    foreach ($player->getInventory()->addItem($item) as $invfull) {
                        $player->getWorld()->dropItem($player->getPosition(), $invfull);
                    }
                    $player->sendTip("§r§aYou have be blessed with +" . $amount . "!");
                }
            }

            # wheat
            if ($blockId === VanillaItems::WHEAT()->getTypeId()) {

                $random = mt_rand(1, 50);
                $chance = $level * 2;

                if ($chance >= $random) {

                    $amount = mt_rand(10 , 20);
                    $item = VanillaItems::WHEAT()->setCount($amount);

                    foreach ($player->getInventory()->addItem($item) as $invfull) {
                        $player->getWorld()->dropItem($player->getPosition(), $invfull);
                    }

                    $player->sendTip("§r§aYou have be blessed with +" . $amount . "!");
                }
            }

            # beetroot
            if ($blockId === VanillaItems::BEETROOT()->getTypeId()) {

                $random = mt_rand(1, 50);
                $chance = $level * 2;

                if ($chance >= $random) {

                    $amount = mt_rand(10 , 20);
                    $item = VanillaItems::BEETROOT()->setCount($amount);

                    foreach ($player->getInventory()->addItem($item) as $invfull) {
                        $player->getWorld()->dropItem($player->getPosition(), $invfull);
                    }

                    $player->sendTip("§r§aYou have be blessed with +" . $amount . "!");
                }
            }

            # potato
            if ($blockId === VanillaItems::POTATO()->getTypeId()) {

                $random = mt_rand(1, 50);
                $chance = $level * 2;

                if ($chance >= $random) {

                    $amount = mt_rand(10 , 20);
                    $item = VanillaItems::POTATO()->setCount($amount);

                    foreach ($player->getInventory()->addItem($item) as $invfull) {
                        $player->getWorld()->dropItem($player->getPosition(), $invfull);
                    }

                    $player->sendTip("§r§aYou have be blessed with +" . $amount . "!");
                }
            }

            # carrot
            if ($blockId === VanillaItems::CARROT()->getTypeId()) {

                $random = mt_rand(1, 50);
                $chance = $level * 2;

                if ($chance >= $random) {

                    $amount = mt_rand(10 , 20);
                    $item = VanillaItems::CARROT()->setCount($amount);

                    foreach ($player->getInventory()->addItem($item) as $invfull) {
                        $player->getWorld()->dropItem($player->getPosition(), $invfull);
                    }

                    $player->sendTip("§r§aYou have be blessed with +" . $amount . "!");
                }
            }

            # pumpkin
            if ($blockId === VanillaBlocks::PUMPKIN()->getTypeId()) {

                $random = mt_rand(1, 50);
                $chance = $level * 2;

                if ($chance >= $random) {

                    $amount = mt_rand(10 , 20);
                    $item = VanillaBlocks::PUMPKIN()->asItem()->setCount($amount);

                    foreach ($player->getInventory()->addItem($item) as $invfull) {
                        $player->getWorld()->dropItem($player->getPosition(), $invfull);
                    }

                    $player->sendTip("§r§aYou have be blessed with +" . $amount . "!");
                }
            }

            # melon
            if ($blockId === VanillaBlocks::MELON()->getTypeId()) {

                $random = mt_rand(1, 50);
                $chance = $level * 2;

                if ($chance >= $random) {

                    $amount = mt_rand(10 , 20);
                    $item = VanillaBlocks::MELON()->asItem()->setCount($amount);

                    foreach ($player->getInventory()->addItem($item) as $invfull) {
                        $player->getWorld()->dropItem($player->getPosition(), $invfull);
                    }

                    $player->sendTip("§r§aYou have be blessed with +" . $amount . "!");
                }
            }

            # melon slice
            if ($blockId === VanillaItems::MELON()->getTypeId()) {

                $random = mt_rand(1, 50);
                $chance = $level * 2;

                if ($chance >= $random) {

                    $amount = mt_rand(10 , 20);
                    $item = VanillaItems::MELON()->setCount($amount);

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