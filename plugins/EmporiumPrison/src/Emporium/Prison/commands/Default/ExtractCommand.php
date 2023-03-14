<?php

namespace Emporium\Prison\commands\Default;

use Emporium\Prison\EmporiumPrison;
use Emporium\Prison\items\Orbs;
use Emporium\Prison\Managers\misc\Translator;
use Emporium\Prison\Managers\PickaxeManager;
use Emporium\Prison\Variables;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\item\ItemIds;
use pocketmine\item\Pickaxe;
use pocketmine\item\VanillaItems;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;
use pocketmine\world\sound\XpCollectSound;

use Tetro\EmporiumEnchants\Core\BookManager;
use Tetro\EmporiumEnchants\Loader;

class ExtractCommand extends Command {

    private PickaxeManager $pickaxeManager;
    private BookManager $bookManager;
    private Orbs $orb;

    public function __construct() {
        parent::__construct("extract", "Extract energy from a Pickaxe", "/extract");
        $this->setPermission("emporiumprison.command.extract");
        $this->setPermissionMessage(Variables::ERROR_PREFIX . TextFormat::RED . "No permission.");
        # managers
        $this->pickaxeManager = EmporiumPrison::getPickaxeManager();
        $this->bookManager = Loader::getBookManager();
        $this->orb = EmporiumPrison::getOrbs();
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {

        if(!$sender instanceof Player) {
            return false;
        }
        # item
        $item = $sender->getInventory()->getItemInHand();
        # check item type
        if($item instanceof Pickaxe) {
            if($item->getNamedTag()->getTag("Energy") !== null) {
                $energy = $item->getNamedTag()->getInt("Energy");
                # remove energy from pickaxe
                $item->getNamedTag()->setInt("Energy", 0);
                $this->pickaxeManager->updatePickaxeSetInHand($sender, $item);
                # create energy orb
                $discountedEnergy = round($energy * ((100-10) / 100));
                $item = $this->orb->EnergyOrb($discountedEnergy);
                # give player energy
                if($sender->getInventory()->canAddItem($item)) {
                    $sender->getInventory()->addItem($item);
                } else {
                    $sender->getWorld()->dropItem($sender->getLocation(), $item);
                }
                # play sound
                $sender->broadcastSound(new XpCollectSound(), [$sender]);
                # send message
                $sender->sendMessage(Variables::SERVER_PREFIX . TextFormat::GRAY . "You extracted " . TextFormat::WHITE . Translator::shortNumber($discountedEnergy) . TextFormat::AQUA . " Energy " . TextFormat::GRAY . "from your pickaxe.");
                $sender->sendMessage(TextFormat::RED . "(!) You lose 10% of the Energy when using this command");
                return true;
            } else {
                $sender->sendMessage(Variables::ERROR_PREFIX . TextFormat::RED . "That is not a Valid Pickaxe");
                return false;
            }
        }

        if($item->getId() === ItemIds::ENCHANTED_BOOK) {
            if($item->getNamedTag()->getTag("Energy") !== null) {
                $energy = $item->getNamedTag()->getInt("Energy");
                # remove energy from pickaxe
                $item->getNamedTag()->setInt("Energy", 0);
                $updatedItem = $this->bookManager->updateBook($item);
                $sender->getInventory()->setItemInHand(VanillaItems::AIR());
                # create energy orb
                $discountedEnergy = round($energy * ((100-10) / 100));
                $newOrb = $this->orb->EnergyOrb($discountedEnergy);
                # give player energy
                if($sender->getInventory()->canAddItem($newOrb)) {
                    $sender->getInventory()->addItem($newOrb);
                } else {
                    $sender->getWorld()->dropItem($sender->getLocation(), $newOrb);
                }
                # give player book
                if($sender->getInventory()->canAddItem($updatedItem)) {
                    $sender->getInventory()->addItem($updatedItem);
                } else {
                    $sender->getWorld()->dropItem($sender->getLocation(), $updatedItem);
                }
                # play sound
                $sender->broadcastSound(new XpCollectSound(), [$sender]);
                # send message
                $sender->sendMessage(Variables::SERVER_PREFIX . TextFormat::GRAY . "You extracted " . TextFormat::WHITE . Translator::shortNumber($discountedEnergy) . TextFormat::AQUA . " Energy " . TextFormat::GRAY . "from an enchantment book");
                $sender->sendMessage(TextFormat::RED . "(!) You lose 10% of the Energy when using this command");

                return true;
            }
        }
        $sender->sendMessage(Variables::SERVER_PREFIX . TextFormat::GRAY . "Hold the Item you want to extract Energy from.");
        return false;
    }
}