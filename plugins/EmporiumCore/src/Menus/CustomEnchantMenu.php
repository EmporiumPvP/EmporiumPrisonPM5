<?php

namespace Menus;

use Emporium\Prison\library\formapi\CustomForm;
use Emporium\Prison\library\formapi\SimpleForm;
use Emporium\Prison\Managers\misc\Translator;

use EmporiumCore\Managers\Data\DataManager;
use EmporiumCore\Variables;

use pocketmine\utils\TextFormat as TF;
use Tetro\EmporiumEnchants\Items\Books;

class CustomEnchantMenu {

    public function Form($player): void {

        $form = new SimpleForm(function($player, $data) {
            if ($data === null) {
                return;
            }
            switch($data) {
                case 0:
                    $this->EliteEnchant($player);
                    break;
                case 1:
                    $this->UltimateEnchant($player);
                    break;
                case 2:
                    $this->LegendaryEnchant($player);
                    break;
                case 3:
                    $this->GodlyEnchant($player);
                    break;
                case 4:
                    $this->HeroicEnchant($player);
                    break;
                case 5:
                    $this->ExecutiveEnchant($player);
                    break;
                case 6:
                    break;
            }
        });
        $form->setTitle("Custom Enchant Shop");
        $form->setContent(TF::GRAY . "Select the category that you would like to purchase an item in.");
        $form->addButton(TF::BLUE . "Elite Book" . TF::EOL . TF::GRAY . "5,000 CEXP");
        $form->addButton(TF::YELLOW . "Ultimate Book" . TF::EOL . TF::GRAY . "10,000 CEXP");
        $form->addButton(TF::GOLD . "Legendary Book" . TF::EOL . TF::GRAY . "25,000 CEXP");
        $form->addButton(TF::LIGHT_PURPLE . "Godly Book" . TF::EOL . TF::GRAY . "50,000 CEXP");
        $form->addButton(TF::RED . "Heroic Book" . TF::EOL . TF::GRAY . "75,000 CEXP");
        $form->addButton(TF::BLACK . "Executive Book" . TF::EOL . TF::GRAY . "100,000 CEXP");
        $form->addButton(TF::DARK_RED . "Close");
        $player->sendForm($form);
    }

    public function EliteEnchant($player): void {
        $balance = DataManager::getData($player, "Players", "Cexp");
        $form = new CustomForm(function($player, $data) use ($balance) {
            if ($data === null) {
                return;
            }
            $price = 5000 * $data[1];
            // Purchase
            if ($balance >= $price) {
                DataManager::takeData($player, "Players", "Cexp", $price);
                // Item
                $item = new Books();
                $item->Elite($data[1]);
                foreach ($player->getInventory()->addItem((new Books())->Elite($data[1])) as $invfull) {
                    $player->getWorld()->dropItem($player->getPosition(), $invfull);
                }
                // Confirm
                $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have purchased " . TF::AQUA . $data[1] . "x " . TF::BLUE . "Elite " . TF::GRAY . "Books");
                return;
            }
            $player->sendMessage(Variables::ERROR_PREFIX . TF::GRAY . "You do not have enough CEXP to purchase " . TF::AQUA . $data[1] . "x " . TF::BLUE . "Elite " . TF::GRAY . "Books");
        });
        $form->setTitle("Custom Enchant Shop");
        $form->addLabel(TF::GRAY . "Item: " . TF::BLUE . "Elite " . TF::GRAY . "Enchantment Book" . TF::EOL . TF::GRAY . "Cost: " . TF::GREEN . "5,000 CEXP " . TF::GRAY . "per Book" . TF::EOL . TF::GRAY . "Your Cexp: " . TF::AQUA . Translator::shortNumber($balance));
        $form->addSlider(TF::GRAY . "Amount", 1, 64);
        $player->sendForm($form);
    }

