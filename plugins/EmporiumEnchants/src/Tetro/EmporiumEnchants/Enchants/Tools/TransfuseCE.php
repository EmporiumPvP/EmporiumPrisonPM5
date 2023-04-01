<?php

namespace Tetro\EmporiumEnchants\Enchants\Tools;

use pocketmine\block\BlockLegacyIds;
use pocketmine\event\Event;

use pocketmine\item\Item;
use pocketmine\item\ItemIds;
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
    public int $cooldownDuration = 0;
    public int $maxLevel = 3;
    public int $chance = 1;

    # Compatibility
    public int $usageType = CustomEnchant::TYPE_HAND;
    public int $itemType = CustomEnchant::ITEM_TYPE_TOOLS;

    # Reagents
    public function getReagent(): array {
        return [BlockBreakEvent::class];
    }

    private array $upgradableBlocks = [
        ItemIds::COAL_ORE, ItemIds::COAL_BLOCK,
        ItemIds::IRON_ORE, ItemIds::IRON_BLOCK,
        ItemIds::LAPIS_ORE, ItemIds::LAPIS_BLOCK,
        ItemIds::REDSTONE_ORE, ItemIds::REDSTONE_BLOCK,
        ItemIds::GOLD_ORE, ItemIds::GOLD_BLOCK,
        ItemIds::DIAMOND_ORE, ItemIds::DIAMOND_BLOCK,
        ItemIds::EMERALD_ORE, ItemIds::EMERALD_BLOCK
    ];

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

    # Enchantment
    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void {
        // Chance
        $chance = floor(200 / $level);
        if (mt_rand(1, $chance) !== mt_rand(1, $chance)) {
            return;
        }
        // Enchantment Code
        if ($event instanceof BlockBreakEvent) {

            $block = $event->getBlock()->getIdInfo()->getBlockId();
            if(in_array($block, $this->upgradableBlocks)) {
                switch($block) {

                    case ItemIds::COAL_ORE:
                        $player->getInventory()->addItem(StringToItemParser::getInstance()->parse("iron_ore"));
                        break;

                    case ItemIds::COAL_BLOCK:
                        $player->getInventory()->addItem(StringToItemParser::getInstance()->parse("iron_block"));
                        break;

                    case ItemIds::IRON_ORE:
                        $player->getInventory()->addItem(StringToItemParser::getInstance()->parse("lapis_ore"));
                        break;

                    case ItemIds::IRON_BLOCK:
                        $player->getInventory()->addItem(StringToItemParser::getInstance()->parse("lapis_block"));
                        break;

                    case ItemIds::LAPIS_ORE:
                        $player->getInventory()->addItem(StringToItemParser::getInstance()->parse("redstone_ore"));
                        break;

                    case ItemIds::LAPIS_BLOCK:
                        $player->getInventory()->addItem(StringToItemParser::getInstance()->parse("redstone_block"));
                        break;

                    case ItemIds::REDSTONE_ORE:
                        $player->getInventory()->addItem(StringToItemParser::getInstance()->parse("gold_ore"));
                        break;

                    case ItemIds::REDSTONE_BLOCK:
                        $player->getInventory()->addItem(StringToItemParser::getInstance()->parse("gold_block"));
                        break;

                    case ItemIds::GOLD_ORE:
                        $player->getInventory()->addItem(StringToItemParser::getInstance()->parse("diamond_ore"));
                        break;

                    case ItemIds::GOLD_BLOCK:
                        $player->getInventory()->addItem(StringToItemParser::getInstance()->parse("diamond_block"));
                        break;

                    case ItemIds::DIAMOND_ORE:
                        $player->getInventory()->addItem(StringToItemParser::getInstance()->parse("emerald_ore"));
                        break;

                    case ItemIds::DIAMOND_BLOCK:
                        $player->getInventory()->addItem(StringToItemParser::getInstance()->parse("emerald_block"));
                        break;
                }
                $player->broadcastSound(new FizzSound(), [$player]);
                $player->sendMessage(TextFormat::RED . "Transfusion");
            }
            $this->setCooldown($player, 1);
        }
    }

    public function getPriority(): int
    {
        return 1;
    }
}