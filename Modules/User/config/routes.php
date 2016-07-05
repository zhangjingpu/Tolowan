<?php
$settings = array(
    'user' => array(
        'httpMethods' => 'GET',
        'pattern' => '/user/{id}.html',
        'paths' => array(
            'controller' => 'Index',
            'action' => 'Index',
            'module' => 'user',
            'namespace' => 'Modules\User\Controllers',
        ),
    ),
    'userManager' => array(
        'httpMethods' => 'GET',
        'pattern' => '/user',
        'paths' => array(
            'controller' => 'Index',
            'action' => 'Manager',
            'module' => 'user',
            'namespace' => 'Modules\User\Controllers',
        ),
    ),
    'userCropImage' => array(
        'httpMethods' => null,
        'pattern' => '/user/crop_image',
        'paths' => array(
            'controller' => 'Index',
            'action' => 'cropImage',
            'module' => 'user',
            'namespace' => 'Modules\User\Controllers',
        ),
    ),
    'userCenterIndex' => array(
        'httpMethods' => 'GET',
        'pattern' => '/user_center/index',
        'paths' => array(
            'controller' => 'Index',
            'action' => 'userCenter',
            'module' => 'user',
            'namespace' => 'Modules\User\Controllers',
        ),
    ),
    'remote' => array(
        'httpMethods' => null,
        'pattern' => '/remote',
        'paths' => array(
            'controller' => 'Index',
            'action' => 'Remote',
            'module' => 'user',
            'namespace' => 'Modules\User\Controllers',
        ),
    ),
    'login' => array(
        'httpMethods' => null,
        'pattern' => '/login.html',
        'paths' => array(
            'controller' => 'Index',
            'action' => 'Login',
            'module' => 'user',
            'namespace' => 'Modules\User\Controllers',
        ),
    ),
    'logout' => array(
        'httpMethods' => 'GET',
        'pattern' => '/logout.html',
        'paths' => array(
            'controller' => 'Index',
            'action' => 'Logout',
            'module' => 'user',
            'namespace' => 'Modules\User\Controllers',
        ),
    ),
    'password' => array(
        'httpMethods' => null,
        'pattern' => '/password.html',
        'paths' => array(
            'controller' => 'Index',
            'action' => 'Password',
            'module' => 'user',
            'namespace' => 'Modules\User\Controllers',
        ),
    ),
    'register' => array(
        'httpMethods' => null,
        'pattern' => '/register.html',
        'paths' => array(
            'controller' => 'Index',
            'action' => 'Register',
            'module' => 'user',
            'namespace' => 'Modules\User\Controllers',
        ),
    ),
    'adminUserEditor' => array(
        'httpMethods' => null,
        'pattern' => '/' . ADMIN_PREFIX . '/user_editor/{id}',
        'paths' => array(
            'module' => 'user',
            'controller' => 'Admin',
            'action' => 'Index',
            'namespace' => 'Modules\User\Controllers',
        ),
    ),
    'adminUserHandle' => array(
        'httpMethods' => null,
        'pattern' => '/' . ADMIN_PREFIX . '/user_handle',
        'paths' => array(
            'controller' => 'Admin',
            'module' => 'user',
            'action' => 'Handle',
            'namespace' => 'Modules\User\Controllers',
        ),
    ),
);
