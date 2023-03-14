<?php

namespace Emporium\Prison\Managers;

use Emporium\Prison\EmporiumPrison;
use Emporium\Prison\items\Boosters;
use Emporium\Prison\items\Flares;
use Emporium\Wormhole\Utils\FireworksParticle;
use Items\Contraband;

use JsonException;

use EmporiumData\DataManager;

use pocketmine\entity\Location;
use pocketmine\entity\object\ItemEntity;
use pocketmine\event\Listener;
use pocketmine\item\VanillaItems;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\scheduler\ClosureTask;
use pocketmine\utils\TextFormat;
use pocketmine\world\sound\XpLevelUpSound;

use Tetro\EPTutorial\Managers\TutorialManager;

class PlayerLevelManager implements Listener {
    private ?ItemEntity $playerPickaxe;

    public function getPlayerLevel(Player $player): int {
        return DataManager::getInstance()->getPlayerData($player->getXuid(), "level");
    }

    public function getPlayerXp(Player $player): int {
        return DataManager::getInstance()->getPlayerData($player->getXuid(), "xp");
    }

    public function getTotalPlayerXp(Player $player): int {
        return DataManager::getInstance()->getPlayerData($player->getXuid(), "total-xp");
    }

    public function getNextPlayerLevelXp(Player $player): int {
        $playerLevel = $this->getPlayerLevel($player);

        return EmporiumPrison::getInstance()->getPlayerLevelXpData()[$playerLevel] + 1;
    }


    public function createItemEntity (Player $player): void
    {
        $position = $this->calculateRelativePosition($player);

        $itemEntity = new ItemEntity(Location::fromObject($position, $player->getLocation()->getWorld(), lcg_value() * 360, 0), VanillaItems::DIAMOND_PICKAXE());
        $itemEntity->setHasGravity(false);
        $itemEntity->setPickupDelay(-1);
        $itemEntity->setDespawnDelay(80);
        $itemEntity->setNameTag(TextFormat::BOLD . TextFormat::RED . "PICKAXE LEVEL UP");
        $itemEntity->setNameTagAlwaysVisible();

        $playerPickaxe = $itemEntity;
        $playerPickaxe->spawnTo($player);
    }

    /**
     * @param Player $player
     * @return Vector3
     */
    private function calculateRelativePosition(Player $player): Vector3{
        $position = $player->getPosition()->asVector3();
        $direction = $player->getDirectionVector();
        $subtract = $direction->multiply(0.75);
        $position = $position->add($subtract->getX(), $subtract->getY(), $subtract->getZ());
        $position->y += ($player->getEyeHeight() + -0);
        return $position;
    }

    public function removeItemEntity()
    {
        $this->playerPickaxe->close();
        $this->playerPickaxe = null;
    }


    /**
     * @throws JsonException
     */
    public function checkPlayerLevelUp(Player $player): void {
        $playerXp = $this->getPlayerXp($player);
        $nextPlayerLevelXp = $this->getNextPlayerLevelXp($player);

        if($playerXp < $nextPlayerLevelXp) {
            return;
        } else {
            $this->playerLevelUp($player);
        }
    }

