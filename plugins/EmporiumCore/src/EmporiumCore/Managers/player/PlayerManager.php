<?php

namespace EmporiumCore\managers\player;

use EmporiumCore\EmporiumCore;

use EmporiumCore\managers\data\DataManager;
use EmporiumCore\Variables;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerPreLoginEvent;

use pocketmine\utils\Config;

class PlayerManager implements Listener {

    private array $defaultPlayerData = [
        "Banned" => false,
        "Muted" => false,
        "Frozen" => false,
        "Rank" => "Player",
        "RankFormat" => "§8<§7Player§8>§r",
        "Money" => 0,
        "Cexp" => 0,
        "Prestige" => 0,
        "OnlineTime" => 0,
        "AntiAuto" => 0,
        "AntiNuke" => 0,
    ];
    private array $defaultTagsData = [
        "vampire" => false,
        "noob" => false,
        "weeb" => false,
        "dodo" => false,
        "2ez" => false,
        "pvpgod" => false,
        "otaku" => false,
        "emporium" => false,
        "daddy" => false,
        "tryhard" => false,
        "alpha" => true,
    ];

    private array $defaultPermissionsData = [
    "emporiumcore.command.balance" => true,
    "emporiumcore.command.brag" => true,
    "emporiumcore.command.discord" => true,
    "emporiumcore.command.gamble" => true,
    "emporiumcore.command.gkits" => true,
    "emporiumcore.command.kits" => true,
    "emporiumcore.command.pay" => true,
    "emporiumcore.command.prestige" => true,
    "emporiumcore.command.prestigepanel" => false,
    "emporiumcore.command.ranks" => true,
    "emporiumcore.command.rules" => true,
    "emporiumcore.command.shop" => true,
    "emporiumcore.command.tags" => true,
    "emporiumcore.command.tell" => true,
    "emporiumcore.command.tpask" => true,
    "emporiumcore.command.trash" => true,
    "emporiumcore.command.voteshop" => true,
    "emporiumprison.command.help" => true,
    "emporiumprison.command.mines" => true,
    "emporiumprison.command.playerlevel" => true,
    "emporiumprison.command.spawn" => true,
    "emporiumprison.command.tourguide" => false,
    "emporiumenchants.command.enchant" => false,
    "emporiumenchants.command.info" => true,
    "emporiumenchants.command.list" => true,
    "emporiumenchants.command.remove" => false,
    # rank Commands
    "emporiumcore.command.feed" => false,
    "emporiumcore.command.heal" => false,
    "emporiumcore.command.clear" => false,
    "emporiumcore.command.sell" => false,
    "emporiumcore.command.ceshop" => false,
    "emporiumprison.command.oreexchanger" => false,
    "emporiumprison.command.blacksmith" => false,
    "emporiumprison.command.wormhole" => false,
    "emporiumtinker.command.tinker" => false,
    # staff Commands
    "emporiumcore.command.ban" => false,
    "emporiumcore.command.broadcast" => false,
    "emporiumcore.command.clearchat" => false,
    "emporiumcore.command.creative" => false,
    "emporiumcore.command.freeze" => false,
    "emporiumcore.command.items" => false,
    "emporiumcore.command.key" => false,
    "emporiumcore.command.kick" => false,
    "emporiumcore.command.kill" => false,
    "emporiumcore.command.mute" => false,
    "emporiumcore.command.ranks.set" => false,
    "emporiumcore.command.survival" => false,
    "emporiumcore.command.teleport" => false,
    "emporiumcore.command.unban" => false,
    "emporiumcore.command.unfreeze" => false,
    "emporiumcore.command.unmute" => false,
    "emporiumcore.command.warn" => false,
    "invsee.command.invsee" => false,
    "invsee.command.enderinvsee" => false,
    "invsee.inventory.view" => false,
    "invsee.inventory.modify" => false,
    "invsee.enderinventory.view" => false,
    "invsee.enderinventory.modify" => false,
    "emporiumprison.command.npc" => false,
    "emporiumprison.command.booster" => false,
    "emporiumprison.command.energy" => false,
    "emporiumprison.command.flare" => false,
    # rank kits
    "emporiumcore.rankkit.noble" => false,
    "emporiumcore.rankkit.imperial" => false,
    "emporiumcore.rankkit.supreme" => false,
    "emporiumcore.rankkit.majesty" => false,
    "emporiumcore.rankkit.emperor" => false,
    "emporiumcore.rankkit.president" => false,
    # gkits
    "emporiumcore.gkit.heroicvulkarion" => false,
    "emporiumcore.gkit.heroiczenith" => false,
    "emporiumcore.gkit.heroiccolossus" => false,
    "emporiumcore.gkit.heroicwarlock" => false,
    "emporiumcore.gkit.heroicslaughter" => false,
    "emporiumcore.gkit.heroicenchanter" => false,
    "emporiumcore.gkit.heroicatheos" => false,
    "emporiumcore.gkit.heroiciapetus" => false,
    "emporiumcore.gkit.heroicbroteas" => false,
    "emporiumcore.gkit.heroicares" => false,
    "emporiumcore.gkit.heroicgrimreaper" => false,
    "emporiumcore.gkit.heroicexecutioner" => false,
    "emporiumcore.gkit.blacksmith" => false,
    "emporiumcore.gkit.hero" => false,
    "emporiumcore.gkit.cyborg" => false,
    "emporiumcore.gkit.crucible" => false,
    "emporiumcore.gkit.hunter" => false,
    # prestige kits
    "emporiumcore.prestigekit.prestige1" => false,
    "emporiumcore.prestigekit.prestige2" => false,
    "emporiumcore.prestigekit.prestige3" => false,
    "emporiumcore.prestigekit.prestige4" => false,
    "emporiumcore.prestigekit.prestige5" => false,
    # vaults
    "playervaults.vault.1" => true,
    "playervaults.vault.2" => false,
    "playervaults.vault.3" => false,
    "playervaults.vault.4" => false,
    "playervaults.vault.5" => false,
    "playervaults.vault.6" => false,
    "playervaults.vault.7" => false,
    "playervaults.vault.8" => false,
    "playervaults.vault.9" => false
    ];

