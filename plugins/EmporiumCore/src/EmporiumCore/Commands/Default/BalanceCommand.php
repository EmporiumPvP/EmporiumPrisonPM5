<?php

namespace EmporiumCore\Commands\Default;

use Emporium\Prison\Managers\Misc\Translator;
use EmporiumCore\EmporiumCore;
use EmporiumCore\Variables;
use EmporiumData\DataManager;
use EmporiumData\PermissionsManager;
use pocketmine\command\{Command, CommandSender};
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;

class BalanceCommand extends Command {

    private EmporiumCore $plugin;

    public function __construct(EmporiumCore $plugin) {
        parent::__construct("balance", "Check a players balance.", "/balance [player]", ["bal"]);
        $this->setPermission("emporiumcore.command.balance");
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {

        # check sender
        if(!$sender instanceof Player) {
            return false;
        }

        $permission = PermissionsManager::getInstance()->checkPermission($sender->getXuid(), "emporiumcore.command.balance");
        # check permission
        if (!$permission) {
            $sender->sendMessage(TF::RED . "No permission");
            return false;
        }

        if (isset($args[0])) {
            $player = $this->plugin->getServer()->getPlayerExact($args[0]);
            if ($player instanceof Player) {
                $balance = DataManager::getInstance()->getPlayerData($sender->getXuid(), "profile.money");
                $sender->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "{$player->getName()}'s balance: " . TF::GREEN . "$" . TF::WHITE . Translator::shortNumber($balance));
                return true;
            }
            $sender->sendMessage(Variables::SERVER_PREFIX . "§r§7That player cannot be found.");
            return false;
        }

        $balance = DataManager::getInstance()->getPlayerData($sender->getXuid(), "profile.money");
        $sender->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "Your balance: " . TF::GREEN . "$" . TF::WHITE . Translator::shortNumber($balance));
        return true;
    }
}