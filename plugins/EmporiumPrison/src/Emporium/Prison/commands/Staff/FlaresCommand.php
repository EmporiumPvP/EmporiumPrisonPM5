<?php

namespace Emporium\Prison\commands\Staff;

use Emporium\Prison\EmporiumPrison;
use Emporium\Prison\Variables;

use EmporiumData\PermissionsManager;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;

class FlaresCommand extends Command {

    private array $meteorRarities = [
        "elite",
        "ultimate",
        "legendary",
        "godly",
        "heroic"
    ];

    private array $gkitRarities = [
        "vulkarion",
        "zenith",
        "colossus",
        "warlock",
        "slaughter",
        "enchanter",
        "atheos",
        "iapetus",
        "broteas",
        "ares",
        "grimreaper",
        "executioner",
        "blacksmith",
        "hero",
        "cyborg",
        "crucible",
        "hunter"
    ];

    private array $types = [
        "meteor",
        "gkit"
    ];

    public function __construct() {
        parent::__construct("flare", "Main flare Command", TF::GRAY . "/flare give <player> <type> <rarity>");
        $this->setPermission("emporiumprison.command.flare");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {

        if(!$sender instanceof Player) {
            return;
        }

        # permission check
        $permission = PermissionsManager::getInstance()->checkPermission($sender->getXuid(), $this->getPermissions());
        if(!$permission) {
            $sender->sendMessage(Variables::NO_PERMISSION_MESSAGE);
            return;
        }

        # parameter check
        if(!isset($args[0])) {
            $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "(" . TF::RED . "!" . TF::DARK_GRAY . ") " . TF::RESET . TF::RED . "invalid usage");
            $sender->sendMessage($this->getUsage());
            return;
        }
        $parmeter = strtolower($args[0]);

        if(!$parmeter == "give") {
            $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "(" . TF::RED . "!" . TF::DARK_GRAY . ") " . TF::RESET . TF::RED . "invalid usage");
            $sender->sendMessage($this->getUsage());
            return;
        }

