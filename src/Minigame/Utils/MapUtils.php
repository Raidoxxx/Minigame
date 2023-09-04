<?php

namespace Minigame\Utils;

trait MapUtils
{
    public function deleteDir(string $path): void
    {
        if(is_dir($path)){
            $files = array_diff(scandir($path), ['.', '..']);
            foreach($files as $file){
                $this->deleteDir($path . '/' . $file);
            }
            rmdir($path);
        }else{
            unlink($path);
        }
    }
}