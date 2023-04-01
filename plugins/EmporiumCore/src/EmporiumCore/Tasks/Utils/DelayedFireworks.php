<?php

namespace EmporiumCore\Tasks\Utils;

use pocketmine\player\Player;
use pocketmine\scheduler\Task;
use Tetro\EmporiumWormhole\Utils\FireworksParticle;

class DelayedFireworks extends Task {

    private Player $player;

    public function __construct(Player $player) {
        $this->player = $player;
    }

    public function onRun(): void {
        FireworksParticle::Fireworks3($this->player);
    }
}