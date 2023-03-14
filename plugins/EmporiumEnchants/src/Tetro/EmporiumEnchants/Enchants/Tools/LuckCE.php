<?php

namespace Tetro\EmporiumEnchants\Enchants\Tools;

use Emporium\Prison\items\Boosters;
use Emporium\Prison\items\Flares;
use Emporium\Prison\items\Scrolls;
use Items\Contraband;
use Items\Lootboxes;
use pocketmine\item\Item;
use pocketmine\event\Event;
use pocketmine\player\Player;

use pocketmine\inventory\Inventory;
use pocketmine\event\block\BlockBreakEvent;

use pocketmine\utils\TextFormat;
use pocketmine\world\sound\AnvilBreakSound;
use Tetro\EmporiumEnchants\Core\CustomEnchant;
use Tetro\EmporiumEnchants\Core\Types\ReactiveEnchantment;

class LuckCE extends ReactiveEnchantment {

    # Register Enchantment
    public string $name = "Luck";
    public string $description = "Gives you a random reward whilst mining.";
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
        $chance = floor(1500 / $level);
        if (mt_rand(1, $chance) !== mt_rand(1, $chance)) {
            return;
        }
        // Enchantment Code
        if ($event instanceof BlockBreakEvent) {
            $reward = mt_rand(1, 16);

            switch($reward) {
                # white scroll
                case 1:
                    $player->broadcastSound(new AnvilBreakSound(), [$player]);
                    if($player->getInventory()->canAddItem((new Scrolls())->whiteScroll())) {
                        $player->getInventory()->addItem((new Scrolls())->whiteScroll());
                    } else {
                        $player->getWorld()->dropItem($player->getPosition(), (new Scrolls())->whiteScroll());
                    }
                    break;
                case 2:
                    # holy white scroll
                    $player->broadcastSound(new AnvilBreakSound(), [$player]);
                    if($player->getInventory()->canAddItem((new Scrolls())->holyWhiteScroll())) {
                        $player->getInventory()->addItem((new Scrolls())->holyWhiteScroll());
                    } else {
                        $player->getWorld()->dropItem($player->getPosition(), (new Scrolls())->holyWhiteScroll());
                    }
                    break;
                case 3:
                    # elite contraband
                    $player->broadcastSound(new AnvilBreakSound(), [$player]);
                    if($player->getInventory()->canAddItem((new Contraband())->Elite(1))) {
                        $player->getInventory()->addItem((new Contraband())->Elite(1));
                    } else {
                        $player->getWorld()->dropItem($player->getPosition(), (new Contraband())->Elite(1));
                    }
                    break;
                case 4:
                    # ultimate contraband
                    $player->broadcastSound(new AnvilBreakSound(), [$player]);
                    if($player->getInventory()->canAddItem((new Contraband())->Ultimate(1))) {
                        $player->getInventory()->addItem((new Contraband())->Ultimate(1));
                    } else {
                        $player->getWorld()->dropItem($player->getPosition(), (new Contraband())->Ultimate(1));
                    }
                    break;
                case 5:
                    # legendary contraband
                    $player->broadcastSound(new AnvilBreakSound(), [$player]);
                    if($player->getInventory()->canAddItem((new Contraband())->Legendary(1))) {
                        $player->getInventory()->addItem((new Contraband())->Legendary(1));
                    } else {
                        $player->getWorld()->dropItem($player->getPosition(), (new Contraband())->Legendary(1));
                    }
                    break;
                case 6:
                    # godly contraband
                    $player->broadcastSound(new AnvilBreakSound(), [$player]);
                    if($player->getInventory()->canAddItem((new Contraband())->Godly(1))) {
                        $player->getInventory()->addItem((new Contraband())->Godly(1));
                    } else {
                        $player->getWorld()->dropItem($player->getPosition(), (new Contraband())->Godly(1));
                    }
                    break;
                case 7:
                    # heroic contraband
                    $player->broadcastSound(new AnvilBreakSound(), [$player]);
                    if($player->getInventory()->canAddItem((new Contraband())->Heroic(1))) {
                        $player->getInventory()->addItem((new Contraband())->Heroic(1));
                    } else {
                        $player->getWorld()->dropItem($player->getPosition(), (new Contraband())->Heroic(1));
                    }
                    break;
                case 8:
                    # mystery xp booster
                    $player->broadcastSound(new AnvilBreakSound(), [$player]);
                    if($player->getInventory()->canAddItem((new Boosters())->MysteryMiningXpBooster())) {
                        $player->getInventory()->addItem((new Boosters())->MysteryMiningXpBooster());
                    } else {
                        $player->getWorld()->dropItem($player->getPosition(), (new Boosters())->MysteryMiningXpBooster());
                    }
                    break;
                case 9:
                    # mystery energy booster
                    $player->broadcastSound(new AnvilBreakSound(), [$player]);
                    if($player->getInventory()->canAddItem((new Boosters())->MysteryEnergyBooster())) {
                        $player->getInventory()->addItem((new Boosters())->MysteryEnergyBooster());
                    } else {
                        $player->getWorld()->dropItem($player->getPosition(), (new Boosters())->MysteryEnergyBooster());
                    }
                    break;
                case 10:
                    # mystery gkit lootbox
                    $player->broadcastSound(new AnvilBreakSound(), [$player]);
                    if($player->getInventory()->canAddItem((new Lootboxes())->MysteryGKit(1))) {
                        $player->getInventory()->addItem((new Lootboxes())->MysteryGKit(1));
                    } else {
                        $player->getWorld()->dropItem($player->getPosition(), (new Lootboxes())->MysteryGKit(1));
                    }
                    break;
                case 11:
                    # mystery rank kit lootbox
                    $player->broadcastSound(new AnvilBreakSound(), [$player]);
                    if($player->getInventory()->canAddItem((new Lootboxes())->MysteryRankKit(1))) {
                        $player->getInventory()->addItem((new Lootboxes())->MysteryRankKit(1));
                    } else {
                        $player->getWorld()->dropItem($player->getPosition(), (new Lootboxes())->MysteryRankKit(1));
                    }
                    break;
                case 12:
                    # elite meteor flare
                    $player->broadcastSound(new AnvilBreakSound(), [$player]);
                    if($player->getInventory()->canAddItem((new Flares())->EliteMeteor())) {
                        $player->getInventory()->addItem((new Flares())->EliteMeteor());
                    } else {
                        $player->getWorld()->dropItem($player->getPosition(), (new Flares())->EliteMeteor());
                    }
                    break;
                case 13:
                    # ultimate meteor flare
                    $player->broadcastSound(new AnvilBreakSound(), [$player]);
                    if($player->getInventory()->canAddItem((new Flares())->UltimateMeteor())) {
                        $player->getInventory()->addItem((new Flares())->UltimateMeteor());
                    } else {
                        $player->getWorld()->dropItem($player->getPosition(), (new Flares())->UltimateMeteor());
                    }
                    break;
                case 14:
                    # legendary meteor flare
                    $player->broadcastSound(new AnvilBreakSound(), [$player]);
                    if($player->getInventory()->canAddItem((new Flares())->LegendaryMeteor())) {
                        $player->getInventory()->addItem((new Flares())->LegendaryMeteor());
                    } else {
                        $player->getWorld()->dropItem($player->getPosition(), (new Flares())->LegendaryMeteor());
                    }
                    break;
                case 15:
                    # godly meteor flare
                    $player->broadcastSound(new AnvilBreakSound(), [$player]);
                    if($player->getInventory()->canAddItem((new Flares())->GodlyMeteor())) {
                        $player->getInventory()->addItem((new Flares())->GodlyMeteor());
                    } else {
                        $player->getWorld()->dropItem($player->getPosition(), (new Flares())->GodlyMeteor());
                    }
                    break;
                case 16:
                    # heroic meteor flare
                    $player->broadcastSound(new AnvilBreakSound(), [$player]);
                    if($player->getInventory()->canAddItem((new Flares())->HeroicMeteor())) {
                        $player->getInventory()->addItem((new Flares())->HeroicMeteor());
                    } else {
                        $player->getWorld()->dropItem($player->getPosition(), (new Flares())->HeroicMeteor());
                    }
                    break;
            }
            $player->sendMessage(TextFormat::RED . "Luck");
            $this->setCooldown($player, 1);
        }
    }

}