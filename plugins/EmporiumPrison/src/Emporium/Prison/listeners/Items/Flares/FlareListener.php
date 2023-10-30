<?php

namespace Emporium\Prison\listeners\Items\Flares;

use Emporium\Prison\EmporiumPrison;
use Emporium\Prison\Entity\FallingBlockEntity;
use Emporium\Prison\Entity\Fireball;
use Emporium\Prison\tasks\Flares\MeteorFlareEntityTask;
use Emporium\Prison\Variables;

use EmporiumData\ServerManager;

use Exception;

use pocketmine\block\BlockTypeIds;
use pocketmine\block\VanillaBlocks;
use pocketmine\entity\Location;
use pocketmine\entity\object\ItemEntity;
use pocketmine\event\entity\EntityExplodeEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\math\Vector3;
use pocketmine\network\mcpe\protocol\CameraShakePacket;
use pocketmine\player\Player;
use pocketmine\Server;
use pocketmine\utils\TextFormat as TF;
use pocketmine\world\particle\HugeExplodeParticle;
use pocketmine\world\sound\ExplodeSound;

class FlareListener implements Listener
{

    private string $type;
    private string $colour;
    private int $timer;
    private string $message;

    /**
     * @throws Exception
     */
    public function onBlockPlace(PlayerInteractEvent $event)
    {
        # data
        $player = $event->getPlayer();

        $hand = $player->getInventory()->getItemInHand();
        $count = $hand->getCount();
        $block = $player->getTargetBlock(8);

        if ($block == null) {
            $player->sendMessage(Variables::PREFIX . TF::RED . "Place on the floor to activate");
        }
        $world = $player->getWorld();

        # position
        $x = round($block->getPosition()->getX());
        $y = round($block->getPosition()->getY());
        $z = round($block->getPosition()->getZ());

        $areaManager = EmporiumPrison::getInstance()->getAreaManager();
        $areas = $areaManager->getAreasInPosition($player->getPosition()->asPosition());

        $willSpawn = false;

        # meteor flares
        if ($hand->getNamedTag()->getTag("EliteMeteorFlare")) {

            # world check
            if (!$world->getFolderName() == "world" || !$world->getFolderName() == "TutorialMine") {
                $player->sendMessage(TF::RED . "You can't do that here");
                return;
            }

            # check if meteor already exists
            $name = $x . "_" . $y . "_" . $z;
            if (ServerManager::getInstance()->getData($name)) return;

            $willSpawn = true;

            # set meteor info
            $this->type = "elite";
            $this->colour = TF::BLUE;
            $this->timer = ServerManager::getInstance()->getData("meteors.$name.timer");
            $this->message = TF::BOLD . $this->colour . "An Elite Meteor Flare has been activated by\n" . $player->getName() . " near: \n" . TF::RESET . TF::WHITE . $x . TF::GRAY . "x, " . TF::WHITE . $y . TF::GRAY . "y, " . TF::WHITE . $z . TF::GRAY . "z\nMeteors are corrupt ores from lost galaxies\nfilled with mass amounts of legendary loot!" . TF::WHITE . " /help meteors";
        }
        if ($hand->getNamedTag()->getTag("UltimateMeteorFlare")) {

            # world check
            if (!$world->getFolderName() == "world" || !$world->getFolderName() == "TutorialMine") {
                $player->sendMessage(TF::RED . "You can't do that here");
                return;
            }

            # check if meteor already exists
            $name = $x . "_" . $y . "_" . $z;
            if (ServerManager::getInstance()->getData($name)) return;

            $willSpawn = true;

            # set meteor info
            $this->type = "ultimate";
            $this->colour = TF::YELLOW;
            $this->timer = ServerManager::getInstance()->getData("meteors.$name.timer");
            $this->message = TF::BOLD . $this->colour . "An Ultimate Meteor Flare has been activated by\n" . $player->getName() . " near: \n" . TF::RESET . TF::WHITE . $x . TF::GRAY . "x, " . TF::WHITE . $y . TF::GRAY . "y, " . TF::WHITE . $z . TF::GRAY . "z\nMeteors are corrupt ores from lost galaxies\nfilled with mass amounts of legendary loot!" . TF::WHITE . " /help meteors";
        }
        if ($hand->getNamedTag()->getTag("LegendaryMeteorFlare")) {

            # world check
            if (!$world->getFolderName() == "world" || !$world->getFolderName() == "TutorialMine") {
                $player->sendMessage(TF::RED . "You can't do that here");
                return;
            }

            # check if meteor already exists
            $name = $x . "_" . $y . "_" . $z;
            if (ServerManager::getInstance()->getData($name)) return;

            $willSpawn = true;

            # set meteor info
            $this->type = "legendary";
            $this->colour = TF::GOLD;
            $this->timer = ServerManager::getInstance()->getData("meteors.$name.timer");
            $this->message = TF::BOLD . $this->colour . "A Legendary Meteor Flare has been activated by\n" . $player->getName() . " near: \n" . TF::RESET . TF::WHITE . $x . TF::GRAY . "x, " . TF::WHITE . $y . TF::GRAY . "y, " . TF::WHITE . $z . TF::GRAY . "z\nMeteors are corrupt ores from lost galaxies\nfilled with mass amounts of legendary loot!" . TF::WHITE . " /help meteors";
        }
        if ($hand->getNamedTag()->getTag("GodlyMeteorFlare")) {

            # world check
            if (!$world->getFolderName() == "world" || !$world->getFolderName() == "TutorialMine") {
                $player->sendMessage(TF::RED . "You can't do that here");
                return;
            }

            # check if meteor already exists
            $name = $x . "_" . $y . "_" . $z;
            if (ServerManager::getInstance()->getData($name)) return;

            $willSpawn = true;

            # set meteor info
            $this->type = "godly";
            $this->colour = TF::LIGHT_PURPLE;
            $this->timer = ServerManager::getInstance()->getData("meteors.$name.timer");
            $this->message = TF::BOLD . $this->colour . "A Godly Meteor Flare has been activated by\n" . $player->getName() . " near: \n" . TF::RESET . TF::WHITE . $x . TF::GRAY . "x, " . TF::WHITE . $y . TF::GRAY . "y, " . TF::WHITE . $z . TF::GRAY . "z\nMeteors are corrupt ores from lost galaxies\nfilled with mass amounts of legendary loot!" . TF::WHITE . " /help meteors";
        }
        if ($hand->getNamedTag()->getTag("HeroicMeteorFlare")) {

            # world check
            if (!$world->getFolderName() == "world" || !$world->getFolderName() == "TutorialMine") {
                $player->sendMessage(TF::RED . "You can't do that here");
                return;
            }

            # check if meteor already exists
            $name = $x . "_" . $y . "_" . $z;
            if (ServerManager::getInstance()->getData($name)) return;

            $willSpawn = true;

            # set meteor info
            $this->type = "heroic";
            $this->colour = TF::RED;
            $this->timer = ServerManager::getInstance()->getData("meteors.$name.timer");
            $this->message = TF::BOLD . $this->colour . "A Heroic Meteor Flare has been activated by\n" . $player->getName() . " near: \n" . TF::RESET . TF::WHITE . $x . TF::GRAY . "x, " . TF::WHITE . $y . TF::GRAY . "y, " . TF::WHITE . $z . TF::GRAY . "z\nMeteors are corrupt ores from lost galaxies\nfilled with mass amounts of legendary loot!" . TF::WHITE . " /help meteors";
        }

        # heroic gkit flares
        if ($hand->getNamedTag()->getTag("VulkarionGKitFlare")) {

            # world check
            if (!$world->getFolderName() == "world" || !$world->getFolderName() == "TutorialMine") {
                $player->sendMessage(TF::RED . "You can't do that here");
                return;
            }

            # check if meteor already exists
            $name = $x . "_" . $y . "_" . $z;
            if (ServerManager::getInstance()->getData("meteors.$name")) return;

            $willSpawn = true;

            # set type
            $this->type = "Heroic Vulkarion GKit";
            $this->colour = TF::DARK_RED;
            $this->timer = ServerManager::getInstance()->getData("meteors.$name.timer");
            $this->message = TF::BOLD . $this->colour . "A $this->type Flare has been activated by\n" . $player->getName() . " near: \n" . TF::RESET . TF::WHITE . $x . TF::GRAY . "x, " . TF::WHITE . $y . TF::GRAY . "y, " . TF::WHITE . $z . TF::GRAY . "z\nMeteors are corrupt ores from lost galaxies\nfilled with mass amounts of legendary loot!" . TF::WHITE . " /help meteors";

        }
        if ($hand->getNamedTag()->getTag("ZenithGKitFlare")) {

            # world check
            if (!$world->getFolderName() == "world" || !$world->getFolderName() == "TutorialMine") {
                $player->sendMessage(TF::RED . "You can't do that here");
                return;
            }

            # check if meteor already exists
            $name = $x . "_" . $y . "_" . $z;
            if (ServerManager::getInstance()->getData("meteors.$name")) return;

            $willSpawn = true;

            # set type
            $this->type = "Heroic Zenith GKit";
            $this->colour = TF::GOLD;
            $this->timer = ServerManager::getInstance()->getData("meteors.$name.timer");
            $this->message = TF::BOLD . $this->colour . "A $this->type Flare has been activated by\n" . $player->getName() . " near: \n" . TF::RESET . TF::WHITE . $x . TF::GRAY . "x, " . TF::WHITE . $y . TF::GRAY . "y, " . TF::WHITE . $z . TF::GRAY . "z\nMeteors are corrupt ores from lost galaxies\nfilled with mass amounts of legendary loot!" . TF::WHITE . " /help meteors";
        }
        if ($hand->getNamedTag()->getTag("ColossusGKitFlare")) {

            # world check
            if (!$world->getFolderName() == "world" || !$world->getFolderName() == "TutorialMine") {
                $player->sendMessage(TF::RED . "You can't do that here");
                return;
            }

            # check if meteor already exists
            $name = $x . "_" . $y . "_" . $z;
            if (ServerManager::getInstance()->getData("meteors.$name")) return;

            $willSpawn = true;

            # set meteor info
            $this->type = "Heroic Colossus GKit";
            $this->colour = TF::WHITE;
            $this->timer = ServerManager::getInstance()->getData("meteors.$name.timer");
            $this->message = TF::BOLD . $this->colour . "A $this->type Flare has been activated by\n" . $player->getName() . " near: \n" . TF::RESET . TF::WHITE . $x . TF::GRAY . "x, " . TF::WHITE . $y . TF::GRAY . "y, " . TF::WHITE . $z . TF::GRAY . "z\nMeteors are corrupt ores from lost galaxies\nfilled with mass amounts of legendary loot!" . TF::WHITE . " /help meteors";
        }
        if ($hand->getNamedTag()->getTag("WarlockGKitFlare")) {

            # world check
            if (!$world->getFolderName() == "world" || !$world->getFolderName() == "TutorialMine") {
                $player->sendMessage(TF::RED . "You can't do that here");
                return;
            }

            # check if meteor already exists
            $name = $x . "_" . $y . "_" . $z;
            if (ServerManager::getInstance()->getData("meteors.$name")) return;

            $willSpawn = true;

            # set meteor info
            $this->type = "Heroic Warlock GKit";
            $this->colour = TF::DARK_PURPLE;
            $this->timer = ServerManager::getInstance()->getData("meteors.$name.timer");
            $this->message = TF::BOLD . $this->colour . "A $this->type Flare has been activated by\n" . $player->getName() . " near: \n" . TF::RESET . TF::WHITE . $x . TF::GRAY . "x, " . TF::WHITE . $y . TF::GRAY . "y, " . TF::WHITE . $z . TF::GRAY . "z\nMeteors are corrupt ores from lost galaxies\nfilled with mass amounts of legendary loot!" . TF::WHITE . " /help meteors";
        }
        if ($hand->getNamedTag()->getTag("SlaughterGKitFlare")) {

            # world check
            if (!$world->getFolderName() == "world" || !$world->getFolderName() == "TutorialMine") {
                $player->sendMessage(TF::RED . "You can't do that here");
                return;
            }

            # check if meteor already exists
            $name = $x . "_" . $y . "_" . $z;
            if (ServerManager::getInstance()->getData("meteors.$name")) return;

            $willSpawn = true;

            # set type
            $this->type = "Heroic Slaughter GKit";
            $this->colour = TF::RED;
            $this->timer = ServerManager::getInstance()->getData("meteors.$name.timer");
            $this->message = TF::BOLD . $this->colour . "A $this->type Flare has been activated by\n" . $player->getName() . " near: \n" . TF::RESET . TF::WHITE . $x . TF::GRAY . "x, " . TF::WHITE . $y . TF::GRAY . "y, " . TF::WHITE . $z . TF::GRAY . "z\nMeteors are corrupt ores from lost galaxies\nfilled with mass amounts of legendary loot!" . TF::WHITE . " /help meteors";
        }
        if ($hand->getNamedTag()->getTag("EnchanterGKitFlare")) {

            # world check
            if (!$world->getFolderName() == "world" || !$world->getFolderName() == "TutorialMine") {
                $player->sendMessage(TF::RED . "You can't do that here");
                return;
            }

            # check if meteor already exists
            $name = $x . "_" . $y . "_" . $z;
            if (ServerManager::getInstance()->getData("meteors.$name")) return;

            $willSpawn = true;

            # set type
            $this->type = "Heroic Enchanter GKit";
            $this->colour = TF::AQUA;
            $this->timer = ServerManager::getInstance()->getData("meteors.$name.timer");
            $this->message = TF::BOLD . $this->colour . "A $this->type Flare has been activated by\n" . $player->getName() . " near: \n" . TF::RESET . TF::WHITE . $x . TF::GRAY . "x, " . TF::WHITE . $y . TF::GRAY . "y, " . TF::WHITE . $z . TF::GRAY . "z\nMeteors are corrupt ores from lost galaxies\nfilled with mass amounts of legendary loot!" . TF::WHITE . " /help meteors";
        }
        if ($hand->getNamedTag()->getTag("AtheosGKitFlare")) {

            # world check
            if (!$world->getFolderName() == "world" || !$world->getFolderName() == "TutorialMine") {
                $player->sendMessage(TF::RED . "You can't do that here");
                return;
            }

            # check if meteor already exists
            $name = $x . "_" . $y . "_" . $z;
            if (ServerManager::getInstance()->getData("meteors.$name")) return;

            $willSpawn = true;

            # set type
            $this->type = "Heroic Atheos GKit";
            $this->colour = TF::GRAY;
            $this->timer = ServerManager::getInstance()->getData("meteors.$name.timer");
            $this->message = TF::BOLD . $this->colour . "A $this->type Flare has been activated by\n" . $player->getName() . " near: \n" . TF::RESET . TF::WHITE . $x . TF::GRAY . "x, " . TF::WHITE . $y . TF::GRAY . "y, " . TF::WHITE . $z . TF::GRAY . "z\nMeteors are corrupt ores from lost galaxies\nfilled with mass amounts of legendary loot!" . TF::WHITE . " /help meteors";
        }
        if ($hand->getNamedTag()->getTag("Iapetus")) {

            # world check
            if (!$world->getFolderName() == "world" || !$world->getFolderName() == "TutorialMine") {
                $player->sendMessage(TF::RED . "You can't do that here");
                return;
            }

            # check if meteor already exists
            $name = $x . "_" . $y . "_" . $z;
            if (ServerManager::getInstance()->getData("meteors.$name")) return;

            $willSpawn = true;

            # set type
            $this->type = "Heroic Iapetus GKit";
            $this->colour = TF::BLUE;
            $this->timer = ServerManager::getInstance()->getData("meteors.$name.timer");
            $this->message = TF::BOLD . $this->colour . "A $this->type Flare has been activated by\n" . $player->getName() . " near: \n" . TF::RESET . TF::WHITE . $x . TF::GRAY . "x, " . TF::WHITE . $y . TF::GRAY . "y, " . TF::WHITE . $z . TF::GRAY . "z\nMeteors are corrupt ores from lost galaxies\nfilled with mass amounts of legendary loot!" . TF::WHITE . " /help meteors";
        }
        if ($hand->getNamedTag()->getTag("BroteasGKitFlare")) {

            # world check
            if (!$world->getFolderName() == "world" || !$world->getFolderName() == "TutorialMine") {
                $player->sendMessage(TF::RED . "You can't do that here");
                return;
            }

            # check if meteor already exists
            $name = $x . "_" . $y . "_" . $z;
            if (ServerManager::getInstance()->getData("meteors.$name")) return;

            $willSpawn = true;

            # set type
            $this->type = "Heroic Broteas GKit";
            $this->colour = TF::GREEN;
            $this->timer = ServerManager::getInstance()->getData("meteors.$name.timer");
            $this->message = TF::BOLD . $this->colour . "A $this->type Flare has been activated by\n" . $player->getName() . " near: \n" . TF::RESET . TF::WHITE . $x . TF::GRAY . "x, " . TF::WHITE . $y . TF::GRAY . "y, " . TF::WHITE . $z . TF::GRAY . "z\nMeteors are corrupt ores from lost galaxies\nfilled with mass amounts of legendary loot!" . TF::WHITE . " /help meteors";
        }
        if ($hand->getNamedTag()->getTag("AresGKitFlare")) {

            # world check
            if (!$world->getFolderName() == "world" || !$world->getFolderName() == "TutorialMine") {
                $player->sendMessage(TF::RED . "You can't do that here");
                return;
            }

            # check if meteor already exists
            $name = $x . "_" . $y . "_" . $z;
            if (ServerManager::getInstance()->getData("meteors.$name")) return;

            $willSpawn = true;

            # set type
            $this->type = "Heroic Ares GKit";
            $this->colour = TF::GOLD;
            $this->timer = ServerManager::getInstance()->getData("meteors.$name.timer");
            $this->message = TF::BOLD . $this->colour . "A $this->type Flare has been activated by\n" . $player->getName() . " near: \n" . TF::RESET . TF::WHITE . $x . TF::GRAY . "x, " . TF::WHITE . $y . TF::GRAY . "y, " . TF::WHITE . $z . TF::GRAY . "z\nMeteors are corrupt ores from lost galaxies\nfilled with mass amounts of legendary loot!" . TF::WHITE . " /help meteors";
        }
        if ($hand->getNamedTag()->getTag("GrimReaperGKitFlare")) {

            # world check
            if (!$world->getFolderName() == "world" || !$world->getFolderName() == "TutorialMine") {
                $player->sendMessage(TF::RED . "You can't do that here");
                return;
            }

            # check if meteor already exists
            $name = $x . "_" . $y . "_" . $z;
            if (ServerManager::getInstance()->getData("meteors.$name")) return;

            $willSpawn = true;

            # set type
            $this->type = "Heroic Grim Reaper GKit";
            $this->colour = TF::RED;
            $this->timer = ServerManager::getInstance()->getData("meteors.$name.timer");
            $this->message = TF::BOLD . $this->colour . "A $this->type Flare has been activated by\n" . $player->getName() . " near: \n" . TF::RESET . TF::WHITE . $x . TF::GRAY . "x, " . TF::WHITE . $y . TF::GRAY . "y, " . TF::WHITE . $z . TF::GRAY . "z\nMeteors are corrupt ores from lost galaxies\nfilled with mass amounts of legendary loot!" . TF::WHITE . " /help meteors";
        }
        if ($hand->getNamedTag()->getTag("ExecutionerGKitFlare")) {

            # world check
            if (!$world->getFolderName() == "world" || !$world->getFolderName() == "TutorialMine") {
                $player->sendMessage(TF::RED . "You can't do that here");
                return;
            }
            # position check

            # check if meteor already exists
            $name = $x . "_" . $y . "_" . $z;
            if (ServerManager::getInstance()->getData("meteors.$name")) return;

            $willSpawn = true;

            # set type
            $this->type = "Heroic Executioner GKit";
            $this->colour = TF::DARK_RED;
            $this->timer = ServerManager::getInstance()->getData("meteors.$name.timer");
            $this->message = TF::BOLD . $this->colour . "A $this->type Flare has been activated by\n" . $player->getName() . " near: \n" . TF::RESET . TF::WHITE . $x . TF::GRAY . "x, " . TF::WHITE . $y . TF::GRAY . "y, " . TF::WHITE . $z . TF::GRAY . "z\nMeteors are corrupt ores from lost galaxies\nfilled with mass amounts of legendary loot!" . TF::WHITE . " /help meteors";
        }

        # gkit flares
        if ($hand->getNamedTag()->getTag("BlacksmithGKitFlare")) {

            # world check
            if (!$world->getFolderName() == "world" || !$world->getFolderName() == "TutorialMine") {
                $player->sendMessage(TF::RED . "You can't do that here");
                return;
            }

            # check if meteor already exists
            $name = $x . "_" . $y . "_" . $z;
            if (ServerManager::getInstance()->getData("meteors.$name")) return;

            $willSpawn = true;

            # set type
            $this->type = "Blacksmith GKit";
            $this->colour = TF::DARK_GRAY;
            $this->timer = ServerManager::getInstance()->getData("meteors.$name.timer");
            $this->message = TF::BOLD . $this->colour . "A $this->type Flare has been activated by\n" . $player->getName() . " near: \n" . TF::RESET . TF::WHITE . $x . TF::GRAY . "x, " . TF::WHITE . $y . TF::GRAY . "y, " . TF::WHITE . $z . TF::GRAY . "z\nMeteors are corrupt ores from lost galaxies\nfilled with mass amounts of legendary loot!" . TF::WHITE . " /help meteors";
        }
        if ($hand->getNamedTag()->getTag("HeroGKitFlare")) {

            # world check
            if (!$world->getFolderName() == "world" || !$world->getFolderName() == "TutorialMine") {
                $player->sendMessage(TF::RED . "You can't do that here");
                return;
            }

            # check if meteor already exists
            $name = $x . "_" . $y . "_" . $z;
            if (ServerManager::getInstance()->getData("meteors.$name")) return;

            $willSpawn = true;

            # set type
            $this->type = "Hero GKit";
            $this->colour = TF::WHITE;
            $this->timer = ServerManager::getInstance()->getData("meteors.$name.timer");
            $this->message = TF::BOLD . $this->colour . "A $this->type Flare has been activated by\n" . $player->getName() . " near: \n" . TF::RESET . TF::WHITE . $x . TF::GRAY . "x, " . TF::WHITE . $y . TF::GRAY . "y, " . TF::WHITE . $z . TF::GRAY . "z\nMeteors are corrupt ores from lost galaxies\nfilled with mass amounts of legendary loot!" . TF::WHITE . " /help meteors";
        }
        if ($hand->getNamedTag()->getTag("CyborgGKitFlare")) {

            # world check
            if (!$world->getFolderName() == "world" || !$world->getFolderName() == "TutorialMine") {
                $player->sendMessage(TF::RED . "You can't do that here");
                return;
            }

            # check if meteor already exists
            $name = $x . "_" . $y . "_" . $z;
            if (ServerManager::getInstance()->getData("meteors.$name")) return;

            $willSpawn = true;

            # set type
            $this->type = "Cyborg GKit";
            $this->colour = TF::DARK_AQUA;
            $this->timer = ServerManager::getInstance()->getData("meteors.$name.timer");
            $this->message = TF::BOLD . $this->colour . "A $this->type Flare has been activated by\n" . $player->getName() . " near: \n" . TF::RESET . TF::WHITE . $x . TF::GRAY . "x, " . TF::WHITE . $y . TF::GRAY . "y, " . TF::WHITE . $z . TF::GRAY . "z\nMeteors are corrupt ores from lost galaxies\nfilled with mass amounts of legendary loot!" . TF::WHITE . " /help meteors";
        }
        if ($hand->getNamedTag()->getTag("CrucibleGKitFlare")) {

            # world check
            if (!$world->getFolderName() == "world" || !$world->getFolderName() == "TutorialMine") {
                $player->sendMessage(TF::RED . "You can't do that here");
                return;
            }

            # check if meteor already exists
            $name = $x . "_" . $y . "_" . $z;
            if (ServerManager::getInstance()->getData("meteors.$name")) return;

            $willSpawn = true;

            # set type
            $this->type = "Crucible GKit";
            $this->colour = TF::YELLOW;
            $this->timer = ServerManager::getInstance()->getData("meteors.$name.timer");
            $this->message = TF::BOLD . $this->colour . "A $this->type Flare has been activated by\n" . $player->getName() . " near: \n" . TF::RESET . TF::WHITE . $x . TF::GRAY . "x, " . TF::WHITE . $y . TF::GRAY . "y, " . TF::WHITE . $z . TF::GRAY . "z\nMeteors are corrupt ores from lost galaxies\nfilled with mass amounts of legendary loot!" . TF::WHITE . " /help meteors";
        }
        if ($hand->getNamedTag()->getTag("HunterGKitFlare")) {

            # world check
            if (!$world->getFolderName() == "world" || !$world->getFolderName() == "TutorialMine") {
                $player->sendMessage(TF::RED . "You can't do that here");
                return;
            }

            # check if meteor already exists
            $name = $x . "_" . $y . "_" . $z;
            if (ServerManager::getInstance()->getData("meteors.$name")) return;

            $willSpawn = true;

            # set type
            $this->type = "Hunter GKit";
            $this->colour = TF::AQUA;
            $this->timer = ServerManager::getInstance()->getData("meteors.$name.timer");
            $this->message = TF::BOLD . $this->colour . "A $this->type Flare has been activated by\n" . $player->getName() . " near: \n" . TF::RESET . TF::WHITE . $x . TF::GRAY . "x, " . TF::WHITE . $y . TF::GRAY . "y, " . TF::WHITE . $z . TF::GRAY . "z\nMeteors are corrupt ores from lost galaxies\nfilled with mass amounts of legendary loot!" . TF::WHITE . " /help meteors";
        }

        if ($willSpawn) {

            # area check
            if (!is_null($areas)) {
                foreach ($areas as $area) {
                    if ($area->getName() === "Spawn") {
                        $event->cancel();
                        $player->sendMessage(Variables::PREFIX . TF::RED . "leave spawn to activate the flare");
                        return;
                    }
                }
            }

            # remove flare from stack
            $hand->setCount($count - 1);
            $player->getInventory()->setItemInHand($hand);
            $player->broadcastSound(new ExplodeSound(), [$player]);

            # broadcast message
            EmporiumPrison::getInstance()->getServer()->broadcastMessage($this->message);

            # create item entity
            $itemEntity = new ItemEntity(new Location($x + 0.5, $y + 2, $z + 0.5, $world, 0, 0), VanillaBlocks::REDSTONE_TORCH()->asItem());
            $itemEntity->setNameTag($this->colour . "$this->type Meteor Flare\n\nArriving in: " . $this->timer . "s");
            $itemEntity->setNameTagAlwaysVisible();
            $itemEntity->setPickupDelay(-1);
            $itemEntity->setHasGravity(false);
            $itemEntity->spawnToAll();

            EmporiumPrison::getInstance()->getScheduler()->scheduleRepeatingTask(new MeteorFlareEntityTask($player, $itemEntity, $this->colour, $this->type), 20);
            $x = $block->getPosition()->getX() + (mt_rand(1, 80) - 40);
            $z = $block->getPosition()->getZ() + (mt_rand(1, 80) - 40);
            $rx = (($block->getPosition()->getX() - $x) / 30) / 20;
            $rz = (($block->getPosition()->getZ() - $z) / 30) / 20;

            # create fireball
            $entity = new Fireball(new Location($x, $block->getPosition()->getY() + 900, $z, $block->getPosition()->getWorld(), 0, 0), null);
            $entity->setMotion(new Vector3($rx, -1.5, $rz));
            $entity->setHasGravity(false);
            $entity->setOnFire(999);
            $entity->type = $this->type;
            $entity->spawnToAll();
        }
    }

