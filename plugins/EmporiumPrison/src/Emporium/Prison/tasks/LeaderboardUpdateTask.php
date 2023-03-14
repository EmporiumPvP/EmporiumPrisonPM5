<?php

namespace Emporium\Prison\tasks;

use Emporium\Prison\Managers\LeaderboardManager;

use pocketmine\scheduler\Task;

class LeaderboardUpdateTask extends Task {

    public function onRun(): void {
        LeaderboardManager::update();
    }

}