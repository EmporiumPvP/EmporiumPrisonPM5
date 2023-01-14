<?php

declare(strict_types=1);

namespace Emporium\Prison;

use pocketmine\utils\TextFormat as TF;

interface Variables {

    public const SERVER_NAME = "EmporiumMC";
    public const DOMAIN_LINK = "emporiummc.org";
    public const DISCORD_LINK = "discord.gg/emporiummc";
    public const STORE_LINK = "https://store.emporiummc.org";
    public const VOTE_LINK = "https://vote.emporiummc.org";

    public const DIRECTORY = "C:/Users/brant/Desktop/EmporiumPrison/plugin_data/EmporiumPrison/";
    public const SERVER_PREFIX = TF::BOLD . TF::AQUA . "Emporium" . TF::DARK_GRAY . " >> " . TF::RESET;
    public const ERROR_PREFIX = TF::BOLD . TF::RED . "Error" . TF::DARK_GRAY . " >> " . TF::RESET;
    public const WARDEN_PREFIX = TF::BOLD . TF::DARK_AQUA . "Warden" .TF::DARK_GRAY . " >> " . TF::RESET;
    public const FILE_CREATED_PREFIX = TF::AQUA . "[FILE CREATED]" . TF::GREEN;
    public const FILE_LOADED_PREFIX = TF::AQUA . "[FILE LOADED]" . TF::GREEN;
    public const INCORRECT_VERSION_MESSAGE = TF::BOLD . TF::RED . "INCORRECT PLUGIN VERSION SHUTTING DOWN SERVER";
    public const PLUGIN_VERSION = "EmporiumPrisonPre-alpha1.0.0";

    public const WARDEN_WEBHOOK = "https://discord.com/api/webhooks/1061317597448114196/LmApAvTvXnkq3MwfmOmUJ_mqDvVoM0XTtlVSNPE0cKxYh-GUgKl8LOTOVcarLnWnRr9Y"; # ANTI CHEAT
    public const EVENTS_WEBHOOK = "https://discord.com/api/webhooks/1024947135105482752/5znAr02R-exGP-H-SzHJcehY_cCaJqAj8zzf1uszZXi17ppKg_g5460GTs0sJmmjhBaP"; # SERVER EVENTS

    public const BANNED_MESSAGE = TF::BOLD . TF::RED . 'You are banned from ' . TF::AQUA . 'Emporium' . TF::DARK_AQUA . 'MC' . TF::RESET;
    public const BANNED_ALT_HEADER = TF::BOLD . TF::RED . 'An account linked to you is banned from' . TF::AQUA . 'Emporium' . TF::DARK_AQUA . 'MC' . TF::RESET;
    public const BLACKLIST_MESSAGE = TF::BOLD . TF::RED . 'You are blacklisted from ' . TF::AQUA . 'Emporium' . TF::DARK_AQUA . 'MC' . TF::RESET;
    public const BLACKLIST_ALT_MESSAGE = TF::BOLD . TF::RED . "An account linked to you is blacklisted from " . TF::AQUA . "Emporium" . TF::DARK_AQUA . "MC" . TF::RESET;

    public const WORLD_LOBBY = "Lobby"; // https://www.mediafire.com/file/lhifzblm1ofvbg0/Vasar_Greek_Style_Lobby.zip/file
    public const WORLD_WARZONE = "Warzone"; // https://www.mediafire.com/file/kc3ivmrzjd8a115/vasar_nodebuff_ffa_tetris.zip/file
    public const WORLD_MINES = "Mines";
    public const WORLD_TUTORIAL = "Tutorial";

    public const COMBAT_TAG = 20;
    public const PEARL_COOLDOWN = 300;
    public const GAPPLE_COOLDOWN = 300;
    public const AGRO_TICKS = 20;

    public const BASIC_SETTINGS_CHOICES_ARRAY = ['§aEnabled', '§cDisabled'];

    public const DAY = 86400;
    public const HOUR = 3600;
    public const MINUTE = 60;

}