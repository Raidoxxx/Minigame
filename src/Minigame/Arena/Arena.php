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

    public function __construct(string $name, int $slots, World $world)
    {
        $this->name = $name;
        $this->world = $world;
        $this->spawnHandler = new SpawnManager($this, $slots);
        $this->arenaPlayerManager = new ArenaPlayerManager();
    }

    public function getId():string{
        return "{$this->name}:".rand(1,99999);
    }

    public function getName():string{
        return $this->name;
    }

    public function getWorld():World{
        return $this->world;
    }

    public function getSpawnHandler() : SpawnManager{
        return $this->spawnHandler;
    }

    public function getArenaPlayerManager(): ArenaPlayerManager{
        return $this->arenaPlayerManager;
    }
}