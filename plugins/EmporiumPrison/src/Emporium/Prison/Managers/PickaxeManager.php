<?php

namespace Emporium\Prison\Managers;

use Emporium\Prison\EmporiumPrison;
use Emporium\Prison\Managers\misc\Translator;

use pocketmine\item\Item;
use pocketmine\network\mcpe\protocol\OnScreenTextureAnimationPacket;
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
        if($level === 100) return 0;
        return EmporiumPrison::getInstance()->getPickaxeEnergyLevels()[$level + 1];
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

    public function removeLevelUpEnergy($item): Item {
        $energyNeeded = $this->getEnergyNeeded($item);
        $oldData = $item->getNamedTag()->getInt("Energy");
        $newData = $oldData - $energyNeeded;
        $item->getNamedTag()->setInt("Energy", $newData);
        $this->updatePickaxe($item);
        return $item;
    }

    public function levelUpPickaxe($item): Item {
        $oldData = $item->getNamedTag()->getInt("Level");
        $newData = $oldData + 1;
        $item->getNamedTag()->setInt("Level", $newData);
        $this->updatePickaxe($item);
        return $item;
    }

    public function createEnergyBar($item): String {

        $pickaxeManager = EmporiumPrison::getInstance()->getPickaxeManager();

        $energy = $item->getNamedTag()->getInt("Energy");
        $energyNeeded = $pickaxeManager->getEnergyNeeded($item);
        if($energyNeeded == 0) {
            return TF::RED . "Pickaxe is Max Level";
        }
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
        $prestige = $item->getNamedTag()->getInt("Prestige");
        $successfulEnchants = $item->getNamedTag()->getInt("SuccessfulEnchants");
        $failedEnchants = $item->getNamedTag()->getInt("FailedEnchants");
        $blocksMined = $item->getNamedTag()->getInt("BlocksMined");
        $translatedEnergy = Translator::shortNumber($energy);
        $energyNeeded = $this->getEnergyNeeded($item);
        $translatedEnergyNeeded = Translator::shortNumber($energyNeeded);
        $whiteScrolled = $item->getNamedTag()->getString("whitescrolled");
        $levelRequired = $item->getNamedTag()->getInt("LevelRequired");
        # prestige buffs
        $energyMastery = $item->getNamedTag()->getString("EnergyMastery");
        $energyMasteryBuff = $item->getNamedTag()->getInt("ChargeOrbSlots");
        $xpMastery = $item->getNamedTag()->getString("XpMastery");
        $xpMasteryBuff = $item->getNamedTag()->getInt("XpMasteryBuff");
        $hoarder = $item->getNamedTag()->getString("Hoarder");
        $hoarderBuff = $item->getNamedTag()->getInt("HoarderBuff");
        $meteoriteMastery = $item->getNamedTag()->getString("MeteoriteMastery");
        $meteoriteMasteryBuff = $item->getNamedTag()->getInt("MeteoriteMasteryBuff");

        # prestige buff message
        $prestigeMessage = null;
        if($energyMastery == "unlocked") {
            $prestigeMessage .= TF::RESET . TF::BOLD . TF::AQUA . "Energy Mastery: +" . TF::RESET . TF::WHITE . $energyMasteryBuff . " Charge Orb Slots" .TF::EOL;
        }
        if($xpMastery == "unlocked") {
            $prestigeMessage .= TF::RESET . TF::BOLD . TF::AQUA . "Xp Mastery: +" . TF::RESET . TF::WHITE . $xpMasteryBuff . " more XP" . TF::EOL;
        }
        if($hoarder == "unlocked") {
            $prestigeMessage .= TF::RESET . TF::BOLD . TF::AQUA . "Hoarder: +" . TF::RESET . TF::WHITE . $hoarderBuff . " more Ores Gained" . TF::EOL;
        }
        if($meteoriteMastery == "unlocked") {
            $prestigeMessage .= TF::RESET . TF::BOLD . TF::AQUA . "Meteorite Mastery: +" . TF::RESET . TF::WHITE . $meteoriteMasteryBuff . " more Ores from Meteorites" . TF::EOL;
        }

        # white scroll message
        if($whiteScrolled === "white") {
            $whiteScrollMessage = TF::RESET . TF::BOLD . TF::WHITE . "WHITE SCROLLED";
        } elseif($whiteScrolled === "holy") {
            $holyWhiteScrollMessage = TF::RESET . TF::BOLD . TF::GOLD . "HOLY WHITE SCROLLED";
        }

        # energy bar
        $energyBar = $this->createEnergyBar($item);

        # lore
        if($prestige >= 1) {
            if($whiteScrolled === "white") {
                if($level === 100) {
                    $lore = [
                        $prestigeMessage,
                        TF::RESET . TF::GREEN . "=- " . TF::BOLD . TF::WHITE . "$successfulEnchants" . TF::RESET . TF::GREEN . " Enchants -=",
                        TF::RESET . TF::RED . "=- " . TF::BOLD . TF::RED . "$failedEnchants" . TF::RESET . TF::RED . " Failures -=",
                        TF::EOL,
                        TF::RESET . TF::BOLD . TF::AQUA . "Energy",
                        TF::GREEN . "$energyBar",
                        TF::RESET . TF::WHITE . $translatedEnergy . TF::AQUA . " Energy",
                        TF::EOL,
                        TF::RESET . $whiteScrollMessage,
                        TF::EOL,
                        TF::RESET . TF::AQUA . "This item is ready to prestige!",
                        TF::RESET . TF::GRAY . "Visit the Prestige Master located at " . TF::AQUA . "/spawn",
                        TF::EOL,
                        TF::RESET . TF::GRAY . "Blocks Mined: " . TF::WHITE . $blocksMined,
                        TF::RESET . TF::YELLOW . "Required Mining Level " . $levelRequired
                    ];
                } elseif($energy >= $energyNeeded) {
                    $lore = [
                        $prestigeMessage,
                        TF::RESET . TF::GREEN . "=- " . TF::BOLD . TF::WHITE . "$successfulEnchants" . TF::RESET . TF::GREEN . " Enchants -=",
                        TF::RESET . TF::RED . "=- " . TF::BOLD . TF::RED . "$failedEnchants" . TF::RESET . TF::RED . " Failures -=",
                        TF::EOL,
                        TF::RESET . TF::BOLD . TF::AQUA . "Energy",
                        TF::RESET . TF::GRAY . "(" . TF::WHITE . "$translatedEnergy" . TF::GRAY . "/" . $translatedEnergyNeeded . ")",
                        TF::EOL,
                        TF::RESET . $whiteScrollMessage,
                        TF::EOL,
                        TF::RESET . TF::AQUA . "This item is ready to level-up!",
                        TF::RESET . TF::GRAY . "Visit the Enchanter located at " . TF::AQUA . "/spawn",
                        TF::EOL,
                        TF::RESET . TF::GRAY . "Blocks Mined: " . TF::WHITE . $blocksMined,
                        TF::RESET . TF::YELLOW . "Required Mining Level " . $levelRequired
                    ];
                    # pickaxe is max level
                } else {
                    # create lore
                    $lore = [
                        $prestigeMessage,
                        TF::RESET . TF::GREEN . "=- " . TF::BOLD . TF::WHITE . "$successfulEnchants" . TF::RESET . TF::GREEN . " Enchants -=",
                        TF::RESET . TF::RED . "=- " . TF::BOLD . TF::RED . "$failedEnchants" . TF::RESET . TF::RED . " Failures -=",
                        TF::EOL,
                        TF::RESET . TF::BOLD . TF::AQUA . "Energy",
                        TF::RESET . "$energyBar",
                        TF::RESET . TF::GRAY . "(" . TF::WHITE . "$translatedEnergy" . TF::GRAY . "/" . $translatedEnergyNeeded . ")",
                        TF::EOL,
                        TF::RESET . $whiteScrollMessage,
                        TF::EOL,
                        TF::RESET . TF::GRAY . "Blocks Mined: " . TF::WHITE . $blocksMined,
                        TF::RESET . TF::YELLOW . "Required Mining Level " . $levelRequired
                    ];
                }
            } elseif($whiteScrolled === "holy") {
                if($energy >= $energyNeeded) {
                    $lore = [
                        $prestigeMessage,
                        TF::RESET . TF::GREEN . "=- " . TF::BOLD . TF::WHITE . "$successfulEnchants" . TF::RESET . TF::GREEN . " Enchants -=",
                        TF::RESET . TF::RED . "=- " . TF::BOLD . TF::RED . "$failedEnchants" . TF::RESET . TF::RED . " Failures -=",
                        TF::EOL,
                        TF::RESET . TF::BOLD . TF::AQUA . "Energy",
                        TF::RESET . TF::GRAY . "(" . TF::WHITE . "$translatedEnergy" . TF::GRAY . "/" . $translatedEnergyNeeded . ")",
                        TF::EOL,
                        TF::RESET . $holyWhiteScrollMessage,
                        TF::EOL,
                        TF::RESET . TF::AQUA . "This item is ready to level-up!",
                        TF::RESET . TF::GRAY . "Visit the Enchanter located at " . TF::AQUA . "/spawn",
                        TF::EOL,
                        TF::RESET . TF::GRAY . "Blocks Mined: " . TF::WHITE . $blocksMined,
                        TF::RESET . TF::YELLOW . "Required Mining Level " . $levelRequired
                    ];
                    # pickaxe is max level
                } elseif($level === 100) {
                    $lore = [
                        $prestigeMessage,
                        TF::RESET . TF::GREEN . "=- " . TF::BOLD . TF::WHITE . "$successfulEnchants" . TF::RESET . TF::GREEN . " Enchants -=",
                        TF::RESET . TF::RED . "=- " . TF::BOLD . TF::RED . "$failedEnchants" . TF::RESET . TF::RED . " Failures -=",
                        TF::EOL,
                        TF::RESET . TF::BOLD . TF::AQUA . "Energy",
                        TF::GREEN . "$energyBar",
                        TF::RESET . TF::WHITE . $translatedEnergy . TF::AQUA . " Energy",
                        TF::EOL,
                        TF::RESET . $holyWhiteScrollMessage,
                        TF::EOL,
                        TF::RESET . TF::GRAY . "Blocks Mined: " . TF::WHITE . $blocksMined,
                        TF::RESET . TF::YELLOW . "Required Mining Level " . $levelRequired
                    ];
                } else {
                    # create lore
                    $lore = [
                        $prestigeMessage,
                        TF::RESET . TF::GREEN . "=- " . TF::BOLD . TF::WHITE . "$successfulEnchants" . TF::RESET . TF::GREEN . " Enchants -=",
                        TF::RESET . TF::RED . "=- " . TF::BOLD . TF::RED . "$failedEnchants" . TF::RESET . TF::RED . " Failures -=",
                        TF::EOL,
                        TF::RESET . TF::BOLD . TF::AQUA . "Energy",
                        TF::RESET . "$energyBar",
                        TF::RESET . TF::GRAY . "(" . TF::WHITE . "$translatedEnergy" . TF::GRAY . "/" . $translatedEnergyNeeded . ")",
                        TF::EOL,
                        TF::RESET . $holyWhiteScrollMessage,
                        TF::EOL,
                        TF::RESET . TF::GRAY . "Blocks Mined: " . TF::WHITE . $blocksMined,
                        TF::RESET . TF::YELLOW . "Required Mining Level " . $levelRequired
                    ];
                }
            } elseif($level === 100) {
                $lore = [
                    $prestigeMessage,
                    TF::RESET . TF::GREEN . "=- " . TF::BOLD . TF::WHITE . "$successfulEnchants" . TF::RESET . TF::GREEN . " Enchants -=",
                    TF::RESET . TF::RED . "=- " . TF::BOLD . TF::RED . "$failedEnchants" . TF::RESET . TF::RED . " Failures -=",
                    TF::EOL,
                    TF::RESET . TF::BOLD . TF::AQUA . "Energy",
                    TF::GREEN . "$energyBar",
                    TF::RESET . TF::GRAY . "(" . TF::WHITE . $translatedEnergy . TF::GRAY . ") " . TF::AQUA . " Energy",
                    TF::EOL,
                    TF::RESET . TF::GRAY . "Blocks Mined: " . TF::WHITE . $blocksMined,
                    TF::RESET . TF::YELLOW . "Required Mining Level " . $levelRequired
                ];
            } elseif($energy >= $energyNeeded) {
                $lore = [
                    $prestigeMessage,
                    TF::RESET . TF::GREEN . "=- " . TF::BOLD . TF::WHITE . "$successfulEnchants" . TF::RESET . TF::GREEN . " Enchants -=",
                    TF::RESET . TF::RED . "=- " . TF::BOLD . TF::RED . "$failedEnchants" . TF::RESET . TF::RED . " Failures -=",
                    TF::EOL,
                    TF::RESET . TF::BOLD . TF::AQUA . "Energy",
                    TF::RESET . TF::WHITE . "(" . $translatedEnergy . TF::GRAY . "/" . $translatedEnergyNeeded . ")",
                    TF::EOL,
                    TF::RESET . TF::AQUA . "This item is ready to level-up!",
                    TF::RESET . TF::GRAY . "Visit the Enchanter located at " . TF::AQUA . "/spawn",
                    TF::EOL,
                    TF::RESET . TF::GRAY . "Blocks Mined: " . TF::WHITE . $blocksMined,
                    TF::RESET . TF::YELLOW . "Required Mining Level " . $levelRequired
                ];
                # pickaxe is max level
            } elseif($level == 100) {
                $lore = [
                    $prestigeMessage,
                    TF::RESET . TF::GREEN . "=- " . TF::BOLD . TF::WHITE . "$successfulEnchants" . TF::RESET . TF::GREEN . " Enchants -=",
                    TF::RESET . TF::RED . "=- " . TF::BOLD . TF::RED . "$failedEnchants" . TF::RESET . TF::RED . " Failures -=",
                    TF::EOL,
                    TF::RESET . TF::BOLD . TF::AQUA . "Energy",
                    TF::GREEN . "$energyBar",
                    TF::RESET . TF::GRAY . "(" . TF::WHITE . $translatedEnergy . TF::GRAY . ") " . TF::AQUA . " Energy",
                    TF::EOL,
                    TF::RESET . TF::GRAY . "Blocks Mined: " . TF::WHITE . $blocksMined,
                    TF::RESET . TF::YELLOW . "Required Mining Level " . $levelRequired
                ];
            } else {
                # create lore
                $lore = [
                    $prestigeMessage,
                    TF::RESET . TF::GREEN . "=- " . TF::BOLD . TF::WHITE . "$successfulEnchants" . TF::RESET . TF::GREEN . " Enchants -=",
                    TF::RESET . TF::RED . "=- " . TF::BOLD . TF::RED . "$failedEnchants" . TF::RESET . TF::RED . " Failures -=",
                    TF::EOL,
                    TF::RESET . TF::BOLD . TF::AQUA . "Energy",
                    TF::RESET . "$energyBar",
                    TF::RESET . TF::GRAY . "(" . TF::WHITE . "$translatedEnergy" . TF::GRAY . "/" . $translatedEnergyNeeded . ")",
                    TF::EOL,
                    TF::RESET . TF::GRAY . "Blocks Mined: " . TF::WHITE . $blocksMined,
                    TF::RESET . TF::YELLOW . "Required Mining Level " . $levelRequired
                ];
            }
        } else {
            if($whiteScrolled === "white") {
                if($level === 100) {
                    $lore = [
                        TF::RESET . TF::GREEN . "=- " . TF::BOLD . TF::WHITE . "$successfulEnchants" . TF::RESET . TF::GREEN . " Enchants -=",
                        TF::RESET . TF::RED . "=- " . TF::BOLD . TF::RED . "$failedEnchants" . TF::RESET . TF::RED . " Failures -=",
                        TF::EOL,
                        TF::RESET . TF::BOLD . TF::AQUA . "Energy",
                        TF::GREEN . "$energyBar",
                        TF::RESET . TF::GRAY . "(" . TF::WHITE . $translatedEnergy . TF::AQUA . " Energy",
                        TF::EOL,
                        TF::RESET . $whiteScrollMessage,
                        TF::EOL,
                        TF::RESET . TF::AQUA . "This item is ready to prestige!",
                        TF::RESET . TF::GRAY . "Visit the Prestige Master located at " . TF::AQUA . "/spawn",
                        TF::EOL,
                        TF::RESET . TF::GRAY . "Blocks Mined: " . TF::WHITE . $blocksMined,
                        TF::RESET . TF::YELLOW . "Required Mining Level " . $levelRequired
                    ];
                } elseif($energy >= $energyNeeded) {
                    $lore = [
                        TF::RESET . TF::GREEN . "=- " . TF::BOLD . TF::WHITE . "$successfulEnchants" . TF::RESET . TF::GREEN . " Enchants -=",
                        TF::RESET . TF::RED . "=- " . TF::BOLD . TF::RED . "$failedEnchants" . TF::RESET . TF::RED . " Failures -=",
                        TF::EOL,
                        TF::RESET . TF::BOLD . TF::AQUA . "Energy",
                        TF::RESET . TF::GRAY . "(" . TF::WHITE . "$translatedEnergy" . TF::GRAY . "/" . $translatedEnergyNeeded . ")",
                        TF::EOL,
                        TF::RESET . $whiteScrollMessage,
                        TF::EOL,
                        TF::RESET . TF::AQUA . "This item is ready to level-up!",
                        TF::RESET . TF::GRAY . "Visit the Enchanter located at " . TF::AQUA . "/spawn",
                        TF::EOL,
                        TF::RESET . TF::GRAY . "Blocks Mined: " . TF::WHITE . $blocksMined,
                        TF::RESET . TF::YELLOW . "Required Mining Level " . $levelRequired
                    ];
                    # pickaxe is max level
                } else {
                    # create lore
                    $lore = [
                        TF::RESET . TF::GREEN . "=- " . TF::BOLD . TF::WHITE . "$successfulEnchants" . TF::RESET . TF::GREEN . " Enchants -=",
                        TF::RESET . TF::RED . "=- " . TF::BOLD . TF::RED . "$failedEnchants" . TF::RESET . TF::RED . " Failures -=",
                        TF::EOL,
                        TF::RESET . TF::BOLD . TF::AQUA . "Energy",
                        TF::RESET . "$energyBar",
                        TF::RESET . TF::GRAY . "(" . TF::WHITE . "$translatedEnergy" . TF::GRAY . "/" . $translatedEnergyNeeded . ")",
                        TF::EOL,
                        TF::RESET . $whiteScrollMessage,
                        TF::EOL,
                        TF::RESET . TF::GRAY . "Blocks Mined: " . TF::WHITE . $blocksMined,
                        TF::RESET . TF::YELLOW . "Required Mining Level " . $levelRequired
                    ];
                }
            } elseif($whiteScrolled === "holy") {
                if($energy >= $energyNeeded) {
                    $lore = [
                        TF::RESET . TF::GREEN . "=- " . TF::BOLD . TF::WHITE . "$successfulEnchants" . TF::RESET . TF::GREEN . " Enchants -=",
                        TF::RESET . TF::RED . "=- " . TF::BOLD . TF::RED . "$failedEnchants" . TF::RESET . TF::RED . " Failures -=",
                        TF::EOL,
                        TF::RESET . TF::BOLD . TF::AQUA . "Energy",
                        TF::RESET . TF::GRAY . "(" . TF::WHITE . "$translatedEnergy" . TF::GRAY . "/" . $translatedEnergyNeeded . ")",
                        TF::EOL,
                        TF::RESET . $holyWhiteScrollMessage,
                        TF::EOL,
                        TF::RESET . TF::AQUA . "This item is ready to level-up!",
                        TF::RESET . TF::GRAY . "Visit the Enchanter located at " . TF::AQUA . "/spawn",
                        TF::EOL,
                        TF::RESET . TF::GRAY . "Blocks Mined: " . TF::WHITE . $blocksMined,
                        TF::RESET . TF::YELLOW . "Required Mining Level " . $levelRequired
                    ];
                    # pickaxe is max level
                } elseif($level === 100) {
                    $lore = [
                        TF::RESET . TF::GREEN . "=- " . TF::BOLD . TF::WHITE . "$successfulEnchants" . TF::RESET . TF::GREEN . " Enchants -=",
                        TF::RESET . TF::RED . "=- " . TF::BOLD . TF::RED . "$failedEnchants" . TF::RESET . TF::RED . " Failures -=",
                        TF::EOL,
                        TF::RESET . TF::BOLD . TF::AQUA . "Energy",
                        TF::GREEN . "$energyBar",
                        TF::RESET . TF::GRAY . "(" . TF::WHITE . $translatedEnergy . TF::AQUA . " Energy",
                        TF::EOL,
                        TF::RESET . $holyWhiteScrollMessage,
                        TF::EOL,
                        TF::RESET . TF::GRAY . "Blocks Mined: " . TF::WHITE . $blocksMined,
                        TF::RESET . TF::YELLOW . "Required Mining Level " . $levelRequired
                    ];
                } else {
                    # create lore
                    $lore = [
                        TF::RESET . TF::GREEN . "=- " . TF::BOLD . TF::WHITE . "$successfulEnchants" . TF::RESET . TF::GREEN . " Enchants -=",
                        TF::RESET . TF::RED . "=- " . TF::BOLD . TF::RED . "$failedEnchants" . TF::RESET . TF::RED . " Failures -=",
                        TF::EOL,
                        TF::RESET . TF::BOLD . TF::AQUA . "Energy",
                        TF::RESET . "$energyBar",
                        TF::RESET . TF::GRAY . "(" . TF::WHITE . "$translatedEnergy" . TF::GRAY . "/" . $translatedEnergyNeeded . ")",
                        TF::EOL,
                        TF::RESET . $holyWhiteScrollMessage,
                        TF::EOL,
                        TF::RESET . TF::GRAY . "Blocks Mined: " . TF::WHITE . $blocksMined,
                        TF::RESET . TF::YELLOW . "Required Mining Level " . $levelRequired
                    ];
                }
            } elseif($level === 100) {
                $lore = [
                    TF::RESET . TF::GREEN . "=- " . TF::BOLD . TF::WHITE . "$successfulEnchants" . TF::RESET . TF::GREEN . " Enchants -=",
                    TF::RESET . TF::RED . "=- " . TF::BOLD . TF::RED . "$failedEnchants" . TF::RESET . TF::RED . " Failures -=",
                    TF::EOL,
                    TF::RESET . TF::BOLD . TF::AQUA . "Energy",
                    TF::GREEN . "$energyBar",
                    TF::RESET . TF::GRAY . "(" . TF::WHITE . $translatedEnergy . TF::AQUA . " Energy",
                    TF::EOL,
                    TF::RESET . TF::GRAY . "Blocks Mined: " . TF::WHITE . $blocksMined,
                    TF::RESET . TF::YELLOW . "Required Mining Level " . $levelRequired
                ];
            } elseif($energy >= $energyNeeded) {
                $lore = [
                    TF::RESET . TF::GREEN . "=- " . TF::BOLD . TF::WHITE . "$successfulEnchants" . TF::RESET . TF::GREEN . " Enchants -=",
                    TF::RESET . TF::RED . "=- " . TF::BOLD . TF::RED . "$failedEnchants" . TF::RESET . TF::RED . " Failures -=",
                    TF::EOL,
                    TF::RESET . TF::BOLD . TF::AQUA . "Energy",
                    TF::RESET . TF::GRAY . "(" . TF::WHITE . "$translatedEnergy" . TF::GRAY . "/" . $translatedEnergyNeeded . ")",
                    TF::EOL,
                    TF::RESET . TF::AQUA . "This item is ready to level-up!",
                    TF::RESET . TF::GRAY . "Visit the Enchanter located at " . TF::AQUA . "/spawn",
                    TF::EOL,
                    TF::RESET . TF::GRAY . "Blocks Mined: " . TF::WHITE . $blocksMined,
                    TF::RESET . TF::YELLOW . "Required Mining Level " . $levelRequired
                ];
                # pickaxe is max level
            } elseif($level == 100) {
                $lore = [
                    TF::RESET . TF::GREEN . "=- " . TF::BOLD . TF::WHITE . "$successfulEnchants" . TF::RESET . TF::GREEN . " Enchants -=",
                    TF::RESET . TF::RED . "=- " . TF::BOLD . TF::RED . "$failedEnchants" . TF::RESET . TF::RED . " Failures -=",
                    TF::EOL,
                    TF::RESET . TF::BOLD . TF::AQUA . "Energy",
                    TF::GREEN . "$energyBar",
                    TF::RESET . TF::GRAY . "(" . TF::WHITE . $translatedEnergy . TF::AQUA . " Energy",
                    TF::EOL,
                    TF::RESET . TF::GRAY . "Blocks Mined: " . TF::WHITE . $blocksMined,
                    TF::RESET . TF::YELLOW . "Required Mining Level " . $levelRequired
                ];
            } else {
                # create lore
                $lore = [
                    TF::RESET . TF::GREEN . "=- " . TF::BOLD . TF::WHITE . "$successfulEnchants" . TF::RESET . TF::GREEN . " Enchants -=",
                    TF::RESET . TF::RED . "=- " . TF::BOLD . TF::RED . "$failedEnchants" . TF::RESET . TF::RED . " Failures -=",
                    TF::EOL,
                    TF::RESET . TF::BOLD . TF::AQUA . "Energy",
                    TF::RESET . "$energyBar",
                    TF::RESET . TF::GRAY . "(" . TF::WHITE . "$translatedEnergy" . TF::GRAY . "/" . $translatedEnergyNeeded . ")",
                    TF::EOL,
                    TF::RESET . TF::GRAY . "Blocks Mined: " . TF::WHITE . $blocksMined,
                    TF::RESET . TF::YELLOW . "Required Mining Level " . $levelRequired
                ];
            }
        }
        return $lore;
    }

    public function updatePickaxe(Item $item): Item {

        $type = $this->getType($item);

        switch($type) {

            case "Trainee":
                # get nbt Data
                $level = $item->getNamedTag()->getInt("Level");
                $prestige = $item->getNamedTag()->getInt("Prestige");

                # set name
                if($prestige >= 1) {
                    if($level == 0) {
                        $item->setCustomName(TF::AQUA . "Trainee Pickaxe " . TF::BOLD . TF::AQUA . " <" . TF::LIGHT_PURPLE . Translator::romanNumber($prestige) . TF::AQUA . ">");
                    } else {
                        $item->setCustomName(TF::AQUA . "Trainee Pickaxe " . TF::BOLD . TF::GREEN . $level . TF::AQUA . " <" . TF::LIGHT_PURPLE . Translator::romanNumber($prestige) . TF::AQUA . ">");
                    }
                } else {
                    $item->setCustomName(TF::AQUA . "Trainee Pickaxe " . TF::BOLD . TF::GREEN . $level . TF::RESET);
                }
                # create lore
                $lore = $this->createLore($item);
                # set the lore
                $item->setLore($lore);
                break;

            case "Stone":
                # get nbt Data
                $level = $item->getNamedTag()->getInt("Level");
                $prestige = $item->getNamedTag()->getInt("Prestige");

                # set name
                if($prestige >= 1) {
                    if($level == 0) {
                        $item->setCustomName(TF::AQUA . "Stone Pickaxe " . TF::BOLD . TF::AQUA . " <" . TF::LIGHT_PURPLE . Translator::romanNumber($prestige) . TF::AQUA . ">");
                    } else {
                        $item->setCustomName(TF::AQUA . "Stone Pickaxe " . TF::BOLD . TF::GREEN . $level . TF::AQUA . " <" . TF::LIGHT_PURPLE . Translator::romanNumber($prestige) . TF::AQUA . ">");
                    }
                } else {
                    $item->setCustomName(TF::AQUA . "Stone Pickaxe " . TF::BOLD . TF::GREEN . $level . TF::RESET);
                }
                # create lore
                $lore = $this->createLore($item);
                # set the lore
                $item->setLore($lore);
                break;

            case "Gold":
                # get nbt Data
                $level = $item->getNamedTag()->getInt("Level");
                $prestige = $item->getNamedTag()->getInt("Prestige");

                # set name
                if($prestige >= 1) {
                    if($level == 0) {
                        $item->setCustomName(TF::AQUA . "Gold Pickaxe " . TF::BOLD . TF::AQUA . " <" . TF::LIGHT_PURPLE . Translator::romanNumber($prestige) . TF::AQUA . ">");
                    } else {
                        $item->setCustomName(TF::AQUA . "Gold Pickaxe " . TF::BOLD . TF::GREEN . $level . TF::AQUA . " <" . TF::LIGHT_PURPLE . Translator::romanNumber($prestige) . TF::AQUA . ">");
                    }
                } else {
                    $item->setCustomName(TF::AQUA . "Gold Pickaxe " . TF::BOLD . TF::GREEN . $level . TF::RESET);
                }
                # create lore
                $lore = $this->createLore($item);
                # set the lore
                $item->setLore($lore);
                break;

            case "Iron":
                # get nbt Data
                $level = $item->getNamedTag()->getInt("Level");
                $prestige = $item->getNamedTag()->getInt("Prestige");

                # set name
                if($prestige >= 1) {
                    if($level == 0) {
                        $item->setCustomName(TF::AQUA . "Iron Pickaxe " . TF::BOLD . TF::AQUA . " <" . TF::LIGHT_PURPLE . Translator::romanNumber($prestige) . TF::AQUA . ">");
                    } else {
                        $item->setCustomName(TF::AQUA . "Iron Pickaxe " . TF::BOLD . TF::GREEN . $level . TF::AQUA . " <" . TF::LIGHT_PURPLE . Translator::romanNumber($prestige) . TF::AQUA . ">");
                    }
                } else {
                    $item->setCustomName(TF::AQUA . "Iron Pickaxe " . TF::BOLD . TF::GREEN . $level . TF::RESET);
                }
                # create lore
                $lore = $this->createLore($item);
                # set the lore
                $item->setLore($lore);
                break;

            case "Diamond":
                # get nbt Data
                $level = $item->getNamedTag()->getInt("Level");
                $prestige = $item->getNamedTag()->getInt("Prestige");

                # set name
                if($prestige >= 1) {
                    if($level == 0) {
                        $item->setCustomName(TF::AQUA . "Diamond Pickaxe " . TF::BOLD . TF::AQUA . " <" . TF::LIGHT_PURPLE . Translator::romanNumber($prestige) . TF::AQUA . ">");
                    } else {
                        $item->setCustomName(TF::AQUA . "Diamond Pickaxe " . TF::BOLD . TF::GREEN . $level . TF::AQUA . " <" . TF::LIGHT_PURPLE . Translator::romanNumber($prestige) . TF::AQUA . ">");
                    }
                } else {
                    $item->setCustomName(TF::AQUA . "Diamond Pickaxe " . TF::BOLD . TF::GREEN . $level . TF::RESET);
                }
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
                $prestige = $item->getNamedTag()->getInt("Prestige");

                # set name
                if($prestige >= 1) {
                    if($level == 0) {
                        $item->setCustomName(TF::AQUA . "Trainee Pickaxe " . TF::BOLD . TF::AQUA . " <" . TF::LIGHT_PURPLE . Translator::romanNumber((int)$prestige) . TF::AQUA . ">");
                    } else {
                        $item->setCustomName(TF::AQUA . "Trainee Pickaxe " . TF::BOLD . TF::GREEN . $level . TF::AQUA . " <" . TF::LIGHT_PURPLE . Translator::romanNumber((int)$prestige) . TF::AQUA . ">");
                    }
                } else {
                    $item->setCustomName(TF::AQUA . "Trainee Pickaxe " . TF::BOLD . TF::GREEN . $level . TF::RESET);
                }
                # create lore
                $lore = $this->createLore($item);
                # set the lore
                $item->setLore($lore);
                # give player item
                $player->getInventory()->setItemInHand($item);
                break;

            case "Stone":
                # get nbt Data
                $level = $item->getNamedTag()->getInt("Level");
                $prestige = $item->getNamedTag()->getInt("Prestige");

                # set name
                if($prestige >= 1) {
                    if($level == 0) {
                        $item->setCustomName(TF::AQUA . "Stone Pickaxe " . TF::BOLD . TF::AQUA . " <" . TF::LIGHT_PURPLE . Translator::romanNumber((int)$prestige) . TF::AQUA . ">");
                    } else {
                        $item->setCustomName(TF::AQUA . "Stone Pickaxe " . TF::BOLD . TF::GREEN . $level . TF::AQUA . " <" . TF::LIGHT_PURPLE . Translator::romanNumber((int)$prestige) . TF::AQUA . ">");
                    }
                } else {
                    $item->setCustomName(TF::AQUA . "Stone Pickaxe " . TF::BOLD . TF::GREEN . $level . TF::RESET);
                }
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
                $prestige = $item->getNamedTag()->getInt("Prestige");

                # set name
                if($prestige >= 1) {
                    if($level == 0) {
                        $item->setCustomName(TF::AQUA . "Gold Pickaxe " . TF::BOLD . TF::AQUA . " <" . TF::LIGHT_PURPLE . Translator::romanNumber((int)$prestige) . TF::AQUA . ">");
                    } else {
                        $item->setCustomName(TF::AQUA . "Gold Pickaxe " . TF::BOLD . TF::GREEN . $level . TF::AQUA . " <" . TF::LIGHT_PURPLE . Translator::romanNumber((int)$prestige) . TF::AQUA . ">");
                    }
                } else {
                    $item->setCustomName(TF::AQUA . "Gold Pickaxe " . TF::BOLD . TF::GREEN . $level . TF::RESET);
                }
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
                $prestige = $item->getNamedTag()->getInt("Prestige");

                # set name
                if($prestige >= 1) {
                    if($level == 0) {
                        $item->setCustomName(TF::AQUA . "Iron Pickaxe " . TF::BOLD . TF::AQUA . " <" . TF::LIGHT_PURPLE . Translator::romanNumber((int)$prestige) . TF::AQUA . ">");
                    } else {
                        $item->setCustomName(TF::AQUA . "Iron Pickaxe " . TF::BOLD . TF::GREEN . $level . TF::AQUA . " <" . TF::LIGHT_PURPLE . Translator::romanNumber((int)$prestige) . TF::AQUA . ">");
                    }
                } else {
                    $item->setCustomName(TF::AQUA . "Iron Pickaxe " . TF::BOLD . TF::GREEN . $level . TF::RESET);
                }
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
                $prestige = $item->getNamedTag()->getInt("Prestige");

                # set name
                if($prestige >= 1) {
                    if($level == 0) {
                        $item->setCustomName(TF::AQUA . "Diamond Pickaxe " . TF::BOLD . TF::AQUA . " <" . TF::LIGHT_PURPLE . Translator::romanNumber((int)$prestige) . TF::AQUA . ">");
                    } else {
                        $item->setCustomName(TF::AQUA . "Diamond Pickaxe " . TF::BOLD . TF::GREEN . $level . TF::AQUA . " <" . TF::LIGHT_PURPLE . Translator::romanNumber((int)$prestige) . TF::AQUA . ">");
                    }
                } else {
                    $item->setCustomName(TF::AQUA . "Diamond Pickaxe " . TF::BOLD . TF::GREEN . $level . TF::RESET);
                }
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

    public function levelUpAnimation(Player $player): void {
        $pk = OnScreenTextureAnimationPacket::create(3);
        $player->getNetworkSession()->sendDataPacket($pk);
        $player->sendTitle(TF::GOLD . "Pickaxe Level Up", "", 5, 30, 5);
    }
}