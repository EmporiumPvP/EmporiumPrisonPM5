<?php

namespace Tetro\EmporiumEnchants\Core;

use customiesdevs\customies\item\CustomiesItemFactory;
use Emporium\Prison\Managers\misc\Translator;

use Exception;
use pocketmine\block\utils\DyeColor;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\Item;
use pocketmine\item\VanillaItems;
use pocketmine\utils\TextFormat as TF;

class OrbManager {

    public function getOrbEnergyNeeded(int $level, int $rarity): int {

        $translatedRarity = match ($rarity) {
            800 => "Elite",
            801 => "Ultimate",
            802 => "Legendary",
            803 => "Godly",
            804 => "Heroic",
            805 => "Executive",
            806 => "Pickaxe"
        };

        $minimumEnergy = EnchantsDataManager::getData("energyData", "enchantBook" . $translatedRarity . "LevelEnergy", "level" . $level . "minimum");
        $maximumEnergy = EnchantsDataManager::getData("energyData", "enchantBook" . $translatedRarity . "LevelEnergy", "level" . $level . "maximum");

        return mt_rand($minimumEnergy, $maximumEnergy);
    }

    public function createEnergyBar(Item $item, int $level, int $rarity): String {

        $energy = $item->getNamedTag()->getInt("Energy");
        # get enchant data

        $energyNeeded = $this->getOrbEnergyNeeded($level, $rarity);
        $progress = round(($energy / $energyNeeded) * 100, +1);

        $energyBar = "";
        switch($progress) {

            # change bar to use this: 〡
            case 0:
                $energyBar = TF::RED . "|||||||||||||||||||||||||||||||| " . TF::WHITE . $progress . "%";
                break;
            case $progress <= 3:
                $energyBar = TF::GREEN . "|" . TF::RED . "||||||||||||||||||||||||||||||| " . TF::WHITE . $progress . "%";
                break;

            case $progress <= 6:
                $energyBar = TF::GREEN . "||" . TF::RED . "|||||||||||||||||||||||||||||| " . TF::WHITE . $progress . "%";
                break;

            case $progress <= 9:
                $energyBar = TF::GREEN . "|||" . TF::RED . "||||||||||||||||||||||||||||| " . TF::WHITE . $progress . "%";
                break;

            case $progress <= 12:
                $energyBar = TF::GREEN . "||||" . TF::RED . "||||||||||||||||||||||||||||| " . TF::WHITE . $progress . "%";
                break;

            case $progress <= 15:
                $energyBar = TF::GREEN . "|||||" . TF::RED . "|||||||||||||||||||||||||||| " . TF::WHITE . $progress . "%";
                break;

            case $progress <= 18:
                $energyBar = TF::GREEN . "||||||" . TF::RED . "||||||||||||||||||||||||||| " . TF::WHITE . $progress . "%";
                break;

            case $progress <= 21:
                $energyBar = TF::GREEN . "|||||||" . TF::RED . "|||||||||||||||||||||||||| " . TF::WHITE . $progress . "%";
                break;

            case $progress <= 24:
                $energyBar = TF::GREEN . "||||||||" . TF::RED . "||||||||||||||||||||||||| " . TF::WHITE . $progress . "%";
                break;

            case $progress <= 27:
                $energyBar = TF::GREEN . "|||||||||" . TF::RED . "|||||||||||||||||||||||| " . TF::WHITE . $progress . "%";
                break;

            case $progress <= 30:
                $energyBar = TF::GREEN . "||||||||||" . TF::RED . "||||||||||||||||||||||| " . TF::WHITE . $progress . "%";
                break;

            case $progress <= 33:
                $energyBar = TF::GREEN . "|||||||||||" . TF::RED . "|||||||||||||||||||||| " . TF::WHITE . $progress . "%";
                break;

            case $progress <= 36:
                $energyBar = TF::GREEN . "||||||||||||" . TF::RED . "||||||||||||||||||||| " . TF::WHITE . $progress . "%";
                break;

            case $progress <= 39:
                $energyBar = TF::GREEN . "|||||||||||||" . TF::RED . "|||||||||||||||||||| " . TF::WHITE . $progress . "%";
                break;

            case $progress <= 42:
                $energyBar = TF::GREEN . "||||||||||||||" . TF::RED . "||||||||||||||||||| " . TF::WHITE . $progress . "%";
                break;

            case $progress <= 45:
                $energyBar = TF::GREEN . "|||||||||||||||" . TF::RED . "|||||||||||||||||| " . TF::WHITE . $progress . "%";
                break;

            case $progress <= 48:
                $energyBar = TF::GREEN . "||||||||||||||||" . TF::RED . "||||||||||||||||| " . TF::WHITE . $progress . "%";
                break;

            case $progress <= 51:
                $energyBar = TF::GREEN . "|||||||||||||||||" . TF::RED . "|||||||||||||||| " . TF::WHITE . $progress . "%";
                break;

            case $progress <= 54:
                $energyBar = TF::GREEN . "||||||||||||||||||" . TF::RED . "||||||||||||||| " . TF::WHITE . $progress . "%";
                break;

            case $progress <= 57:
                $energyBar = TF::GREEN . "|||||||||||||||||||" . TF::RED . "|||||||||||||| " . TF::WHITE . $progress . "%";
                break;

            case $progress <= 60:
                $energyBar = TF::GREEN . "||||||||||||||||||||" . TF::RED . "||||||||||||| " . TF::WHITE . $progress . "%";
                break;

            case $progress <= 63:
                $energyBar = TF::GREEN . "|||||||||||||||||||||" . TF::RED . "|||||||||||| " . TF::WHITE . $progress . "%";
                break;

            case $progress <= 66:
                $energyBar = TF::GREEN . "||||||||||||||||||||||" . TF::RED . "||||||||||| " . TF::WHITE . $progress . "%";
                break;

            case $progress <= 69:
                $energyBar = TF::GREEN . "|||||||||||||||||||||||" . TF::RED . "|||||||||| " . TF::WHITE . $progress . "%";
                break;

            case $progress <= 72:
                $energyBar = TF::GREEN . "||||||||||||||||||||||||" . TF::RED . "||||||||| " . TF::WHITE . $progress . "%";
                break;

            case $progress <= 75:
                $energyBar = TF::GREEN . "|||||||||||||||||||||||||" . TF::RED . "|||||||| " . TF::WHITE . $progress . "%";
                break;

            case $progress <= 78:
                $energyBar = TF::GREEN . "||||||||||||||||||||||||||" . TF::RED . "||||||| " . TF::WHITE . $progress . "%";
                break;

            case $progress <= 81:
                $energyBar = TF::GREEN . "|||||||||||||||||||||||||||" . TF::RED . "|||||| " . TF::WHITE . $progress . "%";
                break;

            case $progress <= 84:
                $energyBar = TF::GREEN . "||||||||||||||||||||||||||||" . TF::RED . "||||| " . TF::WHITE . $progress . "%";
                break;

            case $progress <= 87:
                $energyBar = TF::GREEN . "|||||||||||||||||||||||||||||" . TF::RED . "|||| " . TF::WHITE . $progress . "%";
                break;

            case $progress <= 90:
                $energyBar = TF::GREEN . "||||||||||||||||||||||||||||||" . TF::RED . "||| " . TF::WHITE . $progress . "%";
                break;

            case $progress <= 93:
                $energyBar = TF::GREEN . "|||||||||||||||||||||||||||||||" . TF::RED . "|| " . TF::WHITE . $progress . "%";
                break;

            case $progress <= 96:
                $energyBar = TF::GREEN . "||||||||||||||||||||||||||||||||" . TF::RED . "| " . TF::WHITE . $progress . "%";
                break;

            case $progress <= 100:
                $energyBar = TF::GREEN . "|||||||||||||||||||||||||||||||||" . TF::RED . " " . TF::WHITE . $progress . "%";
                break;
        }

        return $energyBar;
    }

