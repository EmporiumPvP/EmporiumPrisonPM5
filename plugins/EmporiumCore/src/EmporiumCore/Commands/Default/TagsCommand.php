<?php

namespace EmporiumCore\Commands\Default;

use EmporiumCore\EmporiumCore;
use EmporiumData\PermissionsManager;
use pocketmine\command\{Command, CommandSender};
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;
use pocketmine\world\sound\EnderChestOpenSound;

class TagsCommand extends Command {

    public function __construct() {
        parent::__construct("tags", "Manage your tags", "/tags", ["tag"]);
        $this->setPermission("emporiumcore.command.tags");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {

        if(!$sender instanceof Player) {
            return false;
        }

        $permission = PermissionsManager::getInstance()->checkPermission($sender->getXuid(), "emporiumcore.command.tags");
        if (!$permission) {
            $sender->sendMessage(TextFormat::RED . "No permission");
            return false;
        }

        // Execute Command
        $tagForm = EmporiumCore::getInstance()->getTags();
        $tagForm->Form($sender);
        $sender->broadcastSound(new EnderChestOpenSound(), [$sender]);
        return true;
    }

}