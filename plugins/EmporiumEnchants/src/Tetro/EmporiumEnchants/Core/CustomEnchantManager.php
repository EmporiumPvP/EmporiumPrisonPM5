<?php

namespace Tetro\EmporiumEnchants\Core;

use JsonException;
use pocketmine\item\enchantment\StringToEnchantmentParser;
use pocketmine\data\bedrock\EnchantmentIdMap;
use pocketmine\Utils\StringToTParser;
use ReflectionProperty;

use Tetro\EmporiumEnchants\Enchants\Tools\Alchemy;
use Tetro\EmporiumEnchants\Enchants\Tools\EnergyCollectorCE;
use Tetro\EmporiumEnchants\Enchants\Tools\JackpotCE;
use Tetro\EmporiumEnchants\Enchants\Tools\LuckCE;
use Tetro\EmporiumEnchants\Enchants\Tools\MeteorHunterCE;
use Tetro\EmporiumEnchants\Enchants\Tools\MeteorSummonerCE;
use Tetro\EmporiumEnchants\Enchants\Tools\MinersSightCE;
use Tetro\EmporiumEnchants\Enchants\Tools\OreMagnetCE;
use Tetro\EmporiumEnchants\Enchants\Tools\OreSurgeCE;
use Tetro\EmporiumEnchants\Enchants\Tools\ShardDiscovererCE;
use Tetro\EmporiumEnchants\Enchants\Tools\ShatterCE;
use Tetro\EmporiumEnchants\Enchants\Tools\SuperBreakerCE;
use Tetro\EmporiumEnchants\Enchants\Tools\TransfuseCE;
use Tetro\EmporiumEnchants\Loader;
// Armour
use Tetro\EmporiumEnchants\Enchants\Armour\Boots\{GearsCE, SpringsCE};
use Tetro\EmporiumEnchants\Enchants\Armour\Chestplate\{BandAidCE};
use Tetro\EmporiumEnchants\Enchants\Armour\Global\{AngelicCE, ArmoredCE, CurseCE, BerserkerCE, DeathbringerCE, DiminishCE, ShockwaveCE, DeflectCE, DivineArmoredCE, DivineEnlightenedCE, DrunkCE, EndershiftCE, EnderwalkerCE, EnlightedCE, EnlightenedCE, EtherealDodgeCE, FrozenCE, GodlyOverloadCE, HeatWaveCE, HeavyCE, MoltenCE, NourishCE, NurtureCE, ObscureCE, ObsidianShieldCE, OverloadCE, PainkillerCE, ReviveCE, TankCE, TitanTrapCE, ValorCE, VoodooCE, MetaphysicalCE};
use Tetro\EmporiumEnchants\Enchants\Armour\Helmet\{AntitoxinCE, ClarityCE, FocusedCE, GlowingCE, ImplantsCE, DarknessCE};
// Weapons
use Tetro\EmporiumEnchants\Enchants\Weapons\Axe\{InsanityCE, OvergrowthCE};
use Tetro\EmporiumEnchants\Enchants\Weapons\Global\{AccuracyCE,
    AerialCE,
    BloodCurdleCE,
    SilenceCE,
    BackstabCE,
    BlessedCE,
    BlindCE,
    BlockCE,
    ChargeCE,
    CrippleCE,
    DecapitationCE,
    DemiseCE,
    DemonForgedCE,
    DemonicLifestealCE,
    DisarmorCE,
    DisintegrateCE,
    DominateCE,
    DoubleStrikeCE,
    ExecuteCE,
    ExperienceHunterCE,
    FreezeCE,
    FrenzyCE,
    GravityCE,
    HallucinationCE,
    HuntsmanCE,
    IceAspectCE,
    IncendiaryCE,
    InfluxCE,
    InversionCE,
    LifestealCE,
    ManiacCE,
    PoisonCE,
    SoulStealCE,
    UltraRageCE,
    WitherCE,
    RageCE,
    SergeonCE};
use Tetro\EmporiumEnchants\Enchants\Weapons\Sword\{AssassinCE};
// Other
use Tetro\EmporiumEnchants\Enchants\Global\{AutoRepairCE};

class CustomEnchantManager {

    private static Loader $plugin;
    public static array $enchants = [];

