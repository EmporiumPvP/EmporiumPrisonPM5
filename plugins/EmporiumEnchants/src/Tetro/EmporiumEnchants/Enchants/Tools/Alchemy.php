<?php

namespace Tetro\EmporiumEnchants\Enchants\Tools;

use Emporium\Prison\Managers\misc\Translator;

use EmporiumData\DataManager;

use pocketmine\block\BlockLegacyIds;
use Tetro\EmporiumEnchants\Core\CustomEnchant;
use Tetro\EmporiumEnchants\Core\Types\ReactiveEnchantment;

use pocketmine\item\Item;
use pocketmine\event\Event;
use pocketmine\item\ItemIds;
use pocketmine\player\Player;
use pocketmine\inventory\Inventory;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\utils\TextFormat as TF;
use pocketmine\world\sound\BlazeShootSound;

class Alchemy extends ReactiveEnchantment {

    # Register Enchantment
    public string $name = "Alchemy";
    public string $description = "Chance to turn mined ores into money";
    public int $rarity = CustomEnchant::RARITY_ELITE;
    public int $cooldownDuration = 60;
    public int $maxLevel = 3;
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

    private array $sellables = [
        16, 173, 263, # coal
        15, 42, 265, # iron
        21, 22, 351, # lapis
        73, 152, 331, # redstone
        14, 41, 266, # gold
        56, 57, 264, # diamond
        129, 133, 388 # emerald
    ];

    # Enchantment
    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void {

        if ($event instanceof BlockBreakEvent) {

            if($event->isCancelled()) return;

            $blockId = $event->getBlock()->getIdInfo()->getBlockId();

            if(!in_array($blockId, $this->ores)) {
                $event->cancel();
                return;
            }

            # chance
            $chance = floor(150 / $level);
            if (mt_rand(1, $chance) !== mt_rand(1, $chance)) {
                return;
            }

            # sell ores logic here
            $inventory = $player->getInventory()->getContents();
            $sellprice = 0;
            foreach ($inventory as $item) {
                if(in_array($item->getId(), $this->sellables)) {
                    # coal ore
                    if ($item->getId() === ItemIds::COAL_ORE) {
                        $count = $item->getCount();
                        $sellprice = $sellprice + (0.06 * $count);
                    }
                    # coal block
                    if ($item->getId() === ItemIds::COAL) {
                        $count = $item->getCount();
                        $sellprice = $sellprice + (0.32 * $count);
                    }
                    # coal
                    if ($item->getId() === ItemIds::COAL_BLOCK) {
                        $count = $item->getCount();
                        $sellprice = $sellprice + (1.21 * $count);
                    }

                    # iron ore
                    if ($item->getId() === ItemIds::IRON_ORE) {
                        $count = $item->getCount();
                        $sellprice = $sellprice + (0.20 * $count);
                    }
                    # iron ingot
                    if ($item->getId() === ItemIds::IRON_INGOT) {
                        $count = $item->getCount();
                        $sellprice = $sellprice + (1.02 * $count);
                    }
                    # iron block
                    if ($item->getId() === ItemIds::IRON_BLOCK) {
                        $count = $item->getCount();
                        $sellprice = $sellprice + (4.08 * $count);
                    }

                    # lapis ore
                    if ($item->getId() === ItemIds::LAPIS_ORE) {
                        $count = $item->getCount();
                        $sellprice = $sellprice + (0.52 * $count);
                    }
                    # lapis
                    if ($item->getId() === ItemIds::DYE) {
                        $count = $item->getCount();
                        $sellprice = $sellprice + (2.70 * $count);
                    }
                    # lapis block
                    if ($item->getId() === ItemIds::LAPIS_BLOCK) {
                        $count = $item->getCount();
                        $sellprice = $sellprice + (10.80 * $count);
                    }

                    # redstone ore
                    if ($item->getId() === ItemIds::REDSTONE_ORE) {
                        $count = $item->getCount();
                        $sellprice = $sellprice + (1.57 * $count);
                    }
                    # redstone
                    if ($item->getId() === ItemIds::REDSTONE) {
                        $count = $item->getCount();
                        $sellprice = $sellprice + (8.29 * $count);
                    }
                    # redstone block
                    if ($item->getId() === ItemIds::REDSTONE_BLOCK) {
                        $count = $item->getCount();
                        $sellprice = $sellprice + (33.16 * $count);
                    }

                    # gold ore
                    if ($item->getId() === ItemIds::GOLD_ORE) {
                        $count = $item->getCount();
                        $sellprice = $sellprice + (4.86 * $count);
                    }
                    # gold ingot
                    if ($item->getId() === ItemIds::GOLD_INGOT) {
                        $count = $item->getCount();
                        $sellprice = $sellprice + (25.76 * $count);
                    }
                    # gold block
                    if ($item->getId() === ItemIds::GOLD_BLOCK) {
                        $count = $item->getCount();
                        $sellprice = $sellprice + (103.04 * $count);
                    }

                    # diamond ore
                    if ($item->getId() === ItemIds::DIAMOND_ORE) {
                        $count = $item->getCount();
                        $sellprice = $sellprice + (7.34 * $count);
                    }
                    # diamond
                    if ($item->getId() === ItemIds::DIAMOND) {
                        $count = $item->getCount();
                        $sellprice = $sellprice + (38.85 * $count);
                    }
                    # diamond block
                    if ($item->getId() === ItemIds::DIAMOND_BLOCK) {
                        $count = $item->getCount();
                        $sellprice = $sellprice + (155.40 * $count);
                    }

                    # emerald ore
                    if ($item->getId() === ItemIds::EMERALD_ORE) {
                        $count = $item->getCount();
                        $sellprice = $sellprice + (27.35 * $count);
                    }
                    # emerald
                    if ($item->getId() === ItemIds::EMERALD) {
                        $count = $item->getCount();
                        $sellprice = $sellprice + (144.92 * $count);
                    }
                    # emerald block
                    if ($item->getId() === ItemIds::EMERALD_BLOCK) {
                        $count = $item->getCount();
                        $sellprice = $sellprice + (579.68 * $count);
                    }
                    $player->getInventory()->remove($item);
                    $this->setCooldown($player, 60);
                }
            }


            # sell messages
            if ($sellprice > 0) {
                DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.money") + $sellprice);
                $player->sendMessage(TF::GREEN . "Alchemy +$" . TF::WHITE . Translator::shortNumber($sellprice));
                $player->broadcastSound(new BlazeShootSound());
            }
        }
    }

    public function getPriority(): int
    {
        return 1;
    }

}