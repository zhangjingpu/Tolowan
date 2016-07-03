<?php
use Core\Config;
global $di;
$settings = array(
    'formId' => 'search',
    'form' => array(
        'action' => $di->getShared('url')->get(array(
            'for' => 'searchSubmit'
        )),
        'method' => 'post',
        'class' => 'searchform',
        'accept-charset' => 'utf-8',
        'role' => 'search',
        'id' => 'search',
    ),
    'type' => array(
        'label' => '类型',
        'error' => '',
        'description' => '搜索类型',
        'field' => 'string',
        'widget' => 'Select',
        'options' => array(),
        'attributes' => array(),
        'required' => true,
    ),
    'word' => array(
        'label' => '关键字',
        'error' => '',
        'description' => '关键字',
        'field' => 'string',
        'widget' => 'Text',
        'validate' => array(
        ),
        'attributes' => array(
            'class' => 'form-control',
            'placeholder' => '输入关键字搜索',
        ),
        'required' => true,
    ),
    'settings' => array(
        'checkToken' => false,
        'validation' => true,
    ),
);
$typeOptions = array();
foreach (Config::get('m.search.engine') as $key => $engine){
    $typeOptions[$key] = $engine['name'];
}
$settings['type']['options'] = $typeOptions;