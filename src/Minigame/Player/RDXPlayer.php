<?php

namespace Minigame\Player;

use Minigame\Player\session\Session;
use pocketmine\player\Player;

class RDXPlayer
{
    /**
     * @var Session
     */
    private Session $session;

    /**
     * @var Player
     */
    private Player $player;

    private bool $isInArena = false;

    public function __construct(Session $session, Player $player){
        $this->session = $session;
        $this->player = $player;
    }

    /**
     * @return Player
     */
    public function getPlayer():Player{
        return $this->player;
    }

    /**
     * @return Session
     */
    public function getSession():Session{
        return $this->session;
    }

    public function isInArena():bool
    {
        return $this->isInArena;
    }

    public function setInArena(bool $value): void
    {
        $this->isInArena = $value;
    }
}