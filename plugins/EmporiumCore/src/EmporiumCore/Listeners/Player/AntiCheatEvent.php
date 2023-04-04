<?php

# Namespace
namespace EmporiumCore\Listeners\Player;

use EmporiumCore\EmporiumCore;
use EmporiumData\DataManager;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\Listener;
use pocketmine\event\server\DataPacketReceiveEvent;
use pocketmine\network\mcpe\protocol\{LevelSoundEventPacket};
use pocketmine\network\mcpe\protocol\types\LevelSoundEvent;
use pocketmine\player\Player;
use Tetro\EmporiumEnchants\Core\CustomEnchant;
use Tetro\EmporiumEnchants\Core\CustomEnchantManager;

# Plugin
class AntiCheatEvent implements Listener {

    # Constructor
    private EmporiumCore $plugin;

    public function __construct(EmporiumCore $plugin) {
        $this->plugin = $plugin;
    }

    # Anti-Nuke Listener
    public function onBreak(BlockBreakEvent $event) {

        // Anti-Nuke
        $player = $event->getPlayer();
        $ping = $player->getNetworkSession()->getPing();
        $tps = $this->plugin->getServer()->getTicksPerSecond();
        if (DataManager::getInstance()->getPlayerXuid($player->getName()) == "00") return;
        if ($tps >= 18) {
            if ($ping < 500) {
                if($player->getInventory()->getItemInHand()->hasEnchantment(CustomEnchantManager::getEnchantmentByName("Shatter"))) return;
                DataManager::getInstance()->setPlayerData($player->getXuid(), "anticheat.anti_nuke", (int) DataManager::getInstance()->getPlayerData($player->getXuid(), "anticheat.anti_nuke") + 1);
            }
        }

    }

    # Anti-Autoclick Listener
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
                            if(file_exists(EmporiumCore::getInstance()->getDataFolder() . "players/" . $player->getXuid() . ".json")) {
                                DataManager::getInstance()->setPlayerData($player->getXuid(), "anticheat.anti_auto", (int) DataManager::getInstance()->getPlayerData($player->getXuid(), "anticheat.anti_auto") + 1);
                            }
                        }
                    }
                }

            }
        }


    }
}