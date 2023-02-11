<?php

namespace Forms;

use Emporium\Prison\library\formapi\SimpleForm;
use EmporiumCore\Managers\Data\DataManager;

use EmporiumCore\Variables;
use Items\Lootboxes;
#use Library\SeraCEs\Core\CustomEnchantManager;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\enchantment\StringToEnchantmentParser;
use pocketmine\item\ItemFactory;

class VoteShopForm {

    public function MainMenu($player): SimpleForm {
        $form = new SimpleForm(function($player, $data) {
            if ($data === null) {
                return;
            }
            switch($data) {
                case 0:
                    break;
                case 1:
                    $balance = DataManager::getData($player, "Players", "HalloweenPoints");
                    if ($balance >= 10) {
                        // Halloween Scythe
                        $item = ItemFactory::getInstance()->get(293);
                        $item->setCustomName("§r§l§8§k|§6|§r §l§8>> §l§6H§8a§6l§8l§6o§8w§6e§8e§6n §r§6Scythe §l§8<< §c§6|§8|");
                        $item->addEnchantment(new EnchantmentInstance(StringToEnchantmentParser::getInstance()->parse("sharpness"), 30));
                        $item->addEnchantment(new EnchantmentInstance(StringToEnchantmentParser::getInstance()->parse("unbreaking"), 10));
                        /*
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("hellforged"), 10));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("silence"), 2));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("demonic_lifesteal"), 5));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("hex"), 5));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("corrupt"), 5));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("disarmour"), 5));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("incinerate"), 10));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("soul_steal"), 3));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("soul_strike"), 3));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("vengance"), 5));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("confusion"), 10));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("curse"), 5));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("execution"), 10));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("vampire"), 3));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("assassin"), 5));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("bleeding"), 5));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("decapitation"), 10));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("double_strike"), 3));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("freeze"), 5));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("barbarian"), 5));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("charge"), 5));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("critical"), 5));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("rogue"), 5));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("berserk"), 10));
                        */
                        $item->getNamedTag()->setByte("HauntedAbility", 1);
                        $item->getNamedTag()->setByte("SoulEaterAbility", 1);
                        $item->getNamedTag()->setByte("NightmareAbility", 1);
                        $item->setLore([
                            "§r",
                            "§r§l§8-------[ §r§7Item Abilities §l§8]-------",
                            "§r§8- §l§9Haunted",
                            "§r§7   Inflict the enemy with every negative effect",
                            "§r§7   and damage them heavily for 5 seconds.",
                            "§r§7   5 seconds.",
                            "§r§8- §l§9Soul Eater",
                            "§r§7   Steal your enemies health and heal yourself",
                            "§r§7   whilst dealing damage to them.",
                            "§r§8- §l§9Nightmare",
                            "§r§7   Grants you with permanent strength 10."
                        ]);
                        // Give Scythe
                        foreach ($player->getInventory()->addItem($item) as $invfull) {
                            $player->getWorld()->dropItem($player->getPosition(), $invfull);
                        }
                        DataManager::takeData($player, "Players", "HalloweenPoints", 10);
                        $player->sendMessage(Variables::SERVER_PREFIX . "§r§7You have purchased a Halloween Scythe for 10 Halloween Points.");
                        return;
                    }
                    $player->sendMessage("§l§cError §8>> §r§7You do not have enough Halloween Points to purchase a Halloween Scythe.");
                    break;
                case 2:
                    $balance = DataManager::getData($player, "Players", "HalloweenPoints");
                    if ($balance >= 10) {
                        // Halloween Pickaxe
                        $item = ItemFactory::getInstance()->get(278);
                        $item->setCustomName("§r§l§8§k|§6|§r §l§8>> §l§6H§8a§6l§8l§6o§8w§6e§8e§6n §r§6Pickaxe §l§8<< §6§k|§8|");
                        $item->addEnchantment(new EnchantmentInstance(StringToEnchantmentParser::getInstance()->parse("efficiency"), 10));
                        $item->addEnchantment(new EnchantmentInstance(StringToEnchantmentParser::getInstance()->parse("unbreaking"), 10));
                        /*
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("reforged"), 10));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("discovery"), 5));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("power_hunter"), 5));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("detonate"), 3));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("miners_luck"), 5));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("elixir_hunter"), 25));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("lucky"), 10));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("jackpot"), 150));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("key_hunter"), 10));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("relic_hunter"), 10));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("exp_hunter"), 15));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("scavenger"), 10));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("haste"), 10));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("smelting"), 1));
                        */
                        $item->getNamedTag()->setByte("GraveDiggerAbility", 1);
                        $item->setLore([
                            "§r",
                            "§r§l§8-------[ §r§7Item Abilities §l§8]-------",
                            "§r§8- §l§9Grave Digger",
                            "§r§7   Find random relics and keys whilst mining",
                            "§r§7   in the wilderness and in mines."
                        ]);
                        // Give Pickaxe
                        foreach ($player->getInventory()->addItem($item) as $invfull) {
                            $player->getWorld()->dropItem($player->getPosition(), $invfull);
                        }
                        DataManager::takeData($player, "Players", "HalloweenPoints", 10);
                        $player->sendMessage(Variables::SERVER_PREFIX . "§r§7You have purchased a Halloween Pickaxe for 10 Halloween Points.");
                        return;
                    }
                    $player->sendMessage("§l§cError §8>> §r§7You do not have enough Halloween Points to purchase a Halloween Pickaxe.");
                    break;
                case 3:
                    $balance = DataManager::getData($player, "Players", "HalloweenPoints");
                    if ($balance >= 5) {
                        // Halloween Helmet
                        $item = ItemFactory::getInstance()->get(310);
                        $item->setCustomName("§r§l§8§k|§6|§r §l§8>> §l§6H§8a§6l§8l§6o§8w§6e§8e§6n §r§6Helmet §l§8<< §6§k|§8|");
                        $item->addEnchantment(new EnchantmentInstance(StringToEnchantmentParser::getInstance()->parse("protection"), 10));
                        $item->addEnchantment(new EnchantmentInstance(StringToEnchantmentParser::getInstance()->parse("unbreaking"), 10));
                        /*
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("demonic_overload"), 3));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("dragonskin"), 5));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("implants"), 3));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("solitude"), 10));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("antitoxin"), 10));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("drunk"), 5));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("reflect"), 5));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("valor"), 5));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("clarity"), 10));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("focused"), 10));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("metaphysical"), 10));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("defence"), 3));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("dodge"), 10));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("enlighten"), 5));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("painkiller"), 10));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("angelic"), 5));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("wither"), 5));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("glowing"), 1));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("ghost"), 5));
                        */
                        $item->getNamedTag()->setByte("RottedAbility", 1);
                        $item->getNamedTag()->setByte("ClownAbility", 1);
                        $item->setLore([
                            "§r",
                            "§r§l§8-------[ §r§7Item Abilities §l§8]-------",
                            "§r§8- §l§9Rotted",
                            "§r§7   Inflict the opponent with blindness, nausea",
                            "§r§7   and mining fatigue.",
                            "§r§8- §l§9Clown",
                            "§r§7   Replaces the enemies helmet slot with a pumpkin",
                            "§r§7   and places their helmet in their inventory or",
                            "§r§7   drops their helmet if they have a full inventory."
                        ]);
                        // Give Helmet
                        foreach ($player->getInventory()->addItem($item) as $invfull) {
                            $player->getWorld()->dropItem($player->getPosition(), $invfull);
                        }
                        DataManager::takeData($player, "Players", "HalloweenPoints", 5);
                        $player->sendMessage(Variables::SERVER_PREFIX . "§r§7You have purchased a Halloween Helmet for 5 Halloween Points.");
                        return;
                    }
                    $player->sendMessage("§l§cError §8>> §r§7You do not have enough Halloween Points to purchase a Halloween Helmet.");
                    break;
                case 4:
                    $balance = DataManager::getData($player, "Players", "HalloweenPoints");
                    if ($balance >= 5) {
                        // Halloween Chestplate
                        $item = ItemFactory::getInstance()->get(311);
                        $item->setCustomName("§r§l§8§k|§6|§r §l§8>> §l§6H§8a§6l§8l§6o§8w§6e§8e§6n §r§6Chestplate §l§8<< §6§k|§8|");
                        $item->addEnchantment(new EnchantmentInstance(StringToEnchantmentParser::getInstance()->parse("protection"), 10));
                        $item->addEnchantment(new EnchantmentInstance(StringToEnchantmentParser::getInstance()->parse("unbreaking"), 10));
                        /*
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("demonic_overload"), 3));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("dragonskin"), 5));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("diminish"), 5));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("solitude"), 10));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("divinity"), 10));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("shockwave"), 5));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("vitamins"), 10));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("drunk"), 5));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("reflect"), 5));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("valor"), 5));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("bloodlust"), 5));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("defence"), 3));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("dodge"), 10));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("enlighten"), 5));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("magma"), 10));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("painkiller"), 10));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("angelic"), 5));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("wither"), 5));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("ghost"), 5));
                        */
                        $item->getNamedTag()->setByte("RottedAbility", 1);
                        $item->getNamedTag()->setByte("ClownAbility", 1);
                        $item->getNamedTag()->setByte("ImmortalityAbility", 1);
                        $item->setLore([
                            "§r",
                            "§r§l§8-------[ §r§7Item Abilities §l§8]-------",
                            "§r§8- §l§9Rotted",
                            "§r§7   Inflict the opponent with blindness, nausea",
                            "§r§7   and mining fatigue.",
                            "§r§8- §l§9Clown",
                            "§r§7   Replaces the enemies helmet slot with a pumpkin",
                            "§r§7   and places their helmet in their inventory or",
                            "§r§7   drops their helmet if they have a full inventory.",
                            "§r§8- §l§9Immortality",
                            "§r§7   Have a 50% chance to fully revive when",
                            "§r§7   you die."
                        ]);
                        // Give Chestplate
                        foreach ($player->getInventory()->addItem($item) as $invfull) {
                            $player->getWorld()->dropItem($player->getPosition(), $invfull);
                        }
                        DataManager::takeData($player, "Players", "HalloweenPoints", 5);
                        $player->sendMessage(Variables::SERVER_PREFIX . "§r§7You have purchased a Halloween Chestplate for 5 Halloween Points.");
                        return;
                    }
                    $player->sendMessage("§l§cError §8>> §r§7You do not have enough Halloween Points to purchase a Halloween Chestplate.");
                    break;
                case 5:
                    $balance = DataManager::getData($player, "Players", "HalloweenPoints");
                    if ($balance >= 5) {
                        // Halloween Leggings
                        $item = ItemFactory::getInstance()->get(312);
                        $item->setCustomName("§r§l§8§k|§6|§r §l§8>> §l§6H§8a§6l§8l§6o§8w§6e§8e§6n §r§6Leggings §l§8<< §6§k|§8|");
                        $item->addEnchantment(new EnchantmentInstance(StringToEnchantmentParser::getInstance()->parse("protection"), 10));
                        $item->addEnchantment(new EnchantmentInstance(StringToEnchantmentParser::getInstance()->parse("unbreaking"), 10));
                        /*
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("natures_wrath"), 3));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("demonic_overload"), 3));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("dragonskin"), 5));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("solitude"), 10));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("drunk"), 5));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("reflect"), 5));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("valor"), 5));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("defence"), 3));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("dodge"), 10));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("magma"), 10));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("painkiller"), 10));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("enlighten"), 5));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("angelic"), 5));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("poisoned"), 5));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("tempered"), 5));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("ghost"), 5));
                        */
                        $item->getNamedTag()->setByte("RottedAbility", 1);
                        $item->getNamedTag()->setByte("ClownAbility", 1);
                        $item->setLore([
                            "§r",
                            "§r§l§8-------[ §r§7Item Abilities §l§8]-------",
                            "§r§8- §l§9Rotted",
                            "§r§7   Inflict the opponent with blindness, nausea",
                            "§r§7   and mining fatigue.",
                            "§r§8- §l§9Clown",
                            "§r§7   Replaces the enemies helmet slot with a pumpkin",
                            "§r§7   and places their helmet in their inventory or",
                            "§r§7   drops their helmet if they have a full inventory."
                        ]);
                        // Give Leggings
                        foreach ($player->getInventory()->addItem($item) as $invfull) {
                            $player->getWorld()->dropItem($player->getPosition(), $invfull);
                        }
                        DataManager::takeData($player, "Players", "HalloweenPoints", 5);
                        $player->sendMessage(Variables::SERVER_PREFIX . "§r§7You have purchased a Halloween Leggings for 5 Halloween Points.");
                        return;
                    }
                    $player->sendMessage("§l§cError §8>> §r§7You do not have enough Halloween Points to purchase a Halloween Leggings.");
                    break;
                case 6:
                    $balance = DataManager::getData($player, "Players", "HalloweenPoints");
                    if ($balance >= 5) {
                        // Halloween Boots
                        $item = ItemFactory::getInstance()->get(313);
                        $item->setCustomName("§r§l§8§k|§6|§r §l§8>> §l§6H§8a§6l§8l§6o§8w§6e§8e§6n §r§6Boots §l§8<< §6§k|§8|");
                        $item->addEnchantment(new EnchantmentInstance(StringToEnchantmentParser::getInstance()->parse("protection"), 10));
                        $item->addEnchantment(new EnchantmentInstance(StringToEnchantmentParser::getInstance()->parse("unbreaking"), 10));
                        /*
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("warmer"), 1));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("demonic_overload"), 3));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("dragonskin"), 5));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("solitude"), 10));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("drunk"), 5));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("reflect"), 5));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("valor"), 5));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("defence"), 3));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("dodge"), 10));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("painkiller"), 10));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("enlighten"), 5));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("angelic"), 5));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("starved"), 5));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("wither"), 5));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("bunny"), 2));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("speed"), 2));
                        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantmentByName("ghost"), 5));
                        */
                        $item->getNamedTag()->setByte("RottedAbility", 1);
                        $item->getNamedTag()->setByte("ClownAbility", 1);
                        $item->getNamedTag()->setByte("AgileAbility", 1);
                        $item->setLore([
                            "§r",
                            "§r§l§8-------[ §r§7Item Abilities §l§8]-------",
                            "§r§8- §l§9Rotted",
                            "§r§7   Inflict the opponent with blindness, nausea",
                            "§r§7   and mining fatigue.",
                            "§r§8- §l§9Clown",
                            "§r§7   Replaces the enemies helmet slot with a pumpkin",
                            "§r§7   and places their helmet in their inventory or",
                            "§r§7   drops their helmet if they have a full inventory.",
                            "§r§8- §l§9Ethereal",
                            "§r§7   Grants you with permanent speed 5 and jump",
                            "§r§7   boost 5."
                        ]);
                        // Give Boots
                        foreach ($player->getInventory()->addItem($item) as $invfull) {
                            $player->getWorld()->dropItem($player->getPosition(), $invfull);
                        }
                        DataManager::takeData($player, "Players", "HalloweenPoints", 5);
                        $player->sendMessage(Variables::SERVER_PREFIX . "§r§7You have purchased a Halloween Boots for 5 Halloween Points.");
                        return;
                    }
                    $player->sendMessage("§l§cError §8>> §r§7You do not have enough Halloween Points to purchase a Halloween Boots.");
                    break;
                case 7:
                    $balance = DataManager::getData($player, "Players", "HalloweenPoints");
                    if ($balance >= 31) {
                        // Give Lootbox
                        foreach ($player->getInventory()->addItem((new Lootboxes)->Halloween()) as $invfull) {
                            $player->getWorld()->dropItem($player->getPosition(), $invfull);
                        }
                        DataManager::takeData($player, "Players", "HalloweenPoints", 31);
                        $player->sendMessage(Variables::SERVER_PREFIX . "§r§7You have purchased a Halloween Lootbox for 31 Halloween Points.");
                        return;
                    }
                    $player->sendMessage("§l§cError §8>> §r§7You do not have enough Halloween Points to purchase a Halloween Lootbox.");
                    break;
            }
        });
        $balance = DataManager::getData($player, "Players", "HalloweenPoints");
        $form->setTitle("§l§9Halloween Menu");
        $form->setContent("§7Welcome to Emporium's Halloween Season!\nYou can earn Halloween Points by voting at vote.emporiummc.org.\nYour Points: $balance");
        $form->addButton("§4Close");
        $form->addButton("§9Halloween Scythe\n§610 Halloween Points");
        $form->addButton("§9Halloween Pickaxe\n§610 Halloween Points");
        $form->addButton("§9Halloween Helmet\n§65 Halloween Points");
        $form->addButton("§9Halloween Chestplate\n§65 Halloween Points");
        $form->addButton("§9Halloween Leggings\n§65 Halloween Points");
        $form->addButton("§9Halloween Boots\n§65 Halloween Points");
        $form->addButton("§9Halloween Lootbox\n§631 Halloween Points");
        $player->sendForm($form);

        return $form;
    }

}