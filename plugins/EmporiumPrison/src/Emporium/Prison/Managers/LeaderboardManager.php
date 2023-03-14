<?php

namespace Emporium\Prison\Managers;

use Emporium\Prison\Managers\misc\Translator;
use EmporiumCore\EmporiumCore;

use EmporiumCore\Managers\Data\DataManager;
use Emporium\Prison\Managers\DataManager as PDataManager;

use pocketmine\utils\TextFormat as TF;
use pocketmine\world\Position;

use WolfDen133\WFT\WFT;

class LeaderboardManager {

    private const LEADERBOARD_LEVEL = "leaderboardlevel";
    private const LEADERBOARD_MONEY = "leaderboardmoney";
    private const LEADERBOARD_PRISON = "leaderboardprison";
    private const WORMHOLE_TEXT = "wormholetext";
    private const TUTORIAL_WELCOME_TEXT = "tutorialwelcometext";
    private const SHOPS_TEXT = "shopstext";

    public function init (): void
    {
        self::registerLeaderboards();
        self::registerTexts();
    }

    public static function registerLeaderboards(): void {
        # leaderboards
        WFT::getInstance()->getTextManager()->registerText(self::LEADERBOARD_LEVEL, self::getTopLevelLeaderboard(), new Position(-1577.5, 175, -298.5, EmporiumCore::getInstance()->getServer()->getWorldManager()->getWorldByName("world")), true, false);
        WFT::getInstance()->getTextManager()->registerText(self::LEADERBOARD_MONEY, self::getTopMoneyLeaderboardText(), new Position(-1581.5, 175, -298.5, EmporiumCore::getInstance()->getServer()->getWorldManager()->getWorldByName("world")), true, false);
        WFT::getInstance()->getTextManager()->registerText(self::LEADERBOARD_PRISON, self::getTopPrisonLeaderboardText(), new Position(-1585.5, 175, -298.5, EmporiumCore::getInstance()->getServer()->getWorldManager()->getWorldByName("world")), true, false);
    }

    public static function registerTexts(): void {
        # tutorial world texts
        WFT::getInstance()->getTextManager()->registerText(self::WORMHOLE_TEXT, self::getTutorialWormholeText(), new Position(-24.5, 151, 15.5, EmporiumCore::getInstance()->getServer()->getWorldManager()->getWorldByName("TutorialMine")), true, false);
        WFT::getInstance()->getTextManager()->registerText(self::TUTORIAL_WELCOME_TEXT, self::getTutorialWelcomeText(), new Position(-36.5, 158, -2.5, EmporiumCore::getInstance()->getServer()->getWorldManager()->getWorldByName("TutorialMine")), true, false);
        WFT::getInstance()->getTextManager()->registerText(self::SHOPS_TEXT, self::getShopsText(), new Position(-29.5, 156, -14.5, EmporiumCore::getInstance()->getServer()->getWorldManager()->getWorldByName("TutorialMine")), true, false);
    }


    public static function update () : void {
        WFT::getInstance()->getTextManager()->getTextById(self::LEADERBOARD_LEVEL)->setText(self::getTopMoneyLeaderboardText());
        WFT::getInstance()->getTextManager()->getTextById(self::LEADERBOARD_MONEY)->setText(self::getTopLevelLeaderboard());
        WFT::getInstance()->getTextManager()->getTextById(self::LEADERBOARD_PRISON)->setText(self::getTopPrisonLeaderboardText());

        WFT::getInstance()->getTextManager()->getActions()->respawnToAll(self::LEADERBOARD_LEVEL);
        WFT::getInstance()->getTextManager()->getActions()->respawnToAll(self::LEADERBOARD_MONEY);
        WFT::getInstance()->getTextManager()->getActions()->respawnToAll(self::LEADERBOARD_PRISON);
    }

    /**
     * Return the money leaderboard text
     *
     * @return string
     */
    private static function getTopMoneyLeaderboardText () : string {
        $message = TF::BOLD . TF::GREEN . "Top Money" . "##";

        /* Get and sort money data */
        $moneyData = self::getMoneyData();
        arsort($moneyData);

        /* Map sorted data into an un-indexed array formatted array[] = [playerName, money] */
        $playerMoney = [];
        foreach($moneyData as $player => $money) $playerMoney[] = [$player, $money];

        /* Add the data to the message for the first 10 lines */
        for ($i = 1; $i <= 10; $i++)
        {
            /* If there is data for that field, set it to message, otherwise set blank line */
            if (isset($playerMoney[$i - 1]) && $playerMoney[$i - 1] > 1) $message .= TF::GRAY . "[" . TF::WHITE . "$i" . TF::GRAY . "] " . TF::AQUA . $playerMoney[$i - 1][0] . TF::GRAY . " - " . TF::GREEN . "$" . TF::WHITE . Translator::shortNumber($playerMoney[$i - 1][1]) . "#";
            else $message .= TF::GRAY . "[" . TF::WHITE . $i . TF::GRAY . "] --- #";
        }

        /* Returns sed message */
        return $message;
    }

