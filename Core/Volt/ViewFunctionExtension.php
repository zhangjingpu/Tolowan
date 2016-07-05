<?php
namespace Core\Volt;

class ViewFunctionExtension
{
    public function compileFunction($name, $arguments)
    {
        if (function_exists($name)) {
            return $name . '(' . $arguments . ')';
        } elseif ($name[0] == '\\') {
            $class_fun = explode('::', $name);
            if (count($class_fun) == 2) {
                if (method_exists($class_fun[0], $class_fun[1])) {
                    return $name . '(' . $arguments . ')';
                }
            }
        }
    }
}