    /**
     * @throws JsonException
     */
    public static function init(Loader $plugin): void {
        self::$plugin = $plugin;

        # Register Enchants
        /////////////////////////////// ARMOUR ///////////////////////////////
        // Boots
        self::registerEnchantment(new GearsCE($plugin, CustomEnchantIds::GEARS));
        self::registerEnchantment(new SpringsCE($plugin, CustomEnchantIds::SPRINGS));
        self::registerEnchantment(new GlowingCE($plugin, CustomEnchantIds::GLOWING));
        self::registerEnchantment(new ClarityCE($plugin, CustomEnchantIds::CLARITY));
        self::registerEnchantment(new FocusedCE($plugin, CustomEnchantIds::FOCUSED));
        self::registerEnchantment(new DarknessCE($plugin, CustomEnchantIds::DARKNESS));
        // Armour ces
        self::registerEnchantment(new AngelicCE($plugin, CustomEnchantIds::ANGELIC));
        self::registerEnchantment(new AntitoxinCE($plugin, CustomEnchantIds::ANTITOXIN));
        self::registerEnchantment(new ArmoredCE($plugin, CustomEnchantIds::ARMORED));
        self::registerEnchantment(new BandAidCE($plugin, CustomEnchantIds::BANDAID));
        self::registerEnchantment(new BerserkerCE($plugin, CustomEnchantIds::BERSERKER));
        self::registerEnchantment(new CurseCE($plugin, CustomEnchantIds::CURSE));
        self::registerEnchantment(new DeathbringerCE($plugin, CustomEnchantIds::DEATHBRINGER));
        self::registerEnchantment(new DeflectCE($plugin, CustomEnchantIds::DEFLECT));
        self::registerEnchantment(new DiminishCE($plugin, CustomEnchantIds::DIMINISH));
        self::registerEnchantment(new DivineArmoredCE($plugin, CustomEnchantIds::DIVINEARMORED));
        self::registerEnchantment(new DivineEnlightenedCE($plugin, CustomEnchantIds::DIVINEENIGHTENED));
        self::registerEnchantment(new DrunkCE($plugin, CustomEnchantIds::DRUNK));
        self::registerEnchantment(new EndershiftCE($plugin, CustomEnchantIds::ENDERSHIFT));
        self::registerEnchantment(new EnderwalkerCE($plugin, CustomEnchantIds::ENDERWALKER));
        self::registerEnchantment(new EnlightedCE($plugin, CustomEnchantIds::ENLIGHTED));
        self::registerEnchantment(new EnlightenedCE($plugin, CustomEnchantIds::ENLIGHTENED));
        self::registerEnchantment(new EtherealDodgeCE($plugin, CustomEnchantIds::ETHEREALDODGE));
        self::registerEnchantment(new FrozenCE($plugin, CustomEnchantIds::FROZEN));
        self::registerEnchantment(new GodlyOverloadCE($plugin, CustomEnchantIds::GODLYOVERLOAD));
        self::registerEnchantment(new HeatWaveCE($plugin, CustomEnchantIds::HEATWAVE));
        self::registerEnchantment(new HeavyCE($plugin, CustomEnchantIds::HEAVY));
        self::registerEnchantment(new ImplantsCE($plugin, CustomEnchantIds::IMPLANTS));
        self::registerEnchantment(new MetaphysicalCE($plugin, CustomEnchantIds::METAPHYSICAL));
        self::registerEnchantment(new MoltenCE($plugin, CustomEnchantIds::MOLTEN));
        self::registerEnchantment(new NourishCE($plugin, CustomEnchantIds::NOURISH));
        self::registerEnchantment(new NurtureCE($plugin, CustomEnchantIds::NURTURE));
        self::registerEnchantment(new ObscureCE($plugin, CustomEnchantIds::OBSCURE));
        self::registerEnchantment(new ObsidianShieldCE($plugin, CustomEnchantIds::OBSIDIANSHIELD));
        self::registerEnchantment(new OverloadCE($plugin, CustomEnchantIds::OVERLOAD));
        self::registerEnchantment(new PainkillerCE($plugin, CustomEnchantIds::PAINKILLER));
        self::registerEnchantment(new ReviveCE($plugin, CustomEnchantIds::REVIVE));
        self::registerEnchantment(new ShockwaveCE($plugin, CustomEnchantIds::SHOCKWAVE));
        self::registerEnchantment(new TankCE($plugin, CustomEnchantIds::TANK));
        self::registerEnchantment(new TitanTrapCE($plugin, CustomEnchantIds::TITANTRAP));
        self::registerEnchantment(new ValorCE($plugin, CustomEnchantIds::VALOR));
        self::registerEnchantment(new VoodooCE($plugin, CustomEnchantIds::VOODOO));
        // Weapon Ces
        self::registerEnchantment(new AccuracyCE($plugin, CustomEnchantIds::ACCURACY));
        self::registerEnchantment(new AerialCE($plugin, CustomEnchantIds::AERIAL));
        self::registerEnchantment(new AssassinCE($plugin, CustomEnchantIds::ASSASSIN));
        self::registerEnchantment(new BackstabCE($plugin, CustomEnchantIds::BACKSTAB));
        self::registerEnchantment(new BlessedCE($plugin, CustomEnchantIds::BLESSED));
        self::registerEnchantment(new BlindCE($plugin, CustomEnchantIds::BLIND));
        self::registerEnchantment(new BlockCE($plugin, CustomEnchantIds::BLOCK));
        self::registerEnchantment(new ChargeCE($plugin, CustomEnchantIds::CHARGE));
        self::registerEnchantment(new CrippleCE($plugin, CustomEnchantIds::CRIPPLE));
        self::registerEnchantment(new DecapitationCE($plugin, CustomEnchantIds::DECAPITATION));
        self::registerEnchantment(new DemiseCE($plugin, CustomEnchantIds::DEMISE));
        self::registerEnchantment(new DemonForgedCE($plugin, CustomEnchantIds::DEMONFORGED));
        self::registerEnchantment(new DemonicLifestealCE($plugin, CustomEnchantIds::DEMONICLIFESTEAL));
        self::registerEnchantment(new DisarmorCE($plugin, CustomEnchantIds::DISARMOR));
        self::registerEnchantment(new DisintegrateCE($plugin, CustomEnchantIds::DISINTEGRATE));
        self::registerEnchantment(new DominateCE($plugin, CustomEnchantIds::DOMINATE));
        self::registerEnchantment(new DoubleStrikeCE($plugin, CustomEnchantIds::DOUBLESTRIKE));
        self::registerEnchantment(new ExecuteCE($plugin, CustomEnchantIds::EXECUTE));
        self::registerEnchantment(new ExperienceHunterCE($plugin, CustomEnchantIds::EXPERIENCEHUNTER));
        self::registerEnchantment(new FreezeCE($plugin, CustomEnchantIds::FREEZE));
        self::registerEnchantment(new FrenzyCE($plugin, CustomEnchantIds::FRENZY));
        self::registerEnchantment(new GravityCE($plugin, CustomEnchantIds::GRAVITY));
        self::registerEnchantment(new HallucinationCE($plugin, CustomEnchantIds::HALLUCINATION));
        self::registerEnchantment(new HuntsmanCE($plugin, CustomEnchantIds::HUNTSMAN));
        self::registerEnchantment(new IceAspectCE($plugin, CustomEnchantIds::ICEASPECT));
        self::registerEnchantment(new IncendiaryCE($plugin, CustomEnchantIds::INCENDIARY));
        self::registerEnchantment(new InfluxCE($plugin, CustomEnchantIds::INFLUX));
        self::registerEnchantment(new InsanityCE($plugin, CustomEnchantIds::INSANITY));
        self::registerEnchantment(new InversionCE($plugin, CustomEnchantIds::INVERSION));
        self::registerEnchantment(new LifestealCE($plugin, CustomEnchantIds::LIFESTEAL));
        self::registerEnchantment(new ManiacCE($plugin, CustomEnchantIds::MANIAC));
        self::registerEnchantment(new PoisonCE($plugin, CustomEnchantIds::POISON));
        self::registerEnchantment(new RageCE($plugin, CustomEnchantIds::RAGE));
        self::registerEnchantment(new SilenceCE($plugin, CustomEnchantIds::SILENCE));
        self::registerEnchantment(new SoulStealCE($plugin, CustomEnchantIds::SOULSTEAL));
        self::registerEnchantment(new UltraRageCE($plugin, CustomEnchantIds::ULTRARAGE));
        self::registerEnchantment(new WitherCE($plugin, CustomEnchantIds::WITHER));
        self::registerEnchantment(new SergeonCE($plugin, CustomEnchantIds::SERGEON));
        self::registerEnchantment(new OvergrowthCE($plugin, CustomEnchantIds::OVERGROWTH));
        self::registerEnchantment(new BloodCurdleCE($plugin, CustomEnchantIds::BLOOD));
        # pickaxe
        self::registerEnchantment(new Alchemy($plugin, CustomEnchantIds::ALCHEMY));
        self::registerEnchantment(new EnergyCollectorCE($plugin, CustomEnchantIds::ENERGY_COLLECTOR));
        self::registerEnchantment(new JackpotCE($plugin, CustomEnchantIds::JACKPOT));
        self::registerEnchantment(new LuckCE($plugin, CustomEnchantIds::LUCK));
        self::registerEnchantment(new MeteorHunterCE($plugin, CustomEnchantIds::METEOR_HUNTER));
        self::registerEnchantment(new MeteorSummonerCE($plugin, CustomEnchantIds::METEOR_SUMMONER));
        self::registerEnchantment(new MinersSightCE($plugin, CustomEnchantIds::MINERS_SIGHT));
        self::registerEnchantment(new OreMagnetCE($plugin, CustomEnchantIds::ORE_MAGNET));
        self::registerEnchantment(new OreSurgeCE($plugin, CustomEnchantIds::ORE_SURGE));
        self::registerEnchantment(new ShardDiscovererCE($plugin, CustomEnchantIds::SHARD_DISCOVERER));
        self::registerEnchantment(new ShatterCE($plugin, CustomEnchantIds::SHATTER));
        self::registerEnchantment(new SuperBreakerCE($plugin, CustomEnchantIds::SUPER_BREAKER));
        self::registerEnchantment(new TransfuseCE($plugin, CustomEnchantIds::TRANSFUSE));
        // Pickaxe ces
        // Global
        self::registerEnchantment(new AutoRepairCE($plugin, CustomEnchantIds::AUTOREPAIR));
        
    }

