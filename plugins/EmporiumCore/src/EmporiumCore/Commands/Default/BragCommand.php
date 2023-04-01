<?php

namespace EmporiumCore\Commands\Default;

use EmporiumCore\EmporiumCore;
use EmporiumCore\Variables;
use EmporiumData\PermissionsManager;
use pocketmine\command\{Command, CommandSender};
use pocketmine\player\Player;
use pocketmine\Server;
use pocketmine\utils\TextFormat as TF;

class BragCommand extends Command {

    private EmporiumCore $plugin;

    public function __construct(EmporiumCore $plugin) {
        parent::__construct("brag", "Brag about an item.", "/brag");
        $this->setPermission("emporiumcore.command.brag");
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {

        if(!$sender instanceof Player) {
            return false;
        }

        $permission = PermissionsManager::getInstance()->checkPermission($sender->getXuid(), "emporiumcore.command.brag");
        if (!$permission) {
            $sender->sendMessage(TF::RED . "No permission");
            return false;
        }

        $item = $sender->getInventory()->getItemInHand();
        $enchants = $item->getEnchantments();
        $enchantsList = null;
        if(count($enchants) > 0) {
            foreach ($item->getEnchantments() as $enchant) {
                $name = $enchant->getType()->getName();
                if (is_string($name)) $name = Server::getInstance()->getLanguage()->translateString($name);
                else $name = Server::getInstance()->getLanguage()->translate($name);

                $enchantsList .= TF::GREEN . $name . " " . TF::WHITE . $enchant->getLevel() . TF::EOL;
            }
        }
        if(count($enchants) > 0) {
            $this->plugin->getServer()->broadcastMessage(TF::BOLD . TF::DARK_GRAY . "[" . TF::AQUA . "BRAG" . TF::DARK_GRAY . "]" . TF::RESET . $sender->getName() . " is bragging " . TF::DARK_GRAY . "[" . TF::WHITE . $item->getCount() . "x " . $item->getName() . TF::RESET . TF::DARK_GRAY . "]" . TF::EOL . $enchantsList);
        } else {
            $this->plugin->getServer()->broadcastMessage(TF::BOLD . TF::DARK_GRAY . "[" . TF::AQUA . "BRAG" . TF::DARK_GRAY . "]" . TF::RESET . $sender->getName() . " is bragging " . TF::DARK_GRAY . "[" . TF::WHITE . $item->getCount() . "x " . $item->getName() . TF::RESET . TF::DARK_GRAY . "]");
        }
        return true;
    }
}