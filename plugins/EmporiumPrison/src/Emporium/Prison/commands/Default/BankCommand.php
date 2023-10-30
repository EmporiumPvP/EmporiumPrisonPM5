<?php

namespace Emporium\Prison\commands\Default;

use Emporium\Prison\EmporiumPrison;
use Emporium\Prison\Menus\Bank;

use Emporium\Prison\Variables;
use EmporiumData\PermissionsManager;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\world\sound\BarrelOpenSound;

class BankCommand extends Command {

    public function __construct() {
        parent::__construct("bank", "Main command for Bank", "/bank");
        $this->setPermission("emporiumprison.command.bank");
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

        $sender->broadcastSound(new BarrelOpenSound(), [$sender]);
        $bank = EmporiumPrison::getInstance()->getBankMenu();
        $bank->Form($sender);
    }
}