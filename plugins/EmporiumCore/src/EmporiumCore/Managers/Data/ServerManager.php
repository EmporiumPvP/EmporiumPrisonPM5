<?php

namespace EmporiumCore\Managers\Data;

use EmporiumCore\EmporiumCore;

use JsonException;
use pocketmine\utils\Config;

class ServerManager {

    # Get Data
    public static function getData($file, $data) {
        $serverFile = new Config(EmporiumCore::getInstance()->getDataFolder() . "Server/" . $file . ".yml", Config::YAML);
        return $serverFile->get($data);
    }

    # Set New Data
    /**
     * @throws JsonException
     */
    public static function setNewData($file, $data, $entry): void {
        $serverFile = new Config(EmporiumCore::getInstance()->getDataFolder() . "Server/" . $file . ".yml", Config::YAML);
        if ($serverFile->get($data) == null) {
            $serverFile->set($data, $entry);
            $serverFile->save();
        }
    }

    # Set Data
    /**
     * @throws JsonException
     */
    public static function setData($file, $data, $entry): void {
        $serverFile = new Config(EmporiumCore::getInstance()->getDataFolder() . "Server/" . $file . ".yml", Config::YAML);
        $serverFile->set($data, $entry);
        $serverFile->save();
    }

    # Add Data
    /**
     * @throws JsonException
     */
    public static function addData($file, $data, $entry): void {
        $serverFile = new Config(EmporiumCore::getInstance()->getDataFolder() . "Server/" . $file . ".yml", Config::YAML);
        $amount = $serverFile->get($data);
        $total = ($entry + $amount);
        $serverFile->set($data, $total);
        $serverFile->save();
    }

    # Take Data
    /**
     * @throws JsonException
     */
    public static function takeData($file, $data, $entry): void {
        $serverFile = new Config(EmporiumCore::getInstance()->getDataFolder() . "Server/" . $file . ".yml", Config::YAML);
        $amount = $serverFile->get($data);
        $total = ($amount - $entry);
        $serverFile->set($data, $total);
        $serverFile->save();
    }

}