    public function createLore(Item $item, int $enchantId, int $level, int $rarity, int $success, int $energyNeeded, int $energy): array {
        # energy data
        $translatedEnergy = Translator::shortNumber($energy);
        $translatedEnergyNeeded = Translator::shortNumber($energyNeeded);
        # enchant data
        $fail = 100 - $success;
        $enchant = CustomEnchantManager::getEnchantment($enchantId);
        $description = $enchant->getDescription();
        $maximumLevel = $enchant->getMaxLevel();
        # create energy bar
        $energyBar = $this->createEnergyBar($item, $level, $rarity);
        # create lore
        return [
            TF::RESET . TF::GRAY . $description,
            TF::EOL,
            TF::RESET . TF::BOLD . TF::GREEN . $success . "% Success rate",
            TF::RESET . TF::BOLD . TF::RED . $fail . "% fail rate",
            TF::EOL,
            TF::RESET . TF::BOLD . TF::AQUA . "Energy",
            TF::RESET . "$energyBar",
            TF::RESET . TF::GRAY . "(" . TF::WHITE . "$translatedEnergy" . TF::GRAY . " / $translatedEnergyNeeded)",
            TF::EOL,
            TF::RESET . TF::GRAY . "Maximum Level: " . TF::WHITE . $maximumLevel,
            TF::RESET . TF::GRAY . "Applicable to: " . TF::WHITE . "Pickaxes",
            TF::EOL,
            TF::RESET . TF::GRAY . "Drag n' Drop onto an item to enchant"
        ];
    }

