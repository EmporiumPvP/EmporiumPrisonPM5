<?php

namespace Emporium\Prison\items\BossItems;

use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\enchantment\VanillaEnchantments;
use pocketmine\item\Item;
use pocketmine\item\VanillaItems;
use pocketmine\utils\TextFormat as TF;

use Tetro\EmporiumEnchants\Core\CustomEnchantIds;
use Tetro\EmporiumEnchants\Core\CustomEnchantManager;

class Hades
{

    public function sword(): Item
    {

        $chance = mt_rand(1, 4);
        $item = match ($chance) {
            1 => VanillaItems::STONE_SWORD(),
            2 => VanillaItems::GOLDEN_SWORD(),
            3 => VanillaItems::IRON_SWORD(),
            4 => VanillaItems::DIAMOND_SWORD()
        };
        $item->setCustomName(TF::BOLD . TF::RED . "Hades' Sword");
        $item->addEnchantment(new EnchantmentInstance(VanillaEnchantments::SHARPNESS(), 10));
        $item->addEnchantment(new EnchantmentInstance(VanillaEnchantments::UNBREAKING(), 5));
        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantment(CustomEnchantIds::GLORY), 10));
        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantment(CustomEnchantIds::GRAVITY), 5));
        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantment(CustomEnchantIds::DOUBLESTRIKE), 3));
        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantment(CustomEnchantIds::BLESSED), 3));
        $item->addEnchantment(new EnchantmentInstance(CustomEnchantManager::getEnchantment(CustomEnchantIds::BLIND), 5));

        return $item;
    }

    public function helmet(): Item
    {

        $chance = mt_rand(1, 4);
        $item = match ($chance) {
            1 => VanillaItems::CHAINMAIL_HELMET(),
            2 => VanillaItems::GOLDEN_HELMET(),
            3 => VanillaItems::IRON_HELMET(),
            4 => VanillaItems::DIAMOND_HELMET()
        };

        $item->setCustomName(TF::BOLD . TF::RED . "Hades' Helmet");

        return $item;
    }

    public function chestplate(): Item
    {

        $chance = mt_rand(1, 4);
        $item = match ($chance) {
            1 => VanillaItems::CHAINMAIL_CHESTPLATE(),
            2 => VanillaItems::GOLDEN_CHESTPLATE(),
            3 => VanillaItems::IRON_CHESTPLATE(),
            4 => VanillaItems::DIAMOND_CHESTPLATE()
        };

        $item->setCustomName(TF::BOLD . TF::RED . "Hades' Chestplate");

        return $item;
    }

    public function leggings(): Item
    {

        $chance = mt_rand(1, 4);
        $item = match ($chance) {
            1 => VanillaItems::CHAINMAIL_LEGGINGS(),
            2 => VanillaItems::GOLDEN_LEGGINGS(),
            3 => VanillaItems::IRON_LEGGINGS(),
            4 => VanillaItems::DIAMOND_LEGGINGS()
        };

        $item->setCustomName(TF::BOLD . TF::RED . "Hades' Leggings");

        return $item;
    }

    public function boots(): Item
    {

        $chance = mt_rand(1, 4);
        $item = match ($chance) {
            1 => VanillaItems::CHAINMAIL_BOOTS(),
            2 => VanillaItems::GOLDEN_BOOTS(),
            3 => VanillaItems::IRON_BOOTS(),
            4 => VanillaItems::DIAMOND_BOOTS()
        };

        $item->setCustomName(TF::BOLD . TF::RED . "Hades' Boots");

        return $item;
    }

    public function getItems(): Item|array
    {
        $items[] = [$this->sword(), $this->helmet(), $this->chestplate(), $this->leggings(), $this->boots()];

        return $items;
    }
}
