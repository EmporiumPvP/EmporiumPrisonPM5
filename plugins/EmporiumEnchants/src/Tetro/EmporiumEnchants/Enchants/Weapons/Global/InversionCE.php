<?php

# Namespaces
namespace Tetro\EmporiumEnchants\Enchants\Weapons\Global;

# Pocketmine API
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Event;
use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\player\Player;
use Tetro\EmporiumEnchants\Core\{CustomEnchant};
use Tetro\EmporiumEnchants\Core\Types\ReactiveEnchantment;

# Used Files

# Enchantment Class
class InversionCE extends ReactiveEnchantment
{

    # Register Enchantment
    public string $name = "Inversion";
    public string $description = "Has a chance to steal your opponents EXP.";
    public int $rarity = CustomEnchant::RARITY_LEGENDARY;
    public int $cooldownDuration = 0;
    public int $maxLevel = 10;
    public int $chance = 10000;

    # Compatibility
    public int $usageType = CustomEnchant::TYPE_HAND;
    public int $itemType = CustomEnchant::ITEM_TYPE_WEAPON;

    # Enchantment
    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void
    {
        if ($event instanceof EntityDamageByEntityEvent) {
            $exp = mt_rand(50 * $level, 100 * $level);
            $entity = $event->getEntity();
            $damager = $event->getDamager();
            if((!$entity instanceof Player) or (!$damager instanceof Player)) {
                return;
            }
            if ($entity->getXpManager()->getCurrentTotalXp() - $exp > 0) {
                $entity->getXpManager()->subtractXp($exp);
                $player->getXpManager()->addXp($exp);
            }
            return;
        }
    }
}