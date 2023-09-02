<?php

namespace Minigame\Arena;

class ArenaManager
{
    private array $arenas;

    private static ArenaManager $instance;
    public function __construct()
    {
        self::$instance = $this;
    }

    /**
     * @return ArenaManager
     */
    public static function getInstance(): ArenaManager
    {
        return self::$instance;
    }

    public function addArena(Arena $arena): void
    {
        $this->arenas[$arena->getId()] = $arena;
    }

    public function removeArena(Arena $arena): void
    {
        unset($this->arenas[$arena->getId()]);
    }

    public function existArena(int $id):Arena|null{
        if(isset($this->arenas[$id])) return $this->arenas[$id];

        return null;
    }

    public function getArena(int $id): ?Arena
    {
        if($arena = $this->existArena($id)){
            return $arena;
        }return null;
    }
}