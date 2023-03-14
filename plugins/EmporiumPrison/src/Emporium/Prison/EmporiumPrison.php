<?php

namespace Emporium\Prison;

# commands
use Emporium\Prison\commands\Default\BankCommand;
use Emporium\Prison\commands\Default\ExtractCommand;
use Emporium\Prison\commands\Default\HelpCommand;
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
use Emporium\Prison\Managers\misc\ScoreboardManager;
use Emporium\Prison\Managers\PickaxeManager;
use Emporium\Prison\Managers\PlayerLevelManager;
use Emporium\Prison\Managers\misc\GlowManager;

# tasks
use Emporium\Prison\tasks\BoosterTask;
use Emporium\Prison\tasks\Events\PrisonBreakBar;
use Emporium\Prison\tasks\LeaderboardUpdateTask;
use Emporium\Prison\tasks\NPCUpdateTask;
use Emporium\Prison\tasks\ScoreboardTask;

# libraries
use muqsit\invmenu\InvMenuHandler;
use muqsit\invmenu\type\util\InvMenuTypeBuilders;

# pocketmine
use pocketmine\block\BlockFactory;
use pocketmine\network\mcpe\protocol\types\inventory\WindowTypes;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat as TF;

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
    private static GlowManager $glowManager;
    private static ScoreboardManager $scoreboardManager;

    public function getPickaxeEnergyLevels () : array
    {
        $ar = [];
        for ($l = 1; $l <= 100; $l++) $ar[$l] = 4800 * ($l * 2 - 1);
        return $ar;
    }

    public function getPlayerLevelXpData(): array
    {
        $playerLevelXpData = [];
        for ($l = 1; $l <= 400; $l++) $playerLevelXpData[$l] = (max($l / 10, 1) * 30) * $l;
        return $playerLevelXpData;
    }

    public static function getInstance(): EmporiumPrison {
        return self::$instance;
    }

    protected function onLoad(): void {
        # Assign instance
        self::$instance = $this;

        # assign managers
        self::$energyManager = new EnergyManager();
        self::$miningManager = new MiningManager();
        self::$pickaxeManager = new PickaxeManager();
        self::$playerLevelManager = new PlayerLevelManager();
        self::$scoreboardManager = new ScoreboardManager($this);
        self::$glowManager = new GlowManager();
        # items
        self::$boosters = new Boosters();
        self::$flares = new Flares();
        self::$orbs = new Orbs();
        self::$pickaxes = new Pickaxes();
        self::$scrolls = new Scrolls();
    }

    public function onEnable(): void {
        # create directories
        @mkdir($this->getDataFolder() . "Prison/");
        @mkdir($this->getDataFolder() . "Boosters/");
        @mkdir($this->getDataFolder() . "Players/");
        @mkdir($this->getDataFolder() . "Meteors/");
        @mkdir($this->getDataFolder() . "Leaderboards/");

        # create files
        if(!file_exists($this->getDataFolder() . "Prison/settings.yml")) new Config($this->getDataFolder() . "Prison/settings.yml", Config::YAML, ["plugin-version" => "EmporiumPrisonPre-alpha1.0.0"]);
        if(!file_exists($this->getDataFolder() . "Leaderboards/kills.yml")) new Config($this->getDataFolder() . "Leaderboards/kills.yml", Config::YAML);
        if(!file_exists($this->getDataFolder() . "Leaderboards/playerlevel.yml")) new Config($this->getDataFolder() . "Leaderboards/playerlevel.yml", Config::YAML);
        if(!file_exists($this->getDataFolder() . "Leaderboards/blocksMined.yml")) new Config($this->getDataFolder() . "Leaderboards/blocksMined.yml", Config::YAML);
        if(!file_exists($this->getDataFolder() . "Leaderboards/meteorHunter.yml")) new Config($this->getDataFolder() . "Leaderboards/meteorHunter.yml", Config::YAML);

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
            ->build()
        );

        # invisible enchant effect
        GlowManager::createEnchant();

        # initialise leaderboards
        LeaderboardManager::registerLeaderboards();
        LeaderboardManager::registerTexts();

        # tasks
        $this->registerEvents();
        $this->registerCommands();
        $this->registerTasks();

        # world
        if(($world = $this->getServer()->getWorldManager()->getWorldByName("world")) !== null) {
            $world->setTime(1000);
            $world->stopTime();
        }

        # tutorial mine
        $this->getServer()->getWorldManager()->loadWorld("TutorialMine");
        if(($world = $this->getServer()->getWorldManager()->getWorldByName("TutorialMine")) !== null) {
            $world->setTime(1000);
            $world->stopTime();
        }

        # coal badlands
        $this->getServer()->getWorldManager()->loadWorld("CoalBadlands");
        if(($world = $this->getServer()->getWorldManager()->getWorldByName("CoalBadlands")) !== null) {
            $world->setTime(1000);
            $world->stopTime();
        }

        # plugin loaded message
        $this->getLogger()->info(TF::BOLD . TF::GREEN . Variables::PLUGIN_VERSION . " Enabled!");
    }

    public function registerCommands () : void
    {
        $this->getServer()->getCommandMap()->unregister($this->getServer()->getCommandMap()->getCommand("help"));
        # default
        $this->getServer()->getCommandMap()->register("bank", new BankCommand());
        $this->getServer()->getCommandMap()->register("extract", new ExtractCommand());
        $this->getServer()->getCommandMap()->register("mines", new MinesCommand());
        $this->getServer()->getCommandMap()->register("pickaxeprestige", new PickaxePrestigeCommand());
        $this->getServer()->getCommandMap()->register("level", new PlayerLevelCommand());
        $this->getServer()->getCommandMap()->register("prestige", new PlayerPrestigeCommand());
        $this->getServer()->getCommandMap()->register("spawn", new SpawnCommand());
        $this->getServer()->getCommandMap()->register("help", new HelpCommand());
        # ranked
        # staff
        $this->getServer()->getCommandMap()->register("booster", new BoosterCommand());
        $this->getServer()->getCommandMap()->register("energy", new EnergyCommand());
        $this->getServer()->getCommandMap()->register("flare", new FlaresCommand());
        $this->getServer()->getCommandMap()->register("npc", new NPCCommand());
    }

    public function registerEvents () : void
    {
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
        $this->getServer()->getPluginManager()->registerEvents(new PlayerListener(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new MeteorListener(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new NPCListener(), $this);
        # item listeners
        $this->getServer()->getPluginManager()->registerEvents(new BoosterListener(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new EnergyListener(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new FlareListener(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new WhiteScrollListener(), $this);
    }

    public function registerTasks () : void
    {
        $this->getScheduler()->scheduleRepeatingTask(new LeaderboardUpdateTask(), 6000);
        $this->getScheduler()->scheduleRepeatingTask(new ScoreboardTask(), 20);
        $this->getScheduler()->scheduleRepeatingTask(new BoosterTask($this), 20);
        $this->getScheduler()->scheduleRepeatingTask(new PrisonBreakBar(), 20);
        $this->getScheduler()->scheduleTask(new NPCUpdateTask());
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

    /**
     * @return GlowManager
     */
    public static function getGlowManager(): GlowManager
    {
        return self::$glowManager;
    }

    /**
     * @return ScoreboardManager
     */
    public static function getScoreboardManager(): ScoreboardManager
    {
        return self::$scoreboardManager;
    }
}