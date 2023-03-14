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

    public const SERVER_PREFIX = TF::BOLD . TF::AQUA . 'Emporium' . TF::DARK_GRAY . ' >> ' . TF::RESET;
    public const ERROR_PREFIX = TF::BOLD . TF::RED . 'Error' . TF::DARK_GRAY . ' >> ' . TF::RESET;


    public const WARDEN_PREFIX = TF::BOLD . TF::AQUA . "WAR" . TF::RED . "DEN " . TF::RESET;
    public const WARDEN_WEBHOOK = 'https://discord.com/api/webhooks/1061317597448114196/LmApAvTvXnkq3MwfmOmUJ_mqDvVoM0XTtlVSNPE0cKxYh-GUgKl8LOTOVcarLnWnRr9Y'; # ANTI CHEAT
    public const EVENTS_WEBHOOK = 'https://discord.com/api/webhooks/1024947135105482752/5znAr02R-exGP-H-SzHJcehY_cCaJqAj8zzf1uszZXi17ppKg_g5460GTs0sJmmjhBaP'; # SERVER EVENTS

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