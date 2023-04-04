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
        $this->timer--;
        if ($this->timer <= 5) $this->itemEntity->close();
        if ($this->timer <= 0) $this->getHandler()->cancel();

        if ($this->timer > 26) {
            $this->player->sendTitle(TextFormat::RESET, TextFormat::DARK_RED . "=======" . TextFormat::RED . TextFormat::BOLD . " METEOR STRIKE " . TextFormat::RESET . TextFormat::DARK_RED . "=======\n" . TextFormat::DARK_RED  . "=======" . TextFormat::RED . TextFormat::BOLD . " T-30  SECONDS " . TextFormat::RESET . TextFormat::DARK_RED . "=======", 4, 12, 4);
            $this->player->broadcastSound(new NoteSound(NoteInstrument::DOUBLE_BASS(), 24), [$this->player]);
            $this->player->broadcastSound(new NoteSound(NoteInstrument::DOUBLE_BASS(), 20), [$this->player]);
        }

        $this->itemEntity->setNameTag($this->color . $this->type . " Flare\n\nArriving in: " . $this->timer . "s");
    }
}