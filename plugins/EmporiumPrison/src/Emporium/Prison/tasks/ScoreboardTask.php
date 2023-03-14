<?php

namespace Emporium\Prison\tasks;

use Emporium\Prison\EmporiumPrison;
use Emporium\Prison\Managers\misc\ScoreboardManager;
use pocketmine\scheduler\Task;

class ScoreboardTask extends Task {

    # Task Constructor
    private ScoreboardManager $ScoreboardManager;

    public function __construct(EmporiumPrison $plugin) {
        $this->ScoreboardManager = new ScoreboardManager($plugin);
    }

    # Task Execution
    public function onRun(): void {
        $this->ScoreboardManager->scoreboard();
    }
}