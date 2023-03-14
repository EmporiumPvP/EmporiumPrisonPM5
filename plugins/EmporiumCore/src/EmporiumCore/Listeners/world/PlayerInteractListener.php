<?php

namespace EmporiumCore\Listeners\world;

use Emporium\Prison\Menus\Vaults;
use pocketmine\block\BlockLegacyIds;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;

use pocketmine\network\mcpe\protocol\types\DeviceOS;

class PlayerInteractListener implements Listener {

    public function onEnderChestInteract(PlayerInteractEvent $event) {

        $player = $event->getPlayer();
        $block = $event->getBlock();

        if($block->getIdInfo()->getBlockId() === BlockLegacyIds::ENDER_CHEST) {

            $event->cancel();
            $extraData = $player->getPlayerInfo()->getExtraData();
            $vaults = new Vaults();
            switch ($extraData["DeviceOS"]) {

                case DeviceOS::IOS:
                case DeviceOS::ANDROID:
                case DeviceOS::PLAYSTATION:
                case DeviceOS::XBOX:
                case DeviceOS::NINTENDO:
                    $vaults->Form($player);
                    break;

                case DeviceOS::WINDOWS_10:
                case DeviceOS::OSX:
                    $vaults->Inventory($player);
                    break;
            }
        }
    }
}