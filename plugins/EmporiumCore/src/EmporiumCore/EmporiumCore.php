<?php

namespace EmporiumCore;

# default Commands
use customiesdevs\customies\item\CustomiesItemFactory;
use EmporiumCore\Commands\Default\BalanceCommand;
use EmporiumCore\Commands\Default\BragCommand;
use EmporiumCore\Commands\Default\CustomEnchantShopCommand;
use EmporiumCore\Commands\Default\DiscordCommand;
use EmporiumCore\Commands\Default\GambleCommand;
use EmporiumCore\Commands\Default\GKitsCommand;
use EmporiumCore\Commands\Default\ItemsCommand;
use EmporiumCore\Commands\Default\KitsCommand;
use EmporiumCore\Commands\Default\PayCommand;
use EmporiumCore\Commands\Default\RanksCommand;
use EmporiumCore\Commands\Default\RulesCommand;
use EmporiumCore\Commands\Default\ShopCommand;
use EmporiumCore\Commands\Default\TagsCommand;
use EmporiumCore\Commands\Default\TrashCommand;
use EmporiumCore\Commands\Default\VoteShopCommand;
use EmporiumCore\Commands\Rank\ClearCommand;
use EmporiumCore\Commands\Rank\FeedCommand;
use EmporiumCore\Commands\Rank\HealCommand;
use EmporiumCore\Commands\Rank\MilkCommand;
use EmporiumCore\Commands\Rank\SellCommand;
use EmporiumCore\Commands\Staff\BanCommand;
use EmporiumCore\Commands\Staff\BossCommand;
use EmporiumCore\Commands\Staff\BroadcastCommand;
use EmporiumCore\Commands\Staff\ClearChatCommand;
use EmporiumCore\Commands\Staff\ContrabandCommand;
use EmporiumCore\Commands\Staff\CreativeCommand;
use EmporiumCore\Commands\Staff\FreezeCommand;
use EmporiumCore\Commands\Staff\KickCommand;
use EmporiumCore\Commands\Staff\KillCommand;
use EmporiumCore\Commands\Staff\MuteCommand;
use EmporiumCore\Commands\Staff\SurvivalCommand;
use EmporiumCore\Commands\Staff\TeleportCommand;
use EmporiumCore\Commands\Staff\UnbanCommand;
use EmporiumCore\Commands\Staff\UnfreezeCommand;
use EmporiumCore\Commands\Staff\UnmuteCommand;
use EmporiumCore\Commands\Staff\WarnCommand;
use EmporiumCore\CustomItems\Filler;
use EmporiumCore\CustomItems\Locked;
use EmporiumCore\CustomItems\Unlocked;
use EmporiumCore\Listeners\Events\PrisonBreakListener;
use EmporiumCore\Listeners\Items\ContrabandListener;
use EmporiumCore\Listeners\Items\GKitListener;
use EmporiumCore\Listeners\Items\LootboxListener;
use EmporiumCore\Listeners\Items\RankKitListener;
use EmporiumCore\Listeners\Player\AntiCheatEvent;
use EmporiumCore\Listeners\Player\ChatEvent;
use EmporiumCore\Listeners\Player\MoveEvent;
use EmporiumCore\Listeners\WebhookEvent;
use EmporiumCore\Listeners\world\PlayerInteractListener;
use EmporiumCore\Managers\player\PlayerManager;
use EmporiumCore\Menus\Blacksmith;
use EmporiumCore\Menus\Chef;
use EmporiumCore\Menus\CustomEnchantMenu;
use EmporiumCore\Menus\GKitsMenu;
use EmporiumCore\Menus\KitsMenu;
use EmporiumCore\Menus\RankKitsMenu;
use EmporiumCore\Menus\RulesMenu;
use EmporiumCore\Menus\Tags;
use EmporiumCore\Tasks\AntiCheatTask;
use EmporiumCore\Tasks\CooldownTask;
use EmporiumCore\Tasks\CosmeticsTask;
use EmporiumCore\Tasks\TimerTask;
use Items\Crystals;
use Items\GKits;
use Items\Lootboxes;
use Items\PlayerTags;
use Items\RankKitItems\Emperor;
use Items\RankKitItems\Imperial;
use Items\RankKitItems\Majesty;
use Items\RankKitItems\Noble;
use Items\RankKitItems\President;
use Items\RankKitItems\Supreme;
use Items\RankKits;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat as TF;

class EmporiumCore extends PluginBase {

