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

class LegendaryContrabandGiveRewardDelay extends Task {

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
                $item = $crystals->majesty();

                $this->player->sendMessage(TF::YELLOW . "You got a " . TF::DARK_PURPLE . "Majesty" . TF::YELLOW . " Rank Crystal");
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
                $item = $rankKits->majesty(1);

                $this->player->sendMessage(TF::YELLOW . "You got an " . TF::DARK_PURPLE . "Majesty" . TF::YELLOW . " Rank Kit");
                if($this->player->getInventory()->canAddItem($item)) {
                    $this->player->getInventory()->addItem($item);
                } else {
                    $this->player->getLocation()->getWorld()->dropItem($this->player->getLocation(), $item);
                }
                break;

            # 1.25m energy
            case 4:
            case 5:
            case 6:
                $this->player->sendMessage(TF::AQUA . "You got " . TF::WHITE . "1,250,000" . TF::AQUA . " Energy");

                $energyOrb = new Orbs();
                $item = $energyOrb->EnergyOrb(1250000);
                if($this->player->getInventory()->canAddItem($item)) {
                    $this->player->getInventory()->addItem($item);
                } else {
                    $this->player->getLocation()->getWorld()->dropItem($this->player->getLocation(), $item);
                }
                break;

            # 1m-2m money
            case 7:
            case 8:
            case 9:
            case 10:
                $amount = mt_rand(1000000, 2000000);

                $this->player->sendMessage(TF::GRAY . "You got " . TF::GREEN . "$" . TF::WHITE . Translator::shortNumber($amount));
                DataManager::addData($this->player, "Players", "Money", $amount);
                break;

            # mystery elite enchants
            case 11:
            case 12:
            case 13:
            case 14:
            case 15:
                $this->player->sendMessage(TF::AQUA . "You got 2x Legendary Mystery Enchants " . TF::GRAY . "Coming soon...");
                if($this->player->getInventory()->canAddItem((new Books())->Legendary(2))) {
                    $this->player->getInventory()->addItem((new Books())->Legendary(2));
                } else {
                    $this->player->getWorld()->dropItem($this->player->getPosition(), (new Books())->Legendary(2));
                }
                break;

            # 1m energy
            case 16:
            case 17:
            case 18:
            case 19:
            case 20:
            case 21:
                $this->player->sendMessage(TF::AQUA . "You got " . TF::WHITE . "1,000,000" . TF::AQUA . " Energy");

                $energyOrb = new Orbs();
                $item = $energyOrb->EnergyOrb(1000000);
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

                case 1: # heroic broteas
                    if($this->player->getInventory()->canAddItem((new GKits())->heroicBroteas(1))) {
                        $this->player->getInventory()->addItem((new GKits())->heroicBroteas(1));
                    } else {
                        $this->player->getWorld()->dropItem($this->player->getLocation(), (new GKits())->heroicBroteas(1));
                    }
                    break;

                case 2: # heroic ares
                    if($this->player->getInventory()->canAddItem((new GKits())->heroicAres(1))) {
                        $this->player->getInventory()->addItem((new GKits())->heroicAres(1));
                    } else {
                        $this->player->getWorld()->dropItem($this->player->getLocation(), (new GKits())->heroicAres(1));
                    }
                    break;

                case 3: # heroic grim reaper
                    if($this->player->getInventory()->canAddItem((new GKits())->heroicGrimReaper(1))) {
                        $this->player->getInventory()->addItem((new GKits())->heroicGrimReaper(1));
                    } else {
                        $this->player->getWorld()->dropItem($this->player->getLocation(), (new GKits())->heroicGrimReaper(1));
                    }
                    break;

                case 4: # heroic executioner
                    if($this->player->getInventory()->canAddItem((new GKits())->heroicExecutioner(1))) {
                        $this->player->getInventory()->addItem((new GKits())->heroicExecutioner(1));
                    } else {
                        $this->player->getWorld()->dropItem($this->player->getLocation(), (new GKits())->heroicExecutioner(1));
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
                $this->player->sendMessage(TF::AQUA . "You got " . TF::WHITE . "750,000" . TF::AQUA . " Energy");

                $energyOrb = new Orbs();
                $item = $energyOrb->EnergyOrb(750000);
                if($this->player->getInventory()->canAddItem($item)) {
                    $this->player->getInventory()->addItem($item);
                } else {
                    $this->player->getLocation()->getWorld()->dropItem($this->player->getLocation(), $item);
                }
                break;
        }
    }
}