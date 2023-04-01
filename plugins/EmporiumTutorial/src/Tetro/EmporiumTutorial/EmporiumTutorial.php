<?php

namespace Tetro\EmporiumTutorial;

use DialogueUIAPI\Yanoox\DialogueUIAPI\DialogueAPI;

use pocketmine\plugin\PluginBase;

use Tetro\EmporiumTutorial\Listeners\TutorialWorldListener;
use Tetro\EmporiumTutorial\Managers\TutorialManager;

class EmporiumTutorial extends PluginBase {

    private static EmporiumTutorial $instance;

    private TutorialManager $tutorialManager;

    protected function onLoad(): void
    {
        $this->tutorialManager = new TutorialManager();
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

    public static function getInstance(): EmporiumTutorial {
        return self::$instance;
    }

    /**
     * @return TutorialManager
     */
    public function getTutorialManager(): TutorialManager
    {
        return $this->tutorialManager;
    }

}