    /**
     * @throws JsonException
     */
    public function playerLevelUp(Player $player): void {
        # 100
        if($this->getPlayerLevel($player) === 100) {
            return;
        } else {
            # update player Data
            DataManager::getInstance()->setPlayerData($player->getXuid(), "level", DataManager::getInstance()->getPlayerData($player->getXuid(), "level") + 1);
            DataManager::getInstance()->setPlayerData($player->getXuid(), "xp", 0);
            # send title
            $newPlayerLevel = $this->getPlayerLevel($player);
            $player->broadcastSound(new XpLevelUpSound(30));
            # send particles
            FireworksParticle::Fireworks3($player);
            # give rewards
            switch($newPlayerLevel) {
                    # energy booster
                case 12:
                case 17:
                case 22:
                case 27:
                case 32:
                case 37:
                case 42:
                case 47:
                case 52:
                case 57:
                case 62:
                case 67:
                case 72:
                case 77:
                case 82:
                case 87:
                case 92:
                case 97:
                    if($player->getInventory()->canAddItem((new Boosters())->MysteryEnergyBooster())) {
                        $player->getInventory()->addItem((new Boosters())->MysteryEnergyBooster());
                    } else {
                        $player->getWorld()->dropItem($player->getPosition(), (new Boosters())->MysteryEnergyBooster());
                    }
                    break;
                    # mining booster
                case 18:
                case 23:
                case 28:
                case 33:
                case 38:
                case 43:
                case 48:
                case 53:
                case 58:
                case 63:
                case 68:
                case 73:
                case 78:
                case 83:
                case 88:
                case 93:
                case 98:
                    if($player->getInventory()->canAddItem((new Boosters())->MysteryMiningXpBooster())) {
                        $player->getInventory()->addItem((new Boosters())->MysteryMiningXpBooster());
                    } else {
                        $player->getWorld()->dropItem($player->getPosition(), (new Boosters())->MysteryMiningXpBooster());
                    }
                    break;
                    # contraband
                case 15:
                case 20:
                case 25:
                    if($player->getInventory()->canAddItem((new Contraband())->Elite(1))) {
                        $player->getInventory()->addItem((new Contraband())->Elite(1));
                    } else {
                        $player->getWorld()->dropItem($player->getPosition(), (new Contraband())->Elite(1));
                    }
                    break;
                case 30:
                    if($player->getInventory()->canAddItem((new Contraband())->Ultimate(1))) {
                        $player->getInventory()->addItem((new Contraband())->Ultimate(1));
                    } else {
                        $player->getWorld()->dropItem($player->getPosition(), (new Contraband())->Ultimate(1));
                    }
                    if($player->getInventory()->canAddItem((new Flares())->MysteryGKit())) {
                        $player->getInventory()->addItem((new Flares())->MysteryGKit());
                    } else {
                        $player->getWorld()->dropItem($player->getPosition(), (new Flares())->MysteryGKit());
                    }
                    break;
                case 35:
                case 40:
                case 45:
                    if($player->getInventory()->canAddItem((new Contraband())->Ultimate(1))) {
                        $player->getInventory()->addItem((new Contraband())->Ultimate(1));
                    } else {
                        $player->getWorld()->dropItem($player->getPosition(), (new Contraband())->Ultimate(1));
                    }
                    break;

                case 60:
                    if($player->getInventory()->canAddItem((new Contraband())->Legendary(1))) {
                        $player->getInventory()->addItem((new Contraband())->Legendary(1));
                    } else {
                        $player->getWorld()->dropItem($player->getPosition(), (new Contraband())->Legendary(1));
                    }
                    if($player->getInventory()->canAddItem((new Flares())->MysteryGKit())) {
                        $player->getInventory()->addItem((new Flares())->MysteryGKit());
                    } else {
                        $player->getWorld()->dropItem($player->getPosition(), (new Contraband())->Legendary(1));
                    }
                    break;

                case 50:
                case 55:
                case 65:
                    if($player->getInventory()->canAddItem((new Contraband())->Legendary(1))) {
                        $player->getInventory()->addItem((new Contraband())->Legendary(1));
                    } else {
                        $player->getWorld()->dropItem($player->getPosition(), (new Contraband())->Legendary(1));
                    }
                    break;

                case 70:
                case 75:
                case 80:
                case 85:
                    if($player->getInventory()->canAddItem((new Contraband())->Godly(1))) {
                        $player->getInventory()->addItem((new Contraband())->Godly(1));
                    } else {
                        $player->getWorld()->dropItem($player->getPosition(), (new Contraband())->Godly(1));
                    }
                    break;

                case 90:
                    if($player->getInventory()->canAddItem((new Flares())->MysteryGKit())) {
                        $player->getInventory()->addItem((new Flares())->MysteryGKit());
                    } else {
                        $player->getWorld()->dropItem($player->getPosition(), (new Flares())->MysteryGKit());
                    }
                    if($player->getInventory()->canAddItem((new Contraband())->Heroic(1))) {
                        $player->getInventory()->addItem((new Contraband())->Heroic(1));
                    } else {
                        $player->getWorld()->dropItem($player->getPosition(), (new Contraband())->Heroic(1));
                    }
                    break;

                case 95:
                case 100:
                    if($player->getInventory()->canAddItem((new Contraband())->Heroic(1))) {
                        $player->getInventory()->addItem((new Contraband())->Heroic(1));
                    } else {
                        $player->getWorld()->dropItem($player->getPosition(), (new Contraband())->Heroic(1));
                    }
                    break;
            }
        }
        // Can you create a new task in the tasks folder called LevelUpTask

        $this->createItemEntity($player);
        EmporiumPrison::getInstance()->getScheduler()->scheduleDelayedTask(new ClosureTask(function () {
            $this->removeItemEntity();
        }), 100);

        # if player level >= 10 and tutorial is not complete set to complete
        $tutorialProgress = DataManager::getInstance()->getPlayerData($player->getXuid(), "tutorial-progress");
        $tutorialComplete = DataManager::getInstance()->getPlayerData($player->getXuid(), "tutorial-complete");
        if ($this->getPlayerLevel($player) === 10 && $tutorialProgress === 4 && $tutorialComplete === false) {
            DataManager::getInstance()->setPlayerData($player->getXuid(),"tutorial-progress", DataManager::getInstance()->getPlayerData($player->getXuid(), "tutorial-progress") + 1);
            DataManager::getInstance()->setPlayerData($player->getXuid(),"tutorial-complete", true);
            $tutorialManager = new TutorialManager();
            $tutorialManager->startTutorial($player);
        }
    }

}