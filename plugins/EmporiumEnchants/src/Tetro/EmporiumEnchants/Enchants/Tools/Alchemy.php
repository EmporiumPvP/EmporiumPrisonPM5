<?php

namespace Tetro\EmporiumEnchants\Enchants\Tools;

use Emporium\Prison\Managers\misc\Translator;

use EmporiumData\DataManager;

use pocketmine\block\BlockTypeIds;
use pocketmine\block\VanillaBlocks;

use pocketmine\item\VanillaItems;
use Tetro\EmporiumEnchants\Core\CustomEnchant;
use Tetro\EmporiumEnchants\Core\Types\ReactiveEnchantment;

use pocketmine\item\Item;
use pocketmine\event\Event;
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
    public int $chance = 150;

    # Compatibility
    public int $usageType = CustomEnchant::TYPE_HAND;
    public int $itemType = CustomEnchant::ITEM_TYPE_TOOLS;

    # Reagents
    public function getReagent(): array {
        return [BlockBreakEvent::class];
    }

    private array $ores = [
        BlockTypeIds::COAL_ORE, BlockTypeIds::COAL,
        BlockTypeIds::IRON_ORE, BlockTypeIds::IRON,
        BlockTypeIds::LAPIS_LAZULI_ORE, BlockTypeIds::LAPIS_LAZULI,
        BlockTypeIds::REDSTONE_ORE, BlockTypeIds::REDSTONE,
        BlockTypeIds::GOLD_ORE, BlockTypeIds::GOLD,
        BlockTypeIds::DIAMOND_ORE, BlockTypeIds::DIAMOND,
        BlockTypeIds::EMERALD_ORE, BlockTypeIds::EMERALD,
        BlockTypeIds::NETHER_QUARTZ_ORE, BlockTypeIds::QUARTZ
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

        if(!$event instanceof BlockBreakEvent) return;

        if ($event->isCancelled()) return;

        $blockId = $event->getBlock()->getTypeId();

        if(!in_array($blockId, $this->ores)) return;

        # chance
        $chance = floor($this->chance / $level);
        if (mt_rand(1, $chance) !== mt_rand(1, $chance)) return;

        # sell ores logic here
        $inventory = $player->getInventory()->getContents();
        $sellprice = 0;
        foreach ($inventory as $item) {
            if(in_array($item->getTypeId(), $this->sellables)) {
                # coal ore
                if ($item->getTypeId() == VanillaBlocks::COAL_ORE()->getTypeId()) {
                    $count = $item->getCount();
                    $sellprice = $sellprice + (0.06 * $count);
                }
                # coal
                if ($item->getTypeId() == VanillaItems::COAL()->getTypeId()) {
                    $count = $item->getCount();
                    $sellprice = $sellprice + (0.32 * $count);
                }
                # coal block
                if ($item->getTypeId() == VanillaBlocks::COAL()->getTypeId()) {
                    $count = $item->getCount();
                    $sellprice = $sellprice + (1.21 * $count);
                }

                # iron ore
                if ($item->getTypeId() == VanillaBlocks::IRON_ORE()->getTypeId()) {
                    $count = $item->getCount();
                    $sellprice = $sellprice + (0.20 * $count);
                }
                # iron ingot
                if ($item->getTypeId() == VanillaItems::IRON_INGOT()->getTypeId()) {
                    $count = $item->getCount();
                    $sellprice = $sellprice + (1.02 * $count);
                }
                # iron block
                if ($item->getTypeId() == VanillaBlocks::IRON()->getTypeId()) {
                    $count = $item->getCount();
                    $sellprice = $sellprice + (4.08 * $count);
                }

                # lapis ore
                if ($item->getTypeId() == VanillaBlocks::LAPIS_LAZULI_ORE()->getTypeId()) {
                    $count = $item->getCount();
                    $sellprice = $sellprice + (0.52 * $count);
                }
                # lapis
                if ($item->getTypeId() == VanillaItems::LAPIS_LAZULI()) {
                    $count = $item->getCount();
                    $sellprice = $sellprice + (2.70 * $count);
                }
                # lapis block
                if ($item->getTypeId() == VanillaBlocks::LAPIS_LAZULI()->getTypeId()) {
                    $count = $item->getCount();
                    $sellprice = $sellprice + (10.80 * $count);
                }

                # redstone ore
                if ($item->getTypeId() == VanillaBlocks::REDSTONE_ORE()->getTypeId()) {
                    $count = $item->getCount();
                    $sellprice = $sellprice + (1.57 * $count);
                }
                # redstone
                if ($item->getTypeId() == VanillaItems::REDSTONE_DUST()->getTypeId()) {
                    $count = $item->getCount();
                    $sellprice = $sellprice + (8.29 * $count);
                }
                # redstone block
                if ($item->getTypeId() == VanillaBlocks::REDSTONE()->getTypeId()) {
                    $count = $item->getCount();
                    $sellprice = $sellprice + (33.16 * $count);
                }

                # gold ore
                if ($item->getTypeId() == VanillaBlocks::GOLD_ORE()->getTypeId()) {
                    $count = $item->getCount();
                    $sellprice = $sellprice + (4.86 * $count);
                }
                # gold ingot
                if ($item->getTypeId() == VanillaItems::GOLD_INGOT()->getTypeId()) {
                    $count = $item->getCount();
                    $sellprice = $sellprice + (25.76 * $count);
                }
                # gold block
                if ($item->getTypeId() == VanillaBlocks::GOLD()->getTypeId()) {
                    $count = $item->getCount();
                    $sellprice = $sellprice + (103.04 * $count);
                }

                # diamond ore
                if ($item->getTypeId() == VanillaBlocks::DIAMOND_ORE()->getTypeId()) {
                    $count = $item->getCount();
                    $sellprice = $sellprice + (7.34 * $count);
                }
                # diamond
                if ($item->getTypeId() == VanillaItems::DIAMOND()->getTypeId()) {
                    $count = $item->getCount();
                    $sellprice = $sellprice + (38.85 * $count);
                }
                # diamond block
                if ($item->getTypeId() == VanillaBlocks::DIAMOND()->getTypeId()) {
                    $count = $item->getCount();
                    $sellprice = $sellprice + (155.40 * $count);
                }

                # emerald ore
                if ($item->getTypeId() == VanillaBlocks::EMERALD_ORE()->getTypeId()) {
                    $count = $item->getCount();
                    $sellprice = $sellprice + (27.35 * $count);
                }
                # emerald
                if ($item->getTypeId() == VanillaItems::EMERALD()->getTypeId()) {
                    $count = $item->getCount();
                    $sellprice = $sellprice + (144.92 * $count);
                }
                # emerald block
                if ($item->getTypeId() == VanillaBlocks::EMERALD()->getTypeId()) {
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

        $this->setCooldown($player, $this->cooldownDuration);
    }

    public function getPriority(): int
    {
        return 1;
    }

}