<?php

namespace Minigame\Arena\spawn;

use Minigame\Arena\Arena;

class SpawnManager
{
    /**
     * @var Spawn[] $spawns
     */
    private array $spawns = [];

    /**
     * @var Spawn[]
     */
    private array $used_spawns = [];

    /**
     * @var Arena
     */
    private Arena $arena;

    /**
     * @var int
     */
    private int $max_slots;

    /**
     * @param Arena $arena
     * @param int $max_slots
     */
    public function __construct(Arena $arena, int $max_slots){
        $this->arena = $arena;
        $this->max_slots = $max_slots;
    }

    /**
     * @return Arena
     */
    public function getArena():Arena{
        return $this->arena;
    }

    public function getMaxSlots():int{
        return $this->max_slots;
    }

    /**
     * @param Spawn $spawn
     * @return void
     */
    public function addSpawn(Spawn $spawn): void
    {
        $this->spawns[] = $spawn;
    }

    /**
     * @param Spawn $spawn
     * @return bool|int|string|null
     */

    public function existSpawn(Spawn $spawn): bool|int|string|null
    {
        foreach ($this->spawns as $s){
            if($s->getPos() === $spawn->getPos()){
                return array_search($s, $this->spawns);
            }
        }

        return null;
    }


    /**
     * @param Spawn $spawn
     * @return void
     */
    public function removeSpawn(Spawn $spawn):void{
       if($index = $this->existSpawn($spawn)){
           unset($this->spawns[$index]);
       }
    }

    /**
     * @return Spawn[]
     */
    public function getSpawns():array{
        return $this->spawns;
    }

    /**
     * @return Spawn[]
     */
    public function getUseSpawns():array{
        return $this->used_spawns;
    }


    /**
     * @param Spawn $spawn
     * @return void
     */
    public function addUsedSpawn(Spawn $spawn):void{
        $this->used_spawns[] = $spawn;
    }


    /**
     * @param Spawn $spawn
     * @return void
     */
    public function removeUsedSpawn(Spawn $spawn):void{
        if($index = $this->existUsedSpawn($spawn)){
            unset($this->used_spawns[$index]);
        }
    }

    /**
     * @param Spawn $spawn
     * @return bool|int|string|null
     */
    public function existUsedSpawn(Spawn $spawn): bool|int|string|null
    {
        foreach ($this->used_spawns as $s){
            if($s->getPos() === $spawn->getPos()){
                return array_search($s, $this->used_spawns);
            }
        }

        return null;
    }


    /**
     * @param array $spawns
     * @return void
     */
    public function registerSpawns(array $spawns): void
    {
        foreach ($spawns as $spawn){
            $this->addSpawn(new Spawn($spawn));
        }
    }


}