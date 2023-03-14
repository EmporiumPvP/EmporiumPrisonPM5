<?php

namespace Tetro\EmporiumEnchants\Enchants\Tools;


use pocketmine\item\Item;
use pocketmine\event\Event;
use pocketmine\player\Player;
use pocketmine\inventory\Inventory;
use pocketmine\event\block\BlockBreakEvent;

use pocketmine\utils\TextFormat as TF;
use pocketmine\world\sound\BlazeShootSound;
use Tetro\EmporiumEnchants\Core\CustomEnchant;
use Tetro\EmporiumEnchants\Core\Types\ReactiveEnchantment;

class ShardDiscovererCE extends ReactiveEnchantment {

    # Register Enchantment
    public string $name = "Shard Discoverer";
    public string $description = "Higher chance to find shards.";
    public int $rarity = CustomEnchant::RARITY_PICKAXE;
    public int $cooldownDuration = 0;
    public int $maxLevel = 5;
    public int $chance = 1;

    # Compatibility
    public int $usageType = CustomEnchant::TYPE_HAND;
    public int $itemType = CustomEnchant::ITEM_TYPE_TOOLS;

    # Reagents
    public function getReagent(): array {
        return [BlockBreakEvent::class];
    }
    
    # Enchantment

    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void {
        // Chance
        $chance = floor(600 / $level);
        if (mt_rand(1, $chance) !== mt_rand(1, $chance)) {
            return;
        }
        // Enchantment Code
        if ($event instanceof BlockBreakEvent) {

            switch($level) {

                case 1:
                    $player->broadcastSound(new BlazeShootSound());
                    $player->sendTitle(TF::BOLD . TF::WHITE . "Simple" . TF::DARK_GRAY . " Shard Discovered");
                    break;

                case 2:
                    $type = mt_rand(1, 2);
                    if($type === 1) {
                        $player->broadcastSound(new BlazeShootSound());
                        $player->sendTitle(TF::BOLD . TF::WHITE . "Simple" . TF::DARK_GRAY . " Shard Discovered");
                    } elseif($type === 2) {
                        $player->broadcastSound(new BlazeShootSound());
                        $player->sendTitle(TF::BOLD . TF::GREEN . "Uncommon" . TF::DARK_GRAY . " Shard Discovered");
                    }
                    break;

                case 3:
                    $type = mt_rand(1, 3);
                    if($type === 1) {
                        $player->broadcastSound(new BlazeShootSound());
                        $player->sendTitle(TF::BOLD . TF::WHITE . "Simple" . TF::DARK_GRAY . " Shard Discovered");
                    } elseif($type === 2) {
                        $player->broadcastSound(new BlazeShootSound());
                        $player->sendTitle(TF::BOLD . TF::GREEN . "Uncommon" . TF::DARK_GRAY . " Shard Discovered");
                    } elseif($type === 3) {
                        $player->broadcastSound(new BlazeShootSound());
                        $player->sendTitle(TF::BOLD . TF::BLUE . "Elite" . TF::DARK_GRAY . " Shard Discovered");
                    }
                    break;

                case 4:
                    $type = mt_rand(1, 4);
                    if($type === 1) {
                        $player->broadcastSound(new BlazeShootSound());
                        $player->sendTitle(TF::BOLD . TF::WHITE . "Simple" . TF::DARK_GRAY . " Shard Discovered");
                    } elseif($type === 2) {
                        $player->broadcastSound(new BlazeShootSound());
                        $player->sendTitle(TF::BOLD . TF::GREEN . "Uncommon" . TF::DARK_GRAY . " Shard Discovered");
                    } elseif($type === 3) {
                        $player->broadcastSound(new BlazeShootSound());
                        $player->sendTitle(TF::BOLD . TF::BLUE . "Elite" . TF::DARK_GRAY . " Shard Discovered");
                    } elseif($type === 4) {
                        $player->broadcastSound(new BlazeShootSound());
                        $player->sendTitle(TF::BOLD . TF::YELLOW . "Ultimate" . TF::DARK_GRAY . " Shard Discovered");
                    }
                    break;

                case 5:
                    $type = mt_rand(1, 5);
                    if($type === 1) {
                        $player->broadcastSound(new BlazeShootSound());
                        $player->sendTitle(TF::BOLD . TF::WHITE . "Simple" . TF::DARK_GRAY . " Shard Discovered");
                    } elseif($type === 2) {
                        $player->broadcastSound(new BlazeShootSound());
                        $player->sendTitle(TF::BOLD . TF::GREEN . "Uncommon" . TF::DARK_GRAY . " Shard Discovered");
                    } elseif($type === 3) {
                        $player->broadcastSound(new BlazeShootSound());
                        $player->sendTitle(TF::BOLD . TF::BLUE . "Elite" . TF::DARK_GRAY . " Shard Discovered");
                    } elseif($type === 4) {
                        $player->broadcastSound(new BlazeShootSound());
                        $player->sendTitle(TF::BOLD . TF::YELLOW . "Ultimate" . TF::DARK_GRAY . " Shard Discovered");
                    } elseif($type === 5) {
                        $player->broadcastSound(new BlazeShootSound());
                        $player->sendTitle(TF::BOLD . TF::YELLOW . "Legendary" . TF::DARK_GRAY . " Shard Discovered");
                    }
                    break;
            }
            $player->sendMessage(TF::RED . "Shard Discoverer");
            $this->setCooldown($player, 1);
        }
    }

}