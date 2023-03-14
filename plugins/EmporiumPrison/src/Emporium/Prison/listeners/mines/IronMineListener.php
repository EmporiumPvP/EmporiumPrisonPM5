<?php

namespace Emporium\Prison\listeners\mines;

use Emporium\Prison\EmporiumPrison;

use Emporium\Prison\Managers\DataManager;
use Emporium\Prison\Managers\EnergyManager;
use Emporium\Prison\Managers\MiningManager;
use Emporium\Prison\Managers\PickaxeManager;
use Emporium\Prison\Managers\PlayerLevelManager;

use Emporium\Prison\tasks\BedrockSpawnTask;
use Emporium\Prison\tasks\Ores\IronBlockSpawnTask;
use Emporium\Prison\tasks\Ores\OreRegenTask;

use Emporium\Prison\Variables;

use JsonException;

use pocketmine\block\BlockLegacyIds;

use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\Listener;

use pocketmine\item\StringToItemParser;
use pocketmine\utils\TextFormat as TF;

class IronMineListener implements Listener {

    private PickaxeManager $pickaxeManager;
    private PlayerLevelManager $playerLevelManager;
    private EnergyManager $energyManager;
    private MiningManager $miningManager;

    public function __construct() {
        # Managers
        $this->pickaxeManager = EmporiumPrison::getPickaxeManager();
        $this->playerLevelManager = EmporiumPrison::getPlayerLevelManager();
        $this->energyManager = EmporiumPrison::getEnergyManager();
        $this->miningManager = EmporiumPrison::getMiningManager();
    }

