<?php

declare(strict_types=1);

namespace EmporiumCore;

use pocketmine\utils\TextFormat as TF;

interface Variables {

    public const NAME = 'EmporiumPvP';
    public const DOMAIN_LINK = 'emporiumpvp.com';
    public const DISCORD_LINK = 'discord.gg/emporiumpvp';
    public const STORE_LINK = 'https://store.emporiumpvp.com';
    public const VOTE_LINK = 'https://vote.emporiumpvp.com';

    # webhooks
    public const CHAT_LOGS_WEBHOOK = "https://discord.com/api/webhooks/1092930374096666695/RJ-n93NTzNPbMWFP70HVGYABcMC2W0brQy8_f-4_WEvcNroZ8wOgwvYmAZFERjzw1oLl";
    public const PLAYER_COMMANDS_WEBHOOK = "https://discord.com/api/webhooks/1073240681985880114/IH8qqjVhtUf-snbdC0oHA36F_9rcLFee5TdIwnPgNyZwz9P-c-SPyl5qeExZhUAv7InL";
    public const PLAYER_PUNISHMENTS_WEBHOOK = "https://discord.com/api/webhooks/1092931028240322630/scMHHIk0GvNNh9Hg6RThJMR7RbhYkIpMCTjI6Nh4DbWDez1DTBmC6awnJCNskEtDUQrg";
    public const PLAYER_ITEMS_WEBHOOK = "https://discord.com/api/webhooks/1092932001947975721/T05LcXNSuz9fbarn8Q90xLfJdlpmfgZfW0FaJ0bjRfP6ZYSnFwM4R6uiK9u-Yz6T1XZI";
    public const EVENTS_WEBHOOK = "https://discord.com/api/webhooks/1054914712770465843/dbiR0pfZFb05u3-DwNgw8eTcM8nFeJSUyTP8IvYbUfQrE9faa5UWBT-mbc8J612l4tOr";
    public const PLAYER_EVENTS = "https://discord.com/api/webhooks/1092933251821215846/3cbDxjmJ-jSr06q0IuS88d55pgmhY2nbkpVUHlucT_dwESvpUypMJp_zsMZnfiE5bTsT";

    public const SERVER_PREFIX = TF::BOLD . TF::AQUA . 'Emporium' . TF::DARK_GRAY . ' >> ' . TF::RESET;
    public const ERROR_PREFIX = TF::BOLD . TF::RED . 'Error' . TF::DARK_GRAY . ' >> ' . TF::RESET;


    public const WARDEN_PREFIX = TF::BOLD . TF::AQUA . "WAR" . TF::RED . "DEN " . TF::RESET;
    public const WARDEN_WEBHOOK = 'https://discord.com/api/webhooks/1061317597448114196/LmApAvTvXnkq3MwfmOmUJ_mqDvVoM0XTtlVSNPE0cKxYh-GUgKl8LOTOVcarLnWnRr9Y'; # ANTI CHEAT

    public const BAN_HEADER = TF::BOLD . TF::RED . 'You are banned from ' . TF::AQUA . 'Emporium' . TF::DARK_AQUA . 'PvP' . TF::RESET;
    public const BAN_ALT_HEADER = TF::BOLD . TF::RED . 'An account linked to you is banned from' . TF::AQUA . 'Emporium' . TF::DARK_AQUA . 'PvP' . TF::RESET;
    public const BLACKLIST_HEADER = TF::BOLD . TF::RED . 'You are blacklisted from ' . TF::AQUA . 'Emporium' . TF::DARK_AQUA . 'PvP' . TF::RESET;
    public const BLACKLIST_ALT_HEADER = TF::BOLD . TF::RED . 'An account linked to you is blacklisted from ' . TF::AQUA . 'Emporium' . TF::DARK_AQUA . 'PvP' . TF::RESET;

    public const COMBAT_TAG = 20;
    public const PEARL_COOLDOWN = 300;
    public const AGRO_TICKS = 20;

    public const DAY = 86400;
    public const HOUR = 3600;
    public const MINUTE = 60;

}