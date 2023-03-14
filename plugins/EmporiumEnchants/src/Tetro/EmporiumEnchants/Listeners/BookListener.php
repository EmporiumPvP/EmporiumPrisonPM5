<?php

namespace Tetro\EmporiumEnchants\Listeners;

use BlockHorizons\Fireworks\item\Fireworks;
use Emporium\Wormhole\Utils\FireworksParticle;

use Exception;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerItemUseEvent;
use pocketmine\utils\TextFormat as TF;

use Tetro\EmporiumEnchants\Core\BookManager;
use Tetro\EmporiumEnchants\Core\CustomEnchant;
use Tetro\EmporiumEnchants\Loader;
use Tetro\EmporiumEnchants\Utils\Utils;

class BookListener implements Listener {

    private BookManager $bookManager;

    public function __construct() {
        $this->bookManager = Loader::getBookManager();
    }

    /**
     * @throws Exception
     */
    public function onRevealBookAir(PlayerInteractEvent $event) {

        $player = $event->getPlayer();
        $hand = $player->getInventory()->getItemInHand();
        $count = $hand->getCount();

        $utils = new Utils();

        # Elite Book
        if ($hand->getNamedTag()->getTag("EliteBook")) {
            # create book
            $enchants = $utils->getEnchant(CustomEnchant::RARITY_ELITE);
            $enchant = $enchants[array_rand($enchants)];
            $id = $enchant->getId();
            $level = mt_rand(1, $enchant->getMaxLevel());
            $rarity = CustomEnchant::RARITY_ELITE;
            $success = mt_rand(1, 100);
            # check if player inventory full
            if($player->getInventory()->canAddItem($this->bookManager->EnchantedBook($enchant, $level,  $rarity, $id, $success))) {
                # remove Item
                $hand->setCount($count - 1);
                $player->getInventory()->setItemInHand($hand);
                # give item
                $player->getInventory()->addItem($this->bookManager->EnchantedBook($enchant, $level,  $rarity, $id, $success));
                # send particles
                FireworksParticle::instantFirework($player, Fireworks::COLOR_BLUE);
            } else {
                $player->sendMessage(TF::RED. "Your inventory is full");
            }
        }

        # Ultimate Book
        if ($hand->getNamedTag()->getTag("UltimateBook")) {
            # create book
            $enchants = $utils->getEnchant(CustomEnchant::RARITY_ULTIMATE);
            $enchant = $enchants[array_rand($enchants)];
            $id = $enchant->getId();
            $level = mt_rand(1, $enchant->getMaxLevel());
            $rarity = CustomEnchant::RARITY_ULTIMATE;
            $success = mt_rand(1, 100);
            # check if player inventory full
            if($player->getInventory()->canAddItem($this->bookManager->EnchantedBook($enchant, $level,  $rarity, $id, $success))) {
                # remove Item
                $hand->setCount($count - 1);
                $player->getInventory()->setItemInHand($hand);
                # give item
                $player->getInventory()->addItem($this->bookManager->EnchantedBook($enchant, $level,  $rarity, $id, $success));
                # send particles
                FireworksParticle::instantFirework($player, Fireworks::COLOR_YELLOW);
            } else {
                $player->sendMessage(TF::RED. "Your inventory is full");
            }
        }

        # Legendary Book
        if ($hand->getNamedTag()->getTag("LegendaryBook")) {
            # create book
            $enchants = $utils->getEnchant(CustomEnchant::RARITY_LEGENDARY);
            $enchant = $enchants[array_rand($enchants)];
            $id = $enchant->getId();
            $level = mt_rand(1, $enchant->getMaxLevel());
            $rarity = CustomEnchant::RARITY_LEGENDARY;
            $success = mt_rand(1, 100);
            # check if player inventory full
            if($player->getInventory()->canAddItem($this->bookManager->EnchantedBook($enchant, $level,  $rarity, $id, $success))) {
                # remove Item
                $hand->setCount($count - 1);
                $player->getInventory()->setItemInHand($hand);
                # give item
                $player->getInventory()->addItem($this->bookManager->EnchantedBook($enchant, $level,  $rarity, $id, $success));
                # send particles
                FireworksParticle::instantFirework($player, Fireworks::COLOR_GOLD);
            } else {
                $player->sendMessage(TF::RED. "Your inventory is full");
            }
        }

        # Godly Book
        if ($hand->getNamedTag()->getTag("GodlyBook")) {
            # create book
            $enchants = $utils->getEnchant(CustomEnchant::RARITY_GODLY);
            $enchant = $enchants[array_rand($enchants)];
            $id = $enchant->getId();
            $level = mt_rand(1, $enchant->getMaxLevel());
            $rarity = CustomEnchant::RARITY_GODLY;
            $success = mt_rand(1, 100);
            # check if player inventory full
            if($player->getInventory()->canAddItem($this->bookManager->EnchantedBook($enchant, $level,  $rarity, $id, $success))) {
                # remove Item
                $hand->setCount($count - 1);
                $player->getInventory()->setItemInHand($hand);
                # give item
                $player->getInventory()->addItem($this->bookManager->EnchantedBook($enchant, $level,  $rarity, $id, $success));
                # send particles
                FireworksParticle::instantFirework($player, Fireworks::COLOR_PINK);
            } else {
                $player->sendMessage(TF::RED. "Your inventory is full");
            }
        }

        # Heroic Book
        if ($hand->getNamedTag()->getTag("HeroicBook")) {
            # create book
            $enchants = $utils->getEnchant(CustomEnchant::RARITY_HEROIC);
            $enchant = $enchants[array_rand($enchants)];
            $id = $enchant->getId();
            $level = mt_rand(1, $enchant->getMaxLevel());
            $rarity = CustomEnchant::RARITY_HEROIC;
            $success = mt_rand(1, 100);
            # check if player inventory full
            if($player->getInventory()->canAddItem($this->bookManager->EnchantedBook($enchant, $level,  $rarity, $id, $success))) {
                # remove Item
                $hand->setCount($count - 1);
                $player->getInventory()->setItemInHand($hand);
                # give item
                $player->getInventory()->addItem(($this->bookManager->EnchantedBook($enchant, $level,  $rarity, $id, $success)));
                # send particles
                FireworksParticle::instantFirework($player, Fireworks::COLOR_RED);
            } else {
                $player->sendMessage(TF::RED. "Your inventory is full");
            }
        }

        # Executive Book
        if ($hand->getNamedTag()->getTag("ExecutiveBook")) {
            # create book
            $enchants = $utils->getEnchant(CustomEnchant::RARITY_EXECUTIVE);
            $enchant = $enchants[array_rand($enchants)];
            $id = $enchant->getId();
            $level = mt_rand(1, $enchant->getMaxLevel());
            $rarity = CustomEnchant::RARITY_EXECUTIVE;
            $success = mt_rand(1, 100);
            # check if player inventory full
            if($player->getInventory()->canAddItem($this->bookManager->EnchantedBook($enchant, $level,  $rarity, $id, $success))) {
                # remove Item
                $hand->setCount($count - 1);
                $player->getInventory()->setItemInHand($hand);
                # give item
                $player->getInventory()->addItem($this->bookManager->EnchantedBook($enchant, $level,  $rarity, $id, $success));
                # send particles
                FireworksParticle::instantFirework($player, Fireworks::COLOR_BLACK);
            } else {
                $player->sendMessage(TF::RED. "Your inventory is full");
            }
        }

    }

