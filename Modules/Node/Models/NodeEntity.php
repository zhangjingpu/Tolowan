<?php
namespace Modules\Node\Models;

use Modules\Node\Models\Node;
use Phalcon\Mvc\Model;

class NodeEntity extends Model
{
    public static $type;
    public function initialize()
    {
        $this->setSource('node_' . self::$type);
    }
}
