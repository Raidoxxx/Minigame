<?php

namespace Minigame\Arena;

use Minigame\Arena\spawn\SpawnManager;
use pocketmine\world\World;


abstract class Arena
{
    private string $name;
    private ArenaPlayerManager $arenaPlayerManager;
    private World $world;
    private SpawnManager $spawnHandler;

    private ArenaEnum $status = ArenaEnum::WAITING;

    public function __construct(string $name, int $slots, World $world)
    {
        $this->name = $name;
        $this->world = $world;
        $this->spawnHandler = new SpawnManager($this, $slots);
        $this->arenaPlayerManager = new ArenaPlayerManager($this);
    }

    public function getId():string{
        return "{$this->name}:".rand(1,99999);
    }

    public function getName():string{
        return $this->name;
    }

    public function setWorld(World $world): void{
        $this->world = $world;
    }

    public function getWorld(): World{
        return $this->world;
    }

    public function getSpawnHandler() : SpawnManager{
        return $this->spawnHandler;
    }

    public function getArenaPlayerManager(): ArenaPlayerManager
    {
        return $this->arenaPlayerManager;
    }


    public function getStatus():ArenaEnum{
        return $this->status;
    }

    public function setStatus(ArenaEnum $status):void{
        $this->status = $status;
    }

    abstract public function start():void;

    abstract public function stop():void;

}