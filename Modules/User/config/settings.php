<?php
$settings = array(
    'formId' => 'adminUserSettings',
    'form' => array(
        'action' => staticUrl(),
        'method' => 'get',
        'ajax-submit' => '#main',
        'accept-charset' => 'utf-8',
        'role' => 'form',
        'id' => 'adminUserSettings',
    ),
    'user_center' => array(
        'label' => '启用用户中心',
        'userOptions' => array(),
        'error' => '',
        'description' => '禁用后用户主页和用户中心将不能访问',
        'field' => 'boole',
        'widget' => 'Checkbox',
        'default' => 1,
        'validate' => array(),
        'attributes' => array(),
        'required' => false,
    ),
    'open_register' => array(
        'label' => '开放注册',
        'userOptions' => array(),
        'error' => '',
        'description' => '禁用后将不能注册',
        'field' => 'boole',
        'widget' => 'Checkbox',
        'default' => 1,
        'validate' => array(),
        'attributes' => array(),
        'required' => false,
    ),
    'open_register_roles' => array(
        'label' => '开放角色注册',
        'userOptions' => array(),
        'error' => '',
        'description' => '指定某角色可以公开注册，不公开注册的角色将不显示',
        'field' => 'list',
        'widget' => 'Checkboxs',
        'options' => getRolesOptions(),
        'default' => 1,
        'validate' => array(),
        'attributes' => array(),
        'required' => false,
    ),
    'open_register_captcha' => array(
        'label' => '启用注册验证码',
        'userOptions' => array(),
        'error' => '',
        'description' => '启用后注册需要输入验证码',
        'field' => 'boole',
        'widget' => 'Checkbox',
        'default' => 1,
        'validate' => array(),
        'attributes' => array(),
        'required' => false,
    ),
    'open_login_captcha' => array(
        'label' => '启用登陆验证码',
        'userOptions' => array(),
        'error' => '',
        'description' => '启用后登陆需要输入验证码',
        'field' => 'boole',
        'widget' => 'Checkbox',
        'default' => 1,
        'validate' => array(),
        'attributes' => array(),
        'required' => false,
    ),
    'open_email_active' => array(
        'label' => '注册验证方式',
        'userOptions' => array(),
        'error' => '',
        'description' => '启用用户需要完成选定验证后才能激活',
        'field' => 'string',
        'widget' => 'Select',
        'options' => array(
            0 => '不验证',
            'email' => '邮箱验证',
            'phone' => '手机验证'
        ),
        'value' => 1,
        'validate' => array(),
        'attributes' => array(
            'class' => 'form-control',
        ),
        'required' => false,
    ),
    'email_active_body' => array(
        'label' => '激活信息',
        'userOptions' => array(),
        'error' => '',
        'description' => '启用注册验证后向用户发送的激活邮件信息',
        'field' => 'textLong',
        'widget' => 'Textarea',
        'default' => 1,
        'validate' => array(),
        'attributes' => array(
            'class' => 'form-control',
        ),
        'required' => false,
    ),
    'number' => array(
        'label' => '用户列表项数量',
        'userOptions' => array(),
        'error' => '',
        'description' => '默认用户列表项数量',
        'field' => 'number',
        'widget' => 'Text',
        'validate' => array(),
        'attributes' => array(
            'class' => 'form-control',
        ),
        'required' => true,
    ),
    'no_user' => array(
        'label' => '用户名敏感词',
        'userOptions' => array(),
        'error' => '',
        'description' => '包含敏感词的用户名不能被注册,用英文逗号隔开',
        'field' => 'textLong',
        'widget' => 'Textarea',
        'validate' => array(),
        'attributes' => array(
            'class' => 'form-control',
        ),
        'required' => true,
    ),
    'settings' => array(
        'save' => 'config',
        'data' => 'm.user.config',
        'menuGroup' => array(),
        'module' => '用户',
        'title' => '设置',
        'description' => '用户相关设置',
    ),
);
