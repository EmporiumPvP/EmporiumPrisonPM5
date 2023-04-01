<?php

namespace Emporium\Prison\tasks\Flares;

use EmporiumData\ServerManager;

use Exception;

use pocketmine\entity\object\ItemEntity;
use pocketmine\math\Vector3;
use pocketmine\scheduler\Task;
use pocketmine\world\particle\ExplodeParticle;
use pocketmine\world\sound\ExplodeSound;
use pocketmine\world\World;

class MeteorFlareEntityTask extends Task
{

    private World $world;
    private int $x;
    private int $y;
    private int $z;
    private ItemEntity $itemEntity;
    private string $name;
    private string $type;
    private String $colour;

    public function __construct(World $world, int $x, int $y, int $z, ItemEntity $itemEntity, String $name, String $type, $colour)
    {
        $this->world = $world;
        $this->x = $x;
        $this->y = $y;
        $this->z = $z;
        $this->itemEntity = $itemEntity;
        $this->name = $name;
        $this->type = $type;
        $this->colour = $colour;
    }

    /**
     * @throws Exception
     */
    public function onRun(): void
    {
        var_dump(ServerManager::getInstance()->getData("meteors." . $this->name . ".timer" . ".$this->name.timer"));
        if(ServerManager::getInstance()->getData("meteors." . $this->name . ".timer" . ".$this->name.timer") >= 1) {
            ServerManager::getInstance()->setData("meteors." . $this->name . ".timer", ServerManager::getInstance()->getData($this->name . ".$this->name.timer") - 1);
            $this->itemEntity->setNameTag($this->colour . " $this->type Flare\n\nArriving in: " . ServerManager::getInstance()->getData($this->name . ".$this->name.timer") . "s");
        }

        if (ServerManager::getInstance()->getData($this->name . ".timer" . ".$this->name.timer") == 0) {
            # remove item entity
            $this->itemEntity->close();
            # send sounds
            $this->world->addSound(new Vector3($this->x, $this->y, $this->z), new ExplodeSound());
            # send particles
            $this->world->addParticle(new Vector3($this->x, $this->y, $this->z), new ExplodeParticle());
            # cancel task
            $this->getHandler()->cancel();
        }
    }
}