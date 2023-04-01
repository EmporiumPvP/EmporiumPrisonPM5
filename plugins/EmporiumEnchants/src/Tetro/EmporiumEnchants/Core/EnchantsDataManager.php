<?php

namespace Tetro\EmporiumEnchants\Core;

use JsonException;

use pocketmine\utils\Config;
use Tetro\EmporiumEnchants\EmporiumEnchants;

class EnchantsDataManager {

    # Get Data
    public static function getData($folder, $file, $data) {
        $sfile = new Config(EmporiumEnchants::getInstance()->getDataFolder() . $folder . "/" . $file . ".yml", Config::YAML);
        return $sfile->get($data);
    }

    # Set New Data

    /**
     * @throws JsonException
     */
    public static function setNewData($folder, $file, $data, $entry): void
    {
        $sfile = new Config(EmporiumEnchants::getInstance()->getDataFolder() . $folder . "/" . $file . ".yml", Config::YAML);
        if ($sfile->get($data) == null) {
            $sfile->set($data, $entry);
            $sfile->save();
        }
    }

    # Set Data

    /**
     * @throws JsonException
     */
    public static function setData($folder, $file, $data, $entry): void
    {
        $sfile = new Config(EmporiumEnchants::getInstance()->getDataFolder() . $folder . "/" . $file . ".yml", Config::YAML);
        $sfile->set($data, $entry);
        $sfile->save();
    }

    # Add Data

    /**
     * @throws JsonException
     */
    public static function addData($folder, $file, $data, $entry): void
    {
        $sfile = new Config(EmporiumEnchants::getInstance()->getDataFolder() . $folder . "/" . $file . ".yml", Config::YAML);
        $amount = $sfile->get($data);
        $total = ($entry + $amount);
        $sfile->set($data, $total);
        $sfile->save();
    }

    # Take Data

    /**
     * @throws JsonException
     */
    public static function takeData($folder, $file, $data, $entry): void
    {
        $sfile = new Config(EmporiumEnchants::getInstance()->getDataFolder() . $folder . "/" . $file . ".yml", Config::YAML);
        $amount = $sfile->get($data);
        $total = ($amount - $entry);
        $sfile->set($data, $total);
        $sfile->save();
    }

}