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
use pocketmine\Utils\TextFormat;
use Tetro\EmporiumEnchants\Core\CustomEnchant;
use Tetro\EmporiumEnchants\Core\Types\ReactiveEnchantment;

# Used Files

# Enchantment Class
class DivineEnlightenedCE extends ReactiveEnchantment
{

    # Register Enchantment
    public string $name = "Divine Enlightened";
    public string $description = "Grants you with high levels of regeneration and Exp on low health.";
    public int $rarity = CustomEnchant::RARITY_GODLY;
    public int $cooldownDuration = 35;
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
            $health = $player->getHealth();
            $exp = mt_rand(219 * $level, 947 * $level);
            if ($health <= 25) {
                $player->getEffects()->add(new EffectInstance(VanillaEffects::REGENERATION(), ($level * 10), ($level * 2), false));
                $player->sendTitle(TextFormat::BOLD . TextFormat::LIGHT_PURPLE . "Divine Enlightened", 20, 20, 20);
                $player->sendSubtitle(TextFormat::BOLD . TextFormat::LIGHT_PURPLE . "+" . $exp, 20, 20, 20);
                $player->getXpManager()->addXp($exp);
                $this->setCooldown($player, 35);
            }
        }
    }
}