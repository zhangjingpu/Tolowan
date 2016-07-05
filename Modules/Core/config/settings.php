<?php
$settings = array(
    'formId' => 'coreSettings',
    'form' => array(
        'method' => 'post',
        'class' => array(),
        'accept-charset' => 'utf-8',
        'role' => 'form',
        'ajax-submit' => '#main',
        'id' => 'coreSettings',
    ),
    'logo' => array(
        'field' => 'fileBox',
        'widget' => 'FileBox',
        'access' => array(
            'addForm' => true,
            'editForm' => true,
        ),
        'wordsmith' => true,
        'minLength' => 1,
        'maxLength' => 11,
        'number' => 1,
        'addition' => true,
        'label' => 'logo',
        'description' => '网站标志图',
        'error' => '',
        'attributes' => array(
            'class' => 'form-control',
        ),
    ),
    'name' => array(
        'field' => 'string',
        'widget' => 'Text',
        'isLabel' => true,
        'access' => array(
            'addForm' => true,
            'editForm' => true,
        ),
        'minLength' => 1,
        'maxLength' => 11,
        'number' => 1,
        'addition' => true,
        'label' => '网站名称',
        'description' => '',
        'error' => '',
        'attributes' => array(
            'class' => 'form-control',
        ),
    ),
    'description' => array(
        'field' => 'textLong',
        'widget' => 'Textarea',
        'isLabel' => true,
        'access' => array(
            'addForm' => true,
            'editForm' => true,
        ),
        'minLength' => 1,
        'maxLength' => 11,
        'number' => 1,
        'addition' => true,
        'label' => '网站描述',
        'description' => '',
        'error' => '',
        'attributes' => array(
            'class' => 'form-control',
        ),
    ),
    'indexTitle' => array(
        'field' => 'string',
        'widget' => 'Text',
        'isLabel' => true,
        'access' => array(
            'addForm' => true,
            'editForm' => true,
        ),
        'minLength' => 1,
        'maxLength' => 11,
        'number' => 1,
        'addition' => true,
        'label' => '首页标题',
        'description' => '首页ＳＥＯ标题',
        'error' => '',
        'attributes' => array(
            'class' => 'form-control',
        ),
    ),
    'indexDescription' => array(
        'field' => 'textLong',
        'widget' => 'Textarea',
        'isLabel' => true,
        'access' => array(
            'addForm' => true,
            'editForm' => true,
        ),
        'minLength' => 1,
        'maxLength' => 11,
        'number' => 1,
        'addition' => true,
        'label' => '首页描述',
        'description' => '首页ＳＥＯ描述',
        'error' => '',
        'attributes' => array(
            'class' => 'form-control',
        ),
    ),
    'indexKeywords' => array(
        'field' => 'string',
        'widget' => 'Text',
        'isLabel' => true,
        'access' => array(
            'addForm' => true,
            'editForm' => true,
        ),
        'minLength' => 1,
        'maxLength' => 11,
        'number' => 1,
        'addition' => true,
        'label' => '首页关键字',
        'description' => '首页ＳＥＯ关键字',
        'error' => '',
        'attributes' => array(
            'class' => 'form-control',
        ),
    ),
    'icp' => array(
        'field' => 'string',
        'widget' => 'Text',
        'isLabel' => true,
        'access' => array(
            'addForm' => true,
            'editForm' => true,
        ),
        'minLength' => 1,
        'maxLength' => 11,
        'number' => 1,
        'addition' => true,
        'label' => 'ICP备案号',
        'description' => '',
        'error' => '',
        'attributes' => array(
            'class' => 'form-control',
        ),
    ),
    'tel' => array(
        'field' => 'string',
        'widget' => 'Text',
        'isLabel' => true,
        'access' => array(
            'addForm' => true,
            'editForm' => true,
        ),
        'minLength' => 1,
        'maxLength' => 11,
        'number' => 1,
        'addition' => true,
        'label' => '联系电话',
        'description' => '',
        'error' => '',
        'attributes' => array(
            'class' => 'form-control',
        ),
    ),
    'email' => array(
        'field' => 'string',
        'widget' => 'Text',
        'isLabel' => true,
        'access' => array(
            'addForm' => true,
            'editForm' => true,
        ),
        'minLength' => 1,
        'maxLength' => 11,
        'number' => 1,
        'addition' => true,
        'label' => '联系邮箱',
        'description' => '',
        'error' => '',
        'attributes' => array(
            'class' => 'form-control',
        ),
    ),
    'other' => array(
        'field' => 'kvgroup',
        'widget' => 'Kvgroup',
        'isLabel' => true,
        'access' => array(
            'addForm' => true,
            'editForm' => true,
        ),
        'minLength' => 1,
        'maxLength' => 11,
        'number' => 1,
        'addition' => true,
        'label' => '其他选项',
        'description' => '',
        'error' => '',
        'attributes' => array(
            'class' => 'form-control',
        ),
    ),
    'settings' => array(
        'save' => 'config',
        'data' => 'm.core.config',
        'menuGroup' => array(),
        'module' => '系统',
        'title' => '设置',
        'description' => '系统相关设置',
    ),
);
