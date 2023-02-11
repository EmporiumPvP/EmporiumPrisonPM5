<?php

namespace EmporiumCore\Commands\Default;

use Emporium\Prison\library\formapi\CustomForm;
use Emporium\Prison\library\formapi\SimpleForm;
use EmporiumCore\Variables;
use pocketmine\player\Player;
use pocketmine\item\ItemFactory;
use pocketmine\command\{Command, CommandSender};

use EmporiumCore\Managers\Data\DataManager;
use pocketmine\utils\TextFormat;

class ShopCommand extends Command {

    public function __construct() {
        parent::__construct("shop", "Purchase items from the shop.", "/shop", ["market", "store"]);
        $this->setPermission("emporiumcore.command.shop");
    }

    # Command Code
    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {

        if(!$sender instanceof Player) {
            return false;
        }

        $permission = DataManager::getData($sender, "Permissions", "emporiumcore.command.shop");
        if ($permission === false) {
            $sender->sendMessage(TextFormat::RED . "No permission");
            return false;
        }

        $this->ShopMenu($sender);
        return true;
    }

    # Purchase Item
    public function PurchaseItem($player, $op, $id, $meta) {
        $form = new CustomForm(function($player, $data) use($op, $id, $meta) {
            if ($data === null) {
                return;
            }
            // Variables
            $balance = DataManager::getData($player, "Players", "Money");
            $price = $op * $data[1];
            $item = ItemFactory::getInstance()->get($id, $meta, $data[1]);
            // Purchase
            if ($balance >= $price) {
                DataManager::takeData($player, "Players", "Money", $price);
                // Give Item
                foreach ($player->getInventory()->addItem($item) as $invfull) {
                    $player->getWorld()->dropItem($player->getPosition(), $invfull);
                }
                // Confirm
                $player->sendMessage(Variables::SERVER_PREFIX . "§r§7You have purchased §e{$data[1]}x {$item->getName()}§7 for $" . $price . ".");
                return;
            }
            $player->sendMessage(Variables::ERROR_PREFIX . "§r§7You do not have enough money to purchase §e{$data[1]}x {$item->getName()}§7.");
        });
        $item = ItemFactory::getInstance()->get($id, $meta);
        $form->setTitle("§l§9Shop Menu");
        $form->addLabel("§3Item: §b{$item->getName()}\n§6Cost: §e$" . $op . " per Item");
        $form->addSlider("§7Amount", 1, 128);
        $player->sendForm($form);
    }

    # Convert Currency
    public function Convert($player, $c1, $c2, $price, $amount) {
        $form = new CustomForm(function($player, $data) use($c1, $c2, $price, $amount) {
            if ($data === null) {
                return;
            }
            if (!is_numeric($data[1])) {
                $player->sendMessage(Variables::ERROR_PREFIX . "§r§7Please enter only numbers for the amount you're converting.");
                return;
            }
            // Check Converters
            if ($c1 === "EXP" || $c2 === "EXP") {
                // Variables
                if ($c1 === "Money") {
                    $current = DataManager::getData($player, "Players", $c1);
                } else {
                    $current = $player->getXpManager()->getCurrentTotalXp();
                }
                if ($data[1] <= 0) {
                    $player->sendMessage(Variables::ERROR_PREFIX . "§r§7You can only convert values above 0.");
                    return;
                }
                $price = $price * $data[1];
                $amount = $amount * $data[1];
                // Purchase
                if ($current >= $price) {
                    // Convert
                    if ($c1 === "Money") {
                        DataManager::takeData($player, "Players", "{$c1}", $price);
                        $player->getXpManager()->addXp($amount);
                    } else {
                        $player->getXpManager()->subtractXp($price);
                        DataManager::addData($player, "Players", "{$c2}", $amount);
                    }
                    // Confirm
                    $player->sendMessage(Variables::SERVER_PREFIX . "§r§7You have converted §e{$price} {$c1}§7 to §e{$data[1]} {$c2}§7.");
                    return;
                }
                $player->sendMessage(Variables::ERROR_PREFIX . "§r§7You do not have enough {$c1} to convert it to §e{$amount}x {$c2}§7.");
            } else {
                // Variables
                $current = DataManager::getData($player, "Players", $c1);
                if ($data[1] <= 0) {
                    $player->sendMessage(Variables::ERROR_PREFIX . "§r§7You can only convert values above 0.");
                    return;
                }
                $price = $price * $data[1];
                $amount = $amount * $data[1];
                // Purchase
                if ($current >= $price) {
                    // Convert
                    DataManager::takeData($player, "Players", "{$c1}", $price);
                    DataManager::addData($player, "Players", "{$c2}", $amount);
                    // Confirm
                    $player->sendMessage(Variables::SERVER_PREFIX . "§r§7You have converted §e{$price} {$c1}§7 to §e{$amount} {$c2}§7.");
                    return;
                }
                $player->sendMessage(Variables::ERROR_PREFIX . "§r§7You do not have enough {$c1} to convert it to §e{$amount}x {$c2}§7.");
            }
        });
        $form->setTitle("§l§9Shop Menu");
        $form->addLabel("§3Currency: §b{$c2}\n§6Cost: §e{$price} {$c1} per {$amount}x {$c2}");
        $form->addInput("§7Amount");
        $player->sendForm($form);
    }

