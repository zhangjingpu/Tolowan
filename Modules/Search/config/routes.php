<?php
use Core\Config;
$conf = Config::get('config');
$settings = array(
    'searchSubmit' => array(
        'httpMethods' => 'POST',
        'pattern' => '/search_submit',
        'paths' => array(
            'controller' => 'Index',
            'action' => 'Index',
            'module' => 'search',
            'namespace' => 'Modules\Search\Controllers',
        ),
    ),
    'search' => array(
        'httpMethods' => 'GET',
        'pattern' => '/search/{type}/{word}/{page}.html',
        'paths' => array(
            'controller' => 'Index',
            'action' => 'Search',
            'module' => 'search',
            'namespace' => 'Modules\Search\Controllers',
        ),
    ),
    'adminSearchSubmit' => array(
        'httpMethods' => 'POST',
        'pattern' => '/' . ADMIN_PREFIX . '/search_submit',
        'paths' => array(
            'controller' => 'Admin',
            'module' => 'search',
            'action' => 'Index',
            'namespace' => 'Modules\Search\Controllers',
        ),
    ),
    'adminSearch' => array(
        'httpMethods' => null,
        'pattern' => '/' . ADMIN_PREFIX . '/search/{type}/{word}/{page}.html',
        'paths' => array(
            'controller' => 'Admin',
            'module' => 'search',
            'action' => 'Search',
            'namespace' => 'Modules\Search\Controllers',
        ),
    ),
);
