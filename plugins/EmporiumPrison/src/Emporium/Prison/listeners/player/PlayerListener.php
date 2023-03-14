<?php

namespace Emporium\Prison\listeners\player;

use Emporium\Prison\EmporiumPrison;
use Emporium\Prison\tasks\NPCUpdateTask;

use pocketmine\event\inventory\CraftItemEvent;
use pocketmine\event\player\PlayerJoinEvent;
use Tetro\EPTutorial\Loader;
use Tetro\EPTutorial\Managers\TutorialManager;

use JsonException;

use pocketmine\event\Listener;

use pocketmine\event\player\PlayerPreLoginEvent;

use pocketmine\utils\Config;

use pocketmine\world\Position;

class PlayerListener implements Listener {

    private array $defaultPlayerData = [
        "level" => 0,
        "xp" => 0,
        "total-xp" => 0,
        "coal-ore-mined" => 0,
        "iron-ore-mined" => 0,
        "redstone-ore-mined" => 0,
        "lapis-ore-mined" => 0,
        "gold-ore-mined" => 0,
        "diamond-ore-mined" => 0,
        "emerald-ore-mined" => 0,
        "tutorial-complete" => false,
        "tutorial-progress" => 0,
        "tutorial-blocks-mined" => 0
    ];

    private array $defaultBoosterData = [
        "mining-booster-active" => false,
        "mining-booster-timer" => 0,
        "mining-booster-multiplier" => 0,
        "energy-booster-active" => false,
        "energy-booster-timer" => 0,
        "energy-booster-multiplier" => 0
    ];
    private TutorialManager $tutorialManager;

    public function __construct() {
        $this->tutorialManager = Loader::getTutorialManager();
    }

    public function onLogin(PlayerPreLoginEvent $event) {

        $player = $event->getPlayerInfo()->getUsername();

        @mkdir(EmporiumPrison::getInstance()->getDataFolder() . "Players/");
        if(!file_exists(EmporiumPrison::getInstance()->getDataFolder() . "Players/" . $player . ".yml")) {
            new Config(EmporiumPrison::getInstance()->getDataFolder() . "Players/" . $player . ".yml", Config::YAML, $this->defaultPlayerData);
        }

        if(!file_exists(EmporiumPrison::getInstance()->getDataFolder() . "Boosters/" . $player . ".yml")) {
            new Config(EmporiumPrison::getInstance()->getDataFolder() . "Boosters/" . $player . ".yml", Config::YAML, $this->defaultBoosterData);
        }
    }
    /**
     * @throws JsonException
     */
    public function onJoin(PlayerJoinEvent $event): void {

        $player = $event->getPlayer();

        # check if player is in tutorial
        $tutorialComplete = $this->tutorialManager->checkPlayerTutorialComplete($player);
        if(!$tutorialComplete) {
            $player->teleport(new Position(-29.5, 154, -2.5, EmporiumPrison::getInstance()->getServer()->getWorldManager()->getWorldByName("TutorialMine")));
            $this->tutorialManager->startTutorial($player);
        }

        # update NPC names
        EmporiumPrison::getInstance()->getScheduler()->scheduleTask(new NPCUpdateTask());
    }
    public function onCraft(CraftItemEvent $event) {
        $event->cancel();
    }
}