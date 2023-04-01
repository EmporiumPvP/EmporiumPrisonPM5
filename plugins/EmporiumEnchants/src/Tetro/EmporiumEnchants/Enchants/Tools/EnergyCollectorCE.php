<?php

namespace Tetro\EmporiumEnchants\Enchants\Tools;

use Emporium\Prison\EmporiumPrison;
use Emporium\Prison\Managers\PickaxeManager;
use pocketmine\block\BlockLegacyIds;
use pocketmine\item\Item;
use pocketmine\event\Event;
use pocketmine\item\ItemIds;
use pocketmine\player\Player;
use pocketmine\inventory\Inventory;
use pocketmine\event\block\BlockBreakEvent;
use Tetro\EmporiumEnchants\Core\CustomEnchant;
use Tetro\EmporiumEnchants\Core\Types\ReactiveEnchantment;


class EnergyCollectorCE extends ReactiveEnchantment {

    public string $name = "Energy Collector";
    public string $description = "Gain additional energy when mining.";
    public int $rarity = CustomEnchant::RARITY_ULTIMATE;
    public int $cooldownDuration = 0;
    public int $maxLevel = 5;
    public int $chance = 1;

    public int $usageType = CustomEnchant::TYPE_HAND;
    public int $itemType = CustomEnchant::ITEM_TYPE_TOOLS;

    public function getReagent(): array {
        return [BlockBreakEvent::class];
    }

    private array $ores = [
        BlockLegacyIds::COAL_ORE,
        BlockLegacyIds::COAL_BLOCK,
        BlockLegacyIds::IRON_ORE,
        BlockLegacyIds::IRON_BLOCK,
        BlockLegacyIds::LAPIS_ORE,
        BlockLegacyIds::LAPIS_BLOCK,
        BlockLegacyIds::REDSTONE_ORE,
        BlockLegacyIds::LIT_REDSTONE_ORE,
        BlockLegacyIds::REDSTONE_BLOCK,
        BlockLegacyIds::GOLD_ORE,
        BlockLegacyIds::GOLD_BLOCK,
        BlockLegacyIds::DIAMOND_ORE,
        BlockLegacyIds::DIAMOND_BLOCK,
        BlockLegacyIds::EMERALD_ORE,
        BlockLegacyIds::EMERALD_BLOCK,
        BlockLegacyIds::QUARTZ_ORE
    ];

    private array $blocks = [
        ItemIds::COAL_ORE, ItemIds::COAL_BLOCK,
        ItemIds::IRON_ORE, ItemIds::IRON_BLOCK,
        ItemIds::LAPIS_ORE, ItemIds::LAPIS_BLOCK,
        ItemIds::REDSTONE_ORE, ItemIds::REDSTONE_BLOCK,
        ItemIds::GOLD_ORE, ItemIds::GOLD_BLOCK,
        ItemIds::DIAMOND_ORE, ItemIds::DIAMOND_BLOCK,
        ItemIds::EMERALD_ORE, ItemIds::EMERALD_BLOCK
    ];

