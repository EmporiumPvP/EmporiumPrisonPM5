<?php

namespace Emporium\Prison\listeners\blocks;

use Emporium\Prison\EmporiumPrison;
use Emporium\Prison\tasks\Meteors\MeteorTask;

use EmporiumData\DataManager;
use EmporiumData\ServerManager;

use JsonException;

use pocketmine\block\BlockTypeIds;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\Listener;
use pocketmine\item\Pickaxe;
use pocketmine\item\StringToItemParser;
use pocketmine\utils\TextFormat as TF;
use pocketmine\world\sound\FizzSound;

class MeteorListener implements Listener
{

    /**
     * @throws JsonException
     */
    public function onMine(BlockBreakEvent $event)
    {

        $player = $event->getPlayer();
        $world = $event->getPlayer()->getWorld();

        # block Data
        $block = $event->getBlock();
        $blockId = $event->getBlock()->getTypeId();
        $blockPosition = $block->getPosition();
        $blockX = round($blockPosition->getX());
        $blockY = round($blockPosition->getY());
        $blockZ = round($blockPosition->getZ());
        $blockName = $blockX . "_" . $blockY . "_" . $blockZ;

        $item = $event->getPlayer()->getInventory()->getItemInHand();
        $itemUsed = $event->getPlayer()->getInventory()->getItemInHand();

        # boosters
        $energyBoosterTime = EmporiumPrison::getInstance()->getEnergyManager()->getTime($player);
        $energyMultiplier = EmporiumPrison::getInstance()->getEnergyManager()->getMultiplier($player);
        $miningBoosterTime = EmporiumPrison::getInstance()->getMiningManager()->getTime($player);
        $miningMultiplier = EmporiumPrison::getInstance()->getMiningManager()->getMultiplier($player);

        # meteor Data
        $meteorName = $blockName;

        # block check
        if (!$blockId == BlockTypeIds::NETHER_QUARTZ_ORE) return;

        # check if block is a meteor
        if (!ServerManager::getInstance()->getData("meteors.$meteorName")) return;

        $meteorX = $blockX;
        $meteorY = $blockY;
        $meteorZ = $blockZ;
        $breaksLeft = ServerManager::getInstance()->getData("meteors.$meteorName.breaks-left");
        $rarity = ServerManager::getInstance()->getData("meteors.$meteorName.rarity");

        # pickaxe check
        if (!$itemUsed instanceof Pickaxe) return;

        # calculate energy
        $energy = mt_rand(50, 120);
        # with booster
        if($energyBoosterTime > 1) {
            $energy = $energy * $energyMultiplier;
        }
        # no booster
        $item->getNamedTag()->setInt("Energy", $item->getNamedTag()->getInt("Energy") + $energy);

        # calculate xp
        $xp = mt_rand(10, 30);
        if ($miningBoosterTime > 1) {
            $player->sendTip("+" . $xp * $miningMultiplier . "xp");
            $xp = $xp * $miningMultiplier;
        }
        $player->sendTip("+$xp xp");

        # add xp
        DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.xp", DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.xp") + $xp);
        DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.total-xp", DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.total-xp") + $xp);

        # add pickaxe Data
        $item->getNamedTag()->setInt("BlocksMined", $item->getNamedTag()->getInt("BlocksMined") + 1);

        # update pickaxe check player level
        EmporiumPrison::getInstance()->getPickaxeManager()->updatePickaxeSetInHand($player, $item);
        EmporiumPrison::getInstance()->getPlayerLevelManager()->checkPlayerLevelUp($player);

        # player just used the last break
        if ($breaksLeft == 1) ServerManager::getInstance()->removeData("meteors.$meteorName");

        # check block breaks left
        if ($breaksLeft > 1) {
            # meteor has more breaks left respawn
            EmporiumPrison::getInstance()->getScheduler()->scheduleTask(new MeteorTask($world, $meteorX, $meteorY, $meteorZ));
            # set new meteor Data
            ServerManager::getInstance()->setData("meteors.$meteorName.breaks-left", ServerManager::getInstance()->getData("meteors.$meteorName.breaks-left") - 1);
        }

        # meteor is complete
        $player->broadcastSound(new FizzSound(5));

        # random drop rewards
        $rewards = mt_rand(1, 100);
        switch ($rarity) {

            case "elite":
                switch (($rewards)) {

                    case $rewards >= 1 && $rewards <= 99: # coal ore
                        $player->getInventory()->addItem(StringToItemParser::getInstance()->parse("coal_ore")->setCount(mt_rand(10, 32)));
                        break;

                    case 100: # elite contraband
                        $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You found an " . TF::BLUE . "Elite Contraband!");
                        if ($player->getInventory()->canAddItem(EmporiumPrison::getInstance()->getContraband()->Elite(1))) {
                            $player->getInventory()->addItem(EmporiumPrison::getInstance()->getContraband()->Elite(1));
                        } else {
                            $player->getWorld()->dropItem($player->getLocation(), EmporiumPrison::getInstance()->getContraband()->Elite(1));
                        }
                        $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You found an " . TF::BLUE . "Elite Contraband!");
                        break;

                }
                break;

            case "ultimate":
                switch ($rewards) {

                    case $rewards >= 1 && $rewards <= 99: # iron ore
                        $player->getInventory()->addItem(StringToItemParser::getInstance()->parse("iron_ore")->setCount(mt_rand(10, 32)));
                        break;

                    case 100: # ultimate contraband
                        if ($player->getInventory()->canAddItem(EmporiumPrison::getInstance()->getContraband()->Ultimate(1))) {
                            $player->getInventory()->addItem(EmporiumPrison::getInstance()->getContraband()->Ultimate(1));
                        } else {
                            $player->getWorld()->dropItem($player->getLocation(), EmporiumPrison::getInstance()->getContraband()->Elite(1));
                        }
                        $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You found an " . TF::YELLOW . "Ultimate Contraband!");
                        break;
                }
                break;

            case "legendary":

                switch ($rewards) {

                    case $rewards >= 1 && $rewards <= 99: # lapis ore
                        $player->getInventory()->addItem(StringToItemParser::getInstance()->parse("lapis_ore")->setCount(mt_rand(10, 32)));
                        break;

                    case 100:
                        if ($player->getInventory()->canAddItem(EmporiumPrison::getInstance()->getContraband()->Legendary(1))) {
                            $player->getInventory()->addItem(EmporiumPrison::getInstance()->getContraband()->Legendary(1));
                        } else {
                            $player->getWorld()->dropItem($player->getLocation(), EmporiumPrison::getInstance()->getContraband()->Legendary(1));
                        }
                        $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You found a " . TF::GOLD . "Legendary Contraband!");
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
                        if ($player->getInventory()->canAddItem(EmporiumPrison::getInstance()->getContraband()->Godly(1))) {
                            $player->getInventory()->addItem(EmporiumPrison::getInstance()->getContraband()->Godly(1));
                        } else {
                            $player->getWorld()->dropItem($player->getLocation(), EmporiumPrison::getInstance()->getContraband()->Godly(1));
                        }
                        $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You found a " . TF::LIGHT_PURPLE . "Godly Contraband!");
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
                        if ($player->getInventory()->canAddItem(EmporiumPrison::getInstance()->getContraband()->Heroic(1))) {
                            $player->getInventory()->addItem(EmporiumPrison::getInstance()->getContraband()->Heroic(1));
                        } else {
                            $player->getWorld()->dropItem($player->getLocation(), EmporiumPrison::getInstance()->getContraband()->Heroic(1));
                        }
                        $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You found a " . TF::RED . "Heroic Contraband!");
                        break;

                }
                break;

        }

        # set drops
        $event->setXpDropAmount(0);
        $event->setDrops([]);

    }
}