    public function UltimateEnchant($player): void {
        $balance = DataManager::getData($player, "Players", "Cexp");
        $form = new CustomForm(function($player, $data) use ($balance) {
            if ($data === null) {
                return;
            }
            // Variables
            $price = 10000 * $data[1];
            // Purchase
            if ($balance >= $price) {
                DataManager::takeData($player, "Players", "Cexp", $price);
                // Item
                $item = new Books();
                $item->Ultimate($data[1]);
                foreach ($player->getInventory()->addItem((new Books())->Ultimate($data[1])) as $invfull) {
                    $player->getWorld()->dropItem($player->getPosition(), $invfull);
                }
                // Confirm
                $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have purchased " . TF::AQUA . $data[1] . "x " . TF::YELLOW . "Ultimate " . TF::GRAY . "Books");
                return;
            }
            $player->sendMessage(Variables::ERROR_PREFIX . TF::GRAY . "You do not have enough CEXP to purchase " . TF::AQUA . $data[1] . "x " . TF::YELLOW . "Ultimate " . TF::GRAY . "Books");
        });
        $form->setTitle("Custom Enchant Shop");
        $form->addLabel(TF::GRAY . "Item: " . TF::YELLOW . "Ultimate " . TF::GRAY . "Enchantment Book" . TF::EOL . TF::GRAY . "Cost: " . TF::GREEN . "10,000 CEXP " . TF::GRAY . "per Book" . TF::EOL . TF::GRAY . "Your Cexp: " . TF::AQUA . Translator::shortNumber($balance));
        $form->addSlider(TF::GRAY . "Amount", 1, 64);
        $player->sendForm($form);
    }

    public function LegendaryEnchant($player): void {
        $balance = DataManager::getData($player, "Players", "Cexp");
        $form = new CustomForm(function($player, $data) use ($balance) {
            if ($data === null) {
                return;
            }
            // Variables
            $price = 25000 * $data[1];
            // Purchase
            if ($balance >= $price) {
                DataManager::takeData($player, "Players", "Cexp", $price);
                // Item
                $item = new Books();
                $item->Legendary($data[1]);
                foreach ($player->getInventory()->addItem((new Books())->Legendary($data[1])) as $invfull) {
                    $player->getWorld()->dropItem($player->getPosition(), $invfull);
                }
                // Confirm
                $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have purchased " . TF::AQUA . $data[1] . "x " . TF::GOLD . "Legendary " . TF::GRAY . "Books");
                return;
            }
            $player->sendMessage(Variables::ERROR_PREFIX . TF::GRAY . "You do not have enough CEXP to purchase " . TF::AQUA . $data[1] . "x " . TF::GOLD . "Legendary " . TF::GRAY . "Books");
        });
        $form->setTitle("Custom Enchant Shop");
        $form->addLabel(TF::GRAY . "Item: " . TF::GOLD . "Legendary " . TF::GRAY . "Enchantment Book" . TF::EOL . TF::GRAY . "Cost: " . TF::GREEN . "25,000 CEXP " . TF::GRAY . "per Book" . TF::EOL . TF::GRAY . "Your Cexp: " . TF::AQUA . Translator::shortNumber($balance));
        $form->addSlider(TF::GRAY . "Amount", 1, 64);
        $player->sendForm($form);
    }

    public function GodlyEnchant($player): void {
        $balance = DataManager::getData($player, "Players", "Cexp");
        $form = new CustomForm(function($player, $data) use ($balance) {
            if ($data === null) {
                return;
            }
            // Variables
            $price = 50000 * $data[1];
            // Purchase
            if ($balance >= $price) {
                DataManager::takeData($player, "Players", "Cexp", $price);
                // Item
                $item = new Books();
                $item->Godly($data[1]);
                foreach ($player->getInventory()->addItem((new Books())->Godly($data[1])) as $invfull) {
                    $player->getWorld()->dropItem($player->getPosition(), $invfull);
                }
                // Confirm
                $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have purchased " . TF::AQUA . $data[1] . "x " . TF::LIGHT_PURPLE . "Godly " . TF::GRAY . "Books");
                return;
            }
            $player->sendMessage(Variables::ERROR_PREFIX . TF::GRAY . "You do not have enough CEXP to purchase " . TF::AQUA . $data[1] . "x " . TF::LIGHT_PURPLE . "Godly " . TF::GRAY . "Books");
        });
        $form->setTitle("Custom Enchant Shop");
        $form->addLabel(TF::GRAY . "Item: " . TF::LIGHT_PURPLE . "Godly " . TF::GRAY . "Enchantment Book" . TF::EOL . TF::GRAY . "Cost: " . TF::GREEN . "50,000 CEXP " . TF::GRAY . "per Book" . TF::EOL . TF::GRAY . "Your Cexp: " . TF::AQUA . Translator::shortNumber($balance));
        $form->addSlider(TF::GRAY . "Amount", 1, 64);
        $player->sendForm($form);
    }

