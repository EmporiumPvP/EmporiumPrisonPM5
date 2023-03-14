<?php

# Namespaces
namespace Tetro\EmporiumEnchants\Enchants\Armour\Helmet;

# Pocketmine API
use pocketmine\event\Event;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\player\Player;
use Tetro\EmporiumEnchants\Core\CustomEnchant;
use Tetro\EmporiumEnchants\Core\Types\ReactiveEnchantment;

# Used Files

# Enchantment Class
class ImplantsCE extends ReactiveEnchantment
{

    # Register Enchantment
    public string $name = "Implants";
    public string $description = "Refills your hunger.";
    public int $rarity = CustomEnchant::RARITY_LEGENDARY;
    public int $cooldownDuration = 0;
    public int $maxLevel = 3;
    public int $chance = 1;

    # Compatibility
    public int $usageType = CustomEnchant::TYPE_HELMET;
    public int $itemType = CustomEnchant::ITEM_TYPE_HELMET;

    # Reagents
    public function getReagent(): array
    {
        return [PlayerMoveEvent::class];
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
        if ($event instanceof PlayerMoveEvent) {
            $player->getHungerManager()->setFood($player->getHungerManager()->getMaxFood());
        }
    }
}