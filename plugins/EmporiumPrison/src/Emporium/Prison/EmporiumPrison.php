<?php

namespace Emporium\Prison;

# default commands
use Emporium\Prison\area\AreaException;
use Emporium\Prison\area\AreaListener;
use Emporium\Prison\area\AreaManager;
use Emporium\Prison\commands\Default\BankCommand;
use Emporium\Prison\commands\Default\ExtractCommand;
use Emporium\Prison\commands\Default\MinesCommand;
use Emporium\Prison\commands\Default\PickaxePrestigeCommand;
use Emporium\Prison\commands\Default\PlayerLevelCommand;
use Emporium\Prison\commands\Default\PlayerPrestigeCommand;
use Emporium\Prison\commands\Default\SpawnCommand;

# staff commands
use Emporium\Prison\commands\Staff\BoosterCommand;
use Emporium\Prison\commands\Staff\EnergyCommand;
use Emporium\Prison\commands\Staff\FlaresCommand;
use Emporium\Prison\commands\Staff\NPCCommand;

# items
use Emporium\Prison\items\Boosters;
use Emporium\Prison\items\Contraband;
use Emporium\Prison\items\Flares;
use Emporium\Prison\items\Orbs;
use Emporium\Prison\items\Pickaxes;
use Emporium\Prison\items\Scrolls;

# listeners
use Emporium\Prison\listeners\blocks\MeteorListener;
use Emporium\Prison\listeners\Items\ArmourListener;
use Emporium\Prison\listeners\Items\BoosterListener;
use Emporium\Prison\listeners\Items\EnergyListener;
use Emporium\Prison\listeners\Items\Flares\FlareListener;
use Emporium\Prison\listeners\Items\WhiteScrollListener;
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
use Emporium\Prison\Managers\misc\GlowManager;
use Emporium\Prison\Managers\PickaxeManager;
use Emporium\Prison\Managers\PlayerLevelManager;
use Emporium\Prison\Managers\ScoreboardManager;

# tasks
use Emporium\Prison\Menus\Bank;
use Emporium\Prison\Menus\Help;
use Emporium\Prison\Menus\Mines;
use Emporium\Prison\Menus\OreExchanger;
use Emporium\Prison\Menus\PickaxePrestige;
use Emporium\Prison\Menus\PlayerLevel;
use Emporium\Prison\Menus\PlayerPrestige;
use Emporium\Prison\Menus\TourGuide;
use Emporium\Prison\Menus\Vaults;
use Emporium\Prison\tasks\BoosterTask;
use Emporium\Prison\tasks\LeaderboardUpdateTask;
use Emporium\Prison\tasks\NPCUpdateTask;
use Emporium\Prison\tasks\ScoreboardTask;
use Emporium\Prison\tasks\Server\spawnChunkLoaderTask;
use Emporium\Prison\tasks\Server\tutorialMineChunkLoaderTask;

# libraries
use muqsit\invmenu\InvMenuHandler;
use muqsit\invmenu\type\util\InvMenuTypeBuilders;

# pocketmine
use pocketmine\block\BlockFactory;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\network\mcpe\protocol\types\inventory\WindowTypes;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;

class EmporiumPrison extends PluginBase {

    const TYPE_DISPENSER = "dispenser menu";

    # managers
    private GlowManager $glowManager;
    private ScoreboardManager $scoreboardManager;
    private EnergyManager $energyManager;
    private PickaxeManager $pickaxeManager;
    private MiningManager $miningManager;
    private PlayerLevelManager $playerLevelManager;
    private AreaManager $areaManager;

    private static EmporiumPrison $instance;

    # items
    private Boosters $boosters;
    private Orbs $orbs;
    private Flares $flares;
    private Pickaxes $pickaxes;
    private Scrolls $scrolls;
    private Contraband $contraband;

    # menus
    private PickaxePrestige $pickaxePrestigeMenu;
    private OreExchanger $oreExchangerMenu;
    private TourGuide $tourguideMenu;
    private Mines $minesMenu;
    private PlayerLevel $playerLevelMenu;
    private Vaults $vaultsMenu;
    private Bank $bankMenu;
    private Help $helpMenu;
    private PlayerPrestige $playerPrestigeMenu;

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

    protected function onLoad(): void {

        # initialise managers
        $this->energyManager = new EnergyManager();
        $this->miningManager = new MiningManager();
        $this->pickaxeManager = new PickaxeManager();
        $this->playerLevelManager = new PlayerLevelManager();
        $this->scoreboardManager = new ScoreboardManager($this);
        $this->glowManager = new GlowManager();

        # initialise items
        $this->boosters = new Boosters();
        $this->flares = new Flares();
        $this->orbs = new Orbs();
        $this->pickaxes = new Pickaxes();
        $this->scrolls = new Scrolls();
        $this->contraband = new Contraband();

        # initialise menus
        $this->pickaxePrestigeMenu = new PickaxePrestige();
        $this->oreExchangerMenu = new OreExchanger();
        $this->tourguideMenu = new TourGuide();
        $this->minesMenu = new Mines();
        $this->playerLevelMenu = new PlayerLevel();
        $this->vaultsMenu = new Vaults();
        $this->bankMenu = new Bank();
        $this->helpMenu = new Help();
        $this->playerPrestigeMenu = new PlayerPrestige();
    }

