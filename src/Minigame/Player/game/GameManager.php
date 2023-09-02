<?php

namespace Minigame\Player\game;


use Minigame\Player\RDXPlayer;

class GameManager
{
    public Game|null $currentGame;

    public function __construct(private readonly RDXPlayer $player){

    }

    public function getPlayer():RDXPlayer{
        return $this->player;
    }

    public function getCurrentGame(Game $game):Game|null{
        return $this->currentGame;
    }

    public function addCurrentGame(Game $game):bool{
        if(isset($this->currentGame)){
            return false;
        }else{
            $this->currentGame = $game;
            return true;
        }
    }
}