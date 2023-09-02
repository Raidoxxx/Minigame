<?php

namespace TheBridge;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase implements Listener
{

    public static Main $instance;

    public function onEnable(): void
    {
        self::$instance = $this;
    }

    public function getInstance(): Main {
        return self::$instance;
    }
}