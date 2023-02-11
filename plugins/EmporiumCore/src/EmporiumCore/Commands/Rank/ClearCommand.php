<?php

namespace EmporiumCore\Commands\Rank;

use EmporiumCore\Managers\Data\DataManager;

use EmporiumCore\Variables;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;

class ClearCommand extends Command {

    public function __construct() {
        parent::__construct("clear", "Clear a players inventory.", "/clear [player]", ["c"]);
        $this->setPermission("emporiumcore.command.clear");
    }

    # Command Code
    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {

        if(!$sender instanceof Player) {
            return false;
        }

        $permission = DataManager::getData($sender, "Permissions", "emporiumcore.command.clear");
        if ($permission === false) {
            $sender->sendMessage(Variables::ERROR_PREFIX . TF::RED . "No permission.");
            return false;
        }


        if (isset($args[0])) {
            $subcommand = strtolower($args[0]);
            $subcommands = ["hand", "inv"];
            if (in_array($subcommand, $subcommands)) {
                if (strtolower($args[0]) === "hand") {
                    $hand = $sender->getInventory()->getItemInHand();
                    $sender->getInventory()->remove($hand);
                    $sender->sendMessage(Variables::SERVER_PREFIX . TF::GREEN . "Successfully cleared your hand.");
                    return true;
                }
                if (strtolower($args[0]) === "inv") {
                    $sender->getOffHandInventory()->clearAll();
                    $sender->getArmorInventory()->clearAll();
                    $sender->getInventory()->clearAll();
                    $sender->sendMessage(Variables::SERVER_PREFIX . TF::GREEN . "Successfully cleared your inventory.");
                    return true;
                }
            }
            $sender->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "Usage: /clear <hand/inv>");
            return false;
        }
        $sender->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "Usage: /clear <hand/inv>");
        return false;
    }

}