<?php

namespace Minigame\Player\session;

use pocketmine\player\Player;

class SessionManager
{

    /**
     * @var Session[]
     */
    private static array $sessions = [];

    public static function addSession(Player $player): void
    {
        if(self::existSession($player)) return;
        self::$sessions[$player->getUniqueId()->toString()] = new Session($player);
    }

    private static function existSession(Player $player): bool
    {
        return isset(self::$sessions[$player->getUniqueId()->toString()]);
    }

    public static function removeSession(Player $player): void
    {
        if(!self::existSession($player)) return;
        unset(self::$sessions[$player->getUniqueId()->toString()]);
    }

    public static function getSession(Player $player): ?Session
    {
        if(!self::existSession($player)) return null;
        return self::$sessions[$player->getUniqueId()->toString()];
    }

    public static function getSessions(): array
    {
        return self::$sessions;
    }
}