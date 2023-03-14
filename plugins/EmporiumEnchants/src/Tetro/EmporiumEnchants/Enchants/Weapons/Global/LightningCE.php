<?php

namespace Tetro\EmporiumEnchants\Enchants\Weapons\Global;

use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Event;
use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\player\Player;
use Tetro\EmporiumEnchants\Core\CustomEnchant;
use Tetro\EmporiumEnchants\Core\Types\ReactiveEnchantment;
use Tetro\EmporiumEnchants\entities\PiggyLightning;

# Used Files

class LightningCE extends ReactiveEnchantment
{
    public string $name = "Lightning";
    public string $description = "Strike your enemy with the might of lightning.";
    public int $rarity = CustomEnchant::RARITY_HEROIC;
    public int $cooldownDuration = 0;
    public int $maxLevel = 5;
    public int $chance = 1;

    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void
    {
        if ($event instanceof EntityDamageByEntityEvent) {
            $lightning = PiggyLightning($event->getEntity()->getLocation());
            $lightning->setOwningEntity($player);
            $lightning->spawnToAll();
        }
        $this->setCooldown($player, 30);
    }
}