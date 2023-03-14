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
class BlindCE extends ReactiveEnchantment
{

    # Register Enchantment
    public string $name = "Blind";
    public string $description = "Has a chance to inflict your opponent with blindness.";
    public int $rarity = CustomEnchant::RARITY_ELITE;
    public int $cooldownDuration = 15;
    public int $maxLevel = 5;
    public int $chance = 500;

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
        $enemy->getEffects()->add(new EffectInstance(VanillaEffects::BLINDNESS(), $level * 20, $level - 1, false));
        $player->sendMessage("§l§b** Blind **");
        $this->setCooldown($player, 60);
    }
}