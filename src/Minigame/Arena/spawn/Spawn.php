<?php

namespace Minigame\Arena\spawn;

use Minigame\Player\RDXPlayer;
use pocketmine\world\Position;

class Spawn
{
    private Position $position;

    /**
     * @var RDXPlayer|null
     */
    private RDXPlayer|null $player;

    /**
     * @param Position $position
     */
    public function __construct(Position $position){
        $this->position = $position;
    }

    /**
     * @return Position
     */
    public function getPos():Position{
        return $this->position;
    }

    /**
     * @return bool
     */
    public function existPlayer():bool{
        return $this->player instanceof RDXPlayer;
    }

    /*
     * @return RDXPlayer|null
     */
    public function getPlayer():RDXPlayer|null{
        return $this->player;
    }

    /**
     * @param RDXPlayer $player
     * @return void
     */
    public function setPlayer(RDXPlayer $player):void{
        $this->player = $player;
    }
}