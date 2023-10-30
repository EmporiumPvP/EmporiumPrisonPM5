<?php

namespace Emporium\Prison\commands\Default;

use Emporium\Prison\EmporiumPrison;
use Emporium\Prison\Variables;

use EmporiumData\PermissionsManager;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;

class EventsCommand extends Command
{

    public function __construct()
    {
        parent::__construct("events", "opens the events menu", "/events");
        $this->setPermission("emporiumprison.command.events");
        $this->setPermissionMessage(Variables::NO_PERMISSION_MESSAGE);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        # check sender
        if(!$sender instanceof Player) return;

        # check permission
        $permission = PermissionsManager::getInstance()->checkPermission($sender->getXuid(), $this->getPermissions());
        #if(!$permission) return;

        # send menu
        EmporiumPrison::getInstance()->getEvents()->Menu($sender);
    }
}