    public function HeroicEnchant($player): void {
        $balance = DataManager::getData($player, "Players", "Cexp");
        $form = new CustomForm(function($player, $data) use ($balance) {
            if ($data === null) {
                return;
            }
            // Variables
            $price = 75000 * $data[1];
            // Purchase
            if ($balance >= $price) {
                DataManager::takeData($player, "Players", "Cexp", $price);
                // Item
                $item = new Books();
                $item->Heroic($data[1]);
                foreach ($player->getInventory()->addItem((new Books())->Heroic($data[1])) as $invfull) {
                    $player->getWorld()->dropItem($player->getPosition(), $invfull);
                }
                // Confirm
                $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have purchased " . TF::AQUA . $data[1] . "x " . TF::RED . "Heroic " . TF::GRAY . "Books");
                return;
            }
            $player->sendMessage(Variables::ERROR_PREFIX . TF::GRAY . "You do not have enough CEXP to purchase " . TF::AQUA . $data[1] . "x " . TF::RED . "Heroic " . TF::GRAY . "Books");
        });
        $form->setTitle("Custom Enchant Shop");
        $form->addLabel(TF::GRAY . "Item: " . TF::RED . "Heroic " . TF::GRAY . "Enchantment Book" . TF::EOL . TF::GRAY . "Cost: " . TF::GREEN . "75,000 CEXP " . TF::GRAY . "per Book" . TF::EOL . TF::GRAY . "Your Cexp: " . TF::AQUA . Translator::shortNumber($balance));
        $form->addSlider(TF::GRAY . "Amount", 1, 64);
        $player->sendForm($form);
    }

    public function ExecutiveEnchant($player): void {
        $balance = DataManager::getData($player, "Players", "Cexp");
        $form = new CustomForm(function($player, $data) use ($balance) {
            if ($data === null) {
                return;
            }
            // Variables
            $price = 100000 * $data[1];
            // Purchase
            if ($balance >= $price) {
                DataManager::takeData($player, "Players", "Cexp", $price);
                // Item
                $item = new Books();
                $item->Executive($data[1]);
                foreach ($player->getInventory()->addItem((new Books())->Executive($data[1])) as $invfull) {
                    $player->getWorld()->dropItem($player->getPosition(), $invfull);
                }
                // Confirm
                $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have purchased " . TF::AQUA . $data[1] . "x " . TF::BLACK . "Executive " . TF::GRAY . "Books");
                return;
            }
            $player->sendMessage(Variables::ERROR_PREFIX . TF::GRAY . "You do not have enough CEXP to purchase " . TF::AQUA . $data[1] . "x " . TF::BLACK . "Executive " . TF::GRAY . "Books");
        });
        $form->setTitle("Custom Enchant Shop");
        $form->addLabel(TF::GRAY . "Item: " . TF::BLACK . "Executive " . TF::GRAY . "Enchantment Book" . TF::EOL . TF::GRAY . "Cost: " . TF::GREEN . "100,000 CEXP " . TF::GRAY . "per Book" . TF::EOL . TF::GRAY . "Your Cexp: " . TF::AQUA . Translator::shortNumber($balance));
        $form->addSlider(TF::GRAY . "Amount", 1, 64);
        $player->sendForm($form);
    }

}