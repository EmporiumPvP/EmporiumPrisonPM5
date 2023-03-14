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
class VoodooCE extends ReactiveEnchantment
{

    # Register Enchantment
    public string $name = "Voodoo";
    public string $description = "Inflict your enemy with a lot off negative effects.";
    public int $rarity = CustomEnchant::RARITY_ULTIMATE;
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
        $chance = $level * 10;
        if ($chance <= $random) {
            return;
        }
        // Enchantment Code
        if ($event instanceof EntityDamageByEntityEvent) {
            $enemy = $event->getDamager();
            if ($enemy instanceof Player) {
                $enemy->getEffects()->add(new EffectInstance(VanillaEffects::MINING_FATIGUE(), ($level * 20), $level - 1, false));
                $enemy->getEffects()->add(new EffectInstance(VanillaEffects::NAUSEA(), ($level * 20), $level - 1, false));
                $enemy->getEffects()->add(new EffectInstance(VanillaEffects::POISON(), ($level * 20), $level - 1, false));
                $enemy->getEffects()->add(new EffectInstance(VanillaEffects::WITHER(), ($level * 20), $level - 1, false));
                $this->setCooldown($player, 20);
                $player->sendMessage("§l§e** Voodoo **");
            }
        }
    }
}