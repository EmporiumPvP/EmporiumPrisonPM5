<?php

namespace Emporium\Prison\Managers;

use Emporium\Prison\EmporiumPrison;
use Emporium\Prison\items\Contraband;
use EmporiumData\DataManager;
use JsonException;
use pocketmine\entity\Location;
use pocketmine\entity\object\ItemEntity;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\item\VanillaItems;
use pocketmine\math\Vector3;
use pocketmine\network\mcpe\protocol\OnScreenTextureAnimationPacket;
use pocketmine\player\Player;
use pocketmine\scheduler\ClosureTask;
use pocketmine\utils\TextFormat;
use pocketmine\world\sound\XpLevelUpSound;
use Tetro\EmporiumTutorial\Managers\TutorialManager;
use Tetro\EmporiumWormhole\Utils\FireworksParticle;

class PlayerLevelManager implements Listener {
    /** @var ItemEntity[] */
    public array $playerPickaxe = [];

    public function getPlayerLevel(Player $player): int {
        return (int) DataManager::getInstance()->getPlayerData($player->getXuid(),  "profile.level");
    }

    public function getPlayerXp(Player $player): int {
        return (int) DataManager::getInstance()->getPlayerData($player->getXuid(),  "profile.xp");
    }

    public function getTotalPlayerXp(Player $player): int {
        return (int) DataManager::getInstance()->getPlayerData($player->getXuid(),  "profile.total-xp");
    }

