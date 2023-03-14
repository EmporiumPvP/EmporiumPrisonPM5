<?php

# Namespaces
namespace Tetro\EmporiumEnchants\Enchants\Armour\Boots;

# Pocketmine API
use pocketmine\entity\effect\{EffectInstance, VanillaEffects};
use pocketmine\event\Event;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\player\Player;
use Tetro\EmporiumEnchants\Core\CustomEnchant;
use Tetro\EmporiumEnchants\Core\Types\ReactiveEnchantment;

# Used Files

# Enchantment Class
class GearsCE extends ReactiveEnchantment
{

    # Register Enchantment
    public string $name = "Gears";
    public string $description = "Grants the wearer permanent speed according to the level.";
    public int $rarity = CustomEnchant::RARITY_ELITE;
    public int $cooldownDuration = 0;
    public int $maxLevel = 2;
    public int $chance = 1;

    # Compatibility
    public int $usageType = CustomEnchant::TYPE_BOOTS;
    public int $itemType = CustomEnchant::ITEM_TYPE_BOOTS;

    # Reagents
    public function getReagent(): array
    {
        return [PlayerMoveEvent::class];
    }

    # Enchantment
    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void
    {
        // Enchantment Code
        if ($event instanceof PlayerMoveEvent) {
            $player->getEffects()->add(new EffectInstance(VanillaEffects::SPEED(), 200, $level - 1, false));
        }
    }
}