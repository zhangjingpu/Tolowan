<?php
namespace Modules\Book\Models;

use Phalcon\Mvc\Model;

class NodeBook extends Model
{
    public $id;
    public $nid;
    public $bid;
    public $pid;
    public $weight;
    public $title;
    public $created;
    public $changed;

    public function beforeValidationOnCreate()
    {
        if (!$this->created) {
            $this->created = time();
        }
        $this->changed = time();
    }

    public function beforeValidationOnUpdate()
    {
        $this->changed = time();
    }

    public function getChildren()
    {
        $query = array(
            'conditions' => 'pid = :parent:',
            'bind' => array(
                'parent' => $this->id,
            ),
            'order' => 'widget',
        );
        $output = self::find($query);
        return $output;
    }
}
