<?php
use Core\Config;
$conf = Config::get('config');
$settings = array(
    'term' => array(
        'httpMethods' => 'GET',
        'pattern' => '/taxonomy_term/{id}_{page}.html',
        'paths' => array(
            'controller' => 'Index',
            'action' => 'Term',
            'module' => 'node',
            'namespace' => 'Modules\Node\Controllers',
        ),
    ),
    'node' => array(
        'httpMethods' => array('GET', 'POST'),
        'pattern' => '/node/{id:([1-9]{1}[0-9]{0,11})}.html',
        'paths' => array(
            'controller' => 'Index',
            'action' => 'Index',
            'module' => 'node',
            'namespace' => 'Modules\Node\Controllers',
        ),
    ),
    'nodeLove' => array(
        'httpMethods' => array('GET', 'POST'),
        'pattern' => '/node_love/{id:([1-9]{1}[0-9]{0,11})}',
        'paths' => array(
            'controller' => 'Index',
            'action' => 'Index',
            'module' => 'node',
            'namespace' => 'Modules\Node\Controllers',
        ),
    ),
    'nodeType' => array(
        'httpMethods' => 'GET',
        'pattern' => '/node_type/{contentModel:([a-z]{2,})}_{page:([1-9]{1}[0-9]{0,11})}.html',
        'paths' => array(
            'controller' => 'Index',
            'action' => 'Type',
            'module' => 'node',
            'namespace' => 'Modules\Node\Controllers',
        ),
    ),
);
