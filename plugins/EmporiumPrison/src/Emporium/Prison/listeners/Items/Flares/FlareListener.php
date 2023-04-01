<?php

namespace Emporium\Prison\listeners\Items\Flares;

use Emporium\Prison\EmporiumPrison;
use Emporium\Prison\tasks\Flares\MeteorFlareEntityTask;
use Emporium\Prison\tasks\Meteors\MeteorTask;

use EmporiumData\ServerManager;

use Exception;
use pocketmine\block\VanillaBlocks;
use pocketmine\entity\Location;
use pocketmine\entity\object\ItemEntity;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\utils\TextFormat;
use pocketmine\utils\TextFormat as TF;
use pocketmine\world\sound\ExplodeSound;

class FlareListener implements Listener {

    /**
     * @throws Exception
     */
    public function onBlockPlace(PlayerInteractEvent $event) {
        # data
        $player = $event->getPlayer();

        $hand = $player->getInventory()->getItemInHand();

        /*
        if($hand->getNamedTag()->getTag("EliteMeteorFlare") ||
            $hand->getNamedTag()->getTag("UltimateMeteorFlare") ||
            $hand->getNamedTag()->getTag("LegendaryMeteorFlare") ||
            $hand->getNamedTag()->getTag("GodlyMeteorFlare") ||
            $hand->getNamedTag()->getTag("HeroicMeteorFlare")) {
            $event->cancel();
            $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "Flares are temporarily disabled");
        }*/


        $hand = $player->getInventory()->getItemInHand();
        $count = $hand->getCount();
        $block = $event->getBlock();
        $world = $player->getWorld();
        # position
        $x = round($block->getPosition()->getX());
        $y = round($block->getPosition()->getY());
        $z = round($block->getPosition()->getZ());
        # meteor flares
        if($hand->getNamedTag()->getTag("EliteMeteorFlare")) {
            #world check
            if(!$world->getFolderName() == "world" || !$world->getFolderName() == "TutorialMine") {
                $player->sendMessage(TF::RED . "You can't do that here");
                return;
            }
            # position check
            # check if meteor already exists
            $name = $x . "_" . $y . "_" . $z;
            if(ServerManager::getInstance()->getData($name)) return;
            # set type
            $type = "Elite Meteor ";
            $colour = TextFormat::BLUE;
            # create meteor file set Data
            var_dump("meteors.$name.timer");
            var_dump("meteors.$name.breaks-left");
            var_dump("meteors.$name.rarity");
            ServerManager::getInstance()->setData("meteors.$name.timer", 30);
            ServerManager::getInstance()->setData("meteors.$name.breaks-left", 50);
            ServerManager::getInstance()->setData("meteors.$name.rarity", "elite");
            # broadcast message to server
            EmporiumPrison::getInstance()->getServer()->broadcastMessage(TF::BOLD . $colour . "An Elite Meteor Flare has been activated by\n" . $player->getName() . " near: \n" . TF::RESET . TF::WHITE . $x . TF::GRAY . "x, " . TF::WHITE . $y . TF::GRAY . "y, " . TF::WHITE . $z . TF::GRAY . "z\nMeteors are corrupt ores from lost galaxies\nfilled with mass amounts of legendary loot!" . TF::WHITE . " /help meteors");
            # create item entity
            (int) $timer = ServerManager::getInstance()->getData("meteors.$name.timer");
            $itemEntity = new ItemEntity(new Location($x + 0.5, $y + 2, $z + 0.5, $world, 0, 0), VanillaBlocks::REDSTONE_TORCH()->asItem());
            $itemEntity->setNameTag($colour . "$type Flare\n\nArriving in: " . $timer . "s");
            $itemEntity->setNameTagAlwaysVisible();
            $itemEntity->setPickupDelay(-1);
            $itemEntity->setHasGravity(false);
            $itemEntity->spawnToAll();
            # schedule tasks
            EmporiumPrison::getInstance()->getScheduler()->scheduleRepeatingTask(new MeteorFlareEntityTask($world, $x, $y, $z, $itemEntity, $name, $type, $colour), 20);
            EmporiumPrison::getInstance()->getScheduler()->scheduleDelayedTask(new MeteorTask($world, $x, $y, $z), 20 * 29);
            # remove flare from stack
            $hand->setCount($count - 1);
            $player->getInventory()->setItemInHand($hand);
            $player->broadcastSound(new ExplodeSound(), [$player]);

        }
        # heroic gkit flares
        if($hand->getNamedTag()->getTag("VulkarionGKitFlare")) {
            # world check
            if(!$world->getFolderName() == "world" || !$world->getFolderName() == "TutorialMine") {
                $player->sendMessage(TF::RED . "You can't do that here");
                return;
            }
            # position check

            # check if meteor already exists
            $name = $x . "_" . $y . "_" . $z;
            if(ServerManager::getInstance()->getData("meteors.$name")) return;
            # set type
            $type = "Heroic Vulkarion GKit";
            $colour = TextFormat::DARK_RED;
            # create meteor data
            ServerManager::getInstance()->setData("meteors.$name.timer", 30);
            ServerManager::getInstance()->setData("meteors.$name.breaks-left", 50);
            ServerManager::getInstance()->setData("meteors.$name.rarity", "elite");
            # broadcast message
            EmporiumPrison::getInstance()->getServer()->broadcastMessage(TF::BOLD . $colour . "A $type Flare has been activated by\n" . $player->getName() . " near: \n" . TF::RESET . TF::WHITE . $x . TF::GRAY . "x, " . TF::WHITE . $y . TF::GRAY . "y, " . TF::WHITE . $z . TF::GRAY . "z\nMeteors are corrupt ores from lost galaxies\nfilled with mass amounts of legendary loot!" . TF::WHITE . " /help meteors");
            # create item entity
            (int)$timer = ServerManager::getInstance()->getData("meteors.$name.timer");
            $itemEntity = new ItemEntity(new Location($x + 0.5, $y + 2, $z + 0.5, $world, 0, 0), VanillaBlocks::REDSTONE_TORCH()->asItem());
            $itemEntity->setNameTag($colour . "$type Flare\n\nArriving in: " . $timer . "s");
            $itemEntity->setNameTagAlwaysVisible();
            $itemEntity->setPickupDelay(-1);
            $itemEntity->setHasGravity(false);
            $itemEntity->spawnToAll();
            # schedule tasks
            EmporiumPrison::getInstance()->getScheduler()->scheduleRepeatingTask(new MeteorFlareEntityTask($world, $x, $y, $z, $itemEntity, $name, $type, $colour), 20);

            # remove flare from stack
            $hand->setCount($count - 1);
            $player->getInventory()->setItemInHand($hand);
            $player->broadcastSound(new ExplodeSound(), [$player]);
        }
        if($hand->getNamedTag()->getTag("ZenithGKitFlare")) {
            # world check
            if(!$world->getFolderName() == "world" || !$world->getFolderName() == "TutorialMine") {
                $player->sendMessage(TF::RED . "You can't do that here");
                return;
            }
            # position check

            # check if meteor already exists
            $name = $x . "_" . $y . "_" . $z;
            if(ServerManager::getInstance()->getData("meteors.$name")) return;
            # set type
            $type = "Heroic Zenith GKit";
            $colour = TextFormat::GOLD;
            # create meteor data
            ServerManager::getInstance()->setData("meteors.$name.timer", 30);
            ServerManager::getInstance()->setData("meteors.$name.breaks-left", 50);
            ServerManager::getInstance()->setData("meteors.$name.rarity", "elite");
            # broadcast message
            EmporiumPrison::getInstance()->getServer()->broadcastMessage(TF::BOLD . $colour . "A $type Flare has been activated by\n" . $player->getName() . " near: \n" . TF::RESET . TF::WHITE . $x . TF::GRAY . "x, " . TF::WHITE . $y . TF::GRAY . "y, " . TF::WHITE . $z . TF::GRAY . "z\nMeteors are corrupt ores from lost galaxies\nfilled with mass amounts of legendary loot!" . TF::WHITE . " /help meteors");
            # create item entity
            (int)$timer = ServerManager::getInstance()->getData("meteors.$name.timer");
            $itemEntity = new ItemEntity(new Location($x + 0.5, $y + 2, $z + 0.5, $world, 0, 0), VanillaBlocks::REDSTONE_TORCH()->asItem());
            $itemEntity->setNameTag($colour . "$type Flare\n\nArriving in: " . $timer . "s");
            $itemEntity->setNameTagAlwaysVisible();
            $itemEntity->setPickupDelay(-1);
            $itemEntity->setHasGravity(false);
            $itemEntity->spawnToAll();
            # schedule tasks
            EmporiumPrison::getInstance()->getScheduler()->scheduleRepeatingTask(new MeteorFlareEntityTask($world, $x, $y, $z, $itemEntity, $name, $type, $colour), 20);

            # remove flare from stack
            $hand->setCount($count - 1);
            $player->getInventory()->setItemInHand($hand);
            $player->broadcastSound(new ExplodeSound(), [$player]);
        }
        if($hand->getNamedTag()->getTag("ColossusGKitFlare")) {
            # world check
            if(!$world->getFolderName() == "world" || !$world->getFolderName() == "TutorialMine") {
                $player->sendMessage(TF::RED . "You can't do that here");
                return;
            }
            # position check

            # check if meteor already exists
            $name = $x . "_" . $y . "_" . $z;
            if(ServerManager::getInstance()->getData("meteors.$name")) return;
            # set type
            $type = "Heroic Colossus GKit";
            $colour = TextFormat::WHITE;
            # create meteor data
            ServerManager::getInstance()->setData("meteors.$name.timer", 30);
            ServerManager::getInstance()->setData("meteors.$name.breaks-left", 50);
            ServerManager::getInstance()->setData("meteors.$name.rarity", "elite");
            # broadcast message
            EmporiumPrison::getInstance()->getServer()->broadcastMessage(TF::BOLD . $colour . "A $type Flare has been activated by\n" . $player->getName() . " near: \n" . TF::RESET . TF::WHITE . $x . TF::GRAY . "x, " . TF::WHITE . $y . TF::GRAY . "y, " . TF::WHITE . $z . TF::GRAY . "z\nMeteors are corrupt ores from lost galaxies\nfilled with mass amounts of legendary loot!" . TF::WHITE . " /help meteors");
            # create item entity
            (int)$timer = ServerManager::getInstance()->getData("meteors.$name.timer");
            $itemEntity = new ItemEntity(new Location($x + 0.5, $y + 2, $z + 0.5, $world, 0, 0), VanillaBlocks::REDSTONE_TORCH()->asItem());
            $itemEntity->setNameTag($colour . "$type Flare\n\nArriving in: " . $timer . "s");
            $itemEntity->setNameTagAlwaysVisible();
            $itemEntity->setPickupDelay(-1);
            $itemEntity->setHasGravity(false);
            $itemEntity->spawnToAll();
            # schedule tasks
            EmporiumPrison::getInstance()->getScheduler()->scheduleRepeatingTask(new MeteorFlareEntityTask($world, $x, $y, $z, $itemEntity, $name, $type, $colour), 20);

            # remove flare from stack
            $hand->setCount($count - 1);
            $player->getInventory()->setItemInHand($hand);
            $player->broadcastSound(new ExplodeSound(), [$player]);
        }
        if($hand->getNamedTag()->getTag("WarlockGKitFlare")) {
            # world check
            if(!$world->getFolderName() == "world" || !$world->getFolderName() == "TutorialMine") {
                $player->sendMessage(TF::RED . "You can't do that here");
                return;
            }
            # position check

            # check if meteor already exists
            $name = $x . "_" . $y . "_" . $z;
            if(ServerManager::getInstance()->getData("meteors.$name")) return;
            # set type
            $type = "Heroic Warlock GKit";
            $colour = TextFormat::DARK_PURPLE;
            # create meteor data
            ServerManager::getInstance()->setData("meteors.$name.timer", 30);
            ServerManager::getInstance()->setData("meteors.$name.breaks-left", 50);
            ServerManager::getInstance()->setData("meteors.$name.rarity", "elite");
            # broadcast message
            EmporiumPrison::getInstance()->getServer()->broadcastMessage(TF::BOLD . $colour . "A $type Flare has been activated by\n" . $player->getName() . " near: \n" . TF::RESET . TF::WHITE . $x . TF::GRAY . "x, " . TF::WHITE . $y . TF::GRAY . "y, " . TF::WHITE . $z . TF::GRAY . "z\nMeteors are corrupt ores from lost galaxies\nfilled with mass amounts of legendary loot!" . TF::WHITE . " /help meteors");
            # create item entity
            (int)$timer = ServerManager::getInstance()->getData("meteors.$name.timer");
            $itemEntity = new ItemEntity(new Location($x + 0.5, $y + 2, $z + 0.5, $world, 0, 0), VanillaBlocks::REDSTONE_TORCH()->asItem());
            $itemEntity->setNameTag($colour . "$type Flare\n\nArriving in: " . $timer . "s");
            $itemEntity->setNameTagAlwaysVisible();
            $itemEntity->setPickupDelay(-1);
            $itemEntity->setHasGravity(false);
            $itemEntity->spawnToAll();
            # schedule tasks
            EmporiumPrison::getInstance()->getScheduler()->scheduleRepeatingTask(new MeteorFlareEntityTask($world, $x, $y, $z, $itemEntity, $name, $type, $colour), 20);

            # remove flare from stack
            $hand->setCount($count - 1);
            $player->getInventory()->setItemInHand($hand);
            $player->broadcastSound(new ExplodeSound(), [$player]);
        }
        if($hand->getNamedTag()->getTag("SlaughterGKitFlare")) {
            # world check
            if(!$world->getFolderName() == "world" || !$world->getFolderName() == "TutorialMine") {
                $player->sendMessage(TF::RED . "You can't do that here");
                return;
            }
            # position check

            # check if meteor already exists
            $name = $x . "_" . $y . "_" . $z;
            if(ServerManager::getInstance()->getData("meteors.$name")) return;
            # set type
            $type = "Heroic Slaughter GKit";
            $colour = TextFormat::RED;
            # create meteor data
            ServerManager::getInstance()->setData("meteors.$name.timer", 30);
            ServerManager::getInstance()->setData("meteors.$name.breaks-left", 50);
            ServerManager::getInstance()->setData("meteors.$name.rarity", "elite");
            # broadcast message
            EmporiumPrison::getInstance()->getServer()->broadcastMessage(TF::BOLD . $colour . "A $type Flare has been activated by\n" . $player->getName() . " near: \n" . TF::RESET . TF::WHITE . $x . TF::GRAY . "x, " . TF::WHITE . $y . TF::GRAY . "y, " . TF::WHITE . $z . TF::GRAY . "z\nMeteors are corrupt ores from lost galaxies\nfilled with mass amounts of legendary loot!" . TF::WHITE . " /help meteors");
            # create item entity
            (int)$timer = ServerManager::getInstance()->getData("meteors.$name.timer");
            $itemEntity = new ItemEntity(new Location($x + 0.5, $y + 2, $z + 0.5, $world, 0, 0), VanillaBlocks::REDSTONE_TORCH()->asItem());
            $itemEntity->setNameTag($colour . "$type Flare\n\nArriving in: " . $timer . "s");
            $itemEntity->setNameTagAlwaysVisible();
            $itemEntity->setPickupDelay(-1);
            $itemEntity->setHasGravity(false);
            $itemEntity->spawnToAll();
            # schedule tasks
            EmporiumPrison::getInstance()->getScheduler()->scheduleRepeatingTask(new MeteorFlareEntityTask($world, $x, $y, $z, $itemEntity, $name, $type, $colour), 20);

            # remove flare from stack
            $hand->setCount($count - 1);
            $player->getInventory()->setItemInHand($hand);
            $player->broadcastSound(new ExplodeSound(), [$player]);
        }
        if($hand->getNamedTag()->getTag("EnchanterGKitFlare")) {
            # world check
            if(!$world->getFolderName() == "world" || !$world->getFolderName() == "TutorialMine") {
                $player->sendMessage(TF::RED . "You can't do that here");
                return;
            }
            # position check

            # check if meteor already exists
            $name = $x . "_" . $y . "_" . $z;
            if(ServerManager::getInstance()->getData("meteors.$name")) return;
            # set type
            $type = "Heroic Enchanter GKit";
            $colour = TextFormat::AQUA;
            # create meteor data
            ServerManager::getInstance()->setData("meteors.$name.timer", 30);
            ServerManager::getInstance()->setData("meteors.$name.breaks-left", 50);
            ServerManager::getInstance()->setData("meteors.$name.rarity", "elite");
            # broadcast message
            EmporiumPrison::getInstance()->getServer()->broadcastMessage(TF::BOLD . $colour . "A $type Flare has been activated by\n" . $player->getName() . " near: \n" . TF::RESET . TF::WHITE . $x . TF::GRAY . "x, " . TF::WHITE . $y . TF::GRAY . "y, " . TF::WHITE . $z . TF::GRAY . "z\nMeteors are corrupt ores from lost galaxies\nfilled with mass amounts of legendary loot!" . TF::WHITE . " /help meteors");
            # create item entity
            (int)$timer = ServerManager::getInstance()->getData("meteors.$name.timer");
            $itemEntity = new ItemEntity(new Location($x + 0.5, $y + 2, $z + 0.5, $world, 0, 0), VanillaBlocks::REDSTONE_TORCH()->asItem());
            $itemEntity->setNameTag($colour . "$type Flare\n\nArriving in: " . $timer . "s");
            $itemEntity->setNameTagAlwaysVisible();
            $itemEntity->setPickupDelay(-1);
            $itemEntity->setHasGravity(false);
            $itemEntity->spawnToAll();
            # schedule tasks
            EmporiumPrison::getInstance()->getScheduler()->scheduleRepeatingTask(new MeteorFlareEntityTask($world, $x, $y, $z, $itemEntity, $name, $type, $colour), 20);

            # remove flare from stack
            $hand->setCount($count - 1);
            $player->getInventory()->setItemInHand($hand);
            $player->broadcastSound(new ExplodeSound(), [$player]);
        }
        if($hand->getNamedTag()->getTag("AtheosGKitFlare")) {
            # world check
            if(!$world->getFolderName() == "world" || !$world->getFolderName() == "TutorialMine") {
                $player->sendMessage(TF::RED . "You can't do that here");
                return;
            }
            # position check

            # check if meteor already exists
            $name = $x . "_" . $y . "_" . $z;
            if(ServerManager::getInstance()->getData("meteors.$name")) return;
            # set type
            $type = "Heroic Atheos GKit";
            $colour = TextFormat::GRAY;
            # create meteor data
            ServerManager::getInstance()->setData("meteors.$name.timer", 30);
            ServerManager::getInstance()->setData("meteors.$name.breaks-left", 50);
            ServerManager::getInstance()->setData("meteors.$name.rarity", "elite");
            # broadcast message
            EmporiumPrison::getInstance()->getServer()->broadcastMessage(TF::BOLD . $colour . "A $type Flare has been activated by\n" . $player->getName() . " near: \n" . TF::RESET . TF::WHITE . $x . TF::GRAY . "x, " . TF::WHITE . $y . TF::GRAY . "y, " . TF::WHITE . $z . TF::GRAY . "z\nMeteors are corrupt ores from lost galaxies\nfilled with mass amounts of legendary loot!" . TF::WHITE . " /help meteors");
            # create item entity
            (int)$timer = ServerManager::getInstance()->getData("meteors.$name.timer");
            $itemEntity = new ItemEntity(new Location($x + 0.5, $y + 2, $z + 0.5, $world, 0, 0), VanillaBlocks::REDSTONE_TORCH()->asItem());
            $itemEntity->setNameTag($colour . "$type Flare\n\nArriving in: " . $timer . "s");
            $itemEntity->setNameTagAlwaysVisible();
            $itemEntity->setPickupDelay(-1);
            $itemEntity->setHasGravity(false);
            $itemEntity->spawnToAll();
            # schedule tasks
            EmporiumPrison::getInstance()->getScheduler()->scheduleRepeatingTask(new MeteorFlareEntityTask($world, $x, $y, $z, $itemEntity, $name, $type, $colour), 20);

            # remove flare from stack
            $hand->setCount($count - 1);
            $player->getInventory()->setItemInHand($hand);
            $player->broadcastSound(new ExplodeSound(), [$player]);
        }
        if($hand->getNamedTag()->getTag("Iapetus")) {
            # world check
            if(!$world->getFolderName() == "world" || !$world->getFolderName() == "TutorialMine") {
                $player->sendMessage(TF::RED . "You can't do that here");
                return;
            }
            # position check

            # check if meteor already exists
            $name = $x . "_" . $y . "_" . $z;
            if(ServerManager::getInstance()->getData("meteors.$name")) return;
            # set type
            $type = "Heroic Iapetus GKit";
            $colour = TextFormat::BLUE;
            # create meteor data
            ServerManager::getInstance()->setData("meteors.$name.timer", 30);
            ServerManager::getInstance()->setData("meteors.$name.breaks-left", 50);
            ServerManager::getInstance()->setData("meteors.$name.rarity", "elite");
            # broadcast message
            EmporiumPrison::getInstance()->getServer()->broadcastMessage(TF::BOLD . $colour . "A $type Flare has been activated by\n" . $player->getName() . " near: \n" . TF::RESET . TF::WHITE . $x . TF::GRAY . "x, " . TF::WHITE . $y . TF::GRAY . "y, " . TF::WHITE . $z . TF::GRAY . "z\nMeteors are corrupt ores from lost galaxies\nfilled with mass amounts of legendary loot!" . TF::WHITE . " /help meteors");
            # create item entity
            (int)$timer = ServerManager::getInstance()->getData("meteors.$name.timer");
            $itemEntity = new ItemEntity(new Location($x + 0.5, $y + 2, $z + 0.5, $world, 0, 0), VanillaBlocks::REDSTONE_TORCH()->asItem());
            $itemEntity->setNameTag($colour . "$type Flare\n\nArriving in: " . $timer . "s");
            $itemEntity->setNameTagAlwaysVisible();
            $itemEntity->setPickupDelay(-1);
            $itemEntity->setHasGravity(false);
            $itemEntity->spawnToAll();
            # schedule tasks
            EmporiumPrison::getInstance()->getScheduler()->scheduleRepeatingTask(new MeteorFlareEntityTask($world, $x, $y, $z, $itemEntity, $name, $type, $colour), 20);

            # remove flare from stack
            $hand->setCount($count - 1);
            $player->getInventory()->setItemInHand($hand);
            $player->broadcastSound(new ExplodeSound(), [$player]);
        }
        if($hand->getNamedTag()->getTag("BroteasGKitFlare")) {
            # world check
            if(!$world->getFolderName() == "world" || !$world->getFolderName() == "TutorialMine") {
                $player->sendMessage(TF::RED . "You can't do that here");
                return;
            }
            # position check

            # check if meteor already exists
            $name = $x . "_" . $y . "_" . $z;
            if(ServerManager::getInstance()->getData("meteors.$name")) return;
            # set type
            $type = "Heroic Broteas GKit";
            $colour = TextFormat::GREEN;
            # create meteor data
            ServerManager::getInstance()->setData("meteors.$name.timer", 30);
            ServerManager::getInstance()->setData("meteors.$name.breaks-left", 50);
            ServerManager::getInstance()->setData("meteors.$name.rarity", "elite");
            # broadcast message
            EmporiumPrison::getInstance()->getServer()->broadcastMessage(TF::BOLD . $colour . "A $type Flare has been activated by\n" . $player->getName() . " near: \n" . TF::RESET . TF::WHITE . $x . TF::GRAY . "x, " . TF::WHITE . $y . TF::GRAY . "y, " . TF::WHITE . $z . TF::GRAY . "z\nMeteors are corrupt ores from lost galaxies\nfilled with mass amounts of legendary loot!" . TF::WHITE . " /help meteors");
            # create item entity
            (int)$timer = ServerManager::getInstance()->getData("meteors.$name.timer");
            $itemEntity = new ItemEntity(new Location($x + 0.5, $y + 2, $z + 0.5, $world, 0, 0), VanillaBlocks::REDSTONE_TORCH()->asItem());
            $itemEntity->setNameTag($colour . "$type Flare\n\nArriving in: " . $timer . "s");
            $itemEntity->setNameTagAlwaysVisible();
            $itemEntity->setPickupDelay(-1);
            $itemEntity->setHasGravity(false);
            $itemEntity->spawnToAll();
            # schedule tasks
            EmporiumPrison::getInstance()->getScheduler()->scheduleRepeatingTask(new MeteorFlareEntityTask($world, $x, $y, $z, $itemEntity, $name, $type, $colour), 20);

            # remove flare from stack
            $hand->setCount($count - 1);
            $player->getInventory()->setItemInHand($hand);
            $player->broadcastSound(new ExplodeSound(), [$player]);
        }
        if($hand->getNamedTag()->getTag("AresGKitFlare")) {
            # world check
            if(!$world->getFolderName() == "world" || !$world->getFolderName() == "TutorialMine") {
                $player->sendMessage(TF::RED . "You can't do that here");
                return;
            }
            # position check

            # check if meteor already exists
            $name = $x . "_" . $y . "_" . $z;
            if(ServerManager::getInstance()->getData("meteors.$name")) return;
            # set type
            $type = "Heroic Ares GKit";
            $colour = TextFormat::GOLD;
            # create meteor data
            ServerManager::getInstance()->setData("meteors.$name.timer", 30);
            ServerManager::getInstance()->setData("meteors.$name.breaks-left", 50);
            ServerManager::getInstance()->setData("meteors.$name.rarity", "elite");
            # broadcast message
            EmporiumPrison::getInstance()->getServer()->broadcastMessage(TF::BOLD . $colour . "A $type Flare has been activated by\n" . $player->getName() . " near: \n" . TF::RESET . TF::WHITE . $x . TF::GRAY . "x, " . TF::WHITE . $y . TF::GRAY . "y, " . TF::WHITE . $z . TF::GRAY . "z\nMeteors are corrupt ores from lost galaxies\nfilled with mass amounts of legendary loot!" . TF::WHITE . " /help meteors");
            # create item entity
            (int)$timer = ServerManager::getInstance()->getData("meteors.$name.timer");
            $itemEntity = new ItemEntity(new Location($x + 0.5, $y + 2, $z + 0.5, $world, 0, 0), VanillaBlocks::REDSTONE_TORCH()->asItem());
            $itemEntity->setNameTag($colour . "$type Flare\n\nArriving in: " . $timer . "s");
            $itemEntity->setNameTagAlwaysVisible();
            $itemEntity->setPickupDelay(-1);
            $itemEntity->setHasGravity(false);
            $itemEntity->spawnToAll();
            # schedule tasks
            EmporiumPrison::getInstance()->getScheduler()->scheduleRepeatingTask(new MeteorFlareEntityTask($world, $x, $y, $z, $itemEntity, $name, $type, $colour), 20);

            # remove flare from stack
            $hand->setCount($count - 1);
            $player->getInventory()->setItemInHand($hand);
            $player->broadcastSound(new ExplodeSound(), [$player]);
        }
        if($hand->getNamedTag()->getTag("GrimReaperGKitFlare")) {
            # world check
            if(!$world->getFolderName() == "world" || !$world->getFolderName() == "TutorialMine") {
                $player->sendMessage(TF::RED . "You can't do that here");
                return;
            }
            # position check

            # check if meteor already exists
            $name = $x . "_" . $y . "_" . $z;
            if(ServerManager::getInstance()->getData("meteors.$name")) return;
            # set type
            $type = "Heroic Grim Reaper GKit";
            $colour = TextFormat::RED;
            # create meteor data
            ServerManager::getInstance()->setData("meteors.$name.timer", 30);
            ServerManager::getInstance()->setData("meteors.$name.breaks-left", 50);
            ServerManager::getInstance()->setData("meteors.$name.rarity", "elite");
            # broadcast message
            EmporiumPrison::getInstance()->getServer()->broadcastMessage(TF::BOLD . $colour . "A $type Flare has been activated by\n" . $player->getName() . " near: \n" . TF::RESET . TF::WHITE . $x . TF::GRAY . "x, " . TF::WHITE . $y . TF::GRAY . "y, " . TF::WHITE . $z . TF::GRAY . "z\nMeteors are corrupt ores from lost galaxies\nfilled with mass amounts of legendary loot!" . TF::WHITE . " /help meteors");
            # create item entity
            (int)$timer = ServerManager::getInstance()->getData("meteors.$name.timer");
            $itemEntity = new ItemEntity(new Location($x + 0.5, $y + 2, $z + 0.5, $world, 0, 0), VanillaBlocks::REDSTONE_TORCH()->asItem());
            $itemEntity->setNameTag($colour . "$type Flare\n\nArriving in: " . $timer . "s");
            $itemEntity->setNameTagAlwaysVisible();
            $itemEntity->setPickupDelay(-1);
            $itemEntity->setHasGravity(false);
            $itemEntity->spawnToAll();
            # schedule tasks
            EmporiumPrison::getInstance()->getScheduler()->scheduleRepeatingTask(new MeteorFlareEntityTask($world, $x, $y, $z, $itemEntity, $name, $type, $colour), 20);

            # remove flare from stack
            $hand->setCount($count - 1);
            $player->getInventory()->setItemInHand($hand);
            $player->broadcastSound(new ExplodeSound(), [$player]);
        }
        if($hand->getNamedTag()->getTag("ExecutionerGKitFlare")) {
            # world check
            if(!$world->getFolderName() == "world" || !$world->getFolderName() == "TutorialMine") {
                $player->sendMessage(TF::RED . "You can't do that here");
                return;
            }
            # position check

            # check if meteor already exists
            $name = $x . "_" . $y . "_" . $z;
            if(ServerManager::getInstance()->getData("meteors.$name")) return;
            # set type
            $type = "Heroic Executioner GKit";
            $colour = TextFormat::DARK_RED;
            # create meteor data
            ServerManager::getInstance()->setData("meteors.$name.timer", 30);
            ServerManager::getInstance()->setData("meteors.$name.breaks-left", 50);
            ServerManager::getInstance()->setData("meteors.$name.rarity", "elite");
            # broadcast message
            EmporiumPrison::getInstance()->getServer()->broadcastMessage(TF::BOLD . $colour . "A $type Flare has been activated by\n" . $player->getName() . " near: \n" . TF::RESET . TF::WHITE . $x . TF::GRAY . "x, " . TF::WHITE . $y . TF::GRAY . "y, " . TF::WHITE . $z . TF::GRAY . "z\nMeteors are corrupt ores from lost galaxies\nfilled with mass amounts of legendary loot!" . TF::WHITE . " /help meteors");
            # create item entity
            (int)$timer = ServerManager::getInstance()->getData("meteors.$name.timer");
            $itemEntity = new ItemEntity(new Location($x + 0.5, $y + 2, $z + 0.5, $world, 0, 0), VanillaBlocks::REDSTONE_TORCH()->asItem());
            $itemEntity->setNameTag($colour . "$type Flare\n\nArriving in: " . $timer . "s");
            $itemEntity->setNameTagAlwaysVisible();
            $itemEntity->setPickupDelay(-1);
            $itemEntity->setHasGravity(false);
            $itemEntity->spawnToAll();
            # schedule tasks
            EmporiumPrison::getInstance()->getScheduler()->scheduleRepeatingTask(new MeteorFlareEntityTask($world, $x, $y, $z, $itemEntity, $name, $type, $colour), 20);

            # remove flare from stack
            $hand->setCount($count - 1);
            $player->getInventory()->setItemInHand($hand);
            $player->broadcastSound(new ExplodeSound(), [$player]);
        }
        # gkit flares
        if($hand->getNamedTag()->getTag("BlacksmithGKitFlare")) {
            # world check
            if(!$world->getFolderName() == "world" || !$world->getFolderName() == "TutorialMine") {
                $player->sendMessage(TF::RED . "You can't do that here");
                return;
            }
            # position check

            # check if meteor already exists
            $name = $x . "_" . $y . "_" . $z;
            if(ServerManager::getInstance()->getData("meteors.$name")) return;
            # set type
            $type = "Blacksmith GKit";
            $colour = TextFormat::DARK_GRAY;
            # create meteor data
            ServerManager::getInstance()->setData("meteors.$name.timer", 30);
            ServerManager::getInstance()->setData("meteors.$name.breaks-left", 50);
            ServerManager::getInstance()->setData("meteors.$name.rarity", "elite");
            # broadcast message
            EmporiumPrison::getInstance()->getServer()->broadcastMessage(TF::BOLD . $colour . "A $type Flare has been activated by\n" . $player->getName() . " near: \n" . TF::RESET . TF::WHITE . $x . TF::GRAY . "x, " . TF::WHITE . $y . TF::GRAY . "y, " . TF::WHITE . $z . TF::GRAY . "z\nMeteors are corrupt ores from lost galaxies\nfilled with mass amounts of legendary loot!" . TF::WHITE . " /help meteors");
            # create item entity
            (int)$timer = ServerManager::getInstance()->getData("meteors.$name.timer");
            $itemEntity = new ItemEntity(new Location($x + 0.5, $y + 2, $z + 0.5, $world, 0, 0), VanillaBlocks::REDSTONE_TORCH()->asItem());
            $itemEntity->setNameTag($colour . "$type Flare\n\nArriving in: " . $timer . "s");
            $itemEntity->setNameTagAlwaysVisible();
            $itemEntity->setPickupDelay(-1);
            $itemEntity->setHasGravity(false);
            $itemEntity->spawnToAll();
            # schedule tasks
            EmporiumPrison::getInstance()->getScheduler()->scheduleRepeatingTask(new MeteorFlareEntityTask($world, $x, $y, $z, $itemEntity, $name, $type, $colour), 20);

            # remove flare from stack
            $hand->setCount($count - 1);
            $player->getInventory()->setItemInHand($hand);
            $player->broadcastSound(new ExplodeSound(), [$player]);
        }
        if($hand->getNamedTag()->getTag("HeroGKitFlare")) {
            # world check
            if(!$world->getFolderName() == "world" || !$world->getFolderName() == "TutorialMine") {
                $player->sendMessage(TF::RED . "You can't do that here");
                return;
            }
            # position check

            # check if meteor already exists
            $name = $x . "_" . $y . "_" . $z;
            if(ServerManager::getInstance()->getData("meteors.$name")) return;
            # set type
            $type = "Hero GKit";
            $colour = TextFormat::WHITE;
            # create meteor data
            ServerManager::getInstance()->setData("meteors.$name.timer", 30);
            ServerManager::getInstance()->setData("meteors.$name.breaks-left", 50);
            ServerManager::getInstance()->setData("meteors.$name.rarity", "elite");
            # broadcast message
            EmporiumPrison::getInstance()->getServer()->broadcastMessage(TF::BOLD . $colour . "A $type Flare has been activated by\n" . $player->getName() . " near: \n" . TF::RESET . TF::WHITE . $x . TF::GRAY . "x, " . TF::WHITE . $y . TF::GRAY . "y, " . TF::WHITE . $z . TF::GRAY . "z\nMeteors are corrupt ores from lost galaxies\nfilled with mass amounts of legendary loot!" . TF::WHITE . " /help meteors");
            # create item entity
            (int)$timer = ServerManager::getInstance()->getData("meteors.$name.timer");
            $itemEntity = new ItemEntity(new Location($x + 0.5, $y + 2, $z + 0.5, $world, 0, 0), VanillaBlocks::REDSTONE_TORCH()->asItem());
            $itemEntity->setNameTag($colour . "$type Flare\n\nArriving in: " . $timer . "s");
            $itemEntity->setNameTagAlwaysVisible();
            $itemEntity->setPickupDelay(-1);
            $itemEntity->setHasGravity(false);
            $itemEntity->spawnToAll();
            # schedule tasks
            EmporiumPrison::getInstance()->getScheduler()->scheduleRepeatingTask(new MeteorFlareEntityTask($world, $x, $y, $z, $itemEntity, $name, $type, $colour), 20);

            # remove flare from stack
            $hand->setCount($count - 1);
            $player->getInventory()->setItemInHand($hand);
            $player->broadcastSound(new ExplodeSound(), [$player]);
        }
        if($hand->getNamedTag()->getTag("CyborgGKitFlare")) {
            # world check
            if(!$world->getFolderName() == "world" || !$world->getFolderName() == "TutorialMine") {
                $player->sendMessage(TF::RED . "You can't do that here");
                return;
            }
            # position check

            # check if meteor already exists
            $name = $x . "_" . $y . "_" . $z;
            if(ServerManager::getInstance()->getData("meteors.$name")) return;
            # set type
            $type = "Cyborg GKit";
            $colour = TextFormat::DARK_AQUA;
            # create meteor data
            ServerManager::getInstance()->setData("meteors.$name.timer", 30);
            ServerManager::getInstance()->setData("meteors.$name.breaks-left", 50);
            ServerManager::getInstance()->setData("meteors.$name.rarity", "elite");
            # broadcast message
            EmporiumPrison::getInstance()->getServer()->broadcastMessage(TF::BOLD . $colour . "A $type Flare has been activated by\n" . $player->getName() . " near: \n" . TF::RESET . TF::WHITE . $x . TF::GRAY . "x, " . TF::WHITE . $y . TF::GRAY . "y, " . TF::WHITE . $z . TF::GRAY . "z\nMeteors are corrupt ores from lost galaxies\nfilled with mass amounts of legendary loot!" . TF::WHITE . " /help meteors");
            # create item entity
            (int)$timer = ServerManager::getInstance()->getData("meteors.$name.timer");
            $itemEntity = new ItemEntity(new Location($x + 0.5, $y + 2, $z + 0.5, $world, 0, 0), VanillaBlocks::REDSTONE_TORCH()->asItem());
            $itemEntity->setNameTag($colour . "$type Flare\n\nArriving in: " . $timer . "s");
            $itemEntity->setNameTagAlwaysVisible();
            $itemEntity->setPickupDelay(-1);
            $itemEntity->setHasGravity(false);
            $itemEntity->spawnToAll();
            # schedule tasks
            EmporiumPrison::getInstance()->getScheduler()->scheduleRepeatingTask(new MeteorFlareEntityTask($world, $x, $y, $z, $itemEntity, $name, $type, $colour), 20);

            # remove flare from stack
            $hand->setCount($count - 1);
            $player->getInventory()->setItemInHand($hand);
            $player->broadcastSound(new ExplodeSound(), [$player]);
        }
        if($hand->getNamedTag()->getTag("CrucibleGKitFlare")) {
            # world check
            if(!$world->getFolderName() == "world" || !$world->getFolderName() == "TutorialMine") {
                $player->sendMessage(TF::RED . "You can't do that here");
                return;
            }
            # position check

            # check if meteor already exists
            $name = $x . "_" . $y . "_" . $z;
            if(ServerManager::getInstance()->getData("meteors.$name")) return;
            # set type
            $type = "Crucible GKit";
            $colour = TextFormat::YELLOW;
            # create meteor data
            ServerManager::getInstance()->setData("meteors.$name.timer", 30);
            ServerManager::getInstance()->setData("meteors.$name.breaks-left", 50);
            ServerManager::getInstance()->setData("meteors.$name.rarity", "elite");
            # broadcast message
            EmporiumPrison::getInstance()->getServer()->broadcastMessage(TF::BOLD . $colour . "A $type Flare has been activated by\n" . $player->getName() . " near: \n" . TF::RESET . TF::WHITE . $x . TF::GRAY . "x, " . TF::WHITE . $y . TF::GRAY . "y, " . TF::WHITE . $z . TF::GRAY . "z\nMeteors are corrupt ores from lost galaxies\nfilled with mass amounts of legendary loot!" . TF::WHITE . " /help meteors");
            # create item entity
            (int)$timer = ServerManager::getInstance()->getData("meteors.$name.timer");
            $itemEntity = new ItemEntity(new Location($x + 0.5, $y + 2, $z + 0.5, $world, 0, 0), VanillaBlocks::REDSTONE_TORCH()->asItem());
            $itemEntity->setNameTag($colour . "$type Flare\n\nArriving in: " . $timer . "s");
            $itemEntity->setNameTagAlwaysVisible();
            $itemEntity->setPickupDelay(-1);
            $itemEntity->setHasGravity(false);
            $itemEntity->spawnToAll();
            # schedule tasks
            EmporiumPrison::getInstance()->getScheduler()->scheduleRepeatingTask(new MeteorFlareEntityTask($world, $x, $y, $z, $itemEntity, $name, $type, $colour), 20);

            # remove flare from stack
            $hand->setCount($count - 1);
            $player->getInventory()->setItemInHand($hand);
            $player->broadcastSound(new ExplodeSound(), [$player]);
        }
        if($hand->getNamedTag()->getTag("HunterGKitFlare")) {
            # world check
            if(!$world->getFolderName() == "world" || !$world->getFolderName() == "TutorialMine") {
                $player->sendMessage(TF::RED . "You can't do that here");
                return;
            }
            # position check

            # check if meteor already exists
            $name = $x . "_" . $y . "_" . $z;
            if(ServerManager::getInstance()->getData("meteors.$name")) return;
            # set type
            $type = "Hunter GKit";
            $colour = TextFormat::AQUA;
            # create meteor data
            ServerManager::getInstance()->setData("meteors.$name.timer", 30);
            ServerManager::getInstance()->setData("meteors.$name.breaks-left", 50);
            ServerManager::getInstance()->setData("meteors.$name.rarity", "elite");
            # broadcast message
            EmporiumPrison::getInstance()->getServer()->broadcastMessage(TF::BOLD . $colour . "A $type Flare has been activated by\n" . $player->getName() . " near: \n" . TF::RESET . TF::WHITE . $x . TF::GRAY . "x, " . TF::WHITE . $y . TF::GRAY . "y, " . TF::WHITE . $z . TF::GRAY . "z\nMeteors are corrupt ores from lost galaxies\nfilled with mass amounts of legendary loot!" . TF::WHITE . " /help meteors");
            # create item entity
            (int)$timer = ServerManager::getInstance()->getData("meteors.$name.timer");
            $itemEntity = new ItemEntity(new Location($x + 0.5, $y + 2, $z + 0.5, $world, 0, 0), VanillaBlocks::REDSTONE_TORCH()->asItem());
            $itemEntity->setNameTag($colour . "$type Flare\n\nArriving in: " . $timer . "s");
            $itemEntity->setNameTagAlwaysVisible();
            $itemEntity->setPickupDelay(-1);
            $itemEntity->setHasGravity(false);
            $itemEntity->spawnToAll();
            # schedule tasks
            EmporiumPrison::getInstance()->getScheduler()->scheduleRepeatingTask(new MeteorFlareEntityTask($world, $x, $y, $z, $itemEntity, $name, $type, $colour), 20);

            # remove flare from stack
            $hand->setCount($count - 1);
            $player->getInventory()->setItemInHand($hand);
            $player->broadcastSound(new ExplodeSound(), [$player]);
        }

    }

}