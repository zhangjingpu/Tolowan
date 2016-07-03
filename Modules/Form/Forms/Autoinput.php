<?php
namespace Modules\Form\Forms;

use Phalcon\Forms\Element;

class Autoinput extends Element
{

    public function setOptions($options = array())
    {
        $this->options = $options;
    }

    public function getOptions()
    {
        return $this->options;
    }

    public function getDefault()
    {
        if (!empty($this->defaultValue) && is_array($this->defaultValue)) {
            return implode(',', $this->defaultValue);
        } else {
            return ' ';
        }
    }

    public function setDefault($value = array())
    {
        $this->defaultValue = $value;
    }

    public function render($attributes = null)
    {
        $output = '';
        $name = $this->getName();
        $output = '<input type="search" autocomplete="off" placeholder="输入关键字" name="' . $name . '" id="auto-input-' . $name . '">';
        return $output;
    }

}
