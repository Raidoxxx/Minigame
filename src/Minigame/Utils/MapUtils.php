<?php

namespace Minigame\Utils;

use ZipArchive;

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

    public function extractZip(string $path, string $to): void
    {
        $zip = new ZipArchive();
        $zip->open($path);
        $zip->extractTo($to);
        $zip->close();
    }
}