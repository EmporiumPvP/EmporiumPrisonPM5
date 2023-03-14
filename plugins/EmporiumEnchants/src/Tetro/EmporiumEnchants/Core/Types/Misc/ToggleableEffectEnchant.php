<?php

# Namespace
namespace Tetro\EmporiumEnchants\Core\Types\Misc;

# Pocketmine Packages
use pocketmine\entity\effect\{Effect, EffectInstance, VanillaEffects};
use pocketmine\inventory\Inventory;
use pocketmine\player\Player;
use pocketmine\item\Item;

# Used Files
use Tetro\EmporiumEnchants\Core\Types\ToggleableEnchantment;
use Tetro\EmporiumEnchants\Core\CustomEnchant;
use Tetro\EmporiumEnchants\Utils\Utils;
use Tetro\EmporiumEnchants\Loader;

# Type Enchant
class ToggleableEffectEnchant extends ToggleableEnchantment {
   
    # Array
    private array $previousEffect = [];

    # Constructor
    public function __construct(Loader $plugin, int $id, string $name, int $maxLevel, int $usageType, int $itemType, private Effect $effect, private int $baseAmplifier = 0, private int $amplifierMultiplier = 1, int $rarity = CustomEnchant::RARITY_ELITE) {
        $this->name = $name;
        $this->rarity = $rarity;
        $this->maxLevel = $maxLevel;
        $this->usageType = $usageType;
        $this->itemType = $itemType;
        parent::__construct($plugin, $id);
    }

    # Get Extra Data
    public function getDefaultExtraData(): array {
        return ["baseAmplifier" => $this->baseAmplifier, "amplifierMultiplier" => $this->amplifierMultiplier];
    }

    # Execute Enchant
    public function toggle(Player $player, Item $item, Inventory $inventory, int $slot, int $level, bool $toggle): void {
        if ($toggle) {
            if ($this->effect === VanillaEffects::JUMP_BOOST()) Utils::setShouldTakeFallDamage($player, false, 2147483647);
            if ($player->getEffects()->has($this->effect) && $player->getEffects()->get($this->effect)->getAmplifier() > $this->extraData["baseAmplifier"] + $this->extraData["amplifierMultiplier"] * $level) $this->previousEffect[$player->getName()] = $player->getEffects()->get($this->effect);
        } else {
            if ($this->usageType !== CustomEnchant::TYPE_ARMOR_INVENTORY || $this->getArmorStack($player) === 0) {
                if ($this->effect === VanillaEffects::JUMP_BOOST()) Utils::setShouldTakeFallDamage($player, true);
                $player->getEffects()->remove($this->effect);
                if (isset($this->previousEffect[$player->getName()])) {
                    $player->getEffects()->add($this->previousEffect[$player->getName()]);
                    unset($this->previousEffect[$player->getName()]);
                }
                return;
            }
        }
        $player->getEffects()->remove($this->effect);
        $player->getEffects()->add(new EffectInstance($this->effect, 2147483647, $this->extraData["baseAmplifier"] + $this->extraData["amplifierMultiplier"] * $level, false));
    }

    # Get Usage Type
    public function getUsageType(): int {
        return $this->usageType;
    }

    # Get Item Type
    public function getItemType(): int {
        return $this->itemType;
    }
}