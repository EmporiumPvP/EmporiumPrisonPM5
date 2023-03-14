<?php

namespace Tetro\EmporiumEnchants\Commands;

use pocketmine\command\CommandSender;

use Tetro\EmporiumEnchants\Utils\Commando\BaseCommand;
use Tetro\EmporiumEnchants\Utils\Commando\BaseSubCommand;
use Tetro\EmporiumEnchants\Commands\subcommands\EnchantSubCommand;
use Tetro\EmporiumEnchants\Commands\subcommands\InfoSubCommand;
use Tetro\EmporiumEnchants\Commands\subcommands\ListSubCommand;
use Tetro\EmporiumEnchants\Commands\subcommands\RemoveSubCommand;
use Tetro\EmporiumEnchants\Loader;

class CustomEnchantsCommand extends BaseCommand
{
    /** @var Loader */
    protected $plugin;

    public function onRun(CommandSender $sender, string $aliasUsed, array $args): void
    {
        $subcommands = array_values(array_map(function (BaseSubCommand $subCommand): string {
            return $subCommand->getName();
        }, $this->getSubCommands()));
        $sender->sendMessage("§l§8(§c!§8) §r§7Usage: /ce <" . implode("|", $subcommands) . ">");
    }

    public function prepare(): void
    {
        $this->registerSubCommand(new EnchantSubCommand($this->plugin, "enchant", "Apply an enchantment on an item"));
        $this->registerSubCommand(new InfoSubCommand($this->plugin, "info", "Get info on a custom enchant"));
        $this->registerSubCommand(new ListSubCommand($this->plugin, "list", "Lists all registered custom enchants"));
        $this->registerSubCommand(new RemoveSubCommand($this->plugin, "remove", "Remove an enchantment from an item"));
    }
}
