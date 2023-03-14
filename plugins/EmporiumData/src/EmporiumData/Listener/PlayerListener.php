<?php

namespace EmporiumData\Listener;

use EmporiumData\DataManager;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerLoginEvent;

class PlayerListener implements Listener
{
    public function onPlayerLoginEvent (PlayerLoginEvent $event) : void
    {
        if (DataManager::getInstance()->isNew($event->getPlayer())) DataManager::getInstance()->registerPlayer($event->getPlayer());
    }
}