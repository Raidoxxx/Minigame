<?php

namespace Minigame\Arena;

use Minigame\Game\Game;
use Minigame\Main;
use Minigame\Player\session\SessionManager;
use pocketmine\player\Player;
use pocketmine\Server;

class ArenaManager
{
    private array $arenas;

    private static ArenaManager $instance;
    private Game $game;

    public function __construct(Game $game)
    {
        $this->game = $game;
        self::$instance = $this;
    }

    public function getGame():Game{
        return $this->game;
    }

    /**
     * @return ArenaManager
     */
    public static function getInstance(): ArenaManager
    {
        return self::$instance;
    }

    public function getArenas(): array
    {
        return $this->arenas;
    }

    public function addArena(Arena $arena): void
    {
        $this->arenas[$arena->getId()] = $arena;
    }

    public function removeArena(Arena $arena): void
    {
        unset($this->arenas[$arena->getId()]);
    }

    public function existArena(int $id):Arena|null{
        if(isset($this->arenas[$id])) return $this->arenas[$id];

        return null;
    }

    public function getArena(int $id): ?Arena
    {
        if($arena = $this->existArena($id)){
            return $arena;
        }return null;
    }


    public function joinArena(Player $player): void
    {
        $rdxPlayer = SessionManager::getSession($player)->getPlayer();

        if($rdxPlayer->isInArena()) return;

        /**
         * @var Arena $arena
         */
        $arenas = $this->getArenas();

        foreach ($arenas as $arena){
            if($arena->getStatus() === ArenaEnum::WAITING){
                if(count($arena->getArenaPlayerManager()->getPlaying()) >= $this->getGame()->getSlots()) return;

                $arena->getArenaPlayerManager()->addPlaying($rdxPlayer);
                $rdxPlayer->setInArena(true);
            }


        }
    }
}