    /**
     * @throws JsonException
     */
    public function onMine(BlockBreakEvent $event)
    {

        $player = $event->getPlayer();
        $world = $event->getPlayer()->getWorld()->getFolderName();

        if ($world === "world") {
            # block info
            $block = $event->getBlock();
            $blockId = $event->getBlock()->getIdInfo()->getBlockId();
            $blockPosition = $block->getPosition();

            # item info
            $item = $event->getPlayer()->getInventory()->getItemInHand();
            $itemId = $item->getId();

            if ($blockId === 15 || $blockId === 42) {
                if ($itemId === 270) {
                    # energy
                    $energy = $item->getNamedTag()->getInt("Energy");
                    $energyNeeded = $this->pickaxeManager->getEnergyNeeded($item);

                    # boosters
                    $energyBoosterTime = $this->energyManager->getTime($player);
                    $energyMultiplier = $this->energyManager->getMultiplier($player);
                    $miningBoosterTime = $this->miningManager->getTime($player);
                    $miningMultiplier = $this->miningManager->getMultiplier($player);

                    if($item->getNamedTag()->getTag("Level") !== null) {
                        $pickaxeLevel = $item->getNamedTag()->getInt("Level");
                    } else {
                        $event->cancel();
                        return;
                    }

                    # player Data
                    $playerLevel = $this->playerLevelManager->getPlayerLevel($player);

                    if ($energy >= $energyNeeded) {
                        if($pickaxeLevel >= 100) {
                            switch ($blockId) {

                                case BlockLegacyIds::IRON_ORE: # wooden pickaxe required to break

                                    if ($playerLevel < 10) {
                                        $event->cancel();
                                        $player->sendMessage(Variables::SERVER_PREFIX . TF::RED . "Your player" . TF::GOLD . " /level" . TF::RED . " is too low!");
                                    } else {
                                        $chance = mt_rand(1, 30);
                                        if ($chance === 1) {
                                            # spawn iron block
                                            EmporiumPrison::getInstance()->getScheduler()->scheduleDelayedTask(new IronBlockSpawnTask($block, $blockPosition), 1);
                                        } else {
                                            # spawn bedrock schedule regen
                                            EmporiumPrison::getInstance()->getScheduler()->scheduleDelayedTask(new BedrockSpawnTask($block, $blockPosition), 1);
                                            EmporiumPrison::getInstance()->getScheduler()->scheduleDelayedTask(new OreRegenTask($block, $blockPosition, $blockId), 20 * 60);
                                        }
                                        # add energy to player
                                        $energy = mt_rand(20, 30);
                                        if ($energyBoosterTime > 0) {
                                            $multipliedEnergy = $energy * $energyMultiplier;
                                            $oldData = $item->getNamedTag()->getInt("Energy");
                                            $newData = $oldData + $multipliedEnergy;
                                            $item->getNamedTag()->setInt("Energy", $newData);
                                        } else {
                                            $oldData = $item->getNamedTag()->getInt("Energy");
                                            $newData = $oldData + $energy;
                                            $item->getNamedTag()->setInt("Energy", $newData);
                                        }
                                        # add xp to player
                                        $xp = 6;
                                        if ($miningBoosterTime > 0) {
                                            $multipliedXp = $xp * $miningMultiplier;
                                            $player->sendTip("+$multipliedXp xp");
                                            DataManager::addData($player, "Players", "xp", $multipliedXp);
                                            DataManager::addData($player, "Players", "total-xp", $multipliedXp);
                                        } else {
                                            $player->sendTip("+$xp xp");
                                            DataManager::addData($player, "Players", "xp", $xp);
                                            DataManager::addData($player, "Players", "total-xp", $xp);
                                        }
                                        # add pickaxe Data
                                        DataManager::addData($player, "Players", "iron-ore-mined", 1);
                                        $oldData = $item->getNamedTag()->getInt("BlocksMined");
                                        $newData = $oldData + 1;
                                        $item->getNamedTag()->setInt("BlocksMined", $newData);
                                        # auto pickup (blocks)
                                        if ($player->getInventory()->canAddItem(StringToItemParser::getInstance()->parse("iron_ore"))) {
                                            if ($event->isCancelled()) {
                                                $event->setDrops([]);
                                                return;
                                            } else {
                                                $event->setDrops([]);
                                                $event->getPlayer()->getInventory()->addItem(StringToItemParser::getInstance()->parse("iron_ore"));
                                            }
                                        } else {
                                            $event->setDrops([]);
                                            $player->sendTitle(TF::DARK_RED . "Inventory Full!");
                                        }
                                        # auto pickup (xp)
                                        $player->getXpManager()->addXp($event->getXpDropAmount());
                                        $event->setXpDropAmount(0);
                                        # check for pickaxe and player level up
                                        $this->pickaxeManager->updatePickaxeSetInHand($player, $item);
                                        $this->playerLevelManager->checkPlayerLevelUp($player);
                                    }
                                    break;

                                case BlockLegacyIds::IRON_BLOCK:
                                    if ($playerLevel < 10) {
                                        $event->cancel();
                                        $player->sendMessage(Variables::SERVER_PREFIX . TF::RED . "Your player" . TF::GOLD . " /level" . TF::RED . " is too low!");
                                    } else {
                                        $chance = mt_rand(1, 30);
                                        if ($chance === 1) {
                                            # spawn iron block
                                            EmporiumPrison::getInstance()->getScheduler()->scheduleDelayedTask(new IronBlockSpawnTask($block, $blockPosition), 1);
                                        } else {
                                            # spawn bedrock schedule regen
                                            EmporiumPrison::getInstance()->getScheduler()->scheduleDelayedTask(new BedrockSpawnTask($block, $blockPosition), 1);
                                            EmporiumPrison::getInstance()->getScheduler()->scheduleDelayedTask(new OreRegenTask($block, $blockPosition, $blockId), 20 * 6);
                                        }
                                        # add energy to player
                                        $energy = mt_rand(40, 60);
                                        if ($energyBoosterTime > 0) {
                                            $multipliedEnergy = $energy * $energyMultiplier;
                                            $oldData = $item->getNamedTag()->getInt("Energy");
                                            $newData = $oldData + $multipliedEnergy;
                                            $item->getNamedTag()->setInt("Energy", $newData);
                                        } else {
                                            $oldData = $item->getNamedTag()->getInt("Energy");
                                            $newData = $oldData + $energy;
                                            $item->getNamedTag()->setInt("Energy", $newData);
                                        }
                                        # add xp to player
                                        $xp = 12;
                                        if ($miningBoosterTime > 0) {
                                            $multipliedXp = $xp * $miningMultiplier;
                                            $player->sendTip("+$multipliedXp xp");
                                            DataManager::addData($player, "Players", "xp", $multipliedXp);
                                            DataManager::addData($player, "Players", "total-xp", $multipliedXp);
                                        } else {
                                            $player->sendTip("+$xp xp");
                                            DataManager::addData($player, "Players", "xp", $xp);
                                            DataManager::addData($player, "Players", "total-xp", $xp);
                                        }
                                        # add pickaxe Data
                                        DataManager::addData($player, "Players", "iron-ore-mined", 1);
                                        $oldData = $item->getNamedTag()->getInt("BlocksMined");
                                        $newData = $oldData + 1;
                                        $item->getNamedTag()->setInt("BlocksMined", $newData);
                                        # auto pickup (blocks)
                                        if ($player->getInventory()->canAddItem(StringToItemParser::getInstance()->parse("iron_block"))) {
                                            if ($event->isCancelled()) {
                                                $event->setDrops([]);
                                                return;
                                            } else {
                                                $event->setDrops([]);
                                                $event->getPlayer()->getInventory()->addItem(StringToItemParser::getInstance()->parse("iron_block"));
                                            }
                                        } else {
                                            $event->setDrops([]);
                                            $player->sendTitle(TF::DARK_RED . "Inventory Full!");
                                        }
                                        # auto pickup (xp)
                                        $player->getXpManager()->addXp($event->getXpDropAmount());
                                        $event->setXpDropAmount(0);
                                        # check for pickaxe and player level up
                                        $this->pickaxeManager->updatePickaxeSetInHand($player, $item);
                                        $this->playerLevelManager->checkPlayerLevelUp($player);
                                    }
                                    break;

                            }
                        } else {
                            $event->cancel();
                            $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "Your pickaxe is full of energy");
                            $player->sendMessage(TF::GRAY . "You must get the Wormhole to Forge your pickaxe! He can be found near " . TF::AQUA . "/spawn");
                            $player->sendMessage(TF::GRAY . "This will level up your pickaxe, and give you the chance to gain or upgrade an Enchant.");
                        }
                    } else {
                        switch ($blockId) {

                            case BlockLegacyIds::IRON_ORE: # wooden pickaxe required to break

                                if ($playerLevel < 10) {
                                    $event->cancel();
                                    $player->sendMessage(Variables::SERVER_PREFIX . TF::RED . "Your player" . TF::GOLD . " /level" . TF::RED . " is too low!");
                                } else {
                                    $chance = mt_rand(1, 30);
                                    if ($chance === 1) {
                                        # spawn iron block
                                        EmporiumPrison::getInstance()->getScheduler()->scheduleDelayedTask(new IronBlockSpawnTask($block, $blockPosition), 1);
                                    } else {
                                        # spawn bedrock schedule regen
                                        EmporiumPrison::getInstance()->getScheduler()->scheduleDelayedTask(new BedrockSpawnTask($block, $blockPosition), 1);
                                        EmporiumPrison::getInstance()->getScheduler()->scheduleDelayedTask(new OreRegenTask($block, $blockPosition, $blockId), 20 * 60);
                                    }
                                    # add energy to player
                                    $energy = mt_rand(20, 30);
                                    if ($energyBoosterTime > 0) {
                                        $multipliedEnergy = $energy * $energyMultiplier;
                                        $oldData = $item->getNamedTag()->getInt("Energy");
                                        $newData = $oldData + $multipliedEnergy;
                                        $item->getNamedTag()->setInt("Energy", $newData);
                                    } else {
                                        $oldData = $item->getNamedTag()->getInt("Energy");
                                        $newData = $oldData + $energy;
                                        $item->getNamedTag()->setInt("Energy", $newData);
                                    }
                                    # add xp to player
                                    $xp = 6;
                                    if ($miningBoosterTime > 0) {
                                        $multipliedXp = $xp * $miningMultiplier;
                                        $player->sendTip("+$multipliedXp xp");
                                        DataManager::addData($player, "Players", "xp", $multipliedXp);
                                        DataManager::addData($player, "Players", "total-xp", $multipliedXp);
                                    } else {
                                        $player->sendTip("+$xp xp");
                                        DataManager::addData($player, "Players", "xp", $xp);
                                        DataManager::addData($player, "Players", "total-xp", $xp);
                                    }
                                    # add pickaxe Data
                                    DataManager::addData($player, "Players", "iron-ore-mined", 1);
                                    $oldData = $item->getNamedTag()->getInt("BlocksMined");
                                    $newData = $oldData + 1;
                                    $item->getNamedTag()->setInt("BlocksMined", $newData);
                                    # auto pickup (blocks)
                                    if ($player->getInventory()->canAddItem(StringToItemParser::getInstance()->parse("iron_ore"))) {
                                        if ($event->isCancelled()) {
                                            $event->setDrops([]);
                                            return;
                                        } else {
                                            $event->setDrops([]);
                                            $event->getPlayer()->getInventory()->addItem(StringToItemParser::getInstance()->parse("iron_ore"));
                                        }
                                    } else {
                                        $event->setDrops([]);
                                        $player->sendTitle(TF::DARK_RED . "Inventory Full!");
                                    }
                                    # auto pickup (xp)
                                    $player->getXpManager()->addXp($event->getXpDropAmount());
                                    $event->setXpDropAmount(0);
                                    # check for pickaxe and player level up
                                    $this->pickaxeManager->updatePickaxeSetInHand($player, $item);
                                    $this->playerLevelManager->checkPlayerLevelUp($player);
                                }
                                break;

                            case BlockLegacyIds::IRON_BLOCK:
                                if ($playerLevel < 10) {
                                    $event->cancel();
                                    $player->sendMessage(Variables::SERVER_PREFIX . TF::RED . "Your player" . TF::GOLD . " /level" . TF::RED . " is too low!");
                                } else {
                                    $chance = mt_rand(1, 30);
                                    if ($chance === 1) {
                                        # spawn iron block
                                        EmporiumPrison::getInstance()->getScheduler()->scheduleDelayedTask(new IronBlockSpawnTask($block, $blockPosition), 1);
                                    } else {
                                        # spawn bedrock schedule regen
                                        EmporiumPrison::getInstance()->getScheduler()->scheduleDelayedTask(new BedrockSpawnTask($block, $blockPosition), 1);
                                        EmporiumPrison::getInstance()->getScheduler()->scheduleDelayedTask(new OreRegenTask($block, $blockPosition, $blockId), 20 * 6);
                                    }
                                    # add energy to player
                                    $energy = mt_rand(40, 60);
                                    if ($energyBoosterTime > 0) {
                                        $multipliedEnergy = $energy * $energyMultiplier;
                                        $oldData = $item->getNamedTag()->getInt("Energy");
                                        $newData = $oldData + $multipliedEnergy;
                                        $item->getNamedTag()->setInt("Energy", $newData);
                                    } else {
                                        $oldData = $item->getNamedTag()->getInt("Energy");
                                        $newData = $oldData + $energy;
                                        $item->getNamedTag()->setInt("Energy", $newData);
                                    }
                                    # add xp to player
                                    $xp = 12;
                                    if ($miningBoosterTime > 0) {
                                        $multipliedXp = $xp * $miningMultiplier;
                                        $player->sendTip("+$multipliedXp xp");
                                        DataManager::addData($player, "Players", "xp", $multipliedXp);
                                        DataManager::addData($player, "Players", "total-xp", $multipliedXp);
                                    } else {
                                        $player->sendTip("+$xp xp");
                                        DataManager::addData($player, "Players", "xp", $xp);
                                        DataManager::addData($player, "Players", "total-xp", $xp);
                                    }
                                    # add pickaxe Data
                                    DataManager::addData($player, "Players", "iron-ore-mined", 1);
                                    $oldData = $item->getNamedTag()->getInt("BlocksMined");
                                    $newData = $oldData + 1;
                                    $item->getNamedTag()->setInt("BlocksMined", $newData);
                                    # auto pickup (blocks)
                                    if ($player->getInventory()->canAddItem(StringToItemParser::getInstance()->parse("iron_block"))) {
                                        if ($event->isCancelled()) {
                                            $event->setDrops([]);
                                            return;
                                        } else {
                                            $event->setDrops([]);
                                            $event->getPlayer()->getInventory()->addItem(StringToItemParser::getInstance()->parse("iron_block"));
                                        }
                                    } else {
                                        $event->setDrops([]);
                                        $player->sendTitle(TF::DARK_RED . "Inventory Full!");
                                    }
                                    # auto pickup (xp)
                                    $player->getXpManager()->addXp($event->getXpDropAmount());
                                    $event->setXpDropAmount(0);
                                    # check for pickaxe and player level up
                                    $this->pickaxeManager->updatePickaxeSetInHand($player, $item);
                                    $this->playerLevelManager->checkPlayerLevelUp($player);
                                }
                                break;

                        }
                    }
                } else {
                    $event->cancel();
                    $player->sendMessage(Variables::SERVER_PREFIX . "Try using a " . TF::BOLD . TF::DARK_PURPLE . "Wooden Pickaxe");

                }
            }
        }
    }
}