    /**
     * @throws Exception
     */
    public function EnchantedOrb($enchant, int $level, int $rarity, int $id, int $success): Item {

        $energyNeeded = $this->getOrbEnergyNeeded($level, $rarity);
        # get rarity colour
        $translatedRarityColour = match ($rarity) {
            800 => TF::BLUE,
            801 => TF::YELLOW,
            802 => TF::GOLD,
            803 => TF::LIGHT_PURPLE,
            804 => TF::RED,
            805 => TF::BLACK,
            806 => TF::WHITE,
            default => TF::GRAY
        };
        # get rarity name
        $translatedRarity = match ($rarity) {
            800 => "Elite",
            801 => TF::YELLOW . "Ultimate",
            802 => TF::GOLD . "Legendary",
            803 => TF::LIGHT_PURPLE . "Godly",
            804 => TF::RED . "Heroic",
            805 => TF::BLACK . "Executive",
            default => TF::GRAY . "Unknown"
        };
        # create item
        switch($rarity) {
            case CustomEnchant::RARITY_ELITE:
                $item = CustomiesItemFactory::getInstance()->get("emporiumenchants:elite_orb");
                break;
            case CustomEnchant::RARITY_ULTIMATE:
                $item = CustomiesItemFactory::getInstance()->get("emporiumenchants:ultimate_orb");
                break;
            case CustomEnchant::RARITY_LEGENDARY:
                $item = CustomiesItemFactory::getInstance()->get("emporiumenchants:legendary_orb");
                break;
            case CustomEnchant::RARITY_GODLY:
                $item = CustomiesItemFactory::getInstance()->get("emporiumenchants:godly_orb");
                break;
            case CustomEnchant::RARITY_HEROIC:
                $item = CustomiesItemFactory::getInstance()->get("emporiumenchants:heroic_orb");
                break;

            default:
                $item = VanillaItems::DYE()->setColor(DyeColor::CYAN());
                break;
        }
        $item->setCustomName(TF::BOLD . $translatedRarityColour . $enchant->getDisplayName() . " " . TF::RESET . TF::AQUA . Translator::romanNumber($level));
        # set item tags
        $item->getNamedTag()->setInt("OpenedPickaxeEnchantOrb", 0);
        $item->getNamedTag()->setInt("level", $level);
        $item->getNamedTag()->setString("RarityName", $translatedRarity);
        $item->getNamedTag()->setInt("Rarity", $rarity);
        $item->getNamedTag()->setInt("Energy", 0);
        $item->getNamedTag()->setInt("EnergyNeeded", $energyNeeded);
        $item->getNamedTag()->setInt("id", $id);
        $item->getNamedTag()->setInt("Success", $success);
        $energy = $item->getNamedTag()->getInt("Energy");
        # set the lore
        $lore = $this->createLore($item, $id, $level, $rarity, $success, $energyNeeded, $energy);
        $item->setLore($lore);
        # add enchant
        $item->addEnchantment(new EnchantmentInstance($enchant, $level));

        return $item;
    }

    public function updateOrb(Item $item): Item {
        # get book tags
        $id = $item->getNamedTag()->getInt("id");
        $level = $item->getNamedTag()->getInt("level");
        $rarityName = $item->getNamedTag()->getString("RarityName");
        $rarity = $item->getNamedTag()->getInt("Rarity");
        $energy = $item->getNamedTag()->getInt("Energy");
        $energyNeeded = $item->getNamedTag()->getInt("EnergyNeeded");
        $success = $item->getNamedTag()->getInt("Success");
        # create new lore
        $lore = $this->createLore($item, $id, $level, $rarity, $success, $energyNeeded, $energy);
        # set lore
        $item->setLore($lore);
        return $item;
    }
}