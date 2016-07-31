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
        global $di;
        $flash = $di->getShared('flash');
        $name = strtolower($name);
        $modulesList = Config::get('modules');
        if (isset($modulesList[$name])) {
            if (self::stopUsing($name)) {
                $fileState = File::rm('Modules/' . $name);
                if ($fileState === true){
                    $flash->success('停用成功');
                    return true;
                }else{
                    self::startUsing($name);
                    $flash->error('停用失败，模块目录删除失败：'.$fileState);
                    return false;
                }
            }else{
                $flash->error('停用失败');
                return false;
            }
        }else{
            $flash->error('停用失败，模块没有被启用');
        }
        return false;
    }

    public static function startUsing($name)
    {
        global $di;
        $name = strtolower($name);
        $flash = $di->getShared('flash');
        $state = false;
        $activeFunction = '\Modules\\' . ucfirst($name) . '\Install::startUsing';
        $modulesList = Config::get('modules');
        if (isset($modulesList[$name])) {
            $flash->notice('模块已经启用，请勿重复启用');
            return 2;
        }
        if (function_exists($activeFunction)) {
            $state = call_user_func($activeFunction);
        }
        if ($state === false) {
            $flash->error('模块启用失败');
            return false;
        }
        $modulesList[$name] = ucfirst($name);
        if (Config::set('modules', $modulesList)) {
            $flash->success('模块启用成功');
            return true;
        }
        //清除缓存
        $flash->error('模块启用失败');
        return false;
    }

    public static function stopUsing($name)
    {
        global $di;
        $flash = $di->getShared('flash');
        $name = strtolower($name);
        $state = false;
        $activeFunction = '\Modules\\' . ucfirst($name) . '\Install::stopUsing';
        $modulesList = Config::get('modules');
        if (!isset($modulesList[$name])) {
            $flash->notice('模块是停用状态，无法停用');
            return 2;
        }
        if (is_callable($activeFunction)) {
            $state = call_user_func($activeFunction);
        }
        if ($state === false) {
            $flash->error('模块停用失败');
            return false;
        }
        unset($modulesList[$name]);
        if (Config::set('modules', $modulesList)) {
            $flash->success('模块停用成功');
            return true;
        }
        //清除缓存
        return $state;
    }

    public static function listInfo()
    {
        $config = Config::get('config');
        $modulesList = array();
        $dirList = File::listDir('Modules/');
        foreach ($dirList as $key => $value) {
            if (file_exists(ROOT_DIR . $value) && file_exists(ROOT_DIR . $value . 'Info.php')) {
                require_once ROOT_DIR . $value . 'Info.php';
                if (isset($settings)) {
                    $modulesList[$key] = $settings;
                    unset($settings);
                }
            }
        }

        return $modulesList;
    }
}
