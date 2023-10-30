<?php

namespace Emporium\Prison\items;

use customiesdevs\customies\item\CustomiesItemFactory;
use Emporium\Prison\EmporiumPrison;

use pocketmine\item\Durable;
use pocketmine\item\Item;
use pocketmine\item\VanillaItems;
use pocketmine\utils\TextFormat as TF;

class Pickaxes {

    public function Trainee(): Item {
        # create item
        $item = VanillaItems::WOODEN_PICKAXE();
        # variables
        # set nbt Data
        $item->getNamedTag()->setString("PickaxeType", "Trainee");
        $item->getNamedTag()->setInt("Level", 0);
        $item->getNamedTag()->setInt("Energy", 0);
        $item->getNamedTag()->setInt("SuccessfulEnchants", 0);
        $item->getNamedTag()->setInt("FailedEnchants", 0);
        $item->getNamedTag()->setInt("BlocksMined", 0);
        $item->getNamedTag()->setString("whitescrolled", "false");
        $item->getNamedTag()->setInt("LevelRequired", 1);
        $item->getNamedTag()->setInt("Prestige", 0);

        # prestige buffs
        $item->getNamedTag()->setString("EnergyMastery", "locked");
        $item->getNamedTag()->setInt("ChargeOrbSlots", 0);
        $item->getNamedTag()->setString("XpMastery", "locked");
        $item->getNamedTag()->setInt("XpMasteryBuff", 0);
        $item->getNamedTag()->setString("Hoarder", "locked");
        $item->getNamedTag()->setInt("HoarderBuff", 0);
        $item->getNamedTag()->setString("MeteoriteMastery", "locked");
        $item->getNamedTag()->setInt("MeteoriteMasteryBuff", 0);

        # get nbt Data
        $level = $item->getNamedTag()->getInt("Level");
        if($level == 0) {
            $item->setCustomName(TF::AQUA . "Trainee Pickaxe" . TF::RESET);
        } else {
            $item->setCustomName(TF::AQUA . "Trainee Pickaxe " . TF::BOLD . TF::GREEN . $level . TF::RESET);
        }
        # create lore
        $lore = EmporiumPrison::getInstance()->getPickaxeManager()->createLore($item);
        # set lore
        $item->setLore($lore);
        # set item unbreakable
        if($item instanceof Durable) {
            $item->setUnbreakable();
        }
        return $item;
    }

    public function Stone(): Item {
        # create item
        $item = VanillaItems::STONE_PICKAXE();
        # variables
        # set nbt Data
        $item->getNamedTag()->setString("PickaxeType", "Stone");
        $item->getNamedTag()->setInt("Level", 0);
        $item->getNamedTag()->setInt("Energy", 0);
        $item->getNamedTag()->setInt("SuccessfulEnchants", 0);
        $item->getNamedTag()->setInt("FailedEnchants", 0);
        $item->getNamedTag()->setInt("BlocksMined", 0);
        $item->getNamedTag()->setString("whitescrolled", "false");
        $item->getNamedTag()->setInt("LevelRequired", 30);
        $item->getNamedTag()->setInt("Prestige", 0);

        # prestige buffs
        $item->getNamedTag()->setString("EnergyMastery", "locked");
        $item->getNamedTag()->setInt("ChargeOrbSlots", 0);
        $item->getNamedTag()->setString("XpMastery", "locked");
        $item->getNamedTag()->setInt("XpMasteryBuff", 0);
        $item->getNamedTag()->setString("Hoarder", "locked");
        $item->getNamedTag()->setInt("HoarderBuff", 0);
        $item->getNamedTag()->setString("MeteoriteMastery", "locked");
        $item->getNamedTag()->setInt("MeteoriteMasteryBuff", 0);

        # get nbt Data
        $level = $item->getNamedTag()->getInt("Level");

        if($level == 0) {
            $item->setCustomName(TF::AQUA . "Stone Pickaxe" . TF::RESET);
        } else {
            $item->setCustomName(TF::AQUA . "Stone Pickaxe " . TF::BOLD . TF::GREEN . $level . TF::RESET);
        }
        # create lore
        $lore = EmporiumPrison::getInstance()->getPickaxeManager()->createLore($item);
        # set lore
        $item->setLore($lore);
        # set item unbreakable
        if($item instanceof Durable) {
            $item->setUnbreakable();
        }
        return $item;
    }

