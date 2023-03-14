<?php

namespace EmporiumCore\Commands\Staff;

use diamondgold\MiniBosses\Main;

use Emporium\Prison\items\Pickaxes;
use Emporium\Prison\items\Scrolls;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\player\Player;

class BossCommand extends Command {

    public function __construct() {
        parent::__construct("boss", "main boss command", "/boss");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {

        if(!$sender instanceof Player) {
            return;
        }

        $sender->getInventory()->addItem((new Scrolls())->whiteScroll());
        $sender->getInventory()->addItem((new Pickaxes($sender))->Trainee());
        #Main::getInstance()->spawnBoss("coal_bandit");
    }
}