<?php

namespace Tetro\EmporiumEnchants\Enchants\Tools;

use Emporium\Prison\Managers\misc\Translator;
use pocketmine\block\BlockLegacyIds;
use pocketmine\item\Item;
use pocketmine\event\Event;
use pocketmine\item\ItemIds;
use pocketmine\item\StringToItemParser;
use pocketmine\player\Player;
use pocketmine\inventory\Inventory;
use pocketmine\event\block\BlockBreakEvent;

use pocketmine\utils\TextFormat as TF;
use Tetro\EmporiumEnchants\Core\CustomEnchant;
use Tetro\EmporiumEnchants\Core\Types\ReactiveEnchantment;

class OreMagnetCE extends ReactiveEnchantment {

    # Register Enchantment
    public string $name = "Ore Magnet";
    public string $description = "Receive more ores from mining.";
    public int $rarity = CustomEnchant::RARITY_ELITE;
    public int $cooldownDuration = 30;
    public int $maxLevel = 5;
    public int $chance = 1;

    # Compatibility
    public int $usageType = CustomEnchant::TYPE_HAND;
    public int $itemType = CustomEnchant::ITEM_TYPE_TOOLS;

    # Reagents
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

        // Chance
        $chance = floor(400 / $level);
        if (mt_rand(1, $chance) !== mt_rand(1, $chance)) {
            return;
        }
        // Enchantment Code
        if ($event instanceof BlockBreakEvent) {
            $block = $event->getBlock();
            if(in_array($block->getIdInfo()->getBlockId(), $this->blocks)) {
                $amount = (mt_rand(1, 30) * $level);
                switch($block->getIdInfo()->getBlockId()) {

                    case ItemIds::COAL_ORE:
                        $player->getInventory()->addItem(StringToItemParser::getInstance()->parse("coal_ore")->setCount($amount));
                        break;

                    case ItemIds::IRON_ORE:
                        $player->getInventory()->addItem(StringToItemParser::getInstance()->parse("iron_ore")->setCount($amount));
                        break;

                    case ItemIds::LAPIS_ORE:
                        $player->getInventory()->addItem(StringToItemParser::getInstance()->parse("lapis_ore")->setCount($amount));
                        break;

                    case ItemIds::REDSTONE_ORE:
                        $player->getInventory()->addItem(StringToItemParser::getInstance()->parse("redstone_ore")->setCount($amount));
                        break;

                    case ItemIds::GOLD_ORE:
                        $player->getInventory()->addItem(StringToItemParser::getInstance()->parse("gold_ore")->setCount($amount));
                        break;

                    case ItemIds::DIAMOND_ORE:
                        $player->getInventory()->addItem(StringToItemParser::getInstance()->parse("diamond_ore")->setCount($amount));
                        break;

                    case ItemIds::EMERALD_ORE:
                        $player->getInventory()->addItem(StringToItemParser::getInstance()->parse("emerald_ore")->setCount($amount));
                        break;
                }
                $player->sendMessage(TF::RED . "Ore Magnet" . TF::GREEN . " +$" . TF::WHITE . Translator::shortNumber($amount));
                $this->setCooldown($player, 30);
            }
        }
    }

    public function getPriority(): int
    {
        return 1;
    }
}