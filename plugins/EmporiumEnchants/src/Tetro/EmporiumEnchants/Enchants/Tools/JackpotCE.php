<?php

namespace Tetro\EmporiumEnchants\Enchants\Tools;

use Emporium\Prison\Managers\misc\Translator;
use EmporiumData\DataManager;
use pocketmine\block\BlockTypeIds;
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
    public int $chance = 800;

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

    # Enchantment
    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void {

        if(!$event instanceof BlockBreakEvent) return;

        if($event->isCancelled()) return;

        $blockId = $event->getBlock()->getTypeId();

        if(!in_array($blockId, $this->ores)) return;

        // Chance
        $chance = floor($this->chance / $level);
        if (mt_rand(1, $chance) !== mt_rand(1, $chance)) return;

        $amount = mt_rand(1, 10000) * $level;
        DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.money") + $amount);
        $player->sendMessage(TF::GOLD . "Jackpot" . TF::DARK_GRAY . " " . TF::GREEN . "+$" . TF::WHITE . Translator::shortNumber($amount));
        $this->setCooldown($player, $this->cooldownDuration);
    }

    public function getPriority(): int
    {
        return 4;
    }
}