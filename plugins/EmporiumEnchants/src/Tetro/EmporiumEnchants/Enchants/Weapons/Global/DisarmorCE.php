<?php

# Namespaces
namespace Tetro\EmporiumEnchants\Enchants\Weapons\Global;

# Pocketmine API
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Event;
use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;
use Tetro\EmporiumEnchants\Core\CustomEnchant;
use Tetro\EmporiumEnchants\Core\Types\ReactiveEnchantment;

# Used Files

# Enchantment Class
class DisarmorCE extends ReactiveEnchantment
{

    # Register Enchantment
    public string $name = "Disarmor";
    public string $description = "Drop the enemies armour when they have low health.";
    public int $rarity = CustomEnchant::RARITY_HEROIC;
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
        $chance = $level * 20;
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
        if ($enemy->getHealth() <= 20) {
            if (count($armorContents = $enemy->getArmorInventory()->getContents(false)) > 0) {
                $item = $armorContents[array_rand($armorContents)];
                $enemy->getArmorInventory()->removeItem($item);
                foreach ($enemy->getInventory()->addItem($item) as $invfull) {
                    $enemy->getWorld()->dropItem($enemy->getPosition(), $invfull);
                }
                $enemy->sendTitle(TextFormat::BOLD . TextFormat::BLUE . "Disarmoured", 20, 20, 20);
                $enemy->sendSubtitle(TextFormat::BOLD . TextFormat::BLUE . "You have been Disarmoured!", 20, 20, 20);
                $this->setCooldown($player, 10);
            }
        }
    }
}