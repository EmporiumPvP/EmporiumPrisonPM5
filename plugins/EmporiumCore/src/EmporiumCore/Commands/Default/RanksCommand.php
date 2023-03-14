<?php

namespace EmporiumCore\Commands\Default;

use EmporiumCore\EmporiumCore;
use EmporiumCore\Managers\Data\DataManager;
use EmporiumCore\Managers\Data\PermissionManager;

use EmporiumCore\Variables;

use JsonException;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\player\Player;

use pocketmine\utils\TextFormat as TF;

class RanksCommand extends Command {

    public array $ranks =
        [
        "player",
        "noble",
        "imperial",
        "supreme",
        "majesty",
        "emperor",
        "president",
        "trial",
        "builder",
        "helper",
        "mod",
        "admin",
        "developer",
        "manager",
        "owner",
        "founder"
        ];

    public function __construct() {
        parent::__construct("ranks", "Main ranks command", "/ranks | set [player] [rank]");
        $this->setPermission("emporiumcore.command.ranks");
    }

    /**
     * @throws JsonException
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args) {

        if(!$sender instanceof Player) {
            return;
        }

        $permission = DataManager::getData($sender, "Permissions", "emporiumcore.command.ranks");
        if(!$permission) {
            return;
        }
        # parameter
        if(isset($args[0])) {
            $parameter = strtolower($args[0]);
            # player
            if(isset($args[1])) {
                $target = $args[1];
                if($target instanceof Player) {
                    $player = EmporiumCore::getInstance()->getServer()->getPlayerExact($args[1]);
                } else {
                    if(file_exists(EmporiumCore::getInstance()->getDataFolder() . "PlayerData/Players/" . $target . ".yml")) {
                        # player exists but is offline
                        $player = $args[1];
                    } else {
                        # player doesnt exist
                        $sender->sendMessage(Variables::ERROR_PREFIX . TF::RED . "That player does not exist");
                        return;
                    }
                }
                # rank
                if(isset($args[2])) {
                    $rank = strtolower($args[2]);
                    if(in_array($rank, $this->ranks)) {
                        if($parameter === "set") {
                            $permission = DataManager::getData($sender, "Permissions", "emporiumcore.command.ranks.set");
                            if(!$permission) {
                                $sender->sendMessage(Variables::ERROR_PREFIX . "No permission.");
                            } else {
                                if($player instanceof Player) {
                                    PermissionManager::setOnlinePlayerRankPermissions($player, $rank);
                                    $sender->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have set " . TF::AQUA . "$player's " . TF::GRAY . "rank to " . TF::AQUA . "$rank");
                                } else {
                                    PermissionManager::setOfflinePlayerRankPermissions($player, $rank);
                                    $sender->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have set " . TF::AQUA . "$player's " . TF::GRAY . "rank to " . TF::AQUA . "$rank");
                                }
                            }
                        } else {
                            $sender->sendMessage(Variables::ERROR_PREFIX . "Invalid usage!");
                            $sender->sendMessage("§r ");
                            $sender->sendMessage($this->getUsage());
                        }
                    } else {
                        $sender->sendMessage(Variables::ERROR_PREFIX . "That rank does not exist!");
                        $sender->sendMessage("Here is a list of ranks on the server");
                        $sender->sendMessage("§r ");
                        $sender->sendMessage(TF::BOLD . TF::GOLD . "<" . TF::RESET . TF::DARK_GRAY . "----- " . TF::BOLD . TF::YELLOW . "Ranks " . TF::RESET . TF::DARK_GRAY . "-----" . TF::BOLD . TF::GOLD . ">");
                        $sender->sendMessage(TF::YELLOW . "Below is the list of Player Ranks.");
                        $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "* " . TF::RESET . TF::GRAY . "Noble");
                        $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "* " . TF::RESET . TF::GRAY . "Imperial");
                        $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "* " . TF::RESET . TF::GRAY . "Supreme");
                        $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "* ". TF::RESET . TF::GRAY . "Majesty");
                        $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "* ". TF::RESET . TF::GRAY . "Emperor");
                        $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "* ". TF::RESET . TF::GRAY . "President");
                        $sender->sendMessage(TF::YELLOW . "Below is the list of staff Ranks.");
                        $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "* ". TF::RESET . TF::GRAY . "Trial");
                        $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "* ". TF::RESET . TF::GRAY . "Builder");
                        $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "* ". TF::RESET . TF::GRAY . "Helper");
                        $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "* ". TF::RESET . TF::GRAY . "Mod");
                        $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "* ". TF::RESET . TF::GRAY . "Admin");
                        $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "* ". TF::RESET . TF::GRAY . "Developer");
                        $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "* ". TF::RESET . TF::GRAY . "Manager");
                        $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "* ". TF::RESET . TF::GRAY . "Owner");
                        $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "* ". TF::RESET . TF::GRAY . "Founder");
                        $sender->sendMessage(TF::BOLD . TF::GOLD . "<" . TF::RESET . TF::DARK_GRAY . "§r§8-----------------" . TF::BOLD . TF::GOLD . ">");
                    }
                } else {
                    $sender->sendMessage(Variables::ERROR_PREFIX . "Invalid usage!");
                    $sender->sendMessage("§r ");
                    $sender->sendMessage($this->getUsage());
                }
            } else {
                $sender->sendMessage(Variables::ERROR_PREFIX . "Invalid usage!");
                $sender->sendMessage("§r ");
                $sender->sendMessage($this->getUsage());
            }
        } else {
            $sender->sendMessage(TF::BOLD . TF::GOLD . "<" . TF::RESET . TF::DARK_GRAY . "----- " . TF::BOLD . TF::YELLOW . "Ranks " . TF::RESET . TF::DARK_GRAY . "-----" . TF::BOLD . TF::GOLD . ">");
            $sender->sendMessage(TF::YELLOW . "Below is the list of Player Ranks.");
            $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "* " . TF::RESET . TF::GRAY . "Noble");
            $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "* " . TF::RESET . TF::GRAY . "Imperial");
            $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "* " . TF::RESET . TF::GRAY . "Supreme");
            $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "* ". TF::RESET . TF::GRAY . "Majesty");
            $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "* ". TF::RESET . TF::GRAY . "Emperor");
            $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "* ". TF::RESET . TF::GRAY . "President");
            $sender->sendMessage(TF::YELLOW . "Below is the list of staff Ranks.");
            $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "* ". TF::RESET . TF::GRAY . "Trial");
            $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "* ". TF::RESET . TF::GRAY . "Builder");
            $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "* ". TF::RESET . TF::GRAY . "Helper");
            $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "* ". TF::RESET . TF::GRAY . "Mod");
            $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "* ". TF::RESET . TF::GRAY . "Admin");
            $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "* ". TF::RESET . TF::GRAY . "Developer");
            $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "* ". TF::RESET . TF::GRAY . "Manager");
            $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "* ". TF::RESET . TF::GRAY . "Owner");
            $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "* ". TF::RESET . TF::GRAY . "Founder");
            $sender->sendMessage(TF::BOLD . TF::GOLD . "<" . TF::RESET . TF::DARK_GRAY . "§r§8-----------------" . TF::BOLD . TF::GOLD . ">");
        }
    }
}