<?php

# Namespace
namespace EmporiumCore\Managers\Data;

use EmporiumCore\EmporiumCore;
use JsonException;

use pocketmine\utils\Config;
use pocketmine\player\Player;

class DataManager {

    # Set New Data
    /**
     * @throws JsonException
     */
    public static function setNewData($player, string $folder, string $data, $entry): void {
        $file = new Config(EmporiumCore::getInstance()->getDataFolder() . "PlayerData/" . $folder . "/" . $player . ".yml", Config::YAML);
        if ($file->get($data) == null) {
            $file->set($data, $entry);
            $file->save();
        }
    }

    # Get Data
    public static function getData(Player $player, string $folder, string $data) {
        $name = $player->getName();
        $file = new Config(EmporiumCore::getInstance()->getDataFolder() . "PlayerData/" . $folder . "/" . $name . ".yml", Config::YAML);
        return $file->get($data);
    }

    # Set Data

    /**
     * @throws JsonException
     */
    public static function setData(Player $player, string $folder, string $data, $entry): void {
        $name = $player->getName();
        $file = new Config(EmporiumCore::getInstance()->getDataFolder() . "PlayerData/" . $folder . "/" . $name . ".yml", Config::YAML);
        $file->set($data, $entry);
        $file->save();
    }

    # Add Data

    /**
     * @throws JsonException
     */
    public static function addData(Player $player, string $folder, string $data, $entry): void {
        $name = $player->getName();
        $file = new Config(EmporiumCore::getInstance()->getDataFolder() . "PlayerData/" . $folder . "/" . $name . ".yml", Config::YAML);
        $amount = $file->get($data);
        $total = ($entry + $amount);
        $file->set($data, $total);
        $file->save();
    }

    # Take Data

    /**
     * @throws JsonException
     */
    public static function takeData(Player $player, string $folder, string $data, $entry): void {
        $name = $player->getName();
        $file = new Config(EmporiumCore::getInstance()->getDataFolder() . "PlayerData/" . $folder . "/" . $name . ".yml", Config::YAML);
        $amount = $file->get($data);
        $total = ($amount - $entry);
        $file->set($data, $total);
        $file->save();
    }

    # Get No-Player Data
    public static function getOfflinePlayerData($player, string $folder, string $data) {
        $file = new Config(EmporiumCore::getInstance()->getDataFolder() . "PlayerData/" . $folder . "/" . $player . ".yml", Config::YAML);
        return $file->get($data);
    }

    # Set No-Player Data

    /**
     * @throws JsonException
     */
    public static function setOfflinePlayerData($player, string $folder, string $data, $entry): void {
        $file = new Config(EmporiumCore::getInstance()->getDataFolder() . "PlayerData/" . $folder . "/" . $player . ".yml", Config::YAML);
        $file->set($data, $entry);
        $file->save();
    }

    # Add No-Player Data

    /**
     * @throws JsonException
     */
    public static function addOfflinePlayerData($player, string $folder, string $data, $entry): void {
        $file = new Config(EmporiumCore::getInstance()->getDataFolder() . "PlayerData/" . $folder . "/" . $player . ".yml", Config::YAML);
        $amount = $file->get($data);
        $total = ($entry + $amount);
        $file->set($data, $total);
        $file->save();
    }

    # Take No-Player Data

    /**
     * @throws JsonException
     */
    public static function takeOfflinePlayerData($player, string $folder, string $data, $entry): void {
        $file = new Config(EmporiumCore::getInstance()->getDataFolder() . "PlayerData/" . $folder . "/" . $player . ".yml", Config::YAML);
        $amount = $file->get($data);
        $total = ($amount - $entry);
        $file->set($data, $total);
        $file->save();
    }
}