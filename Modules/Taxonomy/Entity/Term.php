<?php
namespace Modules\Taxonomy\Entity;

use Core\Config;
use Modules\Entity\Entity\EntityModel;

class Term extends EntityModel
{
    protected $_source = 'term';

    protected $_table = 'term';

    protected $_entity = 'term';

    protected $_entityId = 'term';
    protected $entityClassName = '\Modules\Taxonomy\Entity\Term';

    protected $_module = 'taxonomy';

    public function getChildren()
    {
        $query = array(
            'conditions' => 'parent = :parent:',
            'bind' => array(
                'parent' => $this->id,
            ),
            'order' => 'widget',
        );
        $output = self::find($query);
        return $output;
    }
}
