<?php

namespace EmporiumData;

class ServerManager
{
    private Loader $plugin;

    private array $data = [];

    private static self $instance;

    public function __construct(Loader $loader)
    {
        self::$instance = $this;
        $this->plugin = $loader;
    }

    public function save () : void
    {
        $this->plugin->provider->saveServerDataAll("serverData", $this->data);
    }

    public function load () : void
    {
        $this->data = $this->plugin->provider->getServerDataAll("serverData");
    }

    public function setData (string $key, mixed $data) : void
    {
        $vars = explode(".", $key);
        $base = array_shift($vars);

        if (!isset($this->data[$base])) $this->data[$base] = [];

        $base = &$this->data[$base];

        while(count($vars) > 0){
            $baseKey = array_shift($vars);
            if(!isset($base[$baseKey])){
                $base[$baseKey] = [];
            }
            $base = &$base[$baseKey];
        }

        $base = $data;
    }

    public function getData (string $key) : mixed
    {
        $vars = explode(".", $key);
        $base = array_shift($vars);

        if (isset($this->data[$base])) $base = $this->data[$base];
        else return false;

        while (count($vars) > 0) {
            $baseKey = array_shift($vars);
            if (is_array($base) && isset($base[$baseKey])) $base = $base[$baseKey];
            else return false;
        }

        return $base;
    }

    public function removeData (string $key) : void
    {
        $vars = explode(".", $key);

        if (!isset($this->data[$key])) return;

        $currentNode = &$this->data[$key];
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

    /**
     * @return ServerManager
     */
    public static function getInstance(): ServerManager
    {
        return self::$instance;
    }
}