    private static EmporiumCore $instance;
    private Crystals $crystals;
    private GKits $gkits;
    private Lootboxes $lootboxes;
    private PlayerTags $playerTags;
    private RankKits $rankKits;
    private Noble $nobleItems;
    private Imperial $imperialItems;
    private Majesty $majestyItems;
    private Supreme $supremeItems;
    private Emperor $emperorItems;
    private President $presidentItems;
    private Chef $chef;
    private Blacksmith $blacksmith;
    private CustomEnchantMenu $customEnchantMenu;
    private Tags $tagsMenu;
    private GKitsMenu $gkitsMenu;
    private RankKitsMenu $rankKitsMenu;
    private RulesMenu $getRulesMenu;
    private KitsMenu $kitsMenu;

    public static function getInstance(): EmporiumCore {
        return self::$instance;
    }

    protected function onLoad(): void
    {
        # items
        $this->crystals = new Crystals();
        $this->gkits = new GKits();
        $this->lootboxes = new Lootboxes();
        $this->playerTags = new PlayerTags();
        $this->rankKits = new RankKits();
        $this->nobleItems = new Noble();
        $this->imperialItems = new Imperial();
        $this->majestyItems = new Majesty();
        $this->supremeItems = new Supreme();
        $this->emperorItems = new Emperor();
        $this->presidentItems = new President();
        # menus
        $this->chef = new Chef();
        $this->blacksmith = new Blacksmith();
        $this->customEnchantMenu = new CustomEnchantMenu();
        $this->tagsMenu = new Tags();
        $this->gkitsMenu = new GKitsMenu();
        $this->rankKitsMenu = new RankKitsMenu();
        $this->getRulesMenu = new RulesMenu();
        $this->kitsMenu = new KitsMenu();
    }

