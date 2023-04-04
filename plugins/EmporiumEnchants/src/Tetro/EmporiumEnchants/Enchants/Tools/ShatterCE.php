<?php

namespace Tetro\EmporiumEnchants\Enchants\Tools;

use pocketmine\block\BlockLegacyIds;
use pocketmine\item\Item;
use pocketmine\event\Event;
use pocketmine\math\Axis;
use pocketmine\math\Facing;
use pocketmine\player\Player;
use pocketmine\inventory\Inventory;
use pocketmine\event\block\BlockBreakEvent;

use pocketmine\utils\TextFormat;
use pocketmine\world\sound\PotionSplashSound;
use Tetro\EmporiumEnchants\Core\CustomEnchant;
use Tetro\EmporiumEnchants\Core\Types\Misc\RecursiveEnchant;

class ShatterCE extends RecursiveEnchant {

    # Register Enchantment
    public string $name = "Shatter";
    public string $description = "Chance to cause an explosion which mines up nearby ores.";
    public int $rarity = CustomEnchant::RARITY_LEGENDARY;
    public int $cooldownDuration = 60;
    public int $maxLevel = 5;
    public int $chance = 1000;

    # Compatibility
    public int $usageType = CustomEnchant::TYPE_HAND;
    public int $itemType = CustomEnchant::ITEM_TYPE_TOOLS;

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

    /** @var int[] */
    public static array $lastBreakFace = [];

    public function getReagent(): array
    {
        return [BlockBreakEvent::class];
    }

    public function getDefaultExtraData(): array
    {
        return ["distanceMultiplier" => 1];
    }

    public function safeReact(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void
    {
        if(!(mt_rand(1, $this->chance) == $this->chance)) return;

        if ($event instanceof BlockBreakEvent) {
            if ($event->isCancelled()) return;

            $player->sendMessage(TextFormat::RED . "Shatter");
            $player->broadcastSound(new PotionSplashSound(), [$player]);

            $breakFace = self::$lastBreakFace[$player->getName()];
            for ($i = 0; $i <= $level * $this->extraData["distanceMultiplier"]; $i++) {
                $block = $event->getBlock()->getSide(Facing::opposite($breakFace), $i);
                $faceLeft = Facing::rotate($breakFace, Facing::axis($breakFace) !== Axis::Y ? Axis::Y : Axis::X, true);
                $faceUp = Facing::rotate($breakFace, Facing::axis($breakFace) !== Axis::Z ? Axis::Z : Axis::X, true);
                foreach ([
                             $block->getSide($faceLeft), //Center Left
                             $block->getSide(Facing::opposite($faceLeft)), //Center Right
                             $block->getSide($faceUp), //Center Top
                             $block->getSide(Facing::opposite($faceUp)), //Center Bottom
                             $block->getSide($faceUp)->getSide($faceLeft), //Top Left
                             $block->getSide($faceUp)->getSide(Facing::opposite($faceLeft)), //Top Right
                             $block->getSide(Facing::opposite($faceUp))->getSide($faceLeft), //Bottom Left
                             $block->getSide(Facing::opposite($faceUp))->getSide(Facing::opposite($faceLeft)) //Bottom Right
                         ] as $b) {
                    $player->getWorld()->useBreakOn($b->getPosition(), $item, $player, true);
                }
                if (!$block->getPosition()->equals($event->getBlock()->getPosition())) {
                    $player->getWorld()->useBreakOn($block->getPosition(), $item, $player, true);
                }
            }
            $this->setCooldown($player, 60);
        }

    }

}