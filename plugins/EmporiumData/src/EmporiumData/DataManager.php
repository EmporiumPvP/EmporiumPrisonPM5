<?php

namespace EmporiumData;

use EmporiumData\Provider\JsonProvider;

use JsonException;
use pocketmine\player\Player;
use pocketmine\Server;
use pocketmine\utils\Config;

class DataManager
{
    private array $playerData = [];

    private array $xuids = [];

    private static self $instance;

    private Loader $plugin;

    public function __construct(Loader $loader)
    {
        self::$instance = $this;

        $this->plugin = $loader;
    }

    public function load () : void
    {
        $this->xuids = (new Config(JsonProvider::$PLAYER_FOLDER . "xuid.json", Config::JSON))->getAll();
        foreach ($this->getPlayerNames() as $playerFile) $this->playerData[$playerFile] = $this->plugin->provider->getPlayerDataAll((int)$playerFile);
    }

    /**
     * @throws JsonException
     */
    public function save () : void
    {
        $xuid = new Config(JsonProvider::$PLAYER_FOLDER . "xuid.json", Config::JSON);
        $xuid->setAll($this->xuids);
        $xuid->save();

        foreach ($this->playerData as $xuid => $data) $this->plugin->provider->savePlayerDataAll((int)$xuid, $data);
    }


    public function registerPlayer (Player $player) : void
    {
        $this->playerData[$player->getXuid()] = [];
        $defaults = [
            "profile.level" => 0,
            "profile.xp" => 0,
            "profile.total-xp" => 0,
            "profile.tutorial-complete" => false,
            "profile.tutorial-progress" => 0,
            "profile.tutorial-blocks-mined" => 0,
            "profile.money" => 0,
            "profile.banned" => false,
            "profile.muted" => false,
            "profile.frozen" => false,
            "profile.rank" => "player",
            "profile.rank_format" => "§8<§7Player§8>§r",
            "profile.tag" => "tag",
            "profile.cexp" => 0,
            "profile.prestige" => 0,
            "profile.online_time" => 27,
            "anticheat.anti_auto" => 0,
            "anticheat.anti_nuke" => 0,
            "anticheat.auto_warn" => 0,
            "anticheat.nuke_warn" => 0,
            "boosters.mining-booster-active" => false,
            "boosters.mining-booster-timer" => 0,
            "boosters.mining-booster-multiplier" => 0,
            "boosters.energy-booster-active" => false,
            "boosters.energy-booster-timer" => 0,
            "boosters.energy-booster-multiplier" => 0,
            "cooldown.gkit_heroic_vulkarion" => 0,
            "cooldown.gkit_heroic_zenith" => 0,
            "cooldown.gkit_heroic_colossus" => 0,
            "cooldown.gkit_heroic_warlock" => 0,
            "cooldown.gkit_heroic_slaughter" => 0,
            "cooldown.gkit_heroic_enchanter" => 0,
            "cooldown.gkit_heroic_atheos" => 0,
            "cooldown.gkit_heroic_iapetus" => 0,
            "cooldown.gkit_heroic_broteas" => 0,
            "cooldown.gkit_heroic_ares" => 0,
            "cooldown.gkit_heroic_grim_reaper" => 0,
            "cooldown.gkit_heroic_heroic_executioner" => 0,
            "cooldown.gkit_blacksmith" => 0,
            "cooldown.gkit_hero" => 0,
            "cooldown.gkit_cyborg" => 0,
            "cooldown.gkit_crucible" => 0,
            "cooldown.gkit_hunter" => 0,
            "cooldown.prestige_kit1" => 0,
            "cooldown.prestige_kit2" => 0,
            "cooldown.prestige_kit3" => 0,
            "cooldown.prestige_kit4" => 0,
            "cooldown.prestige_kit5" => 0,
            "cooldown.rank_kit_noble" => 0,
            "cooldown.rank_kit_imperial" => 0,
            "cooldown.rank_kit_supreme" => 0,
            "cooldown.rank_kit_majesty" => 0,
            "cooldown.rank_kit_emperor" => 0,
            "cooldown.rank_kit_president" => 0,
            "permissions" => []
        ];

        foreach ($defaults as $key => $value) $this->setPlayerData($player->getXuid(), $key, $value);

        $this->plugin->provider->savePlayerDataAll($player->getXuid(), $this->playerData[$player->getXuid()]);
        $this->xuids[$player->getName()] = $player->getXuid();
    }

    public function setPlayerData (string $xuid, string $key, mixed $data) : void
    {
        $vars = explode(".", $key);
        $base = array_shift($vars);

        if (!isset($this->playerData[$xuid])) $this->playerData[$xuid] = [];

        if(!isset($this->playerData[$xuid][$base])){
            $this->playerData[$xuid][$base] = [];
        }

        $base = &$this->playerData[$xuid][$base];

        while(count($vars) > 0){
            $baseKey = array_shift($vars);
            if(!isset($base[$baseKey])){
                $base[$baseKey] = [];
            }
            $base = &$base[$baseKey];
        }

        $base = $data;
    }

    public function getPlayerData (string $xuid, string $key) : mixed
    {
        if (isset($this->playerData[$xuid][$key])) return $this->playerData[$xuid][$key];

        $vars = explode(".", $key);
        $base = array_shift($vars);

        if (isset($this->playerData[$xuid][$base])) $base = $this->playerData[$xuid][$base];
        else return null;

        while (count($vars) > 0) {
            $baseKey = array_shift($vars);
            if (is_array($base) && isset($base[$baseKey])){
                $base = $base[$baseKey];
            }
            else return null;
        }

        return $base;
    }

    public function removePlayerData (string $xuid, string $key) : void
    {
        $vars = explode(".", $key);

        $currentNode = &$this->playerData[$xuid];
        while(count($vars) > 0){
            $nodeName = array_shift($vars);
            if(isset($currentNode[$nodeName])){
                if(count($vars) === 0){ //final node
                    unset($currentNode[$nodeName]);
                }elseif(is_array($currentNode[$nodeName])){
                    $currentNode = &$currentNode[$nodeName];
                }
            }else{
                break;
            }
        }
    }

    public function getPlayerByXuid (string $xuid) : ?Player
    {
        if (in_array($xuid, $this->xuids)){
            if (($player = Server::getInstance()->getPlayerExact(array_search($xuid, $this->xuids))) != null) return $player;
            return null;
        }

        return null;
    }


    public function isNew (Player $player) : bool
    {
        return !isset($this->playerData[$player->getXuid()]);
    }

    public function getPlayerXuid (string $name) : string
    {
        return $this->xuids[$name] ?? "00";
    }

    public function getPlayerNames () : array
    {
        $files = scandir(JsonProvider::$PLAYER_FOLDER);

        $playerFolders = [];
        foreach ($files as $file) if (!in_array($file, [".", "..", "xuid.json", false])) $playerFolders[] = str_replace(".json", "", $file);

        return $playerFolders;
    }

    public static function getInstance () : self
    {
        return self::$instance;
    }
}