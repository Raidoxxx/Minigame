<?php

namespace Minigame;

use Minigame\Tasks\async\world\CloneWorldTask;
use Minigame\Utils\MapUtils;
use pocketmine\Server;
use pocketmine\world\World;

class MapManager
{

    use MapUtils;
    private static MapManager $instance;

    private array $worlds_cloned = [];

    public function __construct()
    {
        self::$instance = $this;
    }

    public static function getInstance(): MapManager
    {
        return self::$instance;
    }

    public function isWorldCloned(World $world): bool
    {
        $name = $world->getFolderName();
        return isset($this->worlds_cloned[$name]);
    }

    public function addWorldCloned(World $world): void
    {
        $name = $world->getFolderName();
        $this->worlds_cloned[$name] = $world;
    }

    public function removeWorldCloned(World $world): void
    {
        $name = $world->getFolderName();
        if($world->isLoaded()){
            Server::getInstance()->getWorldManager()->unloadWorld($world);
        }
        $this->deleteWorld($world);
        unset($this->worlds_cloned[$name]);
    }

    public function cloneWorld(World $world, string $name): void
    {
        $from = Server::getInstance()->getDataPath(). 'worlds/' . $world->getFolderName();
        $to = Server::getInstance()->getDataPath(). 'worlds/' . $name. "(".count($this->worlds_cloned).")";
        Server::getInstance()->getAsyncPool()->submitTask(new CloneWorldTask($from, $to));
    }

    public function deleteWorld(World $world): void
    {
        if($world->isLoaded()){
            Server::getInstance()->getWorldManager()->unloadWorld($world);
        }
        $path = Server::getInstance()->getDataPath(). 'worlds/' . $world->getFolderName();
        if(is_dir($path)){
            $this->deleteDir($path);
        }
    }

    public function getNextWorld(): World
    {
        return array_shift($this->worlds_cloned);
    }
}