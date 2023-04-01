<?php

declare(strict_types=1);

namespace Tetro\EmporiumEnchants\Commands\subcommands;

use Tetro\EmporiumEnchants\Utils\Commando\args\RawStringArgument;
use Tetro\EmporiumEnchants\Utils\Commando\BaseSubCommand;
use Tetro\EmporiumEnchants\Utils\Commando\exception\ArgumentOrderException;
use Tetro\EmporiumEnchants\Core\CustomEnchantManager;
use Tetro\EmporiumEnchants\EmporiumEnchants;
use Tetro\EmporiumEnchants\Utils\Utils;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\Utils\TextFormat;

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
        $target = empty($args["player"]) ? $sender : $this->plugin->getServer()->getPlayerByPrefix($args["player"]);
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
}