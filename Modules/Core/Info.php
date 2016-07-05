<?php
$settings = array(
    'name' => '核心组件',
    'machine' => 'Core',
    'require' => array('User', 'Form'),
    'conflict' => array('system'),
    'uninstall' => false,
    'remove' => false,
    'description' => '豫之旗管理后台核心组件，不可禁用，不可替换。',
    'handle' => array(
        'setting' => array('name' => '设置', 'link' => '/'),
        'quanxian' => array('name' => '权限', 'link' => '/'),
    ),
);
