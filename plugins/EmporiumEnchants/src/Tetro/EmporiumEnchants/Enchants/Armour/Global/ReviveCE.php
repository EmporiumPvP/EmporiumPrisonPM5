<?php

# Namespaces
namespace Tetro\EmporiumEnchants\Enchants\Armour\Global;

# Pocketmine API
use pocketmine\entity\effect\{EffectInstance, VanillaEffects};
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\Event;
use pocketmine\inventory\Inventory;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\Item;
use pocketmine\network\mcpe\protocol\PlaySoundPacket;
use pocketmine\player\Player;
use pocketmine\world\particle\FlameParticle;
use Tetro\EmporiumEnchants\Core\{CustomEnchant, CustomEnchantIds, CustomEnchantManager};
use Tetro\EmporiumEnchants\Core\Types\ReactiveEnchantment;

# Used Files

# Enchantment Class
class ReviveCE extends ReactiveEnchantment
{

    # Register Enchantment
    public string $name = "Revive";
    public string $description = "Revives you when you have died.";
    public int $rarity = CustomEnchant::RARITY_HEROIC;
    public int $cooldownDuration = 0;
    public int $maxLevel = 5;
    public int $chance = 10000;

    # Compatibility
    public int $usageType = CustomEnchant::TYPE_ARMOR_INVENTORY;
    public int $itemType = CustomEnchant::ITEM_TYPE_ARMOR;

    # Reagents
    public function getReagent(): array
    {
        return [EntityDamageEvent::class];
    }

    # Enchantment
    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void
    {
        if ($event->getFinalDamage() >= $player->getHealth()) {

            // Remove Level (-1)
            $level > 1 ? $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantment(CustomEnchantIds::REVIVE), $level - 1)) : $item->removeEnchantment(CustomEnchantManager::getEnchantment(CustomEnchantIds::REVIVE));
            $player->getArmorInventory()->setItem($slot, $item);

            // Remove Effects
            foreach ($player->getEffects()->all() as $effect) {
                if ($effect->getType()->isBad()) {
                    $player->getEffects()->remove($effect->getType());
                }
            }

            // Reset Health & Hunger
            $player->setHealth($player->getMaxHealth());
            $player->getHungerManager()->setFood($player->getHungerManager()->getMaxFood());

            // Effect remove if it breaks
            $player->getEffects()->add(new EffectInstance(VanillaEffects::SLOWNESS(), 5, 1, false));
            $player->getEffects()->add(new EffectInstance(VanillaEffects::REGENERATION(), 3, 10, false));

            // Particles
            for ($i = $player->getPosition()->y; $i <= 256; $i += 0.25) {
                $player->getWorld()->addParticle($player->getPosition()->add(0, $i - $player->getPosition()->y, 0), new FlameParticle());
            }

            // Remove Damage
            foreach ($event->getModifiers() as $modifier => $damage) {
                $event->setModifier(0, $modifier);
            }
            $event->setBaseDamage(0);

            // Send Message
            $player->sendTip("§l§8(§a!§8) §r§eRevive");
            $player->sendMessage("§l§5** Revive **");

        }
    }
}