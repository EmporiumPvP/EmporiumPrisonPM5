<?php

namespace Tetro\EmporiumEnchants\Enchants\Tools;

use Emporium\Prison\listeners\worlds\WorldListener;
use pocketmine\block\BlockLegacyIds;
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

        if ($event instanceof BlockBreakEvent) {

            if($event->isCancelled()) return;

            $blockId = $event->getBlock()->getIdInfo()->getBlockId();

            if(!in_array($blockId, $this->ores)) {
                $event->cancel();
                return;
            }
            $player->getEffects()->add(new EffectInstance(VanillaEffects::NIGHT_VISION(), 200, $level - 1, false));
        }
    }

    public function getPriority(): int
    {
        return 1;
    }
}