    public function onEntityExplosionEvent(EntityExplodeEvent $event): void
    {
        if (!($entity = $event->getEntity()) instanceof Fireball) return;

        foreach ($event->getBlockList() as $block) {
            $fallingBlockEntity = new FallingBlockEntity(new Location($event->getPosition()->getX(), $block->getPosition()->getY() + 2.5, $event->getPosition()->getZ(), $block->getPosition()->getWorld(), 0, 0), $block);
            $fallingBlockEntity->setMaxHealth(255);
            $fallingBlockEntity->setMotion(new Vector3((mt_rand(1, 30) - 15) / 10, ($event->getYield() + ((mt_rand(1, 90) - 45) / 10)) / 20, (mt_rand(1, 30) - 15) / 10));
            $fallingBlockEntity->spawnToAll();
            // $block->getPosition()->getWorld()->setBlock($block->getPosition()->asVector3(), VanillaBlocks::AIR());

            if ($block->getPosition()->getWorld()->getBlock($block->getPosition()->up())->getTypeId() == BlockTypeIds::AIR && mt_rand(1, 66) > 25) {
                $block->getPosition()->getWorld()->setBlock($block->getPosition()->up(), VanillaBlocks::FIRE());
            }
        }

        $event->setBlockList([]);

        if ($event->getPosition()->getWorld()->getBlock($event->getPosition())->getTypeId() == BlockTypeIds::AIR || $event->getPosition()->getWorld()->getBlock($event->getPosition())->getTypeId() == BlockTypeIds::FIRE) {
            $name = $event->getPosition()->floor()->getX() . "_" . (int)$event->getPosition()->floor()->getY() . "_" . (int)$event->getPosition()->floor()->getZ();
            $event->getPosition()->getWorld()->setBlock($event->getPosition()->floor(), VanillaBlocks::NETHER_QUARTZ_ORE());
        } else {
            $name = $event->getPosition()->floor()->getX() . "_" . (int)$event->getPosition()->floor()->up()->getY() . "_" . (int)$event->getPosition()->floor()->getZ();
            $event->getPosition()->getWorld()->setBlock($event->getPosition()->up()->floor(), VanillaBlocks::NETHER_QUARTZ_ORE());
        }


        ServerManager::getInstance()->setData("meteors.$name.breaks-left", 50);
        if(isset($this->type)) {
            ServerManager::getInstance()->setData("meteors.$name.rarity", $this->type);
        }

        foreach (Server::getInstance()->getOnlinePlayers() as $player) {
            $rotationIntensity = (1 - ($event->getPosition()->distance($player->getPosition()) / 12)) * 0.7;

            if ($rotationIntensity > 0) $this->cameraShake($player, $rotationIntensity);
        }

        $event->cancel();

        $event->getPosition()->getWorld()->addParticle($event->getPosition(), new HugeExplodeParticle());
        $event->getPosition()->getWorld()->addSound($event->getPosition(), new ExplodeSound());

    }

    private function cameraShake(Player $player, float $intensity): void
    {
        $pk = CameraShakePacket::create($intensity, 0.5, CameraShakePacket::TYPE_ROTATIONAL, CameraShakePacket::ACTION_ADD);
        $player->getNetworkSession()->sendDataPacket($pk);
    }
}