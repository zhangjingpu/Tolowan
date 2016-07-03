<?php
namespace Modules\Core\Library;

use Core\Config;
use Core\File;

class Theme{
    public static function listInfo()
    {
        $config = Config::get('config');
        $modulesList = array();
        $dirList = File::listDir('Themes/');
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