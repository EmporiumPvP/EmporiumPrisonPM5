<?php

namespace Tetro\EmporiumEnchants\Enchants\Tools;

use Emporium\Prison\Managers\misc\Translator;
use EmporiumCore\managers\data\DataManager;
use JsonException;
use pocketmine\item\Item;
use pocketmine\event\Event;
use pocketmine\player\Player;
use pocketmine\inventory\Inventory;
use pocketmine\event\block\BlockBreakEvent;


use pocketmine\utils\TextFormat;
use Tetro\EmporiumEnchants\Core\CustomEnchant;
use Tetro\EmporiumEnchants\Core\Types\ReactiveEnchantment;

class JackpotCE extends ReactiveEnchantment {

    # Register Enchantment
    public string $name = "Jackpot";
    public string $description = "Gives you money whilst mining.";
    public int $rarity = CustomEnchant::RARITY_PICKAXE;
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
    
    # Enchantment

    /**
     * @throws JsonException
     */
    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void {
        // Chance
        $chance = floor(800 / $level);
        if (mt_rand(1, $chance) !== mt_rand(1, $chance)) {
            return;
        }
        // Enchantment Code
        if ($event instanceof BlockBreakEvent) {

            $amount = mt_rand(1, 10000) * $level;
            DataManager::addData($player, "Players", "Money", $amount);
            $player->sendMessage("§r §6Jackpot§8 | §a+$" . Translator::shortNumber($amount));
            $this->setCooldown($player, 60);
        }
    }

}