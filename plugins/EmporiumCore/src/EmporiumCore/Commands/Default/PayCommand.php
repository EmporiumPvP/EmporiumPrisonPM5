<?php

namespace EmporiumCore\Commands\Default;

use EmporiumCore\Variables;
use JsonException;
use pocketmine\player\Player;
use pocketmine\command\{Command, CommandSender};

# Used Files
use EmporiumCore\EmporiumCore;
use EmporiumCore\Managers\Data\DataManager;
use pocketmine\utils\TextFormat;

class PayCommand extends Command {

    private EmporiumCore $plugin;

    public function __construct(EmporiumCore $plugin) {
        parent::__construct("pay", "Pay an economy a player.", "/pay <money/exp/elixir/crystal> <amount> <player>");
        $this->setPermission("emporiumcore.command.pay");
        $this->plugin = $plugin;
    }


    /**
     * @throws JsonException
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {

        if (!$sender instanceof Player) {
            $sender->sendMessage("§cYou may only run this command in-game!");
            return false;
        }

        $permission = DataManager::getData($sender, "Permissions", "emporiumcore.command.pay");
        if ($permission === false) {
            $sender->sendMessage(TextFormat::RED . "No permission");
            return false;
        }

        if (isset($args[0])) {
            $currency = strtolower(($args[0]));
            if ($currency === "money" || $currency === "exp" || $currency === "elixir" || $currency === "crystal") {
                if ($currency === "money") {
                    $currency = "Money";
                }
                if ($currency === "exp") {
                    $currency = "Experience";
                }
                if ($currency === "elixir") {
                    $currency = "Elixir";
                }
                if ($currency === "crystal") {
                    $currency = "Crystal";
                }
                if ($currency === "Experience") {
                    $balance = $sender->getXpManager()->getCurrentTotalXp();
                } else {
                    $balance = DataManager::getData($sender, "Players", $currency);
                }
                if (isset($args[1])) {
                    if (is_numeric($args[1])) {
                        if ($args[1] > 0) {
                            if ($balance >= $args[1]) {
                                if (isset($args[2])) {
                                    $player = $this->plugin->getServer()->getPlayerByPrefix($args[2]);
                                    if ($player instanceof Player) {
                                        if ($currency === "Experience") {
                                            $sender->getXpManager()->subtractXp($args[1]);
                                            $player->getXpManager()->addXp($args[1]);
                                            $sender->sendMessage(Variables::SERVER_PREFIX . "§r§7You have successfully paid " . $args[1] . " EXP to " . $player->getName() . ".");
                                            $player->sendMessage(Variables::SERVER_PREFIX . "§r§7You have been paid " . $args[1] . " EXP by " . $sender->getName() . ".");
                                            return true;
                                        } else {
                                            DataManager::takeData($sender, "Players", $currency, $args[1]);
                                            DataManager::addData($player, "Players", $currency, $args[1]);
                                            if ($currency === "Money") {
                                                $sender->sendMessage(Variables::SERVER_PREFIX . "§r§7You have successfully paid $" . $args[1] . " to " . $player->getName() . ".");
                                                $player->sendMessage(Variables::SERVER_PREFIX . "§r§7You have been paid $" . $args[1] . " by " . $sender->getName() . ".");
                                                return true;
                                            } else {
                                                $sender->sendMessage(Variables::SERVER_PREFIX . "§r§7You have successfully paid " . $args[1] . " " . $currency . " to " . $player->getName() . ".");
                                                $player->sendMessage(Variables::SERVER_PREFIX . "§r§7You have been paid " . $args[1] . " " . $currency . " by " . $sender->getName() . ".");
                                                return true;
                                            }
                                        }
                                    }
                                    $sender->sendMessage(Variables::ERROR_PREFIX . "§r§7That player cannot be found.");
                                    return false;
                                }
                                $sender->sendMessage(Variables::ERROR_PREFIX . "§r§7Command Usage: /pay <money/exp/elixir/crystal> <amount> <player>");
                                return false;
                            }
                            $sender->sendMessage(Variables::ERROR_PREFIX . "§r§7You do not have enough to pay your target.");
                            return false;
                        }
                        $sender->sendMessage(Variables::ERROR_PREFIX . "§r§7Please provide a valid amount to pay.");
                        return false;
                    }
                    $sender->sendMessage(Variables::ERROR_PREFIX . "§r§7Please enter only numbers for the amount you're paying.");
                    return false;
                }
                $sender->sendMessage(Variables::ERROR_PREFIX . "§r§7Command Usage: /pay <money/exp/elixir/crystal> <amount> <player>");
                return false;
            }
            $sender->sendMessage(Variables::ERROR_PREFIX . "§r§7Please provide a valid currency to pay in.");
            return false;
        }
        $sender->sendMessage(Variables::ERROR_PREFIX . "§r§7Command Usage: /pay <money/exp/elixir/crystal> <amount> <player>");
        return false;
    }
}