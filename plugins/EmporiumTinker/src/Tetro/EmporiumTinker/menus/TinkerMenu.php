<?php

namespace Tetro\EmporiumTinker\menus;

use customiesdevs\customies\item\CustomiesItemFactory;

use Emporium\Prison\EmporiumPrison;
use Emporium\Prison\Managers\misc\GlowManager;
use Emporium\Prison\Managers\misc\Translator;
use Emporium\Prison\Variables;

use pocketmine\block\utils\DyeColor;
use pocketmine\world\sound\BarrelCloseSound;
use pocketmine\world\sound\DoorBumpSound;

use Tetro\EmporiumEnchants\Core\CustomEnchant;

use muqsit\invmenu\InvMenu;
use muqsit\invmenu\transaction\InvMenuTransaction;
use muqsit\invmenu\type\InvMenuTypeIds;
use muqsit\invmenu\transaction\InvMenuTransactionResult;

use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\item\VanillaItems;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;
use pocketmine\world\sound\XpCollectSound;

class TinkerMenu {

    private int $totalEnergy = 0;
    private bool $saleComplete = false;

    public function Menu(Player $player): void {
        $menu = InvMenu::create(InvMenuTypeIds::TYPE_DOUBLE_CHEST);
        $menu->setName("Tinker");
        $menu->setListener(function (InvMenuTransaction $transaction) use ($menu, $player): InvMenuTransactionResult {

            # player is accepting energy offered
            if($transaction->getOut()->getNamedTag()->getTag("EnergyOffered")) {
                if($this->totalEnergy === 0) {
                    $player->broadcastSound(new DoorBumpSound(), [$player]);
                    return $transaction->discard();
                }

                # set sale to true
                $this->saleComplete = true;

                # give player energy orb
                if($player->getInventory()->canAddItem((EmporiumPrison::getInstance()->getOrbs()->EnergyOrb($this->totalEnergy)))) {
                    $player->getInventory()->addItem((EmporiumPrison::getInstance()->getOrbs()->EnergyOrb($this->totalEnergy)));
                } else {
                    $player->getWorld()->dropItem($player->getPosition(), (EmporiumPrison::getInstance()->getOrbs()->EnergyOrb($this->totalEnergy)));
                }
                # send confirmation
                $player->sendMessage(TF::BOLD . TF::GOLD . "(!)" . TF::RESET . TF::GOLD . " Tinkerer transformed your items into: " . TF::EOL . TF::GOLD . TF::GOLD . " * " . TF::WHITE . Translator::shortNumber($this->totalEnergy) . TF::AQUA . " Energy");
                # play sound
                $player->broadcastSound(new XpCollectSound(), [$player]);
                # remove menu
                $player->removeCurrentWindow();

                $this->totalEnergy = 0;

                return $transaction->discard();
            }

            # player is adding book
            if($transaction->getIn()->getNamedTag()->getTag("OpenedCustomEnchantBook")) {

                # check if book has an enchant
                if(count($transaction->getIn()->getEnchantments()) == 0) {
                    $player->broadcastSound(new DoorBumpSound(), [$player]);
                    $player->sendMessage(Variables::PREFIX . "Item has no enchants");
                    return $transaction->discard();
                }

                # check if enchant is a custom enchant
                $book = $transaction->getIn();

                if($menu->getInventory()->canAddItem($book)) {

                    # get enchants
                    foreach ($book->getEnchantments() as $enchantment) {
                        $level = $enchantment->getLevel();
                        $rarity = $enchantment->getType()->getRarity();
                    }
                    if(!isset($level)) return $transaction->discard();
                    if(!isset($rarity)) return $transaction->discard();

                    # calculate new value
                    $number = 1 . $level;
                    $multiplier = number_format($number / 10, 1);
                    $rarityValue = match ($rarity) {
                        CustomEnchant::RARITY_ELITE => 500 * $multiplier,
                        CustomEnchant::RARITY_ULTIMATE => 1000 * $multiplier,
                        CustomEnchant::RARITY_LEGENDARY => 2500 * $multiplier,
                        CustomEnchant::RARITY_GODLY => 5000 * $multiplier,
                        CustomEnchant::RARITY_HEROIC => 7500 * $multiplier,
                        CustomEnchant::RARITY_EXECUTIVE => 10000 * $multiplier
                    };
                    $this->totalEnergy += $rarityValue;

                    # update defined item
                    # set new defined item in menu
                    $menu->getInventory()->setItem(4, $this->generateEnergyOfferedItem());
                    $menu->getInventory()->addItem($book);
                    $player->getInventory()->removeItem($book);

                    # play sound to player
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                    return $transaction->continue();
                }

                $player->broadcastSound(new DoorBumpSound(), [$player]);
                return $transaction->discard();

            }

            # player is removing book
            if($transaction->getOut()->getNamedTag()->getTag("OpenedCustomEnchantBook")) {

                # check if enchant is a custom enchant
                $book = $transaction->getOut();

                foreach ($book->getEnchantments() as $enchantment) {
                    $level = $enchantment->getLevel();
                    $rarity = $enchantment->getType()->getRarity();
                }
                if(!isset($level)) return $transaction->discard();
                if(!isset($rarity)) return $transaction->discard();

                # calculate new value
                $number = 1 . $level;
                $multiplier = number_format($number / 10, 1);
                $rarityValue = match ($rarity) {
                    CustomEnchant::RARITY_ELITE => 500 * $multiplier,
                    CustomEnchant::RARITY_ULTIMATE => 1000 * $multiplier,
                    CustomEnchant::RARITY_LEGENDARY => 2500 * $multiplier,
                    CustomEnchant::RARITY_GODLY => 5000 * $multiplier,
                    CustomEnchant::RARITY_HEROIC => 7500 * $multiplier,
                    CustomEnchant::RARITY_EXECUTIVE => 10000 * $multiplier
                };
                $this->totalEnergy -= $rarityValue;

                # set new defined item in menu
                $menu->getInventory()->setItem(4, $this->generateEnergyOfferedItem());

                # play sound
                $player->broadcastSound(new XpCollectSound(), [$player]);
                return $transaction->continue();
            }

            # player is adding orb
            if($transaction->getIn()->getNamedTag()->getTag("OpenedPickaxeEnchantOrb")) {

                # check if orb has an enchant
                if(count($transaction->getIn()->getEnchantments()) == 0) {
                    $player->broadcastSound(new DoorBumpSound(), [$player]);
                    $player->sendMessage("Item has no enchants");
                    return $transaction->discard();
                }

                # check if enchant is a custom enchant
                $orb = $transaction->getIn();

                foreach ($orb->getEnchantments() as $enchantment) {
                    $level = $enchantment->getLevel();
                    $rarity = $enchantment->getType()->getRarity();
                }
                if(!isset($level)) return $transaction->discard();
                if(!isset($rarity)) return $transaction->discard();

                if($menu->getInventory()->canAddItem($orb)) {

                    # calculate new value
                    $number = 1 . $level;
                    $multiplier = number_format($number / 10, 1);
                    $rarityValue = match ($rarity) {
                        CustomEnchant::RARITY_ELITE => 500 * $multiplier,
                        CustomEnchant::RARITY_ULTIMATE => 1000 * $multiplier,
                        CustomEnchant::RARITY_LEGENDARY => 2500 * $multiplier,
                        CustomEnchant::RARITY_GODLY => 5000 * $multiplier,
                        CustomEnchant::RARITY_HEROIC => 7500 * $multiplier,
                        CustomEnchant::RARITY_EXECUTIVE => 10000 * $multiplier
                    };
                    $this->totalEnergy += $rarityValue;

                    # update defined item
                    # set new defined item in menu
                    $menu->getInventory()->setItem(4, $this->generateEnergyOfferedItem());
                    $menu->getInventory()->addItem($orb);

                    # play sound to player
                    $player->broadcastSound(new XpCollectSound(), [$player]);
                    return $transaction->continue();
                }

                $player->broadcastSound(new DoorBumpSound(), [$player]);
                return $transaction->discard();
            }

            # player is removing orb
            if($transaction->getOut()->getNamedTag()->getTag("OpenedPickaxeEnchantOrb")) {

                # check if enchant is a custom enchant
                $orb = $transaction->getOut();

                foreach ($orb->getEnchantments() as $enchantment) {
                    $level = $enchantment->getLevel();
                    $rarity = $enchantment->getType()->getRarity();
                }
                if(!isset($level)) return $transaction->discard();
                if(!isset($rarity)) return $transaction->discard();

                # calculate new value
                $number = 1 . $level;
                $multiplier = number_format($number / 10, 1);
                $rarityValue = match ($rarity) {
                    CustomEnchant::RARITY_ELITE => 500 * $multiplier,
                    CustomEnchant::RARITY_ULTIMATE => 1000 * $multiplier,
                    CustomEnchant::RARITY_LEGENDARY => 2500 * $multiplier,
                    CustomEnchant::RARITY_GODLY => 5000 * $multiplier,
                    CustomEnchant::RARITY_HEROIC => 7500 * $multiplier,
                    CustomEnchant::RARITY_EXECUTIVE => 10000 * $multiplier
                };
                $this->totalEnergy -= $rarityValue;

                # set new defined item in menu
                $menu->getInventory()->setItem(4, $this->generateEnergyOfferedItem());

                # change items
                #$player->getInventory()->addItem($orb);
                #$menu->getInventory()->remove($orb);

                # play sound
                $player->broadcastSound(new XpCollectSound(), [$player]);
                return $transaction->continue();
            } else {
                $player->broadcastSound(new DoorBumpSound(), [$player]);
                $player->sendMessage(Variables::PREFIX . "You can only offer Enchant Books and Orbs");
            }

            return $transaction->discard();
        });
        $menu->setInventoryCloseListener(function(Player $player, Inventory $inventory) {
            if(!$this->saleComplete) {
                foreach ($inventory->getContents() as $item) {
                    if($item->getNamedTag()->getTag("LockedCustomEnchantBook")) {
                        $player->getInventory()->addItem($item);
                    }
                    if($item->getNamedTag()->getTag("OpenedCustomEnchantBook")) {
                        $player->getInventory()->addItem($item);
                    }
                    if($item->getNamedTag()->getTag("LockedPickaxeEnchantOrb")) {
                        $player->getInventory()->addItem($item);
                    }
                    if($item->getNamedTag()->getTag("OpenedPickaxeEnchantOrb")) {
                        $player->getInventory()->addItem($item);
                    }
                }

                $player->sendMessage(Variables::PREFIX . "Offered cancelled");
                $player->broadcastSound(new BarrelCloseSound(), [$player]);
                return;
            }

            $player->sendMessage(TF::BOLD . TF::GOLD . "Tinker: " . TF::GRAY . "Pleasure doing business with you!");
        });

        # get inventory
        $inv = $menu->getInventory();
        # create energy item
        $energyItem = $this->generateEnergyOfferedItem();

        for($i = 0; $i < 9; $i++) {
            $inv->setItem($i, $this->filler());
        }
        $inv->setItem(4, $energyItem);
        # send menu
        $menu->send($player);
    }