        # target check
        if(!isset($args[1])) {
            $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "(" . TF::RED . "!" . TF::DARK_GRAY . ") " . TF::RESET . TF::RED . "Please specify a player.");
            return;
        }
        $target = EmporiumPrison::getInstance()->getServer()->getPlayerExact($args[1]);

        if(!$target instanceof Player) {
            $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "(" . TF::RED . "!" . TF::DARK_GRAY . ") " . TF::RESET . TF::RED . "That player is not online");
            return;
        }

        # type check
        if(!isset($args[2])) {
            $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "(" . TF::RED . "!" . TF::DARK_GRAY . ") " . TF::RESET . TF::RED . "Please specify a type.");
            return;
        }
        $type = strtolower($args[2]);

        if(!in_array($type, $this->types)) {
            $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "(" . TF::RED . "!" . TF::DARK_GRAY . ") " . TF::RESET . TF::RED . "invalid type");
            $sender->sendMessage(TF::AQUA . "Available types: ");
            $sender->sendMessage(TF::GRAY . "Meteor");
            $sender->sendMessage(TF::GRAY . "GKit");
            return;
        }

        # rarity check
        if(!isset($args[3])) {
            $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "(" . TF::RED . "!" . TF::DARK_GRAY . ") " . TF::RESET . TF::RED . "invalid usage");
            $sender->sendMessage($this->getUsage());
            return;
        }
        $rarity = strtolower($args[3]);

        if($type === "meteor") {
            if(!in_array($rarity, $this->meteorRarities)) {
                $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "(" . TF::RED . "!" . TF::DARK_GRAY . ") " . TF::RESET . TF::RED . "invalid rarity");
                $sender->sendMessage(TF::AQUA . "Available rarities: ");
                $sender->sendMessage(TF::GRAY . "Elite");
                $sender->sendMessage(TF::GRAY . "Ultimate");
                $sender->sendMessage(TF::GRAY . "Legendary");
                $sender->sendMessage(TF::GRAY . "Godly");
                $sender->sendMessage(TF::GRAY . "Heroic");
                return;
            }
            switch($rarity) {

                case "elite":
                    $target->getInventory()->addItem((EmporiumPrison::getInstance()->getFlares())->EliteMeteor());
                    $target->sendMessage(Variables::SERVER_PREFIX . "You have received an " . TF::BLUE . "Elite Meteor Flare");
                    break;

                case "ultimate":
                    $target->getInventory()->addItem((EmporiumPrison::getInstance()->getFlares())->UltimateMeteor());
                    $target->sendMessage(Variables::SERVER_PREFIX . "You have received an " . TF::YELLOW . "Ultimate Meteor Flare");
                    break;

                case "legendary":
                    $target->getInventory()->addItem((EmporiumPrison::getInstance()->getFlares())->LegendaryMeteor());
                    $target->sendMessage(Variables::SERVER_PREFIX . "You have received a " . TF::GOLD . "Legendary Meteor Flare");
                    break;

                case "godly":
                    $target->getInventory()->addItem((EmporiumPrison::getInstance()->getFlares())->GodlyMeteor());
                    $target->sendMessage(Variables::SERVER_PREFIX . "You have received a " . TF::LIGHT_PURPLE . "Godly Meteor Flare");
                    break;

                case "heroic":
                    $target->getInventory()->addItem((EmporiumPrison::getInstance()->getFlares())->HeroicMeteor());
                    $target->sendMessage(Variables::SERVER_PREFIX . "You have received a " . TF::RED . "Heroic Meteor Flare");
                    break;
            }
        }

        if($type === "gkit") {
            if(!in_array($rarity, $this->gkitRarities)) {
                $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "(" . TF::RED . "!" . TF::DARK_GRAY . ") " . TF::RESET . TF::RED . "invalid rarity");
                $sender->sendMessage(TF::AQUA . "Available rarities: ");
                $sender->sendMessage(TF::GRAY . "Vulkarion");
                $sender->sendMessage(TF::GRAY . "Zenith");
                $sender->sendMessage(TF::GRAY . "Colossus");
                $sender->sendMessage(TF::GRAY . "Warlock");
                $sender->sendMessage(TF::GRAY . "Slaughter");
                $sender->sendMessage(TF::GRAY . "Enchanter");
                $sender->sendMessage(TF::GRAY . "Atheos");
                $sender->sendMessage(TF::GRAY . "Iapetus");
                $sender->sendMessage(TF::GRAY . "Broteas");
                $sender->sendMessage(TF::GRAY . "Ares");
                $sender->sendMessage(TF::GRAY . "Grim reaper");
                $sender->sendMessage(TF::GRAY . "Executioner");
                $sender->sendMessage(TF::GRAY . "blacksmith");
                $sender->sendMessage(TF::GRAY . "Hero");
                $sender->sendMessage(TF::GRAY . "Cyborg");
                $sender->sendMessage(TF::GRAY . "Crucible");
                $sender->sendMessage(TF::GRAY . "Hunter");
                return;
            }
            switch($rarity) {

                case "vulkarion":
                    $target->getInventory()->addItem((EmporiumPrison::getInstance()->getFlares())->heroicVulkarion());
                    $target->sendMessage(Variables::SERVER_PREFIX . "You have received a " . TF::DARK_RED . "Heroic Vulkarion G-Kit Flare");
                    break;

                case "zenith":
                    $target->getInventory()->addItem((EmporiumPrison::getInstance()->getFlares())->heroicZenith());
                    $target->sendMessage(Variables::SERVER_PREFIX . "You have received a " . TF::GOLD . "Heroic Zenith G-Kit Flare");
                    break;

                case "colossus":
                    $target->getInventory()->addItem((EmporiumPrison::getInstance()->getFlares())->heroicColossus());
                    $target->sendMessage(Variables::SERVER_PREFIX . "You have received a " . TF::WHITE . "Heroic Colossus G-Kit Flare");
                    break;

                case "warlock":
                    $target->getInventory()->addItem((EmporiumPrison::getInstance()->getFlares())->heroicWarlock());
                    $target->sendMessage(Variables::SERVER_PREFIX . "You have received a " . TF::DARK_PURPLE . "Heroic Warlock G-Kit Flare");
                    break;

                case "slaughter":
                    $target->getInventory()->addItem((EmporiumPrison::getInstance()->getFlares())->heroicSlaughter());
                    $target->sendMessage(Variables::SERVER_PREFIX . "You have received a " . TF::RED . "Heroic Slaughter G-Kit Flare");
                    break;

                case "enchanter":
                    $target->getInventory()->addItem((EmporiumPrison::getInstance()->getFlares())->heroicEnchanter());
                    $target->sendMessage(Variables::SERVER_PREFIX . "You have received a " . TF::AQUA . "Heroic Enchanter G-Kit Flare");
                    break;

                case "atheos":
                    $target->getInventory()->addItem((EmporiumPrison::getInstance()->getFlares())->heroicAtheos());
                    $target->sendMessage(Variables::SERVER_PREFIX . "You have received a " . TF::GRAY . "Heroic Atheos G-Kit Flare");
                    break;

                case "iapetus":
                    $target->getInventory()->addItem((EmporiumPrison::getInstance()->getFlares())->heroicIapetus());
                    $target->sendMessage(Variables::SERVER_PREFIX . "You have received a " . TF::BLUE . "Heroic Iapetus G-Kit Flare");
                    break;

                case "broteas":
                    $target->getInventory()->addItem((EmporiumPrison::getInstance()->getFlares())->heroicBroteas());
                    $target->sendMessage(Variables::SERVER_PREFIX . "You have received a " . TF::GREEN . "Heroic Broteas G-Kit Flare");
                    break;

                case "ares":
                    $target->getInventory()->addItem((EmporiumPrison::getInstance()->getFlares())->heroicAres());
                    $target->sendMessage(Variables::SERVER_PREFIX . "You have received a " . TF::GOLD . "Heroic Ares G-Kit Flare");
                    break;

                case "grimreaper":
                    $target->getInventory()->addItem((EmporiumPrison::getInstance()->getFlares())->heroicGrimReaper());
                    $target->sendMessage(Variables::SERVER_PREFIX . "You have received a " . TF::RED . "Heroic Grim Reaper G-Kit Flare");
                    break;

                case "executioner":
                    $target->getInventory()->addItem((EmporiumPrison::getInstance()->getFlares())->heroicExecutioner());
                    $target->sendMessage(Variables::SERVER_PREFIX . "You have received a " . TF::DARK_RED . "Heroic Executioner G-Kit Flare");
                    break;

                case "blacksmith":
                    $target->getInventory()->addItem((EmporiumPrison::getInstance()->getFlares())->blacksmith());
                    $target->sendMessage(Variables::SERVER_PREFIX . "You have received a " . TF::DARK_GRAY . "Blacksmith G-Kit Flare");
                    break;

                case "hero":
                    $target->getInventory()->addItem((EmporiumPrison::getInstance()->getFlares())->blacksmith());
                    $target->sendMessage(Variables::SERVER_PREFIX . "You have received a " . TF::WHITE . "Hero G-Kit Flare");
                    break;

                case "cyborg":
                    $target->getInventory()->addItem((EmporiumPrison::getInstance()->getFlares())->cyborg());
                    $target->sendMessage(Variables::SERVER_PREFIX . "You have received a " . TF::DARK_AQUA . "Cyborg G-Kit Flare");
                    break;

                case "crucible":
                    $target->getInventory()->addItem((EmporiumPrison::getInstance()->getFlares())->crucible());
                    $target->sendMessage(Variables::SERVER_PREFIX . "You have received a " . TF::YELLOW . "Crucible G-Kit Flare");
                    break;

                case "hunter":
                    $target->getInventory()->addItem((EmporiumPrison::getInstance()->getFlares())->hunter());
                    $target->sendMessage(Variables::SERVER_PREFIX . "You have received a " . TF::AQUA . "Hunter G-Kit Flare");
                    break;
            }
        }
    }

}