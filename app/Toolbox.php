<?php
namespace App;

class Toolbox{
    public static function createWorkspace($name){
        if(!file_exists(getcwd().'/'.$name)){
            mkdir(getcwd().'/'.$name);
        }
        return true;
    }

    public static function downloadTemplate($name, $address){
        file_put_contents(getcwd().'/'.$name.'.zip', file_get_contents($address));
        return true;
    }

    public static function extractZip($name){
        $zip = new \ZipArchive;
        if ($zip->open(getcwd().'/'.$name.'.zip') === TRUE) {
            $zip->extractTo(getcwd());
            $zip->close();
            return true;
        } else {
           return false;
        }
    }

    public static function renameWorkspace($name, $folder){
        rename(getcwd().'/'.$folder, getcwd().'/'.$name );
    }

    public static function deleteFiles ($name){
        unlink(getcwd().'/'.$name.'.zip');
    }

    public static function initializePackage($cmd, $gitAddress, $gitFolderName){
        $cmd->task("Create the workspace", function () use ($cmd) {
            return self::createWorkspace($cmd->argument('name'));
        });

        $cmd->task("Download latest version of bootstrap templat", function () use ($cmd, $gitAddress) {
            return self::downloadTemplate($cmd->argument('name'), $gitAddress);
        });

        $cmd->task("Extraction of the template", function () use ($cmd) {
            return self::extractZip($cmd->argument('name'));
        });

        $cmd->task("Rename the workspace", function () use ($cmd, $gitFolderName) {
            return self::renameWorkspace($cmd->argument('name'), $gitFolderName);
        });

        $cmd->task("Delete useless files", function () use ($cmd) {
            return self::deleteFiles($cmd->argument('name'));
        });
    }
}
