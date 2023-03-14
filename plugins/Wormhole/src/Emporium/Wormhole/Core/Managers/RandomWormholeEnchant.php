<?php

namespace Emporium\Wormhole\Core\Managers;

use pocketmine\item\enchantment\VanillaEnchantments;

use pocketmine\item\Item;
use pocketmine\item\StringToItemParser;
use pocketmine\utils\TextFormat as TF;
use Tetro\EmporiumEnchants\Core\CustomEnchantIds;
use Tetro\EmporiumEnchants\Core\CustomEnchantManager;

class RandomWormholeEnchant {

    public function getRandomCustomEnchant(): int {
        return mt_rand(1, 10);
    }

    public function getRandomVanillaEnchant(): int {
        return mt_rand(1, 10);
    }

    public static function enchantGenerator($hand, $chance): Item {
        # get random custom enchant
        $customEnchant = (new RandomWormholeEnchant)->getRandomCustomEnchant();
        # get random vanilla enchant
        $vanillaEnchant = (new RandomWormholeEnchant)->getRandomVanillaEnchant();
        # assign custom enchant
        $enchant = $customEnchant;
        $fail = 100 - $chance;
        # enchant 1
        $item = StringToItemParser::getInstance()->parse("book");
        $lore = [];
        # will vanilla enchant be used?
        if($vanillaEnchant === 1) {
            if($hand->getEnchantment(VanillaEnchantments::EFFICIENCY()) === null) {
                $item->setCustomName("Efficiency I");
                $item->getNamedTag()->setInt("nextlevel", 1);
                $lore = [
                    "",
                    TF::GREEN . "Success: $chance",
                    TF::RED . "fail: $fail%",
                    "",
                    TF::GRAY . "Click to attempt enchant."
                ];
            } elseif($hand->getEnchantment(VanillaEnchantments::EFFICIENCY())->getLevel() === 10) {
                $item->setCustomName("Efficiency MAX LEVEL");
                $item->getNamedTag()->setString("isMax", "true");
                $item->getNamedTag()->setInt("nextlevel", 10);
                $lore = [
                    "",
                    TF::RED . "Enchant is Max Level.",
                    "",
                    TF::GRAY . "Click to Level Up Pickaxe",
                    TF::YELLOW . "(!) You wont get an enchant"
                ];
            } else {
                $newLevel = $hand->getEnchantment(VanillaEnchantments::EFFICIENCY())->getLevel() + 1;
                $item->setCustomName("Efficiency $newLevel");
                $item->getNamedTag()->setInt("nextlevel", $newLevel);
                $lore = [
                    "",
                    TF::GREEN . "Success: $chance%",
                    TF::RED . "fail: $fail%",
                    "",
                    TF::GRAY . "Click to attempt enchant."
                ];
            }
            $item->getNamedTag()->setString("enchant", "efficiency");
            $item->getNamedTag()->setInt("enchantId", 15);
            $item->getNamedTag()->setInt("success", $chance);
            $item->setLore($lore);
        } else {
            switch($enchant) {
                # alchemy
                case 1:
                    if($hand->getEnchantment(CustomEnchantManager::getEnchantment(CustomEnchantIds::ALCHEMY)) === null) {
                        $item->setCustomName(TF::BOLD . TF::GREEN . "Alchemy I");
                        $item->getNamedTag()->setInt("nextlevel", 1);
                        $lore = [
                            "",
                            TF::GREEN . "Success: $chance%",
                            TF::RED . "fail: $fail%",
                            "",
                            TF::GRAY . "Click to attempt enchant."
                        ];
                    } elseif ($hand->getEnchantment(CustomEnchantManager::getEnchantment(CustomEnchantIds::ALCHEMY))->getLevel() === CustomEnchantManager::getEnchantment(CustomEnchantIds::ALCHEMY)->getMaxLevel()) {
                        $item->setCustomName(TF::BOLD . TF::GREEN . "Alchemy MAX LEVEL");
                        $item->getNamedTag()->setString("isMax", "true");
                        $item->getNamedTag()->setInt("nextlevel", 3);
                        $lore = [
                            "",
                            TF::RED . "Enchant is Max Level.",
                            "",
                            TF::GRAY . "Click to Level Up Pickaxe",
                            TF::YELLOW . "(!) You wont get an enchant"
                        ];
                    } else {
                        $newLevel = $hand->getEnchantment(CustomEnchantManager::getEnchantment(CustomEnchantIds::ALCHEMY))->getLevel() + 1;
                        $item->setCustomName(TF::BOLD . TF::GREEN . "Alchemy $newLevel");
                        $item->getNamedTag()->setInt("nextlevel", $newLevel);
                        $lore = [
                            "",
                            TF::GREEN . "Success: $chance%",
                            TF::RED . "fail: $fail%",
                            "",
                            TF::GRAY . "Click to attempt enchant."
                        ];
                    }
                    $item->getNamedTag()->setString("enchant", "alchemy");
                    $item->getNamedTag()->setInt("enchantId", 144);
                    $item->getNamedTag()->setInt("success", $chance);
                    break;
                # energy collector
                case 2:
                    if($hand->getEnchantment(CustomEnchantManager::getEnchantment(CustomEnchantIds::ENERGY_COLLECTOR)) === null) {
                        $item->setCustomName(TF::BOLD . TF::GREEN . "Energy Collector I");
                        $item->getNamedTag()->setInt("nextlevel", 1);
                        $lore = [
                            "",
                            TF::GREEN . "Success: $chance%",
                            TF::RED . "fail: $fail%",
                            "",
                            TF::GRAY . "Click to attempt enchant."
                        ];
                    } elseif ($hand->getEnchantment(CustomEnchantManager::getEnchantment(CustomEnchantIds::ENERGY_COLLECTOR))->getLevel() === CustomEnchantManager::getEnchantment(CustomEnchantIds::ENERGY_COLLECTOR)->getMaxLevel()) {
                        $item->setCustomName(TF::BOLD . TF::GREEN . "Energy Collector MAX LEVEL");
                        $item->getNamedTag()->setString("isMax", "true");
                        $item->getNamedTag()->setInt("nextlevel", 5);
                        $lore = [
                            "",
                            TF::RED . "Enchant is Max Level.",
                            "",
                            TF::GRAY . "Click to Level Up Pickaxe",
                            TF::YELLOW . "(!) You wont get an enchant"
                        ];
                    } else {
                        $newLevel = $hand->getEnchantment(CustomEnchantManager::getEnchantment(CustomEnchantIds::ENERGY_COLLECTOR))->getLevel() + 1;
                        $item->setCustomName(TF::BOLD . TF::GREEN . "Energy Collector $newLevel");
                        $item->getNamedTag()->setInt("nextlevel", $newLevel);
                        $lore = [
                            "",
                            TF::GREEN . "Success: $chance%",
                            TF::RED . "fail: $fail%",
                            "",
                            TF::GRAY . "Click to attempt enchant."
                        ];
                    }
                    $item->getNamedTag()->setString("enchant", "energy_collector");
                    $item->getNamedTag()->setInt("enchantId", 145);
                    $item->getNamedTag()->setInt("success", $chance);
                    break;
                # transfuse
                case 3:
                    if($hand->getEnchantment(CustomEnchantManager::getEnchantment(CustomEnchantIds::TRANSFUSE)) === null) {
                        $item->setCustomName(TF::BOLD . TF::GREEN . "Transfuse I");
                        $item->getNamedTag()->setInt("nextlevel", 1);
                        $lore = [
                            "",
                            TF::GREEN . "Success: $chance%",
                            TF::RED . "fail: $fail%",
                            "",
                            TF::GRAY . "Click to attempt enchant."
                        ];
                    } elseif ($hand->getEnchantment(CustomEnchantManager::getEnchantment(CustomEnchantIds::TRANSFUSE))->getLevel() === CustomEnchantManager::getEnchantment(CustomEnchantIds::TRANSFUSE)->getMaxLevel()) {
                        $item->setCustomName(TF::BOLD . TF::GREEN . "Transfuse MAX LEVEL");
                        $item->getNamedTag()->setString("isMax", "true");
                        $item->getNamedTag()->setInt("nextlevel", 3);
                        $lore = [
                            "",
                            TF::RED . "Enchant is Max Level.",
                            "",
                            TF::GRAY . "Click to Level Up Pickaxe",
                            TF::YELLOW . "(!) You wont get an enchant"
                        ];
                    } else {
                        $newLevel = $hand->getEnchantment(CustomEnchantManager::getEnchantment(CustomEnchantIds::TRANSFUSE))->getLevel() + 1;
                        $item->setCustomName(TF::BOLD . TF::GREEN . "Transfuse $newLevel");
                        $item->getNamedTag()->setInt("nextlevel", $newLevel);
                        $lore = [
                            "",
                            TF::GREEN . "Success: $chance%",
                            TF::RED . "fail: $fail%",
                            "",
                            TF::GRAY . "Click to attempt enchant."
                        ];
                    }
                    $item->getNamedTag()->setString("enchant", "transfuse");
                    $item->getNamedTag()->setInt("enchantId", 146);
                    $item->getNamedTag()->setInt("success", $chance);
                    break;
                # ore magnet
                case 4:
                    if($hand->getEnchantment(CustomEnchantManager::getEnchantment(CustomEnchantIds::ORE_MAGNET)) === null) {
                        $item->setCustomName(TF::BOLD . TF::WHITE . "Ore Magnet I");
                        $item->getNamedTag()->setInt("nextlevel", 1);
                        $lore = [
                            "",
                            TF::GREEN . "Success: $chance%",
                            TF::RED . "fail: $fail%",
                            "",
                            TF::GRAY . "Click to attempt enchant."
                        ];
                    } elseif ($hand->getEnchantment(CustomEnchantManager::getEnchantment(CustomEnchantIds::ORE_MAGNET))->getLevel() === CustomEnchantManager::getEnchantment(CustomEnchantIds::ORE_MAGNET)->getMaxLevel()) {
                        $item->setCustomName(TF::BOLD . TF::WHITE . "Ore Magnet MAX LEVEL");
                        $item->getNamedTag()->setString("isMax", "true");
                        $item->getNamedTag()->setInt("nextlevel", 5);
                        $lore = [
                            "",
                            TF::RED . "Enchant is Max Level.",
                            "",
                            TF::GRAY . "Click to Level Up Pickaxe",
                            TF::YELLOW . "(!) You wont get an enchant"
                        ];
                    } else {
                        $newLevel = $hand->getEnchantment(CustomEnchantManager::getEnchantment(CustomEnchantIds::ORE_MAGNET))->getLevel() + 1;
                        $item->setCustomName(TF::BOLD . TF::WHITE . "Ore Magnet $newLevel");
                        $item->getNamedTag()->setInt("nextlevel", $newLevel);
                        $lore = [
                            "",
                            TF::GREEN . "Success: $chance%",
                            TF::RED . "fail: $fail%",
                            "",
                            TF::GRAY . "Click to attempt enchant."
                        ];
                    }
                    $item->getNamedTag()->setString("enchant", "ore_magnet");
                    $item->getNamedTag()->setInt("enchantId", 142);
                    $item->getNamedTag()->setInt("success", $chance);
                    break;
                # shard discoverer
                case 5:
                    if($hand->getEnchantment(CustomEnchantManager::getEnchantment(CustomEnchantIds::SHARD_DISCOVERER)) === null) {
                        $item->setCustomName(TF::BOLD . TF::WHITE . "Shard Discoverer I");
                        $item->getNamedTag()->setInt("nextlevel", 1);
                        $lore = [
                            "",
                            TF::GREEN . "Success: $chance%",
                            TF::RED . "fail: $fail%",
                            "",
                            TF::GRAY . "Click to attempt enchant."
                        ];
                    } elseif ($hand->getEnchantment(CustomEnchantManager::getEnchantment(CustomEnchantIds::SHARD_DISCOVERER))->getLevel() === CustomEnchantManager::getEnchantment(CustomEnchantIds::SHARD_DISCOVERER)->getMaxLevel()) {
                        $item->setCustomName(TF::BOLD . TF::WHITE . "Shard Discoverer MAX LEVEL");
                        $item->getNamedTag()->setString("isMax", "true");
                        $item->getNamedTag()->setInt("nextlevel", 5);
                        $lore = [
                            "",
                            TF::RED . "Enchant is Max Level.",
                            "",
                            TF::GRAY . "Click to Level Up Pickaxe",
                            TF::YELLOW . "(!) You wont get an enchant"
                        ];
                    } else {
                        $newLevel = $hand->getEnchantment(CustomEnchantManager::getEnchantment(CustomEnchantIds::SHARD_DISCOVERER))->getLevel() + 1;
                        $item->setCustomName(TF::BOLD . TF::WHITE . "Shard Discoverer $newLevel");
                        $item->getNamedTag()->setInt("nextlevel", $newLevel);
                        $lore = [
                            "",
                            TF::GREEN . "Success: $chance%",
                            TF::RED . "fail: $fail%",
                            "",
                            TF::GRAY . "Click to attempt enchant."
                        ];
                    }
                    $item->getNamedTag()->setString("enchant", "shard_discoverer");
                    $item->getNamedTag()->setInt("enchantId", 143);
                    $item->getNamedTag()->setInt("success", $chance);
                    break;
                # super breaker
                case 6:
                    if($hand->getEnchantment(CustomEnchantManager::getEnchantment(CustomEnchantIds::SUPER_BREAKER)) === null) {
                        $item->setCustomName(TF::BOLD . TF::BLUE . "Super Breaker I");
                        $item->getNamedTag()->setInt("nextlevel", 1);
                        $lore = [
                            "",
                            TF::GREEN . "Success: $chance%",
                            TF::RED . "fail: $fail%",
                            "",
                            TF::GRAY . "Click to attempt enchant."
                        ];
                    } elseif ($hand->getEnchantment(CustomEnchantManager::getEnchantment(CustomEnchantIds::SUPER_BREAKER))->getLevel() === CustomEnchantManager::getEnchantment(CustomEnchantIds::SUPER_BREAKER)->getMaxLevel()) {
                        $item->setCustomName(TF::BOLD . TF::BLUE . "Super Breaker MAX LEVEL");
                        $item->getNamedTag()->setString("isMax", "true");
                        $item->getNamedTag()->setInt("nextlevel", 10);
                        $lore = [
                            "",
                            TF::RED . "Enchant is Max Level.",
                            "",
                            TF::GRAY . "Click to Level Up Pickaxe",
                            TF::YELLOW . "(!) You wont get an enchant"
                        ];
                    } else {
                        $newLevel = $hand->getEnchantment(CustomEnchantManager::getEnchantment(CustomEnchantIds::SUPER_BREAKER))->getLevel() + 1;
                        $item->setCustomName(TF::BOLD . TF::BLUE . "Super Breaker $newLevel");
                        $item->getNamedTag()->setInt("nextlevel", $newLevel);
                        $lore = [
                            "",
                            TF::GREEN . "Success: $chance%",
                            TF::RED . "fail: $fail%",
                            "",
                            TF::GRAY . "Click to attempt enchant."
                        ];
                    }
                    $item->getNamedTag()->setString("enchant", "super_breaker");
                    $item->getNamedTag()->setInt("enchantId", 149);
                    $item->getNamedTag()->setInt("success", $chance);
                    break;
                # miners sight
                case 7:
                    if($hand->getEnchantment(CustomEnchantManager::getEnchantment(CustomEnchantIds::MINERS_SIGHT)) === null) {
                        $item->setCustomName(TF::BOLD . TF::BLUE . "Miners Sight I");
                        $item->getNamedTag()->setInt("nextlevel", 1);
                        $lore = [
                            "",
                            TF::GREEN . "Success: $chance%",
                            TF::RED . "fail: $fail%",
                            "",
                            TF::GRAY . "Click to attempt enchant."
                        ];
                    } elseif ($hand->getEnchantment(CustomEnchantManager::getEnchantment(CustomEnchantIds::MINERS_SIGHT))->getLevel() === CustomEnchantManager::getEnchantment(CustomEnchantIds::MINERS_SIGHT)->getMaxLevel()) {
                        $item->setCustomName(TF::BOLD . TF::BLUE . "Miners Sight MAX LEVEL");
                        $item->getNamedTag()->setString("isMax", "true");
                        $item->getNamedTag()->setInt("nextlevel", 1);
                        $lore = [
                            "",
                            TF::RED . "Enchant is Max Level.",
                            "",
                            TF::GRAY . "Click to Level Up Pickaxe",
                            TF::YELLOW . "(!) You wont get an enchant"
                        ];
                    } else {
                        $newLevel = $hand->getEnchantment(CustomEnchantManager::getEnchantment(CustomEnchantIds::MINERS_SIGHT))->getLevel() + 1;
                        $item->setCustomName(TF::BOLD . TF::BLUE . "Miners Sight $newLevel");
                        $item->getNamedTag()->setInt("nextlevel", $newLevel);
                        $lore = [
                            "",
                            TF::GREEN . "Success: $chance%",
                            TF::RED . "fail: $fail%",
                            "",
                            TF::GRAY . "Click to attempt enchant."
                        ];
                    }
                    $item->getNamedTag()->setString("enchant", "miners_sight");
                    $item->getNamedTag()->setInt("enchantId", 147);
                    $item->getNamedTag()->setInt("success", $chance);
                    break;
                # jackpot
                case 8:
                    if($hand->getEnchantment(CustomEnchantManager::getEnchantment(CustomEnchantIds::JACKPOT)) === null) {
                        $item->setCustomName(TF::BOLD . TF::YELLOW . "Jackpot I");
                        $item->getNamedTag()->setInt("nextlevel", 1);
                        $lore = [
                            "",
                            TF::GREEN . "Success: $chance%",
                            TF::RED . "fail: $fail%",
                            "",
                            TF::GRAY . "Click to attempt enchant."
                        ];
                    } elseif ($hand->getEnchantment(CustomEnchantManager::getEnchantment(CustomEnchantIds::JACKPOT))->getLevel() === CustomEnchantManager::getEnchantment(CustomEnchantIds::JACKPOT)->getMaxLevel()) {
                        $item->setCustomName(TF::BOLD . TF::YELLOW . "Jackpot MAX LEVEL");
                        $item->getNamedTag()->setString("isMax", "true");
                        $item->getNamedTag()->setInt("nextlevel", 10);
                        $lore = [
                            "",
                            TF::RED . "Enchant is Max Level.",
                            "",
                            TF::GRAY . "Click to Level Up Pickaxe",
                            TF::YELLOW . "(!) You wont get an enchant"
                        ];
                    } else {
                        $newLevel = $hand->getEnchantment(CustomEnchantManager::getEnchantment(CustomEnchantIds::JACKPOT))->getLevel() + 1;
                        $item->setCustomName(TF::BOLD . TF::YELLOW . "Jackpot $newLevel");
                        $item->getNamedTag()->setInt("nextlevel", $newLevel);
                        $lore = [
                            "",
                            TF::GREEN . "Success: $chance%",
                            TF::RED . "fail: $fail%",
                            "",
                            TF::GRAY . "Click to attempt enchant."
                        ];
                    }
                    $item->getNamedTag()->setString("enchant", "jackpot");
                    $item->getNamedTag()->setInt("enchantId", 150);
                    $item->getNamedTag()->setInt("success", $chance);
                    break;
                # ore surge
                case 9:
                    if($hand->getEnchantment(CustomEnchantManager::getEnchantment(CustomEnchantIds::ORE_SURGE)) === null) {
                        $item->setCustomName(TF::BOLD . TF::YELLOW . "Ore Surge I");
                        $item->getNamedTag()->setInt("nextlevel", 1);
                        $lore = [
                            "",
                            TF::GREEN . "Success: $chance%",
                            TF::RED . "fail: $fail%",
                            "",
                            TF::GRAY . "Click to attempt enchant."
                        ];
                    } elseif ($hand->getEnchantment(CustomEnchantManager::getEnchantment(CustomEnchantIds::ORE_SURGE))->getLevel() === CustomEnchantManager::getEnchantment(CustomEnchantIds::ORE_SURGE)->getMaxLevel()) {
                        $item->setCustomName(TF::BOLD . TF::YELLOW . "Ore Surge MAX LEVEL");
                        $item->getNamedTag()->setString("isMax", "true");
                        $item->getNamedTag()->setInt("nextlevel", 10);
                        $lore = [
                            "",
                            TF::RED . "Enchant is Max Level.",
                            "",
                            TF::GRAY . "Click to Level Up Pickaxe",
                            TF::YELLOW . "(!) You wont get an enchant"
                        ];
                    } else {
                        $newLevel = $hand->getEnchantment(CustomEnchantManager::getEnchantment(CustomEnchantIds::ORE_SURGE))->getLevel() + 1;
                        $item->setCustomName(TF::BOLD . TF::YELLOW . "Ore Surge $newLevel");
                        $item->getNamedTag()->setInt("nextlevel", $newLevel);
                        $lore = [
                            "",
                            TF::GREEN . "Success: $chance%",
                            TF::RED . "fail: $fail%",
                            "",
                            TF::GRAY . "Click to attempt enchant."
                        ];
                    }
                    $item->getNamedTag()->setString("enchant", "ore_surge");
                    $item->getNamedTag()->setInt("enchantId", 148);
                    $item->getNamedTag()->setInt("success", $chance);
                    break;
                # luck
                case 10:
                    if($hand->getEnchantment(CustomEnchantManager::getEnchantment(CustomEnchantIds::LUCK)) === null) {
                        $item->setCustomName(TF::BOLD . TF::GOLD . "Luck I");
                        $item->getNamedTag()->setInt("nextlevel", 1);
                        $lore = [
                            "",
                            TF::GREEN . "Success: $chance%",
                            TF::RED . "fail: $fail%",
                            "",
                            TF::GRAY . "Click to attempt enchant."
                        ];
                    } elseif ($hand->getEnchantment(CustomEnchantManager::getEnchantment(CustomEnchantIds::LUCK))->getLevel() === CustomEnchantManager::getEnchantment(CustomEnchantIds::LUCK)->getMaxLevel()) {
                        $item->setCustomName(TF::BOLD . TF::GOLD . "Luck MAX LEVEL");
                        $item->getNamedTag()->setString("isMax", "true");
                        $item->getNamedTag()->setInt("nextlevel", 5);
                        $lore = [
                            "",
                            TF::RED . "Enchant is Max Level.",
                            "",
                            TF::GRAY . "Click to Level Up Pickaxe",
                            TF::YELLOW . "(!) You wont get an enchant"
                        ];
                    } else {
                        $newLevel = $hand->getEnchantment(CustomEnchantManager::getEnchantment(CustomEnchantIds::LUCK))->getLevel() + 1;
                        $item->setCustomName(TF::BOLD . TF::GOLD . "Luck $newLevel");
                        $item->getNamedTag()->setInt("nextlevel", $newLevel);
                        $lore = [
                            "",
                            TF::GREEN . "Success: $chance%",
                            TF::RED . "fail: $fail%",
                            "",
                            TF::GRAY . "Click to attempt enchant."
                        ];
                    }
                    $item->getNamedTag()->setString("enchant", "luck");
                    $item->getNamedTag()->setInt("enchantId", 151);
                    $item->getNamedTag()->setInt("success", $chance);
                    break;
                # meteor hunter
                case 11:
                    if($hand->getEnchantment(CustomEnchantManager::getEnchantment(CustomEnchantIds::METEOR_HUNTER)) === null) {
                        $item->setCustomName(TF::BOLD . TF::BLUE . "Meteor Hunter I");
                        $item->getNamedTag()->setInt("nextlevel", 1);
                        $lore = [
                            "",
                            TF::GREEN . "Success: $chance%",
                            TF::RED . "fail: $fail%",
                            "",
                            TF::GRAY . "Click to attempt enchant."
                        ];
                    } elseif ($hand->getEnchantment(CustomEnchantManager::getEnchantment(CustomEnchantIds::METEOR_HUNTER))->getLevel() === CustomEnchantManager::getEnchantment(CustomEnchantIds::METEOR_HUNTER)->getMaxLevel()) {
                        $item->setCustomName(TF::BOLD . TF::BLUE . "Meteor Hunter MAX LEVEL");
                        $item->getNamedTag()->setString("isMax", "true");
                        $item->getNamedTag()->setInt("nextlevel", 10);
                        $lore = [
                            "",
                            TF::RED . "Enchant is Max Level.",
                            "",
                            TF::GRAY . "Click to Level Up Pickaxe",
                            TF::YELLOW . "(!) You wont get an enchant"
                        ];
                    } else {
                        $newLevel = $hand->getEnchantment(CustomEnchantManager::getEnchantment(CustomEnchantIds::METEOR_HUNTER))->getLevel() + 1;
                        $item->setCustomName(TF::BOLD . TF::BLUE . "Meteor Hunter $newLevel");
                        $item->getNamedTag()->setInt("nextlevel", 1);
                        $lore = [
                            "",
                            TF::GREEN . "Success: $chance%",
                            TF::RED . "fail: $fail%",
                            "",
                            TF::GRAY . "Click to attempt enchant."
                        ];
                    }
                    $item->getNamedTag()->setString("enchant", "meteor_hunter");
                    $item->getNamedTag()->setInt("enchantId", 152);
                    $item->getNamedTag()->setInt("success", $chance);
                    break;
                # meteor summoner
                case 12:
                    if($hand->getEnchantment(CustomEnchantManager::getEnchantment(CustomEnchantIds::METEOR_SUMMONER)) === null) {
                        $item->setCustomName(TF::BOLD . TF::BLUE . "Meteor Summoner I");
                        $item->getNamedTag()->setInt("nextlevel", 1);
                        $lore = [
                            "",
                            TF::GREEN . "Success: $chance%",
                            TF::RED . "fail: $fail%",
                            "",
                            TF::GRAY . "Click to attempt enchant."
                        ];
                    } elseif ($hand->getEnchantment(CustomEnchantManager::getEnchantment(CustomEnchantIds::METEOR_SUMMONER))->getLevel() === CustomEnchantManager::getEnchantment(CustomEnchantIds::METEOR_SUMMONER)->getMaxLevel()) {
                        $item->setCustomName(TF::BOLD . TF::BLUE . "Meteor Summoner MAX LEVEL");
                        $item->getNamedTag()->setString("isMax", "true");
                        $item->getNamedTag()->setInt("nextlevel", 10);
                        $lore = [
                            "",
                            TF::RED . "Enchant is Max Level.",
                            "",
                            TF::GRAY . "Click to Level Up Pickaxe",
                            TF::YELLOW . "(!) You wont get an enchant"
                        ];
                    } else {
                        $newLevel = $hand->getEnchantment(CustomEnchantManager::getEnchantment(CustomEnchantIds::METEOR_SUMMONER))->getLevel() + 1;
                        $item->setCustomName(TF::BOLD . TF::BLUE . "Meteor Summoner $newLevel");
                        $item->getNamedTag()->setInt("nextlevel", 1);
                        $lore = [
                            "",
                            TF::GREEN . "Success: $chance%",
                            TF::RED . "fail: $fail%",
                            "",
                            TF::GRAY . "Click to attempt enchant."
                        ];
                    }
                    $item->getNamedTag()->setString("enchant", "meteor_summoner");
                    $item->getNamedTag()->setInt("enchantId", 153);
                    $item->getNamedTag()->setInt("success", $chance);
                    break;
                # shatter
                case 13:
                    if($hand->getEnchantment(CustomEnchantManager::getEnchantment(CustomEnchantIds::SHATTER)) === null) {
                        $item->setCustomName(TF::BOLD . TF::BLUE . "Shatter I");
                        $item->getNamedTag()->setInt("nextlevel", 1);
                        $lore = [
                            "",
                            TF::GREEN . "Success: $chance%",
                            TF::RED . "fail: $fail%",
                            "",
                            TF::GRAY . "Click to attempt enchant."
                        ];
                    } elseif ($hand->getEnchantment(CustomEnchantManager::getEnchantment(CustomEnchantIds::SHATTER))->getLevel() === CustomEnchantManager::getEnchantment(CustomEnchantIds::SHATTER)->getMaxLevel()) {
                        $item->setCustomName(TF::BOLD . TF::BLUE . "Shatter MAX LEVEL");
                        $item->getNamedTag()->setString("isMax", "true");
                        $item->getNamedTag()->setInt("nextlevel", 10);
                        $lore = [
                            "",
                            TF::RED . "Enchant is Max Level.",
                            "",
                            TF::GRAY . "Click to Level Up Pickaxe",
                            TF::YELLOW . "(!) You wont get an enchant"
                        ];
                    } else {
                        $newLevel = $hand->getEnchantment(CustomEnchantManager::getEnchantment(CustomEnchantIds::SHATTER))->getLevel() + 1;
                        $item->setCustomName(TF::BOLD . TF::BLUE . "Shatter $newLevel");
                        $item->getNamedTag()->setInt("nextlevel", 1);
                        $lore = [
                            "",
                            TF::GREEN . "Success: $chance%",
                            TF::RED . "fail: $fail%",
                            "",
                            TF::GRAY . "Click to attempt enchant."
                        ];
                    }
                    $item->getNamedTag()->setString("enchant", "shatter");
                    $item->getNamedTag()->setInt("enchantId", 154);
                    $item->getNamedTag()->setInt("success", $chance);
                    break;
            }
            $item->setLore($lore);
        }
        return $item;
    }
}