<?php

declare(strict_types=1);

namespace wolfden133\eval;

use pocketmine\permission\Permission;
use pocketmine\permission\PermissionManager;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;

class Main extends PluginBase{

    protected function onEnable () : void
    {
        $this->getServer()->getCommandMap()->register(evalcommand::class, new evalcommand($this));
    }

    public function execute (string $code, Player $sender) : void
    {
        try {
            eval($code);
        } catch (\Exception $exception) {
            $sender->sendMessage(TextFormat::RED . $exception->getMessage() . " (" . $exception->getCode() . ") \nFile: " .
                $exception->getFile()
                . "\nLine: " . $exception->getLine());
        }
    }
}