    public function filler(): Item {
        $item = CustomiesItemFactory::getInstance()->get("2dglasspanes:pane_lightgrey");
        $item->setCustomName("§r");
        return $item;
    }

    public function generateEnergyOfferedItem(): Item {

        $item = VanillaItems::DYE()->setColor(DyeColor::LIGHT_BLUE());

        if($this->totalEnergy > 0) {
            # energy offered
            $item->setCustomName(TF::BOLD . TF::GREEN . "(!) ACCEPT " . TF::RESET . TF::GRAY . "(Click)");
            $lore = [
                TF::EOL,
                TF::BOLD . TF::AQUA . "Tinkerer will transform offer into:",
                TF::BOLD . TF::AQUA . " * " . TF::WHITE . Translator::shortNumber($this->totalEnergy) . TF::AQUA . " Cosmic Energy",
                TF::EOL,
                TF::BOLD . TF::RED . "------- WARNING -------",
                TF::RESET . TF::RED . "ALL items offered will be LOST forever!"
            ];
            $item->setLore($lore);
            $item->addEnchantment(GlowManager::$enchInst);
            $item->getNamedTag()->setInt("EnergyOffered", $this->totalEnergy);
        }

        if($this->totalEnergy <= 0) {
            # no energy offered
            $item->setCustomName(TF::BOLD . TF::RED . "(!) NOTHING OFFERED");
            $lore = [
                TF::EOL,
                TF::GRAY . "Offer pickaxes, gear or enchants from your",
                TF::GRAY . "inventory to see what the Tinkerer can",
                TF::GRAY . "transform them into!"
            ];
            $item->setLore($lore);
            $item->addEnchantment(GlowManager::$enchInst);
            $item->getNamedTag()->setInt("EnergyOffered", $this->totalEnergy);
        }
        return $item;
    }
}