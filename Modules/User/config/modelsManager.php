<?php
$settings = array(
    'user' => array(
        'entity' => 'Modules\User\Models\User',
        'columns' => array('user.id', 'user.name', 'user.email', 'user.password', 'user.created', 'user.active'),
    ),
    'user_info' => array(
        'entity' => 'Modules\User\Models\UserInfo',
        'columns' => array('user_info.id', 'user_info.uid', 'user_info.portrait', 'user_info.qq', 'user_info.phone', 'user_info.home_site', 'user_info.gender', 'user_info.job', 'user_info.area', 'user_info.school'),
    ),
    'user_log' => array(
        'entity' => 'Modules\User\Models\UserLog',
        'columns' => array('user_log.id', 'user_log.uid', 'user_log.data', 'user_log.type'),
    ),
    'user_roles' => array(
        'entity' => 'Modules\User\Models\UserRoles',
        'columns' => array('user_roles.id', 'user_roles.uid', 'user_roles.role', 'user_roles.created'),
    ),
);
