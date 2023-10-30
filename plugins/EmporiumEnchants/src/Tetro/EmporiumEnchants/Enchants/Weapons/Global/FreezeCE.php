<?php

# Namespaces
namespace Tetro\EmporiumEnchants\Enchants\Weapons\Global;

# Pocketmine API
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Event;
use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\player\Player;
use pocketmine\scheduler\ClosureTask;
use pocketmine\utils\TextFormat;
use Tetro\EmporiumEnchants\Core\{CustomEnchant, CustomEnchantManager};
use Tetro\EmporiumEnchants\Core\Types\ReactiveEnchantment;

# Used Files

# Enchantment Class
class FreezeCE extends ReactiveEnchantment
{

    # Register Enchantment
    public static array $freeze;
    public string $name = "Freeze";
    public string $description = "Freeze the enemy.";
    public int $rarity = CustomEnchant::RARITY_GODLY;
    public int $cooldownDuration = 0;
    public int $maxLevel = 5;

    # Compatibility
    public int $chance = 1;
    public int $usageType = CustomEnchant::TYPE_HAND;

    # Reagents
    public int $itemType = CustomEnchant::ITEM_TYPE_WEAPON;

    # Tasks

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
        $enemy = $event->getEntity();
        $damager = $event->getDamager();
        if ((!$enemy instanceof Player) or (!$damager instanceof Player)) {
            return;
        }
        // Enchantment Code
        $enemy = $event->getEntity();
            if (!isset(self::$freeze[$enemy->getTypeId()])) {
                $endTime = time() + (2 * $level);
                self::$freeze[$enemy->getTypeId()] = new ClosureTask(function () use ($enemy, $endTime): void {
                    if (!$enemy->isAlive() || $enemy->isClosed() || $enemy->isFlaggedForDespawn() || $endTime < time()) {
                        self::$freeze[$enemy->getTypeId()]->getHandler()->cancel();
                        unset(self::$freeze[$enemy->getTypeId()]);
                        $enemy->setImmobile(false);
                        return;
                    }
                    $enemy->setImmobile(true);
                });
                $this->plugin->getScheduler()->scheduleRepeatingTask(self::$freeze[$enemy->getTypeId()], 20);
            }
            $enemy->sendTitle(TextFormat::BOLD . TextFormat::AQUA . "Freeze", 20, 20, 20);
            $enemy->sendSubtitle(TextFormat::BOLD . TextFormat::GREEN . "You have been Frozen!", 20, 20, 20);
            $this->setCooldown($player, 60);
    }
}