<?php

namespace Minigame\Arena\spawn;

use pocketmine\world\Position;

class Spawn
{

    private Position $position;

    public function __construct(Position $position){
        $this->position = $position;
    }

    public function getPos():Position{
        return $this->position;
    }


}