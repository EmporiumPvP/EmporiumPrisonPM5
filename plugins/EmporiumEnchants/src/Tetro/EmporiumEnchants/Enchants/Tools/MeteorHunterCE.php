<?php

namespace Tetro\EmporiumEnchants\Enchants\Tools;

use pocketmine\block\BlockTypeIds;
use pocketmine\item\Item;
use pocketmine\event\Event;
use pocketmine\player\Player;
use pocketmine\inventory\Inventory;
use pocketmine\event\block\BlockBreakEvent;

use pocketmine\utils\TextFormat;
use Tetro\EmporiumEnchants\Core\CustomEnchant;
use Tetro\EmporiumEnchants\Core\Types\ReactiveEnchantment;

class MeteorHunterCE extends ReactiveEnchantment {

    # Register Enchantment
    public string $name = "Meteor Hunter";
    public string $description = "Chance of receiving double Contrabands when mining Meteors.";
    public int $rarity = CustomEnchant::RARITY_HEROIC;
    public int $cooldownDuration = 10;
    public int $maxLevel = 5;
    public int $chance = 2500;

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

        // Enchantment Code
        if (!$event instanceof BlockBreakEvent) return;

        if ($event->isCancelled()) return;

        if(!in_array($event->getBlock()->getTypeId(), $this->ores)) return;

        var_dump("Chance: " . $this->chance);
        var_dump("Level: " . $level);
        // Chance
        $chance = floor($this->chance / $level);
        var_dump("New chance: " . $chance);
        $number1 = mt_rand(1, $chance);
        $number2 = mt_rand(1, $chance);
        var_dump("Number 1: " . $number1);
        var_dump("Number 2: " . $number2);
        if ($number1 !== $number2) return;

        # add logic
        $player->sendMessage(TextFormat::RED . "Meteor Hunter");
        $this->setCooldown($player, $this->cooldownDuration);
    }

    public function getPriority(): int
    {
        return 5;
    }
}