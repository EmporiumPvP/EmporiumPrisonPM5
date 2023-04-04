<?php

namespace Emporium\Prison\tasks\Server;

use Emporium\Prison\EmporiumPrison;

use pocketmine\math\Vector2;
use pocketmine\scheduler\AsyncTask;
use pocketmine\utils\TextFormat;

class spawnChunkLoaderTask extends AsyncTask {

    private Vector2 $xBounds;
    private Vector2 $zBounds;

    public function onRun(): void {
        $this->xBounds = new Vector2(-112, 111);
        $this->zBounds = new Vector2(-31, 31);
    }

    public function onCompletion(): void
    {
        return;
        $world = EmporiumPrison::getInstance()->getServer()->getWorldManager()->getWorldByName("world");
        # enable world
        if($world !== null) {
            EmporiumPrison::getInstance()->getServer()->getWorldManager()->loadWorld("world");
            # run task
            EmporiumPrison::getInstance()->getLogger()->info(TextFormat::RED . "Loading Spawn Chunks...");
            $totalChunksLoaded = 0;
            $world->setTime(1000);
            $world->stopTime();
            for($x = $this->xBounds->getX(); $x <= $this->xBounds->getY(); $x++) {
                for($z = $this->zBounds->getX(); $z <= $this->zBounds->getY(); $z++) {
                    $world->loadChunk($x, $z);
                    $totalChunksLoaded++;
                }
            }

            EmporiumPrison::getInstance()->getLogger()->info(TextFormat::GREEN . "Total chunks loaded: " . TextFormat::GRAY . $totalChunksLoaded);
        }
    }
}