    # Shop Menu
    public function ShopMenu($player) {
        $form = new SimpleForm(function($player, $data) {
            if ($data === null) {
                return;
            }
            switch($data) {
                case 0:
                    $this->BlocksMenu($player);
                    break;
                case 1:
                    $this->ItemsMenu($player);
                    break;
                case 2:
                    $this->FarmingMenu($player);
                    break;
                case 3:
                    $this->RaidingMenu($player);
                    break;
                case 4:
                    $this->FoodMenu($player);
                    break;
                case 5:
                    $this->ConverterMenu($player);
                    break;
                case 6:
                    break;
            }
        });
        $form->setTitle("§l§9Shop Menu");
        $form->setContent("§7Select the category that you would like to purchase an item in.");
        $form->addButton("§9Blocks");
        $form->addButton("§9Items");
        $form->addButton("§9Farming");
        $form->addButton("§9Raiding");
        $form->addButton("§9Food");
        $form->addButton("§9Converters");
        $form->addButton("§4Close");
        $player->sendForm($form);
    }

    # Blocks Menu
    public function BlocksMenu($player) {
        $form = new SimpleForm(function($player, $data) {
            if ($data === null) {
                return;
            }
            switch($data) {
                case 0:
                    $this->PurchaseItem($player, 20, 2, 0);
                    break;
                case 1:
                    $this->PurchaseItem($player, 20, 3, 0);
                    break;
                case 2:
                    $this->PurchaseItem($player, 30, 3, 1);
                    break;
                case 3:
                    $this->PurchaseItem($player, 20, 1, 0);
                    break;
                case 4:
                    $this->PurchaseItem($player, 10, 4, 0);
                    break;
                case 5:
                    $this->PurchaseItem($player, 50, 98, 0);
                    break;
                case 6:
                    $this->PurchaseItem($player, 75, -183, 0);
                    break;
                case 7:
                    $this->PurchaseItem($player, 10, 13, 0);
                    break;
                case 8:
                    $this->PurchaseItem($player, 10, 12, 0);
                    break;
                case 9:
                    $this->PurchaseItem($player, 20, 12, 1);
                    break;
                case 10:
                    $this->PurchaseItem($player, 30, 24, 0);
                    break;
                case 11:
                    $this->PurchaseItem($player, 60, 179, 0);
                    break;
                case 12:
                    $this->PurchaseItem($player, 50, 20, 0);
                    break;
                case 13:
                    $this->PurchaseItem($player, 50, 168, 0);
                    break;
                case 14:
                    $this->PurchaseItem($player, 100, 168, 2);
                    break;
                case 15:
                    $this->PurchaseItem($player, 100, 168, 1);
                    break;
                case 16:
                    $this->PurchaseItem($player, 5000, 10, 0);
                    break;
                case 17:
                    $this->PurchaseItem($player, 3000, 8, 0);
                    break;
                case 18:
                    $this->PurchaseItem($player, 40, 17, 0);
                    break;
                case 19:
                    $this->PurchaseItem($player, 40, 17, 1);
                    break;
                case 20:
                    $this->PurchaseItem($player, 40, 17, 2);
                    break;
                case 21:
                    $this->PurchaseItem($player, 40, 17, 3);
                    break;
                case 22:
                    $this->PurchaseItem($player, 40, 162, 0);
                    break;
                case 23:
                    $this->PurchaseItem($player, 40, 162, 1);
                    break;
                case 24:
                    $this->PurchaseItem($player, 30, 18, 0);
                    break;
                case 25:
                    $this->PurchaseItem($player, 30, 18, 1);
                    break;
                case 26:
                    $this->PurchaseItem($player, 30, 18, 2);
                    break;
                case 27:
                    $this->PurchaseItem($player, 30, 18, 3);
                    break;
                case 28:
                    $this->PurchaseItem($player, 30, 161, 0);
                    break;
                case 29:
                    $this->PurchaseItem($player, 30, 161, 1);
                    break;
                case 30:
                    $this->PurchaseItem($player, 30, 45, 0);
                    break;
                case 31:
                    $this->PurchaseItem($player, 50, 201, 0);
                    break;
                case 32:
                    $this->PurchaseItem($player, 100, 19, 0);
                    break;
                case 33:
                    $this->PurchaseItem($player, 100, 79, 0);
                    break;
                case 34:
                    $this->PurchaseItem($player, 50, 80, 0);
                    break;
                case 35:
                    $this->PurchaseItem($player, 300, 155, 0);
                    break;
                case 36:
                    $this->PurchaseItem($player, 200, 112, 0);
                    break;
                case 37:
                    $this->PurchaseItem($player, 200, 214, 0);
                    break;
                case 38:
                    $this->PurchaseItem($player, 1000, 213, 0);
                    break;
                case 39:
                    $this->PurchaseItem($player, 20, 87, 0);
                    break;
                case 40:
                    $this->PurchaseItem($player, 500, 88, 0);
                    break;
                case 41:
                    $this->PurchaseItem($player, 2000, 49, 0);
                    break;
                case 42:
                    $this->PurchaseItem($player, 60, 121, 0);
                    break;
                case 43:
                    $this->PurchaseItem($player, 120, 206, 0);
                    break;
                case 44:
                    $this->ShopMenu($player);
                    break;
            }
        });
        $form->setTitle("§l§9Shop Menu");
        $form->setContent("§7Select the item you would like to purchase.");
        $form->addButton("§9Grass\n§e$20");
        $form->addButton("§9Dirt\n§e$10");
        $form->addButton("§9Coarse Dirt\n§e$30");
        $form->addButton("§9Stone\n§e$20");
        $form->addButton("§9Cobblestone\n§e$10");
        $form->addButton("§9Stone Bricks\n§e$50");
        $form->addButton("§9Smooth Stone\n§e$75");
        $form->addButton("§9Gravel\n§e$10");
        $form->addButton("§9Sand\n§e$10");
        $form->addButton("§9Red Sand\n§e$20");
        $form->addButton("§9Sandstone\n§e$30");
        $form->addButton("§9Red Sandstone\n§e$60");
        $form->addButton("§9Glass\n§e$50");
        $form->addButton("§9Prismarine\n§e$50");
        $form->addButton("§9Prismarine Bricks\n§e$100");
        $form->addButton("§9Dark Prismarine\n§e$100");
        $form->addButton("§9Lava\n§e$5000");
        $form->addButton("§9Water\n§e$3000");
        $form->addButton("§9Oak Log\n§e$40");
        $form->addButton("§9Spruce Log\n§e$40");
        $form->addButton("§9Birch Log\n§e$40");
        $form->addButton("§9Jungle Log\n§e$40");
        $form->addButton("§9Acacia Log\n§e$40");
        $form->addButton("§9Dark Oak Log\n§e$40");
        $form->addButton("§9Oak Leaves\n§e$30");
        $form->addButton("§9Spruce Leaves\n§e$30");
        $form->addButton("§9Birch Leaves\n§e$30");
        $form->addButton("§9Jungle Leaves\n§e$30");
        $form->addButton("§9Acacia Leaves\n§e$30");
        $form->addButton("§9Dark Oak Leaves\n§e$30");
        $form->addButton("§9Brick Block\n§e$30");
        $form->addButton("§9Purpur Block\n§e$50");
        $form->addButton("§9Sponge\n§e$100");
        $form->addButton("§9Ice\n§e$100");
        $form->addButton("§9Snow\n§e$50");
        $form->addButton("§9Block of Quartz\n§e$300");
        $form->addButton("§9Nether Brick Block\n§e$200");
        $form->addButton("§9Nether Wart Block\n§e$200");
        $form->addButton("§9Magma Block\n§e$1000");
        $form->addButton("§9Netherrack\n§e$20");
        $form->addButton("§9Soul Sand\n§e$500");
        $form->addButton("§9Obsidian\n§e$2000");
        $form->addButton("§9End Stone\n§e$60");
        $form->addButton("§9End Stone Bricks\n§e$120");
        $form->addButton("§cBack");
        $player->sendForm($form);
    }

