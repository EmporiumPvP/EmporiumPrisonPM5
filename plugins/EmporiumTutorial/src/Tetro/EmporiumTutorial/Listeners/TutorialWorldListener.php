<?php

namespace Tetro\EmporiumTutorial\Listeners;

use Emporium\Prison\EmporiumPrison;
use Emporium\Prison\Managers\EnergyManager;
use Emporium\Prison\Managers\MiningManager;
use Emporium\Prison\Managers\PickaxeManager;
use Emporium\Prison\Managers\PlayerLevelManager;
use Emporium\Prison\tasks\BedrockSpawnTask;
use Emporium\Prison\tasks\Ores\CoalBlockSpawnTask;
use Emporium\Prison\tasks\Ores\OreRegenTask;
use Emporium\Prison\Variables;

use JsonException;
use pocketmine\event\inventory\InventoryTransactionEvent;
use pocketmine\inventory\transaction\action\DropItemAction;
use pocketmine\item\Item;
use pocketmine\player\Player;
use Tetro\EmporiumWormhole\EmporiumWormhole;

use EmporiumData\DataManager;

use pocketmine\block\BlockLegacyIds;
use pocketmine\block\VanillaBlocks;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDropItemEvent;
use pocketmine\utils\TextFormat;
use pocketmine\utils\TextFormat as TF;
use pocketmine\world\sound\EndermanTeleportSound;
use pocketmine\world\sound\XpLevelUpSound;

use Tetro\EmporiumTutorial\EmporiumTutorial;
use Tetro\EmporiumTutorial\Managers\TutorialManager;

class TutorialWorldListener implements Listener {

    private PickaxeManager $pickaxeManager;
    private TutorialManager $tutorialManager;
    private EnergyManager $energyManager;
    private MiningManager $miningManager;
    private PlayerLevelManager $playerLevelManager;

    public function __construct(){
        # Managers
        $this->pickaxeManager = EmporiumPrison::getInstance()->getPickaxeManager();
        $this->tutorialManager = EmporiumTutorial::getInstance()->getTutorialManager();
        $this->energyManager = EmporiumPrison::getInstance()->getEnergyManager();
        $this->miningManager = EmporiumPrison::getInstance()->getMiningManager();
        $this->playerLevelManager = EmporiumPrison::getInstance()->getPlayerLevelManager();
    }

    private array $ores = [
        BlockLegacyIds::COAL_ORE,
        BlockLegacyIds::COAL_BLOCK,
        BlockLegacyIds::QUARTZ_ORE
    ];

    public function onDropItem(PlayerDropItemEvent $event) {

        $player = $event->getPlayer();
        $item = $event->getItem();
        $playerX = $player->getPosition()->getX();
        $playerY = $player->getPosition()->getY();
        $playerZ = $player->getPosition()->getZ();
        $world = $player->getWorld()->getFolderName();

        if($world != "TutorialMine") return;

        # is player in wormhole range
        if(!$playerX >= -25 && !$playerX <= -5 && !$playerY >= 145 && !$playerY <= 153 && !$playerZ >= 5 && !$playerZ <= 25) return;

        # is it an upgradable pickaxe
        if($item->getNamedTag()->getTag("PickaxeType") == null) {
            $event->cancel();
            $player->broadcastSound(new XpLevelUpSound(30));
            $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You need to be holding the Pickaxe you want to enchant");
            return;
        }

        # compatability checks
        if($item->getNamedTag()->getTag("Level") == null) return;
        $level = $item->getNamedTag()->getInt("Level");

        # pickaxe is max level
        if($level >= 100) {
            $event->cancel();
            $player->sendMessage(TF::RED . "You need to prestige your pickaxe to do this");
            return;
        }

        # does pickaxe have energy
        if($item->getNamedTag()->getTag("Energy") == null) return;
        $energy = $item->getNamedTag()->getInt("Energy");
        $energyNeeded = $this->pickaxeManager->getEnergyNeeded($item);

        # does pickaxe have enough energy
        $event->cancel();
        if ($energy < $energyNeeded) {
            $player->broadcastSound(new XpLevelUpSound(30));
            $player->sendMessage(TF::RED . "You need more energy to Enchant!");
            return;
        }

        # pickaxe is ready to level up
        # remove pickaxe from inventory
        $player->getInventory()->remove($item);

        # remove pickaxe from cursor
        $player->getCursorInventory()->remove($item);

        # play sound to player
        $player->broadcastSound(new EndermanTeleportSound(), [$player]);

        # remove energy from pickaxe
        $removedEnergyPickaxe = $this->pickaxeManager->removeLevelUpEnergy($item);

        # send inventory
        $menu = EmporiumWormhole::getInstance()->getMenu();
        $menu->Inventory($player, $removedEnergyPickaxe);
    }

