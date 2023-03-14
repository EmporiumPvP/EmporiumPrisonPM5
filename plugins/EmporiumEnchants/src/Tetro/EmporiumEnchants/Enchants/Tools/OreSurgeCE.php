<?php

namespace Tetro\EmporiumEnchants\Enchants\Tools;


use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\Event;

use pocketmine\inventory\Inventory;

use pocketmine\item\Item;
use pocketmine\item\ItemIds;
use pocketmine\item\StringToItemParser;

use pocketmine\player\Player;
use pocketmine\utils\TextFormat;
use Tetro\EmporiumEnchants\Core\CustomEnchant;
use Tetro\EmporiumEnchants\Core\Types\ReactiveEnchantment;

class OreSurgeCE extends ReactiveEnchantment {

    # Register Enchantment
    public string $name = "Ore Surge";
    public string $description = "Chance to shoot a bolt of energy into the ore enriching it .";
    public int $rarity = CustomEnchant::RARITY_PICKAXE;
    public int $cooldownDuration = 0;
    public int $maxLevel = 10;
    public int $chance = 1;

    # Compatibility
    public int $usageType = CustomEnchant::TYPE_HAND;
    public int $itemType = CustomEnchant::ITEM_TYPE_TOOLS;

    # Reagents
    public function getReagent(): array
    {
        return [BlockBreakEvent::class];
    }

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
        $chance = floor(500 / $level);
        if (mt_rand(1, $chance) !== mt_rand(1, $chance)) {
            return;
        }
        // Enchantment Code
        if ($event instanceof BlockBreakEvent) {
            $block = $event->getBlock();
            if(in_array($block->getIdInfo()->getBlockId(), $this->blocks)) {
                $amount = (mt_rand(5, 25) * $level);
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
                $player->sendMessage(TextFormat::RED . "Ore Surge");
                $this->setCooldown($player, 1);
            }
        }
    }

}