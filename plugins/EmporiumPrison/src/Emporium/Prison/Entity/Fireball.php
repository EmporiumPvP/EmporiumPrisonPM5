<?php

namespace Emporium\Prison\Entity;

use pocketmine\entity\EntitySizeInfo;
use pocketmine\entity\projectile\Projectile;
use pocketmine\event\entity\ProjectileHitEvent;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;
use pocketmine\world\Explosion;

class Fireball extends Projectile
{
    public string $type = "";

    public static function getNetworkTypeId(): string
    {
        return EntityIds::FIREBALL;
    }

    protected function onHit(ProjectileHitEvent $event): void
    {
        $explosion = new Explosion($event->getEntity()->getPosition(), 3, $this);
        $explosion->explodeA();
        $explosion->explodeB();
        $this->flagForDespawn();
    }

    protected function getInitialSizeInfo(): EntitySizeInfo
    {
        return new EntitySizeInfo(1, 1);
    }

    protected function getInitialDragMultiplier(): float
    {
        // TODO: Implement getInitialDragMultiplier() method.
        return 1.0;
    }

    protected function getInitialGravity(): float
    {
        // TODO: Implement getInitialGravity() method.
        return 1.0;
    }
}