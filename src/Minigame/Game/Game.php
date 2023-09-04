<?php

namespace Minigame\Game;

use JsonException;
use Minigame\Arena\Arena;
use Minigame\Arena\ArenaManager;
use Minigame\Game\lobby\lobby;
use Minigame\Main;
use Minigame\Utils\MapUtils;
use pocketmine\entity\Location;
use pocketmine\entity\Skin;
use pocketmine\Server;
use pocketmine\utils\Config;
use pocketmine\world\Position;

abstract class Game
{
    use MapUtils;
    private string $name;
    private int $slots;
    private lobby $lobby;
    protected ArenaManager $arenaManager;
    private Config $config;
    protected Config $arenas;

    /**
     * @throws JsonException
     */
    public function __construct(string $name, int $slots)
    {
        $this->name = $name;
        $this->slots = $slots;
        $this->lobby = new Lobby($this);
        $this->arenaManager = new ArenaManager($this);
        $this->arenas = new Config(Main::getInstance()->getDataFolder()."games/{$this->name}/arenas.yml", Config::YAML);
        $this->config = new Config(Main::getInstance()->getDataFolder()."games/{$this->name}/config.yml", Config::YAML);
        $this->init();
    }

    public function getName():string{
        return $this->name;
    }

    public function getSlots():int{
        return $this->slots;
    }

    public function getLobby():Lobby{
        return $this->lobby;
    }

    public function getConfig():Config{
        return $this->config;
    }

    public function getArenaManager():ArenaManager{
        return $this->arenaManager;
    }

    abstract public function loadArenas():void;

    /**
     * @throws JsonException
     */
    private function init(): void
    {
        $this->loadWorlds();
        $this->loadArenas();
        $this->loadNPC();
    }

    /**
     * @throws JsonException
     */
    private function loadNPC(): void
    {
        $npcs = $this->config->get('npcs');
        foreach ($npcs as $npc){
            $skin = new Skin($npc['skin']['id'], $npc['skin']['data'], $npc['skin']['cape'], $npc['skin']['geometry']);
            $name = $npc['name'];
            $x = $npc['x'];
            $y = $npc['y'];
            $z = $npc['z'];
            $yaw = $npc['yaw'];
            $pitch = $npc['pitch'];
            $world = Server::getInstance()->getWorldManager()->getWorldByName($npc['level']);

            if($world === null){
                Server::getInstance()->getLogger()->error("World {$npc['level']} not found");
            }else{
                $this->getLobby()->addNPC($skin, $name, new Location($x, $y, $z, $world, $yaw, $pitch), $this);
            }
        }
    }

    private function loadWorlds(): void
    {
        $path = Main::getInstance()->getDataFolder()."games/{$this->name}/worlds/";

        if(!is_dir($path)){
            mkdir($path);
        }

        $files = scandir($path);

        foreach ($files as $file) {
            if (str_contains($file, '.zip')) {
                $name = str_replace('.zip', '', $file);
                $this->extractZip($path . $file, Server::getInstance()->getDataPath() . 'worlds/' . $name);
            }
        }
    }

}