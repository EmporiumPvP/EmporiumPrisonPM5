<?php

namespace Emporium\Prison\Managers;

use Emporium\Prison\EmporiumPrison;
use Emporium\Prison\Managers\misc\Translator;


use pocketmine\item\Item;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;

class PickaxeManager {

    public function getType($item): String {
        return $item->getNamedTag()->getString("PickaxeType");
    }

    public function getPickaxeLevel($item): int {
        return $item->getNamedTag()->getInt("Level");
    }

    public function getEnergy($item): int {
        return $item->getNamedTag()->getTag("Energy");
    }

    public function getEnergyNeeded($item): int {
        $level = $item->getNamedTag()->getInt("Level");
        return EmporiumPrison::getInstance()->getPickaxeEnergyLevels()[$level] + 1;
    }

    public function getSuccessfulEnchants($item): int {
        return $item->getNamedTag()->getInt("SuccessfulEnchants");
    }

    public function getFailedEnchants($item): int {
        return $item->getNamedTag()->getInt("FailedEnchants");
    }

    public function getBlocksMined($item): int {
        return $item->getNamedTag()->getInt("BlocksMined");
    }

    public function addSuccessfulEnchant(Player $player, $item): Item {
        $oldData = $item->getNamedTag()->getInt("SuccessfulEnchants");
        $newData = $oldData + 1;
        $item->getNamedTag()->setInt("SuccessfulEnchants", $newData);
        $this->updatePickaxeSetInHand($player, $item);
        return $item;
    }

    public function addFailedEnchant(Player $player, $item): Item {
        $oldData = $item->getNamedTag()->getInt("FailedEnchants");
        $newData = $oldData + 1;
        $item->getNamedTag()->setInt("FailedEnchants", $newData);
        $this->updatePickaxeSetInHand($player, $item);
        return $item;
    }

    public function removeLevelUpEnergy(Player $player, $item): Item {
        $energyNeeded = $this->getEnergyNeeded($item);
        $oldData = $item->getNamedTag()->getInt("Energy");
        $newData = $oldData - $energyNeeded;
        $item->getNamedTag()->setInt("Energy", $newData);
        $this->updatePickaxeSetInHand($player, $item);
        return $item;
    }

    public function levelUpPickaxe(Player $player, $item): Item {
        $oldData = $item->getNamedTag()->getInt("Level");
        $newData = $oldData + 1;
        $item->getNamedTag()->setInt("Level", $newData);
        $this->updatePickaxeSetInHand($player, $item);
        return $item;
    }

