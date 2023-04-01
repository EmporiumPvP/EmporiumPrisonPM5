<?php

namespace Tetro\EmporiumWormhole\Core;

use Emporium\Prison\EmporiumPrison;
use Emporium\Prison\Variables;

use Tetro\EmporiumWormhole\Menus\Menu;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDropItemEvent;
use pocketmine\item\ItemIds;
use pocketmine\utils\TextFormat as TF;
use pocketmine\world\sound\EndermanTeleportSound;
use pocketmine\world\sound\XpLevelUpSound;

class EventListener implements Listener {

    public function onDropItem(PlayerDropItemEvent $event) {

        $player = $event->getPlayer();
        $item = $event->getItem();
        $hand = $item->getId();
        $playerX = $player->getPosition()->getX();
        $playerY = $player->getPosition()->getY();
        $playerZ = $player->getPosition()->getZ();

        $world = $player->getWorld()->getFolderName();
        if($world === "world") {
            # player is in wormhole range
            if($playerX >= -1516 && $playerX <= -1488 && $playerY >= 166 && $playerY <= 178 && $playerZ >= -331 && $playerZ <= -303) {
                if($hand === ItemIds::WOODEN_PICKAXE || $hand === ItemIds::STONE_PICKAXE || $hand === ItemIds::GOLDEN_PICKAXE || $hand === ItemIds::IRON_PICKAXE || $hand === ItemIds::DIAMOND_PICKAXE) {
                    if($item->getNamedTag()->getTag("Level") !== null) {
                        $level = $item->getNamedTag()->getInt("Level");
                        if($level >= 100) {
                            # pickaxe is max level
                            $event->cancel();
                            $player->sendMessage(TF::RED . "You need to prestige your pickaxe to do this");
                        } else {
                            $energy = $item->getNamedTag()->getInt("Energy");
                            $energyNeeded = EmporiumPrison::getInstance()->getPickaxeManager()->getEnergyNeeded($item);
                            if ($energy >= $energyNeeded) {
                                # pickaxe is ready to level up
                                $event->cancel();
                                # play sound to player
                                $player->broadcastSound(new EndermanTeleportSound(), [$player]);
                                # remove energy from pickaxe
                                EmporiumPrison::getInstance()->getPickaxeManager()->removeLevelUpEnergy($player, $item);
                                # send inventory
                                $menu = new Menu();
                                $menu->Inventory($player, $item);
                            } else {
                                # pickaxe is not ready to level up
                                $player->broadcastSound(new XpLevelUpSound(30));
                                $player->sendMessage(TF::RED . "You need more energy to Enchant!");
                                $event->cancel();
                            }
                        }
                    } else {
                        $player->broadcastSound(new XpLevelUpSound(30));
                        $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "That is not a valid pickaxe");
                        $event->cancel();
                    } # not a valid pickaxe
                } else {
                    $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You need to be holding the Pickaxe you want to enchant");
                    $event->cancel();
                } # player not holding a pickaxe
            } # not in wormhole range
        } # not "world"
    }
}