<?php

namespace Minigame\Player\session;

class SessionManager
{

    /**
     * @var Session[]
     */
    private array $sessions = [];

    /**
     * @param Session $session
     * @return void
     */
    public function addSession(Session $session): void
    {
        if(!$this->existSession($session)){
            $this->sessions[$session->getId()] = $session;
        }
    }

    /**
     * @param Session $session
     * @return void
     */
    public function removeSession(Session $session): void
    {
        if($this->existSession($session)){
           unset($this->sessions[$session->getId()]);
        }
    }

    /**
     * @param Session $session
     * @return bool
     */
    public function existSession(Session $session): bool
    {
        return isset($this->sessions[$session->getId()]);
    }

    /**
     * @return Session[]
     */
    public function getAllSessions():array{
        return $this->sessions;
    }
}