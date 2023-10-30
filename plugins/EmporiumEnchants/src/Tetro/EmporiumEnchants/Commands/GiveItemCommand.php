<?php

namespace Tetro\EmporiumEnchants\Commands;

use Emporium\Prison\EmporiumPrison;
use Emporium\Prison\Variables;

use EmporiumData\PermissionsManager;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\Server;
use pocketmine\utils\TextFormat as TF;

use Tetro\EmporiumEnchants\EmporiumEnchants;

class GiveItemCommand extends Command
{

    private array $items =
        [
            "pages" => ["elite_page", "ultimate_page", "legendary_page", "godly_page", "heroic_page", "executive_page"],
            "books" => ["elite_book", "ultimate_book", "legendary_book", "godly_book", "heroic_book", "executive_book"],
            "dust" => ["elite_dust", "ultimate_dust", "legendary_dust", "godly_dust", "heroic_dust"],
            "orbs" => ["elite_orb", "ultimate_orb", "legendary_orb", "godly_orb", "heroic_orb"],
            "scrolls" => ["white_scroll", "holy_white_scroll", "black_scroll", "elite_randomisation_scroll", "ultimate_randomisation_scroll", "legendary_randomisation_scroll", "godly_randomisation_scroll", "heroic_randomisation_scroll"],
            "pickaxes" => ["trainee_pickaxe", "stone_pickaxe", "gold_pickaxe", "iron_pickaxe", "diamond_pickaxe", "energy_pickaxe"],
            "boss_rewards" => ["hades", "zeus", "apollo", "poseidon"]
        ];

    private EmporiumEnchants $emporiumEnchants;

    public function __construct()
    {
        parent::__construct("giveitem", "give a player custom enchant items", "/giveitem [player] [item]");
        $this->setPermission("emporiumenchants.command.give");
        $this->setPermissionMessage(Variables::NO_PERMISSION_MESSAGE);
        $this->emporiumEnchants = EmporiumEnchants::getInstance();
    }


    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if(!$sender instanceof Player) return;

        if(!isset($args[0])) {
            $sender->sendMessage("Please specify a player");
            return;
        }

        $permission = PermissionsManager::getInstance()->checkPermission($sender->getXuid(), $this->getPermissions());
        if(!$permission) {
            $sender->sendMessage(Variables::NO_PERMISSION_MESSAGE);
            return;
        }

        $player = Server::getInstance()->getPlayerExact($args[0]);
        if(!$player instanceof Player) {
            $sender->sendMessage("$args[0] is not online or can not be found");
            return;
        }

        if(!isset($args[1])) {
            $sender->sendMessage("Please specify an item");
            return;
        }

        $test = implode(" ", $args);
        #$name = implode(" ", array_shift($args));
        $name = str_replace($args[0], "", $test);
        $name = ltrim($name, " ");
        $name = str_replace(" ", "_", $name);
        $name = strtolower($name);

        $found = false;
        foreach ($this->items as $category => $items) {
            if (in_array($name, $items)) {
                $found = true;
            }
        }

        if(!$found) {

            $message = Variables::PREFIX . TF::RESET . TF::RED . "That is not a valid item, Available Items: " . TF::EOL;

            foreach ($this->items as $type => $items) {
                $type = str_replace("_", " ", $type);
                $message .= TF::EOL . TF::BOLD . TF::AQUA . ucwords($type) . ":";
                foreach ($items as $item) {
                    $item = str_replace("_", " ", $item);
                    $message .= "\n  " . TF::GRAY . ucwords($item);
                }
                $message .= TF::EOL;
            }
            $sender->sendMessage($message);

            return;
        }

