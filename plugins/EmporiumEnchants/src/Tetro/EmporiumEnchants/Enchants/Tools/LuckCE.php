<?php

namespace Tetro\EmporiumEnchants\Enchants\Tools;

use Emporium\Prison\EmporiumPrison;
use EmporiumCore\EmporiumCore;
use pocketmine\block\BlockLegacyIds;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\Event;
use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;
use pocketmine\world\sound\AnvilBreakSound;
use Tetro\EmporiumEnchants\Core\CustomEnchant;
use Tetro\EmporiumEnchants\Core\Types\ReactiveEnchantment;

class LuckCE extends ReactiveEnchantment {

    # Register Enchantment
    public string $name = "Luck";
    public string $description = "Gives you a random reward whilst mining.";
    public int $rarity = CustomEnchant::RARITY_HEROIC;
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

    private array $ores = [
        BlockLegacyIds::COAL_ORE,
        BlockLegacyIds::COAL_BLOCK,
        BlockLegacyIds::IRON_ORE,
        BlockLegacyIds::IRON_BLOCK,
        BlockLegacyIds::LAPIS_ORE,
        BlockLegacyIds::LAPIS_BLOCK,
        BlockLegacyIds::REDSTONE_ORE,
        BlockLegacyIds::LIT_REDSTONE_ORE,
        BlockLegacyIds::REDSTONE_BLOCK,
        BlockLegacyIds::GOLD_ORE,
        BlockLegacyIds::GOLD_BLOCK,
        BlockLegacyIds::DIAMOND_ORE,
        BlockLegacyIds::DIAMOND_BLOCK,
        BlockLegacyIds::EMERALD_ORE,
        BlockLegacyIds::EMERALD_BLOCK,
        BlockLegacyIds::QUARTZ_ORE
    ];

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
                    if($player->getInventory()->canAddItem((EmporiumPrison::getInstance()->getScrolls())->whiteScroll())) {
                        $player->getInventory()->addItem((EmporiumPrison::getInstance()->getScrolls())->whiteScroll());
                    } else {
                        $player->getWorld()->dropItem($player->getPosition(), (EmporiumPrison::getInstance()->getScrolls())->whiteScroll());
                    }
                    break;
                case 2:
                    # holy white scroll
                    $player->broadcastSound(new AnvilBreakSound(), [$player]);
                    if($player->getInventory()->canAddItem((EmporiumPrison::getInstance()->getScrolls())->holyWhiteScroll())) {
                        $player->getInventory()->addItem((EmporiumPrison::getInstance()->getScrolls())->holyWhiteScroll());
                    } else {
                        $player->getWorld()->dropItem($player->getPosition(), (EmporiumPrison::getInstance()->getScrolls())->holyWhiteScroll());
                    }
                    break;
                case 3:
                    # elite contraband
                    $player->broadcastSound(new AnvilBreakSound(), [$player]);
                    if($player->getInventory()->canAddItem((EmporiumCore::getInstance()->getContraband())->Elite(1))) {
                        $player->getInventory()->addItem((EmporiumCore::getInstance()->getContraband())->Elite(1));
                    } else {
                        $player->getWorld()->dropItem($player->getPosition(), (EmporiumCore::getInstance()->getContraband())->Elite(1));
                    }
                    break;
                case 4:
                    # ultimate contraband
                    $player->broadcastSound(new AnvilBreakSound(), [$player]);
                    if($player->getInventory()->canAddItem((EmporiumCore::getInstance()->getContraband())->Ultimate(1))) {
                        $player->getInventory()->addItem((EmporiumCore::getInstance()->getContraband())->Ultimate(1));
                    } else {
                        $player->getWorld()->dropItem($player->getPosition(), ((EmporiumCore::getInstance()->getContraband())->Ultimate(1)));
                    }
                    break;
                case 5:
                    # legendary contraband
                    $player->broadcastSound(new AnvilBreakSound(), [$player]);
                    if($player->getInventory()->canAddItem((EmporiumCore::getInstance()->getContraband())->Legendary(1))) {
                        $player->getInventory()->addItem((EmporiumCore::getInstance()->getContraband())->Legendary(1));
                    } else {
                        $player->getWorld()->dropItem($player->getPosition(), (EmporiumCore::getInstance()->getContraband())->Legendary(1));
                    }
                    break;
                case 6:
                    # godly contraband
                    $player->broadcastSound(new AnvilBreakSound(), [$player]);
                    if($player->getInventory()->canAddItem((EmporiumCore::getInstance()->getContraband())->Godly(1))) {
                        $player->getInventory()->addItem((EmporiumCore::getInstance()->getContraband())->Godly(1));
                    } else {
                        $player->getWorld()->dropItem($player->getPosition(), (EmporiumCore::getInstance()->getContraband())->Godly(1));
                    }
                    break;
                case 7:
                    # heroic contraband
                    $player->broadcastSound(new AnvilBreakSound(), [$player]);
                    if($player->getInventory()->canAddItem((EmporiumCore::getInstance()->getContraband())->Heroic(1))) {
                        $player->getInventory()->addItem((EmporiumCore::getInstance()->getContraband())->Heroic(1));
                    } else {
                        $player->getWorld()->dropItem($player->getPosition(), (EmporiumCore::getInstance()->getContraband())->Heroic(1));
                    }
                    break;
                case 8:
                    # mystery xp booster
                    $player->broadcastSound(new AnvilBreakSound(), [$player]);
                    if($player->getInventory()->canAddItem((EmporiumPrison::getInstance()->getBoosters())->MysteryMiningXpBooster())) {
                        $player->getInventory()->addItem((EmporiumPrison::getInstance()->getBoosters())->MysteryMiningXpBooster());
                    } else {
                        $player->getWorld()->dropItem($player->getPosition(), (EmporiumPrison::getInstance()->getBoosters())->MysteryMiningXpBooster());
                    }
                    break;
                case 9:
                    # mystery energy booster
                    $player->broadcastSound(new AnvilBreakSound(), [$player]);
                    if($player->getInventory()->canAddItem((EmporiumPrison::getInstance()->getBoosters())->MysteryEnergyBooster())) {
                        $player->getInventory()->addItem((EmporiumPrison::getInstance()->getBoosters())->MysteryEnergyBooster());
                    } else {
                        $player->getWorld()->dropItem($player->getPosition(), (EmporiumPrison::getInstance()->getBoosters())->MysteryEnergyBooster());
                    }
                    break;
                case 10:
                    # mystery gkit lootbox
                    $player->broadcastSound(new AnvilBreakSound(), [$player]);
                    if($player->getInventory()->canAddItem((EmporiumCore::getInstance()->getLootboxes())->MysteryGKit(1))) {
                        $player->getInventory()->addItem((EmporiumCore::getInstance()->getLootboxes())->MysteryGKit(1));
                    } else {
                        $player->getWorld()->dropItem($player->getPosition(), (EmporiumCore::getInstance()->getLootboxes())->MysteryGKit(1));
                    }
                    break;
                case 11:
                    # mystery rank kit lootbox
                    $player->broadcastSound(new AnvilBreakSound(), [$player]);
                    if($player->getInventory()->canAddItem((EmporiumCore::getInstance()->getLootboxes())->MysteryRankKit(1))) {
                        $player->getInventory()->addItem((EmporiumCore::getInstance()->getLootboxes())->MysteryRankKit(1));
                    } else {
                        $player->getWorld()->dropItem($player->getPosition(), (EmporiumCore::getInstance()->getLootboxes())->MysteryRankKit(1));
                    }
                    break;
                case 12:
                    # elite meteor flare
                    $player->broadcastSound(new AnvilBreakSound(), [$player]);
                    if($player->getInventory()->canAddItem((EmporiumPrison::getInstance()->getFlares())->EliteMeteor())) {
                        $player->getInventory()->addItem((EmporiumPrison::getInstance()->getFlares())->EliteMeteor());
                    } else {
                        $player->getWorld()->dropItem($player->getPosition(), (EmporiumPrison::getInstance()->getFlares())->EliteMeteor());
                    }
                    break;
                case 13:
                    # ultimate meteor flare
                    $player->broadcastSound(new AnvilBreakSound(), [$player]);
                    if($player->getInventory()->canAddItem((EmporiumPrison::getInstance()->getFlares())->UltimateMeteor())) {
                        $player->getInventory()->addItem((EmporiumPrison::getInstance()->getFlares())->UltimateMeteor());
                    } else {
                        $player->getWorld()->dropItem($player->getPosition(), (EmporiumPrison::getInstance()->getFlares())->UltimateMeteor());
                    }
                    break;
                case 14:
                    # legendary meteor flare
                    $player->broadcastSound(new AnvilBreakSound(), [$player]);
                    if($player->getInventory()->canAddItem((EmporiumPrison::getInstance()->getFlares())->LegendaryMeteor())) {
                        $player->getInventory()->addItem((EmporiumPrison::getInstance()->getFlares())->LegendaryMeteor());
                    } else {
                        $player->getWorld()->dropItem($player->getPosition(), (EmporiumPrison::getInstance()->getFlares())->LegendaryMeteor());
                    }
                    break;
                case 15:
                    # godly meteor flare
                    $player->broadcastSound(new AnvilBreakSound(), [$player]);
                    if($player->getInventory()->canAddItem((EmporiumPrison::getInstance()->getFlares())->GodlyMeteor())) {
                        $player->getInventory()->addItem((EmporiumPrison::getInstance()->getFlares())->GodlyMeteor());
                    } else {
                        $player->getWorld()->dropItem($player->getPosition(), (EmporiumPrison::getInstance()->getFlares())->GodlyMeteor());
                    }
                    break;
                case 16:
                    # heroic meteor flare
                    $player->broadcastSound(new AnvilBreakSound(), [$player]);
                    if($player->getInventory()->canAddItem((EmporiumPrison::getInstance()->getFlares())->HeroicMeteor())) {
                        $player->getInventory()->addItem((EmporiumPrison::getInstance()->getFlares())->HeroicMeteor());
                    } else {
                        $player->getWorld()->dropItem($player->getPosition(), (EmporiumPrison::getInstance()->getFlares())->HeroicMeteor());
                    }
                    break;
            }
            $player->sendMessage(TextFormat::RED . "Luck");
            $this->setCooldown($player, 1);
        }
    }

    public function getPriority(): int
    {
        return 5;
    }
}