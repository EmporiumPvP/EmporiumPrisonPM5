<?php

namespace Emporium\Prison\tasks\Events;

use Emporium\Prison\EmporiumPrison;

use Emporium\Prison\Entity\Fireball;
use EmporiumData\ServerManager;

use pocketmine\entity\Location;
use pocketmine\math\Vector3;
use pocketmine\scheduler\Task;
use pocketmine\Server;
use pocketmine\utils\TextFormat as TF;

class SpawnMeteorTask extends Task
{

    /**
     * @var array|string[]
     */
    private array $meteors;
    private int $minX;
    private int $maxX;
    private int $minZ;
    private int $maxZ;

    public function __construct()
    {
        $this->meteors = ["elite", "ultimate", "legendary", "godly", "heroic"];
        $this->minX = -1792;
        $this->maxX = 1790;

        $this->minZ = -511;
        $this->maxZ = 511;
    }

    public function onRun(): void
    {
        # increment timer
        ServerManager::getInstance()->setData("events.meteor", ServerManager::getInstance()->getData("events.meteor") + 1);

        $seconds = ServerManager::getInstance()->getData("events.meteor");
        $minute = $seconds / 60;

        # has been 30 minutes
        if ($minute >= 30) {

            # generate position
            $x = mt_rand($this->minX, $this->maxX);
            $z = mt_rand($this->minZ, $this->maxZ);
            $y = Server::getInstance()->getWorldManager()->getWorldByName("world")->getHighestBlockAt($x, $z) + 1;

            $location = TF::WHITE . $x . TF::GRAY . "x " . TF::WHITE . $y . TF::GRAY . "y " . TF::WHITE . $z . TF::GRAY . "z ";

            # broadcast message
            $message = TF::BOLD . TF::GOLD . "(!) A meteor shower is falling from the sky at:" . TF::EOL;
            $message .= TF::RESET . TF::WHITE . $location . TF::EOL;
            $message .= TF::RESET . TF::GRAY . "Meteors are rare ores from lost galaxies that give massive" . TF::EOL;
            $message .= TF::RESET . TF::GRAY . "amounts of energy and loot. " . TF::WHITE . "/help meteors";

            EmporiumPrison::getInstance()->getServer()->broadcastMessage($message);

            # reset timer
            ServerManager::getInstance()->setData("events.meteor", 0);

            for ($i = 1; $i <= mt_rand(10, 20); $i++) {
                $x = $x + (mt_rand(0, 200) - 150);
                $z = $z + (mt_rand(0, 200) - 150);
                $spawnX = $x + (mt_rand(1, 160) - 80);
                $spawnZ = $z + (mt_rand(1, 160) - 80);

                $rx = (($x - $spawnX) / 30) / 20;
                $rz = (($z - $spawnZ) / 30) / 20;

                $entity = new Fireball(new Location($x, mt_rand(800, 1000), $z, Server::getInstance()->getWorldManager()->getWorldByName("world"), 0, 0), null);
                $entity->setMotion(new Vector3($rx, -1.5, $rz));
                $entity->setHasGravity(false);
                $entity->setOnFire(999);
                $entity->type = array_rand($this->meteors);
                $entity->spawnToAll();
            }
        }
    }
}