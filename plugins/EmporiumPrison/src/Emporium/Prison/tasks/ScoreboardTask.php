<?php

namespace Emporium\Prison\tasks;

use Emporium\Prison\EmporiumPrison;

use pocketmine\scheduler\Task;

class ScoreboardTask extends Task {

    public function onRun(): void {
        EmporiumPrison::getInstance()->getScoreboardManager()->scoreboard();
    }
}