<?php

declare(strict_types = 1);

namespace Emporium\Prison\tasks;

use pocketmine\player\Player;
use pocketmine\world\sound\EndermanTeleportSound;
use pocketmine\entity\Effect;
use pocketmine\entity\EffectInstance;
use pocketmine\scheduler\CancelTaskException;
use pocketmine\world\Position;
use pocketmine\scheduler\Task;
use pocketmine\utils\TextFormat;

class TeleportTask extends Task {

    /** @var Player|null */
    private Player|null $player;

    /** @var Position */
    private Position $position;

    /** @var Position */
    private Position $originalLocation;

    /** @var int */
    private int $time;

    /** @var int */
    private int $maxTime;

    /**
     * TeleportTask constructor.
     *
     * @param Player $player
     * @param Position $position
     * @param int $time
     */
    public function __construct(Player $player, Position $position, int $time) {
        $this->player = $player;
        //$areas = Main::getInstance()->getAreaManager()->getAreasInPosition($player);
        //if($areas !== null) {
        //foreach($areas as $area) {
        //if($area->getPvpFlag() === false) {
        //$this->player->addEffect(new EffectInstance(Effect::getEffect(Effect::RESISTANCE), 200, 20));
        //$player->teleport($position);
        //$player->sendPopUp("§aSuccessfully Teleported!");
        //$player->getLevel()->addSound(new EndermanTeleportSound($player));
        //$this->player = null;
        //return;
        //}
        //}
        //}
        $this->player->sendTitle("§6Teleporting..§r", "§7Do not move!");
        $this->position = $position;
        $this->originalLocation = $player->getPosition();
        $this->time = $time;
        $this->maxTime = $time;
    }

    /**
     * @throws CancelTaskException
     */
    public function onRun() : void {
        if($this->player === null or $this->player->isClosed()) {
            throw new CancelTaskException();
        }
        if($this->position === null) {
            throw new CancelTaskException();
        }
        if($this->player->getPosition()->distance($this->originalLocation) >= 2) {
            $this->player->sendPopUp("§cTeleportation Cancelled!");
            $this->player->sendTitle("§l§4FAILED TO TELEPORT§r", "§7You must not move!");
            throw new CancelTaskException();
        }
        if($this->time >= 0) {
            if($this->player === null or $this->player->isClosed()) {
                throw new CancelTaskException();
            }
            $this->player->sendPopUp("§eTeleporting in $this->time" . str_repeat(".", ($this->maxTime - $this->time) % 4));
            $this->time--;
            return;
        }
        if($this->player->isCreative() and !$this->player->getAllowFlight()) {
            $this->player->setAllowFlight(true);
        }
        if($this->player === null or $this->player->isClosed()) {
            throw new CancelTaskException();
        }
        if($this->position !== null) {
            $this->player->teleport($this->position);
            $this->player->sendPopUp("§aSuccessfully Teleported!");
            $this->player->broadcastSound(new EndermanTeleportSound, [$this->player]);
            throw new CancelTaskException();
        } else {
            throw new CancelTaskException();
        }
    }
}
