<?php

namespace Tetro\EmporiumWormhole\Core;

use Emporium\Prison\EmporiumPrison;

use Tetro\EmporiumTutorial\Tasks\RemoveItemTask;

use Tetro\EmporiumWormhole\EmporiumWormhole;
use Tetro\EmporiumWormhole\Tasks\OpenWormholeMenuTask;

use pocketmine\item\Pickaxe;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDropItemEvent;
use pocketmine\utils\TextFormat as TF;
use pocketmine\world\sound\EndermanTeleportSound;
use pocketmine\world\sound\XpLevelUpSound;

class EventListener implements Listener {

    public function onDropItem(PlayerDropItemEvent $event) {

        $player = $event->getPlayer();
        $item = $event->getItem();
        $playerX = $player->getPosition()->getX();
        $playerY = $player->getPosition()->getY();
        $playerZ = $player->getPosition()->getZ();
        $world = $player->getWorld()->getFolderName();

        if(!$world == "world") return;

        if($playerX < -1516 && $playerX > -1488 && $playerY < 166 && $playerY > 178 && $playerZ < -331 && $playerZ > -303) return;

        $event->cancel();

        if(!$item instanceof Pickaxe) {
            $player->broadcastSound(new XpLevelUpSound(30));
            $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "That is not a valid pickaxe");
            return;
        }

        if(!$item->getNamedTag()->getTag("PickaxeType")) {
            $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You need to be holding the Pickaxe you want to enchant");
            return;
        }

        if($item->getNamedTag()->getInt("Level") >= 100) {
            $player->sendMessage(TF::RED . "You need to prestige your pickaxe to do this");
            return;
        }

        $energy = $item->getNamedTag()->getInt("Energy");
        $energyNeeded = EmporiumPrison::getInstance()->getPickaxeManager()->getEnergyNeeded($item);

        # pickaxe needs more energy
        if($energy < $energyNeeded) {
            $player->broadcastSound(new XpLevelUpSound(30));
            $player->sendMessage(TF::RED . "You need more energy to Enchant!");
            return;
        }

        # pickaxe is ready to level up

        # play sound to player
        $player->broadcastSound(new EndermanTeleportSound(), [$player]);

        # schedule task
        EmporiumWormhole::getInstance()->getScheduler()->scheduleDelayedTask(new RemoveItemTask($player, $item), 1);

        EmporiumWormhole::getInstance()->getScheduler()->scheduleDelayedTask(new OpenWormholeMenuTask($player, $item), 5);
    }
}
