<?php
namespace Modules\Node\Models;

use Phalcon\Mvc\Model;

class NodeFieldArticle extends Model
{
    public $id;
    public $nid;
    public $title;
    public $body;
    public $description;
    public $images;
}
