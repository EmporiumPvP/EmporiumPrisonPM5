<?php

namespace EmporiumCore\managers\data;

use JsonException;
use pocketmine\player\Player;

class PermissionManager {

    /**
     * @throws JsonException
     */
    public static function setOnlinePlayerDefaultPermissions(Player $player): void {
        # default Commands
        DataManager::setData($player, "Permissions", "emporiumcore.command.balance", true);
        DataManager::setData($player, "Permissions", "emporiumcore.command.brag", true);
        DataManager::setData($player, "Permissions", "emporiumcore.command.discord", true);
        DataManager::setData($player, "Permissions", "emporiumcore.command.gamble", true);
        DataManager::setData($player, "Permissions", "emporiumcore.command.kits", true);
        DataManager::setData($player, "Permissions", "emporiumcore.command.gkits", true);
        DataManager::setData($player, "Permissions", "emporiumcore.command.pay", true);
        DataManager::setData($player, "Permissions", "emporiumcore.command.prestige", true);
        DataManager::setData($player, "Permissions", "emporiumcore.command.prestigepanel", false);
        DataManager::setData($player, "Permissions", "emporiumcore.command.ranks", true);
        DataManager::setData($player, "Permissions", "emporiumcore.command.rules", true);
        DataManager::setData($player, "Permissions", "emporiumcore.command.shop", true);
        DataManager::setData($player, "Permissions", "emporiumcore.command.tags", true);
        DataManager::setData($player, "Permissions", "emporiumcore.command.tell", true);
        DataManager::setData($player, "Permissions", "emporiumcore.command.tpask", true);
        DataManager::setData($player, "Permissions", "emporiumcore.command.trash", true);
        DataManager::setData($player, "Permissions", "emporiumcore.command.voteshop", true);
        DataManager::setData($player, "Permissions", "emporiumprison.command.help", true);
        DataManager::setData($player, "Permissions", "emporiumprison.command.spawn", true);
        DataManager::setData($player, "Permissions", "emporiumprison.command.tourguide", false);
        DataManager::setData($player, "Permissions", "emporiumprison.command.mines", true);
        # rank Commands
        DataManager::setData($player, "Permissions", "emporiumcore.command.feed", false);
        DataManager::setData($player, "Permissions", "emporiumcore.command.heal", false);
        DataManager::setData($player, "Permissions", "emporiumcore.command.clear", false);
        DataManager::setData($player, "Permissions", "emporiumcore.command.sell", false);
        DataManager::setData($player, "Permissions", "emporiumprison.command.oremerchant", false);
        DataManager::setData($player, "Permissions", "emporiumprison.command.blacksmith", false);
        # staff Commands
        DataManager::setData($player, "Permissions", "emporiumcore.command.ban", false);
        DataManager::setData($player, "Permissions", "emporiumcore.command.broadcast", false);
        DataManager::setData($player, "Permissions", "emporiumcore.command.clearchat", false);
        DataManager::setData($player, "Permissions", "emporiumcore.command.creative", false);
        DataManager::setData($player, "Permissions", "emporiumcore.command.freeze", false);
        DataManager::setData($player, "Permissions", "emporiumcore.command.items", false);
        DataManager::setData($player, "Permissions", "emporiumcore.command.key", false);
        DataManager::setData($player, "Permissions", "emporiumcore.command.kick", false);
        DataManager::setData($player, "Permissions", "emporiumcore.command.kill", false);
        DataManager::setData($player, "Permissions", "emporiumcore.command.mute", false);
        DataManager::setData($player, "Permissions", "emporiumcore.command.ranks.set", false);
        DataManager::setData($player, "Permissions", "emporiumcore.command.survival", false);
        DataManager::setData($player, "Permissions", "emporiumcore.command.teleport", false);
        DataManager::setData($player, "Permissions", "emporiumcore.command.unban", false);
        DataManager::setData($player, "Permissions", "emporiumcore.command.unfreeze", false);
        DataManager::setData($player, "Permissions", "emporiumcore.command.unmute", false);
        DataManager::setData($player, "Permissions", "emporiumcore.command.warn", false);
        DataManager::setData($player, "Permissions", "invsee.command.invsee", false);
        DataManager::setData($player, "Permissions", "invsee.command.enderinvsee", false);
        DataManager::setData($player, "Permissions", "invsee.inventory.view", false);
        DataManager::setData($player, "Permissions", "invsee.inventory.modify", false);
        DataManager::setData($player, "Permissions", "invsee.enderinventory.view", false);
        DataManager::setData($player, "Permissions", "invsee.enderinventory.modify", false);
        DataManager::setData($player, "Permissions", "emporiumprison.command.npc", false);
        DataManager::setData($player, "Permissions", "emporiumprison.command.booster", false);
        DataManager::setData($player, "Permissions", "emporiumprison.command.energy", false);
        DataManager::setData($player, "Permissions", "emporiumprison.command.flare", false);
        # rank kits
        DataManager::setData($player, "Permissions", "emporiumcore.rankkit.noble", false);
        DataManager::setData($player, "Permissions", "emporiumcore.rankkit.imperial", false);
        DataManager::setData($player, "Permissions", "emporiumcore.rankkit.supreme", false);
        DataManager::setData($player, "Permissions", "emporiumcore.rankkit.majesty", false);
        DataManager::setData($player, "Permissions", "emporiumcore.rankkit.emperor", false);
        DataManager::setData($player, "Permissions", "emporiumcore.rankkit.president", false);
        # gkits
        DataManager::setData($player, "Permissions", "emporiumcore.gkit.heroicvulkarion", false);
        DataManager::setData($player, "Permissions", "emporiumcore.gkit.heroiczenith", false);
        DataManager::setData($player, "Permissions", "emporiumcore.gkit.heroiccolossus", false);
        DataManager::setData($player, "Permissions", "emporiumcore.gkit.heroicwarlock", false);
        DataManager::setData($player, "Permissions", "emporiumcore.gkit.heroicslaughter", false);
        DataManager::setData($player, "Permissions", "emporiumcore.gkit.heroicenchanter", false);
        DataManager::setData($player, "Permissions", "emporiumcore.gkit.heroicatheos", false);
        DataManager::setData($player, "Permissions", "emporiumcore.gkit.heroiciapetus", false);
        DataManager::setData($player, "Permissions", "emporiumcore.gkit.heroicbroteas", false);
        DataManager::setData($player, "Permissions", "emporiumcore.gkit.heroicares", false);
        DataManager::setData($player, "Permissions", "emporiumcore.gkit.heroicgrimreaper", false);
        DataManager::setData($player, "Permissions", "emporiumcore.gkit.heroicexecutioner", false);
        DataManager::setData($player, "Permissions", "emporiumcore.gkit.blacksmith", false);
        DataManager::setData($player, "Permissions", "emporiumcore.gkit.hero", false);
        DataManager::setData($player, "Permissions", "emporiumcore.gkit.cyborg", false);
        DataManager::setData($player, "Permissions", "emporiumcore.gkit.crucible", false);
        DataManager::setData($player, "Permissions", "emporiumcore.gkit.hunter", false);
        # prestige kits
        DataManager::setData($player, "Permissions", "emporiumcore.prestigekit.prestige1", false);
        DataManager::setData($player, "Permissions", "emporiumcore.prestigekit.prestige2", false);
        DataManager::setData($player, "Permissions", "emporiumcore.prestigekit.prestige3", false);
        DataManager::setData($player, "Permissions", "emporiumcore.prestigekit.prestige4", false);
        DataManager::setData($player, "Permissions", "emporiumcore.prestigekit.prestige5", false);
    }

