<?php

namespace EmporiumCore\Tasks\Utils;

use EmporiumCore\EmporiumCore;
use pocketmine\entity\Location;
use pocketmine\entity\object\ItemEntity;
use pocketmine\item\Item;
use pocketmine\item\ItemIds;
use pocketmine\player\Player;
use pocketmine\scheduler\Task;
use pocketmine\world\sound\DoorBumpSound;
use pocketmine\world\World;

class SpawnContrabandReward extends Task {

    private Player $player;
    private World $world;
    private Location $location;
    private Item $reward;
    private string $rewardName;
    private int $despawnDelay;

    public function __construct(Player $player, World $world, Location $location, Item $reward, String $rewardName, int $despawnDelay) {
        $this->player = $player;
        $this->world = $world;
        $this->location = $location;
        $this->reward = $reward;
        $this->rewardName = $rewardName;
        $this->despawnDelay = $despawnDelay;
    }

    public function onRun(): void
    {
        # play sound
        EmporiumCore::getInstance()->getServer()->getWorldManager()->getWorldByName($this->world->getFolderName())->addSound($this->location, new DoorBumpSound(), [$this->player]);
        # spawn entity
        $itemEntity1 = new ItemEntity($this->location, $this->reward);
        $itemEntity1->setNameTag($this->rewardName);
        $itemEntity1->setNameTagAlwaysVisible();
        $itemEntity1->setPickupDelay(-1);
        $itemEntity1->setDespawnDelay($this->despawnDelay);
        $itemEntity1->setHasGravity(false);
        $itemEntity1->spawnToAll();
        if($this->reward->getId() == ItemIds::PAPER) return;
        # give player item
        if($this->player->getInventory()->canAddItem($this->reward)) {
            $this->player->getInventory()->addItem($this->reward);
        } else {
            $this->player->getWorld()->dropItem($this->player->getLocation()->asVector3(), $this->reward);
        }
    }
}