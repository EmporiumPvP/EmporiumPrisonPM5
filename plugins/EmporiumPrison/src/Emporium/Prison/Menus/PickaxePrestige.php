<?php

namespace Emporium\Prison\Menus;

use Emporium\Prison\EmporiumPrison;

use muqsit\invmenu\InvMenu;
use muqsit\invmenu\transaction\InvMenuTransaction;
use muqsit\invmenu\transaction\InvMenuTransactionResult;
use muqsit\invmenu\type\InvMenuTypeIds;

use pocketmine\block\VanillaBlocks;
use pocketmine\item\Item;
use pocketmine\item\VanillaItems;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;
use pocketmine\world\sound\ClickSound;
use pocketmine\world\sound\XpLevelUpSound;

class PickaxePrestige {

    public function Inventory(Player $player): void {
        $menu = InvMenu::create(InvMenuTypeIds::TYPE_CHEST);
        $menu->setName("Pickaxe Prestige");
        $menu->setListener(function(InvMenuTransaction $transaction) use ($menu): InvMenuTransactionResult {

            $itemClickedOut = $transaction->getOut();
            $player = $transaction->getPlayer();

            # pickaxe isn't eligible for prestige
            if($itemClickedOut->getNamedTag()->getInt("Level") < 100) {
                $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "This item is not eligible for prestige!");
                $player->broadcastSound(new ClickSound(0), [$player]);
                return $transaction->discard();
            }

            # pickaxe is max prestige
            if($itemClickedOut->getNamedTag()->getInt("Prestige") >= 6) {
                $player->sendMessage(TF::BOLD . TF::RED . "(!) " . TF::RESET . TF::RED . "This item is max prestige!");
                $player->broadcastSound(new ClickSound(0), [$player]);
                return $transaction->discard();
            }

            # send prestige menu
            if($itemClickedOut->getNamedTag()->getTag("PickaxeType")) {
                $this->PrestigeMenu($player, $itemClickedOut);
                return $transaction->discard();
            }
            return $transaction->continue();
        });
        $inventory = $menu->getInventory();
        # add pickaxes to menu
        foreach ($player->getInventory()->getContents() as $item) {
            if($item->getNamedTag()->getTag("PickaxeType")) {
                if($item->getNamedTag()->getInt("Level") >= 100 && ($item->getNamedTag()->getInt("Prestige") < 6)) {
                    # change lore
                    /*
                    $oldLore = $item->getLore();
                    $newLore = array_merge($oldLore, [
                        TF::EOL,
                        TF::BOLD . TF::GREEN . "Eligible for prestige"
                    ]);
                    $item->setLore($newLore);*/
                    # add item
                    $inventory->addItem($item);
                    continue;
                }
                if($item->getNamedTag()->getInt("Level") < 100) {
                    # change lore
                    /*
                    $oldLore =  $item->getLore();
                    $newLore = array_merge($oldLore, [
                        TF::EOL,
                        TF::BOLD . TF::GREEN . "Ineligible for prestige"
                    ]);
                    $item->setLore($newLore);*/
                    # add item
                    $inventory->addItem($item);
                }
            }
        }
        $menu->send($player);
    }

    public function PrestigeMenu(Player $player, Item $item): void {
        $menu = InvMenu::create(InvMenuTypeIds::TYPE_CHEST);
        $menu->setName("Pickaxe Prestige");
        $menu->setListener(function(InvMenuTransaction $transaction) use ($item, $player): InvMenuTransactionResult {
            $itemOut = $transaction->getOut();

            # energy mastery
            if($itemOut->getNamedTag()->getTag("EnergyMastery")) {

                # remove old pickaxe
                $player->getInventory()->remove($item);

                # play sound
                $player->broadcastSound(new XpLevelUpSound(100), [$player]);

                # add charge orb slots
                $item->getNamedTag()->setInt("ChargeOrbSlots", $item->getNamedTag()->getInt("ChargeOrbSlots") + 1);

                # set buff unlocked
                $item->getNamedTag()->setString("EnergyMastery", "unlocked");

                # increment pickaxe prestige
                $item->getNamedTag()->setInt("Prestige", $item->getNamedTag()->getInt("Prestige") + 1);

                # reset pickaxe
                $item->getNamedTag()->setInt("Level", 0);
                $energy = $item->getNamedTag()->getInt("Energy");
                $item->getNamedTag()->setInt("Energy", 0);
                $item->getNamedTag()->setInt("SuccessfulEnchants", 0);
                $item->getNamedTag()->setInt("FailedEnchants", 0);
                $item->getNamedTag()->setInt("BlocksMined", 0);
                $item->removeEnchantments();

                # update pickaxe
                $updatedPickaxe = EmporiumPrison::getInstance()->getPickaxeManager()->updatePickaxe($item);

                # give player new pickaxe
                if($player->getInventory()->canAddItem($updatedPickaxe)) {
                    $player->getInventory()->addItem($updatedPickaxe);
                } else {
                    $player->getWorld()->dropItem($player->getPosition(), $updatedPickaxe);
                }

                # give player remaining energy in orb
                if($player->getInventory()->canAddItem(EmporiumPrison::getInstance()->getOrbs()->EnergyOrb($energy))) {
                    $player->getInventory()->addItem(EmporiumPrison::getInstance()->getOrbs()->EnergyOrb($energy));
                } else {
                    $player->getWorld()->dropItem($player->getPosition(), EmporiumPrison::getInstance()->getOrbs()->EnergyOrb($energy));
                }

                # send confirmation message
                $player->sendMessage("You unlocked Energy Mastery");

                # close inventory
                $player->removeCurrentWindow();

                return $transaction->discard();

            }

            # xp mastery
            if($itemOut->getNamedTag()->getTag("XpMastery")) {

                # remove old pickaxe
                $player->getInventory()->remove($item);

                # play sound
                $player->broadcastSound(new XpLevelUpSound(100), [$player]);

                # add xp mastery buff
                $buff = mt_rand(2, 8);
                $item->getNamedTag()->setInt("XpMasteryBuff", $item->getNamedTag()->getInt("XpMasteryBuff") + $buff);

                # set buff unlocked
                $item->getNamedTag()->setString("XpMastery", "unlocked");

                # increment pickaxe prestige
                $item->getNamedTag()->setInt("Prestige", $item->getNamedTag()->getInt("Prestige") + 1);

                # reset pickaxe
                $item->getNamedTag()->setInt("Level", 0);
                $energy = $item->getNamedTag()->getInt("Energy");
                $item->getNamedTag()->setInt("Energy", 0);
                $item->getNamedTag()->setInt("SuccessfulEnchants", 0);
                $item->getNamedTag()->setInt("FailedEnchants", 0);
                $item->getNamedTag()->setInt("BlocksMined", 0);
                $item->removeEnchantments();

                # update pickaxe
                $updatedPickaxe = EmporiumPrison::getInstance()->getPickaxeManager()->updatePickaxe($item);

                # give player new pickaxe
                if($player->getInventory()->canAddItem($updatedPickaxe)) {
                    $player->getInventory()->addItem($updatedPickaxe);
                } else {
                    $player->getWorld()->dropItem($player->getPosition(), $updatedPickaxe);
                }

                # give player remaining energy in orb
                if($player->getInventory()->canAddItem(EmporiumPrison::getInstance()->getOrbs()->EnergyOrb($energy))) {
                    $player->getInventory()->addItem(EmporiumPrison::getInstance()->getOrbs()->EnergyOrb($energy));
                } else {
                    $player->getWorld()->dropItem($player->getPosition(), EmporiumPrison::getInstance()->getOrbs()->EnergyOrb($energy));
                }

                # send confirmation message
                $player->sendMessage("You unlocked Xp Mastery");

                # close inventory
                $player->removeCurrentWindow();

                return $transaction->discard();

            }

            # hoarder
            if($itemOut->getNamedTag()->getTag("Hoarder")) {

                # remove old pickaxe
                $player->getInventory()->remove($item);

                # play sound
                $player->broadcastSound(new XpLevelUpSound(100), [$player]);

                # add hoarder buff
                $buff = mt_rand(5, 15);
                $item->getNamedTag()->setInt("HoarderBuff", $item->getNamedTag()->getInt("HoarderBuff") + $buff);

                # set buff unlocked
                $item->getNamedTag()->setString("Hoarder", "unlocked");

                # increment pickaxe prestige
                $item->getNamedTag()->setInt("Prestige", $item->getNamedTag()->getInt("Prestige") + 1);

                # reset pickaxe
                $item->getNamedTag()->setInt("Level", 0);
                $energy = $item->getNamedTag()->getInt("Energy");
                $item->getNamedTag()->setInt("Energy", 0);
                $item->getNamedTag()->setInt("SuccessfulEnchants", 0);
                $item->getNamedTag()->setInt("FailedEnchants", 0);
                $item->getNamedTag()->setInt("BlocksMined", 0);
                $item->removeEnchantments();

                # update pickaxe
                $updatedPickaxe = EmporiumPrison::getInstance()->getPickaxeManager()->updatePickaxe($item);

                # give player new pickaxe
                if($player->getInventory()->canAddItem($updatedPickaxe)) {
                    $player->getInventory()->addItem($updatedPickaxe);
                } else {
                    $player->getWorld()->dropItem($player->getPosition(), $updatedPickaxe);
                }

                # give player remaining energy in orb
                if($player->getInventory()->canAddItem(EmporiumPrison::getInstance()->getOrbs()->EnergyOrb($energy))) {
                    $player->getInventory()->addItem(EmporiumPrison::getInstance()->getOrbs()->EnergyOrb($energy));
                } else {
                    $player->getWorld()->dropItem($player->getPosition(), EmporiumPrison::getInstance()->getOrbs()->EnergyOrb($energy));
                }

                # send confirmation message
                $player->sendMessage("You unlocked Hoarder");

                # close inventory
                $player->removeCurrentWindow();

                return $transaction->discard();

            }

            # meteorite mastery
            if($itemOut->getNamedTag()->getTag("MeteoriteMastery")) {

                # remove old pickaxe
                $player->getInventory()->remove($item);

                # play sound
                $player->broadcastSound(new XpLevelUpSound(100), [$player]);

                # set xp mastery buff
                $buff = mt_rand(7, 20);
                $item->getNamedTag()->setInt("MeteoriteMasteryBuff", $buff);

                # set buff unlocked
                $item->getNamedTag()->setString("MeteoriteMastery", "unlocked");

                # increment pickaxe prestige
                $item->getNamedTag()->setInt("Prestige", $item->getNamedTag()->getInt("Prestige") + 1);

                # reset pickaxe
                $item->getNamedTag()->setInt("Level", 0);
                $energy = $item->getNamedTag()->getInt("Energy");
                $item->getNamedTag()->setInt("Energy", 0);
                $item->getNamedTag()->setInt("SuccessfulEnchants", 0);
                $item->getNamedTag()->setInt("FailedEnchants", 0);
                $item->getNamedTag()->setInt("BlocksMined", 0);
                $item->removeEnchantments();

                # update pickaxe
                $updatedPickaxe = EmporiumPrison::getInstance()->getPickaxeManager()->updatePickaxe($item);

                # give player new pickaxe
                if($player->getInventory()->canAddItem($updatedPickaxe)) {
                    $player->getInventory()->addItem($updatedPickaxe);
                } else {
                    $player->getWorld()->dropItem($player->getPosition(), $updatedPickaxe);
                }

                # give player remaining energy in orb
                if($player->getInventory()->canAddItem(EmporiumPrison::getInstance()->getOrbs()->EnergyOrb($energy))) {
                    $player->getInventory()->addItem(EmporiumPrison::getInstance()->getOrbs()->EnergyOrb($energy));
                } else {
                    $player->getWorld()->dropItem($player->getPosition(), EmporiumPrison::getInstance()->getOrbs()->EnergyOrb($energy));
                }

                # send confirmation message
                $player->sendMessage("You unlocked Meteorite Mastery");

                # close inventory
                $player->removeCurrentWindow();

                return $transaction->discard();

            }

            # player pickaxe
            if($itemOut->getNamedTag()->getTag("PickaxeType")) {
                # play sound
                $player->broadcastSound(new ClickSound(0), [$player]);
                return $transaction->discard();
            }

            return $transaction->continue();
        });
        $inventory = $menu->getInventory();
        # players pickaxe
        $inventory->setItem(4, $item);
        # prestige options
        $inventory->setItem(10, $this->prestigeOption1());
        $inventory->setItem(12, $this->prestigeOption2());
        $inventory->setItem(14, $this->prestigeOption3());
        $inventory->setItem(16, $this->prestigeOption4());
        # send menu
        $menu->send($player);
    }

    # energy mastery
    public function prestigeOption1(): Item {
        # doesn't have this buff
        $option1 = VanillaItems::LIGHT_BLUE_DYE();
        $option1->getNamedTag()->setString("EnergyMastery", "locked");
        $option1->setCustomName(TF::BOLD . TF::GREEN . "Energy Mastery");
        $lore = [
            TF::EOL,
            TF::GRAY . "Unlock an extra 1 - 3 Charge Orb Slots "
        ];
        $option1->setLore($lore);
        return $option1;
    }

    # xp mastery
    public function prestigeOption2(): Item {
        # doesn't have this buff
        $option2 = VanillaItems::EXPERIENCE_BOTTLE();
        $option2->getNamedTag()->setString("XpMastery", "locked");
        $option2->setCustomName(TF::BOLD . TF::GREEN . "Xp Mastery");
        $lore = [
            TF::EOL,
            TF::GRAY . "Unlock a permanent XP buff +7 - 20"
        ];
        $option2->setLore($lore);
        return $option2;
    }

    # hoarder
    public function prestigeOption3(): Item {
        # doesn't have this buff
        $option3 = VanillaBlocks::COAL_ORE()->asItem();
        $option3->getNamedTag()->setString("Hoarder", "locked");
        $option3->setCustomName(TF::BOLD . TF::GREEN . "Hoarder");
        $lore = [
            TF::EOL,
            TF::GRAY . "Gain +5 - 15 more ores"
        ];
        $option3->setLore($lore);
        return $option3;

    }

    # meteorite mastery
    public function prestigeOption4(): Item {
        # doesn't have this buff
        $option4 = VanillaBlocks::NETHER_QUARTZ_ORE()->asItem();
        $option4->getNamedTag()->setString("MeteoriteMastery", "locked");
        $option4->setCustomName(TF::BOLD . TF::GREEN . "Meteorite Mastery");
        $lore = [
            TF::EOL,
            TF::GRAY . "Gain +7 - 20 more ores from meteorites"
        ];
        $option4->setLore($lore);
        return $option4;

    }
}