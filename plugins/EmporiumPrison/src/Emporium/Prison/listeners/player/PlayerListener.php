<?php

namespace Emporium\Prison\listeners\player;

use Emporium\Prison\Loader;
use Emporium\Prison\Managers\DataManager;
use Emporium\Prison\Variables;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;

use pocketmine\utils\Config;
use pocketmine\utils\TextFormat as TF;

use pocketmine\world\Position;

class PlayerListener implements Listener {

    private array $defaultPlayerData = [
        "level" => 0,
        "xp" => 0,
        "coal-ore-mined" => 0,
        "iron-ore-mined" => 0,
        "redstone-ore-mined" => 0,
        "lapis-ore-mined" => 0,
        "gold-ore-mined" => 0,
        "diamond-ore-mined" => 0,
        "emerald-ore-mined" => 0,
        "tutorial-complete" => false
    ];
    private Loader $plugin;

    public function __construct(Loader $plugin) {
        $this->plugin = $plugin;
    }

    public function onJoin(PlayerJoinEvent $event) {

        $player = $event->getPlayer();
        if(!file_exists(Variables::DIRECTORY . "Players/" . $player->getName() . ".yml")) {
            new Config(Variables::DIRECTORY . "Players/" . $player->getName() . ".yml", Config::YAML, $this->defaultPlayerData);
            $this->plugin->getLogger()->info(Variables::FILE_CREATED_PREFIX . TF::YELLOW . $player->getName());
        }
        $tutorialComplete = DataManager::getOfflinePlayerData($player, "Players", "tutorial-complete");

        if($tutorialComplete) {
            # teleport to lobby
            $player->teleport(new Position(100, 100, 100, $this->plugin->getServer()->getWorldManager()->getWorldByName("Lobby")));
        } else {
            # teleport to tutorial world
            $player->teleport(new Position(18.5, 111, -12.5, $this->plugin->getServer()->getWorldManager()->getWorldByName("CoalMine"))); # replace with tutorial mine when made
        }
    }

}