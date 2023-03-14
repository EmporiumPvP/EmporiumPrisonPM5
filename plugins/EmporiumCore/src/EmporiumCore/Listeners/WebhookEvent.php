<?php

namespace EmporiumCore\Listeners;

use pocketmine\player\Player;

use pocketmine\event\Listener;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\player\{PlayerCommandPreprocessEvent, PlayerDeathEvent, PlayerJoinEvent, PlayerQuitEvent};

use EmporiumCore\EmporiumCore;

use EmporiumCore\Managers\Misc\Webhooks;

use pocketmine\Server;

class WebhookEvent implements Listener {

    private EmporiumCore $plugin;

    public function __construct(EmporiumCore $plugin) {
        $this->plugin = $plugin;
    }

    /////////////////////////////// DEATH ///////////////////////////////
    public function onDeath(PlayerDeathEvent $event) {

        $player = $event->getPlayer();
        $killer = $player->getLastDamageCause();

        if ($killer instanceof EntityDamageByEntityEvent) {
            $killer = $killer->getDamager();
            if ($killer instanceof Player) {
                // Create Webhook
                $message = "**" . $event->getPlayer()->getName() . "** has been killed by **" . $killer->getName() . "**.";
                $webhook = "https://discord.com/api/webhooks/1073240681985880114/IH8qqjVhtUf-snbdC0oHA36F_9rcLFee5TdIwnPgNyZwz9P-c-SPyl5qeExZhUAv7InL";
                $curlopts = [
                    "content" => $message,
                    "username" => "Emporium | Moderation"
                ];
                // Send Webhook
                $this->plugin->getServer()->getAsyncPool()->submitTask(new Webhooks($event->getPlayer()->getName(), $webhook, serialize($curlopts)));
            }
        }
    }

    /////////////////////////////// JOIN ///////////////////////////////
    public function onJoin(PlayerJoinEvent $event) {

        // Create Webhook
        $count = count($this->plugin->getServer()->getOnlinePlayers());
        $message = "**{$event->getPlayer()->getName()}** has joined the server. **(" . $count . "/" . $this->plugin->getServer()->getMaxPlayers() . ")**";
        $webhook = "https://discord.com/api/webhooks/1073240681985880114/IH8qqjVhtUf-snbdC0oHA36F_9rcLFee5TdIwnPgNyZwz9P-c-SPyl5qeExZhUAv7InL";
        $curlopts = [
            "content" => $message,
            "username" => "Emporium | Moderation"
        ];

        // Send Webhook
        $this->plugin->getServer()->getAsyncPool()->submitTask(new Webhooks($event->getPlayer()->getName(), $webhook, serialize($curlopts)));
    }

    /////////////////////////////// QUIT ///////////////////////////////
    public function onQuit(PlayerQuitEvent $event) {

        // Create Webhook
        $count = count($this->plugin->getServer()->getOnlinePlayers()) - 1;
        $message = "**{$event->getPlayer()->getName()}** has left the server. **(" . $count . "/" . $this->plugin->getServer()->getMaxPlayers() . ")**";
        $webhook = "https://discord.com/api/webhooks/1073240681985880114/IH8qqjVhtUf-snbdC0oHA36F_9rcLFee5TdIwnPgNyZwz9P-c-SPyl5qeExZhUAv7InL";
        $curlopts = [
            "content" => $message,
            "username" => "Emporium | Moderation"
        ];

        // Send Webhook
        $this->plugin->getServer()->getAsyncPool()->submitTask(new Webhooks($event->getPlayer()->getName(), $webhook, serialize($curlopts)));
    }

    /////////////////////////////// SEND MESSAGE ///////////////////////////////
    public function onCommand(PlayerCommandPreprocessEvent $event) {

        // Remove Discord Pings
        $message = str_replace(["@everyone", "@here"], '', $event->getMessage());
        if($message === "") {
            return;
        }

        // Create Webhook
        $message = "**" . $event->getPlayer()->getName() . "**: `" . $message . "`";
        if ($event->getMessage()[0] === "/") {

            // Create Command Webhook
            $webhook = "https://discord.com/api/webhooks/1073240681985880114/IH8qqjVhtUf-snbdC0oHA36F_9rcLFee5TdIwnPgNyZwz9P-c-SPyl5qeExZhUAv7InL";
            $curlopts = [
                "content" => $message,
                "username" => "EmporiumPvP | Commands"
            ];

        } else {

            // Create Chat Webhook
            $webhook = "https://discord.com/api/webhooks/1073240681985880114/IH8qqjVhtUf-snbdC0oHA36F_9rcLFee5TdIwnPgNyZwz9P-c-SPyl5qeExZhUAv7InL";
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Chat"
            ];

        }

