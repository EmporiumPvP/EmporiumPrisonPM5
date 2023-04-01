<?php

namespace EmporiumData;

use Emporium\Prison\Variables;
use EmporiumCore\EmporiumCore;
use pocketmine\scheduler\Task;
use pocketmine\Server;
use pocketmine\utils\TextFormat;

class AutoSaveTask extends Task
{
    public function onRun(): void
    {
        Server::getInstance()->broadcastMessage(Variables::SERVER_PREFIX . TextFormat::YELLOW . "Auto-saving...");
        Loader::getInstance()->save();
        Server::getInstance()->broadcastMessage(Variables::SERVER_PREFIX . TextFormat::YELLOW . "Save Complete...");
    }
}