    /**
     * @throws Exception
     */
    public function onRevealBookBlock(PlayerInteractEvent $event) {

        $player = $event->getPlayer();
        $hand = $player->getInventory()->getItemInHand();
        $count = $hand->getCount();

        $utils = new Utils();

        # Elite Book
        if ($hand->getNamedTag()->getTag("EliteBook")) {
            # create book
            $enchants = $utils->getEnchant(CustomEnchant::RARITY_ELITE);
            $enchant = $enchants[array_rand($enchants)];
            $id = $enchant->getId();
            $level = mt_rand(1, $enchant->getMaxLevel());
            $rarity = CustomEnchant::RARITY_ELITE;
            $success = mt_rand(1, 100);
            # check if player inventory full
            if($player->getInventory()->canAddItem($this->bookManager->EnchantedBook($enchant, $level,  $rarity, $id, $success))) {
                # remove Item
                $hand->setCount($count - 1);
                $player->getInventory()->setItemInHand($hand);
                # give item
                $player->getInventory()->addItem($this->bookManager->EnchantedBook($enchant, $level,  $rarity, $id, $success));
                # send particles
                FireworksParticle::instantFirework($player, Fireworks::COLOR_BLUE);
            } else {
                $player->sendMessage(TF::RED. "Your inventory is full");
            }
        }

        # Ultimate Book
        if ($hand->getNamedTag()->getTag("UltimateBook")) {
            # create book
            $enchants = $utils->getEnchant(CustomEnchant::RARITY_ULTIMATE);
            $enchant = $enchants[array_rand($enchants)];
            $id = $enchant->getId();
            $level = mt_rand(1, $enchant->getMaxLevel());
            $rarity = CustomEnchant::RARITY_ULTIMATE;
            $success = mt_rand(1, 100);
            # check if player inventory full
            if($player->getInventory()->canAddItem($this->bookManager->EnchantedBook($enchant, $level,  $rarity, $id, $success))) {
                # remove Item
                $hand->setCount($count - 1);
                $player->getInventory()->setItemInHand($hand);
                # give item
                $player->getInventory()->addItem($this->bookManager->EnchantedBook($enchant, $level,  $rarity, $id, $success));
                # send particles
                FireworksParticle::instantFirework($player, Fireworks::COLOR_YELLOW);
            } else {
                $player->sendMessage(TF::RED. "Your inventory is full");
            }
        }

        # Legendary Book
        if ($hand->getNamedTag()->getTag("LegendaryBook")) {
            # create book
            $enchants = $utils->getEnchant(CustomEnchant::RARITY_LEGENDARY);
            $enchant = $enchants[array_rand($enchants)];
            $id = $enchant->getId();
            $level = mt_rand(1, $enchant->getMaxLevel());
            $rarity = CustomEnchant::RARITY_LEGENDARY;
            $success = mt_rand(1, 100);
            # check if player inventory full
            if($player->getInventory()->canAddItem($this->bookManager->EnchantedBook($enchant, $level,  $rarity, $id, $success))) {
                # remove Item
                $hand->setCount($count - 1);
                $player->getInventory()->setItemInHand($hand);
                # give item
                $player->getInventory()->addItem($this->bookManager->EnchantedBook($enchant, $level,  $rarity, $id, $success));
                # send particles
                FireworksParticle::instantFirework($player, Fireworks::COLOR_GOLD);
            } else {
                $player->sendMessage(TF::RED. "Your inventory is full");
            }
        }

        # Godly Book
        if ($hand->getNamedTag()->getTag("GodlyBook")) {
            # create book
            $enchants = $utils->getEnchant(CustomEnchant::RARITY_GODLY);
            $enchant = $enchants[array_rand($enchants)];
            $id = $enchant->getId();
            $level = mt_rand(1, $enchant->getMaxLevel());
            $rarity = CustomEnchant::RARITY_GODLY;
            $success = mt_rand(1, 100);
            # check if player inventory full
            if($player->getInventory()->canAddItem($this->bookManager->EnchantedBook($enchant, $level,  $rarity, $id, $success))) {
                # remove Item
                $hand->setCount($count - 1);
                $player->getInventory()->setItemInHand($hand);
                # give item
                $player->getInventory()->addItem($this->bookManager->EnchantedBook($enchant, $level,  $rarity, $id, $success));
                # send particles
                FireworksParticle::instantFirework($player, Fireworks::COLOR_PINK);
            } else {
                $player->sendMessage(TF::RED. "Your inventory is full");
            }
        }

        # Heroic Book
        if ($hand->getNamedTag()->getTag("HeroicBook")) {
            # create book
            $enchants = $utils->getEnchant(CustomEnchant::RARITY_HEROIC);
            $enchant = $enchants[array_rand($enchants)];
            $id = $enchant->getId();
            $level = mt_rand(1, $enchant->getMaxLevel());
            $rarity = CustomEnchant::RARITY_HEROIC;
            $success = mt_rand(1, 100);
            # check if player inventory full
            if($player->getInventory()->canAddItem($this->bookManager->EnchantedBook($enchant, $level,  $rarity, $id, $success))) {
                # remove Item
                $hand->setCount($count - 1);
                $player->getInventory()->setItemInHand($hand);
                # give item
                $player->getInventory()->addItem(($this->bookManager->EnchantedBook($enchant, $level,  $rarity, $id, $success)));
                # send particles
                FireworksParticle::instantFirework($player, Fireworks::COLOR_RED);
            } else {
                $player->sendMessage(TF::RED. "Your inventory is full");
            }
        }

        # Executive Book
        if ($hand->getNamedTag()->getTag("ExecutiveBook")) {
            # create book
            $enchants = $utils->getEnchant(CustomEnchant::RARITY_EXECUTIVE);
            $enchant = $enchants[array_rand($enchants)];
            $id = $enchant->getId();
            $level = mt_rand(1, $enchant->getMaxLevel());
            $rarity = CustomEnchant::RARITY_EXECUTIVE;
            $success = mt_rand(1, 100);
            # check if player inventory full
            if($player->getInventory()->canAddItem($this->bookManager->EnchantedBook($enchant, $level,  $rarity, $id, $success))) {
                # remove Item
                $hand->setCount($count - 1);
                $player->getInventory()->setItemInHand($hand);
                # give item
                $player->getInventory()->addItem($this->bookManager->EnchantedBook($enchant, $level,  $rarity, $id, $success));
                # send particles
                FireworksParticle::instantFirework($player, Fireworks::COLOR_BLACK);
            } else {
                $player->sendMessage(TF::RED. "Your inventory is full");
            }
        }

    }
}