<?php
$settings = array(
    'formId' => 'coreSettings',
    'form' => array(
        'action' => '',
        'method' => 'post',
        'class' => array(),
        'accept-charset' => 'utf-8',
        'role' => 'form',
        'id' => 'coreSettings',
    ),
    'salt' => array(
        'label' => 'queue密锁',
        'userOptions' => array(),
        'error' => '',
        'description' => '长度为4~10queue密锁',
        'field' => 'string',
        'widget' => 'Text',
        'validate' => array(),
        'attributes' => array(),
        'required' => true,
    ),
    'local' => array(
        'label' => '锁定本地访问',
        'userOptions' => array(),
        'error' => '',
        'description' => '禁止外网访问queue链接提高安全性',
        'field' => 'list',
        'widget' => 'Radios',
        'options' => array(
            'on' => '开启',
            'off' => '关闭',
        ),
        'validate' => array(),
        'attributes' => array(),
        'required' => true,
    ),
    'bingxing' => array(
        'label' => '并行队列',
        'userOptions' => array(),
        'error' => '',
        'description' => '是否允许同时进行多了队列进程',
        'field' => 'list',
        'widget' => 'Radios',
        'options' => array(
            'on' => '开启',
            'off' => '关闭',
        ),
        'validate' => array(),
        'attributes' => array(),
        'required' => true,
    ),
    'settings' => array(
        'save' => '\Core\Options::save',
        'key' => 'queueSettings',
        'module' => '队列',
        'title' => '设置',
        'settings' => true,
    ),
);
