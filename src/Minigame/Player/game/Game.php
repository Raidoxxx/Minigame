<?php

namespace Minigame\Player\game;

use Minigame\Arena\Arena;

class Game
{
    //TODO: Make the logic here
    public function __construct(private readonly Arena $arena)
    {

    }

    public function getArena():Arena{
        return $this->arena;
    }

}