    public function Gold(): Item {
        # create item
        $item = VanillaItems::GOLDEN_PICKAXE();
        # variables
        # set nbt Data
        $item->getNamedTag()->setString("PickaxeType", "Gold");
        $item->getNamedTag()->setInt("Level", 0);
        $item->getNamedTag()->setInt("Energy", 0);
        $item->getNamedTag()->setInt("SuccessfulEnchants", 0);
        $item->getNamedTag()->setInt("FailedEnchants", 0);
        $item->getNamedTag()->setInt("BlocksMined", 0);
        $item->getNamedTag()->setString("whitescrolled", "false");
        $item->getNamedTag()->setInt("LevelRequired", 50);
        $item->getNamedTag()->setInt("Prestige", 0);

        # prestige buffs
        $item->getNamedTag()->setString("EnergyMastery", "locked");
        $item->getNamedTag()->setInt("ChargeOrbSlots", 0);
        $item->getNamedTag()->setString("XpMastery", "locked");
        $item->getNamedTag()->setInt("XpMasteryBuff", 0);
        $item->getNamedTag()->setString("Hoarder", "locked");
        $item->getNamedTag()->setInt("HoarderBuff", 0);
        $item->getNamedTag()->setString("MeteoriteMastery", "locked");
        $item->getNamedTag()->setInt("MeteoriteMasteryBuff", 0);

        # get nbt Data
        $level = $item->getNamedTag()->getInt("Level");

        if($level == 0) {
            $item->setCustomName(TF::AQUA . "Gold Pickaxe" . TF::RESET);
        } else {
            $item->setCustomName(TF::AQUA . "Gold Pickaxe " . TF::BOLD . TF::GREEN . $level . TF::RESET);
        }
        # create lore
        $lore = EmporiumPrison::getInstance()->getPickaxeManager()->createLore($item);
        # set lore
        $item->setLore($lore);
        # set item unbreakable
        if($item instanceof Durable) {
            $item->setUnbreakable();
        }
        return $item;
    }

    public function Iron(): Item {
        # create item
        $item = VanillaItems::IRON_PICKAXE();
        # variables
        # set nbt Data
        $item->getNamedTag()->setString("PickaxeType", "Iron");
        $item->getNamedTag()->setInt("Level", 0);
        $item->getNamedTag()->setInt("Energy", 0);
        $item->getNamedTag()->setInt("SuccessfulEnchants", 0);
        $item->getNamedTag()->setInt("FailedEnchants", 0);
        $item->getNamedTag()->setInt("BlocksMined", 0);
        $item->getNamedTag()->setString("whitescrolled", "false");
        $item->getNamedTag()->setInt("LevelRequired", 70);
        $item->getNamedTag()->setInt("Prestige", 0);

        # prestige buffs
        $item->getNamedTag()->setString("EnergyMastery", "locked");
        $item->getNamedTag()->setInt("ChargeOrbSlots", 0);
        $item->getNamedTag()->setString("XpMastery", "locked");
        $item->getNamedTag()->setInt("XpMasteryBuff", 0);
        $item->getNamedTag()->setString("Hoarder", "locked");
        $item->getNamedTag()->setInt("HoarderBuff", 0);
        $item->getNamedTag()->setString("MeteoriteMastery", "locked");
        $item->getNamedTag()->setInt("MeteoriteMasteryBuff", 0);

        # get nbt Data
        $level = $item->getNamedTag()->getInt("Level");

        if($level == 0) {
            $item->setCustomName(TF::AQUA . "Iron Pickaxe" . TF::RESET);
        } else {
            $item->setCustomName(TF::AQUA . "Iron Pickaxe " . TF::BOLD . TF::GREEN . $level . TF::RESET);
        }
        # create lore
        $lore = EmporiumPrison::getInstance()->getPickaxeManager()->createLore($item);
        # set lore
        $item->setLore($lore);
        # set item unbreakable
        if($item instanceof Durable) {
            $item->setUnbreakable();
        }
        return $item;
    }

