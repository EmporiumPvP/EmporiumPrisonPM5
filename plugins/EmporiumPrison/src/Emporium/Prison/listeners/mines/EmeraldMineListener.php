<?php

namespace Emporium\Prison\listeners\mines;

use Emporium\Prison\Managers\EnergyManager;
use Emporium\Prison\Managers\MiningManager;
use Emporium\Prison\Managers\PickaxeManager;
use Emporium\Prison\EmporiumPrison;
use Emporium\Prison\tasks\BedrockSpawnTask;
use Emporium\Prison\tasks\Ores\EmeraldBlockSpawnTask;
use Emporium\Prison\tasks\Ores\OreRegenTask;

use EmporiumData\DataManager;

use JsonException;

use pocketmine\block\BlockLegacyIds;
use pocketmine\block\VanillaBlocks;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\Listener;
use pocketmine\item\Item;
use pocketmine\item\ItemIds;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;

class EmeraldMineListener implements Listener {

    private array $ores = [ItemIds::EMERALD_ORE, ItemIds::EMERALD_BLOCK];

    private PickaxeManager $pickaxeManager;
    private EnergyManager $energyManager;
    private MiningManager $miningManager;

    public function __construct() {
        $this->pickaxeManager = EmporiumPrison::getInstance()->getPickaxeManager();
        $this->energyManager = EmporiumPrison::getInstance()->getEnergyManager();
        $this->miningManager = EmporiumPrison::getInstance()->getMiningManager();
    }

    /**
     * @throws JsonException
     */
    public function onMine(BlockBreakEvent $event) {

        # event info
        $player = $event->getPlayer();
        $blockId = $event->getBlock()->getIdInfo()->getBlockId();
        $world = $event->getPlayer()->getWorld()->getFolderName();

        # world check
        if($world != "world") return;

        # ore check
        if(!in_array($blockId, $this->ores)) {
            $event->cancel();
            return;
        }

        # item info
        $item = $event->getPlayer()->getInventory()->getItemInHand();

        # pickaxe checks
        if($item->getNamedTag()->getTag("PickaxeType") === null) {
            $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "Try using a pickaxe");
            $event->cancel();
            return;
        }
        if($item->getNamedTag()->getTag("Level") === null) {
            $event->cancel();
            return;
        }
        if($item->getNamedTag()->getTag("Energy") === null) {
            $event->cancel();
            return;
        }

        # pickaxe data
        $pickaxeLevel = $item->getNamedTag()->getInt("Level");
        $energy = $item->getNamedTag()->getInt("Energy");
        $energyNeeded = $this->pickaxeManager->getEnergyNeeded($item);

        if(!in_array($blockId, $this->ores)) return;

        # check pickaxe type
        if($item->getNamedTag()->getString("PickaxeType") != "Diamond") {
            $event->cancel();
            $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You can only use a" . TF::BOLD . TF::GREEN . " Diamond Pickaxe" . TF::RESET . TF::RED . " here!");
            return;
        }

        # block info
        $block = $event->getBlock();
        $blockId = $event->getBlock()->getIdInfo()->getBlockId();
        $blockPosition = $block->getPosition();

        # player boosters data
        $energyBoosterTime = $this->energyManager->getTime($player);
        $energyMultiplier = $this->energyManager->getMultiplier($player);
        $miningBoosterTime = $this->miningManager->getTime($player);
        $miningMultiplier = $this->miningManager->getMultiplier($player);

        # remove drops
        $event->setDrops([]);
        $event->setXpDropAmount(0);

        # block regen chance
        $chance = mt_rand(1, 30);

        # max pickaxe level (don't check for energy)
        if($pickaxeLevel == 100) {

            # ore regen
            switch($blockId) {

                case BlockLegacyIds::EMERALD_ORE:

                    if($chance === 1) {
                        # spawn coal block
                        EmporiumPrison::getInstance()->getScheduler()->scheduleDelayedTask(new EmeraldBlockSpawnTask($block, $blockPosition), 1);
                    } else {
                        EmporiumPrison::getInstance()->getScheduler()->scheduleDelayedTask(new BedrockSpawnTask($block, $blockPosition), 1);
                        EmporiumPrison::getInstance()->getScheduler()->scheduleDelayedTask(new OreRegenTask($block, $blockPosition, $blockId), 20 * 10);
                    }

                    # energy to add
                    $energy = mt_rand(80, 90);

                    # xp to add
                    $xp = 16;

                    # auto pickup
                    if($player->getInventory()->canAddItem(VanillaBlocks::EMERALD_ORE()->asItem())) {
                        $player->getInventory()->addItem(VanillaBlocks::EMERALD_ORE()->asItem());
                    } else {
                        $player->sendMessage(TF::RED . "Your inventory is full");
                        $player->getWorld()->dropItem($block->getPosition()->asVector3()->up(), VanillaBlocks::EMERALD_ORE()->asItem());
                    }
                    break;

                case BlockLegacyIds::EMERALD_BLOCK:

                    if($chance === 1) {
                        # spawn coal block
                        EmporiumPrison::getInstance()->getScheduler()->scheduleDelayedTask(new EmeraldBlockSpawnTask($block, $blockPosition), 1);
                    }
                    if($chance > 1) {
                        # spawn placeholder block
                        EmporiumPrison::getInstance()->getScheduler()->scheduleDelayedTask(new BedrockSpawnTask($block, $blockPosition), 1);
                        # schedule regen
                        EmporiumPrison::getInstance()->getScheduler()->scheduleDelayedTask(new OreRegenTask($block, $blockPosition, $blockId), 20 * 20);
                    }

                    # energy to add
                    $energy = mt_rand(160, 180);

                    # xp to add
                    $xp = 32;

                    # auto pickup (block)
                    if($player->getInventory()->canAddItem(VanillaBlocks::EMERALD()->asItem())) {
                        $player->getInventory()->addItem(VanillaBlocks::EMERALD()->asItem());
                    } else {
                        $player->sendMessage(TF::RED . "Your inventory is full");
                        $player->getWorld()->dropItem($block->getPosition()->asVector3()->up(), VanillaBlocks::EMERALD()->asItem());
                    }
                    break;

                default:
                    $xp = 0;
                    $energy = 0;
            }
            # check for player level up
            EmporiumPrison::getInstance()->getPlayerLevelManager()->checkPlayerLevelUp($player);

            # add pickaxe Data
            $item->getNamedTag()->setInt("BlocksMined", $item->getNamedTag()->getInt("BlocksMined") + 1);

            $this->addXpToPlayer($xp, $player, $miningBoosterTime, $miningMultiplier);
            $this->addEnergyToPickaxe($energy, $item, $energyBoosterTime, $energyMultiplier);

            # pickaxe update
            $this->pickaxeManager->updatePickaxeSetInHand($player, $item);
            return;
        }