    public function createEnergyBar($item): String {


        $pickaxeManager = EmporiumPrison::getInstance()->getPickaxeManager();

        $energy = $item->getNamedTag()->getInt("Energy");
        $energyNeeded = $pickaxeManager->getEnergyNeeded($item);
        $progress = round(($energy / $energyNeeded) * 100, +1);

        $energyBar = "";
        switch($progress) {

            # change bar to use this: 〡
            case 0:
                $energyBar = TF::RED . "|||||||||||||||||||||||||||||||| " . TF::WHITE . $progress . "%";
                break;
            case $progress <= 3:
                $energyBar = TF::GREEN . "|" . TF::RED . "||||||||||||||||||||||||||||||| " . TF::WHITE . $progress . "%";
                break;

            case $progress <= 6:
                $energyBar = TF::GREEN . "||" . TF::RED . "|||||||||||||||||||||||||||||| " . TF::WHITE . $progress . "%";
                break;

            case $progress <= 9:
                $energyBar = TF::GREEN . "|||" . TF::RED . "||||||||||||||||||||||||||||| " . TF::WHITE . $progress . "%";
                break;

            case $progress <= 12:
                $energyBar = TF::GREEN . "||||" . TF::RED . "||||||||||||||||||||||||||||| " . TF::WHITE . $progress . "%";
                break;

            case $progress <= 15:
                $energyBar = TF::GREEN . "|||||" . TF::RED . "|||||||||||||||||||||||||||| " . TF::WHITE . $progress . "%";
                break;

            case $progress <= 18:
                $energyBar = TF::GREEN . "||||||" . TF::RED . "||||||||||||||||||||||||||| " . TF::WHITE . $progress . "%";
                break;

            case $progress <= 21:
                $energyBar = TF::GREEN . "|||||||" . TF::RED . "|||||||||||||||||||||||||| " . TF::WHITE . $progress . "%";
                break;

            case $progress <= 24:
                $energyBar = TF::GREEN . "||||||||" . TF::RED . "||||||||||||||||||||||||| " . TF::WHITE . $progress . "%";
                break;

            case $progress <= 27:
                $energyBar = TF::GREEN . "|||||||||" . TF::RED . "|||||||||||||||||||||||| " . TF::WHITE . $progress . "%";
                break;

            case $progress <= 30:
                $energyBar = TF::GREEN . "||||||||||" . TF::RED . "||||||||||||||||||||||| " . TF::WHITE . $progress . "%";
                break;

            case $progress <= 33:
                $energyBar = TF::GREEN . "|||||||||||" . TF::RED . "|||||||||||||||||||||| " . TF::WHITE . $progress . "%";
                break;

            case $progress <= 36:
                $energyBar = TF::GREEN . "||||||||||||" . TF::RED . "||||||||||||||||||||| " . TF::WHITE . $progress . "%";
                break;

            case $progress <= 39:
                $energyBar = TF::GREEN . "|||||||||||||" . TF::RED . "|||||||||||||||||||| " . TF::WHITE . $progress . "%";
                break;

            case $progress <= 42:
                $energyBar = TF::GREEN . "||||||||||||||" . TF::RED . "||||||||||||||||||| " . TF::WHITE . $progress . "%";
                break;

            case $progress <= 45:
                $energyBar = TF::GREEN . "|||||||||||||||" . TF::RED . "|||||||||||||||||| " . TF::WHITE . $progress . "%";
                break;

            case $progress <= 48:
                $energyBar = TF::GREEN . "||||||||||||||||" . TF::RED . "||||||||||||||||| " . TF::WHITE . $progress . "%";
                break;

            case $progress <= 51:
                $energyBar = TF::GREEN . "|||||||||||||||||" . TF::RED . "|||||||||||||||| " . TF::WHITE . $progress . "%";
                break;

            case $progress <= 54:
                $energyBar = TF::GREEN . "||||||||||||||||||" . TF::RED . "||||||||||||||| " . TF::WHITE . $progress . "%";
                break;

            case $progress <= 57:
                $energyBar = TF::GREEN . "|||||||||||||||||||" . TF::RED . "|||||||||||||| " . TF::WHITE . $progress . "%";
                break;

            case $progress <= 60:
                $energyBar = TF::GREEN . "||||||||||||||||||||" . TF::RED . "||||||||||||| " . TF::WHITE . $progress . "%";
                break;

            case $progress <= 63:
                $energyBar = TF::GREEN . "|||||||||||||||||||||" . TF::RED . "|||||||||||| " . TF::WHITE . $progress . "%";
                break;

            case $progress <= 66:
                $energyBar = TF::GREEN . "||||||||||||||||||||||" . TF::RED . "||||||||||| " . TF::WHITE . $progress . "%";
                break;

            case $progress <= 69:
                $energyBar = TF::GREEN . "|||||||||||||||||||||||" . TF::RED . "|||||||||| " . TF::WHITE . $progress . "%";
                break;

            case $progress <= 72:
                $energyBar = TF::GREEN . "||||||||||||||||||||||||" . TF::RED . "||||||||| " . TF::WHITE . $progress . "%";
                break;

            case $progress <= 75:
                $energyBar = TF::GREEN . "|||||||||||||||||||||||||" . TF::RED . "|||||||| " . TF::WHITE . $progress . "%";
                break;

            case $progress <= 78:
                $energyBar = TF::GREEN . "||||||||||||||||||||||||||" . TF::RED . "||||||| " . TF::WHITE . $progress . "%";
                break;

            case $progress <= 81:
                $energyBar = TF::GREEN . "|||||||||||||||||||||||||||" . TF::RED . "|||||| " . TF::WHITE . $progress . "%";
                break;

            case $progress <= 84:
                $energyBar = TF::GREEN . "||||||||||||||||||||||||||||" . TF::RED . "||||| " . TF::WHITE . $progress . "%";
                break;

            case $progress <= 87:
                $energyBar = TF::GREEN . "|||||||||||||||||||||||||||||" . TF::RED . "|||| " . TF::WHITE . $progress . "%";
                break;

            case $progress <= 90:
                $energyBar = TF::GREEN . "||||||||||||||||||||||||||||||" . TF::RED . "||| " . TF::WHITE . $progress . "%";
                break;

            case $progress <= 93:
                $energyBar = TF::GREEN . "|||||||||||||||||||||||||||||||" . TF::RED . "|| " . TF::WHITE . $progress . "%";
                break;

            case $progress <= 96:
                $energyBar = TF::GREEN . "||||||||||||||||||||||||||||||||" . TF::RED . "| " . TF::WHITE . $progress . "%";
                break;

            case $progress <= 100:
                $energyBar = TF::GREEN . "|||||||||||||||||||||||||||||||||" . TF::RED . " " . TF::WHITE . $progress . "%";
                break;
        }

        return $energyBar;
    }

