<?php

namespace Tetro\EmporiumEnchants\Enchants\Tools;

use Emporium\Prison\Managers\misc\Translator;
use EmporiumData\DataManager;
use pocketmine\block\BlockLegacyIds;
use pocketmine\item\Item;
use pocketmine\event\Event;
use pocketmine\player\Player;
use pocketmine\inventory\Inventory;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\utils\TextFormat as TF;

use Tetro\EmporiumEnchants\Core\CustomEnchant;
use Tetro\EmporiumEnchants\Core\Types\ReactiveEnchantment;

class JackpotCE extends ReactiveEnchantment {

    # Register Enchantment
    public string $name = "Jackpot";
    public string $description = "Gives you money whilst mining.";
    public int $rarity = CustomEnchant::RARITY_GODLY;
    public int $cooldownDuration = 60;
    public int $maxLevel = 10;
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
        $chance = floor(800 / $level);
        if (mt_rand(1, $chance) !== mt_rand(1, $chance)) {
            return;
        }
        // Enchantment Code
        if ($event instanceof BlockBreakEvent) {

            if($event->isCancelled()) return;

            $blockId = $event->getBlock()->getIdInfo()->getBlockId();

            if(!in_array($blockId, $this->ores)) {
                $event->cancel();
                return;
            }

            $amount = mt_rand(1, 10000) * $level;
            DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.money") + $amount);
            $player->sendMessage(TF::GOLD . "Jackpot" . TF::DARK_GRAY . " " . TF::GREEN . "+$" . TF::WHITE . Translator::shortNumber($amount));
            $this->setCooldown($player, 60);
        }
    }

    public function getPriority(): int
    {
        return 4;
    }
}