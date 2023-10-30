<?php

namespace EmporiumCore\Menus;

use customiesdevs\customies\item\CustomiesItemFactory;

use Emporium\Prison\EmporiumPrison;
use Emporium\Prison\library\formapi\CustomForm;
use Emporium\Prison\library\formapi\SimpleForm;
use Emporium\Prison\Managers\misc\Translator;

use EmporiumCore\Variables;

use Tetro\EmporiumEnchants\EmporiumEnchants;
use Tetro\EmporiumEnchants\Items\Books;

use EmporiumData\DataManager;

use muqsit\invmenu\InvMenu;
use muqsit\invmenu\transaction\DeterministicInvMenuTransaction;
use muqsit\invmenu\type\InvMenuTypeIds;

use pocketmine\item\Item;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;
use pocketmine\world\sound\ClickSound;
use pocketmine\world\sound\DoorBumpSound;
use pocketmine\world\sound\XpCollectSound;

class CustomEnchantMenu extends Menu {

    public function Form(Player $player): void {

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

    public function EliteEnchant(Player $player): void {
        $balance = DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.cexp");
        $form = new CustomForm(function(Player $player, $data) use ($balance) {
            if ($data === null) {
                return;
            }
            $price = 5000 * $data[1];
            // Purchase
            if ($balance >= $price) {
                $player->sendMessage(TF::BOLD . TF::GRAY . "(!) " . TF::RESET . TF::GRAY . "Purchased: " . TF::BOLD . TF::BLUE . "Mystery Elite Enchant " . TF::RESET . TF::GRAY . "* " . TF::WHITE . $data[1]);
                DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.cexp", DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.cexp") - $price);
                foreach ($player->getInventory()->addItem(EmporiumEnchants::getInstance()->getBooks()->Elite($data[1])) as $invfull) {
                    $player->getWorld()->dropItem($player->getPosition(), $invfull);
                }
                return;
            }
            $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You do not have enough CEXP to purchase " . TF::AQUA . $data[1] . "x " . TF::BLUE . "Elite " . TF::GRAY . "Books");
        });
        $form->setTitle("Custom Enchant Shop");
        $form->addLabel(TF::GRAY . "Item: " . TF::BLUE . "Elite " . TF::GRAY . "Enchantment Book" . TF::EOL . TF::GRAY . "Cost: " . TF::GREEN . "5,000 CEXP " . TF::GRAY . "per Book" . TF::EOL . TF::GRAY . "Your Cexp: " . TF::AQUA . Translator::shortNumber($balance));
        $form->addSlider(TF::GRAY . "Amount", 1, 64);
        $player->sendForm($form);
    }

    public function UltimateEnchant($player): void {
        $balance = DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.cexp");
        $form = new CustomForm(function($player, $data) use ($balance) {
            if ($data === null) {
                return;
            }
            // Variables
            $price = 10000 * $data[1];
            // Purchase
            if ($balance >= $price) {
                DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.cexp", DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.cexp") - $price);
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
            $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You do not have enough CEXP to purchase " . TF::AQUA . $data[1] . "x " . TF::YELLOW . "Ultimate " . TF::GRAY . "Books");
        });
        $form->setTitle("Custom Enchant Shop");
        $form->addLabel(TF::GRAY . "Item: " . TF::YELLOW . "Ultimate " . TF::GRAY . "Enchantment Book" . TF::EOL . TF::GRAY . "Cost: " . TF::GREEN . "10,000 CEXP " . TF::GRAY . "per Book" . TF::EOL . TF::GRAY . "Your Cexp: " . TF::AQUA . Translator::shortNumber($balance));
        $form->addSlider(TF::GRAY . "Amount", 1, 64);
        $player->sendForm($form);
    }

    public function LegendaryEnchant($player): void {
        $balance = DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.cexp");
        $form = new CustomForm(function($player, $data) use ($balance) {
            if ($data === null) {
                return;
            }
            // Variables
            $price = 25000 * $data[1];
            // Purchase
            if ($balance >= $price) {
                DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.cexp", DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.cexp") - $price);
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
            $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You do not have enough CEXP to purchase " . TF::AQUA . $data[1] . "x " . TF::GOLD . "Legendary " . TF::GRAY . "Books");
        });
        $form->setTitle("Custom Enchant Shop");
        $form->addLabel(TF::GRAY . "Item: " . TF::GOLD . "Legendary " . TF::GRAY . "Enchantment Book" . TF::EOL . TF::GRAY . "Cost: " . TF::GREEN . "25,000 CEXP " . TF::GRAY . "per Book" . TF::EOL . TF::GRAY . "Your Cexp: " . TF::AQUA . Translator::shortNumber($balance));
        $form->addSlider(TF::GRAY . "Amount", 1, 64);
        $player->sendForm($form);
    }

    public function GodlyEnchant($player): void {
        $balance = DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.cexp");
        $form = new CustomForm(function($player, $data) use ($balance) {
            if ($data === null) {
                return;
            }
            // Variables
            $price = 50000 * $data[1];
            // Purchase
            if ($balance >= $price) {
                DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.cexp", DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.cexp") - $price);
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
            $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You do not have enough CEXP to purchase " . TF::AQUA . $data[1] . "x " . TF::LIGHT_PURPLE . "Godly " . TF::GRAY . "Books");
        });
        $form->setTitle("Custom Enchant Shop");
        $form->addLabel(TF::GRAY . "Item: " . TF::LIGHT_PURPLE . "Godly " . TF::GRAY . "Enchantment Book" . TF::EOL . TF::GRAY . "Cost: " . TF::GREEN . "50,000 CEXP " . TF::GRAY . "per Book" . TF::EOL . TF::GRAY . "Your Cexp: " . TF::AQUA . Translator::shortNumber($balance));
        $form->addSlider(TF::GRAY . "Amount", 1, 64);
        $player->sendForm($form);
    }

    public function HeroicEnchant($player): void {
        $balance = DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.cexp");
        $form = new CustomForm(function($player, $data) use ($balance) {
            if ($data === null) {
                return;
            }
            // Variables
            $price = 75000 * $data[1];
            // Purchase
            if ($balance >= $price) {
                DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.cexp", DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.cexp") - $price);
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
            $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You do not have enough CEXP to purchase " . TF::AQUA . $data[1] . "x " . TF::RED . "Heroic " . TF::GRAY . "Books");
        });
        $form->setTitle("Custom Enchant Shop");
        $form->addLabel(TF::GRAY . "Item: " . TF::RED . "Heroic " . TF::GRAY . "Enchantment Book" . TF::EOL . TF::GRAY . "Cost: " . TF::GREEN . "75,000 CEXP " . TF::GRAY . "per Book" . TF::EOL . TF::GRAY . "Your Cexp: " . TF::AQUA . Translator::shortNumber($balance));
        $form->addSlider(TF::GRAY . "Amount", 1, 64);
        $player->sendForm($form);
    }

    public function ExecutiveEnchant($player): void {
        $balance = DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.cexp");
        $form = new CustomForm(function($player, $data) use ($balance) {
            if ($data === null) {
                return;
            }
            // Variables
            $price = 100000 * $data[1];
            // Purchase
            if ($balance >= $price) {
                DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.cexp", DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.cexp") - $price);
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
            $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You do not have enough CEXP to purchase " . TF::AQUA . $data[1] . "x " . TF::BLACK . "Executive " . TF::GRAY . "Books");
        });
        $form->setTitle("Custom Enchant Shop");
        $form->addLabel(TF::GRAY . "Item: " . TF::BLACK . "Executive " . TF::GRAY . "Enchantment Book" . TF::EOL . TF::GRAY . "Cost: " . TF::GREEN . "100,000 CEXP " . TF::GRAY . "per Book" . TF::EOL . TF::GRAY . "Your Cexp: " . TF::AQUA . Translator::shortNumber($balance));
        $form->addSlider(TF::GRAY . "Amount", 1, 64);
        $player->sendForm($form);
    }

    public function Inventory(Player $player): void {

        $menu = InvMenu::create(InvMenuTypeIds::TYPE_CHEST);
        $menu->setName("Custom Enchant Shop");
        $menu->setListener(InvMenu::readonly(function (DeterministicInvMenuTransaction $transaction): void {

            $player = $transaction->getPlayer();
            $itemClicked = $transaction->getItemClicked();

            # buying elite book
            if($itemClicked->getNamedTag()->getTag("EliteCustomEnchantBook")) {

                # amount of books trying to purchase
                $count = $itemClicked->getCount();

                $playersInventory = $player->getInventory();

                # players balance
                $balance = 0;

                foreach ($playersInventory->getContents() as $item) {
                    if($item->getNamedTag()->getTag("EnergyOrb")) {
                        $balance += $item->getNamedTag()->getInt("Energy");
                        $player->getInventory()->remove($item);
                    }
                }
                if($balance > 0) {
                    $playersInventory->addItem(EmporiumPrison::getInstance()->getOrbs()->EnergyOrb($balance));
                }

                # player has no energy in inventory
                if($balance == 0) {
                    $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You dont have any energy in your inventory");
                    $player->broadcastSound(new DoorBumpSound(), [$player]);
                    return;
                }

                # player doesn't have enough energy in their inventory
                if($balance < 25000 * $count && $balance > 0) {
                    $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You dont have enough energy in your inventory");
                    $player->broadcastSound(new DoorBumpSound(), [$player]);
                    return;
                }

                # player has enough energy
                if($balance >= 25000 * $count) {

                    # update energy orb
                    $newBalance = $balance - (25000 * $count);
                    foreach ($player->getInventory()->getContents() as $item) {
                        if($item->getNamedTag()->getTag("EnergyOrb")) {
                            $player->getInventory()->remove($item);
                        }
                    }

                    # give player new orb
                    $player->getInventory()->addItem(EmporiumPrison::getInstance()->getOrbs()->EnergyOrb($newBalance));

                    # give player enchant book
                    if($player->getInventory()->canAddItem(EmporiumEnchants::getInstance()->getBooks()->Elite($count))) {
                        $player->getInventory()->addItem(EmporiumEnchants::getInstance()->getBooks()->Elite($count));
                    } else {
                        $player->getWorld()->dropItem($player->getPosition(), EmporiumEnchants::getInstance()->getBooks()->Elite($count));
                    }

                    # send confirmations
                    $player->sendMessage(TF::BOLD . TF::GRAY . "(!) " . TF::RESET . TF::GRAY . "You purchased: " . TF::BOLD . TF::BLUE . "Mystery Elite Enchant " . TF::RESET . TF::GRAY . " * " . TF::WHITE . $itemClicked->getCount());
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                    return;
                }
                return;
            }

            if($itemClicked->getNamedTag()->getTag("UltimateCustomEnchantBook")) {

                # amount of books trying to purchase
                $count = $itemClicked->getCount();

                $playersInventory = $player->getInventory();

                # players balance
                $balance = 0;

                foreach ($playersInventory->getContents() as $item) {
                    if($item->getNamedTag()->getTag("EnergyOrb")) {
                        $balance += $item->getNamedTag()->getInt("Energy");
                        $player->getInventory()->remove($item);
                    }
                }
                if($balance > 0) {
                    $playersInventory->addItem(EmporiumPrison::getInstance()->getOrbs()->EnergyOrb($balance));
                }

                # player has no energy in inventory
                if($balance == 0) {
                    $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You dont have any energy in your inventory");
                    $player->broadcastSound(new DoorBumpSound(), [$player]);
                    return;
                }

                # player doesn't have enough energy in their inventory
                if($balance < 50000 * $count && $balance > 0) {
                    $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You dont have enough energy in your inventory");
                    $player->broadcastSound(new DoorBumpSound(), [$player]);
                    return;
                }

                # player has enough energy
                if($balance > 50000 * $count) {

                    # update energy orb
                    $newBalance = $balance - (50000 * $count);
                    foreach ($player->getInventory()->getContents() as $item) {
                        if($item->getNamedTag()->getTag("EnergyOrb")) {
                            $player->getInventory()->remove($item);
                        }
                    }

                    # give player new orb
                    $player->getInventory()->addItem(EmporiumPrison::getInstance()->getOrbs()->EnergyOrb($newBalance));

                    # give player books
                    if($player->getInventory()->canAddItem(EmporiumEnchants::getInstance()->getBooks()->Ultimate($count))) {
                        $player->getInventory()->addItem(EmporiumEnchants::getInstance()->getBooks()->Ultimate($count));
                    } else {
                        $player->getWorld()->dropItem($player->getPosition(), EmporiumEnchants::getInstance()->getBooks()->Ultimate($count));
                    }

                    # send confirmations
                    $player->sendMessage(TF::BOLD . TF::GRAY . "(!) " . TF::RESET . TF::GRAY . "You purchased: " . TF::BOLD . TF::YELLOW . "Mystery Ultimate Enchant " . TF::RESET . TF::GRAY . " * " . TF::WHITE . $itemClicked->getCount());
                    $player->broadcastSound(new ClickSound(4), [$player]);
                    return;
                }
                return;
            }

            if($itemClicked->getNamedTag()->getTag("LegendaryCustomEnchantBook")) {

                # amount of books trying to purchase
                $count = $itemClicked->getCount();

                $playersInventory = $player->getInventory();

                # players balance
                $balance = 0;

                foreach ($playersInventory->getContents() as $item) {
                    if($item->getNamedTag()->getTag("EnergyOrb")) {
                        $balance += $item->getNamedTag()->getInt("Energy");
                        $player->getInventory()->remove($item);
                    }
                }
                if($balance > 0) {
                    $playersInventory->addItem(EmporiumPrison::getInstance()->getOrbs()->EnergyOrb($balance));
                }

                # player has no energy in inventory
                if($balance == 0) {
                    $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You dont have any energy in your inventory");
                    $player->broadcastSound(new DoorBumpSound(), [$player]);
                    return;
                }

                # player doesn't have enough energy in their inventory
                if($balance < 100000 * $count && $balance > 0) {
                    $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You dont have enough energy in your inventory");
                    $player->broadcastSound(new DoorBumpSound(), [$player]);
                    return;
                }

                # player has enough energy
                if($balance > 100000 * $count) {

                    # update energy orb
                    $newBalance = $balance - (100000 * $count);
                    foreach ($player->getInventory()->getContents() as $item) {
                        if($item->getNamedTag()->getTag("EnergyOrb")) {
                            $player->getInventory()->remove($item);
                        }
                    }

                    # give player new orb
                    $player->getInventory()->addItem(EmporiumPrison::getInstance()->getOrbs()->EnergyOrb($newBalance));

                    if($player->getInventory()->canAddItem(EmporiumEnchants::getInstance()->getBooks()->Legendary($count))) {
                        $player->getInventory()->addItem(EmporiumEnchants::getInstance()->getBooks()->Legendary($count));
                    } else {
                        $player->getWorld()->dropItem($player->getPosition(), EmporiumEnchants::getInstance()->getBooks()->Legendary($count));
                    }

                    # send confirmations
                    $player->sendMessage(TF::BOLD . TF::GRAY . "(!) " . TF::RESET . TF::GRAY . "You purchased: " . TF::BOLD . TF::GOLD . "Mystery Legendary Enchant " . TF::RESET . TF::GRAY . " * " . TF::WHITE . $itemClicked->getCount());
                    $player->broadcastSound(new ClickSound(4), [$player]);
                    return;
                }
                return;
            }

            if($itemClicked->getNamedTag()->getTag("GodlyCustomEnchantBook")) {

                # amount of books trying to purchase
                $count = $itemClicked->getCount();

                $playersInventory = $player->getInventory();

                # players balance
                $balance = 0;

                foreach ($playersInventory->getContents() as $item) {
                    if($item->getNamedTag()->getTag("EnergyOrb")) {
                        $balance += $item->getNamedTag()->getInt("Energy");
                        $player->getInventory()->remove($item);
                    }
                }
                if($balance > 0) {
                    $playersInventory->addItem(EmporiumPrison::getInstance()->getOrbs()->EnergyOrb($balance));
                }

                # player has no energy in inventory
                if($balance == 0) {
                    $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You dont have any energy in your inventory");
                    $player->broadcastSound(new DoorBumpSound(), [$player]);
                    return;
                }

                # player doesn't have enough energy in their inventory
                if($balance < 250000 * $count && $balance > 0) {
                    $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You dont have enough energy in your inventory");
                    $player->broadcastSound(new DoorBumpSound(), [$player]);
                    return;
                }

                # player has enough energy
                if($balance > 250000 * $count) {

                    # update energy orb
                    $newBalance = $balance - (250000 * $count);
                    foreach ($player->getInventory()->getContents() as $item) {
                        if($item->getNamedTag()->getTag("EnergyOrb")) {
                            $player->getInventory()->remove($item);
                        }
                    }

                    # give player new orb
                    $player->getInventory()->addItem(EmporiumPrison::getInstance()->getOrbs()->EnergyOrb($newBalance));

                    # give player books
                    if($player->getInventory()->canAddItem(EmporiumEnchants::getInstance()->getBooks()->Godly($count))) {
                        $player->getInventory()->addItem(EmporiumEnchants::getInstance()->getBooks()->Godly($count));
                    } else {
                        $player->getWorld()->dropItem($player->getPosition(), EmporiumEnchants::getInstance()->getBooks()->Godly($count));
                    }

                    # send confirmations
                    $player->sendMessage(TF::BOLD . TF::GRAY . "(!) " . TF::RESET . TF::GRAY . "You purchased: " . TF::BOLD . TF::LIGHT_PURPLE . "Mystery Godly Enchant " . TF::RESET . TF::GRAY . " * " . TF::WHITE . $itemClicked->getCount());
                    $player->broadcastSound(new ClickSound(4), [$player]);
                    return;
                }
                return;
            }

            if($itemClicked->getNamedTag()->getTag("HeroicCustomEnchantBook")) {

                # amount of books trying to purchase
                $count = $itemClicked->getCount();

                $playersInventory = $player->getInventory();

                # players balance
                $balance = 0;

                foreach ($playersInventory->getContents() as $item) {
                    if($item->getNamedTag()->getTag("EnergyOrb")) {
                        $balance += $item->getNamedTag()->getInt("Energy");
                        $player->getInventory()->remove($item);
                    }
                }
                if($balance > 0) {
                    $playersInventory->addItem(EmporiumPrison::getInstance()->getOrbs()->EnergyOrb($balance));
                }

                # player has no energy in inventory
                if($balance == 0) {
                    $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You dont have any energy in your inventory");
                    $player->broadcastSound(new DoorBumpSound(), [$player]);
                    return;
                }

                # player doesn't have enough energy in their inventory
                if($balance < 500000 * $count && $balance > 0) {
                    $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You dont have enough energy in your inventory");
                    $player->broadcastSound(new DoorBumpSound(), [$player]);
                    return;
                }

                # player has enough energy
                if($balance > 500000 * $count) {

                    # update energy orb
                    $newBalance = $balance - (500000 * $count);
                    foreach ($player->getInventory()->getContents() as $item) {
                        if($item->getNamedTag()->getTag("EnergyOrb")) {
                            $player->getInventory()->remove($item);
                        }
                    }

                    # give player new orb
                    $player->getInventory()->addItem(EmporiumPrison::getInstance()->getOrbs()->EnergyOrb($newBalance));

                    # give player books
                    if($player->getInventory()->canAddItem(EmporiumEnchants::getInstance()->getBooks()->Heroic($count))) {
                        $player->getInventory()->addItem(EmporiumEnchants::getInstance()->getBooks()->Heroic($count));
                    } else {
                        $player->getWorld()->dropItem($player->getPosition(), EmporiumEnchants::getInstance()->getBooks()->Heroic($count));
                    }

                    # send confirmations
                    $player->sendMessage(TF::BOLD . TF::GRAY . "(!) " . TF::RESET . TF::GRAY . "You purchased: " . TF::BOLD . TF::RED . "Mystery Heroic Enchant " . TF::RESET . TF::GRAY . " * " . TF::WHITE . $itemClicked->getCount());
                    $player->broadcastSound(new ClickSound(4), [$player]);
                }
            }
        }));
        $inv = $menu->getInventory();
        # elite books
        $inv->setItem(2, $this->generateEliteBookItem(1));
        $inv->setItem(11, $this->generateEliteBookItem(32));
        $inv->setItem(20, $this->generateEliteBookItem(64));
        # ultimate books
        $inv->setItem(3, $this->generateUltimateBookItem(1));
        $inv->setItem(12, $this->generateUltimateBookItem(32));
        $inv->setItem(21, $this->generateUltimateBookItem(64));
        # legendary books
        $inv->setItem(4, $this->generateLegendaryBookItem(1));
        $inv->setItem(13, $this->generateLegendaryBookItem(32));
        $inv->setItem(22, $this->generateLegendaryBookItem(64));
        # godly books
        $inv->setItem(5, $this->generateGodlyBookItem(1));
        $inv->setItem(14, $this->generateGodlyBookItem(32));
        $inv->setItem(23, $this->generateGodlyBookItem(64));
        # heroic books
        $inv->setItem(6, $this->generateHeroicBookItem(1));
        $inv->setItem(15, $this->generateHeroicBookItem(32));
        $inv->setItem(24, $this->generateHeroicBookItem(64));
        # send menu
        $menu->send($player);
    }

    public function generateEliteBookItem(int $count): Item {
        $item = CustomiesItemFactory::getInstance()->get("emporiumenchants:elite_book");
        $item->setCustomName(TF::BOLD . TF::BLUE . "Mystery Elite Enchant");
        $item->getNamedTag()->setInt("EliteCustomEnchantBook", 2);
        $lore = [
            TF::EOL,
            TF::WHITE . "Contains an " . TF::BOLD . TF::BLUE . "Elite",
            TF::RESET . TF::WHITE . "tier gear enchantment!",
            TF::EOL,
            TF::RESET . TF::GRAY . "Price: " . TF::BOLD . TF::WHITE . Translator::shortNumber(25000 * $count),
            TF::EOL,
            TF::RESET . TF::GRAY . "(Left-click to purchase)"
        ];
        $item->setCount($count);
        $item->setLore($lore);
        return $item;
    }
    public function generateUltimateBookItem(int $count): Item {
        $item = CustomiesItemFactory::getInstance()->get("emporiumenchants:ultimate_book");
        $item->setCustomName(TF::BOLD . TF::YELLOW . "Mystery Ultimate Enchant");
        $item->getNamedTag()->setInt("UltimateCustomEnchantBook", 2);
        $lore = [
            TF::EOL,
            TF::WHITE . "Contains an " . TF::BOLD . TF::YELLOW . "Ultimate",
            TF::RESET . TF::WHITE . "tier gear enchantment!",
            TF::EOL,
            TF::RESET . TF::GRAY . "Price: " . TF::BOLD . TF::WHITE . Translator::shortNumber(50000 * $count),
            TF::EOL,
            TF::RESET . TF::GRAY . "(Left-click to purchase)"
        ];
        $item->setCount($count);
        $item->setLore($lore);
        return $item;
    }
    public function generateLegendaryBookItem(int $count): Item {
        $item = CustomiesItemFactory::getInstance()->get("emporiumenchants:legendary_book");
        $item->setCustomName(TF::BOLD . TF::GOLD . "Mystery Legendary Enchant");
        $item->getNamedTag()->setInt("LegendaryCustomEnchantBook", 2);
        $lore = [
            TF::EOL,
            TF::WHITE . "Contains a " . TF::BOLD . TF::GOLD . "Legendary",
            TF::RESET . TF::WHITE . "tier gear enchantment!",
            TF::EOL,
            TF::RESET . TF::GRAY . "Price: " . TF::BOLD . TF::WHITE . Translator::shortNumber(100000 * $count),
            TF::EOL,
            TF::RESET . TF::GRAY . "(Left-click to purchase)"
        ];
        $item->setCount($count);
        $item->setLore($lore);
        return $item;
    }
    public function generateGodlyBookItem(int $count): Item {
        $item = CustomiesItemFactory::getInstance()->get("emporiumenchants:godly_book");
        $item->setCustomName(TF::BOLD . TF::LIGHT_PURPLE . "Mystery Godly Enchant");
        $item->getNamedTag()->setInt("GodlyCustomEnchantBook", 2);
        $lore = [
            TF::EOL,
            TF::WHITE . "Contains a " . TF::BOLD . TF::LIGHT_PURPLE . "Godly",
            TF::RESET . TF::WHITE . "tier gear enchantment!",
            TF::EOL,
            TF::RESET . TF::GRAY . "Price: " . TF::BOLD . TF::WHITE . Translator::shortNumber(250000 * $count),
            TF::EOL,
            TF::RESET . TF::GRAY . "(Left-click to purchase)"
        ];
        $item->setCount($count);
        $item->setLore($lore);
        return $item;
    }
    public function generateHeroicBookItem(int $count): Item {
        $item = CustomiesItemFactory::getInstance()->get("emporiumenchants:heroic_book");
        $item->setCustomName(TF::BOLD . TF::RED . "Mystery Heroic Enchant");
        $item->getNamedTag()->setInt("HeroicCustomEnchantBook", 2);
        $lore = [
            TF::EOL,
            TF::WHITE . "Contains a " . TF::BOLD . TF::RED . "Heroic",
            TF::RESET . TF::WHITE . "tier gear enchantment!",
            TF::EOL,
            TF::RESET . TF::GRAY . "Price: " . TF::BOLD . TF::WHITE . Translator::shortNumber(500000 * $count),
            TF::EOL,
            TF::RESET . TF::GRAY . "(Left-click to purchase)"
        ];
        $item->setCount($count);
        $item->setLore($lore);
        return $item;
    }
}