    # Items Menu
    public function ItemsMenu($player) {
        $form = new SimpleForm(function($player, $data) {
            if ($data === null) {
                return;
            }
            switch($data) {
                case 0:
                    $this->PurchaseItem($player, 200, 54, 0);
                    break;
                case 1:
                    $this->PurchaseItem($player, 1000, -203, 0);
                    break;
                case 2:
                    $this->PurchaseItem($player, 200, 123, 0);
                    break;
                case 3:
                    $this->PurchaseItem($player, 300, 89, 0);
                    break;
                case 4:
                    $this->PurchaseItem($player, 300, 169, 0);
                    break;
                case 5:
                    $this->PurchaseItem($player, 10000, 138, 0);
                    break;
                case 6:
                    $this->PurchaseItem($player, 100, 208, 0);
                    break;
                case 7:
                    $this->PurchaseItem($player, 100, 58, 0);
                    break;
                case 8:
                    $this->PurchaseItem($player, 100, 61, 0);
                    break;
                case 9:
                    $this->PurchaseItem($player, 300, 379, 0);
                    break;
                case 10:
                    $this->PurchaseItem($player, 500, 145, 0);
                    break;
                case 11:
                    $this->PurchaseItem($player, 1000, 116, 0);
                    break;
                case 12:
                    $this->PurchaseItem($player, 250, 47, 0);
                    break;
                case 13:
                    $this->PurchaseItem($player, 750, -194, 0);
                    break;
                case 14:
                    $this->PurchaseItem($player, 500, 25, 0);
                    break;
                case 15:
                    $this->PurchaseItem($player, 500, -206, 0);
                    break;
                case 16:
                    $this->PurchaseItem($player, 50, 390, 0);
                    break;
                case 17:
                    $this->PurchaseItem($player, 100, 323, 0);
                    break;
                case 18:
                    $this->PurchaseItem($player, 10000, 410, 0);
                    break;
                case 19:
                    $this->ShopMenu($player);
                    break;
            }
        });
        $form->setTitle("§l§9Shop Menu");
        $form->setContent("§7Select the item you would like to purchase.");
        $form->addButton("§9Chest\n§e$200");
        $form->addButton("§9Barrel\n§e$1000");
        $form->addButton("§9Redstone Lamp\n§e$200");
        $form->addButton("§9Glowstone\n§e$300");
        $form->addButton("§9Sea Lantern\n§e$300");
        $form->addButton("§9Beacon\n§e$10000");
        $form->addButton("§9End Rod\n§e$100");
        $form->addButton("§9Crafting Table\n§e$100");
        $form->addButton("§9Furnace\n§e$100");
        $form->addButton("§9Brewing Stand\n§e$300");
        $form->addButton("§9Anvil\n§e$500");
        $form->addButton("§9Enchanting Table\n§e$1000");
        $form->addButton("§9Bookshelf\n§e$250");
        $form->addButton("§9Lectern\n§e$750");
        $form->addButton("§9Note Block\n§e$500");
        $form->addButton("§9Bell\n§e$500");
        $form->addButton("§9Flower Pot\n§e$50");
        $form->addButton("§9Sign\n§e$100");
        $form->addButton("§9Hopper\n§e$10000");
        $form->addButton("§cBack");
        $player->sendForm($form);
    }

