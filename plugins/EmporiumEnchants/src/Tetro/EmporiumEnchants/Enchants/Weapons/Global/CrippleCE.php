<?php

# Namespaces
namespace Tetro\EmporiumEnchants\Enchants\Weapons\Global;

# Pocketmine API
use pocketmine\entity\effect\{EffectInstance, VanillaEffects};
use pocketmine\event\Event;
use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\player\Player;
use Tetro\EmporiumEnchants\Core\{CustomEnchant};
use Tetro\EmporiumEnchants\Core\Types\ReactiveEnchantment;

# Used Files

# Enchantment Class
class CrippleCE extends ReactiveEnchantment
{

    # Register Enchantment
    public string $name = "Cripple";
    public string $description = "Has a chance to inflict your opponent with nausea and slowness.";
    public int $rarity = CustomEnchant::RARITY_ULTIMATE;
    public int $cooldownDuration = 40;
    public int $maxLevel = 5;
    public int $chance = 300;

    # Compatibility
    public int $usageType = CustomEnchant::TYPE_HAND;
    public int $itemType = CustomEnchant::ITEM_TYPE_WEAPON;

    # Enchantment
    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void
    {
        $enemy = $event->getEntity();
        $damager = $event->getDamager();
        if ((!$enemy instanceof Player) or (!$damager instanceof Player)) {
            return;
        }
        $enemy = $event->getEntity();
        $enemy->getEffects()->add(new EffectInstance(VanillaEffects::NAUSEA(), $level * 20, 1, false));
        $enemy->getEffects()->add(new EffectInstance(VanillaEffects::SLOWNESS(), $level * 20, 2, false));
        $this->setCooldown($player, 30);
        $player->sendMessage("§l§e** Cripple **");
    }
}