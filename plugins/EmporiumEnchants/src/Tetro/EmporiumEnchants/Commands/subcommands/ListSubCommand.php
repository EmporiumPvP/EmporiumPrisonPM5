<?php

declare(strict_types=1);

namespace Tetro\EmporiumEnchants\Commands\subcommands;

use CortexPE\Commando\BaseSubCommand;
use Tetro\EmporiumEnchants\Core\CustomEnchantManager;
use Tetro\EmporiumEnchants\Core\CustomEnchant;
use Tetro\EmporiumEnchants\EmporiumEnchants;
use Tetro\EmporiumEnchants\Utils\Utils;

use pocketmine\command\CommandSender;
use pocketmine\Utils\TextFormat;

class ListSubCommand extends BaseSubCommand
{
    /** @var EmporiumEnchants */
    protected $plugin;

    public function onRun(CommandSender $sender, string $aliasUsed, array $args): void
    {

        $sender->sendMessage($this->getCustomEnchantList());
    }

    /**
     * @return CustomEnchant[][]
     */
    public function getEnchantmentsByType(): array
    {
        $enchantmentsByType = [];
        foreach (CustomEnchantManager::getEnchantments() as $enchantment) {
            if (!isset($enchantmentsByType[$enchantment->getItemType()])) $enchantmentsByType[$enchantment->getItemType()] = [];
            $enchantmentsByType[$enchantment->getItemType()][] = $enchantment;
        }
        return array_map(function (array $typeEnchants) {
            uasort($typeEnchants, function (CustomEnchant $a, CustomEnchant $b) {
                return strcmp($a->getDisplayName(), $b->getDisplayName());
            });
            return $typeEnchants;
        }, $enchantmentsByType);
    }

    public function getCustomEnchantList(): string
    {
        $enchantmentsByType = $this->getEnchantmentsByType();
        $listString = "";
        foreach (Utils::TYPE_NAMES as $type => $name) {
            if (isset($enchantmentsByType[$type])) {
                $listString .= TextFormat::EOL . "§l§4------§c " . Utils::TYPE_NAMES[$type] . " §4------§r" . TextFormat::EOL;
                $listString .= implode(", ", array_map(function (CustomEnchant $enchant) {
                    return $enchant->getDisplayName();
                }, $enchantmentsByType[$type]));
            }
        }
        return $listString;
    }

    public function prepare(): void
    {
        $this->setPermission("emporiumenchants.command.list");
    }

    public function getPermission()
    {
        // TODO: Implement getPermission() method.
    }
}