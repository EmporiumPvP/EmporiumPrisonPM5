<?php

namespace Emporium\Prison\commands\Default;

use Emporium\Prison\EmporiumPrison;
use Emporium\Prison\Managers\misc\Translator;
use Emporium\Prison\Variables;

use pocketmine\block\Air;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\item\Item;
use pocketmine\item\ItemIds;
use pocketmine\item\Pickaxe;
use pocketmine\item\VanillaItems;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;
use pocketmine\world\sound\XpCollectSound;

use Tetro\EmporiumEnchants\EmporiumEnchants;

class ExtractCommand extends Command {

    public function __construct() {
        parent::__construct("extract", "Extract energy from a Pickaxe", "/extract");
        $this->setPermission("emporiumprison.command.extract");
        $this->setPermissionMessage(TF::BOLD . TF::RED . "(!) " . TF::RED . "No permission.");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): void {

        if(!$sender instanceof Player) return;

        $item = $sender->getInventory()->getItemInHand();

        if($item instanceof Air) {
            $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "Hold the Item you want to extract Energy from.");
        }

        # check item type
        if($item->getNamedTag()->getTag("Energy") === null) {
            $sender->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RED . "You can not extract energy from that item");
            return;
        }

        if($item->getNamedTag()->getInt("Energy") <= 0) {
            $sender->sendMessage(TF::RED . "That item doesn't have any energy to extract");
            return;
        }

        $discountedEnergy = round($item->getNamedTag()->getInt("Energy") * ((100-10) / 100));
        $newOrb = (EmporiumPrison::getInstance()->getOrbs())->EnergyOrb($discountedEnergy);

        if($item->getNamedTag()->getTag("PickaxeType")) {
            # remove energy from pickaxe
            $item->getNamedTag()->setInt("Energy", 0);
            # remove pickaxe from inventory
            $sender->getInventory()->setItemInHand(VanillaItems::AIR());
            # generate new items;
            $updatedItem = EmporiumPrison::getInstance()->getPickaxeManager()->updatePickaxe($item);
            # give player energy
            $this->giveToPlayer($sender, $newOrb, $discountedEnergy, $updatedItem);
            return;
        }

        if($item->getNamedTag()->getInt("CustomEnchantBook")) {
            # remove energy from book
            $item->getNamedTag()->setInt("Energy", 0);
            # remove book from inventory
            $sender->getInventory()->setItemInHand(VanillaItems::AIR());
            # generate new item
            $updatedItem = EmporiumEnchants::getInstance()->getBookManager()->updateBook($item);
            # give player items
            $this->giveToPlayer($sender, $newOrb, $discountedEnergy, $updatedItem);
            return;
        }
    }

    private function giveToPlayer(Player $sender, Item $orb, int $discountedEnergy, Item $updatedItem) : void
    {
        // Give player pickaxe or book
        $sender->getInventory()->setItemInHand($updatedItem);

        // Give player energy orb
        if($sender->getInventory()->canAddItem($orb)) $sender->getInventory()->addItem($orb);
        else $sender->getWorld()->dropItem($sender->getLocation(), $orb);

        # play sound
        $sender->broadcastSound(new XpCollectSound(), [$sender]);
        # send message
        $sender->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You extracted " . TF::WHITE . Translator::shortNumber($discountedEnergy) . TF::AQUA . " Energy " . TF::GRAY . "from an enchantment book");
        $sender->sendMessage(TF::RED . "(!) You lose 10% of the Energy when using this command");
    }
}