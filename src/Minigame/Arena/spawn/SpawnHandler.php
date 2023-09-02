<?php

namespace Minigame\Arena\spawn;

use Minigame\Arena\Arena;

class SpawnHandler
{
    /**
     * @var Spawn[] $spawns
     */
    private array $spawns;

    /**
     * @var Arena
     */
    private Arena $arena;

    /**
     * @param Arena $arena
     */
    public function __construct(Arena $arena){
        $this->arena = $arena;
    }

    /**
     * @return Arena
     */
    public function getArena():Arena{
        return $this->arena;
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