        switch($name) {

            # pages
            case "elite_page":
                if($player->getInventory()->canAddItem($this->emporiumEnchants->getPages()->elitePage(mt_rand(1, 15)))) {
                    $player->getInventory()->addItem($this->emporiumEnchants->getPages()->elitePage(mt_rand(1, 15)));
                } else {
                    $player->getWorld()->dropItem($player->getPosition(), $this->emporiumEnchants->getPages()->elitePage(mt_rand(1, 15)));
                }
                break;
            case "ultimate_page":
                if($player->getInventory()->canAddItem($this->emporiumEnchants->getPages()->ultimatePage(mt_rand(1, 15)))) {
                    $player->getInventory()->addItem($this->emporiumEnchants->getPages()->ultimatePage(mt_rand(1, 15)));
                } else {
                    $player->getWorld()->dropItem($player->getPosition(), $this->emporiumEnchants->getPages()->ultimatePage(mt_rand(1, 15)));
                }
                break;
            case "legendary_page":
                if($player->getInventory()->canAddItem($this->emporiumEnchants->getPages()->legendaryPage(mt_rand(1, 15)))) {
                    $player->getInventory()->addItem($this->emporiumEnchants->getPages()->legendaryPage(mt_rand(1, 15)));
                } else {
                    $player->getWorld()->dropItem($player->getPosition(), $this->emporiumEnchants->getPages()->legendaryPage(mt_rand(1, 15)));
                }
                break;
            case "godly_page":
                if($player->getInventory()->canAddItem($this->emporiumEnchants->getPages()->godlyPage(mt_rand(1, 15)))) {
                    $player->getInventory()->addItem($this->emporiumEnchants->getPages()->godlyPage(mt_rand(1, 15)));
                } else {
                    $player->getWorld()->dropItem($player->getPosition(), $this->emporiumEnchants->getPages()->godlyPage(mt_rand(1, 15)));
                }
                break;
            case "heroic_page":
                if($player->getInventory()->canAddItem($this->emporiumEnchants->getPages()->heroicPage(mt_rand(1, 15)))) {
                    $player->getInventory()->addItem($this->emporiumEnchants->getPages()->heroicPage(mt_rand(1, 15)));
                } else {
                    $player->getWorld()->dropItem($player->getPosition(), $this->emporiumEnchants->getPages()->heroicPage(mt_rand(1, 15)));
                }
                break;
            case "executive_page":
                if($player->getInventory()->canAddItem($this->emporiumEnchants->getPages()->executivePage(mt_rand(1, 15)))) {
                    $player->getInventory()->addItem($this->emporiumEnchants->getPages()->executivePage(mt_rand(1, 15)));
                } else {
                    $player->getWorld()->dropItem($player->getPosition(), $this->emporiumEnchants->getPages()->executivePage(mt_rand(1, 15)));
                }
                break;

                # books
            case "elite_book":
                if($player->getInventory()->canAddItem($this->emporiumEnchants->getBooks()->Elite(1))) {
                    $player->getInventory()->addItem($this->emporiumEnchants->getBooks()->Elite(1));
                } else {
                    $player->getWorld()->dropItem($player->getPosition(), $this->emporiumEnchants->getBooks()->Elite(1));
                }
                break;
            case "ultimate_book":
                if($player->getInventory()->canAddItem($this->emporiumEnchants->getBooks()->Ultimate(1))) {
                    $player->getInventory()->addItem($this->emporiumEnchants->getBooks()->Ultimate(1));
                } else {
                    $player->getWorld()->dropItem($player->getPosition(), $this->emporiumEnchants->getBooks()->Ultimate(1));
                }
                break;
            case "legendary_book":
                if($player->getInventory()->canAddItem($this->emporiumEnchants->getBooks()->Legendary(1))) {
                    $player->getInventory()->addItem($this->emporiumEnchants->getBooks()->Legendary(1));
                } else {
                    $player->getWorld()->dropItem($player->getPosition(), $this->emporiumEnchants->getBooks()->Legendary(1));
                }
                break;
            case "godly_book":
                if($player->getInventory()->canAddItem($this->emporiumEnchants->getBooks()->Godly(1))) {
                    $player->getInventory()->addItem($this->emporiumEnchants->getBooks()->Godly(1));
                } else {
                    $player->getWorld()->dropItem($player->getPosition(), $this->emporiumEnchants->getBooks()->Godly(1));
                }
                break;
            case "heroic_book":
                if($player->getInventory()->canAddItem($this->emporiumEnchants->getBooks()->Heroic(1))) {
                    $player->getInventory()->addItem($this->emporiumEnchants->getBooks()->Heroic(1));
                } else {
                    $player->getWorld()->dropItem($player->getPosition(), $this->emporiumEnchants->getBooks()->Heroic(1));
                }
                break;
            case "executive_book":
                if($player->getInventory()->canAddItem($this->emporiumEnchants->getBooks()->Executive(1))) {
                    $player->getInventory()->addItem($this->emporiumEnchants->getBooks()->Executive(1));
                } else {
                    $player->getWorld()->dropItem($player->getPosition(), $this->emporiumEnchants->getBooks()->Executive(1));
                }
                break;

                # dust
            case "elite_dust":
                if($player->getInventory()->canAddItem($this->emporiumEnchants->getDust()->eliteDust(mt_rand(1, 15)))) {
                    $player->getInventory()->addItem($this->emporiumEnchants->getDust()->eliteDust(mt_rand(1, 15)));
                } else {
                    $player->getWorld()->dropItem($player->getPosition(), $this->emporiumEnchants->getDust()->eliteDust(mt_rand(1, 15)));
                }
                break;
            case "ultimate_dust":
                if($player->getInventory()->canAddItem($this->emporiumEnchants->getDust()->ultimateDust(mt_rand(1, 15)))) {
                    $player->getInventory()->addItem($this->emporiumEnchants->getDust()->ultimateDust(mt_rand(1, 15)));
                } else {
                    $player->getWorld()->dropItem($player->getPosition(), $this->emporiumEnchants->getDust()->ultimateDust(mt_rand(1, 15)));
                }
                break;
            case "legendary_dust":
                if($player->getInventory()->canAddItem($this->emporiumEnchants->getDust()->legendaryDust(mt_rand(1, 15)))) {
                    $player->getInventory()->addItem($this->emporiumEnchants->getDust()->legendaryDust(mt_rand(1, 15)));
                } else {
                    $player->getWorld()->dropItem($player->getPosition(), $this->emporiumEnchants->getDust()->legendaryDust(mt_rand(1, 15)));
                }
                break;
            case "godly_dust":
                if($player->getInventory()->canAddItem($this->emporiumEnchants->getDust()->godlyDust(mt_rand(1, 15)))) {
                    $player->getInventory()->addItem($this->emporiumEnchants->getDust()->godlyDust(mt_rand(1, 15)));
                } else {
                    $player->getWorld()->dropItem($player->getPosition(), $this->emporiumEnchants->getDust()->godlyDust(mt_rand(1, 15)));
                }
                break;
            case "heroic_dust":
                if($player->getInventory()->canAddItem($this->emporiumEnchants->getDust()->heroicDust(mt_rand(1, 15)))) {
                    $player->getInventory()->addItem($this->emporiumEnchants->getDust()->heroicDust(mt_rand(1, 15)));
                } else {
                    $player->getWorld()->dropItem($player->getPosition(), $this->emporiumEnchants->getDust()->heroicDust(mt_rand(1, 15)));
                }
                break;

                # orbs
            case "elite_orb":
                if($player->getInventory()->canAddItem($this->emporiumEnchants->getOrbs()->Elite(1))) {
                    $player->getInventory()->addItem($this->emporiumEnchants->getOrbs()->Elite(1));
                } else {
                    $player->getWorld()->dropItem($player->getPosition(), $this->emporiumEnchants->getOrbs()->Elite(1));
                }
                break;
            case "ultimate_orb":
                if($player->getInventory()->canAddItem($this->emporiumEnchants->getOrbs()->Ultimate(1))) {
                    $player->getInventory()->addItem($this->emporiumEnchants->getOrbs()->Ultimate(1));
                } else {
                    $player->getWorld()->dropItem($player->getPosition(), $this->emporiumEnchants->getOrbs()->Ultimate(1));
                }
                break;
            case "legendary_orb":
                if($player->getInventory()->canAddItem($this->emporiumEnchants->getOrbs()->Legendary(1))) {
                    $player->getInventory()->addItem($this->emporiumEnchants->getOrbs()->Legendary(1));
                } else {
                    $player->getWorld()->dropItem($player->getPosition(), $this->emporiumEnchants->getOrbs()->Legendary(1));
                }
                break;
            case "godly_orb":
                if($player->getInventory()->canAddItem($this->emporiumEnchants->getOrbs()->Godly(1))) {
                    $player->getInventory()->addItem($this->emporiumEnchants->getOrbs()->Godly(1));
                } else {
                    $player->getWorld()->dropItem($player->getPosition(), $this->emporiumEnchants->getOrbs()->Godly(1));
                }
                break;
            case "heroic_orb":
                if($player->getInventory()->canAddItem($this->emporiumEnchants->getOrbs()->Heroic(1))) {
                    $player->getInventory()->addItem($this->emporiumEnchants->getOrbs()->Heroic(1));
                } else {
                    $player->getWorld()->dropItem($player->getPosition(), $this->emporiumEnchants->getOrbs()->Heroic(1));
                }
                break;

                # scrolls
            case "white_scroll":
                if($player->getInventory()->canAddItem(EmporiumPrison::getInstance()->getScrolls()->whiteScroll())) {
                    $player->getInventory()->addItem(EmporiumPrison::getInstance()->getScrolls()->whiteScroll());
                } else {
                    $player->getWorld()->dropItem($player->getPosition(), EmporiumPrison::getInstance()->getScrolls()->whiteScroll());
                }
                break;
            case "holy_white_scroll":
                if($player->getInventory()->canAddItem(EmporiumPrison::getInstance()->getScrolls()->holyWhiteScroll())) {
                    $player->getInventory()->addItem(EmporiumPrison::getInstance()->getScrolls()->holyWhiteScroll());
                } else {
                    $player->getWorld()->dropItem($player->getPosition(), EmporiumPrison::getInstance()->getScrolls()->holyWhiteScroll());
                }
                break;
            case "black_scroll":
                if($player->getInventory()->canAddItem($this->emporiumEnchants->getScrolls()->blackScrollHundred())) {
                    $player->getInventory()->addItem($this->emporiumEnchants->getScrolls()->blackScrollHundred());
                } else {
                    $player->getWorld()->dropItem($player->getPosition(), $this->emporiumEnchants->getScrolls()->blackScrollHundred());
                }
                break;
            case "elite_randomisation_scroll":
                if($player->getInventory()->canAddItem($this->emporiumEnchants->getScrolls()->eliteRandomisationScroll())) {
                    $player->getInventory()->addItem($this->emporiumEnchants->getScrolls()->eliteRandomisationScroll());
                } else {
                    $player->getWorld()->dropItem($player->getPosition(), $this->emporiumEnchants->getScrolls()->eliteRandomisationScroll());
                }
                break;
            case "ultimate_randomisation_scroll":
                if($player->getInventory()->canAddItem($this->emporiumEnchants->getScrolls()->ultimateRandomisationScroll())) {
                    $player->getInventory()->addItem($this->emporiumEnchants->getScrolls()->ultimateRandomisationScroll());
                } else {
                    $player->getWorld()->dropItem($player->getPosition(), $this->emporiumEnchants->getScrolls()->ultimateRandomisationScroll());
                }
                break;
            case "legendary_randomisation_scroll":
                if($player->getInventory()->canAddItem($this->emporiumEnchants->getScrolls()->legendaryRandomisationScroll())) {
                    $player->getInventory()->addItem($this->emporiumEnchants->getScrolls()->legendaryRandomisationScroll());
                } else {
                    $player->getWorld()->dropItem($player->getPosition(), $this->emporiumEnchants->getScrolls()->legendaryRandomisationScroll());
                }
                break;
            case "godly_randomisation_scroll":
                if($player->getInventory()->canAddItem($this->emporiumEnchants->getScrolls()->godlyRandomisationScroll())) {
                    $player->getInventory()->addItem($this->emporiumEnchants->getScrolls()->godlyRandomisationScroll());
                } else {
                    $player->getWorld()->dropItem($player->getPosition(), $this->emporiumEnchants->getScrolls()->godlyRandomisationScroll());
                }
                break;
            case "heroic_randomisation_scroll":
                if($player->getInventory()->canAddItem($this->emporiumEnchants->getScrolls()->heroicRandomisationScroll())) {
                    $player->getInventory()->addItem($this->emporiumEnchants->getScrolls()->heroicRandomisationScroll());
                } else {
                    $player->getWorld()->dropItem($player->getPosition(), $this->emporiumEnchants->getScrolls()->heroicRandomisationScroll());
                }
                break;

            case "hades":
                $player->getInventory()->addItem(EmporiumPrison::getInstance()->getHades()->sword());
                $player->getInventory()->addItem(EmporiumPrison::getInstance()->getHades()->helmet());
                $player->getInventory()->addItem(EmporiumPrison::getInstance()->getHades()->chestplate());
                $player->getInventory()->addItem(EmporiumPrison::getInstance()->getHades()->leggings());
                $player->getInventory()->addItem(EmporiumPrison::getInstance()->getHades()->boots());
                $player->sendMessage("You received hades items");
                break;

            case "energy_pickaxe":
                $player->getInventory()->addItem(EmporiumPrison::getInstance()->getPickaxes()->energyPickaxe());
                $player->sendMessage("You received an Energy Pickaxe");
                break;

            default:
                $sender->sendMessage("Unknown item");
                break;
        }
    }

}