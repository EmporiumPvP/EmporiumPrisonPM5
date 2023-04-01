<?php

namespace EmporiumCore\Listeners\world;

use Emporium\Prison\EmporiumPrison;
use Emporium\Prison\Menus\Menu;
use pocketmine\block\BlockLegacyIds;
use pocketmine\block\VanillaBlocks;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;


class PlayerInteractListener extends Menu implements Listener {

    /**
     * @priority HIGHEST
     */
    public function onEnderChestInteract(PlayerInteractEvent $event) {

        $player = $event->getPlayer();
        $block = $event->getBlock();

        if(!$block->getIdInfo()->getBlockId() == BlockLegacyIds::ENDER_CHEST) return;

        if($block->getName() != VanillaBlocks::ENDER_CHEST()->asItem()->getVanillaName()) {
            $event->cancel();
            return;
        }
        # player is not clicking on vault
        # player is clicking on vault
        if($block->getName() == VanillaBlocks::ENDER_CHEST()->asItem()->getVanillaName()) {
            $event->cancel();

            $vaults = EmporiumPrison::getInstance()->getVaultsMenu();
            $vaults->open($player);
        }

    }
}