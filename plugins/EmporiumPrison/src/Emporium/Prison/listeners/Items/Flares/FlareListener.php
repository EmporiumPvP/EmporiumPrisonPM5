<?php

namespace Emporium\Prison\listeners\Items\Flares;

use Emporium\Prison\EmporiumPrison;
use Emporium\Prison\Entity\Fireball;
use Emporium\Prison\tasks\Flares\MeteorFlareEntityTask;
use Emporium\Prison\tasks\Meteors\MeteorTask;

use Emporium\Prison\Variables;
use EmporiumData\ServerManager;

use Exception;
use pocketmine\block\BlockLegacyIds;
use pocketmine\block\VanillaBlocks;
use pocketmine\entity\Location;
use pocketmine\entity\object\ItemEntity;
use pocketmine\event\entity\EntityExplodeEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerItemUseEvent;
use pocketmine\math\Vector3;
use pocketmine\network\mcpe\protocol\CameraShakePacket;
use pocketmine\player\Player;
use pocketmine\scheduler\ClosureTask;
use pocketmine\Server;
use pocketmine\utils\TextFormat;
use pocketmine\utils\TextFormat as TF;
use pocketmine\world\particle\HugeExplodeSeedParticle;
use pocketmine\world\sound\ExplodeSound;
use pocketmine\world\sound\NoteInstrument;
use pocketmine\world\sound\NoteSound;
use Emporium\Prison\Entity\FallingBlockEntity;

class FlareListener implements Listener {

