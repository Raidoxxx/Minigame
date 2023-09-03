<?php

namespace Minigame\Game\lobby;

use Minigame\Game\entities\MinigameNPC;
use Minigame\Game\Game;
use Minigame\Game\utils\MessageUtils;
use Minigame\Player\RDXPlayer;
use pocketmine\entity\Location;
use pocketmine\entity\Skin;
use pocketmine\world\Position;
use pocketmine\world\World;

class lobby
{
    use MessageUtils;

    private Game $game;

    private World $world;

    private array $players = [];
    public function __construct(Game $game){
        $this->game = $game;
    }

    public function getGame():Game{
        return $this->game;
    }

    public function getWorld():World{
        return $this->world;
    }

    public function setWorld(World $world):void{
        $this->world = $world;
    }

    public function addPlayer(RDXPlayer $player):void{
        $this->players[] = $player;
    }

    public function removePlayer(RDXPlayer $player):void{
        unset($this->players[array_search($player, $this->players)]);
    }

    /**
     * @return RDXPlayer[]
     */
    public function getPlayers():array{
        return $this->players;
    }

    public function isPlayer(RDXPlayer $player):bool{
        return in_array($player, $this->players);
    }

    public function sendMessage(int $type){
    }

    public function addNPC(Skin $skin, string $name, Location $location, Game $game): void
    {
        $entity = new MinigameNPC($name, $location, $skin, $game);
        $entity->spawnToAll();
    }
}