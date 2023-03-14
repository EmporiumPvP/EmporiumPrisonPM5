<?php

namespace EmporiumCore\Tasks\Utils;

use Emporium\Wormhole\Utils\FireworksParticle;
use pocketmine\player\Player;
use pocketmine\scheduler\Task;

class DelayedFireworks extends Task {

    private Player $player;

    public function __construct(Player $player) {
        $this->player = $player;
    }

    public function onRun(): void {
        FireworksParticle::Fireworks3($this->player);
    }
}