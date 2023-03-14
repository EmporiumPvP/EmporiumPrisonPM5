<?php

namespace EmporiumCore\Tasks\Utils;

use pocketmine\player\Player;
use pocketmine\scheduler\Task;
use pocketmine\world\sound\Sound;

class DelayedSound extends Task {

    private Player $player;
    private Sound $sound;

    public function __construct(Player $player, Sound $sound) {
        $this->player = $player;
        $this->sound = $sound;
    }

    public function onRun(): void {
        $this->player->broadcastSound($this->sound);
    }

}