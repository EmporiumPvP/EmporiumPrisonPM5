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
use pocketmine\world\particle\HugeExplodeParticle;
use pocketmine\world\sound\ExplodeSound;
use Tetro\EmporiumEnchants\Core\CustomEnchant;
use Tetro\EmporiumEnchants\Core\Types\ReactiveEnchantment;

# Used Files

# Enchantment Class
class IncendiaryCE extends ReactiveEnchantment
{

    # Register Enchantment
    public string $name = "Incendiary";
    public string $description = "Deal Mass damage and cause an explosion.";
    public int $rarity = CustomEnchant::RARITY_HEROIC;
    public int $cooldownDuration = 0;
    public int $maxLevel = 3;
    public int $chance = 1;

    # Compatibility
    public int $usageType = CustomEnchant::TYPE_HAND;
    public int $itemType = CustomEnchant::ITEM_TYPE_WEAPON;

    # Reagents
    public function getReagent(): array
    {
        return [EntityDamageByEntityEvent::class];
    }

    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void
    {
        $enemy = $event->getEntity();
        $damager = $event->getDamager();
        $damage = $event->getBaseDamage();
        $health = $enemy->getHealth();
        # Calculate
        if ((!$enemy instanceof Player) or (!$damager instanceof Player)) {
                return;
            }
        if ($health - ($damage * ($level * 2)) <= 0) {
            $event->setKnockBack($event->getKnockBack() + ($level / 5));
            for ($i = $player->getPosition()->y; $i <= 256; $i += 0.25) {
                $enemy->getWorld()->addParticle($enemy->getPosition()->add(0, $i - $enemy->getPosition()->y, 0), new HugeExplodeParticle());
            }
            $enemy->sendTitle(TextFormat::BOLD . TextFormat::RED . "Incendiary!", 20, 20, 20);
            $enemy->sendSubtitle(TextFormat::BOLD . TextFormat::GOLD . "BOOOOOOOOOOOOOOOOOOOM!", 20, 20, 20);
            $this->setCooldown($player, 30);
            $player->sendMessage("§l§d** Incendiary **");
            $player->getWorld()->addSound($player->getPosition()->add(0.5, 0.5, 0.5), new ExplodeSound());
        }
        $enemy->setHealth($enemy->getHealth() - ($level * 2));
    }
}
# Enchantment
