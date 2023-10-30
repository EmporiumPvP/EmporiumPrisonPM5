<?php

namespace EmporiumCore\Listeners;

use EmporiumCore\EmporiumCore;
use EmporiumCore\Managers\Misc\Webhooks;
use EmporiumCore\Variables;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\{PlayerCommandPreprocessEvent, PlayerDeathEvent, PlayerJoinEvent, PlayerQuitEvent};
use pocketmine\player\Player;
use pocketmine\Server;

class WebhookEvent implements Listener
{

    private EmporiumCore $plugin;

    public function __construct(EmporiumCore $plugin)
    {
        $this->plugin = $plugin;
    }

    /////////////////////////////// STAFF WEBHOOK ///////////////////////////////

    public static function staffWebhook($sender, $object, $command, $reason = null)
    {

        if ($command === "Ban") {
            // Create Webhook
            $message = "> **Punishment:** Ban\n> **Player:** {$object->getName()}\n> **Staff:** {$sender->getName()}\n> **Reason:** $reason";
            $webhook = Variables::PLAYER_PUNISHMENTS_WEBHOOK;
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Moderation"
            ];
        }
        if ($command === "ClearChat") {
            // Create Webhook
            $message = "**{$sender->getName()}** has cleared chat";
            $webhook = Variables::PLAYER_PUNISHMENTS_WEBHOOK;
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Moderation"
            ];
        }
        if ($command === "Freeze") {
            // Create Webhook
            $message = "> **Punishment:** Freeze\n> **Player:** {$object->getName()}\n> **Staff:** {$sender->getName()}\n> **Reason:** $reason";
            $webhook = Variables::PLAYER_PUNISHMENTS_WEBHOOK;
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Moderation"
            ];
        }
        switch ($command) {
            case "creative":
            case "survival":
                if ($object === $sender) {
                    // Create Webhook
                    $message = "**{$sender->getName()}** has changed their gamemode";
                } else {
                    // Create Webhook
                    $message = "**{$sender->getName()}** has changed **{$object->getName()}**'s gamemode";
                }
                $webhook = Variables::PLAYER_PUNISHMENTS_WEBHOOK;
                $curlopts = [
                    "content" => $message,
                    "username" => "Emporium | Moderation"
                ];
        }
        if ($command === "Kick") {
            // Create Webhook
            $message = "> **Punishment:** Kick\n> **Player:** {$object->getName()}\n> **Staff:** {$sender->getName()}\n> **Reason:** $reason";
            $webhook = Variables::PLAYER_PUNISHMENTS_WEBHOOK;
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Moderation"
            ];
        }
        if ($command === "Kill") {
            // Create Webhook
            $message = "> **Punishment:** Kill\n> **Player:** {$object->getName()}\n> **Staff:** {$sender->getName()}\n> **Reason:** $reason";
            $webhook = Variables::PLAYER_PUNISHMENTS_WEBHOOK;
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Moderation"
            ];
        }
        if ($command === "Mute") {
            // Create Webhook
            $message = "> **Punishment:** Mute\n> **Player:** {$object->getName()}\n> **Staff:** {$sender->getName()}\n> **Reason:** $reason";
            $webhook = Variables::PLAYER_PUNISHMENTS_WEBHOOK;
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Moderation"
            ];
        }
        if ($command === "Teleport.To") {
            // Create Webhook
            $message = "**{$sender->getName()}** has force teleported to **{$object->getName()}**";
            $webhook = Variables::PLAYER_COMMANDS_WEBHOOK;
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Moderation"
            ];
        }
        if ($command === "Teleport.Here") {
            // Create Webhook
            $message = "**{$sender->getName()}** has force teleported **{$object->getName()}** to themselves";
            $webhook = Variables::PLAYER_COMMANDS_WEBHOOK;
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Moderation"
            ];
        }
        if ($command === "Teleport.Coordinates") {
            // Create Webhook
            $message = "**{$sender->getName()}** has force teleported to the coordinates **$object[0], $object[1], $object[2]**";
            $webhook = Variables::PLAYER_COMMANDS_WEBHOOK;
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Moderation"
            ];
        }
        if ($command === "Unban") {
            // Create Webhook
            $message = "**{$sender->getName()}** has unbanned **{$object->getName()}**";
            $webhook = Variables::PLAYER_PUNISHMENTS_WEBHOOK;
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Moderation"
            ];
        }
        if ($command === "Unfreeze") {
            // Create Webhook
            $message = "**{$sender->getName()}** has unfrozen **$object**";
            $webhook = Variables::PLAYER_PUNISHMENTS_WEBHOOK;
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Moderation"
            ];
        }
        if ($command === "Unmute") {
            // Create Webhook
            $message = "**{$sender->getName()}** has unmuted **$object**";
            $webhook = Variables::PLAYER_PUNISHMENTS_WEBHOOK;
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Moderation"
            ];
        }
        if ($command === "Warn") {
            // Create Webhook
            $message = "**Punishment:** Warn\n**Player:** {$object->getName()}\n**Staff:** {$sender->getName()}\n**Reason:** $reason";
            $webhook = Variables::PLAYER_PUNISHMENTS_WEBHOOK;
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Moderation"
            ];
        }

        // Send Webhook
        $sender->getServer()->getAsyncPool()->submitTask(new Webhooks($webhook, serialize($curlopts)));
    }

    /////////////////////////////// PLAYER ITEMS WEBHOOK ///////////////////////////////

    public static function itemWebhook($player, $item)
    {

        # gkits
        if ($item === "GKitHeroicVulkarion") {
            // Create Webhook
            $message = "**Item:** Heroic Vulkarion GKit\n**Player:** {$player->getName()}";
            $webhook = Variables::PLAYER_ITEMS_WEBHOOK;
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Moderation"
            ];
        }
        if ($item === "GKitHeroicZenith") {
            // Create Webhook
            $message = "**Item:** Heroic Zenith GKit\n**Player:** {$player->getName()}";
            $webhook = Variables::PLAYER_ITEMS_WEBHOOK;
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Moderation"
            ];
        }
        if ($item === "GKitHeroicColossus") {
            // Create Webhook
            $message = "**Item:** Heroic Colossus GKit\n**Player:** {$player->getName()}";
            $webhook = Variables::PLAYER_ITEMS_WEBHOOK;
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Moderation"
            ];
        }
        if ($item === "GKitHeroicWarlock") {
            // Create Webhook
            $message = "**Item:** Heroic Warlock GKit\n**Player:** {$player->getName()}";
            $webhook = Variables::PLAYER_ITEMS_WEBHOOK;
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Moderation"
            ];
        }
        if ($item === "GKitHeroicSlaughter") {
            // Create Webhook
            $message = "**Item:** Heroic Slaughter GKit\n**Player:** {$player->getName()}";
            $webhook = Variables::PLAYER_ITEMS_WEBHOOK;
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Moderation"
            ];
        }
        if ($item === "GKitHeroicEnchanter") {
            // Create Webhook
            $message = "**Item:** Heroic Enchanter GKit\n**Player:** {$player->getName()}";
            $webhook = Variables::PLAYER_ITEMS_WEBHOOK;
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Moderation"
            ];
        }
        if ($item === "GKitHeroicAtheos") {
            // Create Webhook
            $message = "**Item:** Heroic Atheos GKit\n**Player:** {$player->getName()}";
            $webhook = Variables::PLAYER_ITEMS_WEBHOOK;
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Moderation"
            ];
        }
        if ($item === "GKitHeroicIapetus") {
            // Create Webhook
            $message = "**Item:** Heroic Iapetus GKit\n**Player:** {$player->getName()}";
            $webhook = Variables::PLAYER_ITEMS_WEBHOOK;
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Moderation"
            ];
        }
        if ($item === "GKitHeroicBroteas") {
            // Create Webhook
            $message = "**Item:** Heroic Broteas GKit\n**Player:** {$player->getName()}";
            $webhook = Variables::PLAYER_ITEMS_WEBHOOK;
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Moderation"
            ];
        }
        if ($item === "GKitHeroicAres") {
            // Create Webhook
            $message = "**Item:** Heroic Ares GKit\n**Player:** {$player->getName()}";
            $webhook = Variables::PLAYER_ITEMS_WEBHOOK;
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Moderation"
            ];
        }
        if ($item === "GKitHeroicGrimReaper") {
            // Create Webhook
            $message = "**Item:** Heroic Grim Reaper GKit\n**Player:** {$player->getName()}";
            $webhook = Variables::PLAYER_ITEMS_WEBHOOK;
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Moderation"
            ];
        }
        if ($item === "GKitHeroicExecutioner") {
            // Create Webhook
            $message = "**{$player->getName()}** has opened a **Heroic Executioner God Kit**";
            $webhook = Variables::PLAYER_ITEMS_WEBHOOK;
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Moderation"
            ];
        }
        if ($item === "GKitBlacksmith") {
            // Create Webhook
            $message = "**Item:** Blacksmith GKit\n**Player:** {$player->getName()}";
            $webhook = Variables::PLAYER_ITEMS_WEBHOOK;
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Moderation"
            ];
        }
        if ($item === "GKitHero") {
            // Create Webhook
            $message = "**Item:** Hero GKit\n**Player:** {$player->getName()}";
            $webhook = Variables::PLAYER_ITEMS_WEBHOOK;
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Moderation"
            ];
        }
        if ($item === "GKitCyborg") {
            // Create Webhook
            $message = "**Item:** Cyborg GKit\n**Player:** {$player->getName()}";
            $webhook = Variables::PLAYER_ITEMS_WEBHOOK;
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Moderation"
            ];
        }
        if ($item === "GKitCrucible") {
            // Create Webhook
            $message = "**Item:** Crucible GKit\n**Player:** {$player->getName()}";
            $webhook = Variables::PLAYER_ITEMS_WEBHOOK;
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Moderation"
            ];
        }
        if ($item === "GKitHunter") {
            // Create Webhook
            $message = "**Item:** Hunter GKit\n**Player:** {$player->getName()}";
            $webhook = Variables::PLAYER_ITEMS_WEBHOOK;
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Moderation"
            ];
        }
        # rank kits
        if ($item === "RankKitNoble") {
            // Create Webhook
            $message = "**Item:** Noble Rank Kit\n**Player:** {$player->getName()}";
            $webhook = Variables::PLAYER_ITEMS_WEBHOOK;
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Moderation"
            ];
        }
        if ($item === "RankKitImperial") {
            // Create Webhook
            $message = "**Item:** Imperial Rank Kit\n**Player:** {$player->getName()}";
            $webhook = Variables::PLAYER_ITEMS_WEBHOOK;
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Moderation"
            ];
        }
        if ($item === "RankKitSupreme") {
            // Create Webhook
            $message = "**Item:** Supreme Rank Kit\n**Player:** {$player->getName()}";
            $webhook = Variables::PLAYER_ITEMS_WEBHOOK;
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Moderation"
            ];
        }
        if ($item === "RankKitMajesty") {
            // Create Webhook
            $message = "**Item:** Majesty Rank Kit\n**Player:** {$player->getName()}";
            $webhook = Variables::PLAYER_ITEMS_WEBHOOK;
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Moderation"
            ];
        }
        if ($item === "RankKitEmperor") {
            // Create Webhook
            $message = "**Item:** Emperor Rank Kit\n**Player:** {$player->getName()}";
            $webhook = Variables::PLAYER_ITEMS_WEBHOOK;
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Moderation"
            ];
        }
        if ($item === "RankKitPresident") {
            // Create Webhook
            $message = "**Item:** President Rank Kit\n**Player:** {$player->getName()}";
            $webhook = Variables::PLAYER_ITEMS_WEBHOOK;
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Moderation"
            ];
        }
        # contraband
        if ($item === "EliteContraband") {
            // Create Webhook
            $message = "**Item:** Ultimate Contraband\n**Player:** {$player->getName()}";
            $webhook = Variables::PLAYER_ITEMS_WEBHOOK;
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Moderation"
            ];
        }
        if ($item === "UltimateContraband") {
            // Create Webhook
            $message = "**Item:** Ultimate Contraband\n**Player:** {$player->getName()}";
            $message = "**{$player->getName()}** has opened an **Ultimate Contraband**";
            $webhook = Variables::PLAYER_ITEMS_WEBHOOK;
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Moderation"
            ];
        }
        if ($item === "LegendaryContraband") {
            // Create Webhook
            $message = "**Item:** Legendary Contraband\n**Player:** {$player->getName()}";
            $message = "**{$player->getName()}** has opened a **Legendary Contraband**";
            $webhook = Variables::PLAYER_ITEMS_WEBHOOK;
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Moderation"
            ];
        }
        if ($item === "GodlyContraband") {
            // Create Webhook
            $message = "**Item:** Godly Contraband\n**Player:** {$player->getName()}";
            $webhook = Variables::PLAYER_ITEMS_WEBHOOK;
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Moderation"
            ];
        }
        if ($item === "HeroicContraband") {
            // Create Webhook
            $message = "**Item:** Heroic Contraband\n**Player:** {$player->getName()}";
            $webhook = Variables::PLAYER_ITEMS_WEBHOOK;
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Moderation"
            ];
        }
        # lootbox
        if ($item === "GKitLootbox") {
            // Create Webhook
            $message = "**Item:** GKit Lootbox\n**Player:** {$player->getName()}";
            $webhook = Variables::PLAYER_ITEMS_WEBHOOK;
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Moderation"
            ];
        }
        if ($item === "RankKitLootbox") {
            // Create Webhook
            $message = "**Item:** Rank Kit Lootbox\n**Player:** {$player->getName()}";
            $webhook = Variables::PLAYER_ITEMS_WEBHOOK;
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Moderation"
            ];
        }
        if ($item === "PrestigeKitLootbox") {
            // Create Webhook
            $message = "**Item:** Prestige Kit Lootbox\n**Player:** {$player->getName()}";
            $webhook = Variables::PLAYER_ITEMS_WEBHOOK;
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Moderation"
            ];
        }

        // Send Webhook
        if ($webhook === null) {
            return;
        } else {
            $player->getServer()->getAsyncPool()->submitTask(new Webhooks($webhook, serialize($curlopts)));
        }
    }

    /////////////////////////////// SERVER EVENTS WEBHOOK ///////////////////////////////

    public static function EventsWebhook($event, $name = null)
    {

        if($event === "Boss") {
            # Create Webhook
            $message = "> **Event:** Boss Spawned\n> **Boss:** $name";
            $webhook = Variables::EVENTS_WEBHOOK;
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Events"
            ];
        }
        if($event === "Bandit") {
            $bandit = substr($name, 0, 12);
            $rarity = substr($name, 13);
            # Create Webhook
            $message = "> **Event:** Bandit Spawned\n> **Bandit:** $bandit\n> **Rarity:** $rarity";
            $webhook = Variables::EVENTS_WEBHOOK;
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Events"
            ];
        }
        if ($event === "Stronghold") {
            # Create Webhook
            $message = "The Stronghold Event has started";
            $webhook = Variables::EVENTS_WEBHOOK;
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Events"
            ];
        }
        if ($event === "PrisonBreak") {
            # Create Webhook
            $message = "The Prison Break Event has started";
            $webhook = Variables::EVENTS_WEBHOOK;
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Events"
            ];
        }
        if ($event === "AlienInvasion") {
            # Create Webhook
            $message = "The Alien Invasion Event has started";
            $webhook = Variables::EVENTS_WEBHOOK;
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Events"
            ];
        }
        if ($event === "MeteorCompetition") {
            # Create Webhook
            $message = "The Meteor Competition has started";
            $webhook = Variables::EVENTS_WEBHOOK;
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Events"
            ];
        }

        // Send Webhook
        Server::getInstance()->getAsyncPool()->submitTask(new Webhooks($webhook, serialize($curlopts)));

    }

    /////////////////////////////// PLAYER DEATH MESSAGE ///////////////////////////////

    public function onDeath(PlayerDeathEvent $event)
    {

        $player = $event->getPlayer();
        $killer = $player->getLastDamageCause();

        if ($killer instanceof EntityDamageByEntityEvent) {
            $killer = $killer->getDamager();
            if ($killer instanceof Player) {
                // Create Webhook
                $message = "**" . $event->getPlayer()->getName() . "** has been killed by **" . $killer->getName() . "**.";
                $webhook = Variables::PLAYER_EVENTS;
                $curlopts = [
                    "content" => $message,
                    "username" => "Emporium | Moderation"
                ];
                // Send Webhook
                $this->plugin->getServer()->getAsyncPool()->submitTask(new Webhooks($webhook, serialize($curlopts)));
            }
        }
    }

    /////////////////////////////// PLAYER JOIN WEBHOOK ///////////////////////////////

    public function onJoin(PlayerJoinEvent $event)
    {

        // Create Webhook
        $count = count($this->plugin->getServer()->getOnlinePlayers());
        $message = "**{$event->getPlayer()->getName()}** has joined the server. **(" . $count . "/" . $this->plugin->getServer()->getMaxPlayers() . ")**";
        $webhook = Variables::PLAYER_EVENTS;
        $curlopts = [
            "content" => $message,
            "username" => "Emporium | Moderation"
        ];

        // Send Webhook
        $this->plugin->getServer()->getAsyncPool()->submitTask(new Webhooks($webhook, serialize($curlopts)));
    }

    /////////////////////////////// PLAYER QUIT WEBHOOK ///////////////////////////////

    public function onQuit(PlayerQuitEvent $event)
    {

        // Create Webhook
        $count = count($this->plugin->getServer()->getOnlinePlayers()) - 1;
        $message = "**{$event->getPlayer()->getName()}** has left the server. **(" . $count . "/" . $this->plugin->getServer()->getMaxPlayers() . ")**";
        $webhook = Variables::PLAYER_EVENTS;
        $curlopts = [
            "content" => $message,
            "username" => "Emporium | Moderation"
        ];

        // Send Webhook
        $this->plugin->getServer()->getAsyncPool()->submitTask(new Webhooks($webhook, serialize($curlopts)));
    }

    /////////////////////////////// COMMANDS WEBHOOK ///////////////////////////////

    public function onCommand(PlayerCommandPreprocessEvent $event)
    {

        // Remove Discord Pings
        $message = str_replace(["@everyone", "@here"], '', $event->getMessage());
        if ($message === "") {
            return;
        }

        // Create Webhook
        $message = "**" . $event->getSender()->getName() . "**: `" . $message . "`";
        if ($event->getCommand()[0] === "/") {

            $webhook = Variables::PLAYER_COMMANDS_WEBHOOK;
            // Create Command Webhook
            $curlopts = [
                "content" => $message,
                "username" => "EmporiumPvP | Commands"
            ];

        } else {

            $webhook = Variables::CHAT_LOGS_WEBHOOK;
            // Create Chat Webhook
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Chat"
            ];

        }

        // Send Webhook
        $this->plugin->getServer()->getAsyncPool()->submitTask(new Webhooks($webhook, serialize($curlopts)));
    }

}