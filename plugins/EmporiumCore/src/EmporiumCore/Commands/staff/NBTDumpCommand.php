<?php

namespace EmporiumCore\Commands\Staff;

use EmporiumData\Provider\JsonProvider;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\data\bedrock\LegacyItemIdToStringIdMap;
use pocketmine\nbt\LittleEndianNbtSerializer;
use pocketmine\nbt\TreeRoot;
use pocketmine\permission\DefaultPermissions;
use pocketmine\player\Player;
use pocketmine\Server;

class NBTDumpCommand extends Command
{
    public function __construct()
    {
        parent::__construct("nbtdump");
        $this->setPermission("nbtdump.command");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if (!$sender instanceof Player) return;
        if (!$sender->hasPermission(DefaultPermissions::ROOT_OPERATOR)) return;
        if (empty($args) || count($args) != 1) return;
        foreach ($sender->getInventory()->getContents() as $item) {
            $items[] = (LegacyItemIdToStringIdMap::getInstance()->legacyToString($item->getId()) ?? "air") . ";" . $item->getMeta() . ";" . $item->getCount() . ";" . bin2hex((new LittleEndianNbtSerializer())->write(new TreeRoot($item->getNamedTag())));
        }

        if (!is_dir(JsonProvider::$SERVER_FOLDER . "boss")) mkdir(JsonProvider::$SERVER_FOLDER . "boss");
        file_put_contents(JsonProvider::$SERVER_FOLDER . "boss/drops_$args[0].txt", implode(" ", $items));
        $sender->sendMessage("Dumped to drops_$args[0].txt");
    }
}