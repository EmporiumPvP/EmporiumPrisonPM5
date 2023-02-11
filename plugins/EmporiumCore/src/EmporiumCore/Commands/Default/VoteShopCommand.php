<?php

namespace EmporiumCore\Commands\Default;

use Emporium\Prison\library\formapi\SimpleForm;
use Items\Lootboxes;
use pocketmine\player\Player;
use pocketmine\item\ItemFactory;
use pocketmine\command\{Command, CommandSender};

use EmporiumCore\Managers\Data\DataManager;
use EmporiumCore\Listeners\Players\WebhookEvent;
use pocketmine\utils\TextFormat;

class VoteShopCommand extends Command {

    public function __construct() {
        parent::__construct("voteshop", "Exchange vote points for rewards.", "/voteshop", ["vs"]);
        $this->setPermission("emporiumcore.command.voteshop");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {

        if(!$sender instanceof Player) {
            return false;
        }

        $permission = DataManager::getData($sender, "Permissions", "emporiumcore.command.voteshop");
        if ($permission === false) {
            $sender->sendMessage(TextFormat::RED . "No permission");
            return false;
        }

        $this->VoteShopMenu($sender);
        return true;
    }

    # Vote Shop Menu
    public function VoteShopMenu($player) {
        $form = new SimpleForm(function($player, $data) {
            if ($data === null) {
                return;
            }
            switch($data) {
                case 0:
                    $balance = DataManager::getData($player, "Players", "VotePoints");
                    if ($balance >= 2) {
                        DataManager::takeData($player, "Players", "VotePoints", 2);
                        // Create Item
                        $item = ItemFactory::getInstance()->get(415, 0, 3);
                        $item->setCustomName("§r§9Kit Pouch");
                        $item->getNamedTag()->setByte("KitPouch", 1);
                        $item->setLore([
                            "§r§7Receive a random kit.",
                            "§r§7Right-Click to use."
                        ]);
                        // Give Item
                        foreach ($player->getInventory()->addItem($item) as $invfull) {
                            $player->getWorld()->dropItem($player->getPosition(), $invfull);
                        }
                        $player->sendMessage("§l§bSera §8>> §r§7You have purchased 3x Kit Pouches for 2 Vote Points.");
                        return;
                    }
                    $player->sendMessage("§l§cError §8>> §r§7You do not have enough vote points to purchase 3x Kit Pouches.");
                    break;
                case 1:
                    $balance = DataManager::getData($player, "Players", "VotePoints");
                    if ($balance >= 3) {
                        DataManager::takeData($player, "Players", "VotePoints", 3);
                        DataManager::addData($player, "Players", "Money", 10000000);
                        $player->sendMessage("§l§bSera §8>> §r§7You have purchased $10,000,000 Money for 3 Vote Points.");
                        return;
                    }
                    $player->sendMessage("§l§cError §8>> §r§7You do not have enough vote points to purchase $10,000,000 Money.");
                    break;
                case 2:
                    $balance = DataManager::getData($player, "Players", "VotePoints");
                    if ($balance >= 5) {
                        DataManager::takeData($player, "Players", "VotePoints", 5);
                        DataManager::addData($player, "Players", "Elixir", 500000);
                        $player->sendMessage("§l§bSera §8>> §r§7You have purchased 500,000 Elixir for 5 Vote Points.");
                        return;
                    }
                    $player->sendMessage("§l§cError §8>> §r§7You do not have enough vote points to purchase 500,000 Elixir.");
                    break;
                case 3:
                    $balance = DataManager::getData($player, "Players", "VotePoints");
                    if ($balance >= 10) {
                        DataManager::takeData($player, "Players", "VotePoints", 10);
                        // Create Item
                        $item = ItemFactory::getInstance()->get(409, 0, 32);
                        $item->setCustomName("§r§8[§7*§8] §l§5Mystery Tablet §8[§7*§8]");
                        $item->getNamedTag()->setByte("MysteryTablet", 1);
                        $item->setLore([
                            "§r§7Examine this mysterious stone tablet for a",
                            "§r§7chance to receive a random shard tablet.",
                            "§r§8 * §7Right-click to examine the tablet."
                        ]);
                        // Give Item
                        foreach ($player->getInventory()->addItem($item) as $invfull) {
                            $player->getWorld()->dropItem($player->getPosition(), $invfull);
                        }
                        $player->sendMessage("§l§bSera §8>> §r§7You have purchased 32x Mystery Tablets for 10 Vote Points.");
                        return;
                    }
                    $player->sendMessage("§l§cError §8>> §r§7You do not have enough vote points to purchase 32x Mystery Tablets.");
                    break;
                case 4:
                    $balance = DataManager::getData($player, "Players", "VotePoints");
                    if ($balance >= 10) {
                        DataManager::takeData($player, "Players", "VotePoints", 10);
                        // Give Item
                        foreach ($player->getInventory()->addItem((new Lootboxes)->Keys()) as $invfull) {
                            $player->getWorld()->dropItem($player->getPosition(), $invfull);
                        }
                        $player->sendMessage("§l§bSera §8>> §r§7You have purchased 1x Key Capsule for 10 Vote Points.");
                        return;
                    }
                    $player->sendMessage("§l§cError §8>> §r§7You do not have enough vote points to purchase 1x Key Capsule.");
                    break;
                case 5:
                    $balance = DataManager::getData($player, "Players", "VotePoints");
                    if ($balance >= 20) {
                        DataManager::takeData($player, "Players", "VotePoints", 20);
                        // Create Item
                        $item = ItemFactory::getInstance()->get(399);
                        $item->setCustomName("§r§l§bE§3t§be§3r§bn§3a§bl §r§bSuperior Crystal");
                        $item->getNamedTag()->setByte("EternalSuperiorCrystal", 1);
                        $item->setLore([
                            "§r§7Shatter this crystal to rankup to Eternal rank.",
                            "§r§7Works with all ranks, so be careful!",
                            "§r§8 * §7Right-click to shatter the crystal.",
                            "§r§8 * §7Rankup to Eternal rank."
                        ]);
                        // Give Item
                        foreach ($player->getInventory()->addItem($item) as $invfull) {
                            $player->getWorld()->dropItem($player->getPosition(), $invfull);
                        }
                        $player->sendMessage("§l§bSera §8>> §r§7You have purchased a Eternal Superior Crystal for 20 Vote Points.");
                        return;
                    }
                    $player->sendMessage("§l§cError §8>> §r§7You do not have enough vote points to purchase a Eternal Superior Crystal.");
                    break;
                case 6:
                    $balance = DataManager::getData($player, "Players", "VotePoints");
                    if ($balance >= 30) {
                        DataManager::takeData($player, "Players", "VotePoints", 30);
                        // Create Item
                        $item = ItemFactory::getInstance()->get(399);
                        $item->setCustomName("§r§l§6S§ee§6r§ea§6p§eh §r§eSuperior Crystal");
                        $item->getNamedTag()->setByte("SeraphSuperiorCrystal", 1);
                        $item->setLore([
                            "§r§7Shatter this crystal to rankup to Seraph rank.",
                            "§r§7Works with all ranks, so be careful!",
                            "§r§8 * §7Right-click to shatter the crystal.",
                            "§r§8 * §7Rankup to Seraph rank."
                        ]);
                        // Give Item
                        foreach ($player->getInventory()->addItem($item) as $invfull) {
                            $player->getWorld()->dropItem($player->getPosition(), $invfull);
                        }
                        $player->sendMessage("§l§bSera §8>> §r§7You have purchased a Seraph Superior Crystal for 30 Vote Points.");
                        return;
                    }
                    $player->sendMessage("§l§cError §8>> §r§7You do not have enough vote points to purchase a Seraph Superior Crystal.");
                    break;
                case 7:
                    $balance = DataManager::getData($player, "Players", "VotePoints");
                    if ($balance >= 60) {
                        // ReaperKit Gem
                        $item = ItemFactory::getInstance()->get(399);
                        $item->setCustomName("§r§8[§l§k§7||§r§8] §l§4R§ce§4a§cp§4e§cr §4Gem §8[§l§k§7||§r§8]");
                        $item->getNamedTag()->setByte("ReaperKit", mt_rand(-128, 127));
                        $item->setLore([
                            "§r§7A legendary gem imbued with power, forged by",
                            "§r§7the gods throughout time.",
                            "§r§7Shatter the gem and receive its contents.",
                            "§r§8 * §7Right-click to shatter the gem.",
                            "§r§8 * §7Contains §f1x Set of Reaper Armour",
                            "§r§8 * §7Contains §f1x Set of Reaper Weapons",
                            "§r§8 * §7Contains §f1x Set of Reaper Tools",
                            "§r§8 * §7Contains §f64x Enchanted Golden Apples",
                            "§r§8 * §7Contains §f64x Steak",
                            "§r§8 * §7Contains §f128x Bedrock",
                            "§r§8 * §7Contains §f128x Legend Keys",
                            "§r§8 * §7Contains §f64x Ultimate Keys"
                        ]);
                        // Give Gem
                        foreach ($player->getInventory()->addItem($item) as $invfull) {
                            $player->getWorld()->dropItem($player->getPosition(), $invfull);
                        }
                        DataManager::takeData($player, "Players", "VotePoints", 60);
                        $player->sendMessage("§l§bSera §8>> §r§7You have purchased a Reaper Gem for 60 Vote Points.");
                        // Send Logs
                        WebhookEvent::itemWebhook($player, "ReaperGemForged");
                        return;
                    }
                    $player->sendMessage("§l§cError §8>> §r§7You do not have enough vote points to purchase a Reaper Gem.");
                    break;
                case 8:
                    break;
            }
        });
        $form->setTitle("§l§9Vote Shop Menu");
        $form->setContent("§7Select the item that you would like to purchase");
        $form->addButton("§93x Kit Pouches\n§62 Vote Points");
        $form->addButton("§9$10,000,000 Money\n§63 Vote Points");
        $form->addButton("§9500,000 Elixir\n§65 Vote Points");
        $form->addButton("§932x Mystery Tablets\n§610 Vote Points");
        $form->addButton("§91x Key Capsule\n§610 Vote Points");
        $form->addButton("§9Eternal Superior Crystal\n§620 Vote Points");
        $form->addButton("§9Seraph Superior Crystal\n§630 Vote Points");
        $form->addButton("§9Reaper Gem\n§660 Votes");
        $form->addButton("§4Close");
        $player->sendForm($form);
    }
}