<?php

# Namespace
namespace Tetro\EmporiumEnchants\Core\Types\Armour;

# Pocketmine Packages
use pocketmine\entity\effect\Effect;
use pocketmine\entity\effect\EffectInstance;
use pocketmine\entity\Living;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Event;
use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\player\Player;

# Used Files
use Tetro\EmporiumEnchants\Core\CustomEnchant;
use Tetro\EmporiumEnchants\Core\Types\ReactiveEnchantment;
use Tetro\EmporiumEnchants\EmporiumEnchants;

# Type Enchant
class AttackerDeterrentEnchant extends ReactiveEnchantment {

    # Identifiers
    public int $usageType = CustomEnchant::TYPE_ARMOR_INVENTORY;
    public int $itemType = CustomEnchant::TYPE_ARMOR_INVENTORY;

    # Constructor
    public function __construct(EmporiumEnchants $plugin, int $id, string $name, private array $effects, private array $durationMultiplier, private array $amplifierMultiplier, int $rarity = CustomEnchant::RARITY_ELITE) {
        $this->name = $name;
        $this->rarity = $rarity;
        parent::__construct($plugin, $id);
    }

    # Get Extra Data
    public function getDefaultExtraData(): array {
        return ["durationMultipliers" => $this->durationMultiplier, "amplifierMultipliers" => $this->amplifierMultiplier];
    }

    # Execute Enchant
    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void {
        if ($event instanceof EntityDamageByEntityEvent) {
            $damager = $event->getDamager();
            if ($damager instanceof Living) {
                foreach ($this->effects as $key => $effect) {
                    $damager->getEffects()->add(new EffectInstance($effect, $this->extraData["durationMultipliers"][$key] * $level, $this->extraData["amplifierMultipliers"][$key] * $level));
                }
            }
        }
    }
}