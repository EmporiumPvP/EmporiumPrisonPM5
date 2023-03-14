<?php

namespace EmporiumCore\Commands\Default;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\inventory\Inventory;
use pocketmine\player\Player;
use pocketmine\Server;

use muqsit\playervaults\PlayerVaults;
use muqsit\playervaults\vault\Vault;
use muqsit\playervaults\vault\VaultAccess;
use pocketmine\utils\TextFormat;

class ItemsCommand extends Command {

    public function __construct() {
        parent::__construct("items", "Collect protected items", "items");
        $this->setPermission("emporiumcore.command.items");
    }
    public function execute(CommandSender $sender, string $commandLabel, array $args) {

        if(!$sender instanceof Player) {
            return;
        }

        /*
        $permission = DataManager::getData($sender, "Permissions", "emporiumcore.command.items");
        if(!$permission) {
            return;
        }*/

        # send player pv 10
        /** @var PlayerVaults $vaults */
        $vaults = Server::getInstance()->getPluginManager()->getPlugin("PlayerVaults");

        $vaults->loadVault($sender->getName(), 10, function(Vault $vault, VaultAccess $access) use ($vaults, $sender): void {
            $inventory = $vault->getInventory();
            if(count($inventory->getContents()) === 0) {
                $sender->sendMessage(TextFormat::RED . "You have no Blackscroll in your collection chest");
            } else {
                $vaults->openVault($sender, $sender->getName(), 10);
            }
            $access->release(); // unloads vault and if necessary, saves vault
        });
    }
}