    /**
     * @throws JsonException
     */
    public static function setOfflinePlayerDefaultPermissions($player): void {
        # default Commands
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.balance", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.brag", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.discord", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.gamble", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.kits", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.gkits", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.pay", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.prestige", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.prestigepanel", false);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.ranks", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.rules", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.shop", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.tags", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.tell", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.tpask", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.trash", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.voteshop", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumprison.command.help", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumprison.command.tourguide", false);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumprison.command.spawn", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumprison.command.mines", true);
        # rank Commands
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.feed", false);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.heal", false);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.clear", false);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.sell", false);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumprison.command.oremerchant", false);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumprison.command.blacksmith", false);
        # staff Commands
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.ban", false);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.broadcast", false);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.clearchat", false);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.creative", false);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.freeze", false);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.items", false);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.key", false);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.kick", false);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.kill", false);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.mute", false);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.ranks.set", false);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.survival", false);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.teleport", false);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.unban", false);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.unfreeze", false);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.unmute", false);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.warn", false);
        DataManager::setOfflinePlayerData($player, "Permissions", "invsee.command.invsee", false);
        DataManager::setOfflinePlayerData($player, "Permissions", "invsee.command.enderinvsee", false);
        DataManager::setOfflinePlayerData($player, "Permissions", "invsee.inventory.view", false);
        DataManager::setOfflinePlayerData($player, "Permissions", "invsee.inventory.modify", false);
        DataManager::setOfflinePlayerData($player, "Permissions", "invsee.enderinventory.view", false);
        DataManager::setOfflinePlayerData($player, "Permissions", "invsee.enderinventory.modify", false);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumprison.command.npc", false);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumprison.command.booster", false);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumprison.command.energy", false);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumprison.command.flare", false);
        # rank kits
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.rankkit.noble", false);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.rankkit.imperial", false);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.rankkit.supreme", false);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.rankkit.majesty", false);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.rankkit.emperor", false);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.rankkit.president", false);
        # gkits
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.gkit.heroicvulkarion", false);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.gkit.heroiczenith", false);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.gkit.heroiccolossus", false);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.gkit.heroicwarlock", false);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.gkit.heroicslaughter", false);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.gkit.heroicenchanter", false);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.gkit.heroicatheos", false);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.gkit.heroiciapetus", false);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.gkit.heroicbroteas", false);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.gkit.heroicares", false);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.gkit.heroicgrimreaper", false);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.gkit.heroicexecutioner", false);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.gkit.blacksmith", false);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.gkit.hero", false);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.gkit.cyborg", false);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.gkit.crucible", false);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.gkit.hunter", false);
        # prestige kits
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.prestigekit.prestige1", false);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.prestigekit.prestige2", false);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.prestigekit.prestige3", false);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.prestigekit.prestige4", false);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.prestigekit.prestige5", false);
    }

    /**
     * @throws JsonException
     */
    public static function setOnlinePlayerKitPermissions(Player $player, Bool $statement): void {
        # rank kits
        DataManager::setData($player, "Permissions", "emporiumcore.rankkit.noble", $statement);
        DataManager::setData($player, "Permissions", "emporiumcore.rankkit.imperial", $statement);
        DataManager::setData($player, "Permissions", "emporiumcore.rankkit.supreme", $statement);
        DataManager::setData($player, "Permissions", "emporiumcore.rankkit.majesty", $statement);
        DataManager::setData($player, "Permissions", "emporiumcore.rankkit.emperor", $statement);
        DataManager::setData($player, "Permissions", "emporiumcore.rankkit.president", $statement);
        # GKits
        DataManager::setData($player, "Permissions", "emporiumcore.gkit.heroicvulkarion", $statement);
        DataManager::setData($player, "Permissions", "emporiumcore.gkit.heroiczenith", $statement);
        DataManager::setData($player, "Permissions", "emporiumcore.gkit.heroiccolossus", $statement);
        DataManager::setData($player, "Permissions", "emporiumcore.gkit.heroicwarlock", $statement);
        DataManager::setData($player, "Permissions", "emporiumcore.gkit.heroicslaughter", $statement);
        DataManager::setData($player, "Permissions", "emporiumcore.gkit.heroicenchanter", $statement);
        DataManager::setData($player, "Permissions", "emporiumcore.gkit.heroicatheos", $statement);
        DataManager::setData($player, "Permissions", "emporiumcore.gkit.heroiciapetus", $statement);
        DataManager::setData($player, "Permissions", "emporiumcore.gkit.heroicbroteas", $statement);
        DataManager::setData($player, "Permissions", "emporiumcore.gkit.heroicares", $statement);
        DataManager::setData($player, "Permissions", "emporiumcore.gkit.heroicgrimreaper", $statement);
        DataManager::setData($player, "Permissions", "emporiumcore.gkit.heroicexecutioner", $statement);
        DataManager::setData($player, "Permissions", "emporiumcore.gkit.blacksmith", $statement);
        DataManager::setData($player, "Permissions", "emporiumcore.gkit.hero", $statement);
        DataManager::setData($player, "Permissions", "emporiumcore.gkit.cyborg", $statement);
        DataManager::setData($player, "Permissions", "emporiumcore.gkit.crucible", $statement);
        DataManager::setData($player, "Permissions", "emporiumcore.gkit.hunter", $statement);
        # prestige kits
        DataManager::setData($player, "Permissions", "emporiumcore.prestigekit.prestige1", $statement);
        DataManager::setData($player, "Permissions", "emporiumcore.prestigekit.prestige2", $statement);
        DataManager::setData($player, "Permissions", "emporiumcore.prestigekit.prestige3", $statement);
        DataManager::setData($player, "Permissions", "emporiumcore.prestigekit.prestige4", $statement);
        DataManager::setData($player, "Permissions", "emporiumcore.prestigekit.prestige5", $statement);
    }

    /**
     * @throws JsonException
     */
    public static function setOfflinePlayerKitPermissions($player, Bool $statement): void {
        # rank kits
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.rankkit.noble", $statement);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.rankkit.imperial", $statement);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.rankkit.supreme", $statement);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.rankkit.majesty", $statement);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.rankkit.emperor", $statement);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.rankkit.president", $statement);
        # GKits
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.gkit.heroicvulkarion", $statement);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.gkit.heroiczenith", $statement);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.gkit.heroiccolossus", $statement);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.gkit.heroicwarlock", $statement);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.gkit.heroicslaughter", $statement);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.gkit.heroicenchanter", $statement);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.gkit.heroicatheos", $statement);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.gkit.heroiciapetus", $statement);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.gkit.heroicbroteas", $statement);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.gkit.heroicares", $statement);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.gkit.heroicgrimreaper", $statement);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.gkit.heroicexecutioner", $statement);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.gkit.blacksmith", $statement);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.gkit.hero", $statement);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.gkit.cyborg", $statement);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.gkit.crucible", $statement);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.gkit.hunter", $statement);
        # prestige kits
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.prestigekit.prestige1", $statement);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.prestigekit.prestige2", $statement);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.prestigekit.prestige3", $statement);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.prestigekit.prestige4", $statement);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.prestigekit.prestige5", $statement);
    }

    /**
     * @throws JsonException
     */
    public static function setOnlinePlayerStaffPermissions(Player $player, Bool $statement): void {
        # staff Commands
        DataManager::setData($player, "Permissions", "emporiumcore.command.ban", $statement);
        DataManager::setData($player, "Permissions", "emporiumcore.command.broadcast", $statement);
        DataManager::setData($player, "Permissions", "emporiumcore.command.clearchat", $statement);
        DataManager::setData($player, "Permissions", "emporiumcore.command.creative", $statement);
        DataManager::setData($player, "Permissions", "emporiumcore.command.freeze", $statement);
        DataManager::setData($player, "Permissions", "emporiumcore.command.items", $statement);
        DataManager::setData($player, "Permissions", "emporiumcore.command.key", $statement);
        DataManager::setData($player, "Permissions", "emporiumcore.command.kick", $statement);
        DataManager::setData($player, "Permissions", "emporiumcore.command.kill", $statement);
        DataManager::setData($player, "Permissions", "emporiumcore.command.mute", $statement);
        DataManager::setData($player, "Permissions", "emporiumcore.command.ranks.set", $statement);
        DataManager::setData($player, "Permissions", "emporiumcore.command.survival", $statement);
        DataManager::setData($player, "Permissions", "emporiumcore.command.teleport", $statement);
        DataManager::setData($player, "Permissions", "emporiumcore.command.unban", $statement);
        DataManager::setData($player, "Permissions", "emporiumcore.command.unfreeze", $statement);
        DataManager::setData($player, "Permissions", "emporiumcore.command.unmute", $statement);
        DataManager::setData($player, "Permissions", "emporiumcore.command.warn", $statement);
        DataManager::setData($player, "Permissions", "invsee.command.invsee", $statement);
        DataManager::setData($player, "Permissions", "invsee.command.enderinvsee", $statement);
        DataManager::setData($player, "Permissions", "invsee.inventory.view", $statement);
        DataManager::setData($player, "Permissions", "invsee.inventory.modify", $statement);
        DataManager::setData($player, "Permissions", "invsee.enderinventory.view", $statement);
        DataManager::setData($player, "Permissions", "invsee.enderinventory.modify", $statement);
        DataManager::setData($player, "Permissions", "emporiumprison.command.npc", $statement);
        DataManager::setData($player, "Permissions", "emporiumprison.command.booster", $statement);
        DataManager::setData($player, "Permissions", "emporiumprison.command.energy", $statement);
        DataManager::setData($player, "Permissions", "emporiumprison.command.flare", $statement);
    }

    /**
     * @throws JsonException
     */
    public static function setOfflinePlayerStaffPermissions($player, Bool $statement): void {
        # staff Commands
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.ban", $statement);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.broadcast", $statement);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.clearchat", $statement);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.creative", $statement);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.freeze", $statement);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.items", $statement);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.key", $statement);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.kick", $statement);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.kill", $statement);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.mute", $statement);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.ranks.set", $statement);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.survival", $statement);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.teleport", $statement);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.unban", $statement);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.unfreeze", $statement);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.unmute", $statement);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.warn", $statement);
        DataManager::setOfflinePlayerData($player, "Permissions", "invsee.command.invsee", $statement);
        DataManager::setOfflinePlayerData($player, "Permissions", "invsee.command.enderinvsee", $statement);
        DataManager::setOfflinePlayerData($player, "Permissions", "invsee.inventory.view", $statement);
        DataManager::setOfflinePlayerData($player, "Permissions", "invsee.inventory.modify", $statement);
        DataManager::setOfflinePlayerData($player, "Permissions", "invsee.enderinventory.view", $statement);
        DataManager::setOfflinePlayerData($player, "Permissions", "invsee.enderinventory.modify", $statement);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumprison.command.npc", $statement);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumprison.command.booster", $statement);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumprison.command.energy", $statement);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumprison.command.flare", $statement);
    }

    /**
     * @throws JsonException
     */
    public static function setOnlinePlayerAllPermissions(Player $player): void {
        # default Commands
        DataManager::setData($player, "Permissions", "emporiumcore.command.balance", true);
        DataManager::setData($player, "Permissions", "emporiumcore.command.brag", true);
        DataManager::setData($player, "Permissions", "emporiumcore.command.discord", true);
        DataManager::setData($player, "Permissions", "emporiumcore.command.gamble", true);
        DataManager::setData($player, "Permissions", "emporiumcore.command.kits", true);
        DataManager::setData($player, "Permissions", "emporiumcore.command.gkits", true);
        DataManager::setData($player, "Permissions", "emporiumcore.command.pay", true);
        DataManager::setData($player, "Permissions", "emporiumcore.command.prestige", true);
        DataManager::setData($player, "Permissions", "emporiumcore.command.prestigepanel", true);
        DataManager::setData($player, "Permissions", "emporiumcore.command.ranks", true);
        DataManager::setData($player, "Permissions", "emporiumcore.command.rules", true);
        DataManager::setData($player, "Permissions", "emporiumcore.command.shop", true);
        DataManager::setData($player, "Permissions", "emporiumcore.command.tags", true);
        DataManager::setData($player, "Permissions", "emporiumcore.command.tell", true);
        DataManager::setData($player, "Permissions", "emporiumcore.command.tpask", true);
        DataManager::setData($player, "Permissions", "emporiumcore.command.trash", true);
        DataManager::setData($player, "Permissions", "emporiumcore.command.voteshop", true);
        DataManager::setData($player, "Permissions", "emporiumprison.command.help", true);
        DataManager::setData($player, "Permissions", "emporiumprison.command.spawn", true);
        DataManager::setData($player, "Permissions", "emporiumprison.command.tourguide", true);
        DataManager::setData($player, "Permissions", "emporiumprison.command.mines", true);
        # rank Commands
        DataManager::setData($player, "Permissions", "emporiumcore.command.feed", true);
        DataManager::setData($player, "Permissions", "emporiumcore.command.heal", true);
        DataManager::setData($player, "Permissions", "emporiumcore.command.clear", true);
        DataManager::setData($player, "Permissions", "emporiumcore.command.sell", true);
        DataManager::setData($player, "Permissions", "emporiumprison.command.oremerchant", true);
        DataManager::setData($player, "Permissions", "emporiumprison.command.blacksmith", true);
        # staff Commands
        DataManager::setData($player, "Permissions", "emporiumcore.command.ban", true);
        DataManager::setData($player, "Permissions", "emporiumcore.command.broadcast", true);
        DataManager::setData($player, "Permissions", "emporiumcore.command.clearchat", true);
        DataManager::setData($player, "Permissions", "emporiumcore.command.creative", true);
        DataManager::setData($player, "Permissions", "emporiumcore.command.freeze", true);
        DataManager::setData($player, "Permissions", "emporiumcore.command.items", true);
        DataManager::setData($player, "Permissions", "emporiumcore.command.key", true);
        DataManager::setData($player, "Permissions", "emporiumcore.command.kick", true);
        DataManager::setData($player, "Permissions", "emporiumcore.command.kill", true);
        DataManager::setData($player, "Permissions", "emporiumcore.command.mute", true);
        DataManager::setData($player, "Permissions", "emporiumcore.command.ranks.set", true);
        DataManager::setData($player, "Permissions", "emporiumcore.command.survival", true);
        DataManager::setData($player, "Permissions", "emporiumcore.command.teleport", true);
        DataManager::setData($player, "Permissions", "emporiumcore.command.unban", true);
        DataManager::setData($player, "Permissions", "emporiumcore.command.unfreeze", true);
        DataManager::setData($player, "Permissions", "emporiumcore.command.unmute", true);
        DataManager::setData($player, "Permissions", "emporiumcore.command.warn", true);
        DataManager::setData($player, "Permissions", "invsee.command.invsee", true);
        DataManager::setData($player, "Permissions", "invsee.command.enderinvsee", true);
        DataManager::setData($player, "Permissions", "invsee.inventory.view", true);
        DataManager::setData($player, "Permissions", "invsee.inventory.modify", true);
        DataManager::setData($player, "Permissions", "invsee.enderinventory.view", true);
        DataManager::setData($player, "Permissions", "invsee.enderinventory.modify", true);
        DataManager::setData($player, "Permissions", "emporiumprison.command.npc", true);
        DataManager::setData($player, "Permissions", "emporiumprison.command.booster", true);
        DataManager::setData($player, "Permissions", "emporiumprison.command.energy", true);
        DataManager::setData($player, "Permissions", "emporiumprison.command.flare", true);
        # rank kits
        DataManager::setData($player, "Permissions", "emporiumcore.rankkit.noble", true);
        DataManager::setData($player, "Permissions", "emporiumcore.rankkit.imperial", true);
        DataManager::setData($player, "Permissions", "emporiumcore.rankkit.supreme", true);
        DataManager::setData($player, "Permissions", "emporiumcore.rankkit.majesty", true);
        DataManager::setData($player, "Permissions", "emporiumcore.rankkit.emperor", true);
        DataManager::setData($player, "Permissions", "emporiumcore.rankkit.president", true);
        # gkits
        DataManager::setData($player, "Permissions", "emporiumcore.gkit.heroicvulkarion", true);
        DataManager::setData($player, "Permissions", "emporiumcore.gkit.heroiczenith", true);
        DataManager::setData($player, "Permissions", "emporiumcore.gkit.heroiccolossus", true);
        DataManager::setData($player, "Permissions", "emporiumcore.gkit.heroicwarlock", true);
        DataManager::setData($player, "Permissions", "emporiumcore.gkit.heroicslaughter", true);
        DataManager::setData($player, "Permissions", "emporiumcore.gkit.heroicenchanter", true);
        DataManager::setData($player, "Permissions", "emporiumcore.gkit.heroicatheos", true);
        DataManager::setData($player, "Permissions", "emporiumcore.gkit.heroiciapetus", true);
        DataManager::setData($player, "Permissions", "emporiumcore.gkit.heroicbroteas", true);
        DataManager::setData($player, "Permissions", "emporiumcore.gkit.heroicares", true);
        DataManager::setData($player, "Permissions", "emporiumcore.gkit.heroicgrimreaper", true);
        DataManager::setData($player, "Permissions", "emporiumcore.gkit.heroicexecutioner", true);
        DataManager::setData($player, "Permissions", "emporiumcore.gkit.blacksmith", true);
        DataManager::setData($player, "Permissions", "emporiumcore.gkit.hero", true);
        DataManager::setData($player, "Permissions", "emporiumcore.gkit.cyborg", true);
        DataManager::setData($player, "Permissions", "emporiumcore.gkit.crucible", true);
        DataManager::setData($player, "Permissions", "emporiumcore.gkit.hunter", true);
        # prestige kits
        DataManager::setData($player, "Permissions", "emporiumcore.prestigekit.prestige1", true);
        DataManager::setData($player, "Permissions", "emporiumcore.prestigekit.prestige2", true);
        DataManager::setData($player, "Permissions", "emporiumcore.prestigekit.prestige3", true);
        DataManager::setData($player, "Permissions", "emporiumcore.prestigekit.prestige4", true);
        DataManager::setData($player, "Permissions", "emporiumcore.prestigekit.prestige5", true);
    }

    /**
     * @throws JsonException
     */
    public static function setOfflinePlayerAllPermissions($player): void {
        # default Commands
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.balance", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.brag", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.discord", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.gamble", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.kits", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.gkits", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.pay", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.prestige", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.prestigepanel", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.ranks", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.rules", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.shop", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.tags", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.tell", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.tpask", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.trash", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.voteshop", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumprison.command.help", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumprison.command.spawn", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumprison.command.mines", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumprison.command.tourguide", true);
        # rank Commands
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.feed", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.heal", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.clear", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumprison.command.oremerchant", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumprison.command.blacksmith", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumprison.command.sell", true);
        # staff Commands
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.ban", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.broadcast", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.clearchat", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.creative", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.freeze", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.items", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.key", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.kick", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.kill", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.mute", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.ranks.set", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.survival", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.teleport", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.unban", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.unfreeze", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.unmute", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.warn", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "invsee.command.invsee", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "invsee.command.enderinvsee", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "invsee.inventory.view", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "invsee.inventory.modify", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "invsee.enderinventory.view", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "invsee.enderinventory.modify", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumprison.command.npc", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumprison.command.booster", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumprison.command.energy", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumprison.command.flare", true);
        # rank kits
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.rankkit.noble", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.rankkit.imperial", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.rankkit.supreme", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.rankkit.majesty", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.rankkit.emperor", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.rankkit.president", true);
        # gkits
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.gkit.heroicvulkarion", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.gkit.heroiczenith", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.gkit.heroiccolossus", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.gkit.heroicwarlock", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.gkit.heroicslaughter", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.gkit.heroicenchanter", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.gkit.heroicatheos", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.gkit.heroiciapetus", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.gkit.heroicbroteas", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.gkit.heroicares", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.gkit.heroicgrimreaper", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.gkit.heroicexecutioner", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.gkit.blacksmith", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.gkit.hero", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.gkit.cyborg", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.gkit.crucible", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.gkit.hunter", true);
        # prestige kits
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.prestigekit.prestige1", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.prestigekit.prestige2", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.prestigekit.prestige3", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.prestigekit.prestige4", true);
        DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.prestigekit.prestige5", true);
    }

    /**
     * @throws JsonException
     */
    public static function setOnlinePlayerRankPermissions(Player $player, $rank): void {

        switch($rank) {

            case "player":
                PermissionManager::setOnlinePlayerDefaultPermissions($player);
                DataManager::setData($player, "Players", "Rank", "Player");
                DataManager::setData($player, "Players", "RankFormat", "§8<§7Player§8>");
                break;

            case "noble":
                # commands
                DataManager::setData($player, "Permissions", "emporiumprison.command.sell", true);
                # rank kits
                DataManager::setData($player, "Permissions", "emporiumcore.rankkit.noble", true);
                # update player file
                DataManager::setData($player, "Players", "Rank", "Noble");
                DataManager::setData($player, "Players", "RankFormat", "§7<§8Noble§7>");
                break;

            case "imperial":
                # commands
                DataManager::setData($player, "Permissions", "emporiumprison.command.sell", true);
                # rank kits
                DataManager::setData($player, "Permissions", "emporiumcore.rankkit.noble", true);
                DataManager::setData($player, "Permissions", "emporiumcore.rankkit.imperial", true);
                # update player file
                DataManager::setData($player, "Players", "Rank", "Imperial");
                DataManager::setData($player, "Players", "RankFormat", "§f<§dImperial§f>");
                break;

            case "supreme":
                # commands
                DataManager::setData($player, "Permissions", "emporiumprison.command.sell", true);
                # rank kits
                DataManager::setData($player, "Permissions", "emporiumcore.rankkit.noble", true);
                DataManager::setData($player, "Permissions", "emporiumcore.rankkit.imperial", true);
                DataManager::setData($player, "Permissions", "emporiumcore.rankkit.supreme", true);
                # update player file
                DataManager::setData($player, "Players", "Rank", "Supreme");
                DataManager::setData($player, "Players", "RankFormat", "§f<§3Supreme§f>");
                break;

            case "majesty":
                # commands
                DataManager::setData($player, "Permissions", "emporiumprison.command.sell", true);
                # rank kits
                DataManager::setData($player, "Permissions", "emporiumcore.rankkit.noble", true);
                DataManager::setData($player, "Permissions", "emporiumcore.rankkit.imperial", true);
                DataManager::setData($player, "Permissions", "emporiumcore.rankkit.supreme", true);
                DataManager::setData($player, "Permissions", "emporiumcore.rankkit.majesty", true);
                # update player file
                DataManager::setData($player, "Players", "Rank", "Majesty");
                DataManager::setData($player, "Players", "RankFormat", "§f<§dImperial§f>");
                break;

            case "emperor":
                # commands
                DataManager::setData($player, "Permissions", "emporiumprison.command.sell", true);
                # rank kits
                DataManager::setData($player, "Permissions", "emporiumcore.rankkit.noble", true);
                DataManager::setData($player, "Permissions", "emporiumcore.rankkit.imperial", true);
                DataManager::setData($player, "Permissions", "emporiumcore.rankkit.supreme", true);
                DataManager::setData($player, "Permissions", "emporiumcore.rankkit.majesty", true);
                DataManager::setData($player, "Permissions", "emporiumcore.rankkit.emperor", true);
                # update player file
                DataManager::setData($player, "Players", "Rank", "Emperor");
                DataManager::setData($player, "Players", "RankFormat", "§f[§bEmperor§f]");
                break;

            case "president":
                # commands
                DataManager::setData($player, "Permissions", "emporiumprison.command.sell", true);
                # rank kits
                DataManager::setData($player, "Permissions", "emporiumcore.rankkit.noble", true);
                DataManager::setData($player, "Permissions", "emporiumcore.rankkit.imperial", true);
                DataManager::setData($player, "Permissions", "emporiumcore.rankkit.supreme", true);
                DataManager::setData($player, "Permissions", "emporiumcore.rankkit.majesty", true);
                DataManager::setData($player, "Permissions", "emporiumcore.rankkit.emperor", true);
                DataManager::setData($player, "Permissions", "emporiumcore.rankkit.president", true);
                # update player file
                DataManager::setData($player, "Players", "Rank", "President");
                DataManager::setData($player, "Players", "RankFormat", "§4<§cPresident§4>");
                break;

            case "trial":
                # ranked Commands
                DataManager::setData($player, "Permissions","emporiumcore.command.clear", true);
                DataManager::setData($player, "Permissions","emporiumcore.command.feed", true);
                DataManager::setData($player, "Permissions","emporiumcore.command.fly", true);
                DataManager::setData($player, "Permissions","emporiumcore.command.heal", true);
                # staff Commands
                DataManager::setData($player, "Permissions", "emporiumcore.command.ban", false);
                DataManager::setData($player, "Permissions", "emporiumcore.command.broadcast", false);
                DataManager::setData($player, "Permissions", "emporiumcore.command.clearchat", false);
                DataManager::setData($player, "Permissions", "emporiumcore.command.creative", false);
                DataManager::setData($player, "Permissions", "emporiumcore.command.freeze", true);
                DataManager::setData($player, "Permissions", "emporiumcore.command.items", false);
                DataManager::setData($player, "Permissions", "emporiumcore.command.key", false);
                DataManager::setData($player, "Permissions", "emporiumcore.command.kick", true);
                DataManager::setData($player, "Permissions", "emporiumcore.command.kill", false);
                DataManager::setData($player, "Permissions", "emporiumcore.command.mute", true);
                DataManager::setData($player, "Permissions", "emporiumcore.command.ranks.set", false);
                DataManager::setData($player, "Permissions", "emporiumcore.command.survival", false);
                DataManager::setData($player, "Permissions", "emporiumcore.command.teleport", true);
                DataManager::setData($player, "Permissions", "emporiumcore.command.unban", false);
                DataManager::setData($player, "Permissions", "emporiumcore.command.unfreeze", true);
                DataManager::setData($player, "Permissions", "emporiumcore.command.unmute", true);
                DataManager::setData($player, "Permissions", "emporiumcore.command.warn", true);
                DataManager::setData($player, "Permissions", "invsee.command.invsee", true);
                DataManager::setData($player, "Permissions", "invsee.command.enderinvsee", true);
                DataManager::setData($player, "Permissions", "invsee.inventory.view", true);
                DataManager::setData($player, "Permissions", "invsee.inventory.modify", false);
                DataManager::setData($player, "Permissions", "invsee.enderinventory.view", true);
                DataManager::setData($player, "Permissions", "invsee.enderinventory.modify", false);
                DataManager::setData($player, "Permissions", "emporiumprison.command.npc", false);
                DataManager::setData($player, "Permissions", "emporiumprison.command.booster", false);
                DataManager::setData($player, "Permissions", "emporiumprison.command.energy", false);
                DataManager::setData($player, "Permissions", "emporiumprison.command.flare", false);
                # update player file
                DataManager::setData($player, "Players", "Rank", "Trial-Helper");
                DataManager::setData($player, "Players", "RankFormat", "§gTrial-Helper");
                break;

            case "helper":
                # rank Commands
                DataManager::setData($player, "Permissions","emporiumcore.command.clear", true);
                DataManager::setData($player, "Permissions","emporiumcore.command.feed", true);
                DataManager::setData($player, "Permissions","emporiumcore.command.fly", true);
                DataManager::setData($player, "Permissions","emporiumcore.command.heal", true);
                # staff Commands
                DataManager::setData($player, "Permissions", "emporiumcore.command.ban", false);
                DataManager::setData($player, "Permissions", "emporiumcore.command.broadcast", false);
                DataManager::setData($player, "Permissions", "emporiumcore.command.clearchat", false);
                DataManager::setData($player, "Permissions", "emporiumcore.command.creative", false);
                DataManager::setData($player, "Permissions", "emporiumcore.command.freeze", true);
                DataManager::setData($player, "Permissions", "emporiumcore.command.items", false);
                DataManager::setData($player, "Permissions", "emporiumcore.command.key", false);
                DataManager::setData($player, "Permissions", "emporiumcore.command.kick", true);
                DataManager::setData($player, "Permissions", "emporiumcore.command.kill", false);
                DataManager::setData($player, "Permissions", "emporiumcore.command.mute", true);
                DataManager::setData($player, "Permissions", "emporiumcore.command.ranks.set", false);
                DataManager::setData($player, "Permissions", "emporiumcore.command.survival", false);
                DataManager::setData($player, "Permissions", "emporiumcore.command.teleport", true);
                DataManager::setData($player, "Permissions", "emporiumcore.command.unban", false);
                DataManager::setData($player, "Permissions", "emporiumcore.command.unfreeze", true);
                DataManager::setData($player, "Permissions", "emporiumcore.command.unmute", true);
                DataManager::setData($player, "Permissions", "emporiumcore.command.warn", true);
                DataManager::setData($player, "Permissions", "invsee.command.invsee", true);
                DataManager::setData($player, "Permissions", "invsee.command.enderinvsee", true);
                DataManager::setData($player, "Permissions", "invsee.inventory.view", true);
                DataManager::setData($player, "Permissions", "invsee.inventory.modify", false);
                DataManager::setData($player, "Permissions", "invsee.enderinventory.view", true);
                DataManager::setData($player, "Permissions", "invsee.enderinventory.modify", false);
                DataManager::setData($player, "Permissions", "emporiumprison.command.npc", false);
                DataManager::setData($player, "Permissions", "emporiumprison.command.booster", false);
                DataManager::setData($player, "Permissions", "emporiumprison.command.energy", false);
                DataManager::setData($player, "Permissions", "emporiumprison.command.flare", false);
                # update player file
                DataManager::setData($player, "Players", "Rank", "Helper");
                DataManager::setData($player, "Players", "RankFormat", "§aHelper");
                break;

            case "builder":
                # ranked Commands
                DataManager::setData($player, "Permissions","emporiumcore.command.clear", true);
                DataManager::setData($player, "Permissions","emporiumcore.command.feed", true);
                DataManager::setData($player, "Permissions","emporiumcore.command.fly", true);
                DataManager::setData($player, "Permissions","emporiumcore.command.heal", true);
                # staff Commands

                # update player file
                DataManager::setData($player, "Players", "Rank", "Builder");
                DataManager::setData($player, "Players", "RankFormat", "§9Builder");
                break;

            case "mod":
                // Ranked
                DataManager::setData($player, "Permissions","emporiumcore.command.clear", true);
                DataManager::setData($player, "Permissions","emporiumcore.command.feed", true);
                DataManager::setData($player, "Permissions","emporiumcore.command.fly", true);
                DataManager::setData($player, "Permissions","emporiumcore.command.heal", true);
                # staff Commands
                DataManager::setData($player, "Permissions", "emporiumcore.command.ban", false);
                DataManager::setData($player, "Permissions", "emporiumcore.command.broadcast", true);
                DataManager::setData($player, "Permissions", "emporiumcore.command.clearchat", true);
                DataManager::setData($player, "Permissions", "emporiumcore.command.creative", false);
                DataManager::setData($player, "Permissions", "emporiumcore.command.freeze", true);
                DataManager::setData($player, "Permissions", "emporiumcore.command.items", false);
                DataManager::setData($player, "Permissions", "emporiumcore.command.key", false);
                DataManager::setData($player, "Permissions", "emporiumcore.command.kick", true);
                DataManager::setData($player, "Permissions", "emporiumcore.command.kill", false);
                DataManager::setData($player, "Permissions", "emporiumcore.command.mute", true);
                DataManager::setData($player, "Permissions", "emporiumcore.command.ranks.set", false);
                DataManager::setData($player, "Permissions", "emporiumcore.command.survival", false);
                DataManager::setData($player, "Permissions", "emporiumcore.command.teleport", true);
                DataManager::setData($player, "Permissions", "emporiumcore.command.unban", false);
                DataManager::setData($player, "Permissions", "emporiumcore.command.unfreeze", true);
                DataManager::setData($player, "Permissions", "emporiumcore.command.unmute", true);
                DataManager::setData($player, "Permissions", "emporiumcore.command.warn", true);
                DataManager::setData($player, "Permissions", "invsee.command.invsee", true);
                DataManager::setData($player, "Permissions", "invsee.command.enderinvsee", true);
                DataManager::setData($player, "Permissions", "invsee.inventory.view", true);
                DataManager::setData($player, "Permissions", "invsee.inventory.modify", true);
                DataManager::setData($player, "Permissions", "invsee.enderinventory.view", true);
                DataManager::setData($player, "Permissions", "invsee.enderinventory.modify", true);
                DataManager::setData($player, "Permissions", "emporiumprison.command.npc", false);
                DataManager::setData($player, "Permissions", "emporiumprison.command.booster", false);
                DataManager::setData($player, "Permissions", "emporiumprison.command.energy", false);
                DataManager::setData($player, "Permissions", "emporiumprison.command.flare", false);
                # update player file
                DataManager::setData($player, "Players", "Rank", "Mod");
                DataManager::setData($player, "Players", "RankFormat", "§l§dMod");
                break;

            case "admin":
                # set all permissions
                PermissionManager::setOnlinePlayerAllPermissions($player);
                # update player file
                DataManager::setData($player, "Players", "Rank", "Admin");
                DataManager::setData($player, "Players", "RankFormat", "§l§aAdmin");
                break;

            case "developer":
                # set all permissions
                PermissionManager::setOnlinePlayerAllPermissions($player);
                # update player file
                DataManager::setData($player, "Players", "Rank", "Developer");
                DataManager::setData($player, "Players", "RankFormat", "§l§1Developer");
                break;

            case "manager":
                # set all permissions
                PermissionManager::setOnlinePlayerAllPermissions($player);
                # update player file
                DataManager::setData($player, "Players", "Rank", "Manager");
                DataManager::setData($player, "Players", "RankFormat", "§l§bManager");
                break;

            case "owner":
                # set all permissions
                PermissionManager::setOnlinePlayerAllPermissions($player);
                # update player file
                DataManager::setData($player, "Players", "Rank", "Owner");
                DataManager::setData($player, "Players", "RankFormat", "§l§6Owner");
                break;

            case "founder":
                # set all permissions
                PermissionManager::setOnlinePlayerAllPermissions($player);
                # update player file
                DataManager::setData($player, "Players", "Rank", "Founder");
                DataManager::setData($player, "Players", "RankFormat", "§l§cF§4o§cu§4n§cd§4e§cr");
                break;
        }
    }

    /**
     * @throws JsonException
     */
    public static function setOfflinePlayerRankPermissions($player, $rank): void {

        switch($rank) {

            case "player":
                PermissionManager::setOfflinePlayerDefaultPermissions($player);
                DataManager::setOfflinePlayerData($player, "Players", "Rank", "Player");
                DataManager::setOfflinePlayerData($player, "Players", "RankFormat", "§8<§7Player§8>");
                break;

            case "noble":
                # rank kits
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.rankkit.noble", true);
                # update player file
                DataManager::setOfflinePlayerData($player, "Players", "Rank", "Noble");
                DataManager::setOfflinePlayerData($player, "Players", "RankFormat", "§7<§8Noble§7>");
                break;

            case "imperial":
                # rank kits
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.rankkit.noble", true);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.rankkit.imperial", true);
                # update player file
                DataManager::setOfflinePlayerData($player, "Players", "Rank", "Imperial");
                DataManager::setOfflinePlayerData($player, "Players", "RankFormat", "§f<§dImperial§f>");
                break;

            case "supreme":
                # rank kits
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.rankkit.noble", true);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.rankkit.imperial", true);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.rankkit.supreme", true);
                # update player file
                DataManager::setOfflinePlayerData($player, "Players", "Rank", "Supreme");
                DataManager::setOfflinePlayerData($player, "Players", "RankFormat", "§f<§3Supreme§f>");
                break;

            case "majesty":
                # rank kits
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.rankkit.noble", true);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.rankkit.imperial", true);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.rankkit.supreme", true);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.rankkit.majesty", true);
                # update player file
                DataManager::setOfflinePlayerData($player, "Players", "Rank", "Majesty");
                DataManager::setOfflinePlayerData($player, "Players", "RankFormat", "§f<§dImperial§f>");
                break;

            case "emperor":
                # rank kits
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.rankkit.noble", true);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.rankkit.imperial", true);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.rankkit.supreme", true);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.rankkit.majesty", true);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.rankkit.emperor", true);
                # update player file
                DataManager::setOfflinePlayerData($player, "Players", "Rank", "Emperor");
                DataManager::setOfflinePlayerData($player, "Players", "RankFormat", "§f[§bEmperor§f]");
                break;

            case "president":
                # rank kits
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.rankkit.noble", true);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.rankkit.imperial", true);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.rankkit.supreme", true);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.rankkit.majesty", true);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.rankkit.emperor", true);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.rankkit.president", true);
                # update player file
                DataManager::setOfflinePlayerData($player, "Players", "Rank", "President");
                DataManager::setOfflinePlayerData($player, "Players", "RankFormat", "§4<§cPresident§4>");
                break;

            case "trial":
                # ranked Commands
                DataManager::setOfflinePlayerData($player, "Permissions","emporiumcore.command.clear", true);
                DataManager::setOfflinePlayerData($player, "Permissions","emporiumcore.command.feed", true);
                DataManager::setOfflinePlayerData($player, "Permissions","emporiumcore.command.fly", true);
                DataManager::setOfflinePlayerData($player, "Permissions","emporiumcore.command.heal", true);
                # staff Commands
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.ban", false);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.broadcast", false);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.clearchat", false);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.creative", false);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.freeze", true);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.items", false);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.key", false);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.kick", true);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.kill", false);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.mute", true);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.ranks.set", false);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.survival", false);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.teleport", true);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.unban", false);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.unfreeze", true);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.unmute", true);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.warn", true);
                DataManager::setOfflinePlayerData($player, "Permissions", "invsee.command.invsee", true);
                DataManager::setOfflinePlayerData($player, "Permissions", "invsee.command.enderinvsee", true);
                DataManager::setOfflinePlayerData($player, "Permissions", "invsee.inventory.view", true);
                DataManager::setOfflinePlayerData($player, "Permissions", "invsee.inventory.modify", false);
                DataManager::setOfflinePlayerData($player, "Permissions", "invsee.enderinventory.view", true);
                DataManager::setOfflinePlayerData($player, "Permissions", "invsee.enderinventory.modify", false);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumprison.command.npc", false);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumprison.command.booster", false);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumprison.command.energy", false);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumprison.command.flare", false);
                # update player file
                DataManager::setOfflinePlayerData($player, "Players", "Rank", "Trial-Helper");
                DataManager::setOfflinePlayerData($player, "Players", "RankFormat", "§gTrial-Helper");
                break;

            case "helper":
                # rank Commands
                DataManager::setOfflinePlayerData($player, "Permissions","emporiumcore.command.clear", true);
                DataManager::setOfflinePlayerData($player, "Permissions","emporiumcore.command.feed", true);
                DataManager::setOfflinePlayerData($player, "Permissions","emporiumcore.command.fly", true);
                DataManager::setOfflinePlayerData($player, "Permissions","emporiumcore.command.heal", true);
                # staff Commands
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.ban", false);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.broadcast", false);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.clearchat", false);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.creative", false);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.freeze", true);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.items", false);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.key", false);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.kick", true);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.kill", false);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.mute", true);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.ranks.set", false);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.survival", false);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.teleport", true);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.unban", false);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.unfreeze", true);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.unmute", true);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.warn", true);
                DataManager::setOfflinePlayerData($player, "Permissions", "invsee.command.invsee", true);
                DataManager::setOfflinePlayerData($player, "Permissions", "invsee.command.enderinvsee", true);
                DataManager::setOfflinePlayerData($player, "Permissions", "invsee.inventory.view", true);
                DataManager::setOfflinePlayerData($player, "Permissions", "invsee.inventory.modify", false);
                DataManager::setOfflinePlayerData($player, "Permissions", "invsee.enderinventory.view", true);
                DataManager::setOfflinePlayerData($player, "Permissions", "invsee.enderinventory.modify", false);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumprison.command.npc", false);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumprison.command.booster", false);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumprison.command.energy", false);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumprison.command.flare", false);
                # update player file
                DataManager::setOfflinePlayerData($player, "Players", "Rank", "Helper");
                DataManager::setOfflinePlayerData($player, "Players", "RankFormat", "§aHelper");
                break;

            case "builder":
                # ranked Commands
                DataManager::setOfflinePlayerData($player, "Permissions","emporiumcore.command.clear", true);
                DataManager::setOfflinePlayerData($player, "Permissions","emporiumcore.command.feed", true);
                DataManager::setOfflinePlayerData($player, "Permissions","emporiumcore.command.fly", true);
                DataManager::setOfflinePlayerData($player, "Permissions","emporiumcore.command.heal", true);
                # staff Commands

                # update player file
                DataManager::setOfflinePlayerData($player, "Players", "Rank", "Builder");
                DataManager::setOfflinePlayerData($player, "Players", "RankFormat", "§9Builder");
                break;

            case "mod":
                // Ranked
                DataManager::setOfflinePlayerData($player, "Permissions","emporiumcore.command.clear", true);
                DataManager::setOfflinePlayerData($player, "Permissions","emporiumcore.command.feed", true);
                DataManager::setOfflinePlayerData($player, "Permissions","emporiumcore.command.fly", true);
                DataManager::setOfflinePlayerData($player, "Permissions","emporiumcore.command.heal", true);
                # staff Commands
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.ban", false);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.broadcast", true);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.clearchat", true);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.creative", false);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.freeze", true);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.items", false);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.key", false);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.kick", true);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.kill", false);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.mute", true);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.ranks.set", false);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.survival", false);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.teleport", true);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.unban", false);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.unfreeze", true);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.unmute", true);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumcore.command.warn", true);
                DataManager::setOfflinePlayerData($player, "Permissions", "invsee.command.invsee", true);
                DataManager::setOfflinePlayerData($player, "Permissions", "invsee.command.enderinvsee", true);
                DataManager::setOfflinePlayerData($player, "Permissions", "invsee.inventory.view", true);
                DataManager::setOfflinePlayerData($player, "Permissions", "invsee.inventory.modify", true);
                DataManager::setOfflinePlayerData($player, "Permissions", "invsee.enderinventory.view", true);
                DataManager::setOfflinePlayerData($player, "Permissions", "invsee.enderinventory.modify", true);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumprison.command.npc", false);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumprison.command.booster", false);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumprison.command.energy", false);
                DataManager::setOfflinePlayerData($player, "Permissions", "emporiumprison.command.flare", false);
                # update player file
                DataManager::setOfflinePlayerData($player, "Players", "Rank", "Mod");
                DataManager::setOfflinePlayerData($player, "Players", "RankFormat", "§l§dMod");
                break;

            case "admin":
                # set all permissions
                PermissionManager::setOfflinePlayerAllPermissions($player);
                # update player file
                DataManager::setOfflinePlayerData($player, "Players", "Rank", "Admin");
                DataManager::setOfflinePlayerData($player, "Players", "RankFormat", "§l§aAdmin");
                break;

            case "developer":
                # set all permissions
                PermissionManager::setOfflinePlayerAllPermissions($player);
                # update player file
                DataManager::setOfflinePlayerData($player, "Players", "Rank", "Developer");
                DataManager::setOfflinePlayerData($player, "Players", "RankFormat", "§l§1Developer");
                break;

            case "manager":
                # set all permissions
                PermissionManager::setOfflinePlayerAllPermissions($player);
                # update player file
                DataManager::setOfflinePlayerData($player, "Players", "Rank", "Manager");
                DataManager::setOfflinePlayerData($player, "Players", "RankFormat", "§l§bManager");
                break;

            case "owner":
                # set all permissions
                PermissionManager::setOfflinePlayerAllPermissions($player);
                # update player file
                DataManager::setOfflinePlayerData($player, "Players", "Rank", "Owner");
                DataManager::setOfflinePlayerData($player, "Players", "RankFormat", "§l§6Owner");
                break;

            case "founder":
                # set all permissions
                PermissionManager::setOfflinePlayerAllPermissions($player);
                # update player file
                DataManager::setOfflinePlayerData($player, "Players", "Rank", "Founder");
                DataManager::setOfflinePlayerData($player, "Players", "RankFormat", "§l§cF§4o§cu§4n§cd§4e§cr");
                break;
        }
    }
}