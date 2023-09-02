<?php

namespace Minigame\Player\utils;

class RDXPlayerID
{
    private string $uniqueid;

    private string $firstjoin;
    public function __construct(string $uniqueid, string $firstjoin){
        $this->uniqueid = $uniqueid;
        $this->firstjoin = $firstjoin;
    }

    public function getHash():string{
        return "{$this->uniqueid}:{$this->firstjoin}";
    }
}