<?php

# Namespaces
namespace Tetro\EmporiumEnchants\Enchants\Armour\Helmet;

# Pocketmine API
use pocketmine\entity\effect\VanillaEffects;
use pocketmine\event\entity\EntityEffectAddEvent;
use pocketmine\event\Event;
use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\player\Player;
use Tetro\EmporiumEnchants\Core\CustomEnchant;
use Tetro\EmporiumEnchants\Core\Types\ReactiveEnchantment;

# Used Files

# Enchantment Class
class FocusedCE extends ReactiveEnchantment
{

    # Register Enchantment
    public string $name = "Focused";
    public string $description = "Negates nausea. (10% x Level)";
    public int $rarity = CustomEnchant::RARITY_ULTIMATE;
    public int $cooldownDuration = 0;
    public int $maxLevel = 10;
    public int $chance = 1;

    # Compatibility
    public int $usageType = CustomEnchant::TYPE_HELMET;
    public int $itemType = CustomEnchant::ITEM_TYPE_HELMET;

    # Reagents
    public function getReagent(): array
    {
        return [EntityEffectAddEvent::class];
    }

    # Enchantment
    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void
    {
        // Chance
        $random = mt_rand(1, 1000);
        $chance = $level * 100;
        if ($chance <= $random) {
            return;
        }
        // Enchantment Code
        if ($event instanceof EntityEffectAddEvent) {
            if ($event->getEffect()->getType() === VanillaEffects::NAUSEA()) {
                $event->cancel();
            }
        }
    }
}