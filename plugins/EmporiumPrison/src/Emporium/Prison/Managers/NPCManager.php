<?php

namespace Emporium\Prison\Managers;

use Emporium\Prison\EmporiumPrison;
use Emporium\Prison\Entity\NPC\Auctioneer;
use Emporium\Prison\Entity\NPC\Banker;
use Emporium\Prison\Entity\NPC\Blacksmith;
use Emporium\Prison\Entity\NPC\Chef;
use Emporium\Prison\Entity\NPC\Enchanter;
use Emporium\Prison\Entity\NPC\NPC;
use Emporium\Prison\Entity\NPC\OreExchanger;
use Emporium\Prison\Entity\NPC\PickaxePrestige;
use Emporium\Prison\Entity\NPC\PlayerPrestige;
use Emporium\Prison\Entity\NPC\ShipCaptain;
use Emporium\Prison\Entity\NPC\Tinkerer;
use Emporium\Prison\Entity\NPC\TourGuide;
use pocketmine\entity\Human;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\entity\EntityDataHelper;
use pocketmine\entity\EntityFactory;
use pocketmine\player\Player;
use pocketmine\world\World;

class NPCManager
{
    /** @var array<string, callable> */
    private array $npcHandles = [];

    /** @var array<string, Player> */
    public array $deleteHandles = [];

    public function __construct()
    {
        $this->registerDefaultNPCs();

        EntityFactory::getInstance()->register(NPC::class, function (World $world, CompoundTag $nbt) : NPC {
            return new NPC(EntityDataHelper::parseLocation($nbt, $world), Human::parseSkinNBT($nbt), $nbt);
        }, ["emporium_prison::npc"]);
    }

    public function registerDefaultNPCs() : void
    {

        # auctioneer
        $this->registerNPC(Auctioneer::class, function (Player $player) {
            $npc = new Auctioneer($player->getLocation(), $player->getSkin());
            $npc->setNameTagAlwaysVisible();
            $npc->spawnToAll();
        });

        # banker
        $this->registerNPC(Banker::class, function (Player $player) {
            $npc = new Banker($player->getLocation(), $player->getSkin());
            $npc->setNameTagAlwaysVisible();
            $npc->spawnToAll();
        });

        # blacksmith
        $this->registerNPC(Blacksmith::class, function (Player $player) {
            $npc = new Blacksmith($player->getLocation(), $player->getSkin());
            $npc->setNameTagAlwaysVisible();
            $npc->spawnToAll();
        });

        # chef
        $this->registerNPC(Chef::class, function (Player $player) {
            $npc = new Chef($player->getLocation(), $player->getSkin());
            $npc->setNameTagAlwaysVisible();
            $npc->spawnToAll();
        });

        # enchanter
        $this->registerNPC(Enchanter::class, function (Player $player) {
            $npc = new Enchanter($player->getLocation(), $player->getSkin());
            $npc->setNameTagAlwaysVisible();
            $npc->spawnToAll();
        });

        # ore exchanger
        $this->registerNPC(OreExchanger::class, function (Player $player) {
            $npc = new OreExchanger($player->getLocation(), $player->getSkin());
            $npc->setNameTagAlwaysVisible();
            $npc->spawnToAll();
        });

        # pickaxe prestige
        $this->registerNPC(PickaxePrestige::class, function (Player $player) {
            $npc = new PickaxePrestige($player->getLocation(), $player->getSkin());
            $npc->setNameTagAlwaysVisible();
            $npc->spawnToAll();
        });

        # player prestige
        $this->registerNPC(PlayerPrestige::class, function (Player $player) {
            $npc = new PlayerPrestige($player->getLocation(), $player->getSkin());
            $npc->setNameTagAlwaysVisible();
            $npc->spawnToAll();
        });

        # ship captain
        $this->registerNPC(ShipCaptain::class, function (Player $player) {
            $npc = new ShipCaptain($player->getLocation(), $player->getSkin());
            $npc->setNameTagAlwaysVisible();
            $npc->spawnToAll();
        });

        # tinkerer
        $this->registerNPC(Tinkerer::class, function (Player $player) {
            $npc = new Tinkerer($player->getLocation(), $player->getSkin());
            $npc->setNameTagAlwaysVisible();
            $npc->spawnToAll();
        });

        # tour guide
        $this->registerNPC(TourGuide::class, function (Player $player) {
            $npc = new TourGuide($player->getLocation(), $player->getSkin());
            $npc->setNameTagAlwaysVisible();
            $npc->spawnToAll();
        });
    }

    public function registerNPC (string $classname, callable $spawnFunction) : void
    {
        if (isset($this->npcHandles[$classname])) {
            EmporiumPrison::getInstance()->getLogger()->error("Cannot register already registered entity");
            return;
        }

        EntityFactory::getInstance()->register($classname, function (World $world, CompoundTag $nbt) : NPC {
            return new NPC(EntityDataHelper::parseLocation($nbt, $world), Human::parseSkinNBT($nbt), $nbt);
        }, ["emporium_prison::" . $classname]);

        $this->npcHandles[$classname] = $spawnFunction;
    }

    public function spawnNpc (Player $player, string $identifier) : void
    {
        $this->npcHandles[$identifier]($player);
    }

}