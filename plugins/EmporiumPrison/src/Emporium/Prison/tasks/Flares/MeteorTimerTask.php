<?php

namespace Emporium\Prison\tasks\Flares;

use Emporium\Prison\EmporiumPrison;

use Emporium\Prison\Managers\PrisonManager;

use JsonException;

use pocketmine\math\Vector3;

use pocketmine\player\Player;

use pocketmine\scheduler\Task;

use pocketmine\utils\TextFormat as TF;

use pocketmine\world\particle\HugeExplodeParticle;
use pocketmine\world\particle\SmokeParticle;
use pocketmine\world\sound\ExplodeSound;
use pocketmine\world\sound\PopSound;

use WolfDen133\WFT\WFT;

class MeteorTimerTask extends Task {

    private int $x;
    private int $y;
    private int $z;
    private Player $player;
    private string $name;
    private string $text;

    public function __construct(Player $player, String $name, int $x, int $y, int $z) {
        $this->x = $x;
        $this->y = $y;
        $this->z = $z;
        $this->player = $player;
        $this->name = $name;
    }

    /**
     * @throws JsonException
     */
    public function onRun(): void {

        $timer = PrisonManager::getData("Meteors", $this->x . "_" . $this->y . "_" . $this->z, "timer");
        $meteorText = WFT::getInstance()->getTextManager()->getTextById($this->name);

        if($timer >= 1) {
            # update text
            $text = TF::BLUE . "Elite Meteor Flare\n\nArriving in: " . $timer . "s";
            $meteorText->setText($text);
            WFT::getInstance()->getTextManager()->getTextById($this->name)->setText($text);
            # spawn text
            WFT::getInstance()->getTextManager()->getActions()->respawnToAll($this->name);
            $this->player->broadcastSound(new PopSound(1), [$this->player]);
            PrisonManager::takeData("Meteors", $this->x . "_" . $this->y . "_" . $this->z, "timer", 1);
        } else {
            WFT::getInstance()->getTextManager()->getActions()->closeToAll($this->name);
            # particle
            EmporiumPrison::getInstance()->getServer()->getWorldManager()->getWorldByName("world")->addParticle(new Vector3($this->x, $this->y, $this->z), new HugeExplodeParticle(), EmporiumPrison::getInstance()->getServer()->getOnlinePlayers());
            EmporiumPrison::getInstance()->getServer()->getWorldManager()->getWorldByName("world")->addParticle(new Vector3($this->x, $this->y, $this->z), new SmokeParticle(), EmporiumPrison::getInstance()->getServer()->getOnlinePlayers());
            # sound
            EmporiumPrison::getInstance()->getServer()->getWorldManager()->getWorldByName("world")->addSound($this->player->getPosition(), new ExplodeSound());
            $this->getHandler()->cancel();
        }

    }
}