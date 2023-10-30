<?php

namespace Tetro\FlatGlass;

use customiesdevs\customies\item\CustomiesItemFactory;

use pocketmine\plugin\PluginBase;
use Tetro\FlatGlass\items\black;
use Tetro\FlatGlass\items\blue;
use Tetro\FlatGlass\items\brown;
use Tetro\FlatGlass\items\cyan;
use Tetro\FlatGlass\items\green;
use Tetro\FlatGlass\items\grey;
use Tetro\FlatGlass\items\lightblue;
use Tetro\FlatGlass\items\lightgrey;
use Tetro\FlatGlass\items\lime;
use Tetro\FlatGlass\items\magenta;
use Tetro\FlatGlass\items\normal;
use Tetro\FlatGlass\items\orange;
use Tetro\FlatGlass\items\pink;
use Tetro\FlatGlass\items\purple;
use Tetro\FlatGlass\items\red;
use Tetro\FlatGlass\items\white;
use Tetro\FlatGlass\items\yellow;

class main extends PluginBase
{

    protected function onEnable(): void
    {
        CustomiesItemFactory::getInstance()->registerItem(normal::class, "2dglasspanes:pane_normal", "Glass Pane");
        CustomiesItemFactory::getInstance()->registerItem(white::class, "2dglasspanes:pane_white", "White Stained Glass Pane");
        CustomiesItemFactory::getInstance()->registerItem(lightgrey::class, "2dglasspanes:pane_lightgrey", "Light Grey Stained Glass Pane");
        CustomiesItemFactory::getInstance()->registerItem(grey::class, "2dglasspanes:pane_grey", "Grey Stained Glass Pane");
        CustomiesItemFactory::getInstance()->registerItem(black::class, "2dglasspanes:pane_black", "Black Stained Glass Pane");
        CustomiesItemFactory::getInstance()->registerItem(brown::class, "2dglasspanes:pane_brown", "Brown Stained Glass Pane");
        CustomiesItemFactory::getInstance()->registerItem(red::class, "2dglasspanes:pane_red", "Red Stained Glass Pane");
        CustomiesItemFactory::getInstance()->registerItem(orange::class, "2dglasspanes:pane_orange", "Orange Stained Glass Pane");
        CustomiesItemFactory::getInstance()->registerItem(yellow::class, "2dglasspanes:pane_yellow", "Yellow Stained Glass Pane");
        CustomiesItemFactory::getInstance()->registerItem(lime::class, "2dglasspanes:pane_lime", "Lime Stained Glass Pane");
        CustomiesItemFactory::getInstance()->registerItem(green::class, "2dglasspanes:pane_green", "Green Stained Glass Pane");
        CustomiesItemFactory::getInstance()->registerItem(cyan::class, "2dglasspanes:pane_cyan", "Cyan Stained Glass Pane");
        CustomiesItemFactory::getInstance()->registerItem(lightblue::class, "2dglasspanes:pane_lightblue", "Light Blue Stained Glass Pane");
        CustomiesItemFactory::getInstance()->registerItem(blue::class, "2dglasspanes:pane_blue", "Blue Stained Glass Pane");
        CustomiesItemFactory::getInstance()->registerItem(purple::class, "2dglasspanes:pane_purple", "Purple Stained Glass Pane");
        CustomiesItemFactory::getInstance()->registerItem(magenta::class, "2dglasspanes:pane_magenta", "Magenta Stained Glass Pane");
        CustomiesItemFactory::getInstance()->registerItem(pink::class, "2dglasspanes:pane_pink", "Pink Stained Glass Pane");
    }
}