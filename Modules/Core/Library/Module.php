<?php
namespace Modules\Core\Library;

use Core\Config;
use Core\File;

class Module
{
    public static function install($name)
    {

    }
    public static function uninstall($name)
    {

    }
    public static function startUsing($name)
    {
        $state = false;
        $activeFunction = '\Modules\\'.$name.'\Install::startUsing';
        $modulesList = Config::get('modules');
        if(isset($modulesList[$name])){
            return 2;
        }
        if(file_exists($activeFunction)){
            $state = call_user_func($activeFunction);
        }
        if($state === false){
            return false;
        }
        $modulesList[$name] = ucfirst($name);
        Config::set('modules',$modulesList);
        //清除缓存
        return $state;
    }
    public static function stopUsing($name){
        $state = false;
        $activeFunction = '\Modules\\'.$name.'\Install::stopUsing';
        $modulesList = Config::get('modules');
        if(!isset($modulesList[$name])){
            return 2;
        }
        if(is_callable($activeFunction)){
            $state = call_user_func($activeFunction);
        }
        if($state === false){
            return false;
        }
        unset($modulesList[$name]);
        Config::set('modules',$modulesList);
        //清除缓存
        return $state;
    }
    public static function listInfo()
    {
        $config = Config::get('config');
        $modulesList = array();
        $dirList = File::listDir('Modules/');
        foreach ($dirList as $key => $value) {
            if (file_exists(ROOT_DIR.$value) && file_exists(ROOT_DIR.$value . 'Info.php')) {
                require_once ROOT_DIR.$value . 'Info.php';
                if(isset($settings)) {
                    $modulesList[$key] = $settings;
                    unset($settings);
                }
            }
        }
        return $modulesList;
    }
}
