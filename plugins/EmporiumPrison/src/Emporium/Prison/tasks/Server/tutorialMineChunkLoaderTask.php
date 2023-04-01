<?php

namespace Emporium\Prison\tasks\Server;

use Emporium\Prison\EmporiumPrison;

use pocketmine\scheduler\AsyncTask;
use pocketmine\utils\TextFormat;

class tutorialMineChunkLoaderTask extends AsyncTask {

    private int $minX;
    private int $maxX;
    private int $minZ;
    private int $maxZ;

    public function onRun(): void
    {
        $this->minX = -27;
        $this->maxX = 4;
        $this->minZ = -11;
        $this->maxZ = 8;
    }

    public function onCompletion(): void
    {
        $world = EmporiumPrison::getInstance()->getServer()->getWorldManager()->getWorldByName("TutorialMine");
        # enable world
        if($world !== null) {
            EmporiumPrison::getInstance()->getServer()->getWorldManager()->loadWorld("TutorialMine");
            # run task
            EmporiumPrison::getInstance()->getLogger()->info(TextFormat::RED . "Loading Tutorial Mine Chunks...");
            $totalChunksLoaded = 0;
            $world->setTime(1000);
            $world->stopTime();
            for($x = $this->minX; $x <= $this->maxX; $x++) {
                for($z = $this->minZ; $z <= $this->maxZ; $z++) {
                    $world->loadChunk($x, $z);
                    $totalChunksLoaded++;
                }
            }

            EmporiumPrison::getInstance()->getLogger()->info(TextFormat::GREEN . "Total chunks loaded: " . TextFormat::GRAY . $totalChunksLoaded);
        }
    }
}