<?php

namespace EmporiumCore\Commands\Staff;

use EmporiumCore\EmporiumCore;
use EmporiumCore\Listeners\WebhookEvent;
use EmporiumCore\Variables;
use EmporiumData\PermissionsManager;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;

class WarnCommand extends Command {

    public function __construct() {
        parent::__construct("warn", "Warn a player.", "/warn [player]");
        $this->setPermission("emporiumcore.command.warn");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {

        if(!$sender instanceof Player) {
            return false;
        }

        $permission = PermissionsManager::getInstance()->checkPermission($sender->getXuid(), ["emporiumcore.command.warn"]);
        if (!$permission) {
            $sender->sendMessage(\Emporium\Prison\Variables::NO_PERMISSION_MESSAGE);
            return false;
        }

        if (isset($args[0])) {
            $player = EmporiumCore::getInstance()->getServer()->getPlayerExact($args[0]);
            if ($player instanceof Player) {
                $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You have warned {$player->getName()}.");
                $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You have been warned by staff.");

                # create reason message
                $reason = $args;
                $sortedReason = str_replace($player, "", $reason);
                if ($sortedReason === "" || $sortedReason === " ") {
                    $sortedReason = "No reason was specified.";
                }

                # Send webhook
                WebhookEvent::staffWebhook($sender, $player, "Warn", $sortedReason);

                return true;
            } else {
                $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "That player cannot be found.");
                return false;
            }
        } else {
            $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "Usage: /warn <player>");
            return false;
        }
    }

}