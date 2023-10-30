<?php

namespace EmporiumCore\Menus;

use Emporium\Prison\library\formapi\CustomForm;
use Emporium\Prison\library\formapi\SimpleForm;
use Emporium\Prison\Managers\misc\Translator;

use EmporiumData\DataManager;

use muqsit\invmenu\InvMenu;
use muqsit\invmenu\transaction\DeterministicInvMenuTransaction;
use muqsit\invmenu\type\InvMenuTypeIds;

use pocketmine\item\Item;
use pocketmine\item\VanillaItems;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;
use pocketmine\world\sound\ItemFrameAddItemSound;
use pocketmine\world\sound\XpCollectSound;

class Chef extends Menu {

    # form
    public function Form(Player $player): void {

        $form = new SimpleForm(function (Player $player, $data) {
            switch ($data) {

                case 0: # cookie
                    $this->cookiePurchase($player);
                    break;

                case 1: # apple
                    $this->applePurchase($player);
                    break;

                case 2: # pumpkin pie
                    $this->pumpkinPiePurchase($player);
                    break;

                case 3: # bread
                    $this->breadPurchase($player);
                    break;

                case 4: # cooked chicken
                    $this->cookedChickenPurchase($player);
                    break;

                case 5: # steak
                    $this->steakPurchase($player);
                    break;

                case 6: # golden carrot
                    $this->goldenCarrotPurchase($player);
                    break;
            }
            return true;
        });
        $form->setTitle("Chef");
        $form->addButton("Cookie\n" . TF::GREEN . "$" . TF::WHITE . "0.05");
        $form->addButton("Apple\n" . TF::GREEN . "$" . TF::WHITE . "0.25");
        $form->addButton("Pumpkin Pie\n" . TF::GREEN . "$" . TF::WHITE . "1");
        $form->addButton("Bread\n" . TF::GREEN . "$" . TF::WHITE . "2.50");
        $form->addButton("Cooked Chicken\n" . TF::GREEN . "$" . TF::WHITE . "5");
        $form->addButton("Steak\n" . TF::GREEN . "$" . TF::WHITE . "10");
        $form->addButton("Golden Carrot\n" . TF::GREEN . "$" . TF::WHITE . "25");
        $form->addButton("§cEXIT");
        $player->sendForm($form);
    }

