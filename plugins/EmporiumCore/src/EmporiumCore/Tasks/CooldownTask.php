<?php

namespace EmporiumCore\Tasks;

use EmporiumCore\EmporiumCore;
use EmporiumCore\Variables;
use EmporiumData\DataManager;
use pocketmine\scheduler\Task;

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
        foreach ($this->getPlayers() as $player) {

            # Variables
            // Combat
            $apples = (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.apples");
            $pearls = (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.pearls");
            $combat = (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.combat");
            // Punishment
            $antispam = (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.anti_spam");
            $ban = (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.ban");
            $freeze = (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.freeze");
            $mute = (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.mute");
            # RankKits
            $kitNoble = (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.rank_kit_noble");
            $kitImperial = (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.rank_kit_imperial");
            $kitSupreme = (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.rank_kit_supreme");
            $kitMajesty = (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.rank_kit_majesty");
            $kitEmperor = (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.rank_kit_emperor");
            $kitPresident = (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.rank_kit_president");
            # GKits
            $gkitHeroicVulkarion = (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.gkit_heroic_vulkarion");
            $gkitHeroicZenith = (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.gkit_heroic_zenith");
            $gkitHeroicColossus = (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.gkit_heroic_colossus");
            $gkitHeroicWarlock = (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.gkit_heroic_warlock");
            $gkitHeroicSlaughter = (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.gkit_heroic_slaughter");
            $gkitHeroicEnchanter = (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.gkit_heroic_enchanter");
            $gkitHeroicAtheos = (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.gkit_heroic_atheos");
            $gkitHeroicIapetus = (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.gkit_heroic_iapetus");
            $gkitHeroicBroteas = (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.gkit_heroic_broteas");
            $gkitHeroicAres = (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.gkit_heroic_ares");
            $gkitHeroicGrimReaper = (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.gkit_heroic_grim_reaper");
            $gkitHeroicExecutioner = (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.gkit_heroic_executioner");
            $gkitBlacksmith = (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.gkit_blacksmith");
            $gkitHero = (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.gkit_hero");
            $gkitCyborg = (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.gkit_cyborg");
            $gkitCrucible = (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.gkit_crucible");
            $gkitHunter = (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.gkit_hunter");
            # prestige kits
            $prestigekit1 = (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.prestige_kit1");
            $prestigekit2 = (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.prestige_kit2");
            $prestigekit3 = (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.prestige_kit3");
            $prestigekit4 = (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.prestige_kit4");
            $prestigekit5 = (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.prestige_kit5");
            # Set Punishments
            DataManager::getInstance()->setPlayerData($player, "anti_auto", 0);

            // Check for Punishment
            if ($ban === 0) {
                DataManager::getInstance()->setPlayerData($player, "profile.banned", false);
            }
            if ($mute === 0) {
                DataManager::getInstance()->setPlayerData($player, "profile.muted", false);
            }

            // Combat
            if ($apples > 0) {
                DataManager::getInstance()->setPlayerData($player,  "cooldown.apples", (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.apples") - 1);
            }
            if ($pearls > 0) {
                DataManager::getInstance()->setPlayerData($player,  "cooldown.pearls", (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.pearls") - 1);
            }
            if ($combat > 0) {
                DataManager::getInstance()->setPlayerData($player,  "cooldown.combat", (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.combat") - 1);
            }
            // Punishment
            if ($antispam > 0) {
                DataManager::getInstance()->setPlayerData($player,  "cooldown.anti_spam", (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.anti_spam") - 1);
            }
            if ($ban > 0) {
                DataManager::getInstance()->setPlayerData($player,  "cooldown.ban", (int) DataManager::getInstance()->getPlayerData($player, "ban") - 1);
            }
            if ($freeze > 0) {
                DataManager::getInstance()->setPlayerData($player,  "cooldown.freeze", (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.freeze") - 1);
            }
            if ($mute > 0) {
                DataManager::getInstance()->setPlayerData($player,  "cooldown.mute", (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.mute") - 1);
            }
            # RankKits
            if ($kitNoble > 0) {
                DataManager::getInstance()->setPlayerData($player,  "cooldown.kit_noble", (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.kit_noble") - 1);
            }
            if ($kitImperial > 0) {
                DataManager::getInstance()->setPlayerData($player,  "cooldown.kit_imperial", (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.kit_imperial") - 1);
            }
            if ($kitSupreme > 0) {
                DataManager::getInstance()->setPlayerData($player,  "cooldown.kit_supreme", (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.kit_supreme") - 1);
            }
            if ($kitMajesty > 0) {
                DataManager::getInstance()->setPlayerData($player,  "cooldown.kit_majesty", (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.kit_majesty") - 1);
            }
            if ($kitEmperor > 0) {
                DataManager::getInstance()->setPlayerData($player,  "cooldown.kit_emperor", (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.kit_emperor") - 1);
            }
            if ($kitPresident > 0) {
                DataManager::getInstance()->setPlayerData($player,  "cooldown.kit_president", (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.kit_president") - 1);
            }
            # gkits
            if ($gkitHeroicVulkarion > 0) {
                DataManager::getInstance()->setPlayerData($player,  "cooldown.gkit_heroic_vulkarion", (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.gkit_heroic_vulkarion") - 1);
            }
            if ($gkitHeroicZenith > 0) {
                DataManager::getInstance()->setPlayerData($player,  "cooldown.gkit_heroic_zenith", (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.gkit_heroic_zenith") - 1);
            }
            if ($gkitHeroicColossus > 0) {
                DataManager::getInstance()->setPlayerData($player,  "cooldown.gkit_heroic_colossus", (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.gkit_heroic_colossus") - 1);
            }
            if ($gkitHeroicWarlock > 0) {
                DataManager::getInstance()->setPlayerData($player,  "cooldown.gkit_heroic_warlock", (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.gkit_heroic_warlock") - 1);
            }
            if ($gkitHeroicSlaughter > 0) {
                DataManager::getInstance()->setPlayerData($player,  "cooldown.gkit_heroic_slaughter", (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.gkit_heroic_slaughter") - 1);
            }
            if ($gkitHeroicEnchanter > 0) {
                DataManager::getInstance()->setPlayerData($player,  "cooldown.gkit_heroic_enchanter", (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.gkit_heroic_enchanter") - 1);
            }
            if ($gkitHeroicAtheos > 0) {
                DataManager::getInstance()->setPlayerData($player,  "cooldown.gkit_heroic_atheos", (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.gkit_heroic_atheos") - 1);
            }
            if ($gkitHeroicIapetus > 0) {
                DataManager::getInstance()->setPlayerData($player,  "cooldown.gkit_heroic_iapetus", (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.gkit_heroic_iapetus") - 1);
            }
            if ($gkitHeroicBroteas > 0) {
                DataManager::getInstance()->setPlayerData($player,  "cooldown.gkit_heroic_broteas", (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.gkit_heroic_broteas") - 1);
            }
            if ($gkitHeroicAres > 0) {
                DataManager::getInstance()->setPlayerData($player,  "cooldown.gkit_heroic_ares", (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.gkit_heroic_ares") - 1);
            }
            if ($gkitHeroicGrimReaper > 0) {
                DataManager::getInstance()->setPlayerData($player,  "cooldown.gkit_heroic_grim_reaper", (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.gkit_heroic_grim_reaper") - 1);
            }
            if ($gkitHeroicExecutioner > 0) {
                DataManager::getInstance()->setPlayerData($player,  "cooldown.gkit_heroic_executioner", (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.gkit_heroic_executioner") - 1);
            }
            if ($gkitBlacksmith > 0) {
                DataManager::getInstance()->setPlayerData($player,  "cooldown.gkit_blacksmith", (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.gkit_blacksmith") - 1);
            }
            if ($gkitHero > 0) {
                DataManager::getInstance()->setPlayerData($player,  "cooldown.gkit_hero", (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.gkit_hero") - 1);
            }
            if ($gkitCyborg > 0) {
                DataManager::getInstance()->setPlayerData($player,  "cooldown.gkit_cyborg", (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.gkit_cyborg") - 1);
            }
            if ($gkitCrucible > 0) {
                DataManager::getInstance()->setPlayerData($player,  "cooldown.gkit_crucible", (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.gkit_crucible") - 1);
            }
            if ($gkitHunter > 0) {
                DataManager::getInstance()->setPlayerData($player,  "cooldown.gkit_hunter", (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.gkit_hunter") - 1);
            }
            # prestige kits
            if ($prestigekit1 > 0) {
                DataManager::getInstance()->setPlayerData($player,  "cooldown.prestige_kit1", (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.prestige_kit1") - 1);
            }
            if ($prestigekit2 > 0) {
                DataManager::getInstance()->setPlayerData($player,  "cooldown.prestige_kit2", (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.prestige_kit2") - 1);
            }
            if ($prestigekit3 > 0) {
                DataManager::getInstance()->setPlayerData($player,  "cooldown.prestige_kit3", (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.prestige_kit3") - 1);
            }
            if ($prestigekit4 > 0) {
                DataManager::getInstance()->setPlayerData($player,  "cooldown.prestige_kit4", (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.prestige_kit4") - 1);
            }
            if ($prestigekit5 > 0) {
                DataManager::getInstance()->setPlayerData($player,  "cooldown.prestige_kit5", (int) DataManager::getInstance()->getPlayerData($player,  "cooldown.prestige_kit5") - 1);
            }
        }

        // For all Online Players
        foreach ($this->plugin->getServer()->getOnlinePlayers() as $player) {

            # Variables
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
        }
    }
}