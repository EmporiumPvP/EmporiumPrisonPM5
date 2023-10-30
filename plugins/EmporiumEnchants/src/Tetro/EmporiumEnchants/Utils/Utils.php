<?php

# Namespace
namespace Tetro\EmporiumEnchants\Utils;

# Pocketmine Packages
use pocketmine\network\mcpe\protocol\types\inventory\ItemStack;
use pocketmine\item\{Armor, Axe, Durable, Hoe, Tool, Item, Sword, VanillaItems};
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\network\mcpe\convert\TypeConverter;
use pocketmine\inventory\ArmorInventory;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\Utils\TextFormat;
use pocketmine\player\Player;

# Used Files
use Tetro\EmporiumEnchants\Core\{CustomEnchant, CustomEnchantIds, CustomEnchantManager};

# Utils
class Utils {
    
    # Array
    public static array $shouldTakeFallDamage;

    # Register Type Names
    const TYPE_NAMES = [
        CustomEnchant::ITEM_TYPE_ARMOR => "Armor",
        CustomEnchant::ITEM_TYPE_HELMET => "Helmet",
        CustomEnchant::ITEM_TYPE_CHESTPLATE => "Chestplate",
        CustomEnchant::ITEM_TYPE_LEGGINGS => "Leggings",
        CustomEnchant::ITEM_TYPE_BOOTS => "Boots",
        CustomEnchant::ITEM_TYPE_WEAPON => "Sword, Axe & Scythe",
        CustomEnchant::ITEM_TYPE_SWORD => "Sword",
        CustomEnchant::ITEM_TYPE_AXE => "Axe",
        CustomEnchant::ITEM_TYPE_SCYTHE => "Scythe",
        CustomEnchant::ITEM_TYPE_DAMAGEABLE => "Damageable",
        CustomEnchant::ITEM_TYPE_GLOBAL => "Global",
        CustomEnchant::ITEM_TYPE_TOOLS => "Pickaxe"
    ];

    # Register Rarities
    const RARITY_NAMES = [
        CustomEnchant::RARITY_ELITE => "Elite",
        CustomEnchant::RARITY_ULTIMATE => "Ultimate",
        CustomEnchant::RARITY_LEGENDARY => "Legendary",
        CustomEnchant::RARITY_GODLY => "Godly",
        CustomEnchant::RARITY_HEROIC => "Heroic",
        CustomEnchant::RARITY_EXECUTIVE => "Executive",
    ];

    # Register Incompatible Enchants
    const INCOMPATIBLE_ENCHANTS = [
        CustomEnchantIds::LIFESTEAL => [CustomEnchantIds::DEMONICLIFESTEAL],
        CustomEnchantIds::CYBERNETICARMORED => [CustomEnchantIds::ARMORED, CustomEnchantIds::HEAVY, CustomEnchantIds::TANK],
        CustomEnchantIds::GODLYOVERLOAD => [CustomEnchantIds::OVERLOAD],
        CustomEnchantIds::CYBERNETICENIGHTENED => [CustomEnchantIds::ENLIGHTENED],
        CustomEnchantIds::RAGE => [CustomEnchantIds::ULTRARAGE],
        CustomEnchantIds::DRUNK => [CustomEnchantIds::TITANTRAP],
    ];

    public function getEnchant(int $rarity) {
        $enchantments = [];
        foreach (CustomEnchantManager::getEnchantments() as $enchants) {
            $enchantments[$enchants->getRarity()][] = $enchants;
        }
        return $enchantments[$rarity];
    }

    public function getPickaxeEnchant(int $rarity) {
        $enchantments = [];
        foreach (CustomEnchantManager::getEnchantments() as $enchants) {
            if($enchants->getItemType() === CustomEnchant::ITEM_TYPE_TOOLS) {
                $enchantments[$enchants->getRarity()][] = $enchants;
            }
        }
        return $enchantments[$rarity];
    }

    public function getEnchantNotPickaxe(int $rarity) {
        $enchantments = [];
        foreach (CustomEnchantManager::getEnchantments() as $enchants) {
            if($enchants->getItemType() === CustomEnchant::ITEM_TYPE_TOOLS) break;
            $enchantments[$enchants->getRarity()][] = $enchants;
        }
        return $enchantments[$rarity];
    }

