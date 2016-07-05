<?php
namespace Modules\File\Forms;

class FormElementInit{
    public static function fileBox(&$t, $element)
    {
        $field = new \Modules\File\Forms\Element\FileBox($element['key'], $element['value']['attributes']);
        return $field;
    }
    public static function file(&$t, $element)
    {
        $t->setAttribute('enctype','multipart/form-data');
        $field = new \Modules\File\Forms\Element\File($element['key'], $element['value']['attributes']);
        $field->setConfig($element['value']['settings']);
        return $field;
    }
    public static function fileBoxField(&$key,&$element){
        $settings = $element['settings'];
    }
}