<?php

namespace Tetro\EPTutorial\Listeners;

use DialogueUIAPI\Yanoox\DialogueUIAPI\DialogueAPI;
use DialogueUIAPI\Yanoox\DialogueUIAPI\element\DialogueButton;

use Emporium\Prison\EmporiumPrison;
use Emporium\Prison\Managers\DataManager;
use Emporium\Prison\Managers\EnergyManager;
use Emporium\Prison\Managers\MiningManager;
use Emporium\Prison\Managers\PickaxeManager;
use Emporium\Prison\Managers\PlayerLevelManager;
use Emporium\Prison\tasks\BedrockSpawnTask;
use Emporium\Prison\tasks\Ores\CoalBlockSpawnTask;
use Emporium\Prison\tasks\Ores\OreRegenTask;
use Emporium\Prison\Variables;
use Emporium\Wormhole\Menus\Menu;
use JsonException;
use pocketmine\block\BlockLegacyIds;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDropItemEvent;
use pocketmine\item\ItemIds;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;
use pocketmine\world\sound\EndermanTeleportSound;
use pocketmine\world\sound\XpLevelUpSound;
use Tetro\EPTutorial\Loader;
use Tetro\EPTutorial\Managers\TutorialManager;

class TutorialWorldListener implements Listener {

    private array $buildProtectedWorlds = ["world", "TutorialMine"];
    private array $pvpProtectedWorlds = ["world", "TutorialMine"];
    private array $fallDamageProtectedWorlds = ["world", "TutorialMine"];

    private array $ores = [
        BlockLegacyIds::COAL_ORE,
        BlockLegacyIds::COAL_BLOCK
    ];
    private PickaxeManager $pickaxeManager;
    private TutorialManager $tutorialManager;
    private EnergyManager $energyManager;
    private MiningManager $miningManager;
    private PlayerLevelManager $playerLevelManager;

    public function __construct() {
        # Managers
        $this->pickaxeManager = EmporiumPrison::getPickaxeManager();
        $this->tutorialManager = Loader::getTutorialManager();
        $this->energyManager = EmporiumPrison::getEnergyManager();
        $this->miningManager = EmporiumPrison::getMiningManager();
        $this->playerLevelManager = EmporiumPrison::getPlayerLevelManager();
    }

