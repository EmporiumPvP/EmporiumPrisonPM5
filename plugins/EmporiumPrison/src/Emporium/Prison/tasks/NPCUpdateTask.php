<?php

namespace Emporium\Prison\tasks;

use JonyGamesYT9\EntityAPI\entity\types\NPC;

use pocketmine\scheduler\Task;

use pocketmine\Server;

use pocketmine\utils\TextFormat as TF;

class NPCUpdateTask extends Task{

    public function onRun(): void {
        foreach (Server::getInstance()->getWorldManager()->getWorlds() as $worlds) {
            foreach ($worlds->getEntities() as $entities) {
                if ($entities instanceof NPC) {
                    switch ($entities->getIdName()) {

                        case "tourguide":
                            $entities->setNameTag(TF::BOLD . TF::YELLOW . "Tour Guide" . TF::GRAY . "\n(Click Me)");
                            $entities->setScale($entities->getScaleCustom());
                            $entities->setNameTagAlwaysVisible();
                            break;

                        case "oreexchanger":
                            $entities->setNameTag(TF::BOLD . TF::GOLD . "Ore Exchanger" . TF::GRAY . "\n(Click Me)");
                            $entities->setScale($entities->getScaleCustom());
                            $entities->setNameTagAlwaysVisible();
                            break;

                        case "blacksmith":
                            $entities->setNameTag(TF::BOLD . TF::GOLD . "Blacksmith" . TF::GRAY . "\n(Click Me)");
                            $entities->setScale($entities->getScaleCustom());
                            $entities->setNameTagAlwaysVisible();
                            break;

                        case "chef":
                            $entities->setNameTag(TF::BOLD . TF::GOLD . "Chef" . TF::GRAY . "\n(Click Me)");
                            $entities->setScale($entities->getScaleCustom());
                            $entities->setNameTagAlwaysVisible();
                            break;

                        case "auctioneer":
                            $entities->setNameTag(TF::GREEN . "Auctioneer" . TF::GRAY . "\n(Click Me)");
                            $entities->setScale($entities->getScaleCustom());
                            $entities->setNameTagAlwaysVisible();
                            break;

                        case "captain":
                            $entities->setNameTag(TF::BOLD . TF::LIGHT_PURPLE . "Ship Captain" . TF::GRAY . "\n(Click Me)");
                            $entities->setScale($entities->getScaleCustom());
                            $entities->setNameTagAlwaysVisible();
                            break;

                        case "banker":
                            $entities->setNameTag(TF::BOLD . TF::AQUA . "Banker" . TF::GRAY . "\n(Click Me)");
                            $entities->setScale($entities->getScaleCustom());
                            $entities->setNameTagAlwaysVisible();
                            break;

                        case "pickaxe_prestige":
                            $entities->setNameTag(TF::BOLD . TF::AQUA . "Pickaxe Prestige" . TF::GRAY . "\n(Click Me)");
                            $entities->setScale($entities->getScaleCustom());
                            $entities->setNameTagAlwaysVisible();
                            break;

                        case "player_prestige":
                            $entities->setNameTag(TF::BOLD . TF::RED . "Player Prestige" . TF::GRAY . "\n(Click Me)");
                            $entities->setScale($entities->getScaleCustom());
                            $entities->setNameTagAlwaysVisible();
                            break;

                        case "enchanter":
                            $entities->setNameTag(TF::BOLD . TF::DARK_PURPLE . "Enchanter" . TF::GRAY . "\n(Click Me)");
                            $entities->setScale($entities->getScaleCustom());
                            $entities->setNameTagAlwaysVisible();
                            break;

                        case "tinkerer":
                            $entities->setNameTag(TF::BOLD . TF::DARK_AQUA . "Tinkerer" . TF::GRAY . "\n(Click Me)");
                            $entities->setScale($entities->getScaleCustom());
                            $entities->setNameTagAlwaysVisible();
                            break;
                    }
                }
            }
        }
    }
}