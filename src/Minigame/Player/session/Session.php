<?php

namespace Minigame\Player\session;


use Minigame\Player\RDXPlayer;
use pocketmine\player\Player;

class Session
{

    /**
     * @var RDXPlayer
     */
    private RDXPlayer $player;

    /**
     * @var string
     */
    private string $playerID;

    public function __construct(Player $player){
        $this->player = new RDXPlayer($this, $player);
        $this->playerID = $player->getUniqueId()->toString();
    }

    public function getPlayer():RDXPlayer{
        return $this->player;
    }

    public function getPlayerID():string{
        return $this->playerID;
    }
}