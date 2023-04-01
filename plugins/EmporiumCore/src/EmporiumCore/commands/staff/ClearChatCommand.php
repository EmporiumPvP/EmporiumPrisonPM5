<?php

namespace EmporiumCore\Commands\Staff;

use EmporiumCore\EmporiumCore;
use EmporiumCore\Listeners\WebhookEvent;
use EmporiumCore\Variables;
use EmporiumData\PermissionsManager;
use pocketmine\command\{Command, CommandSender};
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;
use pocketmine\utils\TextFormat as TF;

class ClearChatCommand extends Command {

    private EmporiumCore $plugin;

    public function __construct(EmporiumCore $plugin) {
        parent::__construct("clearchat", "Clear the public chat.", "/clearchat", ["cc"]);
        $this->setPermission("emporiumcore.command.clearchat");
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {

        if(!$sender instanceof Player) {
            return false;
        }

        $permission = PermissionsManager::getInstance()->checkPermission($sender->getXuid(), "emporiumcore.command.clearchat");
        if (!$permission) {
            $sender->sendMessage(TextFormat::RED . "No permission");
            return false;
        }

        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage("");
        $this->plugin->getServer()->broadcastMessage(Variables::SERVER_PREFIX . TF::GRAY . "Chat cleared by " . TF::AQUA . $sender->getName() . TF::GRAY . ".");
        // Send Logs
        WebhookEvent::staffWebhook($sender, $sender, "ClearChat");
        return true;
    }
}