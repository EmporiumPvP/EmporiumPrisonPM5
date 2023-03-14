<?php

namespace EmporiumCore\Commands\Staff;


use EmporiumCore\Listeners\WebhookEvent;
use EmporiumCore\Managers\Data\DataManager;

use EmporiumCore\Variables;
use JsonException;

use pocketmine\player\Player;

use pocketmine\command\{Command, CommandSender};
use pocketmine\utils\TextFormat as TF;

class FreezeCommand extends Command {

    public function __construct() {
        parent::__construct("freeze", "Freeze a player.", "/freeze <player>");
        $this->setPermission("emporiumcore.command.freeze");
    }

    /**
     * @throws JsonException
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {

        if(!$sender instanceof Player) {
            return false;
        }

        $permission = DataManager::getData($sender, "Permissions", "emporiumcore.command.freeze");
        if ($permission === false) {
            $sender->sendMessage(TF::RED . "No permission");
            return false;
        }

        if (isset($args[0])) {
            $player = $sender->getServer()->getPlayerExact($args[0]);
            if ($player instanceof Player) {
                DataManager::setData($player, "Players", "Frozen", true);
                $sender->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You have frozen " . TF::YELLOW . "{$player->getName()}.");
                $player->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You are now frozen and cannot move.");
                // Send Logs
                WebhookEvent::staffWebhook($sender, $player, "Freeze");
                return true;
            } else {
                $sender->sendMessage(Variables::ERROR_PREFIX . TF::RED . "That player cannot be found.");
                return false;
            }
        } else {
            $sender->sendMessage(Variables::ERROR_PREFIX . TF::GRAY . "Usage: /freeze <player>");
            return false;
        }
    }
}