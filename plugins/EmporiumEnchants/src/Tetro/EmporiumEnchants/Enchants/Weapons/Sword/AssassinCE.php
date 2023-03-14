<?php

# Namespaces
namespace Tetro\EmporiumEnchants\Enchants\Weapons\Sword;

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
class AssassinCE extends ReactiveEnchantment
{

    # Register Enchantment
    public string $name = "Assassin";
    public string $description = "Deal extra damage to the enemy.";
    public int $rarity = CustomEnchant::RARITY_LEGENDARY;
    public int $cooldownDuration = 0;
    public int $maxLevel = 5;
    public int $chance = 1;

    # Compatibility
    public int $usageType = CustomEnchant::TYPE_HAND;
    public int $itemType = CustomEnchant::ITEM_TYPE_SWORD;

    # Reagents
    public function getReagent(): array
    {
        return [EntityDamageByEntityEvent::class];
    }

    # Enchantment
    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void
    {
        // Chance
        $random = mt_rand(1, 1000);
        $chance = $level * 10;
        if ($chance <= $random) {
            return;
        }
        // Enchantment Code
        if ($event instanceof EntityDamageByEntityEvent) {
            $enemy = $event->getEntity();
            if ($enemy instanceof Player) {
                $event->setModifier(2 + $level * 0.5, CustomEnchantIds::ASSASSIN);
                $this->setCooldown($player, 5);
            }
            $player->sendMessage("§l§6** ASSASSIN **");
        }
    }
}