    public function onDropItem(PlayerDropItemEvent $event) {

        $player = $event->getPlayer();
        $item = $event->getItem();
        $hand = $item->getId();
        $pickaxeManager = new PickaxeManager();
        $playerX = $player->getPosition()->getX();
        $playerY = $player->getPosition()->getY();
        $playerZ = $player->getPosition()->getZ();

        $world = $player->getWorld()->getFolderName();
        if($world === "TutorialMine") {
            # player is in wormhole range
            if($playerX >= -25 && $playerX <= -5 && $playerY >= 145 && $playerY <= 153 && $playerZ >= 5 && $playerZ <= 25) {
                if($hand === ItemIds::WOODEN_PICKAXE || $hand === ItemIds::STONE_PICKAXE || $hand === ItemIds::GOLDEN_PICKAXE || $hand === ItemIds::IRON_PICKAXE || $hand === ItemIds::DIAMOND_PICKAXE) {
                    if($item->getNamedTag()->getTag("Level") !== null) {
                        $level = $item->getNamedTag()->getInt("Level");
                        if($level >= 100) {
                            # pickaxe is max level
                            $event->cancel();
                            $player->sendMessage(TF::RED . "You need to prestige your pickaxe to do this");
                        } else {
                            $energy = $item->getNamedTag()->getInt("Energy");
                            $energyNeeded = $pickaxeManager->getEnergyNeeded($item);
                            if ($energy >= $energyNeeded) {
                                # pickaxe is ready to level up
                                $event->cancel();
                                # play sound to player
                                $player->broadcastSound(new EndermanTeleportSound(), [$player]);
                                # remove energy from pickaxe
                                $pickaxeManager->removeLevelUpEnergy($player, $item);
                                # send inventory
                                $menu = new Menu();
                                $menu->Inventory($player, $item);
                            } else {
                                # pickaxe is not ready to level up
                                $player->broadcastSound(new XpLevelUpSound(30));
                                $player->sendMessage(TF::RED . "You need more energy to Enchant!");
                                $event->cancel();
                            }
                        }
                    } else {
                        $player->broadcastSound(new XpLevelUpSound(30));
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::RED . "That is not a valid pickaxe");
                        $event->cancel();
                    } # not a valid pickaxe
                } else {
                    $player->sendMessage(Variables::ERROR_PREFIX . TF::GREEN . "You need to be holding the Pickaxe you want to enchant");
                    $event->cancel();
                } # player not holding a pickaxe
            } # not in wormhole range
        } # not "TutorialMine"
    }

    /**
     * @throws JsonException
     */
    public function onBlockBreak(BlockBreakEvent $event) {

        # event info
        $player = $event->getPlayer();
        $blockId = $event->getBlock()->getIdInfo()->getBlockId();
        $world = $event->getPlayer()->getWorld()->getFolderName();
        # item info
        $item = $event->getPlayer()->getInventory()->getItemInHand();
        $itemId = $item->getId();
        $woodenPickaxe = 270;
        # variables
        $tutorialProgress = $this->tutorialManager->getPlayerTutorialProgress($player);
        $tutorialBlocksMined = $this->tutorialManager->getPlayerTutorialBlocksMined($player);

        if($world === "TutorialMine") {

            if(!in_array($blockId, $this->ores)) {
                $event->cancel();
            }
            if($tutorialProgress === 5 && $this->playerLevelManager->getPlayerLevel($player) >= 10) {
                DataManager::addData($player, "Players", "tutorial-progress", 1);
                $this->tutorialManager->startTutorial($player);
            }
            if($tutorialProgress === 6 && $this->tutorialManager->tutorialComplete($player) === false) {
                DataManager::setData($player, "Players", "tutorial-complete", true);
                $this->tutorialManager->startTutorial($player);
            }
            if($tutorialProgress === 6 && $this->tutorialManager->tutorialComplete($player) === true) {
                $event->cancel();
                $this->tutorialManager->startTutorial($player);
            }
            if($itemId === 270 || $itemId === 274 || $itemId === 285 || $itemId === 257 || $itemId === 278) {
                $energy = $item->getNamedTag()->getInt("Energy");
                $energyNeeded = $this->pickaxeManager->getEnergyNeeded($item);
                if($energy >= $energyNeeded) {
                    if($tutorialProgress == 3) {
                        DataManager::addData($player, "Players", "tutorial-progress", 1);
                        $this->tutorialManager->startTutorial($player);
                        $event->cancel();
                    } else {
                        $event->cancel();
                        $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "Your pickaxe is full of energy");
                        $player->sendMessage(TF::GRAY . "You must get the Wormhole to Forge your pickaxe! He can be found near " . TF::AQUA . "/spawn");
                        $player->sendMessage(TF::GRAY . "This will level up your pickaxe, and give you the chance to gain or upgrade an Enchant.");
                    }
                } else {
                    DataManager::addData($player, "Players", "tutorial-blocks-mined", 1);
                    # ore regen

                    # block info
                    $block = $event->getBlock();
                    $blockId = $event->getBlock()->getIdInfo()->getBlockId();
                    $blockPosition = $block->getPosition();
                    # boosters
                    $energyBoosterTime = $this->energyManager->getTime($player);
                    $energyMultiplier = $this->energyManager->getMultiplier($player);
                    $miningBoosterTime = $this->miningManager->getTime($player);
                    $miningMultiplier = $this->miningManager->getMultiplier($player);

                    switch($blockId) {

                        case BlockLegacyIds::COAL_ORE: # (wooden pickaxe required)

                            if(!$itemId == $woodenPickaxe) {
                                $event->cancel();
                                $player->sendMessage(Variables::SERVER_PREFIX . TF::RED . "You can only use a" . TF::GREEN . " Wooden Pickaxe" . TF::RED . " here!");
                                $event->setDrops([]);
                                $event->setXpDropAmount(0);
                            } else {
                                $chance = mt_rand(1, 30);
                                if($chance === 1) {
                                    # spawn coal block
                                    EmporiumPrison::getInstance()->getScheduler()->scheduleDelayedTask(new CoalBlockSpawnTask($block, $blockPosition), 1);
                                } else {
                                    EmporiumPrison::getInstance()->getScheduler()->scheduleDelayedTask(new BedrockSpawnTask($block, $blockPosition), 1);
                                    EmporiumPrison::getInstance()->getScheduler()->scheduleDelayedTask(new OreRegenTask($block, $blockPosition, $blockId), 20 * 30);
                                }
                                # add energy to player
                                $energy = mt_rand(10, 20);
                                if($energyBoosterTime > 0) {
                                    $multipliedEnergy = $energy * $energyMultiplier;
                                    $oldData = $item->getNamedTag()->getInt("Energy");
                                    $newData = $oldData + $multipliedEnergy;
                                    $item->getNamedTag()->setInt("Energy", $newData);
                                } else {
                                    $oldData = $item->getNamedTag()->getInt("Energy");
                                    $newData = $oldData + ($energy * 2);
                                    $item->getNamedTag()->setInt("Energy", $newData);
                                }
                                # add xp to player
                                $xp = 4 * 2;
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
                                DataManager::addData($player, "Players", "coal-ore-mined", 1);
                                $oldData = $item->getNamedTag()->getInt("BlocksMined");
                                $newData = $oldData + 1;
                                $item->getNamedTag()->setInt("BlocksMined", $newData);
                                # auto pickup (block)
                                foreach ($event->getDrops() as $drop) {
                                    if($player->getInventory()->canAddItem($drop)) {
                                        if($event->isCancelled()) {
                                            $event->setDrops([]);
                                            return;
                                        } else {
                                            $event->setDrops([]);
                                            $event->getPlayer()->getInventory()->addItem($drop);
                                        }
                                    } else {
                                        $event->setDrops([]);
                                        $player->sendTitle(TF::DARK_RED . "Inventory Full!");
                                    }
                                }
                                # auto pickup (xp)
                                $player->getXpManager()->addXp($event->getXpDropAmount());
                                $event->setXpDropAmount(0);
                                # player and pickaxe checks
                                $this->pickaxeManager->updatePickaxeSetInHand($player, $item);
                                $this->playerLevelManager->checkPlayerLevelUp($player);
                            }
                            break;

                        case BlockLegacyIds::COAL_BLOCK:

                            if(!$itemId == $woodenPickaxe) {
                                $event->cancel();
                                $player->sendMessage(Variables::SERVER_PREFIX . TF::RED . "You can only use a" . TF::GREEN . " Wooden Pickaxe" . TF::RED . " here!");
                                $event->setDrops([]);
                                $event->setXpDropAmount(0);
                            } else {
                                $chance = mt_rand(1, 30);
                                if($chance === 1) {
                                    # spawn coal block
                                    EmporiumPrison::getInstance()->getScheduler()->scheduleDelayedTask(new CoalBlockSpawnTask($block, $blockPosition), 1);
                                } else {
                                    # spawn bedrock schedule regen
                                    EmporiumPrison::getInstance()->getScheduler()->scheduleDelayedTask(new BedrockSpawnTask($block, $blockPosition), 1);
                                    EmporiumPrison::getInstance()->getScheduler()->scheduleDelayedTask(new OreRegenTask($block, $blockPosition, $blockId), 20 * 60);
                                }
                                # add energy to player
                                $energy = mt_rand(20, 30);
                                if($energyBoosterTime > 0) {
                                    $multipliedEnergy = $energy * $energyMultiplier;
                                    $oldData = $item->getNamedTag()->getInt("Energy");
                                    $newData = $oldData + $multipliedEnergy;
                                    $item->getNamedTag()->setInt("Energy", $newData);
                                } else {
                                    $oldData = $item->getNamedTag()->getInt("Energy");
                                    $newData = $oldData + ($energy * 2);
                                    $item->getNamedTag()->setInt("Energy", $newData);
                                }
                                # add xp to player
                                $xp = 8 * 2;
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
                                DataManager::addData($player, "Players", "coal-ore-mined", 1);
                                $oldData = $item->getNamedTag()->getInt("BlocksMined");
                                $newData = $oldData + 1;
                                $item->getNamedTag()->setInt("BlocksMined", $newData);
                                # auto pickup (block)
                                foreach ($event->getDrops() as $drop) {
                                    if($player->getInventory()->canAddItem($drop)) {
                                        if($event->isCancelled()) {
                                            $event->setDrops([]);
                                            return;
                                        } else {
                                            $event->setDrops([]);
                                            $event->getPlayer()->getInventory()->addItem($drop);
                                        }
                                    } else {
                                        $event->setDrops([]);
                                        $player->sendTitle(TF::DARK_RED . "Inventory Full!");
                                    }
                                }
                                # auto pickup (xp)
                                $player->getXpManager()->addXp($event->getXpDropAmount());
                                $event->setXpDropAmount(0);
                                # player and pickaxe checks
                                $this->pickaxeManager->updatePickaxeSetInHand($player, $item);
                                $this->playerLevelManager->checkPlayerLevelUp($player);
                            }
                            break;
                    }
                }

                # tutorial progress 1 messages
                if($tutorialProgress === 1) {
                    switch($tutorialBlocksMined) {

                        case 0:
                            $dialogue = DialogueAPI::create(
                                "TourGuideProgressMessage1",
                                "Tour Guide",
                                "Congrats, you have mined your first ore!" . TF::EOL . TF::EOL .
                                        "When you mine an Ore, you gain XP and Energy, XP goes towards your Player Level, and Energy goes towards your Pickaxe." . TF::EOL . TF::EOL .
                                        "Ores also regenerate when you mine them, and they have a chance to instantly regenerate into their Block form" . TF::EOL . TF::EOL .
                                        "For more information on Player Levels and Energy run /help",
                                [DialogueButton::create("Next")
                                    ->setHandler(function (Player $player, string $buttonName): void {
                                        return;
                                    })]);
                            $dialogue->displayTo([$player]);
                            break;

                        case 15:
                            $dialogue = DialogueAPI::create(
                                "TourGuideProgressMessage2",
                                "Tour Guide",
                                "Take a look at your pickaxe in your inventory." . " Your pickaxe Level is displayed next to the name, as well your successful and failed Enchants." . TF::EOL . TF::EOL .
                                        "Under that you will see your Energy bar, this is where your pickaxe Energy is stored. Each pickaxe level requires more Energy to Forge. You can extract the energy from your pickaxe by using /extract But you will lose 10% of the energy when doing this" . TF::EOL . TF::EOL .
                                        "Next you will see Blocks Mined, this is how many blocks you have mined in total with that pickaxe." . TF::EOL . TF::EOL .
                                        "Lastly at the bottom of the pickaxe it says Required Mining Level, this is what Level you need to be to use this Pickaxe.",
                                [DialogueButton::create("Next")
                                    ->setHandler(function (Player $player, string $buttonName): void {
                                        return;
                                    })]);
                            $dialogue->displayTo([$player]);
                            break;

                        case 25:
                            $dialogue = DialogueAPI::create(
                                "TourGuideProgressMessage3",
                                "Tour Guide",
                                "You can /prestige your pickaxe when it reaches max Level (100)" . TF::EOL . TF::EOL .
                                "Each time you prestige your pickaxe you unlock new features for that pickaxe" . TF::EOL . TF::EOL .
                                "For more information on pickaxes run /help",
                                [DialogueButton::create("Next")
                                    ->setHandler(function (Player $player, string $buttonName): void {
                                        return;
                                    })]);
                            $dialogue->displayTo([$player]);
                            break;

                        case 35:
                            $dialogue = DialogueAPI::create(
                                "TourGuideProgressMessage4",
                                "Tour Guide",
                            "You found an Elite Clue Scroll!" . TF::EOL . TF::EOL .
                                    "When you mine there is a chance you will find a clue scroll." . TF::EOL . TF::EOL .
                                    "You can complete these clue scrolls to gain rewards, or you can sell them on the auction house (This feature is still under development)" . TF::EOL . TF::EOL .
                                    "Clue scrolls have 5 different rarities:" . TF::EOL .
                                    "Elite" . TF::EOL .
                                    "Ultimate" . TF::EOL .
                                    "Legendary" . TF::EOL .
                                    "Godly" . TF::EOL .
                                    "Heroic" . TF::EOL . TF::EOL .
                                    "The higher the rarity the more difficult the task and better the rewards!" . TF::EOL . TF::EOL .
                                    TF::BOLD . TF::RED . "(!) This feature is still under development",
                                [DialogueButton::create("Next")
                                    ->setHandler(function (Player $player, string $buttonName): void {
                                        return;
                                    })]);
                            $dialogue->displayTo([$player]);
                            break;

                        case 50:
                            $dialogue = DialogueAPI::create(
                                "TourGuideProgressMessage5",
                                "Tour Guide",
                                "/help is a great resource. There are several options to the /help menu. If you need more help, try asking the community in our /discord server or by asking one of our /staff",
                                [DialogueButton::create("Next")
                                    ->setHandler(function (Player $player, string $buttonName): void {
                                        return;
                                    })]);
                            $dialogue->displayTo([$player]);
                            break;

                        case 60:
                            DataManager::addData($player, "Players", "tutorial-progress", 1);
                            $this->tutorialManager->startTutorial($player);
                            break;
                    }

                }
            }
        }

    }

    public function onBlockPlace(BlockPlaceEvent $event) {
        $world = $event->getPlayer()->getWorld()->getFolderName();
        if(in_array($world, $this->buildProtectedWorlds)) {
            $event->cancel();
        }
    }

    public function onAttack(EntityDamageByEntityEvent $event) {

        $entity = $event->getEntity();
        $damager = $event->getDamager();
        $world = $entity->getWorld()->getFolderName();

        if($entity instanceof Player) {
            if($damager instanceof Player) {
                if (in_array($world, $this->pvpProtectedWorlds)) {
                    $event->cancel();
                }
            }
        }
    }

    public function onFallDamage(EntityDamageEvent $event) {

        $entity = $event->getEntity();
        $world = $entity->getWorld()->getFolderName();
        $cause = $event->getCause();

        if($entity instanceof Player) {
            if($cause === EntityDamageEvent::CAUSE_FALL) {
                if(in_array($world, $this->fallDamageProtectedWorlds)) {
                    $event->cancel();
                }
            }
        }
    }

}