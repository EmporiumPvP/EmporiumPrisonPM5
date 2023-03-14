<?php

namespace EmporiumCore\Commands\Default;

use EmporiumCore\EmporiumCore;

use EmporiumCore\Managers\Data\DataManager;
use EmporiumCore\Variables;

use pocketmine\player\Player;
use pocketmine\command\{Command, CommandSender};
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

        $permission = DataManager::getData($sender, "Permissions", "emporiumcore.command.brag");
        if ($permission === false) {
            $sender->sendMessage(TF::RED . "No permission");
            return false;
        }

        $item = $sender->getInventory()->getItemInHand();
        $enchants = $item->getEnchantments();
        $enchantsList = null;
        if(count($enchants) > 0) {
            foreach ($item->getEnchantments() as $enchant) {
                $enchantsList .= TF::GREEN . $enchant->getType()->getName() . " " . TF::WHITE . $enchant->getLevel() . TF::EOL;
            }
        }
        if(count($enchants) > 0) {
            $this->plugin->getServer()->broadcastMessage(Variables::SERVER_PREFIX . $sender->getName() . " is bragging " . TF::DARK_GRAY . "[" . TF::WHITE . $item->getCount() . "x " . $item->getName() . TF::RESET . TF::DARK_GRAY . "]" . TF::EOL . $enchantsList);
        } else {
            $this->plugin->getServer()->broadcastMessage(Variables::SERVER_PREFIX . $sender->getName() . " is bragging " . TF::DARK_GRAY . "[" . TF::WHITE . $item->getCount() . "x " . $item->getName() . TF::RESET . TF::DARK_GRAY . "]");
        }
        return true;
    }
}