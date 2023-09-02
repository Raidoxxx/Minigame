<?php

namespace Minigame\Arena;

class ArenaPlayerManager
{

    private array $inLobby = [];
    private array $waiting = [];
    private array $playing = [];
    private array $spectating = [];

    public function __construct()
    {
    }
}