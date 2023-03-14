<?php

namespace EmporiumCore\Commands\Default;


use Emporium\Prison\library\formapi\CustomForm;
use Emporium\Prison\library\formapi\SimpleForm;
use EmporiumCore\Managers\Data\DataManager;
use Menus\CustomEnchantMenu;
use pocketmine\item\ItemFactory;
use pocketmine\player\Player;
use pocketmine\command\{Command, CommandSender};

class CustomEnchantShopCommand extends Command {

    # Command Constructor
    public function __construct() {
        parent::__construct("ceshop", "Purchase custom enchants from the shop.", "/ceshop", ["cs"]);
        $this->setPermission("emporiumcore.command.ceshop");
    }

    # Command Code
    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {
        // Check for Permissions
        if (!$this->testPermissionSilent($sender)) {
            $sender->sendMessage("§cYou do not have permission to use this command.");
            return false;
        }
        // Check Player
        if (!$sender instanceof Player) {
            $sender->sendMessage("§cYou may only run this command in-game!");
            return false;
        }
        // Execute Command
        $menu = new CustomEnchantMenu();
        $menu->Form($sender);
        return true;
    }
}