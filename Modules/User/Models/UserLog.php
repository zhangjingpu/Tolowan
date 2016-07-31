<?php
namespace Modules\User\Models;

use Phalcon\Mvc\Model;

class UserLog extends Model
{
    public $id;
    public $uid;
    public $type;
    public $created;
    public $notice;
    // 设置数据库
    public function beforeValidationOnCreate()
    {
        $this->created = time();
    }
}