    public static function getRandomArmourEnchant(): ?CustomEnchant {

        $randomEnchant = mt_rand(1, 33);
        $enchant = null;

        switch($randomEnchant) {

            case 1:
                $enchant = CustomEnchantManager::getEnchantment(CustomEnchantIds::ANGELIC);
                break;

            case 2:
                $enchant = CustomEnchantManager::getEnchantment(CustomEnchantIds::ARMORED);
                break;

            case 3:
                $enchant = CustomEnchantManager::getEnchantment(CustomEnchantIds::BERSERKER);
                break;

            case 4:
                $enchant = CustomEnchantManager::getEnchantment(CustomEnchantIds::CURSE);
                break;

            case 5:
                $enchant = CustomEnchantManager::getEnchantment(CustomEnchantIds::DEATHBRINGER);
                break;

            case 6:
                $enchant = CustomEnchantManager::getEnchantment(CustomEnchantIds::DEFLECT);
                break;

            case 7:
                $enchant = CustomEnchantManager::getEnchantment(CustomEnchantIds::DIMINISH);
                break;

            case 8:
                $enchant = CustomEnchantManager::getEnchantment(CustomEnchantIds::CYBERNETICARMORED);
                break;

            case 9:
                $enchant = CustomEnchantManager::getEnchantment(CustomEnchantIds::CYBERNETICENIGHTENED);
                break;

            case 10:
                $enchant = CustomEnchantManager::getEnchantment(CustomEnchantIds::DRUNK);
                break;

            case 11:
                $enchant = CustomEnchantManager::getEnchantment(CustomEnchantIds::ENDERSHIFT);
                break;

            case 12:
                $enchant = CustomEnchantManager::getEnchantment(CustomEnchantIds::ENDERWALKER);
                break;

            case 13:
                $enchant = CustomEnchantManager::getEnchantment(CustomEnchantIds::ENLIGHTED);
                break;

            case 14:
                $enchant = CustomEnchantManager::getEnchantment(CustomEnchantIds::ENLIGHTENED);
                break;

            case 15:
                $enchant = CustomEnchantManager::getEnchantment(CustomEnchantIds::ETHEREALDODGE);
                break;

            case 16:
                $enchant = CustomEnchantManager::getEnchantment(CustomEnchantIds::FROZEN);
                break;

            case 17:
                $enchant = CustomEnchantManager::getEnchantment(CustomEnchantIds::GODLYOVERLOAD);
                break;

            case 18:
                $enchant = CustomEnchantManager::getEnchantment(CustomEnchantIds::HEATWAVE);
                break;

            case 19:
                $enchant = CustomEnchantManager::getEnchantment(CustomEnchantIds::HEAVY);
                break;

            case 20:
                $enchant = CustomEnchantManager::getEnchantment(CustomEnchantIds::METAPHYSICAL);
                break;

            case 21:
                $enchant = CustomEnchantManager::getEnchantment(CustomEnchantIds::MOLTEN);
                break;

            case 22:
                $enchant = CustomEnchantManager::getEnchantment(CustomEnchantIds::NOURISH);
                break;

            case 23:
                $enchant = CustomEnchantManager::getEnchantment(CustomEnchantIds::NURTURE);
                break;

            case 24:
                $enchant = CustomEnchantManager::getEnchantment(CustomEnchantIds::OBSCURE);
                break;

            case 25:
                $enchant = CustomEnchantManager::getEnchantment(CustomEnchantIds::OBSIDIANSHIELD);
                break;

            case 26:
                $enchant = CustomEnchantManager::getEnchantment(CustomEnchantIds::OVERLOAD);
                break;

            case 27:
                $enchant = CustomEnchantManager::getEnchantment(CustomEnchantIds::PAINKILLER);
                break;

            case 28:
                $enchant = CustomEnchantManager::getEnchantment(CustomEnchantIds::REVIVE);
                break;

            case 29:
                $enchant = CustomEnchantManager::getEnchantment(CustomEnchantIds::SHOCKWAVE);
                break;

            case 30:
                $enchant = CustomEnchantManager::getEnchantment(CustomEnchantIds::TANK);
                break;

            case 31:
                $enchant = CustomEnchantManager::getEnchantment(CustomEnchantIds::TITANTRAP);
                break;

            case 32:
                $enchant = CustomEnchantManager::getEnchantment(CustomEnchantIds::VALOR);
                break;

            case 33:
                $enchant = CustomEnchantManager::getEnchantment(CustomEnchantIds::VOODOO);
                break;
        }

        return $enchant;
    }

