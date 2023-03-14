<?php

namespace Emporium\Prison\commands\Default;

use Emporium\Prison\Managers\DataManager;
use Emporium\Prison\Menus\Bank;
use Emporium\Prison\Variables;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;
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

        /*
        $permission = DataManager::getData($sender, "Permissions", "emporiumprison.command.bank");
        if(!$permission) {
            $sender->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "No permission.");
        }*/

        $sender->broadcastSound(new BarrelOpenSound(), [$sender]);
        $bank = new Bank();
        $bank->Form($sender);
    }
}