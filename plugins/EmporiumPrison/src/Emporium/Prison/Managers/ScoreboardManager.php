<?php

namespace Emporium\Prison\Managers;

use Emporium\Prison\EmporiumPrison;

use EmporiumCore\managers\data\DataManager;
use pocketmine\player\Player;

use pocketmine\network\mcpe\protocol\types\ScorePacketEntry;

use pocketmine\utils\TextFormat as TF;

use pocketmine\network\mcpe\protocol\{SetScorePacket, SetDisplayObjectivePacket, RemoveObjectivePacket};

use Tetro\EPTutorial\Loader;
use Tetro\EPTutorial\Managers\TutorialManager;
use Emporium\Prison\Managers\misc\Translator;


class ScoreboardManager {

    private const OBJECTIVE = "scoreboard";

    private EmporiumPrison $plugin;

    public function __construct(EmporiumPrison $plugin) {
        $this->plugin = $plugin;
    }

    public function setScoreboardEntry(Player $player, int $score, string $msg, string $objName): void {
        $entry = new ScorePacketEntry();
        $entry->objectiveName = self::OBJECTIVE;
        $entry->type = 3;
        $entry->customName = " $msg   ";
        $entry->score = $score;
        $entry->scoreboardId = $score;
        $pk = new SetScorePacket();
        $pk->type = 0;
        $pk->entries[$score] = $entry;
        $player->getNetworkSession()->sendDataPacket($pk);
    }

    public function createScoreboard(Player $player, string $title, string $slot = "sidebar", $order = 0): void {
        $pk = new SetDisplayObjectivePacket();
        $pk->displaySlot = $slot;
        $pk->objectiveName = self::OBJECTIVE;
        $pk->displayName = $title;
        $pk->criteriaName = "dummy";
        $pk->sortOrder = $order;
        $player->getNetworkSession()->sendDataPacket($pk);
    }

    public function rmScoreboard(Player $player): void {
        $pk = new RemoveObjectivePacket();
        $pk->objectiveName = self::OBJECTIVE;
        $player->getNetworkSession()->sendDataPacket($pk);
    }

