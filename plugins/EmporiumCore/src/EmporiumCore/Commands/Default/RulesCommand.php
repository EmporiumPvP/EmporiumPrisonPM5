<?php

namespace EmporiumCore\Commands\Default;

use EmporiumCore\Managers\Data\DataManager;

use Forms\RulesForm;
# POCKETMINE
use pocketmine\utils\TextFormat;
use pocketmine\world\sound\EnderChestOpenSound;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\player\Player;

class RulesCommand extends Command {

    public function __construct() {
        parent::__construct("rules", "Opens the RulesForms Menu", "/rules");
        $this->setPermission("emporiumcore.command.rules");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {

        if(!$sender instanceof Player) {
            return false;
        }

        $permission = DataManager::getData($sender, "Permissions", "emporiumcore.command.rules");
        if ($permission === false) {
            $sender->sendMessage(TextFormat::RED . "No permission");
            return false;
        }

        $rulesForm = new RulesForm();
        $rulesForm->Form($sender);
        $sender->broadcastSound(new EnderChestOpenSound());
        return true;
    }

} # END OF CLASS