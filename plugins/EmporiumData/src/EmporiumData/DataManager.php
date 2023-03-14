<?php

namespace EmporiumData;

use EmporiumData\Provider\JsonProvider;
use EmporiumData\Provider\ProviderInterface;
use pocketmine\player\Player;
use pocketmine\utils\Config;

class DataManager
{
    private array $playerData = [];

    private array $xuids = [];

    private ProviderInterface $provider;

    private static self $instance;

    public function __construct(Loader $loader)
    {
        self::$instance = $this;
        $this->provider = new JsonProvider($loader);
    }

    public function loadData (): void
    {
        $this->xuids = (new Config(JsonProvider::$PLAYER_FOLDER . "xuid.json", Config::JSON))->getAll();

        foreach ($this->getPlayerNames() as $playerFile) $this->playerData[$playerFile] = $this->provider->getPlayerDataAll((int)$playerFile);
    }

    public function saveData (): void
    {
        $xuid = new Config(JsonProvider::$PLAYER_FOLDER . "xuid.json", Config::JSON);
        $xuid->setAll($this->xuids);
        $xuid->save();

        foreach ($this->playerData as $xuid => $data) $this->provider->savePlayerDataAll((int)$xuid, $data);
    }


    public function registerPlayer (Player $player) : void
    {
        $this->playerData[$player->getXuid()] = [
            "name" => $player->getName(),
            "level" => 1
        ];

        $this->provider->savePlayerDataAll($player->getXuid(), $this->playerData[$player->getXuid()]);
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
        $vars = explode(".", $key);
        $base = array_shift($vars);

        if (isset($this->playerData[$xuid][$base])) $base = $this->playerData[$xuid][$base];
        else return false;

        while (count($vars) > 0) {
            $baseKey = array_shift($vars);
            if (is_array($base) && isset($base[$baseKey])) $base = $base[$baseKey];
            else return false;
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

    public function isNew (Player $player) : bool
    {
        return !isset($this->playerData[$player->getXuid()]);
    }

    private function getPlayerNames () : array
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