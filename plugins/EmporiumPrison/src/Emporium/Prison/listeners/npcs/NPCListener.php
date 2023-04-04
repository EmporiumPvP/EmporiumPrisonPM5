<?php

namespace Emporium\Prison\listeners\npcs;

use DialogueUIAPI\Yanoox\DialogueUIAPI\DialogueAPI;
use DialogueUIAPI\Yanoox\DialogueUIAPI\element\DialogueButton;

use Emporium\Prison\EmporiumPrison;

use EmporiumCore\EmporiumCore;

use EmporiumData\DataManager;

use JonyGamesYT9\EntityAPI\entity\types\NPC;

use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Listener;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;
use pocketmine\world\Position;
use pocketmine\world\sound\EndermanTeleportSound;

use Tetro\EmporiumTinker\menus\TinkerMenu;
use Tetro\EmporiumTinker\Tinker;

class NPCListener implements Listener {

    public function onDamageNpc(EntityDamageByEntityEvent $event): void {

        $npc = $event->getEntity();
        $player = $event->getDamager();

        if ($player instanceof Player && $npc instanceof NPC) {

            switch ($npc->getIdName()) {

                case "tourguide":
                    $event->cancel();
                    $form = EmporiumPrison::getInstance()->getTourguide();
                    $form->MainForm($player);
                    break;

                    # sell ores
                case "oreexchanger":
                    $event->cancel();
                    $menu = EmporiumPrison::getInstance()->getOreExchanger();
                    $menu->Inventory($player);
                    break;

                # purchase equipment
                case "blacksmith":
                    $event->cancel();
                    $menu = EmporiumCore::getInstance()->getBlacksmith();
                    $menu->open($player);
                    break;

                # purchase food
                case "chef":
                    $event->cancel();
                    $menu = EmporiumCore::getInstance()->getChef();
                    $menu->open($player);
                    break;

                # ship captain
                case "captain":
                    $event->cancel();
                    if(DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.tutorial-complete") === true && DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.tutorial-progress") == 5) {
                        $dialogue = DialogueAPI::create(
                            "ShipCaptainPreFlight",
                            "Ship Captain",
                            "Hello " . $player->getName() . " I am the Ship Captain." . TF::EOL . TF::EOL .
                            "I am in charge of transporting all the new inmates from the Training Area to the Yard" . TF::EOL . TF::EOL .
                            "When you are ready press the Board Ship button, and i will take you to the Yard.",
                            [DialogueButton::create("Board Ship")
                                ->setHandler(function (Player $player): void {
                                    # teleport player
                                    $player->teleport(new Position(-1525.5, 169, -316.5, EmporiumPrison::getInstance()->getServer()->getWorldManager()->getWorldByName("world")));
                                    $player->broadcastSound(new EndermanTeleportSound(), [$player]);
                                    # send new dialogue
                                    $dialogue = DialogueAPI::create(
                                        "ShipCaptain",
                                        "Ship Captain",
                                        "We are here! Welcome to the Yard." . TF::EOL . TF::EOL .
                                        "You are currently in the recreation yard, here you can Forge your pickaxe, upgrade items, purchase new items chat with other in mates and much much more." . TF::EOL . TF::EOL .
                                        "I would recommend that you explore the recreation yard for a bit and get familiar with it you will be spending a lot of time here" . TF::EOL . TF::EOL .
                                        "If you would like to get straight to work you can type /mines to travel to the first mine. Each mine has certain requirements you need to reach before you can access it, for detailed information on each mine run /mines info" . TF::EOL . TF::EOL .
                                        "I have to go back now i have some new inmates waiting for me, remember if you get stuck you can use /help and if you would like to come back to the recreation yard you can use /spawn",
                                        [DialogueButton::create("continue")
                                            ->setHandler(function (): void {})]);
                                    $dialogue->displayTo([$player]);
                                })]);
                        $dialogue->displayTo([$player]);
                    }
                    break;

                # buy enchants
                case "enchanter":
                    $event->cancel();
                    $menu = EmporiumCore::getInstance()->getCustomEnchantMenu();
                    $menu->open($player);
                    break;

                case "banker":
                    $event->cancel();
                    $player->sendMessage(TF::BOLD . TF::YELLOW . "Banker " . TF::GRAY . "The Emporium Bank will be open soon.");
                    /*
                    $bank = new Bank();
                    $bank->Form($player);
                    */
                    break;

                case "tinkerer":
                    $event->cancel();
                    $menu = Tinker::getInstance()->getTinkerMenu();
                    $menu->Menu($player);
                    break;

                case "pickaxe_prestige":
                    $event->cancel();
                    $menu = EmporiumPrison::getInstance()->getPickaxePrestige();
                    $menu->Inventory($player);
                    break;

                case "player_prestige":
                    $event->cancel();
                    $menu = EmporiumPrison::getInstance()->getPlayerPrestigeMenu();
                    $menu->Inventory($player);
                    break;
            }
        }
    }
}