<?php
use Core\Config;
$di->setShared('user','\Modules\User\Library\User');

function getRolesList() {
    return Config::get('m.user.entityUserContentModelList');
}
function getRolesOptions() {
    $rolesList = getRolesList();
    $options = array();
    foreach ($rolesList as $rkey=>$role){
        $options[$rkey] = $role['modelName'];
    }
    return $options;
}
function userList($query){
    global $di;
    $user = $di->getShared('entityManager')->getEntity('user');
    return $user->gets($query);
}