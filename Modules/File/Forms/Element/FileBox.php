<?php
namespace Modules\File\Forms\Element;

use Phalcon\Forms\Element\Text;

class FileBox extends Text
{
    public function ex()
    {
        return array_filter(explode(';', trim($this->getValue(),';')));
    }
}
