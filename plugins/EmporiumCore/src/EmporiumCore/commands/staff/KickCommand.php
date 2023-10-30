<?php

namespace EmporiumCore\Commands\Staff;

use EmporiumCore\EmporiumCore;
use EmporiumCore\Listeners\WebhookEvent;
use EmporiumCore\Variables;
use EmporiumData\PermissionsManager;
use pocketmine\command\{Command, CommandSender};
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;

class KickCommand extends Command {

    public function __construct() {
        parent::__construct("kick", "Kick a player from the server.", "/kick <player>");
        $this->setPermission("emporiumcore.command.kick");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {

        if(!$sender instanceof Player) {
            return false;
        }

        $permission = PermissionsManager::getInstance()->checkPermission($sender->getXuid(), ["emporiumcore.command.kick"]);
        if (!$permission) {
            $sender->sendMessage(\Emporium\Prison\Variables::NO_PERMISSION_MESSAGE);
            return false;
        }

        if (isset($args[0])) {
            $player = EmporiumCore::getInstance()->getServer()->getPlayerExact($args[0]);
            if ($player instanceof Player) {
                if(isset($args[1])) {
                    $reason = $args;
                    $translatedReason = implode(" ", $reason);
                    $newTranslatedReason = str_replace($player->getName() . " ", "", $translatedReason);

                    # Send webhook
                    WebhookEvent::staffWebhook($sender, $player, "Kick", $newTranslatedReason);

                    $player->kick(TF::RED . "You have been kicked from Emporium." . TF::EOL . TF::GRAY . "Reason: " . TF::WHITE . $newTranslatedReason . TF::EOL . TF::GRAY . "By: " . TF::AQUA . $sender->getName());
                    return true;
                }
                $player->kick(TF::RED . "You have been kicked from Emporium." . TF::EOL . TF::GRAY . "Reason: " . TF::WHITE . "reason not set" . TF::EOL . TF::GRAY . "By: " . TF::AQUA . $sender->getName());
                $sender->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have kicked {$player->getName()}.");
                // Send Logs
                return true;
            } else {
                $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "That player cannot be found.");
                return false;
            }
        } else {
            $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "Usage: /kick <player>");
            return false;
        }
    }
}