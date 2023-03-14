<?php

namespace Tetro\EPTutorial;

use DialogueUIAPI\Yanoox\DialogueUIAPI\DialogueAPI;
use pocketmine\plugin\PluginBase;
use Tetro\EPTutorial\Listeners\TutorialWorldListener;

class Loader extends PluginBase {

    private static Loader $instance;

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

}