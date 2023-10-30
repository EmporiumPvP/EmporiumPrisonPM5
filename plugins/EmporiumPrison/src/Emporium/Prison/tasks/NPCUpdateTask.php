<?php

namespace Emporium\Prison\tasks;

use Emporium\Prison\Entity\NPC\NPC;

use pocketmine\scheduler\Task;
use pocketmine\Server;
use pocketmine\utils\TextFormat as TF;

class NPCUpdateTask extends Task{

    public function onRun(): void {
        foreach (Server::getInstance()->getWorldManager()->getWorlds() as $worlds) {
            foreach ($worlds->getEntities() as $entities) {
                if ($entities instanceof NPC) {
                    switch ($entities->getName()) {

                        case TF::YELLOW . "Tour Guide":
                            $entities->setNameTag(TF::BOLD . TF::YELLOW . "Tour Guide" . TF::GRAY . "\n(Click Me)");
                            $entities->setScale($entities->getScale());
                            $entities->setNameTagAlwaysVisible();
                            break;

                        case TF::AQUA . "Ore Exchanger":
                            $entities->setNameTag(TF::BOLD . TF::GOLD . "Ore Exchanger" . TF::GRAY . "\n(Click Me)");
                            $entities->setScale($entities->getScale());
                            $entities->setNameTagAlwaysVisible();
                            break;

                        case TF::DARK_GRAY . "Blacksmith":
                            $entities->setNameTag(TF::BOLD . TF::GOLD . "Blacksmith" . TF::GRAY . "\n(Click Me)");
                            $entities->setScale($entities->getScale());
                            $entities->setNameTagAlwaysVisible();
                            break;

                        case TF::GOLD . "Chef":
                            $entities->setNameTag(TF::BOLD . TF::GOLD . "Chef" . TF::GRAY . "\n(Click Me)");
                            $entities->setScale($entities->getScale());
                            $entities->setNameTagAlwaysVisible();
                            break;

                        case TF::GREEN . "Auctioneer":
                            $entities->setNameTag(TF::GREEN . "Auctioneer" . TF::GRAY . "\n(Click Me)");
                            $entities->setScale($entities->getScale());
                            $entities->setNameTagAlwaysVisible();
                            break;

                        case TF::LIGHT_PURPLE . "Ship Captain":
                            $entities->setNameTag(TF::BOLD . TF::LIGHT_PURPLE . "Ship Captain" . TF::GRAY . "\n(Click Me)");
                            $entities->setScale($entities->getScale());
                            $entities->setNameTagAlwaysVisible();
                            break;

                        case TF::AQUA . "Banker":
                            $entities->setNameTag(TF::BOLD . TF::AQUA . "Banker" . TF::GRAY . "\n(Click Me)");
                            $entities->setScale($entities->getScale());
                            $entities->setNameTagAlwaysVisible();
                            break;

                        case TF::AQUA . "Pickaxe Prestige":
                            $entities->setNameTag(TF::BOLD . TF::AQUA . "Pickaxe Prestige" . TF::GRAY . "\n(Click Me)");
                            $entities->setScale($entities->getScale());
                            $entities->setNameTagAlwaysVisible();
                            break;

                        case TF::RED . "Player Prestige":
                            $entities->setNameTag(TF::BOLD . TF::RED . "Player Prestige" . TF::GRAY . "\n(Click Me)");
                            $entities->setScale($entities->getScale());
                            $entities->setNameTagAlwaysVisible();
                            break;

                        case TF::DARK_PURPLE . "Enchanter":
                            $entities->setNameTag(TF::BOLD . TF::DARK_PURPLE . "Enchanter" . TF::GRAY . "\n(Click Me)");
                            $entities->setScale($entities->getScale());
                            $entities->setNameTagAlwaysVisible();
                            break;

                        case TF::DARK_AQUA . "Tinkerer":
                            $entities->setNameTag(TF::BOLD . TF::DARK_AQUA . "Tinker" . TF::GRAY . "\n(Click Me)");
                            $entities->setScale($entities->getScale());
                            $entities->setNameTagAlwaysVisible();
                            break;
                    }
                }
            }
        }
    }
}