<?php

# Namespaces
namespace Tetro\EmporiumEnchants\Enchants\Armour\Global;

# Pocketmine API
use pocketmine\entity\effect\{EffectInstance, VanillaEffects};
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Event;
use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\player\Player;
use Tetro\EmporiumEnchants\Core\CustomEnchant;
use Tetro\EmporiumEnchants\Core\Types\ReactiveEnchantment;

# Used Files

# Enchantment Class
class CurseCE extends ReactiveEnchantment
{

    # Register Enchantment
    public string $name = "Curse";
    public string $description = "Acquires slowness and strength when low on health.";
    public int $rarity = CustomEnchant::RARITY_ULTIMATE;
    public int $cooldownDuration = 0;
    public int $maxLevel = 5;
    public int $chance = 1;

    # Compatibility
    public int $usageType = CustomEnchant::TYPE_ARMOR_INVENTORY;
    public int $itemType = CustomEnchant::ITEM_TYPE_ARMOR;

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
            $enemy = $event->getDamager();
            if ($enemy instanceof Player) {
                $player->getEffects()->add(new EffectInstance(VanillaEffects::STRENGTH(), 10, $level * 3, false));
                $player->getEffects()->add(new EffectInstance(VanillaEffects::SLOWNESS(), 10, 1, false));
                $player->sendMessage("§l§e** Curse **");
                $this->setCooldown($player, 15);
            }
        }
    }
}