<?php

namespace EmporiumCore\Tasks\Utils;

use Emporium\Prison\items\Orbs;
use Emporium\Prison\Managers\misc\Translator;
use EmporiumData\DataManager;
use Items\Crystals;
use Items\RankKits;
use pocketmine\player\Player;
use pocketmine\scheduler\Task;
use pocketmine\utils\TextFormat as TF;
use Tetro\EmporiumEnchants\Items\Books;


class HeroicContrabandGiveRewardDelay extends Task {

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
                $item = $crystals->president();

                $this->player->sendMessage(TF::YELLOW . "You got a " . TF::RED . "President" . TF::YELLOW . " Rank Crystal");
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
                $item = $rankKits->president(1);

                $this->player->sendMessage(TF::YELLOW . "You got a " . TF::RED . "President" . TF::YELLOW . " Rank Kit");
                if($this->player->getInventory()->canAddItem($item)) {
                    $this->player->getInventory()->addItem($item);
                } else {
                    $this->player->getLocation()->getWorld()->dropItem($this->player->getLocation(), $item);
                }
                break;

            # 2.25m energy
            case 4:
            case 5:
            case 6:
                $this->player->sendMessage(TF::AQUA . "You got " . TF::WHITE . "2,250,000" . TF::AQUA . " Energy");

                $energyOrb = new Orbs();
                $item = $energyOrb->EnergyOrb(2250000);
                if($this->player->getInventory()->canAddItem($item)) {
                    $this->player->getInventory()->addItem($item);
                } else {
                    $this->player->getLocation()->getWorld()->dropItem($this->player->getLocation(), $item);
                }
                break;

            # 4m-6m money
            case 7:
            case 8:
            case 9:
            case 10:
                $amount = mt_rand(4000000, 6000000);

                $this->player->sendMessage(TF::GRAY . "You got " . TF::GREEN . "$" . TF::WHITE . Translator::shortNumber($amount));
            DataManager::getInstance()->setPlayerData($this->player->getXuid(), "profile.money", DataManager::getInstance()->getPlayerData($this->player->getXuid(), "profile.money") + $amount);
                break;

            # mystery elite enchants
            case 11:
            case 12:
            case 13:
            case 14:
            case 15:
                $this->player->sendMessage(TF::AQUA . "You got 2x Heroic Mystery Enchants " . TF::GRAY . "Coming soon...");
                if($this->player->getInventory()->canAddItem((new Books())->Heroic(2))) {
                    $this->player->getInventory()->addItem((new Books())->Heroic(2));
                } else {
                    $this->player->getWorld()->dropItem($this->player->getPosition(), (new Books())->Heroic(2));
                }
                break;

            # 2m energy
            case 16:
            case 17:
            case 18:
            case 19:
            case 20:
            case 21:
                $this->player->sendMessage(TF::AQUA . "You got " . TF::WHITE . "2,000,000" . TF::AQUA . " Energy");

                $energyOrb = new Orbs();
                $item = $energyOrb->EnergyOrb(2000000);
                if($this->player->getInventory()->canAddItem($item)) {
                    $this->player->getInventory()->addItem($item);
                } else {
                    $this->player->getLocation()->getWorld()->dropItem($this->player->getLocation(), $item);
                }
                break;

            # mystery rank kit
            case 22:
            case 23:
            case 24:
            case 25:
            case 26:
            case 27:
            case 28:
            $reward = mt_rand(1,4);
            switch($reward) {

                case 1: # noble
                    if($this->player->getInventory()->canAddItem((new RankKits())->noble(1))) {
                        $this->player->getInventory()->addItem((new RankKits())->noble(1));
                    } else {
                        $this->player->getWorld()->dropItem($this->player->getLocation(), (new RankKits())->noble(1));
                    }
                    $this->player->sendMessage(TF::AQUA . "You got a " . TF::DARK_GRAY . "Noble " . TF::AQUA . "Rank Kit");
                    break;

                case 2: # imperial
                    if($this->player->getInventory()->canAddItem((new RankKits())->imperial(1))) {
                        $this->player->getInventory()->addItem((new RankKits())->imperial(1));
                    } else {
                        $this->player->getWorld()->dropItem($this->player->getLocation(), (new RankKits())->imperial(1));
                    }
                    $this->player->sendMessage(TF::AQUA . "You got a " . TF::LIGHT_PURPLE . "Imperial " . TF::AQUA . "Rank Kit");
                    break;

                case 3: # supreme
                    if($this->player->getInventory()->canAddItem((new RankKits())->supreme(1))) {
                        $this->player->getInventory()->addItem((new RankKits())->supreme(1));
                    } else {
                        $this->player->getWorld()->dropItem($this->player->getLocation(), (new RankKits())->supreme(1));
                    }
                    $this->player->sendMessage(TF::AQUA . "You got a " . TF::DARK_AQUA . "Supreme " . TF::AQUA . "Rank Kit");
                    break;

                case 4: # majesty
                    if($this->player->getInventory()->canAddItem((new RankKits())->majesty(1))) {
                        $this->player->getInventory()->addItem((new RankKits())->majesty(1));
                    } else {
                        $this->player->getWorld()->dropItem($this->player->getLocation(), (new RankKits())->majesty(1));
                    }
                    $this->player->sendMessage(TF::AQUA . "You got a " . TF::DARK_PURPLE . "Majesty " . TF::AQUA . "Rank Kit");
                    break;

                case 5: # emperor
                    if($this->player->getInventory()->canAddItem((new RankKits())->emperor(1))) {
                        $this->player->getInventory()->addItem((new RankKits())->emperor(1));
                    } else {
                        $this->player->getWorld()->dropItem($this->player->getLocation(), (new RankKits())->emperor(1));
                    }
                    $this->player->sendMessage(TF::AQUA . "You got a " . TF::AQUA . "Emperor " . TF::AQUA . "Rank Kit");
                    break;

                case 6: # president
                    if($this->player->getInventory()->canAddItem((new RankKits())->president(1))) {
                        $this->player->getInventory()->addItem((new RankKits())->president(1));
                    } else {
                        $this->player->getWorld()->dropItem($this->player->getLocation(), (new RankKits())->president(1));
                    }
                    $this->player->sendMessage(TF::AQUA . "You got a " . TF::RED . "President " . TF::AQUA . "Rank Kit");
                    break;
            }
                break;

            # 1.75m energy
            case 29:
            case 30:
            case 31:
            case 32:
            case 33:
            case 34:
            case 35:
                $this->player->sendMessage(TF::AQUA . "You got " . TF::WHITE . "1,750,000" . TF::AQUA . " Energy");

                $energyOrb = new Orbs();
                $item = $energyOrb->EnergyOrb(1750000);
                if($this->player->getInventory()->canAddItem($item)) {
                    $this->player->getInventory()->addItem($item);
                } else {
                    $this->player->getLocation()->getWorld()->dropItem($this->player->getLocation(), $item);
                }
                break;
        }
    }
}