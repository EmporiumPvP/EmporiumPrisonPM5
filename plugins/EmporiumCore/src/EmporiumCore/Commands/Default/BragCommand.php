<?php

namespace EmporiumCore\Commands\Default;

use EmporiumCore\EmporiumCore;

use EmporiumCore\managers\data\DataManager;
use EmporiumCore\Variables;

use pocketmine\player\Player;
use pocketmine\command\{Command, CommandSender};
use pocketmine\utils\TextFormat;

class BragCommand extends Command {

    private EmporiumCore $plugin;

    public function __construct(EmporiumCore $plugin) {
        parent::__construct("brag", "Brag about an item.", "/brag [view]");
        $this->setPermission("emporiumcore.command.brag");
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {

        if(!$sender instanceof Player) {
            return false;
        }

        $permission = DataManager::getData($sender, "Permissions", "emporiumcore.command.brag");
        if ($permission === false) {
            $sender->sendMessage(TextFormat::RED . "No permission");
            return false;
        }

        if (isset($args[0])) {
            if (strtolower($args[0]) === "view" || strtolower($args[0]) === "v") {
                $sender->sendMessage("§cComing Soon!");
                return true;
            }
        }

        $item = $sender->getInventory()->getItemInHand();
        $this->plugin->getServer()->broadcastMessage(Variables::SERVER_PREFIX . $sender->getName() . " is bragging §8[§f" . $item->getCount() . "x " . $item->getName() . "§r§8]§7.");
        return true;
    }
}