<?php

# Namespaces
namespace Tetro\EmporiumEnchants\Enchants\Armour\Global;

# Pocketmine API
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Event;
use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\player\Player;
use Tetro\EmporiumEnchants\Core\CustomEnchant;
use Tetro\EmporiumEnchants\Core\Types\ReactiveEnchantment;

# Used Files

# Enchantment Class
class HeatWaveCE extends ReactiveEnchantment
{

    # Register Enchantment
    public string $name = "HeatWave";
    public string $description = "Light your enemies on fire.";
    public int $rarity = CustomEnchant::RARITY_GODLY;
    public int $cooldownDuration = 0;
    public int $maxLevel = 4;
    public int $chance = 1;

    # Compatibility
    public int $usageType = CustomEnchant::TYPE_ARMOR_INVENTORY;
    public int $itemType = CustomEnchant::ITEM_TYPE_ARMOR;

    # Enchantment
    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void
    {
        // Chance
        $random = mt_rand(1, 1000);
        $chance = $level * 5;
        if ($chance <= $random) {
            return;
        }
        // Enchantment Code
        if ($event instanceof EntityDamageByEntityEvent) {
            $enemy = $event->getDamager();
            if ($enemy instanceof Player) {
                $enemy->setOnFire($level);
                $player->sendMessage("§l§d** Heatwave **");
                $this->setCooldown($player, 20);
            }
        }
    }
}