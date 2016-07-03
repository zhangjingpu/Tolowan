<?php
namespace Modules\Node\Models;

use Phalcon\Mvc\Model;

class NodeMate extends Model
{
    public $id;
    public $nid;
    public $yes;
    public $no;
    public $comment_num;
    public $browse;
    public function initialize()
    {
        $this->setSource('node_mate');
    }
}
