<?php

namespace wolfden133\eval;

use pocketmine\lang\Translatable;
use pocketmine\player\Player;

class evalcommand extends \pocketmine\command\Command
{
    public function __construct (Main $main) { parent::__construct('eval'); $this->setPermission('eval.use');
        $this->plugin = $main;}

    /**
     * @inheritDoc
     */
    public function execute (\pocketmine\command\CommandSender $sender, string $commandLabel, array $args)
    {
        if ($sender instanceof Player) {
            $this->plugin->execute(implode(' ', $args), $sender);
        }
    }
}