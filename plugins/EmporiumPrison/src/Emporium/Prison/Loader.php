<?php

namespace Emporium\Prison;

use Emporium\Prison\commands\MinesCommand;

use Emporium\Prison\listeners\player\PlayerListener;
use Emporium\Prison\listeners\world\WorldListener;

use pocketmine\plugin\PluginBase;

use pocketmine\utils\Config;
use pocketmine\utils\TextFormat as TF;

class Loader extends PluginBase {

    private static Loader $instance;

    private array $defaultServerSettingsData = [
        "plugin-version" => "EmporiumPrisonPre-alpha1.0.0",
    ];

    public static function getInstance(): Loader {
        return self::$instance;
    }

    public function onLoad(): void {
        $this->getLogger()->info(TF::GREEN . "Emporium Prison Loading...");
    }

    public function onEnable(): void {

        self::$instance = $this;

        @mkdir($this->getDataFolder() . "Server/");
        @mkdir($this->getDataFolder() . "Players/");
        if(!file_exists(Variables::DIRECTORY . "Server/settings.yml")) {
            new Config(Variables::DIRECTORY . "Server/settings.yml", Config::YAML, $this->defaultServerSettingsData);
            $this->getLogger()->info(Variables::FILE_CREATED_PREFIX . " SERVER SETTINGS FILE");
        } else {
            $this->getLogger()->info(Variables::FILE_LOADED_PREFIX . " SERVER SETTINGS FILE");
        }

        # listeners
        $this->getServer()->getPluginManager()->registerEvents(new WorldListener($this), $this);
        $this->getServer()->getPluginManager()->registerEvents(new PlayerListener($this), $this);
        # commands
        $this->getServer()->getCommandMap()->register("mines", new MinesCommand());
        # load worlds
        $this->getServer()->getWorldManager()->loadWorld("Lobby");
        $this->getServer()->getWorldManager()->loadWorld("Warzone");
        $this->getServer()->getWorldManager()->loadWorld("TutorialMine");
        $this->getServer()->getWorldManager()->loadWorld("CoalMine");
        $this->getServer()->getWorldManager()->loadWorld("IronMine");
        $this->getServer()->getWorldManager()->loadWorld("RedstoneMine");
        $this->getServer()->getWorldManager()->loadWorld("LapisMine");
        $this->getServer()->getWorldManager()->loadWorld("GoldMine");
        $this->getServer()->getWorldManager()->loadWorld("DiamondMine");
        $this->getServer()->getWorldManager()->loadWorld("EmeraldMine");

        $this->getLogger()->info(TF::BOLD . TF::GREEN . Variables::PLUGIN_VERSION . " Enabled!");
    }

    public function onDisable(): void {
        $this->getLogger()->info(TF::BOLD . TF::RED . "Emporium Prison Disabled!");
    }
}