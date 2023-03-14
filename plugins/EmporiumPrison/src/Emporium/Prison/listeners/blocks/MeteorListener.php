<?php

namespace Emporium\Prison\listeners\blocks;

use Emporium\Prison\EmporiumPrison;

use Emporium\Prison\Managers\DataManager;
use Emporium\Prison\Managers\EnergyManager;
use Emporium\Prison\Managers\MiningManager;
use Emporium\Prison\Managers\PickaxeManager;
use Emporium\Prison\Managers\PlayerLevelManager;

use Emporium\Prison\Managers\PrisonManager;
use Emporium\Prison\tasks\Meteors\MeteorTask;

use Emporium\Prison\Variables;
use Items\Contraband;
use JsonException;
use pocketmine\block\BlockLegacyIds;

use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\Listener;

use pocketmine\item\StringToItemParser;
use pocketmine\utils\TextFormat as TF;
use pocketmine\world\sound\FizzSound;

class MeteorListener implements Listener {

    private EnergyManager $energyManager;
    private MiningManager $miningManager;
    private PickaxeManager $pickaxeManager;
    private PlayerLevelManager $playerLevelManager;

    public function __construct() {
        $this->energyManager = EmporiumPrison::getEnergyManager();
        $this->miningManager = EmporiumPrison::getMiningManager();
        $this->pickaxeManager = EmporiumPrison::getPickaxeManager();
        $this->playerLevelManager = EmporiumPrison::getPlayerLevelManager();
    }