    # Enchantment
    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void {

        if($event instanceof BlockBreakEvent) {

            if($event->isCancelled()) return;

            $blockId = $event->getBlock()->getIdInfo()->getBlockId();

            if(!in_array($blockId, $this->ores)) {
                $event->cancel();
                return;
            }

            $item = $event->getPlayer()->getInventory()->getItemInHand();
            if($item->getNamedTag()->getString("PickaxeType") === null) {
                return;
            }
            if($item->getNamedTag()->getInt("Energy") === null) {
                return;
            } else {
                $pickaxeEnergy = $item->getNamedTag()->getInt("Energy");
            }

            $pickaxeManager = EmporiumPrison::getInstance()->getPickaxeManager();

            $block = $event->getBlock();
            $blockId = $block->getIdInfo()->getBlockId();

            if(in_array($blockId, $this->blocks)) {
                switch ($blockId) {
                    # coal
                    case ItemIds::COAL_ORE:
                        $amount = (mt_rand(10, 20) * $level);
                        $newData = $pickaxeEnergy + $amount;
                        $item->getNamedTag()->setInt("Energy", $newData);
                        $pickaxeManager->updatePickaxe($item);
                        break;
                    case ItemIds::COAL_BLOCK:
                        $amount = (mt_rand(20, 40) * $level);
                        $newData = $pickaxeEnergy + $amount;
                        $item->getNamedTag()->setInt("Energy", $newData);
                        $pickaxeManager->updatePickaxe($item);
                        break;
                    # iron
                    case ItemIds::IRON_ORE:
                        $amount = (mt_rand(20, 30) * $level);
                        $newData = $pickaxeEnergy + $amount;
                        $item->getNamedTag()->setInt("Energy", $newData);
                        $pickaxeManager->updatePickaxe($item);
                        break;
                    case ItemIds::IRON_BLOCK:
                        $amount = (mt_rand(40, 60) * $level);
                        $newData = $pickaxeEnergy + $amount;
                        $item->getNamedTag()->setInt("Energy", $newData);
                        $pickaxeManager->updatePickaxe($item);
                        break;
                    # lapis
                    case ItemIds::LAPIS_ORE:
                        $amount = (mt_rand(30, 40) * $level);
                        $newData = $pickaxeEnergy + $amount;
                        $item->getNamedTag()->setInt("Energy", $newData);
                        $pickaxeManager->updatePickaxe($item);
                        break;
                    case ItemIds::LAPIS_BLOCK:
                        $amount = (mt_rand(60, 80) * $level);
                        $newData = $pickaxeEnergy + $amount;
                        $item->getNamedTag()->setInt("Energy", $newData);
                        $pickaxeManager->updatePickaxe($item);
                        break;
                    # redstone
                    case ItemIds::REDSTONE_ORE:
                        $amount = (mt_rand(40, 50) * $level);
                        $newData = $pickaxeEnergy + $amount;
                        $item->getNamedTag()->setInt("Energy", $newData);
                        $pickaxeManager->updatePickaxe($item);
                        break;
                    case ItemIds::REDSTONE_BLOCK:
                        $amount = (mt_rand(80, 100) * $level);
                        $newData = $pickaxeEnergy + $amount;
                        $item->getNamedTag()->setInt("Energy", $newData);
                        $pickaxeManager->updatePickaxe($item);
                        break;
                    # gold
                    case ItemIds::GOLD_ORE:
                        $amount = (mt_rand(50, 60) * $level);
                        $newData = $pickaxeEnergy + $amount;
                        $item->getNamedTag()->setInt("Energy", $newData);
                        $pickaxeManager->updatePickaxe($item);
                        break;
                    case ItemIds::GOLD_BLOCK:
                        $amount = (mt_rand(100, 120) * $level);
                        $newData = $pickaxeEnergy + $amount;
                        $item->getNamedTag()->setInt("Energy", $newData);
                        $pickaxeManager->updatePickaxe($item);
                        break;
                    # diamond
                    case ItemIds::DIAMOND_ORE:
                        $amount = (mt_rand(60, 70) * $level);
                        $newData = $pickaxeEnergy + $amount;
                        $item->getNamedTag()->setInt("Energy", $newData);
                        $pickaxeManager->updatePickaxe($item);
                        break;
                    case ItemIds::DIAMOND_BLOCK:
                        $amount = (mt_rand(120, 140) * $level);
                        $newData = $pickaxeEnergy + $amount;
                        $item->getNamedTag()->setInt("Energy", $newData);
                        $pickaxeManager->updatePickaxe($item);
                        break;
                    # emerald
                    case ItemIds::EMERALD_ORE:
                        $amount = (mt_rand(70, 80) * $level);
                        $newData = $pickaxeEnergy + $amount;
                        $item->getNamedTag()->setInt("Energy", $newData);
                        $pickaxeManager->updatePickaxe($item);
                        break;
                    case ItemIds::EMERALD_BLOCK:
                        $amount = (mt_rand(140, 160) * $level);
                        $newData = $pickaxeEnergy + $amount;
                        $item->getNamedTag()->setInt("Energy", $newData);
                        $pickaxeManager->updatePickaxe($item);
                        break;
                }
            }
            $this->setCooldown($player, 1);
        }
    }

    public function getPriority(): int
    {
        return 2;
    }

}