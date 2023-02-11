<?php

namespace EmporiumCore\Commands\Default;

use Emporium\Prison\library\formapi\SimpleForm;
use EmporiumCore\Variables;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;
use pocketmine\world\Position;
use pocketmine\item\ItemFactory;
use pocketmine\command\{Command, CommandSender};
use pocketmine\item\enchantment\{EnchantmentInstance, StringToEnchantmentParser};

use EmporiumCore\EmporiumCore;
use EmporiumCore\Managers\Data\DataManager;
#use Library\SeraCEs\Core\CustomEnchantManager;

class PrestigePanelCommand extends Command {

    private EmporiumCore $plugin;

    public function __construct(EmporiumCore $plugin) {
        parent::__construct("prestigepanel", "Open the prestige panel.", "/prestigepanel", ["pp"]);
        $this->setPermission("emporiumcore.command.prestigepanel");
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {

        if (!$sender instanceof Player) {
            $sender->sendMessage("§cYou may only run this command in-game!");
            return false;
        }

        $permission = DataManager::getData($sender, "Permissions", "emporiumcore.command.prestigepanel");
        if ($permission === false) {
            $sender->sendMessage(TextFormat::RED . "No permission");
            return false;
        }

        $prestige = DataManager::getData($sender, "Players", "Prestige");
        if ($prestige >= 10) {
            $this->PrestigePanel($sender);
            return true;
        }
        $sender->sendMessage(Variables::ERROR_PREFIX . "§r§7You need to be Prestige 10+ to use this command!");
        return false;
    }

    # Prestige Panel
    public function PrestigePanel($player) {

        $form = new SimpleForm(function($player, $data) {
            if ($data === null) {
                return;
            }
            switch($data) {
                case 0:
                    break;
                case 1:
                    $world = $this->plugin->getServer()->getWorldManager()->getWorldByName("PrestigeMine");
                    $player->teleport(new Position(288, 90, 270, $world));
                    $player->sendMessage(Variables::SERVER_PREFIX . "have teleported to the prestige mine.");
                    break;
                case 2:
                    $prestige = DataManager::getData($player, "Players", "Prestige");
                    $claimed = DataManager::getData($player, "Players", "Prestige20");
                    if ($prestige >= 20) {
                        if ($claimed === false) {
                            // Give Rewards
                            DataManager::addData($player, "Players", "Elixir", 3000000);
                            DataManager::addData($player, "Players", "Crystal", 1000);
                            $item = ItemFactory::getInstance()->get(415, 0, 8);
                            $item->setCustomName("§r§9Kit Pouch");
                            $item->getNamedTag()->setByte("KitPouch", 1);
                            $item->setLore([
                                "§r§7Receive a random kit.",
                                "§r§7Right-Click to use."
                            ]);
                            foreach ($player->getInventory()->addItem($item) as $invfull) {
                                $player->getWorld()->dropItem($player->getPosition(), $invfull);
                            }
                            // Finalise
                            $player->sendMessage("§l§1<§r§8----- §l§9Prestige Rewards §r§8-----§l§1>");
                            $player->sendMessage("§9You have claimed your Prestige 20 rewards.");
                            $player->sendMessage("§9Below is the list of what you had claimed.");
                            $player->sendMessage("§l§8* §r§73,000,000x Elixir");
                            $player->sendMessage("§l§8* §r§71,000x Crystal");
                            $player->sendMessage("§l§8* §r§78x Kit Pouch");
                            $player->sendMessage("§l§1<§r§8----------------------------§l§1>");
                            DataManager::setData($player, "Players", "Prestige20", true);
                            return;
                        }
                        $player->sendMessage(Variables::ERROR_PREFIX . "§r§7You have already claimed your Prestige 20 rewards.");
                        return;
                    }
                    $player->sendMessage(Variables::ERROR_PREFIX . "§r§7You have not reached Prestige 20 yet.");
                    break;
                case 3:
                    $prestige = DataManager::getData($player, "Players", "Prestige");
                    $claimed = DataManager::getData($player, "Players", "Prestige30");
                    if ($prestige >= 30) {
                        if ($claimed === false) {
                            // Give Rewards
                            $item = ItemFactory::getInstance()->get(399);
                            $item->setCustomName("§r§8[§l§k§2||§r§8] §l§2Basilisk §r§2Gem §8[§l§k§2||§r§8]");
                            $item->getNamedTag()->setByte("BasiliskKit", mt_rand(-128, 127));
                            $item->setLore([
                                "§r§7A mystical gem of loot, containing the legendary",
                                "§r§7Basilisk God Kit.",
                                "§r§7Shatter the gem and receive its contents.",
                                "§r§8 * §7Right-click to shatter the gem.",
                                "§r§8 * §7Contains §f1x Set of Basilisk Armour",
                                "§r§8 * §7Contains §f1x Set of Basilisk Weapons",
                                "§r§8 * §7Contains §f1x Set of Basilisk Tools",
                                "§r§8 * §7Contains §f64x Enchanted Golden Apples",
                                "§r§8 * §7Contains §f64x Steak",
                                "§r§8 * §7Contains §f128x Bedrock",
                                "§r§8 * §7Contains §f16x Legend Keys",
                                "§r§8 * §7Contains §f8x Ultimate Keys"
                            ]);
                            foreach ($player->getInventory()->addItem($item) as $invfull) {
                                $player->getWorld()->dropItem($player->getPosition(), $invfull);
                            }
                            DataManager::addData($player, "Players", "Crystal", 5000);
                            // Finalise
                            $player->sendMessage("§l§1<§r§8----- §l§9Prestige Rewards §r§8-----§l§1>");
                            $player->sendMessage("§9You have claimed your Prestige 30 rewards.");
                            $player->sendMessage("§9Below is the list of what you had claimed.");
                            $player->sendMessage("§l§8* §r§71x Basilisk Gem");
                            $player->sendMessage("§l§8* §r§75,000x Crystal");
                            $player->sendMessage("§l§1<§r§8----------------------------§l§1>");
                            DataManager::setData($player, "Players", "Prestige30", true);
                            return;
                        }
                        $player->sendMessage(Variables::ERROR_PREFIX . "§r§7You have already claimed your Prestige 30 rewards.");
                        return;
                    }
                    $player->sendMessage(Variables::ERROR_PREFIX . "§r§7You have not reached Prestige 30 yet.");
                    break;
                case 4:
                    $prestige = DataManager::getData($player, "Players", "Prestige");
                    $claimed = DataManager::getData($player, "Players", "Prestige40");
                    if ($prestige >= 40) {
                        if ($claimed === false) {
                            // Give Rewards
                            $item = ItemFactory::getInstance()->get(399);
                            $item->setCustomName("§r§8[§l§k§b||§r§8] §l§bHydra §r§bGem §8[§l§k§b||§r§8]");
                            $item->getNamedTag()->setByte("HydraKit", mt_rand(-128, 127));
                            $item->setLore([
                                "§r§7A mystical gem of loot, containing the legendary",
                                "§r§7Hydra God Kit.",
                                "§r§7Shatter the gem and receive its contents.",
                                "§r§8 * §7Right-click to shatter the gem.",
                                "§r§8 * §7Contains §f1x Set of Hydra Armour",
                                "§r§8 * §7Contains §f1x Set of Hydra Weapons",
                                "§r§8 * §7Contains §f1x Set of Hydra Tools",
                                "§r§8 * §7Contains §f64x Enchanted Golden Apples",
                                "§r§8 * §7Contains §f64x Steak",
                                "§r§8 * §7Contains §f128x Bedrock",
                                "§r§8 * §7Contains §f32x Legend Keys",
                                "§r§8 * §7Contains §f16x Ultimate Keys"
                            ]);
                            foreach ($player->getInventory()->addItem($item) as $invfull) {
                                $player->getWorld()->dropItem($player->getPosition(), $invfull);
                            }
                            $item = ItemFactory::getInstance()->get(399);
                            $item->setCustomName("§r§dTwilight Superior Crystal");
                            $item->getNamedTag()->setByte("TwilightSuperiorCrystal", 1);
                            $item->setLore([
                                "§r§7Shatter this crystal to rankup to Twilight rank.",
                                "§r§7Works with all ranks, so be careful!",
                                "§r§8 * §7Right-click to shatter the crystal.",
                                "§r§8 * §7Rankup to Twilight rank."
                            ]);
                            foreach ($player->getInventory()->addItem($item) as $invfull) {
                                $player->getWorld()->dropItem($player->getPosition(), $invfull);
                            }
                            // Finalise
                            $player->sendMessage("§l§1<§r§8----- §l§9Prestige Rewards §r§8-----§l§1>");
                            $player->sendMessage("§9You have claimed your Prestige 40 rewards.");
                            $player->sendMessage("§9Below is the list of what you had claimed.");
                            $player->sendMessage("§l§8* §r§71x Hydra Gem");
                            $player->sendMessage("§l§8* §r§71x Twilight Superior Crystal");
                            $player->sendMessage("§l§1<§r§8----------------------------§l§1>");
                            DataManager::setData($player, "Players", "Prestige40", true);
                            return;
                        }
                        $player->sendMessage(Variables::ERROR_PREFIX . "§r§7You have already claimed your Prestige 40 rewards.");
                        return;
                    }
                    $player->sendMessage(Variables::ERROR_PREFIX . "§r§7You have not reached Prestige 40 yet.");
                    break;
                case 5:
                    $prestige = DataManager::getData($player, "Players", "Prestige");
                    $claimed = DataManager::getData($player, "Players", "Prestige50");
                    if ($prestige >= 50) {
                        if ($claimed === false) {
                            // Give Rewards
                            $item = ItemFactory::getInstance()->get(399);
                            $item->setCustomName("§r§8[§l§k§6||§r§8] §l§6Phoenix §r§6Gem §8[§l§k§6||§r§8]");
                            $item->getNamedTag()->setByte("PhoenixKit", mt_rand(-128, 127));
                            $item->setLore([
                                "§r§7A mystical gem of loot, containing the legendary",
                                "§r§7Phoenix God Kit.",
                                "§r§7Shatter the gem and receive its contents.",
                                "§r§8 * §7Right-click to shatter the gem.",
                                "§r§8 * §7Contains §f1x Set of Phoenix Armour",
                                "§r§8 * §7Contains §f1x Set of Phoenix Weapons",
                                "§r§8 * §7Contains §f1x Set of Phoenix Tools",
                                "§r§8 * §7Contains §f64x Enchanted Golden Apples",
                                "§r§8 * §7Contains §f64x Steak",
                                "§r§8 * §7Contains §f128x Bedrock",
                                "§r§8 * §7Contains §f64x Legend Keys",
                                "§r§8 * §7Contains §f32x Ultimate Keys"
                            ]);
                            foreach ($player->getInventory()->addItem($item) as $invfull) {
                                $player->getWorld()->dropItem($player->getPosition(), $invfull);
                            }
                            $item = ItemFactory::getInstance()->get(278);
                            $item->setCustomName("§l§k§c||§r §l§8// §6Prestige §7<§fL§7> §6Pickaxe §8\\ §c§k||§r");
                            $item->addEnchantment(new EnchantmentInstance(StringToEnchantmentParser::getInstance()->parse("efficiency"), 50));
                            $item->addEnchantment(new EnchantmentInstance(StringToEnchantmentParser::getInstance()->parse("unbreaking"), 30));
                            /*
                            $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("reforged"), 10));
                            $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("discovery"), 30));
                            $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("power_hunter"), 10));
                            $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("detonate"), 3));
                            $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("miners_luck"), 10));
                            $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("elixir_hunter"), 50));
                            $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("lucky"), 15));
                            $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("jackpot"), 500));
                            $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("key_hunter"), 20));
                            $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("relic_hunter"), 20));
                            $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("exp_hunter"), 50));
                            $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("scavenger"), 20));
                            $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("haste"), 10));
                            $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("smelting"), 1));
                            */
                            foreach ($player->getInventory()->addItem($item) as $invfull) {
                                $player->getWorld()->dropItem($player->getPosition(), $invfull);
                            }
                            // Finalise
                            $player->sendMessage("§l§1<§r§8----- §l§9Prestige Rewards §r§8-----§l§1>");
                            $player->sendMessage("§9You have claimed your Prestige 50 rewards.");
                            $player->sendMessage("§9Below is the list of what you had claimed.");
                            $player->sendMessage("§l§8* §r§71x Phoenix Gem");
                            $player->sendMessage("§l§8* §r§7Prestige 50 Pickaxe");
                            $player->sendMessage("§l§1<§r§8----------------------------§l§1>");
                            DataManager::setData($player, "Players", "Prestige50", true);
                            return;
                        }
                        $player->sendMessage(Variables::ERROR_PREFIX . "§r§7You have already claimed your Prestige 50 rewards.");
                        return;
                    }
                    $player->sendMessage(Variables::ERROR_PREFIX . "§r§7You have not reached Prestige 50 yet.");
                    break;
            }
        });
        // Variables
        $prestige = DataManager::getData($player, "Players", "Prestige");
        $prestige20 = DataManager::getData($player, "Players", "Prestige20");
        $prestige30 = DataManager::getData($player, "Players", "Prestige30");
        $prestige40 = DataManager::getData($player, "Players", "Prestige40");
        $prestige50 = DataManager::getData($player, "Players", "Prestige50");
        // Buttons
        $form->setTitle("§l§9Prestige Panel");
        $form->setContent("§7Welcome to the Prestige Panel.\nPlease select an option.");
        $form->addButton("§4Close");
        $form->addButton("§9Prestige Mine\n§7Click to Teleport");
        // Prestige 20
        if ($prestige >= 20) {
            if ($prestige20 === false) {
                $form->addButton("§9Prestige 20 Rewards\n§aUnclaimed");
            } else {
                $form->addButton("§9Prestige 20 Rewards\n§cClaimed");
            }
        }
        // Prestige 30
        if ($prestige >= 30) {
            if ($prestige30 === false) {
                $form->addButton("§9Prestige 30 Rewards\n§aUnclaimed");
            } else {
                $form->addButton("§9Prestige 30 Rewards\n§cClaimed");
            }
        }
        // Prestige 40
        if ($prestige >= 40) {
            if ($prestige40 === false) {
                $form->addButton("§9Prestige 40 Rewards\n§aUnclaimed");
            } else {
                $form->addButton("§9Prestige 40 Rewards\n§cClaimed");
            }
        }
        // Prestige 50
        if ($prestige >= 50) {
            if ($prestige50 === false) {
                $form->addButton("§9Prestige 50 Rewards\n§aUnclaimed");
            } else {
                $form->addButton("§9Prestige 50 Rewards\n§cClaimed");
            }
        }
        // Send Form
        $player->sendForm($form);
    }
}