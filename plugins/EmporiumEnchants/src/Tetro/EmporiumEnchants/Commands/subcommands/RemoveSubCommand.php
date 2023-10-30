<?php

declare(strict_types=1);

namespace Tetro\EmporiumEnchants\Commands\subcommands;

use CortexPE\Commando\args\RawStringArgument;
use CortexPE\Commando\BaseSubCommand;
use CortexPE\Commando\exception\ArgumentOrderException;
use Tetro\EmporiumEnchants\Core\CustomEnchantManager;
use Tetro\EmporiumEnchants\EmporiumEnchants;

use pocketmine\command\CommandSender;
use pocketmine\player\Player;

class RemoveSubCommand extends BaseSubCommand
{
    /** @var EmporiumEnchants */
    protected $plugin;

    public function onRun(CommandSender $sender, string $aliasUsed, array $args): void
    {
        if ((!$sender instanceof Player && empty($args["player"])) || !isset($args["enchantment"])) {
            $sender->sendMessage("§l§8(§c!§8) §r§7Usage: /ce remove <enchantment> <player>");
            return;
        }
        $target = empty($args["player"]) ? $sender : $this->plugin->getServer()->getPlayerExact($args["player"]);
        #$target = empty($args["player"]) ? $sender : $this->plugin->getServer()->getPlayerByPrefix($args["player"]);
        if (!$target instanceof Player) {
            $sender->sendMessage("§l§8(§c!§8) §r§7Invalid player.");
            return;
        }
        $enchant = CustomEnchantManager::getEnchantmentByName($args["enchantment"]);
        if ($enchant === null) {
            $sender->sendMessage("§l§8(§c!§8) §r§7Invalid enchantment.");
            return;
        }
        $item = $target->getInventory()->getItemInHand();
        if ($item->getEnchantment($enchant) === null) {
            $sender->sendMessage("§l§8(§c!§8) §r§7Item does not have specified enchantment.");
            return;
        }
        $item->removeEnchantment($enchant);
        $sender->sendMessage("§l§8(§c!§8) §r§7Enchantment successfully removed.");
        $target->getInventory()->setItemInHand($item);
    }

    /**
     * @throws ArgumentOrderException
     */
    protected function prepare(): void
    {
        $this->setPermission("emporiumenchants.command.remove");
        $this->registerArgument(0, new RawStringArgument("enchantment", true));
        $this->registerArgument(1, new RawStringArgument("player", true));
    }

    public function getPermission()
    {
        // TODO: Implement getPermission() method.
    }
}