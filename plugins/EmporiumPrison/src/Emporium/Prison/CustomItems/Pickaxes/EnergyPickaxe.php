<?php

namespace Emporium\Prison\CustomItems\Pickaxes;

use customiesdevs\customies\item\component\AllowOffHandComponent;
use customiesdevs\customies\item\component\DiggerComponent;
use customiesdevs\customies\item\component\DurabilityComponent;
use customiesdevs\customies\item\component\HandEquippedComponent;
use customiesdevs\customies\item\component\MaxStackSizeComponent;
use customiesdevs\customies\item\CreativeInventoryInfo;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use pocketmine\block\VanillaBlocks;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\Pickaxe;
use pocketmine\item\ToolTier;

class EnergyPickaxe extends Pickaxe implements ItemComponents
{

    use ItemComponentsTrait;

    public function __construct(ItemIdentifier $identifier, string $name = "Unknown") {

        parent::__construct($identifier, $name, ToolTier::DIAMOND());

        $creativeInfo = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_EQUIPMENT, CreativeInventoryInfo::GROUP_PICKAXE);

        $diggerComponent = new DiggerComponent();
        $this->initComponent("energy_pickaxe", $creativeInfo);
        $this->addComponent(new HandEquippedComponent(true));
        $this->addComponent(new AllowOffHandComponent(false));
        $this->addComponent(new MaxStackSizeComponent(1));
        $this->addComponent(new DurabilityComponent(5000));
        $this->addComponent($diggerComponent->withBlocks(10,
            VanillaBlocks::COAL_ORE(), VanillaBlocks::COAL(), VanillaBlocks::IRON_ORE(), VanillaBlocks::IRON(),
            VanillaBlocks::LAPIS_LAZULI_ORE(), VanillaBlocks::LAPIS_LAZULI(), VanillaBlocks::REDSTONE_ORE(), VanillaBlocks::REDSTONE(),
            VanillaBlocks::GOLD_ORE(), VanillaBlocks::GOLD(), VanillaBlocks::DIAMOND_ORE(), VanillaBlocks::DIAMOND(),
            VanillaBlocks::EMERALD_ORE(), VanillaBlocks::EMERALD(), VanillaBlocks::NETHER_QUARTZ_ORE()
        ));

        $this->setupRenderOffsets(1200, 1200, true);
    }

    public function getBaseMiningEfficiency(): float
    {
        return 7;
    }

}