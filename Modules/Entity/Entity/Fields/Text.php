<?php
namespace Modules\Entity\Entity\Fields;

use Phalcon\Mvc\Model;
use Modules\Queue\Library\Queue;

class Text extends Field
{
    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        if (is_array($value)) {
            $value = serialize($value);
        }
        $this->value = $value;
    }

    public function afterSave()
    {
        if (isset($this->_options['fullTextSearch']) && $this->_options['fullTextSearch'] === true && isset($this->_options['entity']) && isset($this->_options['field'])) {
            $params = array(
                'entity' => $this->_options['entity'],
                'field' => $this->_options['field'],
                'id' => $this->id
            );
            Queue::add('entityFieldScsw',$params);
        }
    }
}