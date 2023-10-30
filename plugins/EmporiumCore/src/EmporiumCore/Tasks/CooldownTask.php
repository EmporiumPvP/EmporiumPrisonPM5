<?php

namespace EmporiumCore\Tasks;

use EmporiumCore\EmporiumCore;
use EmporiumCore\Variables;
use EmporiumData\DataManager;

use pocketmine\scheduler\Task;
use pocketmine\utils\TextFormat;

class CooldownTask extends Task {

    # Task Constructor
    private EmporiumCore $plugin;

    public function __construct(EmporiumCore $plugin) {
        $this->plugin = $plugin;
	}

    # Get all Players
	function getPlayers(): array
    {
		return DataManager::getInstance()->getPlayerNames();
	}

    # Task Execution
    public function onRun(): void {

        // For all Files
        foreach (DataManager::getInstance()->getPlayerNames() as $player) {

            $ban = (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.ban");
            $freeze = (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.freeze");
            $mute = (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.mute");

            # Set Punishments
            DataManager::getInstance()->setPlayerData($player, "anticheat.anti_auto", 0);

            // Check for Punishment
            if ($ban === 0) {
                DataManager::getInstance()->setPlayerData($player, "profile.banned", false);
            }
            if ($mute === 0) {
                DataManager::getInstance()->setPlayerData($player, "profile.muted", false);
            }

            # none command cooldowns
            foreach (DataManager::getInstance()->getPlayerData($player, "cooldown") as $cooldownStr => $value) {
                if($cooldownStr == "command") continue;
                if ($value > 0) DataManager::getInstance()->setPlayerData($player, "cooldown." . $cooldownStr, $value - 1);
            }

            # command cooldowns
            foreach (DataManager::getInstance()->getPlayerData($player, "cooldown.command") as $cooldownStr => $value) {
                if ($value > 0) DataManager::getInstance()->setPlayerData($player, "cooldown.command." . $cooldownStr, $value - 1);
            }

        }

        // For all Online Players
        foreach ($this->plugin->getServer()->getOnlinePlayers() as $player) {

            # Variables
            $antispam = (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.anti_spam");

            // Combat
            $apples = (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.apples");
            $pearls = (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.pearls");
            $combat = (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.combat");
            // Punishment
            $mute = (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.mute");

            # Send Alerts
            // Combat
            if ($apples === 1) {
                $player->sendMessage(Variables::SERVER_PREFIX . "§r§7Your apple cooldown has ended");
            }
            if ($pearls === 1) {
                $player->sendMessage(Variables::SERVER_PREFIX . "§r§7Your enderpearl cooldown has ended");
            }
            if ($combat === 1) {
                $player->sendMessage(Variables::SERVER_PREFIX . "§r§7You are no longer in combat");
            }
            // Punishment
            if ($mute === 1) {
                $player->sendMessage(Variables::SERVER_PREFIX . "§r§7You are no longer muted");
            }
            if($antispam === 1) {
                $player->sendMessage(Variables::SERVER_PREFIX . TextFormat::GRAY . "You can now talk in chat");
            }
        }
    }
}