    # Get Plugin
    public static function getPlugin(): Loader {
        return self::$plugin;
    }

    # Register Enchant
    public static function registerEnchantment(CustomEnchant $enchant): void {
        EnchantmentIdMap::getInstance()->register($enchant->getId(), $enchant);
        self::$enchants[$enchant->getId()] = $enchant;
        StringToEnchantmentParser::getInstance()->register($enchant->name, fn() => $enchant);
        if ($enchant->name !== $enchant->getDisplayName()) StringToEnchantmentParser::getInstance()->register($enchant->getDisplayName(), fn() => $enchant);
        self::$plugin->getLogger()->debug("Custom Enchantment '" . $enchant->getDisplayName() . "' registered with id " . $enchant->getId());
    }

    # Unregister Enchant
    public static function unregisterEnchantment(int|CustomEnchant $id): void {
        $id = $id instanceof CustomEnchant ? $id->getId() : $id;
        $enchant = self::$enchants[$id];

        $property = new ReflectionProperty(StringToTParser::class, "callbackMap");
        $property->setAccessible(true);
        $value = $property->getValue(StringToEnchantmentParser::getInstance());
        unset($value[strtolower(str_replace([" ", "minecraft:"], ["_", ""], trim($enchant->name)))]);
        if ($enchant->name !== $enchant->getDisplayName()) unset($value[strtolower(str_replace([" ", "minecraft:"], ["_", ""], trim($enchant->getDisplayName())))]);
        $property->setValue(StringToEnchantmentParser::getInstance(), $value);

        self::$plugin->getLogger()->debug("Custom Enchantment '" . $enchant->getDisplayName() . "' unregistered with id " . $enchant->getId());
        unset(self::$enchants[$id]);

        $property = new ReflectionProperty(EnchantmentIdMap::class, "enchToId");
        $property->setAccessible(true);
        $value = $property->getValue(EnchantmentIdMap::getInstance());
        unset($value[spl_object_id(EnchantmentIdMap::getInstance()->fromId($id))]);
        $property->setValue(EnchantmentIdMap::getInstance(), $value);

        $property = new ReflectionProperty(EnchantmentIdMap::class, "idToEnch");
        $property->setAccessible(true);
        $value = $property->getValue(EnchantmentIdMap::getInstance());
        unset($value[$id]);
        $property->setValue(EnchantmentIdMap::getInstance(), $value);
    }

    # Get Enchantments
    public static function getEnchantments(): array {
        return self::$enchants;
    }

    # Get Enchantment
    public static function getEnchantment(int $id): ?CustomEnchant {
        return self::$enchants[$id] ?? null;
    }

    # Get Enchantment by Name
    public static function getEnchantmentByName(string $name): ?CustomEnchant {
        return ($enchant = StringToEnchantmentParser::getInstance()->parse($name)) instanceof CustomEnchant ? $enchant : null;
    }
}
