<?php
namespace Modules\Form\Forms;

class FormElementInit
{

    public static function text(&$t, $element)
    {
        $field = new \Phalcon\Forms\Element\Text($element['key'], $element['value']['attributes']);
        return $field;
    }

    public static function hidden(&$t, $element)
    {
        $field = new \Phalcon\Forms\Element\Hidden($element['key'], $element['value']['attributes']);
        return $field;
    }

    public static function Tags(&$t, $element)
    {
        $field = new \Modules\Form\Forms\Element\Tags($element['key'], $element['value']['attributes']);
        return $field;
    }

    public static function Autoinput(&$t, $element)
    {
        $field = new \Modules\Form\Forms\Element\Autoinput($element['key'], $element['value']['attributes']);
        return $field;
    }

    public static function checkboxs(&$t, $element)
    {
        $field = new \Modules\Form\Forms\Element\Checkboxes($element['key'], $element['value']['attributes']);
        $field->setOptions($element['value']['options']);
        return $field;
    }

    public static function group(&$t, $element)
    {
        $field = new \Modules\Form\Forms\Element\Group($element['key'], $element['value']['attributes']);
        $field->setGroup($element['value']['group']);
        $t->addField($element['value']['group']);
        return $field;
    }

    public static function groupTabs(&$t, $element)
    {
        $field = new \Modules\Form\Forms\Element\GroupTabs($element['key'], $element['value']['attributes']);
        $field->setGroupTabs($element['value']['groupTabs']);
        $t->addField($element['value']['groupTabs']);
        return $field;
    }

    public static function validateCode(&$t, $element)
    {
        $field = new \Modules\Form\Forms\Element\ValidateCode($element['key'], $element['value']['attributes']);
        return $field;
    }

    public static function machineName(&$t, $element)
    {
        $field = new \Modules\Form\Forms\Element\MachineName($element['key'], $element['value']['attributes']);
        return $field;
    }

    public static function radios(&$t, $element)
    {
        $field = new \Modules\Form\Forms\Element\Radios($element['key'], $element['value']['attributes']);
        $field->setOptions($element['value']['options']);
        return $field;
    }

    public static function kvgroup(&$t, $element)
    {
        $field = new \Modules\Form\Forms\Element\Kvgroup($element['key'], $element['value']['attributes']);
        return $field;
    }

    public static function radio(&$t, $element)
    {
        $field = new \Phalcon\Forms\Element\Radio($element['key'], $element['value']['attributes']);
        return $field;
    }

    public static function select(&$t, $element)
    {
        $field = new \Phalcon\Forms\Element\Select($element['key'], $element['value']['options'], $element['value']['attributes']);
        return $field;
    }

    public static function selects(&$t, $element)
    {
        $field = new \Modules\Form\Forms\Element\Selects($element['key'], $element['value']['options'], $element['value']['attributes']);
        return $field;
    }

    public static function check(&$t, $element)
    {
        $field = new \Phalcon\Forms\Element\Check($element['key'], $element['value']['attributes']);
        if (!isset($element['value']['value'])) {
            $element['value']['value'] = 1;
        }
        $field->setDefault($element['value']['value']);
        return $field;
    }

    public static function date(&$t, $element)
    {
        $field = new \Phalcon\Forms\Element\Date($element['key'], $element['value']['attributes']);
        return $field;
    }

    public static function password(&$t, $element)
    {
        $field = new \Phalcon\Forms\Element\Password($element['key'], $element['value']['attributes']);
        return $field;
    }

    public static function email(&$t, $element)
    {
        $field = new \Phalcon\Forms\Element\Email($element['key'], $element['value']['attributes']);
        return $field;
    }

    public static function textarea(&$t, $element)
    {
        $field = new \Phalcon\Forms\Element\TextArea($element['key'], $element['value']['attributes']);
        return $field;
    }

    public static function file(&$t, $element)
    {
        $field = new \Phalcon\Forms\Element\File($element['key'], $element['value']['attributes']);
        return $field;
    }
}