    /**
     * Returns the prison break leaderboard text
     *
     * @return string
     */
    private static function getTopPrisonLeaderboardText(): string
    {
        $prisonBreak = self::getPrisonData();
        arsort($prisonBreak);

        $message = TF::BOLD . TF::GREEN . "Top Prison Break" . "#";
        $message .= "#";

        $prisonBreakData = [];
        foreach ($prisonBreak as $playerData => $prisonBreakWins) $prisonBreakData[] = [$playerData, $prisonBreakWins];

        rsort($prisonBreakData);

        for ($i = 1; $i <= 10; $i++) {
            if (isset($prisonBreakData[$i - 1])) $message .= TF::GRAY . "[" . TF::WHITE . "$i" . TF::GRAY . "] " . TF::AQUA . $prisonBreakData[$i - 1][0] . TF::GRAY . " - " . TF::WHITE . Translator::shortNumber($prisonBreakData[$i - 1][1]) . "#";
            else $message .= TF::GRAY . "[" . TF::WHITE . $i . TF::GRAY . "] --- #";
        }

        return $message;
    }

    private static function getTopLevelLeaderboard(): string {
        $playerLevelConfig = self::getLevelData();

        arsort($playerLevelConfig);

        $message = TF::BOLD . TF::GREEN . "Top Player Level" . "#";
        $message .= "#";

        $playerLevelData = [];
        foreach ($playerLevelConfig as $playerData => $playerLevel) $playerLevelData[] = [$playerData, $playerLevel];


        for ($i = 1; $i <= 10; $i++)
        {
            if (isset($playerLevelData[$i - 1]))
                $message .= TF::GRAY . "[" . TF::WHITE . "$i" . TF::GRAY . "] " . TF::AQUA . $playerLevelData[$i - 1][0] . TF::GRAY . " - " . TF::WHITE . Translator::shortNumber($playerLevelData[$i - 1][1]) . "#";
            else $message .= TF::GRAY . "[" . TF::WHITE . $i . TF::GRAY . "] --- #";
        }

        return $message;
    }

    private static function getTutorialWormholeText(): string {
        return TF::GOLD . "Welcome to the " . TF::BOLD . TF::GOLD . "Wormhole!" . TF::RESET . TF::EOL . TF::AQUA . "When your pickaxe has reached 100% " . TF::BOLD . "Energy" . TF::RESET . TF::EOL . TF::AQUA . "You may throw it into the " . TF::BOLD . TF::GOLD . "Wormhole " . TF::RESET . TF::AQUA . "to forge it!" . TF::EOL . TF::GRAY . "(Yes, really, drop your pickaxe while at the wormhole)";
    }

    private static function getTutorialWelcomeText(): string {
        $message = TF::AQUA . "Welcome to " . TF::BOLD . TF::GOLD . "Emporium Prison" . "#";
        $message .= "#";
        $message .= TF::RESET . TF::AQUA . "You are in the Training Area" . "#";
        $message .= TF::AQUA . "Here you will learn the basics before you are" . "#";
        $message .= TF::AQUA . "released into the Yard" . "#";
        $message .= "#";
        $message .= TF::AQUA . "To get started check your chat" . "#";
        $message .= TF::AQUA . "You have been sent your first " . TF::YELLOW . "Quest" . "#";

        return $message;
    }

    private static function getShopsText(): string {
        return TF::RED . "Shops This Way";
    }


    /**
     * Returns an unsorted array in the format array[playerName] => balance
     */
    private static function getMoneyData(): array
    {
        $playerMoney = [];

        # get all player money data
        foreach(self::getPlayers() as $player) {
            $balance = DataManager::getOfflinePlayerData($player, "Players", "Money");

            $playerMoney[$player] = $balance;
        }

        return $playerMoney;
    }

    /**
     * Returns an unsorted array in the format array[playerName] => balance
     */
    private static function getLevelData(): array
    {
        $playerMoney = [];

        # get all player money data
        foreach(self::getPlayers() as $player) {
            $balance = PDataManager::getOfflinePlayerData($player, "Players", "level");

            $playerMoney[$player] = $balance;
        }

        return $playerMoney;
    }

    /**
     * Returns an unsorted array in the format array[playerName] => balance
     * TODO: Prison Break Data
     */
    private static function getPrisonData(): array
    {
        return [];
    }

    /**
     * Returns an array of player names
     *
     * @return array
     */
    private static function getPlayers(): array {
        $files = scandir(EmporiumCore::getInstance()->getDataFolder() . "PlayerData/Players");
        $players = [];
        foreach($files as $file) {
            if (in_array($file, ["..", "."])) continue;
            if (str_contains(".tmp", $file)) continue;
            $players[] = str_replace(".yml", "", $file);
        }
        return $players;
    }

}