    public function getNextPlayerLevelXp(Player $player): int {
        $playerLevel = $this->getPlayerLevel($player);

        return EmporiumPrison::getInstance()->getPlayerLevelXpData()[$playerLevel + 1];
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

    public function playerLevelUp(Player $player): void {
        # 100
        if($this->getPlayerLevel($player) === 100) {
            return;
        } else {
            # update player Data
            DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.level", DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.level") + 1);
            DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.xp", 0);
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
                    if($player->getInventory()->canAddItem(EmporiumPrison::getInstance()->getBoosters()->MysteryEnergyBooster())) {
                        $player->getInventory()->addItem(EmporiumPrison::getInstance()->getBoosters()->MysteryEnergyBooster());
                    } else {
                        $player->getWorld()->dropItem($player->getPosition(), EmporiumPrison::getInstance()->getBoosters()->MysteryEnergyBooster());
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
                    if($player->getInventory()->canAddItem(EmporiumPrison::getInstance()->getBoosters()->MysteryMiningXpBooster())) {
                        $player->getInventory()->addItem(EmporiumPrison::getInstance()->getBoosters()->MysteryMiningXpBooster());
                    } else {
                        $player->getWorld()->dropItem($player->getPosition(), EmporiumPrison::getInstance()->getBoosters()->MysteryMiningXpBooster());
                    }
                    break;
                # contraband
                case 15:
                case 20:
                case 25:
                    if($player->getInventory()->canAddItem(EmporiumPrison::getInstance()->getContraband()->Elite(1))) {
                        $player->getInventory()->addItem(EmporiumPrison::getInstance()->getContraband()->Elite(1));
                    } else {
                        $player->getWorld()->dropItem($player->getPosition(), EmporiumPrison::getInstance()->getContraband()->Elite(1));
                    }
                    break;
                case 30:
                    if($player->getInventory()->canAddItem(EmporiumPrison::getInstance()->getContraband()->Ultimate(1))) {
                        $player->getInventory()->addItem(EmporiumPrison::getInstance()->getContraband()->Ultimate(1));
                    } else {
                        $player->getWorld()->dropItem($player->getPosition(), EmporiumPrison::getInstance()->getContraband()->Ultimate(1));
                    }
                    if($player->getInventory()->canAddItem(EmporiumPrison::getInstance()->getFlares()->MysteryGKit())) {
                        $player->getInventory()->addItem(EmporiumPrison::getInstance()->getFlares()->MysteryGKit());
                    } else {
                        $player->getWorld()->dropItem($player->getPosition(), EmporiumPrison::getInstance()->getFlares()->MysteryGKit());
                    }
                    break;
                case 35:
                case 40:
                case 45:
                    if($player->getInventory()->canAddItem(EmporiumPrison::getInstance()->getContraband()->Ultimate(1))) {
                        $player->getInventory()->addItem(EmporiumPrison::getInstance()->getContraband()->Ultimate(1));
                    } else {
                        $player->getWorld()->dropItem($player->getPosition(), EmporiumPrison::getInstance()->getContraband()->Ultimate(1));
                    }
                    break;

                case 60:
                    if($player->getInventory()->canAddItem(EmporiumPrison::getInstance()->getContraband()->Legendary(1))) {
                        $player->getInventory()->addItem(EmporiumPrison::getInstance()->getContraband()->Legendary(1));
                    } else {
                        $player->getWorld()->dropItem($player->getPosition(), EmporiumPrison::getInstance()->getContraband()->Legendary(1));
                    }
                    if($player->getInventory()->canAddItem(EmporiumPrison::getInstance()->getFlares()->MysteryGKit())) {
                        $player->getInventory()->addItem(EmporiumPrison::getInstance()->getFlares()->MysteryGKit());
                    } else {
                        $player->getWorld()->dropItem($player->getPosition(), EmporiumPrison::getInstance()->getContraband()->Legendary(1));
                    }
                    break;

                case 50:
                case 55:
                case 65:
                    if($player->getInventory()->canAddItem(EmporiumPrison::getInstance()->getContraband()->Legendary(1))) {
                        $player->getInventory()->addItem(EmporiumPrison::getInstance()->getContraband()->Legendary(1));
                    } else {
                        $player->getWorld()->dropItem($player->getPosition(), EmporiumPrison::getInstance()->getContraband()->Legendary(1));
                    }
                    break;

                case 70:
                case 75:
                case 80:
                case 85:
                    if($player->getInventory()->canAddItem(EmporiumPrison::getInstance()->getContraband()->Godly(1))) {
                        $player->getInventory()->addItem(EmporiumPrison::getInstance()->getContraband()->Godly(1));
                    } else {
                        $player->getWorld()->dropItem($player->getPosition(), EmporiumPrison::getInstance()->getContraband()->Godly(1));
                    }
                    break;

                case 90:
                    if($player->getInventory()->canAddItem(EmporiumPrison::getInstance()->getFlares()->MysteryGKit())) {
                        $player->getInventory()->addItem(EmporiumPrison::getInstance()->getFlares()->MysteryGKit());
                    } else {
                        $player->getWorld()->dropItem($player->getPosition(), EmporiumPrison::getInstance()->getFlares()->MysteryGKit());
                    }
                    if($player->getInventory()->canAddItem(EmporiumPrison::getInstance()->getContraband()->Heroic(1))) {
                        $player->getInventory()->addItem(EmporiumPrison::getInstance()->getContraband()->Heroic(1));
                    } else {
                        $player->getWorld()->dropItem($player->getPosition(), EmporiumPrison::getInstance()->getContraband()->Heroic(1));
                    }
                    break;

                case 95:
                case 100:
                    if($player->getInventory()->canAddItem(EmporiumPrison::getInstance()->getContraband()->Heroic(1))) {
                        $player->getInventory()->addItem(EmporiumPrison::getInstance()->getContraband()->Heroic(1));
                    } else {
                        $player->getWorld()->dropItem($player->getPosition(), EmporiumPrison::getInstance()->getContraband()->Heroic(1));
                    }
                    break;
            }
        }

        EmporiumPrison::getInstance()->getPickaxeManager()->levelUpAnimation($player);

        # if player level >= 10 and tutorial is not complete set to complete
        $tutorialProgress = DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.tutorial-progress");
        $tutorialComplete = DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.tutorial-complete");
        if ($this->getPlayerLevel($player) === 10 && $tutorialProgress === 4 && $tutorialComplete === false) {
            DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.tutorial-progress", DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.tutorial-progress") + 1);
            DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.tutorial-complete", true);
            $tutorialManager = new TutorialManager();
            $tutorialManager->startTutorial($player);
        }
    }

    public function prestigePlayer(Player $player): void {
        DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.prestige", DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.prestige") + 1);
        DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.level", 0);
        DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.xp", 0);
    }

}