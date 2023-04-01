<?php

namespace EmporiumData;

use EmporiumData\Listener\PlayerListener;
use EmporiumData\Provider\JsonProvider;
use EmporiumData\Provider;
use pocketmine\plugin\PluginBase;

class Loader extends PluginBase
{
    public const PLAYER_FOLDER = "players/";
    public const SERVER_FOLDER = "server/";
    public static ServerManager $serverManagerInstance;
    public static DataManager $dataManagerInstance;
    private static self $instance;

    private DataManager $dataManager;
    private PermissionsManager $permissionManager;
    private ServerManager $serverManager;

    public Provider\JsonProvider $provider;

    protected function onLoad(): void
    {
        if (!is_dir($this->getDataFolder() . self::SERVER_FOLDER)) mkdir($this->getDataFolder() . self::SERVER_FOLDER);
        if (!is_dir($this->getDataFolder() . self::PLAYER_FOLDER)) mkdir($this->getDataFolder() . self::PLAYER_FOLDER);

        self::$serverManagerInstance = new ServerManager($this);
        self::$dataManagerInstance = new DataManager($this);

        $this->provider = new JsonProvider($this);
        $this->serverManager = new ServerManager($this);
        $this->dataManager = new DataManager($this);
        $this->permissionManager = new PermissionsManager($this);
    }

    protected function onEnable(): void
    {
        $this->serverManager->load();
        $this->dataManager->load();
        $this->permissionManager->load();

        $this->getScheduler()->scheduleDelayedRepeatingTask(new AutoSaveTask(), 36000, 36000);
        $this->getServer()->getPluginManager()->registerEvents(new PlayerListener(), $this);
    }

    protected function onDisable(): void
    {
        $this->serverManager->save();
        $this->dataManager->save();
        $this->permissionManager->save();
    }

    public function save() : void
    {
        $this->serverManager->save();
        $this->permissionManager->save();
        $this->dataManager->save();
    }

    public static function getInstance(): self
    {
        return self::$instance;
    }

    /**
     * @return ServerManager
     */
    public function getServerManager(): ServerManager
    {
        return self::$serverManagerInstance;
    }

    /**
     * @return DataManager
     */
    public function getDataManager(): DataManager
    {
        return self::$dataManagerInstance;
    }
}