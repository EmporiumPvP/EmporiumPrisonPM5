<?php

namespace Emporium\Prison\listeners;

use pocketmine\event\Listener;
use WolfDen133\WFT\Event\TagReplaceEvent;

class LeaderboardsListener implements Listener {

    public function onTagReplaceEvent(TagReplaceEvent $event) : void {
        // Get the text from the event
        $text = $event->getText();

        // Replace the tags you need
        $replace = str_replace(["{tag1}", "{tag2}"], ["Value 1", "Value 2"], $text);

        // And replace the text
        $event->setText($replace);
    }
}