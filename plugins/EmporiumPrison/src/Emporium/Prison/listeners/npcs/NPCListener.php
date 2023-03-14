<?php

namespace Emporium\Prison\listeners\npcs;

use DialogueUIAPI\Yanoox\DialogueUIAPI\DialogueAPI;
use DialogueUIAPI\Yanoox\DialogueUIAPI\element\DialogueButton;

use Emporium\Prison\EmporiumPrison;
use EmporiumData\DataManager;
use Emporium\Prison\Managers\misc\Translator;
use Emporium\Prison\Managers\PrisonManager;
use Emporium\Prison\Menus\TourGuide;

use EmporiumCore\Variables;

use JonyGamesYT9\EntityAPI\entity\types\NPC;

use JsonException;

use Menus\CustomEnchantMenu;
use Menus\Merchants;

use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Listener;
use pocketmine\item\ItemIds;
use pocketmine\item\VanillaItems;
use pocketmine\network\mcpe\protocol\types\DeviceOS;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;
use pocketmine\world\Position;
use pocketmine\world\sound\BarrelOpenSound;
use pocketmine\world\sound\ChestOpenSound;
use pocketmine\world\sound\EndermanTeleportSound;
use pocketmine\world\sound\ItemFrameAddItemSound;
use pocketmine\world\sound\XpCollectSound;
use pocketmine\world\sound\XpLevelUpSound;

use Tetro\EmporiumEnchants\Core\CustomEnchant;
use Tetro\EPTutorial\Loader;
use Tetro\EPTutorial\Managers\TutorialManager;

class NPCListener implements Listener {

    private array $sellables = [
        16, 173, 263, # coal
        15, 42, 265, # iron
        21, 22, 351, # lapis
        73, 152, 331, # redstone
        14, 41, 266, # gold
        56, 57, 264, # diamond
        129, 133, 388 # emerald
    ];

