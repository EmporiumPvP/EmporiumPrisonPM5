<?php

namespace Tetro\EmporiumWormhole;

use pocketmine\plugin\PluginBase;

use Tetro\EmporiumWormhole\Core\EventListener;
use Tetro\EmporiumWormhole\Menus\Menu;

class EmporiumWormhole extends PluginBase {

    private static EmporiumWormhole $instance;
    private Menu $menu;

    protected function onLoad(): void
    {
        self::$instance = $this;
        $this->menu = new Menu();
    }

    public function onEnable(): void {
        $this->getServer()->getPluginManager()->registerEvents(new EventListener(), $this);
    }


    /**
     * @return EmporiumWormhole
     */
    public static function getInstance(): EmporiumWormhole
    {
        return self::$instance;
    }

    /**
     * @return Menu
     */
    public function getMenu(): Menu
    {
        return $this->menu;
    }
}