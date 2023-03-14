<?php

namespace Emporium\Prison\commands\Default;

use Emporium\Prison\items\Orbs;
use Emporium\Prison\Managers\misc\Translator;
use Emporium\Prison\Managers\PickaxeManager;
use Emporium\Prison\Variables;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\item\Item;
use pocketmine\item\ItemIds;
use pocketmine\item\Pickaxe;
use pocketmine\item\VanillaItems;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;
use pocketmine\world\sound\XpCollectSound;
use Tetro\EmporiumEnchants\Core\BookManager;

class ExtractCommand extends Command {

    public function __construct() {
        parent::__construct("extract", "Extract energy from a Pickaxe", "/extract");
        $this->setPermission("emporiumprison.command.extract");
        $this->setPermissionMessage(Variables::ERROR_PREFIX . TextFormat::RED . "No permission.");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {

        if(!$sender instanceof Player) return false;

        # managers
        $pickaxeManager = new PickaxeManager($sender);
        $bookManager = new BookManager();
        $item = $sender->getInventory()->getItemInHand();
        # check item type

        if($item->getNamedTag()->getTag("Energy") === null) {
            $sender->sendMessage(Variables::ERROR_PREFIX . TextFormat::RED . "That is not a Valid Pickaxe");
            return false;
        }

        $discountedEnergy = round($item->getNamedTag()->getInt("Energy") * ((100-10) / 100));
        $newOrb = (new Orbs())->EnergyOrb($discountedEnergy);

        if($item instanceof Pickaxe) {
            # remove energy from pickaxe
            $item->getNamedTag()->setInt("Energy", 0);
            $pickaxeManager->updatePickaxeSetInHand($item);

            # give player energy
            $this->giveToPlayer($sender, $item, $discountedEnergy);
            return true;
        }

        if($item->getId() == ItemIds::ENCHANTED_BOOK) {
            # remove energy from pickaxe
            $item->getNamedTag()->setInt("Energy", 0);
            $updatedItem = $bookManager->updateBook($item);
            $sender->getInventory()->setItemInHand(VanillaItems::AIR());

            # give player energy
            $this->giveToPlayer($sender, $newOrb, $discountedEnergy, $updatedItem);
            return true;
        }

        $sender->sendMessage(Variables::SERVER_PREFIX . TextFormat::GRAY . "Hold the Item you want to extract Energy from.");
        return false;
    }

    private function giveToPlayer (Player $sender, Item $item, int $discountedEnergy, Item $updatedItem = null) : void
    {
        // Give player first item
        if($sender->getInventory()->canAddItem($item)) $sender->getInventory()->addItem($item);
        else $sender->getWorld()->dropItem($sender->getLocation(), $item);

        // Give optional second item
        if ($updatedItem) {
            if($sender->getInventory()->canAddItem($updatedItem)) $sender->getInventory()->addItem($updatedItem);
            else $sender->getWorld()->dropItem($sender->getLocation(), $updatedItem);
        }

        # play sound
        $sender->broadcastSound(new XpCollectSound(), [$sender]);
        # send message
        $sender->sendMessage(Variables::SERVER_PREFIX . TextFormat::GRAY . "You extracted " . TextFormat::WHITE . Translator::shortNumber($discountedEnergy) . TextFormat::AQUA . " Energy " . TextFormat::GRAY . "from an enchantment book");
        $sender->sendMessage(TextFormat::RED . "(!) You lose 10% of the Energy when using this command");
    }
}