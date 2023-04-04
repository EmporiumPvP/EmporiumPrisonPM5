<?php

namespace Emporium\Prison\Menus;

use customiesdevs\customies\item\CustomiesItemFactory;

use Emporium\Prison\library\formapi\SimpleForm;
use Emporium\Prison\EmporiumPrison;
use Emporium\Prison\tasks\TeleportTask;
use Emporium\Prison\Variables;

use EmporiumData\DataManager;

use muqsit\invmenu\InvMenu;
use muqsit\invmenu\transaction\DeterministicInvMenuTransaction;
use muqsit\invmenu\type\InvMenuTypeIds;

use pocketmine\block\VanillaBlocks;
use pocketmine\item\Item;
use pocketmine\item\ItemIds;
use pocketmine\item\StringToItemParser;
use pocketmine\item\VanillaItems;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;
use pocketmine\world\Position;
use pocketmine\world\sound\EndermanTeleportSound;
use pocketmine\world\sound\ItemFrameAddItemSound;

class Mines extends Menu {

    public function Inventory(Player $player): void {
        $menu = InvMenu::create(InvMenuTypeIds::TYPE_CHEST);
        $menu->setName(TF::BOLD . TF::GRAY . "Warps");
        $menu->setListener(InvMenu::readonly(function(DeterministicInvMenuTransaction $transaction) {
            $player = $transaction->getPlayer();
            $itemClicked = $transaction->getItemClicked();
            $playerLevel = DataManager::getInstance()->getPlayerData($player->getXuid(),  "profile.level");
            # coal mine
            if($itemClicked->getId() === ItemIds::COAL_ORE) {
                $mine = new Position(-1443.5, 246, -38.5, EmporiumPrison::getInstance()->getServer()->getWorldManager()->getWorldByName("world"));
                EmporiumPrison::getInstance()->getScheduler()->scheduleRepeatingTask(new TeleportTask($player, $mine, 10), 20);
                $player->broadcastSound(new EndermanTeleportSound(), [$player]);
            }
            # iron mine
            if($itemClicked->getId() === ItemIds::IRON_ORE) {
                if($playerLevel >= 10) {
                    $mine = new Position(-1133.5, 245, 281.5, EmporiumPrison::getInstance()->getServer()->getWorldManager()->getWorldByName("world"));
                    EmporiumPrison::getInstance()->getScheduler()->scheduleRepeatingTask(new TeleportTask($player, $mine, 10), 20);
                    $player->broadcastSound(new EndermanTeleportSound(), [$player]);
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                }
            }
            # lapis mine
            if($itemClicked->getId() === ItemIds::LAPIS_ORE) {
                if($playerLevel >= 30) {
                    $mine = new Position(-709.5, 245, -173.5, EmporiumPrison::getInstance()->getServer()->getWorldManager()->getWorldByName("world"));
                    EmporiumPrison::getInstance()->getScheduler()->scheduleRepeatingTask(new TeleportTask($player, $mine, 10), 20);
                    $player->broadcastSound(new EndermanTeleportSound(), [$player]);
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                }
            }
            # redstone mine
            if($itemClicked->getId() === ItemIds::REDSTONE_ORE) {
                if($playerLevel >= 50) {
                    $mine = new Position(-390.5, 244, 209.5, EmporiumPrison::getInstance()->getServer()->getWorldManager()->getWorldByName("world"));
                    EmporiumPrison::getInstance()->getScheduler()->scheduleRepeatingTask(new TeleportTask($player, $mine, 10), 20);
                    $player->broadcastSound(new EndermanTeleportSound(), [$player]);
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                }
            }
            # gold mine
            if($itemClicked->getId() === ItemIds::GOLD_ORE) {
                if($playerLevel >= 70) {
                    $mine = new Position(7.5, 246, -96.5, EmporiumPrison::getInstance()->getServer()->getWorldManager()->getWorldByName("world"));
                    EmporiumPrison::getInstance()->getScheduler()->scheduleRepeatingTask(new TeleportTask($player, $mine, 10), 20);
                    $player->broadcastSound(new EndermanTeleportSound(), [$player]);
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                }
            }
            # diamond mine
            if($itemClicked->getId() === ItemIds::DIAMOND_ORE) {
                if($playerLevel >= 90) {
                    $mine = new Position(405.5, 244, 194.5, EmporiumPrison::getInstance()->getServer()->getWorldManager()->getWorldByName("world"));
                    EmporiumPrison::getInstance()->getScheduler()->scheduleRepeatingTask(new TeleportTask($player, $mine, 10), 20);
                    $player->broadcastSound(new EndermanTeleportSound(), [$player]);
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                }
            }
            # emerald mine
            if($itemClicked->getId() === ItemIds::EMERALD_ORE) {
                if($playerLevel >= 100) {
                    $mine = new Position(1273.5, 245, -176.5, EmporiumPrison::getInstance()->getServer()->getWorldManager()->getWorldByName("world"));
                    EmporiumPrison::getInstance()->getScheduler()->scheduleRepeatingTask(new TeleportTask($player, $mine, 10), 20);
                    $player->broadcastSound(new EndermanTeleportSound(), [$player]);
                } else {
                    $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                }
            }
            $player->removeCurrentWindow();
        }));
        $inventory = $menu->getInventory();

        # information
        $inventory->setItem(22, self::information());
        # mines
        $inventory->setItem(1, self::coalWarp());
        $inventory->setItem(2, self::ironWarp($player));
        $inventory->setItem(3, self::lapisWarp($player));
        $inventory->setItem(4, self::redstoneWarp($player));
        $inventory->setItem(5, self::goldMine($player));
        $inventory->setItem(6, self::diamondMine($player));
        $inventory->setItem(7, self::emeraldMine($player));
        # badlands
        $inventory->setItem(10, self::chainBadlands());
        $inventory->setItem(12, self::goldBadlands());
        $inventory->setItem(14, self::ironBadlands());
        $inventory->setItem(16, self::diamondBadlands());
        # fill empty slots
        for($i = 0; $i <= 26; $i++) {
            if($inventory->isSlotEmpty($i)) {
                $inventory->setItem($i, $this->filler());
            }
        }

        # send menu to player
        $menu->send($player);
    }

