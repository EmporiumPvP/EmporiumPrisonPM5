<?php

namespace Tetro\EPTutorial;

use DialogueUIAPI\Yanoox\DialogueUIAPI\DialogueAPI;
use pocketmine\plugin\PluginBase;
use Tetro\EPTutorial\Listeners\TutorialWorldListener;
use Tetro\EPTutorial\Managers\TutorialManager;

class Loader extends PluginBase {

    private static Loader $instance;
    private static TutorialManager $tutorialManager;

    public function onLoad(): void {
        self::$tutorialManager = new TutorialManager();
    }

    public function onEnable(): void {

        self::$instance = $this;
        # register listener
        $this->getServer()->getPluginManager()->registerEvents(new TutorialWorldListener(), $this);
        # load tutorial world
        $this->getServer()->getWorldManager()->loadWorld("TutorialMine");
        $tutorialMine = $this->getServer()->getWorldManager()->getWorldByName("TutorialMine");
        $tutorialMine->setTime(13000);
        $tutorialMine->stopTime();

        DialogueAPI::register($this);
    }

    public static function getInstance(): Loader {
        return self::$instance;
    }

    public static function getTutorialManager(): TutorialManager {
        return self::$tutorialManager;
    }

}