<?php

namespace Emporium\Wormhole;

use pocketmine\plugin\PluginBase;

use Emporium\Wormhole\Core\EventListener;

class Wormhole extends PluginBase {

    public function onEnable(): void {
        # Register Files
        $this->getServer()->getPluginManager()->registerEvents(new EventListener(), $this);
    }
}