    /**
     * @throws Exception
     */
    public function onBlockPlace(PlayerInteractEvent $event) {
        # data
        $player = $event->getPlayer();

        $hand = $player->getInventory()->getItemInHand();
        $count = $hand->getCount();
        $block = $player->getTargetBlock(8);
        if ($block == null) {
            $player->sendMessage(Variables::SERVER_PREFIX . TextFormat::RED . "Please look at a block to activate a flare!");
        }
        $world = $player->getWorld();
        # position
        $x = round($block->getPosition()->getX());
        $y = round($block->getPosition()->getY());
        $z = round($block->getPosition()->getZ());

        $willSpawn = false;
        # meteor flares
        if($hand->getNamedTag()->getTag("EliteMeteorFlare")
        ) {
            $willSpawn = true;
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

            # create

            # broadcast message to server
            EmporiumPrison::getInstance()->getServer()->broadcastMessage(TF::BOLD . $colour . "An Elite Meteor Flare has been activated by\n" . $player->getName() . " near: \n" . TF::RESET . TF::WHITE . $x . TF::GRAY . "x, " . TF::WHITE . $y . TF::GRAY . "y, " . TF::WHITE . $z . TF::GRAY . "z\nMeteors are corrupt ores from lost galaxies\nfilled with mass amounts of legendary loot!" . TF::WHITE . " /help meteors");

            # create item entity
            $timer = ServerManager::getInstance()->getData("meteors.$name.timer");
            $itemEntity = new ItemEntity(new Location($x + 0.5, $y + 2, $z + 0.5, $world, 0, 0), VanillaBlocks::REDSTONE_TORCH()->asItem());
            $itemEntity->setNameTag($colour . "$type Flare\n\nArriving in: " . $timer . "s");
            $itemEntity->setNameTagAlwaysVisible();
            $itemEntity->setPickupDelay(-1);
            $itemEntity->setHasGravity(false);
            $itemEntity->spawnToAll();

            # remove flare from stack
            $hand->setCount($count - 1);
            $player->getInventory()->setItemInHand($hand);
            $player->broadcastSound(new ExplodeSound(), [$player]);
        }

        # heroic gkit flares
        if($hand->getNamedTag()->getTag("VulkarionGKitFlare")) {
            $willSpawn = true;
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

            # remove flare from stack
            $hand->setCount($count - 1);
            $player->getInventory()->setItemInHand($hand);
            $player->broadcastSound(new ExplodeSound(), [$player]);
        }
        if($hand->getNamedTag()->getTag("ZenithGKitFlare")) {
            $willSpawn = true;
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

            # remove flare from stack
            $hand->setCount($count - 1);
            $player->getInventory()->setItemInHand($hand);
            $player->broadcastSound(new ExplodeSound(), [$player]);
        }
        if($hand->getNamedTag()->getTag("ColossusGKitFlare")) {
            $willSpawn = true;
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

            # remove flare from stack
            $hand->setCount($count - 1);
            $player->getInventory()->setItemInHand($hand);
            $player->broadcastSound(new ExplodeSound(), [$player]);
        }
        if($hand->getNamedTag()->getTag("WarlockGKitFlare")) {
            $willSpawn = true;
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

            # remove flare from stack
            $hand->setCount($count - 1);
            $player->getInventory()->setItemInHand($hand);
            $player->broadcastSound(new ExplodeSound(), [$player]);
        }
        if($hand->getNamedTag()->getTag("SlaughterGKitFlare")) {
            $willSpawn = true;
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

            # remove flare from stack
            $hand->setCount($count - 1);
            $player->getInventory()->setItemInHand($hand);
            $player->broadcastSound(new ExplodeSound(), [$player]);
        }
        if($hand->getNamedTag()->getTag("EnchanterGKitFlare")) {
            $willSpawn = true;
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

            # remove flare from stack
            $hand->setCount($count - 1);
            $player->getInventory()->setItemInHand($hand);
            $player->broadcastSound(new ExplodeSound(), [$player]);
        }
        if($hand->getNamedTag()->getTag("AtheosGKitFlare")) {
            $willSpawn = true;
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

            # remove flare from stack
            $hand->setCount($count - 1);
            $player->getInventory()->setItemInHand($hand);
            $player->broadcastSound(new ExplodeSound(), [$player]);
        }
        if($hand->getNamedTag()->getTag("BroteasGKitFlare")) {
            $willSpawn = true;
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

            # remove flare from stack
            $hand->setCount($count - 1);
            $player->getInventory()->setItemInHand($hand);
            $player->broadcastSound(new ExplodeSound(), [$player]);
        }
        if($hand->getNamedTag()->getTag("AresGKitFlare")) {
            $willSpawn = true;
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

            # remove flare from stack
            $hand->setCount($count - 1);
            $player->getInventory()->setItemInHand($hand);
            $player->broadcastSound(new ExplodeSound(), [$player]);
        }
        if($hand->getNamedTag()->getTag("GrimReaperGKitFlare")) {
            $willSpawn = true;
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

            # remove flare from stack
            $hand->setCount($count - 1);
            $player->getInventory()->setItemInHand($hand);
            $player->broadcastSound(new ExplodeSound(), [$player]);
        }
        if($hand->getNamedTag()->getTag("ExecutionerGKitFlare")) {
            $willSpawn = true;
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

            # remove flare from stack
            $hand->setCount($count - 1);
            $player->getInventory()->setItemInHand($hand);
            $player->broadcastSound(new ExplodeSound(), [$player]);
        }
        # gkit flares
        if($hand->getNamedTag()->getTag("BlacksmithGKitFlare")) {
            $willSpawn = true;
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

            # remove flare from stack
            $hand->setCount($count - 1);
            $player->getInventory()->setItemInHand($hand);
            $player->broadcastSound(new ExplodeSound(), [$player]);
        }
        if($hand->getNamedTag()->getTag("HeroGKitFlare")) {
            $willSpawn = true;
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

            # remove flare from stack
            $hand->setCount($count - 1);
            $player->getInventory()->setItemInHand($hand);
            $player->broadcastSound(new ExplodeSound(), [$player]);
        }
        if($hand->getNamedTag()->getTag("CyborgGKitFlare")) {
            $willSpawn = true;
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

            # remove flare from stack
            $hand->setCount($count - 1);
            $player->getInventory()->setItemInHand($hand);
            $player->broadcastSound(new ExplodeSound(), [$player]);
        }
        if($hand->getNamedTag()->getTag("CrucibleGKitFlare")) {
            $willSpawn = true;
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

            # remove flare from stack
            $hand->setCount($count - 1);
            $player->getInventory()->setItemInHand($hand);
            $player->broadcastSound(new ExplodeSound(), [$player]);
        }
        if($hand->getNamedTag()->getTag("HunterGKitFlare")) {
            $willSpawn = true;
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

            # remove flare from stack
            $hand->setCount($count - 1);
            $player->getInventory()->setItemInHand($hand);
            $player->broadcastSound(new ExplodeSound(), [$player]);
        }

        if ($willSpawn) {
            EmporiumPrison::getInstance()->getScheduler()->scheduleRepeatingTask(new MeteorFlareEntityTask($player, $itemEntity, $colour, $type), 20);
            $x = $block->getPosition()->getX() + (mt_rand(1, 80) - 40);
            $z = $block->getPosition()->getZ() + (mt_rand(1, 80) - 40);
            $rx = (($block->getPosition()->getX() - $x) / 30) / 20;
            $rz = (($block->getPosition()->getZ() - $z) / 30) / 20;

            $entity = new Fireball(new Location($x, $block->getPosition()->getY() + 900, $z, $block->getPosition()->getWorld(), 0, 0), null);
            $entity->setMotion(new Vector3($rx, -1.5, $rz));
            $entity->setHasGravity(false);
            $entity->setOnFire(999);
            $entity->type = $type;
            $entity->spawnToAll();
        }
    }

