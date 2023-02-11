<?php

namespace EmporiumCore\Tasks;

use EmporiumCore\Variables;
use JsonException;
use pocketmine\scheduler\Task;

use EmporiumCore\EmporiumCore;
use EmporiumCore\Managers\Data\{DataManager, ServerManager};

class CooldownTask extends Task {

    # Task Constructor
    private EmporiumCore $plugin;

    public function __construct(EmporiumCore $plugin) {
        $this->plugin = $plugin;
	}

    # Get all Players
	function getPlayers(): array
    {
		$files = scandir(EmporiumCore::getPluginInstance()->getDataFolder() . "PlayerData/Cooldowns");
		$players = [];
		foreach($files as $file) {
			$players[] = str_replace(".yml", "", $file);
		}
		return $players;
	}

    # Task Execution

    /**
     * @throws JsonException
     */
    public function onRun(): void {

        // For all Files
        foreach ($this->getPlayers() as $player) {

            # Variables
            // Combat
            $apples = DataManager::getOfflinePlayerData($player, "Cooldowns", "Apples");
            $pearls = DataManager::getOfflinePlayerData($player, "Cooldowns", "Pearls");
            $combat = DataManager::getOfflinePlayerData($player, "Cooldowns", "Combat");
            // Punishment
            $antispam = DataManager::getOfflinePlayerData($player, "Cooldowns", "AntiSpam");
            $ban = DataManager::getOfflinePlayerData($player, "Cooldowns", "Ban");
            $freeze = DataManager::getOfflinePlayerData($player, "Cooldowns", "Freeze");
            $mute = DataManager::getOfflinePlayerData($player, "Cooldowns", "Mute");
            # RankKits
            $kitNoble = DataManager::getOfflinePlayerData($player, "Cooldowns", "KitNoble");
            $kitImperial = DataManager::getOfflinePlayerData($player, "Cooldowns", "KitImperial");
            $kitSupreme = DataManager::getOfflinePlayerData($player, "Cooldowns", "KitSupreme");
            $kitMajesty = DataManager::getOfflinePlayerData($player, "Cooldowns", "KitMajesty");
            $kitEmperor = DataManager::getOfflinePlayerData($player, "Cooldowns", "KitEmperor");
            $kitPresident = DataManager::getOfflinePlayerData($player, "Cooldowns", "KitPresident");
            # GKits
            $gkitHeroicVulkarion = DataManager::getOfflinePlayerData($player, "Cooldowns", "GKitHeroicVulkarion");
            $gkitHeroicZenith = DataManager::getOfflinePlayerData($player, "Cooldowns", "GKitHeroicZenith");
            $gkitHeroicColossus = DataManager::getOfflinePlayerData($player, "Cooldowns", "GKitHeroicColossus");
            $gkitHeroicWarlock = DataManager::getOfflinePlayerData($player, "Cooldowns", "GKitHeroicWarlock");
            $gkitHeroicSlaughter = DataManager::getOfflinePlayerData($player, "Cooldowns", "GKitHeroicSlaughter");
            $gkitHeroicEnchanter = DataManager::getOfflinePlayerData($player, "Cooldowns", "GKitHeroicEnchanter");
            $gkitHeroicAtheos = DataManager::getOfflinePlayerData($player, "Cooldowns", "GKitHeroicAtheos");
            $gkitHeroicIapetus = DataManager::getOfflinePlayerData($player, "Cooldowns", "GKitHeroicIapetus");
            $gkitHeroicBroteas = DataManager::getOfflinePlayerData($player, "Cooldowns", "GKitHeroicBroteas");
            $gkitHeroicAres = DataManager::getOfflinePlayerData($player, "Cooldowns", "GKitHeroicAres");
            $gkitHeroicGrimReaper = DataManager::getOfflinePlayerData($player, "Cooldowns", "GKitHeroicGrimReaper");
            $gkitHeroicExecutioner = DataManager::getOfflinePlayerData($player, "Cooldowns", "GKitHeroicExecutioner");
            $gkitBlacksmith = DataManager::getOfflinePlayerData($player, "Cooldowns", "GKitBlacksmith");
            $gkitHero = DataManager::getOfflinePlayerData($player, "Cooldowns", "GKitHero");
            $gkitCyborg = DataManager::getOfflinePlayerData($player, "Cooldowns", "GKitCyborg");
            $gkitCrucible = DataManager::getOfflinePlayerData($player, "Cooldowns", "GKitCrucible");
            $gkitHunter = DataManager::getOfflinePlayerData($player, "Cooldowns", "GKitHunter");
            # prestige kits
            $prestigekit1 = DataManager::getOfflinePlayerData($player, "Cooldowns", "PrestigeKit1");
            $prestigekit2 = DataManager::getOfflinePlayerData($player, "Cooldowns", "PrestigeKit2");
            $prestigekit3 = DataManager::getOfflinePlayerData($player, "Cooldowns", "PrestigeKit3");
            $prestigekit4 = DataManager::getOfflinePlayerData($player, "Cooldowns", "PrestigeKit4");
            $prestigekit5 = DataManager::getOfflinePlayerData($player, "Cooldowns", "PrestigeKit5");
            # Boosters
            $moneyBoost = DataManager::getOfflinePlayerData($player, "Cooldowns", "MoneyBooster");
            $relicBoost = DataManager::getOfflinePlayerData($player, "Cooldowns", "RelicBooster");
            $keyBoost = DataManager::getOfflinePlayerData($player, "Cooldowns", "KeyBooster");
            # Set Punishments
            DataManager::setOfflinePlayerData($player, "Players", "AntiAuto", 0);

            // Check for Punishment
            if ($ban === 0) {
                DataManager::setOfflinePlayerData($player, "Players", "Banned", false);
            }
            if ($mute === 0) {
                DataManager::setOfflinePlayerData($player, "Players", "Muted", false);
            }

            // Combat
            if ($apples > 0) {
                DataManager::takeOfflinePlayerData($player, "Cooldowns", "Apples", 1);
            }
            if ($pearls > 0) {
                DataManager::takeOfflinePlayerData($player, "Cooldowns", "Pearls", 1);
            }
            if ($combat > 0) {
                DataManager::takeOfflinePlayerData($player, "Cooldowns", "Combat", 1);
            }
            // Punishment
            if ($antispam > 0) {
                DataManager::takeOfflinePlayerData($player, "Cooldowns", "AntiSpam", 1);
            }
            if ($ban > 0) {
                DataManager::takeOfflinePlayerData($player, "Cooldowns", "Ban", 1);
            }
            if ($freeze > 0) {
                DataManager::takeOfflinePlayerData($player, "Cooldowns", "Freeze", 1);
            }
            if ($mute > 0) {
                DataManager::takeOfflinePlayerData($player, "Cooldowns", "Mute", 1);
            }
            # RankKits
            if ($kitNoble > 0) {
                DataManager::takeOfflinePlayerData($player, "Cooldowns", "KitNoble", 1);
            }
            if ($kitImperial > 0) {
                DataManager::takeOfflinePlayerData($player, "Cooldowns", "KitImperial", 1);
            }
            if ($kitSupreme > 0) {
                DataManager::takeOfflinePlayerData($player, "Cooldowns", "KitSupreme", 1);
            }
            if ($kitMajesty > 0) {
                DataManager::takeOfflinePlayerData($player, "Cooldowns", "KitMajesty", 1);
            }
            if ($kitEmperor > 0) {
                DataManager::takeOfflinePlayerData($player, "Cooldowns", "KitEmperor", 1);
            }
            if ($kitPresident > 0) {
                DataManager::takeOfflinePlayerData($player, "Cooldowns", "KitPresident", 1);
            }
            # gkits
            if ($gkitHeroicVulkarion > 0) {
                DataManager::takeOfflinePlayerData($player, "Cooldowns", "GKitHeroicVulkarion", 1);
            }
            if ($gkitHeroicZenith > 0) {
                DataManager::takeOfflinePlayerData($player, "Cooldowns", "GKitHeroicZenith", 1);
            }
            if ($gkitHeroicColossus > 0) {
                DataManager::takeOfflinePlayerData($player, "Cooldowns", "GKitHeroicColossus", 1);
            }
            if ($gkitHeroicWarlock > 0) {
                DataManager::takeOfflinePlayerData($player, "Cooldowns", "GKitHeroicWarlock", 1);
            }
            if ($gkitHeroicSlaughter > 0) {
                DataManager::takeOfflinePlayerData($player, "Cooldowns", "GKitHeroicSlaughter", 1);
            }
            if ($gkitHeroicEnchanter > 0) {
                DataManager::takeOfflinePlayerData($player, "Cooldowns", "GKitHeroicEnchanter", 1);
            }
            if ($gkitHeroicAtheos > 0) {
                DataManager::takeOfflinePlayerData($player, "Cooldowns", "GKitHeroicAtheos", 1);
            }
            if ($gkitHeroicIapetus > 0) {
                DataManager::takeOfflinePlayerData($player, "Cooldowns", "GKitHeroicIapetus", 1);
            }
            if ($gkitHeroicBroteas > 0) {
                DataManager::takeOfflinePlayerData($player, "Cooldowns", "GKitHeroicBroteas", 1);
            }
            if ($gkitHeroicAres > 0) {
                DataManager::takeOfflinePlayerData($player, "Cooldowns", "GKitHeroicAres", 1);
            }
            if ($gkitHeroicGrimReaper > 0) {
                DataManager::takeOfflinePlayerData($player, "Cooldowns", "GKitHeroicGrimReaper", 1);
            }
            if ($gkitHeroicExecutioner > 0) {
                DataManager::takeOfflinePlayerData($player, "Cooldowns", "GKitHeroicExecutioner", 1);
            }
            if ($gkitBlacksmith > 0) {
                DataManager::takeOfflinePlayerData($player, "Cooldowns", "GKitBlacksmith", 1);
            }
            if ($gkitHero > 0) {
                DataManager::takeOfflinePlayerData($player, "Cooldowns", "GKitHero", 1);
            }
            if ($gkitCyborg > 0) {
                DataManager::takeOfflinePlayerData($player, "Cooldowns", "GKitCyborg", 1);
            }
            if ($gkitCrucible > 0) {
                DataManager::takeOfflinePlayerData($player, "Cooldowns", "GKitCrucible", 1);
            }
            if ($gkitHunter > 0) {
                DataManager::takeOfflinePlayerData($player, "Cooldowns", "GKitHunter", 1);
            }
            # prestige kits
            if ($prestigekit1 > 0) {
                DataManager::takeOfflinePlayerData($player, "Cooldowns", "KitPrestige1", 1);
            }
            if ($prestigekit2 > 0) {
                DataManager::takeOfflinePlayerData($player, "Cooldowns", "KitPrestige2", 1);
            }
            if ($prestigekit3 > 0) {
                DataManager::takeOfflinePlayerData($player, "Cooldowns", "KitPrestige3", 1);
            }
            if ($prestigekit4 > 0) {
                DataManager::takeOfflinePlayerData($player, "Cooldowns", "KitPrestige4", 1);
            }
            if ($prestigekit5 > 0) {
                DataManager::takeOfflinePlayerData($player, "Cooldowns", "KitPrestige5", 1);
            }
            # boosters
            if ($moneyBoost > 0) {
                DataManager::takeOfflinePlayerData($player, "Cooldowns", "MoneyBooster", 1);
            }
            if ($relicBoost > 0) {
                DataManager::takeOfflinePlayerData($player, "Cooldowns", "RelicBooster", 1);
            }
            if ($keyBoost > 0) {
                DataManager::takeOfflinePlayerData($player, "Cooldowns", "KeyBooster", 1);
            }
        }

        # global boosters
        $globalMoneyBoost = ServerManager::getData("Boosters", "Money");
        $globalRelicBoost = ServerManager::getData("Boosters", "Relic");
        $globalKeyBoost = ServerManager::getData("Boosters", "Key");

        # boosters
        if ($globalMoneyBoost > 0) {
            ServerManager::takeData("Boosters", "Money", 1);
        }
        if ($globalRelicBoost > 0) {
            ServerManager::takeData("Boosters", "Relic", 1);
        }
        if ($globalKeyBoost > 0) {
            ServerManager::takeData("Boosters", "Key", 1);
        }

        // For all Online Players
        foreach ($this->plugin->getServer()->getOnlinePlayers() as $player) {

            # Variables
            // Combat
            $apples = DataManager::getData($player, "Cooldowns", "Apples");
            $pearls = DataManager::getData($player, "Cooldowns", "Pearls");
            $combat = DataManager::getData($player, "Cooldowns", "Combat");
            // Punishment
            $mute = DataManager::getData($player, "Cooldowns", "Mute");
            // Boosters
            $globalMoneyBoost = ServerManager::getData("Boosters", "Money");
            $globalRelicBoost = ServerManager::getData("Boosters", "Relic");
            $globalKeyBoost = ServerManager::getData("Boosters", "Key");
            $moneyBoost = DataManager::getData($player, "Cooldowns", "MoneyBooster");
            $relicBoost = DataManager::getData($player, "Cooldowns", "RelicBooster");
            $keyBoost = DataManager::getData($player, "Cooldowns", "KeyBooster");

            # Send Alerts
            // Combat
            if ($apples === 1) {
                $player->sendMessage(Variables::SERVER_PREFIX . "§r§7Your apple cooldown has ended.");
            }
            if ($pearls === 1) {
                $player->sendMessage(Variables::SERVER_PREFIX . "§r§7Your enderpearl cooldown has ended.");
            }
            if ($combat === 1) {
                $player->sendMessage(Variables::SERVER_PREFIX . "§r§7You are no longer in combat.");
            }
            // Punishment
            if ($mute === 1) {
                $player->sendMessage(Variables::SERVER_PREFIX . "§r§7You are no longer muted.");
            }
            // Boosters
            if ($globalMoneyBoost === 1) {
                $player->getServer()->broadcastMessage(Variables::SERVER_PREFIX . "§r§7The Global Money Booster has worn off.");
            }
            if ($globalRelicBoost === 1) {
                $player->getServer()->broadcastMessage(Variables::SERVER_PREFIX . "§r§7The Global Relic Booster has worn off.");
            }
            if ($globalKeyBoost === 1) {
                $player->getServer()->broadcastMessage(Variables::SERVER_PREFIX . "§r§7The Global Key Booster has worn off.");
            }
            if ($moneyBoost === 1) {
                $player->sendMessage(Variables::SERVER_PREFIX . "§r§7Your Personal Money Booster has worn off.");
            }
            if ($relicBoost === 1) {
                $player->sendMessage(Variables::SERVER_PREFIX . "§r§7Your Personal Relic Booster has worn off.");
            }
            if ($keyBoost === 1) {
                $player->sendMessage(Variables::SERVER_PREFIX . "§r§7Your Personal Key Booster has worn off.");
            }
        }
    }
}