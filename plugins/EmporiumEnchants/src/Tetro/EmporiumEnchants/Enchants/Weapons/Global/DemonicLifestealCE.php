<?php

# Namespaces
namespace Tetro\EmporiumEnchants\Enchants\Weapons\Global;

# Pocketmine API
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Event;
use pocketmine\inventory\Inventory;
use pocketmine\utils\TextFormat;
use pocketmine\item\Item;
use pocketmine\player\Player;
use Tetro\EmporiumEnchants\Core\CustomEnchant;
use Tetro\EmporiumEnchants\Core\Types\ReactiveEnchantment;

# Used Files

# Enchantment Class
class DemonicLifestealCE extends ReactiveEnchantment
{

    # Register Enchantment
    public string $name = "Demonic Lifesteal";
    public string $description = "Highly drain the enemy of health and heals you.";
    public int $rarity = CustomEnchant::RARITY_HEROIC;
    public int $cooldownDuration = 60;
    public int $maxLevel = 2;
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
        $chance = $level * 5;
        if ($chance <= $random) {
            return;
        }
        // Enchantment Code
        $enemy = $event->getEntity();
        $damager = $event->getDamager();
        if ((!$enemy instanceof Player) or (!$damager instanceof Player)) {
            return;
        }
        $enemy = $event->getEntity();
        $enemy->setHealth($enemy->getHealth() - 5);
        if (($player->getHealth() + 5) <= $player->getMaxHealth()) {
            $player->setHealth($player->getHealth() + 5);
            $player->sendTitle(TextFormat::BOLD . TextFormat::LIGHT_PURPLE . "Demonic Lifesteal", 20, 20, 20);
            $player->sendMessage("§l§d** Demonic Lifesteal **");
        }
        $this->setCooldown($player, 60);
    }
}