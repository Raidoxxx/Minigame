<?php

namespace Minigame\Game\entities;

use Minigame\Game\Game;
use pocketmine\entity\Human;
use pocketmine\entity\Location;
use pocketmine\entity\Skin;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\nbt\tag\CompoundTag;

class MinigameNPC extends Human
{
    private Game $game;

    public function __construct(string $name, Location $location, Skin $skin, Game $game, ?CompoundTag $nbt = null)
    {
        $this->setNameTag("§l§a{$name}");
        $this->setScoreTag("§l§eClick to join!");
        $this->setNameTagAlwaysVisible(true);
        $this->setScale(1.2);
        $this->setForceMovementUpdate(false);
        $this->game = $game;
        parent::__construct($location, $skin, $nbt);
    }

    public function getGame():Game{
        return $this->game;
    }

    public function attack(EntityDamageEvent $source): void
    {
        if($source->getCause() === EntityDamageEvent::CAUSE_ENTITY_ATTACK){
            $source->cancel();
            $this->getGame()->getLobby()->getGame()->getArenaManager()->joinArena($source->getDamager());
        }
    }
}