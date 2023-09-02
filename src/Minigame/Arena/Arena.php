<?php

namespace Minigame\Arena;

use Minigame\Arena\spawn\Spawn;
use Minigame\Arena\spawn\SpawnHandler;
use pocketmine\world\Position;
use pocketmine\world\World;

abstract class Arena
{

    private string $name;
    private int $max_slots;
    private array $slots_empyt;

    private ArenaPlayerManager $arenaPlayerManager;
    private World $world;
    private SpawnHandler $spawnHandler;

    public function __construct(string $name, int $slots, World $world, SpawnHandler $spawnHandler)
    {
        $this->name = $name;
        $this->max_slots = $slots;
        $this->world = $world;
        $this->spawnHandler = new SpawnHandler($this);
        $this->arenaPlayerManager = new ArenaPlayerManager();
    }

    public function getId():string{
        return "{$this->name}:".rand(1,99999);
    }

    public function getName():string{
        return $this->name;
    }

    public function getMaxSlots():int{
        return $this->max_slots;
    }

    public function getWorld():World{
        return $this->world;
    }

    public function getSpawnHandler() : SpawnHandler{
        return $this->spawnHandler;
    }
}