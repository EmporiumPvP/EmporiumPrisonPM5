<?php

namespace Tetro\EmporiumEnchants\Enchants\Tools;

use pocketmine\block\BlockTypeIds;
use pocketmine\event\Event;

use pocketmine\item\Item;
use pocketmine\item\StringToItemParser;

use pocketmine\player\Player;

use pocketmine\inventory\Inventory;

use pocketmine\event\block\BlockBreakEvent;

use pocketmine\utils\TextFormat;

use pocketmine\world\sound\FizzSound;
use Tetro\EmporiumEnchants\Core\CustomEnchant;
use Tetro\EmporiumEnchants\Core\Types\ReactiveEnchantment;

class TransfuseCE extends ReactiveEnchantment {

    # Register Enchantment
    public string $name = "Transfuse";
    public string $description = "Chance to upgrade mined materials .";
    public int $rarity = CustomEnchant::RARITY_ELITE;
    public int $cooldownDuration = 30;
    public int $maxLevel = 3;
    public int $chance = 200;

    # Compatibility
    public int $usageType = CustomEnchant::TYPE_HAND;
    public int $itemType = CustomEnchant::ITEM_TYPE_TOOLS;

    # Reagents
    public function getReagent(): array {
        return [BlockBreakEvent::class];
    }

    private array $upgradableBlocks = [
        BlockTypeIds::COAL_ORE, BlockTypeIds::COAL,
        BlockTypeIds::IRON_ORE, BlockTypeIds::IRON,
        BlockTypeIds::LAPIS_LAZULI_ORE, BlockTypeIds::LAPIS_LAZULI,
        BlockTypeIds::REDSTONE_ORE, BlockTypeIds::REDSTONE,
        BlockTypeIds::GOLD_ORE, BlockTypeIds::GOLD,
        BlockTypeIds::DIAMOND_ORE, BlockTypeIds::DIAMOND,
        BlockTypeIds::EMERALD_ORE, BlockTypeIds::EMERALD,
    ];

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

        if ($event->isCancelled()) return;

        if(!in_array($event->getBlock()->getTypeId(), $this->ores)) return;

        $chance = floor($this->chance / $level);
        if (mt_rand(1, $chance) !== mt_rand(1, $chance)) return;

        $block = $event->getBlock()->getTypeId();
        if(in_array($block, $this->upgradableBlocks)) {
            switch($block) {

                case BlockTypeIds::COAL_ORE:
                    $player->getInventory()->addItem(StringToItemParser::getInstance()->parse("iron_ore"));
                    break;

                case BlockTypeIds::COAL:
                    $player->getInventory()->addItem(StringToItemParser::getInstance()->parse("iron_block"));
                    break;

                case BlockTypeIds::IRON_ORE:
                    $player->getInventory()->addItem(StringToItemParser::getInstance()->parse("lapis_ore"));
                    break;

                case BlockTypeIds::IRON:
                    $player->getInventory()->addItem(StringToItemParser::getInstance()->parse("lapis_block"));
                    break;

                case BlockTypeIds::LAPIS_LAZULI_ORE:
                    $player->getInventory()->addItem(StringToItemParser::getInstance()->parse("redstone_ore"));
                    break;

                case BlockTypeIds::LAPIS_LAZULI:
                    $player->getInventory()->addItem(StringToItemParser::getInstance()->parse("redstone_block"));
                    break;

                case BlockTypeIds::REDSTONE_ORE:
                    $player->getInventory()->addItem(StringToItemParser::getInstance()->parse("gold_ore"));
                    break;

                case BlockTypeIds::REDSTONE:
                    $player->getInventory()->addItem(StringToItemParser::getInstance()->parse("gold_block"));
                    break;

                case BlockTypeIds::GOLD_ORE:
                    $player->getInventory()->addItem(StringToItemParser::getInstance()->parse("diamond_ore"));
                    break;

                case BlockTypeIds::GOLD:
                    $player->getInventory()->addItem(StringToItemParser::getInstance()->parse("diamond_block"));
                    break;

                case BlockTypeIds::DIAMOND_ORE:
                    $player->getInventory()->addItem(StringToItemParser::getInstance()->parse("emerald_ore"));
                    break;

                case BlockTypeIds::DIAMOND:
                    $player->getInventory()->addItem(StringToItemParser::getInstance()->parse("emerald_block"));
                    break;
            }
            $player->broadcastSound(new FizzSound(), [$player]);
            $player->sendMessage(TextFormat::RED . "Transfusion");
        }
        $this->setCooldown($player, $this->cooldownDuration);
    }

    public function getPriority(): int
    {
        return 1;
    }
}