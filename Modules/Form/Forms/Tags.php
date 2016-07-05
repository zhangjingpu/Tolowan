<?php
namespace Modules\Form\Forms;

use Phalcon\Forms\Element;

class Tags extends Element
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
        $output = '<input type="text" placeholder="请输入标签后回车" value="" id="tags-' . $name . '" name="' . $name . '">';
        return $output;
    }

}
