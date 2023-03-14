<?php

namespace Emporium\Prison;
# commands
use Emporium\Prison\commands\Default\BankCommand;
use Emporium\Prison\commands\Default\ExtractCommand;
use Emporium\Prison\commands\Default\MinesCommand;
use Emporium\Prison\commands\Default\PickaxePrestigeCommand;
use Emporium\Prison\commands\Default\PlayerLevelCommand;
use Emporium\Prison\commands\Default\PlayerPrestigeCommand;
use Emporium\Prison\commands\Default\SpawnCommand;
use Emporium\Prison\commands\Staff\BoosterCommand;
use Emporium\Prison\commands\Staff\EnergyCommand;
use Emporium\Prison\commands\Staff\FlaresCommand;
use Emporium\Prison\commands\Staff\NPCCommand;
# listeners
use Emporium\Prison\items\Boosters;
use Emporium\Prison\items\Flares;
use Emporium\Prison\items\Orbs;
use Emporium\Prison\items\Pickaxes;
use Emporium\Prison\items\Scrolls;
use Emporium\Prison\listeners\blocks\MeteorListener;
use Emporium\Prison\listeners\Items\EnergyListener;
use Emporium\Prison\listeners\Items\Flares\FlareListener;
use Emporium\Prison\listeners\Items\BoosterListener;
use Emporium\Prison\listeners\Items\WhiteScrollListener;
use Emporium\Prison\listeners\LeaderboardsListener;
use Emporium\Prison\listeners\mines\CoalMineListener;
use Emporium\Prison\listeners\mines\DiamondMineListener;
use Emporium\Prison\listeners\mines\EmeraldMineListener;
use Emporium\Prison\listeners\mines\GoldMineListener;
use Emporium\Prison\listeners\mines\IronMineListener;
use Emporium\Prison\listeners\mines\LapisMineListener;
use Emporium\Prison\listeners\mines\RedstoneMineListener;
use Emporium\Prison\listeners\npcs\NPCListener;
use Emporium\Prison\listeners\player\PlayerListener;
use Emporium\Prison\listeners\worlds\WorldListener;
# managers
use Emporium\Prison\Managers\EnergyManager;
use Emporium\Prison\Managers\LeaderboardManager;
use Emporium\Prison\Managers\MiningManager;
use Emporium\Prison\Managers\PickaxeManager;
use Emporium\Prison\Managers\PlayerLevelManager;
use Emporium\Prison\Managers\misc\GlowManager;
# menus
use Emporium\Prison\Menus\Help;
# tasks
use Emporium\Prison\tasks\BoosterTask;
use Emporium\Prison\tasks\Events\PrisonBreakBar;
use Emporium\Prison\tasks\LeaderboardUpdateTask;
use Emporium\Prison\tasks\NPCUpdateTask;
use Emporium\Prison\tasks\ScoreboardTask;
# libraries
use Items\Contraband;
use muqsit\invmenu\InvMenuHandler;
use muqsit\invmenu\type\util\InvMenuTypeBuilders;
# pocketmine
use pocketmine\block\BlockFactory;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\network\mcpe\protocol\types\DeviceOS;
use pocketmine\network\mcpe\protocol\types\inventory\WindowTypes;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat as TF;
use pocketmine\world\sound\BarrelOpenSound;
use pocketmine\world\sound\ChestOpenSound;

class EmporiumPrison extends PluginBase {

    const TYPE_DISPENSER = "dispenser menu";

    private static EnergyManager $energyManager;
    private static PickaxeManager $pickaxeManager;
    private static MiningManager $miningManager;
    private static PlayerLevelManager $playerLevelManager;

    private static EmporiumPrison $instance;
    private static Boosters $boosters;
    private static Orbs $orbs;
    private static Flares $flares;
    private static Pickaxes $pickaxes;
    private static Scrolls $scrolls;