    # menu items
    public function filler(): Item {
        $item = CustomiesItemFactory::getInstance()->get("2dglasspanes:pane_lightgrey");
        $item->setCustomName("§r");
        return $item;
    }
    public function information(): Item {
        $item = StringToItemParser::getInstance()->parse("book");
        $item->setCustomName(TF::BOLD . TF::GREEN . "Information");
        $lore = [
            "",
            TF::GRAY . "Click for more information",
            TF::GRAY . "about mines and Badlands"
        ];
        $item->setLore($lore);
        return $item;
    }
    # mines
    public function coalWarp(): Item {

        $item = VanillaBlocks::COAL_ORE()->asItem();
        $item->setCustomName(TF::BOLD . TF::DARK_GRAY . "Coal Mine");
        $lore = [
            TF::BOLD . TF::GREEN . "UNLOCKED",
            "§r",
            TF::BOLD . TF::DARK_GRAY . "Ore: " . TF::WHITE . "Coal",
            TF::BOLD . TF::DARK_GRAY . "Required Level: " . TF::WHITE . "1 or Prestige " . TF::LIGHT_PURPLE . "<" . TF::AQUA . "I" . TF::LIGHT_PURPLE . ">",
            "§r",
            TF::GRAY . "(Click to teleport)"
        ];
        $item->setLore($lore);
        return $item;
    }
    public function ironWarp(Player $player): Item {

        $playerLevel = DataManager::getInstance()->getPlayerData($player->getXuid(),  "profile.level");
        $item = VanillaBlocks::IRON_ORE()->asItem();
        $item->setCustomName(TF::BOLD . TF::GRAY . "Iron Mine");
        if($playerLevel >= 10) {
            # mine unlocked
            $lore = [
                TF::BOLD . TF::GREEN . "UNLOCKED",
                "§r",
                TF::BOLD . TF::GRAY . "Ore: " . TF::WHITE . "Iron",
                TF::BOLD . TF::GRAY . "Required Level: " . TF::WHITE . "10 or Prestige " . TF::LIGHT_PURPLE . "<" . TF::AQUA . "I" . TF::LIGHT_PURPLE . ">",
                "§r",
                TF::GRAY . "(Click to teleport)"
            ];
        } else {
            # mine locked
            $lore = [
                TF::BOLD . TF::RED . "LOCKED",
                "§r",
                TF::BOLD . TF::GRAY . "Ore: " . TF::WHITE . "Iron",
                TF::BOLD . TF::GRAY . "Required Level: " . TF::WHITE . "10 or Prestige " . TF::LIGHT_PURPLE . "<" . TF::AQUA . "I" . TF::LIGHT_PURPLE . ">",
                "§r",
                TF::RED . "Reach the required level or",
                TF::RED . "to access this mine."
            ];
        }
        $item->setLore($lore);
        return $item;
    }
    public function lapisWarp(Player $player): Item {

        $playerLevel = DataManager::getInstance()->getPlayerData($player->getXuid(),  "profile.level");
        $item = VanillaBlocks::LAPIS_LAZULI_ORE()->asItem();
        $item->setCustomName(TF::BOLD . TF::BLUE . "Lapis Mine");
        if($playerLevel >= 30) {
            # mine unlocked
            $lore = [
                TF::BOLD . TF::GREEN . "UNLOCKED",
                "§r",
                TF::BOLD . TF::BLUE . "Ore: " . TF::WHITE . "Lapis",
                TF::BOLD . TF::BLUE . "Required Level: " . TF::WHITE . "30 or Prestige " . TF::LIGHT_PURPLE . "<" . TF::AQUA . "I" . TF::LIGHT_PURPLE . ">",
                "§r",
                TF::GRAY . "(Click to teleport)"
            ];
        } else {
            # mine locked
            $lore = [
                TF::BOLD . TF::RED . "LOCKED",
                "§r",
                TF::BOLD . TF::BLUE . "Ore: " . TF::WHITE . "Lapis",
                TF::BOLD . TF::BLUE . "Required Level: " . TF::WHITE . "30 or Prestige " . TF::LIGHT_PURPLE . "<" . TF::AQUA . "I" . TF::LIGHT_PURPLE . ">",
                "§r",
                TF::RED . "Reach the required level or",
                TF::RED . "to access this mine."
            ];
        }
        $item->setLore($lore);
        return $item;
    }
    public function redstoneWarp(Player $player): Item {

        $playerLevel = DataManager::getInstance()->getPlayerData($player->getXuid(),  "profile.level");
        $item = VanillaBlocks::REDSTONE_ORE()->asItem();
        $item->setCustomName(TF::BOLD . TF::DARK_RED . "Redstone Mine");
        if($playerLevel >= 50) {
            # mine unlocked
            $lore = [
                TF::BOLD . TF::GREEN . "UNLOCKED",
                "§r",
                TF::BOLD . TF::DARK_RED . "Ore: " . TF::WHITE . "Redstone",
                TF::BOLD . TF::DARK_RED . "Required Level: " . TF::WHITE . "50 or Prestige " . TF::LIGHT_PURPLE . "<" . TF::AQUA . "I" . TF::LIGHT_PURPLE . ">",
                "§r",
                TF::GRAY . "(Click to teleport)"
            ];
        } else {
            # mine locked
            $lore = [
                TF::BOLD . TF::RED . "LOCKED",
                "§r",
                TF::BOLD . TF::DARK_RED . "Ore: " . TF::WHITE . "Redstone",
                TF::BOLD . TF::DARK_RED . "Required Level: " . TF::WHITE . "50 or Prestige " . TF::LIGHT_PURPLE . "<" . TF::AQUA . "I" . TF::LIGHT_PURPLE . ">",
                "§r",
                TF::RED . "Reach the required level or",
                TF::RED . "to access this mine."
            ];
        }
        $item->setLore($lore);
        return $item;
    }
    public function goldMine(Player $player): Item {

        $playerLevel = DataManager::getInstance()->getPlayerData($player->getXuid(),  "profile.level");
        $item = VanillaBlocks::GOLD_ORE()->asItem();
        $item->setCustomName(TF::BOLD . TF::YELLOW . "Gold Mine");
        if($playerLevel >= 70) {
            # mine unlocked
            $lore = [
                TF::BOLD . TF::GREEN . "UNLOCKED",
                "§r",
                TF::BOLD . TF::YELLOW . "Ore: " . TF::WHITE . "Gold",
                TF::BOLD . TF::YELLOW . "Required Level: " . TF::WHITE . "70 or Prestige " . TF::LIGHT_PURPLE . "<" . TF::AQUA . "I" . TF::LIGHT_PURPLE . ">",
                "§r",
                TF::GRAY . "(Click to teleport)"
            ];
        } else {
            # mine locked
            $lore = [
                TF::BOLD . TF::RED . "LOCKED",
                "§r",
                TF::BOLD . TF::YELLOW . "Ore: " . TF::WHITE . "Gold",
                TF::BOLD . TF::YELLOW . "Required Level: " . TF::WHITE . "70 or Prestige " . TF::LIGHT_PURPLE . "<" . TF::AQUA . "I" . TF::LIGHT_PURPLE . ">",
                "§r",
                TF::RED . "Reach the required level or",
                TF::RED . "to access this mine."
            ];
        }
        $item->setLore($lore);
        return $item;
    }
    public function diamondMine(Player $player): Item {

        $playerLevel = DataManager::getInstance()->getPlayerData($player->getXuid(),  "profile.level");
        $item = VanillaBlocks::DIAMOND_ORE()->asItem();
        $item->setCustomName(TF::BOLD . TF::AQUA . "Diamond Mine");
        if($playerLevel >= 90) {
            # mine unlocked
            $lore = [
                TF::BOLD . TF::GREEN . "UNLOCKED",
                "§r",
                TF::BOLD . TF::AQUA . "Ore: " . TF::WHITE . "Diamond",
                TF::BOLD . TF::AQUA . "Required Level: " . TF::WHITE . "90 or Prestige " . TF::LIGHT_PURPLE . "<" . TF::AQUA . "I" . TF::LIGHT_PURPLE . ">",
                "§r",
                TF::GRAY . "(Click to teleport)"
            ];
        } else {
            # mine locked
            $lore = [
                TF::BOLD . TF::RED . "LOCKED",
                "§r",
                TF::BOLD . TF::AQUA . "Ore: " . TF::WHITE . "Diamond",
                TF::BOLD . TF::AQUA . "Required Level: " . TF::WHITE . "90 or Prestige " . TF::LIGHT_PURPLE . "<" . TF::AQUA . "I" . TF::LIGHT_PURPLE . ">",
                "§r",
                TF::RED . "Reach the required level or",
                TF::RED . "to access this mine."
            ];
        }
        $item->setLore($lore);
        return $item;
    }
    public function emeraldMine(Player $player): Item {

        $playerLevel = DataManager::getInstance()->getPlayerData($player->getXuid(),  "profile.level");
        $item = VanillaBlocks::EMERALD_ORE()->asItem();
        $item->setCustomName(TF::BOLD . TF::GREEN . "Emerald Mine");
        if($playerLevel >= 100) {
            # mine unlocked
            $lore = [
                TF::BOLD . TF::GREEN . "UNLOCKED",
                "§r",
                TF::BOLD . TF::GREEN . "Ore: " . TF::WHITE . "Emerald",
                TF::BOLD . TF::GREEN . "Required Level: " . TF::WHITE . "100 or Prestige " . TF::LIGHT_PURPLE . "<" . TF::AQUA . "I" . TF::LIGHT_PURPLE . ">",
                "§r",
                TF::GRAY . "(Click to teleport)"
            ];
        } else {
            # mine locked
            $lore = [
                TF::BOLD . TF::RED . "LOCKED",
                "§r",
                TF::BOLD . TF::GREEN . "Ore: " . TF::WHITE . "Emerald",
                TF::BOLD . TF::GREEN . "Required Level: " . TF::WHITE . "100 or Prestige " . TF::LIGHT_PURPLE . "<" . TF::AQUA . "I" . TF::LIGHT_PURPLE . ">",
                "§r",
                TF::RED . "Reach the required level or",
                TF::RED . "to access this mine."
            ];
        }
        $item->setLore($lore);
        return $item;
    }
    # badlands
    public function chainBadlands(): Item {
        $item = StringToItemParser::getInstance()->parse("stone_axe");
        $item->setCustomName(TF::BOLD . TF::RED . "Badlands: " . TF::GOLD . "Chain");
        $lore = [
            TF::BOLD . TF::RED . "COMING SOON",
            "§r",
            TF::BOLD . TF::GOLD . "Ore Bandits: " . TF::WHITE . "Coal, Iron",
            TF::BOLD . TF::GOLD . "PvP: " . TF::RED . "DISABLED",
            TF::BOLD . TF::GOLD . "Keep Inventory: " . TF::GREEN . "ENABLED",
            TF::BOLD . TF::GOLD . "Required Level: " . TF::WHITE . "1",
            TF::BOLD . TF::GOLD . "Danger: " . TF::GREEN . "LOW",
            "§r",
            TF::GRAY . "(Click to Teleport)"
        ];
        $item->setLore($lore);
        return $item;
    }
    public function goldBadlands(): Item {
        $item = StringToItemParser::getInstance()->parse("gold_axe");
        $item->setCustomName(TF::BOLD . TF::RED . "Badlands: " . TF::YELLOW . "Gold");
        $lore = [
            TF::BOLD . TF::RED . "COMING SOON",
            "§r",
            TF::BOLD . TF::GOLD . "Ore Bandits: " . TF::WHITE . "Lapis, Redstone",
            TF::BOLD . TF::GOLD . "PvP: " . TF::RED . "DISABLED",
            TF::BOLD . TF::GOLD . "Keep Inventory: " . TF::GREEN . "ENABLED",
            TF::BOLD . TF::GOLD . "Required Level: " . TF::WHITE . "30",
            TF::BOLD . TF::GOLD . "Danger: " . TF::YELLOW . "MODERATE",
            "§r",
            TF::GRAY . "(Click to Teleport)"
        ];
        $item->setLore($lore);
        return $item;
    }
    public function ironBadlands(): Item {
        $item = StringToItemParser::getInstance()->parse("iron_Axe");
        $item->setCustomName(TF::BOLD . TF::RED . "Badlands: " . TF::GRAY . "Iron");
        $lore = [
            TF::BOLD . TF::RED . "COMING SOON",
            "§r",
            TF::BOLD . TF::GOLD . "Ore Bandits: " . TF::WHITE . "Redstone, Gold",
            TF::BOLD . TF::GOLD . "PvP: " . TF::RED . "DISABLED",
            TF::BOLD . TF::GOLD . "Keep Inventory: " . TF::GREEN . "ENABLED",
            TF::BOLD . TF::GOLD . "Required Level: " . TF::WHITE . "50",
            TF::BOLD . TF::GOLD . "Danger: " . TF::DARK_PURPLE . "HIGH",
            "§r",
            TF::GRAY . "(Click to Teleport)"
        ];
        $item->setLore($lore);
        return $item;
    }
    public function diamondBadlands(): Item {
        $item = StringToItemParser::getInstance()->parse("diamond_axe");
        $item->setCustomName(TF::BOLD . TF::RED . "Badlands: " . TF::AQUA . "Diamond");
        $lore = [
            TF::BOLD . TF::RED . "COMING SOON",
            "§r",
            TF::BOLD . TF::GOLD . "Ore Bandits: " . TF::WHITE . "Diamond, Emerald",
            TF::BOLD . TF::GOLD . "PvP: " . TF::RED . "DISABLED",
            TF::BOLD . TF::GOLD . "Keep Inventory: " . TF::GREEN . "ENABLED",
            TF::BOLD . TF::GOLD . "Required Level: " . TF::WHITE . "90",
            TF::BOLD . TF::GOLD . "Danger: " . TF::RED . "EXTREME",
            "§r",
            TF::GRAY . "(Click to Teleport)"
        ];
        $item->setLore($lore);
        return $item;
    }

