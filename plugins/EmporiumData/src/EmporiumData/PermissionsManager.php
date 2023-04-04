<?php

namespace EmporiumData;

use EmporiumData\Provider\JsonProvider;
use EmporiumData\Rank\RankManager;
use pocketmine\permission\DefaultPermissions;
use pocketmine\Server;
use pocketmine\utils\Config;

class PermissionsManager
{
    private Loader $plugin;

    private static self $instance;

    /** @var array<string, array<string>>*/
    private array $customPermissions = [];

    /** @var array<string, array<string> */
    private array $rankPermissions = [];

    /** @var array<string, string> */
    private array $inheritance = [];

    public function __construct(Loader $loader)
    {
        self::$instance = $this;
       $this->plugin = $loader;
    }

    public function load () : void
    {
        foreach (RankManager::getInstance()->getRanks() as $rank) {
            $this->inheritance[$rank->getName()] = $rank->getInheritance();
            $this->rankPermissions[$rank->getName()] = $rank->getPermissions();
        }

        foreach (DataManager::getInstance()->getPlayerNames() as $playerXuid) $this->customPermissions[$playerXuid] = DataManager::getInstance()->getPlayerData($playerXuid, "permissions");
    }

    public function save () : void
    {
        foreach (DataManager::getInstance()->getPlayerNames() as $playerXuid) $this->customPermissions[$playerXuid] = DataManager::getInstance()->getPlayerData($playerXuid, "permissions");
    }

    /**
     * @param string $toXuid
     * @param array<string> $permissions
     * @return void
     */
    public function givePermissions (string $toXuid, array $permissions) : void
    {
        $existingPermissions = DataManager::getInstance()->getPlayerData($toXuid, "permissions");

        foreach ($permissions as $permission) $existingPermissions[] = $permission;

        DataManager::getInstance()->setPlayerData($toXuid, "permissions", $existingPermissions);
    }

    /**
     * @param string $toXuid
     * @param array<string> $permissions
     * @return void
     */
    public function takePermissions (string $toXuid, array $permissions) : void
    {
        $existingPermissions = DataManager::getInstance()->getPlayerData($toXuid, "permissions");

        foreach ($permissions as $permission) {
            if (!isset($existingPermissions[$permission])) continue;

            unset($existingPermissions[$permission]);
        }

        DataManager::getInstance()->setPlayerData($toXuid, "permissions", $existingPermissions);
    }


    public function checkPermission (string $toXuid, string $permission) : bool
    {
        if (!is_null($player = DataManager::getInstance()->getPlayerByXuid($toXuid))) {
            if ($player->hasPermission(DefaultPermissions::ROOT_OPERATOR)) return true;
        }

        $rank = strtolower(DataManager::getInstance()->getPlayerData($toXuid, "profile.rank"));

        if (!in_array($permission, $this->rankPermissions[$rank])) return $this->checkLowerRankPermissions($rank, $permission);

        return true;
    }

    private function checkLowerRankPermissions (string $rank, string $permission) : bool
    {
        if (is_null($this->inheritance[$rank]) || $this->inheritance[$rank] == "") return false;

        $parent = $this->inheritance[$rank];

        if (!in_array($permission, $this->rankPermissions[$parent])) return $this->checkLowerRankPermissions($parent, $permission);

        return true;
    }

    /**
     * @return PermissionsManager
     */
    public static function getInstance(): PermissionsManager
    {
        return self::$instance;
    }

}