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

class MeteorSummonerCE extends ReactiveEnchantment {

    # Register Enchantment
    public string $name = "Meteor Summoner";
    public string $description = "Chance of Summoning a Meteor.";
    public int $rarity = CustomEnchant::RARITY_EXECUTIVE;
    public int $cooldownDuration = 300;
    public int $maxLevel = 5;
    public int $chance = 5000;

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

        // Chance
        $chance = floor($this->chance / $level);
        if (mt_rand(1, $chance) !== mt_rand(1, $chance)) return;

        $player->sendActionBarMessage(TextFormat::RED . "Meteor Summoner");

        switch($level) {

            case 1:
                # spawn elite meteor
                break;

            case 2:
                # spawn ultimate meteor
                break;

            case 3:
                # spawn legendary meteor
                break;

            case 4:
                # spawn godly meteor
                break;

            case 5:
                # spawn heroic meteor
                break;
        }
        $this->setCooldown($player, $this->cooldownDuration);
    }

    public function getPriority(): int
    {
        return 6;
    }
}