    public static function getRandomWeaponEnchant(): ?CustomEnchant {

        $randomEnchant = mt_rand(1, 35);
        $enchant = null;

        switch($randomEnchant) {

            case 1:
                $enchant = CustomEnchantManager::getEnchantment(CustomEnchantIds::ACCURACY);
                break;

            case 2:
                $enchant = CustomEnchantManager::getEnchantment(CustomEnchantIds::AERIAL);
                break;

            case 3:
                $enchant = CustomEnchantManager::getEnchantment(CustomEnchantIds::BACKSTAB);
                break;

            case 4:
                $enchant = CustomEnchantManager::getEnchantment(CustomEnchantIds::BLESSED);
                break;

            case 5:
                $enchant = CustomEnchantManager::getEnchantment(CustomEnchantIds::BLIND);
                break;

            case 6:
                $enchant = CustomEnchantManager::getEnchantment(CustomEnchantIds::BLOCK);
                break;

            case 7:
                $enchant = CustomEnchantManager::getEnchantment(CustomEnchantIds::CHARGE);
                break;

            case 8:
                $enchant = CustomEnchantManager::getEnchantment(CustomEnchantIds::CRIPPLE);
                break;

            case 9:
                $enchant = CustomEnchantManager::getEnchantment(CustomEnchantIds::DECAPITATION);
                break;

            case 10:
                $enchant = CustomEnchantManager::getEnchantment(CustomEnchantIds::DEMISE);
                break;

            case 11:
                $enchant = CustomEnchantManager::getEnchantment(CustomEnchantIds::DEMONFORGED);
                break;

            case 12:
                $enchant = CustomEnchantManager::getEnchantment(CustomEnchantIds::DEMONICLIFESTEAL);
                break;

            case 13:
                $enchant = CustomEnchantManager::getEnchantment(CustomEnchantIds::DISARMOR);
                break;

            case 14:
                $enchant = CustomEnchantManager::getEnchantment(CustomEnchantIds::DISINTEGRATE);
                break;

            case 15:
                $enchant = CustomEnchantManager::getEnchantment(CustomEnchantIds::DOMINATE);
                break;

            case 16:
                $enchant = CustomEnchantManager::getEnchantment(CustomEnchantIds::DOUBLESTRIKE);
                break;

            case 17:
                $enchant = CustomEnchantManager::getEnchantment(CustomEnchantIds::EXECUTE);
                break;

            case 18:
                $enchant = CustomEnchantManager::getEnchantment(CustomEnchantIds::EXPERIENCEHUNTER);
                break;

            case 19:
                $enchant = CustomEnchantManager::getEnchantment(CustomEnchantIds::FREEZE);
                break;

            case 20:
                $enchant = CustomEnchantManager::getEnchantment(CustomEnchantIds::FRENZY);
                break;

            case 21:
                $enchant = CustomEnchantManager::getEnchantment(CustomEnchantIds::GRAVITY);
                break;

            case 22:
                $enchant = CustomEnchantManager::getEnchantment(CustomEnchantIds::HALLUCINATION);
                break;

            case 23:
                $enchant = CustomEnchantManager::getEnchantment(CustomEnchantIds::HUNTSMAN);
                break;

            case 24:
                $enchant = CustomEnchantManager::getEnchantment(CustomEnchantIds::ICEASPECT);
                break;

            case 25:
                $enchant = CustomEnchantManager::getEnchantment(CustomEnchantIds::INCENDIARY);
                break;

            case 26:
                $enchant = CustomEnchantManager::getEnchantment(CustomEnchantIds::INFLUX);
                break;

            case 27:
                $enchant = CustomEnchantManager::getEnchantment(CustomEnchantIds::INVERSION);
                break;

            case 28:
                $enchant = CustomEnchantManager::getEnchantment(CustomEnchantIds::LIFESTEAL);
                break;

            case 29:
                $enchant = CustomEnchantManager::getEnchantment(CustomEnchantIds::MANIAC);
                break;

            case 30:
                $enchant = CustomEnchantManager::getEnchantment(CustomEnchantIds::POISON);
                break;

            case 31:
                $enchant = CustomEnchantManager::getEnchantment(CustomEnchantIds::RAGE);
                break;

            case 32:
                $enchant = CustomEnchantManager::getEnchantment(CustomEnchantIds::SILENCE);
                break;

            case 33:
                $enchant = CustomEnchantManager::getEnchantment(CustomEnchantIds::SOULSTEAL);
                break;

            case 34:
                $enchant = CustomEnchantManager::getEnchantment(CustomEnchantIds::ULTRARAGE);
                break;

            case 35:
                $enchant = CustomEnchantManager::getEnchantment(CustomEnchantIds::WITHER);
                break;
        }

        return $enchant;
    }

