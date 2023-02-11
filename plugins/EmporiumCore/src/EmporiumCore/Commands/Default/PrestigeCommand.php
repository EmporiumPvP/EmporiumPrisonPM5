<?php

namespace EmporiumCore\Commands\Default;

use EmporiumCore\Variables;
use JsonException;
use pocketmine\player\Player;
use pocketmine\command\{Command, CommandSender};

use EmporiumCore\Managers\Data\DataManager;
use pocketmine\utils\TextFormat;

class PrestigeCommand extends Command {

    public function __construct() {
        parent::__construct("prestige", "Prestige from level 100.", "/prestige", ["rebirth"]);
        $this->setPermission("emporiumcore.command.prestige");
    }

    /**
     * @throws JsonException
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {

        if (!$sender instanceof Player) {
            $sender->sendMessage("§cYou may only run this command in-game!");
            return false;
        }

        $permission = DataManager::getData($sender, "Permissions", "emporiumcore.command.prestige");
        if ($permission === false) {
            $sender->sendMessage(TextFormat::RED . "No permission");
            return false;
        }

        $balance = DataManager::getData($sender, "Players", "Money");
        $level = DataManager::getData($sender, "Players", "Level");
        $prestige = DataManager::getData($sender, "Players", "Prestige");
        if ($prestige < 5) {
            $price = 15000000 * $prestige;
        }
        if ($prestige >= 5) {
            $price = (15000000 * $prestige) + 15000000;
        }
        if ($prestige >= 10) {
            $price = (15000000 * $prestige) + (15000000 * 2);
        }
        if ($prestige >= 15) {
            $price = (15000000 * $prestige) + (15000000 * 3);
        }
        if ($prestige >= 20) {
            $price = (15000000 * $prestige) + (15000000 * 3);
        }
        if ($prestige >= 25) {
            $price = (15000000 * $prestige) + (15000000 * 4);
        }
        if ($prestige >= 30) {
            $price = (15000000 * $prestige) + (15000000 * 5);
        }
        if ($prestige >= 35) {
            $price = (15000000 * $prestige) + (15000000 * 6);
        }
        if ($prestige >= 40) {
            $price = (15000000 * $prestige) + (15000000 * 7);
        }
        if ($prestige >= 45) {
            $price = (15000000 * $prestige) + (15000000 * 8);
        }
        if ($level === 100) {
            if ($prestige === 50) {
                $sender->sendMessage(Variables::ERROR_PREFIX . "§r§7You are at the max prestige.");
                return false;
            }
            if ($balance >= $price) {
                DataManager::takeData($sender, "Players", "Money", $price);
                DataManager::setData($sender, "Players", "Level", 1);
                DataManager::addData($sender, "Players", "Prestige", 1);
                $prestige = DataManager::getData($sender, "Players", "Prestige");
                $sender->sendMessage(Variables::SERVER_PREFIX . "§r§7You have prestiged up to Prestige {$prestige}.");
                return true;
            }
            $sender->sendMessage(Variables::ERROR_PREFIX . "§r§7You need $" . $price . " to prestige.");
            return false;
        }
        $sender->sendMessage(Variables::ERROR_PREFIX . "§r§7You are not at the max level and cannot prestige.");
        return false;
    }
}