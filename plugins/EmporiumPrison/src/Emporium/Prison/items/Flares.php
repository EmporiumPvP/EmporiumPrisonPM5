<?php

namespace Emporium\Prison\items;

use Emporium\Prison\Managers\misc\GlowManager;

use pocketmine\block\VanillaBlocks;
use pocketmine\item\Item;

use pocketmine\item\VanillaItems;
use pocketmine\utils\TextFormat as TF;

class Flares {

    public function EliteMeteor(): Item {

        VanillaItems::DIAMOND_SWORD();
        $item = VanillaBlocks::REDSTONE_TORCH()->asItem();
        $item->getNamedTag()->setByte("EliteMeteorFlare", 1);
        $item->setCustomName(TF::BOLD . TF::BLUE . "Elite Meteor Flare");
        $lore = [
            "",
            TF::GRAY . "Meteors are corrupt ores from lost galaxies",
            TF::GRAY . "filled with mass amounts of legendary loot!",
            TF::WHITE . "/help meteors",
            "",
            TF::GRAY . "Place on floor to call in the meteor!",
        ];
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    public function UltimateMeteor(): Item {

        $item = VanillaBlocks::REDSTONE_TORCH()->asItem();
        $item->getNamedTag()->setByte("UltimateMeteorFlare", 1);
        $item->setCustomName(TF::BOLD . TF::YELLOW . "Ultimate Meteor Flare");
        $lore = [
            "",
            TF::GRAY . "Meteors are corrupt ores from lost galaxies",
            TF::GRAY . "filled with mass amounts of legendary loot!",
            TF::WHITE . "/help meteors",
            "",
            TF::GRAY . "Place on floor to call in the meteor!"
        ];
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    public function LegendaryMeteor(): Item {

        $item = VanillaBlocks::REDSTONE_TORCH()->asItem();
        $item->getNamedTag()->setByte("LegendaryMeteorFlare", 1);
        $item->setCustomName(TF::BOLD . TF::GOLD . "Legendary Meteor Flare");
        $lore = [
            "",
            TF::GRAY . "Meteors are corrupt ores from lost galaxies",
            TF::GRAY . "filled with mass amounts of legendary loot!",
            TF::WHITE . "/help meteors",
            "",
            TF::GRAY . "Place on floor to call in the meteor!"
        ];
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    public function GodlyMeteor(): Item {

        $item = VanillaBlocks::REDSTONE_TORCH()->asItem();
        $item->getNamedTag()->setByte("GodlyMeteorFlare", 1);
        $item->setCustomName(TF::BOLD . TF::LIGHT_PURPLE . "Godly Meteor Flare");
        $lore = [
            "",
            TF::GRAY . "Meteors are corrupt ores from lost galaxies",
            TF::GRAY . "filled with mass amounts of legendary loot!",
            TF::WHITE . "/help meteors",
            "",
            TF::GRAY . "Place on floor to call in the meteor!"
        ];
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    public function HeroicMeteor(): Item {

        $item = VanillaBlocks::REDSTONE_TORCH()->asItem();
        $item->getNamedTag()->setByte("HeroicMeteorFlare", 1);
        $item->setCustomName(TF::BOLD . TF::RED . "Heroic Meteor Flare");
        $lore = [
            "",
            TF::GRAY . "Meteors are corrupt ores from lost galaxies",
            TF::GRAY . "filled with mass amounts of legendary loot!",
            TF::WHITE . "/help meteors",
            "",
            TF::GRAY . "Place on floor to call in the meteor!"
        ];
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    public function MysteryGKit(): Item {
        $item = VanillaBlocks::REDSTONE_TORCH()->asItem();
        $item->getNamedTag()->setByte("MysteryGKitFlare", 1);
        $item->setCustomName(TF::BOLD . TF::DARK_PURPLE . "Mystery G-Kit Flare");
        $lore = [
            "",
            TF::GRAY . "Causes a random gkit meteorite to fall",
            TF::GRAY . "wherever you place this!",
            "",
            TF::BOLD . TF::RED . "Major chance to drop full",
            TF::BOLD . TF::RED . "access to a G-Kit",
            "",
            TF::GRAY . "Place on floor to call in the meteor!"
        ];
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    public function heroicVulkarion(): Item {
        $item = VanillaBlocks::REDSTONE_TORCH()->asItem();
        $item->getNamedTag()->setByte("VulkarionGKitFlare", 1);
        $item->setCustomName(TF::BOLD . TF::DARK_RED . "Heroic Vulkarion G-Kit Flare");
        $lore = [
            "",
            TF::GRAY . "Causes the gkit meteorite to fall",
            TF::GRAY . "wherever you place this!",
            "",
            TF::BOLD . TF::RED . "Major chance to drop full",
            TF::BOLD . TF::RED . "access to a G-Kit",
            "",
            TF::GRAY . "Place on floor to call in the meteor!"
        ];
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    public function heroicZenith(): Item {
        $item = VanillaBlocks::REDSTONE_TORCH()->asItem();
        $item->getNamedTag()->setByte("ZenithGKitFlare", 1);
        $item->setCustomName(TF::BOLD . TF::GOLD . "Heroic Zenith G-Kit Flare");
        $lore = [
            "",
            TF::GRAY . "Causes the gkit meteorite to fall",
            TF::GRAY . "wherever you place this!",
            "",
            TF::BOLD . TF::RED . "Major chance to drop full",
            TF::BOLD . TF::RED . "access to a G-Kit",
            "",
            TF::GRAY . "Place on floor to call in the meteor!"
        ];
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    public function heroicColossus(): Item {
        $item = VanillaBlocks::REDSTONE_TORCH()->asItem();
        $item->getNamedTag()->setByte("ColossusGKitFlare", 1);
        $item->setCustomName(TF::BOLD . TF::WHITE . "Heroic Colossus G-Kit Flare");
        $lore = [
            "",
            TF::GRAY . "Causes the gkit meteorite to fall",
            TF::GRAY . "wherever you place this!",
            "",
            TF::BOLD . TF::RED . "Major chance to drop full",
            TF::BOLD . TF::RED . "access to a G-Kit",
            "",
            TF::GRAY . "Place on floor to call in the meteor!"
        ];
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    public function heroicWarlock(): Item {
        $item = VanillaBlocks::REDSTONE_TORCH()->asItem();
        $item->getNamedTag()->setByte("WarlockGKitFlare", 1);
        $item->setCustomName(TF::BOLD . TF::DARK_PURPLE . "Heroic Warlock G-Kit Flare");
        $lore = [
            "",
            TF::GRAY . "Causes the gkit meteorite to fall",
            TF::GRAY . "wherever you place this!",
            "",
            TF::BOLD . TF::RED . "Major chance to drop full",
            TF::BOLD . TF::RED . "access to a G-Kit",
            "",
            TF::GRAY . "Place on floor to call in the meteor!"
        ];
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    public function heroicSlaughter(): Item {
        $item = VanillaBlocks::REDSTONE_TORCH()->asItem();
        $item->getNamedTag()->setByte("SlaughterGKitFlare", 1);
        $item->setCustomName(TF::BOLD . TF::RED . "Heroic Slaughter G-Kit Flare");
        $lore = [
            "",
            TF::GRAY . "Causes the gkit meteorite to fall",
            TF::GRAY . "wherever you place this!",
            "",
            TF::BOLD . TF::RED . "Major chance to drop full",
            TF::BOLD . TF::RED . "access to a G-Kit",
            "",
            TF::GRAY . "Place on floor to call in the meteor!"
        ];
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    public function heroicEnchanter(): Item {
        $item = VanillaBlocks::REDSTONE_TORCH()->asItem();
        $item->getNamedTag()->setByte("EnchanterGKitFlare", 1);
        $item->setCustomName(TF::BOLD . TF::AQUA . "Heroic Enchanter G-Kit Flare");
        $lore = [
            "",
            TF::GRAY . "Causes the gkit meteorite to fall",
            TF::GRAY . "wherever you place this!",
            "",
            TF::BOLD . TF::RED . "Major chance to drop full",
            TF::BOLD . TF::RED . "access to a G-Kit",
            "",
            TF::GRAY . "Place on floor to call in the meteor!"
        ];
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    public function heroicAtheos(): Item {
        $item = VanillaBlocks::REDSTONE_TORCH()->asItem();
        $item->getNamedTag()->setByte("AtheosGKitFlare", 1);
        $item->setCustomName(TF::BOLD . TF::GRAY . "Heroic Atheos G-Kit Flare");
        $lore = [
            "",
            TF::GRAY . "Causes the gkit meteorite to fall",
            TF::GRAY . "wherever you place this!",
            "",
            TF::BOLD . TF::RED . "Major chance to drop full",
            TF::BOLD . TF::RED . "access to a G-Kit",
            "",
            TF::GRAY . "Place on floor to call in the meteor!"
        ];
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    public function heroicIapetus(): Item {
        $item = VanillaBlocks::REDSTONE_TORCH()->asItem();
        $item->getNamedTag()->setByte("IapetusGKitFlare", 1);
        $item->setCustomName(TF::BOLD . TF::BLUE . "Heroic Iapetus G-Kit Flare");
        $lore = [
            "",
            TF::GRAY . "Causes the gkit meteorite to fall",
            TF::GRAY . "wherever you place this!",
            "",
            TF::BOLD . TF::RED . "Major chance to drop full",
            TF::BOLD . TF::RED . "access to a G-Kit",
            "",
            TF::GRAY . "Place on floor to call in the meteor!"
        ];
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    public function heroicBroteas(): Item {
        $item = VanillaBlocks::REDSTONE_TORCH()->asItem();
        $item->getNamedTag()->setByte("BroteasGKitFlare", 1);
        $item->setCustomName(TF::BOLD . TF::GREEN . "Heroic Broteas G-Kit Flare");
        $lore = [
            "",
            TF::GRAY . "Causes the gkit meteorite to fall",
            TF::GRAY . "wherever you place this!",
            "",
            TF::BOLD . TF::RED . "Major chance to drop full",
            TF::BOLD . TF::RED . "access to a G-Kit",
            "",
            TF::GRAY . "Place on floor to call in the meteor!"
        ];
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    public function heroicAres(): Item {
        $item = VanillaBlocks::REDSTONE_TORCH()->asItem();
        $item->getNamedTag()->setByte("AresGKitFlare", 1);
        $item->setCustomName(TF::BOLD . TF::GOLD . "Heroic Ares G-Kit Flare");
        $lore = [
            "",
            TF::GRAY . "Causes the gkit meteorite to fall",
            TF::GRAY . "wherever you place this!",
            "",
            TF::BOLD . TF::RED . "Major chance to drop full",
            TF::BOLD . TF::RED . "access to a G-Kit",
            "",
            TF::GRAY . "Place on floor to call in the meteor!"
        ];
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    public function heroicGrimReaper(): Item {
        $item = VanillaBlocks::REDSTONE_TORCH()->asItem();
        $item->getNamedTag()->setByte("GrimReaperGKitFlare", 1);
        $item->setCustomName(TF::BOLD . TF::RED . "Heroic Grim Reaper G-Kit Flare");
        $lore = [
            "",
            TF::GRAY . "Causes the gkit meteorite to fall",
            TF::GRAY . "wherever you place this!",
            "",
            TF::BOLD . TF::RED . "Major chance to drop full",
            TF::BOLD . TF::RED . "access to a G-Kit",
            "",
            TF::GRAY . "Place on floor to call in the meteor!"
        ];
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    public function heroicExecutioner(): Item {
        $item = VanillaBlocks::REDSTONE_TORCH()->asItem();
        $item->getNamedTag()->setByte("ExecutionerGKitFlare", 1);
        $item->setCustomName(TF::BOLD . TF::DARK_RED . "Heroic Executioner G-Kit Flare");
        $lore = [
            "",
            TF::GRAY . "Causes the gkit meteorite to fall",
            TF::GRAY . "wherever you place this!",
            "",
            TF::BOLD . TF::RED . "Major chance to drop full",
            TF::BOLD . TF::RED . "access to a G-Kit",
            "",
            TF::GRAY . "Place on floor to call in the meteor!"
        ];
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    public function blacksmith(): Item {
        $item = VanillaBlocks::REDSTONE_TORCH()->asItem();
        $item->getNamedTag()->setByte("BlacksmithGKitFlare", 1);
        $item->setCustomName(TF::BOLD . TF::DARK_GRAY . "Blacksmith G-Kit Flare");
        $lore = [
            "",
            TF::GRAY . "Causes the gkit meteorite to fall",
            TF::GRAY . "wherever you place this!",
            "",
            TF::BOLD . TF::RED . "Major chance to drop full",
            TF::BOLD . TF::RED . "access to a G-Kit",
            "",
            TF::GRAY . "Place on floor to call in the meteor!"
        ];
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    public function hero(): Item {
        $item = VanillaBlocks::REDSTONE_TORCH()->asItem();
        $item->getNamedTag()->setByte("HeroGKitFlare", 1);
        $item->setCustomName(TF::BOLD . TF::WHITE . "Hero G-Kit Flare");
        $lore = [
            "",
            TF::GRAY . "Causes the gkit meteorite to fall",
            TF::GRAY . "wherever you place this!",
            "",
            TF::BOLD . TF::RED . "Major chance to drop full",
            TF::BOLD . TF::RED . "access to a G-Kit",
            "",
            TF::GRAY . "Place on floor to call in the meteor!"
        ];
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    public function cyborg(): Item {
        $item = VanillaBlocks::REDSTONE_TORCH()->asItem();
        $item->getNamedTag()->setByte("CyborgGKitFlare", 1);
        $item->setCustomName(TF::BOLD . TF::DARK_AQUA . "Cyborg G-Kit Flare");
        $lore = [
            "",
            TF::GRAY . "Causes the gkit meteorite to fall",
            TF::GRAY . "wherever you place this!",
            "",
            TF::BOLD . TF::RED . "Major chance to drop full",
            TF::BOLD . TF::RED . "access to a G-Kit",
            "",
            TF::GRAY . "Place on floor to call in the meteor!"
        ];
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    public function crucible(): Item {
        $item = VanillaBlocks::REDSTONE_TORCH()->asItem();
        $item->getNamedTag()->setByte("CrucibleGKitFlare", 1);
        $item->setCustomName(TF::BOLD . TF::YELLOW . "Crucible G-Kit Flare");
        $lore = [
            "",
            TF::GRAY . "Causes the gkit meteorite to fall",
            TF::GRAY . "wherever you place this!",
            "",
            TF::BOLD . TF::RED . "Major chance to drop full",
            TF::BOLD . TF::RED . "access to a G-Kit",
            "",
            TF::GRAY . "Place on floor to call in the meteor!"
        ];
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

    public function hunter(): Item {
        $item = VanillaBlocks::REDSTONE_TORCH()->asItem();
        $item->getNamedTag()->setByte("HunterGKitFlare", 1);
        $item->setCustomName(TF::BOLD . TF::AQUA . "Hunter G-Kit Flare");
        $lore = [
            "",
            TF::GRAY . "Causes the gkit meteorite to fall",
            TF::GRAY . "wherever you place this!",
            "",
            TF::BOLD . TF::RED . "Major chance to drop full",
            TF::BOLD . TF::RED . "access to a G-Kit",
            "",
            TF::GRAY . "Place on floor to call in the meteor!"
        ];
        $item->setLore($lore);
        $item->addEnchantment(GlowManager::$enchInst);

        return $item;
    }

}