    public function Diamond(): Item {

        # create item
        $item = VanillaItems::DIAMOND_PICKAXE();

        # set nbt Data
        $item->getNamedTag()->setString("PickaxeType", "Diamond");
        $item->getNamedTag()->setInt("Level", 0);
        $item->getNamedTag()->setInt("Energy", 0);
        $item->getNamedTag()->setInt("SuccessfulEnchants", 0);
        $item->getNamedTag()->setInt("FailedEnchants", 0);
        $item->getNamedTag()->setInt("BlocksMined", 0);
        $item->getNamedTag()->setString("whitescrolled", "false");
        $item->getNamedTag()->setInt("LevelRequired", 90);
        $item->getNamedTag()->setInt("Prestige", 0);

        # prestige buffs
        $item->getNamedTag()->setString("EnergyMastery", "locked");
        $item->getNamedTag()->setInt("ChargeOrbSlots", 0);
        $item->getNamedTag()->setString("XpMastery", "locked");
        $item->getNamedTag()->setInt("XpMasteryBuff", 0);
        $item->getNamedTag()->setString("Hoarder", "locked");
        $item->getNamedTag()->setInt("HoarderBuff", 0);
        $item->getNamedTag()->setString("MeteoriteMastery", "locked");
        $item->getNamedTag()->setInt("MeteoriteMasteryBuff", 0);

        # get nbt Data
        $level = $item->getNamedTag()->getInt("Level");

        if($level == 0) {
            $item->setCustomName(TF::AQUA . "Diamond Pickaxe" . TF::RESET);
        } else {
            $item->setCustomName(TF::AQUA . "Diamond Pickaxe " . TF::BOLD . TF::GREEN . $level . TF::RESET);
        }

        # create lore
        $lore = EmporiumPrison::getInstance()->getPickaxeManager()->createLore($item);

        # set lore
        $item->setLore($lore);

        # set item unbreakable
        if($item instanceof Durable) {
            $item->setUnbreakable();
        }

        return $item;
    }

    public function energyPickaxe(): Item {

        # create item
        $item = CustomiesItemFactory::getInstance()->get("emporiumprison:energy_pickaxe");

        # set nbt Data
        $item->getNamedTag()->setString("PickaxeType", "Trainee");
        $item->getNamedTag()->setInt("Level", 0);
        $item->getNamedTag()->setInt("Energy", 0);
        $item->getNamedTag()->setInt("SuccessfulEnchants", 0);
        $item->getNamedTag()->setInt("FailedEnchants", 0);
        $item->getNamedTag()->setInt("BlocksMined", 0);
        $item->getNamedTag()->setString("whitescrolled", "false");
        $item->getNamedTag()->setInt("LevelRequired", 90);
        $item->getNamedTag()->setInt("Prestige", 0);

        # prestige buffs
        $item->getNamedTag()->setString("EnergyMastery", "locked");
        $item->getNamedTag()->setInt("ChargeOrbSlots", 0);
        $item->getNamedTag()->setString("XpMastery", "locked");
        $item->getNamedTag()->setInt("XpMasteryBuff", 0);
        $item->getNamedTag()->setString("Hoarder", "locked");
        $item->getNamedTag()->setInt("HoarderBuff", 0);
        $item->getNamedTag()->setString("MeteoriteMastery", "locked");
        $item->getNamedTag()->setInt("MeteoriteMasteryBuff", 0);

        # get nbt Data
        $level = $item->getNamedTag()->getInt("Level");

        if($level == 0) {
            $item->setCustomName(TF::AQUA . "Energy Pickaxe" . TF::RESET);
        } else {
            $item->setCustomName(TF::AQUA . "Energy Pickaxe " . TF::BOLD . TF::GREEN . $level . TF::RESET);
        }

        # create lore
        $lore = EmporiumPrison::getInstance()->getPickaxeManager()->createLore($item);

        # set lore
        $item->setLore($lore);

        # set item unbreakable
        if($item instanceof Durable) {
            $item->setUnbreakable();
        }

        return $item;

    }
}