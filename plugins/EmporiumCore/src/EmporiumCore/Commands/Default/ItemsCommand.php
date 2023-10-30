<?php

namespace EmporiumCore\Commands\Default;

use Emporium\Prison\Variables;
use EmporiumData\PermissionsManager;

use muqsit\playervaults\PlayerVaults;
use muqsit\playervaults\vault\Vault;
use muqsit\playervaults\vault\VaultAccess;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\Server;
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

        $permission = PermissionsManager::getInstance()->checkPermission($sender->getXuid(), $this->getPermissions());
        if(!$permission) {
            $sender->sendMessage(Variables::NO_PERMISSION_MESSAGE);
            return;
        }

        # send player pv 10
        /** @var PlayerVaults $vaults */
        $vaults = Server::getInstance()->getPluginManager()->getPlugin("PlayerVaults");

        $vaults->loadVault($sender->getName(), 10, function(Vault $vault, VaultAccess $access) use ($vaults, $sender): void {
            $inventory = $vault->getInventory();
            if(count($inventory->getContents()) === 0) {
                $sender->sendMessage(TextFormat::RED . "You have no Items in your collection chest");
                return;
            }
            $vaults->openVault($sender, $sender->getName(), 10);

            $access->release(); // unloads vault and if necessary, saves vault
        });
    }
}