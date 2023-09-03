<?php

namespace Minigame\Game\utils;

trait MessageUtils
{

    public function sendMessageToAll(array $players, string $message): void
    {
        foreach ($players as $player) {
            $player->sendMessage($message);
        }
    }
}