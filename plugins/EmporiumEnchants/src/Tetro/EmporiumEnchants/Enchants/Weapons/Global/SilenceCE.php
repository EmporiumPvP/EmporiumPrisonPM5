<?php

# Namespaces
namespace Tetro\EmporiumEnchants\Enchants\Weapons\Global;

# Pocketmine API
use pocketmine\entity\effect\VanillaEffects;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Event;
use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\player\Player;
use pocketmine\scheduler\ClosureTask;
use pocketmine\utils\TextFormat;
use Tetro\EmporiumEnchants\Core\CustomEnchant;
use Tetro\EmporiumEnchants\Core\Types\ReactiveEnchantment;

# Used Files

# Enchantment Class
class SilenceCE extends ReactiveEnchantment
{

    # Register Enchantment
    public static array $silence;
    public string $name = "Silence";
    public string $description = "Remove some positive effects from the enemy over time.";
    public int $rarity = CustomEnchant::RARITY_HEROIC;
    public int $cooldownDuration = 120;
    public int $maxLevel = 10;

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
        $random = mt_rand(1, 100);
        $chance = $level * 2;
        if ($chance <= $random) {
            return;
        }
        if ($event instanceof EntityDamageByEntityEvent) {
            $exp = mt_rand(50 * $level, 100 * $level);
            $enemy = $event->getEntity();
            $damager = $event->getDamager();
            if ((!$enemy instanceof Player) or (!$damager instanceof Player)) {
                return;
            }
            // Enchantment Code
            $enemy = $event->getEntity();
            if (!isset(self::$silence[$enemy->getTypeId()])) {
                $endTime = ($level * 10);
                self::$silence[$enemy->getTypeId()] = new ClosureTask(function () use ($enemy, $endTime): void {
                    if (!$enemy->isAlive() || $enemy->isClosed() || $enemy->isFlaggedForDespawn() || $endTime < time()) {
                        self::$silence[$enemy->getTypeId()]->getHandler()->cancel();
                        unset(self::$silence[$enemy->getTypeId()]);
                        return;
                    }
                    $enemy->getEffects()->remove(VanillaEffects::ABSORPTION());
                    $enemy->getEffects()->remove(VanillaEffects::HEALTH_BOOST());
                    $enemy->getEffects()->remove(VanillaEffects::INVISIBILITY());
                    $enemy->getEffects()->remove(VanillaEffects::JUMP_BOOST());
                    $enemy->getEffects()->remove(VanillaEffects::NIGHT_VISION());
                });
                $this->plugin->getScheduler()->scheduleRepeatingTask(self::$silence[$enemy->getTypeId()], 1);
                $enemy->sendTitle(TextFormat::BOLD . TextFormat::LIGHT_PURPLE . "Silence", 20, 20, 20);
                $enemy->sendSubtitle(TextFormat::BOLD . TextFormat::LIGHT_PURPLE . "You have been Silenced!", 20, 20, 20);
                $player->sendTitle(TextFormat::BOLD . TextFormat::LIGHT_PURPLE . "Silence", 20, 20, 20);
                $player->sendSubtitle(TextFormat::BOLD . TextFormat::LIGHT_PURPLE . "Enemy has been Silenced!", 20, 20, 20);
                $this->setCooldown($player, 120);
            }
            $enemy->sendTitle(TextFormat::BOLD . TextFormat::LIGHT_PURPLE . "Silence", 20, 20, 20);
            $enemy->sendSubtitle(TextFormat::BOLD . TextFormat::LIGHT_PURPLE . "You have been Silenced!", 20, 20, 20);
            $player->sendTitle(TextFormat::BOLD . TextFormat::LIGHT_PURPLE . "Silence", 20, 20, 20);
            $player->sendSubtitle(TextFormat::BOLD . TextFormat::LIGHT_PURPLE . "Enemy has been Silenced!", 20, 20, 20);
            $player->sendMessage("§l§5** Silence **");
            $this->setCooldown($player, 120);
        }
    }
}