    # sub forms
    public function cookiePurchase(Player $player): void {
        # get player balance
        $balance = DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.money");
        # create form
        $form = new CustomForm(function(Player $player, $data) use ($balance) {
            if ($data === null) {
                return;
            }
            # calculate price
            $price = 0.05 * $data[1];
            # purchase
            if ($balance >= $price) {
                $player->sendMessage(TF::BOLD . TF::GRAY . "(!) " . TF::RESET . TF::GRAY . "Purchased: " . TF::BOLD . TF::WHITE . "Cookie " . TF::RESET . TF::GRAY . "* " . TF::WHITE . $data[1]);
                DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.money") - $price);
                if($player->getInventory()->canAddItem(VanillaItems::COOKIE()->setCount($data[1]))) {
                    $player->getInventory()->addItem(VanillaItems::COOKIE()->setCount($data[1]));
                } else {
                    $player->getWorld()->dropItem($player->getPosition(), VanillaItems::COOKIE()->setCount($data[1]));
                }
                return;
            }
            $player->sendMessage(TF::GRAY . "You do not have enough money to purchase " . TF::AQUA . $data[1] . "x " . TF::BLUE . "Cookie");
        });
        $form->setTitle("Chef - Cookie");
        $form->addLabel(TF::GRAY . "Item: " . TF::WHITE . "Cookie" . TF::EOL . TF::GRAY . "Cost: " . TF::GREEN . "$" . TF::WHITE . "0.05 " . TF::GRAY . "per Cookie" . TF::EOL . TF::GRAY . "Your balance: " . TF::AQUA . Translator::shortNumber($balance));
        $form->addSlider(TF::GRAY . "Amount", 1, 64);
        $player->sendForm($form);
    }
    public function applePurchase(Player $player): void {
        # get player balance
        $balance = DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.money");
        # create form
        $form = new CustomForm(function(Player $player, $data) use ($balance) {
            if ($data === null) {
                return;
            }
            # calculate price
            $price = 0.25 * $data[1];
            # purchase
            if ($balance >= $price) {
                $player->sendMessage(TF::BOLD . TF::GRAY . "(!) " . TF::RESET . TF::GRAY . "Purchased: " . TF::BOLD . TF::WHITE . "Apple " . TF::RESET . TF::GRAY . "* " . TF::WHITE . $data[1]);
                DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.money") - $price);
                if($player->getInventory()->canAddItem(VanillaItems::APPLE()->setCount($data[1]))) {
                    $player->getInventory()->addItem(VanillaItems::APPLE()->setCount($data[1]));
                } else {
                    $player->getWorld()->dropItem($player->getPosition(), VanillaItems::APPLE()->setCount($data[1]));
                }
                return;
            }
            $player->sendMessage(TF::GRAY . "You do not have enough money to purchase " . TF::AQUA . $data[1] . "x " . TF::BLUE . "Apple");
        });
        $form->setTitle("Chef - Apple");
        $form->addLabel(TF::GRAY . "Item: " . TF::WHITE . "Apple" . TF::EOL . TF::GRAY . "Cost: " . TF::GREEN . "$" . TF::WHITE . "0.25 " . TF::GRAY . "per Apple" . TF::EOL . TF::GRAY . "Your balance: " . TF::AQUA . Translator::shortNumber($balance));
        $form->addSlider(TF::GRAY . "Amount", 1, 64);
        $player->sendForm($form);
    }
    public function pumpkinPiePurchase(Player $player): void {
        # get player balance
        $balance = DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.money");
        # create form
        $form = new CustomForm(function(Player $player, $data) use ($balance) {
            if ($data === null) {
                return;
            }
            # calculate price
            $price = 1 * $data[1];
            # purchase
            if ($balance >= $price) {
                $player->sendMessage(TF::BOLD . TF::GRAY . "(!) " . TF::RESET . TF::GRAY . "Purchased: " . TF::BOLD . TF::WHITE . "Pumpkin Pie " . TF::RESET . TF::GRAY . "* " . TF::WHITE . $data[1]);
                DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.money") - $price);
                if($player->getInventory()->canAddItem(VanillaItems::PUMPKIN_PIE()->setCount($data[1]))) {
                    $player->getInventory()->addItem(VanillaItems::PUMPKIN_PIE()->setCount($data[1]));
                } else {
                    $player->getWorld()->dropItem($player->getPosition(), VanillaItems::PUMPKIN_PIE()->setCount($data[1]));
                }
                return;
            }
            $player->sendMessage(TF::GRAY . "You do not have enough money to purchase " . TF::AQUA . $data[1] . "x " . TF::BLUE . "Pumpkin Pie");
        });
        $form->setTitle("Chef - Pumpkin Pie");
        $form->addLabel(TF::GRAY . "Item: " . TF::WHITE . "Pumpkin Pie" . TF::EOL . TF::GRAY . "Cost: " . TF::GREEN . "$" . TF::WHITE . "1 " . TF::GRAY . "per Pumpkin Pie" . TF::EOL . TF::GRAY . "Your balance: " . TF::AQUA . Translator::shortNumber($balance));
        $form->addSlider(TF::GRAY . "Amount", 1, 64);
        $player->sendForm($form);
    }
    public function breadPurchase(Player $player): void {
        # get player balance
        $balance = DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.money");
        # create form
        $form = new CustomForm(function(Player $player, $data) use ($balance) {
            if ($data === null) {
                return;
            }
            # calculate price
            $price = 2.50 * $data[1];
            # purchase
            if ($balance >= $price) {
                $player->sendMessage(TF::BOLD . TF::GRAY . "(!) " . TF::RESET . TF::GRAY . "Purchased: " . TF::BOLD . TF::WHITE . "Bread " . TF::RESET . TF::GRAY . "* " . TF::WHITE . $data[1]);
                DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.money") - $price);
                if($player->getInventory()->canAddItem(VanillaItems::BREAD()->setCount($data[1]))) {
                    $player->getInventory()->addItem(VanillaItems::BREAD()->setCount($data[1]));
                } else {
                    $player->getWorld()->dropItem($player->getPosition(), VanillaItems::BREAD()->setCount($data[1]));
                }
                return;
            }
            $player->sendMessage(TF::GRAY . "You do not have enough money to purchase " . TF::AQUA . $data[1] . "x " . TF::BLUE . "Bread");
        });
        $form->setTitle("Chef - Bread");
        $form->addLabel(TF::GRAY . "Item: " . TF::WHITE . "Bread" . TF::EOL . TF::GRAY . "Cost: " . TF::GREEN . "$" . TF::WHITE . "2.50 " . TF::GRAY . "per Bread" . TF::EOL . TF::GRAY . "Your balance: " . TF::AQUA . Translator::shortNumber($balance));
        $form->addSlider(TF::GRAY . "Amount", 1, 64);
        $player->sendForm($form);
    }
    public function cookedChickenPurchase(Player $player): void {
        # get player balance
        $balance = DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.money");
        # create form
        $form = new CustomForm(function(Player $player, $data) use ($balance) {
            if ($data === null) {
                return;
            }
            # calculate price
            $price = 5 * $data[1];
            # purchase
            if ($balance >= $price) {
                $player->sendMessage(TF::BOLD . TF::GRAY . "(!) " . TF::RESET . TF::GRAY . "Purchased: " . TF::BOLD . TF::WHITE . "Bread " . TF::RESET . TF::GRAY . "* " . TF::WHITE . $data[1]);
                DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.money") - $price);
                if($player->getInventory()->canAddItem(VanillaItems::COOKED_CHICKEN()->setCount($data[1]))) {
                    $player->getInventory()->addItem(VanillaItems::COOKED_CHICKEN()->setCount($data[1]));
                } else {
                    $player->getWorld()->dropItem($player->getPosition(), VanillaItems::COOKED_CHICKEN()->setCount($data[1]));
                }
                return;
            }
            $player->sendMessage(TF::GRAY . "You do not have enough money to purchase " . TF::AQUA . $data[1] . "x " . TF::BLUE . "Cooked Chicken");
        });
        $form->setTitle("Chef - Cooked Chicken");
        $form->addLabel(TF::GRAY . "Item: " . TF::WHITE . "Cooked Chicken" . TF::EOL . TF::GRAY . "Cost: " . TF::GREEN . "$" . TF::WHITE . "5 " . TF::GRAY . "per Cooked Chicken" . TF::EOL . TF::GRAY . "Your balance: " . TF::AQUA . Translator::shortNumber($balance));
        $form->addSlider(TF::GRAY . "Amount", 1, 64);
        $player->sendForm($form);
    }
    public function steakPurchase(Player $player): void {
        # get player balance
        $balance = DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.money");
        # create form
        $form = new CustomForm(function(Player $player, $data) use ($balance) {
            if ($data === null) {
                return;
            }
            # calculate price
            $price = 10 * $data[1];
            # purchase
            if ($balance >= $price) {
                $player->sendMessage(TF::BOLD . TF::GRAY . "(!) " . TF::RESET . TF::GRAY . "Purchased: " . TF::BOLD . TF::WHITE . "Steak " . TF::RESET . TF::GRAY . "* " . TF::WHITE . $data[1]);
                DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.money") - $price);
                if($player->getInventory()->canAddItem(VanillaItems::STEAK()->setCount($data[1]))) {
                    $player->getInventory()->addItem(VanillaItems::STEAK()->setCount($data[1]));
                } else {
                    $player->getWorld()->dropItem($player->getPosition(), VanillaItems::STEAK()->setCount($data[1]));
                }
                return;
            }
            $player->sendMessage(TF::GRAY . "You do not have enough money to purchase " . TF::AQUA . $data[1] . "x " . TF::BLUE . "Steak");
        });
        $form->setTitle("Chef - Steak");
        $form->addLabel(TF::GRAY . "Item: " . TF::WHITE . "Steak" . TF::EOL . TF::GRAY . "Cost: " . TF::GREEN . "$" . TF::WHITE . "5 " . TF::GRAY . "per Steak" . TF::EOL . TF::GRAY . "Your balance: " . TF::AQUA . Translator::shortNumber($balance));
        $form->addSlider(TF::GRAY . "Amount", 1, 64);
        $player->sendForm($form);
    }
    public function goldenCarrotPurchase(Player $player): void {
        # get player balance
        $balance = DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.money");
        # create form
        $form = new CustomForm(function(Player $player, $data) use ($balance) {
            if ($data === null) {
                return;
            }
            # calculate price
            $price = 25 * $data[1];
            # purchase
            if ($balance >= $price) {
                $player->sendMessage(TF::BOLD . TF::GRAY . "(!) " . TF::RESET . TF::GRAY . "Purchased: " . TF::BOLD . TF::WHITE . "Golden Carrot " . TF::RESET . TF::GRAY . "* " . TF::WHITE . $data[1]);
                DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.money") - $price);
                if($player->getInventory()->canAddItem(VanillaItems::GOLDEN_CARROT()->setCount($data[1]))) {
                    $player->getInventory()->addItem(VanillaItems::GOLDEN_CARROT()->setCount($data[1]));
                } else {
                    $player->getWorld()->dropItem($player->getPosition(), VanillaItems::GOLDEN_CARROT()->setCount($data[1]));
                }
                return;
            }
            $player->sendMessage(TF::GRAY . "You do not have enough money to purchase " . TF::AQUA . $data[1] . "x " . TF::BLUE . "Golden Carrot");
        });
        $form->setTitle("Chef - Golden Carrot");
        $form->addLabel(TF::GRAY . "Item: " . TF::WHITE . "Golden Carrot" . TF::EOL . TF::GRAY . "Cost: " . TF::GREEN . "$" . TF::WHITE . "25 " . TF::GRAY . "per Golden Carrot" . TF::EOL . TF::GRAY . "Your balance: " . TF::AQUA . Translator::shortNumber($balance));
        $form->addSlider(TF::GRAY . "Amount", 1, 64);
        $player->sendForm($form);
    }

