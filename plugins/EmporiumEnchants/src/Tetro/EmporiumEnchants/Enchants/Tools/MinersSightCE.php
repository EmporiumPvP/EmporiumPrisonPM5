<?php

namespace Tetro\EmporiumEnchants\Enchants\Tools;

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
    public int $rarity = CustomEnchant::RARITY_PICKAXE;
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
    
    # Enchantment
    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void {
        // Enchantment Code
        if ($event instanceof BlockBreakEvent) {
            $player->getEffects()->add(new EffectInstance(VanillaEffects::NIGHT_VISION(), 200, $level - 1, false));
        }
    }
}