        # pickaxe energy is full
        if($energy >= $energyNeeded) {
            $event->cancel();
            $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "Your pickaxe is full of energy");
            $player->sendMessage(TF::GRAY . "You must Forge your pickaxe at the Wormhole! It can be found near " . TF::AQUA . "/spawn");
            $player->sendMessage(TF::GRAY . "This will level up your pickaxe, and give you the chance to gain or upgrade an Enchant.");
            return;
        }

        # ore regen
        switch($blockId) {

            case BlockLegacyIds::EMERALD_ORE:

                if($chance === 1) {
                    # spawn coal block
                    EmporiumPrison::getInstance()->getScheduler()->scheduleDelayedTask(new EmeraldBlockSpawnTask($block, $blockPosition), 1);
                } else {
                    EmporiumPrison::getInstance()->getScheduler()->scheduleDelayedTask(new BedrockSpawnTask($block, $blockPosition), 1);
                    EmporiumPrison::getInstance()->getScheduler()->scheduleDelayedTask(new OreRegenTask($block, $blockPosition, $blockId), 20 * 10);
                }

                # energy to add
                $energy = mt_rand(80, 90);

                # xp to add
                $xp = 16;

                # auto pickup
                if($player->getInventory()->canAddItem(VanillaBlocks::EMERALD_ORE()->asItem())) {
                    $player->getInventory()->addItem(VanillaBlocks::EMERALD_ORE()->asItem());
                } else {
                    $player->sendMessage(TF::RED . "Your inventory is full");
                    $player->getWorld()->dropItem($block->getPosition()->asVector3()->up(), VanillaBlocks::EMERALD_ORE()->asItem());
                }
                break;

            case BlockLegacyIds::EMERALD_BLOCK:

                if($chance === 1) {
                    # spawn coal block
                    EmporiumPrison::getInstance()->getScheduler()->scheduleDelayedTask(new EmeraldBlockSpawnTask($block, $blockPosition), 1);
                }
                if($chance > 1) {
                    # spawn placeholder block
                    EmporiumPrison::getInstance()->getScheduler()->scheduleDelayedTask(new BedrockSpawnTask($block, $blockPosition), 1);
                    # schedule regen
                    EmporiumPrison::getInstance()->getScheduler()->scheduleDelayedTask(new OreRegenTask($block, $blockPosition, $blockId), 20 * 20);
                }

                # energy to add
                $energy = mt_rand(160, 180);

                # xp to add
                $xp = 32;

                # auto pickup (block)
                if($player->getInventory()->canAddItem(VanillaBlocks::EMERALD()->asItem())) {
                    $player->getInventory()->addItem(VanillaBlocks::EMERALD()->asItem());
                } else {
                    $player->sendMessage(TF::RED . "Your inventory is full");
                    $player->getWorld()->dropItem($block->getPosition()->asVector3()->up(), VanillaBlocks::EMERALD()->asItem());
                }
                break;

            default:
                $xp = 0;
                $energy = 0;
        }

        $this->addXpToPlayer($xp, $player, $miningBoosterTime, $miningMultiplier);
        $this->addEnergyToPickaxe($energy, $item, $energyBoosterTime, $energyMultiplier);

        # add pickaxe Data
        $item->getNamedTag()->setInt("BlocksMined", $item->getNamedTag()->getInt("BlocksMined") + 1);

        # check player level up
        EmporiumPrison::getInstance()->getPlayerLevelManager()->checkPlayerLevelUp($player);

        # update pickaxe
        $this->pickaxeManager->updatePickaxeSetInHand($player, $item);

    }

    private function addEnergyToPickaxe(int $energy, Item $item, int $boosterTime, int $energyMultiplier): void {
        # with booster
        if($boosterTime >= 1) {
            $item->getNamedTag()->setInt("Energy", $item->getNamedTag()->getInt("Energy") + ($energy * 2) * $energyMultiplier);
            return;
        }
        # no booster
        $item->getNamedTag()->setInt("Energy", $item->getNamedTag()->getInt("Energy") + ($energy * 2));
    }

    private function addXpToPlayer(int $xp, Player $player, int $miningBoosterTime, int $miningMultiplier): void {
        if ($miningBoosterTime >= 1) {
            $player->sendTip("+" . $xp * $miningMultiplier . "xp");
            DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.xp", DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.xp") + ($xp * $miningMultiplier));
            DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.total-xp", DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.total-xp") + ($xp * $miningMultiplier));
        }
        if($miningBoosterTime < 1) {
            $player->sendTip("+$xp xp");
            DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.xp", DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.xp") + $xp);
            DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.total-xp", DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.total-xp") + $xp);
        }
    }
}