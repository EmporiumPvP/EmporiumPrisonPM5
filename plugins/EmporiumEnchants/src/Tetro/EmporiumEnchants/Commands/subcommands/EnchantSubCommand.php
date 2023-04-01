<?php

declare(strict_types=1);

namespace Tetro\EmporiumEnchants\Commands\subcommands;

use Tetro\EmporiumEnchants\Utils\Commando\args\IntegerArgument;
use Tetro\EmporiumEnchants\Utils\Commando\args\RawStringArgument;
use Tetro\EmporiumEnchants\Utils\Commando\BaseSubCommand;
use Tetro\EmporiumEnchants\Utils\Commando\exception\ArgumentOrderException;
use Tetro\EmporiumEnchants\Core\CustomEnchantManager;
use Tetro\EmporiumEnchants\EmporiumEnchants;
use Tetro\EmporiumEnchants\Utils\Utils;
use pocketmine\command\CommandSender;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\ItemIds;
use pocketmine\player\Player;
use pocketmine\Utils\TextFormat;
use Ramsey\Uuid\Uuid;

class EnchantSubCommand extends BaseSubCommand
{
    /** @var EmporiumEnchants */
    protected $plugin;

    public function onRun(CommandSender $sender, string $aliasUsed, array $args): void
    {
        if ((!$sender instanceof Player && empty($args["player"])) || !isset($args["enchantment"])) {
            $sender->sendMessage("§l§8(§c!§8) §r§7Usage: /ce enchant <enchantment> <level> <player>");
            return;
        }
        $args["level"] = empty($args["level"]) ? 1 : $args["level"];
        if (!is_int($args["level"])) {
            $sender->sendMessage("§l§8(§c!§8) §r§7Enchantment level must be an integer.");
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
        if ($sender->getName() != "Tetro") {
            if (!Utils::itemMatchesItemType($item, $enchant->getItemType())) {
                $sender->sendMessage("§l§8(§c!§8) §r§7The item is not compatible with this enchant.");
                return;
            }
            if ($args["level"] > $enchant->getMaxLevel()) {
                $sender->sendMessage("§l§8(§c!§8) §r§7The max level is " . $enchant->getMaxLevel() . ".");
                return;
            }
            if ($item->getCount() > 1) {
                $sender->sendMessage("§l§8(§c!§8) §r§7You can only enchant one item at a time.");
                return;
            }
            if (!Utils::checkEnchantIncompatibilities($item, $enchant)) {
                $sender->sendMessage("§l§8(§c!§8) §r§7This enchant is not compatible with another enchant.");
                return;
            }
        }
        if ($item->getId() === ItemIds::ENCHANTED_BOOK || $item->getId() === ItemIds::BOOK) {
            $item->getNamedTag()->setString("PiggyCEBookUUID", Uuid::uuid4()->toString());
        }
        $item->addEnchantment(new EnchantmentInstance($enchant, $args["level"]));
        $sender->sendMessage("§l§8(§c!§8) §r§7Item successfully enchanted.");
        $target->getInventory()->setItemInHand($item);
    }

    /**
     * @throws ArgumentOrderException
     */
    public function prepare(): void
    {
        $this->setPermission("emporiumenchants.command.enchant");
        $this->registerArgument(0, new RawStringArgument("enchantment", true));
        $this->registerArgument(1, new IntegerArgument("level", true));
        $this->registerArgument(2, new RawStringArgument("player", true));
    }
}