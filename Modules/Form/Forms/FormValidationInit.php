<?php
namespace Modules\Form\Forms;

class FormValidationInit
{
    public static function presenceOf(&$t, $element)
    {
        if (!isset($element['message']) || empty($element['message'])) {
            $element['message'] = '值不能为空';
        }
        $t->addValidator(new \Phalcon\Validation\Validator\PresenceOf($element));
    }

    public static function identical(&$t, $element)
    {
        if (!isset($element['message']) || empty($element['message'])) {
            $element['message'] = '您必须要接受这个选项才能继续。';
        }
        $t->addValidator(new \Phalcon\Validation\Validator\Identical($element));
    }

    public static function functions(&$t, $element)
    {
        if (!isset($element['message']) || empty($element['message'])) {
            $element['message'] = '验证失败。';
        }
        $t->addValidator(new \Core\Validation\FunctionValidator($element));
    }

    public static function email(&$t, $element)
    {
        if (!isset($element['message']) || empty($element['message'])) {
            $element['message'] = '邮件地址不合法';
        }
        $t->addValidator(new \Phalcon\Validation\Validator\Email($element));
    }

    public static function exclusionIn(&$t, $element)
    {
        if (!isset($element['message']) || empty($element['message'])) {
            $element['message'] = '值不能包含' . implode('，', $element['domain']);
        }
        $t->addValidator(new \Phalcon\Validation\Validator\ExclusionIn($element));
    }

    public static function inclusionIn(&$t, $element)
    {
        if (!isset($element['message']) || empty($element['message'])) {
            $element['message'] = '值必须是以下值其中之一：' . implode('，', $element['domain']);
        }
        $t->addValidator(new \Phalcon\Validation\Validator\InclusionIn($element));
    }

    public static function regex(&$t, $element)
    {
        if (!isset($element['message']) || empty($element['message'])) {
            $element['message'] = '字段不合法';
        }
        $t->addValidator(new \Phalcon\Validation\Validator\Regex($element));
    }

    public static function stringLength(&$t, $element)
    {
        if (!isset($element['messageMaximum']) || empty($element['messageMaximum'])) {
            $element['messageMaximum'] = '值的长度不能大于' . $element['max'];
        }
        if (!isset($element['messageMinimum']) || empty($element['messageMinimum'])) {
            $element['messageMinimum'] = '值的长度不能小于' . $element['min'];
        }
        $t->addValidator(new \Phalcon\Validation\Validator\StringLength($element));
    }

    public static function between(&$t, $element)
    {
        if (!isset($element['message']) || empty($element['message'])) {
            $element['message'] = '数值必须在　' . $element['minimum'] . '　和　' . $element['maximum'] . '　之间';
        }
        $t->addValidator(new \Phalcon\Validation\Validator\Between($element));
    }

    public static function confirmation(&$t, $element)
    {
        if (!isset($element['message']) || empty($element['message'])) {
            $element['message'] = '值不合法';
        }
        $t->addValidator(new \Phalcon\Validation\Validator\Confirmation($element));
    }
}