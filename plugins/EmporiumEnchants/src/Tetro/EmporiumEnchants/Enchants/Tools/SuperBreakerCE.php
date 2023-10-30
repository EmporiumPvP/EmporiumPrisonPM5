<?php

namespace Tetro\EmporiumEnchants\Enchants\Tools;

use pocketmine\block\BlockTypeIds;
use pocketmine\item\Item;
use pocketmine\event\Event;
use pocketmine\player\Player;
use pocketmine\inventory\Inventory;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\entity\effect\{EffectInstance, VanillaEffects};

use pocketmine\utils\TextFormat;
use pocketmine\world\sound\GhastShootSound;

use Tetro\EmporiumEnchants\Core\CustomEnchant;
use Tetro\EmporiumEnchants\Core\Types\ReactiveEnchantment;

class SuperBreakerCE extends ReactiveEnchantment {

    # Register Enchantment
    public string $name = "Super Breaker";
    public string $description = "Chance to gain an insane mining speed boost for a short amount of time.";
    public int $rarity = CustomEnchant::RARITY_LEGENDARY;
    public int $cooldownDuration = 30;
    public int $maxLevel = 10;
    public int $chance = 500;

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

        if(!in_array(abs($event->getBlock()->getTypeId()), $this->ores)) return;

        // Chance
        $chance = floor($this->chance / $level);
        if (mt_rand(1, $chance) !== mt_rand(1, $chance)) return;

        $player->getEffects()->add(new EffectInstance(VanillaEffects::HASTE(), 100, 25 * $level, false));
        $player->broadcastSound(new GhastShootSound(), [$player]);
        $player->sendMessage(TextFormat::RED . "Super Breaker");
        $this->setCooldown($player, $this->cooldownDuration);
    }

    public function getPriority(): int
    {
        return 3;
    }
}