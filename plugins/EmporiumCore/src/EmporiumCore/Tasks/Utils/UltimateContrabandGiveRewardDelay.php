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

class UltimateContrabandGiveRewardDelay extends Task {

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
                $item = $crystals->supreme();

                $this->player->sendMessage(TF::YELLOW . "You got a " . TF::DARK_AQUA . "Supreme" . TF::YELLOW . " Rank Crystal");
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
                $item = $rankKits->supreme(1);

                $this->player->sendMessage(TF::YELLOW . "You got an " . TF::DARK_AQUA . "Supreme" . TF::YELLOW . " Rank Kit");
                if($this->player->getInventory()->canAddItem($item)) {
                    $this->player->getInventory()->addItem($item);
                } else {
                    $this->player->getLocation()->getWorld()->dropItem($this->player->getLocation(), $item);
                }
                break;

            # 750k energy
            case 4:
            case 5:
            case 6:
                $this->player->sendMessage(TF::AQUA . "You got " . TF::WHITE . "750,000" . TF::AQUA . " Energy");

                $energyOrb = new Orbs();
                $item = $energyOrb->EnergyOrb(750000);
                if($this->player->getInventory()->canAddItem($item)) {
                    $this->player->getInventory()->addItem($item);
                } else {
                    $this->player->getLocation()->getWorld()->dropItem($this->player->getLocation(), $item);
                }
                break;

            # 500k-1m money
            case 7:
            case 8:
            case 9:
            case 10:
                $amount = mt_rand(500000, 1000000);

                $this->player->sendMessage(TF::GRAY . "You got " . TF::GREEN . "$" . TF::WHITE . Translator::shortNumber($amount));
                DataManager::getInstance()->setPlayerData($this->player->getXuid(), "profile.money", DataManager::getInstance()->getPlayerData($this->player->getXuid(), "profile.money") + $amount);
                break;

            # mystery elite enchants
            case 11:
            case 12:
            case 13:
            case 14:
            case 15:
                $this->player->sendMessage(TF::AQUA . "You got 2x Ultimate Mystery Enchants " . TF::GRAY . "Coming soon...");
                if($this->player->getInventory()->canAddItem((new Books())->Ultimate(2))) {
                    $this->player->getInventory()->addItem((new Books())->Ultimate(2));
                } else {
                    $this->player->getWorld()->dropItem($this->player->getPosition(), (new Books())->Ultimate(2));
                }
                break;

            # 500k energy
            case 16:
            case 17:
            case 18:
            case 19:
            case 20:
            case 21:
                $this->player->sendMessage(TF::AQUA . "You got " . TF::WHITE . "500,000" . TF::AQUA . " Energy");

                $energyOrb = new Orbs();
                $item = $energyOrb->EnergyOrb(500000);
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

                case 1: # heroic slaughter
                    if($this->player->getInventory()->canAddItem((new GKits())->heroicSlaughter(1))) {
                        $this->player->getInventory()->addItem((new GKits())->heroicSlaughter(1));
                    } else {
                        $this->player->getWorld()->dropItem($this->player->getLocation(), (new GKits())->heroicSlaughter(1));
                    }
                    break;

                case 2: # heroic enchanter
                    if($this->player->getInventory()->canAddItem((new GKits())->heroicEnchanter(1))) {
                        $this->player->getInventory()->addItem((new GKits())->heroicEnchanter(1));
                    } else {
                        $this->player->getWorld()->dropItem($this->player->getLocation(), (new GKits())->heroicEnchanter(1));
                    }
                    break;

                case 3: # heroic atheos
                    if($this->player->getInventory()->canAddItem((new GKits())->heroicAtheos(1))) {
                        $this->player->getInventory()->addItem((new GKits())->heroicAtheos(1));
                    } else {
                        $this->player->getWorld()->dropItem($this->player->getLocation(), (new GKits())->heroicAtheos(1));
                    }
                    break;

                case 4: # heroic iapetus
                    if($this->player->getInventory()->canAddItem((new GKits())->heroicIapetus(1))) {
                        $this->player->getInventory()->addItem((new GKits())->heroicIapetus(1));
                    } else {
                        $this->player->getWorld()->dropItem($this->player->getLocation(), (new GKits())->heroicIapetus(1));
                    }
                    break;
            }
                break;

            # 250k energy
            case 29:
            case 30:
            case 31:
            case 32:
            case 33:
            case 34:
            case 35:
                $this->player->sendMessage(TF::AQUA . "You got " . TF::WHITE . "250,000" . TF::AQUA . " Energy");

                $energyOrb = new Orbs();
                $item = $energyOrb->EnergyOrb(250000);
                if($this->player->getInventory()->canAddItem($item)) {
                    $this->player->getInventory()->addItem($item);
                } else {
                    $this->player->getLocation()->getWorld()->dropItem($this->player->getLocation(), $item);
                }
                break;
        }
    }
}