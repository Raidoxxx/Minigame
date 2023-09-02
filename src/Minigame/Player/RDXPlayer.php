<?php

namespace Minigame\Player;

use Minigame\Player\game\GameManager;
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

    /**
     * @var GameManager
     */
    private GameManager $gameManager;

    public function __construct(Session $session, Player $player){
        $this->session = $session;
        $this->player = $player;
        $this->gameManager = new GameManager($this);
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


    public function getGameManager(GameManager $game): GameManager
    {
        return $this->gameManager;
    }
}