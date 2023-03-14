<?php

# Namespaces
namespace Tetro\EmporiumEnchants\Enchants\Weapons\Axe;

# Pocketmine API
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Event;
use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\player\Player;
use Tetro\EmporiumEnchants\Core\{CustomEnchant, CustomEnchantIds};
use Tetro\EmporiumEnchants\Core\Types\ReactiveEnchantment;

# Used Files

# Enchantment Class
class InsanityCE extends ReactiveEnchantment
{

    # Register Enchantment
    public string $name = "Insanity";
    public string $description = "Deal extra damage to the enemy.";
    public int $rarity = CustomEnchant::RARITY_LEGENDARY;
    public int $cooldownDuration = 5;
    public int $maxLevel = 7;
    public int $chance = 1;

    # Compatibility
    public int $usageType = CustomEnchant::TYPE_HAND;
    public int $itemType = CustomEnchant::ITEM_TYPE_AXE;

    # Reagents
    public function getReagent(): array
    {
        return [EntityDamageByEntityEvent::class];
    }

    # Enchantment
    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void
    {
        // Enchantment Code
        if ($event instanceof EntityDamageByEntityEvent) {
            $event->setModifier(2 + $level * 0.2, CustomEnchantIds::INSANITY);
            $this->setCooldown($player, 5);
        }
        $player->sendMessage("§l§6** Insanity **");
    }
}