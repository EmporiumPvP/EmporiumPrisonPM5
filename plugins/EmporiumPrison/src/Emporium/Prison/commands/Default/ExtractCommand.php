<?php

namespace Emporium\Prison\commands\Default;

use Emporium\Prison\EmporiumPrison;
use Emporium\Prison\Managers\misc\Translator;
use Emporium\Prison\Variables;

use EmporiumData\DataManager;
use EmporiumData\PermissionsManager;

use pocketmine\block\Air;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\item\Item;
use pocketmine\item\VanillaItems;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;
use pocketmine\world\sound\XpCollectSound;

use Tetro\EmporiumEnchants\EmporiumEnchants;

class ExtractCommand extends Command {

    public function __construct() {
        parent::__construct("extract", "Extract energy from an item", "/extract");
        $this->setPermission("emporiumprison.command.extract");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): void {

        if(!$sender instanceof Player) return;

        $permission = PermissionsManager::getInstance()->checkPermission($sender->getXuid(), $this->getPermissions());
        if(!$permission) {
            $sender->sendMessage(Variables::NO_PERMISSION_MESSAGE);
            return;
        }

        $item = $sender->getInventory()->getItemInHand();

        if($item instanceof Air) {
            $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "(" . TF::RED . "!" . TF::DARK_GRAY . ") " . TF::RESET . TF::RED . "Hold the Item you want to extract Energy from.");
        }

        # check item type
        if($item->getNamedTag()->getTag("Energy") === null) {
            $sender->sendMessage(TF::BOLD . TF::DARK_GRAY . "(" . TF::RED . "!" . TF::DARK_GRAY . ") " . TF::RESET . TF::RED . "You can not extract energy from that item");
            return;
        }

        if($item->getNamedTag()->getInt("Energy") <= 0) {
            $sender->sendMessage(TF::RED . "That item doesn't have any energy to extract");
            return;
        }

        $prestige = DataManager::getInstance()->getPlayerData($sender->getXuid(), "profile.prestige");

        $energy = 0;

        # normal tax (10%)
        if($prestige < 1) {
            $energy = round($item->getNamedTag()->getInt("Energy") * ((100-10) / 100));
        }

        # 50% tax prestige 1+ (5%)
        if($prestige >= 1) {
            $energy = round($item->getNamedTag()->getInt("Energy") * ((100-5) / 100));
        }
        $newOrb = (EmporiumPrison::getInstance()->getOrbs())->EnergyOrb($energy);

        if($item->getNamedTag()->getTag("PickaxeType")) {

            # remove energy from pickaxe
            $item->getNamedTag()->setInt("Energy", 0);

            # remove pickaxe from inventory
            $sender->getInventory()->setItemInHand(VanillaItems::AIR());

            # generate new items;
            $updatedItem = EmporiumPrison::getInstance()->getPickaxeManager()->updatePickaxe($item);

            # give player energy
            $this->giveToPlayer($sender, $newOrb, $energy, $updatedItem, $prestige);
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
            $this->giveToPlayer($sender, $newOrb, $energy, $updatedItem, $prestige);
        }
    }

    private function giveToPlayer(Player $sender, Item $orb, int $discountedEnergy, Item $updatedItem, int $prestige) : void
    {
        # give player item
        $sender->getInventory()->setItemInHand($updatedItem);

        # give player energy orb
        if($sender->getInventory()->canAddItem($orb)) $sender->getInventory()->addItem($orb);
        else $sender->getWorld()->dropItem($sender->getLocation(), $orb);

        # play sound
        $sender->broadcastSound(new XpCollectSound(), [$sender]);

        # send message
        $sender->sendMessage(Variables::SERVER_PREFIX . TF::GRAY . "You extracted " . TF::WHITE . Translator::shortNumber($discountedEnergy) . TF::AQUA . " Energy " . TF::GRAY . "from an enchantment book");
        if($prestige > 0) {
            $sender->sendMessage(TF::RED . "(!) You lose 5% of the Energy when using this command");
            return;
        }

        $sender->sendMessage(TF::RED . "(!) You lose 10% of the Energy when using this command");
    }
}