<?php

namespace Tetro\EmporiumWormhole\Utils;

use BlockHorizons\Fireworks\entity\FireworksRocket;
use BlockHorizons\Fireworks\item\ExtraVanillaItems;
use BlockHorizons\Fireworks\item\Fireworks;

use Emporium\Prison\EmporiumPrison;

use pocketmine\entity\Location;
use pocketmine\player\Player;
use pocketmine\scheduler\ClosureTask;

class FireworksParticle {

    public static function instantFirework(Player $player, $colour): void {

        EmporiumPrison::getInstance()->getScheduler()->scheduleDelayedTask(new ClosureTask(function() use ($player): void {

            /** @var Fireworks $fw */
            $fireworks = ExtraVanillaItems::FIREWORKS();
            $fw = clone $fireworks;

            $fw->addExplosion(Fireworks::TYPE_CREEPER_HEAD, Fireworks::COLOR_GREEN);
            $fw->setFlightDuration(0);

            if ($fw instanceof Fireworks) {
                $fw->addExplosion(0, Fireworks::COLOR_BLUE, "", true, true);
                $fw->setFlightDuration(1);
                $entity = new FireworksRocket(Location::fromObject($player->getPosition(), $player->getWorld(), lcg_value() * 360, 90), $fw);
                $entity->spawnToAll();
            }
        }), 0);
    }

    public static function Fireworks1($player): void {

        EmporiumPrison::getInstance()->getScheduler()->scheduleDelayedTask(new ClosureTask(function() use ($player): void {

            /** @var Fireworks $fw */
            $fireworks = ExtraVanillaItems::FIREWORKS();
            $fw = clone $fireworks;

            $fw->addExplosion(Fireworks::TYPE_STAR, Fireworks::COLOR_BLUE);
            $fw->setFlightDuration(0);

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

            /** @var Fireworks $fw */
            $fireworks = ExtraVanillaItems::FIREWORKS();
            $fw = clone $fireworks;

            $fw->addExplosion(Fireworks::TYPE_STAR, Fireworks::COLOR_BLUE);
            $fw->setFlightDuration(1);

            if ($fw instanceof Fireworks) {
                $entity = new FireworksRocket(Location::fromObject($player->getPosition(), $player->getWorld(), lcg_value() * 360, 90), $fw);
                $entity->spawnToAll();
            }
        }), 0);

        EmporiumPrison::getInstance()->getScheduler()->scheduleDelayedTask(new ClosureTask(function() use ($player): void {

            /** @var Fireworks $fw */
            $fireworks = ExtraVanillaItems::FIREWORKS();
            $fw = clone $fireworks;

            $fw->addExplosion(Fireworks::TYPE_BURST, Fireworks::COLOR_RED);
            $fw->setFlightDuration(1);

            if ($fw instanceof Fireworks) {
                $entity = new FireworksRocket(Location::fromObject($player->getPosition(), $player->getWorld(), lcg_value() * 360, 90), $fw);
                $entity->spawnToAll();
            }
        }), 20);
        EmporiumPrison::getInstance()->getScheduler()->scheduleDelayedTask(new ClosureTask(function() use ($player): void {

            /** @var Fireworks $fw */
            $fireworks = ExtraVanillaItems::FIREWORKS();
            $fw = clone $fireworks;

            $fw->addExplosion(Fireworks::TYPE_CREEPER_HEAD, Fireworks::COLOR_GREEN);
            $fw->setFlightDuration(1);

            if ($fw instanceof Fireworks) {
                $entity = new FireworksRocket(Location::fromObject($player->getPosition(), $player->getWorld(), lcg_value() * 360, 90), $fw);
                $entity->spawnToAll();
            }
        }), 40);
    }

}