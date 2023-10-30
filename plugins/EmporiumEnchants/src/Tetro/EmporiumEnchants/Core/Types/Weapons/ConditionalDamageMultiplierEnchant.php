<?php

# Namespace
namespace Tetro\EmporiumEnchants\Core\Types\Weapons;

# Pocketmine Packages
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Event;
use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\player\Player;

# Used Files
use Tetro\EmporiumEnchants\Core\Types\ReactiveEnchantment;
use Tetro\EmporiumEnchants\Core\CustomEnchant;
use Tetro\EmporiumEnchants\EmporiumEnchants;

# Type Enchant
class ConditionalDamageMultiplierEnchant extends ReactiveEnchantment {
    
    # Constructor
    public function __construct(EmporiumEnchants $plugin, int $id, string $name, private $condition, int $rarity = CustomEnchant::RARITY_ELITE) {
        $this->name = $name;
        $this->rarity = $rarity;
        parent::__construct($plugin, $id);
    }

    # Get Extra Data
    public function getDefaultExtraData(): array {
        return ["additionalMultiplier" => 0.1];
    }

    # Execute Enchant
    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void {
        if ($event instanceof EntityDamageByEntityEvent) {
            if (($this->condition)($event)) {
                $event->setModifier($event->getFinalDamage() * $this->extraData["additionalMultiplier"] * $level, $this->getTypeId());
            }
        }
    }
}