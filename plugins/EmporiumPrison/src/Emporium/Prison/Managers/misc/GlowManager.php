<?php

namespace Emporium\Prison\Managers\misc;

use pocketmine\data\bedrock\EnchantmentIdMap;
use pocketmine\item\enchantment\{Enchantment, EnchantmentInstance, ItemFlags, Rarity};

class GlowManager {

    public static EnchantmentInstance $enchInst;
    
    public static function createEnchant(): void {
        EnchantmentIdMap::getInstance()->register(1000, new Enchantment("Glow", Rarity::MYTHIC, ItemFlags::ALL, ItemFlags::ALL, 5));
        $enchantment = EnchantmentIdMap::getInstance()->fromId(1000);
        GlowManager::$enchInst = new EnchantmentInstance($enchantment, 1);
    }

}
