<?php

# Namespaces
namespace Tetro\EmporiumEnchants\Enchants\Weapons\Global;

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
class RageCE extends ReactiveEnchantment
{

    # Register Enchantment
    public string $name = "Rage";
    public string $description = "Grants you with permanent strength.";
    public int $rarity = CustomEnchant::RARITY_ULTIMATE;
    public int $cooldownDuration = 0;
    public int $maxLevel = 4;
    public int $chance = 1;

    # Compatibility
    public int $usageType = CustomEnchant::TYPE_HAND;
    public int $itemType = CustomEnchant::ITEM_TYPE_WEAPON;

    # Reagents
    public function getReagent(): array
    {
        return [PlayerMoveEvent::class];
    }

    # Enchantment
    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void
    {
        // Enchantment Code
        if (!$player->getEffects()->has(VanillaEffects::STRENGTH()) || $player->getEffects()->get(VanillaEffects::STRENGTH())->getDuration() <= 240) {
            $player->getEffects()->add(new EffectInstance(VanillaEffects::STRENGTH(), 240, $level - 1, false));
            $this->setCooldown($player, 5);
        }
    }
}