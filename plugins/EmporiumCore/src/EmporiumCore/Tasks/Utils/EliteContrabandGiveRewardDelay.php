<?php

namespace EmporiumCore\Tasks\Utils;

use Emporium\Prison\items\Orbs;
use Emporium\Prison\Managers\misc\Translator;
use EmporiumData\DataManager;
use Items\Crystals;
use Items\GKits;
use Items\RankKits;
use pocketmine\player\Player;
use pocketmine\scheduler\Task;
use pocketmine\utils\TextFormat as TF;
use Tetro\EmporiumEnchants\Items\Books;

class EliteContrabandGiveRewardDelay extends Task {

    private Player $player;
    private int $reward;

    /**
     * @param Player $player
     * @param int $reward
     */
    public function __construct(Player $player, int $reward) {
        $this->player = $player;
        $this->reward = $reward;
    }

    public function onRun(): void {
        switch($this->reward) {

            # rank crystal
            case 1:
                $crystals = new Crystals();
                $item = $crystals->imperial();

                $this->player->sendMessage(TF::YELLOW . "You got an " . TF::LIGHT_PURPLE . "Imperial" . TF::YELLOW . " Rank Crystal");
                if($this->player->getInventory()->canAddItem($item)) {
                    $this->player->getInventory()->addItem($item);
                } else {
                    $this->player->getLocation()->getWorld()->dropItem($this->player->getLocation(), $item);
                }
                break;

            # rank kit
            case 2:
            case 3:
                $rankKits = new RankKits();
                $item = $rankKits->imperial(1);

                $this->player->sendMessage(TF::YELLOW . "You got an " . TF::LIGHT_PURPLE . "Imperial" . TF::YELLOW . " Rank Kit");
                if($this->player->getInventory()->canAddItem($item)) {
                    $this->player->getInventory()->addItem($item);
                } else {
                    $this->player->getLocation()->getWorld()->dropItem($this->player->getLocation(), $item);
                }
                break;

            # 250k energy
            case 4:
            case 5:
            case 6:
                $this->player->sendMessage(TF::AQUA . "You got " . TF::WHITE . "250,000" . TF::AQUA . " Energy");

                $energyOrb = new Orbs();
                $item = $energyOrb->EnergyOrb(250000);
                if($this->player->getInventory()->canAddItem($item)) {
                    $this->player->getInventory()->addItem($item);
                } else {
                    $this->player->getLocation()->getWorld()->dropItem($this->player->getLocation(), $item);
                }
                break;

            # 250k-500k money
            case 7:
            case 8:
            case 9:
            case 10:
                $amount = mt_rand(250000, 500000);

                $this->player->sendMessage(TF::GRAY . "You got " . TF::GREEN . "$" . TF::WHITE . Translator::shortNumber($amount));
                DataManager::getInstance()->setPlayerData($this->player->getXuid(), "profile.money", DataManager::getInstance()->getPlayerData($this->player->getXuid(), "profile.money") + $amount);
                break;

            # mystery elite enchants
            case 11:
            case 12:
            case 13:
            case 14:
            case 15:
                $this->player->sendMessage(TF::AQUA . "You got 2x Elite Mystery Enchants");
                if($this->player->getInventory()->canAddItem((new Books())->Elite(2))) {
                    $this->player->getInventory()->addItem((new Books())->Elite(2));
                } else {
                    $this->player->getWorld()->dropItem($this->player->getPosition(), (new Books())->Elite(2));
                }
                break;

            # 100k energy
            case 16:
            case 17:
            case 18:
            case 19:
            case 20:
            case 21:
                $this->player->sendMessage(TF::AQUA . "You got " . TF::WHITE . "100,000" . TF::AQUA . " Energy");

                $energyOrb = new Orbs();
                $item = $energyOrb->EnergyOrb(100000);
                if($this->player->getInventory()->canAddItem($item)) {
                    $this->player->getInventory()->addItem($item);
                } else {
                    $this->player->getLocation()->getWorld()->dropItem($this->player->getLocation(), $item);
                }
                break;

            # mystery gkit
            case 22:
            case 23:
            case 24:
            case 25:
            case 26:
            case 27:
            case 28:
                $reward = mt_rand(1,4);
                switch($reward) {

                    case 1: # heroic vulkarion
                        if($this->player->getInventory()->canAddItem((new GKits())->heroicVulkarion(1))) {
                            $this->player->getInventory()->addItem((new GKits())->heroicVulkarion(1));
                        } else {
                            $this->player->getWorld()->dropItem($this->player->getLocation(), (new GKits())->heroicVulkarion(1));
                        }
                        $this->player->sendMessage(TF::AQUA . "You got a " . TF::RED . "Heroic Vulkarion " . TF::AQUA . "GKit");
                        break;

                    case 2: # heroic zenith
                        if($this->player->getInventory()->canAddItem((new GKits())->heroicZenith(1))) {
                            $this->player->getInventory()->addItem((new GKits())->heroicZenith(1));
                        } else {
                            $this->player->getWorld()->dropItem($this->player->getLocation(), (new GKits())->heroicZenith(1));
                        }
                        $this->player->sendMessage(TF::AQUA . "You got a " . TF::GOLD . "Heroic Zenith " . TF::AQUA . "GKit");
                        break;

                    case 3: # heroic colossus
                        if($this->player->getInventory()->canAddItem((new GKits())->heroicColossus(1))) {
                            $this->player->getInventory()->addItem((new GKits())->heroicColossus(1));
                        } else {
                            $this->player->getWorld()->dropItem($this->player->getLocation(), (new GKits())->heroicColossus(1));
                        }
                        $this->player->sendMessage(TF::AQUA . "You got a " . TF::WHITE . "Heroic Colossus " . TF::AQUA . "GKit");
                        break;

                    case 4: # heroic warlock
                        if($this->player->getInventory()->canAddItem((new GKits())->heroicWarlock(1))) {
                            $this->player->getInventory()->addItem((new GKits())->heroicWarlock(1));
                        } else {
                            $this->player->getWorld()->dropItem($this->player->getLocation(), (new GKits())->heroicWarlock(1));
                        }
                        $this->player->sendMessage(TF::AQUA . "You got a " . TF::DARK_PURPLE . "Heroic Warlock " . TF::AQUA . "GKit");
                        break;
                }
                break;

            # 50k energy
            case 29:
            case 30:
            case 31:
            case 32:
            case 33:
            case 34:
            case 35:
                $this->player->sendMessage(TF::AQUA . "You got " . TF::WHITE . "50,000" . TF::AQUA . " Energy");

                $energyOrb = new Orbs();
                $item = $energyOrb->EnergyOrb(50000);
                if($this->player->getInventory()->canAddItem($item)) {
                    $this->player->getInventory()->addItem($item);
                } else {
                    $this->player->getLocation()->getWorld()->dropItem($this->player->getLocation(), $item);
                }
                break;
        }
    }
}