    # inventory
    public function Inventory($player): void {
        $menu = InvMenu::create(InvMenuTypeIds::TYPE_CHEST);
        $menu->setName(TF::BOLD . "Food");
        $menu->setListener(InvMenu::readonly(function (DeterministicInvMenuTransaction $transaction) {

            $player = $transaction->getPlayer();
            $itemClicked = $transaction->getItemClicked();
            $playerMoney = DataManager::getInstance()->getPlayerData($player->getXuid(), "profile.money");
            switch($itemClicked->getTypeId()) {

                case VanillaItems::COOKIE()->getTypeId():
                    if($playerMoney >= 0.05) {
                        if($player->getInventory()->canAddItem(VanillaItems::COOKIE())) {
                            $player->getInventory()->addItem(VanillaItems::COOKIE());
                            $player->sendMessage(TF::RED . "- $0.05");
                            DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 0.05);
                            $player->broadcastSound(new XpCollectSound(), [$player]);
                        } else {
                            $player->sendMessage(TF::RED . "Your inventory is full");
                            $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                        }
                    } else {
                        $player->sendMessage(TF::RED . "Insufficient funds");
                        $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    }
                    break;

                case VanillaItems::APPLE()->getTypeId():
                    if($playerMoney >= 0.25) {
                        if($player->getInventory()->canAddItem(VanillaItems::APPLE())) {
                            $player->getInventory()->addItem(VanillaItems::APPLE());
                            $player->sendMessage(TF::RED . "- $0.25");
                            DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 0.25);
                            $player->broadcastSound(new XpCollectSound(), [$player]);
                        } else {
                            $player->sendMessage(TF::RED . "Your inventory is full");
                            $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                        }
                    } else {
                        $player->sendMessage(TF::RED . "Insufficient funds");
                        $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    }
                    break;

                case VanillaItems::PUMPKIN_PIE()->getTypeId():
                    if($playerMoney >= 1) {
                        if($player->getInventory()->canAddItem(VanillaItems::PUMPKIN_PIE())) {
                            $player->getInventory()->addItem(VanillaItems::PUMPKIN_PIE());
                            $player->sendMessage(TF::RED . "- $1");
                            DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 1);
                            $player->broadcastSound(new XpCollectSound(), [$player]);
                        } else {
                            $player->sendMessage(TF::RED . "Your inventory is full");
                            $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                        }
                    } else {
                        $player->sendMessage(TF::RED . "Insufficient funds");
                        $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    }
                    break;

                case VanillaItems::BREAD()->getTypeId():
                    if($playerMoney >= 0.25) {
                        if($player->getInventory()->canAddItem(VanillaItems::BREAD())) {
                            $player->getInventory()->addItem(VanillaItems::BREAD());
                            $player->sendMessage(TF::RED . "- $2.50");
                            DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 2.50);
                            $player->broadcastSound(new XpCollectSound(), [$player]);
                        } else {
                            $player->sendMessage(TF::RED . "Your inventory is full");
                            $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                        }
                    } else {
                        $player->sendMessage(TF::RED . "Insufficient funds");
                        $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    }
                    break;

                case VanillaItems::COOKED_CHICKEN()->getTypeId():
                    if($playerMoney >= 5) {
                        if($player->getInventory()->canAddItem(VanillaItems::COOKED_CHICKEN())) {
                            $player->getInventory()->addItem(VanillaItems::COOKED_CHICKEN());
                            $player->sendMessage(TF::RED . "- $5");
                            DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 5);
                            $player->broadcastSound(new XpCollectSound(), [$player]);
                        } else {
                            $player->sendMessage(TF::RED . "Your inventory is full");
                            $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                        }
                    } else {
                        $player->sendMessage(TF::RED . "Insufficient funds");
                        $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    }
                    break;