    /**
     * @throws JsonException
     */
    public function onMine(BlockBreakEvent $event) {

        $player = $event->getPlayer();

        # block Data
        $block = $event->getBlock();
        $blockId = $event->getBlock()->getIdInfo()->getBlockId();
        $blockPosition = $block->getPosition();
        $blockX = round($blockPosition->getX());
        $blockY = round($blockPosition->getY());
        $blockZ = round($blockPosition->getZ());
        $blockName = $blockX . "_" . $blockY . "_" . $blockZ;

        $item = $event->getPlayer()->getInventory()->getItemInHand();
        $itemUsed = $event->getPlayer()->getInventory()->getItemInHand()->getId();

        # boosters
        $energyBoosterTime = $this->energyManager->getTime($player);
        $energyMultiplier = $this->energyManager->getMultiplier($player);
        $miningBoosterTime = $this->miningManager->getTime($player);
        $miningMultiplier = $this->miningManager->getMultiplier($player);

        # meteor Data
        $meteorName = $blockName;

        # check if block is a meteor
        if (file_exists(EmporiumPrison::getInstance()->getDataFolder() . "Meteors/" . $meteorName . ".yml")) {
            $meteorX = $blockX;
            $meteorY = $blockY;
            $meteorZ = $blockZ;
            $breaksLeft = PrisonManager::getData("Meteors", $meteorName, "breaks-left");
            $rarity = PrisonManager::getData("Meteors", $meteorName, "rarity");
        } else {
            return;
        }

        if ($blockId === BlockLegacyIds::NETHER_QUARTZ_ORE) {

            # pickaxe check
            if (!$itemUsed == 270 || !$itemUsed == 274 || !$itemUsed == 285 || !$itemUsed == 257 || !$itemUsed == 278) {
                return;
            } else {
                # add energy to pickaxe
                $energy = mt_rand(50, 120);
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
                $xp = mt_rand(10, 30);
                # add xp to player
                if ($miningBoosterTime > 0) {
                    $multipliedXp = $xp * $miningMultiplier;
                    $player->sendTip("+$multipliedXp xp");
                    DataManager::addData($player, "Players", "xp", $multipliedXp);
                    DataManager::setPlayerData();
                } else {
                    $player->sendTip("+$xp xp");
                    DataManager::addData($player, "Players", "xp", $xp);
                }
                # add pickaxe Data
                DataManager::addData($player, "Players", "trainee-ore-mined", 1);
                $oldData = $item->getNamedTag()->getInt("BlocksMined");
                $newData = $oldData + 1;
                $item->getNamedTag()->setInt("BlocksMined", $newData);
                # update pickaxe check player level
                $this->pickaxeManager->updatePickaxeSetInHand($player, $item);
                $this->playerLevelManager->checkPlayerLevelUp($player);
            }
        }
        # check block breaks left
        if ($breaksLeft > 1) {
            # meteor has more breaks left respawn
            EmporiumPrison::getInstance()->getScheduler()->scheduleTask(new MeteorTask($meteorX, $meteorY, $meteorZ));
            # set new meteor Data
            PrisonManager::takeData("Meteors", $meteorName, "breaks-left", 1);
        } else {
            # meteor is complete
            if(file_exists(EmporiumPrison::getInstance()->getDataFolder() . "Meteors/" . $meteorName . ".yml")) {
                unlink(EmporiumPrison::getInstance()->getDataFolder() . "Meteors/" . $meteorName . ".yml");
                $player->broadcastSound(new FizzSound(mt_rand(1, 10)), [$player]);
            }
        }

        # random drop rewards
        $rewards = mt_rand(1, 100);
        switch ($rarity) {

            case "elite":
                switch (($rewards)) {

                    case $rewards >= 1 && $rewards <= 99: # coal ore
                        $player->getInventory()->addItem(StringToItemParser::getInstance()->parse("coal_ore")->setCount(mt_rand(10, 32)));
                        break;

                    case 100: # elite contraband
                        $player->sendMessage(Variables::SERVER_PREFIX . "You found an " . TF::BLUE . "Elite Contraband!");
                        if($player->getInventory()->canAddItem($this->contraband->Elite(1))) {
                            $player->getInventory()->addItem($this->contraband->Elite(1));
                        } else {
                            $player->getWorld()->dropItem($player->getLocation(), $this->contraband->Elite(1));
                        }
                        $player->sendMessage(Variables::SERVER_PREFIX . "You found an " . TF::BLUE . "Elite Contraband!");
                        break;

                }
                break;

            case "ultimate":
                switch ($rewards) {

                    case $rewards >= 1 && $rewards <= 99: # iron ore
                        $player->getInventory()->addItem(StringToItemParser::getInstance()->parse("iron_ore")->setCount(mt_rand(10, 32)));
                        break;

                    case 100: # ultimate contraband
                        if($player->getInventory()->canAddItem($this->contraband->Ultimate(1))) {
                            $player->getInventory()->addItem($this->contraband->Ultimate(1));
                        } else {
                            $player->getWorld()->dropItem($player->getLocation(), $this->contraband->Elite(1));
                        }
                        $player->sendMessage(Variables::SERVER_PREFIX . "You found an " . TF::YELLOW . "Ultimate Contraband!");
                        break;
                }
                break;

            case "legendary":

                switch ($rewards) {

                    case $rewards >= 1 && $rewards <= 99: # lapis ore
                        $player->getInventory()->addItem(StringToItemParser::getInstance()->parse("lapis_ore")->setCount(mt_rand(10, 32)));
                        break;

                    case 100:
                        if($player->getInventory()->canAddItem($this->contraband->Legendary(1))) {
                            $player->getInventory()->addItem($this->contraband->Legendary(1));
                        } else {
                            $player->getWorld()->dropItem($player->getLocation(), $this->contraband->Legendary(1));
                        }
                        $player->sendMessage(Variables::SERVER_PREFIX . "You found a " . TF::GOLD . "Legendary Contraband!");
                        break;
                }
                break;

            case "godly":
                switch ($rewards) {

                    case $rewards > 1 && $rewards <= 50:
                        $player->getInventory()->addItem(StringToItemParser::getInstance()->parse("redstone_ore")->setCount(mt_rand(10, 32)));
                        break;
                    case $rewards >= 51 && $rewards <= 99:
                        $player->getInventory()->addItem(StringToItemParser::getInstance()->parse("gold_ore")->setCount(mt_rand(10, 32)));
                        break;

                    case 100:
                        if($player->getInventory()->canAddItem($this->contraband->Godly(1))) {
                            $player->getInventory()->addItem($this->contraband->Godly(1));
                        } else {
                            $player->getWorld()->dropItem($player->getLocation(), $this->contraband->Godly(1));
                        }
                        $player->sendMessage(Variables::SERVER_PREFIX . "You found a " . TF::LIGHT_PURPLE . "Godly Contraband!");
                        break;
                }
                break;

            case "heroic":
                switch ($rewards) {

                    case $rewards > 1 && $rewards <= 50:
                        $player->getInventory()->addItem(StringToItemParser::getInstance()->parse("diamond_ore")->setCount(mt_rand(10, 32)));
                        break;
                    case $rewards >= 51 && $rewards <= 99:
                        $player->getInventory()->addItem(StringToItemParser::getInstance()->parse("emerald_ore")->setCount(mt_rand(10, 32)));
                        break;

                    case 100:
                        if($player->getInventory()->canAddItem($this->contraband->Heroic(1))) {
                            $player->getInventory()->addItem($this->contraband->Heroic(1));
                        } else {
                            $player->getWorld()->dropItem($player->getLocation(), $this->contraband->Heroic(1));
                        }
                        $player->sendMessage(Variables::SERVER_PREFIX . "You found a " . TF::RED . "Heroic Contraband!");
                        break;

                }
                break;

        }
        # set drops
        $event->setXpDropAmount(0);
        $event->setDrops([]);
    }
}