    # Farming Menu
    public function FarmingMenu($player) {
        $form = new SimpleForm(function($player, $data) {
            if ($data === null) {
                return;
            }
            switch($data) {
                case 0:
                    $this->PurchaseItem($player, 500, 295, 0);
                    break;
                case 1:
                    $this->PurchaseItem($player, 1000, 458, 0);
                    break;
                case 2:
                    $this->PurchaseItem($player, 5000, 392, 0);
                    break;
                case 3:
                    $this->PurchaseItem($player, 5000, 391, 0);
                    break;
                case 4:
                    $this->PurchaseItem($player, 10000, 362, 0);
                    break;
                case 5:
                    $this->PurchaseItem($player, 20000, 361, 0);
                    break;
                case 6:
                    $this->ShopMenu($player);
                    break;
            }
        });
        $form->setTitle("§l§9Shop Menu");
        $form->setContent("§7Select the item you would like to purchase.");
        $form->addButton("§9Wheat Seeds\n§e$500");
        $form->addButton("§9Beetroot Seeds\n§e$1000");
        $form->addButton("§9Potato\n§e$5000");
        $form->addButton("§9Carrot\n§e$5000");
        $form->addButton("§9Melon Seeds\n§e$10000");
        $form->addButton("§9Pumpkin Seeds\n§e$20000");
        $form->addButton("§cBack");
        $player->sendForm($form);
    }

