<?php

namespace EmporiumCore\Commands\Default;

use Emporium\Prison\library\formapi\SimpleForm;
use Emporium\Prison\Variables;
use EmporiumData\PermissionsManager;
use pocketmine\command\{Command, CommandSender};
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;

class VoteShopCommand extends Command {

    public function __construct() {
        parent::__construct("voteshop", "Exchange vote points for rewards.", "/voteshop", ["vs"]);
        $this->setPermission("emporiumcore.command.voteshop");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {

        if(!$sender instanceof Player) {
            return false;
        }

        $permission = PermissionsManager::getInstance()->checkPermission($sender->getXuid(), $this->getPermissions());
        if (!$permission) {
            $sender->sendMessage(Variables::NO_PERMISSION_MESSAGE);
            return false;
        }

        $this->VoteShopMenu($sender);
        return true;
    }

    # Vote Shop Menu
    public function VoteShopMenu($player) {
        $form = new SimpleForm(function($player, $data) {
            if ($data === null) return;
        });
        $form->setTitle("§l§9Vote Shop Menu");
        $form->setContent("§7Select the item that you would like to purchase");
        $form->addButton("§4Close");
        $player->sendForm($form);
    }
}