    public function onLogin(PlayerPreLoginEvent $event) {

        $player = $event->getPlayerInfo();
        $playerName = $player->getUsername();
        # create player file
        @mkdir(EmporiumCore::getInstance()->getDataFolder() . "PlayerData/Players/");
        if(!file_exists(EmporiumCore::getInstance()->getDataFolder() . "PlayerData/Players/" . $playerName . ".yml")) {
            new Config(EmporiumCore::getInstance()->getDataFolder() . "PlayerData/Players/" . $playerName . ".yml", Config::YAML, $this->defaultPlayerData);
        }
        # create player tags file
        @mkdir(EmporiumCore::getInstance()->getDataFolder() . "PlayerData/Tags/");
        if(!file_exists(EmporiumCore::getInstance()->getDataFolder() . "PlayerData/Tags/" . $playerName . ".yml")) {
            new Config(EmporiumCore::getInstance()->getDataFolder() . "PlayerData/Tags/" . $playerName . ".yml", Config::YAML, $this->defaultTagsData);
        }
        # create player permissions file
        @mkdir(EmporiumCore::getInstance()->getDataFolder() . "PlayerData/Permissions/");
        if(!file_exists(EmporiumCore::getInstance()->getDataFolder() . "PlayerData/Permissions/" . $playerName . ".yml")) {
            new Config(EmporiumCore::getInstance()->getDataFolder() . "PlayerData/Permissions/" . $playerName . ".yml", Config::YAML, $this->defaultPermissionsData);
        }
        # create player cooldowns file
        @mkdir(EmporiumCore::getInstance()->getDataFolder() . "PlayerData/Cooldowns/");
        if(!file_exists(EmporiumCore::getInstance()->getDataFolder() . "PlayerData/Cooldowns/" . $playerName . ".yml")) {
            new Config(EmporiumCore::getInstance()->getDataFolder() . "PlayerData/Cooldowns/" . $playerName . ".yml", Config::YAML);
        }

        if(file_exists(EmporiumCore::getInstance()->getDataFolder() . "PlayerData/Players/" . $playerName . ".yml")) {
            $isBanned = DataManager::getOfflinePlayerData($playerName, "Players", "Banned");
            if($isBanned) {
                $event->setKickReason(PlayerPreLoginEvent::KICK_REASON_BANNED, Variables::BAN_HEADER);
            }
        }
    }
}