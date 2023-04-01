<?php

namespace Tetro\EmporiumEnchants;

use JsonException;
use pocketmine\utils\Config;
use pocketmine\plugin\PluginBase;

use Tetro\EmporiumEnchants\Commands\BlackScrollCommand;
use Tetro\EmporiumEnchants\Commands\CustomEnchantsCommand;

use Tetro\EmporiumEnchants\Items\Books;
use Tetro\EmporiumEnchants\Items\Dust;
use Tetro\EmporiumEnchants\Items\EnchantRerolls;
use Tetro\EmporiumEnchants\Items\Orbs;
use Tetro\EmporiumEnchants\Items\Pages;
use Tetro\EmporiumEnchants\Items\Scrolls;

use Tetro\EmporiumEnchants\Listeners\BlackScrollListener;
use Tetro\EmporiumEnchants\Listeners\BookListener;
use Tetro\EmporiumEnchants\Listeners\DustListener;
use Tetro\EmporiumEnchants\Listeners\OrbListener;
use Tetro\EmporiumEnchants\Listeners\PageListener;

use Tetro\EmporiumEnchants\Core\Types\{ToggleableEnchantment, TickEnchantmentsTask};
use Tetro\EmporiumEnchants\Core\{BookManager, CustomEnchantManager, EventListener, OrbManager};

use Tetro\EmporiumEnchants\Utils\Commando\exception\HookAlreadyRegistered;
use Tetro\EmporiumEnchants\Utils\Commando\PacketHooker;

class EmporiumEnchants extends PluginBase {

    private static EmporiumEnchants $instance;
    private array $enchantmentData;
    # managers
    private BookManager $bookManager;
    private OrbManager $orbManager;
    # items
    private Books $books;
    private Dust $dust;
    private EnchantRerolls $enchantRerolls;
    private Orbs $orbs;
    private Pages $pages;
    private Scrolls $scrolls;

    protected function onLoad(): void
    {
        # managers
        $this->bookManager = new BookManager();
        $this->orbManager = new OrbManager();
        # items
        $this->books = new Books();
        $this->dust = new Dust();
        $this->enchantRerolls = new EnchantRerolls();
        $this->orbs = new Orbs();
        $this->pages = new Pages();
        $this->scrolls = new Scrolls();
    }

    # When Plugin is Loaded
    /**
     * @throws HookAlreadyRegistered|JsonException
     */
    public function onEnable(): void {

        self::$instance = $this;

        # Configurations
        @mkdir($this->getDataFolder()."Enchants/");
        foreach (["rarities", "max_levels", "display_names", "descriptions", "extra_data", "cooldowns", "chances"] as $file) {
            $this->saveResource("Enchants/" . $file . ".json");
            foreach ((new Config($this->getDataFolder() . "Enchants/" . $file . ".json"))->getAll() as $enchant => $data) {
                $this->enchantmentData[$enchant][$file] = $data;
            }
        }
        $this->saveDefaultConfig();

        # register commands
        $this->getServer()->getCommandMap()->register("blackscroll", new BlackScrollCommand());
        $this->getServer()->getCommandMap()->register("customenchants", new CustomEnchantsCommand($this, "customenchants", "Manage Custom Enchants", ["ce", "customenchant"]));
        # register events
        $this->getServer()->getPluginManager()->registerEvents(new EventListener(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new BookListener(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new BlackScrollListener(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new DustListener(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new PageListener(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new OrbListener(), $this);
        # register tasks
        $this->getScheduler()->scheduleRepeatingTask(new TickEnchantmentsTask($this), 20);
        PacketHooker::register($this);
        CustomEnchantManager::init($this);
    }

    public static function getInstance(): EmporiumEnchants {
        return self::$instance;
    }

    # When Plugin is Disabled
    public function onDisable(): void {
        foreach ($this->getServer()->getOnlinePlayers() as $player) {
            foreach ($player->getInventory()->getContents() as $slot => $content) {
                foreach ($content->getEnchantments() as $enchantmentInstance) {
                    ToggleableEnchantment::attemptToggle($player, $content, $enchantmentInstance, $player->getInventory(), $slot, false);
                }
            }
            foreach ($player->getArmorInventory()->getContents() as $slot => $content) {
                foreach ($content->getEnchantments() as $enchantmentInstance) {
                    ToggleableEnchantment::attemptToggle($player, $content, $enchantmentInstance, $player->getArmorInventory(), $slot, false);
                }
            }
        }
    }

    # Get Enchants Data

    /**
     * @throws JsonException
     */
    public function getEnchantmentData(string $enchant, string $data, int|string|array $default = ""): mixed {
        if (!isset($this->enchantmentData[str_replace(" ", "", strtolower($enchant))][$data])) $this->setEnchantmentData($enchant, $data, $default);
        return $this->enchantmentData[str_replace(" ", "", strtolower($enchant))][$data];
    }

    # Set Enchants Data

    /**
     * @throws JsonException
     */
    public function setEnchantmentData(string $enchant, string $data, int|string|array $value): void {
        $this->enchantmentData[str_replace(" ", "", strtolower($enchant))][$data] = $value;
        $config = new Config($this->getDataFolder() . "Enchants/" . $data . ".json");
        $config->set(str_replace(" ", "", strtolower($enchant)), $value);
        $config->save();
    }

    public function getBookManager(): BookManager
    {
        return $this->bookManager;
    }

    /**
     * @return OrbManager
     */
    public function getOrbManager(): OrbManager
    {
        return $this->orbManager;
    }
    /**
     * @return Scrolls
     */
    public function getScrolls(): Scrolls
    {
        return $this->scrolls;
    }

    /**
     * @return Books
     */
    public function getBooks(): Books
    {
        return $this->books;
    }

    /**
     * @return Dust
     */
    public function getDust(): Dust
    {
        return $this->dust;
    }

    /**
     * @return Pages
     */
    public function getPages(): Pages
    {
        return $this->pages;
    }

    /**
     * @return EnchantRerolls
     */
    public function getEnchantRerolls(): EnchantRerolls
    {
        return $this->enchantRerolls;
    }

    /**
     * @return Orbs
     */
    public function getOrbs(): Orbs
    {
        return $this->orbs;
    }
}