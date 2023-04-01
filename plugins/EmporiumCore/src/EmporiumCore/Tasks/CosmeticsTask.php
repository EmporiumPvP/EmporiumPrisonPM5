<?php

namespace EmporiumCore\Tasks;

use EmporiumCore\EmporiumCore;
use EmporiumData\DataManager;
use pocketmine\math\Vector3;
use pocketmine\scheduler\Task;
use pocketmine\world\particle\FlameParticle;

class CosmeticsTask extends Task {

    private EmporiumCore $plugin;
    private int $r;

    public function __construct(EmporiumCore $plugin) {
        $this->plugin = $plugin;
        $this->r = 0;
	}

    public function onRun(): void {

        // For all Online Players
        foreach ($this->plugin->getServer()->getOnlinePlayers() as $player) {
            if (DataManager::getInstance()->getPlayerXuid($player->getName()) == "00") return;

            // Variables
            $particles = DataManager::getInstance()->getPlayerData($player->getXuid(), "particles");

            // Flame-Twirl
            if ($particles === "FlameTwirl") {
                $x = $player->getPosition()->x;
                $y = $player->getPosition()->y;
                $z = $player->getPosition()->z;
                $a = cos(deg2rad($this->r/0.09));
			    $b = sin(deg2rad($this->r/0.09));
			    $c = sin(deg2rad($this->r/0.2));
                $player->getWorld()->addParticle(new Vector3($x - $a, $y + $c + 1.4, $z - $b), new FlameParticle());
            }
            // Flame-Circle
            if ($particles === "FlameCircle") {
                $x = $player->getPosition()->x;
                $y = $player->getPosition()->y;
                $z = $player->getPosition()->z;
                $size = 0.8;
                $a = cos(deg2rad($this->r/0.04))* $size;
                $b = sin(deg2rad($this->r/0.04))* $size;
                $c = cos(deg2rad($this->r/0.04))* 0.6;
                $d = sin(deg2rad($this->r/0.04))* 0.6;
                $player->getWorld()->addParticle(new Vector3($x + $a, $y + $c + $d + 1.2, $z + $b), new FlameParticle());
				$player->getWorld()->addParticle(new Vector3($x - $b, $y + $c + $d + 1.2, $z - $a), new FlameParticle());
            }
            // Flame-Halo
            if ($particles === "FlameHalo") {
                $x = $player->getPosition()->x;
                $y = $player->getPosition()->y;
                $z = $player->getPosition()->z;
                $size = 0.8;
				$a = cos(deg2rad($this->r / 0.04)) * $size;
				$b = sin(deg2rad($this->r / 0.04)) * $size;
				$c = cos(deg2rad($this->r / 0.04)) * 0.6;
				$d = sin(deg2rad($this->r / 0.04)) * 0.6;
				$player->getWorld()->addParticle(new Vector3($x - $b, $y + $c + $d + 1.2, $z - $a), new FlameParticle());
				$player->getWorld()->addParticle(new Vector3($x + $a, $y + $c + $d + 1.2, $z + $b), new FlameParticle());
				$player->getWorld()->addParticle(new Vector3($x + $b, $y + $c + $d + 1.2, $z - $a), new FlameParticle());
				$player->getWorld()->addParticle(new Vector3($x + $a, $y + $c + $d + 1.2, $z - $b), new FlameParticle());
				$player->getWorld()->addParticle(new Vector3($x + $a, $y + 2, $z + $b), new FlameParticle());
            }

        }

        // Continue Timer
        $this->r++;
    }
}