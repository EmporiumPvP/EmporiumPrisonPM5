<?php

namespace Tetro\EmporiumEnchants\Commands;

use EmporiumData\PermissionsManager;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;

use Tetro\EmporiumEnchants\Items\Scrolls;
use Tetro\EmporiumEnchants\EmporiumEnchants;

class BlackScrollCommand extends Command {

    private Scrolls $scrolls;

    public function __construct() {
        parent::__construct("blackscroll", "Get a blackscroll", "/blackscroll <chance>");
        $this->setPermission("emporiumenchants.command.blackscroll");
        $this->scrolls = EmporiumEnchants::getInstance()->getScrolls();
    }
    public function execute(CommandSender $sender, string $commandLabel, array $args) {

        if(!$sender instanceof Player) {
            return;
        }

        $permission = PermissionsManager::getInstance()->checkPermission($sender->getXuid(), "emporiumenchants.command.blackscroll");
        if(!$permission) return;

        if(isset($args[0])) {
            $chance = $args[0];
            if(is_numeric($chance)) {
                # user set the chance
                if($chance > 0 && $chance <= 100) {
                    if($sender->getInventory()->canAddItem($this->scrolls->blackScrollSetChance($chance))) {
                        $sender->getInventory()->addItem($this->scrolls->blackScrollSetChance($chance));
                        $sender->sendMessage(TF::GREEN . "You have received a Blackscroll");
                    } else {
                        $sender->sendMessage(TF::RED . "Your inventory is full");
                    }
                }
                # user requested random chance
            } elseif(is_string($chance)) {
                if(strtolower($chance) === "random") {
                    if($sender->getInventory()->canAddItem($this->scrolls->blackScrollRandomChance())) {
                        $sender->getInventory()->addItem($this->scrolls->blackScrollRandomChance());
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
            if($sender->getInventory()->canAddItem($this->scrolls->blackScrollHundred())) {
                $sender->getInventory()->addItem($this->scrolls->blackScrollHundred());
                $sender->sendMessage(TF::GREEN . "You have received a Blackscroll");

                $sender->getInventory()->addItem(EmporiumEnchants::getInstance()->getDust()->eliteDust(mt_rand(1, 15)));
                $sender->getInventory()->addItem(EmporiumEnchants::getInstance()->getPages()->elitePage(5));
                $sender->getInventory()->addItem(EmporiumEnchants::getInstance()->getOrbs()->Elite(1));
            } else {
                $sender->sendMessage(TF::RED . "Your inventory is full");
            }
        }
    }
}