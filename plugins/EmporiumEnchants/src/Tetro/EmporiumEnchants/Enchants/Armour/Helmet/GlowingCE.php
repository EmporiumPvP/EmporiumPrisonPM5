<?php

# Namespaces
namespace Tetro\EmporiumEnchants\Enchants\Armour\Helmet;

# Pocketmine API
use pocketmine\entity\effect\{EffectInstance, VanillaEffects};
use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\player\Player;
use Tetro\EmporiumEnchants\Core\CustomEnchant;
use Tetro\EmporiumEnchants\Core\Types\ToggleableEnchantment;

# Used Files

# Enchantment Class
class GlowingCE extends ToggleableEnchantment
{

    # Register Enchantment
    public string $name = "Glowing";
    public string $description = "Grants you with permanent night vision.";
    public int $rarity = CustomEnchant::RARITY_ELITE;
    public int $cooldownDuration = 0;
    public int $maxLevel = 1;
    public int $chance = 1;

    # Compatibility
    public int $usageType = CustomEnchant::TYPE_HELMET;
    public int $itemType = CustomEnchant::ITEM_TYPE_HELMET;

    # Arrays
    private array $previousEffect;

    # Enchantment
    public function toggle(Player $player, Item $item, Inventory $inventory, int $slot, int $level, bool $toggle): void
    {
        // Enchantment Code
        if ($toggle) {
            if ($player->getEffects()->has(VanillaEffects::NIGHT_VISION()) && $player->getEffects()->get(VanillaEffects::NIGHT_VISION())->getAmplifier() > 0) $this->previousEffect[$player->getName()] = $player->getEffects()->get(VanillaEffects::NIGHT_VISION());
        } else {
            if ($this->getArmorStack($player) === 0) {
                $player->getEffects()->remove(VanillaEffects::NIGHT_VISION());
                if (isset($this->previousEffect[$player->getName()])) {
                    $player->getEffects()->add($this->previousEffect[$player->getName()]);
                    unset($this->previousEffect[$player->getName()]);
                }
                return;
            }
        }
        $player->getEffects()->remove(VanillaEffects::NIGHT_VISION());
        $player->getEffects()->add(new EffectInstance(VanillaEffects::NIGHT_VISION(), 2147483647, 0, false));
    }
}