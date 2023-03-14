<?php

# Namespace
namespace EmporiumCore\Listeners\Player;

use EmporiumCore\EmporiumCore;
use EmporiumCore\Managers\Data\DataManager;

use JsonException;

use pocketmine\event\Listener;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\server\DataPacketReceiveEvent;

use pocketmine\network\mcpe\protocol\types\LevelSoundEvent;
use pocketmine\network\mcpe\protocol\{LevelSoundEventPacket};
use pocketmine\player\Player;

# Plugin
class AntiCheatEvent implements Listener {

    # Constructor
    private EmporiumCore $plugin;

    public function __construct(EmporiumCore $plugin) {
        $this->plugin = $plugin;
    }

    # Anti-Nuke Listener
    /**
     * @throws JsonException
     */
    public function onBreak(BlockBreakEvent $event) {

        // Anti-Nuke
        $player = $event->getPlayer();
        $ping = $player->getNetworkSession()->getPing();
        $tps = $this->plugin->getServer()->getTicksPerSecond();
        if ($tps >= 18) {
            if ($ping < 500) {
                DataManager::addData($player, "Players", "AntiNuke", 1);
            }
        }

    }

    # Anti-Autoclick Listener
    /**
     * @throws JsonException
     */
    public function onPacket(DataPacketReceiveEvent $event) {

        // Anti-Autoclick
        $packet = $event->getPacket();
        $player = $event->getOrigin()->getPlayer();
        $tps = $this->plugin->getServer()->getTicksPerSecond();
        if($player instanceof Player) {
            $ping = $player->getNetworkSession()->getPing();
            $playerName = $event->getOrigin()->getPlayer()->getPlayerInfo()->getUsername();
            if ($packet instanceof LevelSoundEventPacket) {
                if ($packet->sound === LevelSoundEvent::ATTACK_NODAMAGE || $packet->sound === LevelSoundEvent::ATTACK_STRONG || $packet->sound === LevelSoundEvent::HIT) {
                    if ($tps >= 18) {
                        if ($ping < 500) {
                            if(file_exists(EmporiumCore::getInstance()->getDataFolder() . "/PlayerData/Players/" . $playerName . ".yml")) {
                                DataManager::addData($player, "Players", "AntiAuto", 1);
                            }
                        }
                    }
                }

            }
        }


    }
}