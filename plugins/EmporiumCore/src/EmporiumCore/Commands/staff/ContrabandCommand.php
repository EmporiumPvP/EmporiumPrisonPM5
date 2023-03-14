<?php

namespace EmporiumCore\Commands\Staff;

use EmporiumCore\EmporiumCore;
use Items\Contraband;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;

class ContrabandCommand extends Command {

    public function __construct() {
        parent::__construct("contraband", "Main contraband command");
        $this->setUsage("/contraband [rarity] | [player]");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {

        if(!$sender instanceof Player) {
            return;
        }

        if(isset($args[0])) {
            $rarity = $args[0];
            if(isset($args[1])) {
                $target = EmporiumCore::getInstance()->getServer()->getPlayerExact($args[1]);
                if($target instanceof Player) {
                    switch($rarity) {

                        case "elite":
                            $target->getInventory()->addItem((new Contraband())->Elite(1));
                            break;

                        case "ultimate":
                            $target->getInventory()->addItem((new Contraband())->Ultimate(1));
                            break;

                        case "legendary":
                            $target->getInventory()->addItem((new Contraband())->Legendary(1));
                            break;

                        case "Godly":
                            $target->getInventory()->addItem((new Contraband())->Godly(1));
                            break;

                        case "heroic":
                            $target->getInventory()->addItem((new Contraband())->Heroic(1));
                            break;
                    }
                } else {
                    $sender->sendMessage(TF::BOLD . "That player is not online");
                }
            } else {
                switch($rarity) {

                    case "elite":
                        $sender->getInventory()->addItem((new Contraband())->Elite(1));
                        break;

                    case "ultimate":
                        $sender->getInventory()->addItem((new Contraband())->Ultimate(1));
                        break;

                    case "legendary":
                        $sender->getInventory()->addItem((new Contraband())->Legendary(1));
                        break;

                    case "Godly":
                        $sender->getInventory()->addItem((new Contraband())->Godly(1));
                        break;

                    case "heroic":
                        $sender->getInventory()->addItem((new Contraband())->Heroic(1));
                        break;
                }
            }
        } else {
            $sender->sendMessage($this->getUsage());
        }
    }
}