    # Raiding Menu
    public function RaidingMenu($player) {
        $form = new SimpleForm(function($player, $data) {
            if ($data === null) {
                return;
            }
            switch($data) {
                case 0:
                    $this->PurchaseItem($player, 1000, 368, 0);
                    break;
                case 1:
                    $this->PurchaseItem($player, 500, 332, 0);
                    break;
                case 2:
                    $this->PurchaseItem($player, 100, 262, 0);
                    break;
                case 3:
                    $this->PurchaseItem($player, 10000, 261, 0);
                    break;
                case 4:
                    $this->PurchaseItem($player, 10000, 346, 0);
                    break;
                case 5:
                    $this->ShopMenu($player);
                    break;
            }
        });
        $form->setTitle("§l§9Shop Menu");
        $form->setContent("§7Select the item you would like to purchase.");
        $form->addButton("§9Ender Pearl\n§e$1000");
        $form->addButton("§9Snowball\n§e$500");
        $form->addButton("§9Arrow\n§e$100");
        $form->addButton("§9Bow\n§e$10000");
        $form->addButton("§9Fishing Rod\n§e$10000");
        $form->addButton("§cBack");
        $player->sendForm($form);
    }

    # Food Menu
    public function FoodMenu($player) {
        $form = new SimpleForm(function($player, $data) {
            if ($data === null) {
                return;
            }
            switch($data) {
                case 0:
                    $this->PurchaseItem($player, 100, 366, 0);
                    break;
                case 1:
                    $this->PurchaseItem($player, 100, 320, 0);
                    break;
                case 2:
                    $this->PurchaseItem($player, 100, 364, 0);
                    break;
                case 3:
                    $this->PurchaseItem($player, 100, 424, 0);
                    break;
                case 4:
                    $this->PurchaseItem($player, 100, 412, 0);
                    break;
                case 5:
                    $this->PurchaseItem($player, 100, 350, 0);
                    break;
                case 6:
                    $this->PurchaseItem($player, 100, 463, 0);
                    break;
                case 7:
                    $this->PurchaseItem($player, 100, 297, 0);
                    break;
                case 8:
                    $this->PurchaseItem($player, 200, 393, 0);
                    break;
                case 9:
                    $this->PurchaseItem($player, 200, 357, 0);
                    break;
                case 10:
                    $this->PurchaseItem($player, 300, 400, 0);
                    break;
                case 11:
                    $this->PurchaseItem($player, 50000, 354, 0);
                    break;
                case 12:
                    $this->PurchaseItem($player, 10000, 322, 0);
                    break;
                case 13:
                    $this->PurchaseItem($player, 200000, 466, 0);
                    break;
                case 14:
                    $this->ShopMenu($player);
                    break;
            }
        });
        $form->setTitle("§l§9Shop Menu");
        $form->setContent("§7Select the item you would like to purchase.");
        $form->addButton("§9Cooked Chicken\n§e$100");
        $form->addButton("§9Cooked Porkchop\n§e$100");
        $form->addButton("§9Cooked Beef\n§e$100");
        $form->addButton("§9Cooked Mutton\n§e$100");
        $form->addButton("§9Cooked Rabbit\n§e$100");
        $form->addButton("§9Cooked Cod\n§e$100");
        $form->addButton("§9Cooked Salmon\n§e$100");
        $form->addButton("§9Bread\n§e$100");
        $form->addButton("§9Baked Potato\n§e$200");
        $form->addButton("§9Cookie\n§e$200");
        $form->addButton("§9Pumpkin Pie\n§e$300");
        $form->addButton("§9Cake\n§e$50000");
        $form->addButton("§9Golden Apple\n§e$10000");
        $form->addButton("§9Enchanted Golden Apple\n§e$200000");
        $form->addButton("§cBack");
        $player->sendForm($form);
    }

