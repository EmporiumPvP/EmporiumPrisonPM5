<?php

namespace Tetro\EmporiumEnchants;

use customiesdevs\customies\item\CustomiesItemFactory;

use JsonException;

use Tetro\EmporiumEnchants\Commands\BlackScrollCommand;
use Tetro\EmporiumEnchants\Commands\CustomEnchantsCommand;
use Tetro\EmporiumEnchants\Commands\GiveItemCommand;
use Tetro\EmporiumEnchants\CustomItems\Books\Elite_Book;
use Tetro\EmporiumEnchants\CustomItems\Books\Executive_Book;
use Tetro\EmporiumEnchants\CustomItems\Books\Godly_Book;
use Tetro\EmporiumEnchants\CustomItems\Books\Heroic_Book;
use Tetro\EmporiumEnchants\CustomItems\Books\Legendary_Book;
use Tetro\EmporiumEnchants\CustomItems\Books\Ultimate_Book;
use Tetro\EmporiumEnchants\CustomItems\Dust\Elite_Dust;
use Tetro\EmporiumEnchants\CustomItems\Dust\Godly_Dust;
use Tetro\EmporiumEnchants\CustomItems\Dust\Heroic_Dust;
use Tetro\EmporiumEnchants\CustomItems\Dust\Legendary_Dust;
use Tetro\EmporiumEnchants\CustomItems\Dust\Ultimate_Dust;
use Tetro\EmporiumEnchants\CustomItems\Orbs\Elite_Orb;
use Tetro\EmporiumEnchants\CustomItems\Orbs\Godly_Orb;
use Tetro\EmporiumEnchants\CustomItems\Orbs\Heroic_Orb;
use Tetro\EmporiumEnchants\CustomItems\Orbs\Legendary_Orb;
use Tetro\EmporiumEnchants\CustomItems\Orbs\Ultimate_Orb;
use Tetro\EmporiumEnchants\CustomItems\Pages\Elite_Page;
use Tetro\EmporiumEnchants\CustomItems\Pages\Executive_Page;
use Tetro\EmporiumEnchants\CustomItems\Pages\Godly_Page;
use Tetro\EmporiumEnchants\CustomItems\Pages\Heroic_Page;
use Tetro\EmporiumEnchants\CustomItems\Pages\Legendary_Page;
use Tetro\EmporiumEnchants\CustomItems\Pages\Ultimate_Page;
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
use CortexPE\Commando\exception\HookAlreadyRegistered;
use CortexPE\Commando\PacketHooker;

use pocketmine\utils\Config;
use pocketmine\plugin\PluginBase;

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
        # bosses items
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

        # register items
        $this->registerCustomItems();
        # register commands
        $this->getServer()->getCommandMap()->register("blackscroll", new BlackScrollCommand());
        $this->getServer()->getCommandMap()->register("customenchants", new CustomEnchantsCommand($this, "customenchants"));
        $this->getServer()->getCommandMap()->register("giveitem", new GiveItemCommand());
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

    public function registerCustomItems(): void {

        # books
        CustomiesItemFactory::getInstance()->registerItem(Elite_Book::class, "emporiumenchants:elite_book", "Elite Book");
        CustomiesItemFactory::getInstance()->registerItem(Ultimate_Book::class, "emporiumenchants:ultimate_book", "Ultimate Book");
        CustomiesItemFactory::getInstance()->registerItem(Legendary_Book::class, "emporiumenchants:legendary_book", "Legendary Book");
        CustomiesItemFactory::getInstance()->registerItem(Godly_Book::class, "emporiumenchants:godly_book", "Godly Book");
        CustomiesItemFactory::getInstance()->registerItem(Heroic_Book::class, "emporiumenchants:heroic_book", "Heroic Book");
        CustomiesItemFactory::getInstance()->registerItem(Executive_Book::class, "emporiumenchants:executive_book", "Executive Book");
        # dust
        CustomiesItemFactory::getInstance()->registerItem(Elite_Dust::class, "emporiumenchants:elite_dust", "Elite Dust");
        CustomiesItemFactory::getInstance()->registerItem(Ultimate_Dust::class, "emporiumenchants:ultimate_dust", "Ultimate Dust");
        CustomiesItemFactory::getInstance()->registerItem(Legendary_Dust::class, "emporiumenchants:legendary_dust", "Legendary Dust");
        CustomiesItemFactory::getInstance()->registerItem(Godly_Dust::class, "emporiumenchants:godly_dust", "Godly Dust");
        CustomiesItemFactory::getInstance()->registerItem(Heroic_Dust::class, "emporiumenchants:heroic_dust", "Heroic Dust");
        # rerolls

        # orbs
        CustomiesItemFactory::getInstance()->registerItem(Elite_Orb::class, "emporiumenchants:elite_orb", "Elite Orb");
        CustomiesItemFactory::getInstance()->registerItem(Ultimate_Orb::class, "emporiumenchants:ultimate_orb", "Ultimate Orb");
        CustomiesItemFactory::getInstance()->registerItem(Legendary_Orb::class, "emporiumenchants:legendary_orb", "Legendary Orb");
        CustomiesItemFactory::getInstance()->registerItem(Godly_Orb::class, "emporiumenchants:godly_orb", "Godly Orb");
        CustomiesItemFactory::getInstance()->registerItem(Heroic_Orb::class, "emporiumenchants:heroic_orb", "Heroic Orb");
        # pages
        CustomiesItemFactory::getInstance()->registerItem(Elite_Page::class, "emporiumenchants:elite_page", "Elite Page");
        CustomiesItemFactory::getInstance()->registerItem(Ultimate_Page::class, "emporiumenchants:ultimate_page", "Ultimate Page");
        CustomiesItemFactory::getInstance()->registerItem(Legendary_Page::class, "emporiumenchants:legendary_page", "Legendary Page");
        CustomiesItemFactory::getInstance()->registerItem(Godly_Page::class, "emporiumenchants:godly_page", "Godly Page");
        CustomiesItemFactory::getInstance()->registerItem(Heroic_Page::class, "emporiumenchants:heroic_page", "Heroic Page");
        CustomiesItemFactory::getInstance()->registerItem(Executive_Page::class, "emporiumenchants:executive_page", "Executive Page");

        # scrolls

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