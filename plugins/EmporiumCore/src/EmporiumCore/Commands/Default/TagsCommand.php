<?php

namespace EmporiumCore\Commands\Default;

use EmporiumCore\Managers\Data\DataManager;
use Forms\TagsForm;
# POCKETMINE
use pocketmine\player\Player;
use pocketmine\command\{Command, CommandSender};
use pocketmine\utils\TextFormat;
use pocketmine\world\sound\EnderChestOpenSound;

class TagsCommand extends Command {

    public function __construct() {
        parent::__construct("tags", "Manage your tags", "/tags");
        $this->setPermission("emporiumcore.command.tags");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {

        if(!$sender instanceof Player) {
            return false;
        }

        $permission = DataManager::getData($sender, "Permissions", "emporiumcore.command.tags");
        if ($permission === false) {
            $sender->sendMessage(TextFormat::RED . "No permission");
            return false;
        }

        // Execute Command
        $tagForm = new TagsForm();
        $tagForm->Form($sender);
        $sender->broadcastSound(new EnderChestOpenSound());
        return true;
    }

}