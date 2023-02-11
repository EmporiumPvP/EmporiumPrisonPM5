<?php

namespace EmporiumCore\Commands\Staff;

use EmporiumCore\Managers\Data\DataManager;

use Inventories\ItemsMenu;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\player\Player;

use pocketmine\utils\TextFormat as TF;
use pocketmine\world\sound\EnderChestOpenSound;

class ItemsCommand extends Command {

    public function __construct() {
        parent::__construct("items", "Opens up the Items Menu", "/items");
        $this->setPermission("emporiumcore.command.items");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {

        if(!$sender instanceof Player) {
            return false;
        }

        $permission = DataManager::getData($sender, "Permissions", "emporiumcore.command.items");
        if ($permission === false) {
            $sender->sendMessage(TF::RED . "No permission");
            return false;
        }

        $menu = new ItemsMenu();
        $menu->Lootboxes($sender);
        $sender->broadcastSound(new EnderChestOpenSound());
        return true;

    }

}