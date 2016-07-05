<?php
namespace Core\Volt;

class CoreExtensions
{
  public function compileFunction($name, $arguments)
  {
    if (function_exists($name)) {
      return $name . '(' . $arguments . ')';
    }
  }
}