    # Converter Menu
    public function ConverterMenu($player) {
        $form = new SimpleForm(function($player, $data) {
            if ($data === null) {
                return;
            }
            switch($data) {
                case 0:
                    $this->Convert($player, "Money", "EXP", 1, 1);
                    break;
                case 1:
                    $this->Convert($player, "EXP", "Money", 1, 1);
                    break;
                case 2:
                    $this->Convert($player, "Money", "Elixir", 100, 1);
                    break;
                case 3:
                    $this->Convert($player, "Elixir", "Money", 1, 100);
                    break;
                case 4:
                    $this->Convert($player, "Money", "Crystal", 100000, 1);
                    break;
                case 5:
                    $this->Convert($player, "Crystal", "Money", 1, 100000);
                    break;
                case 6:
                    $this->ShopMenu($player);
                    break;
            }
        });
        $form->setTitle("§l§9Shop Menu");
        $form->setContent("§7Select the option you would like to convert.");
        $form->addButton("§9Money -> EXP\n§e$1 = 1 EXP");
        $form->addButton("§9EXP -> Money\n§e1 EXP = $1");
        $form->addButton("§9Money -> Elixir\n§e$100 = 1 Elixir");
        $form->addButton("§9Elixir -> Money\n§e1 Elixir = $100");
        $form->addButton("§9Money -> Crystal\n§e$100000 = 1 Crystal");
        $form->addButton("§9Crystal -> Money\n§e1 Crystal = $100000");
        $form->addButton("§cBack");
        $player->sendForm($form);
    }
}