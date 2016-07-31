<?php
$settings = array(
    'formId' => 'adminNodeSettingsForm',
    'form' => array(
        'action' => staticUrl(),
        'method' => 'get',
        'ajax-submit' => '#main',
        'accept-charset' => 'utf-8',
        'role' => 'form',
        'id' => 'adminNodeSettingsForm',
    ),
    'browse' => array(
        'label' => '浏览统计',
        'userOptions' => array(),
        'description' => '启用浏览统计',
        'field' => 'boole',
        'widget' => 'Select',
        'options' => array(
            '不启用','启用'
        ),
        'error' => '',
        'validate' => array(),
        'attributes' => array(
            'class' => 'form-control',
        ),
    ),
    'number' => array(
        'label' => '内容类型列表数量',
        'userOptions' => array(),
        'description' => '默认内容类型页列表数量',
        'field' => 'number',
        'widget' => 'Text',
        'error' => '',
        'validate' => array(),
        'attributes' => array(
            'class' => 'form-control',
        ),
    ),
    'term_number' => array(
        'label' => '术语内容页列表数量',
        'userOptions' => array(),
        'description' => '术语内容页列表数量',
        'field' => 'number',
        'widget' => 'Text',
        'error' => '',
        'validate' => array(),
        'attributes' => array(
            'class' => 'form-control',
        ),
    ),
    'settings' => array(
        'save' => 'config',
        'data' => 'm.node.config',
        'menuGroup' => array(),
        'module' => '内容',
        'title' => '设置',
        'description' => '内容相关设置',
    ),
);
