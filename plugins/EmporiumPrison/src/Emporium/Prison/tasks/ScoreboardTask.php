<?php

namespace Emporium\Prison\tasks;

use Emporium\Prison\EmporiumPrison;
use Emporium\Prison\Managers\LeaderboardManager;
use Emporium\Prison\Managers\misc\ScoreboardManager;
use pocketmine\scheduler\Task;

class ScoreboardTask extends Task {
    # Task Execution
    public function onRun(): void {
        EmporiumPrison::getScoreboardManager()->scoreboard();
    }
}