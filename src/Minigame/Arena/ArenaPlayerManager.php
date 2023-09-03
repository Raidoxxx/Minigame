<?php

namespace Minigame\Arena;

use Minigame\Player\RDXPlayer;

class ArenaPlayerManager
{
    private array $playing = [];
    private array $spectating = [];
    private Arena $arena;

    public function __construct(Arena $arena)
    {
        $this->arena = $arena;
    }

    public function getArena(): Arena
    {
        return $this->arena;
    }

    public function addPlayersPlaying(array $players): void
    {
        foreach ($players as $player) {
            $this->addPlaying($player);
        }
    }

    public function addPlaying(RDXPlayer $player): void
    {
        $this->playing[] = $player;
    }

    public function removePlaying(RDXPlayer $player): void
    {
        unset($this->playing[array_search($player, $this->playing)]);
    }

    public function getPlaying(): array
    {
        return $this->playing;
    }

    public function isPlaying(RDXPlayer $player): bool
    {
        return in_array($player, $this->playing);
    }

    public function addSpectating(RDXPlayer $player): void
    {
        $this->spectating[] = $player;
    }

    public function removeSpectating(RDXPlayer $player): void
    {
        unset($this->spectating[array_search($player, $this->spectating)]);
    }

    public function getSpectating(): array
    {
        return $this->spectating;
    }

    public function isSpectating(RDXPlayer $player): bool
    {
        return in_array($player, $this->spectating);
    }

}