    public function Form(Player $player): void {

        $form = new SimpleForm(function($player, $data) {

            $inventory = $player->getInventory();
            $traineePickaxe = VanillaItems::WOODEN_PICKAXE();
            $stonePickaxe = VanillaItems::STONE_PICKAXE();
            $ironPickaxe = VanillaItems::IRON_PICKAXE();
            $diamondPickaxe = VanillaItems::DIAMOND_PICKAXE();

            $playerLevel = EmporiumPrison::getInstance()->getPlayerLevelManager()->getPlayerLevel($player);

            if($data === null) {
                return;
            }

            switch($data) {

                case 0: # coal mine
                    if($inventory->contains($stonePickaxe) || $inventory->contains($ironPickaxe) || $inventory->contains($diamondPickaxe)) {
                        $player->sendMessage(Variables::SERVER_PREFIX . "You can only bring a Trainee Pickaxe to this mine.");
                    } else {
                        $player->teleport(new Position(-1444.5, 246, -39.5, EmporiumPrison::getInstance()->getServer()->getWorldManager()->getWorldByName("world")));
                        $player->broadcastSound(new EndermanTeleportSound(), [$player]);
                        $player->sendTitle(TF::BOLD . TF::GREEN . "MINE");
                        $player->sendSubTitle(TF::GRAY . "Coal");
                    }
                    break;

                case 1: # iron mine (level 20 required)
                    if($playerLevel < 20) {
                        $this->ironMineInfo($player);
                    } else {
                        if($inventory->contains($stonePickaxe) || $inventory->contains($ironPickaxe) || $inventory->contains($diamondPickaxe)) {
                            $player->sendMessage(Variables::SERVER_PREFIX . "You can only bring a Trainee Pickaxe to this mine.");
                        } else {
                            $player->teleport(new Position(-1133.5, 245, 281.5, EmporiumPrison::getInstance()->getServer()->getWorldManager()->getWorldByName("world")));
                            $player->broadcastSound(new EndermanTeleportSound(), [$player]);
                            $player->sendTitle(TF::BOLD . TF::GREEN . "MINE");
                            $player->sendSubTitle(TF::WHITE . "Iron");
                        }
                    }
                    break;

                case 2: # lapis mine (level 30 required)
                    if($playerLevel < 30) {
                        $this->lapisMineInfo($player);
                    } else {
                        if($inventory->contains($traineePickaxe) || $inventory->contains($stonePickaxe) || $inventory->contains($diamondPickaxe)) {
                            $player->sendMessage(Variables::SERVER_PREFIX . "You can only bring an Iron Pickaxe to this mine.");
                        } else {
                            $player->teleport(new Position(-709.5, 245, -173.5, EmporiumPrison::getInstance()->getServer()->getWorldManager()->getWorldByName("world")));
                            $player->broadcastSound(new EndermanTeleportSound(), [$player]);
                            $player->sendTitle(TF::BOLD . TF::GREEN . "MINE");
                            $player->sendSubTitle(TF::BLUE . "Lapis");
                        }
                    }
                    break;

                case 3: # redstone mine (level 50 required)
                    if($playerLevel < 50) {
                        $this->redstoneMineInfo($player);
                    } else {
                        if($inventory->contains($traineePickaxe) || $inventory->contains($ironPickaxe) || $inventory->contains($diamondPickaxe)) {
                            $player->sendMessage(Variables::SERVER_PREFIX . "You can only bring a Stone Pickaxe to this mine.");
                        } else {
                            $player->teleport(new Position(-390.5, 244, 209.5, EmporiumPrison::getInstance()->getServer()->getWorldManager()->getWorldByName("world")));
                            $player->broadcastSound(new EndermanTeleportSound(), [$player]);
                            $player->sendTitle(TF::BOLD . TF::GREEN . "MINE");
                            $player->sendSubTitle(TF::RED . "Redstone");
                        }
                    }
                    break;

                case 4: # gold mine (level 70 required)
                    if($playerLevel < 70) {
                        $this->goldMineInfo($player);
                    } else {
                        if($inventory->contains($traineePickaxe) || $inventory->contains($stonePickaxe) || $inventory->contains($diamondPickaxe)) {
                            $player->sendMessage(Variables::SERVER_PREFIX . "You can only bring an Iron Pickaxe to this mine.");
                        } else {
                            $player->teleport(new Position(7.5, 246, -96.5, EmporiumPrison::getInstance()->getServer()->getWorldManager()->getWorldByName("world")));
                            $player->broadcastSound(new EndermanTeleportSound(), [$player]);
                            $player->sendTitle(TF::BOLD . TF::GREEN . "MINE");
                            $player->sendSubTitle(TF::GOLD . "Gold");
                        }
                    }
                    break;

                case 5: # diamond mine (level 90 required)
                    if($playerLevel < 90) {
                        $this->diamondMineInfo($player);
                    } else {
                        if($inventory->contains($traineePickaxe) || $inventory->contains($stonePickaxe) || $inventory->contains($ironPickaxe)) {
                            $player->sendMessage(Variables::SERVER_PREFIX . "You can only bring a Diamond Pickaxe to this mine.");
                        } else {
                            $player->teleport(new Position(405.5, 244, 194.5, EmporiumPrison::getInstance()->getServer()->getWorldManager()->getWorldByName("world")));
                            $player->broadcastSound(new EndermanTeleportSound(), [$player]);
                            $player->sendTitle(TF::BOLD . TF::GREEN . "MINE");
                            $player->sendSubTitle(TF::AQUA . "Diamond");
                        }
                    }
                    break;

                case 6: # emerald mine (level 100 required)
                    if($playerLevel < 100) {
                        $this->emeraldMineInfo($player);
                    } else {
                        if($inventory->contains($traineePickaxe) || $inventory->contains($stonePickaxe) || $inventory->contains($ironPickaxe)) {
                            $player->sendMessage(Variables::SERVER_PREFIX . "You can only bring a Diamond Pickaxe to this mine.");
                        } else {
                            $player->teleport(new Position(1273.5, 245, -176.5, EmporiumPrison::getInstance()->getServer()->getWorldManager()->getWorldByName("world")));
                            $player->broadcastSound(new EndermanTeleportSound(), [$player]);
                            $player->sendTitle(TF::BOLD . TF::GREEN . "MINE");
                            $player->sendSubTitle(TF::GREEN . "Emerald");
                        }
                    }
                    break;

                case 7: # exit
                    break;
            }
        });
        $playerLevel = EmporiumPrison::getInstance()->getPlayerLevelManager()->getPlayerLevel($player);

        $form->setTitle(TF::DARK_AQUA);
        $form->setContent(TF::GRAY . "Select a mine to teleport to it");
        $form->addButton(TF::BLACK . "Coal Mine\n" . TF::DARK_GRAY . "(Click To Teleport)");
        if($playerLevel < 10) {
            $form->addButton(TF::BOLD . TF::RED . "Iron Mine\n" . TF::RESET . TF::DARK_GRAY . "(Click For Info)");
        } else {
            $form->addButton(TF::WHITE . "Iron Mine\n" . TF::DARK_GRAY . "(Click To Teleport)");
        }

        if($playerLevel < 20) {
            $form->addButton(TF::BOLD . TF::RED . "Redstone Mine\n" . TF::RESET . TF::DARK_GRAY . "(Click For Info)");
        } else {
            $form->addButton(TF::RED . "Redstone Mine\n" . TF::DARK_GRAY . "(Click To Teleport)");
        }

        if($playerLevel < 30) {
            $form->addButton(TF::BOLD . TF::RED . "Lapis Mine\n" . TF::RESET . TF::DARK_GRAY . "(Click For Info)");
        } else {
            $form->addButton(TF::BLUE . "Lapis Mine\n" . TF::DARK_GRAY . "(Click To Teleport)");
        }

        if($playerLevel < 40) {
            $form->addButton(TF::BOLD . TF::RED . "Gold Mine\n" . TF::RESET . TF::DARK_GRAY . "(Click For Info)");
        } else {
            $form->addButton(TF::GOLD . "Gold Mine\n" . TF::DARK_GRAY . "(Click To Teleport)");
        }

        if($playerLevel < 50) {
            $form->addButton(TF::BOLD . TF::RED . "Diamond Mine\n" . TF::RESET . TF::DARK_GRAY . "(Click For Info)");
        } else {
            $form->addButton(TF::AQUA . "Diamond Mine\n" . TF::DARK_GRAY . "(Click To Teleport)");
        }

        if($playerLevel < 60) {
            $form->addButton(TF::BOLD . TF::RED . "Emerald Mine\n" . TF::RESET . TF::DARK_GRAY . "(Click For Info)");
        } else {
            $form->addButton(TF::GREEN . "Emerald Mine\n" . TF::DARK_GRAY . "(Click To Teleport)");
        }
        $form->addButton(TF::DARK_RED . "Exit");
        $player->sendForm($form);
    }

