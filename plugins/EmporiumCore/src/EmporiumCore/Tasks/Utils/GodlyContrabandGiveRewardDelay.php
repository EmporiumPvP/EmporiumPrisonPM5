<?php

namespace EmporiumCore\Tasks\Utils;

use Emporium\Prison\items\Orbs;
use Emporium\Prison\Managers\misc\Translator;
use EmporiumCore\managers\data\DataManager;
use Items\Crystals;
use Items\GKits;
use Items\RankKits;
use JsonException;
use pocketmine\player\Player;
use pocketmine\scheduler\Task;
use pocketmine\utils\TextFormat as TF;
use Tetro\EmporiumEnchants\Items\Books;

class GodlyContrabandGiveRewardDelay extends Task {

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

    /**
     * @throws JsonException
     */
    public function onRun(): void {
        switch($this->reward) {

            # rank crystal
            case 1:
                $crystals = new Crystals();
                $item = $crystals->emperor();

                $this->player->sendMessage(TF::YELLOW . "You got a " . TF::AQUA . "Emperor" . TF::YELLOW . " Rank Crystal");
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
                $item = $rankKits->emperor(1);

                $this->player->sendMessage(TF::YELLOW . "You got an " . TF::AQUA . "Emperor" . TF::YELLOW . " Rank Kit");
                if($this->player->getInventory()->canAddItem($item)) {
                    $this->player->getInventory()->addItem($item);
                } else {
                    $this->player->getLocation()->getWorld()->dropItem($this->player->getLocation(), $item);
                }
                break;

            # 1.75m energy
            case 4:
            case 5:
            case 6:
                $this->player->sendMessage(TF::AQUA . "You got " . TF::WHITE . "1,750,000" . TF::AQUA . " Energy");

                $energyOrb = new Orbs();
                $item = $energyOrb->EnergyOrb(1750000);
                if($this->player->getInventory()->canAddItem($item)) {
                    $this->player->getInventory()->addItem($item);
                } else {
                    $this->player->getLocation()->getWorld()->dropItem($this->player->getLocation(), $item);
                }
                break;

            # 2m-4m money
            case 7:
            case 8:
            case 9:
            case 10:
                $amount = mt_rand(2000000, 4000000);

                $this->player->sendMessage(TF::GRAY . "You got " . TF::GREEN . "$" . TF::WHITE . Translator::shortNumber($amount));
                DataManager::addData($this->player, "Players", "Money", $amount);
                break;

            # mystery elite enchants
            case 11:
            case 12:
            case 13:
            case 14:
            case 15:
                $this->player->sendMessage(TF::AQUA . "You got 2x Godly Mystery Enchants " . TF::GRAY . "Coming soon...");
                if($this->player->getInventory()->canAddItem((new Books())->Godly(2))) {
                    $this->player->getInventory()->addItem((new Books())->Godly(2));
                } else {
                    $this->player->getWorld()->dropItem($this->player->getPosition(), (new Books())->Godly(2));
                }
                break;

            # 1.5m energy
            case 16:
            case 17:
            case 18:
            case 19:
            case 20:
            case 21:
                $this->player->sendMessage(TF::AQUA . "You got " . TF::WHITE . "1,500,000" . TF::AQUA . " Energy");

                $energyOrb = new Orbs();
                $item = $energyOrb->EnergyOrb(1500000);
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

                case 1: # blacksmith
                    if($this->player->getInventory()->canAddItem((new GKits())->Blacksmith(1))) {
                        $this->player->getInventory()->addItem((new GKits())->Blacksmith(1));
                    } else {
                        $this->player->getWorld()->dropItem($this->player->getLocation(), (new GKits())->Blacksmith(1));
                    }
                    $this->player->sendMessage(TF::AQUA . "You got a " . TF::DARK_GRAY . "Blacksmith " . TF::AQUA . "GKit");
                    break;

                case 2: # hero
                    if($this->player->getInventory()->canAddItem((new GKits())->Hero(1))) {
                        $this->player->getInventory()->addItem((new GKits())->Hero(1));
                    } else {
                        $this->player->getWorld()->dropItem($this->player->getLocation(), (new GKits())->Hero(1));
                    }
                    $this->player->sendMessage(TF::AQUA . "You got a " . TF::WHITE . "Hero " . TF::AQUA . "GKit");
                    break;

                case 3: # cyborg
                    if($this->player->getInventory()->canAddItem((new GKits())->Cyborg(1))) {
                        $this->player->getInventory()->addItem((new GKits())->Cyborg(1));
                    } else {
                        $this->player->getWorld()->dropItem($this->player->getLocation(), (new GKits())->Cyborg(1));
                    }
                    $this->player->sendMessage(TF::AQUA . "You got a " . TF::DARK_AQUA . "Cyborg " . TF::AQUA . "GKit");
                    break;

                case 4: # crucible
                    if($this->player->getInventory()->canAddItem((new GKits())->Crucible(1))) {
                        $this->player->getInventory()->addItem((new GKits())->Crucible(1));
                    } else {
                        $this->player->getWorld()->dropItem($this->player->getLocation(), (new GKits())->Crucible(1));
                    }
                    $this->player->sendMessage(TF::AQUA . "You got a " . TF::YELLOW . "Crucible " . TF::AQUA . "GKit");
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
                $this->player->sendMessage(TF::AQUA . "You got " . TF::WHITE . "1,250,000" . TF::AQUA . " Energy");

                $energyOrb = new Orbs();
                $item = $energyOrb->EnergyOrb(1250000);
                if($this->player->getInventory()->canAddItem($item)) {
                    $this->player->getInventory()->addItem($item);
                } else {
                    $this->player->getLocation()->getWorld()->dropItem($this->player->getLocation(), $item);
                }
                break;
        }
    }
}