                case VanillaItems::STEAK()->getTypeId():
                    if($playerMoney >= 10) {
                        if($player->getInventory()->canAddItem(VanillaItems::STEAK())) {
                            $player->getInventory()->addItem(VanillaItems::STEAK());
                            $player->sendMessage(TF::RED . "- $10");
                            DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 10);
                            $player->broadcastSound(new XpCollectSound(), [$player]);
                        } else {
                            $player->sendMessage(TF::RED . "Your inventory is full");
                            $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                        }
                    } else {
                        $player->sendMessage(TF::RED . "Insufficient funds");
                        $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    }
                    break;

                case VanillaItems::GOLDEN_CARROT()->getTypeId():
                    if($playerMoney >= 25) {
                        if($player->getInventory()->canAddItem(VanillaItems::GOLDEN_CARROT())) {
                            $player->getInventory()->addItem(VanillaItems::GOLDEN_CARROT());
                            $player->sendMessage(TF::RED . "- $25");
                            DataManager::getInstance()->setPlayerData($player->getXuid(), "profile.money", 25);
                            $player->broadcastSound(new XpCollectSound(), [$player]);
                        } else {
                            $player->sendMessage(TF::RED . "Your inventory is full");
                            $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                        }
                    } else {
                        $player->sendMessage(TF::RED . "Insufficient funds");
                        $player->broadcastSound(new ItemFrameAddItemSound(), [$player]);
                    }
                    break;
            }
        }));
        $inventory = $menu->getInventory();
        $inventory->setItem(10, $this->cookie());
        $inventory->setItem(11, $this->apple());
        $inventory->setItem(12, $this->pumpkinPie());
        $inventory->setItem(13, $this->bread());
        $inventory->setItem(14, $this->cookedChicken());
        $inventory->setItem(15, $this->steak());
        $inventory->setItem(16, $this->goldenCarrot());
        $menu->send($player);
    }

    # chef items
    public function cookie(): Item {
        $item = VanillaItems::COOKIE();
        $lore = [
            TF::EOL,
            TF::GREEN . "$0.05",
            "",
            TF::GRAY . "Click to buy 1"
        ];
        $item->setLore($lore);

        return $item;
    }
    public function apple(): Item {
        $item = VanillaItems::APPLE();
        $lore = [
            TF::EOL,
            TF::GREEN . "$0.25",
            "",
            TF::GRAY . "Click to buy 1"
        ];
        $item->setLore($lore);

        return $item;
    }
    public function pumpkinPie(): Item {
        $item = VanillaItems::PUMPKIN_PIE();
        $lore = [
            TF::EOL,
            TF::GREEN . "$1",
            "",
            TF::GRAY . "Click to buy 1"
        ];
        $item->setLore($lore);

        return $item;
    }
    public function bread(): Item {
        $item = VanillaItems::BREAD();
        $lore = [
            TF::EOL,
            TF::GREEN . "$2.50",
            "",
            TF::GRAY . "Click to buy 1"
        ];
        $item->setLore($lore);

        return $item;
    }
    public function cookedChicken(): Item {
        $item = VanillaItems::COOKED_CHICKEN();
        $lore = [
            TF::EOL,
            TF::GREEN . "$5",
            "",
            TF::GRAY . "Click to buy 1"
        ];
        $item->setLore($lore);

        return $item;
    }
    public function steak(): Item {
        $item = VanillaItems::STEAK();
        $lore = [
            TF::EOL,
            TF::GREEN . "$10",
            "",
            TF::GRAY . "Click to buy 1"
        ];
        $item->setLore($lore);

        return $item;
    }
    public function goldenCarrot(): Item {
        $item = VanillaItems::GOLDEN_CARROT();
        $lore = [
            TF::EOL,
            TF::GREEN . "$25",
            "",
            TF::GRAY . "Click to buy 1"
        ];
        $item->setLore($lore);

        return $item;
    }

}