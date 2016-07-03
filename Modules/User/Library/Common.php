<?php
namespace Modules\User\Library;

use Modules\User\Entity\User as Muser;
use Modules\User\Models\UserInfo;
use Modules\User\Models\UserRoles;

class Common
{
    //注册
    public static function register($form){
        global $di;
        $data = $form->getData();
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->phone = $data['phone'];
        $user->password = $di->getShared('security')->hash($data['password']);
        $user->active = 1;
        $user->email_validate = 1;
        $user->phone_validate = 1;
        if ($user->save()){
            return $user;
        }
        return false;

    }
    //登陆
    public static function login($form){
        global $di;
        $data = $form->getData();
        if(strpos($data['user'],'@')){
            $user = Muser::findFirstByEmail($data['user']);
        }else{
            $user = Muser::findFirstByPhone($data['user']);
        }
        if($di->getShared('security')->checkHash($data['password'],$user->password)){
            if($di->getShared('user')->login($user->id) === true){
                return $user;
            }
            return false;
        }else{
            return false;
        }
    }
    public static function userRoles($uid){
        $userRoles = UserRoles::findByUid($uid);
        $userRolesArr = array();
        foreach($userRoles as $ur){
            $userRolesArr[$ur->role] = $ur->role;
        }
        return $userRolesArr;
    }
    public static function userDelete($uid){
        global $di;
        $db = $di->getShared('db');
        $db->begin();
        $user = Muser::findFirst($uid);
        if(!$user){
            return false;
        }
        if($user->delete()){
            $userRoles = UserRoles::findByUid($uid);
            $number = 0;
            foreach($userRoles as $ur){
                if($ur->delete()){
                    $number++;
                }
            }
            if(count($userRoles) == $number){
                $db->commit();
                return true;
            }
        }
        $db->rollback();
        return false;
    }
}
