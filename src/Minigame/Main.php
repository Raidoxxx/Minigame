<?php

namespace Minigame;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase implements Listener
{

    public static Main $instance;
    private static MapManager $map_manager;

    public function onEnable(): void
    {
        self::$instance = $this;
        self::$map_manager = new MapManager();
    }

    public function getMapManager(): MapManager
    {
        return self::$map_manager;
    }

    public static function getInstance(): Main {
        return self::$instance;
    }
}