    public function createLore(Item $item): array {


        $level = $item->getNamedTag()->getInt("Level");
        $energy = $item->getNamedTag()->getInt("Energy");
        $successfulEnchants = $item->getNamedTag()->getInt("SuccessfulEnchants");
        $failedEnchants = $item->getNamedTag()->getInt("FailedEnchants");
        $blocksMined = $item->getNamedTag()->getInt("BlocksMined");
        $translatedEnergy = Translator::shortNumber($energy);
        $energyNeeded = $this->getEnergyNeeded($item);
        $translatedEnergyNeeded = Translator::shortNumber($energyNeeded);
        $whiteScrolled = $item->getNamedTag()->getString("whitescrolled");

        if($whiteScrolled === "white") {
            $whiteScrollMessage = TF::BOLD . TF::WHITE . "WHITE SCROLLED";
        } elseif($whiteScrolled === "holy") {
            $holyWhiteScrollMessage = TF::BOLD . TF::GOLD . "HOLY WHITE SCROLLED";
        }

        $energyBar = $this->createEnergyBar($item);
        # create lore
        if($whiteScrolled === "white") {
            if($energy >= $energyNeeded) {
                $lore = [
                    TF::RESET . " ",
                    TF::RESET . TF::GREEN . "=- " . TF::BOLD . TF::WHITE . "$successfulEnchants" . TF::RESET . TF::GREEN . " Enchants -=",
                    TF::RESET . TF::RED . "=- " . TF::BOLD . TF::WHITE . "$failedEnchants" . TF::RESET . TF::RED . " Failures -=",
                    TF::RESET . " ",
                    TF::RESET . TF::BOLD . TF::AQUA . "Energy",
                    TF::GREEN . "$energyBar",
                    TF::RESET . TF::GRAY . "(" . TF::WHITE . "$translatedEnergy" . TF::GRAY . " / $translatedEnergyNeeded)",
                    TF::RESET . "§r",
                    TF::RESET . $whiteScrollMessage,
                    TF::RESET . "§r",
                    TF::RESET . TF::AQUA . "This item is ready to level-up!",
                    TF::RESET . TF::GRAY . "Visit the Enchanter located at " . TF::AQUA . "/spawn",
                    TF::RESET . " ",
                    TF::RESET . TF::YELLOW . "Required Mining Level 1"
                ];
                # pickaxe is max level
            } elseif($level === 100) {
                $lore = [
                    TF::RESET . " ",
                    TF::RESET . TF::GREEN . "=- " . TF::BOLD . TF::WHITE . "$successfulEnchants" . TF::RESET . TF::GREEN . " Enchants -=",
                    TF::RESET . TF::RED . "=- " . TF::BOLD . TF::WHITE . "$failedEnchants" . TF::RESET . TF::RED . " Failures -=",
                    TF::RESET . " ",
                    TF::RESET . TF::BOLD . TF::RED . "Pickaxe is ready to Prestige",
                    TF::RESET . "§r",
                    TF::RESET . $whiteScrollMessage,
                    TF::RESET . " ",
                    TF::RESET . TF::GRAY . "Blocks Mined: " . TF::WHITE . $blocksMined,
                    TF::RESET . " ",
                    TF::RESET . TF::YELLOW . "Required Mining Level " . TF::WHITE . "1                 "
                ];
            } else {
                # create lore
                $lore = [
                    TF::RESET . " ",
                    TF::RESET . TF::GREEN . "=- " . TF::BOLD . TF::WHITE . "$successfulEnchants" . TF::RESET . TF::GREEN . " Enchants -=",
                    TF::RESET . TF::RED . "=- " . TF::BOLD . TF::WHITE . "$failedEnchants" . TF::RESET . TF::RED . " Failures -=",
                    TF::RESET . " ",
                    TF::RESET . TF::BOLD . TF::AQUA . "Energy",
                    TF::RESET . "$energyBar",
                    TF::RESET . TF::GRAY . "(" . TF::WHITE . "$translatedEnergy" . TF::GRAY . " / $translatedEnergyNeeded)",
                    TF::RESET . "§r",
                    TF::RESET . $whiteScrollMessage,
                    TF::RESET . " ",
                    TF::RESET . TF::GRAY . "Blocks Mined: " . TF::WHITE . $blocksMined,
                    TF::RESET . " ",
                    TF::RESET . TF::YELLOW . "Required Mining Level " . TF::WHITE . "1                 "
                ];
            }
        } elseif($whiteScrolled === "holy") {
            if($energy >= $energyNeeded) {
                $lore = [
                    TF::RESET . " ",
                    TF::RESET . TF::GREEN . "=- " . TF::BOLD . TF::WHITE . "$successfulEnchants" . TF::RESET . TF::GREEN . " Enchants -=",
                    TF::RESET . TF::RED . "=- " . TF::BOLD . TF::WHITE . "$failedEnchants" . TF::RESET . TF::RED . " Failures -=",
                    TF::RESET . " ",
                    TF::RESET . TF::BOLD . TF::AQUA . "Energy",
                    TF::GREEN . "$energyBar",
                    TF::RESET . TF::GRAY . "(" . TF::WHITE . "$translatedEnergy" . TF::GRAY . " / $translatedEnergyNeeded)",
                    TF::RESET . "§r",
                    TF::RESET . $holyWhiteScrollMessage,
                    TF::RESET . "§r",
                    TF::RESET . TF::AQUA . "This item is ready to level-up!",
                    TF::RESET . TF::GRAY . "Visit the Enchanter located at " . TF::AQUA . "/spawn",
                    TF::RESET . " ",
                    TF::RESET . TF::YELLOW . "Required Mining Level 1"
                ];
                # pickaxe is max level
            } elseif($level === 100) {
                $lore = [
                    TF::RESET . " ",
                    TF::RESET . TF::GREEN . "=- " . TF::BOLD . TF::WHITE . "$successfulEnchants" . TF::RESET . TF::GREEN . " Enchants -=",
                    TF::RESET . TF::RED . "=- " . TF::BOLD . TF::WHITE . "$failedEnchants" . TF::RESET . TF::RED . " Failures -=",
                    TF::RESET . " ",
                    TF::RESET . TF::BOLD . TF::RED . "Pickaxe is ready to Prestige",
                    TF::RESET . "§r",
                    TF::RESET . $holyWhiteScrollMessage,
                    TF::RESET . " ",
                    TF::RESET . TF::GRAY . "Blocks Mined: " . TF::WHITE . $blocksMined,
                    TF::RESET . " ",
                    TF::RESET . TF::YELLOW . "Required Mining Level " . TF::WHITE . "1                 "
                ];
            } else {
                # create lore
                $lore = [
                    TF::RESET . " ",
                    TF::RESET . TF::GREEN . "=- " . TF::BOLD . TF::WHITE . "$successfulEnchants" . TF::RESET . TF::GREEN . " Enchants -=",
                    TF::RESET . TF::RED . "=- " . TF::BOLD . TF::WHITE . "$failedEnchants" . TF::RESET . TF::RED . " Failures -=",
                    TF::RESET . " ",
                    TF::RESET . TF::BOLD . TF::AQUA . "Energy",
                    TF::RESET . "$energyBar",
                    TF::RESET . TF::GRAY . "(" . TF::WHITE . "$translatedEnergy" . TF::GRAY . " / $translatedEnergyNeeded)",
                    TF::RESET . "§r",
                    TF::RESET . $holyWhiteScrollMessage,
                    TF::RESET . " ",
                    TF::RESET . TF::GRAY . "Blocks Mined: " . TF::WHITE . $blocksMined,
                    TF::RESET . " ",
                    TF::RESET . TF::YELLOW . "Required Mining Level " . TF::WHITE . "1                 "
                ];
            }
        } elseif($energy >= $energyNeeded) {
            $lore = [
                TF::RESET . " ",
                TF::RESET . TF::GREEN . "=- " . TF::BOLD . TF::WHITE . "$successfulEnchants" . TF::RESET . TF::GREEN . " Enchants -=",
                TF::RESET . TF::RED . "=- " . TF::BOLD . TF::WHITE . "$failedEnchants" . TF::RESET . TF::RED . " Failures -=",
                TF::RESET . " ",
                TF::RESET . TF::BOLD . TF::AQUA . "Energy",
                TF::GREEN . "$energyBar",
                TF::RESET . TF::GRAY . "(" . TF::WHITE . "$translatedEnergy" . TF::GRAY . " / $translatedEnergyNeeded)",
                TF::RESET . "§r",
                TF::RESET . TF::AQUA . "This item is ready to level-up!",
                TF::RESET . TF::GRAY . "Visit the Enchanter located at " . TF::AQUA . "/spawn",
                TF::RESET . " ",
                TF::RESET . TF::YELLOW . "Required Mining Level 1"
            ];
            # pickaxe is max level
        } elseif($level === 100) {
            $lore = [
                TF::RESET . " ",
                TF::RESET . TF::GREEN . "=- " . TF::BOLD . TF::WHITE . "$successfulEnchants" . TF::RESET . TF::GREEN . " Enchants -=",
                TF::RESET . TF::RED . "=- " . TF::BOLD . TF::WHITE . "$failedEnchants" . TF::RESET . TF::RED . " Failures -=",
                TF::RESET . " ",
                TF::RESET . TF::BOLD . TF::RED . "Pickaxe is ready to Prestige",
                TF::RESET . " ",
                TF::RESET . TF::GRAY . "Blocks Mined: " . TF::WHITE . $blocksMined,
                TF::RESET . " ",
                TF::RESET . TF::YELLOW . "Required Mining Level " . TF::WHITE . "1                 "
            ];
        } else {
            # create lore
            $lore = [
                TF::RESET . " ",
                TF::RESET . TF::GREEN . "=- " . TF::BOLD . TF::WHITE . "$successfulEnchants" . TF::RESET . TF::GREEN . " Enchants -=",
                TF::RESET . TF::RED . "=- " . TF::BOLD . TF::WHITE . "$failedEnchants" . TF::RESET . TF::RED . " Failures -=",
                TF::RESET . " ",
                TF::RESET . TF::BOLD . TF::AQUA . "Energy",
                TF::RESET . "$energyBar",
                TF::RESET . TF::GRAY . "(" . TF::WHITE . "$translatedEnergy" . TF::GRAY . " / $translatedEnergyNeeded)",
                TF::RESET . " ",
                TF::RESET . TF::GRAY . "Blocks Mined: " . TF::WHITE . $blocksMined,
                TF::RESET . " ",
                TF::RESET . TF::YELLOW . "Required Mining Level " . TF::WHITE . "1                 "
            ];
        }
        return $lore;
    }

