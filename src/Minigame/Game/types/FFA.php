<?php

namespace Minigame\Game\types;

use Minigame\Arena\ArenaEnum;
use Minigame\Arena\types\FFAArena;
use Minigame\Game\Game;
use pocketmine\Server;

class FFA extends Game
{

    public function __construct(string $name, int $slots)
    {
        parent::__construct($name, $slots);
    }

    public function loadArenas(): void
    {
        foreach ($this->arenas->getAll() as $arena){
            $name = $arena['name'];
            $slots = $arena['slots'];
            $world = Server::getInstance()->getWorldManager()->getWorldByName($arena['world']);

            $this->arenaManager->addArena(new FFAArena($name, $slots, $world));
        }
    }

}