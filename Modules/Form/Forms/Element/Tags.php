<?php
namespace Modules\Form\Forms\Element;

use Phalcon\Forms\Element\TextArea;
use Core\Config;

class Tags extends TextArea
{
    public function getValue()
    {
        $value = parent::getValue();
        if(is_array($value)){
            return implode(',',$value);
        }
        return $value;
    }
}
