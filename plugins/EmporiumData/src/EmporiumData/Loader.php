<?php

namespace EmporiumData;

use EmporiumData\Listener\PlayerListener;
use pocketmine\plugin\PluginBase;

class Loader extends PluginBase
{
    public const PLAYER_FOLDER = "players/";
    public const SERVER_FOLDER = "server/";

    private DataManager $dataManager;

    protected function onLoad(): void
    {
        if (!is_dir($this->getDataFolder() . self::SERVER_FOLDER)) mkdir($this->getDataFolder() . self::SERVER_FOLDER);
        if (!is_dir($this->getDataFolder() . self::PLAYER_FOLDER)) mkdir($this->getDataFolder() . self::PLAYER_FOLDER);
        $this->dataManager = new DataManager($this);
    }

    protected function onEnable(): void
    {
        $this->dataManager->loadData();

        $this->getServer()->getPluginManager()->registerEvents(new PlayerListener(), $this);
    }

    protected function onDisable(): void
    {
        $this->dataManager->saveData();
    }

    /**
     * @return DataManager
     */
    public function getDataManager(): DataManager
    {
        return $this->dataManager;
    }
}