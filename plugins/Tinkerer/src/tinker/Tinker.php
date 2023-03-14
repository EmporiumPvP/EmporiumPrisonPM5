<?php

namespace Tinker;


use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;

use tinker\commands\TinkerCommand;

class Tinker extends PluginBase implements Listener {

    public function onEnable(): void {
        $this->registerEvents();
    }

    public function registerEvents() {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);

        $this->getServer()->getCommandMap()->register("tinker", new TinkerCommand());
    }
}