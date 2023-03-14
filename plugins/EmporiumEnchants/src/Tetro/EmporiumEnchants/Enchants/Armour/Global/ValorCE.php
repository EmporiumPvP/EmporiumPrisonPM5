<?php

# Namespaces
namespace Tetro\EmporiumEnchants\Enchants\Armour\Global;

# Pocketmine API
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Event;
use pocketmine\inventory\Inventory;
use pocketmine\item\{Item, Sword};
use pocketmine\player\Player;
use Tetro\EmporiumEnchants\Core\{CustomEnchant, CustomEnchantIds};
use Tetro\EmporiumEnchants\Core\Types\ReactiveEnchantment;

# Used Files

# Enchantment Class
class ValorCE extends ReactiveEnchantment
{

    # Register Enchantment
    public string $name = "Valor";
    public string $description = "Reduce the amount of damage dealt to you slightly.";
    public int $rarity = CustomEnchant::RARITY_ULTIMATE;
    public int $cooldownDuration = 0;
    public int $maxLevel = 8;
    public int $chance = 1;

    # Compatibility
    public int $usageType = CustomEnchant::TYPE_ARMOR_INVENTORY;
    public int $itemType = CustomEnchant::ITEM_TYPE_ARMOR;

    # Enchantment
    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void
    {
        // Enchantment Code
        if ($event instanceof EntityDamageByEntityEvent) {
            $enemy = $event->getDamager();
            if ($enemy instanceof Player) {
                $hand = $enemy->getInventory()->getItemInHand();
                if ($hand instanceof Sword) {
                    $event->setModifier(-($event->getFinalDamage() * 0.01 * $level), CustomEnchantIds::VALOR);
                }
            }
        }
    }
}