    /**
     * @throws AreaException
     */
    public function onEnable(): void {

        self::$instance = $this;
        $this->areaManager = new AreaManager($this);

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

        # register help command
        $map = Server::getInstance()->getCommandMap();
        $command = new class("Help") extends Command {
            public function execute(CommandSender $sender, string $commandLabel, array $args): bool{
                if(!$sender instanceof Player) return false;
                $helpMenu = EmporiumPrison::getInstance()->getHelpMenu();
                $helpMenu->open($sender);
                return true;
            }
        };
        $help = $command;
        $help->setAliases(["help"]);
        $map->register("pqwefh1weo[fbq", $help);
        $this->registerTasks();

        /*
         * TODO: move this to async chunk load task
         */
        # coal badlands
        $this->getServer()->getWorldManager()->loadWorld("CoalBadlands");
        if(($world = $this->getServer()->getWorldManager()->getWorldByName("CoalBadlands")) !== null) {
            $world->setTime(1000);
            $world->stopTime();
        }

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

        # item listeners
        $this->getServer()->getPluginManager()->registerEvents(new BoosterListener(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new EnergyListener(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new FlareListener(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new WhiteScrollListener(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new PlayerLevelManager(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new ArmourListener(), $this);

        # other listeners
        $this->getServer()->getPluginManager()->registerEvents(new PlayerListener(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new MeteorListener(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new NPCListener(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new AreaListener($this), $this);
    }

    public function registerTasks () : void
    {
        $this->getScheduler()->scheduleRepeatingTask(new LeaderboardUpdateTask(), 6000);
        $this->getScheduler()->scheduleRepeatingTask(new ScoreboardTask(), 20);
        $this->getScheduler()->scheduleRepeatingTask(new BoosterTask($this), 20);
        $this->getScheduler()->scheduleTask(new NPCUpdateTask());

        # spawn preload chunk task
        $this->getServer()->getAsyncPool()->submitTask(new spawnChunkLoaderTask());

        # tutorial mine preload chunk task
        $this->getServer()->getAsyncPool()->submitTask(new tutorialMineChunkLoaderTask());
    }

    /**
     * @return EmporiumPrison
     */
    public static function getInstance(): EmporiumPrison
    {
        return self::$instance;
    }

    public function getEnergyManager(): EnergyManager {
        return $this->energyManager;
    }

    public function getPickaxeManager(): PickaxeManager {
        return $this->pickaxeManager;
    }

    public function getMiningManager(): MiningManager {
        return $this->miningManager;
    }

    public function getPlayerLevelManager(): PlayerLevelManager {
        return $this->playerLevelManager;
    }

    /**
     * @return AreaManager
     */
    public function getAreaManager(): AreaManager
    {
        return $this->areaManager;
    }

    public function getBoosters(): Boosters {
        return $this->boosters;
    }

    public function getFlares(): Flares {
        return $this->flares;
    }

    public function getOrbs(): Orbs {
        return $this->orbs;
    }

    public function getPickaxes(): Pickaxes {
        return $this->pickaxes;
    }

    public function getScrolls(): Scrolls {
        return $this->scrolls;
    }

    public function getGlowManager(): GlowManager
    {
        return $this->glowManager;
    }

    /**
     * @return ScoreboardManager
     */
    public function getScoreboardManager(): ScoreboardManager
    {
        return $this->scoreboardManager;
    }

    /**
     * @return PickaxePrestige
     */
    public function getPickaxePrestige(): PickaxePrestige
    {
        return $this->pickaxePrestigeMenu;
    }

    /**
     * @return OreExchanger
     */
    public function getOreExchanger(): OreExchanger
    {
        return $this->oreExchangerMenu;
    }

    /**
     * @return TourGuide
     */
    public function getTourguide(): TourGuide
    {
        return $this->tourguideMenu;
    }

    /**
     * @return Mines
     */
    public function getMines(): Mines
    {
        return $this->minesMenu;
    }

    /**
     * @return PlayerLevel
     */
    public function getPlayerLevelMenu(): PlayerLevel
    {
        return $this->playerLevelMenu;
    }

    /**
     * @return Vaults
     */
    public function getVaultsMenu(): Vaults
    {
        return $this->vaultsMenu;
    }

    /**
     * @return Bank
     */
    public function getBankMenu(): Bank
    {
        return $this->bankMenu;
    }

    /**
     * @return Help
     */
    public function getHelpMenu(): Help
    {
        return $this->helpMenu;
    }

    /**
     * @return Contraband
     */
    public function getContraband(): Contraband
    {
        return $this->contraband;
    }

    /**
     * @return PlayerPrestige
     */
    public function getPlayerPrestigeMenu(): PlayerPrestige
    {
        return $this->playerPrestigeMenu;
    }
}