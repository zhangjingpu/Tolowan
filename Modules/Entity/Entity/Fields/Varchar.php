<?php
namespace Modules\Entity\Entity\Fields;

use Phalcon\Mvc\Model;

class Varchar extends Field
{
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
                'field' => $this->_options['fieldName'],
                'id' => $this->id
            );
            Queue::add('entityFieldScsw', $params);
        }
    }
}