    /**
     * @priority HIGHEST
     * @throws JsonException
     */
    public function onBlockBreak(BlockBreakEvent $event) {

        # event info
        $player = $event->getPlayer();
        $blockId = $event->getBlock()->getIdInfo()->getBlockId();
        $world = $event->getPlayer()->getWorld()->getFolderName();

        # world check
        if($world != "TutorialMine") return;

        # ore check
        if(!in_array($blockId, $this->ores)) {
            $event->cancel();
            return;
        }

        # item info
        $item = $event->getPlayer()->getInventory()->getItemInHand();

        # tutorial player data
        $tutorialProgress = $this->tutorialManager->getPlayerTutorialProgress($player);

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

        # pickaxe prestige data
        $xpMasteryBuff = $item->getNamedTag()->getInt("XpMasteryBuff");
        $hoarderBuff = $item->getNamedTag()->getInt("HoarderBuff");
        $meteoriteMasteryBuff = $item->getNamedTag()->getInt("MeteoriteMasteryBuff");

        # tutorial checks
        if($tutorialProgress === 5 && $this->playerLevelManager->getPlayerLevel($player) >= 10) {
            DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.tutorial-progress", DataManager::getInstance()->getPlayerData($player->getXuid(),  "profile.tutorial-progress") + 1);
            $this->tutorialManager->startTutorial($player);
        }
        if($tutorialProgress === 6 && $this->tutorialManager->checkPlayerTutorialComplete($player) === false) {
            DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.tutorial-complete", true);
            $this->tutorialManager->startTutorial($player);
        }
        if($tutorialProgress === 6 && $this->tutorialManager->checkPlayerTutorialComplete($player) === true) {
            $event->cancel();
            $this->tutorialManager->startTutorial($player);
        }

        # check pickaxe type
        if($item->getNamedTag()->getString("PickaxeType") != "Trainee") {
            $event->cancel();
            $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RED . "You can only use a" . TF::GREEN . " Wooden Pickaxe" . TF::RED . " here!");
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

        # increment tutorial blocks mined
        DataManager::getInstance()->setPlayerData($player->getXuid(),  "profile.tutorial-blocks-mined", DataManager::getInstance()->getPlayerData($player->getXuid(),  "profile.tutorial-blocks-mined") + 1);

        # max pickaxe level (don't check for energy)
        if($pickaxeLevel == 100) {

            # ore regen
            switch($blockId) {

                case BlockLegacyIds::COAL_ORE:

                    if($chance === 1) {
                        # spawn coal block
                        EmporiumPrison::getInstance()->getScheduler()->scheduleDelayedTask(new CoalBlockSpawnTask($block, $blockPosition), 1);
                    } else {
                        EmporiumPrison::getInstance()->getScheduler()->scheduleDelayedTask(new BedrockSpawnTask($block, $blockPosition), 1);
                        EmporiumPrison::getInstance()->getScheduler()->scheduleDelayedTask(new OreRegenTask($block, $blockPosition, $blockId), 20 * 10);
                    }

                    # energy to add
                    $energy = mt_rand(10, 20);

                    # xp to add
                    $xp = 8 + $xpMasteryBuff;

                    # auto pickup
                    if($player->getInventory()->canAddItem(VanillaBlocks::COAL_ORE()->asItem())) {
                        $player->getInventory()->addItem(VanillaBlocks::COAL_ORE()->asItem()->setCount(1 + $hoarderBuff));
                    } else {
                        $player->sendMessage(TextFormat::RED . "Your inventory is full");
                        $player->getWorld()->dropItem($block->getPosition()->asVector3()->up(), VanillaBlocks::COAL_ORE()->asItem()->setCount(1 + $hoarderBuff));
                    }
                    break;

                case BlockLegacyIds::COAL_BLOCK:

                    if($chance === 1) {
                        # spawn coal block
                        EmporiumPrison::getInstance()->getScheduler()->scheduleDelayedTask(new CoalBlockSpawnTask($block, $blockPosition), 1);
                    }

                    if($chance > 1) {
                        # spawn placeholder block
                        EmporiumPrison::getInstance()->getScheduler()->scheduleDelayedTask(new BedrockSpawnTask($block, $blockPosition), 1);
                        # schedule regen
                        EmporiumPrison::getInstance()->getScheduler()->scheduleDelayedTask(new OreRegenTask($block, $blockPosition, $blockId), 20 * 20);
                    }

                    # add energy to player
                    $energy = mt_rand(20, 30);

                    # add xp to player
                    $xp = 16 + $xpMasteryBuff;

                    # auto pickup (block)
                    if($player->getInventory()->canAddItem(VanillaBlocks::COAL()->asItem())) {
                        $player->getInventory()->addItem(VanillaBlocks::COAL()->asItem()->setCount(1 + $hoarderBuff));
                    } else {
                        $player->sendMessage(TextFormat::RED . "Your inventory is full");
                        $player->getWorld()->dropItem($block->getPosition()->asVector3()->up(), VanillaBlocks::COAL()->asItem()->setCount(1 + $hoarderBuff));
                    }
                    break;

                default:
                    $xp = 0;
                    $energy = 0;
            }
            # check for player level up
            EmporiumPrison::getInstance()->getPlayerLevelManager()->checkPlayerLevelUp($player);

            # add pickaxe Data
            $item->getNamedTag()->setInt("BlocksMined", $item->getNamedTag()->getInt("BlocksMined") + (1 + $hoarderBuff));

            $this->addXpToPlayer($xp, $player, $miningBoosterTime, $miningMultiplier);
            $this->addEnergyToPickaxe($energy, $item, $energyBoosterTime, $energyMultiplier);

            # pickaxe update
            $this->pickaxeManager->updatePickaxeSetInHand($player, $item);

            return;
        }

        # pickaxe energy is full
        if($energy >= $energyNeeded) {
            # tutorial check
            if($tutorialProgress == 3) {
                DataManager::getInstance()->setPlayerData($player->getXuid(),  "profile.tutorial-progress", DataManager::getInstance()->getPlayerData($player->getXuid(),  "profile.tutorial-progress") + 1);
                $this->tutorialManager->startTutorial($player);
                $event->cancel();
                return;
            }
            $event->cancel();
            $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "Your pickaxe is full of energy");
            $player->sendMessage(TF::GRAY . "You must Forge your pickaxe at the Wormhole! It can be found near " . TF::AQUA . "/spawn");
            $player->sendMessage(TF::GRAY . "This will level up your pickaxe, and give you the chance to gain or upgrade an Enchant.");
            return;
        }

