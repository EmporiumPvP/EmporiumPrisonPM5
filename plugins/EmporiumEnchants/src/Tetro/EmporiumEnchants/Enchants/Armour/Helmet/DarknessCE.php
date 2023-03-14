<?php

# Namespaces
namespace Tetro\EmporiumEnchants\Enchants\Armour\Helmet;

# Pocketmine API
use pocketmine\entity\effect\{EffectInstance, VanillaEffects};
use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\player\Player;
use Tetro\EmporiumEnchants\Core\CustomEnchant;
use Tetro\EmporiumEnchants\Core\Types\TickingEnchantment;
use Tetro\EmporiumEnchants\Utils\AllyChecks;
use pocketmine\color\Color;
use pocketmine\entity\Living;
use pocketmine\world\particle\DustParticle;

# Used Files

# Enchantment Class
class DarknessCE extends TickingEnchantment
{

    # Register Enchantment
    public string $name = "§l§0Darkness";
    public string $description = "Grants you with permanent invisibilty and strength when worn and surrounds you in darkness.";
    public int $rarity = CustomEnchant::RARITY_EXECUTIVE;
    public int $cooldownDuration = 0;
    public int $maxLevel = 1;
    public int $chance = 1;

    # Compatibility
    public int $usageType = CustomEnchant::TYPE_HELMET;
    public int $itemType = CustomEnchant::ITEM_TYPE_HELMET;

    # Arrays
    private array $previousEffect;

    public function getDefaultExtraData(): array
    {
        return ["radiusMultiplier" => 3, "durationMultiplier" => 100, "baseAmplifier" => -1, "amplifierMultiplier" => 1];
    }

    # Enchantment
    public function tick(Player $player, Item $item, Inventory $inventory, int $slot, int $level): void
    {
        $radius = $level * $this->extraData["radiusMultiplier"];
        foreach ($player->getWorld()->getEntities() as $entity) {
            if ($entity !== $player && $entity instanceof Living && !AllyChecks::isAlly($player, $entity) && $entity->getPosition()->distance($player->getPosition()) <= $radius) {
                $effect = new EffectInstance(VanillaEffects::BLINDNESS(), $level * $this->extraData["durationMultiplier"], $level * $this->extraData["amplifierMultiplier"] + $this->extraData["baseAmplifier"], false);
                $entity->getEffects()->add($effect);
            }
        }
        if ($player->getServer()->getTick() % 20 === 0) {
            for ($x = -$radius; $x <= $radius; $x += 0.25) {
                for ($y = -$radius; $y <= $radius; $y += 0.25) {
                    for ($z = -$radius; $z <= $radius; $z += 0.25) {
                        $random = mt_rand(1, 800 * $level);
                        if ($random === 800 * $level) {
                            $player->getWorld()->addParticle($player->getPosition()->add($x, $y, $z), new DustParticle(new Color(0, 0, 0)));
                        }
                    }
                }
            }
        }
    }
}