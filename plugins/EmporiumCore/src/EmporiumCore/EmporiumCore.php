<?php

namespace EmporiumCore;

# default Commands
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
# rank commands
use EmporiumCore\Commands\Rank\ClearCommand;
use EmporiumCore\Commands\Rank\FeedCommand;
use EmporiumCore\Commands\Rank\HealCommand;
use EmporiumCore\Commands\Rank\MilkCommand;
use EmporiumCore\Commands\Rank\SellCommand;
# staff commands
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
# custom items
use EmporiumCore\CustomItems\Filler;
use EmporiumCore\CustomItems\Locked;
use EmporiumCore\CustomItems\Unlocked;
# listeners
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
# managers
use EmporiumCore\Managers\Data\ServerManager;
use EmporiumCore\Managers\player\PlayerManager;
# tasks
use EmporiumCore\Tasks\AntiCheatTask;
use EmporiumCore\Tasks\CooldownTask;
use EmporiumCore\Tasks\CosmeticsTask;
use EmporiumCore\Tasks\TimerTask;
# libraries
use customiesdevs\customies\item\CustomiesItemFactory;
# pocketmine
use pocketmine\item\Item;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat as TF;
# other
use JsonException;

class EmporiumCore extends PluginBase {

    private static EmporiumCore $instance;

    public static function getInstance(): EmporiumCore {
        return self::$instance;
    }

    /**
     * @throws JsonException
     */
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
        # lootboxes
        # crystals
        # dust
        # shard
        # scroll
        # ui
        CustomiesItemFactory::getInstance()->registerItem(Locked::class, "customies:locked", "Locked");
        CustomiesItemFactory::getInstance()->registerItem(Unlocked::class, "customies:unlocked", "Unlocked");
        CustomiesItemFactory::getInstance()->registerItem(Filler::class, "customies:filler", "Filler");
        # energy
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
        # reset events and boosters
        $this->resetEvents();
        $this->resetBoosters();
    }

    /**
     * @throws JsonException
     */
    public function generateFiles(): void {

        $defaultSettingsData = array(
            "Version" => "PreAlpha v1.0.0"
        );
        $defaultEventsData = array(
            "PrisonBreak" => false,
            "AlienInvasion" => false,
            "MeteorCompetition" => false,
            "StrongHold" => false,
            "EventsTimer" => 0
        );
        $defaultBoostersData = array(
            "Money" => false,
            "MoneyTimer" => 0,
            "Relic" => false,
            "RelicTimer" => 0,
            "Key" => false,
            "KeyTimer" => 0);

        # create directories
        @mkdir($this->getDataFolder() . "PlayerData/");
        @mkdir($this->getDataFolder() . "PlayerData/Players/");
        @mkdir($this->getDataFolder() . "PlayerData/Permissions/");
        @mkdir($this->getDataFolder() . "PlayerData/Cooldowns/");
        @mkdir($this->getDataFolder() . "Server/");

        # create boosters file
        if(!file_exists($this->getDataFolder() . "Server/Boosters.yml")) {
            $serverBoostersConfig = new Config($this->getDataFolder() . "Server/Boosters.yml", Config::YAML, $defaultBoostersData);
            $serverBoostersConfig->save();
        }
        # create events file
        if(!file_exists($this->getDataFolder() . "Server/Events.yml")) {
            $serverEventsConfig = new Config($this->getDataFolder() . "Server/Events.yml", Config::YAML, $defaultEventsData);
            $serverEventsConfig->save();
        }
        # create server settings file
        if(!file_exists($this->getDataFolder() . "Server/Settings.yml")) {
            $serverSettingsConfig = new Config($this->getDataFolder() . "Server/Settings.yml", Config::YAML, $defaultSettingsData);
            $serverSettingsConfig->save();
        }
        # create top money leaderboard file
        if(!file_exists($this->getDataFolder() . "Server/TopMoneyLeaderboardData.yml")) {
            $topMoneyConfig = new Config($this->getDataFolder() . "Server/TopMoneyLeaderboardData.yml", Config::YAML);
            $topMoneyConfig->save();
        }
        # create top prison break leaderboard file
        if(!file_exists($this->getDataFolder() . "Server/TopPrisonBreakLeaderboardData.yml")) {
            $topPrisonBreakConfig = new Config($this->getDataFolder() . "Server/TopPrisonBreakLeaderboardData.yml", Config::YAML);
            $topPrisonBreakConfig->save();
        }
        # create top player level leaderboard file
        if(!file_exists($this->getDataFolder() . "Server/TopPlayerLevelLeaderboardData.yml")) {
            $topPrisonBreakConfig = new Config($this->getDataFolder() . "Server/TopPlayerLevelLeaderboardData.yml", Config::YAML);
            $topPrisonBreakConfig->save();
        }
    }
    /**
     * @throws JsonException
     */
    public function resetEvents(): void {
        if(file_exists($this->getDataFolder() . "Server/Events.yml")) {
            ServerManager::setData("Events", "PrisonBreak", false);
            ServerManager::setData("Events", "AlienInvasion", false);
            ServerManager::setData("Events", "MeteorCompetition", false);
            ServerManager::setData("Events", "StrongHold", false);
            ServerManager::setData("Events", "EventsTimer", 0);
        }
    }
    /**
     * @throws JsonException
     */
    public function resetBoosters(): void {
        if(file_exists($this->getDataFolder() . "Server/Boosters.yml")) {
            ServerManager::setData("Boosters", "Money", false);
            ServerManager::setData("Boosters", "MoneyTimer", 0);
            ServerManager::setData("Boosters", "Relic", false);
            ServerManager::setData("Boosters", "RelicTimer", 0);
            ServerManager::setData("Boosters", "Key", false);
            ServerManager::setData("Boosters", "KeyTimer", 0);
        }
    }
}