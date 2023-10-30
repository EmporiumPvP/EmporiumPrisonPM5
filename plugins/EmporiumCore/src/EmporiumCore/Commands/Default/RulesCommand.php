<?php

namespace EmporiumCore\Commands\Default;

use Emporium\Prison\Variables;
use EmporiumCore\EmporiumCore;
use EmporiumData\PermissionsManager;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;
use pocketmine\world\sound\EnderChestOpenSound;

# POCKETMINE

class RulesCommand extends Command {

    public function __construct() {
        parent::__construct("rules", "Opens the RulesForms Menu", "/rules");
        $this->setPermission("emporiumcore.command.rules");
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

        $rulesForm = EmporiumCore::getInstance()->getRulesMenu();
        $rulesForm->Form($sender);
        $sender->broadcastSound(new EnderChestOpenSound());
        return true;
    }

} # END OF CLASS