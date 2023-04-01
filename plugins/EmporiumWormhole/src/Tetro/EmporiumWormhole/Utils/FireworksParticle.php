<?php

namespace Tetro\EmporiumWormhole\Utils;

use BlockHorizons\Fireworks\entity\FireworksRocket;
use BlockHorizons\Fireworks\item\Fireworks;

use Emporium\Prison\EmporiumPrison;

use pocketmine\entity\Location;
use pocketmine\item\ItemFactory;
use pocketmine\item\ItemIds;
use pocketmine\scheduler\ClosureTask;

class FireworksParticle {

    public static function instantFirework($player, $colour): void {
        EmporiumPrison::getInstance()->getScheduler()->scheduleDelayedTask(new ClosureTask(function() use ($colour, $player): void {
            $fw = ItemFactory::getInstance()->get(ItemIds::FIREWORKS);
            if ($fw instanceof Fireworks) {
                $fw->addExplosion(0, $colour, "", true, true);
                $fw->setFlightDuration(0);
                $entity = new FireworksRocket(Location::fromObject($player->getPosition(), $player->getWorld(), lcg_value() * 360, 90), $fw);
                $entity->spawnToAll();
            }
        }), 0);
    }

    public static function Fireworks1($player): void {
        EmporiumPrison::getInstance()->getScheduler()->scheduleDelayedTask(new ClosureTask(function() use ($player): void {
            $fw = ItemFactory::getInstance()->get(ItemIds::FIREWORKS);
            if ($fw instanceof Fireworks) {
                $fw->addExplosion(0, Fireworks::COLOR_BLUE, "", true, true);
                $fw->setFlightDuration(1);
                $entity = new FireworksRocket(Location::fromObject($player->getPosition(), $player->getWorld(), lcg_value() * 360, 90), $fw);
                $entity->spawnToAll();
            }
        }), 0);
    }
    public static function Fireworks3($player): void {
        EmporiumPrison::getInstance()->getScheduler()->scheduleDelayedTask(new ClosureTask(function() use ($player): void {
            $fw = ItemFactory::getInstance()->get(ItemIds::FIREWORKS);
            if ($fw instanceof Fireworks) {
                $fw->addExplosion(0, Fireworks::COLOR_BLUE, "", true, true);
                $fw->setFlightDuration(1);
                $entity = new FireworksRocket(Location::fromObject($player->getPosition(), $player->getWorld(), lcg_value() * 360, 90), $fw);
                $entity->spawnToAll();
            }
        }), 0);
        EmporiumPrison::getInstance()->getScheduler()->scheduleDelayedTask(new ClosureTask(function() use ($player): void {
            $fw = ItemFactory::getInstance()->get(ItemIds::FIREWORKS);
            if ($fw instanceof Fireworks) {
                $fw->addExplosion(1, Fireworks::COLOR_RED, "", true, true);
                $fw->setFlightDuration(1);
                $entity = new FireworksRocket(Location::fromObject($player->getPosition(), $player->getWorld(), lcg_value() * 360, 90), $fw);
                $entity->spawnToAll();
            }
        }), 20);
        EmporiumPrison::getInstance()->getScheduler()->scheduleDelayedTask(new ClosureTask(function() use ($player): void {
            $fw = ItemFactory::getInstance()->get(ItemIds::FIREWORKS);
            if ($fw instanceof Fireworks) {
                $fw->addExplosion(2, Fireworks::COLOR_GREEN, "", true, true);
                $fw->setFlightDuration(1);
                $entity = new FireworksRocket(Location::fromObject($player->getPosition(), $player->getWorld(), lcg_value() * 360, 90), $fw);
                $entity->spawnToAll();
            }
        }), 40);
    }

}