    public function updatePickaxe($item): Item {

        $type = $this->getType($item);

        switch($type) {

            case "Trainee":
                # get nbt Data
                $level = $item->getNamedTag()->getInt("Level");

                # set name
                if($level == 0) {
                    $item->setCustomName(TF::AQUA . "Trainee Pickaxe" . TF::RESET);
                } else {
                    $item->setCustomName(TF::AQUA . "Trainee Pickaxe " . TF::BOLD . TF::GREEN . $level . TF::RESET);
                }
                # check if pickaxe is ready to level up
                $lore = $this->createLore($item);
                # set the lore
                $item->setLore($lore);
                break;

            case "Stone":
                # get nbt Data
                $level = $item->getNamedTag()->getInt("Level");

                # set name
                if($level == 0) {
                    $item->setCustomName(TF::AQUA . "Stone Pickaxe" . TF::RESET);
                } else {
                    $item->setCustomName(TF::AQUA . "Stone Pickaxe " . TF::BOLD . TF::GREEN . $level . TF::RESET);
                }
                # create energy progress bar
                # check if pickaxe is ready to level up
                # create lore
                $lore = $this->createLore($item);
                # set the lore
                $item->setLore($lore);
                break;

            case "Gold":
                # get nbt Data
                $level = $item->getNamedTag()->getInt("Level");

                # set name
                if($level == 0) {
                    $item->setCustomName(TF::AQUA . "Gold Pickaxe" . TF::RESET);
                } else {
                    $item->setCustomName(TF::AQUA . "Gold Pickaxe " . TF::BOLD . TF::GREEN . $level . TF::RESET);
                }
                # create energy progress bar
                # check if pickaxe is ready to level up
                # create lore
                $lore = $this->createLore($item);
                # set the lore
                $item->setLore($lore);
                break;

            case "Iron":
                # get nbt Data
                $level = $item->getNamedTag()->getInt("Level");

                # set name
                if($level == 0) {
                    $item->setCustomName(TF::AQUA . "Iron Pickaxe" . TF::RESET);
                } else {
                    $item->setCustomName(TF::AQUA . "Iron Pickaxe " . TF::BOLD . TF::GREEN . $level . TF::RESET);
                }
                # create energy progress bar
                # check if pickaxe is ready to level up
                # create lore
                $lore = $this->createLore($item);
                # set the lore
                $item->setLore($lore);
                break;

            case "Diamond":
                # get nbt Data
                $level = $item->getNamedTag()->getInt("Level");

                # set name
                if($level == 0) {
                    $item->setCustomName(TF::AQUA . "Diamond Pickaxe" . TF::RESET);
                } else {
                    $item->setCustomName(TF::AQUA . "Diamond Pickaxe " . TF::BOLD . TF::GREEN . $level . TF::RESET);
                }
                # create energy progress bar
                # check if pickaxe is ready to level up
                # create lore
                $lore = $this->createLore($item);
                # set the lore
                $item->setLore($lore);
                break;
        }

        return $item;
    }

