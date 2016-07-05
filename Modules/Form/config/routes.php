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
);
