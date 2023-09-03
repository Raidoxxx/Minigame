<?php

namespace Minigame\Utils;

use Closure;
use Minigame\Tasks\CloneWorldTask;
use pocketmine\Server;
use pocketmine\world\World;

trait WorldManager
{
    public function cloneWorld(World $world, string $name): void
    {
        $from = Server::getInstance()->getDataPath(). 'worlds/' . $world->getFolderName();
        $to = Server::getInstance()->getDataPath(). 'worlds/' . $name;
        Server::getInstance()->getAsyncPool()->submitTask(new CloneWorldTask($from, $to));
    }
}