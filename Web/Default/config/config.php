<?php
$settings = array(
    'db' => array(
        "host" => "localhost",
        "username" => "root",
        "password" => "root",
        "dbname" => "tolowan",
        'adapter' => 'Mysql',
        "charset" => "utf8",
    ),
    'security' => array(
        'adminIP' => array(),
        'adminMac' => array(),
        'adminCheckIP' => false,
        'adminCheckMac' => false,
    ),
    'cache' => array(
        'type' => '',
        'config' => array(),
        'time' => array(
            'listHot' => 3000,
            'node' => 50000,
        ),
        'templateCache' => true,
    ),
    'translate' => array(
        'switch' => false,
        'url' => 1,
    ),
    'cryptEncode' => 'sdfsdfeftrjhjhhgfdmjhjhj',
    'debug' => true,
    'adminPrefix' => 'admin',
    'multiLingual' => 2,
    'timezone' => 'Asia/Shanghai',
    'route' => true,
    'defalutLanguage' => 'cn',
    'translate' => false,
);
