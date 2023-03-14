<?php

namespace Emporium\Prison\Managers;

use Emporium\Prison\EmporiumPrison;

use JsonException;

use pocketmine\player\Player;
use pocketmine\utils\Config;

class DataManager {

    /**
     * @throws JsonException
     */
    public static function setNewData($player, string $folder, string $data, $entry): void {
        $file = new Config(EmporiumPrison::getInstance()->getDataFolder() . $folder . "/" . $player . ".yml", Config::YAML);
        if($file->get($data) == null) {
            $file->set($data, $entry);
            $file->save();
        }
    }

    /**
     * @throws JsonException
     */
    public static function setData(Player $player, string $folder, string $data, $entry): void {
        $name = $player->getName();
        $file = new Config(EmporiumPrison::getInstance()->getDataFolder() . $folder . "/" . $name . ".yml", Config::YAML);
        $file->set($data, $entry);
        $file->save();
    }

    public static function getData(Player $player, string $folder, string $data) {
        $name = $player->getName();
        $file = new Config(EmporiumPrison::getInstance()->getDataFolder() . $folder . "/" . $name . ".yml", Config::YAML);
        #$file = new Config(Variables::DIRECTORY . $folder . "/" . $name . ".yml", Config::YAML);
        return $file->get($data);
    }

    /**
     * @throws JsonException
     */
    public static function addData(Player $player, string $folder, string $data, $entry): void {
        $name = $player->getName();
        $file = new Config(EmporiumPrison::getInstance()->getDataFolder() . $folder . "/" . $name . ".yml", Config::YAML);
        $amount = $file->get($data);
        $total = $amount + $entry;
        $file->set($data, $total);
        $file->save();
    }

    /**
     * @throws JsonException
     */
    public static function takeData(Player $player, string $folder, string $data, $entry): void {
        $name = $player->getName();
        $file = new Config(EmporiumPrison::getInstance()->getDataFolder() . $folder . "/" . $name . ".yml", Config::YAML);
        $amount = $file->get($data);
        $total = $amount - $entry;
        $file->set($data, $total);
        $file->save();
    }

    public static function getOfflinePlayerData($player, string $folder, string $data) {
        $file = new Config(EmporiumPrison::getInstance()->getDataFolder() . $folder . "/" . $player . ".yml", Config::YAML);
        return $file->get($data);
    }

    /**
     * @throws JsonException
     */
    public static function setOfflinePlayerData($player, string $folder, string $data, $entry): void {
        $file = new Config(EmporiumPrison::getInstance()->getDataFolder() . $folder . "/" . $player . ".yml", Config::YAML);
        $file->set($data, $entry);
        $file->save();
    }

    /**
     * @throws JsonException
     */
    public static function addOfflinePlayerData($player, string $folder, string $data, $entry): void {
        $file = new Config(EmporiumPrison::getInstance()->getDataFolder() . $folder . "/" . $player . ".yml", Config::YAML);
        $amount = $file->get($data);
        $total = $amount + $entry;
        $file->set($data, $total);
        $file->save();
    }

    /**
     * @throws JsonException
     */
    public static function takeOfflinePlayerData($player, string $folder, string $data, $entry): void {
        $file = new Config(EmporiumPrison::getInstance()->getDataFolder() . $folder . "/" . $player . ".yml", Config::YAML);
        $amount = $file->get($data);
        $total = $amount - $entry;
        $file->set($data, $total);
        $file->save();
    }
}