        // Send Webhook
        $this->plugin->getServer()->getAsyncPool()->submitTask(new Webhooks($event->getPlayer()->getName(), $webhook, serialize($curlopts)));
    }

    /////////////////////////////// STAFF WEBHOOK ///////////////////////////////
    public static function staffWebhook($sender, $object, $command) {

        if ($command === "Ban") {
            // Create Webhook
            $message = "**{$sender->getName()}** has banned **{$object->getName()}**";
            $webhook = "https://discord.com/api/webhooks/1073240681985880114/IH8qqjVhtUf-snbdC0oHA36F_9rcLFee5TdIwnPgNyZwz9P-c-SPyl5qeExZhUAv7InL";
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Moderation"
            ];
        }
        if ($command === "ClearChat") {
            // Create Webhook
            $message = "**{$sender->getName()}** has cleared chat";
            $webhook = "https://discord.com/api/webhooks/1073240681985880114/IH8qqjVhtUf-snbdC0oHA36F_9rcLFee5TdIwnPgNyZwz9P-c-SPyl5qeExZhUAv7InL";
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Moderation"
            ];
        }
        if ($command === "Freeze") {
            // Create Webhook
            $message = "**{$sender->getName()}** has froze **{$object->getName()}**";
            $webhook = "https://discord.com/api/webhooks/1073240681985880114/IH8qqjVhtUf-snbdC0oHA36F_9rcLFee5TdIwnPgNyZwz9P-c-SPyl5qeExZhUAv7InL";
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Moderation"
            ];
        }
        switch($command) {
            case "creative":
            case "survival":
            if ($object === $sender) {
                // Create Webhook
                $message = "**{$sender->getName()}** has changed their gamemode";
                $webhook = "https://discord.com/api/webhooks/1073240681985880114/IH8qqjVhtUf-snbdC0oHA36F_9rcLFee5TdIwnPgNyZwz9P-c-SPyl5qeExZhUAv7InL";
                $curlopts = [
                    "content" => $message,
                    "username" => "Emporium | Moderation"
                ];
            } else {
                // Create Webhook
                $message = "**{$sender->getName()}** has changed **{$object->getName()}**'s gamemode";
                $webhook = "https://discord.com/api/webhooks/1073240681985880114/IH8qqjVhtUf-snbdC0oHA36F_9rcLFee5TdIwnPgNyZwz9P-c-SPyl5qeExZhUAv7InL";
                $curlopts = [
                    "content" => $message,
                    "username" => "Emporium | Moderation"
                ];
            }
        }
        if ($command === "item") {
            // Create Webhook
            $message = "**{$sender->getName()}** has given themselves all **$object**";
            $webhook = "https://discord.com/api/webhooks/1073240681985880114/IH8qqjVhtUf-snbdC0oHA36F_9rcLFee5TdIwnPgNyZwz9P-c-SPyl5qeExZhUAv7InL";
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Moderation"
            ];
        }
        if ($command === "Key") {
            if ($object === "Keyall") {
                // Create Webhook
                $message = "**{$sender->getName()}** hosted a **keyall**";
                $webhook = "https://discord.com/api/webhooks/1073240681985880114/IH8qqjVhtUf-snbdC0oHA36F_9rcLFee5TdIwnPgNyZwz9P-c-SPyl5qeExZhUAv7InL";
                $curlopts = [
                    "content" => $message,
                    "username" => "Emporium | Moderation"
                ];
            } else {
                // Create Webhook
                $message = "**{$sender->getName()}** has given keys to **{$object->getName()}**";
                $webhook = "https://discord.com/api/webhooks/1073240681985880114/IH8qqjVhtUf-snbdC0oHA36F_9rcLFee5TdIwnPgNyZwz9P-c-SPyl5qeExZhUAv7InL";
                $curlopts = [
                    "content" => $message,
                    "username" => "Emporium | Moderation"
                ];
            }
        }
        if ($command === "Kick") {
            // Create Webhook
            $message = "**{$sender->getName()}** has kicked **{$object->getName()}**";
            $webhook = "https://discord.com/api/webhooks/1073240681985880114/IH8qqjVhtUf-snbdC0oHA36F_9rcLFee5TdIwnPgNyZwz9P-c-SPyl5qeExZhUAv7InL";
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Moderation"
            ];
        }
        if ($command === "Kill") {
            // Create Webhook
            $message = "**{$sender->getName()}** has force killed **{$object->getName()}**";
            $webhook = "https://discord.com/api/webhooks/1073240681985880114/IH8qqjVhtUf-snbdC0oHA36F_9rcLFee5TdIwnPgNyZwz9P-c-SPyl5qeExZhUAv7InL";
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Moderation"
            ];
        }
        if ($command === "Mute") {
            // Create Webhook
            $message = "**{$sender->getName()}** has muted **{$object->getName()}**";
            $webhook = "https://discord.com/api/webhooks/1073240681985880114/IH8qqjVhtUf-snbdC0oHA36F_9rcLFee5TdIwnPgNyZwz9P-c-SPyl5qeExZhUAv7InL";
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Moderation"
            ];
        }
        if ($command === "Teleport.To") {
            // Create Webhook
            $message = "**{$sender->getName()}** has force teleported to **{$object->getName()}**";
            $webhook = "https://discord.com/api/webhooks/1073240681985880114/IH8qqjVhtUf-snbdC0oHA36F_9rcLFee5TdIwnPgNyZwz9P-c-SPyl5qeExZhUAv7InL";
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Moderation"
            ];
        }
        if ($command === "Teleport.Here") {
            // Create Webhook
            $message = "**{$sender->getName()}** has force teleported **{$object->getName()}** to themselves";
            $webhook = "https://discord.com/api/webhooks/1073240681985880114/IH8qqjVhtUf-snbdC0oHA36F_9rcLFee5TdIwnPgNyZwz9P-c-SPyl5qeExZhUAv7InL";
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Moderation"
            ];
        }
        if ($command === "Teleport.Coordinates") {
            // Create Webhook
            $message = "**{$sender->getName()}** has force teleported to the coordinates **$object[0], $object[1], $object[2]**";
            $webhook = "https://discord.com/api/webhooks/1073240681985880114/IH8qqjVhtUf-snbdC0oHA36F_9rcLFee5TdIwnPgNyZwz9P-c-SPyl5qeExZhUAv7InL";
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Moderation"
            ];
        }
        if ($command === "Unban") {
            // Create Webhook
            $message = "**{$sender->getName()}** has unbanned **$object**";
            $webhook = "https://discord.com/api/webhooks/1073240681985880114/IH8qqjVhtUf-snbdC0oHA36F_9rcLFee5TdIwnPgNyZwz9P-c-SPyl5qeExZhUAv7InL";
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Moderation"
            ];
        }
        if ($command === "Unfreeze") {
            // Create Webhook
            $message = "**{$sender->getName()}** has unfrozen **$object**";
            $webhook = "https://discord.com/api/webhooks/1073240681985880114/IH8qqjVhtUf-snbdC0oHA36F_9rcLFee5TdIwnPgNyZwz9P-c-SPyl5qeExZhUAv7InL";
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Moderation"
            ];
        }
        if ($command === "Unmute") {
            // Create Webhook
            $message = "**{$sender->getName()}** has unmuted **$object**";
            $webhook = "https://discord.com/api/webhooks/1073240681985880114/IH8qqjVhtUf-snbdC0oHA36F_9rcLFee5TdIwnPgNyZwz9P-c-SPyl5qeExZhUAv7InL";
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Moderation"
            ];
        }
        if ($command === "Warn") {
            // Create Webhook
            $message = "**{$sender->getName()}** has warned **{$object->getName()}**";
            $webhook = "https://discord.com/api/webhooks/1073240681985880114/IH8qqjVhtUf-snbdC0oHA36F_9rcLFee5TdIwnPgNyZwz9P-c-SPyl5qeExZhUAv7InL";
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Moderation"
            ];
        }

        // Send Webhook
        $sender->getServer()->getAsyncPool()->submitTask(new Webhooks($sender->getName(), $webhook, serialize($curlopts)));
    }

    /////////////////////////////// ITEM WEBHOOK ///////////////////////////////
    public static function itemWebhook($player, $item) {

        if ($item === "GKitHeroicVulkarion") {
            // Create Webhook
            $message = "**{$player->getName()}** has opened a **Heroic Vulkarion God Kit**";
            $webhook = "https://discord.com/api/webhooks/1073240681985880114/IH8qqjVhtUf-snbdC0oHA36F_9rcLFee5TdIwnPgNyZwz9P-c-SPyl5qeExZhUAv7InL";
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Blackscroll"
            ];
        }
        if ($item === "GKitHeroicZenith") {
            // Create Webhook
            $message = "**{$player->getName()}** has opened a **Heroic Zenith God Kit**";
            $webhook = "https://discord.com/api/webhooks/1073240681985880114/IH8qqjVhtUf-snbdC0oHA36F_9rcLFee5TdIwnPgNyZwz9P-c-SPyl5qeExZhUAv7InL";
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Blackscroll"
            ];
        }
        if ($item === "GKitHeroicColossus") {
            // Create Webhook
            $message = "**{$player->getName()}** has opened a **Heroic Colossus God Kit**";
            $webhook = "https://discord.com/api/webhooks/1073240681985880114/IH8qqjVhtUf-snbdC0oHA36F_9rcLFee5TdIwnPgNyZwz9P-c-SPyl5qeExZhUAv7InL";
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Blackscroll"
            ];
        }
        if ($item === "GKitHeroicWarlock") {
            // Create Webhook
            $message = "**{$player->getName()}** has opened a **Heroic Warlock God Kit**";
            $webhook = "https://discord.com/api/webhooks/1073240681985880114/IH8qqjVhtUf-snbdC0oHA36F_9rcLFee5TdIwnPgNyZwz9P-c-SPyl5qeExZhUAv7InL";
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Blackscroll"
            ];
        }
        if ($item === "GKitHeroicSlaughter") {
            // Create Webhook
            $message = "**{$player->getName()}** has opened a **Heroic Slaughter God Kit**";
            $webhook = "https://discord.com/api/webhooks/1054909649889005711/9UsLrQ5jPjkCksT34MOUotlzFPaic5UcYfrsxJRYV9q9_OdZ9ixK_yQDtADfZTC0Hd3S";
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Blackscroll"
            ];
        }
        if ($item === "GKitHeroicAtheos") {
            // Create Webhook
            $message = "**{$player->getName()}** has opened a **Heroic Atheos God Kit**";
            $webhook = "https://discord.com/api/webhooks/1054909649889005711/9UsLrQ5jPjkCksT34MOUotlzFPaic5UcYfrsxJRYV9q9_OdZ9ixK_yQDtADfZTC0Hd3S";
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Blackscroll"
            ];
        }
        if ($item === "GKitHeroicApetus") {
            // Create Webhook
            $message = "**{$player->getName()}** has opened a **Heroic Apetus God Kit**";
            $webhook = "https://discord.com/api/webhooks/1054909649889005711/9UsLrQ5jPjkCksT34MOUotlzFPaic5UcYfrsxJRYV9q9_OdZ9ixK_yQDtADfZTC0Hd3S";
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Blackscroll"
            ];
        }
        if ($item === "GKitHeroicBroteas") {
            // Create Webhook
            $message = "**{$player->getName()}** has opened a **Heroic Broteas God Kit**";
            $webhook = "https://discord.com/api/webhooks/1054909649889005711/9UsLrQ5jPjkCksT34MOUotlzFPaic5UcYfrsxJRYV9q9_OdZ9ixK_yQDtADfZTC0Hd3S";
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Blackscroll"
            ];
        }
        if ($item === "GKitHeroicGrimReaper") {
            // Create Webhook
            $message = "**{$player->getName()}** has opened a **Heroic Grim Reaper God Kit**";
            $webhook = "https://discord.com/api/webhooks/1054909649889005711/9UsLrQ5jPjkCksT34MOUotlzFPaic5UcYfrsxJRYV9q9_OdZ9ixK_yQDtADfZTC0Hd3S";
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Blackscroll"
            ];
        }
        if ($item === "GKitHeroicExecutioner") {
            // Create Webhook
            $message = "**{$player->getName()}** has opened a **Heroic Executioner God Kit**";
            $webhook = "https://discord.com/api/webhooks/1054909649889005711/9UsLrQ5jPjkCksT34MOUotlzFPaic5UcYfrsxJRYV9q9_OdZ9ixK_yQDtADfZTC0Hd3S";
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Blackscroll"
            ];
        }
        if ($item === "GKitHeroicIapetus") {
            // Create Webhook
            $message = "**{$player->getName()}** has opened a **Heroic Iapetus God Kit**";
            $webhook = "https://discord.com/api/webhooks/1054909649889005711/9UsLrQ5jPjkCksT34MOUotlzFPaic5UcYfrsxJRYV9q9_OdZ9ixK_yQDtADfZTC0Hd3S";
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Blackscroll"
            ];
        }
        if ($item === "GKitHeroicExecutioner") {
            // Create Webhook
            $message = "**{$player->getName()}** has opened a **Heroic Executioner God Kit**";
            $webhook = "https://discord.com/api/webhooks/1054909649889005711/9UsLrQ5jPjkCksT34MOUotlzFPaic5UcYfrsxJRYV9q9_OdZ9ixK_yQDtADfZTC0Hd3S";
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Blackscroll"
            ];
        }
        if ($item === "GKitBlacksmith") {
            // Create Webhook
            $message = "**{$player->getName()}** has opened a **Wormhole God Kit**";
            $webhook = "https://discord.com/api/webhooks/1054909649889005711/9UsLrQ5jPjkCksT34MOUotlzFPaic5UcYfrsxJRYV9q9_OdZ9ixK_yQDtADfZTC0Hd3S";
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Blackscroll"
            ];
        }
        if ($item === "GKitHero") {
            // Create Webhook
            $message = "**{$player->getName()}** has opened a **Hero God Kit**";
            $webhook = "https://discord.com/api/webhooks/1054909649889005711/9UsLrQ5jPjkCksT34MOUotlzFPaic5UcYfrsxJRYV9q9_OdZ9ixK_yQDtADfZTC0Hd3S";
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Blackscroll"
            ];
        }
        if ($item === "GKitCyborg") {
            // Create Webhook
            $message = "**{$player->getName()}** has opened a **Cyborg God Kit**";
            $webhook = "https://discord.com/api/webhooks/1054909649889005711/9UsLrQ5jPjkCksT34MOUotlzFPaic5UcYfrsxJRYV9q9_OdZ9ixK_yQDtADfZTC0Hd3S";
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Blackscroll"
            ];
        }
        if ($item === "GKitCrucible") {
            // Create Webhook
            $message = "**{$player->getName()}** has opened a **Crucible God Kit**";
            $webhook = "https://discord.com/api/webhooks/1054909649889005711/9UsLrQ5jPjkCksT34MOUotlzFPaic5UcYfrsxJRYV9q9_OdZ9ixK_yQDtADfZTC0Hd3S";
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Blackscroll"
            ];
        }
        if ($item === "GKitHunter") {
            // Create Webhook
            $message = "**{$player->getName()}** has opened a **Hunter God Kit**";
            $webhook = "https://discord.com/api/webhooks/1054909649889005711/9UsLrQ5jPjkCksT34MOUotlzFPaic5UcYfrsxJRYV9q9_OdZ9ixK_yQDtADfZTC0Hd3S";
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Blackscroll"
            ];
        }

        // Send Webhook
        if($webhook === null) {
            return;
        } else {
            $player->getServer()->getAsyncPool()->submitTask(new Webhooks($player->getName(), $webhook, serialize($curlopts)));
        }
    }

    /////////////////////////////// EVENTS WEBHOOK ///////////////////////////////
    public static function EventsWebhook($player, $event) {

        if($event === "Stronghold") {
            # Create Webhook
            $message = "The Stronghold Event has started";
            $webhook = "https://discord.com/api/webhooks/1054914712770465843/dbiR0pfZFb05u3-DwNgw8eTcM8nFeJSUyTP8IvYbUfQrE9faa5UWBT-mbc8J612l4tOr";
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Events"
            ];
        }
        if($event === "PrisonBreak") {
            # Create Webhook
            $message = "The Prison Break Event has started";
            $webhook = "https://discord.com/api/webhooks/1054914712770465843/dbiR0pfZFb05u3-DwNgw8eTcM8nFeJSUyTP8IvYbUfQrE9faa5UWBT-mbc8J612l4tOr";
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Events"
            ];
        }
        if($event === "AlienInvasion") {
            # Create Webhook
            $message = "The Alien Invasion Event has started";
            $webhook = "https://discord.com/api/webhooks/1054914712770465843/dbiR0pfZFb05u3-DwNgw8eTcM8nFeJSUyTP8IvYbUfQrE9faa5UWBT-mbc8J612l4tOr";
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Events"
            ];
        }
        if($event === "MeteorCompetition") {
            # Create Webhook
            $message = "The Meteor Competition has started";
            $webhook = "https://discord.com/api/webhooks/1054914712770465843/dbiR0pfZFb05u3-DwNgw8eTcM8nFeJSUyTP8IvYbUfQrE9faa5UWBT-mbc8J612l4tOr";
            $curlopts = [
                "content" => $message,
                "username" => "Emporium | Events"
            ];
        }

        // Send Webhook
        Server::getInstance()->getAsyncPool()->submitTask(new Webhooks($player, $webhook, serialize($curlopts)));

    }

}