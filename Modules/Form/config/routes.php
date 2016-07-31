<?php
$settings = array(
    'validateCode' => array(
        'httpMethods' => 'GET',
        'pattern' => '/validate_code',
        'paths' => array(
            'controller' => 'Index',
            'action' => 'validateCode',
            'module' => 'form',
            'namespace' => 'Modules\Form\Controllers',
        ),
    ),
    'autoSource' => array(
        'httpMethods' => 'GET',
        'pattern' => '/auto_source/{id:([a-z_A-Z]{2,})}/{word}',
        'paths' => array(
            'controller' => 'Index',
            'action' => 'autoSource',
            'module' => 'form',
            'namespace' => 'Modules\Form\Controllers',
        ),
    ),
);
