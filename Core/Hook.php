<?php
namespace Core;

class Hook
{
    public static $hookList;

    public function __construct()
    {
        self::$hookList = Config::cache('hookList');
    }

    public function fire()
    {

    }

    public function attach()
    {

    }
}