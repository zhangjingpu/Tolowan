<?php
namespace Modules\Node\Models;

use Phalcon\Mvc\Model;

class Node extends Model
{
    public $id;
    public $state;
    public $contentModel;
    public $created;
    public $changed;
    public $uid;
    public $comment;//是否开启评论
    public $top;
    public $essence;
    public $hot;
    // 设置数据库

}
