<?php

namespace EmporiumCore\Commands\Default;

use EmporiumCore\Managers\Data\DataManager;
use Forms\KitsForm;
# POCKETMINE
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\player\Player;

use pocketmine\utils\TextFormat;
use pocketmine\world\sound\EnderChestOpenSound;

class KitsCommand extends Command {

    public function __construct() {
        parent::__construct("kits", "Opens the RankKits Menu", "/kits");
        $this->setPermission("emporiumcore.command.kits");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {

        if(!$sender instanceof Player) {
            return false;
        }

        $permission = DataManager::getData($sender, "Permissions", "emporiumcore.command.kits");
        if ($permission === false) {
            $sender->sendMessage(TextFormat::RED . "No permission");
            return false;
        }

        $kitsForm = new KitsForm();
        $kitsForm->Form($sender);
        $sender->broadcastSound(new EnderChestOpenSound());
        return true;

    }

} # END OF CLASS