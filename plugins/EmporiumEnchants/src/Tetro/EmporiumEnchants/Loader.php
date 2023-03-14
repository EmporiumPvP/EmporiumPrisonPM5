<?php

namespace Tetro\EmporiumEnchants;

use Emporium\Prison\EmporiumPrison;
use JsonException;
use pocketmine\utils\Config;
use pocketmine\plugin\PluginBase;

use Tetro\EmporiumEnchants\Commands\BlackScrollCommand;
use Tetro\EmporiumEnchants\Commands\CustomEnchantsCommand;
use Tetro\EmporiumEnchants\Items\Blackscroll;
use Tetro\EmporiumEnchants\Items\Books;
use Tetro\EmporiumEnchants\Listeners\BlackScrollListener;
use Tetro\EmporiumEnchants\Listeners\BookListener;
use Tetro\EmporiumEnchants\Core\Types\{ToggleableEnchantment, TickEnchantmentsTask};
use Tetro\EmporiumEnchants\Core\{BookManager, CustomEnchantManager, EventListener};
use Tetro\EmporiumEnchants\Utils\Commando\exception\HookAlreadyRegistered;
use Tetro\EmporiumEnchants\Utils\Commando\PacketHooker;

class Loader extends PluginBase {

    private static Loader $instance;
    private array $enchantmentData;

    private static BookManager $bookManager;
    private static Books $books;
    private static Blackscroll $blackscroll;

    protected function onLoad(): void
    {
        # managers
        self::$bookManager = new BookManager();
        # items
        self::$books = new Books();
        self::$blackscroll = new Blackscroll();

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

        # Register Files
        $this->getServer()->getCommandMap()->register("blackscroll", new BlackScrollCommand());
        $this->getServer()->getCommandMap()->register("customenchants", new CustomEnchantsCommand($this, "customenchants", "Manage Custom Enchants", ["ce", "customenchant"]));
        $this->getServer()->getPluginManager()->registerEvents(new EventListener(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new BookListener(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new BlackScrollListener(), $this);
        $this->getScheduler()->scheduleRepeatingTask(new TickEnchantmentsTask($this), 20);
        PacketHooker::register($this);
        CustomEnchantManager::init($this);
    }

    public static function getInstance(): Loader {
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

    public static function getBookManager(): BookManager {
        return self::$bookManager;
    }

    /**
     * @return Blackscroll
     */
    public static function getBlackscroll(): Blackscroll
    {
        return self::$blackscroll;
    }

    /**
     * @return Books
     */
    public static function getBooks(): Books
    {
        return self::$books;
    }
}