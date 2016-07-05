<?php
namespace Modules\Entity\Entity\Fields;

class Images extends Field{
    
    protected $value;

    public function setValue($value){
        if(is_array($value)){
            $value = serialize($value);
        }
        $this->value = $value;
    }
}