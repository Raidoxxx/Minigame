<?php

namespace Minigame\Player\session;


use Minigame\Player\RDXPlayer;
use Minigame\Player\utils\RDXPlayerID;
use pocketmine\player\Player;

class Session
{

    /**
     * @var RDXPlayer
     */
    private RDXPlayer $player;

    /**
     * @var RDXPlayerID
     */
    private RDXPlayerID $playerID;

    public function __construct(Player $player){
        $this->player = new RDXPlayer($this, $player);
        $this->playerID = new RDXPlayerID($player->getUniqueId(), strval($player->getFirstPlayed()) ?? "");
    }

    public function getPlayer():RDXPlayer{
        return $this->player;
    }

    public function getPlayerID():RDXPlayerID{
        return $this->playerID;
    }

    public function getId():string{
        return $this->getPlayerID()->getHash();
    }
}