    public function MinesInfoForm(Player $player): SimpleForm {

        $form = new SimpleForm(function($player, $data) {
            if($data === null) {
                return;
            }
            switch($data) {
                case 0:
                    $this->coalMineInfo($player);
                    break;

                case 1:
                    $this->ironMineInfo($player);
                    break;

                case 2:
                    $this->lapisMineInfo($player);
                    break;

                case 3:
                    $this->redstoneMineInfo($player);
                    break;

                case 4:
                    $this->goldMineInfo($player);
                    break;

                case 5:
                    $this->diamondMineInfo($player);
                    break;

                case 6:
                    $this->emeraldMineInfo($player);
                    break;
            }
        });
        $form->setTitle("mines - Info");
        $form->addButton(TF::GRAY . "Coal Mine\n(Click Me)");
        $form->addButton(TF::GRAY . "Iron Mine\n(Click Me)");
        $form->addButton(TF::GRAY . "Lapis Mine\n(Click Me)");
        $form->addButton(TF::GRAY . "Redstone Mine\n(Click Me)");
        $form->addButton(TF::GRAY . "Gold Mine\n(Click Me)");
        $form->addButton(TF::GRAY . "Diamond Mine\n(Click Me)");
        $form->addButton(TF::GRAY . "Emerald Mine\n(Click Me)");
        $form->addButton(TF::DARK_RED . "Exit");
        $player->sendForm($form);
        return $form;
    }
    public function coalMineInfo($player): SimpleForm {

        $form = new SimpleForm(function($player) {
            $this->MinesInfoForm($player);
        });
        $form->setTitle("Coal Mine - Information");
        $form->setContent(TF::GREEN . "RESOURCES:\n" . TF::RESET . TF::GRAY . "Coal Ore\nCoal Block\nMeteors\n\n" . TF::GREEN . "PICKAXE:\n" . TF::RESET . TF::GRAY . "Trainee\n\n" . TF::GREEN . "ARMOUR:\n" . TF::RESET . TF::GRAY . "Chain\n\n" . TF::RED . "GUARDS:\n" . TF::RESET . TF::GRAY . "Coal Bandit");
        $form->addButton(TF::RED . "Back" . TF::GRAY . "\n(Click Me)");
        $player->sendForm($form);
        return $form;
    }
    public function ironMineInfo($player): SimpleForm {

        $form = new SimpleForm(function($player) {
            $this->MinesInfoForm($player);
        });
        $form->setTitle("Iron Mine - Information");
        $form->setContent(TF::GREEN . "RESOURCES:\n" . TF::RESET . TF::GRAY . "Iron Ore\nIron Block\nMeteors\n\n" . TF::GREEN . "PICKAXE:\n" . TF::RESET . TF::GRAY . "Trainee\n\n" . TF::GREEN . "ARMOUR:\n" . TF::RESET . TF::GRAY . "Chain\n\n" . TF::RED . "GUARDS:\n" . TF::RESET . TF::GRAY . "Iron Bandit");
        $form->addButton(TF::RED . "Back" . TF::GRAY . "\n(Click Me)");
        $player->sendForm($form);
        return $form;
    }
    public function lapisMineInfo($player): SimpleForm {

        $form = new SimpleForm(function($player) {
            $this->MinesInfoForm($player);
        });
        $form->setTitle("Lapis Mine - Information");
        $form->setContent(TF::GREEN . "RESOURCES:\n" . TF::RESET . TF::GRAY . "Lapis Ore\nLapis Block\nMeteors\n\n" . TF::GREEN . "PICKAXE:\n" . TF::RESET . TF::GRAY . "Iron\n\n" . TF::GREEN . "ARMOUR:\n" . TF::RESET . TF::GRAY . "Iron\n\n" . TF::RED . "GUARDS:\n" . TF::RESET . TF::GRAY . "Lapis Bandit");
        $form->addButton(TF::RED . "Back" . TF::GRAY . "\n(Click Me)");
        $player->sendForm($form);
        return $form;
    }
    public function redstoneMineInfo($player): SimpleForm {

        $form = new SimpleForm(function($player) {
            $this->MinesInfoForm($player);
        });
        $form->setTitle("Redstone Mine - Information");
        $form->setContent(TF::GREEN . "RESOURCES:\n" . TF::RESET . TF::GRAY . "Redstone Ore\nRedstone Block\nMeteors\n\n" . TF::GREEN . "PICKAXE:\n" . TF::RESET . TF::GRAY . "Stone\n\n" . TF::GREEN . "ARMOUR:\n" . TF::RESET . TF::GRAY . "Iron\n\n" . TF::RED . "GUARDS:\n" . TF::RESET . TF::GRAY . "Redstone Bandit");
        $form->addButton(TF::RED . "Back" . TF::GRAY . "\n(Click Me)");
        $player->sendForm($form);
        return $form;
    }
    public function goldMineInfo($player): SimpleForm {

        $form = new SimpleForm(function($player) {
            $this->MinesInfoForm($player);
        });
        $form->setTitle("Gold Mine - Information");
        $form->setContent(TF::GREEN . "RESOURCES:\n" . TF::RESET . TF::GRAY . "Gold Ore\nGold Block\nMeteors\n\n" . TF::GREEN . "PICKAXE:\n" . TF::RESET . TF::GRAY . "Iron\n\n" . TF::GREEN . "ARMOUR:\n" . TF::RESET . TF::GRAY . "Iron\n\n" . TF::RED . "GUARDS:\n" . TF::RESET . TF::GRAY . "Gold Bandit");
        $form->addButton(TF::RED . "Back" . TF::GRAY . "\n(Click Me)");
        $player->sendForm($form);
        return $form;
    }
    public function diamondMineInfo($player): SimpleForm {

        $form = new SimpleForm(function($player) {
            $this->MinesInfoForm($player);
        });
        $form->setTitle("Diamond Mine - Information");
        $form->setContent(TF::GREEN . "RESOURCES:\n" . TF::RESET . TF::GRAY . "Diamond Ore\nDiamond Block\nMeteors\n\n" . TF::GREEN . "PICKAXE:\n" . TF::RESET . TF::GRAY . "Diamond\n\n" . TF::GREEN . "ARMOUR:\n" . TF::RESET . TF::GRAY . "Diamond\n\n" . TF::RED . "GUARDS:\n" . TF::RESET . TF::GRAY . "Diamond Bandit");
        $form->addButton(TF::RED . "Back" . TF::GRAY . "\n(Click Me)");
        $player->sendForm($form);
        return $form;
    }
    public function emeraldMineInfo($player): SimpleForm {

        $form = new SimpleForm(function($player) {
            $this->MinesInfoForm($player);
        });
        $form->setTitle("Emerald Mine - Information");
        $form->setContent(TF::GREEN . "RESOURCES:\n" . TF::RESET . TF::GRAY . "Emerald Ore\nEmerald Block\nMeteors\n\n" . TF::GREEN . "PICKAXE:\n" . TF::RESET . TF::GRAY . "Diamond\n\n" . TF::GREEN . "ARMOUR:\n" . TF::RESET . TF::GRAY . "Diamond\n\n" . TF::RED . "GUARDS:\n" . TF::RESET . TF::GRAY . "Emerald Bandit");
        $form->addButton(TF::RED . "Back" . TF::GRAY . "\n(Click Me)");
        $player->sendForm($form);
        return $form;
    }

}