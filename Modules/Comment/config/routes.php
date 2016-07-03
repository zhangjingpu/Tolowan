<?php
$settings = array(
    'commentList' => array(
        'httpMethods' => 'GET',
        'pattern' => '/comment/{nid:([1-9]{1}[0-9]{0,11})}_{pid:([1-9]{1}[0-9]{0,11})}_{page:([1-9]{1}[0-9]{0,11})}',
        'paths' => array(
            'controller' => 'Index',
            'action' => 'Index',
            'module' => 'comment',
            'namespace' => 'Modules\Comment\Controllers',
        ),
    ),
    'commentLove' => array(
        'httpMethods' => 'GET',
        'pattern' => '/comment_love/{id:([1-9]{1}[0-9]{0,11})}',
        'paths' => array(
            'controller' => 'Index',
            'action' => 'Love',
            'module' => 'comment',
            'namespace' => 'Modules\Comment\Controllers',
        ),
    ),
);
