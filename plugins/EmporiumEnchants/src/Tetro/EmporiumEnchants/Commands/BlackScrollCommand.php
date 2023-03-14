<?php

namespace Tetro\EmporiumEnchants\Commands;

use EmporiumCore\Managers\Data\DataManager;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;
use Tetro\EmporiumEnchants\Items\Blackscroll;
use Tetro\EmporiumEnchants\Loader;

class BlackScrollCommand extends Command {

    private Blackscroll $blackscroll;

    public function __construct() {
        parent::__construct("blackscroll", "Get a blackscroll", "/blackscroll <chance>");
        $this->setPermission("emporiumenchants.command.blackscroll");
        $this->setPermissionMessage("");
        $this->blackscroll = Loader::getBlackscroll();
    }
    public function execute(CommandSender $sender, string $commandLabel, array $args) {

        if(!$sender instanceof Player) {
            return;
        }

        /*
        $permission = DataManager::getData($sender, "Permissions", "emporiumenchants.command.blackscroll")
        if(!$permission) {
            $sender->sendMessage($this->getPermissionMessage());
            return;
        }
        */

        if(isset($args[0])) {
            $chance = $args[0];
            if(is_numeric($chance)) {
                # user set the chance
                if($chance > 0 && $chance <= 100) {
                    if($sender->getInventory()->canAddItem($this->blackscroll->setChance($chance))) {
                        $sender->getInventory()->addItem($this->blackscroll->setChance($chance));
                        $sender->sendMessage(TF::GREEN . "You have received a Blackscroll");
                    } else {
                        $sender->sendMessage(TF::RED . "Your inventory is full");
                    }
                }
                # user requested random chance
            } elseif(is_string($chance)) {
                if(strtolower($chance) === "random") {
                    if($sender->getInventory()->canAddItem($this->blackscroll->randomChance())) {
                        $sender->getInventory()->addItem($this->blackscroll->randomChance());
                        $sender->sendMessage(TF::GREEN . "You have received a Blackscroll");
                    } else {
                        $sender->sendMessage(TF::RED . "Your inventory is full");
                    }
                }
            } else {
                $sender->sendMessage(TF::RED . "Invalid usage");
            }
        } else {
            # user requested 100% chance
            if($sender->getInventory()->canAddItem($this->blackscroll->oneHundredChance())) {
                $sender->getInventory()->addItem($this->blackscroll->oneHundredChance());
                $sender->sendMessage(TF::GREEN . "You have received a Blackscroll");
            } else {
                $sender->sendMessage(TF::RED . "Your inventory is full");
            }
        }
    }
}