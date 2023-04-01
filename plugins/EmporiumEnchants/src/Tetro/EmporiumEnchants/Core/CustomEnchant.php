<?php

# Namespace
namespace Tetro\EmporiumEnchants\Core;

# Pocketmine Packages
use JsonException;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\enchantment\ItemFlags;
use pocketmine\player\Player;

# Used Files
use Tetro\EmporiumEnchants\EmporiumEnchants;
use Tetro\EmporiumEnchants\Utils\Utils;

# Custom Enchant
class CustomEnchant extends Enchantment {

    # Setup Variables
    public string $name = "";
    public int $rarity = CustomEnchant::RARITY_ELITE;
    public int $maxLevel = 5;
    private string $displayName;
    public string $description;
    public array $extraData;
    public int $cooldownDuration;
    public int $chance;
    public array $cooldown;

    # Compatibility Variables
    public int $usageType = CustomEnchant::TYPE_HAND;
    public int $itemType = CustomEnchant::ITEM_TYPE_WEAPON;

    # Rarities
    public const RARITY_ELITE = 800;
    public const RARITY_ULTIMATE = 801;
    public const RARITY_LEGENDARY = 802;
    public const RARITY_GODLY = 803;
    public const RARITY_HEROIC = 804;
    public const RARITY_EXECUTIVE = 805;

    # Type Conversion
    const TYPE_HAND = 0;
    const TYPE_ANY_INVENTORY = 1;
    const TYPE_INVENTORY = 2;
    const TYPE_ARMOR_INVENTORY = 3;
    const TYPE_HELMET = 4;
    const TYPE_CHESTPLATE = 5;
    const TYPE_LEGGINGS = 6;
    const TYPE_BOOTS = 7;

    # Item Conversion
    const ITEM_TYPE_GLOBAL = 0;
    const ITEM_TYPE_DAMAGEABLE = 1;
    const ITEM_TYPE_WEAPON = 2;
    const ITEM_TYPE_SWORD = 3;
    const ITEM_TYPE_AXE = 4;
    const ITEM_TYPE_SCYTHE = 5;
    const ITEM_TYPE_TOOLS = 6;
    const ITEM_TYPE_ARMOR = 7;
    const ITEM_TYPE_HELMET = 8;
    const ITEM_TYPE_CHESTPLATE = 9;
    const ITEM_TYPE_LEGGINGS = 10;
    const ITEM_TYPE_BOOTS = 11;

    # Constructor

    /**
     * @throws JsonException
     */
    public function __construct(protected EmporiumEnchants $plugin, public int $id) {
        $this->rarity = array_flip(Utils::RARITY_NAMES)[ucfirst(strtolower($plugin->getEnchantmentData($this->name, "rarities", Utils::RARITY_NAMES[$this->rarity])))];
        $this->maxLevel = (int)$plugin->getEnchantmentData($this->name, "max_levels", $this->maxLevel);
        $this->displayName = (string)$plugin->getEnchantmentData($this->name, "display_names", $this->displayName ?? $this->name);
        $this->description = (string)$plugin->getEnchantmentData($this->name, "descriptions", $this->description ?? "");
        $this->extraData = $plugin->getEnchantmentData($this->name, "extra_data", $this->getDefaultExtraData());
        $this->cooldownDuration = (int)$plugin->getEnchantmentData($this->name, "cooldowns", $this->cooldownDuration ?? 0);
        $this->chance = (int)$plugin->getEnchantmentData($this->name, "chances", $this->chance ?? 100);
        foreach ($this->getDefaultExtraData() as $key => $value) {
            if (!isset($this->extraData[$key])) {
                $this->extraData[$key] = $value;
                $plugin->setEnchantmentData($this->name, "extra_data", $this->extraData);
            }
        }
        parent::__construct($this->name, $this->rarity, ItemFlags::ALL, ItemFlags::ALL, $this->maxLevel);
    }

    # Get ID
    public function getId(): int {
        return $this->id;
    }

    # Get Display Name
    public function getDisplayName(): string {
        return $this->displayName;
    }

    # Get Description
    public function getDescription(): string {
        return $this->description;
    }

    # Get Extra Data
    public function getExtraData(): array {
        return $this->extraData;
    }

    # Get Default Extra Data
    public function getDefaultExtraData(): array {
        return [];
    }

    # Get Usage Type
    public function getUsageType(): int {
        return $this->usageType;
    }

    # Get Item Type
    public function getItemType(): int {
        return $this->itemType;
    }

    # Get Priority
    public function getPriority(): int {
        return 1;
    }

    # Can React
    public function canReact(): bool {
        return false;
    }

    # Can Tick
    public function canTick(): bool {
        return false;
    }

    # Can Toggle
    public function canToggle(): bool {
        return false;
    }

    # Get Cooldown
    public function getCooldown(Player $player): int {
        return ($this->cooldown[$player->getName()] ?? time()) - time();
    }

    # Set Cooldown
    public function setCooldown(Player $player, int $cooldown): void {
        $this->cooldown[$player->getName()] = time() + $cooldown;
    }
}