    # Roman Numeral Converter
    public static function getRomanNumeral(int $integer): string {
        $romanNumeralConversionTable = [
            'M' => 1000,
            'CM' => 900,
            'D' => 500,
            'CD' => 400,
            'C' => 100,
            'XC' => 90,
            'L' => 50,
            'XL' => 40,
            'X' => 10,
            'IX' => 9,
            'V' => 5,
            'IV' => 4,
            'I' => 1
        ];
        $romanString = "";
        while ($integer > 0) {
            foreach ($romanNumeralConversionTable as $rom => $arb) {
                if ($integer >= $arb) {
                    $integer -= $arb;
                    $romanString .= $rom;
                    break;
                }
            }
        }
        return $romanString;
    }

    # If is Helmet
    public static function isHelmet(Item $item): bool {
        return $item instanceof Armor && $item->getArmorSlot() === ArmorInventory::SLOT_HEAD;
    }

    # If is Chestplate
    public static function isChestplate(Item $item): bool {
        return $item instanceof Armor && $item->getArmorSlot() === ArmorInventory::SLOT_CHEST;
    }

    # If is Leggings
    public static function isLeggings(Item $item): bool {
        return $item instanceof Armor && $item->getArmorSlot() === ArmorInventory::SLOT_LEGS;
    }

    # If is Boots
    public static function isBoots(Item $item): bool {
        return $item instanceof Armor && $item->getArmorSlot() === ArmorInventory::SLOT_FEET;
    }

    # If Item Matches
    public static function itemMatchesItemType(Item $item, int $enchantType): bool {
        if ($item->getTypeId() == VanillaItems::BOOK()->getTypeId() || $item->getTypeId() == VanillaItems::ENCHANTED_BOOK()->getTypeId()) return true;

        return match ($enchantType) {
            CustomEnchant::ITEM_TYPE_GLOBAL => true,
            CustomEnchant::ITEM_TYPE_DAMAGEABLE => $item instanceof Durable,
            CustomEnchant::ITEM_TYPE_WEAPON => ($item instanceof Sword || $item instanceof Axe || $item instanceof Hoe),
            CustomEnchant::ITEM_TYPE_SWORD => $item instanceof Sword,
            CustomEnchant::ITEM_TYPE_AXE => $item instanceof Axe,
            CustomEnchant::ITEM_TYPE_SCYTHE => $item instanceof Hoe,
            CustomEnchant::ITEM_TYPE_TOOLS => $item instanceof Tool,
            CustomEnchant::ITEM_TYPE_ARMOR => $item instanceof Armor,
            CustomEnchant::ITEM_TYPE_HELMET => self::isHelmet($item),
            CustomEnchant::ITEM_TYPE_CHESTPLATE => self::isChestplate($item),
            CustomEnchant::ITEM_TYPE_LEGGINGS => self::isLeggings($item),
            CustomEnchant::ITEM_TYPE_BOOTS => self::isBoots($item),
            default => false
        };
    }

    # Check Incompatibilities
    public static function checkEnchantIncompatibilities(Item $item, CustomEnchant $enchant): bool {
        foreach ($item->getEnchantments() as $enchantment) {
            $otherEnchant = $enchantment->getType();
            if (!$otherEnchant instanceof CustomEnchant) continue;

            if (
                isset(self::INCOMPATIBLE_ENCHANTS[$otherEnchant->getTypeId()]) &&
                in_array($enchant->getTypeId(), self::INCOMPATIBLE_ENCHANTS[$otherEnchant->getTypeId()], true)
            ) return false;

            if (
                isset(self::INCOMPATIBLE_ENCHANTS[$enchant->getTypeId()]) &&
                in_array($otherEnchant->getTypeId(), self::INCOMPATIBLE_ENCHANTS[$enchant->getTypeId()], true)
            ) return false;
        }

        return true;
    }

    # Display Enchants
    public static function displayEnchants(ItemStack $itemStack): ItemStack {
        $plugin = CustomEnchantManager::getPlugin();
        $item = TypeConverter::getInstance()->netItemStackToCore($itemStack);
        if (count($item->getEnchantments()) > 0) {
            $additionalInformation = $plugin->getConfig()->getNested("enchants.position") === "name" ? TextFormat::RESET . TextFormat::WHITE . $item->getName() : "";
            foreach ($item->getEnchantments() as $enchantmentInstance) {
                $enchantment = $enchantmentInstance->getType();
                if ($enchantment instanceof CustomEnchant) {
                    $additionalInformation .= "\n" . TextFormat::RESET . Utils::getColorFromRarity($enchantment->getRarity()) . $enchantment->getDisplayName() . " " . ($plugin->getConfig()->getNested("enchants.roman-numerals", true) === true ? Utils::getRomanNumeral($enchantmentInstance->getLevel()) : $enchantmentInstance->getLevel());
                }
            }
            if ($item->getNamedTag()->getTag(Item::TAG_DISPLAY)) $item->getNamedTag()->setTag("OriginalDisplayTag", $item->getNamedTag()->getTag(Item::TAG_DISPLAY)->safeClone());
            if (CustomEnchantManager::getPlugin()->getConfig()->getNested("enchants.position", "name") === "lore") {
                $lore = array_merge(explode("\n", $additionalInformation), $item->getLore());
                array_shift($lore);
                $item = $item->setLore($lore);
            } else {
                $item = $item->setCustomName($additionalInformation);
            }
        }
        return TypeConverter::getInstance()->coreItemStackToNet($item);
    }

