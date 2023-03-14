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
class TitanTrapCE extends ReactiveEnchantment
{

    # Register Enchantment
    public string $name = "Titan Trap";
    public string $description = "Debuffs enemy to do less damage.";
    public int $rarity = CustomEnchant::RARITY_GODLY;
    public int $cooldownDuration = 0;
    public int $maxLevel = 10;
    public int $chance = 1;

    # Compatibility
    public int $usageType = CustomEnchant::TYPE_ARMOR_INVENTORY;
    public int $itemType = CustomEnchant::ITEM_TYPE_ARMOR;

    # Enchantment
    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void
    {
        // Chance
        $random = mt_rand(1, 1000);
        $chance = $level * 20;
        if ($chance <= $random) {
            return;
        }
        // Enchantment Code
        if ($event instanceof EntityDamageByEntityEvent) {
            $enemy = $event->getDamager();
            if ($enemy instanceof Player) {
                $enemy->getEffects()->add(new EffectInstance(VanillaEffects::WEAKNESS(), ($level * 20), $level - 1, false));
                $this->setCooldown($player, 8);
                $player->sendMessage("§l§d** Titan Trap **");
            }
        }
    }
}