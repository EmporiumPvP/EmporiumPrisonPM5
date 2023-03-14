<?php

# Namespaces
namespace Tetro\EmporiumEnchants\Enchants\Weapons\Global;

# Pocketmine API
use pocketmine\block\{BlockFactory, BlockLegacyIds};
use pocketmine\block\tile\{Sign, Tile};
use pocketmine\block\VanillaBlocks;
use pocketmine\event\Event;
use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\network\mcpe\convert\RuntimeBlockMapping;
use pocketmine\network\mcpe\protocol\{BlockActorDataPacket, UpdateBlockPacket};
use pocketmine\network\mcpe\protocol\serializer\NetworkNbtSerializer;
use pocketmine\network\mcpe\protocol\types\{BlockPosition, CacheableNbt};
use pocketmine\player\Player;
use pocketmine\scheduler\ClosureTask;
use pocketmine\utils\TextFormat;
use pocketmine\world\Position;
use Tetro\EmporiumEnchants\Core\{CustomEnchant};
use Tetro\EmporiumEnchants\Core\Types\ReactiveEnchantment;

# Used Files

# Enchantment Class
class HallucinationCE extends ReactiveEnchantment
{

    # Register Enchantment
    /** @var bool[] */
    public static array $hallucinating;
    public string $name = "Hallucination";
    public string $description = "Has a chance to trap your opponent in a temporary box.";
    public int $rarity = CustomEnchant::RARITY_HEROIC;
    public int $cooldownDuration = 50;
    public int $maxLevel = 5;

    # Compatibility
    public int $usageType = CustomEnchant::TYPE_HAND;

    # Variables
    public int $itemType = CustomEnchant::ITEM_TYPE_WEAPON;
    /** @var NetworkNbtSerializer */
    public $nbtWriter = null;

    # Enchantment

    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void
    {
        $victim = $event->getEntity();
        if ($victim instanceof Player && !isset(self::$hallucinating[$victim->getName()])) {
            $originalPosition = Position::fromObject($victim->getPosition()->round(), $victim->getWorld());
            self::$hallucinating[$victim->getName()] = true;
            $this->plugin->getScheduler()->scheduleRepeatingTask(($task = new ClosureTask(function () use ($victim, $originalPosition): void {
                $packets = [];
                for ($x = $originalPosition->x - 1; $x <= $originalPosition->x + 1; $x++) {
                    for ($y = $originalPosition->y - 1; $y <= $originalPosition->y + 2; $y++) {
                        for ($z = $originalPosition->z - 1; $z <= $originalPosition->z + 1; $z++) {
                            $position = new Position($x, $y, $z, $originalPosition->getWorld());
                            $block = VanillaBlocks::BEDROCK();
                            if ($position->equals($originalPosition)) $block = VanillaBlocks::LAVA();
                            if ($position->equals($originalPosition->add(0, 1, 0))) {
                                $block = BlockFactory::getInstance()->get(BlockLegacyIds::WALL_SIGN, 2);
                                if ($this->nbtWriter === null) $this->nbtWriter = new NetworkNbtSerializer();
                                $packets[] = BlockActorDataPacket::create(BlockPosition::fromVector3($position->floor()), new CacheableNbt(
                                    CompoundTag::create()->
                                    setString(Tile::TAG_ID, "Sign")->
                                    setInt(Tile::TAG_X, $position->getFloorX())->
                                    setInt(Tile::TAG_Y, $position->getFloorY())->
                                    setInt(Tile::TAG_Z, $position->getFloorZ())->
                                    setString(Sign::TAG_TEXT_BLOB, implode("\n", ["§cYou seem to be", "§challucinating..."])
                                    )));
                            }
                            $packets[] = UpdateBlockPacket::create(BlockPosition::fromVector3($position->floor()), RuntimeBlockMapping::getInstance()->toRuntimeId($block->getFullId()), UpdateBlockPacket::FLAG_NETWORK, UpdateBlockPacket::DATA_LAYER_NORMAL);
                        }
                    }
                }
                $victim->getServer()->broadcastPackets([$victim], $packets);
            })), 1);
            $this->plugin->getScheduler()->scheduleDelayedTask(new ClosureTask(function () use ($originalPosition, $victim, $task): void {
                $task->getHandler()->cancel();
                $blocks = [];
                for ($x = -1; $x <= 1; $x++) {
                    for ($y = -1; $y <= 3; $y++) {
                        for ($z = -1; $z <= 1; $z++) {
                            $blocks[] = $originalPosition->round()->add($x, $y, $z);
                        }
                    }
                }
                $victim->getServer()->broadcastPackets([$victim], $victim->getWorld()->createBlockUpdatePackets($blocks));
                unset(self::$hallucinating[$victim->getName()]);
            }), 20 * 8);
            $player->sendMessage("§l§d** Hallucination **");
            $victim->sendTitle(TextFormat::BOLD . TextFormat::LIGHT_PURPLE . "HALLUCINATION", 40, 40, 40);
            $this->setCooldown($player, 60);
            $victim->sendSubtitle(TextFormat::BOLD . TextFormat::LIGHT_PURPLE . "You are now Hallucinated!", 20, 20, 20);
        }
        $this->setCooldown($player, 60);
    }
}