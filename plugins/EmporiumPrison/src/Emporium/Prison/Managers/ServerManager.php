<?php

namespace Emporium\Prison\Managers;


use Emporium\Prison\Variables;
use JsonException;

use pocketmine\utils\Config;

class ServerManager {

    public static function getData($folder, $file, $data) {
        $serverFile = new Config(Variables::DIRECTORY . $folder . "/" . $file . ".yml", Config::YAML);
        return $serverFile->get($data);
    }

    /**
     * @throws JsonException
     */
    public static function setNewData($folder, $file, $data, $entry): void
    {
        $serverFile = new Config(Variables::DIRECTORY . $folder . "/" . $file . ".yml", Config::YAML);
        if ($serverFile->get($data) == null) {
            $serverFile->set($data, $entry);
            $serverFile->save();
        }
    }

    /**
     * @throws JsonException
     */
    public static function setData($folder, $file, $data, $entry): void {
        $serverFile = new Config(Variables::DIRECTORY . $folder . "/" . $file . ".yml", Config::YAML);
        $serverFile->set($data, $entry);
        $serverFile->save();
    }

    /**
     * @throws JsonException
     */
    public static function addData($folder, $file, $data, $entry): void {
        $serverFile = new Config(Variables::DIRECTORY . $folder . "/" . $file . ".yml", Config::YAML);
        $amount = $serverFile->get($data);
        $total = ($entry + $amount);
        $serverFile->set($data, $total);
        $serverFile->save();
    }

    /**
     * @throws JsonException
     */
    public static function takeData($folder, $file, $data, $entry): void {
        $serverFile = new Config(Variables::DIRECTORY . $folder . "/" . $file . ".yml", Config::YAML);
        $amount = $serverFile->get($data);
        $total = ($amount - $entry);
        $serverFile->set($data, $total);
        $serverFile->save();
    }

}