    private array $defaultPrisonSettingsData = [
        "plugin-version" => "EmporiumPrisonPre-alpha1.0.0",
    ];
    private array $playerLevelXp = [
        1 => 30,
        2 => 30 * 2,
        3 => 30 * 3,
        4 => 30 * 4,
        5 => 30 * 5,
        6 => 30 * 6,
        7 => 30 * 7,
        8 => 30 * 8,
        9 => 30 * 9,
        10 => 60 * 10, # 1950 total xp
        11 => 60 * 11,
        12 => 60 * 12,
        13 => 60 * 13,
        14 => 60 * 14,
        15 => 60 * 15,
        16 => 60 * 16,
        17 => 60 * 17,
        18 => 60 * 18,
        19 => 60 * 19,
        20 => 120 * 20, # total 12450
        21 => 120 * 21,
        22 => 120 * 22,
        23 => 120 * 23,
        24 => 120 * 24,
        25 => 120 * 25,
        26 => 120 * 26,
        27 => 120 * 27,
        28 => 120 * 28,
        29 => 120 * 29,
        30 => 240 * 30, # total 49770
        31 => 240 * 31,
        32 => 240 * 32,
        33 => 240 * 33,
        34 => 240 * 34,
        35 => 240 * 35,
        36 => 240 * 36,
        37 => 240 * 37,
        38 => 240 * 38,
        39 => 240 * 39,
        40 => 480 * 40, # total 144,570
        41 => 480 * 41,
        42 => 480 * 42,
        43 => 480 * 43,
        44 => 480 * 44,
        45 => 480 * 45,
        46 => 480 * 46,
        47 => 480 * 47,
        48 => 480 * 48,
        49 => 480 * 49,
        50 => 960 * 50, # total 366,810
        51 => 960 * 51,
        52 => 960 * 52,
        53 => 960 * 53,
        54 => 960 * 54,
        55 => 960 * 55,
        56 => 960 * 56,
        57 => 960 * 57,
        58 => 960 * 58,
        59 => 960 * 59,
        60 => 1920 * 60, # total 957,210
        61 => 1920 * 61,
        62 => 1920 * 62,
        63 => 1920 * 63,
        64 => 1920 * 64,
        65 => 1920 * 65,
        66 => 1920 * 66,
        67 => 1920 * 67,
        68 => 1920 * 68,
        69 => 1920 * 69,
        70 => 3840 * 70, # total 2,349,210
        71 => 3840 * 71,
        72 => 3840 * 72,
        73 => 3840 * 73,
        74 => 3840 * 74,
        75 => 3840 * 75,
        76 => 3840 * 76,
        77 => 3840 * 77,
        78 => 3840 * 78,
        79 => 3840 * 79,
        80 => 7680 * 80, # total 5,555,610
        81 => 7680 * 81,
        82 => 7680 * 82,
        83 => 7680 * 83,
        84 => 7680 * 84,
        85 => 7680 * 85,
        86 => 7680 * 86,
        87 => 7680 * 87,
        88 => 7680 * 88,
        89 => 7680 * 89,
        90 => 15360 * 90, # total 12,813,210
        91 => 15360 * 91,
        92 => 15360 * 92,
        93 => 15360 * 93,
        94 => 15360 * 94,
        95 => 15360 * 95,
        96 => 15360 * 96,
        97 => 15360 * 97,
        98 => 15360 * 98,
        99 => 15360 * 99,
        100 => 30720 * 100 # total 29,018,010

    ];
    private array $pickaxeEnergyLevels = [
        1 => 4800,
        2 => 4800 * 3,
        3 => 4800 * 5,
        4 => 4800 * 7,
        5 => 4800 * 9,
        6 => 4800 * 11,
        7 => 4800 * 13,
        8 => 4800 * 15,
        9 => 4800 * 17,
        10 => 4800 * 19,
        11 => 4800 * 21,
        12 => 4800 * 23,
        13 => 4800 * 25,
        14 => 4800 * 27,
        15 => 4800 * 29,
        16 => 4800 * 31,
        17 => 4800 * 33,
        18 => 4800 * 35,
        19 => 4800 * 37,
        20 => 4800 * 39,
        21 => 4800 * 41,
        22 => 4800 *43 ,
        23 => 4800 * 45,
        24 => 4800 * 47,
        25 => 4800 * 49,
        26 => 4800 * 51,
        27 => 4800 * 53,
        28 => 4800 * 55,
        29 => 4800 * 57,
        30 => 4800 * 59,
        31 => 4800 * 61,
        32 => 4800 * 63,
        33 => 4800 * 65,
        34 => 4800 * 67,
        35 => 4800 * 69,
        36 => 4800 * 71,
        37 => 4800 * 73,
        38 => 4800 * 75,
        39 => 4800 * 77,
        40 => 4800 * 79,
        41 => 4800 * 81,
        42 => 4800 * 83,
        43 => 4800 * 85,
        44 => 4800 * 87,
        45 => 4800 * 89,
        46 => 4800 * 91,
        47 => 4800 * 93,
        48 => 4800 * 95,
        49 => 4800 * 97,
        50 => 4800 * 99,
        51 => 4800 * 101,
        52 => 4800 * 103,
        53 => 4800 * 105,
        54 => 4800 * 107,
        55 => 4800 * 109,
        56 => 4800 * 111,
        57 => 4800 * 113,
        58 => 4800 * 115,
        59 => 4800 * 117,
        60 => 4800 * 119,
        61 => 4800 * 121,
        62 => 4800 * 123,
        63 => 4800 * 125,
        64 => 4800 * 127,
        65 => 4800 * 129,
        66 => 4800 * 131,
        67 => 4800 * 133,
        68 => 4800 * 135,
        69 => 4800 * 137,
        70 => 4800 * 139,
        71 => 4800 * 141,
        72 => 4800 * 143,
        73 => 4800 * 145,
        74 => 4800 * 147,
        75 => 4800 * 149,
        76 => 4800 * 151,
        77 => 4800 * 153,
        78 => 4800 * 155,
        79 => 4800 * 157,
        80 => 4800 * 159,
        81 => 4800 * 161,
        82 => 4800 * 163 ,
        83 => 4800 * 165,
        84 => 4800 * 167,
        85 => 4800 * 169,
        86 => 4800 * 171,
        87 => 4800 * 173,
        88 => 4800 * 175,
        89 => 4800 * 177,
        90 => 4800 * 179,
        91 => 4800 * 181,
        92 => 4800 * 183,
        93 => 4800 * 185,
        94 => 4800 * 187,
        95 => 4800 * 189,
        96 => 4800 * 191,
        97 => 4800 * 193,
        98 => 4800 * 195,
        99 => 4800 * 197,
        100 => 4800 * 199,
    ];

