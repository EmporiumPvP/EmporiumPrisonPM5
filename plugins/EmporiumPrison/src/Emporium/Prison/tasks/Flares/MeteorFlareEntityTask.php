<?php

namespace Emporium\Prison\tasks\Flares;

use AllowDynamicProperties;
use EmporiumData\ServerManager;

use Exception;

use pocketmine\entity\object\ItemEntity;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\scheduler\Task;
use pocketmine\utils\TextFormat;
use pocketmine\world\particle\ExplodeParticle;
use pocketmine\world\sound\ExplodeSound;
use pocketmine\world\sound\NoteInstrument;
use pocketmine\world\sound\NoteSound;
use pocketmine\world\World;

#[AllowDynamicProperties] class MeteorFlareEntityTask extends Task
{

    private ItemEntity $itemEntity;
    private Player $player;
    private int $timer = 30;

    public function __construct(Player $player, ItemEntity $itemEntity, string $color, string $type)
    {
        $this->player = $player;
        $this->itemEntity = $itemEntity;
        $this->color = $color;
        $this->type = $type;
    }

    /**
     * @throws Exception
     */
    public function onRun(): void
    {
        $this->timer--;
        if ($this->timer <= 1) $this->itemEntity->close();
        if ($this->timer <= 0) $this->getHandler()->cancel();

        if ($this->timer > 26) {
            $this->player->sendTitle(TextFormat::RESET, TextFormat::DARK_RED . "=======" . TextFormat::RED . TextFormat::BOLD . " METEOR STRIKE " . TextFormat::RESET . TextFormat::DARK_RED . "=======\n" . TextFormat::DARK_RED  . "=======" . TextFormat::RED . TextFormat::BOLD . " T-30  SECONDS " . TextFormat::RESET . TextFormat::DARK_RED . "=======", 4, 12, 4);
            $this->player->broadcastSound(new NoteSound(NoteInstrument::DOUBLE_BASS(), 24), [$this->player]);
            $this->player->broadcastSound(new NoteSound(NoteInstrument::DOUBLE_BASS(), 20), [$this->player]);
        }

        $this->itemEntity->setNameTag($this->color . $this->type . " Flare\n\nArriving in: " . $this->timer . "s");
    }
}