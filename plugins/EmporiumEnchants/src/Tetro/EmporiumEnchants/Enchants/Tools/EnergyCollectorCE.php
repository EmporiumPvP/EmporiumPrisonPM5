<?php

namespace Tetro\EmporiumEnchants\Enchants\Tools;

use Emporium\Prison\EmporiumPrison;

use pocketmine\block\BlockTypeIds;
use pocketmine\item\Item;
use pocketmine\event\Event;
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
        BlockTypeIds::COAL_ORE, BlockTypeIds::COAL,
        BlockTypeIds::IRON_ORE, BlockTypeIds::IRON,
        BlockTypeIds::LAPIS_LAZULI_ORE, BlockTypeIds::LAPIS_LAZULI,
        BlockTypeIds::REDSTONE_ORE, BlockTypeIds::REDSTONE,
        BlockTypeIds::GOLD_ORE, BlockTypeIds::GOLD,
        BlockTypeIds::DIAMOND_ORE, BlockTypeIds::DIAMOND,
        BlockTypeIds::EMERALD_ORE, BlockTypeIds::EMERALD,
        BlockTypeIds::NETHER_QUARTZ_ORE, BlockTypeIds::QUARTZ
    ];

    # Enchantment
    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void {

        if(!$event instanceof BlockBreakEvent) return;

        if($event->isCancelled()) return;

        $blockId = $event->getBlock()->getTypeId();

        if(!in_array($blockId, $this->ores)) return;

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
        $blockId = $block->getTypeId()->Info()->getBlockId();

        if(in_array($blockId, $this->ores)) {

            switch ($blockId) {

                # coal
                case BlockTypeIds::COAL_ORE:
                    $amount = (mt_rand(10, 20) * $level);
                    $newData = $pickaxeEnergy + $amount;
                    $item->getNamedTag()->setInt("Energy", $newData);
                    $pickaxeManager->updatePickaxe($item);
                    break;
                case BlockTypeIds::COAL:
                    $amount = (mt_rand(20, 40) * $level);
                    $newData = $pickaxeEnergy + $amount;
                    $item->getNamedTag()->setInt("Energy", $newData);
                    $pickaxeManager->updatePickaxe($item);
                    break;

                # iron
                case BlockTypeIds::IRON_ORE:
                    $amount = (mt_rand(20, 30) * $level);
                    $newData = $pickaxeEnergy + $amount;
                    $item->getNamedTag()->setInt("Energy", $newData);
                    $pickaxeManager->updatePickaxe($item);
                    break;
                case BlockTypeIds::IRON:
                    $amount = (mt_rand(40, 60) * $level);
                    $newData = $pickaxeEnergy + $amount;
                    $item->getNamedTag()->setInt("Energy", $newData);
                    $pickaxeManager->updatePickaxe($item);
                    break;

                # lapis
                case BlockTypeIds::LAPIS_LAZULI_ORE:
                    $amount = (mt_rand(30, 40) * $level);
                    $newData = $pickaxeEnergy + $amount;
                    $item->getNamedTag()->setInt("Energy", $newData);
                    $pickaxeManager->updatePickaxe($item);
                    break;
                case BlockTypeIds::LAPIS_LAZULI:
                    $amount = (mt_rand(60, 80) * $level);
                    $newData = $pickaxeEnergy + $amount;
                    $item->getNamedTag()->setInt("Energy", $newData);
                    $pickaxeManager->updatePickaxe($item);
                    break;

                # redstone
                case BlockTypeIds::REDSTONE_ORE:
                    $amount = (mt_rand(40, 50) * $level);
                    $newData = $pickaxeEnergy + $amount;
                    $item->getNamedTag()->setInt("Energy", $newData);
                    $pickaxeManager->updatePickaxe($item);
                    break;
                case BlockTypeIds::REDSTONE:
                    $amount = (mt_rand(80, 100) * $level);
                    $newData = $pickaxeEnergy + $amount;
                    $item->getNamedTag()->setInt("Energy", $newData);
                    $pickaxeManager->updatePickaxe($item);
                    break;

                # gold
                case BlockTypeIds::GOLD_ORE:
                    $amount = (mt_rand(50, 60) * $level);
                    $newData = $pickaxeEnergy + $amount;
                    $item->getNamedTag()->setInt("Energy", $newData);
                    $pickaxeManager->updatePickaxe($item);
                    break;
                case BlockTypeIds::GOLD:
                    $amount = (mt_rand(100, 120) * $level);
                    $newData = $pickaxeEnergy + $amount;
                    $item->getNamedTag()->setInt("Energy", $newData);
                    $pickaxeManager->updatePickaxe($item);
                    break;

                # diamond
                case BlockTypeIds::DIAMOND_ORE:
                    $amount = (mt_rand(60, 70) * $level);
                    $newData = $pickaxeEnergy + $amount;
                    $item->getNamedTag()->setInt("Energy", $newData);
                    $pickaxeManager->updatePickaxe($item);
                    break;
                case BlockTypeIds::DIAMOND:
                    $amount = (mt_rand(120, 140) * $level);
                    $newData = $pickaxeEnergy + $amount;
                    $item->getNamedTag()->setInt("Energy", $newData);
                    $pickaxeManager->updatePickaxe($item);
                    break;

                # emerald
                case BlockTypeIds::EMERALD_ORE:
                    $amount = (mt_rand(70, 80) * $level);
                    $newData = $pickaxeEnergy + $amount;
                    $item->getNamedTag()->setInt("Energy", $newData);
                    $pickaxeManager->updatePickaxe($item);
                    break;
                case BlockTypeIds::EMERALD:
                    $amount = (mt_rand(140, 160) * $level);
                    $newData = $pickaxeEnergy + $amount;
                    $item->getNamedTag()->setInt("Energy", $newData);
                    $pickaxeManager->updatePickaxe($item);
                    break;
            }
        }
    }

    public function getPriority(): int
    {
        return 2;
    }

}