        switch($blockId) {
            case BlockLegacyIds::COAL_ORE:

                if($chance === 1) {
                    # spawn coal block
                    EmporiumPrison::getInstance()->getScheduler()->scheduleDelayedTask(new CoalBlockSpawnTask($block, $blockPosition), 1);
                } else {
                    EmporiumPrison::getInstance()->getScheduler()->scheduleDelayedTask(new BedrockSpawnTask($block, $blockPosition), 1);
                    EmporiumPrison::getInstance()->getScheduler()->scheduleDelayedTask(new OreRegenTask($block, $blockPosition, $blockId), 20 * 10);
                }

                # energy to add
                $energy = mt_rand(10, 20);
                # xp to add
                $xp = 8 + $xpMasteryBuff;

                # auto pickup
                if($player->getInventory()->canAddItem(VanillaBlocks::COAL_ORE()->asItem())) {
                    $player->getInventory()->addItem(VanillaBlocks::COAL_ORE()->asItem()->setCount(1 + $hoarderBuff));
                } else {
                    $player->sendMessage(TextFormat::RED . "Your inventory is full");
                    $player->getWorld()->dropItem($block->getPosition()->asVector3()->up(), VanillaBlocks::COAL_ORE()->asItem()->setCount(1 + $hoarderBuff));
                }
                break;

            case BlockLegacyIds::COAL_BLOCK:

                if($chance === 1) {
                    # spawn coal block
                    EmporiumPrison::getInstance()->getScheduler()->scheduleDelayedTask(new CoalBlockSpawnTask($block, $blockPosition), 1);
                }

                if($chance > 1) {
                    # spawn placeholder block
                    EmporiumPrison::getInstance()->getScheduler()->scheduleDelayedTask(new BedrockSpawnTask($block, $blockPosition), 1);
                    # schedule regen
                    EmporiumPrison::getInstance()->getScheduler()->scheduleDelayedTask(new OreRegenTask($block, $blockPosition, $blockId), 20 * 20);
                }

                # energy to add
                $energy = mt_rand(20, 30);
                # xp to add
                $xp = 16 + $xpMasteryBuff;

                # auto pickup (block)
                if($player->getInventory()->canAddItem(VanillaBlocks::COAL()->asItem())) {
                    $player->getInventory()->addItem(VanillaBlocks::COAL()->asItem()->setCount(1 + $hoarderBuff));
                } else {
                    $player->sendMessage(TextFormat::RED . "Your inventory is full");
                    $player->getWorld()->dropItem($block->getPosition()->asVector3()->up(), VanillaBlocks::COAL()->asItem()->setCount(1 + $hoarderBuff));
                }
                break;

            default:
                $xp = 0;
                $energy = 0;
        }

        $this->addXpToPlayer($xp, $player, $miningBoosterTime, $miningMultiplier);
        $this->addEnergyToPickaxe($energy, $item, $energyBoosterTime, $energyMultiplier);

        # add pickaxe Data
        $item->getNamedTag()->setInt("BlocksMined", $item->getNamedTag()->getInt("BlocksMined") + (1 + $hoarderBuff));

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

    public function checkIfPlayerDropsItemFromInventoryNearWormhole(InventoryTransactionEvent $event) {

        $player = $event->getTransaction()->getSource();
        $world = $player->getWorld()->getFolderName();

        if($world != "TutorialMine") return;

        $playerX = $player->getPosition()->getX();
        $playerY = $player->getPosition()->getY();
        $playerZ = $player->getPosition()->getZ();

        # is player in wormhole range
        if(!$playerX >= -25 && !$playerX <= -5 && !$playerY >= 145 && !$playerY <= 153 && !$playerZ >= 5 && !$playerZ <= 25) return;

        if($event->getTransaction() instanceof DropItemAction) {
            $event->cancel();
        }
    }
}