    public function onEntityExplosionEvent (EntityExplodeEvent $event) : void
    {
        if (!($entity = $event->getEntity()) instanceof Fireball) return;

        foreach ($event->getBlockList() as $block) {
            $fallingBlockEntity = new FallingBlockEntity(new Location($event->getPosition()->getX(), $block->getPosition()->getY() + 2.5, $event->getPosition()->getZ(), $block->getPosition()->getWorld(), 0, 0), $block);
            $fallingBlockEntity->setMaxHealth(255);
            $fallingBlockEntity->setMotion(new Vector3((mt_rand(1, 30) - 15) / 10,  ($event->getYield() + ((mt_rand(1, 90) - 45) / 10)) / 20, (mt_rand(1, 30) - 15) / 10));
            $fallingBlockEntity->spawnToAll();
            // $block->getPosition()->getWorld()->setBlock($block->getPosition()->asVector3(), VanillaBlocks::AIR());

            if ($block->getPosition()->getWorld()->getBlock($block->getPosition()->up())->getId() == BlockLegacyIds::AIR && mt_rand(1, 66) > 25) {
                $block->getPosition()->getWorld()->setBlock($block->getPosition()->up(), VanillaBlocks::FIRE());
            }
        }

        $event->setBlockList([]);


        $x = round($event->getPosition()->getX());
        $z = round($event->getPosition()->getZ());

        if ($event->getPosition()->getWorld()->getBlock($event->getPosition())->getId() == BlockLegacyIds::AIR) {
            $y = round($event->getPosition()->getY());
            $name = $x . "_" . $y . "_" . $z;
            $event->getPosition()->getWorld()->setBlock($event->getPosition(), VanillaBlocks::NETHER_QUARTZ_ORE());
        }
        else {
            $y = round($event->getPosition()->up()->getY());
            $name = $x . "_" . $y . "_" . $z;
            $event->getPosition()->getWorld()->setBlock($event->getPosition()->up(), VanillaBlocks::NETHER_QUARTZ_ORE());
        }

        ServerManager::getInstance()->setData("meteors.$name.breaks-left", 50);
        ServerManager::getInstance()->setData("meteors.$name.rarity", $entity->type);
        var_dump(ServerManager::getInstance()->setData("meteors.$name.rarity");

        foreach (Server::getInstance()->getOnlinePlayers() as $player) {
            $rotationIntensity = (1 - ($event->getPosition()->distance($player->getPosition()) / 12)) * 0.7;

            // $player->sendMessage($rotationIntensity);
            if ($rotationIntensity > 0) $this->cameraShake($player, $rotationIntensity);
        }

        $event->cancel();

        $event->getPosition()->getWorld()->addParticle($event->getPosition(), new HugeExplodeSeedParticle());
        $event->getPosition()->getWorld()->addSound($event->getPosition(), new ExplodeSound());
    }

    private function cameraShake (Player $player, float $intensity) : void
    {
        $pk = CameraShakePacket::create($intensity, 0.5, CameraShakePacket::TYPE_ROTATIONAL, CameraShakePacket::ACTION_ADD);
        $player->getNetworkSession()->sendDataPacket($pk);
    }
}