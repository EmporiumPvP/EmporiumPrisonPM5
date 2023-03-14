<?php

# Namespace
namespace Tetro\EmporiumEnchants\Core\Types\Weapons;

# Pocketmine Packages
use pocketmine\entity\effect\{Effect, EffectInstance, VanillaEffects};
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\inventory\Inventory;
use pocketmine\player\Player;
use pocketmine\entity\Living;
use pocketmine\event\Event;
use pocketmine\item\Item;

# Used Files
use Tetro\EmporiumEnchants\Core\Types\ReactiveEnchantment;
use Tetro\EmporiumEnchants\Core\CustomEnchant;
use Tetro\EmporiumEnchants\Loader;

# Type Enchant
class LacedWeaponEnchant extends ReactiveEnchantment {
    
    # Constructor
    public function __construct(Loader $plugin, int $id, string $name, int $rarity = CustomEnchant::RARITY_ELITE, private ?array $effects = null, private array $durationMultiplier = [60], private array $amplifierMultiplier = [1], private array $baseDuration = [0], private array $baseAmplifier = [0]) {
        $this->name = $name;
        $this->rarity = $rarity;
        $this->effects = $effects ?? [VanillaEffects::POISON()];
        parent::__construct($plugin, $id);
    }

    # Get Extra Data
    public function getDefaultExtraData(): array {
        return ["durationMultiplier" => $this->durationMultiplier, "amplifierMultiplier" => $this->amplifierMultiplier, "baseDuration" => $this->baseDuration, "baseAmplifier" => $this->baseAmplifier];
    }

    # Execute Enchant
    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void {
        if ($event instanceof EntityDamageByEntityEvent) {
            $entity = $event->getEntity();
            if ($entity instanceof Living) {
                foreach ($this->effects as $key => $effect) {
                    $entity->getEffects()->add(new EffectInstance($effect, ($this->extraData["baseDuration"][$key] ?? 0) + ($this->extraData["durationMultiplier"][$key] ?? 60) * $level, ($this->extraData["baseAmplifier"][$key] ?? 0) + ($this->extraData["amplifierMultiplier"][$key] ?? 1) * $level));
                }
            }
        }
    }
}