    public function onEnable(): void {

        self::$instance = $this;

        # set motd
        $this->getServer()->getNetwork()->setName(TF::BOLD . TF::AQUA . "Emporium" . TF::LIGHT_PURPLE . "PvP");

        $this->generateFiles();
        ###############################
        # Unregister Vanilla Commands #
        ###############################
        $map = $this->getServer()->getCommandMap();
        $commands = [
            "ban",
            "ban-ip",
            "banlist",
            "clear",
            "defaultgamemode",
            "deop",
            "difficulty",
            "dumpmemory",
            "effect",
            "gamemode",
            "gc",
            "kick",
            "kill",
            "list",
            "me",
            "op",
            "pardon",
            "pardon-ip",
            "particle",
            "plugins",
            "save-all",
            "save-off",
            "save-on",
            "say",
            "seed",
            "setworldspawn",
            "spawnpoint",
            "status",
            "stop",
            "tell",
            "time",
            "timings",
            "title",
            "tp",
            "transferserver",
            "version",
            "whitelist"
        ];
        foreach($commands as $command) {
            $map->unregister($map->getCommand($command));
        }

        # register items
        # ui
        CustomiesItemFactory::getInstance()->registerItem(Locked::class, "customies:locked", "Locked");
        CustomiesItemFactory::getInstance()->registerItem(Unlocked::class, "customies:unlocked", "Unlocked");
        CustomiesItemFactory::getInstance()->registerItem(Filler::class, "customies:filler", "Filler");

        # register listeners
        # item listeners
        $this->getServer()->getPluginManager()->registerEvents(new ContrabandListener(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new GKitListener(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new RankKitListener(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new LootboxListener(), $this);

        # other
        $this->getServer()->getPluginManager()->registerEvents(new MoveEvent(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new AntiCheatEvent($this), $this);
        $this->getServer()->getPluginManager()->registerEvents(new PlayerManager(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new WebhookEvent($this), $this);
        $this->getServer()->getPluginManager()->registerEvents(new PrisonBreakListener(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new PlayerInteractListener(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new ChatEvent(), $this);

        # register Commands
        # default commands
        $this->getServer()->getCommandMap()->register("balance", new BalanceCommand($this));
        $this->getServer()->getCommandMap()->register("brag", new BragCommand($this));
        $this->getServer()->getCommandMap()->register("discord", new DiscordCommand());
        $this->getServer()->getCommandMap()->register("gamble", new GambleCommand());
        $this->getServer()->getCommandMap()->register("gkits", new GKitsCommand());
        $this->getServer()->getCommandMap()->register("items", new ItemsCommand());
        $this->getServer()->getCommandMap()->register("kits", new KitsCommand());
        $this->getServer()->getCommandMap()->register("pay", new PayCommand());
        $this->getServer()->getCommandMap()->register("ranks", new RanksCommand());
        $this->getServer()->getCommandMap()->register("rules", new RulesCommand());
        $this->getServer()->getCommandMap()->register("shop", new ShopCommand());
        $this->getServer()->getCommandMap()->register("tags", new TagsCommand());
        $this->getServer()->getCommandMap()->register("trash", new TrashCommand());
        $this->getServer()->getCommandMap()->register("voteshop", new VoteShopCommand());

        # rank commands
        $this->getServer()->getCommandMap()->register("clear", new ClearCommand());
        $this->getServer()->getCommandMap()->register("feed", new FeedCommand());
        $this->getServer()->getCommandMap()->register("heal", new HealCommand());
        $this->getServer()->getCommandMap()->register("milk", new MilkCommand());
        $this->getServer()->getCommandMap()->register("sell", new SellCommand());

        # staff commands
        $this->getServer()->getCommandMap()->register("ban", new BanCommand());
        $this->getServer()->getCommandMap()->register("broadcast", new BroadcastCommand());
        $this->getServer()->getCommandMap()->register("clearchat", new ClearChatCommand($this));
        $this->getServer()->getCommandMap()->register("creative", new CreativeCommand());
        $this->getServer()->getCommandMap()->register("customenchantshop", new CustomEnchantShopCommand());
        $this->getServer()->getCommandMap()->register("freeze", new FreezeCommand());
        $this->getServer()->getCommandMap()->register("kick", new KickCommand());
        $this->getServer()->getCommandMap()->register("kill", new KillCommand());
        $this->getServer()->getCommandMap()->register("mute", new MuteCommand());
        $this->getServer()->getCommandMap()->register("survival", new SurvivalCommand());
        $this->getServer()->getCommandMap()->register("teleport", new TeleportCommand());
        $this->getServer()->getCommandMap()->register("unban", new UnbanCommand());
        $this->getServer()->getCommandMap()->register("unfreeze", new UnfreezeCommand());
        $this->getServer()->getCommandMap()->register("unmute", new UnmuteCommand());
        $this->getServer()->getCommandMap()->register("warn", new WarnCommand());
        $this->getServer()->getCommandMap()->register("boss", new BossCommand());
        $this->getServer()->getCommandMap()->register("contraband", new ContrabandCommand());

        # register tasks
        $this->getScheduler()->scheduleRepeatingTask(new AntiCheatTask($this), 20);
        $this->getScheduler()->scheduleRepeatingTask(new CooldownTask($this), 20);
        $this->getScheduler()->scheduleRepeatingTask(new CosmeticsTask($this), 1);
        $this->getScheduler()->scheduleRepeatingTask(new TimerTask($this), 20);
    }

    /**
     * @return Crystals
     */
    public function getCrystals(): Crystals
    {
        return $this->crystals;
    }

    /**
     * @return GKits
     */
    public function getGkits(): GKits
    {
        return $this->gkits;
    }

    /**
     * @return Lootboxes
     */
    public function getLootboxes(): Lootboxes
    {
        return $this->lootboxes;
    }

    /**
     * @return PlayerTags
     */
    public function getPlayerTags(): PlayerTags
    {
        return $this->playerTags;
    }

    /**
     * @return RankKits
     */
    public function getRankKits(): RankKits
    {
        return $this->rankKits;
    }

    /**
     * @return Noble
     */
    public function getNobleItems(): Noble
    {
        return $this->nobleItems;
    }

    /**
     * @return Imperial
     */
    public function getImperialItems(): Imperial
    {
        return $this->imperialItems;
    }

    /**
     * @return Supreme
     */
    public function getSupremeItems(): Supreme
    {
        return $this->supremeItems;
    }

    /**
     * @return Majesty
     */
    public function getMajestyItems(): Majesty
    {
        return $this->majestyItems;
    }

    /**
     * @return Emperor
     */
    public function getEmperorItems(): Emperor
    {
        return $this->emperorItems;
    }

    /**
     * @return President
     */
    public function getPresidentItems(): President
    {
        return $this->presidentItems;
    }

    /**
     * @return Chef
     */
    public function getChef(): Chef
    {
        return $this->chef;
    }

    /**
     * @return Blacksmith
     */
    public function getBlacksmith(): Blacksmith
    {
        return $this->blacksmith;
    }

    /**
     * @return CustomEnchantMenu
     */
    public function getCustomEnchantMenu(): CustomEnchantMenu
    {
        return $this->customEnchantMenu;
    }

    /**
     * @return Tags
     */
    public function getTags(): Tags
    {
        return $this->tagsMenu;
    }

    /**
     * @return GKitsMenu
     */
    public function getGkitsMenu(): GKitsMenu
    {
        return $this->gkitsMenu;
    }

    /**
     * @return RankKitsMenu
     */
    public function getRankKitsMenu(): RankKitsMenu
    {
        return $this->rankKitsMenu;
    }

    /**
     * @return RulesMenu
     */
    public function getRulesMenu(): RulesMenu
    {
        return $this->getRulesMenu;
    }

    /**
     * @return KitsMenu
     */
    public function getKitsMenu(): KitsMenu
    {
        return $this->kitsMenu;
    }
}