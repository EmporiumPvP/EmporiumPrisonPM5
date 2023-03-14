<?php

namespace Emporium\Prison\items;

use Emporium\Prison\EmporiumPrison;
use Emporium\Prison\Managers\PickaxeManager;

use pocketmine\item\Durable;
use pocketmine\item\Item;

use pocketmine\item\VanillaItems;
use pocketmine\utils\TextFormat as TF;

class Pickaxes {


    private PickaxeManager $pickaxeManager;

    public function __construct() {
        # Managers
        $this->pickaxeManager = EmporiumPrison::getPickaxeManager();
    }

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
        # get nbt Data
        $level = $item->getNamedTag()->getInt("Level");

        if($level == 0) {
            $item->setCustomName(TF::AQUA . "Trainee Pickaxe" . TF::RESET);
        } else {
            $item->setCustomName(TF::AQUA . "Trainee Pickaxe " . TF::BOLD . TF::GREEN . $level . TF::RESET);
        }
        # create lore
        $lore = $this->pickaxeManager->createLore($item);
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
        $item->getNamedTag()->setString("PickaxeType", "Trainee");
        $item->getNamedTag()->setInt("Level", 0);
        $item->getNamedTag()->setInt("Energy", 0);
        $item->getNamedTag()->setInt("SuccessfulEnchants", 0);
        $item->getNamedTag()->setInt("FailedEnchants", 0);
        $item->getNamedTag()->setInt("BlocksMined", 0);
        $item->getNamedTag()->setString("whitescrolled", "false");
        # get nbt Data
        $level = $item->getNamedTag()->getInt("Level");

        if($level == 0) {
            $item->setCustomName(TF::AQUA . "Stone Pickaxe" . TF::RESET);
        } else {
            $item->setCustomName(TF::AQUA . "Stone Pickaxe " . TF::BOLD . TF::GREEN . $level . TF::RESET);
        }
        # create lore
        $lore = $this->pickaxeManager->createLore($item);
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
        $item->getNamedTag()->setString("PickaxeType", "Trainee");
        $item->getNamedTag()->setInt("Level", 0);
        $item->getNamedTag()->setInt("Energy", 0);
        $item->getNamedTag()->setInt("SuccessfulEnchants", 0);
        $item->getNamedTag()->setInt("FailedEnchants", 0);
        $item->getNamedTag()->setInt("BlocksMined", 0);
        $item->getNamedTag()->setString("whitescrolled", "false");
        # get nbt Data
        $level = $item->getNamedTag()->getInt("Level");

        if($level == 0) {
            $item->setCustomName(TF::AQUA . "Gold Pickaxe" . TF::RESET);
        } else {
            $item->setCustomName(TF::AQUA . "Gold Pickaxe " . TF::BOLD . TF::GREEN . $level . TF::RESET);
        }
        # create lore
        $lore = $this->pickaxeManager->createLore($item);
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
        $item->getNamedTag()->setString("PickaxeType", "Trainee");
        $item->getNamedTag()->setInt("Level", 0);
        $item->getNamedTag()->setInt("Energy", 0);
        $item->getNamedTag()->setInt("SuccessfulEnchants", 0);
        $item->getNamedTag()->setInt("FailedEnchants", 0);
        $item->getNamedTag()->setInt("BlocksMined", 0);
        $item->getNamedTag()->setString("whitescrolled", "false");
        # get nbt Data
        $level = $item->getNamedTag()->getInt("Level");

        if($level == 0) {
            $item->setCustomName(TF::AQUA . "Iron Pickaxe" . TF::RESET);
        } else {
            $item->setCustomName(TF::AQUA . "Iron Pickaxe " . TF::BOLD . TF::GREEN . $level . TF::RESET);
        }
        # create lore
        $lore = $this->pickaxeManager->createLore($item);
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
        # variables
        # set nbt Data
        $item->getNamedTag()->setString("PickaxeType", "Trainee");
        $item->getNamedTag()->setInt("Level", 0);
        $item->getNamedTag()->setInt("Energy", 0);
        $item->getNamedTag()->setInt("SuccessfulEnchants", 0);
        $item->getNamedTag()->setInt("FailedEnchants", 0);
        $item->getNamedTag()->setInt("BlocksMined", 0);
        $item->getNamedTag()->setString("whitescrolled", "false");
        # get nbt Data
        $level = $item->getNamedTag()->getInt("Level");

        if($level == 0) {
            $item->setCustomName(TF::AQUA . "Diamond Pickaxe" . TF::RESET);
        } else {
            $item->setCustomName(TF::AQUA . "Diamond Pickaxe " . TF::BOLD . TF::GREEN . $level . TF::RESET);
        }
        # create lore
        $lore = $this->pickaxeManager->createLore($item);
        # set lore
        $item->setLore($lore);
        # set item unbreakable
        if($item instanceof Durable) {
            $item->setUnbreakable();
        }
        return $item;
    }

}