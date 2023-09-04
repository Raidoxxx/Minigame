<?php

namespace Minigame\Tasks\async\world;

use Minigame\Main;
use pocketmine\scheduler\AsyncTask;

class CloneWorldTask extends AsyncTask
{
    private string $from;
    private string $to;

    public function __construct(string $from, string $to)
    {
        $this->from = $from;
        $this->to = $to;
    }

    public function copyWorld(string $src, string $dst): void
    {
        $dir = opendir($src);
        @mkdir($dst);
        while (false !== ($file = readdir($dir))){
            if(($file != '.') && ($file != '..')){
                if(is_dir($src . '/' . $file)){
                    $this->copyWorld($src . '/' . $file, $dst . '/' . $file);
                }else{
                    copy($src . '/' . $file, $dst . '/' . $file);
                }
            }
        }
        closedir($dir);
    }

    public function onRun(): void
    {
        $this->copyWorld($this->from, $this->to);
    }

    public function onCompletion(): void
    {
        $world_name = explode('/', $this->to);
        $world_name = end($world_name);
        $world = Main::getInstance()->getServer()->getWorldManager()->getWorldByName($world_name);

        if(is_null($world)){
            Main::getInstance()->getServer()->getWorldManager()->loadWorld($world_name);
        }

        Main::getInstance()->getMapManager()->addWorldCloned($world);
    }
}