    # Filter Displayed Enchants
    public static function filterDisplayedEnchants(ItemStack $itemStack): ItemStack {
        $item = TypeConverter::getInstance()->netItemStackToCore($itemStack);
        $tag = $item->getNamedTag();
        if (count($item->getEnchantments()) > 0) $tag->removeTag(Item::TAG_DISPLAY);
        if ($tag->getTag("OriginalDisplayTag") instanceof CompoundTag) {
            $tag->setTag(Item::TAG_DISPLAY, $tag->getTag("OriginalDisplayTag"));
            $tag->removeTag("OriginalDisplayTag");
        }
        $item->setNamedTag($tag);
        return TypeConverter::getInstance()->coreItemStackToNet($item);
    }

    # Sort Enchants
    public static function sortEnchantmentsByPriority(array $enchantments): array {
        usort($enchantments, function (EnchantmentInstance $enchantmentInstance, EnchantmentInstance $enchantmentInstanceB) {
            $type = $enchantmentInstance->getType();
            $typeB = $enchantmentInstanceB->getType();
            return ($typeB instanceof CustomEnchant ? $typeB->getPriority() : 1) - ($type instanceof CustomEnchant ? $type->getPriority() : 1);
        });
        return $enchantments;
    }

    # Get Rarity Colour
    public static function getColorFromRarity(int $rarity): string {
        return self::getTFConstFromString(CustomEnchantManager::getPlugin()->getConfig()->get("rarity-colors")[strtolower(self::RARITY_NAMES[$rarity])]);
    }

    # Colour Conversions
    public static function getTFConstFromString(string $color): string {
        $colorConversionTable = [
            "BLACK" => TextFormat::BLACK . TextFormat::BOLD,
            "DARK_BLUE" => TextFormat::DARK_BLUE . TextFormat::BOLD,
            "DARK_GREEN" => TextFormat::DARK_GREEN . TextFormat::BOLD,
            "DARK_AQUA" => TextFormat::DARK_AQUA . TextFormat::BOLD,
            "DARK_RED" => TextFormat::DARK_RED . TextFormat::BOLD,
            "DARK_PURPLE" => TextFormat::DARK_PURPLE . TextFormat::BOLD,
            "GOLD" => TextFormat::GOLD . TextFormat::BOLD,
            "GRAY" => TextFormat::GRAY . TextFormat::BOLD,
            "DARK_GRAY" => TextFormat::DARK_GRAY . TextFormat::BOLD,
            "BLUE" => TextFormat::BLUE . TextFormat::BOLD,
            "GREEN" => TextFormat::GREEN . TextFormat::BOLD,
            "AQUA" => TextFormat::AQUA . TextFormat::BOLD,
            "RED" => TextFormat::RED . TextFormat::BOLD,
            "LIGHT_PURPLE" => TextFormat::LIGHT_PURPLE . TextFormat::BOLD,
            "YELLOW" => TextFormat::YELLOW . TextFormat::BOLD,
            "WHITE" => TextFormat::WHITE . TextFormat::BOLD
        ];
        return $colorConversionTable[strtoupper($color)] ?? TextFormat::GRAY;
    }

    # Take Fall Damage
    public static function shouldTakeFallDamage(Player $player): bool {
        return !isset(self::$shouldTakeFallDamage[$player->getName()]);
    }

    # Set Choice of Fall Damage 
    public static function setShouldTakeFallDamage(Player $player, bool $shouldTakeFallDamage, int $duration = 1): void {
        unset(self::$shouldTakeFallDamage[$player->getName()]);
        if (!$shouldTakeFallDamage) self::$shouldTakeFallDamage[$player->getName()] = time() + $duration;
    }

    # Get no Fall Damage Duration
    public static function getNoFallDamageDuration(Player $player): int {
        return (self::$shouldTakeFallDamage[$player->getName()] ?? time()) - time();
    }

    # Increase no Fall Damage Duration
    public static function increaseNoFallDamageDuration(Player $player, int $duration = 1): void {
        self::$shouldTakeFallDamage[$player->getName()] += $duration;
    }
}