    public function updatePickaxeSetInHand(Player $player, $item): Item {

        $type = $this->getType($item);

        switch($type) {

            case "Trainee":
                # get nbt Data
                $level = $item->getNamedTag()->getInt("Level");

                # set name
                if($level == 0) {
                    $item->setCustomName(TF::AQUA . "Trainee Pickaxe" . TF::RESET);
                } else {
                    $item->setCustomName(TF::AQUA . "Trainee Pickaxe " . TF::BOLD . TF::GREEN . $level . TF::RESET);
                }
                # check if pickaxe is ready to level up
                $lore = $this->createLore($item);
                # set the lore
                $item->setLore($lore);
                # give player item
                $player->getInventory()->setItemInHand($item);
                break;

            case "Stone":
                # get nbt Data
                $level = $item->getNamedTag()->getInt("Level");

                # set name
                if($level == 0) {
                    $item->setCustomName(TF::AQUA . "Stone Pickaxe" . TF::RESET);
                } else {
                    $item->setCustomName(TF::AQUA . "Stone Pickaxe " . TF::BOLD . TF::GREEN . $level . TF::RESET);
                }
                # create energy progress bar
                # check if pickaxe is ready to level up
                # create lore
                $lore = $this->createLore($item);
                # set the lore
                $item->setLore($lore);
                # give player item
                $player->getInventory()->setItemInHand($item);
                break;

            case "Gold":
                # get nbt Data
                $level = $item->getNamedTag()->getInt("Level");

                # set name
                if($level == 0) {
                    $item->setCustomName(TF::AQUA . "Gold Pickaxe" . TF::RESET);
                } else {
                    $item->setCustomName(TF::AQUA . "Gold Pickaxe " . TF::BOLD . TF::GREEN . $level . TF::RESET);
                }
                # create energy progress bar
                # check if pickaxe is ready to level up
                # create lore
                $lore = $this->createLore($item);
                # set the lore
                $item->setLore($lore);
                # give player item
                $player->getInventory()->setItemInHand($item);
                break;

            case "Iron":
                # get nbt Data
                $level = $item->getNamedTag()->getInt("Level");

                # set name
                if($level == 0) {
                    $item->setCustomName(TF::AQUA . "Iron Pickaxe" . TF::RESET);
                } else {
                    $item->setCustomName(TF::AQUA . "Iron Pickaxe " . TF::BOLD . TF::GREEN . $level . TF::RESET);
                }
                # create energy progress bar
                # check if pickaxe is ready to level up
                # create lore
                $lore = $this->createLore($item);
                # set the lore
                $item->setLore($lore);
                # give player item
                $player->getInventory()->setItemInHand($item);
                break;

            case "Diamond":
                # get nbt Data
                $level = $item->getNamedTag()->getInt("Level");

                # set name
                if($level == 0) {
                    $item->setCustomName(TF::AQUA . "Diamond Pickaxe" . TF::RESET);
                } else {
                    $item->setCustomName(TF::AQUA . "Diamond Pickaxe " . TF::BOLD . TF::GREEN . $level . TF::RESET);
                }
                # create energy progress bar
                # check if pickaxe is ready to level up
                # create lore
                $lore = $this->createLore($item);
                # set the lore
                $item->setLore($lore);
                # give player item
                $player->getInventory()->setItemInHand($item);
                break;
        }

        return $item;
    }
}