<?php

namespace Emporium\Prison\listeners\Items\Flares;

use Emporium\Prison\EmporiumPrison;

use Emporium\Prison\Managers\PrisonManager;

use Emporium\Prison\tasks\Flares\MeteorTimerTask;
use Emporium\Prison\tasks\Meteors\MeteorTask;

use JsonException;
use pocketmine\block\VanillaBlocks;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerItemUseEvent;

use pocketmine\utils\Config;
use pocketmine\utils\TextFormat as TF;

use pocketmine\world\Position;
use pocketmine\world\sound\ExplodeSound;
use WolfDen133\WFT\Texts\FloatingText;
use WolfDen133\WFT\WFT;

class FlareListener implements Listener {

    /**
     * @throws JsonException
     */
    public function onItemUse(PlayerItemUseEvent $event) {

        $player = $event->getPlayer();
        $hand = $player->getInventory()->getItemInHand();
        $count = $hand->getCount();
        $world = $player->getWorld()->getFolderName();
        $x = round($player->getLocation()->getX());
        $y = round($player->getLocation()->getY());
        $z = round($player->getLocation()->getZ());

        if($hand->getNamedTag()->getTag("EliteMeteorFlare")) {

            if($world != "world") {
                return;
            }

            # check if meteor already exists
            $name = $x . "_" . $y . "_" . $z;
            if(file_exists(EmporiumPrison::getInstance()->getDataFolder() . "Meteors/" . $name . ".yml")) {
                return;
            } else {
                # create meteor file set Data
                new Config(EmporiumPrison::getInstance()->getDataFolder() . "/Meteors/" . $name . ".yml", Config::YAML);
                PrisonManager::setNewData("Meteors", $name, "timer", 30);
                PrisonManager::setNewData("Meteors", $name, "breaks-left", 50);
                PrisonManager::setNewData("Meteors", $name, "rarity", "elite");
                # broadcast message to server
                EmporiumPrison::getInstance()->getServer()->broadcastMessage(TF::BOLD . TF::RED . "An Elite Meteor Flare has been activated by\n" . $player->getName() . " near: \n" . TF::RESET . TF::WHITE . $x . TF::GRAY . "x, " . TF::WHITE . $y . TF::GRAY . "y, " . TF::WHITE . $z . TF::GRAY . "z\nMeteors are corrupt ores from lost galaxies\nfilled with mass amounts of legendary loot!" . TF::WHITE . " /help meteors");
                # set flare on ground
                $world = EmporiumPrison::getInstance()->getServer()->getWorldManager()->getWorldByName("world");
                $world->setBlockAt($x, $y, $z, VanillaBlocks::REDSTONE_TORCH());
                # create text
                $timer = PrisonManager::getData("Meteors", $name, "timer");
                $text = TF::BLUE . "Elite Meteor Flare\n\nArriving in: " . $timer . "s";
                WFT::getInstance()->getTextManager()->registerText($name, $text, new Position($x + 0.5, $y + 2, $z + 0.5, $world), true, false);
                # schedule tasks
                EmporiumPrison::getInstance()->getScheduler()->scheduleRepeatingTask(new MeteorTimerTask($player, $name, $x, $y, $z), 20);
                EmporiumPrison::getInstance()->getScheduler()->scheduleDelayedTask(new MeteorTask($x, $y, $z), 20 * 30);
                # remove flare from stack
                $hand->setCount($count - 1);
                $player->getInventory()->setItemInHand($hand);
                $player->broadcastSound(new ExplodeSound(), [$player]);
            }
        }

    }

}