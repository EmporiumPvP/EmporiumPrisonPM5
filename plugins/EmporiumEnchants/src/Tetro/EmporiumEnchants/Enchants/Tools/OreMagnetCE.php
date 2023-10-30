<?php

namespace Tetro\EmporiumEnchants\Enchants\Tools;

use Emporium\Prison\Managers\misc\Translator;

use pocketmine\block\BlockTypeIds;
use pocketmine\item\Item;
use pocketmine\event\Event;
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
    public int $chance = 400;

    # Compatibility
    public int $usageType = CustomEnchant::TYPE_HAND;
    public int $itemType = CustomEnchant::ITEM_TYPE_TOOLS;

    # Reagents
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

        if ($event->isCancelled()) return;

        // Chance
        $chance = floor($this->chance / $level);
        if (mt_rand(1, $chance) !== mt_rand(1, $chance)) return;

        $block = $event->getBlock();
        if(!in_array($block->getTypeId(), $this->ores)) return;

        $amount = (mt_rand(1, 30) * $level);
        switch($block->getTypeId()) {

            case BlockTypeIds::COAL_ORE:
                $player->getInventory()->addItem(StringToItemParser::getInstance()->parse("coal_ore")->setCount($amount));
                break;

            case BlockTypeIds::IRON_ORE:
                $player->getInventory()->addItem(StringToItemParser::getInstance()->parse("iron_ore")->setCount($amount));
                break;

            case BlockTypeIds::LAPIS_LAZULI_ORE:
                $player->getInventory()->addItem(StringToItemParser::getInstance()->parse("lapis_ore")->setCount($amount));
                break;

            case BlockTypeIds::REDSTONE_ORE:
                $player->getInventory()->addItem(StringToItemParser::getInstance()->parse("redstone_ore")->setCount($amount));
                break;

            case BlockTypeIds::GOLD_ORE:
                $player->getInventory()->addItem(StringToItemParser::getInstance()->parse("gold_ore")->setCount($amount));
                break;

            case BlockTypeIds::DIAMOND_ORE:
                $player->getInventory()->addItem(StringToItemParser::getInstance()->parse("diamond_ore")->setCount($amount));
                break;

            case BlockTypeIds::EMERALD_ORE:
                $player->getInventory()->addItem(StringToItemParser::getInstance()->parse("emerald_ore")->setCount($amount));
                break;
        }
        $player->sendMessage(TF::RED . "Ore Magnet" . TF::GREEN . " +$" . TF::WHITE . Translator::shortNumber($amount));
        $this->setCooldown($player, $this->cooldownDuration);

    }

    public function getPriority(): int
    {
        return 1;
    }
}