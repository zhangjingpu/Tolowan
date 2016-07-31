<?php
namespace Modules\Entity\Entity\Fields;

use Core\Config;
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
        $this->getDI()->getFlash()->success('Hahahhahhahhah');
        if (isset($this->_options['fullTextSearch']) && $this->_options['fullTextSearch'] === true && isset($this->_options['entityId']) && isset($this->_options['fieldName'])) {
            $params = array(
                'entity' => $this->_options['entityId'],
                'field' => $this->_options['fieldName'],
                'id' => $this->id
            );
            Queue::add('entityFieldScsw',$params);
        }
    }
}