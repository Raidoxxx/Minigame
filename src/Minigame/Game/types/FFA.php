<?php

namespace Minigame\Game\types;

use Minigame\Arena\ArenaEnum;
use Minigame\Arena\spawn\Spawn;
use Minigame\Arena\types\FFAArena;
use Minigame\Game\Game;
use pocketmine\Server;
use pocketmine\world\Position;

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
            $positions = $arena['positions'];

            $world = Server::getInstance()->getWorldManager()->getWorldByName($arena['world']);

            if(is_null($world)){
                Server::getInstance()->getWorldManager()->loadWorld($arena['world']);
            }

            if(is_null($world)){
                Server::getInstance()->getLogger()->error("World {$arena['world']} not found");
                continue;
            }

            $arena = new FFAArena($name, $slots, $world);

            foreach ($positions as $position){
                $x = $position['x'];
                $y = $position['y'];
                $z = $position['z'];

                $spawn = new Spawn(new Position($x, $y, $z, $world));
                $arena->getSpawnHandler()->addSpawn($spawn);
            }

            $this->arenaManager->addArena($arena);
        }
    }

}