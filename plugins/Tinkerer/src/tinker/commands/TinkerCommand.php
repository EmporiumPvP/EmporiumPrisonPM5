<?php

namespace tinker\commands;

use EmporiumCore\Managers\Data\DataManager;
use JsonException;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\item\ItemIds;
use pocketmine\item\VanillaItems;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;
use pocketmine\world\sound\XpLevelUpSound;
use Tetro\EmporiumEnchants\Core\CustomEnchant;

class TinkerCommand extends Command {

    public function __construct() {
        parent::__construct("tinker", "Check a players balance.", "/tinker");
        $this->setPermission("emporiumtinker.command.tinker");
    }

    /**
     * @throws JsonException
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args) {

        if(!$sender instanceof Player) {
            return;
        }

        $permission = DataManager::getData($sender, "Permissions", "emporiumtinker.command.tinker");

        if(!$permission) {
            $sender->sendMessage(TF::RED . "You need a higher rank to use that, please visit the Tinkerer at " . TF::AQUA . "/shop");
            return;
        }

        $item = $sender->getInventory()->getItemInHand();
        if($item->getId() === ItemIds::ENCHANTED_BOOK && count($item->getEnchantments()) > 0) {
            $cexp = 0;

            foreach ($item->getEnchantments() as $enchant) {
                $rarity = $enchant->getType()->getRarity();
                $level = $enchant->getLevel();
                $number = 1 . $level;
                $multiplier = number_format($number / 10, 1);
                switch ($rarity) {

                    case CustomEnchant::RARITY_ELITE:
                        $cexp = 500 * $multiplier;
                        break;

                    case CustomEnchant::RARITY_ULTIMATE:
                        $cexp = 1000 * $multiplier;
                        break;

                    case CustomEnchant::RARITY_LEGENDARY:
                        $cexp = 2500 * $multiplier;
                        break;

                    case CustomEnchant::RARITY_GODLY:
                        $cexp = 5000 * $multiplier;
                        break;

                    case CustomEnchant::RARITY_HEROIC:
                        $cexp = 7500 * $multiplier;
                        break;

                    case CustomEnchant::RARITY_EXECUTIVE:
                        $cexp = 10000 * $multiplier;
                        break;
                }
            }
            $count = count($item->getEnchantments());
            $totalCexp = $cexp * $count;

            $sender->sendMessage(TF::GREEN . "You Tinkered an Enchantment Book " . TF::AQUA . "+$totalCexp CEXP");
            $sender->broadcastSound(new XpLevelUpSound(30), [$sender]);
            $sender->getInventory()->setItemInHand(VanillaItems::AIR());
            DataManager::addData($sender, "Players", "Cexp", $totalCexp);
        } else {
            $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "You are not holding an enchantment book");
        }
    }
}