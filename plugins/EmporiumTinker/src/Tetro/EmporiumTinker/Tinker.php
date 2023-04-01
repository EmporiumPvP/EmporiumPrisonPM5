<?php

namespace Tetro\EmporiumTinker;


use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use Tetro\EmporiumTinker\commands\TinkerCommand;
use Tetro\EmporiumTinker\menus\TinkerMenu;

class Tinker extends PluginBase implements Listener {

    private static Tinker $instance;
    private TinkerMenu $tinkerMenu;

    protected function onLoad(): void
    {
        $this->tinkerMenu = new TinkerMenu();
    }

    public function onEnable(): void {
        self::$instance = $this;
        $this->registerEvents();
    }

    public function registerEvents() {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);

        $this->getServer()->getCommandMap()->register("tinker", new TinkerCommand());
    }

    /**
     * @return TinkerMenu
     */
    public function getTinkerMenu(): TinkerMenu
    {
        return $this->tinkerMenu;
    }

    /**
     * @return Tinker
     */
    public static function getInstance(): Tinker
    {
        return self::$instance;
    }
}