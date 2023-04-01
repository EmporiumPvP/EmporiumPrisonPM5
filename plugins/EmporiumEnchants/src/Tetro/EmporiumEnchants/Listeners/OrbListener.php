<?php

namespace Tetro\EmporiumEnchants\Listeners;

use BlockHorizons\Fireworks\item\Fireworks;

use Emporium\Prison\Managers\misc\Translator;

use Exception;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerItemUseEvent;
use pocketmine\utils\TextFormat as TF;

use Tetro\EmporiumEnchants\Core\CustomEnchant;
use Tetro\EmporiumEnchants\Core\OrbManager;
use Tetro\EmporiumEnchants\EmporiumEnchants;
use Tetro\EmporiumEnchants\Utils\Utils;
use Tetro\EmporiumWormhole\Utils\FireworksParticle;

class OrbListener implements Listener {

    private orbManager $orbManager;

    public function __construct() {
        $this->orbManager = EmporiumEnchants::getInstance()->getOrbManager();
    }

    /**
     * @throws Exception
     */
    public function onRevealOrb(PlayerItemUseEvent $event)
    {

        $player = $event->getPlayer();
        $hand = $player->getInventory()->getItemInHand();
        $count = $hand->getCount();

        $utils = new Utils();

        # Elite Orb
        if ($hand->getNamedTag()->getTag("ElitePickaxeEnchantOrb")) {
            # create orb
            $enchants = $utils->getPickaxeEnchant(CustomEnchant::RARITY_ELITE);
            $enchant = $enchants[array_rand($enchants)];
            $id = $enchant->getId();
            $level = mt_rand(1, $enchant->getMaxLevel());
            $rarity = CustomEnchant::RARITY_ELITE;
            $name = $enchant->getName();
            $success = mt_rand(1, 100);
            # check if player inventory full
            if($player->getInventory()->canAddItem($this->orbManager->EnchantedOrb($enchant, $level,  $rarity, $id, $success))) {
                # remove Item
                $hand->setCount($count - 1);
                $player->getInventory()->setItemInHand($hand);
                # give item
                $player->getInventory()->addItem($this->orbManager->EnchantedOrb($enchant, $level,  $rarity, $id, $success));
                # send particles
                FireworksParticle::instantFirework($player, Fireworks::COLOR_BLUE);
                $player->sendMessage(TF::BOLD . TF::GRAY . "(!) " . TF::RESET . TF::GRAY . "You received: " . TF::BLUE . $name . " " . TF::AQUA . Translator::romanNumber($level) . TF::GRAY . " (" . TF::WHITE . $success . "%" . TF::GRAY . ")");
            } else {
                $player->sendMessage(TF::RED. "Your inventory is full");
            }
        }

        # Ultimate Book
        if ($hand->getNamedTag()->getTag("UltimatePickaxeEnchantOrb")) {
            # create book
            $enchants = $utils->getPickaxeEnchant(CustomEnchant::RARITY_ULTIMATE);
            $enchant = $enchants[array_rand($enchants)];
            $id = $enchant->getId();
            $level = mt_rand(1, $enchant->getMaxLevel());
            $rarity = CustomEnchant::RARITY_ULTIMATE;
            $name = $enchant->getName();
            $success = mt_rand(1, 100);
            # check if player inventory full
            if($player->getInventory()->canAddItem($this->orbManager->EnchantedOrb($enchant, $level,  $rarity, $id, $success))) {
                # remove Item
                $hand->setCount($count - 1);
                $player->getInventory()->setItemInHand($hand);
                # give item
                $player->getInventory()->addItem($this->orbManager->EnchantedOrb($enchant, $level,  $rarity, $id, $success));
                # send particles
                FireworksParticle::instantFirework($player, Fireworks::COLOR_YELLOW);
                $player->sendMessage(TF::BOLD . TF::GRAY . "(!) " . TF::RESET . TF::GRAY . "You received: " . TF::YELLOW . $name . " " . TF::AQUA . Translator::romanNumber($level) . TF::GRAY . " (" . TF::WHITE . $success . "%" . TF::GRAY . ")");
            } else {
                $player->sendMessage(TF::RED. "Your inventory is full");
            }
        }

        # Legendary Book
        if ($hand->getNamedTag()->getTag("LegendaryPickaxeEnchantOrb")) {
            # create book
            $enchants = $utils->getPickaxeEnchant(CustomEnchant::RARITY_LEGENDARY);
            $enchant = $enchants[array_rand($enchants)];
            $id = $enchant->getId();
            $level = mt_rand(1, $enchant->getMaxLevel());
            $rarity = CustomEnchant::RARITY_LEGENDARY;
            $name = $enchant->getName();
            $success = mt_rand(1, 100);
            # check if player inventory full
            if($player->getInventory()->canAddItem($this->orbManager->EnchantedOrb($enchant, $level,  $rarity, $id, $success))) {
                # remove Item
                $hand->setCount($count - 1);
                $player->getInventory()->setItemInHand($hand);
                # give item
                $player->getInventory()->addItem($this->orbManager->EnchantedOrb($enchant, $level,  $rarity, $id, $success));
                # send particles
                FireworksParticle::instantFirework($player, Fireworks::COLOR_GOLD);
                $player->sendMessage(TF::BOLD . TF::GRAY . "(!) " . TF::RESET . TF::GRAY . "You received: " . TF::GOLD . $name . " " . TF::AQUA . Translator::romanNumber($level) . TF::GRAY . " (" . TF::WHITE . $success . "%" . TF::GRAY . ")");
            } else {
                $player->sendMessage(TF::RED. "Your inventory is full");
            }
        }

        # Godly Book
        if ($hand->getNamedTag()->getTag("GodlyPickaxeEnchantOrb")) {
            # create book
            $enchants = $utils->getPickaxeEnchant(CustomEnchant::RARITY_GODLY);
            $enchant = $enchants[array_rand($enchants)];
            $id = $enchant->getId();
            $level = mt_rand(1, $enchant->getMaxLevel());
            $rarity = CustomEnchant::RARITY_GODLY;
            $name = $enchant->getName();
            $success = mt_rand(1, 100);
            # check if player inventory full
            if($player->getInventory()->canAddItem($this->orbManager->EnchantedOrb($enchant, $level,  $rarity, $id, $success))) {
                # remove Item
                $hand->setCount($count - 1);
                $player->getInventory()->setItemInHand($hand);
                # give item
                $player->getInventory()->addItem($this->orbManager->EnchantedOrb($enchant, $level,  $rarity, $id, $success));
                # send particles
                FireworksParticle::instantFirework($player, Fireworks::COLOR_PINK);
                $player->sendMessage(TF::BOLD . TF::GRAY . "(!) " . TF::RESET . TF::GRAY . "You received: " . TF::LIGHT_PURPLE . $name . " " . TF::AQUA . Translator::romanNumber($level) . TF::GRAY . " (" . TF::WHITE . $success . "%" . TF::GRAY . ")");
            } else {
                $player->sendMessage(TF::RED. "Your inventory is full");
            }
        }

        # Heroic Book
        if ($hand->getNamedTag()->getTag("HeroicPickaxeEnchantOrb")) {
            # create book
            $enchants = $utils->getPickaxeEnchant(CustomEnchant::RARITY_HEROIC);
            $enchant = $enchants[array_rand($enchants)];
            $id = $enchant->getId();
            $level = mt_rand(1, $enchant->getMaxLevel());
            $rarity = CustomEnchant::RARITY_HEROIC;
            $name = $enchant->getName();
            $success = mt_rand(1, 100);
            # check if player inventory full
            if($player->getInventory()->canAddItem($this->orbManager->EnchantedOrb($enchant, $level,  $rarity, $id, $success))) {
                # remove Item
                $hand->setCount($count - 1);
                $player->getInventory()->setItemInHand($hand);
                # give item
                $player->getInventory()->addItem(($this->orbManager->EnchantedOrb($enchant, $level,  $rarity, $id, $success)));
                # send particles
                FireworksParticle::instantFirework($player, Fireworks::COLOR_RED);
                $player->sendMessage(TF::BOLD . TF::GRAY . "(!) " . TF::RESET . TF::GRAY . "You received: " . TF::RED . $name . " " . TF::AQUA . Translator::romanNumber($level) . TF::GRAY . " (" . TF::WHITE . $success . "%" . TF::GRAY . ")");
            } else {
                $player->sendMessage(TF::RED. "Your inventory is full");
            }
        }

        # Executive Book
        if ($hand->getNamedTag()->getTag("ExecutivePickaxeEnchantOrb")) {
            # create book
            $enchants = $utils->getPickaxeEnchant(CustomEnchant::RARITY_EXECUTIVE);
            $enchant = $enchants[array_rand($enchants)];
            $id = $enchant->getId();
            $level = mt_rand(1, $enchant->getMaxLevel());
            $rarity = CustomEnchant::RARITY_EXECUTIVE;
            $name = $enchant->getName();
            $success = mt_rand(1, 100);
            # check if player inventory full
            if($player->getInventory()->canAddItem($this->orbManager->EnchantedOrb($enchant, $level,  $rarity, $id, $success))) {
                # remove Item
                $hand->setCount($count - 1);
                $player->getInventory()->setItemInHand($hand);
                # give item
                $player->getInventory()->addItem($this->orbManager->EnchantedOrb($enchant, $level,  $rarity, $id, $success));
                # send particles
                FireworksParticle::instantFirework($player, Fireworks::COLOR_BLACK);
                $player->sendMessage(TF::BOLD . TF::GRAY . "(!) " . TF::RESET . TF::GRAY . "You received: " . TF::BLACK . $name . " " . TF::AQUA . Translator::romanNumber($level) . TF::GRAY . " (" . TF::WHITE . $success . "%" . TF::GRAY . ")");
            } else {
                $player->sendMessage(TF::RED. "Your inventory is full");
            }
        }

    }

}