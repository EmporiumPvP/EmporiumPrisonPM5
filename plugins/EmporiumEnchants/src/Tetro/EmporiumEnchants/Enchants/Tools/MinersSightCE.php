<?php

namespace Tetro\EmporiumEnchants\Enchants\Tools;

use Emporium\Prison\listeners\worlds\WorldListener;
use pocketmine\block\BlockTypeIds;
use pocketmine\item\Item;
use pocketmine\event\Event;
use pocketmine\player\Player;
use pocketmine\inventory\Inventory;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\entity\effect\{EffectInstance, VanillaEffects};
use Tetro\EmporiumEnchants\Core\CustomEnchant;
use Tetro\EmporiumEnchants\Core\Types\ReactiveEnchantment;


class MinersSightCE extends ReactiveEnchantment {

    # Register Enchantment
    public string $name = "Miners Sight";
    public string $description = "Grants you with permanent night vision.";
    public int $rarity = CustomEnchant::RARITY_ELITE;
    public int $cooldownDuration = 0;
    public int $maxLevel = 1;
    public int $chance = 1;

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

        if ($event instanceof BlockBreakEvent) {

            if($event->isCancelled()) return;

            $blockId = $event->getBlock()->getTypeId();

            if(!in_array($blockId, $this->ores)) return;

            $player->getEffects()->add(new EffectInstance(VanillaEffects::NIGHT_VISION(), 200, $level - 1, false));
        }
    }

    public function getPriority(): int
    {
        return 1;
    }
}