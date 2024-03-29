<?php

# Namespaces
namespace Tetro\EmporiumEnchants\Enchants\Weapons\Global;

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
class GravityCE extends ReactiveEnchantment
{

    # Register Enchantment
    public string $name = "Gravity";
    public string $description = "Inflict the enemy with levitation.";
    public int $rarity = CustomEnchant::RARITY_LEGENDARY;
    public int $cooldownDuration = 0;
    public int $maxLevel = 5;
    public int $chance = 1;

    # Compatibility
    public int $usageType = CustomEnchant::TYPE_HAND;
    public int $itemType = CustomEnchant::ITEM_TYPE_WEAPON;

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
        $enemy = $event->getEntity();
        $damager = $event->getDamager();
        if ((!$enemy instanceof Player) or (!$damager instanceof Player)) {
            return;
        }
        // Enchantment Code
        $enemy = $event->getEntity();
        $enemy->getEffects()->add(new EffectInstance(VanillaEffects::LEVITATION(), (20 * $level), $level - 1, false));
        $player->sendMessage("§l§b** Gravity **");
        $this->setCooldown($player, 30);
    }
}