    public function scoreboard(): void {

        $players = $this->plugin->getServer()->getOnlinePlayers();

        foreach($players as $player) {
            # world
            $world = $player->getWorld()->getFolderName();
            # mining booster manager
            $miningBoosterTimer = EmporiumPrison::getMiningManager()->getTime($player);
            $miningBoosterTranslated = Translator::timeConvert($miningBoosterTimer);
            $miningBoosterMultiplier = EmporiumPrison::getMiningManager()->getMultiplier($player);
            # energy manager
            $energyBoosterTime = EmporiumPrison::getEnergyManager()->getTime($player);
            $energyBoosterMultiplier = EmporiumPrison::getEnergyManager()->getMultiplier($player);
            $energyBoosterTranslated = Translator::timeConvert($energyBoosterTime);
            # level manager
            $playerLevel = EmporiumPrison::getPlayerLevelManager()->getPlayerLevel($player);
            $playerTotalXp = EmporiumPrison::getPlayerLevelManager()->getTotalPlayerXp($player);
            $playerXp = EmporiumPrison::getPlayerLevelManager()->getPlayerXp($player);
            $nextLevelXp = EmporiumPrison::getPlayerLevelManager()->getNextPlayerLevelXp($player);
            $xpNeeded = $nextLevelXp - $playerXp;
            # pickaxe manager
            # tutorial manager
            $tutorialManager = new TutorialManager();
            $tutorialComplete = $tutorialManager->checkPlayerTutorialComplete($player);
            $tutorialProgress = $tutorialManager->getPlayerTutorialProgress($player);
            # player balance
            $playerBalance = DataManager::getData($player, "Players", "Money");
            # player location information
            $x = $player->getLocation()->getX();
            $z = $player->getLocation()->getZ();
            # player level progress
            if($playerXp > 0) {
                $progress = ($playerXp / $nextLevelXp) * 100;
                $progressRounded = round($progress, +1);
            } else {
                $progressRounded = 0;
            }
            # pickaxe energy progress
            $pickaxeEnergy = null;
            $pickaxeEnergyNeeded = null;
            $item = $player->getInventory()->getItemInHand();
            if($item->getNamedTag()->getTag("PickaxeType") !== null) {
                if($item->getNamedTag()->getTag("Energy") !== null) {
                    $pickaxeEnergy = $item->getNamedTag()->getInt("Energy");
                    $pickaxeEnergyNeeded = EmporiumPrison::getPickaxeManager()->getEnergyNeeded($item);
                }
            }

            switch($world) {

                case "world":

                    $this->rmScoreboard($player, "scoreboard");
                    if($x >= -1604 && $x <= -1303 && $z >= -174 && $z <= 126) {
                        # PLAYER IS IN COAL ZONE
                        $this->rmScoreboard($player, "scoreboard");
                        $this->createScoreboard($player, TF::BOLD . TF::AQUA . " » " . TF::GRAY . "Coal Mine" . TF::AQUA . " « ", "scoreboard");
                    } elseif($x >= -1285 && $x <= -1038 && $z >= 88 && $z <= 389) {
                        # PLAYER IS IN IRON ZONE
                        $this->rmScoreboard($player, "scoreboard");
                        $this->createScoreboard($player, TF::BOLD . TF::AQUA . " » " . TF::GRAY . "Iron Mine" . TF::AQUA . " « ", "scoreboard");
                    } elseif ($x >= -937 && $x <= -500 && $z >= -352 && $z <= 46) {
                        # PLAYER IS IN LAPIS ZONE
                        $this->rmScoreboard($player, "scoreboard");
                        $this->createScoreboard($player, TF::BOLD . TF::AQUA . " » " . TF::GRAY . "Lapis Mine" . TF::AQUA . " « ", "scoreboard");
                    } elseif($x >= -608 && $x <= -190 && $z >= 5 && $z <= 509) {
                        # PLAYER IS IN REDSTONE ZONE
                        $this->rmScoreboard($player, "scoreboard");
                        $this->createScoreboard($player, TF::BOLD . TF::AQUA . " » " . TF::GRAY . "Redstone Mine" . TF::AQUA . " « ", "scoreboard");
                    } elseif ($x >= -233 && $x <= 214 && $z >= -348 && $z <= 106) {
                        # PLAYER IS IN GOLD ZONE
                        $this->rmScoreboard($player, "scoreboard");
                        $this->createScoreboard($player, TF::BOLD . TF::AQUA . " » " . TF::GRAY . "Gold Mine" . TF::AQUA . " « ", "scoreboard");
                    } elseif ($x >= 159 && $x <= 545 && $z >= -52 && $z <= 425) {
                        # PLAYER IS IN DIAMOND ZONE
                        $this->rmScoreboard($player, "scoreboard");
                        $this->createScoreboard($player, TF::BOLD . TF::AQUA . " » " . TF::GRAY . "Diamond Mine" . TF::AQUA . " « ", "scoreboard");
                    } elseif ($x >= 1063 && $x <= 1418 && $z >= -323 && $z <= 32) {
                        # PLAYER IS IN EMERALD ZONE
                        $this->rmScoreboard($player, "scoreboard");
                        $this->createScoreboard($player, TF::BOLD . TF::AQUA . " » " . TF::GRAY . "Emerald Mine" . TF::AQUA . " « ", "scoreboard");
                    } else {
                        # default scoreboard
                        $this->rmScoreboard($player, "scoreboard");
                        $this->createScoreboard($player, TF::BOLD . TF::AQUA . " » " . TF::GRAY . "Emporium Prison" . TF::AQUA . " « ", "scoreboard");
                    }

                    if($item->getNamedTag()->getTag("PickaxeType") !== null) {
                        if($energyBoosterTime > 0 && $miningBoosterTimer > 0) {
                            $this->setScoreboardEntry($player, 1, "§r ", "scoreboard");
                            $this->setScoreboardEntry($player, 2, TF::BOLD . TF::AQUA . "Level: " . TF::RESET . TF::WHITE . $playerLevel . TF::GRAY . " (" . TF::WHITE . Translator::shortNumber($playerTotalXp) . TF::GRAY . "XP)", "scoreboard");
                            $this->setScoreboardEntry($player, 3, TF::GRAY . $xpNeeded . " (" . TF::GREEN . $progressRounded . "%%%%" . TF::GRAY . ") to " . TF::WHITE . $playerLevel + 1, "scoreboard");                        $this->setScoreboardEntry($player, 4, "§r   ", "scoreboard");
                            $this->setScoreboardEntry($player, 4, "§r  ", "scoreboard");
                            $this->setScoreboardEntry($player, 5, TF::BOLD . TF::AQUA . "Balance: " . TF::RESET . TF::GREEN . "$" . TF::WHITE . Translator::shortNumber($playerBalance), "scoreboard");
                            $this->setScoreboardEntry($player, 6, "§r   ", "scoreboard");
                            $this->setScoreboardEntry($player, 7, TF::BOLD . TF::AQUA . "Pickaxe Energy: ", "scoreboard");
                            $this->setScoreboardEntry($player, 8, TF::GRAY . Translator::shortNumber($pickaxeEnergy) . "/" . Translator::shortNumber($pickaxeEnergyNeeded), "scoreboard");
                            $this->setScoreboardEntry($player, 9, "§r    ", "scoreboard");
                            $this->setScoreboardEntry($player, 10, TF::BOLD . TF::AQUA . "BOOSTERS", "scoreboard");
                            $this->setScoreboardEntry($player, 11, TF::GRAY . " Energy - " . TF::RESET . TF::WHITE . $energyBoosterTranslated . TF::GRAY . " ($energyBoosterMultiplier" . "x)", "scoreboard");
                            $this->setScoreboardEntry($player, 12, TF::GRAY . " Mining - " . TF::RESET . TF::WHITE . $miningBoosterTranslated . TF::GRAY . " ($miningBoosterMultiplier" . "x)", "scoreboard");
                            $this->setScoreboardEntry($player, 13, "§r     ", "scoreboard");
                            $this->setScoreboardEntry($player, 14, "§r      ", "scoreboard");
                        } elseif($energyBoosterTime > 0) {
                            $this->setScoreboardEntry($player, 1, "§r ", "scoreboard");
                            $this->setScoreboardEntry($player, 2, TF::BOLD . TF::AQUA . "Level: " . TF::RESET . TF::WHITE . $playerLevel . TF::GRAY . " (" . TF::WHITE . Translator::shortNumber($playerTotalXp) . TF::GRAY . "XP)", "scoreboard");
                            $this->setScoreboardEntry($player, 3, TF::GRAY . $xpNeeded . " (" . TF::GREEN . $progressRounded . "%%%%" . TF::GRAY . ") to " . TF::WHITE . $playerLevel + 1, "scoreboard");                        $this->setScoreboardEntry($player, 4, "§r   ", "scoreboard");
                            $this->setScoreboardEntry($player, 4, "§r  ", "scoreboard");
                            $this->setScoreboardEntry($player, 5, TF::BOLD . TF::AQUA . "Balance: " . TF::RESET . TF::GREEN . "$" . TF::WHITE . Translator::shortNumber($playerBalance), "scoreboard");
                            $this->setScoreboardEntry($player, 6, "§r   ", "scoreboard");
                            $this->setScoreboardEntry($player, 7, TF::BOLD . TF::AQUA . "Pickaxe Energy: ", "scoreboard");
                            $this->setScoreboardEntry($player, 8, TF::GRAY . Translator::shortNumber($pickaxeEnergy) . "/" . Translator::shortNumber($pickaxeEnergyNeeded), "scoreboard");
                            $this->setScoreboardEntry($player, 9, "§r    ", "scoreboard");
                            $this->setScoreboardEntry($player, 10, TF::BOLD . TF::AQUA . "BOOSTERS", "scoreboard");
                            $this->setScoreboardEntry($player, 11, TF::GRAY . " Energy - " . TF::RESET . TF::WHITE . $energyBoosterTranslated . TF::GRAY . " ($energyBoosterMultiplier" . "x)", "scoreboard");
                            $this->setScoreboardEntry($player, 12, "§r     ", "scoreboard");
                            $this->setScoreboardEntry($player, 13, "§r      ", "scoreboard");
                            $this->setScoreboardEntry($player, 14, "§r       ", "scoreboard");
                        } elseif($miningBoosterTimer > 0) {
                            $this->setScoreboardEntry($player, 1, "§r ", "scoreboard");
                            $this->setScoreboardEntry($player, 2, TF::BOLD . TF::AQUA . "Level: " . TF::RESET . TF::WHITE . $playerLevel . TF::GRAY . " (" . TF::WHITE . Translator::shortNumber($playerTotalXp) . TF::GRAY . "XP)", "scoreboard");
                            $this->setScoreboardEntry($player, 3, TF::GRAY . $xpNeeded . " (" . TF::GREEN . $progressRounded . "%%%%" . TF::GRAY . ") to " . TF::WHITE . $playerLevel + 1, "scoreboard");                        $this->setScoreboardEntry($player, 4, "§r   ", "scoreboard");
                            $this->setScoreboardEntry($player, 4, "§r  ", "scoreboard");
                            $this->setScoreboardEntry($player, 5, TF::BOLD . TF::AQUA . "Balance: " . TF::RESET . TF::GREEN . "$" . TF::WHITE . Translator::shortNumber($playerBalance), "scoreboard");
                            $this->setScoreboardEntry($player, 6, "§r   ", "scoreboard");
                            $this->setScoreboardEntry($player, 7, TF::BOLD . TF::AQUA . "Pickaxe Energy: ", "scoreboard");
                            $this->setScoreboardEntry($player, 8, TF::GRAY . Translator::shortNumber($pickaxeEnergy) . "/" . Translator::shortNumber($pickaxeEnergyNeeded), "scoreboard");
                            $this->setScoreboardEntry($player, 9, "§r       ", "scoreboard");
                            $this->setScoreboardEntry($player, 10, TF::BOLD . TF::AQUA . "BOOSTERS", "scoreboard");
                            $this->setScoreboardEntry($player, 11, TF::GRAY . " Mining - " . TF::RESET . TF::WHITE . $miningBoosterTranslated . TF::GRAY . " ($miningBoosterMultiplier" . "x)", "scoreboard");
                            $this->setScoreboardEntry($player, 12, "§r    ", "scoreboard");
                            $this->setScoreboardEntry($player, 13, "§r     ", "scoreboard");
                            $this->setScoreboardEntry($player, 14, "§r      ", "scoreboard");
                        } else {
                            $this->setScoreboardEntry($player, 1, "§r ", "scoreboard");
                            $this->setScoreboardEntry($player, 2, TF::BOLD . TF::AQUA . "Level: " . TF::RESET . TF::WHITE . $playerLevel . TF::GRAY . " (" . TF::WHITE . Translator::shortNumber($playerTotalXp) . TF::GRAY . "XP)", "scoreboard");
                            $this->setScoreboardEntry($player, 3, TF::GRAY . $xpNeeded . " (" . TF::GREEN . $progressRounded . "%%%%" . TF::GRAY . ") to " . TF::WHITE . $playerLevel + 1, "scoreboard");
                            $this->setScoreboardEntry($player, 4, "§r   ", "scoreboard");
                            $this->setScoreboardEntry($player, 5, TF::BOLD . TF::AQUA . "Balance: " . TF::RESET . TF::GREEN . "$" . TF::WHITE . Translator::shortNumber($playerBalance), "scoreboard");
                            $this->setScoreboardEntry($player, 6, "§r   ", "scoreboard");
                            $this->setScoreboardEntry($player, 7, TF::BOLD . TF::AQUA . "Pickaxe Energy: ", "scoreboard");
                            $this->setScoreboardEntry($player, 8, TF::GRAY . Translator::shortNumber($pickaxeEnergy) . "/" . Translator::shortNumber($pickaxeEnergyNeeded), "scoreboard");
                            $this->setScoreboardEntry($player, 9, "§r       ", "scoreboard");
                            $this->setScoreboardEntry($player, 10, "§r       ", "scoreboard");
                            $this->setScoreboardEntry($player, 11, "§r        ", "scoreboard");
                            $this->setScoreboardEntry($player, 12, "§r         ", "scoreboard");
                            $this->setScoreboardEntry($player, 13, "§r          ", "scoreboard");
                            $this->setScoreboardEntry($player, 14, "§r           ", "scoreboard");
                        }
                    } else {
                        if($energyBoosterTime > 0 && $miningBoosterTimer > 0) {
                            $this->setScoreboardEntry($player, 1, "§r ", "scoreboard");
                            $this->setScoreboardEntry($player, 2, TF::BOLD . TF::AQUA . "Level: " . TF::RESET . TF::WHITE . $playerLevel . TF::GRAY . " (" . TF::WHITE . Translator::shortNumber($playerTotalXp) . TF::GRAY . "XP)", "scoreboard");
                            $this->setScoreboardEntry($player, 3, TF::GRAY . $xpNeeded . " (" . TF::GREEN . $progressRounded . "%%%%" . TF::GRAY . ") to " . TF::WHITE . $playerLevel + 1, "scoreboard");                        $this->setScoreboardEntry($player, 4, "§r   ", "scoreboard");
                            $this->setScoreboardEntry($player, 4, "§r  ", "scoreboard");
                            $this->setScoreboardEntry($player, 5, TF::BOLD . TF::AQUA . "Balance: " . TF::RESET . TF::GREEN . "$" . TF::WHITE . Translator::shortNumber($playerBalance), "scoreboard");
                            $this->setScoreboardEntry($player, 6, "§r    ", "scoreboard");
                            $this->setScoreboardEntry($player, 7, TF::BOLD . TF::AQUA . "BOOSTERS", "scoreboard");
                            $this->setScoreboardEntry($player, 8, TF::GRAY . " Energy - " . TF::RESET . TF::WHITE . $energyBoosterTranslated . TF::GRAY . " ($energyBoosterMultiplier" . "x)", "scoreboard");
                            $this->setScoreboardEntry($player, 9, TF::GRAY . " Mining - " . TF::RESET . TF::WHITE . $miningBoosterTranslated . TF::GRAY . " ($miningBoosterMultiplier" . "x)", "scoreboard");
                            $this->setScoreboardEntry($player, 10, "§r     ", "scoreboard");
                            $this->setScoreboardEntry($player, 11, "§r      ", "scoreboard");
                            $this->setScoreboardEntry($player, 12, "§r       ", "scoreboard");
                            $this->setScoreboardEntry($player, 13, "§r        ", "scoreboard");
                            $this->setScoreboardEntry($player, 14, "§r         ", "scoreboard");
                        } elseif($energyBoosterTime > 0) {
                            $this->setScoreboardEntry($player, 1, "§r ", "scoreboard");
                            $this->setScoreboardEntry($player, 2, TF::BOLD . TF::AQUA . "Level: " . TF::RESET . TF::WHITE . $playerLevel . TF::GRAY . " (" . TF::WHITE . Translator::shortNumber($playerTotalXp) . TF::GRAY . "XP)", "scoreboard");
                            $this->setScoreboardEntry($player, 3, TF::GRAY . $xpNeeded . " (" . TF::GREEN . $progressRounded . "%%%%" . TF::GRAY . ") to " . TF::WHITE . $playerLevel + 1, "scoreboard");                        $this->setScoreboardEntry($player, 4, "§r   ", "scoreboard");
                            $this->setScoreboardEntry($player, 4, "§r  ", "scoreboard");
                            $this->setScoreboardEntry($player, 5, TF::BOLD . TF::AQUA . "Balance: " . TF::RESET . TF::GREEN . "$" . TF::WHITE . Translator::shortNumber($playerBalance), "scoreboard");
                            $this->setScoreboardEntry($player, 6, "§r   ", "scoreboard");
                            $this->setScoreboardEntry($player, 7, "§r    ", "scoreboard");
                            $this->setScoreboardEntry($player, 8, TF::BOLD . TF::AQUA . "BOOSTERS", "scoreboard");
                            $this->setScoreboardEntry($player, 9, TF::GRAY . " Energy - " . TF::RESET . TF::WHITE . $energyBoosterTranslated . TF::GRAY . " ($energyBoosterMultiplier" . "x)", "scoreboard");
                            $this->setScoreboardEntry($player, 10, "§r     ", "scoreboard");
                            $this->setScoreboardEntry($player, 11, "§r      ", "scoreboard");
                            $this->setScoreboardEntry($player, 12, "§r       ", "scoreboard");
                            $this->setScoreboardEntry($player, 13, "§r        ", "scoreboard");
                            $this->setScoreboardEntry($player, 14, "§r         ", "scoreboard");
                        } elseif($miningBoosterTimer > 0) {
                            $this->setScoreboardEntry($player, 1, "§r ", "scoreboard");
                            $this->setScoreboardEntry($player, 2, TF::BOLD . TF::AQUA . "Level: " . TF::RESET . TF::WHITE . $playerLevel . TF::GRAY . " (" . TF::WHITE . Translator::shortNumber($playerTotalXp) . TF::GRAY . "XP)", "scoreboard");
                            $this->setScoreboardEntry($player, 3, TF::GRAY . $xpNeeded . " (" . TF::GREEN . $progressRounded . "%%%%" . TF::GRAY . ") to " . TF::WHITE . $playerLevel + 1, "scoreboard");                        $this->setScoreboardEntry($player, 4, "§r   ", "scoreboard");
                            $this->setScoreboardEntry($player, 4, "§r  ", "scoreboard");
                            $this->setScoreboardEntry($player, 5, TF::BOLD . TF::AQUA . "Balance: " . TF::RESET . TF::GREEN . "$" . TF::WHITE . Translator::shortNumber($playerBalance), "scoreboard");
                            $this->setScoreboardEntry($player, 6, "§r   ", "scoreboard");
                            $this->setScoreboardEntry($player, 7, TF::BOLD . TF::AQUA . "BOOSTERS", "scoreboard");
                            $this->setScoreboardEntry($player, 8, TF::GRAY . " Mining - " . TF::RESET . TF::WHITE . $miningBoosterTranslated . TF::GRAY . " ($miningBoosterMultiplier" . "x)", "scoreboard");
                            $this->setScoreboardEntry($player, 9, "§r     ", "scoreboard");
                            $this->setScoreboardEntry($player, 10, "§r      ", "scoreboard");
                            $this->setScoreboardEntry($player, 11, "§r       ", "scoreboard");
                            $this->setScoreboardEntry($player, 12, "§r        ", "scoreboard");
                            $this->setScoreboardEntry($player, 13, "§r         ", "scoreboard");
                            $this->setScoreboardEntry($player, 14, "§r          ", "scoreboard");
                        } else {
                            $this->setScoreboardEntry($player, 1, "§r ", "scoreboard");
                            $this->setScoreboardEntry($player, 2, TF::BOLD . TF::AQUA . "Level: " . TF::RESET . TF::WHITE . $playerLevel . TF::GRAY . " (" . TF::WHITE . Translator::shortNumber($playerTotalXp) . TF::GRAY . "XP)", "scoreboard");
                            $this->setScoreboardEntry($player, 3, TF::GRAY . $xpNeeded . " (" . TF::GREEN . $progressRounded . "%%%%" . TF::GRAY . ") to " . TF::WHITE . $playerLevel + 1, "scoreboard");
                            $this->setScoreboardEntry($player, 4, "§r  ", "scoreboard");
                            $this->setScoreboardEntry($player, 5, TF::BOLD . TF::AQUA . "Balance: " . TF::RESET . TF::GREEN . "$" . TF::WHITE . Translator::shortNumber($playerBalance), "scoreboard");
                            $this->setScoreboardEntry($player, 6, "§r   ", "scoreboard");
                            $this->setScoreboardEntry($player, 7, "§r    ", "scoreboard");
                            $this->setScoreboardEntry($player, 8, "§r     ", "scoreboard");
                            $this->setScoreboardEntry($player, 9, "§r      ", "scoreboard");
                            $this->setScoreboardEntry($player, 10, "§r       ", "scoreboard");
                            $this->setScoreboardEntry($player, 11, "§r        ", "scoreboard");
                            $this->setScoreboardEntry($player, 12, "§r         ", "scoreboard");
                            $this->setScoreboardEntry($player, 13, "§r          ", "scoreboard");
                            $this->setScoreboardEntry($player, 14, "§r           ", "scoreboard");
                        }
                    }
                    $this->setScoreboardEntry($player, 15, TF::AQUA . "prison.emporiumpvp.com", "scoreboard");
                    break;

                case "TutorialMine":
                    if(!$tutorialComplete) {
                        $this->rmScoreboard($player, "scoreboard");
                        $this->createScoreboard($player, TF::BOLD . TF::AQUA . " » " . TF::GRAY . "Training Area" . TF::AQUA . " « " , "scoreboard");
                        if($item->getNamedTag()->getTag("PickaxeType") !== null) {
                            # holding pickaxe
                            if($pickaxeEnergy >= $pickaxeEnergyNeeded) {
                                # pickaxe has max energy
                                switch($tutorialProgress) {

                                    case 0:
                                        $this->setScoreboardEntry($player, 1, "§r ", "scoreboard");
                                        $this->setScoreboardEntry($player, 2, TF::BOLD . TF::AQUA . "Level: " . TF::RESET . TF::WHITE . $playerLevel . TF::GRAY . " (" . TF::WHITE . Translator::shortNumber($playerTotalXp) . TF::GRAY . "XP)", "scoreboard");
                                        $this->setScoreboardEntry($player, 3, TF::GRAY . $xpNeeded . " (" . TF::GREEN . $progressRounded . "%%%%" . TF::GRAY . ") to " . TF::WHITE . $playerLevel + 1, "scoreboard");                                $this->setScoreboardEntry($player, 4, TF::BOLD . TF::AQUA . "XP: " . TF::RESET . TF::WHITE . $playerXp . "/" . $nextLevelXp . TF::GRAY . " (" . $progressRounded . "%%%%)", "scoreboard");
                                        $this->setScoreboardEntry($player, 4, "§r   ", "scoreboard");
                                        $this->setScoreboardEntry($player, 5, TF::BOLD . TF::AQUA . "Balance: " . TF::RESET . TF::GREEN . "$" . TF::WHITE . Translator::shortNumber($playerBalance), "scoreboard");
                                        $this->setScoreboardEntry($player, 6, "§r    ", "scoreboard");
                                        $this->setScoreboardEntry($player, 7, TF::BOLD . TF::AQUA . "Pickaxe Energy: ", "scoreboard");
                                        $this->setScoreboardEntry($player, 8, TF::RED . " Pickaxe ready to forge!", "scoreboard");
                                        $this->setScoreboardEntry($player, 9, "§r     ", "scoreboard");
                                        $this->setScoreboardEntry($player, 10, TF::BOLD . TF::YELLOW . "NEW QUEST", "scoreboard");
                                        $this->setScoreboardEntry($player, 11, TF::WHITE . " Talk to the Tour Guide", "scoreboard");
                                        $this->setScoreboardEntry($player, 12, "§r      ", "scoreboard");
                                        $this->setScoreboardEntry($player, 13, "§r       ", "scoreboard");
                                        $this->setScoreboardEntry($player, 14, "§r        ", "scoreboard");
                                        break;

                                    case 1:
                                        $this->setScoreboardEntry($player, 1, "§r ", "scoreboard");
                                        $this->setScoreboardEntry($player, 2, TF::BOLD . TF::AQUA . "Level: " . TF::RESET . TF::WHITE . $playerLevel . TF::GRAY . " (" . TF::WHITE . Translator::shortNumber($playerTotalXp) . TF::GRAY . "XP)", "scoreboard");
                                        $this->setScoreboardEntry($player, 3, TF::GRAY . $xpNeeded . " (" . TF::GREEN . $progressRounded . "%%%%" . TF::GRAY . ") to " . TF::WHITE . $playerLevel + 1, "scoreboard");
                                        $this->setScoreboardEntry($player, 4, "§r   ", "scoreboard");
                                        $this->setScoreboardEntry($player, 5, TF::BOLD . TF::AQUA . "Balance: " . TF::RESET . TF::GREEN . "$" . TF::WHITE . Translator::shortNumber($playerBalance), "scoreboard");
                                        $this->setScoreboardEntry($player, 6, "§r    ", "scoreboard");
                                        $this->setScoreboardEntry($player, 7, TF::BOLD . TF::AQUA . "Pickaxe Energy: ", "scoreboard");
                                        $this->setScoreboardEntry($player, 8, TF::RED . " Pickaxe ready to forge!", "scoreboard");
                                        $this->setScoreboardEntry($player, 9, "§r     ", "scoreboard");
                                        $this->setScoreboardEntry($player, 10, TF::BOLD . TF::YELLOW . "NEW QUEST", "scoreboard");
                                        $this->setScoreboardEntry($player, 11, TF::WHITE . " Go to the mines and", "scoreboard");
                                        $this->setScoreboardEntry($player, 12, TF::WHITE . " start mining!", "scoreboard");
                                        $this->setScoreboardEntry($player, 13, "§r      ", "scoreboard");
                                        $this->setScoreboardEntry($player, 14, "§r        ", "scoreboard");
                                        break;

                                    case 2:
                                        $this->setScoreboardEntry($player, 1, "§r ", "scoreboard");
                                        $this->setScoreboardEntry($player, 2, TF::BOLD . TF::AQUA . "Level: " . TF::RESET . TF::WHITE . $playerLevel . TF::GRAY . " (" . TF::WHITE . Translator::shortNumber($playerTotalXp) . TF::GRAY . "XP)", "scoreboard");
                                        $this->setScoreboardEntry($player, 3, TF::GRAY . $xpNeeded . " (" . TF::GREEN . $progressRounded . "%%%%" . TF::GRAY . ") to " . TF::WHITE . $playerLevel + 1, "scoreboard");
                                        $this->setScoreboardEntry($player, 4, "§r   ", "scoreboard");
                                        $this->setScoreboardEntry($player, 5, TF::BOLD . TF::AQUA . "Balance: " . TF::RESET . TF::GREEN . "$" . TF::WHITE . Translator::shortNumber($playerBalance), "scoreboard");
                                        $this->setScoreboardEntry($player, 6, "§r    ", "scoreboard");
                                        $this->setScoreboardEntry($player, 7, TF::BOLD . TF::AQUA . "Pickaxe Energy: ", "scoreboard");
                                        $this->setScoreboardEntry($player, 8, TF::RED . " Pickaxe ready to forge!", "scoreboard");
                                        $this->setScoreboardEntry($player, 9, "§r     ", "scoreboard");
                                        $this->setScoreboardEntry($player, 10, TF::BOLD . TF::YELLOW . "NEW QUEST", "scoreboard");
                                        $this->setScoreboardEntry($player, 11, TF::WHITE . " Talk to the Ore Merchant", "scoreboard");
                                        $this->setScoreboardEntry($player, 12, "§r      ", "scoreboard");
                                        $this->setScoreboardEntry($player, 13, "§r       ", "scoreboard");
                                        $this->setScoreboardEntry($player, 14, "§r        ", "scoreboard");
                                        break;

                                    case 3:
                                        $this->setScoreboardEntry($player, 1, "§r ", "scoreboard");
                                        $this->setScoreboardEntry($player, 2, TF::BOLD . TF::AQUA . "Level: " . TF::RESET . TF::WHITE . $playerLevel . TF::GRAY . " (" . TF::WHITE . Translator::shortNumber($playerTotalXp) . TF::GRAY . "XP)", "scoreboard");
                                        $this->setScoreboardEntry($player, 3, TF::GRAY . $xpNeeded . " (" . TF::GREEN . $progressRounded . "%%%%" . TF::GRAY . ") to " . TF::WHITE . $playerLevel + 1, "scoreboard");
                                        $this->setScoreboardEntry($player, 4, "§r   ", "scoreboard");
                                        $this->setScoreboardEntry($player, 5, TF::BOLD . TF::AQUA . "Balance: " . TF::RESET . TF::GREEN . "$" . TF::WHITE . Translator::shortNumber($playerBalance), "scoreboard");
                                        $this->setScoreboardEntry($player, 6, "§r    ", "scoreboard");
                                        $this->setScoreboardEntry($player, 7, TF::BOLD . TF::AQUA . "Pickaxe Energy: ", "scoreboard");
                                        $this->setScoreboardEntry($player, 8, TF::RED . " Pickaxe ready to forge!", "scoreboard");
                                        $this->setScoreboardEntry($player, 8, TF::GRAY . Translator::shortNumber($pickaxeEnergy) . "/" . Translator::shortNumber($pickaxeEnergyNeeded), "scoreboard");
                                        $this->setScoreboardEntry($player, 9, "§r     ", "scoreboard");
                                        $this->setScoreboardEntry($player, 10, TF::BOLD . TF::YELLOW . "NEW QUEST", "scoreboard");
                                        $this->setScoreboardEntry($player, 11, TF::WHITE . " Fill your Pickaxe Energy", "scoreboard");
                                        $this->setScoreboardEntry($player, 12, "§r      ", "scoreboard");
                                        $this->setScoreboardEntry($player, 13, "§r       ", "scoreboard");
                                        $this->setScoreboardEntry($player, 14, "§r        ", "scoreboard");
                                        break;

                                    case 4:
                                        $this->setScoreboardEntry($player, 1, "§r ", "scoreboard");
                                        $this->setScoreboardEntry($player, 2, TF::BOLD . TF::AQUA . "Level: " . TF::RESET . TF::WHITE . $playerLevel . TF::GRAY . " (" . TF::WHITE . Translator::shortNumber($playerTotalXp) . TF::GRAY . "XP)", "scoreboard");
                                        $this->setScoreboardEntry($player, 3, TF::GRAY . $xpNeeded . " (" . TF::GREEN . $progressRounded . "%%%%" . TF::GRAY . ") to " . TF::WHITE . $playerLevel + 1, "scoreboard");
                                        $this->setScoreboardEntry($player, 4, "§r   ", "scoreboard");
                                        $this->setScoreboardEntry($player, 5, TF::BOLD . TF::AQUA . "Balance: " . TF::RESET . TF::GREEN . "$" . TF::WHITE . Translator::shortNumber($playerBalance), "scoreboard");
                                        $this->setScoreboardEntry($player, 6, "§r    ", "scoreboard");
                                        $this->setScoreboardEntry($player, 7, TF::BOLD . TF::AQUA . "Pickaxe Energy: ", "scoreboard");
                                        $this->setScoreboardEntry($player, 8, TF::RED . " Pickaxe ready to forge!", "scoreboard");
                                        $this->setScoreboardEntry($player, 8, TF::GRAY . Translator::shortNumber($pickaxeEnergy) . "/" . Translator::shortNumber($pickaxeEnergyNeeded), "scoreboard");
                                        $this->setScoreboardEntry($player, 9, "§r     ", "scoreboard");
                                        $this->setScoreboardEntry($player, 10, TF::BOLD . TF::YELLOW . "NEW QUEST", "scoreboard");
                                        $this->setScoreboardEntry($player, 11, TF::WHITE . " Forge your pickaxe at", "scoreboard");
                                        $this->setScoreboardEntry($player, 12, TF::WHITE . " the Wormhole", "scoreboard");
                                        $this->setScoreboardEntry($player, 13, "§r       ", "scoreboard");
                                        $this->setScoreboardEntry($player, 14, "§r        ", "scoreboard");
                                        break;

                                    case 5:
                                        $this->setScoreboardEntry($player, 1, "§r ", "scoreboard");
                                        $this->setScoreboardEntry($player, 2, TF::BOLD . TF::AQUA . "Level: " . TF::RESET . TF::WHITE . $playerLevel . TF::GRAY . " (" . TF::WHITE . Translator::shortNumber($playerTotalXp) . TF::GRAY . "XP)", "scoreboard");
                                        $this->setScoreboardEntry($player, 3, TF::GRAY . $xpNeeded . " (" . TF::GREEN . $progressRounded . "%%%%" . TF::GRAY . ") to " . TF::WHITE . $playerLevel + 1, "scoreboard");
                                        $this->setScoreboardEntry($player, 4, "§r  ", "scoreboard");
                                        $this->setScoreboardEntry($player, 5, TF::BOLD . TF::AQUA . "Balance: " . TF::RESET . TF::GREEN . "$" . TF::WHITE . Translator::shortNumber($playerBalance), "scoreboard");
                                        $this->setScoreboardEntry($player, 6, "§r   ", "scoreboard");
                                        $this->setScoreboardEntry($player, 7, TF::BOLD . TF::AQUA . "Pickaxe Energy: ", "scoreboard");
                                        $this->setScoreboardEntry($player, 8, TF::RED . " Pickaxe ready to forge!", "scoreboard");
                                        $this->setScoreboardEntry($player, 8, TF::GRAY . Translator::shortNumber($pickaxeEnergy) . "/" . Translator::shortNumber($pickaxeEnergyNeeded), "scoreboard");
                                        $this->setScoreboardEntry($player, 9, "§r    ", "scoreboard");
                                        $this->setScoreboardEntry($player, 10, TF::BOLD . TF::YELLOW . "ALL QUESTS COMPLETE", "scoreboard");
                                        $this->setScoreboardEntry($player, 11, TF::WHITE . " Level up to 10 to proceed", "scoreboard");
                                        $this->setScoreboardEntry($player, 12, "§r     ", "scoreboard");
                                        $this->setScoreboardEntry($player, 13, "§r      ", "scoreboard");
                                        $this->setScoreboardEntry($player, 14, "§r       ", "scoreboard");
                                        break;
                                }
                            } else {
                                # pickaxe doesn't have max energy
                                switch($tutorialProgress) {

                                    case 0:
                                        $this->setScoreboardEntry($player, 1, "§r ", "scoreboard");
                                        $this->setScoreboardEntry($player, 2, TF::BOLD . TF::AQUA . "Level: " . TF::RESET . TF::WHITE . $playerLevel . TF::GRAY . " (" . TF::WHITE . Translator::shortNumber($playerTotalXp) . TF::GRAY . "XP)", "scoreboard");
                                        $this->setScoreboardEntry($player, 3, TF::GRAY . $xpNeeded . " (" . TF::GREEN . $progressRounded . "%%%%" . TF::GRAY . ") to " . TF::WHITE . $playerLevel + 1, "scoreboard");                                $this->setScoreboardEntry($player, 4, TF::BOLD . TF::AQUA . "XP: " . TF::RESET . TF::WHITE . $playerXp . "/" . $nextLevelXp . TF::GRAY . " (" . $progressRounded . "%%%%)", "scoreboard");
                                        $this->setScoreboardEntry($player, 4, "§r   ", "scoreboard");
                                        $this->setScoreboardEntry($player, 5, TF::BOLD . TF::AQUA . "Balance: " . TF::RESET . TF::GREEN . "$" . TF::WHITE . Translator::shortNumber($playerBalance), "scoreboard");
                                        $this->setScoreboardEntry($player, 6, "§r    ", "scoreboard");
                                        $this->setScoreboardEntry($player, 7, TF::BOLD . TF::AQUA . "Pickaxe Energy: ", "scoreboard");
                                        $this->setScoreboardEntry($player, 8, TF::GRAY . Translator::shortNumber($pickaxeEnergy) . "/" . Translator::shortNumber($pickaxeEnergyNeeded), "scoreboard");
                                        $this->setScoreboardEntry($player, 9, "§r     ", "scoreboard");
                                        $this->setScoreboardEntry($player, 10, TF::BOLD . TF::YELLOW . "NEW QUEST", "scoreboard");
                                        $this->setScoreboardEntry($player, 11, TF::WHITE . " Talk to the Tour Guide", "scoreboard");
                                        $this->setScoreboardEntry($player, 12, "§r      ", "scoreboard");
                                        $this->setScoreboardEntry($player, 13, "§r       ", "scoreboard");
                                        $this->setScoreboardEntry($player, 14, "§r        ", "scoreboard");
                                        break;

                                    case 1:
                                        $this->setScoreboardEntry($player, 1, "§r ", "scoreboard");
                                        $this->setScoreboardEntry($player, 2, TF::BOLD . TF::AQUA . "Level: " . TF::RESET . TF::WHITE . $playerLevel . TF::GRAY . " (" . TF::WHITE . Translator::shortNumber($playerTotalXp) . TF::GRAY . "XP)", "scoreboard");
                                        $this->setScoreboardEntry($player, 3, TF::GRAY . $xpNeeded . " (" . TF::GREEN . $progressRounded . "%%%%" . TF::GRAY . ") to " . TF::WHITE . $playerLevel + 1, "scoreboard");
                                        $this->setScoreboardEntry($player, 4, "§r   ", "scoreboard");
                                        $this->setScoreboardEntry($player, 5, TF::BOLD . TF::AQUA . "Balance: " . TF::RESET . TF::GREEN . "$" . TF::WHITE . Translator::shortNumber($playerBalance), "scoreboard");
                                        $this->setScoreboardEntry($player, 6, "§r    ", "scoreboard");
                                        $this->setScoreboardEntry($player, 7, TF::BOLD . TF::AQUA . "Pickaxe Energy: ", "scoreboard");
                                        $this->setScoreboardEntry($player, 8, TF::GRAY . Translator::shortNumber($pickaxeEnergy) . "/" . Translator::shortNumber($pickaxeEnergyNeeded), "scoreboard");
                                        $this->setScoreboardEntry($player, 9, "§r     ", "scoreboard");
                                        $this->setScoreboardEntry($player, 10, TF::BOLD . TF::YELLOW . "NEW QUEST", "scoreboard");
                                        $this->setScoreboardEntry($player, 11, TF::WHITE . " Go to the mines and", "scoreboard");
                                        $this->setScoreboardEntry($player, 12, TF::WHITE . " start mining!", "scoreboard");
                                        $this->setScoreboardEntry($player, 13, "§r      ", "scoreboard");
                                        $this->setScoreboardEntry($player, 14, "§r        ", "scoreboard");
                                        break;

                                    case 2:
                                        $this->setScoreboardEntry($player, 1, "§r ", "scoreboard");
                                        $this->setScoreboardEntry($player, 2, TF::BOLD . TF::AQUA . "Level: " . TF::RESET . TF::WHITE . $playerLevel . TF::GRAY . " (" . TF::WHITE . Translator::shortNumber($playerTotalXp) . TF::GRAY . "XP)", "scoreboard");
                                        $this->setScoreboardEntry($player, 3, TF::GRAY . $xpNeeded . " (" . TF::GREEN . $progressRounded . "%%%%" . TF::GRAY . ") to " . TF::WHITE . $playerLevel + 1, "scoreboard");
                                        $this->setScoreboardEntry($player, 4, "§r   ", "scoreboard");
                                        $this->setScoreboardEntry($player, 5, TF::BOLD . TF::AQUA . "Balance: " . TF::RESET . TF::GREEN . "$" . TF::WHITE . Translator::shortNumber($playerBalance), "scoreboard");
                                        $this->setScoreboardEntry($player, 6, "§r    ", "scoreboard");
                                        $this->setScoreboardEntry($player, 7, TF::BOLD . TF::AQUA . "Pickaxe Energy: ", "scoreboard");
                                        $this->setScoreboardEntry($player, 8, TF::GRAY . Translator::shortNumber($pickaxeEnergy) . "/" . Translator::shortNumber($pickaxeEnergyNeeded), "scoreboard");
                                        $this->setScoreboardEntry($player, 9, "§r     ", "scoreboard");
                                        $this->setScoreboardEntry($player, 10, TF::BOLD . TF::YELLOW . "NEW QUEST", "scoreboard");
                                        $this->setScoreboardEntry($player, 11, TF::WHITE . " Talk to the Ore Merchant", "scoreboard");
                                        $this->setScoreboardEntry($player, 12, "§r      ", "scoreboard");
                                        $this->setScoreboardEntry($player, 13, "§r       ", "scoreboard");
                                        $this->setScoreboardEntry($player, 14, "§r        ", "scoreboard");
                                        break;

                                    case 3:
                                        $this->setScoreboardEntry($player, 1, "§r ", "scoreboard");
                                        $this->setScoreboardEntry($player, 2, TF::BOLD . TF::AQUA . "Level: " . TF::RESET . TF::WHITE . $playerLevel . TF::GRAY . " (" . TF::WHITE . Translator::shortNumber($playerTotalXp) . TF::GRAY . "XP)", "scoreboard");
                                        $this->setScoreboardEntry($player, 3, TF::GRAY . $xpNeeded . " (" . TF::GREEN . $progressRounded . "%%%%" . TF::GRAY . ") to " . TF::WHITE . $playerLevel + 1, "scoreboard");
                                        $this->setScoreboardEntry($player, 4, "§r   ", "scoreboard");
                                        $this->setScoreboardEntry($player, 5, TF::BOLD . TF::AQUA . "Balance: " . TF::RESET . TF::GREEN . "$" . TF::WHITE . Translator::shortNumber($playerBalance), "scoreboard");
                                        $this->setScoreboardEntry($player, 6, "§r    ", "scoreboard");
                                        $this->setScoreboardEntry($player, 7, TF::BOLD . TF::AQUA . "Pickaxe Energy: ", "scoreboard");
                                        $this->setScoreboardEntry($player, 8, TF::GRAY . Translator::shortNumber($pickaxeEnergy) . "/" . Translator::shortNumber($pickaxeEnergyNeeded), "scoreboard");
                                        $this->setScoreboardEntry($player, 9, "§r     ", "scoreboard");
                                        $this->setScoreboardEntry($player, 10, TF::BOLD . TF::YELLOW . "NEW QUEST", "scoreboard");
                                        $this->setScoreboardEntry($player, 11, TF::WHITE . " Fill your Pickaxe Energy", "scoreboard");
                                        $this->setScoreboardEntry($player, 12, "§r      ", "scoreboard");
                                        $this->setScoreboardEntry($player, 13, "§r       ", "scoreboard");
                                        $this->setScoreboardEntry($player, 14, "§r        ", "scoreboard");
                                        break;

                                    case 4:
                                        $this->setScoreboardEntry($player, 1, "§r ", "scoreboard");
                                        $this->setScoreboardEntry($player, 2, TF::BOLD . TF::AQUA . "Level: " . TF::RESET . TF::WHITE . $playerLevel . TF::GRAY . " (" . TF::WHITE . Translator::shortNumber($playerTotalXp) . TF::GRAY . "XP)", "scoreboard");
                                        $this->setScoreboardEntry($player, 3, TF::GRAY . $xpNeeded . " (" . TF::GREEN . $progressRounded . "%%%%" . TF::GRAY . ") to " . TF::WHITE . $playerLevel + 1, "scoreboard");
                                        $this->setScoreboardEntry($player, 4, "§r   ", "scoreboard");
                                        $this->setScoreboardEntry($player, 5, TF::BOLD . TF::AQUA . "Balance: " . TF::RESET . TF::GREEN . "$" . TF::WHITE . Translator::shortNumber($playerBalance), "scoreboard");
                                        $this->setScoreboardEntry($player, 6, "§r    ", "scoreboard");
                                        $this->setScoreboardEntry($player, 7, TF::BOLD . TF::AQUA . "Pickaxe Energy: ", "scoreboard");
                                        $this->setScoreboardEntry($player, 8, TF::GRAY . Translator::shortNumber($pickaxeEnergy) . "/" . Translator::shortNumber($pickaxeEnergyNeeded), "scoreboard");
                                        $this->setScoreboardEntry($player, 9, "§r     ", "scoreboard");
                                        $this->setScoreboardEntry($player, 10, TF::BOLD . TF::YELLOW . "NEW QUEST", "scoreboard");
                                        $this->setScoreboardEntry($player, 11, TF::WHITE . " Forge your pickaxe at", "scoreboard");
                                        $this->setScoreboardEntry($player, 12, TF::WHITE . " the Wormhole", "scoreboard");
                                        $this->setScoreboardEntry($player, 13, "§r       ", "scoreboard");
                                        $this->setScoreboardEntry($player, 14, "§r        ", "scoreboard");
                                        break;

                                    case 5:
                                        $this->setScoreboardEntry($player, 1, "§r ", "scoreboard");
                                        $this->setScoreboardEntry($player, 2, TF::BOLD . TF::AQUA . "Level: " . TF::RESET . TF::WHITE . $playerLevel . TF::GRAY . " (" . TF::WHITE . Translator::shortNumber($playerTotalXp) . TF::GRAY . "XP)", "scoreboard");
                                        $this->setScoreboardEntry($player, 3, TF::GRAY . $xpNeeded . " (" . TF::GREEN . $progressRounded . "%%%%" . TF::GRAY . ") to " . TF::WHITE . $playerLevel + 1, "scoreboard");
                                        $this->setScoreboardEntry($player, 4, "§r  ", "scoreboard");
                                        $this->setScoreboardEntry($player, 5, TF::BOLD . TF::AQUA . "Balance: " . TF::RESET . TF::GREEN . "$" . TF::WHITE . Translator::shortNumber($playerBalance), "scoreboard");
                                        $this->setScoreboardEntry($player, 6, "§r   ", "scoreboard");
                                        $this->setScoreboardEntry($player, 7, TF::BOLD . TF::AQUA . "Pickaxe Energy: ", "scoreboard");
                                        $this->setScoreboardEntry($player, 8, TF::GRAY . Translator::shortNumber($pickaxeEnergy) . "/" . Translator::shortNumber($pickaxeEnergyNeeded), "scoreboard");
                                        $this->setScoreboardEntry($player, 9, "§r    ", "scoreboard");
                                        $this->setScoreboardEntry($player, 10, TF::BOLD . TF::YELLOW . "ALL QUESTS COMPLETE", "scoreboard");
                                        $this->setScoreboardEntry($player, 11, TF::WHITE . " Level up to 10 to proceed", "scoreboard");
                                        $this->setScoreboardEntry($player, 12, "§r     ", "scoreboard");
                                        $this->setScoreboardEntry($player, 13, "§r      ", "scoreboard");
                                        $this->setScoreboardEntry($player, 14, "§r       ", "scoreboard");
                                        break;
                                }
                            }
                        } else {
                            # not holding pickaxe
                            switch($tutorialProgress) {

                                case 0:
                                    $this->setScoreboardEntry($player, 1, "§r ", "scoreboard");
                                    $this->setScoreboardEntry($player, 2, TF::BOLD . TF::AQUA . "Level: " . TF::RESET . TF::WHITE . $playerLevel . TF::GRAY . " (" . TF::WHITE . Translator::shortNumber($playerTotalXp) . TF::GRAY . "XP)", "scoreboard");
                                    $this->setScoreboardEntry($player, 3, TF::GRAY . $xpNeeded . " (" . TF::GREEN . $progressRounded . "%%%%" . TF::GRAY . ") to " . TF::WHITE . $playerLevel + 1, "scoreboard");                                $this->setScoreboardEntry($player, 4, TF::BOLD . TF::AQUA . "XP: " . TF::RESET . TF::WHITE . $playerXp . "/" . $nextLevelXp . TF::GRAY . " (" . $progressRounded . "%%%%)", "scoreboard");
                                    $this->setScoreboardEntry($player, 4, "§r  ", "scoreboard");
                                    $this->setScoreboardEntry($player, 5, TF::BOLD . TF::AQUA . "Balance: " . TF::RESET . TF::GREEN . "$" . TF::WHITE . Translator::shortNumber($playerBalance), "scoreboard");
                                    $this->setScoreboardEntry($player, 6, "§r   ", "scoreboard");
                                    $this->setScoreboardEntry($player, 7, TF::BOLD . TF::YELLOW . "NEW QUEST", "scoreboard");
                                    $this->setScoreboardEntry($player, 8, TF::WHITE . " Talk to the Tour Guide", "scoreboard");
                                    $this->setScoreboardEntry($player, 9, "§r    ", "scoreboard");
                                    $this->setScoreboardEntry($player, 10, "§r     ", "scoreboard");
                                    $this->setScoreboardEntry($player, 11, "§r      ", "scoreboard");
                                    $this->setScoreboardEntry($player, 12, "§r       ", "scoreboard");
                                    $this->setScoreboardEntry($player, 13, "§r        ", "scoreboard");
                                    $this->setScoreboardEntry($player, 14, "§r         ", "scoreboard");
                                    break;

                                case 1:
                                    $this->setScoreboardEntry($player, 1, "§r ", "scoreboard");
                                    $this->setScoreboardEntry($player, 2, TF::BOLD . TF::AQUA . "Level: " . TF::RESET . TF::WHITE . $playerLevel . TF::GRAY . " (" . TF::WHITE . Translator::shortNumber($playerTotalXp) . TF::GRAY . "XP)", "scoreboard");
                                    $this->setScoreboardEntry($player, 3, TF::GRAY . $xpNeeded . " (" . TF::GREEN . $progressRounded . "%%%%" . TF::GRAY . ") to " . TF::WHITE . $playerLevel + 1, "scoreboard");
                                    $this->setScoreboardEntry($player, 4, "§r  ", "scoreboard");
                                    $this->setScoreboardEntry($player, 5, TF::BOLD . TF::AQUA . "Balance: " . TF::RESET . TF::GREEN . "$" . TF::WHITE . Translator::shortNumber($playerBalance), "scoreboard");
                                    $this->setScoreboardEntry($player, 6, "§r   ", "scoreboard");
                                    $this->setScoreboardEntry($player, 7, TF::BOLD . TF::YELLOW . "NEW QUEST", "scoreboard");
                                    $this->setScoreboardEntry($player, 8, TF::WHITE . " Go to the mines and", "scoreboard");
                                    $this->setScoreboardEntry($player, 9, TF::WHITE . " start mining!", "scoreboard");
                                    $this->setScoreboardEntry($player, 10, "§r    ", "scoreboard");
                                    $this->setScoreboardEntry($player, 11, "§r     ", "scoreboard");
                                    $this->setScoreboardEntry($player, 12, "§r       ", "scoreboard");
                                    $this->setScoreboardEntry($player, 13, "§r        ", "scoreboard");
                                    $this->setScoreboardEntry($player, 14, "§r         ", "scoreboard");
                                    break;

                                case 2:
                                    $this->setScoreboardEntry($player, 1, "§r ", "scoreboard");
                                    $this->setScoreboardEntry($player, 2, TF::BOLD . TF::AQUA . "Level: " . TF::RESET . TF::WHITE . $playerLevel . TF::GRAY . " (" . TF::WHITE . Translator::shortNumber($playerTotalXp) . TF::GRAY . "XP)", "scoreboard");
                                    $this->setScoreboardEntry($player, 3, TF::GRAY . $xpNeeded . " (" . TF::GREEN . $progressRounded . "%%%%" . TF::GRAY . ") to " . TF::WHITE . $playerLevel + 1, "scoreboard");
                                    $this->setScoreboardEntry($player, 4, "§r  ", "scoreboard");
                                    $this->setScoreboardEntry($player, 5, TF::BOLD . TF::AQUA . "Balance: " . TF::RESET . TF::GREEN . "$" . TF::WHITE . Translator::shortNumber($playerBalance), "scoreboard");
                                    $this->setScoreboardEntry($player, 6, "§r   ", "scoreboard");
                                    $this->setScoreboardEntry($player, 7, TF::BOLD . TF::YELLOW . "NEW QUEST", "scoreboard");
                                    $this->setScoreboardEntry($player, 8, TF::WHITE . " Talk to the Ore Merchant", "scoreboard");
                                    $this->setScoreboardEntry($player, 9, "§r    ", "scoreboard");
                                    $this->setScoreboardEntry($player, 10, "§r     ", "scoreboard");
                                    $this->setScoreboardEntry($player, 11, "§r      ", "scoreboard");
                                    $this->setScoreboardEntry($player, 12, "§r       ", "scoreboard");
                                    $this->setScoreboardEntry($player, 13, "§r        ", "scoreboard");
                                    $this->setScoreboardEntry($player, 14, "§r         ", "scoreboard");
                                    break;

                                case 3:
                                    $this->setScoreboardEntry($player, 1, "§r ", "scoreboard");
                                    $this->setScoreboardEntry($player, 2, TF::BOLD . TF::AQUA . "Level: " . TF::RESET . TF::WHITE . $playerLevel . TF::GRAY . " (" . TF::WHITE . Translator::shortNumber($playerTotalXp) . TF::GRAY . "XP)", "scoreboard");
                                    $this->setScoreboardEntry($player, 3, TF::GRAY . $xpNeeded . " (" . TF::GREEN . $progressRounded . "%%%%" . TF::GRAY . ") to " . TF::WHITE . $playerLevel + 1, "scoreboard");
                                    $this->setScoreboardEntry($player, 4, "§r  ", "scoreboard");
                                    $this->setScoreboardEntry($player, 5, TF::BOLD . TF::AQUA . "Balance: " . TF::RESET . TF::GREEN . "$" . TF::WHITE . Translator::shortNumber($playerBalance), "scoreboard");
                                    $this->setScoreboardEntry($player, 6, "§r   ", "scoreboard");
                                    $this->setScoreboardEntry($player, 7, TF::BOLD . TF::YELLOW . "NEW QUEST", "scoreboard");
                                    $this->setScoreboardEntry($player, 8, TF::WHITE . " Fill your Pickaxe Energy", "scoreboard");
                                    $this->setScoreboardEntry($player, 9, "§r    ", "scoreboard");
                                    $this->setScoreboardEntry($player, 10, "§r     ", "scoreboard");
                                    $this->setScoreboardEntry($player, 11, "§r      ", "scoreboard");
                                    $this->setScoreboardEntry($player, 12, "§r       ", "scoreboard");
                                    $this->setScoreboardEntry($player, 13, "§r        ", "scoreboard");
                                    $this->setScoreboardEntry($player, 14, "§r         ", "scoreboard");
                                    break;

                                case 4:
                                    $this->setScoreboardEntry($player, 1, "§r ", "scoreboard");
                                    $this->setScoreboardEntry($player, 2, TF::BOLD . TF::AQUA . "Level: " . TF::RESET . TF::WHITE . $playerLevel . TF::GRAY . " (" . TF::WHITE . Translator::shortNumber($playerTotalXp) . TF::GRAY . "XP)", "scoreboard");
                                    $this->setScoreboardEntry($player, 3, TF::GRAY . $xpNeeded . " (" . TF::GREEN . $progressRounded . "%%%%" . TF::GRAY . ") to " . TF::WHITE . $playerLevel + 1, "scoreboard");
                                    $this->setScoreboardEntry($player, 4, "§r  ", "scoreboard");
                                    $this->setScoreboardEntry($player, 5, TF::BOLD . TF::AQUA . "Balance: " . TF::RESET . TF::GREEN . "$" . TF::WHITE . Translator::shortNumber($playerBalance), "scoreboard");
                                    $this->setScoreboardEntry($player, 6, "§r   ", "scoreboard");
                                    $this->setScoreboardEntry($player, 7, TF::BOLD . TF::YELLOW . "NEW QUEST", "scoreboard");
                                    $this->setScoreboardEntry($player, 8, TF::WHITE . " Forge your pickaxe at", "scoreboard");
                                    $this->setScoreboardEntry($player, 9, TF::WHITE . " the Wormhole", "scoreboard");
                                    $this->setScoreboardEntry($player, 10, "§r    ", "scoreboard");
                                    $this->setScoreboardEntry($player, 11, "§r     ", "scoreboard");
                                    $this->setScoreboardEntry($player, 12, "§r      ", "scoreboard");
                                    $this->setScoreboardEntry($player, 13, "§r       ", "scoreboard");
                                    $this->setScoreboardEntry($player, 14, "§r        ", "scoreboard");
                                    break;

                                case 5:
                                    $this->setScoreboardEntry($player, 1, "§r ", "scoreboard");
                                    $this->setScoreboardEntry($player, 2, TF::BOLD . TF::AQUA . "Level: " . TF::RESET . TF::WHITE . $playerLevel . TF::GRAY . " (" . TF::WHITE . Translator::shortNumber($playerTotalXp) . TF::GRAY . "XP)", "scoreboard");
                                    $this->setScoreboardEntry($player, 3, TF::GRAY . $xpNeeded . " (" . TF::GREEN . $progressRounded . "%%%%" . TF::GRAY . ") to " . TF::WHITE . $playerLevel + 1, "scoreboard");
                                    $this->setScoreboardEntry($player, 4, "§r  ", "scoreboard");
                                    $this->setScoreboardEntry($player, 5, TF::BOLD . TF::AQUA . "Balance: " . TF::RESET . TF::GREEN . "$" . TF::WHITE . Translator::shortNumber($playerBalance), "scoreboard");
                                    $this->setScoreboardEntry($player, 6, "§r   ", "scoreboard");
                                    $this->setScoreboardEntry($player, 7, TF::BOLD . TF::YELLOW . "ALL QUESTS COMPLETE", "scoreboard");
                                    $this->setScoreboardEntry($player, 8, TF::WHITE . " Level up to 10 to proceed", "scoreboard");
                                    $this->setScoreboardEntry($player, 9, "§r    ", "scoreboard");
                                    $this->setScoreboardEntry($player, 10, "§r    ", "scoreboard");
                                    $this->setScoreboardEntry($player, 11, "§r     ", "scoreboard");
                                    $this->setScoreboardEntry($player, 12, "§r      ", "scoreboard");
                                    $this->setScoreboardEntry($player, 13, "§r       ", "scoreboard");
                                    $this->setScoreboardEntry($player, 14, "§r        ", "scoreboard");
                                    break;
                            }
                        }
                    } else {
                        $this->rmScoreboard($player, "scoreboard");
                        $this->createScoreboard($player, TF::BOLD . TF::AQUA . " » " . TF::GRAY . "Tutorial Mine" . TF::AQUA . " « ", "scoreboard");
                        $this->setScoreboardEntry($player, 1, "§r ", "scoreboard");
                        $this->setScoreboardEntry($player, 2, TF::BOLD . TF::AQUA . "Level: " . TF::RESET . TF::WHITE . $playerLevel . TF::GRAY . " (" . TF::WHITE . Translator::shortNumber($playerTotalXp) . TF::GRAY . "XP)", "scoreboard");
                        $this->setScoreboardEntry($player, 3, TF::BOLD . TF::AQUA . "XP: " . TF::RESET . TF::WHITE . $playerXp . "/" . $nextLevelXp . TF::GRAY . " (" . $progressRounded . "%%%%)", "scoreboard");
                        $this->setScoreboardEntry($player, 4, "§r    ", "scoreboard");
                        $this->setScoreboardEntry($player, 5, TF::BOLD . TF::AQUA . "Balance: " . TF::RESET . TF::GREEN . "$" . TF::WHITE . Translator::shortNumber($playerBalance), "scoreboard");
                        $this->setScoreboardEntry($player, 6, "§r     ", "scoreboard");
                        $this->setScoreboardEntry($player, 7, TF::BOLD . TF::AQUA . "Pickaxe Energy: ", "scoreboard");
                        $this->setScoreboardEntry($player, 8, TF::GRAY . Translator::shortNumber($pickaxeEnergy) . "/" . Translator::shortNumber($pickaxeEnergyNeeded), "scoreboard");$this->setScoreboardEntry($player, 8, "§r    ", "scoreboard");
                        $this->setScoreboardEntry($player, 9, "§r      ", "scoreboard");
                        $this->setScoreboardEntry($player, 10, TF::BOLD . TF::YELLOW . "TUTORIAL COMPLETE", "scoreboard");
                        $this->setScoreboardEntry($player, 11, TF::WHITE . " Travel to the Space station", "scoreboard");
                        $this->setScoreboardEntry($player, 12, TF::WHITE . " talk to the Ship Captain", "scoreboard");
                        $this->setScoreboardEntry($player, 13, "§r       ", "scoreboard");
                        $this->setScoreboardEntry($player, 14, "§r         ", "scoreboard");
                    }
                    $this->setScoreboardEntry($player, 15, TF::AQUA . "prison.emporiumpvp.com", "scoreboard");
                    break;
            }
        }
    }
}