    /**
     * @throws JsonException
     */
    public function onDamageNpc(EntityDamageByEntityEvent $event): void {

        $npc = $event->getEntity();
        $player = $event->getDamager();

        if ($player instanceof Player && $npc instanceof NPC) {

            # I need to add pc and mobile checks for form or inventory
            switch ($npc->getIdName()) {

                case "tourguide":
                    $event->cancel();
                    $form = new TourGuide();
                    $form->MainForm($player);
                    break;

                    # sell ores
                case "oreexchanger":
                    $event->cancel();

                    # sell ores logic here
                    $inventory = $player->getInventory()->getContents();
                    $sellprice = 0;

                    foreach ($inventory as $item) {
                        if(in_array($item->getId(), $this->sellables)) {
                            # coal ore
                            if ($item->getId() === ItemIds::COAL_ORE) {
                                $count = $item->getCount();
                                $sellprice = $sellprice + (0.06 * $count);
                                $player->getInventory()->remove($item);
                            }
                            # coal block
                            if ($item->getId() === ItemIds::COAL) {
                                $count = $item->getCount();
                                $sellprice = $sellprice + (0.32 * $count);
                                $player->getInventory()->remove($item);
                            }
                            # coal
                            if ($item->getId() === ItemIds::COAL_BLOCK) {
                                $count = $item->getCount();
                                $sellprice = $sellprice + (1.21 * $count);
                                $player->getInventory()->remove($item);
                            }

                            # iron ore
                            if ($item->getId() === ItemIds::IRON_ORE) {
                                $count = $item->getCount();
                                $sellprice = $sellprice + (0.20 * $count);
                                $player->getInventory()->remove($item);
                            }
                            # iron ingot
                            if ($item->getId() === ItemIds::IRON_INGOT) {
                                $count = $item->getCount();
                                $sellprice = $sellprice + (1.02 * $count);
                                $player->getInventory()->remove($item);
                            }
                            # iron block
                            if ($item->getId() === ItemIds::IRON_BLOCK) {
                                $count = $item->getCount();
                                $sellprice = $sellprice + (4.08 * $count);
                                $player->getInventory()->remove($item);
                            }

                            # lapis ore
                            if ($item->getId() === ItemIds::LAPIS_ORE) {
                                $count = $item->getCount();
                                $sellprice = $sellprice + (0.52 * $count);
                                $player->getInventory()->remove($item);
                            }
                            # lapis
                            if ($item->getId() === ItemIds::DYE && $item->getMeta() === 4) {
                                $count = $item->getCount();
                                $sellprice = $sellprice + (2.70 * $count);
                                $player->getInventory()->remove($item);
                            }
                            # lapis block
                            if ($item->getId() === ItemIds::LAPIS_BLOCK) {
                                $count = $item->getCount();
                                $sellprice = $sellprice + (10.80 * $count);
                                $player->getInventory()->remove($item);
                            }

                            # redstone ore
                            if ($item->getId() === ItemIds::REDSTONE_ORE) {
                                $count = $item->getCount();
                                $sellprice = $sellprice + (1.57 * $count);
                                $player->getInventory()->remove($item);
                            }
                            # redstone
                            if ($item->getId() === ItemIds::REDSTONE) {
                                $count = $item->getCount();
                                $sellprice = $sellprice + (8.29 * $count);
                                $player->getInventory()->remove($item);
                            }
                            # redstone block
                            if ($item->getId() === ItemIds::REDSTONE_BLOCK) {
                                $count = $item->getCount();
                                $sellprice = $sellprice + (33.16 * $count);
                                $player->getInventory()->remove($item);
                            }

                            # gold ore
                            if ($item->getId() === ItemIds::GOLD_ORE) {
                                $count = $item->getCount();
                                $sellprice = $sellprice + (4.86 * $count);
                                $player->getInventory()->remove($item);
                            }
                            # gold ingot
                            if ($item->getId() === ItemIds::GOLD_INGOT) {
                                $count = $item->getCount();
                                $sellprice = $sellprice + (25.76 * $count);
                            }
                            # gold block
                            if ($item->getId() === ItemIds::GOLD_BLOCK) {
                                $count = $item->getCount();
                                $sellprice = $sellprice + (103.04 * $count);
                                $player->getInventory()->remove($item);
                            }

                            # diamond ore
                            if ($item->getId() === ItemIds::DIAMOND_ORE) {
                                $count = $item->getCount();
                                $sellprice = $sellprice + (7.34 * $count);
                                $player->getInventory()->remove($item);
                            }
                            # diamond
                            if ($item->getId() === ItemIds::DIAMOND) {
                                $count = $item->getCount();
                                $sellprice = $sellprice + (38.85 * $count);
                                $player->getInventory()->remove($item);
                            }
                            # diamond block
                            if ($item->getId() === ItemIds::DIAMOND_BLOCK) {
                                $count = $item->getCount();
                                $sellprice = $sellprice + (155.40 * $count);
                                $player->getInventory()->remove($item);
                            }

                            # emerald ore
                            if ($item->getId() === ItemIds::EMERALD_ORE) {
                                $count = $item->getCount();
                                $sellprice = $sellprice + (27.35 * $count);
                                $player->getInventory()->remove($item);
                            }
                            # emerald
                            if ($item->getId() === ItemIds::EMERALD) {
                                $count = $item->getCount();
                                $sellprice = $sellprice + (144.92 * $count);
                                $player->getInventory()->remove($item);
                            }
                            # emerald block
                            if ($item->getId() === ItemIds::EMERALD_BLOCK) {
                                $count = $item->getCount();
                                $sellprice = $sellprice + (579.68 * $count);
                                $player->getInventory()->remove($item);
                            }
                        }
                    }
                    # sell messages
                    if ($sellprice === 0) {
                        $player->sendMessage(Variables::ERROR_PREFIX . TF::GRAY . "You do not have any sellable items in your inventory.");
                        $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    } else {
                        DataManager::getInstance()->setPlayerData($player->getXuid(), "money", DataManager::getInstance()->getPlayerData($player->getXuid(), "money") + $sellprice);
                        $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have sold your inventory for " . TF::GREEN . "$" . TF::WHITE . Translator::shortNumber($sellprice));
                        $player->broadcastSound(new XpCollectSound(), [$player]);
                    }
                    # check tutorial stage
                    $tutorialProgress = (new TutorialManager())->getPlayerTutorialProgress($player);
                    if($tutorialProgress == 2) {
                        # update player tutorial progression
                        DataManager::getInstance()->setPlayerData($player->getXuid(), "tutorial-progress", DataManager::getInstance()->getPlayerData($player->getXuid(), "tutorial-progress") + 1);

                        # start next tutorial stage
                        (new TutorialManager())->startTutorial($player);
                    }
                    break;

                # purchase equipment
                case "blacksmith":
                    $event->cancel();
                    $merchants = new Merchants();
                    $extraData = $player->getPlayerInfo()->getExtraData();
                    switch($extraData["DeviceOS"]) {

                        case DeviceOS::IOS:
                        case DeviceOS::ANDROID:
                        case DeviceOS::PLAYSTATION:
                        case DeviceOS::XBOX:
                        case DeviceOS::NINTENDO:
                            $player->broadcastSound(new BarrelOpenSound(), [$player]);
                            $merchants->BlacksmithForm($player);
                            break;

                        case DeviceOS::WINDOWS_10:
                        case DeviceOS::OSX:
                            $player->broadcastSound(new ChestOpenSound(), [$player]);
                            $merchants->BlacksmithInventory($player);
                            break;
                    }
                    break;

                # purchase food
                case "chef":
                    $event->cancel();
                    $merchants = new Merchants();
                    $merchants->Chef($player);
                    break;

                # ship captain
                case "captain":
                    $event->cancel();
                    if(PrisonManager::getData("Players", $player->getName(), "level") >= 10) {
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
                                            ->setHandler(function (): void {
                                                return;
                                            })]);
                                    $dialogue->displayTo([$player]);
                                })]);
                        $dialogue->displayTo([$player]);
                    } else {
                        $player->sendMessage(TF::BOLD . TF::YELLOW . "Captain " . TF::GRAY . "You need to reach " . TF::BOLD . "Level 10 " . TF::RESET . TF::GRAY . "to use the " . TF::BOLD . TF::GOLD . "Space Shuttle");
                    }
                    break;

                # buy enchants
                case "enchanter":
                    $event->cancel();
                    $form = new CustomEnchantMenu();
                    $form->Form($player);
                    $player->broadcastSound(new BarrelOpenSound(), [$player]);
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
                    $item = $player->getInventory()->getItemInHand();
                    if($item->getId() === ItemIds::ENCHANTED_BOOK && count($item->getEnchantments()) > 0) {
                        $cexp = 0;

                        foreach ($item->getEnchantments() as $enchant) {
                            $rarity = $enchant->getType()->getRarity();
                            $level = $enchant->getLevel();
                            $number = 1 . $level;
                            $multiplier = number_format($number / 10, 1);
                            switch ($rarity) {

                                case CustomEnchant::RARITY_ELITE:
                                    $cexp = 500 * $multiplier;
                                    break;

                                case CustomEnchant::RARITY_ULTIMATE:
                                    $cexp = 1000 * $multiplier;
                                    break;

                                case CustomEnchant::RARITY_LEGENDARY:
                                    $cexp = 2500 * $multiplier;
                                    break;

                                case CustomEnchant::RARITY_GODLY:
                                    $cexp = 5000 * $multiplier;
                                    break;

                                case CustomEnchant::RARITY_HEROIC:
                                    $cexp = 7500 * $multiplier;
                                    break;

                                case CustomEnchant::RARITY_EXECUTIVE:
                                    $cexp = 10000 * $multiplier;
                                    break;
                            }
                        }
                        $count = count($item->getEnchantments());
                        $totalCexp = $cexp * $count;

                        $player->sendMessage(TF::GREEN . "You Tinkered an Enchantment Book " . TF::AQUA . "+$totalCexp CEXP");
                        $player->broadcastSound(new XpLevelUpSound(30), [$player]);
                        $player->getInventory()->setItemInHand(VanillaItems::AIR());
                        DataManager::getInstance()->setPlayerData($player->getXuid(), "cexp", DataManager::getInstance()->getPlayerData($player->getXuid(), "cexp") + $totalCexp);

                    } else {
                        $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You are not holding an enchantment book");
                    }
                    break;

                case "pickaxe_prestige":
                    $event->cancel();
                    $player->sendMessage(TF::BOLD . TF::AQUA . "Pickaxe Prestige: " . TF::RESET . TF::GRAY . "Come back at a later date...");
                    break;

                case "player_prestige":
                    $event->cancel();
                    $player->sendMessage(TF::BOLD . TF::RED . "Player Prestige: " . TF::RESET . TF::GRAY . "Come back at a later date...");
                    break;
            }
        }
    }
}