    public static function getInstance(): EmporiumPrison {
        return self::$instance;
    }

    protected function onLoad(): void {
        # assign managers
        self::$energyManager = new EnergyManager();
        self::$miningManager = new MiningManager();
        self::$pickaxeManager = new PickaxeManager();
        self::$playerLevelManager = new PlayerLevelManager();
        # items
        self::$boosters = new Boosters();
        self::$flares = new Flares();
        self::$orbs = new Orbs();
        self::$pickaxes = new Pickaxes();
        self::$scrolls = new Scrolls();
    }

    public function onEnable(): void {

        # create main instance
        self::$instance = $this;
        # create directories
        @mkdir($this->getDataFolder() . "Prison/");
        @mkdir($this->getDataFolder() . "Boosters/");
        @mkdir($this->getDataFolder() . "Players/");
        @mkdir($this->getDataFolder() . "Meteors/");
        @mkdir($this->getDataFolder() . "Leaderboards/");
        # create files
        if(!file_exists($this->getDataFolder() . "Prison/settings.yml")) {
            new Config($this->getDataFolder() . "Prison/settings.yml", Config::YAML, $this->defaultPrisonSettingsData);
        }
        if(!file_exists($this->getDataFolder() . "Prison/playerLevelXp.yml")) {
            new Config($this->getDataFolder() . "Prison/playerLevelXp.yml", Config::YAML, $this->createPlayerLevelXpData());
        }
        if(!file_exists($this->getDataFolder() . "Prison/pickaxeEnergyLevels.yml")) {
            new Config($this->getDataFolder() . "Prison/pickaxeEnergyLevels.yml", Config::YAML, $this->pickaxeEnergyLevels);
        }
        if(!file_exists($this->getDataFolder() . "Leaderboards/kills.yml")) {
            new Config($this->getDataFolder() . "Leaderboards/kills.yml", Config::YAML);
        }
        if(!file_exists($this->getDataFolder() . "Leaderboards/playerlevel.yml")) {
            new Config($this->getDataFolder() . "Leaderboards/playerlevel.yml", Config::YAML);
        }
        if(!file_exists($this->getDataFolder() . "Leaderboards/blocksMined.yml")) {
            new Config($this->getDataFolder() . "Leaderboards/blocksMined.yml", Config::YAML);
        }
        if(!file_exists($this->getDataFolder() . "Leaderboards/meteorHunter.yml")) {
            new Config($this->getDataFolder() . "Leaderboards/meteorHunter.yml", Config::YAML);
        }
        # unregister help command
        $map = Server::getInstance()->getCommandMap();
        $map->unregister($map->getCommand("help"));
        $command = new Class("Help") extends Command {
            public function execute(CommandSender $sender, string $commandLabel, array $args): bool {

                if(!$sender instanceof Player) {
                    return false;
                }

                $helpMenu = new Help();
                $extraData = $sender->getPlayerInfo()->getExtraData();
                switch($extraData["DeviceOS"]) {

                    case DeviceOS::IOS:
                    case DeviceOS::ANDROID:
                    case DeviceOS::PLAYSTATION:
                    case DeviceOS::XBOX:
                    case DeviceOS::NINTENDO:
                        $sender->broadcastSound(new BarrelOpenSound(), [$sender]);
                        $helpMenu->Form($sender);
                        break;

                    case DeviceOS::WINDOWS_10:
                    case DeviceOS::OSX:
                        $sender->broadcastSound(new ChestOpenSound(), [$sender]);
                        $helpMenu->Inventory($sender);
                        break;
                }
                return true;
            }
        };
        $help = $command;
        $help->setAliases(["help"]);
        $map->register("xd", $help);
        # register listeners
        # world listeners
        $this->getServer()->getPluginManager()->registerEvents(new WorldListener(), $this);
        # mine listeners
        $this->getServer()->getPluginManager()->registerEvents(new CoalMineListener(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new IronMineListener(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new LapisMineListener(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new RedstoneMineListener(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new GoldMineListener(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new DiamondMineListener(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new EmeraldMineListener(), $this);
        # other listeners
        $this->getServer()->getPluginManager()->registerEvents(new LeaderboardsListener(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new PlayerListener(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new MeteorListener(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new NPCListener(), $this);
        # item listeners
        $this->getServer()->getPluginManager()->registerEvents(new BoosterListener(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new EnergyListener(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new FlareListener(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new WhiteScrollListener(), $this);
        # entity listeners
        # invmenu listener
        if(!InvMenuHandler::isRegistered()){
            InvMenuHandler::register($this);
        }
        # dispenser invmenu
        InvMenuHandler::getTypeRegistry()->register(self::TYPE_DISPENSER, InvMenuTypeBuilders::BLOCK_ACTOR_FIXED()
            ->setBlock(BlockFactory::getInstance()->get(23, 0))
            ->setSize(9) // number of slots
            ->setBlockActorId("Dispenser")
            ->setNetworkWindowType(WindowTypes::DISPENSER)
            ->build());
        # Commands
        # default
        $this->getServer()->getCommandMap()->register("bank", new BankCommand());
        $this->getServer()->getCommandMap()->register("extract", new ExtractCommand());
        $this->getServer()->getCommandMap()->register("mines", new MinesCommand());
        $this->getServer()->getCommandMap()->register("pickaxeprestige", new PickaxePrestigeCommand());
        $this->getServer()->getCommandMap()->register("level", new PlayerLevelCommand());
        $this->getServer()->getCommandMap()->register("prestige", new PlayerPrestigeCommand());
        $this->getServer()->getCommandMap()->register("spawn", new SpawnCommand());
        # ranked
        # staff
        $this->getServer()->getCommandMap()->register("booster", new BoosterCommand());
        $this->getServer()->getCommandMap()->register("energy", new EnergyCommand());
        $this->getServer()->getCommandMap()->register("flare", new FlaresCommand());
        $this->getServer()->getCommandMap()->register("npc", new NPCCommand());
        # tasks
        $this->getScheduler()->scheduleRepeatingTask(new ScoreboardTask($this), 20);
        $this->getScheduler()->scheduleRepeatingTask(new BoosterTask($this), 20);
        $this->getScheduler()->scheduleRepeatingTask(new PrisonBreakBar(), 20);
        $this->getScheduler()->scheduleTask(new NPCUpdateTask());
        # world
        $this->getServer()->getWorldManager()->loadWorld("world");
        $world = $this->getServer()->getWorldManager()->getWorldByName("world");
        if($world !== null) {
            $world->setTime(1000);
            $world->stopTime();
        }
        # tutorial mine
        $this->getServer()->getWorldManager()->loadWorld("TutorialMine");
        $world = $this->getServer()->getWorldManager()->getWorldByName("TutorialMine");
        if($world !== null) {
            $world->setTime(1000);
            $world->stopTime();
        }
        # coal badlands
        $this->getServer()->getWorldManager()->loadWorld("CoalBadlands");
        $world = $this->getServer()->getWorldManager()->getWorldByName("CoalBadlands");
        if($world !== null) {
            $world->setTime(1000);
            $world->stopTime();
        }
        # invisible enchant effect
        GlowManager::createEnchant();
        # initialise leaderboards
        LeaderboardManager::registerLeaderboards();
        LeaderboardManager::registerTexts();
        $this->getScheduler()->scheduleRepeatingTask(new LeaderboardUpdateTask(), 6000);
        # plugin loaded message
        $this->getLogger()->info(TF::BOLD . TF::GREEN . Variables::PLUGIN_VERSION . " Enabled!");
    }

    public function createPlayerLevelXpData(): array
    {

        $playerLevelXpData = array();

        for($level = 1; $level < 11; $level++) {
            $playerLevelXpData[$level] = 30 * $level;
        }
        for($level = 11; $level < 21; $level++) {
            $playerLevelXpData[$level] = 60 * $level;
        }
        for($level = 21; $level < 31; $level++) {
            $playerLevelXpData[$level] = 120 * $level;
        }
        for($level = 31; $level < 41; $level++) {
            $playerLevelXpData[$level] = 240 * $level;
        }
        for($level = 41; $level < 51; $level++) {
            $playerLevelXpData[$level] = 480 * $level;
        }
        for($level = 51; $level < 61; $level++) {
            $playerLevelXpData[$level] = 960 * $level;
        }
        for($level = 61; $level < 71; $level++) {
            $playerLevelXpData[$level] = 1920 * $level;
        }
        for($level = 71; $level < 81; $level++) {
            $playerLevelXpData[$level] = 3840 * $level;
        }
        for($level = 81; $level < 91; $level++) {
            $playerLevelXpData[$level] = 7680 * $level;
        }
        for($level = 91; $level < 101; $level++) {
            $playerLevelXpData[$level] = 15360 * $level;
        }
        for($level = 101; $level < 151; $level++) {
            $playerLevelXpData[$level] = 30720 * $level;
        }
        for($level = 151; $level < 201; $level++) {
            $playerLevelXpData[$level] = 61440 * $level;
        }
        for($level = 201; $level < 251; $level++) {
            $playerLevelXpData[$level] = 122880 * $level;
        }
        for($level = 251; $level < 301; $level++) {
            $playerLevelXpData[$level] = 245760 * $level;
        }
        for($level = 301; $level < 351; $level++) {
            $playerLevelXpData[$level] = 491520 * $level;
        }
        for($level = 351; $level < 401; $level++) {
            $playerLevelXpData[$level] = 983040 * $level;
        }

        return $playerLevelXpData;
    }

    # manager getters
    public static function getEnergyManager(): EnergyManager {
        return self::$energyManager;
    }

    public static function getPickaxeManager(): PickaxeManager {
        return self::$pickaxeManager;
    }

    public static function getMiningManager(): MiningManager {
        return self::$miningManager;
    }

    public static function getPlayerLevelManager(): PlayerLevelManager {
        return self::$playerLevelManager;
    }

    public static function getBoosters(): Boosters {
        return self::$boosters;
    }

    public static function getFlares(): Flares {
        return self::$flares;
    }

    public static function getOrbs(): Orbs {
        return self::$orbs;
    }

    public static function getPickaxes(): Pickaxes {
        return self::$pickaxes;
    }

    public static function getScrolls(): Scrolls {
        return self::$scrolls;
    }
}