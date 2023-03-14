<?php

# Namespaces
namespace Tetro\EmporiumEnchants\Enchants\Global;

# Pocketmine API
use pocketmine\event\Event;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\inventory\Inventory;
use pocketmine\item\{Durable, Item};
use pocketmine\player\Player;
use Tetro\EmporiumEnchants\Core\CustomEnchant;
use Tetro\EmporiumEnchants\Core\Types\ReactiveEnchantment;

# Used Files

# Enchantment Class
class AutoRepairCE extends ReactiveEnchantment
{

    # Register Enchantment
    public string $name = "Auto Repair";
    public string $description = "Automatically repairs your items for experience.";
    public int $rarity = CustomEnchant::RARITY_HEROIC;
    public int $cooldownDuration = 0;
    public int $maxLevel = 10;
    public int $chance = 1;

    # Compatibility
    public int $usageType = CustomEnchant::TYPE_ANY_INVENTORY;
    public int $itemType = CustomEnchant::ITEM_TYPE_DAMAGEABLE;

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
            if (!$item instanceof Durable || $item->getMeta() === 0 || $player->getXpManager()->getCurrentTotalXp() < 10000) {
                return;
            }
            $newDir = $item->getMeta() - $level;
            if ($newDir < 0) {
                $item->setDamage(0);
            } else {
                $item->setDamage($newDir);
            }
            $player->getXpManager()->subtractXp(1000 * $level);
            $inventory->setItem($slot, $item);
        }
    }
}